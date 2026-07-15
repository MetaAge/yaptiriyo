<span class="popup-contents-close popup-close"> <i class="fas fa-times"></i> </span>
<div class="profile-details-portfolio">
    <div class="popup-contents-portfolio-thumb">
        <a href="#/">
            <?php if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])): ?>
                <img src="<?php echo e(render_frontend_cloud_image_if_module_exists( 'portfolio/'.$portfolioDetails->image, load_from: $portfolioDetails->load_from)); ?>" alt="<?php echo e($portfolioDetails->title); ?>" class="w-full rounded-lg">
            <?php else: ?>
                <img src="<?php echo e(asset('assets/uploads/portfolio/'.$portfolioDetails->image)); ?>" alt="<?php echo e($portfolioDetails->title); ?>" class="w-full rounded-lg">
            <?php endif; ?>
        </a>
    </div>
    <div class="profile-details-portfolio-content mt-3">
        <h5 class="profile-details-portfolio-content-title font-medium text-lg text-base-300">
            <a href="javascript:void(0)"><?php echo e($portfolioDetails->title ?? ''); ?></a>
        </h5>
        <p class="profile-details-portfolio-content-para text-sm text-gray-500"><?php echo e($portfolioDetails->created_at->toFormattedDateString() ?? ''); ?></p>
        <p class="profile-details-portfolio-content-para text-base-400 leading-relaxed mt-2"><?php echo e($portfolioDetails->description ?? ''); ?> </p>
    </div>
</div>
<?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 2 && Auth::guard('web')->user()->username==$username): ?>
    <div class="popup-contents-btn flex-btn justify-content-end profile-border-top mt-4">
        <a href="javascript:void(0)" class="btn-profile btn-outline-gray btn-hover-danger delete_portfolio px-4 py-2 rounded-lg" data-id="<?php echo e($portfolioDetails->id); ?>">
            <i class="fa-solid fa-trash-can"></i> <?php echo e(__('Delete')); ?>

        </a>
        <a href="javascript:void(0)"
           class="btn-profile btn-bg-1 edit_portfolio_details px-4 py-2 rounded-lg"
           data-id="<?php echo e($portfolioDetails->id); ?>"
           data-title="<?php echo e($portfolioDetails->title); ?>"
           data-description="<?php echo e($portfolioDetails->description); ?>"
           data-image="<?php echo e($portfolioDetails->image); ?>"
        > <?php echo e(__('Edit This')); ?> </a>
    </div>
<?php endif; ?>

<?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 1 && Auth::guard('web')->user()->username==$username && Session::get('user_role') == 'freelancer'): ?>
    <div class="popup-contents-btn flex-btn justify-content-end profile-border-top mt-4">
        <a href="javascript:void(0)" class="btn-profile btn-outline-gray btn-hover-danger delete_portfolio px-4 py-2 rounded-lg" data-id="<?php echo e($portfolioDetails->id); ?>">
            <i class="fa-solid fa-trash-can"></i> <?php echo e(__('Delete')); ?>

        </a>
        <a href="javascript:void(0)"
           class="btn-profile btn-bg-1 edit_portfolio_details px-4 py-2 rounded-lg"
           data-id="<?php echo e($portfolioDetails->id); ?>"
           data-title="<?php echo e($portfolioDetails->title); ?>"
           data-description="<?php echo e($portfolioDetails->description); ?>"
           data-image="<?php echo e($portfolioDetails->image); ?>"
        > <?php echo e(__('Edit This')); ?> </a>
    </div>
<?php endif; ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/profile-details/portfolio-details.blade.php ENDPATH**/ ?>