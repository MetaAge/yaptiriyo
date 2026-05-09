<?php $__env->startSection('title', __('Email to All Subscriber')); ?>
<?php $__env->startSection('style'); ?>
    <?php if (isset($component)) { $__componentOriginal01cc5c14ee36f86d527b39a5e5a925ec = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal01cc5c14ee36f86d527b39a5e5a925ec = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table.data-table-css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table.data-table-css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal01cc5c14ee36f86d527b39a5e5a925ec)): ?>
<?php $attributes = $__attributesOriginal01cc5c14ee36f86d527b39a5e5a925ec; ?>
<?php unset($__attributesOriginal01cc5c14ee36f86d527b39a5e5a925ec); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal01cc5c14ee36f86d527b39a5e5a925ec)): ?>
<?php $component = $__componentOriginal01cc5c14ee36f86d527b39a5e5a925ec; ?>
<?php unset($__componentOriginal01cc5c14ee36f86d527b39a5e5a925ec); ?>
<?php endif; ?>
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
    <style>
        .w-90 {width: 90%;}

        .w-20 {width: 20%;}
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="dashboard__body">
        <div class="row">
            <div class="col-lg-12">
                <div class="customMarkup__single">
                    <div class="customMarkup__single__item">
                        <div class="customMarkup__single__item__flex">
                            <h4 class="customMarkup__single__title"><?php echo e(__('Email to All Registered Users')); ?></h4>
                        </div>
                        <div class="customMarkup__single__inner mt-4">
                            <div class="custom_table style-04">
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
                                <form method="POST" action="<?php echo e(route('admin.email.send.to.all.users')); ?>" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <div class="single-input mb-3">
                                        <label class="label-title"> <?php echo e(__('Subject')); ?></label>
                                        <input type="text" class="form-control" name="subject" id="subject" placeholder="<?php echo e(__('Enter subject')); ?>">
                                    </div>
                                    <div class="single-input mb-3">
                                        <label class="label-title"> <?php echo e(__('Message')); ?></label>
                                        <textarea class="form-control summernote" name="message" id="message" placeholder="__('Enter subject')"></textarea>
                                    </div>
                                    <div class="form-group mt-5">
                                        <button type="submit" class="btn-profile btn-bg-1" id="email_send_only_for_load_spinner"><?php echo e(__('Send Email')); ?> <span id="spinner_icon_load"></span></button>
                                    </div>
                                </form>
                            </div>
                            <!-- Table End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php if (isset($component)) { $__componentOriginalc522360e2a07084453b413c76e27c7e9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc522360e2a07084453b413c76e27c7e9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.summernote.summernote-js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('summernote.summernote-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc522360e2a07084453b413c76e27c7e9)): ?>
<?php $attributes = $__attributesOriginalc522360e2a07084453b413c76e27c7e9; ?>
<?php unset($__attributesOriginalc522360e2a07084453b413c76e27c7e9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc522360e2a07084453b413c76e27c7e9)): ?>
<?php $component = $__componentOriginalc522360e2a07084453b413c76e27c7e9; ?>
<?php unset($__componentOriginalc522360e2a07084453b413c76e27c7e9); ?>
<?php endif; ?>
    <script>
        //load spinner
        $(document).on('click','#email_send_only_for_load_spinner',function(){
            let subject = $('#subject').val();
            let message = $('#message').val();

            if(subject == '' || message == '') {
                return false
            }

            $('#spinner_icon_load').html('<i class="fas fa-spinner fa-pulse"></i>')
            setTimeout(function () {
                $('#spinner_icon_load').html('');
            },1000000);
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/backend/pages/user/verified-users/verified-users.blade.php ENDPATH**/ ?>