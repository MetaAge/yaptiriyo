<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
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
}
