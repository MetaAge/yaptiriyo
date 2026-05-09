<?php

namespace plugins\PageBuilder\Addons\About;

use plugins\PageBuilder\Fields\IconPicker;
use plugins\PageBuilder\Fields\Image;
use plugins\PageBuilder\Fields\Slider;
use plugins\PageBuilder\Fields\Text;
use plugins\PageBuilder\Fields\Video;
use plugins\PageBuilder\PageBuilderBase;
use plugins\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use plugins\PageBuilder\Fields\ColorPicker;
use plugins\PageBuilder\Fields\Repeater;
use plugins\PageBuilder\Fields\Textarea;
use plugins\PageBuilder\Helpers\RepeaterField;

class WhatWeDo extends PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'about/what-we-do.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= Text::get([
            'name' => 'section_title',
            'label' => __('Title'),
            'value' => $widget_saved_values['section_title'] ?? null,
            'placeholder' => __('Enter title')
        ]);

        $output .= Textarea::get([
            'name' => 'subtitle',
            'label' => __('Subtitle'),
            'value' => $widget_saved_values['subtitle'] ?? null,
            'placeholder' => __('enter short description'),
        ]);

        // Image upload field
        $output .= Image::get([
            'name' => 'image',
            'label' => __('Background Image (Optional)'),
            'value' => $widget_saved_values['image'] ?? null,
            'info' => __('Upload an image or use video below')
        ]);

        // Video upload field using the Video field class
        $output .= Video::get([
            'name' => 'video_file',
            'label' => __('Video File'),
            'value' => $widget_saved_values['video_file'] ?? null,
            'dimensions' => __('MP4 format recommended, 16:7 aspect ratio')
        ]);

        // Repeater for stats
        $output .= Repeater::get([
            'settings' => $widget_saved_values,
            'id' => 'stats',
            'fields' => [
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'title',
                    'label' => __('Stat Title')
                ],
                [
                    'type' => RepeaterField::TEXTAREA,
                    'name' => 'description',
                    'label' => __('Stat Description'),
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
        $title = $settings['section_title'] ?? '';
        $description = $settings['subtitle'] ?? '';
        $image = $settings['image'] ?? '';

        // Get video URL from attachment ID
        $video_file_id = $settings['video_file'] ?? '';
        $video_url = '';
        if (!empty($video_file_id)) {
            $video_data = get_attachment_image_by_id($video_file_id, 'full', false);
            $video_url = $video_data['img_url'] ?? '';
        }

        $repeater_data = $settings['stats'] ?? [];

        $padding_top = $settings['padding_top'] ?? 260;
        $padding_bottom = $settings['padding_bottom'] ?? 190;
        $section_bg = $settings['section_bg'] ?? '';

        return $this->renderBlade('about.what-we-do', compact(
            'title',
            'description',
            'image',
            'video_url',
            'repeater_data',
            'padding_top',
            'padding_bottom',
            'section_bg'
        ));
    }

    public function addon_title()
    {
        return __('About- what we do');
    }
}