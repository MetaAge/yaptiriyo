<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Reel;
use Illuminate\Http\Request;

class ReelController extends Controller
{
    public function index()
    {
        $all_reels = Reel::with('user')->latest()->paginate(10);
        return view('backend.pages.reels.index', compact('all_reels'));
    }

    public function destroy($id)
    {
        $reel = Reel::findOrFail($id);

        if (file_exists(public_path('assets/uploads/reels/' . $reel->video))) {
            @unlink(public_path('assets/uploads/reels/' . $reel->video));
        }

        if ($reel->thumbnail && file_exists(public_path('assets/uploads/reels/thumbnails/' . $reel->thumbnail))) {
            @unlink(public_path('assets/uploads/reels/thumbnails/' . $reel->thumbnail));
        }

        $reel->delete();

        return redirect()->back()->with(['msg' => __('Reel deleted successfully'), 'type' => 'success']);
    }
}
