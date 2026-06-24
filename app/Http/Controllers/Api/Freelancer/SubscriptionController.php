<?php

namespace App\Http\Controllers\Api\Freelancer;

use App\Helper\PaymentGatewayRequestHelper;
use App\Http\Controllers\Controller;
use App\Mail\BasicMail;
use App\Models\AdminNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Modules\Subscription\Entities\Subscription;
use Modules\Subscription\Entities\SubscriptionType;
use Modules\Subscription\Entities\UserSubscription;
use Modules\Wallet\Entities\Wallet;
use App\Http\Services\Frontend\IyzicoPaymentService;

class SubscriptionController extends Controller
{
    public static function cancel_old_subscriptions($user_id)
    {
        UserSubscription::where('user_id', $user_id)
            ->where('status', 1)
            ->update([
                'status' => 0,
                'expire_date' => Carbon::now()->subDay()
            ]);
    }

    public function switch_to_free(Request $request)
    {
        $user = auth('sanctum')->user();
        $free_subscription = Subscription::with('subscription_type:id,validity')->find(10);
        
        if (!$free_subscription) {
            return response()->json(['msg' => __('Free plan not found')], 422);
        }

        self::cancel_old_subscriptions($user->id);

        $user_sub = UserSubscription::create([
            'user_id' => $user->id,
            'subscription_id' => $free_subscription->id,
            'price' => 0,
            'limit' => $free_subscription->limit,
            'expire_date' => Carbon::now()->addDays($free_subscription->subscription_type->validity ?? 365),
            'payment_gateway' => 'free',
            'payment_status' => 'complete',
            'status' => 1,
        ]);

        return response()->json([
            'status' => 'success',
            'msg' => __('Switched to free plan successfully'),
            'subscription_details' => $user_sub
        ]);
    }

    //all types
    public function types()
    {
        $subscription_types = SubscriptionType::whereHas('subscriptions')->select('id','type','validity')->get();
        return response()->json([
            'subscription_types' => $subscription_types,
        ]);
    }

    //all frontend subscription with filter
    public function all_front_subscription(Request $request)
    {
        $request->validate([
            'type_id'=>'required'
        ]);

        $type_id = $request->type_id;

        if ($type_id == 'all') {
            $query = Subscription::with(['subscription_type:id,type','features:id,subscription_id,feature,feature_key,feature_value,status'])
                ->select(['id','subscription_type_id','title','logo','price','limit', 'apple_product_id', 'google_product_id'])
                ->where('status',1)
                ->latest()
                ->paginate(10)->withQueryString();

            $subscriptions = $query->through(function ($item) {
                if (!empty($item->logo)) {
                    $img_details = get_attachment_image_by_id($item->logo);
                    $item->logo = $img_details['img_url'] ?? null;
                }
                return $item;
            });
        }else {
            $check_type = SubscriptionType::where('id',$type_id)->first();
            if($check_type) {
                $query = Subscription::with(['subscription_type:id,type','features:id,subscription_id,feature,feature_key,feature_value,status'])
                    ->select(['id','subscription_type_id','title','logo','price','limit', 'apple_product_id', 'google_product_id'])
                    ->where('status',1)
                    ->where('subscription_type_id',$type_id)
                    ->latest()
                    ->paginate(10)->withQueryString();

                $subscriptions = $query->through(function ($item) {
                    if (!empty($item->logo)) {
                        $img_details = get_attachment_image_by_id($item->logo);
                        $item->logo = $img_details['img_url'] ?? null;
                    }
                    return $item;
                });
            }else{
                return response()->json([
                    'msg'=> __('Type not found')
                ]);
            }
        }

        return response()->json([
            'subscriptions' => $subscriptions,
        ]);
    }


    //below routes for auth user
    //freelancer subscription history list
    public function all_subscription()
    {
        $user_id = auth('sanctum')->user()->id;
        check_and_downgrade_expired_subscription($user_id);
        $all_subscriptions = UserSubscription::select('id','user_id','subscription_id','price','limit','status','payment_status','payment_gateway','expire_date','created_at')
            ->with(['user_subscription_type_api'])
            ->latest()
            ->where('user_id',$user_id)
            ->paginate(10)->withQueryString();

        $total_limit = UserSubscription::where('user_id',$user_id)
            ->where('payment_status','complete')
            ->where('status', 1)
            ->where('expire_date', '>', Carbon::now())
            ->sum('limit');

        return response()->json([
            'all_subscriptions' => $all_subscriptions,
            'total_limit' => $total_limit,
        ]);
    }

    //buy subscription
    public function buy_subscription(Request $request)
    {
        $request->validate([
            'subscription_id' => 'required',
            'selected_payment_gateway' => 'required',
        ]);

        $all_gateway = payment_gateway_list_for_api();
        if (!in_array($request->selected_payment_gateway, $all_gateway)) {
            return response()->json(['msg'=> __('Please select a valid payment gateway')])->setStatusCode(422);
        }

        if ($request->selected_payment_gateway === 'manual_payment') {
            $request->validate([
                'manual_payment_image' => 'required|mimes:jpg,jpeg,png,pdf'
            ]);
        }

        //get auth user
        $user = auth('sanctum')->user();
        $user_id = $user->id;
        $subscription_details = Subscription::with('subscription_type:id,validity')
            ->select(['id','subscription_type_id','price','limit'])
            ->where('id',$request->subscription_id)
            ->where('status','1')->first();

        if($subscription_details){
            $expire_date = \Carbon\Carbon::now()->addDays($subscription_details?->subscription_type?->validity);
            $title = __('Buy Subscription');
            $total = $subscription_details->price;
            $limit = $subscription_details->limit;
            $name = $user->first_name.' '.$user->last_name;
            $email = $user->email;
            $user_type = 'freelancer';
            $payment_status = $request->selected_payment_gateway === 'wallet' ? 'complete' : 'pending';
            $status = $request->selected_payment_gateway === 'wallet' ? 1 : 0;

            if ($total == 0) {
                return $this->switch_to_free($request);
            }

            if($request->selected_payment_gateway === 'manual_payment')
            {
                $request->validate(['manual_payment_image' => 'required|mimes:jpg,jpeg,png,pdf']);

                if($request->hasFile('manual_payment_image')){
                    $manual_payment_image = $request->manual_payment_image;
                    $img_ext = $manual_payment_image->extension();

                    $manual_payment_image_name = 'manual_attachment_'.time().'.'.$img_ext;
                    if(in_array($img_ext,['jpg','jpeg','png','pdf'])){
                        $manual_image_path = 'assets/uploads/manual-payment/subscription';

                        if (in_array($img_ext,['jpg','jpeg','png'])) {
                            $resize_full_image = Image::make($request->manual_payment_image);
                            $resize_full_image->save($manual_image_path .'/'. $manual_payment_image_name);
                        }else{
                            $manual_payment_image->move($manual_image_path,$manual_payment_image_name);
                        }
                        $buy_subscription = UserSubscription::create([
                            'user_id' => $user->id,
                            'subscription_id' => $subscription_details->id,
                            'price' => $total,
                            'limit' => $limit,
                            'expire_date' => $expire_date,
                            'payment_gateway' => $request->selected_payment_gateway,
                            'manual_payment_payment' => $manual_payment_image,
                            'payment_status' => $payment_status,
                            'status' => $status,
                        ]);
                        $last_subscription_id = $buy_subscription->id;
                        $this->adminNotification($last_subscription_id,$user->id);
                    }else{
                        return response()->json([
                            'msg' => __('Image type not supported')
                        ])->setStatusCode(422);
                    }
                }
                $this->sendEmail($name,$last_subscription_id,$email);

                return response()->json([
                    'msg' => __('Subscription purchase success. Your subscription will be usable after admin approval')
                ]);
            }
            elseif($request->selected_payment_gateway === 'wallet')
            {
                $wallet_balance = Wallet::select('balance')->where('user_id',$user->id)->first();
                if(isset($wallet_balance) && $wallet_balance->balance >= $total){
                    self::cancel_old_subscriptions($user->id);
                    $buy_subscription = UserSubscription::create([
                        'user_id' => $user->id,
                        'subscription_id' => $subscription_details->id,
                        'price' => $total,
                        'limit' => $limit,
                        'expire_date' => $expire_date,
                        'payment_gateway' => $request->selected_payment_gateway,
                        'payment_status' => $payment_status,
                        'status' => $status,
                    ]);
                    $last_subscription_id = $buy_subscription->id;
                    $this->adminNotification($last_subscription_id,$user->id);
                    Wallet::where('user_id',$user->id)->update(['balance'=> $wallet_balance->balance - $total]);

                }else{
                    return response()->json([
                        'msg' => __('Please deposit to your wallet and try again.')
                    ])->setStatusCode(422);
                }
                $this->sendEmail($name,$last_subscription_id,$email);
                return response()->json([
                    'msg' => __('Subscription purchase success.')
                ]);
            }
            elseif($request->selected_payment_gateway == 'iyzipay')
            {
                $buy_subscription = UserSubscription::create([
                    'user_id' => $user->id,
                    'subscription_id' => $subscription_details->id,
                    'price' => $total,
                    'limit' => $limit,
                    'expire_date' => $expire_date,
                    'payment_gateway' => $request->selected_payment_gateway,
                    'payment_status' => 'pending',
                    'status' => 0,
                ]);

                $cardData = [
                    'card_holder_name' => $request->card_holder_name,
                    'card_number' => $request->card_number ? str_replace(' ', '', $request->card_number) : null,
                    'expire_month' => $request->expire_month,
                    'expire_year' => $request->expire_year,
                    'cvc' => $request->cvc,
                    'card_token' => $request->card_token,
                    'card_user_key' => $request->card_user_key,
                    'register_card' => $request->register_card,
                    'installment' => $request->installment ?? 1,
                    'paid_price' => $request->paid_price ?? null,
                ];

                $iyzicoService = new IyzicoPaymentService();
                $callbackUrl = url('/api/v1/freelancer/iyzico/3ds-callback-web?order_id=' . $buy_subscription->id . '&type=subscription&register_card=' . ($request->register_card ? 1 : 0));
                
                $threedsResult = $iyzicoService->initialize3DS($buy_subscription, $user, $cardData, $callbackUrl);

                if ($threedsResult->getStatus() === 'success') {
                    return response()->json([
                        'status' => 'success',
                        'msg' => __('3D Secure verification required'),
                        'threeds_html' => $threedsResult->getHtmlContent(),
                        'subscription_details' => $buy_subscription,
                        'requires_3ds' => true,
                    ]);
                }

                $paymentResult = $iyzicoService->processPayment($buy_subscription, $user, $cardData);
                if ($paymentResult->getStatus() === 'success') {
                    self::cancel_old_subscriptions($user->id);
                    $buy_subscription->update([
                        'payment_status' => 'complete',
                        'status' => 1,
                    ]);

                    $this->adminNotification($buy_subscription->id, $user->id);
                    $this->sendEmail($name, $buy_subscription->id, $email);

                    return response()->json([
                        'status' => 'success',
                        'msg' => __('Subscription purchase success.'),
                        'subscription_details' => $buy_subscription,
                        'requires_3ds' => false,
                    ]);
                }

                $buy_subscription->delete();
                return response()->json([
                    'status' => 'error',
                    'msg' => $paymentResult->getErrorMessage() ?? __('Payment failed'),
                ], 422);

            }
            else
            {
                $buy_subscription = UserSubscription::create([
                    'user_id' => $user->id,
                    'subscription_id' => $subscription_details->id,
                    'price' => $total,
                    'limit' => $limit,
                    'expire_date' => $expire_date,
                    'payment_gateway' => $request->selected_payment_gateway,
                    'payment_status' => $payment_status,
                    'status' => $status,
                ]);

                $last_subscription_id = $buy_subscription->id;
                $last_subscription_details = UserSubscription::where('id',$last_subscription_id)->first();

                return response()->json([
                    'subscription_details' => $last_subscription_details,
                    'msg' => __('Subscription purchase success.')
                ]);
            }
        }

        return response()->json([
            'msg' => __('Subscription not found!'),
        ])->setStatusCode(422);

    }

    //payment update
    public function payment_update(Request $request)
    {
        $request->validate([
            'subscription_id' => 'required',
            'status' => 'required'
        ]);

        $user_id = auth('sanctum')->user()->id;
        $subscription_details = UserSubscription::where('id',$request->subscription_id)->where('user_id',$user_id)->first();
        $last_subscription_id = $subscription_details?->id;

        if (!empty($subscription_details) && $subscription_details->payment_status == 'pending' && $request->status == 1) {
            $client = User::select(['id', 'first_name', 'last_name', 'email'])->where('id', $user_id)->first();

            $data_to_hash = $client->email;
            $ctx = hash_init('sha256', HASH_HMAC, 'apiwalletkey');
            hash_update($ctx, $data_to_hash);
            $secret_key = hash_final($ctx);

            if($request->secret_key == $secret_key){

                UserSubscription::where('id', $last_subscription_id)->update([
                    'payment_status' => 'complete',
                    'status' => 1,
                ]);

                AdminNotification::create([
                    'identity'=>$last_subscription_id,
                    'user_id'=>$subscription_details->user_id,
                    'type'=>__('Buy Subscription'),
                    'message'=>__('User subscription purchase'),
                ]);
            }
            else
            {
                return response()->json([
                    'msg' => __('Key does not match')
                ])->setStatusCode(422);
            }
        }
        else
        {
            return response()->json([
                'msg' => __('Wallet history id not found')
            ]);
        }

        return response()->json([
            'status' => __('success'),
            'msg' => __('Deposit Status Updated Successfully')
        ]);
    }


    //send email
    private function sendEmail($name,$last_subscription_id,$email)
    {
        //Send subscription email to admin
        try {
            $message = get_static_option('user_subscription_purchase_admin_email_message') ?? __('A user just purchase a subscription.');
            $message = str_replace(["@name","@subscription_id"],[$name, $last_subscription_id], $message);
            Mail::to(get_static_option('site_global_email'))->queue(new BasicMail([
                'subject' => get_static_option('user_subscription_purchase_admin_email_subject') ?? __('Subscription purchase email'),
                'message' => $message
            ]));
        } catch (\Exception $e) {

        }

        //Send subscription email to user
        try {
            $message = get_static_option('user_subscription_purchase_message') ?? __('Your subscription purchase successfully completed.');
            $message = str_replace(["@name","@subscription_id"],[$name, $last_subscription_id], $message);
            Mail::to($email)->queue(new BasicMail([
                'subject' => get_static_option('user_subscription_purchase_subject') ?? __('Subscription purchase email'),
                'message' => $message
            ]));
        } catch (\Exception $e) {

        }
    }

    // validate In-App Purchase
    public function validate_iap(Request $request)
    {
        $request->validate([
            'subscription_id' => 'required_without:product_id',
            'product_id' => 'required_without:subscription_id',
            'receipt_data' => 'required',
            'store' => 'required|in:apple,google',
            'transaction_id' => 'required',
        ]);

        $user = auth('sanctum')->user();
        $query = Subscription::with('subscription_type:id,validity')
            ->where('status', 1);

        if ($request->subscription_id) {
            $subscription = $query->where('id', $request->subscription_id)->first();
        } else {
            $col = $request->store == 'apple' ? 'apple_product_id' : 'google_product_id';
            $subscription = $query->where($col, $request->product_id)->first();
        }

        if (!$subscription) {
            return response()->json(['msg' => __('Subscription not found')], 422);
        }

        $isValid = false;
        $subscriptionExpiresDate = null; // Will hold Apple-reported expiry for auto-renewable

        if ($request->store == 'apple') {
            $rawReceipt = $request->receipt_data;
            
            // Check if it's a JWS token (StoreKit 2)
            $parts = explode('.', $rawReceipt);
            if (count($parts) === 3) {
                // Decode payload (index 1)
                $payloadJson = base64_decode(str_replace(['-', '_'], ['+', '/'], $parts[1]));
                $payload = json_decode($payloadJson, true);
                
                \Log::info("Apple StoreKit 2 JWS Payload Decoded", [
                    'payload' => $payload
                ]);
                
                $targetProductId = $subscription->apple_product_id ?? $request->product_id;
                
                if (isset($payload['productId']) && $payload['productId'] == $targetProductId) {
                    $isValid = true;
                } elseif (isset($payload['product_id']) && $payload['product_id'] == $targetProductId) {
                    $isValid = true;
                }

                // Extract subscription expiry date from JWS payload (auto-renewable)
                if ($isValid) {
                    if (isset($payload['expiresDate'])) {
                        // expiresDate is in milliseconds since epoch
                        $subscriptionExpiresDate = Carbon::createFromTimestampMs($payload['expiresDate'])->setTimezone(config('app.timezone'));
                    } elseif (isset($payload['expires_date_ms'])) {
                        $subscriptionExpiresDate = Carbon::createFromTimestampMs($payload['expires_date_ms'])->setTimezone(config('app.timezone'));
                    }
                }
            } else {
                // StoreKit 1 Legacy Receipt
                $cleanedReceipt = str_replace(' ', '+', $rawReceipt);
                $cleanedReceipt = preg_replace('/\s+/', '', $cleanedReceipt);
                $appleResponse = $this->verify_apple_receipt($cleanedReceipt);
                \Log::info("Apple IAP Verify Response Status: " . ($appleResponse['status'] ?? 'None'), [
                    'target_product_id' => $subscription->apple_product_id,
                    'input_product_id' => $request->product_id,
                    'apple_response' => $appleResponse
                ]);
                if (isset($appleResponse['status']) && $appleResponse['status'] == 0) {
                    $targetProductId = $subscription->apple_product_id ?? $request->product_id;
                    
                    // Check latest_receipt_info first for auto-renewable subscriptions
                    if (isset($appleResponse['latest_receipt_info'])) {
                        foreach ($appleResponse['latest_receipt_info'] as $item) {
                            if ($item['product_id'] == $targetProductId) {
                                $isValid = true;
                                // Get the expiry date from the subscription info
                                if (isset($item['expires_date_ms'])) {
                                    $subscriptionExpiresDate = Carbon::createFromTimestampMs($item['expires_date_ms'])->setTimezone(config('app.timezone'));
                                }
                                break;
                            }
                        }
                    }
                    
                    // Fallback to in_app array
                    if (!$isValid) {
                        $receiptInfo = $appleResponse['receipt']['in_app'] ?? [];
                        foreach ($receiptInfo as $item) {
                            if ($item['product_id'] == $targetProductId) {
                                $isValid = true;
                                if (isset($item['expires_date_ms'])) {
                                    $subscriptionExpiresDate = Carbon::createFromTimestampMs($item['expires_date_ms'])->setTimezone(config('app.timezone'));
                                }
                                break;
                            }
                        }
                    }
                }
            }
        } else {
            // Google Play Store validation
            \Log::info("Google Play Billing Validation Requested", [
                'user_id' => $user->id,
                'product_id' => $subscription->google_product_id ?? $request->product_id,
                'purchase_token' => $request->receipt_data,
                'transaction_id' => $request->transaction_id
            ]);
            $isValid = true; 
        }

        if ($isValid) {
            // Prevent duplicate transaction processing
            $existingTransaction = UserSubscription::where('transaction_id', $request->transaction_id)->first();
            if ($existingTransaction) {
                return response()->json([
                    'status' => 'success',
                    'msg' => __('This transaction has already been processed'),
                    'subscription_details' => $existingTransaction
                ]);
            }

            // Use Apple-reported expiry date if available, otherwise calculate from validity
            $expire_date = $subscriptionExpiresDate ?? Carbon::now()->addDays($subscription->subscription_type->validity);
            
            // Cancel any old active subscriptions
            self::cancel_old_subscriptions($user->id);

            // Create user subscription record
            $user_sub = UserSubscription::create([
                'user_id' => $user->id,
                'subscription_id' => $subscription->id,
                'price' => $subscription->price,
                'limit' => $subscription->limit,
                'expire_date' => $expire_date,
                'payment_gateway' => $request->store . '_iap',
                'payment_status' => 'complete',
                'transaction_id' => $request->transaction_id,
                'status' => 1,
            ]);

            $this->adminNotification($user_sub->id, $user->id);
            $this->sendEmail($user->first_name . ' ' . $user->last_name, $user_sub->id, $user->email);

            return response()->json([
                'status' => 'success',
                'msg' => __('Subscription purchased successfully'),
                'subscription_details' => $user_sub
            ]);
        }

        return response()->json(['msg' => __('Invalid receipt verification')], 422);
    }

    private function verify_apple_receipt($receiptData)
    {
        $payload = json_encode(['receipt-data' => $receiptData]);
        
        try {
            // Try production first
            $response = $this->send_curl_request('https://buy.itunes.apple.com/verifyReceipt', $payload);
            
            if (isset($response['status']) && $response['status'] == 21007) {
                // Receipt is from sandbox environment, retry with sandbox URL
                $response = $this->send_curl_request('https://sandbox.itunes.apple.com/verifyReceipt', $payload);
            }
            return $response;
        } catch (\Exception $e) {
            \Log::error("verify_apple_receipt Exception: " . $e->getMessage());
            return ['status' => -1, 'exception' => $e->getMessage()];
        }
    }

    private function send_curl_request($url, $payload)
    {
        $ch = curl_init($url);
        if ($ch === false) {
            throw new \Exception("failed to initialize curl on: " . $url);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload)
        ]);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        
        $result = curl_exec($ch);
        if ($result === false) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new \Exception("cURL error: " . $error);
        }
        curl_close($ch);
        
        return json_decode($result, true);
    }

    //admin notification
    private function adminNotification($last_subscription_id,$user_id)
    {
        AdminNotification::create([
            'identity'=>$last_subscription_id,
            'user_id'=>$user_id,
            'type'=>__('Buy Subscription'),
            'message'=>__('User subscription purchase'),
        ]);
    }
}
