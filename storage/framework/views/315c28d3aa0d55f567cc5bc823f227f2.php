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
                        <div class="col-lg-4 col-md-6">
                            <div class="project-preview new_style">
                                <div class="project-preview-head profile-border-bottom">
                                    <h4 class="project-preview-head-title"><?php echo e(__('Project Catalogues')); ?></h4>
                                </div>
                                <div class="project-preview-thumb" style="position: relative;">
                                    <?php
                                        // Use the accessor method
                                        $project_images = $project->images ?? [];
                                        $first_image = $project->first_image ?? '';
                                    ?>

                                    <?php
                                        $media = $project->images ?? [];
                                        $first_media = $project->first_image ?? '';
                                        $ext = pathinfo($first_media, PATHINFO_EXTENSION);
                                        $is_image = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'bmp', 'tiff', 'svg', 'webp', 'gif', 'avif']);
                                        $media_count = count($media);
                                    ?>
                                    <?php if($first_media): ?>
                                        <?php if($is_image): ?>
                                            <?php if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])): ?>
                                                <img src="<?php echo e(render_frontend_cloud_image_if_module_exists('project/'.$first_media, load_from: $project->load_from)); ?>"
                                                     alt="project"
                                                     style="width: 100%; height: 250px; object-fit: cover; display: block;">
                                            <?php else: ?>
                                                <img src="<?php echo e(asset('assets/uploads/project/'.$first_media)); ?>"
                                                     alt="projectPreview"
                                                     style="width: 100%; height: 250px; object-fit: cover; display: block;">
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <video src="<?php echo e(asset('assets/uploads/project/'.$first_media)); ?>"
                                                   style="width: 100%; height: 250px; object-fit: cover; display: block;"
                                                   controls muted poster="<?php echo e(asset('assets/frontend/new_design/assets/images/error-images/no_image.svg')); ?>"></video> <!-- Fallback poster -->
                                        <?php endif; ?>
                                        
                                        <?php if($media_count > 1): ?>
                                            <span style="position: absolute; top: 10px; right: 10px; background: rgba(0,0,0,0.7); color: white; padding: 5px 10px; border-radius: 5px; font-size: 12px; z-index: 10;">
            <i class="fa-solid fa-images"></i> <?php echo e($media_count); ?>

        </span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <div style="width: 100%; height: 250px; display: flex; align-items: center; justify-content: center; background: #e0e0e0;">
                                            <span>No Image</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="project-preview-contents mt-4">
                                    <h4 class="project-preview-contents-title"><?php echo e($project->title); ?></h4>
                                </div>
                                <div class="project-preview-footer profile-border-top">
                                    <div class="btn-wrapper flex-btn gap-2">
                                        <a href="javascript:void(0)"
                                           class="btn-profile btn-outline-gray project_description_view"
                                           data-bs-toggle="modal"
                                           data-bs-target="#projectDescriptionView"
                                           data-project_id="<?php echo e($project->id); ?>">
                                            <i class="fa-regular fa-eye"></i>
                                            <?php echo e(__('Description')); ?>

                                        </a>
                                        <a href="javascript:void(0)" class="btn-profile btn-outline-gray btn-hover-danger"> <i class="fa-regular fa-trash-can"></i> <?php echo e(__('Delete')); ?></a>
                                        <a href="<?php echo e(route('freelancer.project.edit',$project->id)); ?>" class="btn-profile btn-outline-gray"><i class="fa-regular fa-pen-to-square"></i> <?php echo e(__('Edit')); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>

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

<?php echo $__env->make('frontend.layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/freelancer/project/preview/all-projects.blade.php ENDPATH**/ ?>