<div class="single-profile-settings" id="display_client_profile_info">
    <div class="single-profile-settings-header">
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
        <div class="single-profile-settings-header-flex">
            <?php if (isset($component)) { $__componentOriginaldd5d165d00da56cf3441fe2a6f4754db = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldd5d165d00da56cf3441fe2a6f4754db = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.form-title','data' => ['title' => __('Personal Information'),'class' => 'single-profile-settings-header-title']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.form-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Personal Information')),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('single-profile-settings-header-title')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldd5d165d00da56cf3441fe2a6f4754db)): ?>
<?php $attributes = $__attributesOriginaldd5d165d00da56cf3441fe2a6f4754db; ?>
<?php unset($__attributesOriginaldd5d165d00da56cf3441fe2a6f4754db); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldd5d165d00da56cf3441fe2a6f4754db)): ?>
<?php $component = $__componentOriginaldd5d165d00da56cf3441fe2a6f4754db; ?>
<?php unset($__componentOriginaldd5d165d00da56cf3441fe2a6f4754db); ?>
<?php endif; ?>
            <div class="btn-wrapper">
                <a href="javascript:void(0)" class="btn-profile btn-outline-gray profile-click"><i
                        class="fa-regular fa-edit"></i><?php echo e(__('Edit Info')); ?></a>
            </div>
        </div>
    </div>
    <div class="single-profile-settings-inner profile-border-top">
        <div class="single-profile-settings-form custom-form">
            <div class="single-flex-input">
                <div class="single-input">
                    <label for="title" class="label-title"><?php echo e(__('First Name')); ?></label>
                    <input value="<?php echo e(Auth::guard('web')->user()->first_name ?? ''); ?>" class="form-control" readonly
                        disabled>
                </div>
                <div class="single-input">
                    <label for="title" class="label-title"><?php echo e(__('Last Name')); ?></label>
                    <input value="<?php echo e(Auth::guard('web')->user()->last_name ?? ''); ?>" class="form-control" readonly
                        disabled>
                </div>
            </div>
            <div class="single-input">
                <label for="title" class="label-title"><?php echo e(__('Your Email')); ?></label>
                <input value="<?php echo e(Auth::guard('web')->user()->email ?? ''); ?>" class="form-control" readonly disabled>
            </div>
            <div class="single-input">
                <label for="title" class="label-title"><?php echo e(__('Your Country')); ?></label>
                <input value="<?php echo e(optional(Auth::guard('web')->user()->user_country)->country ?? ''); ?>"
                    class="form-control" readonly disabled>
            </div>

            <?php if(moduleExists('CoinPaymentGateway')): ?>
            <?php else: ?>
                <div class="single-input">
                    <label for="title" class="label-title"><?php echo e(__('Your State')); ?></label>
                    <input value="<?php echo e(optional(Auth::guard('web')->user()->user_state)->state ?? ''); ?>" class="form-control"
                           readonly disabled>
                </div>
                <div class="single-input">
                    <label for="title" class="label-title"><?php echo e(__('Your City')); ?></label>
                    <input value="<?php echo e(optional(Auth::guard('web')->user()->user_city)->city ?? ''); ?>" class="form-control"
                           readonly disabled>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/client/profile/profile-info.blade.php ENDPATH**/ ?>