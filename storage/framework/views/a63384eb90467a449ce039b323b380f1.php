<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
    <?php $__empty_1 = true; $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php
            // Get all media for this project
            $projectMedia = $project->media ?? [];
            $mediaCount = count($projectMedia);
            $hasMultipleMedia = $mediaCount > 1;

            // Check if project is promoted/pro
            $isPromotedProject = moduleExists('PromoteFreelancer') &&
                                $project->is_pro == 'yes' &&
                                $project->pro_expire_date >= now();
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
                                    $isImage = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'bmp', 'tiff', 'svg', 'webp', 'gif', 'avif']);
                                ?>
                                <div class="carousel-slide">
                                    <?php if($isImage): ?>
                                        <?php if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])): ?>
                                            <img src="<?php echo e(render_frontend_cloud_image_if_module_exists('project/'.$mediaFile, load_from: $project->load_from)); ?>"
                                                 alt="<?php echo e($project->title); ?>"
                                                 onerror="this.src='<?php echo e(asset('assets/frontend/new_design/assets/images/error-images/no_jobs_found.svg')); ?>'">
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('assets/uploads/project/' . $mediaFile)); ?>"
                                                 alt="<?php echo e($project->title); ?>"
                                                 onerror="this.src='<?php echo e(asset('assets/frontend/new_design/assets/images/error-images/no_jobs_found.svg')); ?>'">
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
                            <button class="arrow-btn left-arrow absolute left-2 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white p-2 rounded-full shadow-lg transition-all duration-300 hidden z-10">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-gray-800">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                                </svg>
                            </button>

                            <!-- Right Arrow -->
                            <button class="arrow-btn right-arrow absolute right-2 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white p-2 rounded-full shadow-lg transition-all duration-300 z-10">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-gray-800">
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
                    <?php else: ?>
                        <!-- Fallback: No image -->
                        <div class="w-full h-full flex items-center justify-center bg-gray-100">
                            <div class="text-center">
                                <svg class="w-16 h-16 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
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
                        <?php
                            // Get freelancer level dynamically using your existing helper function
                            $freelancerLevel = moduleExists('FreelancerLevel') ? freelancer_level($project->project_creator?->id) : null;

                            // Check if it's a promoted project
                            $isPromotedProject = moduleExists('PromoteFreelancer') &&
                                                $project->is_pro == 'yes' &&
                                                $project->pro_expire_date >= now();
                        ?>

                        <?php if(!empty($freelancerLevel)): ?>
                            
                            <p class="bg-secondary/20 px-2 py-1 rounded-lg text-secondary text-xs font-medium">
                                <?php echo e($freelancerLevel); ?>

                            </p>
                        <?php elseif($isPromotedProject): ?>
                            
                            <p class="bg-secondary/20 px-2 py-1 rounded-lg text-secondary text-xs font-medium">
                                <?php echo e(get_static_option('promoted_badge_text', 'Sponsored')); ?>

                            </p>
                        <?php elseif($project->created_at && $project->created_at->diffInHours(now()) < 24): ?>
                            
                            <p class="bg-green-100 px-2 py-1 rounded-lg text-green-700 text-xs font-medium">
                                <?php echo e(__('New')); ?>

                            </p>
                        <?php endif; ?>
                    </div>
                    <a href="<?php echo e(route('project.details', ['username' => $project->project_creator?->username, 'slug' => $project->slug])); ?>">
                        <h2 class="text-xl font-medium leading-tight text-gray-800 line-clamp-2 hover:underline">
                            <?php echo e($project->title); ?>

                        </h2>
                    </a>
                </hgroup>

                <div class="flex items-center justify-between text-yellow-500">
                    <div class="flex items-center gap-1">
                        <?php if($project->ratings_count > 0): ?>
                            <i class="fa-solid fa-star"></i>
                            <span class="text-sm font-semibold text-gray-700"><?php echo e(number_format($project->average_rating ?? ($project->ratings_avg_rating ?? 0), 1)); ?></span>
                            <span class="text-sm text-gray-500">(<?php echo e($project->ratings_count); ?>)</span>
                        <?php else: ?>
                            <span class="text-sm text-gray-500"><?php echo e(__('No reviews yet')); ?></span>
                        <?php endif; ?>
                    </div>
                    <?php if($project->project_creator?->completed_orders_count > 0): ?>
                        <div class="flex items-center gap-1 text-gray-500">
                            <i class="fa-solid fa-briefcase text-xs"></i>
                            <span class="text-xs font-medium"><?php echo e($project->project_creator->completed_orders_count); ?> <?php echo e(__('Jobs Done')); ?></span>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if($project->state || $project->city || $project->project_creator?->state): ?>
                    <div class="flex items-center gap-1 text-gray-500 text-xs">
                        <i class="fa-solid fa-location-dot"></i>
                        <span>
                            <?php echo e($project->city?->city ?? $project->state?->state ?? $project->project_creator?->state?->state ?? __('Turkey')); ?>

                        </span>
                    </div>
                <?php endif; ?>

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
                                            $isOnline = $project->project_creator->check_online_status->diffInMinutes(now()) <= 5;
                                        }
                                    ?>
                                    <div class="absolute bottom-0 right-0 w-3 h-3 <?php echo e($isOnline ? 'bg-green-500' : 'bg-gray-400'); ?> rounded-full border-2 border-white"></div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="flex items-center gap-1">
                            <span class="text-sm font-semibold text-gray-700"><?php echo e($project->project_creator?->fullname ?? __('User')); ?></span>
                            <?php if($project->project_creator?->user_verified_status == 1): ?>
                                <i class="fa-solid fa-circle-check text-blue-500 text-xs" title="<?php echo e(__('Verified')); ?>"></i>
                            <?php endif; ?>
                        </div>
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
                        <img src="/assets/frontend/new_design/assets/images/error-images/no_service_found.svg" alt="nothing-found">
                        <p class="text-base-300 text-base-400 text-lg">Sorry, no results found. Don't worry! You can create
                            a job post and get proposals from top freelancers.</p>
                        <button
                                class=" px-6 mt-6 rounded-full bg-primary hover:bg-primary/90 text-white font-medium py-3 mb-3 transition-colors flex items-center justify-center gap-2">
                            <a href="<?php echo e(route('freelancer.project.create')); ?>">Create a job</a>

                            <i class="icon-base ti tabler-arrow-right icon-20px text-white -rotate-45"></i>
                        </button>
                    </div>
                </div>
            </section>
        </div>
    <?php endif; ?>
</div>
<style>
    /* Video Styling */
    .carousel-slide video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    /* Video Container */
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

    /* Center Play Button Overlay (shown before hover) */
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

    /* Circular Progress Background */
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

    /* Play Button Inside Circle */
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
        right: 12px;
        background: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 600;
        z-index: 6;
        letter-spacing: 0.5px;
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

    /* Move duration badge when volume button is visible */
    .video-duration {
        position: absolute;
        bottom: 12px;
        right: 56px; /* Moved left to make room for volume button */
        background: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 600;
        z-index: 6;
        letter-spacing: 0.5px;
    }
</style>
<script>
    // Video hover to play functionality with circular progress
    document.addEventListener('DOMContentLoaded', function() {
        initializeVideoPlayers();
    });

    // Also reinitialize after AJAX loads
    $(document).ajaxComplete(function() {
        setTimeout(initializeVideoPlayers, 100);
    });

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
                    durationBadge.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
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
                    video.currentTime = 0; // Reset to beginning
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
</script>

<!-- Pagination -->
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
<?php endif; ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/pages/projects/search-result.blade.php ENDPATH**/ ?>