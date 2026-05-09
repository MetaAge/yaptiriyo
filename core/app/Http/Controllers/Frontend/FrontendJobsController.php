<?php

namespace App\Http\Controllers\Frontend;

use App\Models\JobPost;
use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Service\Entities\Category;
use Modules\Service\Entities\SubCategory;
use Modules\CountryManage\Entities\Country;
use Modules\CountryManage\Entities\State;

class FrontendJobsController extends Controller
{
    public function jobs()
    {
        $query = $this->baseJobQuery();

        $query = $this->applyViewLevelCountryRestriction($query);

        if (moduleExists('HourlyJob')) {
            $query = $query->latest();
            $jobs = $query->paginate(10);
        } else {
            $query = $query->where('type', 'fixed')->latest();
            $jobs = $query->paginate(10);
        }

        $categories = Category::where('status', 1)->get();
        $subcategories = SubCategory::where('status', 1)->get();
        $countries = Country::where('status', 1)->get();
        $states = State::where('status', 1)->get();
        $skills = Skill::where('status', 1)->get();

        $maxJobPrice = JobPost::where('status', '1')
            ->where('job_approve_request', '1')
            ->where('on_off', '1')
            ->max('budget') ?? 1000;

        return view('frontend.pages.jobs.jobs', compact(
            'jobs',
            'categories',
            'subcategories',
            'countries',
            'states',
            'skills',
            'maxJobPrice'
        ));
    }

    public function jobs_filter(Request $request)
    {
        $query = $this->baseJobQuery();

        $query = $this->applyViewLevelCountryRestriction($query);

        if (!moduleExists('HourlyJob')) {
            $query = $query->where('type', 'fixed');
        }

        // Apply other filters INCLUDING SORTING
        $query = $this->applyJobFilters($query, $request);

        $jobs = $query->paginate(10)->withQueryString();

        if ($request->ajax()) {
            if ($jobs->total() >= 1) {
                $maxJobPrice = $query->max('budget') ?? 1000;

                return response()->json([
                    'html' => view('frontend.pages.jobs.search-job-result', compact('jobs'))->render(),
                    'total' => $jobs->total(),
                    'count' => $jobs->count(),
                    'max_price' => $maxJobPrice,
                    'status' => 'success'
                ]);
            } else {
                return response()->json(['status' => 'nothing']);
            }
        }

        $categories = Category::where('status', 1)->get();
        $subcategories = SubCategory::where('status', 1)->get();
        $countries = Country::where('status', 1)->get();
        $states = State::where('status', 1)->get();
        $skills = Skill::where('status', 1)->get();

        $maxJobPrice = JobPost::where('status', '1')
            ->where('job_approve_request', '1')
            ->where('on_off', '1')
            ->max('budget') ?? 1000;

        return view('frontend.pages.jobs.jobs', compact(
            'jobs',
            'categories',
            'subcategories',
            'countries',
            'states',
            'skills',
            'maxJobPrice'
        ));
    }

    public function pagination(Request $request)
    {
        return $this->jobs_filter($request);
    }

    public function reset(Request $request)
    {
        if (!$request->ajax()) return abort(404);

        $query = $this->baseJobQuery();

        $query = $this->applyViewLevelCountryRestriction($query);

        $query = $query->latest();

        if (!moduleExists('HourlyJob')) {
            $query = $query->where('type', 'fixed');
        }

        $jobs = $query->paginate(10)->withQueryString();

        if ($jobs->total() >= 1) {
            $maxJobPrice = $query->max('budget') ?? 1000;

            return response()->json([
                'html' => view('frontend.pages.jobs.search-job-result', compact('jobs'))->render(),
                'total' => $jobs->total(),
                'count' => $jobs->count(),
                'max_price' => $maxJobPrice
            ]);
        } else {
            return response()->json(['status' => 'nothing']);
        }
    }

    // -------------------------
    // Helper Methods
    // -------------------------

    private function baseJobQuery()
    {
        return JobPost::with('job_creator', 'job_skills')
            ->whereHas('job_creator', function ($q) {
                $q->where('user_active_inactive_status', 1);
            })
            ->where('on_off', '1')
            ->withCount('job_proposals')
            ->where('status', '1')
            ->where('job_approve_request', '1');
    }

    private function applyViewLevelCountryRestriction($query)
    {
        $restrictionEnabled = get_static_option('job_country_restriction_enabled', 0);
        $viewLevelEnabled = get_static_option('job_country_view_level_enabled', 0);

        if ($restrictionEnabled && $viewLevelEnabled && Auth::check()) {
            $freelancerCountry = Auth::user()->country_id;
            $query = $this->applyCountryRestrictionsToQuery($query, $freelancerCountry);
        }

        return $query;
    }

    private function applyCountryRestrictionsToQuery($query, $freelancerCountry)
    {
        $query->where(function ($q) use ($freelancerCountry) {
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

        return $query;
    }

    private function applyJobFilters($query, $request)
    {
        if (filled($request->job_search_string)) {
            $query = $query->where('title', 'LIKE', '%' . strip_tags($request->job_search_string) . '%');
        }

        if (!empty($request->category)) {
            $query = $query->where('category', $request->category);
        }

        if (!empty($request->subcategory)) {
            $query = $query->whereHas('job_sub_categories', function ($q) use ($request) {
                $q->whereIn('sub_categories.id', $request->subcategory);
            });
        }

        if (!empty($request->skills)) {
            $query = $query->whereHas('job_skills', function ($q) use ($request) {
                $q->whereIn('skills.id', $request->skills);
            });
        }

        if (!empty($request->country)) {
            $query = $query->whereHas('job_creator', function ($q) use ($request) {
                $q->where('country_id', $request->country);
            });
        }

        if (!empty($request->state)) {
            $states = is_array($request->state) ? $request->state : [$request->state];
            $query = $query->whereHas('job_creator', function ($q) use ($states) {
                $q->whereIn('state_id', $states);
            });
        }

        if (!empty($request->type)) {
            $query = $query->where('type', $request->type);
        }

        if (!empty($request->level)) {
            $query = $query->whereHas('job_creator', function ($q) use ($request) {
                $q->where('level', $request->level);
            });
        }

        if (!empty($request->min_price) && !empty($request->max_price)) {
            $query = $query->whereBetween('budget', [$request->min_price, $request->max_price]);
        }

        if (!empty($request->duration)) {
            $query = $query->where('duration', $request->duration);
        }

        // Date Posted Filter
        if (!empty($request->date_posted)) {
            $now = now();

            switch ($request->date_posted) {
                case 'lastHour':
                    $query = $query->where('created_at', '>=', $now->subHour());
                    break;
                case 'last24Hours':
                    $query = $query->where('created_at', '>=', $now->subDay());
                    break;
                case 'last7Days':
                    $query = $query->where('created_at', '>=', $now->subDays(7));
                    break;
                case 'last30Days':
                    $query = $query->where('created_at', '>=', $now->subDays(30));
                    break;
                case 'allTime':
                    // No filter needed
                    break;
            }
        }

        // ===== SORTING WITH TYPE GROUPING =====
        $query->getQuery()->orders = null;

        if (!empty($request->sort_by)) {
            switch ($request->sort_by) {
                case 'newest':
                    $query = $query->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $query = $query->orderBy('created_at', 'asc');
                    break;
                case 'price_high':
                    // Sort by type first (fixed first, then hourly)
                    // Fixed jobs: sort by budget DESC
                    // Hourly jobs: sort by hourly_rate DESC
                    $query = $query->orderByRaw("FIELD(type, 'fixed', 'hourly')")
                        ->orderByRaw('CAST(IF(type = "hourly", hourly_rate, budget) AS DECIMAL(10,2)) DESC');
                    break;
                case 'price_low':
                    // Sort by type first (hourly first, then fixed)
                    // Hourly jobs: sort by hourly_rate ASC
                    // Fixed jobs: sort by budget ASC
                    $query = $query->orderByRaw("FIELD(type, 'hourly', 'fixed')")
                        ->orderByRaw('CAST(IF(type = "hourly", hourly_rate, budget) AS DECIMAL(10,2)) ASC');
                    break;
                default:
                    $query = $query->orderBy('created_at', 'desc');
                    break;
            }
        } else {
            $query = $query->orderBy('created_at', 'desc');
        }

        return $query;
    }
}