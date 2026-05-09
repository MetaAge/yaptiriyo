<section>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-medium text-base-300">{{ __('Portfolio') }}</h2>
        @if(Auth::guard('web')->check() &&
            ((Auth::guard('web')->user()->user_type == 2 && Auth::guard('web')->user()->username==$username) ||
             (Auth::guard('web')->user()->user_type == 1 && Auth::guard('web')->user()->username==$username && Session::get('user_role') == 'freelancer')))
            <div class="add-portfolio-click add_portfolio_show_hide cursor-pointer">
                <i class="fas fa-plus text-base-400 hover:text-primary transition"></i>
            </div>
        @endif
    </div>

    <div class="portfolio_details_display">
        @if($portfolios->count() > 0)
            <div class="flex flex-col xl:flex-row gap-8 xl:items-center">
                <!-- Left Image Gallery -->
                @php $firstPortfolio = $portfolios->first(); @endphp
                <div>
                    <div class="rounded-2xl overflow-hidden xl:h-[277px] w-full xl:w-96 flex flex-col gap-4 flex-shrink-0">
                        @if(function_exists('cloudStorageExist') && cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi']))
                            <img src="{{ render_frontend_cloud_image_if_module_exists( 'portfolio/'.$firstPortfolio->image, load_from: $firstPortfolio->load_from) }}"
                                 id="portfolio-main-img"
                                 alt="{{ $firstPortfolio->title }}"
                                 class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset('assets/uploads/portfolio/' . $firstPortfolio->image) }}"
                                 id="portfolio-main-img"
                                 alt="{{ $firstPortfolio->title }}"
                                 class="w-full h-full object-cover">
                        @endif
                    </div>

                    <!-- Thumbnails for mobile -->
                    @if($portfolios->count() > 1)
                        <div class="gap-4 mt-4 flex xl:hidden">
                            @foreach($portfolios->take(3) as $index => $portfolio)
                                @if($index == 0)
                                    <div class="portfolio-thumb w-20 h-20 rounded-lg overflow-hidden border-2 border-primary cursor-pointer"
                                         data-img="{{ cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi']) ? render_frontend_cloud_image_if_module_exists( 'portfolio/'.$portfolio->image, load_from: $portfolio->load_from) : asset('assets/uploads/portfolio/' . $portfolio->image) }}">
                                        @if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi']))
                                            <img src="{{ render_frontend_cloud_image_if_module_exists( 'portfolio/'.$portfolio->image, load_from: $portfolio->load_from) }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover">
                                        @else
                                            <img src="{{ asset('assets/uploads/portfolio/' . $portfolio->image) }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                @else
                                    <div class="portfolio-thumb w-20 h-20 rounded-lg overflow-hidden border border-gray-200 cursor-pointer hover:border-primary transition"
                                         data-img="{{ cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi']) ? render_frontend_cloud_image_if_module_exists( 'portfolio/'.$portfolio->image, load_from: $portfolio->load_from) : asset('assets/uploads/portfolio/' . $portfolio->image) }}">
                                        @if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi']))
                                            <img src="{{ render_frontend_cloud_image_if_module_exists( 'portfolio/'.$portfolio->image, load_from: $portfolio->load_from) }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover">
                                        @else
                                            <img src="{{ asset('assets/uploads/portfolio/' . $portfolio->image) }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                @endif
                            @endforeach

                            @if($portfolios->count() > 3)
                                <div class="w-20 h-20 rounded-lg border border-gray-200 flex items-center justify-center bg-white cursor-pointer hover:border-primary transition">
                                    <div class="text-center">
                                        <span class="font-medium text-base-300 block">{{ $portfolios->count() - 3 }}+</span>
                                        <span class="text-base-400">{{ __('More') }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Right Details -->
                <div class="flex-1">
                    <span class="text-medium text-base-300">{{ $firstPortfolio->created_at->format('F Y') }}</span>
                    <div class="mt-4">
                        <h3 class="text-xl font-semibold text-base-300 mb-2">{{ $firstPortfolio->title }}</h3>
                        <p class="text-base-400 leading-relaxed mb-4">
                            {{ $firstPortfolio->description }}
                        </p>

                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <div class="text-sm text-base-400 mb-1">{{ __('Created') }}</div>
                                <div class="font-medium text-md text-base-300">{{ $firstPortfolio->created_at->toFormattedDateString() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Thumbnails for desktop -->
            @if($portfolios->count() > 1)
                <div class="gap-4 mt-4 hidden xl:flex">
                    @foreach($portfolios->take(3) as $index => $portfolio)
                        @if($index == 0)
                            <div class="portfolio-thumb w-20 h-20 rounded-lg overflow-hidden border-2 border-primary cursor-pointer"
                                 data-img="{{ cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi']) ? render_frontend_cloud_image_if_module_exists( 'portfolio/'.$portfolio->image, load_from: $portfolio->load_from) : asset('assets/uploads/portfolio/' . $portfolio->image) }}">
                                @if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi']))
                                    <img src="{{ render_frontend_cloud_image_if_module_exists( 'portfolio/'.$portfolio->image, load_from: $portfolio->load_from) }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover">
                                @else
                                    <img src="{{ asset('assets/uploads/portfolio/' . $portfolio->image) }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover">
                                @endif
                            </div>
                        @else
                            <div class="portfolio-thumb w-20 h-20 rounded-lg overflow-hidden border border-gray-200 cursor-pointer hover:border-primary transition"
                                 data-img="{{ cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi']) ? render_frontend_cloud_image_if_module_exists( 'portfolio/'.$portfolio->image, load_from: $portfolio->load_from) : asset('assets/uploads/portfolio/' . $portfolio->image) }}">
                                @if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi']))
                                    <img src="{{ render_frontend_cloud_image_if_module_exists( 'portfolio/'.$portfolio->image, load_from: $portfolio->load_from) }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover">
                                @else
                                    <img src="{{ asset('assets/uploads/portfolio/' . $portfolio->image) }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover">
                                @endif
                            </div>
                        @endif
                    @endforeach

                    @if($portfolios->count() > 3)
                        <div class="w-20 h-20 rounded-lg border border-gray-200 flex items-center justify-center bg-white cursor-pointer hover:border-primary transition">
                            <div class="text-center">
                                <span class="font-medium text-base-300 block">{{ $portfolios->count() - 3 }}+</span>
                                <span class="text-base-400">{{ __('More') }}</span>
                            </div>
                        </div>
                    @endif
                </div>
            @endif


        @else
            <div class="border border-gray-200 rounded-2xl p-8 text-center">
                <p class="text-base-400">{{ __('No portfolio items added yet.') }}</p>
            </div>
        @endif
    </div>
</section>