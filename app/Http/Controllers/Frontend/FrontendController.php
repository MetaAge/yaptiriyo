<?php

namespace App\Http\Controllers\Frontend;

use App\Blog;
use App\Http\Controllers\Controller;
use App\Models\StaticOption;
use App\Models\User;
use App\Service;
use Illuminate\Http\Request;
use Modules\Pages\Entities\Page;

class FrontendController extends Controller
{
    public function home_page()
    {
        // Yaptiriyo statik ana sayfa (SEO-dostu). Eski page-builder ana
        // sayfasına dönmek için aşağıdaki iki satırı açman yeterli:
        // $page_details = Page::find(get_static_option('home_page'));
        // return view('frontend.pages.frontend-home', compact('page_details'));

        $top_categories = \Modules\Service\Entities\Category::select(['id', 'category', 'slug'])
            ->where('status', 1)
            ->orderBy('id')
            ->limit(12)
            ->get();

        $featured_projects = \App\Models\Project::with('project_creator:id,first_name,last_name,username')
            ->withCount('ratings')
            ->withAvg('ratings', 'rating')
            ->where('status', 1)
            ->where('project_on_off', '1')
            ->orderByRaw("CASE WHEN is_pro = 'yes' AND pro_expire_date > NOW() THEN 0 ELSE 1 END")
            ->orderByDesc('id')
            ->limit(8)
            ->get();

        return view('frontend.pages.yaptiriyo-home', compact('top_categories', 'featured_projects'));
    }

    public function dynamic_single_page($slug)
    {
        $page_post = Page::where(['slug' => $slug, 'status' => 1])->first();

        $user_details = User::where(['user_type'=> 0,'username' => $slug])->first();
        $preserved_pages = [
            'home_page',
            'service_list_page',
            'blog_page',
        ];

        $static_option = StaticOption::whereIn('option_name', $preserved_pages)->get()->mapWithKeys(function ($item) {
            return [$item->option_name => $item->option_value];
        })->toArray();

        $pages_id_slugs = Page::whereIn('id', array_values($static_option))->get()->mapWithKeys(function ($item) {
            return [$item->id => $item->slug];
        })->toArray();

        if (in_array($slug, $pages_id_slugs) && $slug === $pages_id_slugs[$static_option['home_page']]) {
            return redirect()->route('homepage');
        } elseif (in_array($slug, $pages_id_slugs) && $slug === $pages_id_slugs[$static_option['blog_page']]) {
            $all_blogs = Blog::where('status','publish')->orderBy('id','desc')->paginate(6);
            return view('frontend.pages.blog.blog-static', [
                'all_blogs' => $all_blogs,
                'page_post' => $page_post,
            ]);
        }elseif(!is_null($user_details)){
            // dd('sdfsad');
            return $this->_user_profile($user_details);
        }

        $page_type = 'page';
        if (!is_null($page_post)) {
            return view('frontend.pages.dynamic.dynamic-single', compact(['page_post','page_type']));
        }

        abort(404);
    }

}
