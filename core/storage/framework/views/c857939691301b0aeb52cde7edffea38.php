<!-- Hire the best -->
<section class="py-10 px-6 md:py-16 lg:py-28" style="background-color: <?php echo e($background_color); ?>; padding-top: <?php echo e($padding_top); ?>px; padding-bottom: <?php echo e($padding_bottom); ?>px;">
    <div class="container mx-auto max-w-7xl px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Left Content -->
            <div class="space-y-8">
                <?php if(!empty($title)): ?>
                    <h2 class="text-3xl md:text-4xl font-medium leading-tight animate-on-scroll">
                        <?php echo $title; ?>

                    </h2>
                <?php endif; ?>

                <?php if(!empty($feature_cards)): ?>
                    <div class="space-y-8">
                        <?php $__currentLoopData = $feature_cards['card_title_'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cardTitle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <!-- Card -->
                            <div class="flex items-start gap-4">
                                <?php if(!empty($feature_cards['icon_'][$key])): ?>
                                    <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center">
                                        <?php echo render_image_markup_by_attachment_id($feature_cards['icon_'][$key], '', 'w-full h-full object-contain'); ?>

                                    </div>
                                <?php else: ?>
                                    <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-gray-100 rounded-lg">
                                        <i class="fas fa-check text-gray-600"></i>
                                    </div>
                                <?php endif; ?>
                                <div>
                                    <?php if(!empty($cardTitle)): ?>
                                        <h3 class="text-xl font-medium mb-1"><?php echo e($cardTitle); ?></h3>
                                    <?php endif; ?>
                                    <?php if(!empty($feature_cards['card_description_'][$key])): ?>
                                        <p class="text-gray-600"><?php echo e($feature_cards['card_description_'][$key]); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Right Image Section -->
            <?php if(!empty($right_image)): ?>
                <div class="flex justify-center items-center">
                    <div class="overflow-hidden rounded-xl shadow-xl max-w-lg">
                        <?php echo render_image_markup_by_attachment_id($right_image, '', 'w-full h-auto'); ?>

                    </div>
                </div>
            <?php else: ?>
                <!-- Default placeholder image -->
                <div class="flex justify-center items-center">
                    <div class="w-full h-64 bg-gray-200 rounded-xl shadow-xl max-w-lg flex items-center justify-center">
                        <span class="text-gray-500">Image will appear here</span>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/app/Providers/../../plugins/PageBuilder/views/HireTheBest/HireTheBest.blade.php ENDPATH**/ ?>