<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Story;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\Subscription\Services\PlanGate;

/**
 * Ephemeral freelancer "stories" (24h image/video), gated by the monthly
 * story quota (story_monthly_limit) per subscription plan. Mirrors the reels
 * feature but for short-lived story posts.
 */
class StoryController extends Controller
{
    /** Public feed: active stories grouped by freelancer. */
    public function index()
    {
        $stories = Story::active()
            ->with('user:id,first_name,last_name,image,username,load_from')
            ->latest()
            ->get()
            ->groupBy('user_id')
            ->map(function ($items) {
                $user = $items->first()->user;
                return [
                    'user_id'         => $user?->id,
                    'username'        => $user?->username,
                    'freelancer_name' => trim(($user?->first_name ?? '') . ' ' . ($user?->last_name ?? '')),
                    'freelancer_image' => $user?->image ? asset('assets/uploads/profile/' . $user->image) : null,
                    'stories'         => $items->values(),
                ];
            })
            ->values();

        return response()->json([
            'status'       => 'success',
            'data'         => $stories,
            'media_path'   => asset('assets/uploads/stories'),
        ]);
    }

    /** A single freelancer's active stories. */
    public function userStories($username)
    {
        $user = User::where('username', $username)->firstOrFail();

        $stories = Story::active()->where('user_id', $user->id)->latest()->get();

        return response()->json([
            'status'     => 'success',
            'data'       => $stories,
            'media_path' => asset('assets/uploads/stories'),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'media'      => 'required|file|mimetypes:image/jpeg,image/png,image/webp,video/mp4,video/quicktime|max:20480',
            'caption'    => 'nullable|string|max:300',
        ]);

        // Subscription gate: reject before upload if the monthly story quota is
        // exhausted. Basic = 0, so free users are blocked.
        $userId = auth('sanctum')->user()->id;
        $gate = PlanGate::for($userId);
        if ($gate->remaining('story_monthly_limit') <= 0) {
            return PlanGate::denied(
                'story_monthly_limit',
                __('Aylık Hikaye paylaşım hakkınız doldu. Daha fazlası için paketinizi yükseltin.')
            );
        }

        $file = $request->file('media');
        $mime = $file->getMimeType();
        $mediaType = str_starts_with($mime, 'video') ? 'video' : 'image';

        $mediaName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/uploads/stories'), $mediaName);

        // Count this story against the monthly quota now that the upload succeeded.
        $gate->consume('story_monthly_limit');

        $story = Story::create([
            'user_id'    => $userId,
            'media'      => $mediaName,
            'media_type' => $mediaType,
            'caption'    => $request->caption,
            'expires_at' => now()->addDay(),
        ]);

        return response()->json([
            'status' => 'success',
            'msg'    => __('Hikaye başarıyla paylaşıldı.'),
            'data'   => $story,
        ]);
    }

    public function incrementViews($id)
    {
        $story = Story::findOrFail($id);
        $story->increment('views');

        return response()->json(['status' => 'success', 'views' => $story->views]);
    }

    public function destroy($id)
    {
        $userId = auth('sanctum')->user()->id;
        $story = Story::where('user_id', $userId)->findOrFail($id);

        $path = public_path('assets/uploads/stories/' . $story->media);
        if (file_exists($path)) {
            @unlink($path);
        }

        $story->delete();

        return response()->json(['status' => 'success', 'msg' => __('Hikaye silindi.')]);
    }
}
