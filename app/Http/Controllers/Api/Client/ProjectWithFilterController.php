<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Project;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\Chat\Entities\LiveChat;
use Illuminate\Pagination\LengthAwarePaginator;

class ProjectWithFilterController extends Controller
{
    private $current_date;
    public function __construct()
    {
        $this->current_date = \Carbon\Carbon::now()->toDateTimeString();
    }

    //all projects
    public function projects(Request $request)
    {
        $projects = $this->getMixedProjects($request);

        if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])) {
            $projects->transform(function ($project) {
                $project->project_cloud_image = render_frontend_cloud_image_if_module_exists('project/'.$project->first_image, load_from: $project->load_from);
                
                // Fix is_pro and add is_premium
                $isProActive = ($project->is_pro == 'yes' && $project->pro_expire_date > $this->current_date) 
                    || (($project->sub_rank ?? 0) == 2)
                    || ($project->is_subscription_promoted == 1 && ($project->sub_rank ?? 0) > 0);
                $project->is_pro = $isProActive ? 'yes' : 'no';
                $project->is_premium = ($project->sub_rank ?? 0) == 2;
                $project->is_pro_active = $isProActive;
                $project->is_emergency = ($project->is_emergency == 1 && ($project->sub_rank ?? 0) > 0) ? 1 : 0;

                return $project;
            });
        } else {
             $projects->transform(function ($project) {
                // Fix is_pro and add is_premium
                $isProActive = ($project->is_pro == 'yes' && $project->pro_expire_date > $this->current_date) 
                    || (($project->sub_rank ?? 0) == 2)
                    || ($project->is_subscription_promoted == 1 && ($project->sub_rank ?? 0) > 0);
                $project->is_pro = $isProActive ? 'yes' : 'no';
                $project->is_premium = ($project->sub_rank ?? 0) == 2;
                $project->is_pro_active = $isProActive;
                $project->is_emergency = ($project->is_emergency == 1 && ($project->sub_rank ?? 0) > 0) ? 1 : 0;

                return $project;
            });
        }

        if($projects){
            return response()->json([
                'projects' => $projects,
                'project_file_path' => asset('assets/uploads/project/'),
                'storage_driver' => Storage::getDefaultDriver() ?? '',
            ]);
        }
        return response()->json(['msg' => __('no projects found.')]);
    }

    //projects filter
    public function projects_filter(Request $request)
    {
        $projects = $this->getMixedProjects($request);

        if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])) {
            $projects->transform(function ($project) {
                $project->project_cloud_image = render_frontend_cloud_image_if_module_exists('project/'.$project->first_image, load_from: $project->load_from);
                
                // Fix is_pro and add is_premium
                $isProActive = ($project->is_pro == 'yes' && $project->pro_expire_date > $this->current_date) 
                    || (($project->sub_rank ?? 0) == 2)
                    || ($project->is_subscription_promoted == 1 && ($project->sub_rank ?? 0) > 0);
                $project->is_pro = $isProActive ? 'yes' : 'no';
                $project->is_premium = ($project->sub_rank ?? 0) == 2;
                $project->is_pro_active = $isProActive;
                $project->is_emergency = ($project->is_emergency == 1 && ($project->sub_rank ?? 0) > 0) ? 1 : 0;

                return $project;
            });
        } else {
             $projects->transform(function ($project) {
                // Fix is_pro and add is_premium
                $isProActive = ($project->is_pro == 'yes' && $project->pro_expire_date > $this->current_date) 
                    || (($project->sub_rank ?? 0) == 2)
                    || ($project->is_subscription_promoted == 1 && ($project->sub_rank ?? 0) > 0);
                $project->is_pro = $isProActive ? 'yes' : 'no';
                $project->is_premium = ($project->sub_rank ?? 0) == 2;
                $project->is_pro_active = $isProActive;
                $project->is_emergency = ($project->is_emergency == 1 && ($project->sub_rank ?? 0) > 0) ? 1 : 0;

                return $project;
            });
        }


        if ($projects) {
            return response()->json([
                'projects' => $projects,
                'project_file_path' => asset('assets/uploads/project/'),
                'storage_driver' => Storage::getDefaultDriver() ?? '',
            ]);
        }
        return response()->json(['msg' => __('no projects found.')]);
    }

    private function common_query($request)
    {
        if($request->get_pro_projects == 1){
            return Project::query()->with(['project_creator' => function($q) {
                $q->withAvg(['freelancer_ratings' => function($sq) {
                    $sq->where('sender_type', 1);
                }], 'rating')->withCount(['freelancer_ratings' => function($sq) {
                    $sq->where('sender_type', 1);
                }]);
            },'project_attributes'])
                ->whereHas('project_creator')
                ->select(['id', 'title','slug','user_id','basic_regular_charge','basic_discount_charge','basic_delivery','description','image','load_from','is_pro','pro_expire_date','is_emergency'])
                ->where('project_on_off','1')
                ->where('pro_expire_date','>',$this->current_date)
                ->where('is_pro','yes')
                ->where('status','1');
        }else{
            return Project::query()->with(['project_creator' => function($q) {
                $q->withAvg(['freelancer_ratings' => function($sq) {
                    $sq->where('sender_type', 1);
                }], 'rating')->withCount(['freelancer_ratings' => function($sq) {
                    $sq->where('sender_type', 1);
                }]);
            },'project_attributes'])
                ->whereHas('project_creator')
                ->select(['id', 'title','slug','user_id','basic_regular_charge','basic_discount_charge','basic_delivery','description','image','load_from','is_pro','pro_expire_date','is_emergency'])
                ->where('project_on_off','1')
                ->where('status','1');
        }
    }

    // Get mixed pro/non-pro projects
    private function getMixedProjects($request)
    {
        $perPage = get_static_option("projects_per_page") ?? 10;
        $proCount = get_static_option("pro_projects_count") ?? 5;
        $nonProCount = get_static_option("non_pro_projects_count") ?? 5;
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
            return $this->getProjectsWithoutPromotion($request, $perPage);
        }

        $baseQuery = $this->filter_query($request);

        $currentProIds = Project::select('projects.id')
            ->leftJoin('user_subscriptions', 'user_subscriptions.user_id', '=', 'projects.user_id')
            ->leftJoin('subscriptions', 'subscriptions.id', '=', 'user_subscriptions.subscription_id')
            ->where(function($q) {
                // 1. Manually paid promotions (is_pro) - always active until date
                $q->where(function($sq) {
                    $sq->where('projects.is_pro', 'yes')
                        ->where('projects.pro_expire_date', '>=', $this->current_date);
                })
                // 2. Subscription based promotions
                ->orWhere(function($sq) {
                    $sq->where('user_subscriptions.status', 1)
                        ->where('user_subscriptions.payment_status', 'complete')
                        ->where('user_subscriptions.expire_date', '>', $this->current_date)
                        ->where(function($ssq) {
                            // Premium users: All projects promoted
                            $ssq->where(function($sssq) {
                                $sssq->where('subscriptions.title', 'LIKE', '%PREMIUM%')
                                    ->orWhere('subscriptions.title', 'LIKE', '%PROFESSIONAL%')
                                    ->orWhere('subscriptions.title', 'LIKE', '%PLUS%')
                                    ->orWhere('subscriptions.title', 'LIKE', '%GOLD%')
                                    ->orWhere('subscriptions.title', 'LIKE', '%VIP%')
                                    ->orWhere('subscriptions.title', 'LIKE', '%ELITE%');
                            })
                            // Pro users: Only manually selected projects
                            ->orWhere(function($sssq) {
                                $sssq->where('projects.is_subscription_promoted', 1)
                                    ->where(function($ssssq) {
                                        $ssssq->where('subscriptions.title', 'LIKE', '%PRO%')
                                            ->orWhere('subscriptions.title', 'LIKE', '%PROFESSIONAL%');
                                    });
                            });
                        });
                });
            })

            ->pluck('projects.id')
            ->unique()
            ->toArray();


        if ($proFirst && !empty($currentProIds)) {
            return $this->getProProjectsFirstOptimized($baseQuery, $currentProIds, $page, $perPage, $request);
        }

        return $this->getMixedProjectsOptimized($baseQuery, $currentProIds, $page, $perPage, $proCount, $nonProCount, $request);
    }

    // Projects without promotion module
    private function getProjectsWithoutPromotion($request, $perPage)
    {
        $query = $this->filter_query($request);
        
        if($request->sort_by == 'price') {
            $query->orderBy(DB::raw('COALESCE(NULLIF(basic_discount_charge, 0), basic_regular_charge)'), $request->sort_type == 'asc' ? 'asc' : 'desc');
        } elseif($request->sort_by == 'rating') {
            $query->orderBy('ratings_avg_rating', $request->sort_type == 'asc' ? 'asc' : 'desc');
        } else {
            $query->orderByRaw('COALESCE(sub_rank, 0) DESC')->latest();
        }



        return $query->paginate($perPage);
    }

    // Pro projects first
    private function getProProjectsFirstOptimized($baseQuery, $proIds, $page, $perPage, $request)
    {
        $sortBy = $request->get('sort_by', '');
        $isPriceSort = $sortBy == 'price';
        $isRatingSort = $sortBy == 'rating';

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
                $proQuery->orderBy(DB::raw('COALESCE(NULLIF(basic_discount_charge, 0), basic_regular_charge)'), $request->sort_type == 'asc' ? 'asc' : 'desc');
                $proProjects = $proQuery->offset($offset)->limit($proTake)->get();
            } elseif ($isRatingSort) {
                $proQuery->orderBy('ratings_avg_rating', $request->sort_type == 'asc' ? 'asc' : 'desc');
                $proProjects = $proQuery->offset($offset)->limit($proTake)->get();
            } else {
                $proProjects = $proQuery
                    ->orderByRaw('COALESCE(sub_rank, 0) DESC')
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

            $nonProQuery = (clone $baseQuery)->whereNotIn('id', $proIds);
            if ($isPriceSort) {
                $nonProQuery->orderBy(DB::raw('COALESCE(NULLIF(basic_discount_charge, 0), basic_regular_charge)'), $request->sort_type == 'asc' ? 'asc' : 'desc');
            } elseif ($isRatingSort) {
                $nonProQuery->orderBy('ratings_avg_rating', $request->sort_type == 'asc' ? 'asc' : 'desc');
            } else {
                $nonProQuery->orderByDesc('sub_rank')->latest();
            }

            
            $nonProProjects = $nonProQuery
                ->offset($nonProOffset)
                ->limit($nonProTake)
                ->get();

            $result = $result->concat($nonProProjects);
        }

        return new LengthAwarePaginator(
            $result,
            $totalItems,
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }

    // Mixed projects with ratio
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

        $sortBy = $request->get('sort_by', '');
        $isPriceSort = $sortBy == 'price';
        $isRatingSort = $sortBy == 'rating';

        $pageData = $this->calculatePageAllocation($page, $perPage, $proCount, $nonProCount, $totalPro, $totalNonPro);

        $result = collect();

        if ($pageData['proTake'] > 0) {
            $proQuery = (clone $baseQuery)->whereIn('id', $proIds);

            if ($isPriceSort) {
                $proQuery->orderBy(DB::raw('COALESCE(NULLIF(basic_discount_charge, 0), basic_regular_charge)'), $request->sort_type == 'asc' ? 'asc' : 'desc');
                $proProjects = $proQuery->offset($pageData['proOffset'])->limit($pageData['proTake'])->get();
            } elseif ($isRatingSort) {
                $proQuery->orderBy('ratings_avg_rating', $request->sort_type == 'asc' ? 'asc' : 'desc');
                $proProjects = $proQuery->offset($pageData['proOffset'])->limit($pageData['proTake'])->get();
            } else {
                $proProjects = $proQuery
                    ->orderByRaw('COALESCE(sub_rank, 0) DESC')
                    ->orderByRaw('RAND(' . $this->getConsistentSeed($request) . ')')
                    ->offset($pageData['proOffset'])
                    ->limit($pageData['proTake'])
                    ->get();
            }



            $result = $result->concat($proProjects);
        }

        if ($pageData['nonProTake'] > 0) {
            $nonProQuery = (clone $baseQuery)->whereNotIn('id', $proIds);
            if ($isPriceSort) {
                $nonProQuery->orderBy(DB::raw('COALESCE(NULLIF(basic_discount_charge, 0), basic_regular_charge)'), $request->sort_type == 'asc' ? 'asc' : 'desc');
            } elseif ($isRatingSort) {
                $nonProQuery->orderBy('ratings_avg_rating', $request->sort_type == 'asc' ? 'asc' : 'desc');
            } else {
                $nonProQuery->orderByDesc('sub_rank')->latest();
            }


            $nonProProjects = $nonProQuery
                ->offset($pageData['nonProOffset'])
                ->limit($pageData['nonProTake'])
                ->get();

            $result = $result->concat($nonProProjects);
        }

        $mixed = $this->interleaveResults($result, $proIds, $proCount, $nonProCount);
        $mixed = $mixed->take($perPage);

        return new LengthAwarePaginator(
            $mixed,
            $totalItems,
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }

    // Calculate page allocation
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

    // Interleave results
    private function interleaveResults($allResults, $proIds, $proCount, $nonProCount)
    {
        $proResults = $allResults->whereIn('id', $proIds)->values();
        $nonProResults = $allResults->whereNotIn('id', $proIds)->values();

        if ($proResults->count() == 0 || $nonProResults->count() == 0) {
            return $allResults->values();
        }

        $mixed = collect();
        $proIndex = 0;
        $nonProIndex = 0;
        $totalItems = $proResults->count() + $nonProResults->count();
        $proCount = $proResults->count();

        $promotedPositions = [];
        if ($proCount <= 3) {
            if ($proCount == 1) $promotedPositions = [0];
            elseif ($proCount == 2) $promotedPositions = [0, 3];
            elseif ($proCount == 3) $promotedPositions = [0, 3, 4];
        } else {
            $strategicPositions = [0, 3, 4, 6, 7, 9];
            $promotedPositions = array_slice($strategicPositions, 0, min($proCount, count($strategicPositions)));
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
            $request->title ?? '',
            $request->country ?? '',
            $request->category ?? '',
            date('H')
        ];
        return crc32(implode('|', $seedData));
    }

    private function filter_query($request)
    {
        $query = $this->common_query($request)->withCount(['complete_orders','ratings'])->withAvg('ratings','rating');

        $query->selectRaw('projects.*, 
            (SELECT CASE 
                WHEN s.title LIKE "%PREMIUM%" THEN 2
                WHEN s.title LIKE "%PROFESSIONAL%" THEN 2
                WHEN s.title LIKE "%PRO%" THEN 1
                ELSE 0 
            END 
            FROM user_subscriptions us 
            JOIN subscriptions s ON s.id = us.subscription_id 
            WHERE us.user_id = projects.user_id 
            AND us.status = 1 
            AND us.payment_status = "complete" 
            AND us.expire_date > ? 
            LIMIT 1) as sub_rank,
            (SELECT COUNT(DISTINCT ip_address) 
             FROM project_views 
             WHERE project_views.project_id = projects.id 
             AND project_views.created_at >= ?) as views_count', [$this->current_date, \Carbon\Carbon::now()->subMinutes(15)->toDateTimeString()]);

        $projects = $query;


        if(filled($request->job_search_string)){
            $query->where(function($q) use ($request){
                $q->where('title', 'LIKE', '%' .strip_tags($request->job_search_string). '%')
                    ->orWhereHas('project_category', function($cq) use ($request){
                        $cq->where('category', 'LIKE', '%'.strip_tags($request->job_search_string).'%');
                    })
                    ->orWhereHas('project_sub_categories', function($sq) use ($request){
                        $sq->where('sub_categories.sub_category', 'LIKE', '%'.strip_tags($request->job_search_string).'%');
                    });
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
            $query = $query->where(function($q) use ($request) {
                $q->where('state_id', $request->state)
                    ->orWhereHas('project_creator', function ($q2) use ($request) {
                        $q2->where('state_id', $request->state);
                    })
                    ->orWhereHas('service_areas', function($sq) use($request){
                        $sq->where('state_id', $request->state);
                    })
                    ->orDoesntHave('service_areas');
            });
        }

        if (!empty($request->city)) {
            $query = $query->where(function($q) use ($request) {
                $q->where('city_id', $request->city)
                    ->orWhereHas('service_areas', function($sq) use($request){
                        $sq->where('city_id', $request->city);
                    })
                    ->orDoesntHave('service_areas');
            });
        }

        if (!empty($request->neighborhood)) {
            $query = $query->where(function($q) use ($request) {
                $q->where('neighborhood_id', $request->neighborhood)
                    ->orWhereHas('service_areas', function($sq) use($request){
                        $sq->where('neighborhood_id', $request->neighborhood);
                    })
                    ->orDoesntHave('service_areas');
            });
        }

        if(!empty($request->min_price) || !empty($request->max_price)){
            $query->where(function($q) use ($request) {
                $effectivePrice = DB::raw('COALESCE(NULLIF(basic_discount_charge, 0), basic_regular_charge)');
                if(!empty($request->min_price)){
                    $q->where($effectivePrice, '>=', $request->min_price);
                }
                if(!empty($request->max_price)){
                    $q->where($effectivePrice, '<=', $request->max_price);
                }
            });
        }

        if(!empty($request->duration)){
            $query = $query->where('basic_delivery',$request->duration);
        }

        if(!empty($request->rating)){
            $query = $query->withAvg(['ratings' => function ($query){
                $query->where('sender_type', 1);
            }],'rating')
                ->havingRaw('ratings_avg_rating >= ?', [$request->rating]);
        }
        if(!empty($request->category)){
            $query = $query->where('category_id',$request->category);
        }

        if(!empty($request->subcategory)){
            $query = $query->whereHas('project_sub_categories',function($q) use($request){
                $q->where('sub_categories.id',$request->subcategory);
            });
        }

        if(!empty($request->title)){
            $query->where(function($q) use ($request){
                $q->where('title','LIKE','%'.strip_tags($request->title).'%')
                    ->orWhereHas('project_category', function($cq) use ($request){
                        $cq->where('category', 'LIKE', '%'.strip_tags($request->title).'%');
                    })
                    ->orWhereHas('project_sub_categories', function($sq) use ($request){
                        $sq->where('sub_categories.sub_category', 'LIKE', '%'.strip_tags($request->title).'%');
                    });
            });
        }

        return $query;
    }

    //project details
    public function project_details($id)
    {
        try {
            DB::table('project_views')->insert([
                'project_id' => $id,
                'ip_address' => request()->ip(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (\Exception $e) {
        }

        $project_details = Project::with([
            'project_creator:id,first_name,last_name,experience_level,image,username,check_online_status,check_work_availability,user_active_inactive_status,user_verified_status,country_id,state_id,load_from,phone',
            'project_attributes',
            'project_category:id,category,slug',
            'project_sub_categories:id,sub_category,slug',
            'service_areas:id,project_id,country_id,state_id,city_id',
            'service_areas.country:id,country',
            'service_areas.state:id,state',
            'service_areas.city:id,city',
        ])
            ->withCount('complete_orders','ratings')
            ->where('id', $id)
            ->first();

        $chat_id = '';
        $user = auth('sanctum')->user();
        $token = request()->bearerToken();
        if(!$user && $token){
            $user = \Laravel\Sanctum\PersonalAccessToken::findToken($token)?->tokenable;
        }

        if($user && !empty($project_details)){
            $client_id = $user->id;
            $chat_id = LiveChat::select('id','freelancer_id','client_id')
                ->where('freelancer_id',$project_details->user_id)
                ->where('client_id',$client_id)
                ->first();
        }

        if (empty($project_details)) {
            return response()->json(['msg' => __('no projects found.')], 404);
        }

        $complete_orders_count = Order::where('freelancer_id',$project_details->user_id)->where('status',3)->count();
        $complete_orders = Order::select('id', 'identity', 'status')->whereHas('user')->whereHas('rating')
            ->where('freelancer_id', $project_details->user_id)
            ->where('status', 3)
            ->where('is_project_job', 'project')
            ->where('identity', $id)
            ->latest()
            ->get();

        $total_rating = 0;
        foreach ($complete_orders as $order){
            $rating = Rating::where('order_id', $order->id)->where('sender_type', 1)->first();
            if ($rating) {
                $total_rating = $total_rating+$rating->rating;
            }
        }

        $total_rating >=1 ? $avg_rating = $total_rating/$complete_orders->count() : $avg_rating = '';


        //freelancer rating
        $freel_complete_orders = Order::select('id','identity','status')->where('freelancer_id',$project_details->user_id)->where('status',3)->get();
        $count = 0;
        $freel_rating_count = 0;
        $freel_total_rating = 0;
        foreach($freel_complete_orders as $order){
            $freel_rating = Rating::where('order_id',$order->id)->where('sender_type',1)->first();
            if($freel_rating){
                $freel_total_rating = $freel_total_rating+$freel_rating->rating;
                $count = $count+1;
                $freel_rating_count = $freel_rating_count+1;
            }
        }

        $freel_avg_rating = $count > 0 ? $freel_total_rating/$count : 0;

        if($project_details->first_image){
            $project_details->project_cloud_image = render_frontend_cloud_image_if_module_exists('project/'.$project_details->first_image, load_from: $project_details->load_from);
        }else{
            $project_details->project_cloud_image = null;
        }

        if($project_details?->project_creator){
            $project_details->project_creator->freelancer_cloud_image = render_frontend_cloud_image_if_module_exists('profile/'.$project_details?->project_creator?->image, load_from: $project_details?->project_creator?->load_from);
            $project_details->project_creator->is_pro_tier = is_pro_user($project_details->user_id);
            $project_details->project_creator->is_premium_tier = is_premium_user($project_details->user_id);
        }

        if ($project_details) {
            $sub_rank = DB::table('user_subscriptions')
                ->join('subscriptions', 'subscriptions.id', '=', 'user_subscriptions.subscription_id')
                ->where('user_subscriptions.user_id', $project_details->user_id)
                ->where('user_subscriptions.status', 1)
                ->where('user_subscriptions.payment_status', 'complete')
                ->where('user_subscriptions.expire_date', '>', now())
                ->value(DB::raw('CASE 
                    WHEN title LIKE "%PREMIUM%" THEN 2
                    WHEN title LIKE "%PROFESSIONAL%" THEN 2
                    WHEN title LIKE "%PRO%" THEN 1
                    ELSE 0 
                END'));
            $project_details->is_emergency = ($project_details->is_emergency == 1 && ($sub_rank ?? 0) > 0) ? 1 : 0;
        }



        if(!empty($project_details)){
//            $freelancerLevelData = freelancer_level_api($project_details->user_id) ?? '';
//
//            $levelImageId = $freelancerLevelData['image_id'] ?? null;
//            $imgUrl = get_attachment_image_by_id($levelImageId);

            $is_promoted = false;
            if (moduleExists('PromoteFreelancer') && class_exists('Modules\PromoteFreelancer\Entities\PromotionProjectList')) {
                $is_promoted = \Modules\PromoteFreelancer\Entities\PromotionProjectList::where('identity', $project_details->user_id)
                    ->where('type', 'profile')
                    ->where('expire_date', '>', now())
                    ->where('payment_status', 'complete')
                    ->first();
            }

            $views_count = \Illuminate\Support\Facades\DB::table('project_views')
                ->where('project_id', $id)
                ->where('created_at', '>=', now()->subMinutes(15))
                ->distinct('ip_address')
                ->count('ip_address');

            return response()->json([
                'project_details' => $project_details,
                'project_file_path' => asset('assets/uploads/project/'),
                'freelancer_title' => $project_details?->project_creator?->user_introduction?->title,
                'country' => $project_details?->project_creator?->user_country?->country,
                'state' => $project_details?->project_creator?->user_state?->state,
                'complete_orders_count' => $complete_orders_count,
                'rating' => !empty($avg_rating) ? $avg_rating : ($project_details->ratings_avg_rating ?? ''),
                'freelancer_avg_rating' => round($freel_avg_rating,1),
                'freelancer_total_rating' => $freel_rating_count,
                'chat_info' => $chat_id,
                'storage_driver' => Storage::getDefaultDriver() ?? '',
                'freelancer_level' => freelancer_level_api($project_details->user_id) ?? '',
                'is_profile_promoted'=> !empty($is_promoted) ? true : false,
                'views_count' => $views_count,
            ]);
        }
        return response()->json(['msg' => __('no projects found.')]);
    }
}