<?php

namespace plugins\WidgetBuilder\Widgets;

use Modules\Service\Entities\Category;
use plugins\PageBuilder\Fields\Number;
use plugins\PageBuilder\Fields\Select;
use plugins\PageBuilder\Fields\Text;
use plugins\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use plugins\WidgetBuilder\WidgetBase;

class ServiceWidget extends WidgetBase
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
        $output .= Select::get([
            'name' => 'order_by',
            'label' => __('Order By'),
            'options' => [
                'id' => __('ID'),
                'created_at' => __('Date'),
            ],
            'value' => $widget_saved_values['order_by'] ?? null,
            'info' => __('set order by')
        ]);
        $output .= Select::get([
            'name' => 'order',
            'label' => __('Order'),
            'options' => [
                'asc' => __('Accessing'),
                'desc' => __('Decreasing'),
            ],
            'value' => $widget_saved_values['order'] ?? null,
            'info' => __('set order')
        ]);
        $output .= Number::get([
            'name' => 'items',
            'label' => __('Items'),
            'value' => $widget_saved_values['items'] ?? null,
            'info' => __('enter how many item you want to show in frontend'),
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
        $order_by = purify_html($settings['order_by'] ?? 'id');
        $IDorDate = purify_html($settings['order'] ?? 'asc');
        $items = purify_html($settings['items'] ?? '');
        $categories = Category::whereHas('projects')->where('status',1)->select('id','category','slug')->orderBy($order_by,$IDorDate)->take($items)->get();
        $category_markup = '';

        foreach ($categories as $cat){
            $category_name = $cat->category;
            $category_slug = route('category.projects',$cat->slug);
            $category_markup.= <<<CATEGORY
        <li><a href="{$category_slug}" class="text-gray-400 hover:text-white transition-colors">{$category_name}</a></li>
CATEGORY;

        }

        return <<<HTML
        <div>
            <h3 class="text-xl font-semibold mb-6">{$title}</h3>
            <ul class="space-y-4">
                {$category_markup}
            </ul>
        </div>
        HTML;
    }

    public function widget_title()
    {
        return __('Services');
    }

}
