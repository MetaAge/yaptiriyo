@if(get_static_option('job_enable_disable') != 'disable')
    <section class="container mx-auto max-w-7xl px-6"
             data-padding-top="{{$padding_top ?? '40'}}"
             data-padding-bottom="{{$padding_bottom ?? '64'}}"
             style="background-color:{{$section_bg ?? ''}}; padding-top: {{$padding_top ?? '40'}}px; padding-bottom: {{$padding_bottom ?? '64'}}px;">

        <h2 class="text-4xl text-base-300 font-medium mb-[40px] text-center lg:text-left animate-on-scroll">
            {{ $title ?? __('Latest Jobs') }}
        </h2>

        <div id="jobCard" class="{{ $layout_type === 'grid' ? 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6' : 'global-slick-init attraction-slider slider-inner-margin' }}"
             @if($layout_type === 'slider')
                 data-rtl="{{get_user_lang_direction() == 'rtl' ? 'true' : 'false'}}"
             data-appendArrows=".append-jobs"
             data-arrows="true"
             data-infinite="true"
             data-dots="false"
             data-slidesToShow="3"
             data-swipeToSlide="true"
             data-autoplay="false"
             data-autoplaySpeed="2500"
             data-prevArrow='<div class="prev-icon"><i class="fa-solid fa-arrow-left"></i></div>'
             data-nextArrow='<div class="next-icon"><i class="fa-solid fa-arrow-right"></i></div>'
             data-responsive='[{"breakpoint": 1400,"settings": {"slidesToShow": 3}},{"breakpoint": 1200,"settings": {"slidesToShow": 2}},{"breakpoint": 992,"settings": {"slidesToShow": 2}},{"breakpoint": 768, "settings": {"slidesToShow": 1} }]'
                @endif>

            @foreach ($jobs as $job)
                <div class="{{ $layout_type === 'slider' ? 'jobs-item' : '' }}">
                    <div class="card-animate rounded-2xl border border-gray-200 p-6 shadow-sm h-full flex flex-col">

                        <h2 class="text-xl font-semibold text-base-300 mb-4 leading-tight hover:underline cursor-pointer">
                            <a href="{{ route('job.details', ['username' => $job->job_creator?->username, 'slug' => $job->slug]) }}">
                                {{ $job->title }}
                            </a>
                        </h2>

                        <div class="flex items-center gap-3 mb-4">
                            <span class="text-base-300 text-sm">{{ $job->created_at->format('M d, Y') ?? '' }}</span>
                            <span class="w-1.5 h-1.5 bg-orange-400 rounded-full"></span>
                            <span class="text-base-300 font-semibold text-sm">{{ ucfirst($job->level) ?? '' }}</span>
                        </div>

                        <div class="flex items-center gap-4 mb-6">
                            <span class="text-xl font-semibold text-base-300">{{ $job->display_price }}</span>
                            <span class="px-3 py-1 bg-gray-200 text-gray-600 text-sm rounded-full">{{ __(ucfirst($job->type)) }}</span>
                            <span class="text-gray-500 text-sm">{{ __('Posted') }} {{ $job->created_at->diffForHumans() }}</span>
                        </div>

                        <p class="text-base-300 text-[16px] mb-6 leading-relaxed line-clamp-2">
                            {!! Str::limit(strip_tags($job->description), 120) !!}
                        </p>

                        <div class="flex flex-wrap gap-2 mb-6">
                            @foreach ($job->job_skills as $skill)
                                <a href="{{ route('skill.jobs', $skill->id . '-' . skillToSlug($skill->skill)) }}"
                                   class="px-2 py-1 border border-gray-300 text-gray-600 text-xs rounded-full hover:bg-primary/10 transition-colors">
                                    {{ $skill->skill ?? '' }}
                                </a>
                            @endforeach
                        </div>

                        <a href="{{ route('job.details', ['username' => $job->job_creator?->username, 'slug' => $job->slug]) }}"
                           class="flex items-center gap-2 text-primary font-medium text-sm hover:text-secondary transition-colors mt-auto">
                            {{ __('View More') }}
                            <i class="fas fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>
            @endforeach

        </div>

        @if($layout_type === 'slider')
            <div class="append-jobs mt-6"></div>
        @endif

    </section>
@endif