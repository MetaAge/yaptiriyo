<!-- Edit Portfolio Popup Starts -->
<div class="popup-fixed portfolio_edit_popup">
    <div class="popup-contents">
        <span class="popup-contents-close popup-close"> <i class="fas fa-times"></i> </span>
        <h5 class="popup-contents-title"><?php echo e(__('Edit Portfolio Project')); ?></h5>
        <div class="error_msg_container mb-4"></div>
        
        <form action="#" id="edit_portfolio_form">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="edit_portfolio_id" id="edit_portfolio_id">
            
            <!-- Upload Zone -->
            <div class="photo-uploaded mb-4">
                <div class="photo-uploaded-icon">
                    <i class="fa-solid fa-image text-3xl"></i>
                </div>
                <div class="edit_portfolio_photo_preview_container mb-2">
                    <img src="" id="portfolio_target_img" class="edit_portfolio_photo_preview">
                </div>
                <span class="font-medium text-base-300 change_image_text"><?php echo e(__('Click to change project image')); ?></span>
                <span class="text-sm text-base-400 mt-2"><?php echo e(__('Recommended: 1200px width, Max 20MB')); ?></span>
                <input class="photo-uploaded-file" type="file" name="edit_image" id="change_portfolio_photo" accept="image/*">
            </div>

            <div class="popup-contents-form custom-form">
                <div class="mb-4">
                    <label for="edit_portfolio_title"><?php echo e(__('Portfolio Title')); ?></label>
                    <input type="text" name="edit_portfolio_title" id="edit_portfolio_title" class="form--control" placeholder="<?php echo e(__('Write Project Title')); ?>">
                    <div class="flex justify-between mt-1">
                        <span id="edit_portfolio_title_error" class="text-xs text-red-500"></span>
                        <span id="edit_portfolio_title_char_counter" class="char-counter">0 / 60</span>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="edit_portfolio_description"><?php echo e(__('Project Description')); ?></label>
                    <textarea name="edit_portfolio_description" id="edit_portfolio_description" class="form--control" rows="4" placeholder="<?php echo e(__('Type Project Details')); ?>"></textarea>
                    <div class="flex justify-between mt-1">
                        <span id="edit_portfolio_description_error" class="text-xs text-red-500"></span>
                        <span id="edit_portfolio_description_char_counter" class="char-counter">0 / 1200</span>
                    </div>
                </div>
            </div>

            <div class="popup-contents-btn">
                <button type="button" class="btn-profile btn-outline-gray popup-close flex-1"><?php echo e(__('Cancel')); ?></button>
                <button type="submit" class="btn-profile btn-bg-1 edit_portfolio flex-1"><?php echo e(__('Update Project')); ?></button>
            </div>
        </form>
    </div>
</div>
<!-- Edit Portfolio Popup Ends --><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/profile-details/edit-portfolio.blade.php ENDPATH**/ ?>