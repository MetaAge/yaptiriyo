<?php
    $loadingText = __('loading');
?>
<?php if(get_static_option('page_loader') != 'disable'): ?>
    <!-- Preloader Starts  -->
    <div id="preloader">
        <div class="preloader-inner">
            <div class="preloader-inner-item">
                <?php $__currentLoopData = mb_str_split($loadingText); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $char): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span><?php echo e($char); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <!-- Preloader Ends  -->
<?php endif; ?>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/layout/partials/preloader.blade.php ENDPATH**/ ?>