<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\PromoteFreelancer\Entities\PromotionProjectList;
use Modules\Service\Entities\Category;

class CategoryProjectController extends Controller
{
    private $current_date;

    public function __construct()
    {
        $this->current_date = \Carbon\Carbon::now()->toDateTimeString();
    }


    public function category_projects($slug)
    {
        $category = Category::select('id', 'category', 'meta_title', 'meta_description')->where('slug', $slug)->first();

        if (!empty($category)) {
            // Get max project price for price range slider
            $maxProjectPrice = Project::where('category_id', $category->id)
                ->where('project_on_off', '1')
                ->where('status', '1')
                ->max('basic_regular_charge') ?? 1000;

            // Use promotion mixing logic
            $request = request();
            $request->merge(['category_id' => $category->id]);
            $projects = $this->getMixedProjects($request, $category->id);

            // Track impressions
            $this->trackProProjectImpressions($projects);

            // Get filter data for sidebar
            $categories = \Modules\Service\Entities\Category::all_categories('project');
            $subcategories = \Modules\Service\Entities\SubCategory::where('category_id', $category->id)
                ->where('status', 1)
                ->get();
            $skills = \App\Models\Skill::where('category_id', $category->id)
                ->where('status', 1)
                ->get();
            $countries = \Modules\CountryManage\Entities\Country::all_countries();
            $states = \Modules\CountryManage\Entities\State::all_states();

            return view('frontend.pages.category-projects.projects', compact(
                'category',
                'projects',
                'categories',
                'subcategories',
                'skills',
                'countries',
                'states',
                'maxProjectPrice'
            ));
        }

        return back();
    }

    public function category_project_filter(Request $request)
    {
        if ($request->ajax()) {
            $categoryId = $request->category_id;
            $projects = $this->getMixedProjects($request, $categoryId);
            $this->trackProProjectImpressions($projects);

            if ($projects->total() >= 1) {
                return response()->json([
                    'html' => view('frontend.pages.category-projects.search-category-result', compact('projects'))->render(),
                    'total' => $projects->total(),
                    'count' => $projects->count(),
                    'max_price' => $request->max_price ?? null
                ]);
            }

            return response()->json(['status' => 'nothing']);
        }
    }

    public function pagination(Request $request)
    {
        if ($request->ajax()) {
            $categoryId = $request->category_id;
            $projects = $this->getMixedProjects($request, $categoryId);
            $this->trackProProjectImpressions($projects);

            if ($projects->total() >= 1) {
                return response()->json([
                    'html' => view('frontend.pages.category-projects.search-category-result', compact('projects'))->render(),
                    'total' => $projects->total(),
                    'count' => $projects->count()
                ]);
            }

            return response()->json(['status' => 'nothing']);
        }
    }

    //reset projects filter
    public function reset(Request $request)
    {
        $categoryId = $request->category_id ?? $request->category;
        $request->merge(['category_id' => $categoryId]);
        $projects = $this->getMixedProjects($request, $categoryId);
        $this->trackProProjectImpressions($projects);

        if ($projects->total() >= 1) {
            return response()->json([
                'html' => view('frontend.pages.category-projects.search-category-result', compact('projects'))->render(),
                'total' => $projects->total(),
                'count' => $projects->count()
            ]);
        }

        return response()->json(['status' => 'nothing']);
    }

    private function getFilteredProjects($request)
    {
        // Always use category_id parameter
        $categoryId = $request->category_id;

        if (empty($categoryId)) {
            // Fallback to category if category_id is not set
            $categoryId = $request->category;
        }

        $query = Project::with(['project_creator' => function($q) {
            $q->withCount('completed_orders');
            $q->withAvg(['freelancer_ratings' => function($sq) {
                $sq->where('sender_type', 1);
            }], 'rating')->withCount(['freelancer_ratings' => function($sq) {
                $sq->where('sender_type', 1);
            }]);
        }, 'project_category'])
            ->select([
                'id',
                'title',
                'slug',
                'user_id',
                'category_id',
                'basic_regular_charge',
                'basic_discount_charge',
                'basic_delivery',
                'description',
                'image',
                'load_from',
                'pro_expire_date',
                'is_pro',
                'created_at'
            ])
            ->withCount(['ratings as ratings_count'])
            ->withAvg('ratings', 'rating')
            ->where('category_id', $categoryId)
            ->where('project_on_off', '1')
            ->where('status', '1')
        ->whereHas('project_creator', function($q) {
        $q->where('check_work_availability', 1); // Only show projects from available freelancers
    });

        // Search by text
        if (filled($request->job_search_string)) {
            $query->where('title', 'LIKE', '%' . strip_tags($request->job_search_string) . '%');
        }

        // Country filter
        if (!empty($request->country)) {
            $query->where(function($q) use ($request) {
                $q->where('country_id', $request->country)
                    ->orWhereHas('project_creator', function ($q2) use ($request) {
                        $q2->where('country_id', $request->country);
                    });
            });
        }

        // Experience level filter
        if (!empty($request->level)) {
            $query->whereHas('project_creator', function ($q) use ($request) {
                $q->where('experience_level', $request->level);
            });
        }

        // Price range filter
        if (!empty($request->min_price) && !empty($request->max_price)) {
            $query->whereBetween('basic_regular_charge', [$request->min_price, $request->max_price]);
        }

        // Delivery day filter
        if (!empty($request->delivery_day)) {
            $query->where('basic_delivery', $request->delivery_day);
        }

        // Rating filter - FIXED: Use average rating for filtering
        if (!empty($request->rating)) {
            $query->having('ratings_avg_rating', '>=', $request->rating);
        }

        // Subcategory filter
        if (!empty($request->subcategory)) {
            $query->whereHas('project_sub_categories', function ($q) use ($request) {
                $q->where('sub_category_id', $request->subcategory);
            });
        }

        // Skills filter
        if (!empty($request->skills)) {
            // Adjust based on your actual relationship
            // If projects have skills through a relationship, add it here
        }

        // State filter
        if (!empty($request->state)) {
            $states = is_array($request->state) ? $request->state : [$request->state];
            $query->where(function($q) use ($states) {
                $q->whereIn('state_id', $states)
                    ->orWhereHas('project_creator', function ($q2) use ($states) {
                        $q2->whereIn('state_id', $states);
                    });
            });
        }

        // City filter
        if (!empty($request->city)) {
            $cities = is_array($request->city) ? $request->city : [$request->city];
            $query->where(function($q) use ($cities) {
                $q->whereIn('city_id', $cities)
                    ->orWhereHas('project_creator.service_areas', function ($q2) use ($cities) {
                        $q2->whereIn('city_id', $cities);
                    });
            });
        }

        // Sort by
        if (!empty($request->sort_by)) {
            switch ($request->sort_by) {
                case 'newest':
                    $query->latest();
                    break;
                case 'oldest':
                    $query->oldest();
                    break;
                case 'price_high':
                    $query->orderBy('basic_regular_charge', 'desc');
                    break;
                case 'price_low':
                    $query->orderBy('basic_regular_charge', 'asc');
                    break;
                default:
                    $query->latest();
            }
        }

        return $query;
    }

    // ==================== PROMOTION LOGIC ====================

    /**
     * Get mixed pro/non-pro projects with promotion logic
     */
    private function getMixedProjects($request, $categoryId)
    {
        $perPage = get_static_option("projects_per_page") ?? 9;
        $proCount = get_static_option("pro_projects_count") ?? 5;
        $nonProCount = get_static_option("non_pro_projects_count") ?? 4;
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
            $projects = $this->getProjectsWithoutPromotion($request, $categoryId, $perPage);
            return $this->applyRatingFallback($projects);
        }

        $baseQuery = $this->getFilteredProjects($request);

        $currentProIds = Project::where('is_pro', 'yes')
            ->where('pro_expire_date', '>=', $this->current_date)
            ->where('category_id', $categoryId)
            ->pluck('id')
            ->toArray();

        $projects = ($proFirst && !empty($currentProIds))
            ? $this->getProProjectsFirstOptimized($baseQuery, $currentProIds, $page, $perPage, $request)
            : $this->getMixedProjectsOptimized($baseQuery, $currentProIds, $page, $perPage, $proCount, $nonProCount, $request);

        return $this->applyRatingFallback($projects);
    }

    private function applyRatingFallback($projects)
    {
        $projects->getCollection()->transform(function ($project) {
            // Fallback to freelancer rating if project has no ratings
            if (($project->ratings_count ?? 0) == 0 && $project->project_creator && ($project->project_creator->freelancer_ratings_count ?? 0) > 0) {
                $project->average_rating = (float) $project->project_creator->freelancer_ratings_avg_rating;
                $project->ratings_count = (int) $project->project_creator->freelancer_ratings_count;
            }
            return $project;
        });
        return $projects;
    }

    /**
     * Projects without promotion module
     */
    private function getProjectsWithoutPromotion($request, $categoryId, $perPage)
    {
        $query = $this->getFilteredProjects($request);
        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }

    /**
     * Pro projects first
     */
    private function getProProjectsFirstOptimized($baseQuery, $proIds, $page, $perPage, $request)
    {
        $sortBy = $request->get('sort_by', '');
        $isPriceSort = in_array($sortBy, ['price_low', 'price_high']);

        $totalPro = (clone $baseQuery)->whereIn('id', $proIds)->count();
        $totalNonPro = (clone $baseQuery)->whereNotIn('id', $proIds)->count();
        $totalItems = $totalPro + $totalNonPro;

        if ($totalItems == 0) {
            return new \Illuminate\Pagination\LengthAwarePaginator(
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
            $proQuery = (clone $baseQuery)->whereIn('id', $proIds);

            if ($isPriceSort) {
                $proProjects = $proQuery
                    ->offset($offset)
                    ->limit($proTake)
                    ->get();
            } else {
                $proProjects = $proQuery
                    ->orderByRaw('RAND(' . $this->getConsistentSeed($request) . ')')
                    ->offset($offset)
                    ->limit($proTake)
                    ->get();
            }

            $result = $result->concat($proProjects);
        }

        if ($result->count() < $perPage && $offset + $result->count() >= $totalPro) {
            $nonProOffset = max(0, $offset - $totalPro);
            $nonProTake = $perPage - $result->count();

            $nonProProjects = (clone $baseQuery)
                ->whereNotIn('id', $proIds)
                ->offset($nonProOffset)
                ->limit($nonProTake)
                ->get();

            $result = $result->concat($nonProProjects);
        }

        // Apply final sorting if needed
        if ($isPriceSort) {
            $sortedResult = $result->sortBy(function ($project) use ($sortBy) {
                $price = $project->basic_discount_charge > 0
                    ? $project->basic_discount_charge
                    : $project->basic_regular_charge;
                return $price;
            });

            if ($sortBy === 'price_high') {
                $sortedResult = $sortedResult->reverse();
            }

            $result = $sortedResult->values();
        } else if ($sortBy === 'newest') {
            $result = $result->sortByDesc('created_at')->values();
        } else if ($sortBy === 'oldest') {
            $result = $result->sortBy('created_at')->values();
        }

        return new \Illuminate\Pagination\LengthAwarePaginator(
            $result,
            $totalItems,
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }

    /**
     * Mixed projects with ratio
     */
    private function getMixedProjectsOptimized($baseQuery, $proIds, $page, $perPage, $proCount, $nonProCount, $request)
    {
        $totalPro = (clone $baseQuery)->whereIn('id', $proIds)->count();
        $totalNonPro = (clone $baseQuery)->whereNotIn('id', $proIds)->count();
        $totalItems = $totalPro + $totalNonPro;

        if ($totalItems == 0) {
            return new \Illuminate\Pagination\LengthAwarePaginator(
                collect([]),
                0,
                $perPage,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );
        }

        $sortBy = $request->get('sort_by', '');
        $isPriceSort = in_array($sortBy, ['price_low', 'price_high']);

        $pageData = $this->calculatePageAllocation($page, $perPage, $proCount, $nonProCount, $totalPro, $totalNonPro);

        $result = collect();

        if ($pageData['proTake'] > 0) {
            $proQuery = (clone $baseQuery)->whereIn('id', $proIds);

            if ($isPriceSort) {
                $proProjects = $proQuery
                    ->offset($pageData['proOffset'])
                    ->limit($pageData['proTake'])
                    ->get();
            } else {
                $proProjects = $proQuery
                    ->orderByRaw('RAND(' . $this->getConsistentSeed($request) . ')')
                    ->offset($pageData['proOffset'])
                    ->limit($pageData['proTake'])
                    ->get();
            }

            $result = $result->concat($proProjects);
        }

        if ($pageData['nonProTake'] > 0) {
            $nonProQuery = (clone $baseQuery)->whereNotIn('id', $proIds);

            $nonProProjects = $nonProQuery
                ->offset($pageData['nonProOffset'])
                ->limit($pageData['nonProTake'])
                ->get();

            $result = $result->concat($nonProProjects);
        }

        // Apply final sorting
        if ($isPriceSort || $sortBy === 'newest' || $sortBy === 'oldest') {
            $allProjects = (clone $baseQuery)->get();

            if ($isPriceSort) {
                $sorted = $allProjects->sortBy(function ($project) {
                    $price = $project->basic_discount_charge > 0
                        ? $project->basic_discount_charge
                        : $project->basic_regular_charge;
                    return $price;
                });

                if ($sortBy === 'price_high') {
                    $sorted = $sorted->reverse();
                }

                $allProjects = $sorted->values();
            } else if ($sortBy === 'newest') {
                $allProjects = $allProjects->sortByDesc('created_at')->values();
            } else if ($sortBy === 'oldest') {
                $allProjects = $allProjects->sortBy('created_at')->values();
            }

            $offset = ($page - 1) * $perPage;
            $mixed = $allProjects->slice($offset, $perPage)->values();
        } else {
            $mixed = $this->interleaveResults($result, $proIds, $proCount, $nonProCount);

            if ($mixed->count() < $perPage) {
                $missingCount = $perPage - $mixed->count();
                $alreadyHaveIds = $mixed->pluck('id')->toArray();

                if ($missingCount > 0) {
                    $extraQuery = (clone $baseQuery)
                        ->whereNotIn('id', $alreadyHaveIds)
                        ->whereNotIn('id', $proIds)
                        ->orderBy('created_at', 'desc')
                        ->limit($missingCount);

                    $extraProjects = $extraQuery->get();
                    $mixed = $mixed->concat($extraProjects);
                }
            }

            $mixed = $mixed->take($perPage);
        }

        return new \Illuminate\Pagination\LengthAwarePaginator(
            $mixed,
            $totalItems,
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }

    /**
     * Calculate page allocation for mixed results
     */
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

    /**
     * Interleave results with scattered distribution
     */
    private function interleaveResults($allResults, $proIds, $proCount, $nonProCount)
    {
        $proResults = $allResults->whereIn('id', $proIds)->values();
        $nonProResults = $allResults->whereNotIn('id', $proIds)->values();

        $totalPro = $proResults->count();
        $totalNonPro = $nonProResults->count();

        if ($totalPro == 0 || $totalNonPro == 0) {
            return $allResults->values();
        }

        $mixed = $this->simplePromotionMix($proResults, $nonProResults);

        return $mixed->unique('id')->values();
    }

    /**
     * Simple promotion mix
     */
    private function simplePromotionMix($proResults, $nonProResults)
    {
        $proCount = $proResults->count();

        if ($proCount <= 3) {
            return $this->fewPromotedStrategy($proResults, $nonProResults);
        } else {
            return $this->manyPromotedStrategy($proResults, $nonProResults);
        }
    }

    /**
     * Few promoted strategy (1-3 promoted projects)
     */
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
            $promotedPositions = [0, 3];
        } elseif ($proCount == 3) {
            $promotedPositions = [0, 3, 4];
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

    /**
     * Many promoted strategy (4+ promoted projects)
     */
    private function manyPromotedStrategy($proResults, $nonProResults)
    {
        $mixed = collect();
        $proIndex = 0;
        $nonProIndex = 0;
        $totalItems = $proResults->count() + $nonProResults->count();
        $proCount = $proResults->count();

        $promotedPositions = [];

        if ($proCount >= 4) {
            $strategicPositions = [0, 3, 4, 6, 7, 9];
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

    /**
     * Get consistent seed for randomization
     */
    private function getConsistentSeed($request)
    {
        $seedData = [
            $request->job_search_string ?? '',
            $request->country ?? '',
            $request->state ?? '',
            $request->category_id ?? '',
            $request->min_price ?? '',
            $request->max_price ?? '',
            session()->getId(),
            date('H')
        ];

        return crc32(implode('|', $seedData));
    }

    /**
     * Track pro project impressions
     */
    private function trackProProjectImpressions($projects)
    {
        if (!moduleExists('PromoteFreelancer')) return;

        $authId = auth('web')->id();
        $proProjectIds = collect();

        foreach ($projects as $project) {
            if (!empty($project->is_pro_project) && $project->user_id !== $authId) {
                $proProjectIds->push($project->id);
            }
        }

        if ($proProjectIds->isNotEmpty()) {
            \Modules\PromoteFreelancer\Entities\PromotionProjectList::whereIn('identity', $proProjectIds)
                ->where('type', 'project')
                ->where('expire_date', '>=', $this->current_date)
                ->increment('impression');
        }
    }
}
