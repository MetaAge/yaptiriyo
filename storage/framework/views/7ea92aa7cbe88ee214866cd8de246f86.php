<?php echo $__env->make('backend.layout.partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('backend.layout.partials.preloader', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<!-- Dashboard area Starts -->
<div class="body-overlay"></div>
<div class="dashboard-area section-bg-2">
    <div class="container-fluid p-0">
        <div class="dashboard__contents__wrapper">
            <div class="dashboard__icon">
                <div class="dashboard__icon__bars sidebar-icon">
                    <i class="fa-solid fa-bars"></i>
                </div>
            </div>
            <?php echo $__env->make('backend.layout.partials.left-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <div class="dashboard__right">
                <div class="dashboard__inner">
                    <?php echo $__env->make('backend.layout.partials.top-header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php echo $__env->yieldContent('content'); ?>
                    <?php echo $__env->make('backend.layout.partials.copyright', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Dashboard area end -->

<?php echo $__env->make('backend.layout.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/backend/layout/master.blade.php ENDPATH**/ ?>