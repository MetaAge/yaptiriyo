<script>
    $('.icp-dd').iconpicker();
    $('.icp-dd').on('iconpickerSelected', function(e) {
        var selectedIcon = e.iconpickerValue;
        $(this).parent().parent().children('input').val(selectedIcon);
    });
    $('.icp-dd').iconpicker();
    $('body').on('iconpickerSelected', '.icp-dd', function(e) {
        var selectedIcon = e.iconpickerValue;
        $(this).parent().parent().children('input').val(selectedIcon);
        $('body .dropdown-menu.iconpicker-container').removeClass('show');
    });
</script>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/components/icon-picker/icon-picker.blade.php ENDPATH**/ ?>