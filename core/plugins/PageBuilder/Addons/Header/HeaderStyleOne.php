<?php

namespace plugins\PageBuilder\Addons\Header;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use plugins\PageBuilder\Fields\Text;
use plugins\PageBuilder\Fields\Textarea;
use plugins\PageBuilder\Fields\Image;
use plugins\PageBuilder\Fields\Slider;
use plugins\PageBuilder\Fields\Repeater;
use plugins\PageBuilder\Fields\Switcher;
use plugins\PageBuilder\PageBuilderBase;
use plugins\PageBuilder\Fields\ColorPicker;
use plugins\PageBuilder\Helpers\RepeaterField;
use plugins\PageBuilder\Traits\LanguageFallbackForPageBuilder;

class HeaderStyleOne extends PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home-page/header-one.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= Textarea::get([
            'name' => 'title',
            'label' => __('Title'),
            'value' => $widget_saved_values['title'] ?? null,
        ]);

        $output .= Textarea::get([
            'name' => 'subtitle',
            'label' => __('Subtitle'),
            'value' => $widget_saved_values['subtitle'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'find_work_button_text',
            'label' => __('Find Work Button Text'),
            'value' => $widget_saved_values['find_work_button_text'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'find_work_button_link',
            'label' => __('Find Work Button Link'),
            'value' => $widget_saved_values['find_work_button_link'] ?? null,
        ]);

        // CHANGED: Renamed label to "Find Talent" to match new design (but kept field name for compatibility)
        $output .= Text::get([
            'name' => 'find_project_button_text',
            'label' => __('Find Talent Button Text'),
            'value' => $widget_saved_values['find_project_button_text'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'find_project_button_link',
            'label' => __('Find Talent Button Link'),
            'value' => $widget_saved_values['find_project_button_link'] ?? null,
        ]);

        // KEPT: Top freelancer fields (not removed, kept for backward compatibility)
        $output .= Text::get([
            'name' => 'top_freelancer_of_the_month',
            'label' => __('Top Freelancer of the Month Text'),
            'value' => $widget_saved_values['top_freelancer_of_the_month'] ?? null,
        ]);

        $output .= Switcher::get([
            'name' => 'show_top_freelancer',
            'label' => __('Show Top Freelancer Element'),
            'value' => $widget_saved_values['show_top_freelancer'] ?? 'off',
            'info' => __('Enable or disable the Top Freelancer Element.'),
        ]);

        // NEW: Added search placeholder field
        $output .= Text::get([
            'name' => 'search_placeholder',
            'label' => __('Search Placeholder Text'),
            'value' => $widget_saved_values['search_placeholder'] ?? null,
        ]);

        // NEW: Added repeater for skill tags
        $output .= Repeater::get([
            'settings' => $widget_saved_values,
            'id' => 'skill_tags',
            'fields' => [
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'tag_name',
                    'label' => __('Tag Name')
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'tag_link',
                    'label' => __('Tag Link')
                ],
            ]
        ]);

        // NEW: Added info card fields for the right side
        $output .= Text::get([
            'name' => 'info_card_one_text',
            'label' => __('Info Card One Text'),
            'value' => $widget_saved_values['info_card_one_text'] ?? null,
        ]);

        $output .= Image::get([
            'name' => 'info_card_one_icon',
            'label' => __('Info Card One Icon'),
            'value' => $widget_saved_values['info_card_one_icon'] ?? null,
            'dimensions' => '24x24'
        ]);

        $output .= Text::get([
            'name' => 'info_card_two_text',
            'label' => __('Info Card Two Text'),
            'value' => $widget_saved_values['info_card_two_text'] ?? null,
        ]);

        $output .= Image::get([
            'name' => 'info_card_two_icon',
            'label' => __('Info Card Two Icon'),
            'value' => $widget_saved_values['info_card_two_icon'] ?? null,
            'dimensions' => '24x24'
        ]);

        // CHANGED: Updated image field labels to match new design
        $output .= Image::get([
            'name' => 'slider_image',
            'label' => __('Top Image (Main Hero Image)'),
            'value' => $widget_saved_values['slider_image'] ?? null,
            'dimensions' => '600x700'
        ]);

        $output .= Image::get([
            'name' => 'shape_image_one',
            'label' => __('Background Shape Image'),
            'value' => $widget_saved_values['shape_image_one'] ?? null,
            'dimensions' => '600x700'
        ]);

        // KEPT: shape_image_two field (not removed, kept for backward compatibility)
        $output .= Image::get([
            'name' => 'shape_image_two',
            'label' => __('Shape Image Two'),
            'value' => $widget_saved_values['shape_image_two'] ?? null,
            'dimensions' => '50x53'
        ]);

        $output .= Image::get([
            'name' => 'background_image',
            'label' => __('Section Background Image'),
            'value' => $widget_saved_values['background_image'] ?? null,
            'dimensions' => '1920x1080'
        ]);

        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 80,
            'max' => 500,
        ]);

        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 80,
            'max' => 500,
        ]);

        $output .= ColorPicker::get([
            'name' => 'section_bg',
            'label' => __('Background Color'),
            'value' => $widget_saved_values['section_bg'] ?? null,
            'info' => __('select color you want to show in frontend'),
        ]);

        // KEPT: Trusted by logos repeater (not removed, kept for backward compatibility)
        $output .= Repeater::get([
            'settings' => $widget_saved_values,
            'id' => 'trusted_by',
            'fields' => [
                [
                    'type' => RepeaterField::IMAGE,
                    'name' => 'logo',
                    'label' => __('Logo')
                ],
            ]
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render() : string
    {
        $settings = $this->get_settings();

        $background_image = render_background_image_markup_by_attachment_id($this->setting_item('background_image'));
        $title = $settings['title'] ?? null;
        $subtitle = $settings['subtitle'] ?? null;
        $find_work_button_text = $settings['find_work_button_text'] ?? null;
        $find_work_button_link = $settings['find_work_button_link'] ?? null;
        $find_project_button_text = $settings['find_project_button_text'] ?? null;
        $find_project_button_link = $settings['find_project_button_link'] ?? null;

        // KEPT: Top freelancer variables (not removed)
        $top_freelancer_of_the_month = $settings['top_freelancer_of_the_month'] ?? null;
        $show_top_freelancer = $settings['show_top_freelancer'] ?? 'off';

        // NEW: Added new fields
        $search_placeholder = $settings['search_placeholder'] ?? null;
        $skill_tags = $settings['skill_tags'] ?? [];
        $info_card_one_text = $settings['info_card_one_text'] ?? null;
        $info_card_one_icon = $settings['info_card_one_icon'] ?? null;
        $info_card_two_text = $settings['info_card_two_text'] ?? null;
        $info_card_two_icon = $settings['info_card_two_icon'] ?? null;

        $padding_top = $settings['padding_top'];
        $padding_bottom = $settings['padding_bottom'];
        $section_bg = $settings['section_bg'];

        // KEPT: All image fields including shape_image_two
        $slider_image = $settings['slider_image'] ?? '';
        $shape_image_one = $settings['shape_image_one'] ?? '';
        $shape_image_two = $settings['shape_image_two'] ?? '';

        // KEPT: Trusted by repeater data
        $repeater_data = $settings['trusted_by'] ?? [];

        // KEPT: Top freelancer query (not removed)
        $top_freelancer = User::select('id','first_name','last_name','image')->where('user_type',2)->withCount(['freelancer_orders' => function ($query) {
            $query->where('created_at', '>=', Carbon::now()->subDay(30))->where('status',3);
        }])->orderBy('freelancer_orders_count', 'DESC')
            ->first();

        return $this->renderBlade('header.header-one',compact([
            'section_bg','padding_bottom',
            'padding_top','slider_image',
            'subtitle','title',
            'shape_image_one',
            'shape_image_two',
            'repeater_data',
            'top_freelancer',
            'show_top_freelancer',
            'top_freelancer_of_the_month',
            'find_work_button_text',
            'find_work_button_link',
            'find_project_button_link',
            'find_project_button_text',
            'search_placeholder',
            'skill_tags',
            'info_card_one_text',
            'info_card_one_icon',
            'info_card_two_text',
            'info_card_two_icon',
        ]));
    }

    public function addon_title()
    {
        return __('Header: 01');
    }
}