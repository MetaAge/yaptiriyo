<?php

namespace Modules\PromoteFreelancer\Http\PageBuilder\Promotion;

use App\Models\Project;
use App\Models\User;
use plugins\PageBuilder\Fields\ColorPicker;
use plugins\PageBuilder\Fields\Number;
use plugins\PageBuilder\Fields\Slider;
use plugins\PageBuilder\Fields\Text;
use plugins\PageBuilder\PageBuilderBase;
use plugins\PageBuilder\Traits\LanguageFallbackForPageBuilder;


class ProfilePromotion extends PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home-page/profile-promotion.png';
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

        // NEW FIELD: Browse all button text
        $output .= Text::get([
            'name' => 'browse_button_text',
            'label' => __('Browse Button Text'),
            'value' => $widget_saved_values['browse_button_text'] ?? __('Browse all'),
        ]);

        // NEW FIELD: Browse all button link
        $output .= Text::get([
            'name' => 'browse_button_link',
            'label' => __('Browse Button Link'),
            'value' => $widget_saved_values['browse_button_link'] ?? '#',
        ]);

        $output .= Number::get([
            'name' => 'items',
            'label' => __('Items'),
            'value' => $widget_saved_values['items'] ?? null,
            'info' => __('enter how many item you want to show in frontend'),
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
        $title = $settings['title'];
        $browse_button_text = $settings['browse_button_text'] ?? __('Browse all');
        $browse_button_link = $settings['browse_button_link'] ?? '#';
        $items = $settings['items'] ?? 6;
        $padding_top = $settings['padding_top'];
        $padding_bottom = $settings['padding_bottom'];
        $section_bg = $settings['section_bg'] ?? '';

        $talents = User::select('id', 'username','first_name','last_name','image','country_id','state_id','user_verified_status','load_from','pro_expire_date','is_pro','hourly_rate','check_online_status')
            ->with([
                'user_introduction',
                'freelancer_category',
                'freelancer_skill',
                'user_country',
                'user_state',
                'freelancer_ratings'
            ])
            ->where('user_type','2')
            ->where('is_email_verified',1)
            ->where('is_suspend',0)
            ->where('is_pro','yes')
            ->withCount(['freelancer_orders' => function ($query) {
                $query->where('status',3);
            }])
            ->orderBy('freelancer_orders_count', 'DESC')
            ->take($items)
            ->inRandomOrder()
            ->get();

        return  $this->renderBlade('projects.promoted-profiles',compact([
            'title',
            'browse_button_text',
            'browse_button_link',
            'items',
            'padding_top',
            'padding_bottom',
            'section_bg',
            'talents'
        ]));
    }

    public function addon_title()
    {
        return __('Promotional Profile');
    }
}