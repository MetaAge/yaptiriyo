<!-- Our Story/Vision/Values Section -->
<section class="w-full px-6" style="padding-top: <?php echo e($padding_top); ?>px; padding-bottom: <?php echo e($padding_bottom); ?>px; background-color: <?php echo e($section_bg); ?>">

    <?php if(!empty($story_sections['section_title_'])): ?>
        <?php $__currentLoopData = $story_sections['section_title_']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $section_title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $image = $story_sections['section_image_'][$index] ?? '';
                $image_position = $story_sections['image_position_'][$index] ?? 'right';
                $section_content = $story_sections['section_content_'][$index] ?? '';

                // Determine order classes
                $content_order = ($image_position === 'left') ? 'lg:order-2' : '';
                $image_order = ($image_position === 'left') ? 'lg:order-1' : '';
                $is_last = ($index === count($story_sections['section_title_']) - 1);
            ?>

            <div class="max-w-7xl mx-auto <?php echo e(!$is_last ? 'mb-16 md:mb-24 lg:mb-32' : ''); ?>"
                 style="<?php echo e(!$is_last ? 'margin-bottom: ' . $section_spacing . 'px' : ''); ?>">

                <!-- Main Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

                    <!-- Left/Right Content -->
                    <div class="flex flex-col gap-10 <?php echo e($content_order); ?>">
                        <!-- Heading -->
                        <?php if(!empty($section_title)): ?>
                            <h2 class="text-3xl lg:text-4xl font-medium">
                                <?php echo e($section_title); ?>

                            </h2>
                        <?php endif; ?>

                        <!-- Section Content -->
                        <?php if(!empty($section_content)): ?>
                            <div class="our-story-content">
                                <?php echo $section_content; ?>

                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Image Content -->
                    <?php if(!empty($image)): ?>
                        <div class="flex justify-center lg:justify-end <?php echo e($image_order); ?>">
                            <div class="w-full max-w-md lg:max-w-full rounded-3xl overflow-hidden shadow-xl">
                                <?php echo render_image_markup_by_attachment_id($image, '', 'w-full h-auto object-contain'); ?>

                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

</section><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/app/Providers/../../plugins/PageBuilder/views/about/our-story.blade.php ENDPATH**/ ?>