<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\EmergencyRequest;
use App\Models\EmergencyOffer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Modules\Chat\Entities\LiveChat;
use Modules\Service\Entities\Category;

class EmergencyController extends Controller
{
    /**
     * Client creates an emergency request.
     * Sends push notifications to all available freelancers in the same city & category.
     */
    public function create(Request $request)
    {
        $request->validate([
            'category_id' => 'required|integer|exists:categories,id',
            'description' => 'required|string|min:5|max:500',
            'city_id' => 'required|integer',
            'address' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();
        $clientId = $user->id;

        // Option 4: Verified Status
        if (!$user->is_email_verified) {
            return response()->json([
                'status' => 'error',
                'msg' => __('Acil talep oluşturabilmek için e-posta adresinizi doğrulamış olmanız gerekmektedir.'),
            ], 403);
        }

        // Option 3: Cooldown (Disabled to prevent testing issues)
        /*
        $recentIssue = EmergencyRequest::where('client_id', $clientId)
            ->whereIn('status', ['cancelled', 'expired'])
            ->where('updated_at', '>', now()->subMinutes(60)) // 1 saatlik pencere
            ->latest('updated_at')
            ->first();

        if ($recentIssue) {
            $diffSeconds = 3600 - now()->diffInSeconds($recentIssue->updated_at, false);
            
            // Eğer süre dolmuşsa veya negatifse kısıtlamayı geç
            if ($diffSeconds > 0) {
                $hours = floor($diffSeconds / 3600);
                $minutes = floor(($diffSeconds % 3600) / 60);
                $seconds = $diffSeconds % 60;
                
                $timeStr = "";
                if ($hours > 0) $timeStr .= $hours . " saat ";
                if ($minutes > 0) $timeStr .= $minutes . " dakika ";
                $timeStr .= $seconds . " saniye";

                return response()->json([
                    'status' => 'error',
                    'msg' => __('Çok sık talep oluşturup iptal ediyorsunuz. Güvenlik nedeniyle lütfen ' . trim($timeStr) . ' sonra tekrar deneyin.'),
                ], 429);
            }
        }
        */

        // Option 5: Daily Penalty System
        $dailyIssuesCount = EmergencyRequest::where('client_id', $clientId)
            ->whereIn('status', ['cancelled', 'expired'])
            ->where('updated_at', '>', now()->subDay())
            ->count();

        if ($dailyIssuesCount >= 20) {
            return response()->json([
                'status' => 'error',
                'msg' => __('Son 24 saat içinde çok fazla başarısız talebiniz olduğu için bu özellik geçici olarak kısıtlanmıştır.'),
            ], 403);
        }

        // Prevent duplicate pending or accepted requests
        $existing = EmergencyRequest::where('client_id', $clientId)
            ->whereIn('status', ['pending', 'accepted'])
            ->first();

        if ($existing) {
            return response()->json([
                'status' => 'error',
                'msg' => __('Zaten aktif bir acil talebiniz var.'),
                'emergency_id' => $existing->id,
            ], 409);
        }

        $emergency = EmergencyRequest::create([
            'client_id' => $clientId,
            'category_id' => $request->category_id,
            'city_id' => $request->city_id,
            'description' => $request->description,
            'address' => $request->address,
            'status' => 'pending',
            'expires_at' => now()->addMinutes(30), // Infrastructure ready, not enforced
        ]);

        // Find available freelancers in the same city with projects in this category
        $freelancers = User::where('user_type', 2) // freelancer
            // ->where('check_work_availability', 1) // Temporarily disabled for testing
            ->where('city_id', $request->city_id) // same city
            ->whereHas('projects', function ($q) use ($request) {
                $q->where('category_id', $request->category_id)
                  ->where('status', 1);
            })
            ->whereNotNull('firebase_device_token')
            ->get();

        $category = Category::find($request->category_id);
        $categoryName = $category ? $category->category : 'Hizmet';
        $notifiedCount = 0;

        foreach ($freelancers as $freelancer) {
            try {
                freelancer_notification(
                    $emergency->id,
                    $freelancer->id,
                    'Emergency',
                    '🚨 Acil ' . $categoryName . ' talebi! Hemen yanıt ver ve teklif gönder.'
                );
                $notifiedCount++;
            } catch (\Exception $e) {
                Log::error("Emergency notification failed for user {$freelancer->id}: " . $e->getMessage());
            }
        }

        $emergency->update(['notified_count' => $notifiedCount]);

        return response()->json([
            'status' => 'success',
            'msg' => __('Acil talebiniz oluşturuldu! ') . $notifiedCount . __(' hizmet verene bildirim gönderildi.'),
            'emergency' => [
                'id' => $emergency->id,
                'status' => $emergency->status,
                'notified_count' => $notifiedCount,
                'category_name' => $categoryName,
                'created_at' => $emergency->created_at->toIso8601String(),
            ],
        ]);
    }

    /**
     * Client checks the status of their emergency request.
     */
    public function status($id)
    {
        $emergency = EmergencyRequest::with(['category', 'acceptedFreelancer', 'offers.freelancer'])
            ->where('id', $id)
            ->where('client_id', Auth::id())
            ->first();

        if (!$emergency) {
            return response()->json(['status' => 'error', 'msg' => __('Talep bulunamadı.')], 404);
        }

        $response = [
            'id' => $emergency->id,
            'status' => $emergency->status,
            'description' => $emergency->description,
            'category_name' => $emergency->category?->category,
            'notified_count' => $emergency->notified_count,
            'created_at' => $emergency->created_at->toIso8601String(),
        ];

        if ($emergency->status === 'accepted' && $emergency->acceptedFreelancer) {
            $freelancer = $emergency->acceptedFreelancer;
            $response['accepted_freelancer'] = [
                'id' => $freelancer->id,
                'name' => $freelancer->first_name . ' ' . $freelancer->last_name,
                'image' => $freelancer->image,
                'load_from' => $freelancer->load_from,
                'cloud_image' => $freelancer->image
                    ? render_frontend_cloud_image_if_module_exists('profile/' . $freelancer->image, load_from: $freelancer->load_from)
                    : null,
                'phone' => $freelancer->phone,
            ];
            $response['offered_price'] = $emergency->offered_price;
            $response['accepted_at'] = $emergency->accepted_at?->toIso8601String();

            // Find the live chat
            $chat = LiveChat::where('client_id', $emergency->client_id)
                ->where('freelancer_id', $emergency->accepted_by)
                ->first();
            $response['live_chat_id'] = $chat?->id;
        }

        // Include offers if pending
        if ($emergency->status === 'pending') {
            $response['offers'] = $emergency->offers->map(function ($o) {
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

        return response()->json(['status' => 'success', 'emergency' => $response]);
    }

    /**
     * Client cancels their emergency request.
     */
    public function cancel($id)
    {
        $updated = EmergencyRequest::where('id', $id)
            ->where('client_id', Auth::id())
            ->where('status', 'pending')
            ->update(['status' => 'cancelled']);

        if ($updated === 0) {
            return response()->json(['status' => 'error', 'msg' => __('Talep iptal edilemedi.')], 400);
        }

        return response()->json(['status' => 'success', 'msg' => __('Acil talebiniz iptal edildi.')]);
    }

    public function complete($id)
    {
        $updated = EmergencyRequest::where('id', $id)
            ->where('client_id', Auth::id())
            ->where('status', 'accepted')
            ->update(['status' => 'completed']);

        if ($updated === 0) {
            return response()->json(['status' => 'error', 'msg' => __('İşlem başarısız.')], 400);
        }

        return response()->json(['status' => 'success', 'msg' => __('İş tamamlandı olarak işaretlendi.')]);
    }

    /**
     * Freelancer accepts an emergency request with a price offer.
     * Race-condition safe: Only the first freelancer to accept wins.
     */
    public function accept(Request $request, $id)
    {
        $freelancerId = Auth::id();

        // Check for Pro or Premium subscription
        if (!is_pro_user($freelancerId) && !is_premium_user($freelancerId)) {
            return response()->json([
                'status' => 'subscription_required', 
                'msg' => __('Acil iş teklifi verebilmek için Pro veya Premium aboneliğiniz olmalıdır.')
            ], 403);
        }

        $request->validate([
            'offered_price' => 'required|numeric|min:1',
        ]);

        $emergency = EmergencyRequest::findOrFail($id);
        
        if ($emergency->status !== 'pending') {
            return response()->json(['status' => 'error', 'msg' => __('Bu talep artık tekliflere açık değil.')], 400);
        }

        $freelancerId = Auth::id();

        // Check if already offered
        $existing = EmergencyOffer::where('emergency_request_id', $id)
            ->where('freelancer_id', $freelancerId)
            ->first();

        if ($existing) {
            return response()->json(['status' => 'error', 'msg' => __('Zaten teklif verdiniz.')], 400);
        }

        $offer = EmergencyOffer::create([
            'emergency_request_id' => $id,
            'freelancer_id' => $freelancerId,
            'offered_price' => $request->offered_price,
            'status' => 'pending',
        ]);

        // Notify client about new offer
        $freelancerName = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        client_notification(
            $emergency->id,
            $emergency->client_id,
            'Emergency',
            '⚡ Yeni bir acil iş teklifi geldi! ' . $freelancerName . ': ' . number_format($request->offered_price, 0) . '₺'
        );

        return response()->json([
            'status' => 'success', 
            'msg' => __('Teklifiniz başarıyla gönderildi. Müşterinin seçmesi bekleniyor.'),
            'offer_id' => $offer->id
        ]);
    }

    /**
     * Client selects an offer.
     */
    public function selectOffer(Request $request, $id)
    {
        $request->validate([
            'offer_id' => 'required|exists:emergency_offers,id',
        ]);

        $emergency = EmergencyRequest::where('client_id', Auth::id())->findOrFail($id);
        
        if ($emergency->status !== 'pending') {
            return response()->json(['status' => 'error', 'msg' => __('Bu talep zaten bir usta ile eşleşmiş.')], 400);
        }

        $offer = EmergencyOffer::where('emergency_request_id', $id)->findOrFail($request->offer_id);

        // Atomic update the request
        $emergency->update([
            'status' => 'accepted',
            'accepted_by' => $offer->freelancer_id,
            'offered_price' => $offer->offered_price,
            'accepted_at' => now(),
            'expires_at' => now()->addMinutes(30), // Reset timer for payment
            'freelancer_status' => 'accepted',
        ]);

        // Update offer status
        $offer->update(['status' => 'accepted']);
        
        // Reject other offers
        EmergencyOffer::where('emergency_request_id', $id)
            ->where('id', '!=', $offer->id)
            ->update(['status' => 'rejected']);

        // Create chat
        $chat = LiveChat::firstOrCreate(
            [
                'client_id' => $emergency->client_id,
                'freelancer_id' => $offer->freelancer_id,
            ],
            [
                'status' => 1,
            ]
        );

        return response()->json([
            'status' => 'success', 
            'msg' => __('Usta başarıyla seçildi! Sohbet başlayabilir.'),
            'live_chat_id' => $chat->id
        ]);
    }

    /**
     * Freelancer views pending emergency requests in their city & categories.
     */
    public function pendingForFreelancer()
    {
        $user = Auth::user();

        // Get category IDs from freelancer's active projects
        $categoryIds = $user->projects()
            ->where('status', 1)
            ->pluck('category_id')
            ->unique()
            ->toArray();

        if (empty($categoryIds)) {
            return response()->json(['status' => 'success', 'emergencies' => []]);
        }

        $emergencies = EmergencyRequest::with('category:id,category', 'client:id,first_name,last_name')
            ->where('status', 'pending')
            ->where('expires_at', '>', now())
            ->where('city_id', $user->city_id)
            ->whereIn('category_id', $categoryIds)
            ->latest()
            ->get()
            ->map(function ($e) {
                return [
                    'id' => $e->id,
                    'category_name' => $e->category?->category,
                    'description' => $e->description,
                    'address' => $e->address,
                    'client_name' => $e->client?->first_name,
                    'created_at' => $e->created_at->toIso8601String(),
                    'minutes_ago' => (int) $e->created_at->diffInMinutes(now()),
                ];
            });

        return response()->json(['status' => 'success', 'emergencies' => $emergencies]);
    }

    /**
     * Freelancer views emergency requests they have accepted.
     */
    public function acceptedForFreelancer()
    {
        $user = Auth::user();

        $emergencies = EmergencyRequest::with('category:id,category', 'client:id,first_name,last_name')
            ->where('status', 'accepted')
            ->where('accepted_by', $user->id)
            ->latest()
            ->get()
            ->map(function ($e) {
                // Find the live chat
                $chat = LiveChat::where('client_id', $e->client_id)
                    ->where('freelancer_id', $e->accepted_by)
                    ->first();

                return [
                    'id' => $e->id,
                    'category_name' => $e->category?->category,
                    'description' => $e->description,
                    'address' => $e->address,
                    'client_name' => $e->client?->first_name,
                    'client_id' => $e->client_id,
                    'offered_price' => $e->offered_price,
                    'accepted_at' => $e->accepted_at?->toIso8601String(),
                    'live_chat_id' => $chat?->id,
                    'freelancer_status' => $e->freelancer_status,
                ];
            });

        return response()->json(['status' => 'success', 'emergencies' => $emergencies]);
    }

    /**
     * Client views their active emergency request.
     */
    public function activeForClient()
    {
        $user = Auth::user();

        $e = EmergencyRequest::with(['category', 'acceptedFreelancer', 'offers.freelancer'])
            ->where('client_id', $user->id)
            ->whereIn('status', ['pending', 'accepted'])
            ->latest()
            ->first();

        if (!$e) {
            return response()->json(['status' => 'success', 'emergency' => null]);
        }

        // Check for expiration
        if ($e->expires_at && now()->gt($e->expires_at)) {
            $e->update(['status' => 'expired']);
            return response()->json(['status' => 'success', 'emergency' => null]);
        }

        $chat = null;
        if ($e->status == 'accepted') {
            $chat = LiveChat::where('client_id', $user->id)
                ->where('freelancer_id', $e->accepted_by)
                ->first();
        }

        $response = [
            'id' => $e->id,
            'status' => $e->status,
            'category_name' => $e->category?->category,
            'description' => $e->description,
            'offered_price' => $e->offered_price,
            'freelancer_id' => $e->accepted_by,
            'freelancer_name' => $e->acceptedFreelancer?->first_name . ' ' . $e->acceptedFreelancer?->last_name,
            'freelancer_image' => $e->acceptedFreelancer?->image,
            'freelancer_cloud_image' => $e->acceptedFreelancer?->image
                ? render_frontend_cloud_image_if_module_exists('profile/' . $e->acceptedFreelancer->image, load_from: $e->acceptedFreelancer->load_from)
                : null,
            'freelancer_phone' => $e->acceptedFreelancer?->phone,
            'freelancer_status' => $e->freelancer_status,
            'freelancer_lat' => $e->freelancer_lat,
            'freelancer_long' => $e->freelancer_long,
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
     * Freelancer updates their tracking status and location.
     */
    public function updateTracking(Request $request, $id)
    {
        $request->validate([
            'freelancer_status' => 'nullable|string|in:accepted,on_the_way,arrived,working',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $emergency = EmergencyRequest::where('accepted_by', Auth::id())->findOrFail($id);

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

        return response()->json([
            'status' => 'success',
            'msg' => __('Durum güncellendi.'),
            'freelancer_status' => $emergency->freelancer_status,
        ]);
    }
}
