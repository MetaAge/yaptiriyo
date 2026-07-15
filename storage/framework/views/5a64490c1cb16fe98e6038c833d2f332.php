<?php $__env->startSection('site_title',__('Edit Project')); ?>
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
    <?php if (isset($component)) { $__componentOriginal7a9f1fc0e33dbb5b6865e47c39fccade = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7a9f1fc0e33dbb5b6865e47c39fccade = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select2.select2-css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select2.select2-css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7a9f1fc0e33dbb5b6865e47c39fccade)): ?>
<?php $attributes = $__attributesOriginal7a9f1fc0e33dbb5b6865e47c39fccade; ?>
<?php unset($__attributesOriginal7a9f1fc0e33dbb5b6865e47c39fccade); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7a9f1fc0e33dbb5b6865e47c39fccade)): ?>
<?php $component = $__componentOriginal7a9f1fc0e33dbb5b6865e47c39fccade; ?>
<?php unset($__componentOriginal7a9f1fc0e33dbb5b6865e47c39fccade); ?>
<?php endif; ?>
    <style>
        .disabled-link {
            background-color: #ccc !important;
            pointer-events: none;
            cursor: default;
        }
         .sticky {
             position: fixed;
             top: 0;
             width: 100%;
             z-index: 9995;
             background: #fff;
             -webkit-box-shadow: 0px 2px 5px 0px rgba(104, 104, 104, 0.49);
             -moz-box-shadow: 0px 2px 5px 0px rgba(104, 104, 104, 0.49);
             box-shadow: 0px 2px 5px 0px rgba(104, 104, 104, 0.49);
         }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <main>
        <?php if (isset($component)) { $__componentOriginal1886b76dac2bd4a55dfc12d1a06ee6e4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1886b76dac2bd4a55dfc12d1a06ee6e4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.breadcrumb.user-profile-breadcrumb','data' => ['title' => __('Edit Project'),'innerTitle' => __('Edit Project')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('breadcrumb.user-profile-breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Edit Project')),'innerTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Edit Project'))]); ?>
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
        <!-- Account Setup area Starts -->
        <div class="account-area section-bg-2 pat-100 pab-100">
            <div class="container">
                <div class="setup-wrapper create-project-wrap">
                    <div class="setup-wrapper-flex">
                        <?php echo $__env->make('frontend.user.freelancer.project.create.project-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <div class="create-project-wrapper">
                            <?php if (isset($component)) { $__componentOriginal4bb59b834d778ff0cb72af5a473e2885 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4bb59b834d778ff0cb72af5a473e2885 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.validation.error','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('validation.error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4bb59b834d778ff0cb72af5a473e2885)): ?>
<?php $attributes = $__attributesOriginal4bb59b834d778ff0cb72af5a473e2885; ?>
<?php unset($__attributesOriginal4bb59b834d778ff0cb72af5a473e2885); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4bb59b834d778ff0cb72af5a473e2885)): ?>
<?php $component = $__componentOriginal4bb59b834d778ff0cb72af5a473e2885; ?>
<?php unset($__componentOriginal4bb59b834d778ff0cb72af5a473e2885); ?>
<?php endif; ?>
                            <form action="<?php echo e(route('freelancer.project.edit',$project_details->id )); ?>" id="submit_edit_project_form" method="post" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="removed_images" id="removed_images" value="">
                                <input type="hidden" name="keep_existing" value="1">
                                <input type="hidden" name="basic_title" id="set_basic_title">
                                <input type="hidden" name="standard_title" id="set_standard_title">
                                <input type="hidden" name="premium_title" id="set_premium_title">

                                <?php echo $__env->make('frontend.user.freelancer.project.edit.project-introduction', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                <?php echo $__env->make('frontend.user.freelancer.project.edit.project-image', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                <?php echo $__env->make('frontend.user.freelancer.project.edit.project-package-charge', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                <?php echo $__env->make('frontend.user.freelancer.project.edit.project-footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Account Setup area end -->
    </main>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo $__env->make('frontend.user.freelancer.project.edit.edit-project-js', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php if (isset($component)) { $__componentOriginal9731ad5c6354aec53812595a64aa497e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9731ad5c6354aec53812595a64aa497e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.summernote.summernote-js-function','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('summernote.summernote-js-function'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9731ad5c6354aec53812595a64aa497e)): ?>
<?php $attributes = $__attributesOriginal9731ad5c6354aec53812595a64aa497e; ?>
<?php unset($__attributesOriginal9731ad5c6354aec53812595a64aa497e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9731ad5c6354aec53812595a64aa497e)): ?>
<?php $component = $__componentOriginal9731ad5c6354aec53812595a64aa497e; ?>
<?php unset($__componentOriginal9731ad5c6354aec53812595a64aa497e); ?>
<?php endif; ?>
    <script>
        initializeSummernote($('#project_description'), {
            onKeyup: function(e) {
                setTimeout(function(){
                    let description_min_length = 10;
                    let project_description_length = $('#project_description').val().length;
                    if(project_description_length < description_min_length){
                        $('#project_description_char_length_check').html('<p class="text text-danger"><?php echo e(__('Length is short, minimum ')); ?>'+ description_min_length +' <?php echo e(__('required')); ?>.</p>');
                    }else{
                        $('#project_description_char_length_check').html('<p class="text text-success"><?php echo e(__('Length is valid')); ?></p>');
                    }
                },200);
            }
        })
    </script>
    <?php if (isset($component)) { $__componentOriginala34b824a201f14e7e09beb6785e605e8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala34b824a201f14e7e09beb6785e605e8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select2.select2-js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select2.select2-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala34b824a201f14e7e09beb6785e605e8)): ?>
<?php $attributes = $__attributesOriginala34b824a201f14e7e09beb6785e605e8; ?>
<?php unset($__attributesOriginala34b824a201f14e7e09beb6785e605e8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala34b824a201f14e7e09beb6785e605e8)): ?>
<?php $component = $__componentOriginala34b824a201f14e7e09beb6785e605e8; ?>
<?php unset($__componentOriginala34b824a201f14e7e09beb6785e605e8); ?>
<?php endif; ?>

    <script>
        let selectedFiles = [];
        let removedImages = [];
        let existingImagesCount = 0;

        $(document).ready(function() {
            existingImagesCount = $('.existing-image-preview').length;

            $('.upload-trigger-area').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                $('#upload_project_photo').click();
            });

            // Handle file selection
            $('#upload_project_photo').on('change', function(e) {
                const newFiles = Array.from(e.target.files);
                
                if (newFiles.length === 0) return;

                // Add new files
                newFiles.forEach(file => {
                    const exists = selectedFiles.some(f => f.name === file.name && f.size === file.size);
                    if (!exists) {
                        selectedFiles.push(file);
                    }
                });

                const totalImages = existingImagesCount + selectedFiles.length - removedImages.length;

                if (totalImages > 5) {
                    alert('Maximum 5 images allowed total. Please remove some images first.');
                    selectedFiles = selectedFiles.slice(0, 5 - (existingImagesCount - removedImages.length));
                }

                updateNewImagesPreview();
                updateFileInput();
            });

            // Remove existing image
            $(document).on('click', '.remove-media-btn', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const imageName = $(this).data('image');
                const $element = $(this);
                
                Swal.fire({
                    title: '<?php echo e(__("Are you sure?")); ?>',
                    text: '<?php echo e(__("You want to remove this media?")); ?>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '<?php echo e(__("Yes, remove it!")); ?>',
                    cancelButtonText: '<?php echo e(__("Cancel")); ?>'
                }).then((result) => {
                    if (result.isConfirmed) {
                        removedImages.push(imageName);
                        $('#removed_images').val(JSON.stringify(removedImages));
                        
                        $element.closest('.existing-image-preview').fadeOut(300, function() {
                            $(this).remove();
                            existingImagesCount--;

                            if ($('.existing-image-preview').length === 0 && selectedFiles.length === 0) {
                                $('.project_photos_preview').html('<p class="text-muted"><?php echo e(__("No images uploaded")); ?></p>');
                            }
                        });
                        
                        Swal.fire(
                            '<?php echo e(__("Removed!")); ?>',
                            '<?php echo e(__("Media has been removed.")); ?>',
                            'success'
                        );
                    }
                });
            });

            // Remove new media
            $(document).on('click', '.remove-new-media-btn', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const index = $(this).data('index');
                selectedFiles.splice(index, 1);
                updateNewImagesPreview();
                updateFileInput();

                if (selectedFiles.length === 0) {
                    document.getElementById('upload_project_photo').value = '';
                }
            });

            // Update form before submit
            $('#submit_edit_project_form').on('submit', function() {
                $('#removed_images').val(JSON.stringify(removedImages));
            });
        });

        function updateNewImagesPreview() {
            // Remove old new images preview
            $('.new-image-preview').remove();

            if (selectedFiles.length === 0) return;

            const previewContainer = $('.project_photos_preview');
            
            // Remove "no images" message if it exists
            previewContainer.find('.text-muted').remove();

            selectedFiles.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const isImage = file.type.startsWith('image/');
                    const mediaTag = isImage
                        ? `<img src="${e.target.result}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px; border: 2px solid #28a745;">`
                        : `<video src="${e.target.result}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px; border: 2px solid #28a745;" muted loop></video>`;
                    
                    previewContainer.append(`
                        <div class="new-image-preview" style="position: relative; width: 100px; height: 100px;">
                            ${mediaTag}
                            <span class="remove-new-media-btn" style="position: absolute; top: -8px; right: -8px; background: #dc3545; color: white; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 18px; font-weight: bold; box-shadow: 0 2px 5px rgba(0,0,0,0.3); z-index: 10;" data-index="${index}" title="Remove media">×</span>
                            <span style="position: absolute; bottom: 5px; left: 5px; background: rgba(40, 167, 69, 0.9); color: white; padding: 2px 6px; border-radius: 3px; font-size: 10px;">New</span>
                        </div>
                    `);
                };
                reader.readAsDataURL(file);
            });
        }

        function updateFileInput() {
            const input = document.getElementById('upload_project_photo');
            const dt = new DataTransfer();

            selectedFiles.forEach(file => {
                dt.items.add(file);
            });

            input.files = dt.files;
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/freelancer/project/edit/edit-project.blade.php ENDPATH**/ ?>