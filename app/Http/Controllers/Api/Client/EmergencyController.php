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

        // Find freelancers by city
        $query = User::where('user_type', 2);
        if ($request->city_id) {
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
            'emergency' => $this->formatEmergency($emergency)
        ]);
    }

    /**
     * Freelancer accepts the emergency request (makes an offer).
     */
    public function accept(Request $request, $id)
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
    public function selectOffer(Request $request, $id)
    {
        $request->validate(['offer_id' => 'required|integer']);
        $offerId = $request->offer_id;

        $emergency = EmergencyRequest::where('client_id', Auth::id())
            ->where('status', 'pending')
            ->findOrFail($id);

        $offer = EmergencyOffer::where('emergency_request_id', $id)->findOrFail($offerId);

        $emergency->update([
            'accepted_by' => $offer->freelancer_id,
            'offered_price' => $offer->offered_price,
            'status' => 'accepted'
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
            'emergency' => $this->formatEmergency($emergency)
        ]);
    }

    /**
     * List emergency requests for freelancers (pending).
     */
    public function pendingForFreelancer()
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
    public function activeForClient()
    {
        $emergency = EmergencyRequest::where('client_id', Auth::id())
            ->whereIn('status', ['pending', 'accepted'])
            ->latest()
            ->first();

        return response()->json([
            'status' => 'success',
            'emergency' => $emergency ? $this->formatEmergency($emergency) : null
        ]);
    }

    /**
     * Get single emergency request details.
     */
    public function status($id)
    {
        $e = EmergencyRequest::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'emergency' => $this->formatEmergency($e)
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

        $emergency->update(['status' => 'completed']);

        if ($emergency->order_id) {
            $order = \App\Models\Order::find($emergency->order_id);
            if ($order && $order->status != 3) {
                $order->update(['status' => 3]);
                $freelancer_id = $order->freelancer_id;
                $payable_amount = $order->payable_amount;

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

                $wallet = \Modules\Wallet\Entities\Wallet::where('user_id', $freelancer_id)->first();
                if ($wallet) {
                    $wallet->update([
                        'balance' => $wallet->balance + $payable_amount,
                        'remaining_balance' => $wallet->remaining_balance + $payable_amount
                    ]);
                }

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
     * Client cancels an emergency request.
     */
    public function cancel($id)
    {
        $emergency = EmergencyRequest::where('client_id', Auth::id())
            ->whereIn('status', ['pending'])
            ->findOrFail($id);

        $emergency->update(['status' => 'cancelled']);
        EmergencyOffer::where('emergency_request_id', $emergency->id)->delete();

        return response()->json([
            'status' => 'success',
            'msg' => __('Talebiniz başarıyla iptal edildi.'),
        ]);
    }

    /**
     * Helper to format emergency request according to app's expectations.
     */
    private function formatEmergency($e)
    {
        $e->load([
            'client:id,first_name,last_name,image,load_from',
            'acceptedFreelancer:id,first_name,last_name,image,load_from,phone',
            'offers.freelancer:id,first_name,last_name,image,load_from',
            'category:id,name'
        ]);

        $chat = \Modules\Chat\Entities\LiveChat::where('order_id', $e->order_id)->first();

        return [
            'id' => $e->id,
            'status' => $e->status,
            'category_name' => $e->category?->name ?? __('Genel'),
            'notified_count' => $e->notified_count ?? 0,
            'created_at' => $e->created_at->toIso8601String(),
            'offered_price' => $e->offered_price,
            'freelancer_id' => $e->accepted_by,
            'freelancer_name' => $e->acceptedFreelancer ? ($e->acceptedFreelancer->first_name . ' ' . $e->acceptedFreelancer->last_name) : null,
            'freelancer_image' => $e->acceptedFreelancer?->image,
            'freelancer_cloud_image' => $e->acceptedFreelancer?->image 
                ? render_frontend_cloud_image_if_module_exists('profile/' . $e->acceptedFreelancer?->image, load_from: $e->acceptedFreelancer?->load_from)
                : null,
            'freelancer_phone' => $e->acceptedFreelancer?->phone,
            'live_chat_id' => $chat?->id,
            'order_id' => $e->order_id,
            'description' => $e->description,
            'latitude' => $e->latitude,
            'longitude' => $e->longitude,
            'address' => $e->address,
            'offers' => $e->offers->map(function ($o) {
                return [
                    'id' => $o->id,
                    'freelancer_id' => $o->freelancer_id,
                    'freelancer_name' => $o->freelancer ? ($o->freelancer->first_name . ' ' . $o->freelancer->last_name) : __('Bilinmeyen Usta'),
                    'freelancer_image' => $o->freelancer?->image,
                    'freelancer_cloud_image' => $o->freelancer?->image 
                        ? render_frontend_cloud_image_if_module_exists('profile/' . $o->freelancer?->image, load_from: $o->freelancer?->load_from)
                        : null,
                    'offered_price' => $o->offered_price,
                    'created_at' => $o->created_at->toIso8601String(),
                ];
            }),
        ];
    }
}
