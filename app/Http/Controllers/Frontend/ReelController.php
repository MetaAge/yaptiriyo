<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Reel;
use Illuminate\Http\Request;

class ReelController extends Controller
{
    public function view($id)
    {
        $reel = Reel::with('user:id,first_name,last_name,image,username')->findOrFail($id);
        
        return view('frontend.reels.view', compact('reel'));
    }
}
