<?php $__currentLoopData = $more_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $more_cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-lg-4 col-sm-6 setup-work-child work_category_id">
        <input type="hidden" value="<?php echo e($more_cat->id); ?>">
        <div class="setup-wrapper-work-single center-text <?php if(!empty($user_work)): ?> <?php if($cat->id == $user_work->category_id): ?> active <?php endif; ?> <?php endif; ?>">
            <div class="setup-wrapper-work-single-icon">
                <?php echo render_image_markup_by_attachment_id($more_cat->image); ?>

            </div>
            <h4 class="setup-wrapper-work-single-title"> <a href="javascript:void(0)"><?php echo e($more_cat->category); ?></a> </h4>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/freelancer/account/work/search-categories.blade.php ENDPATH**/ ?>