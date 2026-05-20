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
        $stories = Order::with([
            'freelancer:id,first_name,last_name,image,load_from', 
            'project:id,title,image,load_from', 
            'order_submit_history' => function($q) {
                $q->whereNotNull('attachment');
            },
            'rating' => function($q) {
                $q->where('sender_type', 1); // Client's rating to Freelancer
            }
        ])
        ->where('status', 3) // Completed
        ->whereHas('rating', function($q) {
            $q->where('sender_type', 1);
        })
        ->latest()
        ->limit(10)
        ->get();

        $formattedStories = $stories->map(function ($order) {
            $rating = $order->rating->where('sender_type', 1)->first();
            
            $storyImage = null;
            if ($order->order_submit_history) {
                foreach ($order->order_submit_history as $submit) {
                    if ($submit->attachment) {
                        $ext = strtolower(pathinfo($submit->attachment, PATHINFO_EXTENSION));
                        if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
                            $storyImage = asset('assets/uploads/attachment/order/' . $submit->attachment);
                            break;
                        }
                    }
                }
            }

            return [
                'id' => $order->id,
                'title' => $order->project ? $order->project->title : ($order->job ? $order->job->title : __('Custom Order')),
                'image' => $storyImage,
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
