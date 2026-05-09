<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Skill;
use App\Models\JobPost;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Service\Entities\Category;
use Modules\CountryManage\Entities\Country;
use Modules\CountryManage\Entities\State;

class SkillJobController extends Controller
{
    public function skill_jobs($slug)
    {
        $parts = explode('-', $slug, 2);
        $id = $parts[0] ?? null;

        if (is_numeric($id)) {
            $skill = Skill::find($id);
            if (!$skill) {
                return redirect()->route('jobs.all');
            }
        } else {
            $skill = Skill::where('skill', $slug)->first();
            if (!$skill) {
                return redirect()->route('jobs.all');
            }
        }

        // Get all categories, countries, skills for sidebar
        $categories = Category::where('status', 1)->get();
        $countries = Country::where('status', 1)->get();
        $allSkills = Skill::where('status', 1)->get();
        $subcategories = \Modules\Service\Entities\SubCategory::where('status', 1)->get();
        $states = State::where('status', 1)->get();

        // Fetch related jobs
        $query = $skill->jobs()
            ->where('on_off', '1')
            ->where('status', '1')
            ->where('job_approve_request', '1')
            ->withCount('job_proposals')
            ->latest();

        // Apply country restrictions
        $query = $this->applyCountryRestrictions($query);

        $jobs = $query->paginate(10);

        return view('frontend.pages.skill-jobs.jobs', compact([
            'jobs',
            'skill',
            'categories',
            'countries',
            'allSkills',
            'subcategories',
            'states'
        ]));
    }

    public function skill_jobs_filter(Request $request)
    {
        if ($request->ajax()) {
            \Log::info('Skill Jobs Filter Request:', $request->all());

            $skill = Skill::select('id', 'skill')->where('id', $request->skill)->first();

            if (!$skill) {
                \Log::error('Skill not found for ID: ' . $request->skill);
                return response()->json(['status' => 'nothing']);
            }

            try {
                $jobs = $skill->jobs()
                    ->where('on_off', '1')
                    ->where('status', '1')
                    ->where('job_approve_request', '1')
                    ->withCount('job_proposals');

                // Apply country restrictions
                $jobs = $this->applyCountryRestrictions($jobs);

                // Apply filters
                $jobs = $this->applyFilters($jobs, $request);

                // Apply sorting
                $jobs = $this->applySorting($jobs, $request->sort_by);

                $jobs = $jobs->paginate(10)->withQueryString();

                \Log::info('Jobs found: ' . $jobs->total());

                if ($jobs->total() >= 1) {
                    return response()->json([
                        'html' => view('frontend.pages.skill-jobs.search-job-result', compact('jobs'))->render(),
                        'total' => $jobs->total(),
                        'count' => $jobs->count(),
                        'status' => 'success'
                    ]);
                } else {
                    return response()->json(['status' => 'nothing']);
                }
            } catch (\Exception $e) {
                \Log::error('Error in skill_jobs_filter: ' . $e->getMessage());
                \Log::error($e->getTraceAsString());
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
            }
        }
    }

    public function pagination(Request $request)
    {
        return $this->skill_jobs_filter($request);
    }

    public function reset(Request $request)
    {
        if ($request->ajax()) {
            $skill = Skill::select('id', 'skill')->where('id', $request->skill)->first();

            if (!$skill) {
                return response()->json(['status' => 'nothing']);
            }

            $query = $skill->jobs()
                ->where('on_off', '1')
                ->where('status', '1')
                ->where('job_approve_request', '1')
                ->withCount('job_proposals')
                ->latest();

            // Apply country restrictions
            $query = $this->applyCountryRestrictions($query);

            $jobs = $query->paginate(10);

            return response()->json([
                'html' => view('frontend.pages.skill-jobs.search-job-result', compact('jobs'))->render(),
                'total' => $jobs->total()
            ]);
        }
    }

    /**
     * Apply filters to job query - SIMPLIFIED AND DEBUGGED
     */
    private function applyFilters($query, $request)
    {
        \Log::info('Applying filters with data:', [
            'skill' => $request->skill,
            'category' => $request->category,
            'subcategory' => $request->subcategory,
            'country' => $request->country,
            'state' => $request->state,
            'type' => $request->type,
            'level' => $request->level,
            'min_price' => $request->min_price,
            'max_price' => $request->max_price,
            'duration' => $request->duration,
            'job_search_string' => $request->job_search_string,
            'date_posted' => $request->date_posted,
            'sort_by' => $request->sort_by,
        ]);

        // Text search
        if (filled($request->job_search_string)) {
            $query->where('title', 'LIKE', '%' . strip_tags($request->job_search_string) . '%');
            \Log::info('Applied text search: ' . $request->job_search_string);
        }

        // Category filter
        if (isset($request->category) && !empty($request->category)) {
            $query->where('category', $request->category);
            \Log::info('Applied category filter: ' . $request->category);
        }

        // Subcategory filter
        if (isset($request->subcategory) && is_array($request->subcategory) && !empty($request->subcategory[0])) {
            $query->whereHas('job_sub_categories', function ($q) use ($request) {
                $q->where('sub_category_id', $request->subcategory[0]);
            });
            \Log::info('Applied subcategory filter: ' . $request->subcategory[0]);
        }

        // Country filter
        if (isset($request->country) && !empty($request->country)) {
            $query->whereHas('job_creator', function ($q) use ($request) {
                $q->where('country_id', $request->country);
            });
            \Log::info('Applied country filter: ' . $request->country);
        }

        // State filter
        if (isset($request->state) && is_array($request->state) && !empty($request->state[0])) {
            $query->whereHas('job_creator', function ($q) use ($request) {
                $q->where('state_id', $request->state[0]);
            });
            \Log::info('Applied state filter: ' . $request->state[0]);
        }

        // Job type filter
        if (isset($request->type) && !empty($request->type)) {
            $query->where('type', $request->type);
            \Log::info('Applied type filter: ' . $request->type);
        }

        // Experience level filter
        if (isset($request->level) && !empty($request->level)) {
            $query->where('level', $request->level);
            \Log::info('Applied level filter: ' . $request->level);
        }

        // Price range filter
        if (isset($request->min_price) && !empty($request->min_price)) {
            $query->where('budget', '>=', $request->min_price);
            \Log::info('Applied min price filter: ' . $request->min_price);
        }

        if (isset($request->max_price) && !empty($request->max_price)) {
            $query->where('budget', '<=', $request->max_price);
            \Log::info('Applied max price filter: ' . $request->max_price);
        }

        // Duration filter
        if (isset($request->duration) && !empty($request->duration)) {
            $query->where('duration', $request->duration);
            \Log::info('Applied duration filter: ' . $request->duration);
        }

        // Date posted filter
        if (isset($request->date_posted) && !empty($request->date_posted)) {
            $now = now();
            switch ($request->date_posted) {
                case 'lastHour':
                    $query->where('created_at', '>=', $now->subHour());
                    break;
                case 'last24Hours':
                    $query->where('created_at', '>=', $now->subDay());
                    break;
                case 'last7Days':
                    $query->where('created_at', '>=', $now->subDays(7));
                    break;
                case 'last30Days':
                    $query->where('created_at', '>=', $now->subDays(30));
                    break;
                case 'allTime':
                    // No filter for all time
                    break;
            }
            \Log::info('Applied date posted filter: ' . $request->date_posted);
        }

        return $query;
    }

    /**
     * Apply sorting to job query
     */
    private function applySorting($query, $sortBy)
    {
        if (!$sortBy) {
            return $query->latest();
        }

        switch ($sortBy) {
            case 'newest':
                \Log::info('Applying newest sort');
                return $query->orderBy('created_at', 'desc');
            case 'oldest':
                \Log::info('Applying oldest sort');
                return $query->orderBy('created_at', 'asc');
            case 'price_high':
                \Log::info('Applying price high to low sort');
                return $query->orderBy('budget', 'desc');
            case 'price_low':
                \Log::info('Applying price low to high sort');
                return $query->orderBy('budget', 'asc');
            default:
                \Log::info('Applying default sort (latest)');
                return $query->latest();
        }
    }

    /**
     * Apply country restrictions to job query
     */
    private function applyCountryRestrictions($query)
    {
        $restrictionEnabled = get_static_option('job_country_restriction_enabled', 0);
        $viewLevelEnabled = get_static_option('job_country_view_level_enabled', 0);

        if ($restrictionEnabled && $viewLevelEnabled && Auth::check()) {
            $freelancerCountry = Auth::user()->country_id;
            $query = $this->applyCountryRestrictionsToQuery($query, $freelancerCountry);
        }

        return $query;
    }

    /**
     * Helper method to apply country restrictions to query
     */
    private function applyCountryRestrictionsToQuery($query, $freelancerCountry)
    {
        return $query->where(function ($q) use ($freelancerCountry) {
            $q->where(function ($subQ) {
                $subQ->whereNull('country_restriction_type')
                    ->orWhere('country_restriction_type', 'none')
                    ->orWhere('country_restriction_type', '');
            });

            if ($freelancerCountry) {
                $q->orWhere(function ($subQ) use ($freelancerCountry) {
                    $subQ->where('country_restriction_type', 'include')
                        ->whereJsonContains('allowed_countries', (string) $freelancerCountry);
                })
                    ->orWhere(function ($subQ) use ($freelancerCountry) {
                        $subQ->where('country_restriction_type', 'exclude')
                            ->whereJsonDoesntContain('excluded_countries', (string) $freelancerCountry);
                    });
            }
        });
    }
}