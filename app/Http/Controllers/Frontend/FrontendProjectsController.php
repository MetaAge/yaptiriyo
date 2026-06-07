<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Service\Entities\Category;
use Modules\Service\Entities\SubCategory;
use Modules\CountryManage\Entities\Country;
use Modules\CountryManage\Entities\State;
use App\Models\Skill;

class FrontendProjectsController extends Controller
{
    private $current_date;

    public function __construct()
    {
        $this->current_date = \Carbon\Carbon::now()->toDateTimeString();
    }

    // All projects
    public function projects(Request $request)
    {
        $categories = Category::all_categories('project');
        $subcategories = SubCategory::all_sub_categories();
        $countries = Country::all_countries();
        $states = State::where('status', 1)->get();
        $skills = Skill::all_skills();

        $projects = $this->getMixedProjects($request);
        $this->trackProProjectImpressions($projects);

        // Get maximum project price from database (use basic_regular_charge)
        $maxProjectPrice = Project::where('status', '1')
            ->where('project_on_off', '1')
            ->where('project_approve_request', 1)
            ->max('basic_regular_charge') ?? 1000; // Default to 1000 if no projects found


        return view('frontend.pages.projects.projects', compact(
            'projects',
            'categories',
            'subcategories',
            'countries',
            'states',
            'skills',
            'maxProjectPrice'
        ));
    }

    // Projects filter
    public function projects_filter(Request $request)
    {
        $projects = $this->getMixedProjects($request);
        $this->trackProProjectImpressions($projects);

        // Always return JSON for AJAX requests (including pagination)
        if ($request->ajax()) {
            // Get max price for current filtered results
            $maxProjectPrice = $this->getFilteredMaxPrice($request);

            $from = ($projects->currentPage() - 1) * $projects->perPage() + 1;
            $to = min($projects->currentPage() * $projects->perPage(), $projects->total());

            return response()->json([
                'html' => view('frontend.pages.projects.search-result', compact('projects'))->render(),
                'total' => $projects->total(),
                'count' => $projects->count(),
                'max_price' => $maxProjectPrice,
                'status' => 'success'
            ]);
        }

        // For non-AJAX requests (direct page load), return full view with all data
        $categories = Category::all_categories('project');
        $subcategories = SubCategory::all_sub_categories();
        $countries = Country::all_countries();
        $states = State::where('status', 1)->get();
        $skills = Skill::all_skills();

        // Get maximum project price from database
        $maxProjectPrice = Project::where('status', '1')
            ->where('project_on_off', '1')
            ->where('project_approve_request', 1)
            ->max('basic_regular_charge') ?? 1000;

        return view('frontend.pages.projects.projects', compact(
            'projects',
            'categories',
            'subcategories',
            'countries',
            'states',
            'skills',
            'maxProjectPrice'
        ));
    }

    // Projects pagination
    public function pagination(Request $request)
    {
        if ($request->ajax()) {
            $projects = $this->getMixedProjects($request);
            $this->trackProProjectImpressions($projects);

            $from = ($projects->currentPage() - 1) * $projects->perPage() + 1;
            $to = min($projects->currentPage() * $projects->perPage(), $projects->total());

            return response()->json([
                'html' => view('frontend.pages.projects.search-result', compact('projects'))->render(),
                'total' => $projects->total(),
                'count' => $projects->count(),
                'status' => 'success'
            ]);
        }
    }

    // Reset projects filter
    public function reset(Request $request)
    {
        $projects = $this->getMixedProjects($request);
        $this->trackProProjectImpressions($projects);

        // Get max price for reset results
        $maxProjectPrice = Project::where('status', '1')
            ->where('project_on_off', '1')
            ->where('project_approve_request', 1)
            ->max('basic_regular_charge') ?? 1000;

        $from = ($projects->currentPage() - 1) * $projects->perPage() + 1;
        $to = min($projects->currentPage() * $projects->perPage(), $projects->total());

        return response()->json([
            'html' => view('frontend.pages.projects.search-result', compact('projects'))->render(),
            'total' => $projects->total(),
            'count' => $projects->count(),
            'max_price' => $maxProjectPrice,
            'status' => 'success'
        ]);
    }

    // Get mixed pro/non-pro projects (OPTIMIZED)
    private function getMixedProjects($request)
    {
        $perPage = get_static_option("projects_per_page") ?? 12;
        $proCount = get_static_option("pro_projects_count") ?? 6;
        $nonProCount = get_static_option("non_pro_projects_count") ?? 6;
        $proFirst = get_static_option("pro_projects_default_first") == 1;
        $page = $request->get('page', 1);
        $hasPromo = moduleExists('PromoteFreelancer');

        // Ensure pro + non-pro counts equal per page
        $totalConfigured = $proCount + $nonProCount;
        if ($totalConfigured !== $perPage) {
            $proCount = (int) round(($proCount / $totalConfigured) * $perPage);
            $nonProCount = $perPage - $proCount;
        }

        if (!$hasPromo) {
            $projects = $this->getProjectsWithoutPromotion($request, $perPage);
            return $this->applyRatingFallback($projects);
        }

        $baseQuery = $this->filter_query($request);

        $currentProIds = Project::where('is_pro', 'yes')
            ->where('pro_expire_date', '>=', $this->current_date)
            ->pluck('id')
            ->toArray();

        $projects = $proFirst && !empty($currentProIds)
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

    // Projects without promotion module
    private function getProjectsWithoutPromotion($request, $perPage)
    {
        $query = $this->filter_query($request);
        return $query->orderBy('orders_count', 'desc')->paginate($perPage);
    }

    // Pro projects first (OPTIMIZED)
    private function getProProjectsFirstOptimized($baseQuery, $proIds, $page, $perPage, $request)
    {
        $sortBy = $request->get('sort_by', '');
        $isPriceSort = in_array($sortBy, ['price_low', 'price_high']);

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
            $proQuery = (clone $baseQuery)->whereIn('id', $proIds);

            if ($isPriceSort) {
                // For price sorting, don't use random
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
            $sortedResult = $result->sortBy(function($project) use ($sortBy) {
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

        return new LengthAwarePaginator(
            $result,
            $totalItems,
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }

    // Mixed projects with ratio (OPTIMIZED)
    private function getMixedProjectsOptimized($baseQuery, $proIds, $page, $perPage, $proCount, $nonProCount, $request)
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

        // Determine if we need price sorting
        $sortBy = $request->get('sort_by', '');
        $isPriceSort = in_array($sortBy, ['price_low', 'price_high']);

        $pageData = $this->calculatePageAllocation($page, $perPage, $proCount, $nonProCount, $totalPro, $totalNonPro);

        $result = collect();

        if ($pageData['proTake'] > 0) {
            $proQuery = (clone $baseQuery)->whereIn('id', $proIds);

            // For price sorting, maintain the order instead of random
            if ($isPriceSort) {
                // Keep the price sorting order for pro projects too
                $proProjects = $proQuery
                    ->offset($pageData['proOffset'])
                    ->limit($pageData['proTake'])
                    ->get();
            } else {
                // Default behavior: random for pro projects
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

        // Apply final sorting based on request sort_by
        // For sorting queries, we need a different approach - fetch ALL matching items first, then paginate
        if ($isPriceSort || $sortBy === 'newest' || $sortBy === 'oldest') {
            // Get ALL projects (both pro and non-pro) with sorting applied
            $allProjects = (clone $baseQuery)->get();

            // Apply sorting to the collection
            if ($isPriceSort) {
                $sorted = $allProjects->sortBy(function($project) {
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

            // Now paginate the sorted collection
            $offset = ($page - 1) * $perPage;
            $mixed = $allProjects->slice($offset, $perPage)->values();

        } else {
            // Default: interleave results for non-sorted queries
            $mixed = $this->interleaveResults($result, $proIds, $proCount, $nonProCount);

            // Don't fill remaining slots - just return what we have for this page
            $mixed = $mixed->take($perPage);
        }

        return new LengthAwarePaginator(
            $mixed,
            $totalItems,
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
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

        $totalPro = $proResults->count();
        $totalNonPro = $nonProResults->count();

        // If no mixing needed, return as-is
        // If no mixing needed, return as-is
        if ($totalPro == 0 || $totalNonPro == 0) {
            return $allResults->values();
        }

        // Use the simple mixing
        $mixed = $this->simplePromotionMix($proResults, $nonProResults);

        return $mixed->unique('id')->values();
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

    private function getConsistentSeed($request)
    {
        $seedData = [
            $request->project_search_string ?? '',
            $request->country ?? '',
            $request->state ?? '',
            $request->category ?? '',
            $request->min_price ?? '',
            $request->max_price ?? '',
            session()->getId(),
            date('H')
        ];

        return crc32(implode('|', $seedData));
    }

    // Track pro project impressions (OPTIMIZED)
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

    // Common query builder
    private function common_query($request)
    {
        return Project::query()->with(['project_creator' => function($q) {
            $q->withCount('completed_orders');
            $q->withAvg(['freelancer_ratings' => function($sq) {
                $sq->where('sender_type', 1);
            }], 'rating')->withCount(['freelancer_ratings' => function($sq) {
                $sq->where('sender_type', 1);
            }]);
        }, 'project_category'])
            ->whereHas('project_creator', function ($q) {
                $q->where('check_work_availability', 1)
                    ->where('user_active_inactive_status', 1);
            })
            ->select(['id', 'title', 'slug', 'user_id', 'category_id', 'basic_regular_charge', 'basic_discount_charge', 'basic_delivery', 'description', 'image', 'pro_expire_date', 'is_pro', 'load_from'])
            ->where('project_on_off', '1')
            ->where('status', '1')
            ->withCount([
                'orders' => function ($query) {
                    $query->where('status', 3)->where('is_project_job', 'project');
                },
                'ratings as ratings_count' => function ($query) {
                    $query->where('is_project_job', 'project')->where('sender_type', 1);
                },
            ])
            ->withAvg([
                'ratings as average_rating' => function ($query) {
                    $query->where('is_project_job', 'project')->where('sender_type', 1);
                },
            ], 'rating');
    }

    // Filter query with all search criteria
    private function filter_query($request)
    {
        $query = $this->common_query($request);

        $query->whereHas('project_creator', function ($q) {
            $q->where('check_work_availability', 1)
                ->where('user_active_inactive_status', 1);
        });

        if (filled($request->project_search_string)) {
            $query->WhereHas('project_creator')->where('title', 'LIKE', '%' . strip_tags($request->project_search_string) . '%');
        }

        if (!empty($request->category)) {
            $query = $query->where('category_id', $request->category);
        }

        if (!empty($request->subcategory)) {
            $query = $query->whereHas('project_sub_categories', function ($q) use ($request) {
                $q->whereIn('sub_categories.id', $request->subcategory);
            });
        }

        if (!empty($request->country)) {
            $query = $query->where(function($q) use ($request) {
                $q->where('country_id', $request->country)
                    ->orWhereHas('project_creator', function ($q2) use ($request) {
                        $q2->where('country_id', $request->country);
                    })
                    ->orWhereHas('service_areas', function($sq) use($request){
                        $sq->where('country_id', $request->country);
                    })
                    ->orDoesntHave('service_areas');
            });
        }

        if (!empty($request->state)) {
            $states = is_array($request->state) ? $request->state : [$request->state];
            $query = $query->where(function($q) use ($states) {
                $q->whereIn('state_id', $states)
                    ->orWhereHas('project_creator', function ($q2) use ($states) {
                        $q2->whereIn('state_id', $states);
                    })
                    ->orWhereHas('service_areas', function($sq) use($states){
                        $sq->whereIn('state_id', $states);
                    })
                    ->orDoesntHave('service_areas');
            });
        }

        if (!empty($request->city)) {
            $cities = is_array($request->city) ? $request->city : [$request->city];
            $query = $query->where(function($q) use ($cities) {
                $q->whereIn('city_id', $cities)
                    ->orWhereHas('project_creator.service_areas', function ($q2) use ($cities) {
                        $q2->whereIn('city_id', $cities);
                    })
                    ->orWhereHas('service_areas', function($sq) use($cities){
                        $sq->whereIn('city_id', $cities);
                    })
                    ->orDoesntHave('service_areas');
            });
        }

        if (!empty($request->neighborhood)) {
            $neighborhoods = is_array($request->neighborhood) ? $request->neighborhood : [$request->neighborhood];
            $query = $query->where(function($q) use ($neighborhoods) {
                $q->whereIn('neighborhood_id', $neighborhoods)
                    ->orWhereHas('service_areas', function($sq) use($neighborhoods){
                        $sq->whereIn('neighborhood_id', $neighborhoods);
                    })
                    ->orDoesntHave('service_areas');
            });
        }

        if (!empty($request->min_price) && !empty($request->max_price)) {
            $query = $query->whereBetween('basic_regular_charge', [$request->min_price, $request->max_price]);
        }

        if (!empty($request->delivery_day)) {
            $query = $query->where('basic_delivery', $request->delivery_day);
        }

        if (!empty($request->rating)) {
            $query->having('average_rating', ">=", $request->rating);
        }

        if (!empty($request->skills)) {
            $skills = is_array($request->skills) ? $request->skills : [$request->skills];
            $skills = array_map('trim', $skills);

            $query = $query->whereHas('project_creator.freelancer_skill', function ($q) use ($skills) {
                foreach ($skills as $index => $skill) {
                    if ($index === 0) {
                        $q->where('skill', 'LIKE', "%{$skill}%");
                    } else {
                        $q->orWhere('skill', 'LIKE', "%{$skill}%");
                    }
                }
            });
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
                    $query->orderBy('basic_regular_charge', 'desc');
                    break;
                case 'price_low':
                    $query->orderBy('basic_regular_charge', 'asc');
                    break;
                default:
                    $query->orderBy('orders_count', 'desc');
            }
        }

        return $query;
    }

    private function getFilteredMaxPrice($request)
    {
        $query = $this->filter_query($request);
        return $query->max('basic_regular_charge') ?? 1000;
    }

    private function applySortingToQuery($query, $sortBy)
    {
        if (!empty($sortBy)) {
            switch ($sortBy) {
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('basic_regular_charge', 'desc');
                    break;
                case 'price_low':
                    $query->orderBy('basic_regular_charge', 'asc');
                    break;
                default:
                    $query->orderBy('orders_count', 'desc');
            }
        }
    }



}