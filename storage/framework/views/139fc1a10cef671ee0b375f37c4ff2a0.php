<?php $__env->startSection('site_title', __('Promotion Checkout')); ?>
<?php $__env->startSection('meta_title'); ?><?php echo e(__('Promotion Checkout')); ?><?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginal5f19dd716048daf403d00235f9f2d409 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5f19dd716048daf403d00235f9f2d409 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.breadcrumb.user-profile-breadcrumb-02','data' => ['innerTitle' => __('Promotion Checkout')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('breadcrumb.user-profile-breadcrumb-02'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['innerTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Promotion Checkout'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5f19dd716048daf403d00235f9f2d409)): ?>
<?php $attributes = $__attributesOriginal5f19dd716048daf403d00235f9f2d409; ?>
<?php unset($__attributesOriginal5f19dd716048daf403d00235f9f2d409); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5f19dd716048daf403d00235f9f2d409)): ?>
<?php $component = $__componentOriginal5f19dd716048daf403d00235f9f2d409; ?>
<?php unset($__componentOriginal5f19dd716048daf403d00235f9f2d409); ?>
<?php endif; ?>
    <main class="py-10 md:py-16 lg:py-[120px]">

        <section class="container mx-auto max-w-7xl px-6">
            <h1 class="text-2xl font-medium text-base-300 mb-6"><?php echo e(__('Promotion Checkout')); ?></h1>

            <form action="<?php echo e(route('freelancer.package.buy')); ?>" method="post" enctype="multipart/form-data" id="promotion-checkout-form">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="set_project_id_for_promote" id="set_project_id_for_promote" value="<?php echo e($projectId); ?>">
                <input type="hidden" name="set_package_budget" id="set_package_budget" value="">
                <input type="hidden" name="transaction_fee" id="transaction_fee" value="0">
                <input type="hidden" name="selected_payment_gateway" id="order_from_user_wallet" value="">

                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Left Column -->
                    <div class="flex-1">
                        <div class="border border-[#D9D9D9] rounded-2xl p-6 bg-white">
                            <!-- Notice -->
                            <div class="bg-[#FA8C00]/10 p-4 rounded-lg mb-6 text-sm text-base-400">
                                <span class="font-medium"><?php echo e(__('Notice:')); ?></span>
                                <?php echo e($isProfile
                                    ? __('Days refers to the number of days your profile will be displayed in the talent page promotional area after purchase.')
                                    : __('Days refers to the number of days your project will be displayed in the project promotional area after purchase.')); ?>

                            </div>

                            <!-- Choose Package -->
                            <div class="mb-6">
                                <h2 class="text-lg font-medium text-base-300 mb-4"><?php echo e(__('Choose Package')); ?></h2>
                                <select id="get_package_budget" name="package_id" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                    <option value=""><?php echo e(__('Select a package')); ?></option>
                                    <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($package->id); ?>"
                                                data-budget="<?php echo e($package->budget); ?>"
                                                data-duration="<?php echo e($package->duration); ?>">
                                            <?php echo e($package->title); ?> -
                                            <?php echo e(float_amount_with_currency_symbol($package->budget)); ?> /
                                            <?php echo e($package->duration); ?> <?php echo e(__('days')); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <!-- Wallet Balance -->
                            <?php if(Auth::check() && Auth::user()->user_wallet?->balance > 0): ?>
                                <div class="mb-6">
                                    <label class="flex items-center gap-3 cursor-pointer mb-2 group">
                                        <div class="relative flex items-center">
                                            <input type="checkbox"
                                                   id="wallet_selected_payment_gateway"
                                                   class="wallet_selected_payment_gateway size-5 appearance-none border border-gray-400 rounded checked:bg-primary checked:border-primary
                                                   checked:bg-[url('<?php echo e(asset("assets/frontend/new_design/assets/images/icons/check.svg")); ?>')] bg-no-repeat bg-center text-white" />
                                        </div>
                                        <span class="text-base-400 font-medium"><?php echo e(__('Use Wallet balance')); ?></span>
                                    </label>
                                    <p class="text-base-400"><?php echo e(__('Wallet Balance:')); ?>

                                        <span class="font-semibold text-base-300 main-balance"><?php echo e(float_amount_with_currency_symbol(Auth::user()->user_wallet?->balance)); ?></span>
                                    </p>
                                    <span class="display_balance block mt-2"></span>
                                    <span class="deposit_link block mt-2"></span>
                                </div>
                            <?php endif; ?>

                            <!-- Payment Gateway Options -->
                            <div class="mb-6">
                                <h2 class="text-lg font-medium text-base-300 mb-4"><?php echo e(__('Payment Method')); ?></h2>
                                <div class="payment-gateway-wrapper">
                                    <?php echo \App\Helper\PaymentGatewayList::renderPaymentGatewayForForm2(false); ?>

                                </div>
                            </div>

                            <!-- Manual Payment Fields (hidden by default) -->
                            <div class="manual_payment_extra_field_information_wrap" style="display: none;">
                                <div class="manual_payment_gateway_extra_field">
                                    <div class="single-input mt-3">
                                        <label class="label-title mb-2"><?php echo e(__('Transaction Screenshot')); ?></label>
                                        <input type="file" name="manual_payment_image" class="form-control" accept="image/*">
                                        <small class="form-text text-muted"><?php echo e(__('Upload proof of payment (screenshot or receipt)')); ?></small>
                                    </div>
                                </div>
                            </div>

                            <hr class="border-[#D9D9D9] my-6">

                            <!-- Buttons -->
                            <div class="flex gap-4">
                                <a href="javascript:history.back()"
                                   class="flex-1 border border-gray-300 text-base-400 py-3 rounded-lg font-medium hover:bg-gray-50 transition text-center">
                                    <?php echo e(__('Cancel')); ?>

                                </a>

                                <button type="submit"
                                        id="confirm_promotion_checkout"
                                        class="flex-1 bg-primary text-white py-3 rounded-lg font-medium hover:bg-primary/90 transition">
                                    <?php echo e(__('Confirm & Pay')); ?> <span id="promotion_load_spinner"></span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column (Summary) -->
                    <div class="lg:w-[380px]">
                        <div class="border border-[#D9D9D9] rounded-2xl p-6 bg-white sticky top-[100px]">
                            <!-- Promotion Info -->
                            <div class="mb-6">
                                <h3 class="text-xl font-medium text-base-300 mb-2">
                                    <?php echo e($isProfile ? __('Profile Promotion') : __('Project Promotion')); ?>

                                </h3>

                                <div id="selected-package-info" class="space-y-4">
                                    <!-- Package details will be inserted here -->
                                </div>
                            </div>

                            <!-- Transaction Fee (hidden initially) -->
                            <div class="mb-4 show_hide_transaction_section" style="display: none;">
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-base-400"><?php echo e(__('Transaction Fee')); ?></span>
                                    <span class="font-medium text-base-300">
                                        <span class="currency_symbol"><?php echo e(site_currency_symbol()); ?></span>
                                        <span class="transaction_fee_amount">0.00</span>
                                    </span>
                                </div>
                            </div>

                            <hr class="border-[#D9D9D9] my-4">

                            <!-- Total -->
                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-lg text-base-300"><?php echo e(__('Total')); ?></span>
                                <span class="font-semibold text-lg text-base-300" id="total_amount">0.00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php if (isset($component)) { $__componentOriginala8bbaec8b85679b9c75e7fd34ed38e55 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bbaec8b85679b9c75e7fd34ed38e55 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.payment-gateway.gateway-select-js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.payment-gateway.gateway-select-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala8bbaec8b85679b9c75e7fd34ed38e55)): ?>
<?php $attributes = $__attributesOriginala8bbaec8b85679b9c75e7fd34ed38e55; ?>
<?php unset($__attributesOriginala8bbaec8b85679b9c75e7fd34ed38e55); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala8bbaec8b85679b9c75e7fd34ed38e55)): ?>
<?php $component = $__componentOriginala8bbaec8b85679b9c75e7fd34ed38e55; ?>
<?php unset($__componentOriginala8bbaec8b85679b9c75e7fd34ed38e55); ?>
<?php endif; ?>
    <script>
        (function($){
            "use strict";

            $(document).ready(function(){
                let site_default_currency_symbol = '<?php echo e(site_currency_symbol()); ?>';
                let wallet_balance = <?php echo e(Auth::check() ? Auth::user()->user_wallet?->balance : 0); ?>;
                let default_gateway = '<?php echo e(get_static_option("site_default_payment_gateway")); ?>';
                let selected_package_price = 0;
                let transaction_fee = 0;
                let total_amount = 0;

                // Update package selection
                $('#get_package_budget').on('change', function() {
                    const selectedOption = $(this).find('option:selected');
                    const packageId = selectedOption.val();
                    const packagePrice = parseFloat(selectedOption.data('budget')) || 0;
                    const packageDuration = selectedOption.data('duration') || 0;

                    // Set hidden inputs
                    $('#set_package_budget').val(packagePrice);
                    selected_package_price = packagePrice;

                    // Update summary
                    $('#selected-package-info').html(`
                        <div class="flex items-baseline mb-2">
                            <span class="text-2xl font-semibold text-base-300">${float_amount_with_currency_symbol_format(packagePrice)}</span>
                            <span class="text-gray-500 ml-2">/ ${packageDuration} <?php echo e(__('days')); ?></span>
                        </div>
                        <p class="text-gray-600 text-sm"><?php echo e($isProfile ? __('Your profile will be promoted for') : __('Your project will be promoted for')); ?> ${packageDuration} <?php echo e(__('days')); ?></p>
                    `);

                    // Update transaction fee and total
                    calculateTransactionFee(packagePrice);
                    updateWalletBalanceCheck(packagePrice);
                });

                // Calculate transaction fee
                function calculateTransactionFee(amount) {
                    let transaction_type = "<?php echo e(get_static_option('promote_transaction_fee_type')); ?>";
                    let transaction_charge = parseFloat("<?php echo e(get_static_option('promote_transaction_fee_charge')); ?>") || 0;

                    if(transaction_charge > 0) {
                        $('.show_hide_transaction_section').show();
                        transaction_fee = transaction_type == 'fixed' ? transaction_charge : (amount * transaction_charge / 100);
                        $('.transaction_fee_amount').text(transaction_fee.toFixed(2));
                        $('#transaction_fee').val(transaction_fee);
                    } else {
                        $('.show_hide_transaction_section').hide();
                        transaction_fee = 0;
                        $('#transaction_fee').val(0);
                    }

                    total_amount = amount + transaction_fee;
                    $('#total_amount').text(float_amount_with_currency_symbol_format(total_amount));
                }

                // Update wallet balance check
                function updateWalletBalanceCheck(packagePrice) {
                    if(packagePrice > wallet_balance && wallet_balance > 0) {
                        const shortage = packagePrice - wallet_balance;
                        $('.display_balance').html('<span class="text-red-600"><?php echo e(__("Wallet Balance Shortage:")); ?> '+ site_default_currency_symbol + shortage.toFixed(2) +'</span>');
                        $('.deposit_link').html('<a href="<?php echo e(route("freelancer.wallet.history")); ?>" target="_blank" class="text-primary hover:underline"><?php echo e(__("Deposit Wallet")); ?></a>');
                    } else {
                        $('.display_balance').html('');
                        $('.deposit_link').html('');
                    }
                }

                // Format currency
                function float_amount_with_currency_symbol_format(amount) {
                    return site_default_currency_symbol + amount.toFixed(2);
                }

                // Payment gateway click handler
                $(document).on('click', '.payment_getway_image ul li', function(e){
                    // Uncheck wallet
                    $('.wallet_selected_payment_gateway').prop("checked", false);

                    // Update UI
                    $('.payment_getway_image ul li').removeClass('active selected border-secondary border-2').addClass('border-[#D9D9D9]');
                    $(this).removeClass('border-[#D9D9D9]').addClass('active selected border-secondary border-2');

                    let gateway = $(this).data('gateway');
                    $('#order_from_user_wallet').val(gateway);

                    // Show/hide kineticpay fields
                    $('.kinetic_payment_show_hide').hide();
                    if(gateway == 'kineticpay'){
                        $('.kinetic_payment_show_hide').show();
                    }

                    // Show/hide manual payment fields
                    $('.manual_payment_extra_field_information_wrap').hide();
                    if(gateway == 'manual_payment'){
                        $('.manual_payment_extra_field_information_wrap').show();
                    }
                });

                // Handle wallet checkbox change
                $(document).on('change', '#wallet_selected_payment_gateway', function(){
                    let isChecked = $(this).is(':checked');

                    if(isChecked){
                        $('#order_from_user_wallet').val('wallet');
                        $('.payment_getway_image ul li').removeClass('active selected border-secondary border-2').addClass('border-[#D9D9D9]');
                    } else {
                        if(default_gateway) {
                            $('#order_from_user_wallet').val(default_gateway);
                            $('.payment-gateway-wrapper ul li[data-gateway="'+ default_gateway +'"]').addClass('active selected border-secondary border-2').removeClass('border-[#D9D9D9]');
                        }
                    }
                });

                // Form submission
                $(document).on('click', '#confirm_promotion_checkout', function(e){
                    const packageId = $('#get_package_budget').val();
                    const selectedGateway = $('#order_from_user_wallet').val();

                    // Validation
                    if(!packageId) {
                        e.preventDefault();
                        toastr_warning_js("<?php echo e(__('Please select a package')); ?>");
                        return false;
                    }

                    if(!selectedGateway) {
                        e.preventDefault();
                        toastr_warning_js("<?php echo e(__('Please select a payment method')); ?>");
                        return false;
                    }

                    // Manual payment image validation
                    if(selectedGateway == 'manual_payment') {
                        const manualPaymentImage = $('input[name="manual_payment_image"]').val();
                        if(!manualPaymentImage) {
                            e.preventDefault();
                            toastr_warning_js("<?php echo e(__('Please upload payment proof')); ?>");
                            return false;
                        }
                    }

                    // Show loading spinner
                    $('#promotion_load_spinner').html('<i class="fas fa-spinner fa-pulse ml-2"></i>');
                });

                // Set default payment gateway on page load
                if(default_gateway) {
                    $('#order_from_user_wallet').val(default_gateway);
                    $(`.payment-gateway-wrapper ul li[data-gateway="${default_gateway}"]`).addClass('active selected border-secondary border-2').removeClass('border-[#D9D9D9]');
                }
            });
        }(jQuery));

        // Toastr warning function
        function toastr_warning_js(message) {
            if(typeof toastr !== 'undefined') {
                toastr.warning(message);
            } else {
                alert(message);
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.new_design.layout.new_master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/profile-details/promotion-checkout.blade.php ENDPATH**/ ?>