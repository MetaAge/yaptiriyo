<?php

namespace App\Http\Controllers\Frontend\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookmarkController extends Controller
{
    public function bookmark(Request $request)
    {
        Log::info('=== FREELANCER BOOKMARK REQUEST ===', [
            'request_data' => $request->all(),
            'user_id' => auth()->user()->id
        ]);

        try {
            // Validate request
            $request->validate([
                'identity' => 'required',
                'type' => 'required|in:project,job'
            ]);

            Log::info('Validation passed');

            // Check if bookmark already exists
            $bookmark_data = Bookmark::where('user_id', auth()->user()->id)
                ->where('is_project_job', $request->type)
                ->where('identity', $request->identity)
                ->first();

            if($bookmark_data){
                Log::info('Bookmark already exists', ['bookmark_id' => $bookmark_data->id]);
                return response()->json([
                    'status' => 'exists',
                    'message' => 'Already bookmarked'
                ]);
            }

            // Create new bookmark
            $bookmark = Bookmark::create([
                'identity' => $request->identity,
                'user_id' => auth()->user()->id,
                'is_project_job' => $request->type,
            ]);

            Log::info('Bookmark created successfully', ['bookmark_id' => $bookmark->id]);

            return response()->json([
                'status' => 'success',
                'message' => 'Bookmark added successfully',
                'bookmark_id' => $bookmark->id
            ]);

        } catch (\Exception $e) {
            Log::error('Bookmark error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add bookmark: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bookmark_remove(Request $request)
    {
        Log::info('=== FREELANCER BOOKMARK REMOVE REQUEST ===', [
            'request_data' => $request->all(),
            'user_id' => auth()->user()->id
        ]);

        try {
            $bookmark = Bookmark::where('id', $request->identity)
                ->where('user_id', auth()->user()->id)
                ->first();

            if($bookmark){
                Log::info('Bookmark found, deleting', ['bookmark_id' => $bookmark->id]);
                $bookmark->delete();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Bookmark removed successfully'
                ]);
            }

            Log::warning('Bookmark not found', ['bookmark_id' => $request->identity]);

            return response()->json([
                'status' => 'error',
                'message' => 'Bookmark not found'
            ], 404);

        } catch (\Exception $e) {
            Log::error('Bookmark remove error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to remove bookmark: ' . $e->getMessage()
            ], 500);
        }
    }

    public function all_bookmarks()
    {
        $all_bookmarks = Bookmark::where('user_id', auth()->user()->id)
            ->with(['bookmark_project', 'bookmark_job'])
            ->latest()
            ->paginate(10);

        return view('frontend.user.freelancer.bookmark.all-bookmarks', compact('all_bookmarks'));
    }
}