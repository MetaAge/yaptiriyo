<!-- Setup Experience Start -->
<div class="setup-wrapper-contents">
    <div class="setup-wrapper-contents-item">
        <h3 class="setup-wrapper-contents-title"><?php echo e(get_static_option('experience_title') ?? __('Tell us about your professional experiences(Experience)')); ?></h3>
        <div class="setup-wrapper-experience">
            <div class="setup-wrapper-experience-add">
                <span class="setup-wrapper-experience-add-title"><?php echo e(__('Add a work experience')); ?></span>
                <a href="javascript:void(0)" class="setup-wrapper-experience-add-icon add-experience"> <i
                        class="fas fa-plus"></i> </a>
            </div>
        </div>
    </div>
    <div class="setup-wrapper-contents-item" id="display_user_experience_data">
        <h4 class="setup-wrapper-contents-title-two"><?php echo e(get_static_option('experience_inner_title') ?? __('Experiences')); ?> </h4>
        <?php $__currentLoopData = $experiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $experience): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="setup-wrapper-experience">
                <div class="setup-wrapper-experience-details">
                    <div class="setup-wrapper-experience-details-flex">
                        <div class="setup-wrapper-experience-details-left">
                            <h5 class="setup-wrapper-experience-details-title"> <?php echo e($experience->title); ?> </h5>
                            <p class="setup-wrapper-experience-details-subtitle"> <?php echo e($experience->organization); ?> </p>
                        </div>
                        <a href="javascript:void(0)"
                           class="setup-wrapper-experience-details-edit experience-click edit_single_experience"
                           data-id="<?php echo e($experience->id); ?>"
                           data-title="<?php echo e($experience->title); ?>"
                           data-organization="<?php echo e($experience->organization); ?>"
                           data-address="<?php echo e($experience->address); ?>"
                           data-short_description="<?php echo e($experience->short_description); ?>"
                           data-start_date="<?php echo e(Carbon\Carbon::parse($experience->start_date)->toFormattedDateString()); ?>"
                           data-end_date="<?php echo e($experience->end_date ? Carbon\Carbon::parse($experience->end_date)->toFormattedDateString() : ''); ?>"
                        > <i class="fas fa-edit"></i>
                        </a>
                    </div>
                    <ul class="setup-wrapper-experience-details-list">
                        <li class="setup-wrapper-experience-details-list-item">
                            <span class="list-inner">
                                <i class="fa-solid fa-calendar-days"></i>
                                <span class="list-inner-para"><?php echo e(__('Duration')); ?></span>
                            </span>
                            <span class="list-inner">
                                <span class="list-inner-para">
                                    <?php echo e(Carbon\Carbon::parse($experience->start_date)->toFormattedDateString()); ?> - <a
                                        href="javascript:void(0)"><?php echo e($experience->end_date ? Carbon\Carbon::parse($experience->end_date)->toFormattedDateString() : __('Current Position')); ?> </a>
                                </span>
                            </span>
                        </li>
                        <li class="setup-wrapper-experience-details-list-item">
                            <span class="list-inner"> <i class="fa-solid fa-location-dot"></i> <span
                                    class="list-inner-para"><?php echo e(__('Location')); ?></span> </span>
                            <span class="list-inner"> <span
                                    class="list-inner-para"><?php echo e($experience->address); ?></span></span>
                        </li>
                    </ul>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>


<!-- Edit Experience Starts  -->
<?php echo $__env->make('frontend.user.freelancer.account.experience.edit-experience-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<!-- Edit Experience Ends  -->

<!-- Add Experience Starts  -->
<?php echo $__env->make('frontend.user.freelancer.account.experience.add-experience-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<!-- Add Experience Ends  -->

<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/freelancer/account/experience/experience.blade.php ENDPATH**/ ?>