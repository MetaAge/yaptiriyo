@extends('frontend.new_design.layout.new_master')
@section('meta_title')
    {{ __(render_page_meta_data_for_profile_details_title($user)) }}
@endsection
@section('meta_description')
@endsection
@section('site_title')
    @yield('meta_title')
@endsection
@section('style')
    @include('frontend.profile-details.style')
@endsection
@section('content')
    <main>
        <!-- Breadcrumb -->
        <x-breadcrumb.user-profile-breadcrumb-02 :innerTitle="__('Talent Details')" />
        <!-- Main section -->
        <div class="flex flex-col lg:flex-row gap-8 max-w-7xl mx-auto py-10 md:py-20 lg:py-[120px] px-6">
            <!-- Left Section -->
            <section class="flex-1 min-w-0 space-y-6">
                <!-- Profile Section -->
                <section class="mb-8">
                    <div class="flex items-center gap-4">
                        <div class="relative">
                            @if($user->image)
                                @if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi']))
                                    <img src="{{ render_frontend_cloud_image_if_module_exists( 'profile/'. $user->image, load_from: $user->load_from) }}" alt="{{ $user->first_name .' '.$user->last_name }}" class="w-20 h-20 rounded-full object-cover">
                                @else
                                    <img src="{{ asset('assets/uploads/profile/'.$user->image) }}" alt="{{ $user->first_name .' '.$user->last_name }}" class="w-20 h-20 rounded-full object-cover">
                                @endif
                            @else
                                <img src="{{ asset('assets/static/img/author/author.jpg') }}" alt="{{ __('AuthorImg') }}" class="w-20 h-20 rounded-full object-cover">
                            @endif
                            @if(Cache::has('user_is_online_' . $user->id))
                                <div class="absolute w-5 h-5 bg-green-500 border-3 border-white rounded-full right-0 bottom-0"></div>
                            @endif
                        </div>
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-sm text-gray-500">{{ optional($user->user_introduction)->title ?? '' }}</span>
                                @if($user->user_verified_status == 1)
                                    <i class="fa-solid fa-circle-check text-blue-500 text-xs" title="{{ __('Verified') }}"></i>
                                @endif
                            </div>

                            <div class="flex flex-wrap items-center gap-2 mb-2">
                                <h1 class="text-2xl font-medium text-base-300">{{ $user->first_name .' '.$user->last_name }}</h1>
                                @if(is_pro_user($user->id))
                                    <span class="bg-blue-600 text-white text-[10px] font-bold px-2 py-0.5 rounded flex items-center gap-1 shadow-sm uppercase tracking-wider">
                                        <i class="fa-solid fa-certificate"></i> {{ __('Onaylı Usta') }}
                                    </span>
                                @endif
                                @if(is_premium_user($user->id))
                                    <span class="bg-amber-500 text-white text-[10px] font-bold px-2 py-0.5 rounded flex items-center gap-1 shadow-sm uppercase tracking-wider">
                                        <i class="fa-solid fa-crown"></i> {{ __('Premium') }}
                                    </span>
                                @endif
                                @if(moduleExists('FreelancerLevel'))
                                    <div class="bg-primary rounded-full w-6 h-6 flex items-center justify-center p-1" title="{{ __('Level') }} • {{ freelancer_level($user->id) }}">
                                        <i class="icon-base ti tabler-crown icon-18px text-white font-medium"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="items-center md:gap-2 text-sm text-gray-500 divide-x divide-gray-300 hidden sm:flex">
                                @if($user?->user_country?->country)
                                    <div class="flex items-center gap-1 pr-2 md:pr-4">
                                        <i class="icon-base ti tabler-map-pin icon-18px text-base-400 font-medium"></i>
                                        <span>{{ optional($user->user_country)->country }}</span>
                                    </div>
                                @endif

                                @if($user->service_areas->count() > 0)
                                    <div class="flex items-center gap-1 px-2 md:px-4 border-l border-gray-300">
                                        <i class="fa-solid fa-truck-fast text-base-400"></i>
                                        <span class="text-xs font-medium text-base-300">
                                            {{ $user->service_areas->take(3)->map(fn($a) => optional($a->city)->city)->filter()->implode(', ') }}
                                            @if($user->service_areas->count() > 3) ... @endif
                                        </span>
                                    </div>
                                @endif

                                @if($user->service_areas->count() > 0)
                                    <div class="flex items-center gap-1 px-2 md:px-4 border-l border-gray-300">
                                        <i class="fa-solid fa-truck-fast text-base-400"></i>
                                        <span class="text-xs text-gray-500">{{ __('Hizmet Bölgeleri:') }}</span>
                                        <span class="text-xs font-medium text-base-300">
                                            {{ $user->service_areas->take(5)->map(fn($a) => optional($a->city)->city)->filter()->implode(', ') }}
                                            @if($user->service_areas->count() > 5) ... @endif
                                        </span>
                                    </div>
                                @endif

                                <div class="flex items-center gap-1 px-2 md:px-4 border-l border-gray-300">
                                    <i class="fa-solid fa-star text-amber-400"></i>
                                    <span class="font-medium text-base-300">
                                     {{ number_format($user->freelancer_ratings_avg_rating ?? 0, 1) }}
                                       </span>
                                    <span>({{ $complete_orders_in_total ?? 0 }} {{ __('Reviews') }})</span>
                                </div>

                                @if($user->completed_orders_count > 0)
                                    <div class="flex items-center gap-1 px-2 md:px-4 border-l border-gray-300">
                                        <i class="fa-solid fa-briefcase text-base-400"></i>
                                        <span class="font-medium text-base-300">{{ $user->completed_orders_count }} {{ __('Jobs Done') }}</span>
                                    </div>
                                @endif

                                @if(moduleExists('FreelancerLevel'))
                                    <div class="flex items-center gap-1 pl-2 md:pl-6">
                                        <span>{{ __('Level') }} • {{ freelancer_level($user->id) }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center md:gap-2 text-sm text-gray-500 divide-x divide-gray-300 mt-4 sm:hidden">
                        @if($user?->user_country?->country)
                            <div class="flex items-center gap-1 pr-2 md:pr-4">
                                <i class="icon-base ti tabler-map-pin icon-18px text-base-400 font-medium"></i>
                                <span>{{ optional($user->user_country)->country }}</span>
                            </div>
                        @endif

                        <div class="flex items-center gap-1 px-2 md:px-4">
                            <i class="fa-solid fa-star text-amber-400"></i>
                            <span class="font-medium text-base-300">
                             {{ number_format($user->freelancer_ratings_avg_rating ?? 0, 1) }}
                               </span>
                            <span>({{ $complete_orders_in_total ?? 0 }} {{ __('Reviews') }})</span>
                        </div>

                        @if(moduleExists('FreelancerLevel'))
                            <div class="flex items-center gap-1 pl-2 md:pl-6">
                                <span>{{ __('Level') }} • {{ freelancer_level($user->id) }}</span>
                            </div>
                        @endif
                    </div>

                    @php
                        $isOwnProfile = Auth::guard('web')->check() &&
                                       Auth::guard('web')->user()->user_type == 2 &&
                                       Auth::guard('web')->user()->username == $username;
                    @endphp

                    @if($isOwnProfile)
                        <div class="mt-6 flex flex-wrap gap-3 items-center">
                            <!-- View as Client button -->
                            <div class="change_client_view">
                                <button type="button"
                                        onclick="toggleClientView()"
                                        class="px-4 py-2.5 text-primary border border-primary rounded-lg hover:bg-primary hover:text-white transition-colors duration-200 flex items-center justify-center gap-2 text-sm font-medium min-h-[42px]"
                                        id="clientViewToggleBtn">
                                    <span id="clientViewText">{{ __('View as Client') }}</span>
                                </button>
                            </div>

                            <!-- Edit info button -->
                            <a href="{{ route('freelancer.profile') }}"
                               class="px-4 py-2.5 bg-primary text-white rounded-lg hover:bg-primary/80 active:bg-primary/70 transition-colors duration-200 flex items-center justify-center gap-2 text-sm font-medium min-h-[42px]">
                                {{ __('Edit info') }}
                            </a>

                            @if(moduleExists('PromoteFreelancer'))
                                @php
                                    $current_date = \Carbon\Carbon::now()->toDateTimeString();
                                    $is_promoted = \Modules\PromoteFreelancer\Entities\PromotionProjectList::where('identity',auth()->user()->id)
                                    ->where('type','profile')
                                    ->where('expire_date','>',$current_date)
                                    ->where('payment_status','complete')
                                    ->first();
                                @endphp

                                @if(!empty($is_promoted))
                                    <!-- Profile Promoted button (disabled state) -->
                                    <button type="button"
                                            class="px-4 py-2.5 border border-primary text-primary rounded-lg hover:bg-primary/5 transition-colors duration-200 text-sm font-medium min-h-[42px] cursor-not-allowed"
                                            disabled>
                                        {{ __('Profile Promoted') }}
                                    </button>
                                @else
                                    <!-- Promote Profile button -->
                                    <a href="{{ route('promotion.checkout') }}?project_id=0"
                                       class="px-4 py-2.5 bg-primary text-white rounded-lg hover:bg-primary/80 active:bg-primary/70 transition-colors duration-200 flex items-center justify-center gap-2 text-sm font-medium min-h-[42px]">
                                        {{ __('Promote Profile') }}
                                    </a>
                                @endif
                            @endif
                        </div>
                    @endif
                </section>

                <!-- About Me -->
                <section>
                    <h2 class="text-xl font-medium text-base-300 mb-2">{{ __('About Me') }}</h2>
                    @if($user?->user_introduction?->description)
                        <p class="text-base-400 leading-relaxed text-sm">
                            {{ optional($user->user_introduction)->description ?? '' }}
                        </p>
                    @else
                        <p class="text-base-400 leading-relaxed text-sm">
                            {{ __('No description provided.') }}
                        </p>
                    @endif
                </section>

                <!-- Skills -->
                <section>
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-medium text-base-300">{{ __('Skills') }}</h2>
                    </div>

                    <div class="freelancer_skill_list">
                        @php
                            $array_skill = explode(',', $skills);
                            $array_length = count($array_skill);

                            // Define how many skills to show initially
                            $initial_skills_count = 6; // You can change this number
                            $show_more_button = $array_length > $initial_skills_count;
                        @endphp

                        @if($array_length > 1)
                            <!-- Visible skills section -->
                            <div class="flex flex-wrap gap-3" id="visible-skills">
                                @for ($i = 0; $i < min($initial_skills_count, $array_length); $i++)
                                    <a href="{{ route('talents.all') }}?skill={{ urlencode($array_skill[$i]) }}"
                                       class="skill-link px-4 py-1 border border-gray-200 rounded-full text-sm text-base-400 hover:border-primary hover:text-primary transition cursor-pointer">
                                        {{ $array_skill[$i] }}
                                    </a>
                                @endfor
                            </div>

                            <!-- Hidden skills section (initially hidden) -->
                            @if($show_more_button)
                                <div class="flex flex-wrap gap-3 mt-3 hidden" id="hidden-skills">
                                    @for ($i = $initial_skills_count; $i < $array_length; $i++)
                                        <a href="{{ route('talents.all') }}?skill={{ urlencode($array_skill[$i]) }}"
                                           class="skill-link px-4 py-1 border border-gray-200 rounded-full text-sm text-base-400 hover:border-primary hover:text-primary transition cursor-pointer">
                                            {{ $array_skill[$i] }}
                                        </a>
                                    @endfor
                                </div>

                                <!-- Show More/Less button -->
                                <div class="mt-4">
                                    <button type="button" id="toggle-skills-btn"
                                            class="text-primary hover:text-primary/80 font-medium text-sm flex items-center gap-1 transition-colors">
                                        <span id="toggle-skills-text">{{ __('Show More') }}</span>
                                        <i class="icon-base ti tabler-chevron-down icon-16px" id="toggle-skills-icon"></i>
                                    </button>
                                </div>
                            @endif
                        @else
                            <p class="text-base-400">{{ __('No skills added yet.') }}</p>
                        @endif
                    </div>

                    <!-- Edit Skill Wrapper (hidden by default) -->
                    <div class="edit_skill_wrapper hidden mt-4">
                        <div class="setup-wrapper-skill">
                            <p class="setup-wrapper-skill-para text-sm text-base-400 mb-4">
                                {{ __('Type and hit Enter to add a skill or choose from suggestions below') }}
                            </p>

                            <div class="setup-wrapper-skill-tagInputs">
                                <input type="text" id="skill_input" placeholder="{{ __('Select tags') }}" class="w-full p-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                        </div>

                        @if($skills_according_to_category)
                            <h6 class="setup-wrapper-experience-details-subtitle mt-6 mb-3 text-base font-medium text-base-300">{{ __('Suggested Skill') }}</h6>
                            <div class="max-h-40 overflow-y-auto pr-2">
                                <div class="flex flex-wrap gap-3">
                                    @foreach ($skills_according_to_category as $skill)
                                        @if (!in_array($skill->skill, $array_skill))
                                            <span class="choose_skill px-4 py-1 border border-gray-200 rounded-full text-sm text-base-400 hover:border-primary hover:text-primary transition cursor-pointer">
                                {{ $skill->skill }}
                            </span>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="btn-wrapper flex justify-end gap-3 mt-6">
                            <button type="button" class="cancel_edit_skill px-4 py-2 border border-gray-300 text-gray-600 rounded-lg hover:border-gray-400 transition">
                                {{ __('Cancel') }}
                            </button>
                            <button type="button" class="update_freelancer_skill px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition">
                                {{ __('Update Skills') }}
                            </button>
                        </div>
                    </div>
                </section>

                <button id="more-about-btn" class="mt-6 px-4 text-primary border py-1 rounded-lg hover:text-primary/90 hover:border-primary transition mb-4 flex items-center justify-center gap-2 text-sm">
                    {{ __('More About Me') }}
                </button>


                <!-- Hidden Sections (Education, Work Experience, Achievements) -->
                <div id="hidden-sections" class="space-y-6 hidden">
                    <!-- Education -->
                    <section>
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-medium text-base-300">{{ __(get_static_option('education_inner_title')) ?? __('Education') }}</h2>
                        </div>

                        <div id="display_user_education_data" class="space-y-4">
                            @foreach($educations as $education)
                                <div class="border border-gray-200 rounded-2xl p-6">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <h3 class="font-medium text-base-300 mb-1">{{ $education->subject }}</h3>
                                            <p class="text-sm text-gray-500">{{ $education->institution }}</p>
                                        </div>
                                    </div>

                                    <hr class="border-gray-100 mb-4">

                                    <div class="space-y-3">
                                        <div class="flex justify-between items-center text-sm">
                                            <div class="flex items-center gap-2">
                                                <i class="fa-solid fa-graduation-cap text-base-400/90"></i>
                                                <span class="text-base-400">{{ __('Degree') }}</span>
                                            </div>
                                            <span class="text-base-400">{{ $education->degree }}</span>
                                        </div>

                                        <div class="flex justify-between items-center text-sm">
                                            <div class="flex items-center gap-2">
                                                <i class="fa-regular fa-calendar text-base-400/90"></i>
                                                <span class="text-base-400">{{ __('From - To') }}</span>
                                            </div>
                                            <span class="text-base-300">
                                                {{ Carbon\Carbon::parse($education->start_date)->toFormattedDateString() }} -
                                                @if($education->end_date)
                                                    {{ Carbon\Carbon::parse($education->end_date)->toFormattedDateString() }}
                                                @else
                                                    <span class="text-primary">({{ __('Expected') }})</span>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @if($educations->count() == 0)
                                <div class="border border-gray-200 rounded-2xl p-6 text-center">
                                    <p class="text-base-400">{{ __('No education added yet.') }}</p>
                                </div>
                            @endif
                        </div>
                    </section>

                    <!-- Work Experience -->
                    <section>
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-medium text-base-300">{{ __(get_static_option('experience_inner_title')) ?? __('Experiences') }}</h2>
                        </div>

                        <div id="display_user_experience_data" class="space-y-4">
                            @foreach($experiences as $experience)
                                <div class="border border-gray-200 rounded-2xl p-6">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <h3 class="font-medium text-base-300 mb-1">{{ $experience->title }}</h3>
                                            <p class="text-sm text-gray-500">{{ $experience->organization }}</p>
                                        </div>
                                    </div>

                                    <hr class="border-gray-100 mb-4">

                                    <div class="space-y-3">
                                        <div class="flex justify-between items-center text-sm">
                                            <div class="flex items-center gap-2">
                                                <i class="fa-regular fa-calendar text-base-400/90"></i>
                                                <span class="text-gray-500">{{ __('Duration') }}</span>
                                            </div>
                                            <span class="text-base-300">
                                                {{ Carbon\Carbon::parse($experience->start_date)->toFormattedDateString() }} -
                                                @if($experience->end_date)
                                                    {{ Carbon\Carbon::parse($experience->end_date)->toFormattedDateString() }}
                                                @else
                                                    <span class="text-primary">{{ __('Current Position') }}</span>
                                                @endif
                                            </span>
                                        </div>

                                        @if($experience->address)
                                            <div class="flex justify-between items-center text-sm">
                                                <div class="flex items-center gap-2">
                                                    <i class="fa-solid fa-location-dot text-base-400/90"></i>
                                                    <span class="text-gray-500">{{ __('Location') }}</span>
                                                </div>
                                                <span class="text-base-400">{{ $experience->address }}</span>
                                            </div>
                                        @endif

                                        @if($experience->short_description)
                                            <div class="mt-3">
                                                <p class="text-sm text-base-400 leading-relaxed">{{ $experience->short_description }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                            @if($experiences->count() == 0)
                                <div class="border border-gray-200 rounded-2xl p-6 text-center">
                                    <p class="text-base-400">{{ __('No work experience added yet.') }}</p>
                                </div>
                            @endif
                        </div>
                    </section>

                    <!-- Achievements -->
                    <section>
                        <h2 class="text-xl font-medium text-base-300 mb-4">{{ __('Achievements') }}</h2>
                        <div class="border border-gray-200 rounded-2xl p-6 flex flex-col md:flex-row gap-6 justify-between">
                            <!-- Total Earned -->
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center text-gray-600">
                                    <i class="fa-solid fa-dollar-sign"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-base-400 mb-1">{{ __('Total Earned') }}</p>
                                    @php
                                        // Get the user's earning visibility preference from database
                                        $userEarningSetting = optional($user->user_earning)->show_earning ?? 0;

                                        // Check if the current user is viewing their own profile
                                        $isOwnProfile = Auth::guard('web')->check() &&
                                                      Auth::guard('web')->user()->user_type == 2 &&
                                                      Auth::guard('web')->user()->username == $username;

                                        // Determine if earnings should be shown
                                        $shouldShowEarnings = false;

                                        // Logic:
                                        // 1. If global toggle is disabled, always show
                                        // 2. If viewing own profile, always show
                                        // 3. Otherwise, respect user's setting
                                        if (get_static_option('user_earning_toggle') != 'enable') {
                                            // Global setting disabled - always show earnings
                                            $shouldShowEarnings = true;
                                        } else if ($isOwnProfile) {
                                            // User viewing their own profile - always show earnings
                                            $shouldShowEarnings = true;
                                        } else {
                                            // Other users viewing - check user's preference
                                            $shouldShowEarnings = ($userEarningSetting == 1);
                                        }
                                    @endphp

                                    @if($shouldShowEarnings)
                                        <p class="font-medium text-base-300">{{ float_amount_with_currency_symbol($total_earning->total_earning ?? 0) }}</p>
                                    @else
                                        <p class="font-medium text-base-300">{{ __('Hidden') }}</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Order Completed -->
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-[#E6F7F1] flex items-center justify-center text-primary">
                                    <div class="border-primary w-5 h-5 p-2 flex items-center justify-center border-2 rounded-full">
                                        <i class="fa-solid fa-check text-[12px]"></i>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm text-base-400 mb-1">{{ __('Order Completed') }}</p>
                                    <p class="font-medium text-base-300">{{ $complete_orders_in_total ?? 0 }}</p>
                                </div>
                            </div>

                            <!-- Active Orders -->
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-[#FFF7E4] flex items-center justify-center text-secondary">
                                    <i class="fa-solid fa-rotate"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-base-400 mb-1">{{ __('Active Orders') }}</p>
                                    <p class="font-medium text-base-300">{{ $active_orders_count ?? __('No Active Orders') }}</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <button id="hide-about-btn" class="hidden mt-6 px-4 text-primary border py-1 rounded-lg hover:text-primary/90 hover:border-primary transition mb-4 flex items-center justify-center gap-2 text-sm">
                        {{ __('See less') }}
                    </button>
                </div>

                @if (get_static_option('project_enable_disable') != 'disable')
                    <!-- My Services -->
                    @include('frontend.profile-details.project')

                @endif

                <!-- Portfolio -->
                @include('frontend.profile-details.all-portfolio')

                <!-- Review Section -->
                @if ($complete_orders_in_total >= 1)
                    <section class="pt-6" id="reviews">
                        <!-- Reviews Header -->
                        <h2 class="text-xl lg:text-2xl text-base-300 font-medium mb-4">{{ __('Reviews') }} ({{ $complete_orders_in_total ?? 0 }})</h2>

                        <!-- Review Container -->
                        <!-- Review Container -->
                        <div class="space-y-8">
                            @php $count = 0; @endphp
                            @foreach($complete_orders as $order)
                                @php $rating = $order->rating->first(); @endphp
                                @if($rating)
                                    @php $count++; @endphp
                                    <div class="rounded-2xl border border-[#C4C8CE] p-4 review-item @if($count > 3) hidden @endif">
                                        <!-- Top Section -->
                                        <div class="flex items-center gap-3 border-b pb-4">
                                            @if($order->user?->image)
                                                <img src="{{ asset('assets/uploads/profile/'.$order->user->image) }}" alt="{{ $order->user->fullname }}" class="w-12 h-12 rounded-full object-cover flex-shrink-0">
                                            @else
                                                <img src="{{ asset('assets/static/img/author/author.jpg') }}" alt="{{ $order->user->fullname ?? '' }}" class="w-12 h-12 rounded-full object-cover flex-shrink-0">
                                            @endif
                                            <div>
                                                <h3 class="text-base font-medium text-base-300">{{ $order->user->fullname ?? '' }}</h3>
                                                <p class="text-sm text-gray-600">{{ $order->user?->user_country?->country ?? '' }}</p>
                                            </div>
                                        </div>

                                        <!-- Bottom section -->
                                        <div class="mt-2">
                                            <!-- Rating and time section -->
                                            <div class="flex items-center gap-2">
                                                <div class="flex star-rating">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= floor($rating->rating))
                                                            <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                                                        @elseif($i == ceil($rating->rating) && !is_int($rating->rating))
                                                            <i class="icon-base ti tabler-star-half-filled icon-16px text-amber-400"></i>
                                                        @else
                                                            <i class="icon-base ti tabler-star icon-16px text-gray-300"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <span class="text-2xl text-base-400">•</span>
                                                <span class="text-sm text-base-400">{{ $rating->created_at->diffForHumans() }}</span>
                                            </div>

                                            <!-- Project Title -->
                                            @if($order->project)
                                                <h4 class="font-medium text-base-300 mt-2">{{ $order->project->title }}</h4>
                                            @elseif($order->job)
                                                <h4 class="font-medium text-base-300 mt-2">{{ $order->job->title }}</h4>
                                            @endif

                                            <!-- Review Feedback -->
                                            <p class="text-sm text-base-400 leading-relaxed mt-2">
                                                {{ $rating->review_feedback }}
                                            </p>

                                            <!-- Earning (if visible) -->
                                            @php
                                                // Get the user's earning visibility preference from database
                                                $userEarningSetting = optional($user->user_earning)->show_earning ?? 0;

                                                // Check if the current user is viewing their own profile
                                                $isOwnProfile = Auth::guard('web')->check() &&
                                                              Auth::guard('web')->user()->user_type == 2 &&
                                                              Auth::guard('web')->user()->username == $username;

                                                $shouldShowEarnings = false;


                                                if (get_static_option('user_earning_toggle') != 'enable') {

                                                    $shouldShowEarnings = true;
                                                } else if ($isOwnProfile) {

                                                    $shouldShowEarnings = true;
                                                } else {

                                                    $shouldShowEarnings = ($userEarningSetting == 1);
                                                }
                                            @endphp
                                            @if($shouldShowEarnings)
                                                <div class="mt-3 pt-3 border-t border-gray-100">
                                                    <div class="text-sm">
                                                        <span class="text-gray-500">{{ __('Earned:') }}</span>
                                                        <span class="font-medium text-base-300 ml-1">{{ float_amount_with_currency_symbol($rating->order?->payable_amount) }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <!-- Show All Reviews Button -->
                        @if($complete_orders_in_total > 3)
                            <div class="mt-6">
                                <button type="button" id="toggle-reviews-btn" class="show-all-reviews inline-flex items-center gap-2 text-primary hover:bg-primary group hover:text-white font-medium text-sm border border-primary hover:border-primary/90 px-4 py-2.5 rounded-md transition-colors duration-300">
                                    <span id="toggle-reviews-text">{{ __('Show All Reviews') }}</span>
                                    <i class="icon-base ti tabler-arrow-right icon-16px text-primary -rotate-45 group-hover:text-white" id="toggle-reviews-icon"></i>
                                </button>
                            </div>
                        @endif
                    </section>
                @endif
            </section>

            <!-- Right Section (Sidebar) -->
            @include('frontend.profile-details.sidebar')
        </div>

        <div class="popup-overlay"></div>

        <!-- Add Portfolio Modal -->
        @include('frontend.profile-details.add-portfolio')

        <!-- Edit Portfolio Modal -->
        @include('frontend.profile-details.edit-portfolio')

        <!-- Portfolio Detail View Shell -->
        <div class="popup-fixed change-portfolio-popup">
            <div class="popup-contents">
                <span class="popup-contents-close popup-close"> <i class="fas fa-times"></i> </span>
                <div class="popup-contents-inner"></div>
            </div>
        </div>
    </main>

@endsection

@section('script')
    <x-sweet-alert.sweet-alert2-js />
    <x-select2.select2-js />
    <x-frontend.payment-gateway.gateway-select-js />
    @include('frontend.profile-details.profile-details-js')
@endsection