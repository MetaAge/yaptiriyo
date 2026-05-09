<script src="<?php echo e(asset('assets/backend/js/jquery-ui.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/js/summernote-lite.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/js/jquery.nice-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/js/spectrum.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/js/fontawesome-iconpicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/js/colorpicker.js')); ?>"></script>
<?php if (isset($component)) { $__componentOriginal9c9e2f22010721f1a8a11abf87b15b5e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9c9e2f22010721f1a8a11abf87b15b5e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('media.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9c9e2f22010721f1a8a11abf87b15b5e)): ?>
<?php $attributes = $__attributesOriginal9c9e2f22010721f1a8a11abf87b15b5e; ?>
<?php unset($__attributesOriginal9c9e2f22010721f1a8a11abf87b15b5e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9c9e2f22010721f1a8a11abf87b15b5e)): ?>
<?php $component = $__componentOriginal9c9e2f22010721f1a8a11abf87b15b5e; ?>
<?php unset($__componentOriginal9c9e2f22010721f1a8a11abf87b15b5e); ?>
<?php endif; ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/components/pagebuilder/js.blade.php ENDPATH**/ ?>