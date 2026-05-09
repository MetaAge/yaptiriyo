<?php


namespace plugins\PageBuilder\Addons\Job;

use App\Models\JobPost;
use Illuminate\Support\Facades\Auth;
use plugins\PageBuilder\Fields\Text;
use Modules\Service\Entities\Category;
use plugins\PageBuilder\Fields\Number;
use plugins\PageBuilder\Fields\Select;
use plugins\PageBuilder\Fields\Slider;
use plugins\PageBuilder\PageBuilderBase;
use plugins\PageBuilder\Fields\ColorPicker;
use plugins\PageBuilder\Traits\LanguageFallbackForPageBuilder;


class ExploreCategoryJob extends PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home-page/explore-category-job.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();
        $categories = Category::where('status', 1)
            ->pluck('category', 'id')->toArray();


        $output .= Text::get([
            'name' => 'title',
            'label' => __('Title'),
            'value' => $widget_saved_values['title'] ?? null,
            'info' => __('This title will be prefixed with the category name.'),
        ]);

        $output .= Select::get([
            'name' => 'category',
            'label' => __('Select Category'),
            'options' => $categories,
            'value' => $widget_saved_values['category'] ?? null,
            'info' => __('set category')
        ]);

        $output .= Number::get([
            'name' => 'items',
            'label' => __('Items'),
            'value' => $widget_saved_values['items'] ?? null,
            'info' => __('Enter how many items you want to show in frontend. Max 6 for Grid layout.'),
        ]);

        $output .= Select::get([
            'name' => 'order_by',
            'label' => __('Order By'),
            'options' => [
                'latest' => __('Latest First'),
                'oldest' => __('Oldest First'),
                'random' => __('Random'),
                'title_asc' => __('Title A → Z'),
                'title_desc' => __('Title Z → A'),
            ],
            'value' => $widget_saved_values['order_by'] ?? 'latest',
            'info' => __('Choose how jobs should be ordered.'),
        ]);

        $output .= Select::get([
            'name' => 'layout_type',
            'label' => __('Layout Type'),
            'options' => [
                'grid' => __('Grid'),
                'slider' => __('Slider'),
            ],
            'value' => $widget_saved_values['layout_type'] ?? 'slider',
            'info' => __('Choose whether to display jobs in grid or slider layout.'),
        ]);

        $output .= Text::get([
            'name' => 'view_all',
            'label' => __('View All Text'),
            'value' => $widget_saved_values['view_all'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'view_all_link',
            'label' => __('View All Link'),
            'value' => $widget_saved_values['view_all_link'] ?? null,
        ]);

        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 260,
            'max' => 500,
        ]);

        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 190,
            'max' => 500,
        ]);
        $output .= ColorPicker::get([
            'name' => 'section_bg',
            'label' => __('Background Color'),
            'value' => $widget_saved_values['section_bg'] ?? null,
            'info' => __('select color you want to show in frontend'),
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }


    public function frontend_render()
    {
        $settings = $this->get_settings();
        $title =    $settings['title'];
        $items =    $settings['items'] ?? 5;
        $order_by = $settings['order_by'] ?? 'latest';
        $layout_type = $settings['layout_type'] ?? 'slider';
        $category_id = $settings['category'] ?? '';
        $view_all_text = $settings['view_all'] ?? '';
        $view_all_link = $settings['view_all_link'] ?? '';
        $padding_top = $settings['padding_top'] ?? '';
        $padding_bottom = $settings['padding_bottom'] ?? '';
        $section_bg = $settings['section_bg'] ?? '';
        if ($category_id) {
            $category = Category::select('id', 'category', 'status')->where('status', 1)->where('id', $category_id)->first();
        }

        if ($layout_type === 'grid' && $items > 6) {
            $items = 6;
        }

        $query = JobPost::with('job_creator', 'job_skills')
            ->where('on_off', '1')
            ->where('status', '1')
            ->where('category', $category?->id)
            ->where('job_approve_request', '1')
            ->whereHas('job_creator');

        // Apply country restrictions
        $query = $this->applyCountryRestrictions($query);

        switch ($order_by) {
            case 'latest':
                $query->orderBy('id', 'desc');
                break;
            case 'oldest':
                $query->orderBy('id', 'asc');
                break;
            case 'title_asc':
                $query->orderBy('title', 'asc');
                break;
            case 'title_desc':
                $query->orderBy('title', 'desc');
                break;
            case 'random':
            default:
                $query->inRandomOrder();
                break;
        }

        $explore_jobs = $query->take($items)->get();

        return  $this->renderBlade('jobs.explore-category-jobs', compact(['title', 'items', 'category', 'view_all_text', 'view_all_link', 'padding_top', 'padding_bottom', 'section_bg', 'explore_jobs', 'layout_type']));
    }

    public function addon_title()
    {
        return __('Explore Category Job: 01');
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
}
