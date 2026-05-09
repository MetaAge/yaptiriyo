<?php

namespace Modules\Blog\Http\Controllers\Frontend;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\BlogPost;
use Modules\Service\Entities\Category;

class BlogController extends Controller
{

    public function blog(Request $request)
    {
        $categoryId = $request->query('category', 'all');

        // Get the base query
        $query = BlogPost::with('category')->latest()->where('status', 1);

        // Apply category filter if not 'all'
        if ($categoryId != 'all') {
            $query->where('category_id', $categoryId);
        }

        $blogs = $query->paginate(10);

        // Add image URLs to each blog
        $blogs->getCollection()->transform(function($blog) {
            $blog->image_url = $blog->image ? asset('storage/' . $blog->image) : null;
            return $blog;
        });

        $categories = Category::select('id','category','status')->where('status',1)->withCount('blogs')->get();

        return view('blog::frontend.blogs.blogs',compact(['blogs','categories', 'categoryId']));
    }

    public function blog_filter(Request $request)
    {
        $category = $request->category;
        if ($category == 'all') {
            $blogs = BlogPost::with('category')->latest()
                ->where('status',1)
                ->get(); // Get all instead of paginate for client-side pagination
        } else {
            $blogs = BlogPost::with('category')->latest()
                ->where('category_id',$category)
                ->where('status',1)
                ->get();
        }

        if ($blogs->count() >= 1) {
            // Return JSON data with proper image URLs
            $blogsData = $blogs->map(function($blog) {
                return [
                    'id' => $blog->id,
                    'title' => $blog->title,
                    'slug' => $blog->slug,
                    'created_at' => $blog->created_at,
                    'image_url' => $blog->image ? asset('storage/' . $blog->image) : null, // Adjust path as needed
                    'category' => $blog->category ? ['category' => $blog->category->category] : null
                ];
            });

            return response()->json([
                'status' => 'success',
                'blogs' => $blogsData
            ]);
        } else {
            return response()->json(['status' => 'nothing']);
        }
    }

    // pagination
    function pagination(Request $request)
    {
        if($request->ajax()){
            $category = $request->category;
            if($category == 'all'){
                $blogs = BlogPost::latest()->where('status',1)->paginate(10);
            }else{
                $blogs = BlogPost::latest()
                    ->where('category_id',$category)
                    ->where('status',1)
                    ->paginate(10);
            }
            return view('blog::frontend.blogs.search-result', compact('blogs'))->render();
        }
    }

    //details
    public function blog_details($slug)
    {
        $blog_details = BlogPost::with('meta_data')->where('slug',$slug)->first();

        if(!$blog_details){
            abort(404); // show 404 page
        }

        $related_blogs = BlogPost::with('category')->where('category_id',$blog_details->category_id)->latest()->take(2)->get();
        $categories = Category::select('id','category','status')->where('status',1)->withCount('blogs')->get();
        $blogs = BlogPost::where('status',1)->paginate(10);
        return view('blog::frontend.blogs.blog-details',compact(['blog_details','related_blogs','categories','blogs']));
    }
}
