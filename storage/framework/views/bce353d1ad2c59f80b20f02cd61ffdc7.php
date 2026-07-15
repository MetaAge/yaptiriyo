<?php $__env->startSection('site_title',__('Project Preview')); ?>
<?php $__env->startSection('style'); ?>
    <?php if (isset($component)) { $__componentOriginalc9b7b8cd21a48778d8b7d695ecb54651 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc9b7b8cd21a48778d8b7d695ecb54651 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.summernote.summernote-css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('summernote.summernote-css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc9b7b8cd21a48778d8b7d695ecb54651)): ?>
<?php $attributes = $__attributesOriginalc9b7b8cd21a48778d8b7d695ecb54651; ?>
<?php unset($__attributesOriginalc9b7b8cd21a48778d8b7d695ecb54651); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc9b7b8cd21a48778d8b7d695ecb54651)): ?>
<?php $component = $__componentOriginalc9b7b8cd21a48778d8b7d695ecb54651; ?>
<?php unset($__componentOriginalc9b7b8cd21a48778d8b7d695ecb54651); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <main>
        <?php if (isset($component)) { $__componentOriginal1886b76dac2bd4a55dfc12d1a06ee6e4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1886b76dac2bd4a55dfc12d1a06ee6e4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.breadcrumb.user-profile-breadcrumb','data' => ['title' => __('Project Preview'),'innerTitle' => __('Project Preview')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('breadcrumb.user-profile-breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Project Preview')),'innerTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Project Preview'))]); ?>
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
        <!-- Project preview area Starts -->
        <div class="preview-area section-bg-2 pat-100 pab-100">
            <div class="container">
                <div class="row g-4">
                    <?php $__currentLoopData = $all_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-6">
                        <div class="project-preview">
                            <div class="project-preview-head profile-border-bottom">
                                <h4 class="project-preview-head-title"><?php echo e(__('Project Catalogues')); ?></h4>
                            </div>
                            <div class="project-preview-thumb">
                                <img src="<?php echo e(asset('assets/uploads/project/'.$project->first_image)); ?>" alt="projectPreview">
                            </div>
                            <div class="project-preview-contents mt-4">
                                <h4 class="project-preview-contents-title"><?php echo e($project->title); ?></h4>
                            </div>
                            <div class="project-preview-footer profile-border-top">
                                <div class="btn-wrapper flex-btn justify-content-end">
                                    <a href="javascript:void(0)"
                                       class="btn-profile btn-outline-gray btn-hover-danger project_description_view"
                                       data-bs-toggle="modal"
                                       data-bs-target="#projectDescriptionView"
                                       data-project_id="<?php echo e($project->id); ?>">
                                        <i class="fa-solid fa-eye"></i>
                                        <?php echo e(__('Project Description')); ?>

                                    </a>
                                    <a href="javascript:void(0)" class="btn-profile btn-outline-gray btn-hover-danger"> <i class="fa-solid fa-trash-can"></i><?php echo e(__('Delete Project')); ?></a>
                                    <a href="javascript:void(0)" class="btn-profile btn-bg-1"><?php echo e(__('Edit Project')); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="project-preview">
                            <div class="project-preview-head profile-border-bottom">
                                <h4 class="project-preview-head-title"> <?php echo e(__('Packages & charges')); ?> </h4>
                            </div>
                            <div class="pricing-wrapper d-flex flex-wrap">
                                <!-- left wrapper -->
                                <div class="pricing-wrapper-left">
                                    <div class="pricing-wrapper-card mb-30 wow fadeInLeft" data-wow-delay=".1s">
                                        <div class="pricing-wrapper-card-top">
                                        </div>
                                        <div class="pricing-wrapper-card-bottom">
                                            <div class="pricing-wrapper-card-bottom-list">
                                                <ul class="list-style-none">
                                                    <li><?php echo e(__('Revisions')); ?></li>
                                                    <li><?php echo e(__('Delivery time')); ?></li>
                                                    <?php $__currentLoopData = $project->project_attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li><?php echo e($attr->check_numeric_title); ?></li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <li><?php echo e(__('Charges')); ?></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pricing-wrapper-right d-flex flex-wrap">
                                    <?php if($project->basic_title): ?>
                                        <div class="pricing-wrapper-card text-center wow fadeInRight" data-wow-delay=".2s">
                                            <div class="pricing-wrapper-card-top">
                                                <h2 class="pricing-wrapper-card-top-prices"> <?php echo e($project->basic_title); ?></h2>
                                            </div>
                                            <div class="pricing-wrapper-card-bottom">
                                                <div class="pricing-wrapper-card-bottom-list">
                                                    <ul class="list-style-none">
                                                        <li><span class="close-icon"> <?php echo e($project->basic_revision); ?> </span></li>
                                                        <li><span class="close-icon"> <?php echo e($project->basic_delivery); ?> <?php echo e(__('days')); ?> </span></li>
                                                        <?php $__currentLoopData = $project->project_attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($attr->basic_check_numeric == 'on'): ?>
                                                            <li><span class="check-icon"> <i class="fas fa-check"></i> </span></li>
                                                            <?php else: ?>
                                                            <li><span class="close-icon"> <?php echo e($attr->basic_check_numeric); ?> </span></li>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <li>
                                                            <div class="price">
                                                                <h6 class="price-main"> <?php echo e(float_amount_with_currency_symbol($project->basic_regular_charge )); ?> </h6>
                                                                <s class="price-old"> <?php echo e(float_amount_with_currency_symbol($project->basic_discount_charge)); ?></s>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="pricing-wrapper-card text-center wow fadeInLeft" data-wow-delay=".2s">
                                        <div class="pricing-wrapper-card-top">
                                            <h2 class="pricing-wrapper-card-top-prices"> <?php echo e($project->standard_title); ?> </h2>
                                        </div>
                                        <div class="pricing-wrapper-card-bottom">
                                            <div class="pricing-wrapper-card-bottom-list">
                                                <ul class="list-style-none">
                                                    <li><span class="close-icon"> <?php echo e($project->standard_revision); ?></span></li>
                                                    <li><span class="close-icon"> <?php echo e($project->standard_delivery); ?> <?php echo e(__('days')); ?> </span></li>
                                                    <?php $__currentLoopData = $project->project_attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($attr->basic_check_numeric == 'on'): ?>
                                                            <li><span class="check-icon"> <i class="fas fa-check"></i> </span></li>
                                                        <?php else: ?>
                                                            <li><span class="close-icon"> <?php echo e($attr->standard_check_numeric); ?> </span></li>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                        <div class="price">
                                                            <h6 class="price-main"> <?php echo e(float_amount_with_currency_symbol($project->standard_regular_charge)); ?> </h6>
                                                            <s class="price-old"> <?php echo e(float_amount_with_currency_symbol($project->standard_discount_charge ?? '')); ?></s>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pricing-wrapper-card text-center wow fadeInRight" data-wow-delay=".3s">
                                        <div class="pricing-wrapper-card-top">
                                            <h2 class="pricing-wrapper-card-top-prices"><?php echo e($project->premium_title); ?> </h2>
                                        </div>
                                        <div class="pricing-wrapper-card-bottom">
                                            <div class="pricing-wrapper-card-bottom-list">
                                                <ul class="list-style-none">
                                                    <li><span class="close-icon"> <?php echo e($project->premium_revision); ?> </span></li>
                                                    <li><span class="close-icon"> <?php echo e($project->premium_delivery); ?> <?php echo e(__('days')); ?> </span></li>
                                                    <?php $__currentLoopData = $project->project_attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($attr->basic_check_numeric == 'on'): ?>
                                                            <li><span class="check-icon"> <i class="fas fa-check"></i> </span></li>
                                                        <?php else: ?>
                                                            <li><span class="close-icon"> <?php echo e($attr->premium_check_numeric); ?> </span></li>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                        <div class="price">
                                                            <h6 class="price-main"> <?php echo e(float_amount_with_currency_symbol($project->premium_regular_charge)); ?> </h6>
                                                            <s class="price-old"> <?php echo e(float_amount_with_currency_symbol($project->premium_discount_charge ?? '')); ?></s>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <hr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <!-- Project preview area end -->
    </main>

    <!-- Modal -->
    <div class="modal fade" id="projectDescriptionView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="projectDescriptionViewLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="projectDescriptionViewLabel"><?php echo e(__('Project Description')); ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {

                // project title length check
                $(document).on('click','.project_description_view', function(){
                    let project_id = $(this).data('project_id');
                    $.ajax({
                        url:"<?php echo e(route('freelancer.project.description')); ?>",
                        method:'get',
                        data:{project_id:project_id},
                        success:function(res){
                            $('.modal-body').html(res);
                        },
                    });
                });

            });
        }(jQuery));


    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/freelancer/project/preview/old-all-projects.blade.php ENDPATH**/ ?>