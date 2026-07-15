<!-- Setup Education Start -->
<div class="setup-wrapper-contents">
    <div class="setup-wrapper-contents-item">
        <h3 class="setup-wrapper-contents-title"><?php echo e(get_static_option('education_title') ?? __('What’s your Educational Background?(Education)')); ?></h3>
        <div class="setup-wrapper-experience">
            <div class="setup-wrapper-experience-add">
                <span class="setup-wrapper-experience-add-title"><?php echo e(__('Add a Educational Background')); ?></span>
                <a href="javascript:void(0)" class="setup-wrapper-experience-add-icon add-education"> <i class="fas fa-plus"></i> </a>
            </div>
        </div>
    </div>
    <div class="setup-wrapper-contents-item">
        <h4 class="setup-wrapper-contents-title-two"><?php echo e(get_static_option('education_inner_title') ?? __('Education')); ?></h4>
        <div class="setup-wrapper-experience" id="display_user_education_data">
            <?php $__currentLoopData = $educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="setup-wrapper-experience-details">
                    <div class="setup-wrapper-experience-details-flex">
                        <div class="setup-wrapper-experience-details-left">
                            <h5 class="setup-wrapper-experience-details-title"><?php echo e($education->subject); ?></h5>
                            <p class="setup-wrapper-experience-details-subtitle"><?php echo e($education->institution); ?></p>
                        </div>
                        <a href="javascript:void(0)"
                           class="setup-wrapper-experience-details-edit education-click edit_single_education"
                           data-id ="<?php echo e($education->id); ?>"
                           data-institution ="<?php echo e($education->institution); ?>"
                           data-subject ="<?php echo e($education->subject); ?>"
                           data-degree ="<?php echo e($education->degree); ?>"
                           data-start_date="<?php echo e(Carbon\Carbon::parse($education->start_date)->toFormattedDateString()); ?>"
                           data-end_date="<?php echo e(Carbon\Carbon::parse($education->end_date)->toFormattedDateString()); ?>"
                        >
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                    <ul class="setup-wrapper-experience-details-list">
                        <li class="setup-wrapper-experience-details-list-item">
                            <span class="list-inner"> <i class="fa-solid fa-graduation-cap"></i>
                                <span class="list-inner-para"><?php echo e(__('Degree')); ?></span>
                            </span>
                            <span class="list-inner">
                                <span class="list-inner-para"><?php echo e($education->degree); ?></span>
                            </span>
                        </li>
                        <li class="setup-wrapper-experience-details-list-item">
                            <span class="list-inner"> <i class="fa-solid fa-calendar-days"></i> <span class="list-inner-para"><?php echo e(__('From-To')); ?></span> </span>
                            <span class="list-inner">
                                <span class="list-inner-para"><?php echo e(Carbon\Carbon::parse($education->start_date)->toFormattedDateString()); ?> - <a href="javascript:void(0)"><?php echo e($education->end_date ? Carbon\Carbon::parse($education->end_date)->toFormattedDateString() : __('(Expected)')); ?></a></span>
                            </span>
                        </li>
                    </ul>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>

<?php echo $__env->make('frontend.user.freelancer.account.education.add-education-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('frontend.user.freelancer.account.education.edit-education-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


<!-- Setup Education Ends -->
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/freelancer/account/education/education.blade.php ENDPATH**/ ?>