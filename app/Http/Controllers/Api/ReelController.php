<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ReelController extends Controller
{
    public function index()
    {
        // Giriş yapmış kullanıcıyı isteğe eklenen token üzerinden manuel olarak algıla
        if ($token = request()->bearerToken()) {
            $accessToken = \Laravel\Sanctum\PersonalAccessToken::findToken($token);
            if ($accessToken) {
                $user = $accessToken->tokenable;
                auth('sanctum')->setUser($user);
            }
        }

        $query = Reel::with('user:id,first_name,last_name,image,username');

        if (request('sort') === 'popular') {
            // Basit bir skorlama: izlenme + (beğeni * 5) + (yorum * 10)
            $query->withCount(['likes', 'comments'])
                  ->orderByRaw('(views + (likes_count * 5) + (comments_count * 10)) DESC');
        } else {
            $query->latest();
        }

        $reels = $query->paginate(10);

        $reels->getCollection()->transform(function ($reel) {
            $reel->append(['is_liked', 'likes_count', 'comments_count']);
            return $reel;
        });

        return response()->json([
            'status' => 'success',
            'data' => $reels,
            'video_path' => asset('assets/uploads/reels/'),
            'thumbnail_path' => asset('assets/uploads/reels/thumbnails/'),
        ]);
    }

    public function toggleLike($id)
    {
        $user_id = auth('sanctum')->id();
        $like = \App\Models\ReelLike::where('reel_id', $id)->where('user_id', $user_id)->first();

        if ($like) {
            $like->delete();
            $status = 'unliked';
        } else {
            \App\Models\ReelLike::create([
                'reel_id' => $id,
                'user_id' => $user_id
            ]);
            $status = 'liked';
        }

        // Bildirim Gönder
        if ($status == 'liked' && $user_id != $reel->user_id) {
            \App\Models\FreelancerNotification::create([
                'freelancer_id' => $reel->user_id,
                'type' => 'reel_like',
                'message' => auth('sanctum')->user()->first_name . ' videonu beğendi.',
            ]);
        }

        return response()->json([
            'status' => 'success',
            'like_status' => $status,
            'likes_count' => Reel::find($id)->likes_count
        ]);
    }

    public function getComments($id)
    {
        $comments = \App\Models\ReelComment::with('user:id,first_name,last_name,image,username')
            ->where('reel_id', $id)
            ->latest()
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $comments
        ]);
    }

    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:1000'
        ]);

        $user_id = auth('sanctum')->id();
        $reel = Reel::findOrFail($id);

        $comment = \App\Models\ReelComment::create([
            'reel_id' => $id,
            'user_id' => $user_id,
            'comment' => $request->comment
        ]);

        // Bildirim Gönder
        if ($user_id != $reel->user_id) {
            \App\Models\FreelancerNotification::create([
                'freelancer_id' => $reel->user_id,
                'type' => 'reel_comment',
                'message' => auth('sanctum')->user()->first_name . ' videona yorum yaptı.',
            ]);
        }

        return response()->json([
            'status' => 'success',
            'data' => $comment->load('user:id,first_name,last_name,image,username')
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'video' => 'required|mimetypes:video/mp4,video/quicktime,video/x-msvideo|max:20480',
            'thumbnail' => 'nullable|image|mimes:jpg,png,jpeg|max:5120',
            'description' => 'nullable|string|max:500',
        ]);

        $videoName = '';
        if ($video = $request->file('video')) {
            $videoName = time() . '-' . uniqid() . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('assets/uploads/reels'), $videoName);
        }

        $thumbnailName = null;
        if ($thumbnail = $request->file('thumbnail')) {
            $thumbnailName = 'thumb-' . time() . '-' . uniqid() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('assets/uploads/reels/thumbnails'), $thumbnailName);
        }

        $reel = Reel::create([
            'user_id' => auth('sanctum')->user()->id,
            'video' => $videoName,
            'thumbnail' => $thumbnailName,
            'description' => $request->description,
        ]);

        return response()->json([
            'status' => 'success',
            'msg' => __('Reel uploaded successfully'),
            'data' => $reel
        ]);
    }

    public function userReels($username)
    {
        $user = \App\Models\User::where('username', $username)->firstOrFail();
        
        $reels = Reel::where('user_id', $user->id)
            ->latest()
            ->paginate(12);

        $reels->getCollection()->transform(function ($reel) {
            $reel->append(['is_liked', 'likes_count', 'comments_count']);
            return $reel;
        });

        return response()->json([
            'status' => 'success',
            'data' => $reels,
            'video_path' => asset('assets/uploads/reels'),
            'thumbnail_path' => asset('assets/uploads/reels/thumbnails'),
        ]);
    }

    public function incrementViews($id)
    {
        $reel = Reel::findOrFail($id);
        $reel->increment('views');
        
        return response()->json([
            'status' => 'success',
            'views' => $reel->views
        ]);
    }

    public function destroy($id)
    {
        $reel = Reel::where('user_id', auth('sanctum')->user()->id)->findOrFail($id);

        if (file_exists(public_path('assets/uploads/reels/' . $reel->video))) {
            @unlink(public_path('assets/uploads/reels/' . $reel->video));
        }

        if ($reel->thumbnail && file_exists(public_path('assets/uploads/reels/thumbnails/' . $reel->thumbnail))) {
            @unlink(public_path('assets/uploads/reels/thumbnails/' . $reel->thumbnail));
        }

        $reel->delete();

        return response()->json([
            'status' => 'success',
            'msg' => __('Reel deleted successfully')
        ]);
    }
}
