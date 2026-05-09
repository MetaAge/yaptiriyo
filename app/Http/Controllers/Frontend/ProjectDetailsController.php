<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Modules\PromoteFreelancer\Entities\PromotionProjectList;
use Modules\Subscription\Http\Controllers\Frontend\FrontendSubscriptionController;

class ProjectDetailsController extends Controller
{
    public function __construct(private FrontendJobsController $jobsController, private FrontendSubscriptionController $subscriptionController)
    {
        //
    }

    //project details
    public function project_details($username, $slug = null)
    {
        if ($username == 'jobs' && $slug == "all") {
            return $this->jobsController->jobs();
        }

        if ($username == 'subscriptions' && $slug == "all") {
            return $this->subscriptionController->subscriptions();
        }

        if ($slug != 'admin') {
            $project = Project::with([
                'project_attributes',
                'project_creator' => function($query) {
                    $query->withAvg(['freelancer_ratings as freelancer_ratings_avg_rating' => function($sq) {
                        $sq->where('sender_type', 1);
                    }], 'rating')->withCount(['freelancer_ratings as freelancer_ratings_count' => function($sq) {
                        $sq->where('sender_type', 1);
                    }]);
                },
                'project_category',
                'project_sub_categories',
            ])
                ->withCount('ratings')
                ->withAvg('ratings', 'rating')
                ->where('slug', $slug)
                ->first();

            if (!empty($project)) {
                // Apply fallback rating logic for the main project
                if (($project->ratings_count ?? 0) == 0 && $project->project_creator && ($project->project_creator->freelancer_ratings_count ?? 0) > 0) {
                    $project->average_rating = (float) $project->project_creator->freelancer_ratings_avg_rating;
                    $project->ratings_count = (int) $project->project_creator->freelancer_ratings_count;
                } else {
                    $project->average_rating = (float) ($project->ratings_avg_rating ?? 0);
                    $project->ratings_count = (int) ($project->ratings_count ?? 0);
                }

                $user = User::with([
                    'user_introduction',
                    'user_country:id,country',
                    'user_state:id,state,timezone',
                    'user_earning',
                    'service_areas.city:id,city',
                ])
                    ->withAvg(['freelancer_ratings as freelancer_ratings_avg_rating' => function($sq) {
                        $sq->where('sender_type', 1);
                    }], 'rating')
                    ->withCount(['freelancer_ratings as freelancer_ratings_count' => function($sq) {
                        $sq->where('sender_type', 1);
                    }])
                    ->withCount('completed_orders')
                    ->where('id', $project->user_id)
                    ->where('check_work_availability', 1)
                    ->where('user_active_inactive_status', 1)
                    ->first();

                if (!$user) {
                    abort(404);
                }

                // Get related projects (same category, excluding current project)
                $relatedProjects = Project::where('category_id', $project->category_id)
                    ->where('id', '!=', $project->id)
                    ->where('status', 1)
                    ->where(function($query) {
                        // Accept 'on', 1, or NULL as "on"
                        $query->where('project_on_off', 'on')
                            ->orWhere('project_on_off', 1)
                            ->orWhereNull('project_on_off');
                    })
                    ->where(function($query) {
                        // Accept 1 or NULL as approved
                        $query->where('project_approve_request', 1)
                            ->orWhereNull('project_approve_request');
                    })
                    ->whereHas('project_creator', function($query) {
                        $query->where('is_suspend', 0)
                            ->where('check_work_availability', 1)
                            ->where('user_active_inactive_status', 1);
                    })
                    ->with(['project_creator' => function($query) {
                        $query->withAvg(['freelancer_ratings' => function($sq) {
                            $sq->where('sender_type', 1);
                        }], 'rating')->withCount(['freelancer_ratings' => function($sq) {
                            $sq->where('sender_type', 1);
                        }]);
                    }, 'project_category', 'ratings'])
                    ->withCount('ratings')
                    ->withAvg('ratings', 'rating')
                    ->inRandomOrder()
                    ->take(6)
                    ->get();

                // If no related projects in same category, get from any category
                if ($relatedProjects->isEmpty()) {
                    $relatedProjects = Project::where('id', '!=', $project->id)
                        ->where('status', 1)
                        ->where(function($query) {
                            $query->where('project_on_off', 'on')
                                ->orWhere('project_on_off', 1)
                                ->orWhereNull('project_on_off');
                        })
                        ->where(function($query) {
                            $query->where('project_approve_request', 1)
                                ->orWhereNull('project_approve_request');
                        })
                        ->whereHas('project_creator', function($query) {
                            $query->where('is_suspend', 0)
                                ->where('check_work_availability', 1)
                                ->where('user_active_inactive_status', 1);
                        })
                        ->with(['project_creator' => function($query) {
                            $query->withAvg(['freelancer_ratings' => function($sq) {
                                $sq->where('sender_type', 1);
                            }], 'rating')->withCount(['freelancer_ratings' => function($sq) {
                                $sq->where('sender_type', 1);
                            }]);
                        }, 'project_category', 'ratings'])
                        ->withCount('ratings')
                        ->withAvg('ratings', 'rating')
                        ->inRandomOrder()
                        ->take(6)
                        ->get();
                }
                
                // Apply fallback rating for related projects
                $relatedProjects->transform(function ($relProject) {
                    if (($relProject->ratings_count ?? 0) == 0 && $relProject->project_creator && ($relProject->project_creator->freelancer_ratings_count ?? 0) > 0) {
                        $relProject->average_rating = (float) $relProject->project_creator->freelancer_ratings_avg_rating;
                        $relProject->ratings_count = (int) $relProject->project_creator->freelancer_ratings_count;
                    } else {
                        $relProject->average_rating = (float) $relProject->ratings_avg_rating;
                    }
                    return $relProject;
                });

                // Get reviews with pagination
                $project_complete_orders = Order::select('orders.id', 'orders.identity', 'orders.status', 'orders.is_project_job')
                    ->join('ratings', 'orders.id', '=', 'ratings.order_id')
                    ->where('orders.identity', $project->id)
                    ->where('orders.status', 3)
                    ->where('orders.is_project_job', 'project')
                    ->where('ratings.sender_type', 1)
                    ->orderBy('ratings.created_at', 'desc')
                    ->paginate(4);

                // pro project view count
                if (moduleExists('PromoteFreelancer')) {
                    $authId = auth('web')->id();
                    $current_date = \Carbon\Carbon::now()->toDateTimeString();

                    $find_package = PromotionProjectList::where('identity', $project->id)
                        ->where('type', 'project')
                        ->where('expire_date', '>=', $current_date)
                        ->first();

                    if ($find_package) {
                        if (!$authId || $authId !== $project->user_id) {
                            PromotionProjectList::where('id', $find_package->id)
                                ->update(['click' => $find_package->click + 1]);
                        }
                    }
                }
            } else {
                return back();
            }

            return view('frontend.pages.project-details.project-details', [
                'project' => $project,
                'user' => $user,
                'project_complete_orders' => $project_complete_orders,
                'relatedProjects' => $relatedProjects
            ]);
        } else {
            return view('backend.pages.auth.login');
        }
    }

    //load more review
    public function load_more_review(Request $request)
    {
        $project_id = $request->project_id;
        $project_complete_orders = Order::select('orders.id', 'orders.identity', 'orders.status', 'orders.is_project_job')
            ->join('ratings', 'orders.id', '=', 'ratings.order_id')
            ->where('orders.identity', $project_id)
            ->where('orders.status', 3)
            ->where('orders.is_project_job', 'project')
            ->where('ratings.sender_type', 1)
            ->orderBy('ratings.created_at', 'desc')
            ->paginate(4);

        return view('frontend.pages.project-details.reviews', compact(['project_complete_orders', 'project_id']))->render();
    }
}