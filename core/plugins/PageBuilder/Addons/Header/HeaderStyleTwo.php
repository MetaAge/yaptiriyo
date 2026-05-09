<?php

namespace plugins\PageBuilder\Addons\Header;

use App\Models\Order;
use App\Models\User;
use plugins\PageBuilder\Fields\ColorPicker;
use plugins\PageBuilder\Fields\Image;
use plugins\PageBuilder\Fields\Number;
use plugins\PageBuilder\Fields\Repeater;
use plugins\PageBuilder\Fields\Select;
use plugins\PageBuilder\Fields\Slider;
use plugins\PageBuilder\Fields\Text;
use plugins\PageBuilder\Fields\Textarea;
use plugins\PageBuilder\Fields\Video;
use plugins\PageBuilder\Helpers\RepeaterField;
use plugins\PageBuilder\PageBuilderBase;
use plugins\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use Carbon\Carbon;

class HeaderStyleTwo extends PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home-page/header-two.png';
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
            'name' => 'description',
            'label' => __('Description'),
            'value' => $widget_saved_values['description'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'search_placeholder',
            'label' => __('Search Placeholder'),
            'value' => $widget_saved_values['search_placeholder'] ?? 'Search keywords',
        ]);

        $output .= Text::get([
            'name' => 'user_count_text',
            'label' => __('User Count Text'),
            'value' => $widget_saved_values['user_count_text'] ?? '10k+ job holder get job',
        ]);

        // User Images Repeater
        $output .= Repeater::get([
            'settings' => $widget_saved_values,
            'id' => 'user_images',
            'fields' => [
                [
                    'type' => RepeaterField::IMAGE,
                    'name' => 'user_image',
                    'label' => __('User Image')
                ],
            ],
            'multi_lang' => false
        ]);

        // Video Field - Using the Video field class
        $output .= Video::get([
            'name' => 'video_file',
            'label' => __('Video File'),
            'value' => $widget_saved_values['video_file'] ?? null,
            'dimensions' => 'MP4 format recommended'
        ]);

        // Background Shape
        $output .= Image::get([
            'name' => 'background_shape',
            'label' => __('Background Shape'),
            'value' => $widget_saved_values['background_shape'] ?? null,
        ]);

        // Search Tags Repeater
        $output .= Repeater::get([
            'settings' => $widget_saved_values,
            'id' => 'search_tags',
            'fields' => [
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'tag_text',
                    'label' => __('Tag Text')
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'tag_link',
                    'label' => __('Tag Link')
                ],
            ],
            'multi_lang' => false
        ]);

        // Background Color
        $output .= ColorPicker::get([
            'name' => 'section_bg',
            'label' => __('Background Color'),
            'value' => $widget_saved_values['section_bg'] ?? null,
        ]);

        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 80,
            'max' => 200,
        ]);

        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 80,
            'max' => 200,
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render(): string
    {
        $settings = $this->get_settings();

        $title = $settings['title'] ?? 'Lead Change, Market Needs You';
        $description = $settings['description'] ?? "We make it's easier for talents and businesses to connect and we make it absolutely less charges.";
        $search_placeholder = $settings['search_placeholder'] ?? 'Search keywords';
        $user_count_text = $settings['user_count_text'] ?? '10k+ job holder get job';

        // User images from repeater - Handle the trailing underscore
        $user_images = [];
        if (isset($settings['user_images']['user_image_']) && is_array($settings['user_images']['user_image_'])) {
            foreach ($settings['user_images']['user_image_'] as $index => $image_id) {
                $user_images[] = [
                    'user_image' => $image_id
                ];
            }
        }

        // Video - Get the full attachment data
        $video_file = $settings['video_file'] ?? '';
        $video_url = '';
        if (!empty($video_file)) {
            // Get the video URL using the attachment ID
            $video_data = get_attachment_image_by_id($video_file, 'full', false);
            $video_url = $video_data['img_url'] ?? '';
        }

        // Background shape
        $background_shape = $settings['background_shape'] ?? '';

        // Tags from repeater - Handle the trailing underscore (FIXED)
        $search_tags = [];
        if (isset($settings['search_tags']['tag_text_']) && is_array($settings['search_tags']['tag_text_'])) {
            foreach ($settings['search_tags']['tag_text_'] as $index => $tag) {
                $search_tags[] = [
                    'tag_text' => $tag,
                    'tag_link' => $settings['search_tags']['tag_link_'][$index] ?? '#'
                ];
            }
        }

        // Background color
        $section_bg = $settings['section_bg'] ?? '';

        $padding_top = $settings['padding_top'] ?? 80;
        $padding_bottom = $settings['padding_bottom'] ?? 80;

        return $this->renderBlade('header.header-two', compact(
            'title',
            'description',
            'search_placeholder',
            'user_count_text',
            'user_images',
            'video_url',
            'background_shape',
            'search_tags',
            'section_bg',
            'padding_top',
            'padding_bottom'
        ));
    }

    public function addon_title()
    {
        return __('Header: 02');
    }
}