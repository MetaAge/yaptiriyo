<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Services\Frontend\IyzicoPaymentService;
use App\Http\Services\Frontend\OrderServiceApi;
use App\Mail\OrderMail;
use App\Models\JobProposal;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

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
        $orderId = $request->order_id; // Added as query param when initializing
        $registerCard = $request->register_card ?? 0;

        // Redirect to a dummy endpoint holding the data in query string
        return redirect()->to(url("/api/v1/client/iyzico/3ds-callback-web/result?status={$status}&paymentId={$paymentId}&order_id={$orderId}&register_card={$registerCard}"));
    }
    /**
     * Complete 3DS payment after user verification
     */
    public function handle3dsCallback(Request $request)
    {
        $request->validate([
            'payment_id' => 'required|string',
            'order_id' => 'required|integer|exists:orders,id',
        ]);

        $user = auth('sanctum')->user();
        $order = Order::where('id', $request->order_id)
            ->where('user_id', $user->id)
            ->where('payment_status', 'pending')
            ->first();

        if (!$order) {
            return response()->json([
                'status' => 'error',
                'msg' => __('Order not found or already processed'),
            ], 422);
        }

        $iyzicoService = new IyzicoPaymentService();
        $result = $iyzicoService->complete3DS($request->payment_id);

        if ($result->getStatus() === 'success') {
            // Update order as paid
            $order->update([
                'payment_status' => 'complete',
                'status' => 0,
                'price' => $order->price - $order->transaction_amount,
            ]);

            // Save card user key if requested
            if (isset($request->register_card) && $request->register_card == "1" && !empty($result->getCardUserKey())) {
                $user->update(['iyzico_card_user_key' => $result->getCardUserKey()]);
            }

            $client = User::select(['id', 'first_name', 'last_name', 'email'])->where('id', $order->user_id)->first();
            $freelancer = User::select(['id', 'first_name', 'last_name', 'email'])->where('id', $order->freelancer_id)->first();

            // Update job proposal if order from job
            if ($order->is_project_job == 'job') {
                if (Cache::has('proposal_id_for_order')) {
                    $proposal_id = Cache::get('proposal_id_for_order');
                    JobProposal::where('id', $proposal_id)->update(['is_hired' => 1]);
                    Cache::forget('proposal_id_for_order');
                }
            }

            if ($order->is_project_job == 'emergency') {
                \App\Models\EmergencyRequest::where('id', $order->identity)->update([
                    'order_id' => $order->id,
                    'freelancer_status' => 'on_the_way'
                ]);
            }

            // Notifications
            notificationToAdmin($order->id, $order->user_id, 'Order', __('New order placed'));
            freelancer_notification($order->id, $order->freelancer_id, 'Order', __('You have a new order'));

            // Emails
            try { Mail::to(get_static_option('site_global_email'))->queue(new OrderMail($order->id, 'admin')); } catch (\Exception $e) {}
            try { Mail::to($client->email)->queue(new OrderMail($order->id, 'client')); } catch (\Exception $e) {}
            try { Mail::to($freelancer->email)->queue(new OrderMail($order->id, 'freelancer')); } catch (\Exception $e) {}

            (new OrderServiceApi())->send_order_chat_message($order);

            return response()->json([
                'status' => 'success',
                'msg' => __('Payment completed successfully'),
                'order_id' => $order->id,
                'iyzico_payment_id' => $result->getPaymentId(),
            ]);
        }

        return response()->json([
            'status' => 'error',
            'msg' => $result->getErrorMessage() ?? __('3D Secure verification failed'),
            'error_code' => $result->getErrorCode(),
        ], 422);
    }
}
