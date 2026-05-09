<div class="modal fade" id="userPasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo e(__('Change Password')); ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" id="userPasswordModalForm">
                <input type="hidden" name="user_id_for_change_password" id="user_id_for_change_password" value="">
                <?php echo csrf_field(); ?>
                <div class="modal-body">

                    <?php if (isset($component)) { $__componentOriginalfc4e3c8108f5f9458dc90e11adc2a670 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfc4e3c8108f5f9458dc90e11adc2a670 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.notice.general-notice','data' => ['description' => __('User will get his password via an automated email once password has changed.')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('notice.general-notice'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('User will get his password via an automated email once password has changed.'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfc4e3c8108f5f9458dc90e11adc2a670)): ?>
<?php $attributes = $__attributesOriginalfc4e3c8108f5f9458dc90e11adc2a670; ?>
<?php unset($__attributesOriginalfc4e3c8108f5f9458dc90e11adc2a670); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfc4e3c8108f5f9458dc90e11adc2a670)): ?>
<?php $component = $__componentOriginalfc4e3c8108f5f9458dc90e11adc2a670; ?>
<?php unset($__componentOriginalfc4e3c8108f5f9458dc90e11adc2a670); ?>
<?php endif; ?>

                    <span class="email_send_message d-none"></span>
                    <?php if (isset($component)) { $__componentOriginal7402aa1f0ef356e6819f9aab3e9a0e98 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7402aa1f0ef356e6819f9aab3e9a0e98 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.password','data' => ['title' => __('Enter new password'),'name' => 'password','id' => 'password','class' => 'form-control','placeholder' => __('Enter New password')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.password'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Enter new password')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('password'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('password'),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('form-control'),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Enter New password'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7402aa1f0ef356e6819f9aab3e9a0e98)): ?>
<?php $attributes = $__attributesOriginal7402aa1f0ef356e6819f9aab3e9a0e98; ?>
<?php unset($__attributesOriginal7402aa1f0ef356e6819f9aab3e9a0e98); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7402aa1f0ef356e6819f9aab3e9a0e98)): ?>
<?php $component = $__componentOriginal7402aa1f0ef356e6819f9aab3e9a0e98; ?>
<?php unset($__componentOriginal7402aa1f0ef356e6819f9aab3e9a0e98); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal7402aa1f0ef356e6819f9aab3e9a0e98 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7402aa1f0ef356e6819f9aab3e9a0e98 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.password','data' => ['title' => __('Confirm new password'),'name' => 'confirm_password','id' => 'confirm_password','class' => 'form-control','placeholder' => __('Confirm new password')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.password'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Confirm new password')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('confirm_password'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('confirm_password'),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('form-control'),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Confirm new password'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7402aa1f0ef356e6819f9aab3e9a0e98)): ?>
<?php $attributes = $__attributesOriginal7402aa1f0ef356e6819f9aab3e9a0e98; ?>
<?php unset($__attributesOriginal7402aa1f0ef356e6819f9aab3e9a0e98); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7402aa1f0ef356e6819f9aab3e9a0e98)): ?>
<?php $component = $__componentOriginal7402aa1f0ef356e6819f9aab3e9a0e98; ?>
<?php unset($__componentOriginal7402aa1f0ef356e6819f9aab3e9a0e98); ?>
<?php endif; ?>
                    <span id="new_password_match"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mt-4" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                    <?php if (isset($component)) { $__componentOriginald51d03ac38950c6ca9fceee323ea1e0d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald51d03ac38950c6ca9fceee323ea1e0d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn.submit','data' => ['title' => __('Change Password'),'class' => 'btn btn-primary mt-4 pr-4 pl-4 change_user_password']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn.submit'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Change Password')),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('btn btn-primary mt-4 pr-4 pl-4 change_user_password')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald51d03ac38950c6ca9fceee323ea1e0d)): ?>
<?php $attributes = $__attributesOriginald51d03ac38950c6ca9fceee323ea1e0d; ?>
<?php unset($__attributesOriginald51d03ac38950c6ca9fceee323ea1e0d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald51d03ac38950c6ca9fceee323ea1e0d)): ?>
<?php $component = $__componentOriginald51d03ac38950c6ca9fceee323ea1e0d; ?>
<?php unset($__componentOriginald51d03ac38950c6ca9fceee323ea1e0d); ?>
<?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>

<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/backend/pages/user/user-password-modal.blade.php ENDPATH**/ ?>