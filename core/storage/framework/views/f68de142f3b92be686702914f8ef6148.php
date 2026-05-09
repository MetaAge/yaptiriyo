<div class="single-input">
    <label class="label-title mt-3"><?php echo e($title); ?></label>
    <?php if($status != ''): ?>
        <select name="status" class="form-control">
            <option value="1" <?php if($status == 1): ?> selected <?php endif; ?>><?php echo e(__('Active')); ?></option>
            <option value="0" <?php if($status == 0): ?> selected <?php endif; ?>><?php echo e(__('Inactive')); ?></option>
        </select>
    <?php else: ?>
        <select name="status" id="status" class="form-control">
            <option value="1"><?php echo e(__('Active')); ?></option>
            <option value="0"><?php echo e(__('Inactive')); ?></option>
        </select>
    <?php endif; ?>
</div>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/components/status/form/active-inactive.blade.php ENDPATH**/ ?>