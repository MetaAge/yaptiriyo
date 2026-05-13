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
        $reels = Reel::with('user:id,first_name,last_name,image,username')
            ->latest()
            ->paginate(10);

        return response()->json([
            'status' => 'success',
            'data' => $reels,
            'video_path' => asset('assets/uploads/reels/'),
            'thumbnail_path' => asset('assets/uploads/reels/thumbnails/'),
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
