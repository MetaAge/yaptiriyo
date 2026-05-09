<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FreelancerNotification;
use App\Models\Order;
use App\Models\Project;
use App\Models\Portfolio;
use App\Models\Skill;
use App\Models\User;
use App\Models\UserEarning;
use App\Models\UserEducation;
use App\Models\UserExperience;
use App\Models\UserSkill;
use App\Models\UserWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\PromoteFreelancer\Entities\PromotionProjectList;
use App\Models\CanContactFreelancer;

class ProfileDetailsController extends Controller
{
    //freelancer profile details
    public function profile_details(Request $request, $username)
    {
        $user = User::with([
            'user_introduction',
            'user_country:id,country',
            'user_state:id,state,timezone',
            'user_earning',
            'service_areas.city:id,city'
        ])
            ->withCount('completed_orders')
            ->withAvg(['freelancer_ratings' => function($sq) {
                $sq->where('sender_type', 1);
            }], 'rating')
            ->withCount(['freelancer_ratings' => function($sq) {
                $sq->where('sender_type', 1);
            }])
            ->select(['id', 'image', 'hourly_rate', 'first_name', 'last_name', 'country_id', 'state_id', 'check_work_availability', 'user_verified_status', 'load_from', 'created_at']) // Add created_at
            ->where('username', $username)
            ->first();

        if ($user) {
            if (!$request->ajax()) {
                if ($request->has('mark_as_read') && $request->mark_as_read == 'true') {
                    if (Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 2 && Auth::guard('web')->user()->username == Auth::guard('web')->user()->username) {
                        FreelancerNotification::where('freelancer_id', Auth::guard('web')->user()->id)
                            ->where('is_read', 'unread')
                            ->where('type', 'Project')
                            ->orWhere('type', 'Profile')
                            ->orWhere('type', 'Reject Project')
                            ->orWhere('type', 'Activate Project')
                            ->orWhere('type', 'Inactivate Project')
                            ->update(['is_read' => 'read']);
                    }
                }
            }

            $user_work =  UserWork::where('user_id', $user->id)->first();
            $total_earning =  UserEarning::where('user_id', $user->id)->first();
            $complete_orders_in_total = Order::whereHas('freelancer')->where('freelancer_id', $user->id)->where('status', 3)->count();
            $complete_orders = Order::with([
                'user:id,first_name,last_name,image', // client who gave rating
                'project:id,title',
                'job:id,title',
                'rating' => function($query) {
                    $query->where('sender_type', 1);
                }
            ])
                ->where('freelancer_id', $user->id)
                ->where('status', 3)
                ->whereHas('rating', function($q) {
                    $q->where('sender_type', 1);
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10);
            $active_orders_count = Order::where('freelancer_id', $user->id)->whereHas('user')->where('status', 1)->count();
            $skills_according_to_category = isset($user_work) ? Skill::select(['id', 'skill'])->where('category_id', $user_work->category_id)->get() : '';
            $skills =  UserSkill::select('skill')->where('user_id', $user->id)->first()->skill ?? '';
            $portfolios = Portfolio::where('username', $username)->latest()->get();
            $educations = UserEducation::where('user_id', $user->id)->latest()->get();
            $experiences = UserExperience::where('user_id', $user->id)->latest()->get();
            $projects = Project::with([
                'project_history',
                'project_category:id,category',
                'ratings',
                'complete_orders'
            ])
                ->where('user_id', $user->id)
                ->withCount(['orders', 'ratings as ratings_count' => function($q) {
                    $q->where('sender_type', 1);
                }])
                ->withAvg(['ratings as ratings_avg_rating' => function($q) {
                    $q->where('sender_type', 1);
                }], 'rating')
                ->latest()
                ->get();

            // Apply rating fallback logic
            $projects->transform(function ($project) use ($user) {
                if (($project->ratings_count ?? 0) == 0 && ($user->freelancer_ratings_count ?? 0) > 0) {
                    $project->average_rating = (float) $user->freelancer_ratings_avg_rating;
                    $project->ratings_count = (int) $user->freelancer_ratings_count;
                }
                return $project;
            });

            //pro profile view count
            if (moduleExists('PromoteFreelancer')) {
                $authId = auth('web')->id();
                $current_date = \Carbon\Carbon::now()->toDateTimeString();

                $find_package = PromotionProjectList::where('identity', $user->id)
                    ->where('type', 'profile')
                    ->where('expire_date', '>=', $current_date)
                    ->first();

                if ($find_package) {
                    if (!$authId || $authId !== $user->id) {
                        PromotionProjectList::where('id', $find_package->id)->update(['click' => $find_package->click + 1]);
                    }
                }
            }


            $record = CanContactFreelancer::first();
            if (!$record) {
                $record = new \stdClass();
                $record->can_contact_freelancer = 0;
                $record->show_contact_me_before_login = 0;
            }


            return view('frontend.profile-details.profile-details', compact([
                'username',
                'skills_according_to_category',
                'portfolios',
                'skills',
                'educations',
                'experiences',
                'projects',
                'user',
                'total_earning',
                'complete_orders',
                'complete_orders_in_total',
                'active_orders_count',
                'record'
            ]));
        } else {
            return back();
        }
    }


    //freelancer portfolio details
    public function portfolio_details(Request $request)
    {
        $portfolioDetails = Portfolio::where('id', $request->id)->first();
        $username = User::select('username')->where('id', $portfolioDetails->user_id)->first();
        $username = $username->username;
        return view('frontend.profile-details.portfolio-details', compact('portfolioDetails', 'username'))->render();
    }


    //freelancer promotion checkout
    public function promotionCheckout(Request $request)
    {
        $projectId = $request->input('project_id', 0);
        $isProfile = ($projectId == 0);

        // Get promotion packages
        $packages = \Modules\PromoteFreelancer\Entities\ProjectPromoteSettings::where('status', 1)->get();

        return view('frontend.profile-details.promotion-checkout', compact('packages', 'projectId', 'isProfile'));
    }

    // CHANGE: Add new method to handle toggle earning visibility
    public function toggleEarning(Request $request)
    {
        $request->validate([
            'show_earning' => 'required|in:0,1',
        ]);

        $userId = auth()->id();

        try {
            // Try to get existing record
            $userEarning = \App\Models\UserEarning::firstOrCreate(
                ['user_id' => $userId],
                [
                    'show_earning'      => (int) $request->show_earning,
                    'total_earning'     => 0,
                    'total_withdraw'    => 0,
                    'remaining_balance' => 0,
                ]
            );

            // If record already exists, just update show_earning
            if (!$userEarning->wasRecentlyCreated) {
                $userEarning->update([
                    'show_earning' => (int) $request->show_earning,
                ]);
            }

            return response()->json([
                'status'  => 'success',
                'message' => __('Earning visibility updated successfully'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => __('Something went wrong while updating earning visibility.'),
            ], 500);
        }
    }
}
