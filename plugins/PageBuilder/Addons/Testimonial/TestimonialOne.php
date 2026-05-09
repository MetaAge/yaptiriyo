<?php


namespace plugins\PageBuilder\Addons\Testimonial;

use App\Models\Feedback;
use plugins\PageBuilder\Fields\ColorPicker;
use plugins\PageBuilder\Fields\Image;
use plugins\PageBuilder\Fields\Number;
use plugins\PageBuilder\Fields\Slider;
use plugins\PageBuilder\Fields\Text;
use plugins\PageBuilder\Fields\Textarea;
use plugins\PageBuilder\Fields\Select;
use plugins\PageBuilder\PageBuilderBase;
use plugins\PageBuilder\Traits\LanguageFallbackForPageBuilder;

class TestimonialOne extends PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home-page/testimonial-one.png';
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
            'info' => __('Use line breaks (Enter key) to create multi-line titles')
        ]);
        $output .= Text::get([
            'name' => 'slider_button_text',
            'label' => __('Slider Button Text'),
            'value' => $widget_saved_values['slider_button_text'] ?? null,
        ]);
        $output .= Number::get([
            'name' => 'items',
            'label' => __('Items'),
            'value' => $widget_saved_values['items'] ?? null,
            'info' => __('enter how many item you want to show in frontend'),
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
            'info' => __('Choose how testimonial should be ordered.'),
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

        $output .= Image::get([
            'name' => 'background_image',
            'label' => __('Background Image (Optional)'),
            'value' => $widget_saved_values['background_image'] ?? null,
            'info' => __('Upload a background image. If provided, it will be used instead of the default SVG pattern.'),
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
        $slider_button_text = $settings['slider_button_text'] ?? null;
        $items = $settings['items'] ?? 10;
        $order_by = $settings['order_by'] ?? 'latest';
        $padding_top = $settings['padding_top'];
        $padding_bottom = $settings['padding_bottom'];
        $section_bg = $settings['section_bg'];
        $background_image = $settings['background_image'] ?? null;

        $query = Feedback::where('status', 1)->whereHas('user');

        // dynamic ordering
        switch ($order_by) {
            case 'oldest':
                $query->orderBy('id', 'asc');
                break;
            case 'latest':
                $query->orderBy('id', 'desc');
                break;
            case 'random':
                $query->inRandomOrder();
                break;
            case 'title_asc':
                $query->orderBy('title', 'asc');
                break;
            case 'title_desc':
                $query->orderBy('title', 'desc');
                break;
            default:
                $query->orderBy('id', 'desc'); // fallback
                break;
        }

        $feedbacks = $query->take($items)->get();

        return $this->renderBlade('testimonial.testimonial-one', compact(
            'title',
            'slider_button_text',
            'padding_top',
            'padding_bottom',
            'section_bg',
            'background_image',
            'feedbacks',
            'items'
        ));
    }


    public function addon_title()
    {
        return __('Testimonial: 01');
    }
}
