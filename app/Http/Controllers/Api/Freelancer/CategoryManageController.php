<?php

namespace App\Http\Controllers\Api\Freelancer;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CountryResource;
use Illuminate\Http\Request;
use Modules\CountryManage\Entities\Country;
use Modules\Service\Entities\Category;

class CategoryManageController extends Controller
{
    //get all category
    public function category(Request $request)
    {
        $per_page = min(max((int) ($request->per_page ?? 10), 1), 200);
        if(!empty($request->category)){
            $category_list = Category::with('sub_categories')->select(['id','category'])->where('status',1)
                ->where('category', 'LIKE', "%". strip_tags($request->category) ."%")
                ->paginate($per_page)->withQueryString();
        }else{
            $category_list = Category::select(['id','category'])->with('sub_categories')->where('status',1)->paginate($per_page)->withQueryString();
        }

        if($category_list){
            return CategoryResource::collection($category_list);
        }

        return response()->json([
            'msg'=> __('No category found'),
        ]);

    }

    // get categories with projects
    public function categoriesWithProjects(Request $request)
    {
        $category_list = Category::with('sub_categories')
            ->whereHas('projects', function($q){
                $q->where('project_on_off', '1')
                  ->where('project_approve_request', 1)
                  ->where('status', '1');
            })
            ->select(['id','category','image'])
            ->where('status',1)
            ->paginate(10)
            ->withQueryString();

        if($category_list){
            return CategoryResource::collection($category_list);
        }

        return response()->json([
            'msg'=> __('No category found'),
        ]);
    }
}
