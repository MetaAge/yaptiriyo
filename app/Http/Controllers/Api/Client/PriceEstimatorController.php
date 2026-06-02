<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use App\Models\Project;
use App\Models\Order;
use Illuminate\Http\Request;
use Modules\CountryManage\Entities\State;
use Modules\Service\Entities\Category;
use Modules\Service\Entities\SubCategory;

class PriceEstimatorController extends Controller
{
    public function estimate(Request $request)
    {
        $description = trim(strip_tags($request->description ?? ''));
        
        // Validation: Minimum meaningful input
        if (mb_strlen($description) < 3) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lütfen en az birkaç kelime ile hizmet detayını açıklayın.',
            ], 422);
        }

        $stateId = $request->state_id;
        $stateName = $stateId ? State::where('id', $stateId)->value('state') : null;
        $usedStateFilterForPricing = !empty($stateId);
        $lowerDesc = mb_strtolower($description, 'UTF-8');

        // ── Step 1: Dynamic Category Detection ──
        $requestCategoryId = $request->category_id ?? $request->category;
        if (!empty($requestCategoryId)) {
            $category = Category::where('status', 1)->where('id', $requestCategoryId)->first();
            $categoryId = $category?->id;
            $categoryName = $category?->category;
            $matchScore = $category ? 100 : 0;
        } else {
            $detectedCategory = $this->detectCategoryFromDB($lowerDesc);
            $categoryId = $detectedCategory['id'];
            $categoryName = $detectedCategory['name'];
            $matchScore = $detectedCategory['score'];
        }

        // ── Step 2: Multi-layer Price Calculation ──

        // Layer 1: Project-based pricing
        $projectQuery = Project::query()->where('status', 1); // Active projects only
        if ($categoryId) {
            $projectQuery->where('category_id', $categoryId);
        }
        if ($stateId) {
            $projectQuery->where('state_id', $stateId);
        }

        $projectPrices = [];
        $projectQuery
            ->where(function ($q) {
                $q->where('basic_regular_charge', '>', 0)
                    ->orWhere('standard_regular_charge', '>', 0)
                    ->orWhere('premium_regular_charge', '>', 0);
            })
            ->select([
                'basic_regular_charge',
                'basic_discount_charge',
                'standard_regular_charge',
                'standard_discount_charge',
                'premium_regular_charge',
                'premium_discount_charge',
            ])
            ->chunk(200, function ($projects) use (&$projectPrices) {
                foreach ($projects as $project) {
                    foreach (['basic', 'standard', 'premium'] as $package) {
                        $regular = (float)($project->{$package . '_regular_charge'} ?? 0);
                        $discount = (float)($project->{$package . '_discount_charge'} ?? 0);
                        $price = $discount > 0 ? $discount : $regular;
                        if ($price > 0) {
                            $projectPrices[] = $price;
                        }
                    }
                }
            });

        // Layer 2: Completed order prices (real market data)
        $orderQuery = Order::query()
            ->where('status', 3)
            ->where('is_project_job', 'project'); // Completed project orders
        if ($categoryId) {
            $orderQuery->whereHas('project', function ($q) use ($categoryId) {
                $q->where('category_id', $categoryId);
            });
        }
        if ($stateId) {
            $orderQuery->whereHas('project', function ($q) use ($stateId) {
                $q->where('state_id', $stateId);
            });
        }

        $orderPrices = $orderQuery
            ->where('price', '>', 0)
            ->pluck('price')
            ->toArray();

        // Layer 3: Client job budgets in the same category.
        $jobQuery = JobPost::query()
            ->where('type', 'fixed')
            ->where('budget', '>', 0)
            ->where('status', 1);
        if ($categoryId) {
            $jobQuery->where('category', $categoryId);
        }
        $jobBudgetPrices = $jobQuery->pluck('budget')->toArray();

        // Merge data sources. Orders are real transactions, so they carry extra weight.
        $allPrices = array_merge($projectPrices, $jobBudgetPrices, $orderPrices, $orderPrices);
        $allPrices = $this->removeOutliers($allPrices);
        $sampleCount = count($projectPrices) + count($jobBudgetPrices) + count($orderPrices);

        // If no data at all for the category, try without category filter
        if (empty($allPrices) && $categoryId) {
            $usedStateFilterForPricing = false;
            $allPrices = Project::query()
                ->where('status', 1)
                ->whereNotNull('basic_regular_charge')
                ->where('basic_regular_charge', '>', 0)
                ->pluck('basic_regular_charge')
                ->toArray();
            $allPrices = $this->removeOutliers($allPrices);
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
                    'recommended' => 0,
                    'detected_scope' => $this->extractScope($lowerDesc),
                    'missing_fields' => $this->missingFields($lowerDesc),
                    'price_drivers' => ['Henüz yeterli piyasa verisi bulunmuyor. Daha fazla hizmet eklendikçe tahminler iyileşecek.'],
                    'insights' => ['Henüz yeterli piyasa verisi bulunmuyor. Daha fazla hizmet eklendikçe tahminler iyileşecek.'],
                    'recommendations' => [],
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
        $priceDrivers = [];

        if (str_contains($lowerDesc, 'acil') || str_contains($lowerDesc, 'bugün') || str_contains($lowerDesc, 'hemen')) {
            $adjustment += 0.20;
            $priceDrivers[] = 'Acil talep algılandı; hızlı teslim fiyatı artırabilir.';
        }
        if (str_contains($lowerDesc, 'malzeme benden') || str_contains($lowerDesc, 'malzeme dahil değil')) {
            $adjustment -= 0.25;
            $priceDrivers[] = 'Malzeme müşteriden olduğu için tahmin işçilik ağırlıklı hesaplandı.';
        }
        if (str_contains($lowerDesc, 'malzeme dahil') || str_contains($lowerDesc, 'malzemeli')) {
            $adjustment += 0.15;
            $priceDrivers[] = 'Malzeme dahil olduğu için toplam bütçe yukarı çekildi.';
        }

        // Room/size detection
        if (preg_match('/(\d)\+(\d)/', $lowerDesc, $matches)) {
            $rooms = (int)$matches[1] + (int)$matches[2];
            $sizeMultiplier = 1.0 + ($rooms - 2) * 0.15; // Each room adds ~15%
            $adjustment *= $sizeMultiplier;
            $priceDrivers[] = "{$matches[0]} alan bilgisi algılandı; kapsam büyüklüğüne göre ayarlandı.";
        }
        if (str_contains($lowerDesc, 'villa') || str_contains($lowerDesc, 'müstakil')) {
            $adjustment *= 1.4;
            $priceDrivers[] = 'Villa/müstakil ev ifadesi büyük alan etkisi olarak değerlendirildi.';
        }
        if (str_contains($lowerDesc, 'kombi') || str_contains($lowerDesc, 'kalorifer')) {
            $priceDrivers[] = 'Isıtma sistemi işi algılandı.';
        }

        // Apply adjustments
        $adjustedMin = $p25 * $adjustment;
        $adjustedMax = $p75 * $adjustment;
        $adjustedMedian = $median * $adjustment;

        // Round to nearest 10
        $adjustedMin = round($adjustedMin, -1);
        $adjustedMax = round($adjustedMax, -1);
        $adjustedMedian = round($adjustedMedian, -1);
        $recommendedPrice = $adjustedMedian;

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
            $priceDrivers[] = "\"$categoryName\" kategorisinde $sampleCount fiyat verisi analiz edildi.";
        } else {
            $priceDrivers[] = "Genel piyasa verileri üzerinden $sampleCount fiyat verisi analiz edildi.";
        }
        if ($stateName) {
            $priceDrivers[] = $usedStateFilterForPricing
                ? "$stateName il filtresi fiyat ve önerilerde dikkate alındı."
                : "$stateName için yeterli fiyat verisi bulunamadı; fiyat genel piyasa verisiyle hesaplandı.";
        }

        // Fetch up to 3 matching projects (recommendations)
        $recQuery = Project::query()
            ->with(['project_creator' => function($q) {
                $q->withAvg(['freelancer_ratings' => function($sq) {
                    $sq->where('sender_type', 1);
                }], 'rating')->withCount(['freelancer_ratings' => function($sq) {
                    $sq->where('sender_type', 1);
                }]);
            }, 'project_category'])
            ->withCount(['complete_orders', 'ratings'])
            ->withAvg('ratings', 'rating')
            ->whereHas('project_creator')
            ->where('project_on_off', '1')
            ->where('status', '1');

        if ($categoryId) {
            $recQuery->where('category_id', $categoryId);
        } else {
            $recQuery->where(function($q) use ($lowerDesc) {
                $q->where('title', 'LIKE', '%' . $lowerDesc . '%')
                    ->orWhereHas('project_category', function($cq) use ($lowerDesc){
                        $cq->where('category', 'LIKE', '%'.$lowerDesc.'%');
                    });
            });
        }
        if ($stateId) {
            $recQuery->where(function ($q) use ($stateId) {
                $q->where('state_id', $stateId)
                    ->orWhereHas('service_areas', function ($sq) use ($stateId) {
                        $sq->where('state_id', $stateId);
                    });
            });
        }

        $recommendations = $recQuery->limit(3)->get();
        $currentDate = \Carbon\Carbon::now()->toDateTimeString();

        $recommendations->transform(function ($project) use ($currentDate) {
            $project->project_cloud_image = render_frontend_cloud_image_if_module_exists('project/'.$project->first_image, load_from: $project->load_from);
            
            $isProActive = ($project->is_pro == 'yes' && $project->pro_expire_date > $currentDate) 
                || (($project->sub_rank ?? 0) == 2)
                || ($project->is_subscription_promoted == 1 && ($project->sub_rank ?? 0) > 0);
            $project->is_pro = $isProActive ? 'yes' : 'no';
            $project->is_premium = ($project->sub_rank ?? 0) == 2;
            $project->is_pro_active = $isProActive;
            
            if ($project->project_creator) {
                $project->project_creator->freelancer_cloud_image = render_frontend_cloud_image_if_module_exists('profile/'.$project->project_creator->image, load_from: $project->project_creator->load_from);
            }
            
            return $project;
        });

        return response()->json([
            'status' => 'success',
            'estimate' => [
                'min' => (int)$adjustedMin,
                'max' => (int)$adjustedMax,
                'median' => (int)$adjustedMedian,
                'recommended' => (int)$recommendedPrice,
                'currency' => '₺',
                'confidence' => $confidence,
                'sample_count' => $sampleCount,
                'category_name' => $categoryName,
                'detected_scope' => $this->extractScope($lowerDesc),
                'missing_fields' => $this->missingFields($lowerDesc),
                'price_drivers' => array_slice($priceDrivers, 0, 3),
                'insights' => $priceDrivers,
                'recommendations' => $recommendations,
            ],
            'message' => __('Fiyat piyasa verileri analiz edilerek tahmin edildi.')
        ]);
    }

    private function removeOutliers(array $prices): array
    {
        $prices = array_values(array_filter(array_map('floatval', $prices), fn($price) => $price > 0));
        sort($prices);

        $count = count($prices);
        if ($count < 8) {
            return $prices;
        }

        $trim = max(1, (int)floor($count * 0.05));
        return array_slice($prices, $trim, $count - ($trim * 2));
    }

    private function extractScope(string $text): array
    {
        $scope = [];

        if (preg_match('/(\d)\+(\d)/', $text, $matches)) {
            $scope['room_count'] = $matches[0];
        }
        if (preg_match('/(\d+)\s*(m2|m²|metrekare)/u', $text, $matches)) {
            $scope['area_m2'] = (int)$matches[1];
        }
        if (str_contains($text, 'acil') || str_contains($text, 'bugün') || str_contains($text, 'hemen')) {
            $scope['urgency'] = 'urgent';
        }
        if (str_contains($text, 'malzeme dahil') || str_contains($text, 'malzemeli')) {
            $scope['material_included'] = true;
        } elseif (str_contains($text, 'malzeme benden') || str_contains($text, 'malzeme dahil değil')) {
            $scope['material_included'] = false;
        }

        return $scope;
    }

    private function missingFields(string $text): array
    {
        $missing = [];
        $looksLikeHomeService = str_contains($text, 'boya')
            || str_contains($text, 'badana')
            || str_contains($text, 'temizlik')
            || str_contains($text, 'tadilat');

        if ($looksLikeHomeService && !preg_match('/(\d+)\s*(m2|m²|metrekare)/u', $text)) {
            $missing[] = 'Yaklaşık metrekare bilgisi tahmini netleştirir.';
        }
        if ($looksLikeHomeService
            && !str_contains($text, 'malzeme dahil')
            && !str_contains($text, 'malzemeli')
            && !str_contains($text, 'malzeme benden')
            && !str_contains($text, 'malzeme dahil değil')) {
            $missing[] = 'Malzemenin kime ait olduğu belirtilirse bütçe daha doğru olur.';
        }

        return array_slice($missing, 0, 2);
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
