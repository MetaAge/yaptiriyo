<section class="pt-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-medium text-base-300"><?php echo e(__('My Services')); ?></h2>
        <?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 2 && Auth::guard('web')->user()->username==$username): ?>
            <div class="create_project_show_hide">
                <a href="<?php echo e(route('freelancer.project.create')); ?>" class="flex items-center gap-2 text-primary hover:text-primary/90">
                    <i class="fas fa-plus"></i>
                    <span><?php echo e(__('Add Service')); ?></span>
                </a>
            </div>
        <?php endif; ?>
    </div>

    <div class="space-y-6 project_wrapper_area">
        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 2 && Auth::guard('web')->user()->username==$username): ?>
                <!-- Full view for own profile -->
                <div class="card-animate border border-gray-200 rounded-2xl p-4 hover:border-primary transition group">
                    <div class="flex flex-col md:flex-row gap-6">
                        <!-- Left Side - Image -->
                        <?php
                            $projectMedia = $project->media ?? [];
                            $mediaCount = count($projectMedia);
                            $hasMultipleMedia = $mediaCount > 1;
                        ?>

                                <!-- Left Side - Image -->
                        <figure class="w-full md:w-[50%] rounded-xl overflow-hidden relative flex-shrink-0">
                            <!-- Bookmark Button (only shown to clients viewing others' profiles) -->
                            <?php if(Auth::guard('web')->check() &&
                                Auth::guard('web')->user()->user_type == 1 &&
                                Auth::guard('web')->user()->id != $user->id): ?>
                                <?php if (isset($component)) { $__componentOriginal07d3a31c875a5b6b694ce6bf32ba8cb3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal07d3a31c875a5b6b694ce6bf32ba8cb3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.bookmark2','data' => ['identity' => $project->id,'type' => 'project','btnClass' => 'absolute top-2 right-2 p-2 bg-white rounded-full hover:text-red-500 transition-colors z-20']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.bookmark2'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['identity' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($project->id),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('project'),'btnClass' => 'absolute top-2 right-2 p-2 bg-white rounded-full hover:text-red-500 transition-colors z-20']); ?>
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
                            <?php elseif(!Auth::guard('web')->check()): ?>
                                <!-- Guest user bookmark button -->
                                <?php if (isset($component)) { $__componentOriginal07d3a31c875a5b6b694ce6bf32ba8cb3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal07d3a31c875a5b6b694ce6bf32ba8cb3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.bookmark2','data' => ['identity' => $project->id,'type' => 'project','btnClass' => 'absolute top-2 right-2 p-2 bg-white rounded-full hover:text-red-500 transition-colors z-20']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.bookmark2'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['identity' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($project->id),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('project'),'btnClass' => 'absolute top-2 right-2 p-2 bg-white rounded-full hover:text-red-500 transition-colors z-20']); ?>
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
                            <?php endif; ?>

                            <a href="<?php echo e(route('project.details', ['username' => $project->project_creator?->username, 'slug' => $project->slug])); ?>">
                                <?php if($mediaCount > 0): ?>
                                    <div class="carousel-container relative w-full h-48">
                                        <!-- Carousel Track -->
                                        <div class="carousel-track">
                                            <?php $__currentLoopData = $projectMedia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mediaFile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $ext = pathinfo($mediaFile, PATHINFO_EXTENSION); $isImage = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'bmp', 'tiff', 'svg', 'webp', 'gif', 'avif']); ?>
                                                <div class="carousel-slide">
                                                    
                                                    <?php if($isImage): ?>
                                                        <?php if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])): ?>
                                                            <img src="<?php echo e(render_frontend_cloud_image_if_module_exists( 'project/'.$mediaFile, load_from: $project->load_from)); ?>"
                                                                 alt="<?php echo e($project->title); ?>"
                                                                 class="w-full h-full object-cover">
                                                        <?php else: ?>
                                                            <img src="<?php echo e(asset('assets/uploads/project/'.$mediaFile)); ?>"
                                                                 alt="<?php echo e($project->title); ?>"
                                                                 class="w-full h-full object-cover">
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        
                                                        <?php
                                                            $videoSrc = cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])
                                                                ? render_frontend_cloud_image_if_module_exists('project/'.$mediaFile, load_from: $project->load_from)
                                                                : asset('assets/uploads/project/' . $mediaFile);
                                                        ?>
                                                        <video class="project-video"
                                                               src="<?php echo e($videoSrc); ?>"
                                                               muted
                                                               loop
                                                               playsinline
                                                               preload="metadata"
                                                               controlslist="nodownload nofullscreen noremoteplayback"
                                                               disablePictureInPicture>
                                                            Your browser does not support the video tag.
                                                        </video>

                                                        <!-- Center Play Button Overlay (before hover) -->
                                                        <div class="video-play-overlay-center">
                                                            <div class="play-button-circle-center">
                                                                <div class="play-icon-center"></div>
                                                            </div>
                                                        </div>

                                                        <!-- Bottom Left Play Button with Circular Progress -->
                                                        <div class="video-play-progress">
                                                            <svg class="progress-ring" width="40" height="40">
                                                                <circle class="progress-ring-circle-bg" cx="20" cy="20" r="18"></circle>
                                                                <circle class="progress-ring-circle" cx="20" cy="20" r="18"
                                                                        stroke-dasharray="113.1" stroke-dashoffset="113.1"></circle>
                                                            </svg>
                                                            <div class="play-button-small">
                                                                <div class="play-icon-small"></div>
                                                            </div>
                                                        </div>

                                                        <!-- Video Duration -->
                                                        <span class="video-duration" style="display: none;"></span>

                                                        <!-- Volume Control Button -->
                                                        <button class="video-volume-control" type="button" title="Mute/Unmute">
                                                            <!-- Muted Icon (default) -->
                                                            <svg class="volume-icon volume-muted" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                                <path d="M3.63 3.63a.996.996 0 0 0 0 1.41L7.29 8.7 7 9H4c-.55 0-1 .45-1 1v4c0 .55.45 1 1 1h3l3.29 3.29c.63.63 1.71.18 1.71-.71v-4.17l4.18 4.18c-.49.37-1.02.68-1.6.91-.36.15-.58.53-.58.92 0 .72.73 1.18 1.39.91.8-.33 1.55-.77 2.22-1.31l1.34 1.34a.996.996 0 1 0 1.41-1.41L5.05 3.63c-.39-.39-1.02-.39-1.42 0zM19 12c0 .82-.15 1.61-.41 2.34l1.53 1.53c.56-1.17.88-2.48.88-3.87 0-3.83-2.4-7.11-5.78-8.4-.59-.23-1.22.23-1.22.86v.19c0 .38.25.71.61.85C17.18 6.54 19 9.06 19 12zm-8.71-6.29-.17.17L12 7.76V6.41c0-.89-1.08-1.33-1.71-.7zM16.5 12A4.5 4.5 0 0 0 14 7.97v1.79l2.48 2.48c.01-.08.02-.16.02-.24z"/>
                                                            </svg>
                                                            <!-- Unmuted Icon (hidden by default) -->
                                                            <svg class="volume-icon volume-unmuted" style="display: none;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                                <path d="M3 10v4c0 .55.45 1 1 1h3l3.29 3.29c.63.63 1.71.18 1.71-.71V6.41c0-.89-1.08-1.34-1.71-.71L7 9H4c-.55 0-1 .45-1 1zm13.5 2A4.5 4.5 0 0 0 14 7.97v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 4.45v.2c0 .38.25.71.6.85C17.18 6.53 19 9.06 19 12s-1.82 5.47-4.4 6.5c-.36.14-.6.47-.6.85v.2c0 .63.63 1.07 1.21.85C18.6 19.11 21 15.84 21 12s-2.4-7.11-5.79-8.4c-.58-.23-1.21.22-1.21.85z"/>
                                                            </svg>
                                                        </button>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>

                                        <!-- Carousel navigation arrows - Show only if multiple images -->
                                        <?php if($hasMultipleMedia): ?>
                                            <!-- Left Arrow -->
                                            <button class="arrow-btn left-arrow absolute left-2 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white p-1.5 rounded-full shadow-lg transition-all duration-300 hidden z-10">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-gray-800">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                                                </svg>
                                            </button>

                                            <!-- Right Arrow -->
                                            <button class="arrow-btn right-arrow absolute right-2 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white p-1.5 rounded-full shadow-lg transition-all duration-300 z-10">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-gray-800">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                                </svg>
                                            </button>

                                            <!-- Pagination Dots -->
                                            <div class="pagination-dots-container">
                                                <?php $__currentLoopData = $projectMedia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dotIndex => $mediaFile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <button class="pagination-dot w-2 h-2 rounded-full transition-all <?php echo e($dotIndex === 0 ? 'active bg-white w-4' : 'bg-white/60'); ?>"
                                                            data-index="<?php echo e($dotIndex); ?>"
                                                            aria-label="<?php echo e(__('Go to slide')); ?> <?php echo e($dotIndex + 1); ?>"></button>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <!-- Fallback: No image -->
                                    <div class="w-full h-48 flex items-center justify-center bg-gray-100">
                                        <div class="text-center">
                                            <svg class="w-12 h-12 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <span class="text-gray-400 text-xs"><?php echo e(__('No Media')); ?></span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </a>

                            <!-- Status Badge (moved outside the carousel) -->
                            <?php if($project->status !== 1): ?>
                                <div class="absolute top-2 left-2 z-10">
                                    <?php if($project->status == 1): ?>
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs"><?php echo e(__('Active')); ?></span>
                                    <?php elseif($project->status == 2): ?>
                                        <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs"><?php echo e(__('Inactive')); ?></span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </figure>

                        <!-- Right Side - Content -->
                        <div class="flex-1 flex flex-col justify-between py-1">
                            <div>
                                <div class="text-base-400/90 mb-2"><?php echo e($project->project_category->category ?? __('Uncategorized')); ?></div>
                                <h3 class="text-xl font-medium text-base-300 mb-3 group-hover:text-primary transition leading-snug break-words break-all line-clamp-2">
                                    <a href="<?php echo e(route('project.details', ['username' => $project->project_creator?->username, 'slug' => $project->slug])); ?>">
                                        <?php echo e($project->title); ?>

                                    </a>
                                </h3>
                                <div class="flex items-center gap-1 text-sm mb-4">
                                    <i class="fa-solid fa-star text-amber-400"></i>
                                    <span class="font-medium text-base-300"><?php echo e(number_format($project->average_rating ?? ($project->ratings_avg_rating ?? 0), 1)); ?></span>
                                    <span class="text-gray-500">(<?php echo e($project->ratings_count ?? 0); ?> <?php echo e(__('Reviews')); ?>)</span>
                                </div>

                                <!-- Price and Delivery -->
                                <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                                    <div class="flex items-center gap-3">
                                        <div class="relative">
                                            <?php if($user->image): ?>
                                                <img src="<?php echo e(asset('assets/uploads/profile/'.$user->image)); ?>" alt="<?php echo e($user->first_name); ?>" class="w-8 h-8 rounded-full">
                                            <?php else: ?>
                                                <img src="<?php echo e(asset('assets/static/img/author/author.jpg')); ?>" alt="<?php echo e(__('AuthorImg')); ?>" class="w-8 h-8 rounded-full">
                                            <?php endif; ?>
                                        </div>
                                        <span class="font-medium text-base-300"><?php echo e($user->first_name .' '.$user->last_name); ?></span>
                                    </div>
                                    <div class="text-sm">
                                        <span class="text-gray-500"><?php echo e(__('Starting at:')); ?></span>
                                        <span class="font-medium text-base-300 text-lg">
                                                                <?php if($project->basic_discount_charge !== null && $project->basic_discount_charge > 0): ?>
                                                <?php echo e(float_amount_with_currency_symbol($project->basic_discount_charge)); ?>

                                                <s class="text-gray-400 text-sm ml-1"><?php echo e(float_amount_with_currency_symbol($project->basic_regular_charge)); ?></s>
                                            <?php else: ?>
                                                <?php echo e(float_amount_with_currency_symbol($project->basic_regular_charge)); ?>

                                            <?php endif; ?>
                                                            </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-2 pt-2 border-t border-gray-100">
                                <div class="flex items-center justify-between">

                                    <!-- Right side: Action buttons -->
                                    <div class="flex items-center gap-2">
                                        <?php if($project?->orders_count == 0): ?>
                                            <a href="javascript:void(0)"
                                               class="delete-project-btn text-red-600 hover:text-white hover:bg-red-600 text-sm font-medium px-3 py-1.5 rounded-lg transition-colors duration-200 border border-red-200 hover:border-red-600"
                                               data-project-id="<?php echo e($project->id); ?>">
                                                <?php echo e(__('Delete')); ?>

                                            </a>
                                            <span class="text-gray-300 text-sm">|</span>
                                        <?php endif; ?>

                                        <a href="<?php echo e(route('freelancer.project.edit',$project->id)); ?>"
                                           class="text-primary hover:text-white hover:bg-primary text-sm font-medium px-3 py-1.5 rounded-lg transition-colors duration-200 border border-primary/30 hover:border-primary">
                                            <?php echo e(__('Edit')); ?>

                                        </a>

                                        <?php if(moduleExists('PromoteFreelancer')): ?>
                                            <?php
                                                $current_date = \Carbon\Carbon::now()->toDateTimeString();
                                                $is_promoted = \Modules\PromoteFreelancer\Entities\PromotionProjectList::where('identity',$project->id)->where('type','project')->where('expire_date','>',$current_date)->where('payment_status','complete')->first();
                                            ?>

                                            <?php if(!empty($is_promoted)): ?>
                                                <span class="text-green-600 bg-green-50 border border-green-200 text-sm font-medium px-3 py-1.5 rounded-lg">
                                                             <?php echo e(__('Promoted')); ?>

                                                                  </span>
                                            <?php else: ?>
                                                <span class="text-gray-300 text-sm">|</span>
                                                <a href="<?php echo e(route('promotion.checkout')); ?>?project_id=<?php echo e($project->id); ?>"
                                                   class="text-primary hover:text-white hover:bg-primary text-sm font-medium px-3 py-1.5 rounded-lg transition-colors duration-200 border border-primary/30 hover:border-primary">
                                                    <?php echo e(__('Promote')); ?>

                                                </a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <!-- Simplified view for others -->
                <?php if($project->project_on_off == 1 && $project->status == 1 && $project->project_approve_request == 1): ?>
                    <?php
                        $projectMedia = $project->media ?? [];
                        $mediaCount = count($projectMedia);
                        $hasMultipleMedia = $mediaCount > 1;
                    ?>

                    <div class="card-animate border border-gray-200 rounded-2xl p-4 hover:border-primary transition group">
                        <div class="flex flex-col md:flex-row gap-6">
                            <!-- Left Side - Image -->
                            <figure class="w-full md:w-[50%] rounded-xl overflow-hidden relative flex-shrink-0">
                                <!-- Bookmark Button -->
                                <?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 1): ?>
                                    <?php if (isset($component)) { $__componentOriginal07d3a31c875a5b6b694ce6bf32ba8cb3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal07d3a31c875a5b6b694ce6bf32ba8cb3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.bookmark2','data' => ['identity' => $project->id,'type' => 'project','btnClass' => 'absolute top-2 right-2 p-2 bg-white rounded-full hover:text-red-500 transition-colors z-20']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.bookmark2'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['identity' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($project->id),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('project'),'btnClass' => 'absolute top-2 right-2 p-2 bg-white rounded-full hover:text-red-500 transition-colors z-20']); ?>
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
                                <?php elseif(!Auth::guard('web')->check()): ?>
                                    <!-- Guest user bookmark button -->
                                    <?php if (isset($component)) { $__componentOriginal07d3a31c875a5b6b694ce6bf32ba8cb3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal07d3a31c875a5b6b694ce6bf32ba8cb3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.bookmark2','data' => ['identity' => $project->id,'type' => 'project','btnClass' => 'absolute top-2 right-2 p-2 bg-white rounded-full hover:text-red-500 transition-colors z-20']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.bookmark2'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['identity' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($project->id),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('project'),'btnClass' => 'absolute top-2 right-2 p-2 bg-white rounded-full hover:text-red-500 transition-colors z-20']); ?>
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
                                <?php endif; ?>

                                <a href="<?php echo e(route('project.details', ['username' => $project->project_creator?->username, 'slug' => $project->slug])); ?>">
                                    <?php if($mediaCount > 0): ?>
                                        <div class="carousel-container relative w-full h-48">
                                            <!-- Carousel Track -->
                                            <div class="carousel-track">
                                                <?php $__currentLoopData = $projectMedia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mediaFile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $ext = pathinfo($mediaFile, PATHINFO_EXTENSION);
                                                        $isImage = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'bmp', 'tiff', 'svg', 'webp', 'gif', 'avif']);
                                                    ?>
                                                    <div class="carousel-slide">
                                                        
                                                        <?php if($isImage): ?>
                                                            <?php if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])): ?>
                                                                <img src="<?php echo e(render_frontend_cloud_image_if_module_exists( 'project/'.$mediaFile, load_from: $project->load_from)); ?>"
                                                                     alt="<?php echo e($project->title); ?>"
                                                                     class="w-full h-full object-cover">
                                                            <?php else: ?>
                                                                <img src="<?php echo e(asset('assets/uploads/project/'.$mediaFile)); ?>"
                                                                     alt="<?php echo e($project->title); ?>"
                                                                     class="w-full h-full object-cover">
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            
                                                            <?php
                                                                $videoSrc = cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])
                                                                    ? render_frontend_cloud_image_if_module_exists('project/'.$mediaFile, load_from: $project->load_from)
                                                                    : asset('assets/uploads/project/' . $mediaFile);
                                                            ?>
                                                            <video class="project-video"
                                                                   src="<?php echo e($videoSrc); ?>"
                                                                   muted
                                                                   loop
                                                                   playsinline
                                                                   preload="metadata"
                                                                   controlslist="nodownload nofullscreen noremoteplayback"
                                                                   disablePictureInPicture>
                                                                Your browser does not support the video tag.
                                                            </video>

                                                            <!-- Center Play Button Overlay (before hover) -->
                                                            <div class="video-play-overlay-center">
                                                                <div class="play-button-circle-center">
                                                                    <div class="play-icon-center"></div>
                                                                </div>
                                                            </div>

                                                            <!-- Bottom Left Play Button with Circular Progress -->
                                                            <div class="video-play-progress">
                                                                <svg class="progress-ring" width="40" height="40">
                                                                    <circle class="progress-ring-circle-bg" cx="20" cy="20" r="18"></circle>
                                                                    <circle class="progress-ring-circle" cx="20" cy="20" r="18"
                                                                            stroke-dasharray="113.1" stroke-dashoffset="113.1"></circle>
                                                                </svg>
                                                                <div class="play-button-small">
                                                                    <div class="play-icon-small"></div>
                                                                </div>
                                                            </div>

                                                            <!-- Video Duration -->
                                                            <span class="video-duration" style="display: none;"></span>

                                                            <!-- Volume Control Button -->
                                                            <button class="video-volume-control" type="button" title="Mute/Unmute">
                                                                <!-- Muted Icon (default) -->
                                                                <svg class="volume-icon volume-muted" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                                    <path d="M3.63 3.63a.996.996 0 0 0 0 1.41L7.29 8.7 7 9H4c-.55 0-1 .45-1 1v4c0 .55.45 1 1 1h3l3.29 3.29c.63.63 1.71.18 1.71-.71v-4.17l4.18 4.18c-.49.37-1.02.68-1.6.91-.36.15-.58.53-.58.92 0 .72.73 1.18 1.39.91.8-.33 1.55-.77 2.22-1.31l1.34 1.34a.996.996 0 1 0 1.41-1.41L5.05 3.63c-.39-.39-1.02-.39-1.42 0zM19 12c0 .82-.15 1.61-.41 2.34l1.53 1.53c.56-1.17.88-2.48.88-3.87 0-3.83-2.4-7.11-5.78-8.4-.59-.23-1.22.23-1.22.86v.19c0 .38.25.71.61.85C17.18 6.54 19 9.06 19 12zm-8.71-6.29-.17.17L12 7.76V6.41c0-.89-1.08-1.33-1.71-.7zM16.5 12A4.5 4.5 0 0 0 14 7.97v1.79l2.48 2.48c.01-.08.02-.16.02-.24z"/>
                                                                </svg>
                                                                <!-- Unmuted Icon (hidden by default) -->
                                                                <svg class="volume-icon volume-unmuted" style="display: none;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                                    <path d="M3 10v4c0 .55.45 1 1 1h3l3.29 3.29c.63.63 1.71.18 1.71-.71V6.41c0-.89-1.08-1.34-1.71-.71L7 9H4c-.55 0-1 .45-1 1zm13.5 2A4.5 4.5 0 0 0 14 7.97v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 4.45v.2c0 .38.25.71.6.85C17.18 6.53 19 9.06 19 12s-1.82 5.47-4.4 6.5c-.36.14-.6.47-.6.85v.2c0 .63.63 1.07 1.21.85C18.6 19.11 21 15.84 21 12s-2.4-7.11-5.79-8.4c-.58-.23-1.21.22-1.21.85z"/>
                                                                </svg>
                                                            </button>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>

                                            <!-- Carousel navigation arrows - Show only if multiple images -->
                                            <?php if($hasMultipleMedia): ?>
                                                <!-- Left Arrow -->
                                                <button class="arrow-btn left-arrow absolute left-2 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white p-1.5 rounded-full shadow-lg transition-all duration-300 hidden z-10">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-gray-800">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                                                    </svg>
                                                </button>

                                                <!-- Right Arrow -->
                                                <button class="arrow-btn right-arrow absolute right-2 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white p-1.5 rounded-full shadow-lg transition-all duration-300 z-10">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-gray-800">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                                    </svg>
                                                </button>

                                                <!-- Pagination Dots -->
                                                <div class="pagination-dots-container">
                                                    <?php $__currentLoopData = $projectMedia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dotIndex => $mediaFile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <button class="pagination-dot w-1.5 h-1.5 rounded-full transition-all <?php echo e($dotIndex === 0 ? 'active bg-white w-3' : 'bg-white/60'); ?>"
                                                                data-index="<?php echo e($dotIndex); ?>"
                                                                aria-label="<?php echo e(__('Go to image')); ?> <?php echo e($dotIndex + 1); ?>"></button>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php else: ?>
                                        <!-- Fallback: No image -->
                                        <div class="w-full h-48 flex items-center justify-center bg-gray-100">
                                            <div class="text-center">
                                                <svg class="w-12 h-12 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                <span class="text-gray-400 text-xs"><?php echo e(__('No Media')); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </figure>

                            <!-- Right Side - Content -->
                            <div class="flex-1 flex flex-col justify-between py-1">
                                <!-- Top: category, title, rating -->
                                <div>
                                    <div class="text-base-400/90 mb-2"><?php echo e($project->project_category->category ?? __('Uncategorized')); ?></div>
                                    <h3 class="text-xl font-medium text-base-300 mb-3 group-hover:text-primary transition leading-snug break-words break-all line-clamp-2">
                                        <a href="<?php echo e(route('project.details', ['username' => $project->project_creator?->username, 'slug' => $project->slug])); ?>">
                                            <?php echo e($project->title); ?>

                                        </a>
                                    </h3>
                                    <div class="flex items-center gap-1 text-sm">
                                        <i class="fa-solid fa-star text-amber-400"></i>
                                        <span class="font-medium text-base-300"><?php echo e(number_format($project->average_rating ?? ($project->ratings_avg_rating ?? 0), 1)); ?></span>
                                        <span class="text-gray-500">(<?php echo e($project->ratings_count ?? 0); ?> <?php echo e(__('Reviews')); ?>)</span>
                                    </div>
                                </div>

                                <div class="mt-4 pt-4 border-t border-gray-100">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="relative">
                                                <?php if($user->image): ?>
                                                    <img src="<?php echo e(asset('assets/uploads/profile/'.$user->image)); ?>" alt="<?php echo e($user->first_name); ?>" class="w-8 h-8 rounded-full">
                                                <?php else: ?>
                                                    <img src="<?php echo e(asset('assets/static/img/author/author.jpg')); ?>" alt="<?php echo e(__('AuthorImg')); ?>" class="w-8 h-8 rounded-full">
                                                <?php endif; ?>
                                            </div>
                                            <span class="font-medium text-base-300"><?php echo e($user->first_name .' '.$user->last_name); ?></span>
                                        </div>
                                        <div class="text-sm">
                                            <span class="text-gray-500"><?php echo e(__('Starting at:')); ?></span>
                                            <span class="font-medium text-base-300 text-lg">
                                                <?php if($project->basic_discount_charge !== null && $project->basic_discount_charge > 0): ?>
                                                    <?php echo e(float_amount_with_currency_symbol($project->basic_discount_charge)); ?>

                                                    <s class="text-gray-400 text-sm ml-1"><?php echo e(float_amount_with_currency_symbol($project->basic_regular_charge)); ?></s>
                                                <?php else: ?>
                                                    <?php echo e(float_amount_with_currency_symbol($project->basic_regular_charge)); ?>

                                                <?php endif; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php if($projects->count() == 0): ?>
            <div class="border border-gray-200 rounded-2xl p-8 text-center">
                <p class="text-base-400"><?php echo e(__('No services added yet.')); ?></p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Show All Services Button -->
    <?php if($projects->count() > 3): ?>
        <div class="mt-6">
            <a href="<?php echo e(route('projects.all')); ?>?user=<?php echo e($user->username); ?>"
               class="show-all-services inline-flex items-center gap-2 text-primary hover:bg-primary group hover:text-white font-medium text-sm border border-primary hover:border-primary/90 px-4 py-2.5 rounded-md transition-colors duration-300">
                <?php echo e(__('Show All Services')); ?>

                <i class="icon-base ti tabler-arrow-right icon-16px text-primary -rotate-45 group-hover:text-white"></i>
            </a>
        </div>
    <?php endif; ?>
</section><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/profile-details/project.blade.php ENDPATH**/ ?>