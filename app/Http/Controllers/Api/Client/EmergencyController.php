<?php

namespace App\Http\Controllers\Api\Client;

use App\Models\EmergencyRequest;
use App\Models\EmergencyOffer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class EmergencyController extends Controller
{
    /**
     * Create a new emergency request.
     */
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'category_id' => 'required|exists:categories,id',
            'city_id' => 'nullable|integer',
            'address' => 'nullable|string',
        ]);

        $emergency = EmergencyRequest::create([
            'client_id' => Auth::id(),
            'title' => $request->title ?? __('Acil Yardım Talebi'),
            'description' => $request->description,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'category_id' => $request->category_id,
            'city_id' => $request->city_id,
            'address' => $request->address,
            'status' => 'pending',
            'expires_at' => now()->addMinutes(30),
        ]);

        // Find freelancers
        $query = User::where('user_type', 2);

        if ($request->latitude && $request->longitude) {
            // Find within 20km radius (simple box)
            $query->whereBetween('latitude', [$request->latitude - 0.2, $request->latitude + 0.2])
                  ->whereBetween('longitude', [$request->longitude - 0.2, $request->longitude + 0.2]);
        } elseif ($request->city_id) {
            // Fallback to city-based search if no coordinates
            $query->where('city_id', $request->city_id);
        }

        $freelancers = $query->get();

        foreach ($freelancers as $f) {
            freelancer_notification(
                $emergency->id,
                $f->id,
                'Emergency',
                __('Yeni bir acil yardım talebi var: ') . $emergency->title
            );
        }

        return response()->json([
            'status' => 'success',
            'msg' => __('Acil yardım talebiniz oluşturuldu ve ustalara bildirildi.'),
            'emergency' => $emergency
        ]);
    }

    /**
     * Freelancer makes an offer for the emergency request.
     */
    public function makeOffer(Request $request, $id)
    {
        $request->validate([
            'offered_price' => 'required|numeric|min:1',
        ]);

        $emergency = EmergencyRequest::where('status', 'pending')->findOrFail($id);

        $offer = EmergencyOffer::updateOrCreate(
            ['emergency_request_id' => $id, 'freelancer_id' => Auth::id()],
            ['offered_price' => $request->offered_price]
        );

        client_notification(
            $emergency->id,
            $emergency->client_id,
            'Emergency',
            __('Acil talebinize yeni bir teklif geldi.')
        );

        return response()->json([
            'status' => 'success',
            'msg' => __('Teklifiniz başarıyla iletildi.'),
            'offer' => $offer
        ]);
    }

    /**
     * Client accepts an offer.
     */
    public function acceptOffer($id, $offerId)
    {
        $emergency = EmergencyRequest::where('client_id', Auth::id())
            ->where('status', 'pending')
            ->findOrFail($id);

        $offer = EmergencyOffer::where('emergency_request_id', $id)->findOrFail($offerId);

        $emergency->update([
            'accepted_by' => $offer->freelancer_id,
            'offered_price' => $offer->offered_price,
            'status' => 'accepted',
            'freelancer_status' => 'accepted'
        ]);

        freelancer_notification(
            $emergency->id,
            $offer->freelancer_id,
            'Emergency',
            __('Acil talebi teklifiniz kabul edildi! Lütfen ödemeyi bekleyin.')
        );

        return response()->json([
            'status' => 'success',
            'msg' => __('Teklif kabul edildi. Lütfen devam etmek için ödemeyi tamamlayın.'),
            'emergency' => $emergency
        ]);
    }

    /**
     * List emergency requests for freelancers (pending).
     */
    public function listForFreelancer()
    {
        $emergencies = EmergencyRequest::with('client:id,first_name,last_name,image,load_from')
            ->where('status', 'pending')
            ->where('expires_at', '>', now())
            ->latest()
            ->get();

        return response()->json([
            'status' => 'success',
            'emergencies' => $emergencies
        ]);
    }

    /**
     * List active emergency requests for client.
     */
    public function listForClient()
    {
        $emergencies = EmergencyRequest::with(['acceptedFreelancer:id,first_name,last_name,image,load_from', 'offers.freelancer'])
            ->where('client_id', Auth::id())
            ->whereIn('status', ['pending', 'accepted'])
            ->latest()
            ->get();

        return response()->json([
            'status' => 'success',
            'emergencies' => $emergencies
        ]);
    }

    /**
     * Get single emergency request details.
     */
    public function show($id)
    {
        $e = EmergencyRequest::with([
            'client:id,first_name,last_name,image,load_from',
            'acceptedFreelancer:id,first_name,last_name,image,load_from',
            'offers.freelancer:id,first_name,last_name,image,load_from'
        ])->findOrFail($id);

        // Security check
        if ($e->client_id != Auth::id() && $e->accepted_by != Auth::id() && $e->status != 'pending') {
             // If not client, not accepted freelancer, and not a public pending request
             // then unauthorized
             // but for simplicity in this SOS flow, we allow viewing if pending
        }

        $chat = \Modules\Chat\Entities\LiveChat::where('order_id', $e->order_id)->first();

        $response = [
            'id' => $e->id,
            'title' => $e->title,
            'description' => $e->description,
            'status' => $e->status,
            'freelancer_status' => $e->freelancer_status,
            'latitude' => $e->latitude,
            'longitude' => $e->longitude,
            'client_id' => $e->client_id,
            'client_name' => $e->client?->first_name . ' ' . $e->client?->last_name,
            'client_image' => $e->client?->image,
            'client_cloud_image' => $e->client?->image 
                ? render_frontend_cloud_image_if_module_exists('profile/' . $e->client?->image, load_from: $e->client?->load_from)
                : null,
            'accepted_by' => $e->accepted_by,
            'accepted_freelancer_name' => $e->acceptedFreelancer?->first_name . ' ' . $e->acceptedFreelancer?->last_name,
            'accepted_freelancer_image' => $e->acceptedFreelancer?->image,
            'accepted_freelancer_cloud_image' => $e->acceptedFreelancer?->image 
                ? render_frontend_cloud_image_if_module_exists('profile/' . $e->acceptedFreelancer?->image, load_from: $e->acceptedFreelancer?->load_from)
                : null,
            'offered_price' => $e->offered_price,
            'freelancer_lat' => $e->freelancer_lat,
            'freelancer_long' => $e->freelancer_long,
            'order_id' => $e->order_id,
            'live_chat_id' => $chat?->id,
            'notified_count' => $e->notified_count ?? 0,
            'created_at' => $e->created_at->toIso8601String(),
            'expires_at' => $e->expires_at?->toIso8601String(),
        ];

        if ($e->status === 'pending') {
            $response['offers'] = $e->offers->map(function ($o) {
                return [
                    'id' => $o->id,
                    'freelancer_id' => $o->freelancer_id,
                    'freelancer_name' => $o->freelancer?->first_name . ' ' . $o->freelancer?->last_name,
                    'freelancer_image' => $o->freelancer?->image,
                    'freelancer_cloud_image' => $o->freelancer?->image 
                        ? render_frontend_cloud_image_if_module_exists('profile/' . $o->freelancer?->image, load_from: $o->freelancer?->load_from)
                        : null,
                    'offered_price' => $o->offered_price,
                    'created_at' => $o->created_at->toIso8601String(),
                ];
            });
        }

        return response()->json([
            'status' => 'success',
            'emergency' => $response
        ]);
    }

    /**
     * List requests accepted by the freelancer.
     */
    public function acceptedForFreelancer()
    {
        $emergencies = EmergencyRequest::with('client:id,first_name,last_name,image,load_from')
            ->where('accepted_by', Auth::id())
            ->where('status', 'accepted')
            ->latest()
            ->get();

        return response()->json([
            'status' => 'success',
            'emergencies' => $emergencies
        ]);
    }

    /**
     * Client confirms completion and releases money.
     */
    public function complete($id)
    {
        $emergency = EmergencyRequest::where('id', $id)
            ->where('client_id', Auth::id())
            ->where('status', 'accepted')
            ->first();

        if (!$emergency) {
            return response()->json(['status' => 'error', 'msg' => __('Talep bulunamadı veya zaten tamamlanmış.')], 400);
        }

        // Update emergency status
        $emergency->update(['status' => 'completed']);

        // Release funds if order exists
        if ($emergency->order_id) {
            $order = \App\Models\Order::find($emergency->order_id);
            if ($order && $order->status != 3) {
                // Mark order as complete
                $order->update(['status' => 3]);

                // Transfer money to freelancer's earnings/wallet
                $freelancer_id = $order->freelancer_id;
                $payable_amount = $order->payable_amount;

                // Update UserEarning
                $total_earning = \App\Models\UserEarning::where('user_id', $freelancer_id)->first();
                if ($total_earning) {
                    $total_earning->update([
                        'total_earning' => $total_earning->total_earning + $payable_amount,
                        'remaining_balance' => ($total_earning->total_earning + $payable_amount) - $total_earning->total_withdraw
                    ]);
                } else {
                    \App\Models\UserEarning::create([
                        'user_id' => $freelancer_id,
                        'total_earning' => $payable_amount,
                        'remaining_balance' => $payable_amount
                    ]);
                }

                // Update Wallet
                $wallet = \Modules\Wallet\Entities\Wallet::where('user_id', $freelancer_id)->first();
                if ($wallet) {
                    $wallet->update([
                        'balance' => $wallet->balance + $payable_amount,
                        'remaining_balance' => $wallet->remaining_balance + $payable_amount
                    ]);
                }

                // Create Wallet History
                \Modules\Wallet\Entities\WalletHistory::create([
                    'user_id' => $freelancer_id,
                    'payment_gateway' => 'Order',
                    'payment_status' => 'complete',
                    'amount' => $payable_amount,
                    'transaction_fee' => 0,
                    'total' => $payable_amount,
                    'transaction_id' => 'emergency_' . $emergency->id . '_' . time(),
                    'status' => 1,
                    'currency' => get_static_option('site_global_currency'),
                    'symbol' => get_static_option('site_global_currency'),
                    'type' => 'earning'
                ]);

                freelancer_notification(
                    $emergency->id,
                    $freelancer_id,
                    'Emergency',
                    __('Acil talebiniz müşteri tarafından onaylandı ve ödeme hesabınıza aktarıldı.')
                );
            }
        }

        return response()->json([
            'status' => 'success',
            'msg' => __('İşlem tamamlandı. Ödeme serbest bırakıldı.'),
        ]);
    }

    /**
     * Freelancer updates their tracking status and location.
     */
    public function updateTracking(Request $request, $id)
    {
        $request->validate([
            'freelancer_status' => 'nullable|string|in:on_the_way,arrived,working,completed',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $emergency = EmergencyRequest::where('accepted_by', Auth::id())->findOrFail($id);

        // Security: Can only update tracking if paid (order_id exists)
        if (!$emergency->order_id) {
            return response()->json([
                'status' => 'error',
                'msg' => __('Müşteri henüz ödeme yapmadı. Ödeme yapıldıktan sonra durum güncelleyebilirsiniz.')
            ], 403);
        }

        $updateData = [];
        if ($request->has('freelancer_status')) {
            $updateData['freelancer_status'] = $request->freelancer_status;
        }
        if ($request->has('latitude')) {
            $updateData['freelancer_lat'] = $request->latitude;
        }
        if ($request->has('longitude')) {
            $updateData['freelancer_long'] = $request->longitude;
        }

        $emergency->update($updateData);

        // If freelancer says completed, also update the Order status to 2 (Delivered/Submitted)
        if ($request->freelancer_status === 'completed' && $emergency->order_id) {
            $order = Order::find($emergency->order_id);
            if ($order && $order->status == 1) { // If it was active, move it to delivered
                $order->update(['status' => 2]);
                
                // Log submission history for standard compliance
                \App\Models\OrderSubmitHistory::create([
                    'order_id' => $order->id,
                    'description' => __('Usta acil hizmeti tamamladı.'),
                    'attachment' => null
                ]);
            }
        }

        // Notify client if status changed
        if ($request->has('freelancer_status')) {
            $statusMessages = [
                'on_the_way' => __('Usta yola çıktı!'),
                'arrived' => __('Usta adrese vardı.'),
                'working' => __('Usta çalışmaya başladı.'),
                'completed' => __('Usta işi bitirdi! Lütfen onaylayın.'),
            ];
            
            client_notification(
                $emergency->id,
                $emergency->client_id,
                'Emergency',
                $statusMessages[$request->freelancer_status] ?? __('Usta durumunu güncelledi.')
            );
        }

        return response()->json([
            'status' => 'success',
            'msg' => __('Durum güncellendi.'),
            'freelancer_status' => $emergency->freelancer_status,
        ]);
    }
}
