<div class="project-preview-contents mt-4">
    <h4 class="project-preview-contents-title"><?php echo e($project_title_and_description->title); ?></h4>
    <hr>

    <?php
        // Use the accessor method
        $project_images = $project_title_and_description->images ?? [];
    ?>

    <?php if(!empty($project_images)): ?>
        <div class="project-images-gallery mb-4">
            <h5 class="mb-3"><?php echo e(__('Project Images')); ?> (<?php echo e(count($project_images)); ?>)</h5>
            <div class="row g-3">
                <?php $__currentLoopData = $project_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4 col-sm-6">
                        <div class="project-image-item" style="position: relative;">
                            <?php if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])): ?>
                                <img src="<?php echo e(render_frontend_cloud_image_if_module_exists('project/'.$image, load_from: $project_title_and_description->load_from)); ?>"
                                     alt="<?php echo e($project_title_and_description->title); ?>"
                                     class="img-fluid rounded"
                                     style="width: 100%; height: 200px; object-fit: cover;">
                            <?php else: ?>
                                <img src="<?php echo e(asset('assets/uploads/project/'.$image)); ?>"
                                     alt="<?php echo e($project_title_and_description->title); ?>"
                                     class="img-fluid rounded"
                                     style="width: 100%; height: 200px; object-fit: cover;">
                            <?php endif; ?>
                            <span style="position: absolute; bottom: 10px; right: 10px; background: rgba(0,0,0,0.7); color: white; padding: 3px 8px; border-radius: 3px; font-size: 12px;">
                                <?php echo e($index + 1); ?>/<?php echo e(count($project_images)); ?>

                            </span>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <hr>
    <?php endif; ?>

    <h5 class="mb-3"><?php echo e(__('Description')); ?></h5>
    <p class="project-preview-contents-para"><?php echo $project_title_and_description->description; ?></p>
</div><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/freelancer/project/preview/project-description.blade.php ENDPATH**/ ?>