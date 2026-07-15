<?php $__env->startSection('page-meta-data'); ?>
    <?php echo render_page_meta_data_for_service($project); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php
        // Fix price values
        $basicPrice = floatval($project->basic_discount_charge ?: $project->basic_regular_charge);
        $standardPrice = floatval($project->standard_discount_charge ?: $project->standard_regular_charge);
        $premiumPrice = floatval($project->premium_discount_charge ?: $project->premium_regular_charge);
    ?>
    <main class="pt-16 md:pt-0"> <!-- Added top padding for mobile -->
        <!-- Main section -->
        <!-- Breadcrumb -->
        <?php if (isset($component)) { $__componentOriginal5f19dd716048daf403d00235f9f2d409 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5f19dd716048daf403d00235f9f2d409 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.breadcrumb.user-profile-breadcrumb-02','data' => ['innerTitle' => __('Project Details')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('breadcrumb.user-profile-breadcrumb-02'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['innerTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Project Details'))]); ?>
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
        <div class="flex flex-col lg:flex-row gap-8 md:gap-12 max-w-7xl mx-auto pt-4 md:pt-10 lg:pt-20 px-4 md:px-6 pb-10 md:pb-20 lg:pb-[120px]">
            <!-- Left Section -->
            <section class="flex-1 space-y-6 md:space-y-10 min-w-0">
                <!-- Header, Profile and Carousel -->
                <section>
                    <h1 class="text-xl md:text-2xl lg:text-[28px] font-medium text-base-300 mb-6 md:mb-8 pt-2 md:pt-0">
                        <?php echo e($project->title); ?>

                    </h1>

                    <!-- Profile Section -->
                    <a href="<?php echo e(route('freelancer.profile.details', $user->username)); ?>" class="block">
                        <div class="flex items-center gap-4 mb-6 cursor-pointer hover:opacity-90 transition-opacity">
                            <div class="relative">
                                <?php if($user->image): ?>
                                    <?php if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])): ?>
                                        <img src="<?php echo e(render_frontend_cloud_image_if_module_exists('profile/'.$user->image, load_from: $user->load_from)); ?>"
                                             alt="<?php echo e($user->first_name ?? ''); ?>"
                                             class="w-14 h-14 rounded-full object-cover">
                                    <?php else: ?>
                                        <img src="<?php echo e(asset('assets/uploads/profile/' . $user->image)); ?>"
                                             alt="<?php echo e($user->first_name); ?>"
                                             class="w-14 h-14 rounded-full object-cover">
                                    <?php endif; ?>
                                <?php else: ?>
                                    <img src="<?php echo e(asset('assets/static/img/author/author.jpg')); ?>"
                                         alt="<?php echo e(__('AuthorImg')); ?>"
                                         class="w-14 h-14 rounded-full object-cover">
                                <?php endif; ?>

                                <?php if(Cache::has('user_is_online_' . $user->id)): ?>
                                    <div class="absolute w-4 h-4 bg-green-600 border border-white rounded-full right-0 bottom-1"></div>
                                <?php else: ?>
                                    <div class="absolute w-4 h-4 bg-gray-400 border border-white rounded-full right-0 bottom-1"></div>
                                <?php endif; ?>
                            </div>
                            <div>
                                <div class="flex items-center gap-3">
                <span class="font-medium text-base-300 hover:text-primary transition-colors">
                    <?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?>

                </span>
                <?php if($user->user_verified_status == 1): ?>
                    <i class="fa-solid fa-circle-check text-blue-500 text-xs ml-1" title="<?php echo e(__('Verified')); ?>"></i>
                <?php endif; ?>
                                </span>
                                    <?php if(moduleExists('FreelancerLevel')): ?>
                                        <span class="border px-3 py-1 rounded-full text-sm">
                  <?php echo e(freelancer_level($user->id, 'text')); ?>

                      </span>
                                    <?php endif; ?>
                                </div>
                                <div class="flex items-center gap-2 mt-1">
                                    <div class="flex star-rating">
                                        <?php
                                            $ratingValue = $user->freelancer_ratings_avg_rating ?? 0;
                                            $fullStars = floor($ratingValue);
                                            $hasHalfStar = ($ratingValue - $fullStars) >= 0.5;
                                            $reviewCount = $user->freelancer_ratings_count ?? 0;
                                        ?>

                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <?php if($i <= $fullStars): ?>
                                                <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                                            <?php elseif($i == $fullStars + 1 && $hasHalfStar): ?>
                                                <i class="icon-base ti tabler-star-half-filled icon-16px text-amber-400"></i>
                                            <?php else: ?>
                                                <i class="icon-base ti tabler-star icon-16px text-amber-400"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </div>
                                    <span class="font-medium text-base-300"><?php echo e(number_format($ratingValue, 1)); ?></span>
                                    <span class="text-base-300">(<?php echo e($reviewCount); ?> reviews)</span>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Carousel Section -->
                    <div>
                        <!-- Slider -->
                        <div class="carousel-container-details rounded-3xl mb-6 relative border overflow-visible">
                            <div class="relative">
                                <?php
                                    $media = $project->media ?? [];
                                    if (empty($media) && $project->image) {
                                        $img = $project->image;
                                        $media = is_array($img) ? $img : [$img];
                                    }
                                    $hasMultipleMedia = count($media) > 1;
                                ?>

                                        <!-- Navigation Buttons - Only show if there are multiple images -->
                                <?php if($hasMultipleMedia): ?>
                                    <button id="servicePrevButton"
                                            class="carousel-nav-button bg-white rounded-full w-12 h-12 flex items-center justify-center shadow-lg hover:shadow-xl transition-all z-10 absolute top-1/2 -translate-y-1/2 left-2 md:-left-5">
                                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                    </button>
                                <?php endif; ?>

                                <!-- Carousel Content -->
                                <div class="overflow-hidden rounded-2xl">
                                    <div id="carouselTrack" class="carousel-track">
                                        <?php $__empty_1 = true; $__currentLoopData = $media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <?php
                                                $ext = pathinfo($file, PATHINFO_EXTENSION);
                                                $isImage = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'bmp', 'tiff', 'svg', 'webp', 'gif', 'avif']);
                                            ?>
                                            <div class="screen-card">
                                                <div class="w-full h-64 sm:h-80 md:h-96 lg:h-[450px]">
                                                    <?php if($isImage): ?>
                                                        <?php if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])): ?>
                                                            <img src="<?php echo e(render_frontend_cloud_image_if_module_exists('project/'.$file, load_from: $project->load_from)); ?>"
                                                                 alt="<?php echo e($project->title ?? ''); ?>"
                                                                 class="w-full h-full object-cover">
                                                        <?php else: ?>
                                                            <img src="<?php echo e(asset('assets/uploads/project/'.$file)); ?>"
                                                                 alt="<?php echo e($project->title ?? ''); ?>"
                                                                 class="w-full h-full object-cover">
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <?php if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])): ?>
                                                            <video src="<?php echo e(render_frontend_cloud_image_if_module_exists('project/'.$file, load_from: $project->load_from)); ?>"
                                                                   class="w-full h-full object-cover" controls autoplay muted loop playsinline>
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        <?php else: ?>
                                                            <video src="<?php echo e(asset('assets/uploads/project/'.$file)); ?>"
                                                                   class="w-full h-full object-cover" controls autoplay muted loop playsinline>
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <div class="screen-card">
                                                <div class="w-full h-64 sm:h-80 md:h-96 lg:h-[450px] flex items-center justify-center bg-gray-100 rounded-2xl">
                                                    <span class="text-base-400">No media available</span>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Next Button - Only show if there are multiple images -->
                                <?php if($hasMultipleMedia): ?>
                                    <button id="serviceNextButton"
                                            class="carousel-nav-button bg-white rounded-full w-12 h-12 flex items-center justify-center shadow-lg hover:shadow-xl transition-all z-10 absolute top-1/2 -translate-y-1/2 right-2 md:-right-5">
                                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M9 5l7 7-7 7">
                                            </path>
                                        </svg>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Thumbnails - Only show if there are more than one image -->
                        <?php if($hasMultipleMedia): ?>
                            <div id="thumbnailContainer" class="flex gap-2 md:gap-4 mb-8 overflow-x-auto pb-2">
                                <?php $__currentLoopData = $media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $ext = pathinfo($file, PATHINFO_EXTENSION);
                                        $isImage = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'bmp', 'tiff', 'svg', 'webp', 'gif', 'avif']);
                                    ?>
                                    <div class="thumbnail rounded-lg md:rounded-xl overflow-hidden border-2 border-transparent <?php echo e($index === 0 ? 'active border-primary' : ''); ?>"
                                         data-index="<?php echo e($index); ?>"
                                         style="width: 80px; height: 80px; flex-shrink: 0;">
                                        <?php if($isImage): ?>
                                            <?php if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])): ?>
                                                <img src="<?php echo e(render_frontend_cloud_image_if_module_exists('project/'.$file, load_from: $project->load_from)); ?>"
                                                     alt="Thumbnail <?php echo e($index + 1); ?>"
                                                     class="w-full h-20 sm:h-24 md:h-32 object-cover">
                                            <?php else: ?>
                                                <img src="<?php echo e(asset('assets/uploads/project/'.$file)); ?>"
                                                     alt="Thumbnail <?php echo e($index + 1); ?>"
                                                     class="w-full h-20 sm:h-24 md:h-32 object-cover">
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <!-- Video thumbnail: Use video with poster or placeholder -->
                                            <div class="relative w-full h-full bg-gray-900">
                                                <?php if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])): ?>
                                                    <video src="<?php echo e(render_frontend_cloud_image_if_module_exists('project/'.$file, load_from: $project->load_from)); ?>"
                                                           class="w-full h-full object-cover" muted></video>
                                                <?php else: ?>
                                                    <video src="<?php echo e(asset('assets/uploads/project/'.$file)); ?>"
                                                           class="w-full h-full object-cover" muted></video>
                                                <?php endif; ?>
                                                <div class="absolute inset-0 flex items-center justify-center">
                                                    <div class="w-8 h-8 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                                                        <i class="fa-solid fa-play text-white text-sm"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>

                <!-- About Service Details Section -->
                <section class="space-y-[40px]">
                    <!-- About Section -->
                    <div>
                        <h2 class="text-xl lg:text-2xl text-base-300 font-medium mb-4">About this Service</h2>
                        <div class="text-base-400 leading-relaxed">
                            <?php echo $project->description; ?>

                        </div>
                    </div>

                    <!-- Service Features Section -->
                    <?php if($project->project_attributes->count() > 0): ?>
                        <div>
                            <h2 class="text-xl md:text-2xl font-medium text-base-300 mb-4">Service Features</h2>
                            <ul class="space-y-3">
                                <?php $__currentLoopData = $project->project_attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($attr->basic_check_numeric == 'on' || $attr->standard_check_numeric == 'on' || $attr->premium_check_numeric == 'on'): ?>
                                        <li class="flex items-center justify-start">
                                            <span class="text-[#3B4759] mr-2">●</span>
                                            <span class="text-base-400"><?php echo e($attr->check_numeric_title); ?></span>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                </section>

                <!-- About the seller -->
                <section>
                    <h2 class="text-xl lg:text-2xl text-base-300 font-medium mb-4">About the Seller</h2>

                    <div class="bg-white rounded-2xl border border-[#C4C8CE] p-6 mb-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center justify-between">
                            <!-- Profile Section -->
                            <a href="<?php echo e(route('freelancer.profile.details', $user->username)); ?>" class="block">
                                <div class="flex items-start md:items-center gap-3 md:gap-4 cursor-pointer hover:opacity-90 transition-opacity">
                                    <div class="relative flex-shrink-0">
                                        <?php if($user->image): ?>
                                            <?php if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])): ?>
                                                <img src="<?php echo e(render_frontend_cloud_image_if_module_exists('profile/'.$user->image, load_from: $user->load_from)); ?>"
                                                     alt="<?php echo e($user->first_name ?? ''); ?>"
                                                     class="w-12 h-12 md:w-14 md:h-14 rounded-full object-cover">
                                            <?php else: ?>
                                                <img src="<?php echo e(asset('assets/uploads/profile/' . $user->image)); ?>"
                                                     alt="<?php echo e($user->first_name); ?>"
                                                     class="w-12 h-12 md:w-14 md:h-14 rounded-full object-cover">
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('assets/static/img/author/author.jpg')); ?>"
                                                 alt="<?php echo e(__('AuthorImg')); ?>"
                                                 class="w-12 h-12 md:w-14 md:h-14 rounded-full object-cover">
                                        <?php endif; ?>

                                        <?php if(Cache::has('user_is_online_' . $user->id)): ?>
                                            <div class="absolute w-3 h-3 md:w-4 md:h-4 bg-green-600 border border-white rounded-full right-0 bottom-0 md:bottom-1"></div>
                                        <?php else: ?>
                                            <div class="absolute w-3 h-3 md:w-4 md:h-4 bg-gray-400 border border-white rounded-full right-0 bottom-0 md:bottom-1"></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex flex-col gap-1 md:block">
                                            <div class="flex items-center gap-2 flex-wrap">
                                                <span class="font-medium text-base-300 hover:text-primary transition-colors truncate">
                                                    <?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?>

                                                </span>
                                                <?php if($user->user_verified_status == 1): ?>
                                                    <i class="fa-solid fa-circle-check text-blue-500 text-xs" title="<?php echo e(__('Verified')); ?>"></i>
                                                <?php endif; ?>
                                                <?php if(moduleExists('FreelancerLevel')): ?>
                                                    <span class="border px-2 py-0.5 md:px-3 md:py-1 rounded-full text-xs md:text-sm whitespace-nowrap">
                                                        <?php echo e(freelancer_level($user->id, 'text')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="flex items-center gap-1 md:gap-2">
                                                <div class="flex star-rating">
                                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                                        <?php if($i <= $fullStars): ?>
                                                            <i class="icon-base ti tabler-star-filled icon-14px md:icon-16px text-amber-400"></i>
                                                        <?php elseif($i == $fullStars + 1 && $hasHalfStar): ?>
                                                            <i class="icon-base ti tabler-star-half-filled icon-14px md:icon-16px text-amber-400"></i>
                                                        <?php else: ?>
                                                            <i class="icon-base ti tabler-star icon-14px md:icon-16px text-amber-400"></i>
                                                        <?php endif; ?>
                                                    <?php endfor; ?>
                                                </div>
                                                <span class="font-medium text-base-300 text-sm md:text-base"><?php echo e(number_format($ratingValue, 1)); ?></span>
                                                <span class="text-base-300 text-sm md:text-base">(<?php echo e($reviewCount); ?> <?php echo e(__('reviews')); ?>)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 1 && Auth::guard('web')->user()->id != $project->user_id && Session::get('user_role') != 'freelancer'): ?>
                                <a href="<?php echo e(route('client.live.chat')); ?>?freelancer_id=<?php echo e($project->user_id); ?>&project_id=<?php echo e($project->id); ?>"
                                   class="bg-primary hover:bg-primary/80 text-white px-5 py-2 rounded-md text-sm font-medium transition-colors justify-self-center place-content-center hidden lg:block inline-block text-center">
                                    <?php echo e(__('Contact me')); ?>

                                </a>
                            <?php endif; ?>
                        </div>

                        <div class="grid grid-cols-2 gap-6 mb-4 mt-6">
                            <div>
                                <p class="text-sm text-gray-600 mb-1"><?php echo e(__('From')); ?></p>
                                <p class="font-medium text-base-300">
                                    <?php if($user->user_state?->state): ?>
                                        <?php echo e($user->user_state?->state); ?>,
                                    <?php endif; ?>
                                    <?php echo e($user->user_country?->country); ?>

                                </p>
                            </div>
                            <div class="justify-self-center">
                                <p class="text-sm text-gray-600 mb-1"><?php echo e(__('Member Since')); ?></p>
                                <p class="font-medium text-base-300">
                                    <?php echo e($user->created_at->format('M Y')); ?>

                                </p>
                            </div>
                            <?php if($user->completed_orders_count > 0): ?>
                                <div>
                                    <p class="text-sm text-gray-600 mb-1"><?php echo e(__('Jobs Completed')); ?></p>
                                    <p class="font-medium text-base-300">
                                        <?php echo e($user->completed_orders_count); ?>

                                    </p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if($user->freelancer_skill->count() > 0): ?>
                            <?php
                                // Get all skills and split by comma
                                $allSkills = [];
                                foreach($user->freelancer_skill->take(5) as $skillItem) {
                                    $splitSkills = array_map('trim', explode(',', $skillItem->skill));
                                    $allSkills = array_merge($allSkills, $splitSkills);
                                }
                                // Take only first 5 unique skills
                                $skills = array_slice(array_unique($allSkills), 0, 5);
                            ?>

                            <div class="flex items-center flex-wrap gap-4">
                                <p class="text-base-400">Skills:</p> <!-- ONLY ONE "Skills:" label -->
                                <div class="flex flex-wrap gap-2">
                                    <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="bg-gray-100 text-base-300 px-3 py-1 rounded-md text-sm">
                    <?php echo e($skill); ?>

                </span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 1 && Auth::guard('web')->user()->id != $project->user_id && Session::get('user_role') != 'freelancer'): ?>
                            <a href="<?php echo e(route('client.live.chat')); ?>?freelancer_id=<?php echo e($project->user_id); ?>&project_id=<?php echo e($project->id); ?>"
                               class="lg:hidden mt-6 w-full bg-primary hover:bg-primary/80 text-white px-5 py-2 rounded-md text-sm font-medium transition-colors inline-block text-center">
                                Contact me
                            </a>
                        <?php endif; ?>
                    </div>
                </section>

                <!-- Compare Package Section -->
                <?php if(!empty($project->standard_title) && !empty($project->premium_title)): ?>
                    <section>
                        <h2 class="text-xl lg:text-2xl text-base-300 font-medium mb-4">Compare packages</h2>

                        <div class="bg-white rounded-2xl border border-[#C4C8CE] overflow-auto">
                            <table class="w-full">
                                <thead>
                                <tr class="text-base-300 text-sm">
                                    <th class="text-left p-4 font-medium border-r">Package</th>
                                    <th class="text-center p-4 font-medium border-r">
                                        <div><?php echo e(yaptiriyo_price_label($basicPrice, $project->pricing_type)); ?></div>
                                        <div><?php echo e($project->basic_title); ?></div>
                                    </th>
                                    <?php if(!empty($project->standard_title)): ?>
                                        <th class="text-center p-4 font-medium border-r">
                                            <div><?php echo e(yaptiriyo_price_label($standardPrice, $project->pricing_type)); ?></div>
                                            <div><?php echo e($project->standard_title); ?></div>
                                        </th>
                                    <?php endif; ?>
                                    <?php if(!empty($project->premium_title)): ?>
                                        <th class="text-center p-4 font-medium">
                                            <div><?php echo e(yaptiriyo_price_label($premiumPrice, $project->pricing_type)); ?></div>
                                            <div><?php echo e($project->premium_title); ?></div>
                                        </th>
                                    <?php endif; ?>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- Revisions Row -->
                                <tr class="text-base-300 bg-primary/5">
                                    <td class="p-4 text-sm border-r">Revisions</td>
                                    <td class="text-center p-4 border-r"><?php echo e($project->basic_revision); ?></td>
                                    <?php if(!empty($project->standard_title)): ?>
                                        <td class="text-center p-4 border-r"><?php echo e($project->standard_revision); ?></td>
                                    <?php endif; ?>
                                    <?php if(!empty($project->premium_title)): ?>
                                        <td class="text-center p-4"><?php echo e($project->premium_revision); ?></td>
                                    <?php endif; ?>
                                </tr>

                                <!-- Delivery Time Row -->
                                <tr class="">
                                    <td class="p-4 text-sm text-base-300 border-r">Delivery Time</td>
                                    <td class="text-center p-4 text-sm text-base-300 border-r"><?php echo e($project->basic_delivery); ?></td>
                                    <?php if(!empty($project->standard_title)): ?>
                                        <td class="text-center p-4 text-sm text-base-300 border-r"><?php echo e($project->standard_delivery); ?></td>
                                    <?php endif; ?>
                                    <?php if(!empty($project->premium_title)): ?>
                                        <td class="text-center p-4 text-sm text-base-300"><?php echo e($project->premium_delivery); ?></td>
                                    <?php endif; ?>
                                </tr>

                                <!-- Attributes Rows -->
                                <?php $__currentLoopData = $project->project_attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="<?php echo e($loop->iteration % 2 == 0 ? 'bg-primary/5' : ''); ?>">
                                        <td class="border-r p-4 text-sm text-base-300"><?php echo e($attr->check_numeric_title); ?></td>
                                        <td class="border-r text-center p-4 text-sm text-base-300">
                                            <?php if($attr->basic_check_numeric == 'on'): ?>
                                                <svg class="w-5 h-5 text-base-300 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            <?php elseif($attr->basic_check_numeric == 'off'): ?>
                                                <svg class="w-5 h-5 text-base-300 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            <?php else: ?>
                                                <?php echo e($attr->basic_check_numeric); ?>

                                            <?php endif; ?>
                                        </td>
                                        <?php if(!empty($project->standard_title)): ?>
                                            <td class="border-r text-center p-4 text-sm text-base-300">
                                                <?php if($attr->standard_check_numeric == 'on'): ?>
                                                    <svg class="w-5 h-5 text-base-300 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                <?php elseif($attr->standard_check_numeric == 'off'): ?>
                                                    <svg class="w-5 h-5 text-base-300 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                <?php else: ?>
                                                    <?php echo e($attr->standard_check_numeric); ?>

                                                <?php endif; ?>
                                            </td>
                                        <?php endif; ?>
                                        <?php if(!empty($project->premium_title)): ?>
                                            <td class="text-center p-4 text-sm text-base-300">
                                                <?php if($attr->premium_check_numeric == 'on'): ?>
                                                    <svg class="w-5 h-5 text-base-300 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                <?php elseif($attr->premium_check_numeric == 'off'): ?>
                                                    <svg class="w-5 h-5 text-base-300 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                <?php else: ?>
                                                    <?php echo e($attr->premium_check_numeric); ?>

                                                <?php endif; ?>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <!-- Total Row -->
                                <tr class="bg-gray-50">
                                    <td class="border-r p-4 text-sm font-medium text-base-300">Total</td>
                                    <td class="border-r text-center p-4 text-sm font-medium text-base-300">
                                        <?php echo e(yaptiriyo_price_label($basicPrice, $project->pricing_type)); ?>

                                    </td>
                                    <?php if(!empty($project->standard_title)): ?>
                                        <td class="border-r text-center p-4 text-sm font-medium text-base-300">
                                            <?php echo e(yaptiriyo_price_label($standardPrice, $project->pricing_type)); ?>

                                        </td>
                                    <?php endif; ?>
                                    <?php if(!empty($project->premium_title)): ?>
                                        <td class="text-center p-4 text-sm font-medium text-base-300">
                                            <?php echo e(yaptiriyo_price_label($premiumPrice, $project->pricing_type)); ?>

                                        </td>
                                    <?php endif; ?>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
                <?php endif; ?>

                <!-- Review Section -->
                <?php if($project_complete_orders->count() > 0): ?>
                    <section>
                        <h2 class="text-xl lg:text-2xl text-base-300 font-medium mb-4">
                            Reviews (<?php echo e($project_complete_orders->total()); ?>)
                        </h2>

                        <!-- Review Container -->
                        <div class="space-y-8" id="reviewsContainer">
                            <?php echo $__env->make('frontend.pages.project-details.reviews', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>

                        <!-- Show All Reviews Button -->
                        <?php if($project_complete_orders->hasMorePages()): ?>
                            <div class="mt-6">
                                <button id="loadMoreReviews"
                                        data-project-id="<?php echo e($project->id); ?>"
                                        class="inline-flex items-center gap-2 text-primary hover:bg-primary group hover:text-white font-medium text-sm border border-primary hover:border-primary/90 px-4 py-2.5 rounded-md transition-colors duration-300">
                                    <?php echo e(__('Show All Reviews')); ?>

                                    <i class="icon-base ti tabler-arrow-right icon-16px text-primary -rotate-45 group-hover:text-white"></i>
                                </button>
                            </div>
                        <?php endif; ?>
                    </section>
                <?php endif; ?>
            </section>

            <!-- Right Section - Pricing Packages -->
            <section class="lg:w-96 xl:w-[440px] flex-shrink-0">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden sticky top-[100px] border">
                    <!-- Package Tabs -->
                    <div class="flex border-b">
                        <div class="package-tab active flex-1 text-center py-3" data-package="basic"><?php echo e($project->basic_title); ?></div>
                        <?php if(!empty($project->standard_title)): ?>
                            <div class="package-tab flex-1 text-center py-3" data-package="standard"><?php echo e($project->standard_title); ?></div>
                        <?php endif; ?>
                        <?php if(!empty($project->premium_title)): ?>
                            <div class="package-tab flex-1 text-center py-3" data-package="premium"><?php echo e($project->premium_title); ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Package Content -->
                    <div class="p-6">
                        <!-- Basic Package -->
                        <div id="basicPackage" class="package-content" data-base-price="<?php echo e($basicPrice); ?>">
                            <div class="text-3xl font-semibold mb-2">
                                <?php echo e(yaptiriyo_price_label($basicPrice, $project->pricing_type)); ?>

                            </div>
                            <p class="text-base-400 mb-6"><?php echo e($project->basic_title); ?></p>

                            <div class="mb-6">
                                <!-- Delivery & Revision -->
                                <div class="flex items-center gap-4 md:gap-10 mb-6">
                                    <div class="flex items-center gap-2">
                                        <i class="icon-base ti tabler-clock-share icon-20px text-base-300 font-medium"></i>
                                        <span class="text-base-300 font-medium"><?php echo e($project->basic_delivery); ?> delivery</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="icon-base ti tabler-refresh-dot icon-20px text-base-300 font-medium"></i>
                                        <span class="text-base-300 font-medium"><?php echo e($project->basic_revision); ?> Revision</span>
                                    </div>
                                </div>

                                <!-- Facilities -->
                                <div class="space-y-3 text-sm">
                                    <?php $__currentLoopData = $project->project_attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($attr->basic_check_numeric == 'on' && empty($attr->basic_extra_price)): ?>
                                            <div class="flex items-center gap-2">
                                                <i class="icon-base ti tabler-check icon-18px text-base-300 font-medium"></i>
                                                <span class="text-base-400"><?php echo e($attr->check_numeric_title); ?></span>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <!-- Extra Services -->
                                    <?php
                                        $basicExtras = $project->project_attributes->filter(fn($attr) => $attr->basic_extra_price > 0);
                                    ?>
                                    <?php if($basicExtras->count()): ?>
                                        <div class="mt-4 pt-4 border-t border-gray-200">
                                            <p class="text-sm font-medium text-base-300 mb-2">Extra Services:</p>
                                            <?php $__currentLoopData = $basicExtras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="flex items-center justify-between mb-2">
                                                    <div class="flex items-center gap-2">
                                                        <input type="checkbox" class="basic-extra-checkbox rounded text-primary"
                                                               data-price="<?php echo e($attr->basic_extra_price); ?>"
                                                               name="extras[<?php echo e($attr->id); ?>]">
                                                        <span class="text-base-400 text-sm"><?php echo e($attr->check_numeric_title); ?></span>
                                                    </div>
                                                    <span class="text-sm text-base-300">+<?php echo e(float_amount_with_currency_symbol($attr->basic_extra_price)); ?></span>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Standard Package -->
                        <?php if(!empty($project->standard_title)): ?>
                            <div id="standardPackage" class="package-content hidden" data-base-price="<?php echo e($standardPrice); ?>">
                                <div class="text-3xl font-semibold mb-2">
                                    <?php echo e(yaptiriyo_price_label($standardPrice, $project->pricing_type)); ?>

                                </div>
                                <p class="text-base-300 mb-6"><?php echo e($project->standard_title); ?></p>

                                <div class="mb-6">
                                    <!-- Delivery & Revision -->
                                    <div class="flex items-center gap-4 md:gap-10 mb-6">
                                        <div class="flex items-center gap-2">
                                            <i class="icon-base ti tabler-clock-share icon-20px text-base-300 font-medium"></i>
                                            <span class="text-base-300 font-medium"><?php echo e($project->standard_delivery); ?> delivery</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <i class="icon-base ti tabler-refresh-dot icon-20px text-base-300 font-medium"></i>
                                            <span class="text-base-300 font-medium"><?php echo e($project->standard_revision); ?> Revision</span>
                                        </div>
                                    </div>

                                    <!-- Facilities -->
                                    <div class="space-y-3 text-sm">
                                        <?php $__currentLoopData = $project->project_attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($attr->standard_check_numeric == 'on' && empty($attr->standard_extra_price)): ?>
                                                <div class="flex items-center gap-2">
                                                    <i class="icon-base ti tabler-check icon-18px text-base-300 font-medium"></i>
                                                    <span class="text-base-400"><?php echo e($attr->check_numeric_title); ?></span>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <!-- Extra Services -->
                                        <?php
                                            $standardExtras = $project->project_attributes->filter(fn($attr) => $attr->standard_extra_price > 0);
                                        ?>
                                        <?php if($standardExtras->count()): ?>
                                            <div class="mt-4 pt-4 border-t border-gray-200">
                                                <p class="text-sm font-medium text-base-300 mb-2">Extra Services:</p>
                                                <?php $__currentLoopData = $standardExtras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="flex items-center justify-between mb-2">
                                                        <div class="flex items-center gap-2">
                                                            <input type="checkbox" class="standard-extra-checkbox rounded text-primary"
                                                                   data-price="<?php echo e($attr->standard_extra_price); ?>"
                                                                   name="extras[<?php echo e($attr->id); ?>]">
                                                            <span class="text-base-400 text-sm"><?php echo e($attr->check_numeric_title); ?></span>
                                                        </div>
                                                        <span class="text-sm text-base-300">+<?php echo e(float_amount_with_currency_symbol($attr->standard_extra_price)); ?></span>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Premium Package -->
                        <?php if(!empty($project->premium_title)): ?>
                            <div id="premiumPackage" class="package-content hidden" data-base-price="<?php echo e($premiumPrice); ?>">
                                <div class="text-3xl font-semibold mb-2">
                                    <?php echo e(yaptiriyo_price_label($premiumPrice, $project->pricing_type)); ?>

                                </div>
                                <p class="text-base-300 mb-6"><?php echo e($project->premium_title); ?></p>

                                <div class="mb-6">
                                    <!-- Delivery & Revision -->
                                    <div class="flex items-center gap-4 md:gap-10 mb-6">
                                        <div class="flex items-center gap-2">
                                            <i class="icon-base ti tabler-clock-share icon-20px text-base-300 font-medium"></i>
                                            <span class="text-base-300 font-medium"><?php echo e($project->premium_delivery); ?> delivery</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <i class="icon-base ti tabler-refresh-dot icon-20px text-base-300 font-medium"></i>
                                            <span class="text-base-300 font-medium"><?php echo e($project->premium_revision); ?> Revision</span>
                                        </div>
                                    </div>

                                    <!-- Facilities -->
                                    <div class="space-y-3 text-sm">
                                        <?php $__currentLoopData = $project->project_attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($attr->premium_check_numeric == 'on' && empty($attr->premium_extra_price)): ?>
                                                <div class="flex items-center gap-2">
                                                    <i class="icon-base ti tabler-check icon-18px text-base-300 font-medium"></i>
                                                    <span class="text-base-400"><?php echo e($attr->check_numeric_title); ?></span>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <!-- Extra Services -->
                                        <?php
                                            $premiumExtras = $project->project_attributes->filter(fn($attr) => $attr->premium_extra_price > 0);
                                        ?>
                                        <?php if($premiumExtras->count()): ?>
                                            <div class="mt-4 pt-4 border-t border-gray-200">
                                                <p class="text-sm font-medium text-base-300 mb-2">Extra Services:</p>
                                                <?php $__currentLoopData = $premiumExtras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="flex items-center justify-between mb-2">
                                                        <div class="flex items-center gap-2">
                                                            <input type="checkbox" class="premium-extra-checkbox rounded text-primary"
                                                                   data-price="<?php echo e($attr->premium_extra_price); ?>"
                                                                   name="extras[<?php echo e($attr->id); ?>]">
                                                            <span class="text-base-400 text-sm"><?php echo e($attr->check_numeric_title); ?></span>
                                                        </div>
                                                        <span class="text-sm text-base-300">+<?php echo e(float_amount_with_currency_symbol($attr->premium_extra_price)); ?></span>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Buttons -->
                        <?php if(Auth::guard('web')->check()): ?>
                            <?php if(Auth::guard('web')->user()->user_type == 1 && Auth::guard('web')->user()->id != $project->user_id && Session::get('user_role') != 'freelancer'): ?>
                                <div class="space-y-3">
                                    <?php if(moduleExists('SecurityManage')): ?>
                                        <?php if(Auth::guard('web')->user()->freeze_order_create == 'freeze'): ?>
                                            <a href="#/" class="w-full bg-gray-400 text-white font-medium py-4 rounded-lg mb-3 transition-colors flex items-center justify-center gap-2 disabled-link">
                                                Continue to Order
                                                <i class="icon-base ti tabler-arrow-right icon-20px text-white -rotate-45"></i>
                                            </a>
                                        <?php else: ?>
                                            <a href="#"
                                               id="continueOrderBtn"
                                               data-project-id="<?php echo e($project->id); ?>"
                                               class="w-full bg-primary hover:bg-primary/90 text-white font-medium py-4 rounded-lg mb-3 transition-colors flex items-center justify-center gap-2">
                                                Continue to Order
                                                <i class="icon-base ti tabler-arrow-right icon-20px text-white -rotate-45"></i>
                                            </a>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <a href="#"
                                           id="continueOrderBtn"
                                           data-project-id="<?php echo e($project->id); ?>"
                                           class="w-full bg-primary hover:bg-primary/90 text-white font-medium py-4 rounded-lg mb-3 transition-colors flex items-center justify-center gap-2">
                                            Continue to Order
                                            <i class="icon-base ti tabler-arrow-right icon-20px text-white -rotate-45"></i>
                                        </a>
                                    <?php endif; ?>

                                        <a href="<?php echo e(route('client.live.chat')); ?>?freelancer_id=<?php echo e($project->user_id); ?>&project_id=<?php echo e($project->id); ?>"
                                           class="w-full border border-primary text-primary hover:bg-primary hover:text-white font-medium py-4 rounded-lg transition-colors inline-block text-center">
                                            Contact me
                                        </a>
                                </div>
                            <?php endif; ?>

                            <?php if(Auth::guard('web')->user()->user_type == 2 && Auth::guard('web')->user()->id != $project->user_id && Session::get('user_role') == 'client'): ?>
                                <?php echo $__env->make('frontend.pages.project-details.freelancer-order-as-client', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="space-y-3">
                                <a href="#"
                                   id="openLoginModalForOrder"
                                   class="w-full bg-primary hover:bg-primary/90 text-white font-medium py-4 rounded-lg mb-3 transition-colors flex items-center justify-center gap-2">
                                    Login to Order
                                    <i class="icon-base ti tabler-arrow-right icon-20px text-white -rotate-45"></i>
                                </a>
                                <a href="#"
                                   id="openLoginModalForContact"
                                   class="w-full border border-primary text-primary hover:bg-primary hover:text-white font-medium py-4 rounded-lg transition-colors inline-block text-center">
                                    Contact me
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        </div>

        <!-- Related Service Section -->
        <?php echo $__env->make('frontend.pages.project-details.related-service', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </main>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
    <?php echo $__env->make('frontend.pages.project-details.load-more-js', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <script>
        // Global variables
        window.siteCurrency = '<?php echo e(get_static_option("site_global_currency") ?? "$"); ?>';
        window.reviewLoadMoreUrl = "<?php echo e(route('project.review.load.more')); ?>";


        $(document).ready(function() {

            function initializeCarousel() {
                const screens = $('.screen-card');
                if (screens.length === 0) return;

                // Ensure each screen card takes full width
                screens.css({
                    'min-width': '100%',
                    'width': '100%'
                });

                let currentIndex = 0;
                const $track = $('#carouselTrack');
                const $thumbnails = $('.thumbnail');

                // Ensure initial state
                $track.css('transform', 'translateX(0%)');
                if ($thumbnails.length > 0) {
                    $thumbnails.removeClass('active').eq(0).addClass('active');
                }

                function updateCarousel() {
                    if (screens.length === 0) return;

                    const offset = -currentIndex * 100;
                    $track.css('transform', `translateX(${offset}%)`);

                    // Update active thumbnail
                    $thumbnails.removeClass('active');
                    if ($thumbnails.length > currentIndex) {
                        $thumbnails.eq(currentIndex).addClass('active');
                    }
                }

                // Previous button
                $('#servicePrevButton').off('click').on('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    currentIndex = currentIndex === 0 ? screens.length - 1 : currentIndex - 1;
                    updateCarousel();
                });

                // Next button
                $('#serviceNextButton').off('click').on('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    currentIndex = currentIndex === screens.length - 1 ? 0 : currentIndex + 1;
                    updateCarousel();
                });

                // Thumbnail clicks
                $thumbnails.off('click').on('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    const index = parseInt($(this).data('index'), 10);
                    if (!isNaN(index) && index >= 0 && index < screens.length) {
                        currentIndex = index;
                        updateCarousel();
                    }
                });

                // Touch swipe support
                let touchStartX = 0;
                let touchEndX = 0;

                $('.carousel-container-details').off('touchstart touchend')
                    .on('touchstart', function(e) {
                        touchStartX = e.changedTouches[0].screenX;
                    })
                    .on('touchend', function(e) {
                        touchEndX = e.changedTouches[0].screenX;
                        if (touchEndX < touchStartX - 50) {
                            $('#serviceNextButton').click();
                        }
                        if (touchEndX > touchStartX + 50) {
                            $('#servicePrevButton').click();
                        }
                    });
            }

            // Initialize carousel immediately and after images load
            initializeCarousel();
            $(window).on('load', function() {
                setTimeout(initializeCarousel, 100);
            });

            $('.package-tab').off('click').on('click', function(e) {
                e.preventDefault();
                const packageName = $(this).data('package');

                $('.package-tab').removeClass('active');
                $(this).addClass('active');

                $('.package-content').addClass('hidden');
                $(`#${packageName}Package`).removeClass('hidden');

            });

            let currentPage = 1;
            let loading = false;

            $('#loadMoreReviews').on('click', function() {
                if (loading) return;

                loading = true;
                currentPage++;

                $.ajax({
                    url: window.reviewLoadMoreUrl,
                    method: 'GET',
                    data: {
                        project_id: $(this).data('project-id'),
                        page: currentPage
                    },
                    beforeSend: function() {
                        $('#loadMoreReviews').prop('disabled', true).html('Loading...');
                    },
                    success: function(response) {
                        $('#reviewsContainer').append(response);
                        $('#loadMoreReviews').prop('disabled', false).html('Show All Reviews <i class="icon-base ti tabler-arrow-right icon-16px text-primary -rotate-45 group-hover:text-white"></i>');

                        // Check if there are more pages
                        if ($(response).find('.review-item').length < 4) {
                            $('#loadMoreReviews').hide();
                        }

                        loading = false;
                    },
                    error: function() {
                        $('#loadMoreReviews').prop('disabled', false).html('Show All Reviews <i class="icon-base ti tabler-arrow-right icon-16px text-primary -rotate-45 group-hover:text-white"></i>');
                        loading = false;
                    }
                });
            });

            function calculateTotalPrice(packageType) {
                // Get the package container
                const $package = $(`#${packageType}Package`);
                const $priceElement = $package.find('.text-3xl');

                // STEP 1: Get ORIGINAL base price (store it once)
                let basePrice = $package.data('base-price-numeric');

                // If not stored yet, extract it from original text
                if (typeof basePrice === 'undefined') {
                    // Get original formatted price
                    const originalText = $priceElement.data('original-text') || $priceElement.text().trim();

                    // Store original text for later use
                    if (!$priceElement.data('original-text')) {
                        $priceElement.data('original-text', originalText);
                    }

                    // Extract numeric value from original price
                    const match = originalText.match(/[\d,]+\.?\d*/);
                    if (match) {
                        basePrice = parseFloat(match[0].replace(/,/g, ''));
                        $package.data('base-price-numeric', basePrice);
                    } else {
                        basePrice = 0;
                    }
                }

                // STEP 2: Calculate total from BASE PRICE + checked extras
                let total = basePrice; // Always start from base price

                // Add prices of all checked extras
                $(`.${packageType}-extra-checkbox:checked`).each(function() {
                    total += parseFloat($(this).data('price')) || 0;
                });

                // STEP 3: Format and display
                formatAndDisplayPrice($priceElement, total);
            }

            function formatAndDisplayPrice($priceElement, amount) {
                // Get original formatting details
                const originalText = $priceElement.data('original-text');
                if (!originalText) return;

                // Extract currency symbol and position
                const currencyMatch = originalText.match(/[^\d,\.\s]+/);
                const currencySymbol = currencyMatch ? currencyMatch[0].trim() : '$';
                const isCurrencyLeft = originalText.indexOf(currencySymbol) === 0;

                // Format the number (always 2 decimal places)
                let formattedNumber = amount.toFixed(2);

                // Add thousand separators
                if (formattedNumber.includes('.')) {
                    const parts = formattedNumber.split('.');
                    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                    formattedNumber = parts.join('.');
                }

                // Construct final price string
                let finalPrice;
                if (isCurrencyLeft) {
                    finalPrice = currencySymbol + formattedNumber;
                } else {
                    finalPrice = formattedNumber + ' ' + currencySymbol;
                }

                // Update the display
                $priceElement.text(finalPrice);
            }

// Initialize on page load and bind events
            $(document).ready(function() {
                // Initialize for each package type
                ['basic', 'standard', 'premium'].forEach(function(packageType) {
                    const $package = $(`#${packageType}Package`);
                    if ($package.length) {
                        const $priceElement = $package.find('.text-3xl');
                        // Store original text
                        $priceElement.data('original-text', $priceElement.text().trim());
                    }
                });

                // Bind checkbox change events
                $('.basic-extra-checkbox').on('change', function() {
                    calculateTotalPrice('basic');
                });

                $('.standard-extra-checkbox').on('change', function() {
                    calculateTotalPrice('standard');
                });

                $('.premium-extra-checkbox').on('change', function() {
                    calculateTotalPrice('premium');
                });
            });

            // Listen to checkbox changes
            $('.basic-extra-checkbox').on('change', function() {
                calculateTotalPrice('basic');
            });

            $('.standard-extra-checkbox').on('change', function() {
                calculateTotalPrice('standard');
            });

            $('.premium-extra-checkbox').on('change', function() {
                calculateTotalPrice('premium');
            });

            // Handle Continue to Order button
            $('#continueOrderBtn').on('click', function(e) {
                e.preventDefault();

                const projectId = $(this).data('project-id');
                const activePackage = $('.package-tab.active').data('package');

                // Get selected extras
                const selectedExtras = [];
                $(`.${activePackage}-extra-checkbox:checked`).each(function() {
                    selectedExtras.push($(this).attr('name').match(/\d+/)[0]);
                });

                // Build checkout URL with parameters
                const url = new URL('<?php echo e(route("order.checkout.page")); ?>', window.location.origin);
                url.searchParams.append('project_id', projectId);
                url.searchParams.append('package', activePackage);
                if(selectedExtras.length > 0) {
                    url.searchParams.append('extras', JSON.stringify(selectedExtras));
                }

                window.location.href = url.toString();
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const carouselTrack = document.getElementById('carouselTrack');
            const thumbnails = document.querySelectorAll('.thumbnail');

            if (carouselTrack && !carouselTrack.style.transform) {
                carouselTrack.style.transform = 'translateX(0%)';
            }

            if (thumbnails.length > 0 && !document.querySelector('.thumbnail.active')) {
                thumbnails[0].classList.add('active');
            }
        });

        // Enhance video thumbnails: Play on hover for details page
        const videoThumbs = document.querySelectorAll('.thumbnail video');
        videoThumbs.forEach(video => {
            video.parentElement.addEventListener('mouseenter', () => {
                video.play().catch(() => {}); // Silent catch for autoplay policies
            });
            video.parentElement.addEventListener('mouseleave', () => {
                video.pause();
                video.currentTime = 0; // Reset to start
            });
        });

        // Handle "Login to Order" button click
        $('#openLoginModalForOrder').on('click', function(e) {
            e.preventDefault();

            // Open the login modal
            $('#loginModal').removeClass('hidden').addClass('flex');
            $('body').addClass('overflow-hidden');
        });

        // Handle "Contact me" button click when not logged in
        $('#openLoginModalForContact').on('click', function(e) {
            e.preventDefault();

            // Open the login modal
            $('#loginModal').removeClass('hidden').addClass('flex');
            $('body').addClass('overflow-hidden');
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.new_design.layout.new_master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/pages/project-details/project-details.blade.php ENDPATH**/ ?>