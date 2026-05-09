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
use plugins\PageBuilder\Fields\Repeater;
use plugins\PageBuilder\PageBuilderBase;
use plugins\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use plugins\PageBuilder\Fields\Select;
use plugins\PageBuilder\Helpers\RepeaterField;
use plugins\FormBuilder\SanitizeInput;


class PopularProjectOne extends PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home-page/popular-project-one.png';
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
            'info' => __('Enter how many items you want to show in frontend. Max 6 for Grid layout.'),
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

        $output .= Select::get([
            'name' => 'layout_type',
            'label' => __('Layout Type'),
            'options' => [
                'grid' => __('Grid'),
                'slider' => __('Slider'),
            ],
            'value' => $widget_saved_values['layout_type'] ?? 'slider',
            'info' => __('Choose whether to display projects in grid or slider layout.'),
        ]);

        // Category Tags Repeater
        $output .= Repeater::get([
            'multi_lang' => false,
            'settings' => $widget_saved_values,
            'id' => 'category_tags',
            'fields' => [
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'tag_text',
                    'label' => __('Tag Text'),
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'tag_url',
                    'label' => __('Tag URL'),
                ],
            ]
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
        $title = $settings['title'] ?? '';
        $items = $settings['items'] ?? 6;
        $proCount = $settings['pro_count'] ?? 4;
        $order_by = $settings['order_by'] ?? 'latest';
        $layout_type = $settings['layout_type'] ?? 'grid';
        $padding_top = $settings['padding_top'] ?? '';
        $padding_bottom = $settings['padding_bottom'] ?? '';
        $section_bg = $settings['section_bg'] ?? '';
        $category_tags_data = $settings['category_tags'] ?? [];

        // Process repeater data
        $category_tags = [];
        if (!empty($category_tags_data['tag_text_'])) {
            foreach ($category_tags_data['tag_text_'] as $key => $tagText) {
                if (!empty($tagText) && !empty($category_tags_data['tag_url_'][$key])) {
                    $category_tags[] = [
                        'tag_text' => SanitizeInput::esc_html($tagText),
                        'tag_url' => SanitizeInput::esc_url($category_tags_data['tag_url_'][$key]),
                    ];
                }
            }
        }

        if ($layout_type === 'grid' && $items > 6) {
            $items = 6;
        }

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
                'project_category',
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
                    $nonProQuery->inRandomOrder();
                    break;
                default:
                    $nonProQuery->orderBy('id', 'desc');
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

        return $this->renderBlade('projects.popular-projects-one', compact(
            'title',
            'items',
            'padding_top',
            'padding_bottom',
            'section_bg',
            'top_projects',
            'categories',
            'projectRatings',
            'layout_type',
            'category_tags'
        ));
    }


    public function addon_title()
    {
        return __('Popular Project: 01');
    }
}