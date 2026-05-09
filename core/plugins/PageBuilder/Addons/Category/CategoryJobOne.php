<?php

namespace plugins\PageBuilder\Addons\Category;

use App\Models\JobPost;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Modules\Service\Entities\Category;
use plugins\PageBuilder\Fields\ColorPicker;
use App\Service;
use plugins\PageBuilder\Fields\Slider;
use plugins\PageBuilder\Fields\Number;
use plugins\PageBuilder\Fields\Text;
use plugins\PageBuilder\PageBuilderBase;
use plugins\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use plugins\PageBuilder\Fields\Select;
use plugins\PageBuilder\Fields\Repeater;
use plugins\PageBuilder\Helpers\RepeaterField;
use plugins\FormBuilder\SanitizeInput;


class CategoryJobOne extends PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home-page/category-job-one.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        // Title field
        $output .= Text::get([
            'name' => 'title',
            'label' => __('Title'),
            'value' => $widget_saved_values['title'] ?? null,
        ]);

        // Button text field
        $output .= Text::get([
            'name' => 'browse_button_text',
            'label' => __('Browse Button Text'),
            'value' => $widget_saved_values['browse_button_text'] ?? __('Browse all categories'),
        ]);

        // Button link field
        $output .= Text::get([
            'name' => 'browse_button_link',
            'label' => __('Browse Button Link'),
            'value' => $widget_saved_values['browse_button_link'] ?? '#',
            'info' => __('Enter URL for browse all categories button'),
        ]);

        // Repeater for custom category data
        $output .= Repeater::get([
            'multi_lang' => false,
            'settings' => $widget_saved_values,
            'id' => 'category_custom_data',
            'fields' => [
                [
                    'type' => RepeaterField::SELECT,
                    'name' => 'category_id',
                    'label' => __('Select Category'),
                    'options' => $this->getCategories(),
                ],
                [
                    'type' => RepeaterField::IMAGE,
                    'name' => 'custom_icon',
                    'label' => __('Custom Icon'),
                ],
                [
                    'type' => RepeaterField::TEXTAREA,
                    'name' => 'custom_subtitle',
                    'label' => __('Custom Subtitle'),
                ],
            ]
        ]);

        // Padding controls
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

        // Background color
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

    /**
     * Get categories for dropdown
     */
    private function getCategories()
    {
        $categories = Category::where('status', 1)->get();
        $options = ['' => __('Select Category')];

        foreach ($categories as $category) {
            $options[$category->id] = $category->category;
        }

        return $options;
    }

    public function frontend_render()
    {
        $settings = $this->get_settings();
        $title = SanitizeInput::esc_html($settings['title'] ?? __('Popular Categories'));
        $browse_button_text = SanitizeInput::esc_html($settings['browse_button_text'] ?? __('Browse all categories'));
        $browse_button_link = SanitizeInput::esc_url($settings['browse_button_link'] ?? '#');
        $padding_top = $settings['padding_top'] ?? 40;
        $padding_bottom = $settings['padding_bottom'] ?? 40;
        $section_bg = $settings['section_bg'] ?? '';
        $custom_data = $settings['category_custom_data'] ?? [];

        // Clean and process repeater data
        $processed_categories = [];

        if (!empty($custom_data['category_id_'])) {
            foreach ($custom_data['category_id_'] as $key => $categoryId) {
                // Skip empty category IDs
                if (empty($categoryId)) {
                    continue;
                }

                // Skip duplicate category IDs
                if (isset($processed_categories[$categoryId])) {
                    continue;
                }

                $processed_categories[$categoryId] = [
                    'icon' => $custom_data['custom_icon_'][$key] ?? null,
                    'subtitle' => $custom_data['custom_subtitle_'][$key] ?? null,
                    'order' => $key // preserve original order
                ];
            }
        }

        // Get categories from database in the correct order
        if (!empty($processed_categories)) {
            $category_ids = array_keys($processed_categories);

            $job_categories = Category::select('id','category','slug')
                ->where('status', 1)
                ->whereHas('jobs')
                ->whereIn('id', $category_ids)
                ->withCount('jobs')
                ->get()
                ->sortBy(function ($category) use ($processed_categories) {
                    return $processed_categories[$category->id]['order'];
                })
                ->values();
        } else {
            $job_categories = collect();
        }

        return $this->renderBlade('categories.category-jobs-one', compact([
            'title',
            'browse_button_text',
            'browse_button_link',
            'padding_top',
            'padding_bottom',
            'section_bg',
            'job_categories',
            'processed_categories'
        ]));
    }

    public function addon_title()
    {
        return __('Category Job: 01');
    }
}