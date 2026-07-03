<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AppleJwsVerifier;
use App\Services\GooglePlayVerifier;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Modules\Subscription\Entities\Subscription;
use Modules\Subscription\Entities\UserSubscription;
use Modules\Subscription\Services\PlanGate;

/**
 * Store subscription lifecycle webhooks.
 *
 * Without these, an auto-renewing subscription keeps charging the user in the
 * store while the backend's expire_date lapses and silently downgrades a PAYING
 * user to the free plan. These endpoints keep expire_date in sync and revoke
 * access on refund/expiry.
 *
 *  - Apple App Store Server Notifications V2 (JWS signedPayload) → /webhooks/apple-iap
 *  - Google Real-Time Developer Notifications (Pub/Sub push)     → /webhooks/google-iap
 *
 * Matching key: user_subscriptions.original_transaction_id
 *  (Apple originalTransactionId / Google purchaseToken).
 */
class StoreWebhookController extends Controller
{
    /** Apple App Store Server Notifications V2. */
    public function apple(Request $request)
    {
        $signedPayload = $request->input('signedPayload');
        if (empty($signedPayload)) {
            return response()->json(['msg' => 'missing signedPayload'], 400);
        }

        $verifier = new AppleJwsVerifier();
        $payload = $verifier->decode($signedPayload);
        if ($payload === null) {
            Log::warning('Apple webhook: signedPayload verification failed', ['reason' => $verifier->error]);
            return response()->json(['msg' => 'invalid signature'], 401);
        }

        $notificationType = $payload['notificationType'] ?? '';
        $subtype = $payload['subtype'] ?? '';
        $data = (array) ($payload['data'] ?? []);

        // The transaction details are a nested signed JWS.
        $transaction = [];
        if (!empty($data['signedTransactionInfo'])) {
            $txVerifier = new AppleJwsVerifier();
            $transaction = $txVerifier->decode($data['signedTransactionInfo']) ?? [];
        }

        $originalTransactionId = $transaction['originalTransactionId'] ?? null;
        if (empty($originalTransactionId)) {
            Log::warning('Apple webhook: no originalTransactionId', ['type' => $notificationType]);
            return response()->json(['status' => 'ignored']);
        }

        $expiresAt = null;
        if (!empty($transaction['expiresDate'])) {
            $expiresAt = Carbon::createFromTimestampMs((int) $transaction['expiresDate'])
                ->setTimezone(config('app.timezone'));
        }

        Log::info('Apple webhook received', [
            'type' => $notificationType,
            'subtype' => $subtype,
            'original_transaction_id' => $originalTransactionId,
            'expires_at' => (string) $expiresAt,
        ]);

        switch ($notificationType) {
            case 'SUBSCRIBED':
            case 'DID_RENEW':
            case 'DID_CHANGE_RENEWAL_STATUS': // user toggled auto-renew; access unchanged until expiry
            case 'OFFER_REDEEMED':
                if ($expiresAt) {
                    $this->extend($originalTransactionId, $expiresAt, $transaction['productId'] ?? null, 'apple_iap');
                }
                break;

            case 'DID_FAIL_TO_RENEW':
                // Billing retry; with GRACE_PERIOD subtype Apple still grants access.
                if ($subtype === 'GRACE_PERIOD' && $expiresAt) {
                    $this->extend($originalTransactionId, $expiresAt, $transaction['productId'] ?? null, 'apple_iap');
                }
                break;

            case 'EXPIRED':
            case 'GRACE_PERIOD_EXPIRED':
                $this->revoke($originalTransactionId, 'expired');
                break;

            case 'REFUND':
            case 'REVOKE':
                $this->revoke($originalTransactionId, 'refund');
                break;

            default:
                // TEST, CONSUMPTION_REQUEST, PRICE_INCREASE, RENEWAL_EXTENDED, ...
                break;
        }

        return response()->json(['status' => 'ok']);
    }

    /** Google Real-Time Developer Notifications (Pub/Sub push wrapper). */
    public function google(Request $request)
    {
        $messageData = $request->input('message.data');
        if (empty($messageData)) {
            return response()->json(['msg' => 'missing message'], 400);
        }

        $decoded = json_decode(base64_decode($messageData), true);
        if (!is_array($decoded)) {
            return response()->json(['msg' => 'invalid payload'], 400);
        }

        $sub = $decoded['subscriptionNotification'] ?? null;
        if (!is_array($sub)) {
            // voidedPurchaseNotification / testNotification etc.
            $voided = $decoded['voidedPurchaseNotification'] ?? null;
            if (is_array($voided) && !empty($voided['purchaseToken'])) {
                $this->revoke($voided['purchaseToken'], 'refund');
            }
            return response()->json(['status' => 'ok']);
        }

        $purchaseToken = $sub['purchaseToken'] ?? null;
        $productId = $sub['subscriptionId'] ?? null;
        $type = (int) ($sub['notificationType'] ?? 0);

        if (empty($purchaseToken) || empty($productId)) {
            return response()->json(['status' => 'ignored']);
        }

        Log::info('Google RTDN received', ['type' => $type, 'product_id' => $productId]);

        // Notification types: 2=RENEWED 3=CANCELED 4=PURCHASED 7=RESTARTED
        // 12=REVOKED 13=EXPIRED 5=ON_HOLD 6=IN_GRACE_PERIOD 10=PAUSED
        if (in_array($type, [12, 13], true)) {
            $this->revoke($purchaseToken, $type === 12 ? 'refund' : 'expired');
            return response()->json(['status' => 'ok']);
        }

        if (in_array($type, [2, 4, 6, 7], true)) {
            // Verify against the Android Publisher API — never trust the push alone.
            $verifier = new GooglePlayVerifier();
            if ($verifier->verify($productId, $purchaseToken) && $verifier->expiresAt) {
                $this->extend($purchaseToken, $verifier->expiresAt, $productId, 'google_iap');
            } else {
                Log::warning('Google RTDN verify failed', ['reason' => $verifier->error]);
            }
        }

        return response()->json(['status' => 'ok']);
    }

    /** Extend/refresh the matching subscription's expiry (renewal). */
    private function extend(string $originalTransactionId, Carbon $expiresAt, ?string $productId, string $gateway): void
    {
        $existing = UserSubscription::where('original_transaction_id', $originalTransactionId)
            ->orderByDesc('id')
            ->first();

        if (!$existing) {
            Log::warning('Store webhook: no subscription row for reference', [
                'reference' => $originalTransactionId,
            ]);
            return;
        }

        // Renewal may arrive after the row lapsed — reactivate and extend.
        $existing->update([
            'expire_date' => $expiresAt,
            'status' => 1,
            'payment_status' => 'complete',
        ]);

        // Make sure no other row stays active for this user.
        UserSubscription::where('user_id', $existing->user_id)
            ->where('id', '!=', $existing->id)
            ->where('status', 1)
            ->update(['status' => 0]);

        PlanGate::forget($existing->user_id);
        Log::info('Store webhook: subscription extended', [
            'user_id' => $existing->user_id,
            'user_subscription_id' => $existing->id,
            'expire_date' => (string) $expiresAt,
            'gateway' => $gateway,
        ]);
    }

    /** Revoke access (refund) or let it lapse to free (expiry). */
    private function revoke(string $originalTransactionId, string $reason): void
    {
        $existing = UserSubscription::where('original_transaction_id', $originalTransactionId)
            ->orderByDesc('id')
            ->first();

        if (!$existing) {
            return;
        }

        $existing->update([
            'status' => 0,
            'expire_date' => Carbon::now()->subMinute(),
        ]);

        PlanGate::forget($existing->user_id);

        // Drop the user onto the free plan immediately so gating stays consistent.
        if (function_exists('check_and_downgrade_expired_subscription')) {
            check_and_downgrade_expired_subscription($existing->user_id);
        }

        Log::info('Store webhook: subscription revoked', [
            'user_id' => $existing->user_id,
            'user_subscription_id' => $existing->id,
            'reason' => $reason,
        ]);
    }
}
