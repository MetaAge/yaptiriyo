<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\EmergencyRequest;
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

        $clientId = Auth::id();

        // Prevent duplicate pending requests
        $existing = EmergencyRequest::where('client_id', $clientId)
            ->where('status', 'pending')
            ->first();

        if ($existing) {
            return response()->json([
                'status' => 'error',
                'msg' => __('Zaten bekleyen bir acil talebiniz var.'),
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
            ->where('check_work_availability', 1) // available for work
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
            ],
        ]);
    }

    /**
     * Client checks the status of their emergency request.
     */
    public function status($id)
    {
        $emergency = EmergencyRequest::with([
            'acceptedFreelancer:id,first_name,last_name,image,load_from',
            'category:id,category',
        ])->where('id', $id)
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
            ];
            $response['offered_price'] = $emergency->offered_price;
            $response['accepted_at'] = $emergency->accepted_at?->toIso8601String();

            // Find the live chat
            $chat = LiveChat::where('client_id', $emergency->client_id)
                ->where('freelancer_id', $emergency->accepted_by)
                ->first();
            $response['live_chat_id'] = $chat?->id;
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

    /**
     * Freelancer accepts an emergency request with a price offer.
     * Race-condition safe: Only the first freelancer to accept wins.
     */
    public function accept(Request $request, $id)
    {
        $request->validate([
            'offered_price' => 'required|numeric|min:1',
        ]);

        $freelancerId = Auth::id();

        // Atomic update — only one freelancer can win
        $updated = EmergencyRequest::where('id', $id)
            ->where('status', 'pending')
            ->update([
                'status' => 'accepted',
                'accepted_by' => $freelancerId,
                'offered_price' => $request->offered_price,
                'accepted_at' => now(),
            ]);

        if ($updated === 0) {
            return response()->json([
                'status' => 'error',
                'msg' => __('Bu talep zaten başka biri tarafından kabul edildi.'),
            ], 409);
        }

        $emergency = EmergencyRequest::with('category:id,category')->find($id);
        $freelancer = User::find($freelancerId);
        $freelancerName = $freelancer->first_name . ' ' . $freelancer->last_name;

        // Notify the client
        client_notification(
            $emergency->id,
            $emergency->client_id,
            'Emergency',
            '✅ Acil talebiniz kabul edildi! ' . $freelancerName . ' ' . number_format($request->offered_price, 0) . '₺ teklif verdi.'
        );

        // Create or find existing chat
        $chat = LiveChat::firstOrCreate(
            [
                'client_id' => $emergency->client_id,
                'freelancer_id' => $freelancerId,
            ],
            [
                'status' => 1,
            ]
        );

        return response()->json([
            'status' => 'success',
            'msg' => __('Talebi kabul ettiniz! Müşteri ile iletişime geçebilirsiniz.'),
            'emergency' => [
                'id' => $emergency->id,
                'client_id' => $emergency->client_id,
                'category_name' => $emergency->category?->category,
                'description' => $emergency->description,
                'address' => $emergency->address,
            ],
            'live_chat_id' => $chat->id,
        ]);
    }

    /**
     * Freelancer views pending emergency requests in their city & categories.
     */
    public function pendingForFreelancer()
    {
        $user = Auth::user();

        // Get category IDs from freelancer's active projects
        $categoryIds = $user->user_projects()
            ->where('status', 1)
            ->pluck('category_id')
            ->unique()
            ->toArray();

        if (empty($categoryIds)) {
            return response()->json(['status' => 'success', 'emergencies' => []]);
        }

        $emergencies = EmergencyRequest::with('category:id,category', 'client:id,first_name,last_name')
            ->where('status', 'pending')
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
                    'minutes_ago' => $e->created_at->diffInMinutes(now()),
                ];
            });

        return response()->json(['status' => 'success', 'emergencies' => $emergencies]);
    }
}
