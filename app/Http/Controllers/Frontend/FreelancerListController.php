<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\Service\Entities\Category;
use Modules\CountryManage\Entities\Country;
use Modules\CountryManage\Entities\State;
use App\Models\Skill;
use Illuminate\Pagination\LengthAwarePaginator;

class FreelancerListController extends Controller
{
    private $current_date;

    public function __construct()
    {
        $this->current_date = now()->toDateTimeString();
    }

    // All talents
    public function talents(Request $request)
    {
        $categories = Category::all_categories('talent');
        $countries = Country::all_countries();
        $states = State::where('status', 1)->get();
        $skills = Skill::all_skills();

        $talents = $this->getMixedFreelancers($request);
        $this->trackProFreelancerImpressions($talents);

        return view('frontend.pages.talent.talents', compact('talents', 'categories', 'countries', 'states', 'skills'));
    }

    // Talents filter
    public function talents_filter(Request $request)
    {
        $talents = $this->getMixedFreelancers($request);
        $this->trackProFreelancerImpressions($talents);

        // Always return JSON for AJAX requests (including pagination)
        if ($request->ajax()) {
            // Check if no results found
            if ($talents->total() == 0) {
                return response()->json([
                    'html' => '',
                    'total' => 0,
                    'status' => 'nothing'
                ]);
            }

            return response()->json([
                'html' => view('frontend.pages.talent.search-talent-result', compact('talents'))->render(),
                'total' => $talents->total(),
                'count' => $talents->count(),
                'status' => 'success'
            ]);
        }

        // For non-AJAX requests (direct page load), return full view with all data
        $categories = Category::all_categories('talent');
        $countries = Country::all_countries();
        $states = State::where('status', 1)->get();
        $skills = Skill::all_skills();

        return view('frontend.pages.talent.talents', compact('talents', 'categories', 'countries', 'states', 'skills'));
    }

    // Talents pagination
    public function pagination(Request $request)
    {
        if ($request->ajax()) {
            $talents = $this->getMixedFreelancers($request);
            $this->trackProFreelancerImpressions($talents);

            // Check if no results found
            if ($talents->total() == 0) {
                return response()->json([
                    'html' => '',
                    'total' => 0,
                    'status' => 'nothing'
                ]);
            }

            return response()->json([
                'html' => view('frontend.pages.talent.search-talent-result', compact('talents'))->render(),
                'total' => $talents->total(),
                'count' => $talents->count(),
                'status' => 'success'
            ]);
        }
    }

    // Reset filter
    public function reset(Request $request)
    {
        $talents = $this->getMixedFreelancers($request);

        // Check if no results found
        if ($talents->total() == 0) {
            return response()->json([
                'html' => '',
                'total' => 0,
                'status' => 'nothing'
            ]);
        }

        return response()->json([
            'html' => view('frontend.pages.talent.search-talent-result', compact('talents'))->render(),
            'total' => $talents->total(),
            'count' => $talents->count(),
            'status' => 'success'
        ]);
    }

    // Get mixed pro/non-pro freelancers
    private function getMixedFreelancers($request)
    {
        $perPage = get_static_option("projects_per_page") ?? 12;
        $proCount = get_static_option("pro_projects_count") ?? 6;
        $nonProCount = get_static_option("non_pro_projects_count") ?? 6;
        $proFirst = get_static_option("pro_projects_default_first") == 0;
        $page = $request->get('page', 1);
        $hasPromo = moduleExists('PromoteFreelancer');

        // Ensure pro + non-pro counts equal per page
        $totalConfigured = $proCount + $nonProCount;
        if ($totalConfigured !== $perPage) {
            $proCount = (int) round(($proCount / $totalConfigured) * $perPage);
            $nonProCount = $perPage - $proCount;
        }

        if (!$hasPromo) {
            return $this->getFreelancersWithoutPromotion($request, $perPage);
        }

        $baseQuery = $this->filter_query($request);

        $currentProIds = User::where('is_pro', 'yes')
            ->where('pro_expire_date', '>=', $this->current_date)
            ->pluck('id')
            ->toArray();

        if ($proFirst && !empty($currentProIds)) {
            return $this->getProFreelancersFirstOptimized($baseQuery, $currentProIds, $page, $perPage, $request);
        }

        return $this->getMixedFreelancersOptimized($baseQuery, $currentProIds, $page, $perPage, $proCount, $nonProCount, $request);
    }

    // Freelancers without promotion module
    private function getFreelancersWithoutPromotion($request, $perPage)
    {
        $query = $this->filter_query($request);
        return $query->orderBy('freelancer_orders_count', 'desc')->paginate($perPage);
    }

    // Pro freelancers first
    private function getProFreelancersFirstOptimized($baseQuery, $proIds, $page, $perPage, $request)
    {
        $totalPro = (clone $baseQuery)->whereIn('id', $proIds)->count();
        $totalNonPro = (clone $baseQuery)->whereNotIn('id', $proIds)->count();
        $totalItems = $totalPro + $totalNonPro;

        if ($totalItems == 0) {
            return new LengthAwarePaginator(
                collect([]),
                0,
                $perPage,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );
        }

        $offset = ($page - 1) * $perPage;
        $result = collect();

        if ($offset < $totalPro) {
            $proTake = min($perPage, $totalPro - $offset);
            $proFreelancers = (clone $baseQuery)
                ->whereIn('id', $proIds)
                ->orderByRaw('RAND(' . $this->getConsistentSeed($request) . ')')
                ->offset($offset)
                ->limit($proTake)
                ->get();

            $result = $result->concat($proFreelancers);
        }

        if ($result->count() < $perPage && $offset + $result->count() >= $totalPro) {
            $nonProOffset = max(0, $offset - $totalPro);
            $nonProTake = $perPage - $result->count();

            $nonProFreelancers = (clone $baseQuery)
                ->whereNotIn('id', $proIds)
                ->orderBy('freelancer_orders_count', 'desc')
                ->offset($nonProOffset)
                ->limit($nonProTake)
                ->get();

            $result = $result->concat($nonProFreelancers);
        }


        $result = $result->take($perPage);

        return new LengthAwarePaginator(
            $result,
            $totalItems,
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }


    private function getMixedFreelancersOptimized($baseQuery, $proIds, $page, $perPage, $proCount, $nonProCount, $request)
    {
        $adjustedCounts = $this->adjustCountsForAvailability($baseQuery, $proIds, $perPage, $proCount, $nonProCount);

        $actualProCount = $adjustedCounts['proCount'];
        $actualNonProCount = $adjustedCounts['nonProCount'];
        $totalPro = $adjustedCounts['totalAvailablePro'];
        $totalNonPro = $adjustedCounts['totalAvailableNonPro'];

        $totalItems = $totalPro + $totalNonPro;

        if ($totalItems == 0) {
            return new LengthAwarePaginator(
                collect([]),
                0,
                $perPage,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );
        }

        $pageData = $this->calculatePageAllocation($page, $perPage, $actualProCount, $actualNonProCount, $totalPro, $totalNonPro);

        $result = collect();

        if ($pageData['proTake'] > 0) {
            $proFreelancers = (clone $baseQuery)
                ->whereIn('id', $proIds)
                ->orderByRaw('RAND(' . $this->getConsistentSeed($request) . ')')
                ->offset($pageData['proOffset'])
                ->limit($pageData['proTake'])
                ->get();
            $result = $result->concat($proFreelancers->keyBy('id'));
        }

        if ($pageData['nonProTake'] > 0) {
            $nonProFreelancers = (clone $baseQuery)
                ->whereNotIn('id', $proIds)
                ->orderBy('freelancer_orders_count', 'desc')
                ->offset($pageData['nonProOffset'])
                ->limit($pageData['nonProTake'])
                ->get();
            $result = $result->concat($nonProFreelancers->keyBy('id'));
        }

        $mixed = $this->interleaveResults($result, $proIds, $actualProCount, $actualNonProCount);

          // Don't fill remaining slots - just return what we have for this page
        $mixed = $mixed->take($perPage);
        return new LengthAwarePaginator(
            $mixed,
            $totalItems,
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }

    // Adjust counts for availability
    private function adjustCountsForAvailability($baseQuery, $proIds, $perPage, $proCount, $nonProCount)
    {
        $totalAvailablePro = (clone $baseQuery)->whereIn('id', $proIds)->count();
        $totalAvailableNonPro = (clone $baseQuery)->whereNotIn('id', $proIds)->count();

        $actualProCount = min($proCount, $totalAvailablePro);
        $actualNonProCount = min($nonProCount, $totalAvailableNonPro);

        $totalConfigured = $actualProCount + $actualNonProCount;
        $remainingSlots = $perPage - $totalConfigured;

        if ($remainingSlots > 0) {
            $extraNonPro = min($remainingSlots, $totalAvailableNonPro - $actualNonProCount);
            $actualNonProCount += $extraNonPro;
            $remainingSlots -= $extraNonPro;

            if ($remainingSlots > 0) {
                $extraPro = min($remainingSlots, $totalAvailablePro - $actualProCount);
                $actualProCount += $extraPro;
            }
        }

        return [
            'proCount' => $actualProCount,
            'nonProCount' => $actualNonProCount,
            'totalAvailablePro' => $totalAvailablePro,
            'totalAvailableNonPro' => $totalAvailableNonPro
        ];
    }

    // Calculate page allocation for mixed results
    private function calculatePageAllocation($page, $perPage, $proCount, $nonProCount, $totalPro, $totalNonPro)
    {
        $proUsed = 0;
        $nonProUsed = 0;

        for ($p = 1; $p < $page; $p++) {
            $pagePro = min($proCount, $totalPro - $proUsed);
            $pageNonPro = min($nonProCount, $totalNonPro - $nonProUsed);
            $pageTotal = $pagePro + $pageNonPro;

            if ($pageTotal < $perPage) {
                $remaining = $perPage - $pageTotal;
                $extraNonPro = min($remaining, $totalNonPro - $nonProUsed - $pageNonPro);
                $pageNonPro += $extraNonPro;
                $remaining -= $extraNonPro;

                if ($remaining > 0) {
                    $extraPro = min($remaining, $totalPro - $proUsed - $pagePro);
                    $pagePro += $extraPro;
                }
            }

            $proUsed += $pagePro;
            $nonProUsed += $pageNonPro;
        }

        $currentPagePro = min($proCount, $totalPro - $proUsed);
        $currentPageNonPro = min($nonProCount, $totalNonPro - $nonProUsed);
        $currentPageTotal = $currentPagePro + $currentPageNonPro;

        if ($currentPageTotal < $perPage) {
            $remaining = $perPage - $currentPageTotal;
            $extraNonPro = min($remaining, $totalNonPro - $nonProUsed - $currentPageNonPro);
            $currentPageNonPro += $extraNonPro;
            $remaining -= $extraNonPro;

            if ($remaining > 0) {
                $extraPro = min($remaining, $totalPro - $proUsed - $currentPagePro);
                $currentPagePro += $extraPro;
            }
        }

        return [
            'proOffset' => $proUsed,
            'proTake' => $currentPagePro,
            'nonProOffset' => $nonProUsed,
            'nonProTake' => $currentPageNonPro
        ];
    }

    // Interleave results with scattered distribution
    private function interleaveResults($allResults, $proIds, $proCount, $nonProCount)
    {
        $proResults = $allResults->whereIn('id', $proIds)->values();
        $nonProResults = $allResults->whereNotIn('id', $proIds)->values();

        $totalItems = $proResults->count() + $nonProResults->count();
        if ($totalItems === 0) return collect();

        if ($proResults->count() === 0) return $nonProResults;
        if ($nonProResults->count() === 0) return $proResults;

        return $this->simplePromotionMix($proResults, $nonProResults);
    }

    private function simplePromotionMix($proResults, $nonProResults)
    {
        $proCount = $proResults->count();

        if ($proCount <= 3) {
            return $this->fewPromotedStrategy($proResults, $nonProResults);
        } else {
            return $this->manyPromotedStrategy($proResults, $nonProResults);
        }
    }

    private function fewPromotedStrategy($proResults, $nonProResults)
    {
        $mixed = collect();
        $proIndex = 0;
        $nonProIndex = 0;
        $totalItems = $proResults->count() + $nonProResults->count();
        $proCount = $proResults->count();

        $promotedPositions = [];

        if ($proCount == 1) {
            $promotedPositions = [0];
        } elseif ($proCount == 2) {
            $promotedPositions = [0, 5];
        } elseif ($proCount == 3) {
            $promotedPositions = [0, 2, 6];
        } else {
            $spacing = max(3, intval($totalItems / $proCount));
            for ($i = 0; $i < $proCount; $i++) {
                $pos = $i * $spacing;
                if ($pos < $totalItems) {
                    $promotedPositions[] = $pos;
                }
            }
        }

        for ($i = 0; $i < $totalItems; $i++) {
            if (in_array($i, $promotedPositions) && $proIndex < $proResults->count()) {
                $mixed->push($proResults[$proIndex]);
                $proIndex++;
            } else if ($nonProIndex < $nonProResults->count()) {
                $mixed->push($nonProResults[$nonProIndex]);
                $nonProIndex++;
            } else if ($proIndex < $proResults->count()) {
                $mixed->push($proResults[$proIndex]);
                $proIndex++;
            }
        }

        return $mixed->filter()->values();
    }

    private function manyPromotedStrategy($proResults, $nonProResults)
    {
        $mixed = collect();
        $proIndex = 0;
        $nonProIndex = 0;
        $totalItems = $proResults->count() + $nonProResults->count();
        $proCount = $proResults->count();

        $promotedPositions = [];

        if ($proCount >= 4) {
            $strategicPositions = [0, 2, 5, 7, 9, 11];
            $promotedPositions = array_slice($strategicPositions, 0, min($proCount, count($strategicPositions)));
        } else {
            $spacing = max(2, intval($totalItems / $proCount));
            for ($i = 0; $i < $proCount; $i++) {
                $pos = $i * $spacing;
                if ($pos < $totalItems) {
                    $promotedPositions[] = $pos;
                }
            }
        }

        for ($i = 0; $i < $totalItems; $i++) {
            if (in_array($i, $promotedPositions) && $proIndex < $proResults->count()) {
                $mixed->push($proResults[$proIndex]);
                $proIndex++;
            } else if ($nonProIndex < $nonProResults->count()) {
                $mixed->push($nonProResults[$nonProIndex]);
                $nonProIndex++;
            } else if ($proIndex < $proResults->count()) {
                $mixed->push($proResults[$proIndex]);
                $proIndex++;
            }
        }

        return $mixed->filter()->values();
    }

    // Generate consistent seed for randomization
    private function getConsistentSeed($request)
    {
        $skillValue = '';
        if (!empty($request->skill)) {
            $skillValue = is_array($request->skill)
                ? implode(',', $request->skill)
                : $request->skill;
        }

        $subcategoryValue = '';
        if (!empty($request->subcategory)) {
            $subcategoryValue = is_array($request->subcategory)
                ? implode(',', $request->subcategory)
                : $request->subcategory;
        }

        $seedData = [
            $request->talent_search_string ?? '',
            $request->country ?? '',
            $request->level ?? '',
            $request->category ?? '',
            $request->subcategory ?? '',
            $skillValue,
            $request->talent_badge ?? '',
            session()->getId(),
            date('H')
        ];

        return crc32(implode('|', $seedData));
    }

    // Track pro freelancer impressions
    private function trackProFreelancerImpressions($freelancers)
    {
        if (!moduleExists('PromoteFreelancer')) return;

        $authId = auth('web')->id();
        $proFreelancerIds = collect();

        foreach ($freelancers as $freelancer) {
            if (!empty($freelancer->is_pro_freelancer) && $freelancer->id !== $authId) {
                $proFreelancerIds->push($freelancer->id);
            }
        }

        if ($proFreelancerIds->isNotEmpty()) {
            \Modules\PromoteFreelancer\Entities\PromotionProjectList::whereIn('identity', $proFreelancerIds)
                ->where('type', 'profile')
                ->where('expire_date', '>=', $this->current_date)
                ->increment('impression');
        }
    }

    // Filter query with all search criteria
    // Filter query with all search criteria
    private function filter_query($request)
    {
        $query = User::query()
            ->select([
                'id', 'username', 'first_name', 'last_name', 'image',
                'country_id', 'state_id', 'is_pro', 'pro_expire_date',
                'user_verified_status', 'load_from', 'created_at',
                'hourly_rate', 'experience_level',
                'check_online_status' // ADDED THIS LINE
            ])
            ->with('user_introduction', 'user_country', 'user_state', 'freelancer_skill')
            ->where('user_type', '2')
            ->where('is_email_verified', 1)
            ->where('is_suspend', 0)
            ->where('user_active_inactive_status', 1)
            ->where('check_work_availability', 1)
            ->withCount(['freelancer_orders' => function ($query) {
                $query->where('status', 3);
            }])
            ->withSum(['freelancer_orders' => function ($query) {
                $query->where('status', 3);
            }], 'payable_amount')
            ->withAvg(['freelancer_ratings' => function ($query) {
                $query->where('sender_type', 1);
            }], 'rating')
            ->orderBy('freelancer_orders_count', 'DESC');

        // Search by keywords
        if (filled($request->talent_search_string)) {
            $query->where(function($q) use ($request) {
                $q->where('first_name', 'LIKE', '%' . strip_tags($request->talent_search_string) . '%')
                    ->orWhere('last_name', 'LIKE', '%' . strip_tags($request->talent_search_string) . '%')
                    ->orWhereHas('user_introduction', function($intro) use ($request) {
                        $intro->where('title', 'LIKE', '%' . strip_tags($request->talent_search_string) . '%')
                            ->orWhere('description', 'LIKE', '%' . strip_tags($request->talent_search_string) . '%');
                    });
            });
        }

        // Country filter
        if (!empty($request->country)) {
            $query->where('country_id', $request->country);
        }

        // State filter
        if (!empty($request->state)) {
            $states = is_array($request->state) ? $request->state : [$request->state];
            $query->whereIn('state_id', $states);
        }

        // Experience level filter
        if (!empty($request->level)) {
            $query->where('experience_level', $request->level);
        }

        // Category filter
        if (!empty($request->category)) {
            $query->whereHas('freelancer_category', function ($q) use ($request) {
                $q->where('category_id', $request->category);
            });
        }

        // Subcategory filter
        if (!empty($request->subcategory)) {
            $subcategories = is_array($request->subcategory) ? $request->subcategory : [$request->subcategory];
            $query->whereHas('freelancer_subcategory', function ($q) use ($subcategories) {
                $q->whereIn('sub_category_id', $subcategories);
            });
        }

        // Talent badge filter
        if (!empty($request->talent_badge) && moduleExists('FreelancerLevel')) {
            $rule = \Modules\FreelancerLevel\Entities\FreelancerLevelRules::where('period', $request->talent_badge)->first();

            if ($rule) {
                $minDays = null;
                $maxDays = null;

                if ($request->talent_badge >= 1 && $request->talent_badge < 3) {
                    $minDays = 30;
                    $maxDays = 90;
                } elseif ($request->talent_badge >= 3 && $request->talent_badge < 6) {
                    $minDays = 90;
                    $maxDays = 180;
                } elseif ($request->talent_badge >= 6 && $request->talent_badge < 9) {
                    $minDays = 180;
                    $maxDays = 270;
                } elseif ($request->talent_badge >= 9 && $request->talent_badge < 12) {
                    $minDays = 270;
                    $maxDays = 360;
                } elseif ($request->talent_badge >= 12) {
                    $minDays = 360;
                    $maxDays = null;
                }

                if ($minDays !== null) {
                    $maxDate = now()->subDays($minDays);
                    $minDate = $maxDays ? now()->subDays($maxDays) : null;

                    if ($minDate) {
                        $query = $query
                            ->whereDate('created_at', '>=', $minDate)
                            ->whereDate('created_at', '<=', $maxDate);
                    } else {
                        $query = $query->whereDate('created_at', '<=', $maxDate);
                    }

                    $query = $query->whereExists(function ($subQuery) use ($rule) {
                        $subQuery->select(DB::raw(1))
                            ->from('orders')
                            ->whereColumn('orders.freelancer_id', 'users.id')
                            ->where('orders.status', 3)
                            ->groupBy('orders.freelancer_id')
                            ->havingRaw('COUNT(*) >= ?', [$rule->complete_order])
                            ->havingRaw('SUM(orders.payable_amount) >= ?', [$rule->earning]);
                    });

                    $query = $query->whereExists(function ($subQuery) use ($rule) {
                        $subQuery->select(DB::raw(1))
                            ->from('ratings')
                            ->join('orders', 'orders.id', '=', 'ratings.order_id')
                            ->whereColumn('orders.freelancer_id', 'users.id')
                            ->where('orders.status', 3)
                            ->where('ratings.sender_type', 1)
                            ->groupBy('orders.freelancer_id')
                            ->havingRaw('AVG(ratings.rating) >= ?', [$rule->avg_rating]);
                    });
                }
            }
        }

        // Skills filter
        if (!empty($request->skill)) {
            $skills = is_array($request->skill) ? $request->skill : [$request->skill];
            $skills = array_map('trim', $skills);
            $skills = array_filter($skills); // Remove empty values

            if (!empty($skills)) {
                $query->whereHas('freelancer_skill', function ($q) use ($skills) {
                    $q->where(function($subQuery) use ($skills) {
                        foreach ($skills as $index => $skill) {
                            if ($index === 0) {
                                $subQuery->where('skill', 'LIKE', "%{$skill}%");
                            } else {
                                $subQuery->orWhere('skill', 'LIKE', "%{$skill}%");
                            }
                        }
                    });
                });
            }
        }

        // Rating filter
        if (!empty($request->rating)) {
            $ratingValue = (int) $request->rating;
            $minRating = $ratingValue - 1;
            $maxRating = $ratingValue;

            $query->whereHas('freelancer_ratings', function($ratingQuery) use ($minRating, $maxRating) {
                $ratingQuery->where('sender_type', 1);
            })->whereExists(function($subQuery) use ($minRating, $maxRating) {
                $subQuery->select(DB::raw(1))
                    ->from('ratings')
                    ->join('orders', 'orders.id', '=', 'ratings.order_id')
                    ->whereColumn('orders.freelancer_id', 'users.id')
                    ->where('ratings.sender_type', 1)
                    ->groupBy('orders.freelancer_id')
                    ->havingRaw('AVG(ratings.rating) > ?', [$minRating])
                    ->havingRaw('AVG(ratings.rating) <= ?', [$maxRating]);
            });
        }

        // Price range filter
        if (!empty($request->min_price) && !empty($request->max_price)) {
            $query->whereBetween('hourly_rate', [$request->min_price, $request->max_price]);
        }

        // Sort by
        if (!empty($request->sort_by)) {
            switch ($request->sort_by) {
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('hourly_rate', 'desc');
                    break;
                case 'price_low':
                    $query->orderBy('hourly_rate', 'asc');
                    break;
                default:
                    $query->orderBy('freelancer_orders_count', 'desc');
            }
        }

        return $query;
    }
}