<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Job;
use App\Models\JobPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Service\Entities\Category;

class CategoryJobController extends Controller
{
    public function category_jobs($slug)
    {
        $category = Category::select('id', 'category', 'meta_title', 'meta_description')->where('slug', $slug)->first();
        if (!empty($category)) {
            $query = JobPost::with('job_creator', 'job_skills')
                ->whereHas('job_creator')
                ->where('on_off', '1')
                ->where('status', '1')
                ->withCount('job_proposals')
                ->where('job_approve_request', '1')
                ->where('category', $category->id)
                ->latest();

            // Apply country restrictions
            $query = $this->applyCountryRestrictions($query);

            if (moduleExists('HourlyJob')) {
                $jobs = $query->paginate(10);
            } else {
                $jobs = $query->where('type', 'fixed')->paginate(10);
            }
            $countries = \Modules\CountryManage\Entities\Country::all_countries();
            $states = \Modules\CountryManage\Entities\State::all_states();
            $skills = \App\Models\Skill::all_skills();
            $subcategories = \Modules\Service\Entities\SubCategory::where('category_id', $category->id)
                ->where('status', 1)
                ->get();

// Calculate max price for slider
            $maxJobPrice = JobPost::where('category', $category->id)->max('budget');

            return view('frontend.pages.category-jobs.jobs', compact(
                'category',
                'jobs',
                'countries',
                'states',
                'skills',
                'subcategories',
                'maxJobPrice'
            ));
        }
        return back();
    }

    public function category_jobs_filter(Request $request)
    {
        if ($request->ajax()) {
            $query = JobPost::with('job_creator', 'job_skills')
                ->whereHas('job_creator')
                ->where('on_off', '1')
                ->where('status', '1')
                ->withCount('job_proposals')
                ->where('job_approve_request', '1')
                ->where('category', $request->category)
                ->latest();

            // Apply country restrictions
            $query = $this->applyCountryRestrictions($query);

            if (moduleExists('HourlyJob')) {
                $jobs = $query;
            } else {
                $jobs = $query->where('type', 'fixed');
            }

            if (filled($request->job_search_string)) {
                $jobs = $jobs->WhereHas('job_creator')->where('title', 'LIKE', '%' . strip_tags($request->job_search_string) . '%');
            }

            if (isset($request->country) && !empty($request->country)) {
                $jobs = $jobs->WhereHas('job_creator', function ($q) use ($request) {
                    $q->where('country_id', $request->country);
                });
            }
            if (isset($request->type) && !empty($request->type)) {
                $jobs = $jobs->where('type', $request->type);
            }
            if (isset($request->level) && !empty($request->level)) {
                $jobs = $jobs->WhereHas('job_creator', function ($q) use ($request) {
                    $q->where('level', $request->level);
                });
            }
            if (isset($request->min_price) && isset($request->max_price)  && !empty($request->min_price) && !empty($request->max_price)) {
                $jobs = $jobs->whereBetween('budget', [$request->min_price, $request->max_price]);
            }
            if (isset($request->duration) && !empty($request->duration)) {
                $jobs = $jobs->where('duration', $request->duration);
            }

            $jobs = $jobs->paginate(10);
            if ($jobs->total() >= 1) {
                // Calculate max price from filtered results
                $maxJobPrice = JobPost::where('category', $request->category)
                    ->when($request->filled('country'), function ($q) use ($request) {
                        $q->whereHas('job_creator', function ($q2) use ($request) {
                            $q2->where('country_id', $request->country);
                        });
                    })
                    ->when($request->filled('type'), function ($q) use ($request) {
                        $q->where('type', $request->type);
                    })
                    // Add other filter conditions here if needed
                    ->max('budget');

                return response()->json([
                    'status' => 'success',
                    'html' => view('frontend.pages.category-jobs.search-job-result', compact('jobs'))->render(),
                    'total' => $jobs->total(),
                    'count' => $jobs->count(),
                    'max_price' => $maxJobPrice ?? 1000
                ]);
            } else {
                return response()->json(['status' => 'nothing']);
            }
        }
    }

    public function pagination(Request $request)
    {
        if ($request->ajax()) {
            $query = JobPost::with('job_creator', 'job_skills')
                ->whereHas('job_creator')
                ->where('on_off', '1')
                ->where('status', '1')
                ->withCount('job_proposals')
                ->where('job_approve_request', '1')
                ->where('category', $request->category);

            // Apply country restrictions
            $query = $this->applyCountryRestrictions($query);

            if (moduleExists('HourlyJob')) {
                $jobs = $query;
            } else {
                $jobs = $query->where('type', 'fixed');
            }

            if ($request->country == '' && $request->type == '' && $request->level == '' && $request->min_price == '' && $request->max_price == '' && $request->duration == '' && $request->job_search_string == '') {
                $jobs = $jobs;
            } else {
                if (filled($request->job_search_string)) {
                    $jobs = $jobs->WhereHas('job_creator')->where('title', 'LIKE', '%' . strip_tags($request->job_search_string) . '%');
                }

                if (isset($request->country) && !empty($request->country)) {
                    $jobs = $jobs->WhereHas('job_creator', function ($q) use ($request) {
                        $q->where('country_id', $request->country);
                    });
                }
                if (isset($request->type) && !empty($request->type)) {
                    $jobs = $jobs->where('type', $request->type);
                }
                if (isset($request->level) && !empty($request->level)) {
                    $jobs = $jobs->WhereHas('job_creator', function ($q) use ($request) {
                        $q->where('level', $request->level);
                    });
                }
                if (isset($request->min_price) && isset($request->max_price)  && !empty($request->min_price) && !empty($request->max_price)) {
                    $jobs = $jobs->whereBetween('budget', [$request->min_price, $request->max_price]);
                }
                if (isset($request->duration) && !empty($request->duration)) {
                    $jobs = $jobs->where('duration', $request->duration);
                }
            }
            $jobs = $jobs->paginate(10);
            if ($jobs->total() >= 1) {
                return response()->json([
                    'status' => 'success',
                    'html' => view('frontend.pages.category-jobs.search-job-result', compact('jobs'))->render(),
                    'total' => $jobs->total(),
                    'count' => $jobs->count()
                ]);
            } else {
                return response()->json(['status' => 'nothing']);
            }
        }
    }

    //reset jobs filter
    public function reset(Request $request)
    {
        $query = JobPost::with('job_creator', 'job_skills')
            ->whereHas('job_creator')
            ->where('on_off', '1')
            ->where('status', '1')
            ->withCount('job_proposals')
            ->where('job_approve_request', '1')
            ->where('category', $request->category)
            ->latest();

        // Apply country restrictions
        $query = $this->applyCountryRestrictions($query);

        if (moduleExists('HourlyJob')) {
            $jobs = $query->paginate(10);
        } else {
            $jobs = $query->where('type', 'fixed')->paginate(10);
        }
        if ($jobs->total() >= 1) {
            // Calculate max price for this category
            $maxJobPrice = JobPost::where('category', $request->category)->max('budget');

            return response()->json([
                'status' => 'success',
                'html' => view('frontend.pages.category-jobs.search-job-result', compact('jobs'))->render(),
                'total' => $jobs->total(),
                'count' => $jobs->count(),
                'max_price' => $maxJobPrice ?? 1000
            ]);

        } else {
            return response()->json(['status' => 'nothing']);
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

    public function all_categories()
    {
        $categories = Category::where('status', 1)
            ->withCount('jobs')
            ->latest()
            ->get();

        return view('frontend.pages.category-jobs.all-categories', compact('categories'));
    }



}
