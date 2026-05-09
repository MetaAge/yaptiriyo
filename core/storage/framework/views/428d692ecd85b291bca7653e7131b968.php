<!-- Mobile App Advertise Section -->
<section class="bg-[#F8F9FD] overflow-hidden" style="background-color:<?php echo e($section_bg ?? ''); ?>; padding-top: <?php echo e($padding_top ?? 100); ?>px; padding-bottom: <?php echo e($padding_bottom ?? 100); ?>px;">
    <div class="container mx-auto max-w-7xl px-6 flex justify-center">

        <!-- Card 01 - Client App (Centered and Enlarged) -->
        <div class="bg-secondary w-full max-w-5xl rounded-[2rem] relative overflow-visible p-10 md:p-16 flex flex-col md:flex-row items-center gap-12 shadow-2xl shadow-secondary/20">
            
            <!-- Content Area -->
            <div class="relative z-20 w-full md:w-3/5 text-center md:text-left space-y-8">
                <?php if($client_app_store_title): ?>
                    <h2 class="text-3xl md:text-5xl lg:text-6xl text-base-100 font-bold leading-tight">
                        <?php echo nl2br(e($client_app_store_title)); ?>

                    </h2>
                <?php endif; ?>

                <p class="text-base-100/90 text-lg md:text-xl max-w-md mx-auto md:mx-0 leading-relaxed">
                    <?php echo e(__('Hemen indirin ve binlerce doğrulanmış uzman arasından size en uygun olanı saniyeler içinde bulun.')); ?>

                </p>

                <!-- App Store Buttons -->
                <div class="flex flex-wrap items-center justify-center md:justify-start gap-4 pt-4">
                    <?php if($client_app_store_image): ?>
                        <a href="<?php echo e($client_app_store_link); ?>" class="transition-transform hover:scale-105 active:scale-95">
                            <?php echo render_image_markup_by_attachment_id($client_app_store_image, '', 'h-12 md:h-14 w-auto'); ?>

                        </a>
                    <?php endif; ?>

                    <?php if($client_app_play_store_image): ?>
                        <a href="<?php echo e($client_app_play_store_link); ?>" class="transition-transform hover:scale-105 active:scale-95">
                            <?php echo render_image_markup_by_attachment_id($client_app_play_store_image, '', 'h-12 md:h-14 w-auto'); ?>

                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Phone Image (Modern Floating Effect) -->
            <?php if($client_app_store_phone): ?>
                <div class="relative z-20 w-full md:w-2/5 flex justify-center md:justify-end">
                    <div class="relative transform md:rotate-[-5deg] md:translate-y-10 hover:rotate-0 transition-transform duration-500">
                        <?php echo render_image_markup_by_attachment_id($client_app_store_phone, '', 'w-64 md:w-80 h-auto drop-shadow-[0_20px_50px_rgba(0,0,0,0.3)]'); ?>

                    </div>
                </div>
            <?php endif; ?>

            <!-- Background Decoration -->
            <?php if($client_app_store_shape): ?>
                <div class="absolute inset-0 z-0 opacity-40">
                    <?php echo render_image_markup_by_attachment_id($client_app_store_shape, '', 'w-full h-full object-cover rounded-[2rem]'); ?>

                </div>
            <?php endif; ?>
            
            <!-- Glow Effect -->
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/10 blur-[100px] rounded-full z-0"></div>
            <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-black/5 blur-[80px] rounded-full z-0"></div>
        </div>

    </div>
</section><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/app/Providers/../../plugins/PageBuilder/views/mobiapplica/mobiapplica.blade.php ENDPATH**/ ?>