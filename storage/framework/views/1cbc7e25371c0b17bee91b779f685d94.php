<?php $__env->startSection('site_title',__('Account Setup')); ?>
<?php $__env->startSection('style'); ?>
    <style>
        .set_scroll_height{
            max-height:300px;
            overflow-y: scroll;
            scrollbar-width: thin;
            scrollbar-color: #ccc #f5f5f5;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Account Setup area Starts -->
    <div class="account-area pat-100 pab-100">
        <div class="container">
            <div class="setup-header setup-top-border">
                <div class="setup-header-flex">
                    <div class="setup-header-left">
                        <h4 class="setup-header-title"><?php echo e(get_static_option('account_page_title') ?? __('Setup Your Account')); ?></h4>
                    </div>
                    <div class="setup-header-right">
                        <a href="<?php echo e(route('homepage')); ?>" class="setup-header-skip"><?php echo e(get_static_option('account_page_skip_title') ?? __('Skip')); ?></a>
                    </div>
                </div>
            </div>
            <div class="setup-wrapper setup-top-border setup-bottom-border">
                <div class="setup-wrapper-flex">
                    <div>
                        <?php echo $__env->make('frontend.user.freelancer.account.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                    <div>
                        <?php echo $__env->make('frontend.user.freelancer.account.introduction', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <?php echo $__env->make('frontend.user.freelancer.account.experience.experience', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <?php echo $__env->make('frontend.user.freelancer.account.education.education', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <?php echo $__env->make('frontend.user.freelancer.account.work.work', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <?php echo $__env->make('frontend.user.freelancer.account.skill.skill', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <?php echo $__env->make('frontend.user.freelancer.account.hourly.hourly-rate', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <?php echo $__env->make('frontend.user.freelancer.account.pre-next', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Account Setup area end -->
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
    <?php echo $__env->make('frontend.user.freelancer.account.account-setup-js', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('frontend.layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/freelancer/account/account-setup.blade.php ENDPATH**/ ?>