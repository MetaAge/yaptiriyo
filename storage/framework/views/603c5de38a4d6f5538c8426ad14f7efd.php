<a tabindex="0" class="<?php echo e($class ?? 'btn dropdown-item status_dropdown__list__link swal_delete_button'); ?>"><?php echo e($title); ?></a>
<form method='post' action='<?php echo e($url); ?>' class="d-none">
    <input type='hidden' name='_token' value='<?php echo e(csrf_token()); ?>'>
    <br>
    <button type="submit" class="swal_form_submit_btn d-none"></button>
</form>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/components/popup/delete-popup.blade.php ENDPATH**/ ?>