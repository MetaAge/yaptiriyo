@props(['title' => '', 'name' => '', 'id' => '', 'class' => '', 'type' => null])

<div class="single-input mt-3">
    @if ($title)
        <label class="label-title">{{ $title }}</label>
    @endif
    <select name="{{ $name }}" id="{{ $id }}" class="{{ $class }}">
        <option value="">{{ __('Select Category') }}</option>
        @foreach ($allCategories = \Modules\Service\Entities\Category::all_categories($type) as $data)
            <option value="{{ $data->id }}">{{ $data->category }}</option>
        @endforeach
    </select>
</div>
