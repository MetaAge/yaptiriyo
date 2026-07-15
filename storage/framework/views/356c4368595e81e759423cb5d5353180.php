<!-- Setup Work Start -->
<div class="setup-wrapper-contents">
    <div class="setup-wrapper-contents-item">
        <h3 class="setup-wrapper-contents-title"><?php echo e(get_static_option('work_title') ?? __('What kinds of services will you provide to clients?(Work)')); ?></h3>
        <div class="setup-wrapper-work">
            <div class="row g-4">
                <input type="hidden" id="set_category_id" <?php if(!empty($user_work)): ?> value="<?php echo e($user_work->category_id); ?>" <?php else: ?> value="" <?php endif; ?>>
                <input type="hidden" id="set_sub_category_id" <?php if(!empty($user_work)): ?> value="<?php echo e($user_work->sub_category_id); ?>" <?php else: ?> value="" <?php endif; ?>>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4 col-sm-6 setup-work-child work_category_id">
                    <input type="hidden" value="<?php echo e($cat->id); ?>">
                    <div class="setup-wrapper-work-single center-text <?php if(!empty($user_work)): ?> <?php if($cat->id == $user_work->category_id): ?> active <?php endif; ?> <?php endif; ?>">
                        <div class="setup-wrapper-work-single-icon">
                            <?php echo render_image_markup_by_attachment_id($cat->image); ?>

                        </div>
                        <h4 class="setup-wrapper-work-single-title"> <a href="javascript:void(0)"><?php echo e($cat->category); ?></a> </h4>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4 col-sm-6 setup-work-child">
                    <div class="setup-wrapper-work-single center-text work-click">
                        <div class="setup-wrapper-work-single-icon">
                            <h4>+<?php echo e($more_categories->count() ?? ''); ?></h4>
                        </div>
                        <h4 class="setup-wrapper-work-single-title"> <?php echo e(__('Categories to choose from')); ?> </h4>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="setup-wrapper-contents-item">
        <h3 class="setup-wrapper-contents-title-two"> <?php echo e(get_static_option('work_inner_title') ?? __('Choose, what would you do?')); ?> </h3>
        <ul class="setup-wrapper-work-list get_subcategory overflow-auto set_scroll_height">
            <?php if(!empty($user_work->category_id)): ?>
                <?php $sub_categories  = \Modules\Service\Entities\SubCategory::where('category_id',$user_work->category_id)->get();?>
                <?php $__currentLoopData = $sub_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="setup-wrapper-work-list-item get_subcategory choose_a_subcategory <?php if($user_work->sub_category_id === $sub_cat->id && $user_work->user_id === $user_id): ?> active <?php endif; ?>" data-id="<?php echo e($sub_cat->id); ?>"><?php echo e($sub_cat->sub_category); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <span class="choose_a_subcategory"></span>
            <?php endif; ?>
        </ul>
    </div>
</div>

<!-- Popup Modal Work area starts -->
<div class="popup-fixed work-popup">
    <div class="popup-contents">
        <span class="popup-contents-close popup-close"> <i class="fas fa-times"></i> </span>
        <h2 class="popup-contents-title"><?php echo e(get_static_option('work_modal_title') ?? __('Choose a service')); ?></h2>
        <p class="popup-contents-para"><?php echo e(__('Choose what kinds of services will you provide to clients?')); ?></p>
        <div class="popup-contents-form custom-form">
            <form action="#">
                <div class="single-input single-input-icon">
                    <input type="text" class="form--control" id="category_search_string" placeholder="<?php echo e(__('Search service')); ?>">
                    <span class="input-icon"> <i class="fas fa-search"></i> </span>
                </div>
            </form>
        </div>
        <div class="row g-4 mt-2 search_result">
            <?php echo $__env->make('frontend.user.freelancer.account.work.search-categories', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="popup-contents-btn flex-btn justify-content-end profile-border-top">
            <a href="javascript:void(0)" class="btn-profile btn-outline-gray btn-hover-danger popup-close"> <i class="las la-arrow-left"></i><?php echo e(__('Cancel')); ?></a>
        </div>
    </div>
</div>
<!-- Popup Modal area ends -->
<!-- Setup Work Ends -->
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/freelancer/account/work/work.blade.php ENDPATH**/ ?>