<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Support\Facades\Cache;
use Modules\Service\Entities\Category;

/**
 * XML sitemap for search engines: homepage, category pages and every active
 * service (project) page. Cached for an hour to keep it cheap.
 */
class SitemapController extends Controller
{
    public function index()
    {
        $xml = Cache::remember('yaptiriyo_sitemap', 3600, function () {
            $urls = [];

            $urls[] = ['loc' => route('homepage'), 'priority' => '1.0', 'changefreq' => 'daily'];

            // Category pages
            $categories = Category::select(['id', 'slug'])->where('status', 1)->get();
            foreach ($categories as $cat) {
                if (empty($cat->slug)) continue;
                $urls[] = [
                    'loc' => route('category.projects', ['slug' => $cat->slug]),
                    'priority' => '0.9',
                    'changefreq' => 'daily',
                ];
            }

            // Active service pages
            $projects = Project::with('project_creator:id,username')
                ->select(['id', 'user_id', 'slug', 'updated_at'])
                ->where('status', 1)
                ->where('project_on_off', '1')
                ->orderByDesc('id')
                ->limit(5000)
                ->get();

            foreach ($projects as $p) {
                $username = $p->project_creator?->username;
                if (empty($username) || empty($p->slug)) continue;
                $urls[] = [
                    'loc' => route('project.details', ['username' => $username, 'slug' => $p->slug]),
                    'lastmod' => optional($p->updated_at)->toAtomString(),
                    'priority' => '0.8',
                    'changefreq' => 'weekly',
                ];
            }

            $out = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
            $out .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
            foreach ($urls as $u) {
                $out .= "  <url>\n";
                $out .= '    <loc>' . htmlspecialchars($u['loc'], ENT_XML1) . "</loc>\n";
                if (!empty($u['lastmod'])) {
                    $out .= '    <lastmod>' . $u['lastmod'] . "</lastmod>\n";
                }
                $out .= '    <changefreq>' . $u['changefreq'] . "</changefreq>\n";
                $out .= '    <priority>' . $u['priority'] . "</priority>\n";
                $out .= "  </url>\n";
            }
            $out .= '</urlset>';

            return $out;
        });

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
