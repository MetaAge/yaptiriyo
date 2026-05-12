<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkStoryController extends Controller
{
    public function stories()
    {
        $stories = Order::with(['freelancer:id,first_name,last_name,image,load_from', 'project:id,title,image,load_from', 'rating' => function($q) {
            $q->where('sender_type', 1); // Client's rating to Freelancer
        }])
        ->where('status', 3) // Completed
        ->whereHas('rating', function($q) {
            $q->where('sender_type', 1);
        })
        ->latest()
        ->limit(10)
        ->get();

        $formattedStories = $stories->map(function ($order) {
            $rating = $order->rating->where('sender_type', 1)->first();
            $projectImage = null;
            if ($order->project && !empty($order->project->image)) {
                $images = is_string($order->project->image) ? json_decode($order->project->image) : $order->project->image;
                $projectImage = !empty($images) ? $images[0] : null;
            }

            return [
                'id' => $order->id,
                'title' => $order->project ? $order->project->title : ($order->job ? $order->job->title : __('Custom Order')),
                'image' => $projectImage ? asset('assets/uploads/project/' . $projectImage) : null,
                'freelancer_name' => $order->freelancer->first_name . ' ' . $order->freelancer->last_name,
                'freelancer_image' => $order->freelancer->image ? asset('assets/uploads/profile/' . $order->freelancer->image) : null,
                'rating' => $rating ? $rating->rating : 5,
                'feedback' => $rating ? $rating->review_feedback : '',
                'completed_at' => $order->updated_at->diffForHumans(),
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $formattedStories
        ]);
    }
}
