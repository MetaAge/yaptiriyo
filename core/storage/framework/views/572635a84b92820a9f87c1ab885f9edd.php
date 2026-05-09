<!-- About Team area starts -->
<section class="w-full px-6 py-12 md:py-20 bg-[#F8F9FD]" data-padding-top="<?php echo e($padding_top ?? ''); ?>" data-padding-bottom="<?php echo e($padding_bottom ?? ''); ?>" style="padding-top: <?php echo e($padding_top); ?>px; padding-bottom: <?php echo e($padding_bottom); ?>px; background-color:<?php echo e($section_bg ?? ''); ?>">
    <div class="max-w-7xl mx-auto pb-3 md:pb-10">
        <!-- Heading -->
        <?php if(!empty($title)): ?>
            <div class="text-center mb-10">
                <h2 class="text-3xl lg:text-4xl font-semibold">
                    <?php echo e($title); ?>

                </h2>
                <?php if(!empty($subtitle)): ?>
                    <p class="text-gray-600 mt-4"><?php echo e($subtitle); ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- Team Carousel Container -->
        <div class="relative">
            <!-- Left Arrow -->
            <button type="button" id="teamPrevBtn" title="left-arrow"
                    class="absolute left-0 top-1/2 transform -translate-y-1/2 -translate-x-6 lg:-translate-x-12 z-10 flex items-center justify-center w-12 h-12 bg-white border-2 border-gray-300 rounded-full hover:bg-gray-100 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                     stroke="currentColor" class="w-6 h-6 text-gray-700">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <!-- Team Members Carousel -->
            <div class="overflow-hidden pb-10">
                <div id="carouselTrack" class="flex transition-transform duration-500 ease-in-out">

                    <?php
                        $bgColors = ['#BBE3EF', '#ECE8E5', '#B5A7E4', '#F8CCB3'];
                        $colorIndex = 0;
                    ?>

                    <?php $__currentLoopData = $repeater_data['image_'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <!-- Team Member <?php echo e($key + 1); ?> -->
                        <div class="w-full lg:w-1/4 md:w-1/2 flex-shrink-0 px-4">
                            <div class="flex flex-col items-center relative">
                                <!-- Card image -->
                                <div class="w-full rounded-xl h-[320px] flex items-start justify-center overflow-hidden mb-4"
                                     style="background-color: <?php echo e($bgColors[$colorIndex % 4]); ?>">
                                    <?php echo render_image_markup_by_attachment_id($image, '', 'w-full h-full object-contain mt-5'); ?>

                                </div>

                                <!-- Card details -->
                                <div class="bg-base-100 p-6 rounded-lg left-5 right-5 absolute -bottom-10 text-center">
                                    <h3 class="text-[20px] font-medium text-base-300"><?php echo e($repeater_data['name_'][$key] ?? ''); ?></h3>
                                    <p class="text-gray-600 text-sm mb-4"><?php echo e($repeater_data['designation_'][$key] ?? ''); ?></p>
                                    <div class="flex gap-2 items-center justify-center">
                                        <a href="#"
                                           class="h-5 w-5 flex items-center justify-center transition-colors">
                                            <img class="w-full h-full" src="<?php echo e(asset('assets/frontend/new_design/assets/images/about-page/facebook.svg')); ?>"
                                                 alt="">
                                        </a>
                                        <div class="h-5 border-r border-base-200"></div>
                                        <a href="#"
                                           class="h-5 w-5 flex items-center justify-center transition-colors">
                                            <img class="w-full h-full"
                                                 src="<?php echo e(asset('assets/frontend/new_design/assets/images/about-page/instagram.svg')); ?>" alt="">
                                        </a>
                                        <div class="h-5 border-r border-base-200"></div>
                                        <a href="#"
                                           class="h-5 w-5 flex items-center justify-center transition-colors">
                                            <img class="w-full h-full" src="<?php echo e(asset('assets/frontend/new_design/assets/images/about-page/linkedIn.svg')); ?>"
                                                 alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            $colorIndex++;
                        ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>

            <!-- Right Arrow -->
            <button type="button" id="teamNextBtn" title="right-arrow"
                    class="absolute right-0 top-1/2 transform -translate-y-1/2 translate-x-6 lg:translate-x-12 z-10 flex items-center justify-center w-12 h-12 bg-orange-500 hover:bg-orange-600 rounded-full transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                     stroke="currentColor" class="w-6 h-6 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
</section>
<!-- About Team area end -->

<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/app/Providers/../../plugins/PageBuilder/views/about/team.blade.php ENDPATH**/ ?>