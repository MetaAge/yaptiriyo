<section class="w-full py-12 md:py-20 lg:py-[120px] bg-[#F8F9FD] md:min-h-[calc(100vh-139px)] flex items-center justify-center" data-padding-top="{{ $padding_top ?? '' }}" data-padding-bottom="{{ $padding_bottom ?? '' }}">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-12">

        <!-- Left Section -->
        <div class="flex flex-col justify-center">
            <div>
                <h2 class="text-3xl font-medium mb-4">{!! nl2br(e($heading ?? '')) !!}</h2>
                <p class="text-gray-600 text-base leading-relaxed">
                    {{ $contact_form_des ?? '' }}
                </p>
            </div>

            <!-- Contact Details -->
            <div class="space-y-6 mt-8">
                @if(isset($repeater_data['icon_']) && is_array($repeater_data['icon_']))
                    @foreach($repeater_data['icon_'] as $key => $icon)
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="{{ $icon }} text-primary"></i>
                            </div>
                            <div>
                                <h3 class="text-base-300 font-medium mb-1">{{ $repeater_data['title_'][$key] ?? '' }}</h3>
                                <p class="text-gray-600 text-sm">{{ $repeater_data['description_'][$key] ?? '' }}</p>
                            </div>
                        </div>
                        @if(!$loop->last)
                            <hr>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Right Section - Form -->
        <div class="bg-white rounded-lg p-8 shadow-sm">
            <x-validation.error />
            {!! $form_details !!}
        </div>
    </div>
</section>