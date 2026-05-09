<?php

namespace App\Http\Controllers\Api\Freelancer;

use App\Http\Controllers\Controller;
use App\Http\Services\Frontend\IyzicoPaymentService;
use App\Models\User;
use App\Models\Project;
use App\Models\AdminNotification;
use App\Mail\BasicMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Modules\PromoteFreelancer\Entities\PromotionProjectList;
use Modules\Subscription\Entities\UserSubscription;
use Modules\Subscription\Entities\Subscription;

class IyzicoCallbackController extends Controller
{
    /**
     * Web callback handler that receives POST from Iyzico and redirects as GET
     * so that the Flutter WebView can intercept the query parameters properly.
     */
    public function handle3dsCallbackWeb(Request $request)
    {
        $status = $request->status;
        $paymentId = $request->paymentId;
        $orderId = $request->order_id; 
        $type = $request->type ?? 'promotion';

        // Redirect to a dummy endpoint holding the data in query string
        return redirect()->to(url("/api/v1/freelancer/iyzico/3ds-callback-web/result?status={$status}&paymentId={$paymentId}&order_id={$orderId}&type={$type}"));
    }

    /**
     * Complete 3DS payment for Freelancer specific items (Promotion, Subscription)
     */
    public function handle3dsCallback(Request $request)
    {
        $request->validate([
            'payment_id' => 'required|string',
            'order_id' => 'required|integer', // This could be promotion_id or subscription_id
            'type' => 'nullable|string|in:promotion,subscription,wallet', // To distinguish what we are paying for
        ]);

        $user = auth('sanctum')->user();
        $type = $request->type ?? 'promotion'; // Default to promotion for now as it's the primary focus

        $iyzicoService = new IyzicoPaymentService();
        $result = $iyzicoService->complete3DS($request->payment_id);

        if ($result->getStatus() === 'success') {
            
            if ($type === 'promotion') {
                return $this->handlePromotionSuccess($request->order_id, $user, $result);
            } else if ($type === 'subscription') {
                return $this->handleSubscriptionSuccess($request->order_id, $user, $result);
            } else {
                return $this->handleWalletSuccess($request->order_id, $user, $result);
            }
        }

        return response()->json([
            'status' => 'error',
            'msg' => $result->getErrorMessage() ?? __('3D Secure verification failed'),
            'error_code' => $result->getErrorCode(),
        ], 422);
    }

    private function handlePromotionSuccess($promotion_id, $user, $result)
    {
        $promoted_package_details = PromotionProjectList::where('id', $promotion_id)
            ->where('user_id', $user->id)
            ->where('payment_status', 'pending')
            ->first();

        if (!$promoted_package_details) {
            return response()->json([
                'status' => 'error',
                'msg' => __('Promotion not found or already processed'),
            ], 422);
        }

        $promoted_package_details->update([
            'payment_status' => 'complete',
            'status' => 1,
            'transaction_id' => $result->getPaymentId(),
            'is_valid_payment' => 'yes',
        ]);

        // Activate PRO status
        if ($promoted_package_details->type == 'profile') {
            User::where('id', $user->id)->update([
                'is_pro' => 'yes',
                'pro_expire_date' => $promoted_package_details->expire_date
            ]);
        } else {
            Project::where('id', $promoted_package_details->identity)->update([
                'is_pro' => 'yes',
                'pro_expire_date' => $promoted_package_details->expire_date
            ]);
        }

        // Notification & Email
        AdminNotification::create([
            'identity' => $promoted_package_details->identity,
            'user_id' => $user->id,
            'type' => __('Buy Package'),
            'message' => __('Promotion package purchase (Iyzico)'),
        ]);

        $this->sendPromotionEmail($user->first_name . ' ' . $user->last_name, $promotion_id, $user->email);

        return response()->json([
            'status' => 'success',
            'msg' => __('Promotion payment completed successfully'),
            'promotion_id' => $promotion_id,
        ]);
    }

    private function handleSubscriptionSuccess($subscription_id, $user, $result)
    {
        $subscription_details = UserSubscription::where('id', $subscription_id)
            ->where('user_id', $user->id)
            ->where('payment_status', 'pending')
            ->first();

        if (!$subscription_details) {
            return response()->json([
                'status' => 'error',
                'msg' => __('Subscription not found or already processed'),
            ], 422);
        }

        $subscription_details->update([
            'payment_status' => 'complete',
            'status' => 1,
            'transaction_id' => $result->getPaymentId(),
        ]);

        AdminNotification::create([
            'identity' => $subscription_id,
            'user_id' => $user->id,
            'type' => __('Buy Subscription'),
            'message' => __('User subscription purchase (Iyzico)'),
        ]);

        $this->sendSubscriptionEmail($user->first_name . ' ' . $user->last_name, $subscription_id, $user->email);

        return response()->json([
            'status' => 'success',
            'msg' => __('Subscription payment completed successfully'),
            'subscription_id' => $subscription_id,
        ]);
    }

    private function handleWalletSuccess($wallet_history_id, $user, $result)
    {
        $wallet_history = \Modules\Wallet\Entities\WalletHistory::where('id', $wallet_history_id)
            ->where('user_id', $user->id)
            ->where('payment_status', 'pending')
            ->first();

        if (!$wallet_history) {
            return response()->json([
                'status' => 'error',
                'msg' => __('Wallet history not found or already processed'),
            ], 422);
        }

        $wallet_history->update([
            'payment_status' => 'complete',
            'status' => 1,
        ]);

        $wallet = \Modules\Wallet\Entities\Wallet::where('user_id', $user->id)->first();
        $wallet->update(['balance' => $wallet->balance + $wallet_history->amount]);

        AdminNotification::create([
            'identity' => $wallet_history_id,
            'user_id' => $user->id,
            'type' => __('Deposit To Wallet'),
            'message' => __('Wallet deposit (Iyzico)'),
        ]);

        $this->sendWalletEmail($user->first_name . ' ' . $user->last_name, $wallet_history_id, $user->email);

        return response()->json([
            'status' => 'success',
            'msg' => __('Wallet credited successfully'),
            'wallet_history_id' => $wallet_history_id,
        ]);
    }

    private function sendWalletEmail($name, $id, $email)
    {
        try {
            Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                'subject' => __('Deposit Confirmation'),
                'message' => __('A user just deposited to his wallet via Iyzico. ID: ') . $id
            ]));
            Mail::to($email)->send(new BasicMail([
                'subject' => __('Deposit Confirmation'),
                'message' => __('Your wallet deposit was successful via Iyzico. ID: ') . $id
            ]));
        } catch (\Exception $e) {}
    }

    private function sendPromotionEmail($name, $id, $email)
    {
        try {
            Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                'subject' => __('Promotion package purchase email'),
                'message' => __('A user just purchased a promotion package via Iyzico. ID: ') . $id
            ]));
            Mail::to($email)->send(new BasicMail([
                'subject' => __('Promotion package purchase email'),
                'message' => __('Your promotion package purchase successfully completed via Iyzico. ID: ') . $id
            ]));
        } catch (\Exception $e) {}
    }

    private function sendSubscriptionEmail($name, $id, $email)
    {
        try {
            Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                'subject' => __('Subscription purchase email'),
                'message' => __('A user just purchased a subscription via Iyzico. ID: ') . $id
            ]));
            Mail::to($email)->send(new BasicMail([
                'subject' => __('Subscription purchase email'),
                'message' => __('Your subscription purchase successfully completed via Iyzico. ID: ') . $id
            ]));
        } catch (\Exception $e) {}
    }
}
