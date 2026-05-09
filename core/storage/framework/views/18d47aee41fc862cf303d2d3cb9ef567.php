<div class="modal fade" id="IndividualCommissionSettingsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo e(__('Individual Commission Settings')); ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo e(route('admin.user.individual.commission.settings')); ?>" id="IndividualSettingsModalForm" method="post">
                <input type="hidden" name="user_id_for_individual_settings" id="user_id_for_individual_settings" value="">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <?php if (isset($component)) { $__componentOriginalfc4e3c8108f5f9458dc90e11adc2a670 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfc4e3c8108f5f9458dc90e11adc2a670 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.notice.general-notice','data' => ['description' => __('Notice: Individual Commission Settings means how much percentage will admin get per completed order for the selected user. Generally admin will get 25 percent each order if he/she don\'t set any global/individual commission.')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('notice.general-notice'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Notice: Individual Commission Settings means how much percentage will admin get per completed order for the selected user. Generally admin will get 25 percent each order if he/she don\'t set any global/individual commission.'))]); ?>
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
                    <div class="single-input mt-5 mb-3">
                        <label class="label-title"><?php echo e(__('Commission Type')); ?></label>
                        <select name="admin_commission_type" id="admin_commission_type" class="form-control">
                            <option value=""><?php echo e(__('Select Type')); ?></option>
                            <option value="percentage"><?php echo e(__('Percentage')); ?></option>
                            <option value="fixed"><?php echo e(__('Fixed')); ?></option>
                        </select>
                    </div>
                    <?php if (isset($component)) { $__componentOriginalaf482b6af4c82cf8ea82fc4d8522b484 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalaf482b6af4c82cf8ea82fc4d8522b484 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.number','data' => ['title' => __('Commission Charge'),'min' => '1','max' => '500','name' => 'admin_commission_charge','id' => 'admin_commission_charge','placeholder' => __('Commission Charge')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.number'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Commission Charge')),'min' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('1'),'max' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('500'),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('admin_commission_charge'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('admin_commission_charge'),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Commission Charge'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalaf482b6af4c82cf8ea82fc4d8522b484)): ?>
<?php $attributes = $__attributesOriginalaf482b6af4c82cf8ea82fc4d8522b484; ?>
<?php unset($__attributesOriginalaf482b6af4c82cf8ea82fc4d8522b484); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalaf482b6af4c82cf8ea82fc4d8522b484)): ?>
<?php $component = $__componentOriginalaf482b6af4c82cf8ea82fc4d8522b484; ?>
<?php unset($__componentOriginalaf482b6af4c82cf8ea82fc4d8522b484); ?>
<?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mt-4" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                    <?php if (isset($component)) { $__componentOriginald51d03ac38950c6ca9fceee323ea1e0d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald51d03ac38950c6ca9fceee323ea1e0d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn.submit','data' => ['title' => __('Update'),'class' => 'btn btn-primary mt-4 pr-4 pl-4 admin_individual_settings_for_user']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn.submit'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Update')),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('btn btn-primary mt-4 pr-4 pl-4 admin_individual_settings_for_user')]); ?>
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

<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/backend/pages/user/individual-commission-settings-modal.blade.php ENDPATH**/ ?>