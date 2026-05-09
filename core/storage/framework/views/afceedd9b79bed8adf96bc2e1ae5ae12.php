<div class="breadcrumb-area border-top">
    <div class="container custom-container-one">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-contents">
                    <h4 class="breadcrumb-contents-title"> <?php echo e($title); ?> </h4>
                    <ul class="breadcrumb-contents-list list-style-none">
                        <li class="breadcrumb-contents-list-item">
                            <a href="<?php echo e(route('homepage')); ?>" class="breadcrumb-contents-list-item-link">
                                <?php echo e(__('Home')); ?>

                            </a>
                        </li>

                        <?php if(auth()->guard()->check()): ?>
                            <li class="breadcrumb-contents-list-item">
                                <?php if(auth()->user()->user_type == 1): ?>
                                    <a href="<?php echo e(route('client.dashboard')); ?>" class="breadcrumb-contents-list-item-link">
                                        <?php echo e(__('Dashboard')); ?>

                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo e(route('freelancer.dashboard')); ?>" class="breadcrumb-contents-list-item-link">
                                        <?php echo e(__('Dashboard')); ?>

                                    </a>
                                <?php endif; ?>
                            </li>
                        <?php endif; ?>

                        <li class="breadcrumb-contents-list-item">
                            <span class="breadcrumb-contents-list-item-text"><?php echo e($innerTitle); ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/components/breadcrumb/user-profile-breadcrumb.blade.php ENDPATH**/ ?>