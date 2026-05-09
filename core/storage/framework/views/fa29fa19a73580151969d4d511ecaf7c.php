<?php if(get_static_option('project_enable_disable') != 'disable'): ?>
    <!-- Popular Services Section -->
    <section id="popularServices" class="py-10 md:py-16 lg:py-28 bg-[#F8F9FD]" data-padding-top="<?php echo e($padding_top ?? ''); ?>" data-padding-bottom="<?php echo e($padding_bottom ?? ''); ?>" style="background-color:<?php echo e($section_bg ?? ''); ?>">
        <div class="mx-auto max-w-7xl px-6">
            <!-- Section Title with Category Tags -->
            <div class="flex flex-col gap-4 lg:flex-row items-center justify-between mb-[40px]">
                <h2 class="text-4xl text-base-300 font-medium text-center lg:text-left animate-on-scroll">
                    Popüler Hizmetler
                </h2>

                <?php if(!empty($category_tags) && is_array($category_tags) && count($category_tags) > 0): ?>
                    <div class="flex items-center justify-center flex-wrap gap-2">
                        <?php $__currentLoopData = $category_tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e($tag['tag_url'] ?? '#'); ?>"
                               class="category-btn text-primary flex font-medium hover:text-base-100 hover:bg-primary transition-all duration-300 border px-4 py-2 rounded-lg border-primary/50 items-center gap-2"
                               <?php if(empty($tag['tag_url'])): ?> onclick="return false;" <?php endif; ?>>
                                <?php echo e($tag['tag_text']); ?>

                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Popular Services Cards -->
            <div id="servicesCards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php $__currentLoopData = $top_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <?php
                        // Skip projects if freelancer is not available for work
                        if (!$project->project_creator || $project->project_creator->check_work_availability != 1) {
                            continue; // Skip this project entirely
                        }

                        // Rest of your existing code
                        $categoryName = $project->project_category->category ?? __('Service');
                        $totalRatings = $project->ratings->count();
                        $averageRating = $totalRatings > 0 ? $project->ratings->avg('rating') : 0;
                        $formattedAverageRating = number_format($averageRating, 1);

                        // Check if project is promoted/pro
                        $isPromotedProject = moduleExists('PromoteFreelancer') &&
                                            $project->is_pro == 'yes' &&
                                            $project->pro_expire_date >= now();

                        // Get freelancer level using your helper function - only if module exists
                        $freelancerLevel = moduleExists('FreelancerLevel') ? freelancer_level($project->project_creator?->id) : null;
                        $badgeText = !empty($freelancerLevel) ? $freelancerLevel : '';

                                            // Check if bookmarked
                                            if (Auth::guard('web')->check()) {
                                                $bookmark_exists = \App\Models\Bookmark::where('user_id', Auth::guard('web')->user()->id)
                                                    ->where('identity', $project->id)
                                                    ->where('is_project_job', 'project')
                                                    ->first();

                                                $user_type = Auth::guard('web')->user()->user_type;
                                                $add_route = $user_type == 1 ? route('client.bookmark') : route('freelancer.bookmark');
                                                $remove_route = $user_type == 1 ? route('client.bookmark.remove') : route('freelancer.bookmark.remove');
                                            }
                    ?>

                            <!-- Card -->
                    <div class="card-animate bg-white rounded-[24px] border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_20px_50px_rgba(0,0,0,0.1)] hover:-translate-y-1 transition-all duration-500 w-full overflow-hidden group">
                        <figure class="relative w-full px-3 pt-3">
                            <?php
                                // Get all media (images + videos) for this project
                                $projectMedia = $project->media ?? [];
                                $mediaCount = count($projectMedia);
                                $hasMultipleMedia = $mediaCount > 1;
                            ?>

                            <div class="carousel-container relative w-full rounded-lg overflow-hidden" data-carousel-id="carousel-<?php echo e($project->id); ?>">
                                <?php if($mediaCount > 0): ?>
                                    <div class="carousel-track">
                                        <?php $__currentLoopData = $projectMedia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mediaIndex => $mediaFile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $ext = pathinfo($mediaFile, PATHINFO_EXTENSION);
                                                $isImage = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'bmp', 'tiff', 'svg', 'webp', 'gif', 'avif']);
                                            ?>
                                            <div class="carousel-slide">
                                                <?php if($isImage): ?>
                                                    <?php if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])): ?>
                                                        <img src="<?php echo e(render_frontend_cloud_image_if_module_exists('project/'.$mediaFile, load_from: $project->load_from)); ?>"
                                                             alt="<?php echo e($project->title ?? ''); ?>"
                                                             class="w-full h-full object-cover">
                                                    <?php else: ?>
                                                        <img src="<?php echo e(asset('assets/uploads/project/'.$mediaFile)); ?>"
                                                             alt="<?php echo e($project->title ?? ''); ?>"
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

                                    <!-- Carousel navigation arrows - Show only if multiple media -->
                                    <?php if($hasMultipleMedia): ?>
                                        <button class="arrow-btn left-arrow absolute left-2 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white p-2 rounded-full shadow-lg transition-all duration-300 hidden" data-carousel-id="carousel-<?php echo e($project->id); ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-gray-800">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                                            </svg>
                                        </button>
                                        <button class="arrow-btn right-arrow absolute right-2 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white p-2 rounded-full shadow-lg transition-all duration-300" data-carousel-id="carousel-<?php echo e($project->id); ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-gray-800">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                            </svg>
                                        </button>

                                        <!-- Carousel pagination dots -->
                                        <div class="pagination-dots-container">
                                            <?php $__currentLoopData = $projectMedia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dotIndex => $mediaFile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <button class="pagination-dot w-2 h-2 rounded-full transition-all <?php echo e($dotIndex === 0 ? 'active' : ''); ?>"
                                                        data-carousel-id="carousel-<?php echo e($project->id); ?>"
                                                        data-index="<?php echo e($dotIndex); ?>"
                                                        aria-label="<?php echo e(__('Go to image')); ?> <?php echo e($dotIndex + 1); ?>"></button>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <!-- Fallback: No image -->
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                        <div class="text-center">
                                            <svg class="w-16 h-16 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <span class="text-gray-400 text-sm">Görsel Yok</span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                             <!-- Favorite Button -->
                            <?php if(Auth::guard('web')->check()): ?>
                                <?php if($bookmark_exists): ?>
                                    
                                    <button type="button"
                                            aria-label="<?php echo e(__('Remove from favorites')); ?>"
                                            class="absolute top-6 right-6 p-2 bg-white/80 backdrop-blur-md rounded-full hover:text-red-500 transition-all duration-300 z-20 popular-project-bookmark-btn shadow-sm hover:shadow-md"
                                            data-bookmark-id="<?php echo e($bookmark_exists->id); ?>"
                                            data-identity="<?php echo e($project->id); ?>"
                                            data-type="project"
                                            data-add-route="<?php echo e($add_route); ?>"
                                            data-remove-route="<?php echo e($remove_route); ?>"
                                            data-is-bookmarked="true"
                                            onclick="popularProjectBookmarkHandler.toggleBookmark(event, this)"
                                            style="pointer-events: auto;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-500"
                                             style="pointer-events: none;">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                                                  style="pointer-events: none;" />
                                        </svg>
                                    </button>
                                <?php else: ?>
                                    
                                    <button type="button"
                                            aria-label="<?php echo e(__('Add to favorites')); ?>"
                                            class="absolute top-6 right-6 p-2 bg-white/80 backdrop-blur-md rounded-full hover:text-red-500 transition-all duration-300 z-20 popular-project-bookmark-btn shadow-sm hover:shadow-md"
                                            data-identity="<?php echo e($project->id); ?>"
                                            data-type="project"
                                            data-add-route="<?php echo e($add_route); ?>"
                                            data-remove-route="<?php echo e($remove_route); ?>"
                                            data-is-bookmarked="false"
                                            onclick="popularProjectBookmarkHandler.toggleBookmark(event, this)"
                                            style="pointer-events: auto;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-5 h-5"
                                             style="pointer-events: none;">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                                                  style="pointer-events: none;" />
                                        </svg>
                                    </button>
                                <?php endif; ?>
                            <?php else: ?>
                                
                                <button type="button"
                                        aria-label="<?php echo e(__('Add to favorites (Login required)')); ?>"
                                        class="absolute top-6 right-6 p-2 bg-white/80 backdrop-blur-md rounded-full hover:text-red-500 transition-all duration-300 z-20 popular-project-bookmark-btn shadow-sm hover:shadow-md"
                                        onclick="popularProjectBookmarkHandler.loginRequired(event)"
                                        style="pointer-events: auto;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-5 h-5"
                                         style="pointer-events: none;">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                                              style="pointer-events: none;" />
                                    </svg>
                                </button>
                            <?php endif; ?>
                            <!-- Sponsored Badge -->
                            <?php if($isPromotedProject): ?>
                                <span class="bg-[#FA8C00]/90 backdrop-blur-sm rounded-lg text-white px-3 py-1 text-[11px] font-bold uppercase tracking-wider z-10 absolute top-6 left-6 shadow-lg border border-white/20">
                                    <?php echo e(get_static_option('promoted_badge_text', __('Öne Çıkan'))); ?>

                                </span>
                            <?php endif; ?>
                        </figure>

                        <div class="px-5 pb-5 pt-2 space-y-3">
                            <hgroup class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <!-- Dynamic Category -->
                                    <p class="text-sm font-medium text-gray-500"><?php echo e($categoryName); ?></p>

                                    <!-- Dynamic Level Badge (only show if NOT promoted) -->
                                    <?php if(!empty($badgeText)): ?>
                                        <p class="bg-secondary/20 px-2 py-1 rounded-lg text-secondary text-xs font-medium">
                                            <?php echo e($badgeText); ?>

                                        </p>
                                    <?php endif; ?>
                                </div>
                                <a class="block" href="<?php echo e(route('project.details', ['username' => $project->project_creator?->username, 'slug' => $project->slug])); ?>">
                                    <h2 class="text-xl font-semibold leading-tight text-base-300 line-clamp-2 hover:text-primary transition-colors duration-300">
                                         <?php echo e($project->title); ?>

                                     </h2>
                                 </a>
                             </hgroup>
 
                             <!-- Dynamic Rating -->
                             <div class="flex items-center gap-1.5">
                                 <div class="flex text-amber-400 text-xs">
                                     <i class="fa-solid fa-star"></i>
                                 </div>
                                 <span class="text-sm font-bold text-base-300"><?php echo e($formattedAverageRating); ?></span>
                                 <span class="text-xs text-gray-400">(<?php echo e($totalRatings); ?>)</span>
                             </div>
 
                             <footer class="flex items-center justify-between pt-4 mt-2 border-t border-gray-50">
                                 <!-- Author Info -->
                                 <div class="flex items-center gap-2.5">
                                     <div class="relative w-9 h-9">
                                         <?php if(!empty($project->project_creator?->image)): ?>
                                             <?php if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])): ?>
                                                 <img src="<?php echo e(render_frontend_cloud_image_if_module_exists('profile/'.$project->project_creator?->image, load_from: $project->project_creator?->load_from)); ?>"
                                                      alt="<?php echo e($project->project_creator?->fullname); ?>"
                                                      class="w-full h-full rounded-full object-cover ring-2 ring-white shadow-sm">
                                             <?php else: ?>
                                                 <img src="<?php echo e(asset('assets/uploads/profile/'.$project->project_creator?->image)); ?>"
                                                      alt="<?php echo e($project->project_creator?->fullname); ?>"
                                                      class="w-full h-full rounded-full object-cover ring-2 ring-white shadow-sm">
                                             <?php endif; ?>
                                         <?php else: ?>
                                             <img src="<?php echo e(asset('assets/static/img/author/author.jpg')); ?>"
                                                  alt="<?php echo e($project->project_creator?->fullname); ?>"
                                                  class="w-full h-full rounded-full object-cover ring-2 ring-white shadow-sm">
                                         <?php endif; ?>
                                         <!-- Online Status Indicator -->
                                         <?php if($project->project_creator): ?>
                                             <?php
                                                 $isOnline = false;
                                                 if ($project->project_creator->check_online_status) {
                                                     // Consider user online if last seen within last 5 minutes
                                                     $isOnline = $project->project_creator->check_online_status->diffInMinutes(now()) <= 5;
                                                 }
                                             ?>
                                             <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 <?php echo e($isOnline ? 'bg-green-500' : 'bg-gray-300'); ?> rounded-full border-2 border-white shadow-sm"></div>
                                         <?php endif; ?>
                                     </div>
                                     <span class="text-[13px] font-medium text-base-300 hover:text-primary transition-colors cursor-pointer">
                                         <?php echo e(\Illuminate\Support\Str::limit($project->project_creator?->fullname ?? __('Anonymous'), 15)); ?>

                                     </span>
                                 </div>
 
                                 <!-- Price -->
                                 <div class="text-right">
                                     <p class="text-[11px] text-gray-400 font-medium uppercase tracking-wider mb-0.5"><?php echo e(__('Başlayan fiyatlarla')); ?></p>
                                     <p class="text-lg font-bold text-primary">
                                         <?php if($project->basic_discount_charge): ?>
                                             <?php echo e(float_amount_with_currency_symbol($project->basic_discount_charge)); ?>

                                         <?php else: ?>
                                             <?php echo e(float_amount_with_currency_symbol($project->basic_regular_charge)); ?>

                                         <?php endif; ?>
                                     </p>
                                 </div>
                             </footer>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <style>
            /* Video Styling for Popular Services */
            .carousel-slide video {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
            }

            .carousel-slide {
                position: relative;
                aspect-ratio: 16/9;
                background: #000;
            }

            .carousel-slide img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            /* Center Play Button Overlay (before hover) */
            .video-play-overlay-center {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                background: rgba(0, 0, 0, 0.3);
                opacity: 1;
                transition: opacity 0.3s ease;
                z-index: 5;
                pointer-events: none;
            }

            .carousel-slide:hover .video-play-overlay-center,
            .carousel-slide.video-playing .video-play-overlay-center {
                opacity: 0;
                visibility: hidden;
            }

            .play-button-circle-center {
                width: 64px;
                height: 64px;
                background: rgba(255, 255, 255, 0.9);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            }

            .play-icon-center {
                width: 0;
                height: 0;
                border-left: 16px solid #000;
                border-top: 10px solid transparent;
                border-bottom: 10px solid transparent;
                margin-left: 4px;
            }

            /* Bottom Left Play Button with Progress */
            .video-play-progress {
                position: absolute;
                bottom: 12px;
                left: 12px;
                width: 40px;
                height: 40px;
                z-index: 6;
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .carousel-slide:hover .video-play-progress,
            .carousel-slide.video-playing .video-play-progress {
                opacity: 1;
            }

            .progress-ring {
                transform: rotate(-90deg);
            }

            .progress-ring-circle-bg {
                fill: none;
                stroke: rgba(255, 255, 255, 0.3);
                stroke-width: 3;
            }

            .progress-ring-circle {
                fill: none;
                stroke: #fff;
                stroke-width: 3;
                stroke-linecap: round;
                transition: stroke-dashoffset 0.1s linear;
            }

            .play-button-small {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 32px;
                height: 32px;
                background: rgba(0, 0, 0, 0.7);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .play-icon-small {
                width: 0;
                height: 0;
                border-left: 10px solid #fff;
                border-top: 6px solid transparent;
                border-bottom: 6px solid transparent;
                margin-left: 2px;
            }

            /* Video duration badge */
            .video-duration {
                position: absolute;
                bottom: 12px;
                right: 56px;
                background: rgba(0, 0, 0, 0.8);
                color: white;
                padding: 4px 8px;
                border-radius: 4px;
                font-size: 11px;
                font-weight: 600;
                z-index: 6;
                letter-spacing: 0.5px;
            }

            /* Volume Control Button */
            .video-volume-control {
                position: absolute;
                bottom: 12px;
                right: 12px;
                width: 36px;
                height: 36px;
                background: rgba(0, 0, 0, 0.7);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                z-index: 7;
                opacity: 0;
                transition: all 0.3s ease;
            }

            .carousel-slide:hover .video-volume-control,
            .carousel-slide.video-playing .video-volume-control {
                opacity: 1;
            }

            .video-volume-control:hover {
                background: rgba(0, 0, 0, 0.9);
                transform: scale(1.1);
            }

            .video-volume-control svg {
                width: 20px;
                height: 20px;
                fill: #fff;
            }

            /* Hide video controls */
            .carousel-slide video::-webkit-media-controls {
                display: none !important;
            }

            .carousel-slide video::-webkit-media-controls-enclosure {
                display: none !important;
            }

            .carousel-slide video::-webkit-media-controls-panel {
                display: none !important;
            }
        </style>
    </section>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize all card image carousels
            const cards = document.querySelectorAll('.card-animate');

            cards.forEach((card) => {
                const carouselWrapper = card.querySelector('.carousel-container');
                if (!carouselWrapper) return;

                const carouselId = carouselWrapper.getAttribute('data-carousel-id');
                const track = card.querySelector('.carousel-track');
                const slides = card.querySelectorAll('.carousel-slide');
                const leftArrow = card.querySelector('.left-arrow[data-carousel-id="' + carouselId + '"]');
                const rightArrow = card.querySelector('.right-arrow[data-carousel-id="' + carouselId + '"]');
                const dots = card.querySelectorAll('.pagination-dot[data-carousel-id="' + carouselId + '"]');

                if (!track || slides.length === 0) return;

                let currentIndex = 0;
                const totalSlides = slides.length;

                // Only enable carousel if multiple images
                if (totalSlides === 1) {
                    return; // Single image, no carousel needed
                }

                function updateCarousel() {
                    const offset = -currentIndex * 100;
                    track.style.transform = 'translateX(' + offset + '%)';

                    // Update dots
                    dots.forEach(function(dot, index) {
                        if (index === currentIndex) {
                            dot.classList.add('active');
                            dot.style.backgroundColor = '#ffffff'; // White color for active
                        } else {
                            dot.classList.remove('active');
                            dot.style.backgroundColor = 'rgba(255, 255, 255, 0.6)'; // White/60 for inactive
                        }
                    });

                    // Update arrow visibility
                    if (leftArrow) {
                        if (currentIndex === 0) {
                            leftArrow.classList.add('hidden');
                        } else {
                            leftArrow.classList.remove('hidden');
                        }
                    }
                    if (rightArrow) {
                        if (currentIndex === totalSlides - 1) {
                            rightArrow.style.opacity = '0.5';
                            rightArrow.style.cursor = 'default';
                        } else {
                            rightArrow.style.opacity = '1';
                            rightArrow.style.cursor = 'pointer';
                        }
                    }
                }

                // Left arrow click
                if (leftArrow) {
                    leftArrow.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        if (currentIndex > 0) {
                            currentIndex--;
                            updateCarousel();
                        }
                    });
                }

                // Right arrow click
                if (rightArrow) {
                    rightArrow.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        if (currentIndex < totalSlides - 1) {
                            currentIndex++;
                            updateCarousel();
                        }
                    });
                }

                // Dot click
                dots.forEach(function(dot) {
                    dot.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        currentIndex = parseInt(dot.getAttribute('data-index'));
                        updateCarousel();
                    });
                });

                // Touch/swipe support
                let touchStartX = 0;
                let touchEndX = 0;

                track.addEventListener('touchstart', function(e) {
                    touchStartX = e.changedTouches[0].screenX;
                }, { passive: true });

                track.addEventListener('touchend', function(e) {
                    touchEndX = e.changedTouches[0].screenX;
                    handleSwipe();
                }, { passive: true });

                function handleSwipe() {
                    const swipeThreshold = 50;
                    if (touchStartX - touchEndX > swipeThreshold && currentIndex < totalSlides - 1) {
                        // Swipe left
                        currentIndex++;
                        updateCarousel();
                    } else if (touchEndX - touchStartX > swipeThreshold && currentIndex > 0) {
                        // Swipe right
                        currentIndex--;
                        updateCarousel();
                    }
                }

                // Initialize
                updateCarousel();
            });

            // Popular Project Bookmark Handler
            window.popularProjectBookmarkHandler = {
                isProcessing: false,

                toggleBookmark: function(event, button) {
                    event.preventDefault();
                    event.stopPropagation();

                    if (this.isProcessing) return;

                    var $btn = $(button);
                    var isBookmarked = $btn.data('is-bookmarked') === true;
                    var identity = $btn.data('identity');
                    var type = $btn.data('type');
                    var addRoute = $btn.data('add-route');
                    var removeRoute = $btn.data('remove-route');

                    // Determine which action to take
                    var route = isBookmarked ? removeRoute : addRoute;
                    var action = isBookmarked ? 'remove' : 'add';

                    console.log('=== POPULAR PROJECT BOOKMARK TOGGLE ===');
                    console.log('Action:', action);
                    console.log('Project ID:', identity);
                    console.log('Type:', type);
                    console.log('Route:', route);

                    if (!route || !identity || !type) {
                        console.error('Missing data!');
                        alert('Error: Missing bookmark data');
                        return;
                    }

                    this.isProcessing = true;
                    $btn.prop('disabled', true).css('opacity', '0.5');

                    // Prepare data based on action
                    var data = {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    };

                    if (action === 'add') {
                        data.identity = identity;
                        data.type = type;
                    } else {
                        // For remove, we need the bookmark ID
                        data.identity = $btn.data('bookmark-id') || identity;
                    }

                    $.ajax({
                        url: route,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: data,
                        success: (res) => {
                            console.log('=== SUCCESS ===');
                            console.log('Response:', res);

                            if (res.status === 'success' || res.status === 'exists') {
                                // Update button appearance without reload
                                this.updateButtonUI($btn, action, res.bookmark_id);

                                // Show appropriate message
                                if (action === 'add') {
                                    if (typeof toastr !== 'undefined') {
                                        toastr.success(res.message || 'Bookmark added');
                                    } else {
                                        alert('Bookmark added successfully!');
                                    }
                                } else {
                                    if (typeof toastr !== 'undefined') {
                                        toastr.success(res.message || 'Bookmark removed');
                                    } else {
                                        alert('Bookmark removed');
                                    }
                                }
                            } else if (res.status === 'error') {
                                alert(res.message || 'Failed to update bookmark');
                                this.isProcessing = false;
                                $btn.prop('disabled', false).css('opacity', '1');
                            }
                        },
                        error: (xhr, status, error) => {
                            console.error('=== ERROR ===');
                            console.error('Status:', status);
                            console.error('Error:', error);
                            console.error('XHR Status:', xhr.status);

                            var errorMsg = 'Failed to update bookmark';

                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMsg = xhr.responseJSON.message;
                            } else if (xhr.status === 401) {
                                errorMsg = 'Please login to bookmark';
                            } else if (xhr.status === 419) {
                                errorMsg = 'Session expired. Refresh the page.';
                            } else if (xhr.status === 500) {
                                errorMsg = 'Server error. Check logs.';
                            } else if (xhr.status === 404) {
                                errorMsg = 'Route not found: ' + route;
                            }

                            if (typeof toastr !== 'undefined') {
                                toastr.error(errorMsg);
                            } else {
                                alert('ERROR: ' + errorMsg);
                            }

                            this.isProcessing = false;
                            $btn.prop('disabled', false).css('opacity', '1');
                        }
                    });
                },

                updateButtonUI: function($btn, action, bookmarkId) {
                    // Toggle button classes and attributes
                    $btn.removeClass('processing');

                    if (action === 'add') {
                        // Change from "add" to "remove" state
                        $btn.data('is-bookmarked', true);
                        $btn.data('bookmark-id', bookmarkId);
                        $btn.attr('aria-label', 'Remove from favorites');

                        // Update SVG icon to filled heart
                        $btn.find('svg').attr('fill', 'currentColor');
                        $btn.find('path').attr('stroke', 'currentColor');
                        $btn.find('svg').addClass('text-red-500');

                        // Change tooltip if you have one
                        if ($btn.attr('title')) {
                            $btn.attr('title', 'Remove from favorites');
                        }
                    } else {
                        // Change from "remove" to "add" state
                        $btn.data('is-bookmarked', false);
                        $btn.removeData('bookmark-id');
                        $btn.attr('aria-label', 'Add to favorites');

                        // Update SVG icon to outline heart
                        $btn.find('svg').attr('fill', 'none');
                        $btn.find('path').attr('stroke', 'currentColor');
                        $btn.find('svg').removeClass('text-red-500');

                        // Change tooltip if you have one
                        if ($btn.attr('title')) {
                            $btn.attr('title', 'Add to favorites');
                        }
                    }

                    // Re-enable button
                    this.isProcessing = false;
                    $btn.prop('disabled', false).css('opacity', '1');

                    // Optional: Add a subtle animation
                    $btn.addClass('scale-110');
                    setTimeout(() => {
                        $btn.removeClass('scale-110');
                    }, 300);
                },

                loginRequired: function(event) {
                    event.preventDefault();
                    event.stopPropagation();

                    console.log('=== LOGIN REQUIRED ===');

                    if (typeof toastr !== 'undefined') {
                        toastr.warning('Please login to bookmark');
                    } else {
                        alert('Please login to bookmark');
                    }
                }
            };
            // Initialize video players with hover-to-play functionality
            function initializeVideoPlayers() {
                const videoContainers = document.querySelectorAll('.carousel-slide');

                videoContainers.forEach(container => {
                    const video = container.querySelector('video');
                    const durationBadge = container.querySelector('.video-duration');
                    const progressCircle = container.querySelector('.progress-ring-circle');
                    const volumeButton = container.querySelector('.video-volume-control');
                    const volumeMutedIcon = container.querySelector('.volume-muted');
                    const volumeUnmutedIcon = container.querySelector('.volume-unmuted');

                    if (!video) return;

                    const radius = 18;
                    const circumference = 2 * Math.PI * radius;

                    // Get video duration and display it
                    video.addEventListener('loadedmetadata', function() {
                        if (durationBadge) {
                            const duration = Math.floor(video.duration);
                            const minutes = Math.floor(duration / 60);
                            const seconds = duration % 60;
                            durationBadge.textContent = minutes + ':' + seconds.toString().padStart(2, '0');
                            durationBadge.style.display = 'block';
                        }
                    });

                    // Update circular progress bar
                    video.addEventListener('timeupdate', function() {
                        if (progressCircle && video.duration) {
                            const progress = (video.currentTime / video.duration) * 100;
                            const offset = circumference - (progress / 100) * circumference;
                            progressCircle.style.strokeDashoffset = offset;
                        }
                    });

                    // Volume button click handler
                    if (volumeButton) {
                        volumeButton.addEventListener('click', function(e) {
                            e.preventDefault();
                            e.stopPropagation();

                            if (video.muted) {
                                video.muted = false;
                                volumeMutedIcon.style.display = 'none';
                                volumeUnmutedIcon.style.display = 'block';
                            } else {
                                video.muted = true;
                                volumeMutedIcon.style.display = 'block';
                                volumeUnmutedIcon.style.display = 'none';
                            }
                        });
                    }

                    // Hover to play
                    container.addEventListener('mouseenter', function() {
                        if (video && video.paused) {
                            container.classList.add('video-playing');
                            video.play().catch(err => console.log('Play error:', err));
                        }
                    });

                    // Stop on mouse leave
                    container.addEventListener('mouseleave', function() {
                        if (video && !video.paused) {
                            container.classList.remove('video-playing');
                            video.pause();
                            video.currentTime = 0;
                            if (progressCircle) {
                                progressCircle.style.strokeDashoffset = circumference;
                            }
                            // Reset to muted when leaving
                            video.muted = true;
                            if (volumeMutedIcon && volumeUnmutedIcon) {
                                volumeMutedIcon.style.display = 'block';
                                volumeUnmutedIcon.style.display = 'none';
                            }
                        }
                    });

                    // Pause other videos when one plays
                    video.addEventListener('play', function() {
                        document.querySelectorAll('.carousel-slide video').forEach(otherVideo => {
                            if (otherVideo !== video && !otherVideo.paused) {
                                otherVideo.pause();
                                otherVideo.currentTime = 0;
                                const otherContainer = otherVideo.closest('.carousel-slide');
                                if (otherContainer) {
                                    otherContainer.classList.remove('video-playing');
                                    const otherProgress = otherContainer.querySelector('.progress-ring-circle');
                                    if (otherProgress) {
                                        otherProgress.style.strokeDashoffset = circumference;
                                    }
                                }
                            }
                        });
                    });

                    // Initialize progress circle
                    if (progressCircle) {
                        progressCircle.style.strokeDasharray = circumference;
                        progressCircle.style.strokeDashoffset = circumference;
                    }
                });
            }

// Call the function to initialize video players
            initializeVideoPlayers();




        });
    </script>
<?php endif; ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/app/Providers/../../plugins/PageBuilder/views/projects/popular-projects-one.blade.php ENDPATH**/ ?>