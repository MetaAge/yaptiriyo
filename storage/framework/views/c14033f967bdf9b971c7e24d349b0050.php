<?php $__env->startSection('page-meta-data'); ?>
    <?php echo render_page_meta_data_for_service($project); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title', 'Sipariş Oluştur'); ?>

<?php $__env->startSection('content'); ?>
    <main class="py-10 md:py-16 lg:py-[120px]">
        <section class="container mx-auto max-w-7xl px-6">
            <h1 class="text-2xl font-medium text-base-300 mb-6">Ödeme Yöntemi</h1>

            <p class="bg-[#FA8C00]/10 p-4 rounded-lg mb-8 text-sm text-base-400">
                <span class="font-medium">Bilgi:</span>
                Sipariş oluşturmadan önce hizmet veren ile iletişime geçmenizi öneririz. Böylece hizmet verenin siparişinizi reddetme olasılığı azalır.
            </p>

            <?php
                $basePriceValue = 0;
                $extrasPriceValue = 0;
                $finalPriceValue = 0;

                $transactionFeeType = get_static_option('transaction_fee_type');
                $transactionFeeCharge = get_static_option('transaction_fee_charge') ?? 0;
                $transactionFee = 0;

                if(isset($project) && isset($packageType)) {
                    if($packageType == $project->basic_title) {
                        $basePriceValue = floatval($project->basic_discount_charge ?: $project->basic_regular_charge);
                    } elseif($packageType == $project->standard_title) {
                        $basePriceValue = floatval($project->standard_discount_charge ?: $project->standard_regular_charge);
                    } elseif($packageType == $project->premium_title) {
                        $basePriceValue = floatval($project->premium_discount_charge ?: $project->premium_regular_charge);
                    }

                    if (!empty($selectedExtras) && $project->project_attributes->count() > 0) {
                        foreach ($selectedExtras as $extraId) {
                            $attribute = $project->project_attributes->where('id', $extraId)->first();
                            if ($attribute) {
                                if($packageType == $project->basic_title) {
                                    $extrasPriceValue += floatval($attribute->basic_extra_price ?? 0);
                                } elseif($packageType == $project->standard_title) {
                                    $extrasPriceValue += floatval($attribute->standard_extra_price ?? 0);
                                } elseif($packageType == $project->premium_title) {
                                    $extrasPriceValue += floatval($attribute->premium_extra_price ?? 0);
                                }
                            }
                        }
                    }

                    // Miktarlı fiyatlandırma (m²/saat/adet): birim fiyat × miktar.
                    $orderQuantity = max(1, (float) ($quantity ?? request('quantity', 1)));
                    $orderPricingType = $pricingType ?? ($project->pricing_type ?? \App\Enums\PricingType::FIXED);
                    $orderRequiresQty = \App\Enums\PricingType::requiresQuantity($orderPricingType);
                    $orderUnitPrice = $basePriceValue;
                    if ($orderRequiresQty) {
                        $basePriceValue = round($basePriceValue * $orderQuantity, 2);
                    }

                    $finalPriceValue = $basePriceValue + $extrasPriceValue;

                    if ($transactionFeeType == 'fixed') {
                        $transactionFee = (float)$transactionFeeCharge;
                    } else {
                        $transactionFee = ((float)$finalPriceValue * (float)$transactionFeeCharge) / 100;
                    }
                }

                $totalWithFee = $finalPriceValue + $transactionFee;
            ?>

            <form action="<?php echo e(route('order.user.confirm')); ?>" method="post" enctype="multipart/form-data" id="prevent_multiple_order_submit">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="project_id" id="project_id_for_order" value="<?php echo e($project->id ?? ''); ?>">
                <input type="hidden" name="basic_standard_premium_type" id="basic_standard_premium_type" value="<?php echo e($packageType ?? ''); ?>">
                <input type="hidden" name="selected_extras" id="selected_extras_input" value="<?php echo e(json_encode($selectedExtras ?? [])); ?>">
                <input type="hidden" name="selected_payment_gateway" id="order_from_user_wallet" value="">
                <?php if(!empty($orderRequiresQty)): ?>
                    <input type="hidden" name="quantity" value="<?php echo e($orderQuantity); ?>">
                <?php endif; ?>

                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Left Column -->
                    <div class="flex-1">
                        <div class="border border-[#D9D9D9] rounded-2xl p-6 bg-white">
                            <h2 class="text-xl font-medium text-base-300 mb-6">
                                Ödeme Yöntemi Seçin
                            </h2>

                            <?php if(Auth::check() && Auth::user()->user_wallet?->balance > 0): ?>
                                <div class="mb-8">
                                    <?php echo \App\Helper\PaymentGatewayList::renderWalletForm(); ?>

                                    <p class="text-base-400 ml-8 mt-0"> <!-- mt-0 for no margin, or mt-0.5 for tiny gap -->
                                        <?php echo e(__('Cüzdan Bakiyesi:')); ?>

                                        <span class="font-semibold text-base-300 main-balance"><?php echo e(float_amount_with_currency_symbol(Auth::user()->user_wallet?->balance)); ?></span>
                                    </p>
                                    <span class="display_balance text-sm text-base-400 ml-8 block mt-1"></span>
                                    <span class="deposit_link text-sm text-primary ml-8 block mt-1"></span>
                                </div>
                            <?php endif; ?>

                            <?php if($transactionFee > 0): ?>
                                <p class="text-base-400 mb-4">
                                    <?php echo e(__('İşlem Ücreti:')); ?>

                                    <span class="text-base-300 font-medium">
                                        +<?php echo e(float_amount_with_currency_symbol($transactionFee)); ?>

                                    </span>
                                </p>
                            <?php endif; ?>

                            <!-- Payment Options Grid -->
                            <div class="mb-8 load_after_login">
                                <?php echo \App\Helper\PaymentGatewayList::renderPaymentGatewayForForm2(false); ?>

                            </div>

                            <!-- Physical Service Details -->
                            <div class="mb-8 bg-gray-50 p-6 rounded-2xl border border-gray-200">
                                <h3 class="text-lg font-semibold text-base-300 mb-4 flex items-center gap-2">
                                    <i class="fa-solid fa-location-dot text-primary"></i>
                                    <?php echo e(__('Hizmet Teslimat Bilgileri')); ?>

                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Phone -->
                                    <div class="col-span-1 md:col-span-2">
                                        <label class="block text-sm font-medium text-base-300 mb-2"><?php echo e(__('İletişim Telefonu')); ?> *</label>
                                        <input type="text" name="phone" class="w-full border border-[#D9D9D9] rounded-lg p-3 text-sm focus:outline-none focus:border-primary" placeholder="05xx xxx xx xx" required>
                                    </div>

                                    <!-- Appointment Date -->
                                    <div class="col-span-1">
                                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                                            <i class="fa-regular fa-calendar-check text-[#FA8C00] mr-1"></i>
                                            <?php echo e(__('Hizmet Tarihi')); ?> *
                                        </label>
                                        <div class="relative">
                                            <input type="text" 
                                                   id="appointment_date_picker" 
                                                   name="appointment_date" 
                                                   placeholder="<?php echo e(__('Gün Seçiniz')); ?>"
                                                   class="w-full bg-white border border-slate-200 rounded-xl p-3.5 pl-11 text-sm focus:outline-none focus:border-[#FA8C00] focus:ring-2 focus:ring-[#FA8C00]/20 transition-all cursor-pointer shadow-sm" 
                                                   required readonly>
                                            <i class="fa-solid fa-calendar absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                        </div>
                                    </div>

                                    <!-- Appointment Time Grid -->
                                    <div class="col-span-1">
                                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                                            <i class="fa-regular fa-clock text-[#FA8C00] mr-1"></i>
                                            <?php echo e(__('Hizmet Saati')); ?> *
                                        </label>
                                        <input type="hidden" name="appointment_time" id="selected_appointment_time" required>
                                        <div class="grid grid-cols-2 gap-2" id="time_slot_container">
                                            <?php
                                                $time_slots = [
                                                    '09:00 - 11:00', '11:00 - 13:00', 
                                                    '13:00 - 15:00', '15:00 - 17:00', 
                                                    '17:00 - 19:00', '19:00 - 21:00'
                                                ];
                                            ?>
                                            <?php $__currentLoopData = $time_slots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <button type="button" 
                                                        data-time="<?php echo e($slot); ?>"
                                                        class="time-slot-btn py-3 px-2 border border-slate-200 rounded-xl text-xs font-medium text-slate-600 hover:border-[#FA8C00] hover:text-[#FA8C00] transition-all flex items-center justify-center gap-1.5 bg-white shadow-sm">
                                                    <?php echo e($slot); ?>

                                                </button>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>

                                    <!-- Country Hidden (Default to Türkiye if exists) -->
                                    <input type="hidden" name="country_id" value="<?php echo e($countries->where('country', 'Türkiye')->first()->id ?? ($countries->first()->id ?? '')); ?>">

                                    <!-- State (City/İl) -->
                                    <div>
                                        <label class="block text-sm font-medium text-base-300 mb-2"><?php echo e(__('Şehir (İl)')); ?> *</label>
                                        <select name="city_id" id="city_id" class="w-full border border-[#D9D9D9] rounded-lg p-3 text-sm focus:outline-none focus:border-primary" required>
                                            <option value=""><?php echo e(__('Şehir Seçin')); ?></option>
                                            <?php
                                                $turkey = $countries->where('country', 'Türkiye')->first();
                                                $states = $turkey ? \Modules\CountryManage\Entities\State::where('country_id', $turkey->id)->get() : [];
                                            ?>
                                            <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($state->id); ?>"><?php echo e($state->state); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <!-- District (İlçe) -->
                                    <div>
                                        <label class="block text-sm font-medium text-base-300 mb-2"><?php echo e(__('İlçe')); ?> *</label>
                                        <select name="state_id" id="state_id" class="w-full border border-[#D9D9D9] rounded-lg p-3 text-sm focus:outline-none focus:border-primary" required>
                                            <option value=""><?php echo e(__('Önce Şehir Seçin')); ?></option>
                                        </select>
                                    </div>

                                    <!-- Address -->
                                    <div class="col-span-1 md:col-span-2">
                                        <label class="block text-sm font-medium text-base-300 mb-2"><?php echo e(__('Hizmet Adresi')); ?> *</label>
                                        <textarea name="service_address" rows="3" class="w-full border border-[#D9D9D9] rounded-lg p-3 text-sm focus:outline-none focus:border-primary resize-none" placeholder="<?php echo e(__('Mahalle, cadde, sokak, bina no, daire no...')); ?>" required></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <?php if(get_static_option('order_enable_disable_description_settings') != 'disable'): ?>
                                <div class="mb-6">
                                    <label class="flex items-center gap-2 mb-3 cursor-pointer">
                                        <input type="checkbox" name="order_description_btn" id="order_description_btn"
                                               class="size-5 appearance-none border border-gray-400 rounded checked:bg-primary checked:border-primary
                   checked:bg-[url('<?php echo e(asset("assets/frontend/new_design/assets/images/icons/check.svg")); ?>')] bg-no-repeat bg-center text-white" />
                                        <span class="font-medium text-base-300">Açıklama</span>
                                    </label>
                                    <div class="description_wrapper d-none">
            <textarea name="order_description" id="order_description" rows="5"
                      class="w-full border border-[#D9D9D9] rounded-lg p-3 text-sm focus:outline-none focus:border-primary resize-none"
                      placeholder="Açıklamanızı girin"></textarea>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Pay by Milestones -->
                            <?php if(get_static_option('order_enable_disable_milestone_settings') != 'disable'): ?>
                                <div class="mb-6">
                                    <label class="flex items-center gap-2 mb-1 cursor-pointer">
                                        <input type="checkbox" name="pay_by_milestone" id="pay_by_milestone"
                                               class="size-5 appearance-none border border-gray-400 rounded checked:bg-primary checked:border-primary
                   checked:bg-[url('<?php echo e(asset("assets/frontend/new_design/assets/images/icons/check.svg")); ?>')] bg-no-repeat bg-center text-white" />
                                        <span class="font-medium text-base-300">Aşamalı Ödeme</span>
                                    </label>
                                    <p class="text-sm text-base-400 ml-7">Hizmetin belirli bir kısmı tamamlandığında belirlediğiniz tutarı ödeyin</p>
                                </div>

                                <!-- Milestone Section -->
                                <div class="mb-8 milestone_wrapper d-none">
                                    <h3 class="font-medium text-base-300 mb-4">Aşama</h3>
                                    <div id="milestone-list" class="space-y-4 mb-4"></div>
                                    <button type="button" id="add-milestone-btn" class="border border-primary text-primary px-4 py-2 rounded-md text-sm font-medium hover:bg-primary/5 transition flex items-center gap-2">
                                        Aşama Ekle <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                            <?php endif; ?>

                            <hr class="border-[#D9D9D9] my-8">

                            <!-- Buttons -->
                            <div class="flex gap-4">
                                <a href="<?php echo e(url()->previous()); ?>" class="flex-1 border border-gray-300 text-base-400 py-3 rounded-lg font-medium hover:bg-gray-50 transition text-center">
                                    İptal
                                </a>
                                <?php if(Auth::guard('web')->check() && (Auth::guard('web')->user()->user_type == 1 || (Auth::guard('web')->user()->user_type == 2 && Session('user_role') == 'client'))): ?>
                                    <button type="submit" class="flex-1 bg-primary text-white py-3 rounded-lg font-medium hover:bg-primary/90 transition" id="order_now_only_for_load_spinner">
                                        Onayla ve Öde<span id="order_create_load_spinner"></span>
                                    </button>
                                <?php else: ?>
                                    <a href="<?php echo e(route('user.register')); ?>" class="flex-1 bg-primary text-white py-3 rounded-lg font-medium hover:bg-primary/90 transition text-center">
                                        Devam etmek için müşteri olarak kayıt olun
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column (Summary) -->
                    <div class="lg:w-[380px]">
                        <div class="border border-[#D9D9D9] rounded-2xl p-6 bg-white sticky top-[100px]">
                            <?php
                                $packageTitle = $packageType ?? '';
                                $revision = 0;
                                $delivery = '';
                                $packageData = null;

                                if(isset($project) && isset($packageType)) {
                                    if($packageType == $project->basic_title) {
                                        $packageTitle = $project->basic_title;
                                        $revision = $project->basic_revision;
                                        $delivery = $project->basic_delivery;
                                        $packageData = 'basic';
                                    } elseif($packageType == $project->standard_title) {
                                        $packageTitle = $project->standard_title;
                                        $revision = $project->standard_revision;
                                        $delivery = $project->standard_delivery;
                                        $packageData = 'standard';
                                    } elseif($packageType == $project->premium_title) {
                                        $packageTitle = $project->premium_title;
                                        $revision = $project->premium_revision;
                                        $delivery = $project->premium_delivery;
                                        $packageData = 'premium';
                                    }
                                }

                                $extrasList = [];
                                if (!empty($selectedExtras) && isset($project) && $project->project_attributes->count() > 0) {
                                    foreach ($selectedExtras as $extraId) {
                                        $attribute = $project->project_attributes->where('id', $extraId)->first();
                                        if ($attribute) {
                                            $extraPrice = 0;
                                            if($packageType == $project->basic_title) {
                                                $extraPrice = floatval($attribute->basic_extra_price ?? 0);
                                            } elseif($packageType == $project->standard_title) {
                                                $extraPrice = floatval($attribute->standard_extra_price ?? 0);
                                            } elseif($packageType == $project->premium_title) {
                                                $extraPrice = floatval($attribute->premium_extra_price ?? 0);
                                            }

                                            if ($extraPrice > 0) {
                                                $extrasList[] = [
                                                    'title' => $attribute->check_numeric_title,
                                                    'price' => $extraPrice
                                                ];
                                            }
                                        }
                                    }
                                }
                            ?>

                            <?php if(isset($project)): ?>
                                <div class="flex gap-4 mb-6">
                                    <?php if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])): ?>
                                        <img src="<?php echo e(render_frontend_cloud_image_if_module_exists('project/'.$project->first_image, load_from: $project->load_from)); ?>"
                                             alt="<?php echo e($project->title ?? ''); ?>" class="w-20 h-16 object-cover rounded-lg">
                                    <?php else: ?>
                                        <img src="<?php echo e(asset('assets/uploads/project/'.$project->first_image)); ?>"
                                             alt="<?php echo e($project->title ?? ''); ?>" class="w-20 h-16 object-cover rounded-lg">
                                    <?php endif; ?>
                                    <h3 class="text-sm font-medium text-base-300 leading-snug"><?php echo e($project->title); ?></h3>
                                </div>

                                <div class="flex justify-between items-center mb-4">
                                    <span class="font-medium text-base-300"><?php echo e($packageTitle); ?></span>
                                    <span class="font-medium text-base-300" id="package-base-price">
                                        <?php echo e(float_amount_with_currency_symbol($basePriceValue)); ?>

                                    </span>
                                </div>

                                <?php if(!empty($orderRequiresQty)): ?>
                                    <?php
                                        $qtyUnit = \App\Enums\PricingType::QUANTITY_LABEL[$orderPricingType] ?? '';
                                    ?>
                                    <div class="flex justify-between items-center mb-4 text-sm bg-primary/5 border border-primary/15 rounded-lg px-3 py-2">
                                        <span class="text-base-400"><?php echo e(__('Birim fiyat × Miktar')); ?></span>
                                        <span class="font-semibold text-base-300">
                                            <?php echo e(yaptiriyo_price_label($orderUnitPrice, $orderPricingType)); ?> × <?php echo e(rtrim(rtrim(number_format($orderQuantity, 2, ',', '.'), '0'), ',')); ?> <?php echo e($qtyUnit); ?>

                                        </span>
                                    </div>
                                <?php endif; ?>

                                <?php if($extrasPriceValue > 0 && !empty($extrasList)): ?>
                                    <div class="mb-4">
                                        <h4 class="text-sm font-medium text-base-300 mb-2">Ek Hizmetler:</h4>
                                        <ul class="space-y-2">
                                            <?php $__currentLoopData = $extrasList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extra): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="flex justify-between items-center text-sm">
                                                    <span class="text-base-400"><?php echo e($extra['title']); ?></span>
                                                    <span class="text-base-300">
                                                        +<?php echo e(float_amount_with_currency_symbol($extra['price'])); ?>

                                                    </span>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <ul class="space-y-3 mb-6">
                                    <li class="flex items-center gap-2 text-sm text-base-400">
                                        <i class="icon-base ti tabler-clock-share icon-18px text-base-300 font-medium"></i>
                                        <?php echo e($delivery); ?> <?php echo e(__('teslim süresi')); ?>

                                    </li>
                                    <li class="flex items-center gap-2 text-sm text-base-400">
                                        <i class="icon-base ti tabler-refresh-dot icon-18px text-base-300 font-medium"></i>
                                        <?php echo e($revision); ?> <?php echo e(__('Revizyon')); ?>

                                    </li>
                                    <?php if($packageData && isset($project)): ?>
                                        <?php $__currentLoopData = $project->project_attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $checkNumeric = '';
                                                $extraPrice = 0;
                                                if($packageData == 'basic') {
                                                    $checkNumeric = $attr->basic_check_numeric;
                                                    $extraPrice = $attr->basic_extra_price ?? 0;
                                                } elseif($packageData == 'standard') {
                                                    $checkNumeric = $attr->standard_check_numeric;
                                                    $extraPrice = $attr->standard_extra_price ?? 0;
                                                } elseif($packageData == 'premium') {
                                                    $checkNumeric = $attr->premium_check_numeric;
                                                    $extraPrice = $attr->premium_extra_price ?? 0;
                                                }
                                            ?>
                                            <?php if($checkNumeric == 'on' && $extraPrice == 0): ?>
                                                <li class="flex items-center gap-2 text-sm text-base-400">
                                                    <i class="icon-base ti tabler-check icon-18px text-base-300 font-medium"></i>
                                                    <?php echo e($attr->check_numeric_title); ?>

                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </ul>

                                <?php if($transactionFee > 0): ?>
                                    <div class="flex justify-between items-center mb-4 text-sm">
                                        <div class="flex items-center gap-1 text-base-400">
                                            <?php echo e(__('İşlem ücreti')); ?> <i class="fa-regular fa-circle-question cursor-help"></i>
                                        </div>
                                        <span class="text-base-400">
                                            +<?php echo e(float_amount_with_currency_symbol($transactionFee)); ?>

                                        </span>
                                    </div>
                                <?php endif; ?>

                                <hr class="border-[#D9D9D9] my-4">

                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-medium text-base-300"><?php echo e(__('Toplam')); ?></span>
                                    <span class="font-medium text-base-300" id="total-price">
                                        <?php echo e(float_amount_with_currency_symbol($totalWithFee)); ?>

                                    </span>
                                </div>
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-base-400"><?php echo e(__('Toplam teslim süresi')); ?></span>
                                    <span class="text-base-400"><?php echo e($delivery); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Milestone Modal -->
            <div id="milestone-modal" class="hidden fixed inset-0 z-50 overflow-y-auto">
                <div id="modal-backdrop" class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>

                <div class="flex min-h-screen items-center justify-center p-4">
                    <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-2xl p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-medium text-base-300">Aşama Ekle</h3>
                            <button id="close-modal-btn" class="text-gray-400 hover:text-gray-600">
                                <i class="fa-solid fa-xmark text-xl"></i>
                            </button>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-base-300 mb-2">Başlık</label>
                                <input type="text" id="m-title" class="w-full border border-[#D9D9D9] rounded-lg p-3 text-sm focus:outline-none focus:border-primary"
                                       placeholder="Başlık girin" required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-base-300 mb-2">Açıklama</label>
                                <textarea id="m-desc" rows="4" class="w-full border border-[#D9D9D9] rounded-lg p-3 text-sm focus:outline-none focus:border-primary resize-none"
                                          placeholder="Açıklama girin" required></textarea>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-base-300 mb-2">Fiyat</label>
                                    <input type="number" id="m-price" step="0.01" class="w-full border border-[#D9D9D9] rounded-lg p-3 text-sm focus:outline-none focus:border-primary"
                                           placeholder="Fiyat girin" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-base-300 mb-2">Revizyon</label>
                                    <input type="number" id="m-revision" min="1" max="100" class="w-full border border-[#D9D9D9] rounded-lg p-3 text-sm focus:outline-none focus:border-primary"
                                           placeholder="Revizyon sayısı" required>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-base-300 mb-2">Teslim Süresi</label>
                                <select id="m-delivery" class="w-full border border-[#D9D9D9] rounded-lg p-3 text-sm focus:outline-none focus:border-primary" required>
                                    <option value="">Teslim Süresi Seçin</option>
                                    <option value="1 Gün">1 Gün</option>
                                    <option value="2 Gün">2 Gün</option>
                                    <option value="3 Gün">3 Gün</option>
                                    <option value="1 Haftadan az">1 Haftadan az</option>
                                    <option value="1 Aydan az">1 Aydan az</option>
                                    <option value="2 Aydan az">2 Aydan az</option>
                                    <option value="3 Aydan az">3 Aydan az</option>
                                    <option value="3 Aydan fazla">3 Aydan fazla</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex gap-4 mt-6">
                            <button type="button" id="save-milestone-btn" class="flex-1 bg-primary text-white py-3 rounded-lg font-medium hover:bg-primary/90 transition">
                                Kaydet
                            </button>
                        </div>
                    </div>
                </div>
            </div>
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
        $(document).ready(function() {
            var currentSelectedGateway = '';

            if($('.wallet_selected_payment_gateway').is(':checked')) {
                currentSelectedGateway = 'wallet';
                $('#order_from_user_wallet').val('wallet');
            }

            var defaultGateway = '<?php echo e(get_static_option("site_default_payment_gateway")); ?>';
            var defaultEnabled = '<?php echo e(get_static_option(get_static_option("site_default_payment_gateway") . "_gateway")); ?>' === 'on';

            if(defaultGateway && defaultEnabled && !currentSelectedGateway) {
                currentSelectedGateway = defaultGateway;
                $('#order_from_user_wallet').val(defaultGateway);

                $('.payment_getway_image ul li[data-gateway="' + defaultGateway + '"]')
                    .removeClass('border-[#D9D9D9]')
                    .addClass('border-secondary border-2 selected active');
            }

            $(document).on('click', '.payment_getway_image ul li', function(e) {
                e.preventDefault();
                e.stopPropagation();

                var gateway = $(this).data('gateway');
                if(!gateway) return;

                currentSelectedGateway = gateway;

                $('.payment_getway_image ul li').removeClass('border-secondary border-2 selected active').addClass('border-[#D9D9D9]');
                $(this).removeClass('border-[#D9D9D9]').addClass('border-secondary border-2 selected active');

                $('#order_from_user_wallet').val(gateway);

                $('.wallet_selected_payment_gateway').prop('checked', false);

                if(gateway === 'manual_payment') {
                    $('.manual_payment_gateway_extra_field').removeClass('hidden');
                } else {
                    $('.manual_payment_gateway_extra_field').addClass('hidden');
                }

                if(gateway === 'kineticpay') {
                    $('.kinetic_payment_show_hide').removeClass('hidden');
                } else {
                    $('.kinetic_payment_show_hide').addClass('hidden');
                }
            });

            $(document).on('change', '.wallet_selected_payment_gateway', function() {
                if($(this).is(':checked')) {
                    currentSelectedGateway = 'wallet';

                    $('.payment_getway_image ul li').removeClass('border-secondary border-2 selected active').addClass('border-[#D9D9D9]');

                    $('#order_from_user_wallet').val('wallet');

                    $('.manual_payment_gateway_extra_field').addClass('hidden');
                    $('.kinetic_payment_show_hide').addClass('hidden');
                } else {
                    currentSelectedGateway = '';
                    $('#order_from_user_wallet').val('');
                }
            });

            $('#order_description_btn').on('change', function() {
                if($(this).is(':checked')) {
                    $('.description_wrapper').removeClass('d-none');
                } else {
                    $('.description_wrapper').addClass('d-none');
                }
            });

            $('#pay_by_milestone').on('change', function() {
                if($(this).is(':checked')) {
                    $('.milestone_wrapper').removeClass('d-none');
                } else {
                    $('.milestone_wrapper').addClass('d-none');
                    $('#milestone-list').empty();
                }
            });

            // AJAX for District (City) selection
            $('#city_id').on('change', function() {
                var state_id = $(this).val();
                if(state_id) {
                    $.ajax({
                        url: "<?php echo e(route('au.city.all')); ?>",
                        type: "POST",
                        data: {
                            _token: "<?php echo e(csrf_token()); ?>",
                            state: state_id
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                var response = res.cities;
                                $('#state_id').html('<option value=""><?php echo e(__("İlçe Seçin")); ?></option>');
                                $.each(response, function(key, value) {
                                    $('#state_id').append('<option value="' + value.id + '">' + value.city + '</option>');
                                });
                            }
                        }
                    });
                } else {
                    $('#state_id').html('<option value=""><?php echo e(__("Önce Şehir Seçin")); ?></option>');
                }
            });

            // Appointment Time Selection Logic
            $('.time-slot-btn').on('click', function() {
                $('.time-slot-btn').removeClass('bg-[#FA8C00] text-white border-[#FA8C00] active shadow-inner').addClass('bg-white text-slate-600 border-slate-200');
                $(this).addClass('bg-[#FA8C00] text-white border-[#FA8C00] active shadow-inner').removeClass('bg-white text-slate-600 border-slate-200');
                $('#selected_appointment_time').val($(this).data('time'));
            });

            // Flatpickr Initialization with Turkish Locale
            if (typeof flatpickr !== 'undefined') {
                flatpickr("#appointment_date_picker", {
                    minDate: "today",
                    locale: "tr",
                    dateFormat: "Y-m-d",
                    altInput: true,
                    altFormat: "j F Y, l",
                    disableMobile: "true"
                });
            } else {
                // If flatpickr is not loaded, load it dynamically
                const link = document.createElement('link');
                link.rel = 'stylesheet';
                link.href = 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css';
                document.head.appendChild(link);

                const script = document.createElement('script');
                script.src = 'https://cdn.jsdelivr.net/npm/flatpickr';
                script.onload = function() {
                    const trScript = document.createElement('script');
                    trScript.src = 'https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/tr.js';
                    trScript.onload = function() {
                        flatpickr("#appointment_date_picker", {
                            minDate: "today",
                            locale: "tr",
                            dateFormat: "Y-m-d",
                            altInput: true,
                            altFormat: "j F Y, l",
                            disableMobile: "true"
                        });
                    };
                    document.head.appendChild(trScript);
                };
                document.head.appendChild(script);
            }

            $('#prevent_multiple_order_submit').on('submit', function(e) {
                e.preventDefault();

                var selectedGateway = $('#order_from_user_wallet').val();

                if(!selectedGateway) {
                    if($('.wallet_selected_payment_gateway').is(':checked')) {
                        selectedGateway = 'wallet';
                    } else if(currentSelectedGateway) {
                        selectedGateway = currentSelectedGateway;
                    }
                }

                $('#order_from_user_wallet').val(selectedGateway);

                if(!selectedGateway || selectedGateway === '') {
                    alert('Lütfen bir ödeme yöntemi seçin');
                    return false;
                }

                if(selectedGateway === 'manual_payment') {
                    var manualImage = $('input[name="manual_payment_image"]').val();
                    if(!manualImage) {
                        alert('Lütfen manuel ödeme için ödeme kanıtı yükleyin');
                        return false;
                    }
                }

                if(selectedGateway === 'kineticpay') {
                    var selectedBank = $('#kineticpay_bank').val();
                    if(!selectedBank) {
                        alert('Lütfen bir banka seçin');
                        return false;
                    }
                }

                if($('#pay_by_milestone').is(':checked')) {
                    var milestoneCount = $('#milestone-list .group').length;
                    if(milestoneCount === 0) {
                        alert('Lütfen en az bir aşama ekleyin');
                        return false;
                    }
                }

                $('#order_create_load_spinner').html('<i class="fas fa-spinner fa-spin ml-2"></i>');
                $('#order_now_only_for_load_spinner').prop('disabled', true);

                this.submit();
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.new_design.layout.new_master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/pages/order/gateway-markup.blade.php ENDPATH**/ ?>