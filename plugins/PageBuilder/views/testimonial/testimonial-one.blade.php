<!-- Testimonials Section -->
@php
    $bg_image_url = asset('assets/static/img/testimonial/testimonial.svg'); // Default
    if (!empty($background_image)) {
        $bg_img_data = get_attachment_image_by_id($background_image, 'full', false);
        if (!empty($bg_img_data['img_url'])) {
            $bg_image_url = $bg_img_data['img_url'];
        }
    }
@endphp

<section
        class="py-10 md:py-16 lg:py-28 bg-center bg-no-repeat bg-contain"
        data-padding-top="{{$padding_top ?? ''}}"
        data-padding-bottom="{{$padding_bottom ?? ''}}"
        style="background-color:{{$section_bg ?? ''}}; background-image: url('{{ $bg_image_url }}');">

    <div class="container mx-auto max-w-7xl px-6">
        <!-- Section Title -->
        <h2 class="mb-[40px] text-4xl text-base-300 font-medium text-center animate-on-scroll">
            {!! nl2br(e($title ?? __('What Freelancers are Thinking About Us'))) !!}
        </h2>

        <!-- Testimonials Cards -->
        <div id="testimonialsCards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($feedbacks as $feedback)
                <!-- Card -->
                <div class="card-animate flex flex-col justify-center items-center bg-white p-6 rounded-xl shadow-[0_0_15px_rgba(0,0,0,0.2)]">
                    <a href="{{ route('freelancer.profile.details', $feedback?->user?->username) }}">
                        @if(!empty($feedback?->user?->image))
                            @if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi']))
                                {{-- CHANGE HERE: Added w-20 h-20 rounded-full classes --}}
                                <img class="mb-2 w-20 h-20 rounded-full object-cover" src="{{ render_frontend_cloud_image_if_module_exists('profile/'.$feedback?->user?->image, load_from: $feedback?->user?->load_from) }}" alt="{{ __('profile img') }}">
                            @else
                                {{-- CHANGE HERE: Added w-20 h-20 rounded-full classes --}}
                                <img class="mb-2 w-20 h-20 rounded-full object-cover" src="{{ asset('assets/uploads/profile/'.$feedback?->user?->image) ?? '' }}" alt="{{ __('profile img') }}">
                            @endif
                        @else
                            {{-- CHANGE HERE: Added w-20 h-20 rounded-full classes --}}
                            <img class="mb-2 w-20 h-20 rounded-full" src="{{ asset('assets/static/img/author/author.jpg') }}" alt="dashboard-logo">
                        @endif
                    </a>
                    <h3 class="text-base-300 font-medium text-[18px]">
                        <a href="{{ route('freelancer.profile.details', $feedback?->user?->username) }}">{{ $feedback?->user?->fullname }}</a>
                    </h3>
                    <p class="mb-6 text-base-300 text-[14px]">{{ $feedback?->user?->user_introduction?->title ?? __('Freelancer') }}</p>
                    <p class="text-center text-base-300 mb-6">{{ $feedback->description }}</p>
                    <img class="border border-base-300/20 p-2 rounded-full" src="{{ asset('assets/frontend/new_design/assets/images/testimonial/quote.svg') }}" alt="quote icon">
                </div>
            @endforeach
        </div>
    </div>
</section>