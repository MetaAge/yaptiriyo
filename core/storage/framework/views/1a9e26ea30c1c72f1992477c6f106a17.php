<!-- Add Portfolio Popup Starts -->
<div class="popup-fixed portfolioadd-popup">
    <div class="popup-contents">
        <span class="popup-contents-close popup-close"> <i class="fas fa-times"></i> </span>
        <h5 class="popup-contents-title"><?php echo e(__('Add New Portfolio')); ?></h5>
        <div class="error_msg_container mb-4"></div>
        
        <form action="#" id="add_portfolio_form">
            <?php echo csrf_field(); ?>
            <!-- Upload Zone -->
            <div class="photo-uploaded mb-4">
                <div class="photo-uploaded-icon">
                    <i class="fa-solid fa-cloud-arrow-up text-3xl"></i>
                </div>
                <div class="portfolio_photo_preview_container mb-2 hidden">
                    <img src="" class="portfolio_photo_preview">
                </div>
                <span class="font-medium text-base-300 change_image_text"><?php echo e(__('Click or drag to upload portfolio image')); ?></span>
                <span class="text-sm text-base-400 mt-2"><?php echo e(__('Recommended: 1200px width, Max 20MB')); ?></span>
                <input class="photo-uploaded-file" type="file" name="image" id="upload_portfolio_photo" accept="image/*">
            </div>

            <div class="popup-contents-form custom-form">
                <div class="mb-4">
                    <label for="portfolio_title"><?php echo e(__('Portfolio Title')); ?></label>
                    <input type="text" name="portfolio_title" id="portfolio_title" class="form--control" placeholder="<?php echo e(__('e.g. Modern Dashboard Design')); ?>">
                    <div class="flex justify-between mt-1">
                        <span id="portfolio_title_error" class="text-xs text-red-500"></span>
                        <span id="portfolio_title_char_counter" class="char-counter">0 / 60</span>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="portfolio_description"><?php echo e(__('Project Description')); ?></label>
                    <textarea name="portfolio_description" id="portfolio_description" class="form--control" rows="4" placeholder="<?php echo e(__('Describe the project objectives and your role...')); ?>"></textarea>
                    <div class="flex justify-between mt-1">
                        <span id="portfolio_description_error" class="text-xs text-red-500"></span>
                        <span id="portfolio_description_char_counter" class="char-counter">0 / 1200</span>
                    </div>
                </div>
            </div>

            <div class="popup-contents-btn">
                <button type="button" class="btn-profile btn-outline-gray popup-close flex-1"><?php echo e(__('Cancel')); ?></button>
                <button type="submit" class="btn-profile btn-bg-1 add_portfolio flex-1"><?php echo e(__('Save Project')); ?></button>
            </div>
        </form>
    </div>
</div>
<!-- Add Portfolio Popup Ends -->
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/profile-details/add-portfolio.blade.php ENDPATH**/ ?>