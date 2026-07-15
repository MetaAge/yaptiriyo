<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Modules\Service\Entities\Category;

/**
 * Customer-facing web page for emergency (SOS) requests. All state actions
 * (create / active / select-offer / cancel / complete) reuse the JSON API
 * controller via web routes; this only renders the page shell.
 */
class EmergencyWebController extends Controller
{
    public function page()
    {
        $categories = Category::select(['id', 'category'])
            ->where('status', 1)
            ->orderBy('category')
            ->get();

        return view('frontend.pages.emergency.emergency', compact('categories'));
    }
}
