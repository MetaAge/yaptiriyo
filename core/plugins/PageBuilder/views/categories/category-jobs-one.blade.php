@if(get_static_option('job_enable_disable') != 'disable')
    <!-- Popular Categories -->
    <section id="popularCategories" class="container mx-auto max-w-7xl px-6 py-10 md:py-16 lg:py-28">
        <!-- Section Title with button -->
        <div class="flex flex-col lg:flex-row gap-5 items-center justify-between mb-[40px]">
            @if(!empty($title))
                <h2 class="text-4xl text-base-300 font-medium text-center lg:text-left animate-on-scroll">
                    {{ $title }}
                </h2>
            @endif

            <!-- Browse all button -->
            <a href="{{ $browse_button_link }}">
                <button class="text-primary flex font-medium hover:text-base-100 hover:bg-primary transition-all duration-300 border px-4 py-2 rounded-lg border-primary/50 items-center gap-2">
                    {{ $browse_button_text }}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                    </svg>
                </button>
            </a>
        </div>

        <!-- Category Cards Grid -->
        <div id="popularCards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($job_categories as $category)
                @php
                    $customData = $processed_categories[$category->id] ?? null;
                    $customIcon = $customData['icon'] ?? null;
                    $customSubtitle = $customData['subtitle'] ?? null;
                @endphp

                        <!-- Single Category Card -->
                <div class="category-card bg-base-100 border hover:shadow-[0_0_15px_rgba(0,0,0,0.2)] p-6 rounded-lg transition-all duration-300 cursor-pointer">
                    <a href="{{ route('category.jobs', $category->slug) }}" class="block">
                        <!-- Custom Icon - Only show if icon exists -->
                        @if(!empty($customIcon))
                            {!! render_image_markup_by_attachment_id($customIcon, 'p-2 bg-primary/10 rounded-full mb-[12px]', 'w-8 h-8') !!}
                        @endif

                        <!-- Category Name from Database -->
                        <h3 class="text-[18px] font-medium text-base-300 mb-[6px]">
                            {{ $category->category ?? '' }}
                        </h3>

                        <!-- Custom Subtitle -->
                        @if(!empty($customSubtitle))
                            <p class="text-base-400 text-[14px] mb-[12px]">
                                {{ $customSubtitle }}
                            </p>
                        @else
                            <!-- Fallback subtitle -->
                            <p class="text-base-400 text-[14px] mb-[12px]">
                                Various jobs available in this category
                            </p>
                        @endif

                        <!-- Jobs Count from Database -->
                        <a href="{{ route('category.jobs', $category->slug) }}" class="text-base-300 text-sm cursor-pointer hover:underline hover:text-primary">
                            {{ $category->jobs_count ?? 0 }} jobs
                        </a>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
    <!-- Category area end -->
@endif