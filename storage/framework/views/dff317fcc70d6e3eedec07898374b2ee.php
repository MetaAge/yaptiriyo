<div id="topTalents" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
    <?php $__empty_1 = true; $__currentLoopData = $talents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $talent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php
            $skills = $talent->freelancer_skill->take(5) ?? collect();
            $skillsCount = $talent->freelancer_skill->count();
            $freelancerLevel = moduleExists('FreelancerLevel') ? freelancer_level($talent->id, 'talent') : '';
            $rating = $talent->freelancer_ratings_avg_rating ?? 0;
            $ratingsCount = $talent->freelancer_ratings_count ?? 0;
        ?>

        <div class="card-animate rounded-2xl p-6 w-full border border-[#C4C8CE] bg-white flex flex-col">
            <!-- Header Section -->
            <div class="flex items-start gap-4 mb-6 sm:mb-8">
                <!-- Profile Image and Status Dot -->
                <a href="<?php echo e(route('freelancer.profile.details', $talent->username)); ?>" class="relative flex-shrink-0">
                    <?php if($talent->image): ?>
                        <img src="<?php echo e(asset('assets/uploads/profile/' . $talent->image)); ?>"
                             alt="<?php echo e($talent->full_name); ?>"
                             class="w-20 h-20 rounded-full object-cover border border-gray-200 cursor-pointer hover:opacity-90 transition"
                             onerror="this.src='<?php echo e(asset('assets/frontend/new_design/assets/images/error-images/no_jobs_found.svg')); ?>'">
                    <?php else: ?>
                        <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($talent->full_name)); ?>&background=random"
                             alt="<?php echo e($talent->full_name); ?>"
                             class="w-20 h-20 rounded-full object-cover border border-gray-200 cursor-pointer hover:opacity-90 transition">
                    <?php endif; ?>

                    <!-- Online Status Indicator - Show for ALL freelancers -->
                    <?php
                        $isOnline = false;
                        if ($talent->check_online_status) {
                            try {
                                // Handle both Carbon instance and string
                                $lastSeen = $talent->check_online_status instanceof \Carbon\Carbon
                                    ? $talent->check_online_status
                                    : \Carbon\Carbon::parse($talent->check_online_status);
                                $isOnline = $lastSeen->diffInMinutes(now()) <= 5;
                            } catch (\Exception $e) {
                                $isOnline = false;
                            }
                        }
                    ?>
                    <div class="absolute bottom-1 right-1 w-4 h-4 <?php echo e($isOnline ? 'bg-green-500' : 'bg-gray-400'); ?> border-2 border-white rounded-full"></div>
                </a>

                <!-- Profile Info -->
                <div class="flex-grow">
                    <div class="profile-line flex items-center flex-wrap gap-2 mb-2" data-wrap-check>
                        <a href="<?php echo e(route('freelancer.profile.details', $talent->username)); ?>"
                           class="name text-xl font-medium text-gray-800 hover:text-primary hover:underline cursor-pointer transition">
                            <?php echo e($talent->full_name); ?>

                        </a>
                        <?php if($talent->user_verified_status == 1): ?>
                            <span class="divider text-gray-400 font-light">|</span>
                            <i class="fas fa-circle-check text-blue-500"></i>
                        <?php endif; ?>
                        <?php if($talent->is_pro_freelancer): ?>
                            <span class="badge text-sm font-medium text-primary bg-primary/10 rounded-full px-2 py-1">
                                <?php echo e(get_static_option('promoted_badge_text', 'Vetted Pro')); ?>

                            </span>
                        <?php elseif($talent->created_at && $talent->created_at->diffInDays(now()) < 7): ?>
                            <span class="badge text-sm font-medium text-green-600 bg-green-100 rounded-full px-2 py-1">
                                <?php echo e(__('New')); ?>

                            </span>
                        <?php endif; ?>
                    </div>

                    <!-- Rating -->
                    <div class="flex items-start gap-1 mb-2">
                        <?php if($rating > 0): ?>
                            <div class="flex text-yellow-400 items-center">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.373 4.225a1 1 0 00.95.691h4.444c.969 0 1.371 1.24.588 1.81l-3.593 2.617a1 1 0 00-.364 1.118l1.373 4.225c.3.921-.755 1.688-1.542 1.118l-3.593-2.617a1 1 0 00-1.176 0l-3.593 2.617c-.787.57-1.842-.197-1.542-1.118l1.373-4.225a1 1 0 00-.364-1.118L2.091 9.653c-.783-.57-.381-1.81.588-1.81h4.444a1 1 0 00.95-.691l1.373-4.225z"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-semibold text-gray-800"><?php echo e(number_format($rating, 1)); ?></span>
                            <span class="text-sm text-gray-500">(<?php echo e($ratingsCount); ?>)</span>
                        <?php else: ?>
                            <span class="text-sm text-gray-500"><?php echo e(__('No ratings yet')); ?></span>
                        <?php endif; ?>
                    </div>

                    <a href="<?php echo e(route('freelancer.profile.details', $talent->username)); ?>"
                       class="text-base-300 hover:text-primary hover:underline cursor-pointer transition">
                        <?php echo e($talent->user_introduction?->title ?? __('Freelancer')); ?>

                    </a>
                </div>
            </div>

            <!-- Skills Section -->
            <div class="flex flex-wrap gap-2 mb-6 min-h-[40px] items-center">
                <?php
                    $allSkills = [];
                    foreach($skills as $skill) {
                        $skillArray = array_map('trim', explode(',', $skill->skill));
                        $allSkills = array_merge($allSkills, $skillArray);
                    }
                    $displaySkills = array_slice($allSkills, 0, 5);
                    $remainingCount = count($allSkills) - 5;
                ?>

                <?php $__empty_2 = true; $__currentLoopData = $displaySkills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $individualSkill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                    <span class="px-2 py-0.5 bg-[#ecedefe0] text-base-300 rounded-lg text-[13px] inline-flex items-center justify-center h-[28px]">
            <?php echo e($individualSkill); ?>

        </span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                    <span class="px-2 py-0.5 bg-gray-100 text-gray-500 rounded-lg text-[13px] inline-flex items-center justify-center h-[28px]">
            <?php echo e(__('No skills added')); ?>

        </span>
                <?php endif; ?>

                <?php if($remainingCount > 0): ?>
                    <span class="px-2 py-0.5 bg-primary/10 text-primary rounded-lg text-[13px] font-medium inline-flex items-center justify-center h-[28px]">
            +<?php echo e($remainingCount); ?>

        </span>
                <?php endif; ?>
            </div>

            <!-- Location and Rate Section -->
            <div class="grid grid-cols-2 gap-4 mb-6 mt-auto">
                <div>
                    <p class="font-medium"><?php echo e(__('Location:')); ?></p>
                    <p class="text-base-300">
                        <?php echo e($talent->user_country?->country ?? __('Not specified')); ?>

                        <?php if($talent->user_state): ?>
                            , <?php echo e($talent->user_state?->state); ?>

                        <?php endif; ?>
                    </p>
                </div>
                <div>
                    <p class="font-medium"><?php echo e(__('Rate:')); ?></p>
                    <p class="text-base-300">
                        <?php if($talent->hourly_rate): ?>
                            <?php echo e(float_amount_with_currency_symbol($talent->hourly_rate)); ?> / hr
                        <?php else: ?>
                            <?php echo e(__('Not specified')); ?>

                        <?php endif; ?>
                    </p>
                </div>
            </div>

            <!-- Call to Action Button -->
            <a href="<?php echo e(route('freelancer.profile.details', $talent->username)); ?>"
               class="text-primary inline-flex font-medium hover:text-base-100 hover:bg-primary transition-all duration-300 border px-4 py-2 rounded-lg border-primary/50 items-center gap-2 w-fit mt-auto">
                <?php echo e(__('View Profile')); ?>

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                </svg>
            </a>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-span-3">
            <section>
                <div class="flex items-center justify-center min-h-[calc(100vh-171px)] w-full py-10">
                    <div class="max-w-md flex flex-col items-center justify-center">
                        <img src="<?php echo e(asset('assets/frontend/new_design/assets/images/error-images/no_jobs_found.svg')); ?>" alt="nothing-found">
                        <p class="text-base-300 text-2xl"><?php echo e(__('Ops! Sorry, no talents found.')); ?></p>
                    </div>
                </div>
            </section>
        </div>
    <?php endif; ?>
</div>

<!-- Pagination -->
<?php if (isset($component)) { $__componentOriginal40bc08c7cd43bb4a699bd2fc78128c87 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal40bc08c7cd43bb4a699bd2fc78128c87 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.pagination.laravel-paginate-02','data' => ['allData' => $talents]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('pagination.laravel-paginate-02'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['allData' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($talents)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal40bc08c7cd43bb4a699bd2fc78128c87)): ?>
<?php $attributes = $__attributesOriginal40bc08c7cd43bb4a699bd2fc78128c87; ?>
<?php unset($__attributesOriginal40bc08c7cd43bb4a699bd2fc78128c87); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal40bc08c7cd43bb4a699bd2fc78128c87)): ?>
<?php $component = $__componentOriginal40bc08c7cd43bb4a699bd2fc78128c87; ?>
<?php unset($__componentOriginal40bc08c7cd43bb4a699bd2fc78128c87); ?>
<?php endif; ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/pages/talent/search-talent-result.blade.php ENDPATH**/ ?>