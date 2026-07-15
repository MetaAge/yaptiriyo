<!-- Setup Setting Starts -->
<div class="setup-wrapper-contents">
    <?php if(moduleExists('HourlyJob')): ?>
    <div class="setup-wrapper-contents-item">
        <h3 class="setup-wrapper-contents-title"><?php echo e(get_static_option('hourly_rate_title') ?? __('What is your hourly rate?')); ?></h3>
        <div class="setup-wrapper-finish">
            <div class="custom-form">
                <form action="#">
                    <div class="single-input single-input-icon">
                        <?php if(moduleExists('CurrencySwitcher')): ?>
                        <input type="number" name="hourly_rate" id="hourly_rate" class="form--control" min="0"
                               <?php if(Auth::guard('web')->check()): ?> value="<?php echo e(float_amount_without_currency_symbol(Auth::guard('web')->user()->hourly_rate)); ?>" <?php else: ?> value="20" <?php endif; ?> >
                        <?php else: ?>
                            <input type="number" name="hourly_rate" id="hourly_rate" class="form--control" min="0"
                                   <?php if(Auth::guard('web')->check()): ?> value="<?php echo e(Auth::guard('web')->user()->hourly_rate); ?>" <?php else: ?> value="20" <?php endif; ?> >
                        <?php endif; ?>
                        <span class="input-icon"><?php echo e(site_currency_symbol() ?? ''); ?></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="setup-wrapper-contents-item">
        <h3 class="setup-wrapper-contents-title"><?php echo e(get_static_option('profile_photo_title') ?? __('Upload profile photo')); ?></h3>
        <div class="setup-wrapper-finish">
            <div class="setup-wrapper-finish-profile">
                <div class="setup-wrapper-finish-profile-flex">
                    <div class="setup-wrapper-finish-profile-thumb profile_photo_area">
                        <?php if(!empty(Auth::user()->image)): ?>
                            <?php if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])): ?>
                                <img src="<?php echo e(render_frontend_cloud_image_if_module_exists( 'profile/'. Auth::user()->image, load_from: Auth::user()->load_from)); ?>" alt="<?php echo e(__('profile img')); ?>">
                            <?php else: ?>
                                <img src="<?php echo e(asset('assets/uploads/profile/'.Auth::user()->image) ?? ''); ?>" alt="<?php echo e(__('profile img')); ?>">
                            <?php endif; ?>
                        <?php else: ?>
                            <img src="<?php echo e(asset('assets/static/single-page/setting_profile.jpg')); ?>" alt="profileImg">
                        <?php endif; ?>
                    </div>
                    <div class="setup-wrapper-finish-profile-content">
                        <span class="cmn-btn btn-bg-1 btn-small hourly-rate-btn"> <?php echo e(__('Upload Photo')); ?> <input type="file" id="upload_profile_photo"> </span>
                        <p class="setup-wrapper-finish-profile-content-para"> <?php echo e(__('Profile photo should be minimum 120x120 pixels')); ?> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Setup Setting Ends -->


<form method="post" enctype="multipart/form-data" id="profilePhotoUploadForm">
    <?php echo csrf_field(); ?>
    <!-- Modal -->
    <div class="modal fade" id="profilePhotoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body file-wrapper text-center">
                    <img src="" alt="" class="profile_photo_preview">
                    <input type="file" name="profile_image" id="profile_image" class="d-none profile_photo_upload">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary save_profile_photo"><?php echo e(__('Save')); ?></button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/freelancer/account/hourly/hourly-rate.blade.php ENDPATH**/ ?>