<?php $__env->startSection('meta_title'); ?>
    <?php echo e(__(render_page_meta_data_for_profile_details_title($user))); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta_description'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site_title'); ?>
    <?php echo $__env->yieldContent('meta_title'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <?php echo $__env->make('frontend.profile-details.style', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <main>
        <!-- Breadcrumb -->
        <?php if (isset($component)) { $__componentOriginal5f19dd716048daf403d00235f9f2d409 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5f19dd716048daf403d00235f9f2d409 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.breadcrumb.user-profile-breadcrumb-02','data' => ['innerTitle' => __('Talent Details')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('breadcrumb.user-profile-breadcrumb-02'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['innerTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Talent Details'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5f19dd716048daf403d00235f9f2d409)): ?>
<?php $attributes = $__attributesOriginal5f19dd716048daf403d00235f9f2d409; ?>
<?php unset($__attributesOriginal5f19dd716048daf403d00235f9f2d409); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5f19dd716048daf403d00235f9f2d409)): ?>
<?php $component = $__componentOriginal5f19dd716048daf403d00235f9f2d409; ?>
<?php unset($__componentOriginal5f19dd716048daf403d00235f9f2d409); ?>
<?php endif; ?>
        <!-- Main section -->
        <div class="flex flex-col lg:flex-row gap-8 max-w-7xl mx-auto py-10 md:py-20 lg:py-[120px] px-6">
            <!-- Left Section -->
            <section class="flex-1 min-w-0 space-y-6">
                <!-- Profile Section -->
                <section class="mb-8">
                    <div class="flex items-center gap-4">
                        <div class="relative">
                            <?php if($user->image): ?>
                                <?php if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])): ?>
                                    <img src="<?php echo e(render_frontend_cloud_image_if_module_exists( 'profile/'. $user->image, load_from: $user->load_from)); ?>" alt="<?php echo e($user->first_name .' '.$user->last_name); ?>" class="w-20 h-20 rounded-full object-cover">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('assets/uploads/profile/'.$user->image)); ?>" alt="<?php echo e($user->first_name .' '.$user->last_name); ?>" class="w-20 h-20 rounded-full object-cover">
                                <?php endif; ?>
                            <?php else: ?>
                                <img src="<?php echo e(asset('assets/static/img/author/author.jpg')); ?>" alt="<?php echo e(__('AuthorImg')); ?>" class="w-20 h-20 rounded-full object-cover">
                            <?php endif; ?>
                            <?php if(Cache::has('user_is_online_' . $user->id)): ?>
                                <div class="absolute w-5 h-5 bg-green-500 border-3 border-white rounded-full right-0 bottom-0"></div>
                            <?php endif; ?>
                        </div>
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-sm text-gray-500"><?php echo e(optional($user->user_introduction)->title ?? ''); ?></span>
                                <?php if($user->user_verified_status == 1): ?>
                                    <i class="fa-solid fa-circle-check text-blue-500 text-xs" title="<?php echo e(__('Verified')); ?>"></i>
                                <?php endif; ?>
                            </div>

                            <div class="flex flex-wrap items-center gap-2 mb-2">
                                <h1 class="text-2xl font-medium text-base-300"><?php echo e($user->first_name .' '.$user->last_name); ?></h1>
                                <?php if(is_pro_user($user->id)): ?>
                                    <span class="bg-blue-600 text-white text-[10px] font-bold px-2 py-0.5 rounded flex items-center gap-1 shadow-sm uppercase tracking-wider">
                                        <i class="fa-solid fa-certificate"></i> <?php echo e(__('Onaylı Usta')); ?>

                                    </span>
                                <?php endif; ?>
                                <?php if(is_premium_user($user->id)): ?>
                                    <span class="bg-amber-500 text-white text-[10px] font-bold px-2 py-0.5 rounded flex items-center gap-1 shadow-sm uppercase tracking-wider">
                                        <i class="fa-solid fa-crown"></i> <?php echo e(__('Premium')); ?>

                                    </span>
                                <?php endif; ?>
                                <?php if(moduleExists('FreelancerLevel')): ?>
                                    <div class="bg-primary rounded-full w-6 h-6 flex items-center justify-center p-1" title="<?php echo e(__('Level')); ?> • <?php echo e(freelancer_level($user->id)); ?>">
                                        <i class="icon-base ti tabler-crown icon-18px text-white font-medium"></i>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="items-center md:gap-2 text-sm text-gray-500 divide-x divide-gray-300 hidden sm:flex">
                                <?php if($user?->user_country?->country): ?>
                                    <div class="flex items-center gap-1 pr-2 md:pr-4">
                                        <i class="icon-base ti tabler-map-pin icon-18px text-base-400 font-medium"></i>
                                        <span><?php echo e(optional($user->user_country)->country); ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if($user->service_areas->count() > 0): ?>
                                    <div class="flex items-center gap-1 px-2 md:px-4 border-l border-gray-300">
                                        <i class="fa-solid fa-truck-fast text-base-400"></i>
                                        <span class="text-xs font-medium text-base-300">
                                            <?php echo e($user->service_areas->take(3)->map(fn($a) => optional($a->city)->city)->filter()->implode(', ')); ?>

                                            <?php if($user->service_areas->count() > 3): ?> ... <?php endif; ?>
                                        </span>
                                    </div>
                                <?php endif; ?>

                                <?php if($user->service_areas->count() > 0): ?>
                                    <div class="flex items-center gap-1 px-2 md:px-4 border-l border-gray-300">
                                        <i class="fa-solid fa-truck-fast text-base-400"></i>
                                        <span class="text-xs text-gray-500"><?php echo e(__('Hizmet Bölgeleri:')); ?></span>
                                        <span class="text-xs font-medium text-base-300">
                                            <?php echo e($user->service_areas->take(5)->map(fn($a) => optional($a->city)->city)->filter()->implode(', ')); ?>

                                            <?php if($user->service_areas->count() > 5): ?> ... <?php endif; ?>
                                        </span>
                                    </div>
                                <?php endif; ?>

                                <div class="flex items-center gap-1 px-2 md:px-4 border-l border-gray-300">
                                    <i class="fa-solid fa-star text-amber-400"></i>
                                    <span class="font-medium text-base-300">
                                     <?php echo e(number_format($user->freelancer_ratings_avg_rating ?? 0, 1)); ?>

                                       </span>
                                    <span>(<?php echo e($complete_orders_in_total ?? 0); ?> <?php echo e(__('Reviews')); ?>)</span>
                                </div>

                                <?php if($user->completed_orders_count > 0): ?>
                                    <div class="flex items-center gap-1 px-2 md:px-4 border-l border-gray-300">
                                        <i class="fa-solid fa-briefcase text-base-400"></i>
                                        <span class="font-medium text-base-300"><?php echo e($user->completed_orders_count); ?> <?php echo e(__('Jobs Done')); ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if(moduleExists('FreelancerLevel')): ?>
                                    <div class="flex items-center gap-1 pl-2 md:pl-6">
                                        <span><?php echo e(__('Level')); ?> • <?php echo e(freelancer_level($user->id)); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center md:gap-2 text-sm text-gray-500 divide-x divide-gray-300 mt-4 sm:hidden">
                        <?php if($user?->user_country?->country): ?>
                            <div class="flex items-center gap-1 pr-2 md:pr-4">
                                <i class="icon-base ti tabler-map-pin icon-18px text-base-400 font-medium"></i>
                                <span><?php echo e(optional($user->user_country)->country); ?></span>
                            </div>
                        <?php endif; ?>

                        <div class="flex items-center gap-1 px-2 md:px-4">
                            <i class="fa-solid fa-star text-amber-400"></i>
                            <span class="font-medium text-base-300">
                             <?php echo e(number_format($user->freelancer_ratings_avg_rating ?? 0, 1)); ?>

                               </span>
                            <span>(<?php echo e($complete_orders_in_total ?? 0); ?> <?php echo e(__('Reviews')); ?>)</span>
                        </div>

                        <?php if(moduleExists('FreelancerLevel')): ?>
                            <div class="flex items-center gap-1 pl-2 md:pl-6">
                                <span><?php echo e(__('Level')); ?> • <?php echo e(freelancer_level($user->id)); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php
                        $isOwnProfile = Auth::guard('web')->check() &&
                                       Auth::guard('web')->user()->user_type == 2 &&
                                       Auth::guard('web')->user()->username == $username;
                    ?>

                    <?php if($isOwnProfile): ?>
                        <div class="mt-6 flex flex-wrap gap-3 items-center">
                            <!-- View as Client button -->
                            <div class="change_client_view">
                                <button type="button"
                                        onclick="toggleClientView()"
                                        class="px-4 py-2.5 text-primary border border-primary rounded-lg hover:bg-primary hover:text-white transition-colors duration-200 flex items-center justify-center gap-2 text-sm font-medium min-h-[42px]"
                                        id="clientViewToggleBtn">
                                    <span id="clientViewText"><?php echo e(__('View as Client')); ?></span>
                                </button>
                            </div>

                            <!-- Edit info button -->
                            <a href="<?php echo e(route('freelancer.profile')); ?>"
                               class="px-4 py-2.5 bg-primary text-white rounded-lg hover:bg-primary/80 active:bg-primary/70 transition-colors duration-200 flex items-center justify-center gap-2 text-sm font-medium min-h-[42px]">
                                <?php echo e(__('Edit info')); ?>

                            </a>

                            <?php if(moduleExists('PromoteFreelancer')): ?>
                                <?php
                                    $current_date = \Carbon\Carbon::now()->toDateTimeString();
                                    $is_promoted = \Modules\PromoteFreelancer\Entities\PromotionProjectList::where('identity',auth()->user()->id)
                                    ->where('type','profile')
                                    ->where('expire_date','>',$current_date)
                                    ->where('payment_status','complete')
                                    ->first();
                                ?>

                                <?php if(!empty($is_promoted)): ?>
                                    <!-- Profile Promoted button (disabled state) -->
                                    <button type="button"
                                            class="px-4 py-2.5 border border-primary text-primary rounded-lg hover:bg-primary/5 transition-colors duration-200 text-sm font-medium min-h-[42px] cursor-not-allowed"
                                            disabled>
                                        <?php echo e(__('Profile Promoted')); ?>

                                    </button>
                                <?php else: ?>
                                    <!-- Promote Profile button -->
                                    <a href="<?php echo e(route('promotion.checkout')); ?>?project_id=0"
                                       class="px-4 py-2.5 bg-primary text-white rounded-lg hover:bg-primary/80 active:bg-primary/70 transition-colors duration-200 flex items-center justify-center gap-2 text-sm font-medium min-h-[42px]">
                                        <?php echo e(__('Promote Profile')); ?>

                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </section>

                <!-- About Me -->
                <section>
                    <h2 class="text-xl font-medium text-base-300 mb-2"><?php echo e(__('About Me')); ?></h2>
                    <?php if($user?->user_introduction?->description): ?>
                        <p class="text-base-400 leading-relaxed text-sm">
                            <?php echo e(optional($user->user_introduction)->description ?? ''); ?>

                        </p>
                    <?php else: ?>
                        <p class="text-base-400 leading-relaxed text-sm">
                            <?php echo e(__('No description provided.')); ?>

                        </p>
                    <?php endif; ?>
                </section>

                <!-- Skills -->
                <section>
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-medium text-base-300"><?php echo e(__('Skills')); ?></h2>
                    </div>

                    <div class="freelancer_skill_list">
                        <?php
                            $array_skill = explode(',', $skills);
                            $array_length = count($array_skill);

                            // Define how many skills to show initially
                            $initial_skills_count = 6; // You can change this number
                            $show_more_button = $array_length > $initial_skills_count;
                        ?>

                        <?php if($array_length > 1): ?>
                            <!-- Visible skills section -->
                            <div class="flex flex-wrap gap-3" id="visible-skills">
                                <?php for($i = 0; $i < min($initial_skills_count, $array_length); $i++): ?>
                                    <a href="<?php echo e(route('talents.all')); ?>?skill=<?php echo e(urlencode($array_skill[$i])); ?>"
                                       class="skill-link px-4 py-1 border border-gray-200 rounded-full text-sm text-base-400 hover:border-primary hover:text-primary transition cursor-pointer">
                                        <?php echo e($array_skill[$i]); ?>

                                    </a>
                                <?php endfor; ?>
                            </div>

                            <!-- Hidden skills section (initially hidden) -->
                            <?php if($show_more_button): ?>
                                <div class="flex flex-wrap gap-3 mt-3 hidden" id="hidden-skills">
                                    <?php for($i = $initial_skills_count; $i < $array_length; $i++): ?>
                                        <a href="<?php echo e(route('talents.all')); ?>?skill=<?php echo e(urlencode($array_skill[$i])); ?>"
                                           class="skill-link px-4 py-1 border border-gray-200 rounded-full text-sm text-base-400 hover:border-primary hover:text-primary transition cursor-pointer">
                                            <?php echo e($array_skill[$i]); ?>

                                        </a>
                                    <?php endfor; ?>
                                </div>

                                <!-- Show More/Less button -->
                                <div class="mt-4">
                                    <button type="button" id="toggle-skills-btn"
                                            class="text-primary hover:text-primary/80 font-medium text-sm flex items-center gap-1 transition-colors">
                                        <span id="toggle-skills-text"><?php echo e(__('Show More')); ?></span>
                                        <i class="icon-base ti tabler-chevron-down icon-16px" id="toggle-skills-icon"></i>
                                    </button>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <p class="text-base-400"><?php echo e(__('No skills added yet.')); ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Edit Skill Wrapper (hidden by default) -->
                    <div class="edit_skill_wrapper hidden mt-4">
                        <div class="setup-wrapper-skill">
                            <p class="setup-wrapper-skill-para text-sm text-base-400 mb-4">
                                <?php echo e(__('Type and hit Enter to add a skill or choose from suggestions below')); ?>

                            </p>

                            <div class="setup-wrapper-skill-tagInputs">
                                <input type="text" id="skill_input" placeholder="<?php echo e(__('Select tags')); ?>" class="w-full p-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                        </div>

                        <?php if($skills_according_to_category): ?>
                            <h6 class="setup-wrapper-experience-details-subtitle mt-6 mb-3 text-base font-medium text-base-300"><?php echo e(__('Suggested Skill')); ?></h6>
                            <div class="max-h-40 overflow-y-auto pr-2">
                                <div class="flex flex-wrap gap-3">
                                    <?php $__currentLoopData = $skills_according_to_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(!in_array($skill->skill, $array_skill)): ?>
                                            <span class="choose_skill px-4 py-1 border border-gray-200 rounded-full text-sm text-base-400 hover:border-primary hover:text-primary transition cursor-pointer">
                                <?php echo e($skill->skill); ?>

                            </span>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="btn-wrapper flex justify-end gap-3 mt-6">
                            <button type="button" class="cancel_edit_skill px-4 py-2 border border-gray-300 text-gray-600 rounded-lg hover:border-gray-400 transition">
                                <?php echo e(__('Cancel')); ?>

                            </button>
                            <button type="button" class="update_freelancer_skill px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition">
                                <?php echo e(__('Update Skills')); ?>

                            </button>
                        </div>
                    </div>
                </section>

                <button id="more-about-btn" class="mt-6 px-4 text-primary border py-1 rounded-lg hover:text-primary/90 hover:border-primary transition mb-4 flex items-center justify-center gap-2 text-sm">
                    <?php echo e(__('More About Me')); ?>

                </button>


                <!-- Hidden Sections (Education, Work Experience, Achievements) -->
                <div id="hidden-sections" class="space-y-6 hidden">
                    <!-- Education -->
                    <section>
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-medium text-base-300"><?php echo e(__(get_static_option('education_inner_title')) ?? __('Education')); ?></h2>
                        </div>

                        <div id="display_user_education_data" class="space-y-4">
                            <?php $__currentLoopData = $educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="border border-gray-200 rounded-2xl p-6">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <h3 class="font-medium text-base-300 mb-1"><?php echo e($education->subject); ?></h3>
                                            <p class="text-sm text-gray-500"><?php echo e($education->institution); ?></p>
                                        </div>
                                    </div>

                                    <hr class="border-gray-100 mb-4">

                                    <div class="space-y-3">
                                        <div class="flex justify-between items-center text-sm">
                                            <div class="flex items-center gap-2">
                                                <i class="fa-solid fa-graduation-cap text-base-400/90"></i>
                                                <span class="text-base-400"><?php echo e(__('Degree')); ?></span>
                                            </div>
                                            <span class="text-base-400"><?php echo e($education->degree); ?></span>
                                        </div>

                                        <div class="flex justify-between items-center text-sm">
                                            <div class="flex items-center gap-2">
                                                <i class="fa-regular fa-calendar text-base-400/90"></i>
                                                <span class="text-base-400"><?php echo e(__('From - To')); ?></span>
                                            </div>
                                            <span class="text-base-300">
                                                <?php echo e(Carbon\Carbon::parse($education->start_date)->toFormattedDateString()); ?> -
                                                <?php if($education->end_date): ?>
                                                    <?php echo e(Carbon\Carbon::parse($education->end_date)->toFormattedDateString()); ?>

                                                <?php else: ?>
                                                    <span class="text-primary">(<?php echo e(__('Expected')); ?>)</span>
                                                <?php endif; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php if($educations->count() == 0): ?>
                                <div class="border border-gray-200 rounded-2xl p-6 text-center">
                                    <p class="text-base-400"><?php echo e(__('No education added yet.')); ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </section>

                    <!-- Work Experience -->
                    <section>
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-medium text-base-300"><?php echo e(__(get_static_option('experience_inner_title')) ?? __('Experiences')); ?></h2>
                        </div>

                        <div id="display_user_experience_data" class="space-y-4">
                            <?php $__currentLoopData = $experiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $experience): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="border border-gray-200 rounded-2xl p-6">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <h3 class="font-medium text-base-300 mb-1"><?php echo e($experience->title); ?></h3>
                                            <p class="text-sm text-gray-500"><?php echo e($experience->organization); ?></p>
                                        </div>
                                    </div>

                                    <hr class="border-gray-100 mb-4">

                                    <div class="space-y-3">
                                        <div class="flex justify-between items-center text-sm">
                                            <div class="flex items-center gap-2">
                                                <i class="fa-regular fa-calendar text-base-400/90"></i>
                                                <span class="text-gray-500"><?php echo e(__('Duration')); ?></span>
                                            </div>
                                            <span class="text-base-300">
                                                <?php echo e(Carbon\Carbon::parse($experience->start_date)->toFormattedDateString()); ?> -
                                                <?php if($experience->end_date): ?>
                                                    <?php echo e(Carbon\Carbon::parse($experience->end_date)->toFormattedDateString()); ?>

                                                <?php else: ?>
                                                    <span class="text-primary"><?php echo e(__('Current Position')); ?></span>
                                                <?php endif; ?>
                                            </span>
                                        </div>

                                        <?php if($experience->address): ?>
                                            <div class="flex justify-between items-center text-sm">
                                                <div class="flex items-center gap-2">
                                                    <i class="fa-solid fa-location-dot text-base-400/90"></i>
                                                    <span class="text-gray-500"><?php echo e(__('Location')); ?></span>
                                                </div>
                                                <span class="text-base-400"><?php echo e($experience->address); ?></span>
                                            </div>
                                        <?php endif; ?>

                                        <?php if($experience->short_description): ?>
                                            <div class="mt-3">
                                                <p class="text-sm text-base-400 leading-relaxed"><?php echo e($experience->short_description); ?></p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php if($experiences->count() == 0): ?>
                                <div class="border border-gray-200 rounded-2xl p-6 text-center">
                                    <p class="text-base-400"><?php echo e(__('No work experience added yet.')); ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </section>

                    <!-- Achievements -->
                    <section>
                        <h2 class="text-xl font-medium text-base-300 mb-4"><?php echo e(__('Achievements')); ?></h2>
                        <div class="border border-gray-200 rounded-2xl p-6 flex flex-col md:flex-row gap-6 justify-between">
                            <!-- Total Earned -->
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center text-gray-600">
                                    <i class="fa-solid fa-dollar-sign"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-base-400 mb-1"><?php echo e(__('Total Earned')); ?></p>
                                    <?php
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
                                    ?>

                                    <?php if($shouldShowEarnings): ?>
                                        <p class="font-medium text-base-300"><?php echo e(float_amount_with_currency_symbol($total_earning->total_earning ?? 0)); ?></p>
                                    <?php else: ?>
                                        <p class="font-medium text-base-300"><?php echo e(__('Hidden')); ?></p>
                                    <?php endif; ?>
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
                                    <p class="text-sm text-base-400 mb-1"><?php echo e(__('Order Completed')); ?></p>
                                    <p class="font-medium text-base-300"><?php echo e($complete_orders_in_total ?? 0); ?></p>
                                </div>
                            </div>

                            <!-- Active Orders -->
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-[#FFF7E4] flex items-center justify-center text-secondary">
                                    <i class="fa-solid fa-rotate"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-base-400 mb-1"><?php echo e(__('Active Orders')); ?></p>
                                    <p class="font-medium text-base-300"><?php echo e($active_orders_count ?? __('No Active Orders')); ?></p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <button id="hide-about-btn" class="hidden mt-6 px-4 text-primary border py-1 rounded-lg hover:text-primary/90 hover:border-primary transition mb-4 flex items-center justify-center gap-2 text-sm">
                        <?php echo e(__('See less')); ?>

                    </button>
                </div>

                <?php if(get_static_option('project_enable_disable') != 'disable'): ?>
                    <!-- My Services -->
                    <?php echo $__env->make('frontend.profile-details.project', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                <?php endif; ?>

                <!-- Portfolio -->
                <?php echo $__env->make('frontend.profile-details.all-portfolio', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                
                <?php
                    $usta_reels = \App\Models\Reel::where('user_id', $user->id)
                        ->latest()->limit(6)->get();
                ?>
                <?php if($usta_reels->isNotEmpty()): ?>
                    <section class="pt-6">
                        <h2 class="text-xl lg:text-2xl text-base-300 font-medium mb-4">
                            <i class="fa-solid fa-clapperboard text-primary mr-1"></i> <?php echo e(__('İşlerinden Videolar')); ?>

                        </h2>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                            <?php $__currentLoopData = $usta_reels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('reels.view', $reel->id)); ?>" target="_blank"
                                   class="group relative rounded-2xl overflow-hidden bg-gray-900 aspect-[9/16] block">
                                    <?php if($reel->thumbnail): ?>
                                        <img src="<?php echo e(asset('assets/uploads/reels/thumbnails/'.$reel->thumbnail)); ?>"
                                             alt="<?php echo e(__('İş videosu')); ?>" loading="lazy"
                                             class="w-full h-full object-cover opacity-90 group-hover:opacity-100 group-hover:scale-105 transition duration-300">
                                    <?php else: ?>
                                        <video src="<?php echo e(asset('assets/uploads/reels/'.$reel->video)); ?>#t=0.5"
                                               class="w-full h-full object-cover" preload="metadata" muted playsinline></video>
                                    <?php endif; ?>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="w-12 h-12 rounded-full bg-white/25 backdrop-blur flex items-center justify-center text-white group-hover:bg-primary transition">
                                            <i class="fa-solid fa-play ml-0.5"></i>
                                        </span>
                                    </div>
                                    <?php if($reel->views): ?>
                                        <span class="absolute bottom-2 left-2 text-white/90 text-xs font-semibold">
                                            <i class="fa-solid fa-eye mr-1"></i><?php echo e($reel->views); ?>

                                        </span>
                                    <?php endif; ?>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </section>
                <?php endif; ?>

                <!-- Review Section -->
                <?php if($complete_orders_in_total >= 1): ?>
                    <section class="pt-6" id="reviews">
                        <!-- Reviews Header -->
                        <h2 class="text-xl lg:text-2xl text-base-300 font-medium mb-4"><?php echo e(__('Reviews')); ?> (<?php echo e($complete_orders_in_total ?? 0); ?>)</h2>

                        <!-- Review Container -->
                        <!-- Review Container -->
                        <div class="space-y-8">
                            <?php $count = 0; ?>
                            <?php $__currentLoopData = $complete_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $rating = $order->rating->first(); ?>
                                <?php if($rating): ?>
                                    <?php $count++; ?>
                                    <div class="rounded-2xl border border-[#C4C8CE] p-4 review-item <?php if($count > 3): ?> hidden <?php endif; ?>">
                                        <!-- Top Section -->
                                        <div class="flex items-center gap-3 border-b pb-4">
                                            <?php if($order->user?->image): ?>
                                                <img src="<?php echo e(asset('assets/uploads/profile/'.$order->user->image)); ?>" alt="<?php echo e($order->user->fullname); ?>" class="w-12 h-12 rounded-full object-cover flex-shrink-0">
                                            <?php else: ?>
                                                <img src="<?php echo e(asset('assets/static/img/author/author.jpg')); ?>" alt="<?php echo e($order->user->fullname ?? ''); ?>" class="w-12 h-12 rounded-full object-cover flex-shrink-0">
                                            <?php endif; ?>
                                            <div>
                                                <h3 class="text-base font-medium text-base-300"><?php echo e($order->user->fullname ?? ''); ?></h3>
                                                <p class="text-sm text-gray-600"><?php echo e($order->user?->user_country?->country ?? ''); ?></p>
                                            </div>
                                        </div>

                                        <!-- Bottom section -->
                                        <div class="mt-2">
                                            <!-- Rating and time section -->
                                            <div class="flex items-center gap-2">
                                                <div class="flex star-rating">
                                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                                        <?php if($i <= floor($rating->rating)): ?>
                                                            <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                                                        <?php elseif($i == ceil($rating->rating) && !is_int($rating->rating)): ?>
                                                            <i class="icon-base ti tabler-star-half-filled icon-16px text-amber-400"></i>
                                                        <?php else: ?>
                                                            <i class="icon-base ti tabler-star icon-16px text-gray-300"></i>
                                                        <?php endif; ?>
                                                    <?php endfor; ?>
                                                </div>
                                                <span class="text-2xl text-base-400">•</span>
                                                <span class="text-sm text-base-400"><?php echo e($rating->created_at->diffForHumans()); ?></span>
                                            </div>

                                            <!-- Project Title -->
                                            <?php if($order->project): ?>
                                                <h4 class="font-medium text-base-300 mt-2"><?php echo e($order->project->title); ?></h4>
                                            <?php elseif($order->job): ?>
                                                <h4 class="font-medium text-base-300 mt-2"><?php echo e($order->job->title); ?></h4>
                                            <?php endif; ?>

                                            <!-- Review Feedback -->
                                            <p class="text-sm text-base-400 leading-relaxed mt-2">
                                                <?php echo e($rating->review_feedback); ?>

                                            </p>

                                            <!-- Earning (if visible) -->
                                            <?php
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
                                            ?>
                                            <?php if($shouldShowEarnings): ?>
                                                <div class="mt-3 pt-3 border-t border-gray-100">
                                                    <div class="text-sm">
                                                        <span class="text-gray-500"><?php echo e(__('Earned:')); ?></span>
                                                        <span class="font-medium text-base-300 ml-1"><?php echo e(float_amount_with_currency_symbol($rating->order?->payable_amount)); ?></span>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <!-- Show All Reviews Button -->
                        <?php if($complete_orders_in_total > 3): ?>
                            <div class="mt-6">
                                <button type="button" id="toggle-reviews-btn" class="show-all-reviews inline-flex items-center gap-2 text-primary hover:bg-primary group hover:text-white font-medium text-sm border border-primary hover:border-primary/90 px-4 py-2.5 rounded-md transition-colors duration-300">
                                    <span id="toggle-reviews-text"><?php echo e(__('Show All Reviews')); ?></span>
                                    <i class="icon-base ti tabler-arrow-right icon-16px text-primary -rotate-45 group-hover:text-white" id="toggle-reviews-icon"></i>
                                </button>
                            </div>
                        <?php endif; ?>
                    </section>
                <?php endif; ?>
            </section>

            <!-- Right Section (Sidebar) -->
            <?php echo $__env->make('frontend.profile-details.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

        <div class="popup-overlay"></div>

        <!-- Add Portfolio Modal -->
        <?php echo $__env->make('frontend.profile-details.add-portfolio', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!-- Edit Portfolio Modal -->
        <?php echo $__env->make('frontend.profile-details.edit-portfolio', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!-- Portfolio Detail View Shell -->
        <div class="popup-fixed change-portfolio-popup">
            <div class="popup-contents">
                <span class="popup-contents-close popup-close"> <i class="fas fa-times"></i> </span>
                <div class="popup-contents-inner"></div>
            </div>
        </div>
    </main>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php if (isset($component)) { $__componentOriginal54c16274d3d0b2e3d7bba6b79dadebcb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal54c16274d3d0b2e3d7bba6b79dadebcb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sweet-alert.sweet-alert2-js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sweet-alert.sweet-alert2-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal54c16274d3d0b2e3d7bba6b79dadebcb)): ?>
<?php $attributes = $__attributesOriginal54c16274d3d0b2e3d7bba6b79dadebcb; ?>
<?php unset($__attributesOriginal54c16274d3d0b2e3d7bba6b79dadebcb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal54c16274d3d0b2e3d7bba6b79dadebcb)): ?>
<?php $component = $__componentOriginal54c16274d3d0b2e3d7bba6b79dadebcb; ?>
<?php unset($__componentOriginal54c16274d3d0b2e3d7bba6b79dadebcb); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginala34b824a201f14e7e09beb6785e605e8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala34b824a201f14e7e09beb6785e605e8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select2.select2-js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select2.select2-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala34b824a201f14e7e09beb6785e605e8)): ?>
<?php $attributes = $__attributesOriginala34b824a201f14e7e09beb6785e605e8; ?>
<?php unset($__attributesOriginala34b824a201f14e7e09beb6785e605e8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala34b824a201f14e7e09beb6785e605e8)): ?>
<?php $component = $__componentOriginala34b824a201f14e7e09beb6785e605e8; ?>
<?php unset($__componentOriginala34b824a201f14e7e09beb6785e605e8); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginala8bbaec8b85679b9c75e7fd34ed38e55 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bbaec8b85679b9c75e7fd34ed38e55 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.payment-gateway.gateway-select-js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.payment-gateway.gateway-select-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala8bbaec8b85679b9c75e7fd34ed38e55)): ?>
<?php $attributes = $__attributesOriginala8bbaec8b85679b9c75e7fd34ed38e55; ?>
<?php unset($__attributesOriginala8bbaec8b85679b9c75e7fd34ed38e55); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala8bbaec8b85679b9c75e7fd34ed38e55)): ?>
<?php $component = $__componentOriginala8bbaec8b85679b9c75e7fd34ed38e55; ?>
<?php unset($__componentOriginala8bbaec8b85679b9c75e7fd34ed38e55); ?>
<?php endif; ?>
    <?php echo $__env->make('frontend.profile-details.profile-details-js', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.new_design.layout.new_master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/profile-details/profile-details.blade.php ENDPATH**/ ?>