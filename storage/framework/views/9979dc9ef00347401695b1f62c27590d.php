<a tabindex="0" class="swal_delete_button_restore <?php echo e($class ?? ''); ?>"><?php echo e($title); ?></a>
<form method='post' action='<?php echo e($url); ?>' class="d-none">
    <input type='hidden' name='_token' value='<?php echo e(csrf_token()); ?>'>
    <br>
    <button type="submit" class="swal_form_submit_btn_restore d-none"></button>
</form>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/components/popup/restore-popup.blade.php ENDPATH**/ ?>