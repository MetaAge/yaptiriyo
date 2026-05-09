<div class="single-input <?php echo e($divClass ?? 'mb-3'); ?>">
    <label for="<?php echo e($id ?? ''); ?>" class="<?php echo e($labelClass ?? 'label-title'); ?>"><?php echo e($title ?? ''); ?></label>
    <input type="number" min="<?php echo e($min ?? 7); ?>" max="<?php echo e($max ?? 365); ?>" step="<?php echo e($step ?? ''); ?>"  name="<?php echo e($name ?? ''); ?>" id="<?php echo e($id ?? ''); ?>" value="<?php echo e($value ?? ''); ?>" placeholder="<?php echo e($placeholder ?? ''); ?>" class="<?php echo e($class ?? 'form-control'); ?>" >
</div>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/components/form/number.blade.php ENDPATH**/ ?>