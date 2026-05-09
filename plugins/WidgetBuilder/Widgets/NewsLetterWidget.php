<?php

namespace plugins\WidgetBuilder\Widgets;

use plugins\PageBuilder\Fields\Repeater;
use plugins\PageBuilder\Fields\Text;
use plugins\PageBuilder\Fields\Textarea;
use plugins\PageBuilder\Helpers\RepeaterField;
use plugins\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use plugins\WidgetBuilder\WidgetBase;

class NewsLetterWidget extends WidgetBase
{
    use LanguageFallbackForPageBuilder;

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
        $output .= Textarea::get([
            'name' => 'description',
            'label' => __('Description'),
            'value' => $widget_saved_values['description'] ?? null,
        ]);


        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        $settings = $this->get_settings();
        $title = purify_html($settings['title'] ?? '');
        $description = purify_html($settings['description'] ?? '');
        $csrf_token = csrf_token();

        return <<<HTML
    <div class="newsletter-widget-wrapper">
        <h3 class="text-xl font-semibold mb-6">{$title}</h3>
        <p class="text-gray-400 mb-6 text-sm leading-relaxed">
            {$description}
        </p>
        <form action="#" method="post" class="newsletter_subscribe_from_footer">
            <input type="hidden" name="_token" value="{$csrf_token}">
            <div class="error-message text-red-500 mb-2 text-sm"></div>
            <div class="success-message text-green-500 mb-2 text-sm"></div>
            <div class="relative">
                <input type="email" 
                       name="email" 
                       placeholder="your email address"
                       required
                       class="px-4 py-3 w-full bg-[#242B36] text-[#C4C8CE] border border-[#414E62]/60 focus:outline-none rounded-lg">
                <button type="submit" 
                        title="subscribe"
                        class="subscription_by_email_newsletter absolute right-2 top-1/2 -translate-y-1/2 px-4 py-2 bg-secondary rounded-md hover:bg-gray-600 transition-colors">
                    <i class="fas fa-paper-plane text-white"></i>
                </button>
            </div>
        </form>
    </div>
HTML;
    }

    public function widget_title()
    {
        return __('News Letter');
    }

}
