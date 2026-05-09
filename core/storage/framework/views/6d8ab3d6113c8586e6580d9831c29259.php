<script>
    (function ($) {
        "use strict";
        $(document).ready(function () {
            let site_default_currency_symbol = '<?php echo e(site_currency_symbol()); ?>';

            // pagination
            $(document).on('click', '.pagination a', function(e){
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                jobs(page);
            });
            function jobs(page){
                $.ajax({
                    url:"<?php echo e(route('subscriptions.pagination').'?page='); ?>" + page,
                    method:'GET',
                    success:function(res){
                        if(res.status=='nothing'){
                            $('.search_subscription_result').html(`
            <div class="col-span-3">
                <section>
                    <div class="flex items-center justify-center min-h-[calc(100vh-171px)] w-full py-10">
                        <div class="max-w-md flex flex-col items-center justify-center">
                            <img src="/assets/frontend/new_design/assets/images/error-images/no_jobs_found.svg" alt="nothing-found">
                            <p class="text-base-300 text-2xl">Ops! Sorry, no results found.</p>
                        </div>
                    </div>
                </section>
            </div>
        `);
                        }else{
                            $('.search_subscription_result').html(res);
                        }
                    }

                });
            }

            //filter subscription
            //filter subscription
            $(document).on('click', '.get_subscription_type_id', function(e){
                e.preventDefault();
                let type_id = $(this).data('type_id');

                // Remove active class from all buttons
                $('.get_subscription_type_id').removeClass('active bg-secondary text-base-100');

                // Add base classes to all buttons
                $('.get_subscription_type_id').addClass('bg-base-100 hover:bg-secondary hover:text-white');

                // Add active class to clicked button
                $(this).removeClass('bg-base-100 hover:bg-secondary hover:text-white');
                $(this).addClass('active bg-secondary text-base-100');

                $.ajax({
                    url:"<?php echo e(route('subscriptions.filter')); ?>",
                    data:{type_id:type_id},
                    method:'GET',
                    success:function(res){
                        if(res.status=='nothing'){
                            $('.search_subscription_result').html(`
            <div class="col-span-3">
                <section>
                    <div class="flex items-center justify-center min-h-[calc(100vh-171px)] w-full py-10">
                        <div class="max-w-md flex flex-col items-center justify-center">
                            <img src="/assets/frontend/new_design/assets/images/error-images/no_jobs_found.svg" alt="nothing-found">
                            <p class="text-base-300 text-2xl">Ops! Sorry, no Subscription found.</p>
                        </div>
                    </div>
                </section>
            </div>
        `);
                        }else{
                            $('.search_subscription_result').html(res);
                        }
                    }
                });
            });


            //choose plan
            <?php
                $user_type = '';
                if(Auth::check()){
                    $user_type = Auth::user()->user_type == 1 ? 'client' : 'freelancer';
                    $user_type = route($user_type .'.'. 'wallet.history');
                }
            ?>

            $(document).on('click', '.choose_plan', function(e){
                let subscription_id = $(this).data('id');
                let subscription_price = $(this).data('price');
                let balance = <?php echo e(Auth::check() ? Auth::user()->user_wallet?->balance : 0); ?>;
                let default_gateway = '<?php echo e(get_static_option("site_default_payment_gateway")); ?>';

                $('#free_plan_message').remove();

                // Free plan handling
                if(subscription_price <= 0){
                    // Hide all payment gateways
                    $('.confirm-payment.payment-border').hide();

                    // Show a free plan message
                    if($('#free_plan_message').length === 0){
                        $('.modal-body').append('<div id="free_plan_message" class="alert alert-info"><?php echo e(__("This is a free plan. Click Buy Now to activate.")); ?></div>');
                    }
                    $('#order_from_user_wallet').val('free');

                } else {
                    // Paid plan
                    $('.confirm-payment.payment-border').show();
                    $('#free_plan_message').remove();

                    let currentVal = $('#order_from_user_wallet').val();

                    // If currentVal is null, 'free' or empty, restore default gateway
                    if (!currentVal || currentVal === 'free') {
                        $('#order_from_user_wallet').val(default_gateway);
                    }

                    $('#selected_payment_gateway').val($('#order_from_user_wallet').val());

                    let selected_gateway = $('#order_from_user_wallet').val() || default_gateway;
                    $('.payment-gateway-wrapper ul li').removeClass('active selected');
                    $('.payment-gateway-wrapper ul li[data-gateway="'+ selected_gateway +'"]').addClass('active selected');
                }
                $('#subscription_id').val(subscription_id);
                $('#subscription_price').val(subscription_price);

                if(subscription_price > balance){
                     $('.display_balance').html('<span class="text-danger"><?php echo e(__('Wallet Balance Shortage:')); ?>'+ site_default_currency_symbol + (subscription_price-balance) +'</span>');
                     $('.deposit_link').html('<a href="<?php echo e($user_type); ?>" target="_blank"><?php echo e(__('Deposit')); ?></a>');
                }
            })

            // Handle wallet checkbox change - using the correct ID and class
            $(document).on('change', '#wallet_selected_payment_gateway, .wallet_selected_payment_gateway', function(){
                let isChecked = $(this).is(':checked');

                console.log('Wallet checkbox changed. Checked:', isChecked);

                if(isChecked){
                    // Wallet is checked
                    $('#order_from_user_wallet').val('wallet');
                    $('.payment-gateway-wrapper ul li').removeClass('active selected');
                    console.log('Wallet selected, hidden input set to: wallet');
                } else {
                    // Wallet is unchecked - CLEAR THE VALUE COMPLETELY
                    $('#order_from_user_wallet').val('');
                    $('.payment-gateway-wrapper ul li').removeClass('active selected');
                    console.log('Wallet unchecked, hidden input cleared to empty string');
                }
            });

            // login
            $(document).on('click', '.login_to_buy_a_subscription', function(e){
                e.preventDefault();
                let username = $('#username').val();
                let password = $('#password').val();
                let subscription_price = $('#subscription_price').val();
                let erContainer = $(".error-message");
                erContainer.html('');
                $.ajax({
                    url:"<?php echo e(route('subscriptions.user.login')); ?>",
                    data:{username:username,password:password},
                    method:'POST',
                    error:function(res){
                        let errors = res.responseJSON;
                        erContainer.html('<div class="alert alert-danger"></div>');
                        $.each(errors.errors, function(index,value){
                            erContainer.find('.alert.alert-danger').append('<p>'+value+'</p>');
                        });
                    },
                    success: function(res){
                        if(res.status=='success'){
                            location.reload();
                            let balance = res.balance;
                            $('#loginModal').modal('hide');
                            if(subscription_price > balance){
                                $('.load_after_login').load(location.href + ' .load_after_login', function (){
                                    $('.display_balance').html('<span class="text-danger"><?php echo e(__('Wallet Balance Shortage:')); ?>'+ site_default_currency_symbol + (subscription_price-balance) +'</span>');
                                    $('.deposit_link').html('<a href="<?php echo e($user_type); ?>" target="_blank"><?php echo e(__('Deposit')); ?></a>');
                                });
                            }
                        }
                        if(res.status == 'failed'){
                            erContainer.html('<div class="alert alert-danger">'+res.msg+'</div>');
                        }
                    }

                });
            });

            //buy subscription-load spinner
            $(document).on('click','#confirm_buy_subscription_load_spinner',function(e){

                let selected_gateway = $('#order_from_user_wallet').val();
                let subscription_price = $('#subscription_price').val();

                // Validate payment method selection for paid plans
                if(subscription_price > 0 && (!selected_gateway || selected_gateway === '')) {
                    e.preventDefault();
                    toastr_warning_js("<?php echo e(__('Please select a payment method')); ?>")
                    return false;
                }
                //Image validation
                let manual_payment = $('#order_from_user_wallet').val();
                if(manual_payment == 'manual_payment') {
                    let manual_payment_image = $('input[name="manual_payment_image"]').val();
                    if(manual_payment_image == '') {
                        toastr_warning_js("<?php echo e(__('Image field is required')); ?>")
                        return false
                    }
                }

                $('#buy_subscription_load_spinner').html('<i class="fas fa-spinner fa-pulse"></i>')
                setTimeout(function () {
                    $('#buy_subscription_load_spinner').html('');
                }, 10000);
            });

        });
    }(jQuery));
</script>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/Modules/Subscription/Resources/views/frontend/subscriptions/subscriptions-js.blade.php ENDPATH**/ ?>