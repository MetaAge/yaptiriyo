<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\JobPost;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Queue\Jobs\Job;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FrontendHomeController extends Controller
{
    public function project_or_job_search(Request $request)
    {
        $search_type = $request->search_type ?? '';
        if ($search_type == 'project') {
            $projects_or_jobs = Project::with('project_creator')
                ->select(['id', 'title', 'slug', 'user_id', 'basic_regular_charge', 'image', 'load_from'])
                ->where('project_on_off', '1')
                ->where('status', '1')
                ->latest()
                ->where('title', 'LIKE', '%' . strip_tags($request->job_search_string) . '%')->get();
        } else if ($search_type == 'job') {

            $query = JobPost::with('job_creator', 'job_skills')
                ->select('id', 'title', 'slug', 'user_id', 'budget')
                ->where('on_off', '1')
                ->where('status', '1')
                ->where('job_approve_request', '1');

            // Apply country restrictions if enabled and view level is active
            $restrictionEnabled = get_static_option('job_country_restriction_enabled', 0);
            $viewLevelEnabled = get_static_option('job_country_view_level_enabled', 0);

            if ($restrictionEnabled && $viewLevelEnabled && Auth::check()) {
                $freelancerCountry = Auth::user()->country_id;
                $query = $this->applyCountryRestrictionsToQuery($query, $freelancerCountry);
            }

            $projects_or_jobs = $query->latest()
                ->where('title', 'LIKE', '%' . strip_tags($request->job_search_string) . '%')->get();
        } else {
            $projects_or_jobs = User::with('user_introduction')
                ->select('id', 'username', 'first_name', 'last_name', 'image', 'country_id', 'state_id', 'load_from')
                ->where('user_type', '2')
                ->where('is_email_verified', 1)
                ->where('is_suspend', 0)
                ->where(function ($q) use ($request) {
                    $search = '%' . strip_tags($request->job_search_string) . '%';
                    $q->where('first_name', 'LIKE', $search)
                    ->orWhere('last_name', 'LIKE', $search)
                    ->orWhere('username', 'LIKE', $search)
                    ->orWhereHas('user_introduction', function ($q2) use ($search) {
                        $q2->where('title', 'LIKE', $search);
                    });
                })
                ->get();
        }
        return view('frontend.pages.frontend-home-job-search-result', compact(['projects_or_jobs', 'search_type']))->render();
    }

    // Helper method to apply country restrictions to query
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
