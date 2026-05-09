@if(moduleExists('PromoteFreelancer'))
    <!-- Top Rated Freelancers - New Design -->
    <section id="topRated" class="bg-[#F8F9FD]" style="background-color:{{$section_bg ?? ''}}">
        <div class="container mx-auto max-w-7xl px-6 py-10 md:py-16 lg:py-28">
            <!-- Section Title with button -->
            <div class="flex flex-col lg:flex-row gap-4 items-center justify-between mb-[40px]">
                @if(!empty($title))
                    <h2 class="text-4xl text-center lg:text-left text-base-300 font-medium animate-on-scroll">
                        {{ $title }}
                    </h2>
                @endif

                <!-- Browse all button -->
                <a href="{{ $browse_button_link }}" class="text-primary flex font-medium hover:text-base-100 hover:bg-primary transition-all duration-300 border px-4 py-2 rounded-lg border-primary/50 items-center gap-2">
                    {{ $browse_button_text }}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                    </svg>
                </a>
            </div>

            <!-- Freelancer Cards Grid -->
            <div id="freelancersCard" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($talents as $talent)
                    @php
                        // Calculate average rating
                        $averageRating = $talent->freelancer_ratings->avg('rating');
                        $totalReviews = $talent->freelancer_ratings->count();

                        // Get location
                        $country = $talent->user_country->country ?? '';
                        $state = $talent->user_state->name ?? '';
                        $location = $state ? $state . ', ' . $country : $country;

                        // Check online status (assuming online if last seen within 5 minutes)
                        $isOnline = false;
                        if ($talent->check_online_status) {
                            $lastSeen = is_string($talent->check_online_status)
                                ? \Carbon\Carbon::parse($talent->check_online_status)
                                : $talent->check_online_status;
                            $isOnline = $lastSeen->diffInMinutes(now()) <= 5;
                        }

                        // Get all skills and flatten them
                        $allSkills = [];
                        foreach ($talent->freelancer_skill as $skill) {
                            $skillList = array_map('trim', explode(',', $skill->skill));
                            $allSkills = array_merge($allSkills, $skillList);
                        }

                        // Limit skills to display (show max 4 skills)
                        $maxSkillsToShow = 4;
                        $displaySkills = array_slice($allSkills, 0, $maxSkillsToShow);
                        $remainingSkillsCount = count($allSkills) - $maxSkillsToShow;

                        // Get experience level
                        $experienceLevel = \App\Models\ExperienceLevel::find($talent->experience_level);

                        // Check if freelancer is currently pro (active promotion)
                        $isProFreelancer = false;
                        if ($talent->is_pro == 'yes' && $talent->pro_expire_date) {
                            $expireDate = is_string($talent->pro_expire_date)
                                ? \Carbon\Carbon::parse($talent->pro_expire_date)
                                : $talent->pro_expire_date;
                            $isProFreelancer = $expireDate->gte(now());
                        }

                        // Check if new freelancer (created less than 7 days ago)
                        $isNewFreelancer = false;
                        if ($talent->created_at) {
                            $createdAt = is_string($talent->created_at)
                                ? \Carbon\Carbon::parse($talent->created_at)
                                : $talent->created_at;
                            $isNewFreelancer = $createdAt->diffInDays(now()) < 7;
                        }
                    @endphp

                            <!-- Freelancer Card -->
                    <div class="card-animate rounded-2xl p-6 w-full border border-[#C4C8CE] bg-white flex flex-col">
                        <!-- Header Section -->
                        <div class="flex items-start gap-4 mb-6">
                            <!-- Profile Image and Status Dot - MAKE CLICKABLE -->
                            <a href="{{ route('freelancer.profile.details', $talent->username) }}" class="relative flex-shrink-0">
                                @if ($talent->image)
                                    @if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi']))
                                        <img src="{{ render_frontend_cloud_image_if_module_exists( 'profile/'. $talent->image, load_from: $talent->load_from) }}"
                                             alt="{{ $talent->first_name }}"
                                             class="w-20 h-20 rounded-full object-cover border border-gray-200 cursor-pointer hover:opacity-90 transition">
                                    @else
                                        <img src="{{ asset('assets/uploads/profile/' . $talent->image) }}"
                                             alt="{{ $talent->first_name }}"
                                             class="w-20 h-20 rounded-full object-cover border border-gray-200 cursor-pointer hover:opacity-90 transition">
                                    @endif
                                @else
                                    <img src="{{ asset('assets/static/img/author/author.jpg') }}"
                                         alt="{{ __('AuthorImg') }}"
                                         class="w-20 h-20 rounded-full object-cover border border-gray-200 cursor-pointer hover:opacity-90 transition">
                                @endif
                                <!-- Online Status Dot -->
                                @if($isOnline)
                                    <div class="absolute bottom-1 right-1 w-4 h-4 bg-green-500 border-2 border-white rounded-full"></div>
                                @else
                                    <div class="absolute bottom-1 right-1 w-4 h-4 bg-gray-400 border-2 border-white rounded-full"></div>
                                @endif
                            </a>

                            <!-- Profile Info -->
                            <div class="flex-grow">
                                <div class="profile-line flex items-center flex-wrap gap-2 mb-2" data-wrap-check>
                                    <!-- Name - MAKE CLICKABLE -->
                                    <a href="{{ route('freelancer.profile.details', $talent->username) }}"
                                       class="name text-xl font-medium text-gray-800 hover:text-primary hover:underline cursor-pointer transition">
                                        {{ $talent->full_name }}
                                    </a>

                                    <!-- Sponsored/Pro Badge -->
                                    @if($isProFreelancer)
                                        <span class="badge text-sm font-medium text-primary bg-primary/10 rounded-full px-2 py-1">
                                            {{ get_static_option('promoted_badge_text', 'Vetted Pro') }}
                                        </span>
                                    @endif

                                    <!-- Verified Badge -->
                                    @if($talent->user_verified_status == 1)
                                        <span class="divider text-gray-400 font-light">|</span>
                                        <i class="fas fa-circle-check text-blue-500"></i>
                                    @endif

                                    <!-- Experience Level -->
                                    @if($experienceLevel)
                                        <span class="divider text-gray-400 font-light">|</span>
                                        <span class="text-sm text-gray-600">{{ $experienceLevel->level }}</span>
                                    @endif

                                    <!-- "New" Badge -->
                                    @if($isNewFreelancer)
                                        <span class="badge text-sm font-medium text-green-600 bg-green-100 rounded-full px-2 py-1">
                                            {{ __('New') }}
                                        </span>
                                    @endif
                                </div>

                                <!-- Rating -->
                                <div class="flex items-start gap-1 mb-2">
                                    @if($averageRating > 0)
                                        <div class="flex text-yellow-400 items-center">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.373 4.225a1 1 0 00.95.691h4.444c.969 0 1.371 1.24.588 1.81l-3.593 2.617a1 1 0 00-.364 1.118l1.373 4.225c.3.921-.755 1.688-1.542 1.118l-3.593-2.617a1 1 0 00-1.176 0l-3.593 2.617c-.787.57-1.842-.197-1.542-1.118l1.373-4.225a1 1 0 00-.364-1.118L2.091 9.653c-.783-.57-.381-1.81.588-1.81h4.444a1 1 0 00.95-.691l1.373-4.225z"></path>
                                            </svg>
                                        </div>
                                        <span class="text-sm font-semibold text-gray-800">
                                            {{ number_format($averageRating, 1) }}
                                        </span>
                                        <span class="text-sm text-gray-500">
                                            ({{ $totalReviews }})
                                        </span>
                                    @else
                                        <span class="text-sm text-gray-500">{{ __('No ratings yet') }}</span>
                                    @endif
                                </div>

                                <!-- Job Title - MAKE CLICKABLE -->
                                <a href="{{ route('freelancer.profile.details', $talent->username) }}"
                                   class="text-sm text-gray-600 line-clamp-2 hover:text-primary hover:underline cursor-pointer transition block">
                                    {{ $talent?->user_introduction?->title ?? '' }}
                                </a>
                            </div>
                        </div>

                        <!-- Skills Section - Fixed Height -->
                        <div class="flex flex-wrap gap-2 mb-6 min-h-[40px] items-center">
                            @if(count($displaySkills) > 0)
                                @foreach($displaySkills as $individualSkill)
                                    <span class="px-2.5 py-1.5 bg-[#ecedefe0] text-base-300 rounded-lg text-[13px] whitespace-nowrap inline-flex items-center justify-center h-[28px]">
                                        {{ $individualSkill }}
                                    </span>
                                @endforeach
                                @if($remainingSkillsCount > 0)
                                    <span class="px-2.5 py-1.5 bg-primary/10 text-primary rounded-lg text-[13px] font-medium inline-flex items-center justify-center h-[28px]">
                                        +{{ $remainingSkillsCount }}
                                    </span>
                                @endif
                            @else
                                <span class="px-2.5 py-1.5 bg-gray-100 text-gray-500 rounded-lg text-[13px] inline-flex items-center justify-center h-[28px]">
                                    {{ __('No skills added') }}
                                </span>
                            @endif
                        </div>

                        <!-- Location and Rate Section -->
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div>
                                <p class="text-sm font-medium text-gray-600 mb-1">{{ __('Location:') }}</p>
                                <p class="text-base-300 text-sm">
                                    {{ $location ?: __('Not specified') }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600 mb-1">{{ __('Rate:') }}</p>
                                <p class="text-base-300 text-sm font-semibold">
                                    @if($talent->hourly_rate)
                                        {{ float_amount_with_currency_symbol($talent->hourly_rate) }} / hr
                                    @else
                                        {{ __('Not specified') }}
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- Call to Action Button -->
                        <div class="mt-auto">
                            <a href="{{ route('freelancer.profile.details', $talent->username) }}"
                               class="text-primary inline-flex font-medium hover:text-base-100 hover:bg-primary transition-all duration-300 border px-4 py-2 rounded-lg border-primary/50 items-center gap-2 w-fit mt-auto">
                                {{ __('View Profile') }}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif