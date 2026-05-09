<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo e(__('Add New Type')); ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo e(route('admin.subscription.type.all')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <?php if (isset($component)) { $__componentOriginal2497cd08ed4b80389f11a0f1101e9ba2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2497cd08ed4b80389f11a0f1101e9ba2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.text','data' => ['title' => __('Type'),'type' => __('text'),'name' => 'type','id' => 'type','value' => old('type', ''),'placeholder' => __('Enter subscription type')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Type')),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('text')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('type'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('type'),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('type', '')),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Enter subscription type'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2497cd08ed4b80389f11a0f1101e9ba2)): ?>
<?php $attributes = $__attributesOriginal2497cd08ed4b80389f11a0f1101e9ba2; ?>
<?php unset($__attributesOriginal2497cd08ed4b80389f11a0f1101e9ba2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2497cd08ed4b80389f11a0f1101e9ba2)): ?>
<?php $component = $__componentOriginal2497cd08ed4b80389f11a0f1101e9ba2; ?>
<?php unset($__componentOriginal2497cd08ed4b80389f11a0f1101e9ba2); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginalaf482b6af4c82cf8ea82fc4d8522b484 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalaf482b6af4c82cf8ea82fc4d8522b484 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.number','data' => ['title' => __('Validity'),'min' => 7,'max' => 365,'name' => 'validity','id' => 'validity','divClass' => 'mb-0','value' => old('validity', ''),'placeholder' => __('Enter validity')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.number'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Validity')),'min' => 7,'max' => 365,'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('validity'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('validity'),'divClass' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('mb-0'),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('validity', '')),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Enter validity'))]); ?>
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
                    <p class="text-info"><?php echo e(__('Validity must be a number between 7 to 365 days')); ?></p>
                    <?php if (isset($component)) { $__componentOriginal1d62194fdaac66ad9f92f098102de78a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1d62194fdaac66ad9f92f098102de78a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.switch-toggle','data' => ['name' => 'is_free','id' => 'is_free','label' => ''.e(__('Is Free Subscription Type?')).'','checked' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.switch-toggle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'is_free','id' => 'is_free','label' => ''.e(__('Is Free Subscription Type?')).'','checked' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1d62194fdaac66ad9f92f098102de78a)): ?>
<?php $attributes = $__attributesOriginal1d62194fdaac66ad9f92f098102de78a; ?>
<?php unset($__attributesOriginal1d62194fdaac66ad9f92f098102de78a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1d62194fdaac66ad9f92f098102de78a)): ?>
<?php $component = $__componentOriginal1d62194fdaac66ad9f92f098102de78a; ?>
<?php unset($__componentOriginal1d62194fdaac66ad9f92f098102de78a); ?>
<?php endif; ?>
                    <p class="text-info"><?php echo e(__('If checked, this type will be considered as a free subscription type.')); ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mt-4" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                    <?php if (isset($component)) { $__componentOriginald51d03ac38950c6ca9fceee323ea1e0d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald51d03ac38950c6ca9fceee323ea1e0d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn.submit','data' => ['title' => __('Save'),'class' => 'btn btn-primary mt-4 pr-4 pl-4 add_type']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn.submit'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Save')),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('btn btn-primary mt-4 pr-4 pl-4 add_type')]); ?>
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
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/Modules/Subscription/Resources/views/backend/type/add-modal.blade.php ENDPATH**/ ?>