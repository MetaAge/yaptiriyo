<!-- Upload Gallery Start -->
<div class="setup-wrapper-contents">
    <div class="create-project-wrapper-item">
        <div class="create-project-wrapper-item-top profile-border-bottom">
            <h4 class="create-project-wrapper-title"><?php echo e(__('Upload Media')); ?> </h4>
        </div>
        <div class="create-project-wrapper-upload">
            <div class="create-project-wrapper-upload-browse center-text radius-10">

                <div class="project_photos_preview" style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 10px; min-height: 50px;">
                    <?php
                        $existing_images = $project_details->media;
                    ?>

                    <?php if(!empty($existing_images)): ?>
                        <?php $__currentLoopData = $existing_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="existing-image-preview" data-image="<?php echo e($image); ?>" style="position: relative; width: 100px; height: 100px;">
                                <?php if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])): ?>
                                    <img src="<?php echo e(render_frontend_cloud_image_if_module_exists('project/'.$image, load_from: $project_details->load_from)); ?>"
                                         alt="project"
                                         style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px; border: 2px solid #ddd;">
                                <?php else: ?>
                                    <?php $ext = pathinfo($image, PATHINFO_EXTENSION); ?>
                                    <?php if(in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'bmp', 'tiff', 'svg', 'webp', 'gif', 'avif'])): ?>
                                        <img src="<?php echo e(asset('assets/uploads/project/'.$image)); ?>" 
                                             alt="<?php echo e(__('Project Media')); ?>" 
                                             style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px; border: 2px solid #ddd;">
                                    <?php else: ?>
                                        <video src="<?php echo e(asset('assets/uploads/project/'.$image)); ?>" 
                                               style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px; border: 2px solid #ddd;" 
                                               muted></video>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <span class="remove-media-btn" 
                                      style="position: absolute; top: -8px; right: -8px; background: #dc3545; color: white; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 18px; font-weight: bold; box-shadow: 0 2px 5px rgba(0,0,0,0.3); z-index: 10;" 
                                      data-image="<?php echo e($image); ?>" 
                                      title="Remove media">×</span>
                                <span style="position: absolute; bottom: 5px; left: 5px; background: rgba(0,0,0,0.7); color: white; padding: 2px 6px; border-radius: 3px; font-size: 10px;"><?php echo e($index + 1); ?></span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <p class="text-muted"><?php echo e(__('No images uploaded')); ?></p>
                    <?php endif; ?>
                </div>

                <div class="upload-trigger-area" style="cursor: pointer; padding: 20px; text-align: center;">
                    <span class="create-project-wrapper-upload-browse-icon mt-3">
                        <i class="fa-solid fa-image"></i>
                    </span>
                    <span class="create-project-wrapper-upload-browse-para"> <?php echo e(__('Click to add more images/videos (up to 5 total)')); ?> </span>
                </div>
                <input class="upload-gallery" type="file" name="images[]" id="upload_project_photo" multiple accept="image/*,video/*" style="display: none;">
            </div>
            <p class="mt-3">
                <strong><?php echo e(__('info:')); ?></strong> <?php echo e(__('Recommended image dimensions 1770x960 pixels. You can have up to 5 media (images/videos) total.')); ?>

            </p>
        </div>
    </div>
</div>
<!-- Upload Gallery Ends --><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/freelancer/project/edit/project-image.blade.php ENDPATH**/ ?>