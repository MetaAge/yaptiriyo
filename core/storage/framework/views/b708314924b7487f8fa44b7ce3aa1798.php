<?php echo $__env->make('frontend.layout.partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('frontend.layout.partials.preloader', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


<?php echo $__env->make('frontend.layout.partials.navbar-variant.navbar-02', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php if(!empty($page_post) && $page_post->breadcrumb_status == 'on'): ?>
    <div class="banner-inner-area border-top pat-20 pab-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-inner-contents">
                        <ul class="inner-menu">
                            <li class="list"><a href="<?php echo e(url('/')); ?>"><?php echo e(__('Home')); ?> </a></li>
                            <li class="list"> <?php echo e($page_post->title ?? ''); ?> </li>
                        </ul>
                        <h2 class="banner-inner-title"> <?php echo e($page_post->title ?? ''); ?> <?php echo $__env->yieldContent('inner-title'); ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php echo $__env->yieldContent('content'); ?>
<?php echo $__env->make('frontend.layout.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('frontend.layout.partials.gdpr-cookie', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/layout/master.blade.php ENDPATH**/ ?>