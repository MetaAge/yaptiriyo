<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Service\Entities\Category;
use Modules\Service\Entities\SubCategory;

class PriceEstimatorController extends Controller
{
    public function estimate(Request $request)
    {
        $description = trim($request->description ?? '');
        
        // Validation: Minimum meaningful input
        if (mb_strlen($description) < 3) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lütfen en az birkaç kelime ile hizmet detayını açıklayın.',
            ], 422);
        }

        $cityId = $request->city_id;
        $lowerDesc = mb_strtolower($description, 'UTF-8');

        // ── Step 1: Dynamic Category Detection ──
        $detectedCategory = $this->detectCategoryFromDB($lowerDesc);
        $categoryId = $detectedCategory['id'];
        $categoryName = $detectedCategory['name'];
        $matchScore = $detectedCategory['score'];

        // ── Step 2: Multi-layer Price Calculation ──

        // Layer 1: Project-based pricing
        $projectQuery = Project::query()->where('status', 1); // Active projects only
        if ($categoryId) {
            $projectQuery->where('category_id', $categoryId);
        }
        if ($cityId) {
            $projectQuery->where('city_id', $cityId);
        }

        $projectPrices = $projectQuery
            ->whereNotNull('basic_regular_charge')
            ->where('basic_regular_charge', '>', 0)
            ->pluck('basic_regular_charge')
            ->toArray();

        // Layer 2: Completed order prices (real market data)
        $orderQuery = Order::query()->where('status', 3); // Completed orders
        if ($categoryId) {
            $orderQuery->whereHas('project', function ($q) use ($categoryId) {
                $q->where('category_id', $categoryId);
            });
        }
        if ($cityId) {
            $orderQuery->whereHas('project', function ($q) use ($cityId) {
                $q->where('city_id', $cityId);
            });
        }

        $orderPrices = $orderQuery
            ->where('price', '>', 0)
            ->pluck('price')
            ->toArray();

        // Merge both data sources (orders weighted more as they're real transactions)
        $allPrices = array_merge($projectPrices, $orderPrices, $orderPrices); // Orders counted twice for weight
        $sampleCount = count($projectPrices) + count($orderPrices);

        // If no data at all for the category, try without category filter
        if (empty($allPrices) && $categoryId) {
            $allPrices = Project::query()
                ->where('status', 1)
                ->whereNotNull('basic_regular_charge')
                ->where('basic_regular_charge', '>', 0)
                ->pluck('basic_regular_charge')
                ->toArray();
            $sampleCount = count($allPrices);
            $categoryName = null; // Reset since we're using general data
            $matchScore = 0;
        }

        // If still no data at all
        if (empty($allPrices)) {
            return response()->json([
                'status' => 'success',
                'estimate' => [
                    'min' => 0,
                    'max' => 0,
                    'median' => 0,
                    'currency' => '₺',
                    'confidence' => 'none',
                    'sample_count' => 0,
                    'category_name' => null,
                    'insights' => ['Henüz yeterli piyasa verisi bulunmuyor. Daha fazla hizmet eklendikçe tahminler iyileşecek.'],
                ],
                'message' => 'Yeterli veri bulunamadı.'
            ]);
        }

        // ── Step 3: Statistical Calculation ──
        sort($allPrices);
        $count = count($allPrices);
        $avg = array_sum($allPrices) / $count;
        $median = $count % 2 === 0
            ? ($allPrices[$count / 2 - 1] + $allPrices[$count / 2]) / 2
            : $allPrices[intdiv($count, 2)];

        // Percentile-based range (25th - 75th)
        $p25 = $allPrices[max(0, intdiv($count, 4))];
        $p75 = $allPrices[min($count - 1, intdiv($count * 3, 4))];

        // ── Step 4: Keyword-based Adjustments ──
        $adjustment = 1.0;
        $insights = [];

        if (str_contains($lowerDesc, 'acil') || str_contains($lowerDesc, 'bugün') || str_contains($lowerDesc, 'hemen')) {
            $adjustment += 0.20;
            $insights[] = 'Acil talep algılandı — fiyatlar ortalama %20 daha yüksek olabilir.';
        }
        if (str_contains($lowerDesc, 'malzeme benden') || str_contains($lowerDesc, 'malzeme dahil değil')) {
            $adjustment -= 0.25;
            $insights[] = 'Malzeme müşteriden — işçilik maliyeti düşürüldü.';
        }
        if (str_contains($lowerDesc, 'malzeme dahil') || str_contains($lowerDesc, 'malzemeli')) {
            $adjustment += 0.15;
            $insights[] = 'Malzeme dahil — toplam maliyet artırıldı.';
        }

        // Room/size detection
        if (preg_match('/(\d)\+(\d)/', $lowerDesc, $matches)) {
            $rooms = (int)$matches[1] + (int)$matches[2];
            $sizeMultiplier = 1.0 + ($rooms - 2) * 0.15; // Each room adds ~15%
            $adjustment *= $sizeMultiplier;
            $insights[] = "{$matches[0]} daire algılandı — alan büyüklüğüne göre ayarlandı.";
        }
        if (str_contains($lowerDesc, 'villa') || str_contains($lowerDesc, 'müstakil')) {
            $adjustment *= 1.4;
            $insights[] = 'Villa/müstakil ev — büyük alan çarpanı uygulandı.';
        }
        if (str_contains($lowerDesc, 'kombi') || str_contains($lowerDesc, 'kalorifer')) {
            $insights[] = 'Isıtma sistemi işi algılandı.';
        }

        // Apply adjustments
        $adjustedMin = $p25 * $adjustment;
        $adjustedMax = $p75 * $adjustment;
        $adjustedMedian = $median * $adjustment;

        // Round to nearest 10
        $adjustedMin = round($adjustedMin, -1);
        $adjustedMax = round($adjustedMax, -1);
        $adjustedMedian = round($adjustedMedian, -1);

        // Ensure min < max
        if ($adjustedMin >= $adjustedMax) {
            $adjustedMax = $adjustedMin * 1.3;
            $adjustedMax = round($adjustedMax, -1);
        }

        // ── Step 5: Confidence Score ──
        $confidence = 'low';
        if ($sampleCount >= 10 && $matchScore > 70) {
            $confidence = 'high';
        } elseif ($sampleCount >= 5 && $matchScore > 40) {
            $confidence = 'medium';
        }

        // Category insight
        if ($categoryName) {
            $insights[] = "\"$categoryName\" kategorisinde $sampleCount aktif hizmet/sipariş verisi analiz edildi.";
        } else {
            $insights[] = "Genel piyasa verileri üzerinden $sampleCount hizmet analiz edildi.";
        }

        return response()->json([
            'status' => 'success',
            'estimate' => [
                'min' => (int)$adjustedMin,
                'max' => (int)$adjustedMax,
                'median' => (int)$adjustedMedian,
                'currency' => '₺',
                'confidence' => $confidence,
                'sample_count' => $sampleCount,
                'category_name' => $categoryName,
                'insights' => $insights,
            ],
            'message' => __('Fiyat piyasa verileri analiz edilerek tahmin edildi.')
        ]);
    }

    /**
     * Dynamically detect category by matching user text against
     * all categories and sub-categories in the database.
     */
    private function detectCategoryFromDB(string $text): array
    {
        $bestMatch = ['id' => null, 'name' => null, 'score' => 0];

        // Fetch all categories
        $categories = Category::where('status', 1)->get(['id', 'category']);

        foreach ($categories as $cat) {
            $catName = mb_strtolower($cat->category, 'UTF-8');
            $score = $this->calculateMatchScore($text, $catName);
            
            if ($score > $bestMatch['score']) {
                $bestMatch = ['id' => $cat->id, 'name' => $cat->category, 'score' => $score];
            }
        }

        // Also check sub-categories for more precise matching
        $subCategories = SubCategory::where('status', 1)->get(['id', 'category_id', 'sub_category']);

        foreach ($subCategories as $sub) {
            $subName = mb_strtolower($sub->sub_category, 'UTF-8');
            $score = $this->calculateMatchScore($text, $subName);
            
            // Sub-category matches get a bonus (more specific = better)
            if ($score > $bestMatch['score']) {
                $parentCat = $categories->firstWhere('id', $sub->category_id);
                $bestMatch = [
                    'id' => $sub->category_id,
                    'name' => $parentCat ? $parentCat->category : $sub->sub_category,
                    'score' => $score,
                ];
            }
        }

        // Only accept if score is meaningful
        if ($bestMatch['score'] < 20) {
            return ['id' => null, 'name' => null, 'score' => 0];
        }

        return $bestMatch;
    }

    /**
     * Calculate a match score between user text and a category name.
     * Uses multiple strategies: exact contain, word match, similarity.
     */
    private function calculateMatchScore(string $text, string $categoryName): int
    {
        $score = 0;

        // Strategy 1: Direct substring match (strongest signal)
        if (str_contains($text, $categoryName)) {
            $score += 80;
        }

        // Strategy 2: Word-by-word matching
        $catWords = explode(' ', $categoryName);
        $textWords = explode(' ', $text);
        
        foreach ($catWords as $catWord) {
            if (mb_strlen($catWord) < 3) continue; // Skip tiny words
            
            foreach ($textWords as $textWord) {
                if (mb_strlen($textWord) < 3) continue;
                
                // Exact word match
                if ($catWord === $textWord) {
                    $score += 60;
                    continue;
                }
                
                // Prefix match (handles Turkish suffixes: boyacı -> boya, tesisatçı -> tesisat)
                $minLen = min(mb_strlen($catWord), mb_strlen($textWord));
                $checkLen = max(3, (int)($minLen * 0.7));
                
                if (mb_substr($catWord, 0, $checkLen) === mb_substr($textWord, 0, $checkLen)) {
                    $score += 40;
                    continue;
                }
                
                // Levenshtein similarity (for typos)
                $lev = levenshtein($catWord, $textWord);
                if ($lev <= 2 && $lev < mb_strlen($catWord) * 0.4) {
                    $score += 30;
                }
            }
        }

        return min($score, 100); // Cap at 100
    }
}
