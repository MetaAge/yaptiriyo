<?php $__env->startSection('site_title',__('Account Setup Complete')); ?>
<?php $__env->startSection('content'); ?>
    <div class="congratulation-area section-bg-2 pat-100 pab-100">
        <div class="container">
            <div class="congratulation-wrapper">
                <div class="congratulation-contents center-text">
                    <div class="congratulation-contents-icon wow  zoomIn animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;">
                        <i class="fas fa-check"></i>
                    </div>
                    <h4 class="congratulation-contents-title"> <?php echo e(__('Congratulations!')); ?> </h4>
                    <p class="congratulation-contents-para"><?php echo e(__('Your account setup has successfully completed')); ?></p>
                    <div class="btn-wrapper mt-4">
                        <a href="<?php echo e(route('freelancer.dashboard')); ?>" class="btn-profile btn-bg-1"><?php echo e(__('Back to Dashboard')); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>





<?php echo $__env->make('frontend.layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/freelancer/account/congrats.blade.php ENDPATH**/ ?>