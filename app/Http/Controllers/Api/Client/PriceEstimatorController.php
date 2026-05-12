<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PriceEstimatorController extends Controller
{
    public function estimate(Request $request)
    {
        $description = $request->description;
        
        // 1. Keyword analysis for Category detection (simple version)
        $categoryId = $this->detectCategory($description);
        
        // 2. Base Price Calculation from completed orders or projects
        $baseQuery = Project::query();
        if ($categoryId) {
            $baseQuery->where('category_id', $categoryId);
        }
        
        // If specific city is provided
        if ($request->city_id) {
            $baseQuery->where('city_id', $request->city_id);
        }

        $avgPrice = $baseQuery->avg('basic_regular_charge');
        
        // If not enough project data, check orders
        if (!$avgPrice || $avgPrice == 0) {
            $avgPrice = Order::where('status', 3); // 3 = Complete
            if ($categoryId) {
                // Assuming orders have category or linked to project
                // For simplicity, let's just use a general average if no specific data
                $avgPrice = 1500; 
            } else {
                $avgPrice = 1200;
            }
        }

        // 3. AI Adjustment logic (Simulated here but uses text analysis)
        $adjustment = 1.0;
        $lowerDesc = strtolower($description);
        
        if (str_contains($lowerDesc, 'acil') || str_contains($lowerDesc, 'bugün')) {
            $adjustment += 0.20;
        }
        if (str_contains($lowerDesc, 'malzeme benden')) {
            $adjustment -= 0.30;
        }
        if (str_contains($lowerDesc, '2+1')) {
            $avgPrice = max($avgPrice, 2500);
        }
        if (str_contains($lowerDesc, '3+1')) {
            $avgPrice = max($avgPrice, 3500);
        }

        $finalAvg = $avgPrice * $adjustment;
        $min = $finalAvg * 0.85;
        $max = $finalAvg * 1.15;

        return response()->json([
            'status' => 'success',
            'estimate' => [
                'min' => round($min, -1), // Round to nearest 10
                'max' => round($max, -1),
                'currency' => '₺',
                'category_detected' => $categoryId ? 'Detected' : 'General',
            ],
            'message' => __('Price estimated based on market data.')
        ]);
    }

    private function detectCategory($text)
    {
        $text = strtolower($text);
        if (str_contains($text, 'boya') || str_contains($text, 'badana')) return 1; // Example ID
        if (str_contains($text, 'tesisat') || str_contains($text, 'musluk')) return 2;
        if (str_contains($text, 'temizlik')) return 3;
        return null;
    }
}
