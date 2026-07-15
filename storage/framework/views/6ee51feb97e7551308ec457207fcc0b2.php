<?php $__env->startSection('site_title', __('Order Rating')); ?>
<?php $__env->startSection('content'); ?>
    <main>
        <?php if (isset($component)) { $__componentOriginal7ecac999957263c09523da7583aa96ad = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7ecac999957263c09523da7583aa96ad = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.category.category','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.category.category'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7ecac999957263c09523da7583aa96ad)): ?>
<?php $attributes = $__attributesOriginal7ecac999957263c09523da7583aa96ad; ?>
<?php unset($__attributesOriginal7ecac999957263c09523da7583aa96ad); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7ecac999957263c09523da7583aa96ad)): ?>
<?php $component = $__componentOriginal7ecac999957263c09523da7583aa96ad; ?>
<?php unset($__componentOriginal7ecac999957263c09523da7583aa96ad); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal1886b76dac2bd4a55dfc12d1a06ee6e4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1886b76dac2bd4a55dfc12d1a06ee6e4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.breadcrumb.user-profile-breadcrumb','data' => ['title' => __('Rating'),'innerTitle' => __('Rating')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('breadcrumb.user-profile-breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Rating')),'innerTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Rating'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1886b76dac2bd4a55dfc12d1a06ee6e4)): ?>
<?php $attributes = $__attributesOriginal1886b76dac2bd4a55dfc12d1a06ee6e4; ?>
<?php unset($__attributesOriginal1886b76dac2bd4a55dfc12d1a06ee6e4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1886b76dac2bd4a55dfc12d1a06ee6e4)): ?>
<?php $component = $__componentOriginal1886b76dac2bd4a55dfc12d1a06ee6e4; ?>
<?php unset($__componentOriginal1886b76dac2bd4a55dfc12d1a06ee6e4); ?>
<?php endif; ?>

        <!-- End Contract area Starts -->
        <div class="end-contract-area pat-100 pab-100 section-bg-2">
            <div class="container">
                <form action="<?php echo e(route('client.order.rating',$id)); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="row gy-4 justify-content-center">
                        <div class="col-lg-8">
                            <input type="hidden" name="skill_rating" id="skill_rating" value="0">
                            <input type="hidden" name="availability_rating" id="availability_rating" value="0">
                            <input type="hidden" name="communication_rating" id="communication_rating" value="0">
                            <input type="hidden" name="work_quality_rating" id="work_quality_rating" value="0">
                            <input type="hidden" name="deadline_rating" id="deadline_rating" value="0">
                            <input type="hidden" name="co_operation_rating" id="co_operation_rating" value="0">

                            <div class="end-contract">
                                <div class="end-contract-single">
                                    <div class="end-contract-single-select">
                                        <label class="label-title"><?php echo e(__('Leave a Review')); ?></label>
                                        <textarea name="review_feedback" id="review_feedback" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="end-contract-feedback mt-4">
                                    <h4 class="end-contract-feedback-title"><?php echo e(__('Provide Feedback')); ?></h4>
                                    <p class="end-contract-feedback-para mt-2"><?php echo e(__('Your feedback will be shared to publicly in freelancer profile and freelancer feedback will be shared publicly in your profile.')); ?></p>
                                    <div class="end-contract-feedback-contents mt-4">

                                        <div data-reaction-type="skills" class="end-contract-feedback-single">
                                            <div class="end-contract-feedback-single-title-flex">
                                                <h4 class="end-contract-feedback-single-title"><?php echo e(__('How would you rate')); ?> <?php echo e($find_login_user_order?->freelancer->first_name); ?><?php echo e(__("'s")); ?>  <?php echo e(__('skills')); ?> </h4>
                                                <div class="btn-wrapper click-skip">
                                                    <a href="javascript:void(0)" class="btn-profile btn-outline-gray get_skill_val" data-skill_val="0"><?php echo e(__('Reset This')); ?></a>
                                                </div>
                                            </div>
                                            <div class="end-contract-feedback-single-contents profile-border-top">
                                                <div class="end-contract-reaction">
                                                    <div class="end-contract-reaction-item reaction-list get_skill_val" data-skill_val="1">
                                                        <span class="end-contract-reaction-item-tooltip"><?php echo e(__('Very sad')); ?></span>
                                                        <div class="end-contract-reaction-item-flex">
                                                            <div class="end-contract-reaction-icon">
                                                                <img src="<?php echo e(asset('assets/static/icons/sad_reaction.svg')); ?>" alt="sad_reaction.svg">
                                                            </div>
                                                            <div class="end-contract-reaction-review">
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="end-contract-reaction-item reaction-list get_skill_val" data-skill_val="2">
                                                        <span class="end-contract-reaction-item-tooltip"><?php echo e(__('Not Good')); ?></span>
                                                        <div class="end-contract-reaction-item-flex">
                                                            <div class="end-contract-reaction-icon">
                                                                <img src="<?php echo e(asset('assets/static/icons/not_good_reaction.svg')); ?>" alt="not_good_reaction.svg">
                                                            </div>
                                                            <div class="end-contract-reaction-review">
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="end-contract-reaction-item reaction-list get_skill_val" data-skill_val="3">
                                                        <span class="end-contract-reaction-item-tooltip"><?php echo e(__("It's Ok")); ?></span>
                                                        <div class="end-contract-reaction-item-flex">
                                                            <div class="end-contract-reaction-icon">
                                                                <img src="<?php echo e(asset('assets/static/icons/its_ok_reaction.svg')); ?>" alt="its_ok_reaction.svg">
                                                            </div>
                                                            <div class="end-contract-reaction-review">
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="end-contract-reaction-item reaction-list get_skill_val" data-skill_val="4">
                                                        <span class="end-contract-reaction-item-tooltip"><?php echo e(__("I'm Happy")); ?></span>
                                                        <div class="end-contract-reaction-item-flex">
                                                            <div class="end-contract-reaction-icon">
                                                                <img src="<?php echo e(asset('assets/static/icons/happy_reaction.svg')); ?>" alt="happy_reaction.svg">
                                                            </div>
                                                            <div class="end-contract-reaction-review">
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="end-contract-reaction-item reaction-list get_skill_val" data-skill_val="5">
                                                        <span class="end-contract-reaction-item-tooltip"><?php echo e(__('Very Happy')); ?></span>
                                                        <div class="end-contract-reaction-item-flex">
                                                            <div class="end-contract-reaction-icon">
                                                                <img src="<?php echo e(asset('assets/static/icons/very_happy_reaction.svg')); ?>" alt="very_happy_reaction.svg">
                                                            </div>
                                                            <div class="end-contract-reaction-review">
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div data-reaction-type="availability" class="end-contract-feedback-single">
                                            <div class="end-contract-feedback-single-title-flex">
                                                <h4 class="end-contract-feedback-single-title"><?php echo e(__('Rate')); ?> <?php echo e($find_login_user_order?->freelancer->first_name); ?><?php echo e(__("'s")); ?> <?php echo e(__('availability')); ?> </h4>
                                                <div class="btn-wrapper click-skip">
                                                    <a href="javascript:void(0)" class="btn-profile btn-outline-gray get_availability_val" data-availability_val="0"><?php echo e(__('Reset This')); ?></a>
                                                </div>
                                            </div>
                                            <div class="end-contract-feedback-single-contents profile-border-top">
                                                <div class="end-contract-reaction">
                                                    <div class="end-contract-reaction-item reaction-list get_availability_val" data-availability_val="1">
                                                        <span class="end-contract-reaction-item-tooltip"><?php echo e(__("Very sad")); ?></span>
                                                        <div class="end-contract-reaction-item-flex">
                                                            <div class="end-contract-reaction-icon">
                                                                <img src="<?php echo e(asset('assets/static/icons/sad_reaction.svg')); ?>" alt="sad_reaction.svg">
                                                            </div>
                                                            <div class="end-contract-reaction-review">
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="end-contract-reaction-item reaction-list get_availability_val" data-availability_val="2">
                                                        <span class="end-contract-reaction-item-tooltip"><?php echo e(__("Not Good")); ?></span>
                                                        <div class="end-contract-reaction-item-flex">
                                                            <div class="end-contract-reaction-icon">
                                                                <img src="<?php echo e(asset('assets/static/icons/not_good_reaction.svg')); ?>" alt="not_good_reaction.svg">
                                                            </div>
                                                            <div class="end-contract-reaction-review">
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="end-contract-reaction-item reaction-list get_availability_val" data-availability_val="3">
                                                        <span class="end-contract-reaction-item-tooltip"><?php echo e(__("It's Ok")); ?></span>
                                                        <div class="end-contract-reaction-item-flex">
                                                            <div class="end-contract-reaction-icon">
                                                                <img src="<?php echo e(asset('assets/static/icons/its_ok_reaction.svg')); ?>" alt="its_ok_reaction.svg">
                                                            </div>
                                                            <div class="end-contract-reaction-review">
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="end-contract-reaction-item reaction-list get_availability_val" data-availability_val="4">
                                                        <span class="end-contract-reaction-item-tooltip"><?php echo e(__("I'm Happy")); ?></span>
                                                        <div class="end-contract-reaction-item-flex">
                                                            <div class="end-contract-reaction-icon">
                                                                <img src="<?php echo e(asset('assets/static/icons/happy_reaction.svg')); ?>" alt="happy_reaction.svg">
                                                            </div>
                                                            <div class="end-contract-reaction-review">
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="end-contract-reaction-item reaction-list get_availability_val" data-availability_val="5">
                                                        <span class="end-contract-reaction-item-tooltip"><?php echo e(__('Very Happy')); ?></span>
                                                        <div class="end-contract-reaction-item-flex">
                                                            <div class="end-contract-reaction-icon">
                                                                <img src="<?php echo e(asset('assets/static/icons/very_happy_reaction.svg')); ?>" alt="very_happy_reaction.svg">
                                                            </div>
                                                            <div class="end-contract-reaction-review">
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div data-reaction-type="communication" class="end-contract-feedback-single">
                                            <div class="end-contract-feedback-single-title-flex">
                                                <h4 class="end-contract-feedback-single-title"><?php echo e(__('Rate')); ?> <?php echo e($find_login_user_order?->freelancer->first_name); ?><?php echo e(__("'s")); ?> <?php echo e(__('Communications')); ?> </h4>
                                                <div class="btn-wrapper click-skip">
                                                    <a href="javascript:void(0)" class="btn-profile btn-outline-gray get_communication_val" data-communication_val="0"><?php echo e(__('Reset This')); ?></a>
                                                </div>
                                            </div>
                                            <div class="end-contract-feedback-single-contents profile-border-top">
                                                <div class="end-contract-reaction">
                                                    <div class="end-contract-reaction-item reaction-list get_communication_val" data-communication_val="1">
                                                        <span class="end-contract-reaction-item-tooltip"><?php echo e(__('Very sad')); ?></span>
                                                        <div class="end-contract-reaction-item-flex">
                                                            <div class="end-contract-reaction-icon">
                                                                <img src="<?php echo e(asset('assets/static/icons/sad_reaction.svg')); ?>" alt="sad_reaction.svg">
                                                            </div>
                                                            <div class="end-contract-reaction-review">
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="end-contract-reaction-item reaction-list get_communication_val" data-communication_val="2">
                                                        <span class="end-contract-reaction-item-tooltip"><?php echo e(__('Not Good')); ?></span>
                                                        <div class="end-contract-reaction-item-flex">
                                                            <div class="end-contract-reaction-icon">
                                                                <img src="<?php echo e(asset('assets/static/icons/not_good_reaction.svg')); ?>" alt="not_good_reaction.svg">
                                                            </div>
                                                            <div class="end-contract-reaction-review">
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="end-contract-reaction-item reaction-list get_communication_val" data-communication_val="3">
                                                        <span class="end-contract-reaction-item-tooltip"><?php echo e(__("It's Ok")); ?></span>
                                                        <div class="end-contract-reaction-item-flex">
                                                            <div class="end-contract-reaction-icon">
                                                                <img src="<?php echo e(asset('assets/static/icons/its_ok_reaction.svg')); ?>" alt="its_ok_reaction.svg">
                                                            </div>
                                                            <div class="end-contract-reaction-review">
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="end-contract-reaction-item reaction-list get_communication_val" data-communication_val="4">
                                                        <span class="end-contract-reaction-item-tooltip"><?php echo e(__("I'm Happy")); ?></span>
                                                        <div class="end-contract-reaction-item-flex">
                                                            <div class="end-contract-reaction-icon">
                                                                <img src="<?php echo e(asset('assets/static/icons/happy_reaction.svg')); ?>" alt="happy_reaction.svg">
                                                            </div>
                                                            <div class="end-contract-reaction-review">
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="end-contract-reaction-item reaction-list get_communication_val" data-communication_val="5">
                                                        <span class="end-contract-reaction-item-tooltip"><?php echo e(__('Very Happy')); ?></span>
                                                        <div class="end-contract-reaction-item-flex">
                                                            <div class="end-contract-reaction-icon">
                                                                <img src="<?php echo e(asset('assets/static/icons/very_happy_reaction.svg')); ?>" alt="very_happy_reaction.svg">
                                                            </div>
                                                            <div class="end-contract-reaction-review">
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div data-reaction-type="work-quality" class="end-contract-feedback-single">
                                            <div class="end-contract-feedback-single-title-flex">
                                                <h4 class="end-contract-feedback-single-title"><?php echo e(__('Rate')); ?> <?php echo e($find_login_user_order?->freelancer->first_name); ?><?php echo e(__("'s")); ?> <?php echo e(__('Work Quality')); ?> </h4>
                                                <div class="btn-wrapper click-skip">
                                                    <a href="javascript:void(0)" class="btn-profile btn-outline-gray get_work_quality_val" data-work_quality_val="0"><?php echo e(__('Reset This')); ?></a>
                                                </div>
                                            </div>
                                            <div class="end-contract-feedback-single-contents profile-border-top">
                                                <div class="end-contract-reaction">
                                                    <div class="end-contract-reaction-item reaction-list get_work_quality_val" data-work_quality_val="1">
                                                        <span class="end-contract-reaction-item-tooltip"><?php echo e(__('Very sad')); ?></span>
                                                        <div class="end-contract-reaction-item-flex">
                                                            <div class="end-contract-reaction-icon">
                                                                <img src="<?php echo e(asset('assets/static/icons/sad_reaction.svg')); ?>" alt="sad_reaction.svg">
                                                            </div>
                                                            <div class="end-contract-reaction-review">
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="end-contract-reaction-item reaction-list get_work_quality_val" data-work_quality_val="2">
                                                        <span class="end-contract-reaction-item-tooltip"><?php echo e(__('Not Good')); ?></span>
                                                        <div class="end-contract-reaction-item-flex">
                                                            <div class="end-contract-reaction-icon">
                                                                <img src="<?php echo e(asset('assets/static/icons/not_good_reaction.svg')); ?>" alt="not_good_reaction.svg">
                                                            </div>
                                                            <div class="end-contract-reaction-review">
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="end-contract-reaction-item reaction-list get_work_quality_val" data-work_quality_val="3">
                                                        <span class="end-contract-reaction-item-tooltip"><?php echo e(__("It's Ok")); ?></span>
                                                        <div class="end-contract-reaction-item-flex">
                                                            <div class="end-contract-reaction-icon">
                                                                <img src="<?php echo e(asset('assets/static/icons/its_ok_reaction.svg')); ?>" alt="its_ok_reaction.svg">
                                                            </div>
                                                            <div class="end-contract-reaction-review">
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="end-contract-reaction-item reaction-list get_work_quality_val" data-work_quality_val="4">
                                                        <span class="end-contract-reaction-item-tooltip"><?php echo e(__("I'm Happy")); ?></span>
                                                        <div class="end-contract-reaction-item-flex">
                                                            <div class="end-contract-reaction-icon">
                                                                <img src="<?php echo e(asset('assets/static/icons/happy_reaction.svg')); ?>" alt="happy_reaction.svg">
                                                            </div>
                                                            <div class="end-contract-reaction-review">
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="end-contract-reaction-item reaction-list get_work_quality_val" data-work_quality_val="5">
                                                        <span class="end-contract-reaction-item-tooltip"><?php echo e(__('Very Happy')); ?></span>
                                                        <div class="end-contract-reaction-item-flex">
                                                            <div class="end-contract-reaction-icon">
                                                                <img src="<?php echo e(asset('assets/static/icons/very_happy_reaction.svg')); ?>" alt="very_happy_reaction.svg">
                                                            </div>
                                                            <div class="end-contract-reaction-review">
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div data-reaction-type="meeting-deadline" class="end-contract-feedback-single">
                                            <div class="end-contract-feedback-single-title-flex">
                                                <h4 class="end-contract-feedback-single-title"><?php echo e(__('Rate')); ?> <?php echo e($find_login_user_order?->freelancer->first_name); ?><?php echo e(__("'s")); ?> <?php echo e(__('Meetings')); ?> </h4>
                                                <div class="btn-wrapper click-skip">
                                                    <a href="javascript:void(0)" class="btn-profile btn-outline-gray get_deadline_val" data-deadline_val="0"><?php echo e(__('Reset This')); ?></a>
                                                </div>
                                            </div>
                                            <div class="end-contract-feedback-single-contents profile-border-top">
                                                <div class="end-contract-reaction">
                                                    <div class="end-contract-reaction-item reaction-list get_deadline_val" data-deadline_val="1">
                                                        <span class="end-contract-reaction-item-tooltip"><?php echo e(__('Very sad')); ?></span>
                                                        <div class="end-contract-reaction-item-flex">
                                                            <div class="end-contract-reaction-icon">
                                                                <img src="<?php echo e(asset('assets/static/icons/sad_reaction.svg')); ?>" alt="sad_reaction.svg">
                                                            </div>
                                                            <div class="end-contract-reaction-review">
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="end-contract-reaction-item reaction-list get_deadline_val" data-deadline_val="2">
                                                        <span class="end-contract-reaction-item-tooltip"><?php echo e(__('Not Good')); ?></span>
                                                        <div class="end-contract-reaction-item-flex">
                                                            <div class="end-contract-reaction-icon">
                                                                <img src="<?php echo e(asset('assets/static/icons/not_good_reaction.svg')); ?>" alt="not_good_reaction.svg">
                                                            </div>
                                                            <div class="end-contract-reaction-review">
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="end-contract-reaction-item reaction-list get_deadline_val" data-deadline_val="3">
                                                        <span class="end-contract-reaction-item-tooltip"><?php echo e(__("It's Ok")); ?></span>
                                                        <div class="end-contract-reaction-item-flex">
                                                            <div class="end-contract-reaction-icon">
                                                                <img src="<?php echo e(asset('assets/static/icons/its_ok_reaction.svg')); ?>" alt="its_ok_reaction.svg">
                                                            </div>
                                                            <div class="end-contract-reaction-review">
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="end-contract-reaction-item reaction-list get_deadline_val" data-deadline_val="4">
                                                        <span class="end-contract-reaction-item-tooltip"><?php echo e(__("I'm Happy")); ?></span>
                                                        <div class="end-contract-reaction-item-flex">
                                                            <div class="end-contract-reaction-icon">
                                                                <img src="<?php echo e(asset('assets/static/icons/happy_reaction.svg')); ?>" alt="happy_reaction.svg">
                                                            </div>
                                                            <div class="end-contract-reaction-review">
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="end-contract-reaction-item reaction-list get_deadline_val" data-deadline_val="5">
                                                        <span class="end-contract-reaction-item-tooltip"><?php echo e(__('Very Happy')); ?></span>
                                                        <div class="end-contract-reaction-item-flex">
                                                            <div class="end-contract-reaction-icon">
                                                                <img src="<?php echo e(asset('assets/static/icons/very_happy_reaction.svg')); ?>" alt="very_happy_reaction.svg">
                                                            </div>
                                                            <div class="end-contract-reaction-review">
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div data-reaction-type="co-operations" class="end-contract-feedback-single">
                                            <div class="end-contract-feedback-single-title-flex">
                                                <h4 class="end-contract-feedback-single-title"><?php echo e(__('Rate')); ?> <?php echo e($find_login_user_order?->freelancer->first_name); ?><?php echo e(__("'s")); ?> <?php echo e(__('Co-operations')); ?> </h4>
                                                <div class="btn-wrapper click-skip">
                                                    <a href="javascript:void(0)" class="btn-profile btn-outline-gray get_co_operation_val" data-co_operation_val="0"><?php echo e(__('Reset This')); ?></a>
                                                </div>
                                            </div>
                                            <div class="end-contract-feedback-single-contents profile-border-top">
                                                <div class="end-contract-reaction">
                                                    <div class="end-contract-reaction-item reaction-list get_co_operation_val" data-co_operation_val="1">
                                                        <span class="end-contract-reaction-item-tooltip"><?php echo e(__('Very sad')); ?></span>
                                                        <div class="end-contract-reaction-item-flex">
                                                            <div class="end-contract-reaction-icon">
                                                                <img src="<?php echo e(asset('assets/static/icons/sad_reaction.svg')); ?>" alt="sad_reaction.svg">
                                                            </div>
                                                            <div class="end-contract-reaction-review">
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="end-contract-reaction-item reaction-list get_co_operation_val" data-co_operation_val="2">
                                                        <span class="end-contract-reaction-item-tooltip"><?php echo e(__('Not Good')); ?></span>
                                                        <div class="end-contract-reaction-item-flex">
                                                            <div class="end-contract-reaction-icon">
                                                                <img src="<?php echo e(asset('assets/static/icons/not_good_reaction.svg')); ?>" alt="not_good_reaction.svg">
                                                            </div>
                                                            <div class="end-contract-reaction-review">
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="end-contract-reaction-item reaction-list get_co_operation_val" data-co_operation_val="3">
                                                        <span class="end-contract-reaction-item-tooltip"><?php echo e(__("It's Ok")); ?></span>
                                                        <div class="end-contract-reaction-item-flex">
                                                            <div class="end-contract-reaction-icon">
                                                                <img src="<?php echo e(asset('assets/static/icons/its_ok_reaction.svg')); ?>" alt="its_ok_reaction.svg">
                                                            </div>
                                                            <div class="end-contract-reaction-review">
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="end-contract-reaction-item reaction-list get_co_operation_val" data-co_operation_val="4">
                                                        <span class="end-contract-reaction-item-tooltip"><?php echo e(__("I'm Happy")); ?></span>
                                                        <div class="end-contract-reaction-item-flex">
                                                            <div class="end-contract-reaction-icon">
                                                                <img src="<?php echo e(asset('assets/static/icons/happy_reaction.svg')); ?>" alt="happy_reaction.svg">
                                                            </div>
                                                            <div class="end-contract-reaction-review">
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="end-contract-reaction-item reaction-list get_co_operation_val" data-co_operation_val="5">
                                                        <span class="end-contract-reaction-item-tooltip"><?php echo e(__('Very Happy')); ?></span>
                                                        <div class="end-contract-reaction-item-flex">
                                                            <div class="end-contract-reaction-icon">
                                                                <img src="<?php echo e(asset('assets/static/icons/very_happy_reaction.svg')); ?>" alt="very_happy_reaction.svg">
                                                            </div>
                                                            <div class="end-contract-reaction-review">
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                                <span class="end-contract-reaction-review-star"><i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="end-contract-widget sticky_top_lg">
                                <div class="end-contract-widget-item">
                                    <ul class="end-contract-widget-list">
                                        <li class="end-contract-widget-list-item skills"><?php echo e(__('Skills')); ?></li>
                                        <li class="end-contract-widget-list-item availability"><?php echo e(__('Availability')); ?></li>
                                        <li class="end-contract-widget-list-item communication"><?php echo e(__('Communication')); ?></li>
                                        <li class="end-contract-widget-list-item work-quality"><?php echo e(__('Work Quality')); ?></li>
                                        <li class="end-contract-widget-list-item meeting-deadline"><?php echo e(__('Meeting Deadline')); ?></li>
                                        <li class="end-contract-widget-list-item co-operations"><?php echo e(__('Co-operations')); ?></li>
                                    </ul>
                                    <div class="end-contract-widget-item-footer profile-border-top">
                                        <div class="overall-score">
                                            <span class="overall-score-para"><?php echo e(__('Overall Score')); ?></span>
                                            <span class="overall-score-review">
                                                <span class="overall-score-review-icon">
                                                    <i class="fa-solid fa-star"></i> </span>
                                                <span class="overall-score-review-para show_average_score">0.0</span>
                                            </span>
                                        </div>
                                        <div class="btn-wrapper mt-4">
                                            <button type="submit" class="btn-profile btn-bg-1 w-100 submit_rating"><?php echo e(__('Submit')); ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Contract area end -->
    </main>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo $__env->make('frontend.user.client.order.rating.rating-js', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/client/order/rating/rating.blade.php ENDPATH**/ ?>