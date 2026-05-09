<!-- About What area starts -->
<section class="w-full px-6 py-12 md:py-20"
         data-padding-top="<?php echo e($padding_top ?? ''); ?>"
         data-padding-bottom="<?php echo e($padding_bottom ?? ''); ?>"
         style="padding-top: <?php echo e($padding_top ?? 0); ?>px; padding-bottom: <?php echo e($padding_bottom ?? 0); ?>px; background-color:<?php echo e($section_bg ?? ''); ?>">
    <div class="max-w-7xl mx-auto">
        <!-- Heading -->
        <?php if(isset($title) && !empty($title)): ?>
            <div class="text-center mb-12">
                <h2 class="text-3xl lg:text-4xl font-medium text-gray-900">
                    <?php echo e($title); ?>

                </h2>
                <?php if(isset($description) && !empty($description)): ?>
                    <p class="text-gray-600 mt-4"><?php echo e($description); ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- Video/Image Container -->
        <div class="relative w-full mb-8">
            <div class="relative w-full bg-gray-300 rounded-3xl overflow-hidden" style="aspect-ratio: 16/7;">
                <?php if(isset($video_url) && !empty($video_url)): ?>
                    <!-- Video Player -->
                    <video id="whatWeDoVideoPlayer" class="w-full h-full object-cover">
                        <source src="<?php echo e($video_url); ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>

                    <!-- Play Button Overlay -->
                    <button id="whatWeDoPlayButton"
                            title="play button"
                            class="absolute inset-0 flex items-center justify-center group cursor-pointer"
                            type="button">
                        <div class="w-20 h-20 lg:w-24 lg:h-24 bg-white rounded-full flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                 class="w-8 h-8 lg:w-10 lg:h-10 text-secondary ml-1">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                        </div>
                    </button>
                <?php elseif(isset($image) && !empty($image)): ?>
                    <!-- Fallback Image -->
                    <?php
                        $image_details = get_attachment_image_by_id($image);
                        $image_url = $image_details['img_url'] ?? '';
                    ?>
                    <?php if(!empty($image_url)): ?>
                        <img src="<?php echo e($image_url); ?>"
                             alt="<?php echo e($title ?? 'What we do'); ?>"
                             class="absolute inset-0 w-full h-full object-cover rounded-3xl">
                    <?php else: ?>
                        <!-- Placeholder when no media is available -->
                        <div class="absolute inset-0 w-full h-full flex items-center justify-center">
                            <span class="text-gray-500 text-lg">Upload a video or image</span>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <!-- Placeholder when no media is available -->
                    <div class="absolute inset-0 w-full h-full flex items-center justify-center">
                        <span class="text-gray-500 text-lg">Upload a video or image</span>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Stats Grid -->
        <?php if(isset($repeater_data) && is_array($repeater_data) && isset($repeater_data['title_']) && count($repeater_data['title_']) > 0): ?>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
                <?php $__currentLoopData = $repeater_data['title_']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $stat_title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <!-- Stat Item -->
                    <div class="text-center">
                        <h3 class="text-3xl lg:text-4xl font-semibold text-gray-900"><?php echo e($stat_title ?? ''); ?></h3>
                        <?php if(isset($repeater_data['description_'][$key]) && !empty($repeater_data['description_'][$key])): ?>
                            <p class="text-gray-600 text-sm mt-2"><?php echo e($repeater_data['description_'][$key]); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- JavaScript for Video Play Control -->
<?php if(isset($video_url) && !empty($video_url)): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const videoPlayer = document.getElementById('whatWeDoVideoPlayer');
            const playButton = document.getElementById('whatWeDoPlayButton');

            if (videoPlayer && playButton) {
                // Play button click handler
                playButton.addEventListener('click', function() {
                    if (videoPlayer.paused) {
                        videoPlayer.play();
                        playButton.style.display = 'none';
                    } else {
                        videoPlayer.pause();
                        playButton.style.display = 'flex';
                    }
                });

                // Show play button when video is paused
                videoPlayer.addEventListener('pause', function() {
                    playButton.style.display = 'flex';
                });

                // Hide play button when video is playing
                videoPlayer.addEventListener('play', function() {
                    playButton.style.display = 'none';
                });

                // Show play button when video ends
                videoPlayer.addEventListener('ended', function() {
                    playButton.style.display = 'flex';
                });

                // Optional: Click on video to pause/play
                videoPlayer.addEventListener('click', function() {
                    if (videoPlayer.paused) {
                        videoPlayer.play();
                    } else {
                        videoPlayer.pause();
                    }
                });
            }
        });
    </script>
<?php endif; ?>
<!-- About What area end --><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/app/Providers/../../plugins/PageBuilder/views/about/what-we-do.blade.php ENDPATH**/ ?>