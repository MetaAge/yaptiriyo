<?php if(get_static_option('mouse_pointer') != 'disable'): ?>
    <!-- Mouse Cursor start -->
    <div class="mouse-move mouse-outer"></div>
    <div class="mouse-move mouse-inner"></div>
    <!-- Mouse Cursor Ends -->
<?php endif; ?>

<!-- jquery -->
<script src="<?php echo e(asset('assets/common/js/jquery-3.7.1.min.js')); ?>"></script>
<!-- jquery Migrate -->
<script src="<?php echo e(asset('assets/common/js/jquery-migrate-3.4.0.min.js')); ?>"></script>
<!-- bootstrap -->
<script src="<?php echo e(asset('assets/backend/js/bootstrap.bundle.min.js')); ?>"></script>
<!-- All Plugin Js -->
<script src="<?php echo e(asset('assets/backend/js/all_plugin.js')); ?>"></script>
<!-- Chart Js -->
<script src="<?php echo e(asset('assets/backend/js/chart.js')); ?>"></script>
<!-- Map Js -->
<script src="<?php echo e(asset('assets/backend/js/maps/jquery.mousewheel.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/js/maps/raphael.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/js/maps/jquery.mapael.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/js/maps/world_countries.js')); ?>"></script>
<!-- Dashboard main js -->
<script src="<?php echo e(asset('assets/backend/js/dashboard_main.js')); ?>"></script>

<!-- Toastr js -->
<script src="<?php echo e(asset('assets/common/js/toastr.min.js')); ?>"></script>
<?php echo Toastr::message(); ?>


<!-- global ajax setup -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
        }
    })
</script>

<?php if (isset($component)) { $__componentOriginalf1c79c8ea18e2860687f4d18fb9318ac = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf1c79c8ea18e2860687f4d18fb9318ac = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'chat::components.livechat-js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('chat::livechat-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf1c79c8ea18e2860687f4d18fb9318ac)): ?>
<?php $attributes = $__attributesOriginalf1c79c8ea18e2860687f4d18fb9318ac; ?>
<?php unset($__attributesOriginalf1c79c8ea18e2860687f4d18fb9318ac); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf1c79c8ea18e2860687f4d18fb9318ac)): ?>
<?php $component = $__componentOriginalf1c79c8ea18e2860687f4d18fb9318ac; ?>
<?php unset($__componentOriginalf1c79c8ea18e2860687f4d18fb9318ac); ?>
<?php endif; ?>

<?php echo $__env->yieldContent('script'); ?>

<script>
    (function($) {
        "use strict";
        $(document).on('mouseup', function(e) {
            if ($(e.target).closest('.dashboard__notification').find('.dashboard__notification__wrapper')
                .length === 0) {
                $('.dashboard__notification__wrapper').removeClass('active');
            }
        });
        $(document).on('click', '.dashboard__notification__icon', function() {
            $('.dashboard__notification__wrapper').toggleClass('active');
        });
        $(document).on('click', '.swal_delete_button', function(e) {
            e.preventDefault();
            Swal.fire({
                title: '<?php echo e(__('Are you sure to delete?')); ?>',
                text: '<?php echo e(__('You would not be able to revert this item!')); ?>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "<?php echo e(__('Yes, Delete it!')); ?>"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).next().find('.swal_form_submit_btn').trigger('click');
                }
            });
        });
        $(document).on('click', '.swal_delete_button_restore', function(e) {
            e.preventDefault();
            Swal.fire({
                title: '<?php echo e(__('Are you sure to restore?')); ?>',
                text: '<?php echo e(__('You could delete this item anytime!')); ?>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "<?php echo e(__('Yes, Restore it!')); ?>"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).next().find('.swal_form_submit_btn_restore').trigger('click');
                }
            });
        });
        $(document).on('click', '.swal_status_change_button', function(e) {
            e.preventDefault();
            Swal.fire({
                title: '<?php echo e(__('Are you sure?')); ?>',
                text: '<?php echo e(__('You would change status any time')); ?>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "<?php echo e(__('Yes, Change it!')); ?>"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).next().find('.swal_form_submit_btn').trigger('click');
                }
            });
        });
        $(document).on('click', '.wallet_history_status_change', function(e) {
            e.preventDefault();
            Swal.fire({
                title: '<?php echo e(__('Are you sure?')); ?>',
                text: '<?php echo e(__('You would not change it again.')); ?>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "<?php echo e(__('Yes, Change it!')); ?>"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).next().find('.swal_form_submit_btn').trigger('click');
                }
            });
        });
        $(document).on('click', '.reject_project', function(e) {
            e.preventDefault();
            Swal.fire({
                title: '<?php echo e(__('Are you sure?')); ?>',
                text: '<?php echo e(__('To reject this project. you would activate any time')); ?>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "<?php echo e(__('Yes, Reject it!')); ?>"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).next().find('.swal_form_submit_btn').trigger('click');
                }
            });
        });
        $(document).on('click', '.reject_job', function(e) {
            e.preventDefault();
            Swal.fire({
                title: '<?php echo e(__('Are you sure?')); ?>',
                text: '<?php echo e(__('To reject this job. you would activate any time')); ?>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "<?php echo e(__('Yes, Reject it!')); ?>"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).next().find('.swal_form_submit_btn').trigger('click');
                }
            });
        });
        $(document).on('click', '.swal_disable_2fa_button', function(e) {
            e.preventDefault();
            Swal.fire({
                title: '<?php echo e(__('Are you sure?')); ?>',
                text: '<?php echo e(__('Disable 2FA for this user')); ?>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "<?php echo e(__('Yes, disable it!')); ?>"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).next().find('.swal_form_submit_btn').trigger('click');
                }
            });
        });
        $(document).on('click', '.swal_email_verify_button', function(e) {
            e.preventDefault();
            Swal.fire({
                title: '<?php echo e(__('Are you sure?')); ?>',
                text: '<?php echo e(__('To verify this user email.')); ?>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "<?php echo e(__('Yes, verify it!')); ?>"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).next().find('.swal_form_submit_btn').trigger('click');
                }
            });
        });
        $(document).on("click", ".media_upload_form_btn", function() {
            let prevModal = $(this).closest(".modal");
            if (prevModal.length > 0) {
                $(document).on("click", ".media_upload_modal_submit_btn , .modal .close-select-button",
                    function() {
                        $(".media_upload_modal_submit_btn").closest('.modal').hide();
                        prevModal.modal("show");
                    })
            }
        });

        //currency  switch
        <?php if(moduleExists('CurrencySwitcher')): ?>
        $(document).on('change','#currency_switch',function(){
            let currency = $('#currency_switch').val();
            $.ajax({
                url:"<?php echo e(route('admin.currency.switch')); ?>",
                method:'post',
                data:{currency:currency},
                success:function(res){
                    if(res.status == 'success'){
                        location.reload();
                    }
                    if(res.status == 'error'){
                        window.location.href = res.redirect;
                    }
                }
            })
        })
        <?php endif; ?>

        // nofication js
        <?php if(Auth::guard('admin')->check()): ?>
        let adminId = "<?php echo e(Auth::guard('admin')->user()->id); ?>";
        let liveChat = new LiveChat();
        liveChat.createAdminNotificationChannel(adminId);
        <?php endif; ?>

    }(jQuery));
</script>

<script>
    //toastr warning
    function toastr_warning_js(msg) {
        Command: toastr["warning"](msg, "Warning !")
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    }

    //toastr warning
    function toastr_success_js(msg) {
        Command: toastr["success"](msg, "Success !")
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    }
</script>

</body>

</html>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/backend/layout/partials/footer.blade.php ENDPATH**/ ?>