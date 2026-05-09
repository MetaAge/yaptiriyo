
<?php if(get_static_option('bottom_to_top') != 'disable'): ?>
    <!-- back to top area start -->
    <div class="back-to-top">
        <span class="back-top"> <i class="fas fa-angle-up"></i> </span>
    </div>
    <!-- back to top area end -->
<?php endif; ?>

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
<script src="<?php echo e(asset('assets/frontend/js/bootstrap.bundle.min.js')); ?>"></script>
<?php if(get_static_option('home_page_animation') != 'disable'): ?>
<!-- Wow Js -->
<script src="<?php echo e(asset('assets/frontend/js/wow.js')); ?>"></script>
<?php endif; ?>
<!-- Slick Js -->
<script src="<?php echo e(asset('assets/frontend/js/slick.js')); ?>"></script>
<!-- All Plugin Js -->
<script src="<?php echo e(asset('assets/frontend/js/all_plugin.js')); ?>"></script>
<!-- Magnific popup Js -->
<script src="<?php echo e(asset('assets/frontend/js/jquery.magnific-popup.js')); ?>"></script>
<!-- main js -->
<script src="<?php echo e(asset('assets/frontend/js/main.js')); ?>"></script>

<script src="<?php echo e(asset('assets/frontend/js/newsletter.js')); ?>"></script>





<!-- Toastr js -->
<?php if(get_static_option('home_page_animation') != 'disable'): ?>
    <!-- Wow Js -->
    <script>new WOW().init();</script>
<?php endif; ?>

<script src="<?php echo e(asset('assets/common/js/toastr.min.js')); ?>"></script>
<?php echo Toastr::message(); ?>

<!-- global ajax setup -->
<script> $.ajaxSetup({headers: {'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'} }) </script>

<?php if(moduleExists('HourlyJob')): ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<?php endif; ?>

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

<script>
    (function($){
        "use strict";
        $(document).ready(function(){
            $(document).on('mouseup', function (e) {
                if ($(e.target).closest('.navbar-right-notification').find('.navbar-right-notification-wrapper').length === 0) {
                    $('.navbar-right-notification-wrapper').removeClass('active');
                }
            });

            $(document).on('click', '.navbar-right-notification-icon', function () {
                $('.navbar-right-notification-wrapper').toggleClass('active');










            });

            $(document).on('click', '.subscription_by_email', function(e){
                e.preventDefault();
                let email = $('#newsletter_subscribe_from_addon input[name="email"]').val();
                let erContainer = $("#newsletter_subscribe_from_addon .error-message");
                erContainer.html('');
                $.ajax({
                    url:"<?php echo e(route('newsletter.subscription')); ?>",
                    data:{email:email},
                    method:'POST',
                    error:function(res){
                        let errors = res.responseJSON;
                        erContainer.html('<div class="alert alert-danger text-start"></div>');
                        $.each(errors.errors, function(index,value){
                            erContainer.find('.alert.alert-danger').append('<p>'+value+'</p>');
                        });
                    },
                    success: function(res){
                        if(res.status=='success'){
                            toastr_success_js("<?php echo e(__('Thanks to Subscription Us.')); ?>")
                            $('input[name="email"]').val('')
                        }
                        if(res.status == 'failed'){
                            erContainer.html('<div class="alert alert-danger">'+res.msg+'</div>');
                        }
                    }

                });
            });
            $(document).on('click', '.subscription_by_email_newsletter', function(e){
                e.preventDefault();
                let email = $('#newsletter_subscribe_from_footer input[name="email"]').val();
                let erContainer = $("#newsletter_subscribe_from_footer .error-message");
                erContainer.html('');
                $.ajax({
                    url:"<?php echo e(route('newsletter.subscription')); ?>",
                    data:{email:email},
                    method:'POST',
                    error:function(res){
                        let errors = res.responseJSON;
                        erContainer.html('<div class="alert alert-danger text-start"></div>');
                        $.each(errors.errors, function(index,value){
                            erContainer.find('.alert.alert-danger').append('<p>'+value+'</p>');
                        });
                    },
                    success: function(res){
                        if(res.status=='success'){
                            toastr_success_js("<?php echo e(__('Thanks to Subscription Us.')); ?>")
                            $('input[name="email"]').val('')
                        }
                        if(res.status == 'failed'){
                            erContainer.html('<div class="alert alert-danger">'+res.msg+'</div>');
                        }
                    }

                });
            });

            //faq question
            $(document).on('click', '.ask_you_question', function(e){
                e.preventDefault();
                let question = $('input[name="question"]').val();
                let erContainer = $("#ask_your_question .error-message");
                erContainer.html('');
                $.ajax({
                    url:"<?php echo e(route('faq.question')); ?>",
                    data:{question:question},
                    method:'POST',
                    error:function(res){
                        let errors = res.responseJSON;
                        erContainer.html('<div class="alert alert-danger text-start"></div>');
                        $.each(errors.errors, function(index,value){
                            erContainer.find('.alert.alert-danger').append('<p>'+value+'</p>');
                        });
                    },
                    success: function(res){
                        if(res.status=='success'){
                            toastr_success_js("<?php echo e(__('Thanks to Question Us.')); ?>")
                            $('input[name="question"]').val('')
                            $("#questionModal").modal('hide');
                        }
                        if(res.status == 'failed'){
                            erContainer.html('<div class="alert alert-danger">'+res.msg+'</div>');
                        }
                    }

                });
            });

            //bookmarks
            $(document).on('click','.click_to_bookmark',function(){
                let identity = $(this).data('identity');
                let route = $(this).data('route');
                let type = $(this).data('type');
                let login = $(this).data('login') ?? '';
                if(login == 'login-please'){
                    toastr_warning_js("<?php echo e(__('Please login to bookmark.')); ?>")
                    return false
                }
                $.ajax({
                    url: route,
                    type: 'post',
                    data: {identity:identity, type:type},
                    success: function(res){
                        if(res.status == 'success'){
                            toastr_success_js("<?php echo e(__('Successfully bookmarked.')); ?>")
                            $(".bookmark_area").load(location.href + ' .bookmark_area');
                        }else if(res.status == 'exists'){
                            toastr_warning_js("<?php echo e(__('Already bookmarked.')); ?>")
                        }
                        else{
                            toastr_warning_js("<?php echo e(__('Something went wrong.')); ?>");
                        }
                    }
                });
            });

            //bookmarks remove
            $(document).on('click','.remove_from_bookmark',function(){
                let identity = $(this).data('identity');
                let route = $(this).data('route');
                $.ajax({
                    url: route,
                    type: 'post',
                    data: {identity:identity},
                    success: function(res){
                        $('#current_password_match').show();
                        if(res.status == 'success'){
                            toastr_success_js("<?php echo e(__('Successfully remove from bookmarked.')); ?>")
                            $(".bookmark_area").load(location.href + ' .bookmark_area');
                        }else{
                            toastr_warning_js("<?php echo e(__('Something went wrong.')); ?>");
                        }
                    }
                });
            });


            //job search from home page
            $(document).on('keyup', '#search_your_desired_job',function(){
                let job_search_string = $('#search_your_desired_job').val();
                let search_type = $('#Select_project_or_job_for_search').val();
                $('.display_search_result').hide()

                if(job_search_string.length >= 1){
                    $('.display_search_result').show()
                    $('#header_search_load_spinner').html('<i class="fas fa-spinner fa-pulse"></i>');
                    $.ajax({
                        url:"<?php echo e(route('home.job.project.search')); ?>",
                        method:"GET",
                        data:{job_search_string:job_search_string, search_type},
                        success:function(res){
                            console.log(res)
                            $('.display_search_result').html(res);
                            $('#header_search_load_spinner').html('<i class="fas fa-search"></i>');
                        }
                    })
                }else{
                    $('.display_search_result').html('');
                }

            })

            $('.video_play').magnificPopup({
                type:'iframe',
            });

            $.fn.select2.defaults.set("language", {
                noResults: function() {
                    return "<?php echo e(__('No results found')); ?>";
                },
                searching: function() {
                    return "<?php echo e(__('Searching...')); ?>";
                }
            });

            //fixed menu js
            if ($('#navigation').length) {
                window.onscroll = function () { myFunction() };

                let navbar = document.getElementById("navigation");
                let sticky = navbar.offsetTop;

                function myFunction() {
                    if (window.pageYOffset >= sticky) {
                        navbar.classList.add("sticky")
                    }
                    if (window.pageYOffset == sticky) {
                        navbar.classList.remove("sticky");
                    }

                }
            }

            <?php if(moduleExists('CurrencySwitcher')): ?>
            $(document).on('change','#currency_switch',function(){
                let currency = $('#currency_switch').val();
                $.ajax({
                    url:"<?php echo e(route('user.currency.switch')); ?>",
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
            <?php if(Auth::guard('web')->check()): ?>
                let userId = "<?php echo e(Auth::guard('web')->user()->id); ?>";
                let liveChat = new LiveChat();
                liveChat.createNotificationChannel(userId);
            <?php endif; ?>

        });
    }(jQuery));
</script>


<script>

    function slickSliderConfiguration() {
        let global = document.querySelectorAll('.global-slick-init');

        global.forEach(function (element, index){
            let parentBoxWidth = element.clientWidth;
            let childCount = element.querySelectorAll('.category-slider-item, .testimonial-item')?.length ?? 0;
            let childItemWidth = element.querySelector('.category-slider-item, .testimonial-item')?.clientWidth ?? 0;

            if(childCount !== 0 && childItemWidth !== 0){
                if((childCount * childItemWidth) < parentBoxWidth){
                    // now hide the div swipe
                    let targetSwipeDiv = element.parentElement.parentElement.parentElement.querySelector('.testimonial-arrows');
                    targetSwipeDiv.classList.add('d-none');
                    targetSwipeDiv.parentElement.classList.remove('mt-5')
                }
            }
        })
    }
    window.addEventListener('load', slickSliderConfiguration,false);
    window.addEventListener('resize', slickSliderConfiguration,false);
</script>

<script>
    //toastr warning
    function toastr_warning_js(msg){
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

    //toastr success
    function toastr_success_js(msg){
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

    //toastr error
    function toastr_error_js(msg){
        Command: toastr["error"](msg, "Error !")
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

<?php echo $__env->yieldContent('script'); ?>
<?php if(!empty( get_static_option('site_third_party_tracking_code'))): ?>
    <?php echo get_static_option('site_third_party_tracking_code'); ?>

<?php endif; ?>
<?php echo renderBodyEndHooks(); ?>

</body>

</html>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/layout/partials/footer.blade.php ENDPATH**/ ?>