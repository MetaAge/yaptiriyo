<?php

namespace plugins\PageBuilder\Addons\Project;

use App\Models\JobPost;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use plugins\PageBuilder\Fields\ColorPicker;
use App\Service;
use plugins\PageBuilder\Fields\Slider;
use plugins\PageBuilder\Fields\Number;
use plugins\PageBuilder\Fields\Text;
use plugins\PageBuilder\PageBuilderBase;
use plugins\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use plugins\PageBuilder\Fields\Select;


class LatestProject extends PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home-page/latest-project.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= Text::get([
            'name' => 'title',
            'label' => __('Title'),
            'value' => $widget_saved_values['title'] ?? null,
        ]);

        $output .= Number::get([
            'name' => 'items',
            'label' => __('Items'),
            'value' => $widget_saved_values['items'] ?? null,
            'info' => __('Enter how many items you want to show in frontend.'),
        ]);

        if (moduleExists('PromoteFreelancer')) {
            $output .= Number::get([
                'name' => 'pro_count',
                'label' => __('Pro Items'),
                'value' => $widget_saved_values['pro_count'] ?? null,
                'info' => __('enter how many promoted item you want to show in frontend'),
            ]);
        }

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
            'info' => __('Choose how projects should be ordered.'),
        ]);

        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 40,
            'max' => 500,
        ]);

        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 40,
            'max' => 500,
        ]);

        $output .= ColorPicker::get([
            'name' => 'section_bg',
            'label' => __('Background Color'),
            'value' => $widget_saved_values['section_bg'] ?? null,
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }


    public function frontend_render()
    {
        $settings = $this->get_settings();
        $title = $settings['title'] ?? '';
        $items = $settings['items'] ?? 6;
        $proCount = $settings['pro_count'] ?? 4;
        $order_by = $settings['order_by'] ?? 'latest';
        $padding_top = $settings['padding_top'] ?? '';
        $padding_bottom = $settings['padding_bottom'] ?? '';
        $section_bg = $settings['section_bg'] ?? '';

        // --- Base Query ---
        $baseQuery = Project::select(
            'id',
            'title',
            'slug',
            'user_id',
            'category_id',
            'basic_regular_charge',
            'basic_discount_charge',
            'basic_delivery',
            'description',
            'image',
            'load_from',
            'is_pro',
            'pro_expire_date'
        )
            ->where('project_on_off', '1')
            ->where('status', '1')
            ->whereHas('project_creator')
            ->with([
                'project_creator',
                'ratings' // Add ratings relationship
            ]);

        // --- Pro Projects ---
        $proProjects = collect();
        if (moduleExists('PromoteFreelancer') && $proCount > 0) {
            $proProjects = (clone $baseQuery)
                ->where('is_pro', 'yes')
                ->where('pro_expire_date', '>', now())
                ->inRandomOrder()
                ->take($proCount)
                ->get();

            // Add is_pro_project flag for template
            $proProjects = $proProjects->map(function($project) {
                $project->is_pro_project = true;
                return $project;
            });
        }
        // --- Non-Pro Projects ---
        $nonProCount = $items - $proProjects->count();
        $nonProProjects = collect();

        if ($nonProCount > 0) {
            $nonProQuery = (clone $baseQuery)
                ->where(function ($q) {
                    $q->where('is_pro', '!=', 'yes')
                        ->orWhereNull('is_pro')
                        ->orWhere('pro_expire_date', '<', now());
                });

            switch ($order_by) {
                case 'latest':
                    $nonProQuery->orderBy('id', 'desc');
                    break;
                case 'oldest':
                    $nonProQuery->orderBy('id', 'asc');
                    break;
                case 'title_asc':
                    $nonProQuery->orderBy('title', 'asc');
                    break;
                case 'title_desc':
                    $nonProQuery->orderBy('title', 'desc');
                    break;
                case 'random':
                default:
                    $nonProQuery->inRandomOrder();
                    break;
            }

            $nonProProjects = $nonProQuery->take($nonProCount)->get();
        }

        // --- Merge Pro + NonPro ---
        $top_projects = $proProjects->merge($nonProProjects);

        // Load categories separately for all projects
        $categoryIds = $top_projects->pluck('category_id')->unique()->filter();
        $categories = [];

        if ($categoryIds->isNotEmpty()) {
            $categories = \Modules\Service\Entities\Category::whereIn('id', $categoryIds)
                ->pluck('category', 'id')
                ->toArray();
        }

        // Calculate ratings for each project
        $projectRatings = [];
        foreach ($top_projects as $project) {
            $totalRatings = $project->ratings->count();
            $averageRating = $totalRatings > 0 ? $project->ratings->avg('rating') : 0;

            $projectRatings[$project->id] = [
                'average' => number_format($averageRating, 1),
                'count' => $totalRatings
            ];
        }

        return $this->renderBlade('projects.latest-project', compact(
            'title',
            'items',
            'padding_top',
            'padding_bottom',
            'section_bg',
            'top_projects',
            'categories',
            'projectRatings'
        ));
    }


    public function addon_title()
    {
        return __('Trending Projects');
    }
}