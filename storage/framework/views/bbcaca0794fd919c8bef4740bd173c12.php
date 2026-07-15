<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
    <?php $__empty_1 = true; $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php
            // Get all media for this project
            $projectMedia = $project->media ?? [];
            $mediaCount = count($projectMedia);
            $hasMultipleMedia = $mediaCount > 1;

            // Check if project is promoted/pro
            $isPromotedProject =
                moduleExists('PromoteFreelancer') && $project->is_pro == 'yes' && $project->pro_expire_date >= now();
        ?>

        <div class="card-animate bg-white rounded-2xl shadow-lg w-full overflow-hidden">
            <figure class="relative w-full px-4 pt-4">

                <div class="carousel-container relative w-full rounded-lg overflow-hidden">
                    <!-- Dynamic Sponsored Badge -->
                    <?php if($isPromotedProject): ?>
                        <span class="bg-secondary rounded-md text-white px-2 text-sm py-1 z-10 absolute top-2 left-2">
                            <?php echo e(get_static_option('promoted_badge_text', 'Sponsored')); ?>

                        </span>
                    <?php endif; ?>

                    <?php if($mediaCount > 0): ?>
                        <!-- Carousel Track -->
                        <div class="carousel-track">
                            <?php $__currentLoopData = $projectMedia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mediaFile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $ext = pathinfo($mediaFile, PATHINFO_EXTENSION);
                                    $isImage = in_array(strtolower($ext), [
                                        'jpg',
                                        'jpeg',
                                        'png',
                                        'bmp',
                                        'tiff',
                                        'svg',
                                        'webp',
                                        'gif',
                                        'avif',
                                    ]);
                                ?>
                                <div class="carousel-slide">
                                    <?php if($isImage): ?>
                                        <?php if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])): ?>
                                            <img src="<?php echo e(render_frontend_cloud_image_if_module_exists('project/' . $mediaFile, load_from: $project->load_from)); ?>"
                                                alt="<?php echo e($project->title); ?>"
                                                onerror="this.src='<?php echo e(asset('assets/frontend/new_design/assets/images/error-images/no_jobs_found.svg')); ?>'">
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('assets/uploads/project/' . $mediaFile)); ?>"
                                                alt="<?php echo e($project->title); ?>"
                                                onerror="this.src='<?php echo e(asset('assets/frontend/new_design/assets/images/error-images/no_jobs_found.svg')); ?>'">
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])): ?>
                                            <video
                                                src="<?php echo e(render_frontend_cloud_image_if_module_exists('project/' . $mediaFile, load_from: $project->load_from)); ?>"
                                                controls muted loop playsinline>
                                                Your browser does not support the video tag.
                                            </video>
                                        <?php else: ?>
                                            <video src="<?php echo e(asset('assets/uploads/project/' . $mediaFile)); ?>" controls
                                                muted loop playsinline>
                                                Your browser does not support the video tag.
                                            </video>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <!-- Carousel navigation arrows - Show only if multiple images -->
                        <?php if($hasMultipleMedia): ?>
                            <!-- Left Arrow -->
                            <button
                                class="arrow-btn left-arrow absolute left-2 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white p-2 rounded-full shadow-lg transition-all duration-300 hidden z-10">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" class="w-5 h-5 text-gray-800">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 19.5L8.25 12l7.5-7.5" />
                                </svg>
                            </button>

                            <!-- Right Arrow -->
                            <button
                                class="arrow-btn right-arrow absolute right-2 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white p-2 rounded-full shadow-lg transition-all duration-300 z-10">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" class="w-5 h-5 text-gray-800">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </button>

                            <!-- Pagination Dots -->
                            <div class="pagination-dots-container">
                                <?php $__currentLoopData = $projectMedia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dotIndex => $mediaFile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <button
                                        class="pagination-dot w-2 h-2 rounded-full transition-all <?php echo e($dotIndex === 0 ? 'active bg-white w-4' : 'bg-white/60'); ?>"
                                        data-index="<?php echo e($dotIndex); ?>"
                                        aria-label="<?php echo e(__('Go to slide')); ?> <?php echo e($dotIndex + 1); ?>"></button>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <!-- Fallback: No image -->
                        <div class="w-full h-full flex items-center justify-center bg-gray-100">
                            <div class="text-center">
                                <svg class="w-16 h-16 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span class="text-gray-400 text-sm"><?php echo e(__('No Media')); ?></span>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Favorite Button -->
                <?php if (isset($component)) { $__componentOriginal07d3a31c875a5b6b694ce6bf32ba8cb3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal07d3a31c875a5b6b694ce6bf32ba8cb3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.bookmark2','data' => ['identity' => $project->id,'type' => 'project','btnClass' => 'absolute top-6 right-6 p-2 bg-white rounded-full hover:text-red-500 transition-colors z-20']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.bookmark2'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['identity' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($project->id),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('project'),'btnClass' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('absolute top-6 right-6 p-2 bg-white rounded-full hover:text-red-500 transition-colors z-20')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal07d3a31c875a5b6b694ce6bf32ba8cb3)): ?>
<?php $attributes = $__attributesOriginal07d3a31c875a5b6b694ce6bf32ba8cb3; ?>
<?php unset($__attributesOriginal07d3a31c875a5b6b694ce6bf32ba8cb3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal07d3a31c875a5b6b694ce6bf32ba8cb3)): ?>
<?php $component = $__componentOriginal07d3a31c875a5b6b694ce6bf32ba8cb3; ?>
<?php unset($__componentOriginal07d3a31c875a5b6b694ce6bf32ba8cb3); ?>
<?php endif; ?>
            </figure>

            <div class="p-4 space-y-3">
                <hgroup class="space-y-3">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-gray-500">
                            <?php echo e($project->project_category?->category ?? __('Service')); ?>

                        </p>
                    </div>
                    <a
                        href="<?php echo e(route('project.details', ['username' => $project->project_creator?->username, 'slug' => $project->slug])); ?>">
                        <h2 class="text-xl font-medium leading-tight text-gray-800 line-clamp-2 hover:underline">
                            <?php echo e($project->title); ?>

                        </h2>
                    </a>
                </hgroup>

                <div class="flex items-center gap-1 text-yellow-500">
                    <?php if($project->ratings_count > 0): ?>
                        <i class="fa-solid fa-star"></i>
                        <span
                            class="text-sm font-semibold text-gray-700"><?php echo e(number_format($project->average_rating ?? ($project->ratings_avg_rating ?? 0), 1)); ?></span>
                        <span class="text-sm text-gray-500">(<?php echo e($project->ratings_count); ?> <?php echo e(__('Reviews')); ?>)</span>
                    <?php else: ?>
                        <span class="text-sm text-gray-500"><?php echo e(__('No reviews yet')); ?></span>
                    <?php endif; ?>
                </div>

                <footer class="flex items-center justify-between pt-3 border-t border-gray-200">
                    <div class="flex items-center gap-3">
                        <div class="relative w-10 h-10">
                            <?php if($project->project_creator?->image): ?>
                                <img src="<?php echo e(asset('assets/uploads/profile/' . $project->project_creator->image)); ?>"
                                    alt="<?php echo e($project->project_creator->fullname); ?>"
                                    class="w-full h-full rounded-full object-cover border-2 border-white shadow"
                                    onerror="this.src='https://ui-avatars.com/api/?name=<?php echo e(urlencode($project->project_creator->fullname ?? 'User')); ?>&background=random'">
                            <?php else: ?>
                                <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($project->project_creator?->fullname ?? 'User')); ?>&background=random"
                                    alt="<?php echo e($project->project_creator?->fullname); ?>"
                                    class="w-full h-full rounded-full object-cover border-2 border-white shadow">
                            <?php endif; ?>
                            <?php if($project->project_creator?->user_verified_status == 1): ?>
                                <?php if($project->project_creator?->user_verified_status == 1): ?>
                                    <?php
                                        $isOnline = false;
                                        if ($project->project_creator?->check_online_status) {
                                            // Consider user online if last seen within last 5 minutes
                                            $isOnline =
                                                $project->project_creator->check_online_status->diffInMinutes(now()) <=
                                                5;
                                        }
                                    ?>
                                    <div
                                        class="absolute bottom-0 right-0 w-3 h-3 <?php echo e($isOnline ? 'bg-green-500' : 'bg-gray-400'); ?> rounded-full border-2 border-white">
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <span
                            class="text-sm font-semibold text-gray-700"><?php echo e($project->project_creator?->fullname ?? __('User')); ?></span>
                    </div>
                    <div class="text-right flex items-center gap-1">
                        <p class="text-xs text-gray-600"><?php echo e(__('Starting at:')); ?></p>
                        <p class="text-lg font-semibold text-gray-800">
                            <?php echo e(yaptiriyo_price_label($project->basic_discount_charge > 0 ? $project->basic_discount_charge : $project->basic_regular_charge, $project->pricing_type, true)); ?>

                        </p>
                    </div>
                </footer>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-span-3">
            <section>
                <div class="flex items-center justify-center h-full w-full py-10">
                    <div class="max-w-lg flex flex-col items-center justify-center text-center">
                        <img src="<?php echo e(asset('assets/frontend/new_design/assets/images/error-images/no_service_found.svg')); ?>"
                            alt="nothing-found">
                        <p class="text-base-300 text-base-400 text-lg">
                            <?php echo e(__("Sorry, no results found.")); ?>

                        </p>
                        <button
                            class=" px-6 mt-6 rounded-full bg-primary hover:bg-primary/90 text-white font-medium py-3 mb-3 transition-colors flex items-center justify-center gap-2">
                            <a href="<?php echo e(route('freelancer.project.create')); ?>">
                                <?php echo e(__('Create a job')); ?>

                            </a>

                            <i class="icon-base ti tabler-arrow-right icon-20px text-white -rotate-45"></i>
                        </button>
                    </div>
                </div>
            </section>
        </div>
    <?php endif; ?>
</div>

<!-- Pagination -->
<?php if($projects->hasPages()): ?>
    <?php if (isset($component)) { $__componentOriginal40bc08c7cd43bb4a699bd2fc78128c87 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal40bc08c7cd43bb4a699bd2fc78128c87 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.pagination.laravel-paginate-02','data' => ['allData' => $projects]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('pagination.laravel-paginate-02'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['allData' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($projects)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal40bc08c7cd43bb4a699bd2fc78128c87)): ?>
<?php $attributes = $__attributesOriginal40bc08c7cd43bb4a699bd2fc78128c87; ?>
<?php unset($__attributesOriginal40bc08c7cd43bb4a699bd2fc78128c87); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal40bc08c7cd43bb4a699bd2fc78128c87)): ?>
<?php $component = $__componentOriginal40bc08c7cd43bb4a699bd2fc78128c87; ?>
<?php unset($__componentOriginal40bc08c7cd43bb4a699bd2fc78128c87); ?>
<?php endif; ?>
<?php endif; ?>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/pages/subcategory-projects/search-subcategory-result.blade.php ENDPATH**/ ?>