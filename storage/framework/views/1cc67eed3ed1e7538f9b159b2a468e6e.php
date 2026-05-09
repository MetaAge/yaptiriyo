<!-- About Us -->
<section class="px-6 py-12 md:py-20 lg:py-[120px]" style="padding-top: <?php echo e($padding_top); ?>px; padding-bottom: <?php echo e($padding_bottom); ?>px; background-color: <?php echo e($section_bg); ?>">
    <div class="max-w-7xl mx-auto">
        <!-- Main Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 ">

            <!-- Left Content -->
            <div class=" border p-6 space-y-4  border-base-300/10 rounded-xl">
                <!-- About Us Label -->
                <div>
                    <span class="text-secondary font-medium text-sm pb-4">About Us</span>
                </div>

                <!-- Main Heading -->
                <?php if(!empty($title)): ?>
                    <div>
                        <h1 class="text-3xl lg:text-4xl font-medium text-gray-900 leading-snug">
                            <?php echo $title; ?>

                        </h1>
                    </div>
                <?php endif; ?>

                <!-- Description Paragraphs -->
                <?php if(!empty($description)): ?>
                    <div class="space-y-4 text-gray-600 text-sm leading-relaxed ">
                        <?php echo $description; ?>

                    </div>
                <?php endif; ?>

                <!-- Repeater Data (Credibility Items) -->
                <?php if(!empty($repeater_data)): ?>
                    <div class="space-y-4 text-gray-600 text-sm leading-relaxed">
                        <?php $__currentLoopData = $repeater_data['title_'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $rep_title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div>
                                <?php if(!empty($rep_title)): ?>
                                    <h3 class="font-medium text-gray-900 mb-1"><?php echo e($rep_title); ?></h3>
                                <?php endif; ?>
                                <?php if(!empty($repeater_data['description_'][$key])): ?>
                                    <p><?php echo e($repeater_data['description_'][$key]); ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Right Content -->
            <!-- Image -->
            <?php if(!empty($image)): ?>
                <div class="w-full rounded-xl overflow-hidden">
                    <?php echo render_image_markup_by_attachment_id($image, '', 'w-full h-auto rounded-xl'); ?>

                </div>
            <?php endif; ?>


        </div>
    </div>
</section><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/app/Providers/../../plugins/PageBuilder/views/about/about-us.blade.php ENDPATH**/ ?>