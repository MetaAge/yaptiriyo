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


class CategoryProjectOne extends PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home-page/category-project-one.png';
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
            'name' => 'view_all_button_text',
            'label' => __('View All Button Text'),
            'value' => $widget_saved_values['view_all_button_text'] ?? __('View all services'),
        ]);

        // Button link field
        $output .= Text::get([
            'name' => 'view_all_button_link',
            'label' => __('View All Button Link'),
            'value' => $widget_saved_values['view_all_button_link'] ?? '#',
        ]);

        // Repeater for custom category data with background images
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
                    'name' => 'background_image',
                    'label' => __('Background Image'),
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
        $title = SanitizeInput::esc_html($settings['title'] ?? __('Browse Service by Categories'));
        $view_all_button_text = SanitizeInput::esc_html($settings['view_all_button_text'] ?? __('View all services'));
        $view_all_button_link = SanitizeInput::esc_url($settings['view_all_button_link'] ?? '#');
        $padding_top = $settings['padding_top'] ?? 40;
        $padding_bottom = $settings['padding_bottom'] ?? 40;
        $section_bg = $settings['section_bg'] ?? '';
        $custom_data = $settings['category_custom_data'] ?? [];

        // Clean and process repeater data - Handle trailing underscore
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
                    'background_image' => $custom_data['background_image_'][$key] ?? null,
                    'order' => $key // preserve original order
                ];
            }
        }

        // Get categories from database in the correct order
        if (!empty($processed_categories)) {
            $category_ids = array_keys($processed_categories);

            $project_categories = Category::select('id','category','slug')
                ->where('status', 1)
                ->whereIn('id', $category_ids)
                ->withCount('projects')
                ->get()
                ->sortBy(function ($category) use ($processed_categories) {
                    return $processed_categories[$category->id]['order'];
                })
                ->values();
        } else {
            $project_categories = collect();
        }

        return $this->renderBlade('categories.category-projects-one', compact([
            'title',
            'view_all_button_text',
            'view_all_button_link',
            'padding_top',
            'padding_bottom',
            'section_bg',
            'project_categories',
            'processed_categories'
        ]));
    }

    public function addon_title()
    {
        return __('Category Project: 01 ');
    }
}