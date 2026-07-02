<?php

namespace App\Services;

use Google\Client as GoogleClient;
use Google\Service\AndroidPublisher;
use Illuminate\Support\Facades\Log;

/**
 * Verifies Google Play subscription purchases via the Android Publisher API.
 *
 * Requires configuration (fail-closed if missing):
 *  - GOOGLE_PLAY_PACKAGE_NAME        : the app's package name (e.g. com.xilancer.app)
 *  - GOOGLE_PLAY_SERVICE_ACCOUNT_JSON: absolute path to the service account JSON key
 *                                      with androidpublisher scope.
 *    (falls back to get_static_option('google_play_service_account_json') /
 *     get_static_option('google_play_package_name')).
 *
 * Without valid config we return false so purchases are NOT granted for free.
 */
class GooglePlayVerifier
{
    public ?string $error = null;
    public ?\Carbon\Carbon $expiresAt = null;

    /**
     * @param string $productId    The subscription product id.
     * @param string $purchaseToken The purchase token from the client.
     */
    public function verify(string $productId, string $purchaseToken): bool
    {
        $packageName = env('GOOGLE_PLAY_PACKAGE_NAME')
            ?: get_static_option('google_play_package_name');
        $saJsonPath = env('GOOGLE_PLAY_SERVICE_ACCOUNT_JSON')
            ?: get_static_option('google_play_service_account_json');

        if (empty($packageName) || empty($saJsonPath) || !is_file($saJsonPath)) {
            return $this->fail('Google Play verification not configured (package name / service account JSON missing)');
        }

        try {
            $client = new GoogleClient();
            $client->setAuthConfig($saJsonPath);
            $client->addScope(AndroidPublisher::ANDROIDPUBLISHER);

            $service = new AndroidPublisher($client);
            $purchase = $service->purchases_subscriptions->get(
                $packageName,
                $productId,
                $purchaseToken
            );

            // paymentState: 0 = pending, 1 = received, 2 = free trial, 3 = pending deferred upgrade.
            $paymentState = $purchase->getPaymentState();
            if ($paymentState === null || !in_array($paymentState, [1, 2], true)) {
                return $this->fail('Payment not in a paid/trial state (paymentState=' . var_export($paymentState, true) . ')');
            }

            $expiryMs = $purchase->getExpiryTimeMillis();
            if ($expiryMs !== null) {
                $this->expiresAt = \Carbon\Carbon::createFromTimestampMs((int) $expiryMs)
                    ->setTimezone(config('app.timezone'));
                if ($this->expiresAt->isPast()) {
                    return $this->fail('Subscription already expired');
                }
            }

            return true;
        } catch (\Throwable $e) {
            return $this->fail('Exception: ' . $e->getMessage());
        }
    }

    private function fail(string $reason): bool
    {
        $this->error = $reason;
        Log::warning('GooglePlayVerifier failed: ' . $reason);
        return false;
    }
}
