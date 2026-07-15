<?php $__env->startSection('site_title'); ?>
    <?php echo e(__('Order Details')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <?php if (isset($component)) { $__componentOriginalc9b7b8cd21a48778d8b7d695ecb54651 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc9b7b8cd21a48778d8b7d695ecb54651 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.summernote.summernote-css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('summernote.summernote-css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc9b7b8cd21a48778d8b7d695ecb54651)): ?>
<?php $attributes = $__attributesOriginalc9b7b8cd21a48778d8b7d695ecb54651; ?>
<?php unset($__attributesOriginalc9b7b8cd21a48778d8b7d695ecb54651); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc9b7b8cd21a48778d8b7d695ecb54651)): ?>
<?php $component = $__componentOriginalc9b7b8cd21a48778d8b7d695ecb54651; ?>
<?php unset($__componentOriginalc9b7b8cd21a48778d8b7d695ecb54651); ?>
<?php endif; ?>
    <style>
        .user-details-manage-list {
            display: flex;
            flex-direction: column;
            gap: 10px
        }

        .myOrder-single-content-para,
        .show_order_submit_description
        {
            white-space: pre-line
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <main>
        <?php if(moduleExists('CoinPaymentGateway')): ?><?php else: ?><?php if (isset($component)) { $__componentOriginal7ecac999957263c09523da7583aa96ad = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7ecac999957263c09523da7583aa96ad = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.category.category','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.category.category'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7ecac999957263c09523da7583aa96ad)): ?>
<?php $attributes = $__attributesOriginal7ecac999957263c09523da7583aa96ad; ?>
<?php unset($__attributesOriginal7ecac999957263c09523da7583aa96ad); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7ecac999957263c09523da7583aa96ad)): ?>
<?php $component = $__componentOriginal7ecac999957263c09523da7583aa96ad; ?>
<?php unset($__componentOriginal7ecac999957263c09523da7583aa96ad); ?>
<?php endif; ?><?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal1886b76dac2bd4a55dfc12d1a06ee6e4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1886b76dac2bd4a55dfc12d1a06ee6e4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.breadcrumb.user-profile-breadcrumb','data' => ['title' => __('Order Details'),'innerTitle' => __('Order Details')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('breadcrumb.user-profile-breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Order Details')),'innerTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Order Details'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1886b76dac2bd4a55dfc12d1a06ee6e4)): ?>
<?php $attributes = $__attributesOriginal1886b76dac2bd4a55dfc12d1a06ee6e4; ?>
<?php unset($__attributesOriginal1886b76dac2bd4a55dfc12d1a06ee6e4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1886b76dac2bd4a55dfc12d1a06ee6e4)): ?>
<?php $component = $__componentOriginal1886b76dac2bd4a55dfc12d1a06ee6e4; ?>
<?php unset($__componentOriginal1886b76dac2bd4a55dfc12d1a06ee6e4); ?>
<?php endif; ?>

        <!-- Profile Details area Starts -->
        <div class="profile-area pat-100 pab-100 section-bg-2">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="myOrder-single bg-white padding-20 radius-10">
                            <div class="myOrder-single-item">
                                <div class="myOrder-single-flex">
                                    <div class="myOrder-single-content">
                                        <span class="myOrder-single-content-id">#000<?php echo e($order_details->id); ?></span>
                                        <h4 class="myOrder-single-content-title mt-2">
                                            <?php if($order_details->is_project_job == 'project'): ?>
                                                <a href="javascript:void(0)"> <?php echo e($order_details?->project->title ?? ''); ?> </a>
                                            <?php elseif($order_details->is_project_job == 'job'): ?>
                                                <a href="javascript:void(0)"><?php echo e($order_details?->job->title ?? ''); ?></a>
                                            <?php else: ?>
                                                <?php echo e(__('Custom order')); ?>

                                            <?php endif; ?>
                                        </h4>
                                        <div class="myOrder-single-content-btn flex-btn mt-3">
                                            <?php if (isset($component)) { $__componentOriginald2cd1824644302ab8fd16ca2027f25d9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald2cd1824644302ab8fd16ca2027f25d9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.order.order-status','data' => ['status' => $order_details->status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('order.order-status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($order_details->status)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald2cd1824644302ab8fd16ca2027f25d9)): ?>
<?php $attributes = $__attributesOriginald2cd1824644302ab8fd16ca2027f25d9; ?>
<?php unset($__attributesOriginald2cd1824644302ab8fd16ca2027f25d9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald2cd1824644302ab8fd16ca2027f25d9)): ?>
<?php $component = $__componentOriginald2cd1824644302ab8fd16ca2027f25d9; ?>
<?php unset($__componentOriginald2cd1824644302ab8fd16ca2027f25d9); ?>
<?php endif; ?>
                                            <?php if (isset($component)) { $__componentOriginal5c7d7c9d888fc7c2cdebae9414fcf5ae = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c7d7c9d888fc7c2cdebae9414fcf5ae = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.order.is-custom','data' => ['isCustom' => $order_details->is_project_job]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('order.is-custom'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['isCustom' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($order_details->is_project_job)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5c7d7c9d888fc7c2cdebae9414fcf5ae)): ?>
<?php $attributes = $__attributesOriginal5c7d7c9d888fc7c2cdebae9414fcf5ae; ?>
<?php unset($__attributesOriginal5c7d7c9d888fc7c2cdebae9414fcf5ae); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5c7d7c9d888fc7c2cdebae9414fcf5ae)): ?>
<?php $component = $__componentOriginal5c7d7c9d888fc7c2cdebae9414fcf5ae; ?>
<?php unset($__componentOriginal5c7d7c9d888fc7c2cdebae9414fcf5ae); ?>
<?php endif; ?>
                                            <?php if (isset($component)) { $__componentOriginal398d03e4589fec85d4b03fdb1bf70726 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal398d03e4589fec85d4b03fdb1bf70726 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.order.payment-verify','data' => ['paymentVerifyCheck' => $order_details]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('order.payment-verify'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['paymentVerifyCheck' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($order_details)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal398d03e4589fec85d4b03fdb1bf70726)): ?>
<?php $attributes = $__attributesOriginal398d03e4589fec85d4b03fdb1bf70726; ?>
<?php unset($__attributesOriginal398d03e4589fec85d4b03fdb1bf70726); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal398d03e4589fec85d4b03fdb1bf70726)): ?>
<?php $component = $__componentOriginal398d03e4589fec85d4b03fdb1bf70726; ?>
<?php unset($__componentOriginal398d03e4589fec85d4b03fdb1bf70726); ?>
<?php endif; ?>
                                        </div>
                                    </div>
                                    <span
                                        class="myOrder-single-content-time"><?php echo e($order_details->created_at->diffForHumans()); ?>

                                    </span>
                                </div>
                            </div>

                            <div class="myOrder-single-item">
                                <div class="myOrder-single-block">
                                    <div class="myOrder-single-block-item">
                                        <div class="myOrder-single-block-item-content">
                                            <?php if($order_details->is_fixed_hourly == 'hourly'): ?>
                                                <span class="myOrder-single-block-subtitle"><?php echo e(__('Hourly Rate')); ?></span>
                                                <h6 class="myOrder-single-block-title mt-2">
                                                    <?php echo e(float_amount_with_currency_symbol($order_details?->job->hourly_rate)); ?>

                                                </h6>
                                            <?php else: ?>
                                                <span class="myOrder-single-block-subtitle"><?php echo e(__('Order budget')); ?></span>
                                                <h6 class="myOrder-single-block-title mt-2">
                                                    <?php echo e(float_amount_with_currency_symbol($order_details->price)); ?>

                                                    <?php if (isset($component)) { $__componentOriginalb63c7ad67c6931e2e669d0f22cbb9d30 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb63c7ad67c6931e2e669d0f22cbb9d30 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.order.is-funded','data' => ['isFunded' => $order_details->payment_status,'paymentGateway' => $order_details->payment_gateway]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('order.is-funded'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['isFunded' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($order_details->payment_status),'paymentGateway' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($order_details->payment_gateway)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb63c7ad67c6931e2e669d0f22cbb9d30)): ?>
<?php $attributes = $__attributesOriginalb63c7ad67c6931e2e669d0f22cbb9d30; ?>
<?php unset($__attributesOriginalb63c7ad67c6931e2e669d0f22cbb9d30); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb63c7ad67c6931e2e669d0f22cbb9d30)): ?>
<?php $component = $__componentOriginalb63c7ad67c6931e2e669d0f22cbb9d30; ?>
<?php unset($__componentOriginalb63c7ad67c6931e2e669d0f22cbb9d30); ?>
<?php endif; ?>
                                                </h6>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php if($order_details->delivery_time): ?>
                                        <div class="myOrder-single-block-item">
                                            <div class="myOrder-single-block-item-content">
                                                <span class="myOrder-single-block-subtitle"><?php echo e(__('Delivery Time')); ?></span>
                                                <?php if (isset($component)) { $__componentOriginal5f3cdccd6938f5c78a7c65a1dbfd3779 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5f3cdccd6938f5c78a7c65a1dbfd3779 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.order.deadline','data' => ['deadline' => $order_details->delivery_time ?? '']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('order.deadline'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['deadline' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($order_details->delivery_time ?? '')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5f3cdccd6938f5c78a7c65a1dbfd3779)): ?>
<?php $attributes = $__attributesOriginal5f3cdccd6938f5c78a7c65a1dbfd3779; ?>
<?php unset($__attributesOriginal5f3cdccd6938f5c78a7c65a1dbfd3779); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5f3cdccd6938f5c78a7c65a1dbfd3779)): ?>
<?php $component = $__componentOriginal5f3cdccd6938f5c78a7c65a1dbfd3779; ?>
<?php unset($__componentOriginal5f3cdccd6938f5c78a7c65a1dbfd3779); ?>
<?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php
                                        $complete_orders = \App\Models\Order::where('freelancer_id',$order_details->freelancer_id)
                                            ->where('status',3)
                                            ->count();
                                    $active_orders = \App\Models\Order::where('freelancer_id',$order_details->freelancer_id)
                                            ->where('status',1)
                                            ->count();
                                    ?>
                                    <div class="myOrder-single-block-item">
                                        <div class="myOrder-single-block-item-content">
                                            <span class="myOrder-single-block-subtitle"><?php echo e(__('Complete Orders')); ?></span>
                                            <h6 class="myOrder-single-block-title mt-2"><?php echo e($complete_orders); ?></h6>
                                        </div>
                                    </div>
                                    <div class="myOrder-single-block-item">
                                        <div class="myOrder-single-block-item-content">
                                            <span class="myOrder-single-block-subtitle"><?php echo e(__('Active Orders')); ?></span>
                                            <h6 class="myOrder-single-block-title mt-2"><?php echo e($active_orders); ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="myOrder-single-item">
                                <div class="myOrder-single-flex flex-between">
                                    <?php
                                        $mile_stones = \App\Models\OrderMilestone::where('order_id', $order_details->id)->get();
                                        $payable_amount = \App\Models\OrderMilestone::where('order_id', $order_details->id)
                                            ->where('status', '!=', 3)
                                            ->sum('price');
                                        
                                            $clientRating = \App\Models\Rating::where('order_id', $order_details->id)
                                                ->where('sender_type', 1)
                                                ->where('sender_id', auth()->id())
                                                ->first();
                                    ?>
                                    <div class="btn-wrapper flex-btn">
                                        <?php if($mile_stones->isEmpty()): ?>
                                            <span class="myJob-wrapper-single-fixed danger"><?php echo e(__('Revision:')); ?>

                                                <?php echo e($order_details->revision); ?></span>
                                            <span class="myJob-wrapper-single-fixed danger"><?php echo e(__('Revision Left:')); ?>

                                                <?php echo e($order_details->revision_left); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="btn-wrapper flex-btn">
                                        <?php if($order_details?->user?->is_suspend != 1): ?>
                                            <form action="<?php echo e(route('client.message.send')); ?>" method="post"
                                                enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="freelancer_id" id="freelancer_id"
                                                    value="<?php echo e($order_details->freelancer_id); ?>">
                                                <input type="hidden" name="from_user" id="from_user" value="1">
                                                <input type="hidden" name="project_id" id="project_id"
                                                    value="<?php echo e($order_details->identity); ?>">
                                                <input type="hidden" name="order_id" id="order_id"
                                                       value="<?php echo e($order_details->id); ?>">
                                                <button type="submit" class="btn-profile btn-outline-1">
                                                    <?php echo e(__('Send Message')); ?></button>
                                            </form>
                                            <?php if($order_details->status == 3): ?>
                                                <a href="<?php echo e(route('client.order.invoice.generate',$order_details->id)); ?>" class="btn-profile btn-outline-1"><?php echo e(__('Invoice')); ?></a>
                                                <?php if(!$clientRating): ?>
                                                    <a href="<?php echo e(route('client.order.rating', $order_details->id)); ?>"
                                                        class="btn-profile btn-bg-1"><?php echo e(__('Submit Review')); ?></a>
                                                <?php endif; ?>
                                                
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if($order_details->is_fixed_hourly == 'hourly' && $order_details->status != 0): ?>
                                            <a href="<?php echo e(route('client.order.work.history',$order_details->id)); ?>" class="btn-profile btn-bg-1"><?php echo e(__('Work History')); ?></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="myOrder-single bg-white padding-20 radius-10">
                            <div class="row g-4">
                                <?php if(get_static_option('commission_disable_client_panel') != 'disable'): ?>

                                    <div class="col-xxl-3 col-lg-6 col-sm-6 col-md-4">
                                        <div class="myJob-wrapper-single-balance">
                                            <div class="myJob-wrapper-single-balance-contents">
                                                <div
                                                    class="myJob-wrapper-single-balance-price d-flex gap-2 justify-content-between">
                                                    <?php if($order_details->status === 3): ?>
                                                        <h4 class="contract_single__balance-price">
                                                            <?php echo e(float_amount_with_currency_symbol($order_details->payable_amount)); ?>

                                                        </h4>
                                                    <?php else: ?>
                                                        <?php
                                                            $earnings = \App\Models\OrderMilestone::where('order_id', $order_details->id)
                                                                ->where('status', 2)
                                                                ->sum('price');
                                                        ?>
                                                        <h4 class="contract_single__balance-price">
                                                            <?php echo e(float_amount_with_currency_symbol($earnings)); ?></h4>
                                                    <?php endif; ?>
                                                    <span class="myJob-wrapper-single-balance-icon hover-question">
                                                        <i class="fa-solid fa-question"></i>
                                                        <span
                                                            class="hover-active-content"><?php echo e(__('Earned balance means how much amount freelancer have received for this order.')); ?></span>
                                                    </span>
                                                </div>
                                                <p class="myJob-wrapper-single-balance-para"><?php echo e(__('Earned Balance')); ?></p>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if($order_details->is_fixed_hourly == 'hourly' && $order_details->status != 3): ?>
                                        <div class="col-xxl-3 col-lg-6 col-sm-6 col-md-4">
                                                <div class="myJob-wrapper-single-balance">
                                                    <div class="myJob-wrapper-single-balance-contents">
                                                        <div class="myJob-wrapper-single-balance-price d-flex gap-2 justify-content-between">
                                                            <h4 class="contract_single__balance-price"><?php echo e(float_amount_with_currency_symbol($order_details?->job->hourly_rate)); ?> </h4>
                                                            <span class="myJob-wrapper-single-balance-icon hover-question">
                                                            <i class="fa-solid fa-question"></i>
                                                            <span class="hover-active-content"><?php echo e(__('Hourly rate means how much amount client will pay for each hour after complete the order.')); ?></span>
                                                        </span>
                                                        </div>
                                                        <p class="myJob-wrapper-single-balance-para"><?php echo e(__('Hourly Rate')); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php else: ?>
                                        <div class="col-xxl-3 col-lg-6 col-sm-6 col-md-4">
                                        <div class="myJob-wrapper-single-balance">
                                            <div class="myJob-wrapper-single-balance-contents">
                                                <div
                                                    class="myJob-wrapper-single-balance-price d-flex gap-2 justify-content-between">
                                                    <?php
                                                        $mile_stones = \App\Models\OrderMilestone::where('order_id', $order_details->id)->get();
                                                        $payable_amount = \App\Models\OrderMilestone::where('order_id', $order_details->id)
                                                            ->where('status', '!=', 3)
                                                            ->sum('price');
                                                    ?>
                                                    <?php if($mile_stones->count() > 0): ?>
                                                        <?php if($order_details->status != 3): ?>
                                                            <h4 class="contract_single__balance-price">
                                                                <?php echo e(float_amount_with_currency_symbol($payable_amount - $earnings)); ?>

                                                            </h4>
                                                        <?php else: ?>
                                                            <h4 class="contract_single__balance-price">
                                                                <?php echo e(site_currency_symbol()); ?> 0</h4>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <?php if($order_details->status != 3 && $order_details->status != 4 && $order_details->payment_status != ''): ?>
                                                            <h4 class="contract_single__balance-price">
                                                                <?php echo e(float_amount_with_currency_symbol($order_details->payable_amount)); ?>

                                                            </h4>
                                                        <?php else: ?>
                                                            <h4 class="contract_single__balance-price">
                                                                <?php echo e(site_currency_symbol()); ?> 0</h4>
                                                        <?php endif; ?>
                                                    <?php endif; ?>

                                                    <span class="myJob-wrapper-single-balance-icon hover-question">
                                                        <i class="fa-solid fa-question"></i>
                                                        <span
                                                            class="hover-active-content"><?php echo e(__('Pending amount means how much amount Freelancer will get after complete this order.')); ?></span>
                                                    </span>
                                                </div>
                                                <p class="myJob-wrapper-single-balance-para"><?php echo e(__('Pending Balance')); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <?php if($order_details->is_fixed_hourly == 'hourly' && $order_details->status != 3): ?>
                                        <div class="col-xxl-3 col-lg-6 col-sm-6 col-md-4">
                                            <div class="myJob-wrapper-single-balance">
                                                <div class="myJob-wrapper-single-balance-contents">
                                                    <div class="myJob-wrapper-single-balance-price d-flex gap-2 justify-content-between">
                                                        <span class="price-title"><?php echo e($order_details?->job->estimated_hours); ?></span>
                                                        <span class="myJob-wrapper-single-balance-icon hover-question">
                                                    <i class="fa-solid fa-question"></i>
                                                    <span class="hover-active-content"><?php echo e(__('Estimated hours refer to the approximate time a client can set for completing the order. The client can adjust this time before accepting the order.')); ?></span>
                                                </span>
                                                    </div>
                                                    <p class="myJob-wrapper-single-balance-para"><?php echo e(__('Estimated Hours')); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="col-xxl-3 col-lg-6 col-sm-6 col-md-4">
                                    <div class="myJob-wrapper-single-balance">
                                        <div class="myJob-wrapper-single-balance-contents">
                                            <div
                                                class="myJob-wrapper-single-balance-price d-flex gap-2 justify-content-between">
                                                <span
                                                    class="price-title"><?php echo e(float_amount_with_currency_symbol($order_details->commission_amount)); ?></span>
                                                <span class="myJob-wrapper-single-balance-icon hover-question">
                                                    <i class="fa-solid fa-question"></i>
                                                    <span
                                                        class="hover-active-content"><?php echo e(__('Commission amount means how much amount admin will get from this order.')); ?></span>
                                                </span>
                                            </div>
                                            <p class="myJob-wrapper-single-balance-para"><?php echo e(__('Commission Amount')); ?></p>
                                        </div>
                                    </div>
                                </div>
                                    <?php endif; ?>

                                <?php endif; ?>

                                <?php if($order_details->is_fixed_hourly == 'hourly' && $order_details->status != 3): ?>
                                    <div class="col-xxl-3 col-lg-6 col-sm-6 col-md-4">
                                        <div class="myJob-wrapper-single-balance">
                                            <div class="myJob-wrapper-single-balance-contents">
                                                <div class="myJob-wrapper-single-balance-price d-flex gap-2 justify-content-between">
                                                    <span class="price-title"><?php echo e(float_amount_with_currency_symbol($order_details->price)); ?></span>
                                                    <span class="myJob-wrapper-single-balance-icon hover-question">
                                                <i class="fa-solid fa-question"></i>
                                                <span class="hover-active-content"><?php echo e(__('The approximate budget indicates the expected payment for this order. This amount may vary depending on the rate and the estimated working hours.')); ?></span>
                                            </span>
                                                </div>
                                                <p class="myJob-wrapper-single-balance-para"><?php echo e(__('Approximate  Budget')); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="col-xxl-3 col-lg-6 col-sm-6 col-md-4">
                                    <div class="myJob-wrapper-single-balance">
                                        <div class="myJob-wrapper-single-balance-contents">
                                            <div
                                                class="myJob-wrapper-single-balance-price d-flex gap-2 justify-content-between">
                                                <span
                                                    class="price-title"><?php echo e(float_amount_with_currency_symbol($order_details->price)); ?></span>
                                                <span class="myJob-wrapper-single-balance-icon hover-question">
                                                    <i class="fa-solid fa-question"></i>
                                                    <span
                                                        class="hover-active-content"><?php echo e(__('Total budget means how much you will pay for this order.')); ?></span>
                                                </span>
                                            </div>
                                            <p class="myJob-wrapper-single-balance-para"><?php echo e(__('Total Budget')); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="myJob-tabs mt-5">
                            <ul class="tabs">
                                <?php if($mile_stones->count() > 0): ?>
                                    <li data-tab="Milestones" class="active"><?php echo e(__('Milestones')); ?></li>
                                    <li data-tab="Description"> <?php echo e(__('Description & Requirements')); ?> </li>
                                <?php else: ?>
                                    <li data-tab="Description" class="active"> <?php echo e(__('Description & Requirements')); ?>

                                    </li>
                                <?php endif; ?>
                                <li data-tab="Works"> <?php echo e(__('Works Submitted')); ?> </li>
                            </ul>

                            <?php if($mile_stones->count() > 0): ?>
                                <div class="tab-content-item active mt-4" id="Milestones">
                                    <div class="myJob-wrapper-single">
                                        <div class="myJob-wrapper-single-header profile-border-bottom">
                                            <h4 class="myJob-wrapper-single-title"><?php echo e(__('Milestone')); ?></h4>
                                        </div>
                                        <div class="myJob-wrapper-single-milestone milestone-contractor-parent">
                                            <?php $__currentLoopData = $mile_stones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mile_stone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="myJob-wrapper-single-milestone-item">
                                                    <div class="myJob-wrapper-single-flex flex-between align-items-start">
                                                        <?php if (isset($component)) { $__componentOriginal4adb1861b1b1739a1551a74b6c27d2d0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4adb1861b1b1739a1551a74b6c27d2d0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.order.milestone-details','data' => ['id' => $mile_stone->id,'orderID' => $order_details->id,'clientID' => $order_details->user_id,'title' => $mile_stone->title,'price' => $mile_stone->price,'status' => $mile_stone->status,'deadline' => $mile_stone->deadline,'description' => $mile_stone->description]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('order.milestone-details'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($mile_stone->id),'orderID' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($order_details->id),'clientID' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($order_details->user_id),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($mile_stone->title),'price' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($mile_stone->price),'status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($mile_stone->status),'deadline' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($mile_stone->deadline),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($mile_stone->description)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4adb1861b1b1739a1551a74b6c27d2d0)): ?>
<?php $attributes = $__attributesOriginal4adb1861b1b1739a1551a74b6c27d2d0; ?>
<?php unset($__attributesOriginal4adb1861b1b1739a1551a74b6c27d2d0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4adb1861b1b1739a1551a74b6c27d2d0)): ?>
<?php $component = $__componentOriginal4adb1861b1b1739a1551a74b6c27d2d0; ?>
<?php unset($__componentOriginal4adb1861b1b1739a1551a74b6c27d2d0); ?>
<?php endif; ?>
                                                        <div class="myJob-wrapper-single-right">
                                                            <div class="myJob-wrapper-single-right-flex">
                                                                <?php if (isset($component)) { $__componentOriginalb63c7ad67c6931e2e669d0f22cbb9d30 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb63c7ad67c6931e2e669d0f22cbb9d30 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.order.is-funded','data' => ['isFunded' => $order_details->payment_status,'paymentGateway' => $order_details->payment_gateway]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('order.is-funded'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['isFunded' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($order_details->payment_status),'paymentGateway' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($order_details->payment_gateway)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb63c7ad67c6931e2e669d0f22cbb9d30)): ?>
<?php $attributes = $__attributesOriginalb63c7ad67c6931e2e669d0f22cbb9d30; ?>
<?php unset($__attributesOriginalb63c7ad67c6931e2e669d0f22cbb9d30); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb63c7ad67c6931e2e669d0f22cbb9d30)): ?>
<?php $component = $__componentOriginalb63c7ad67c6931e2e669d0f22cbb9d30; ?>
<?php unset($__componentOriginalb63c7ad67c6931e2e669d0f22cbb9d30); ?>
<?php endif; ?>
                                                                <span
                                                                    class="myJob-wrapper-single-fixed danger"><?php echo e(__('Revision:')); ?>

                                                                    <?php echo e($mile_stone->revision ?? ''); ?></span>
                                                                <span
                                                                    class="myJob-wrapper-single-fixed danger"><?php echo e(__('Revision Left:')); ?>

                                                                    <?php echo e($mile_stone->revision_left ?? ''); ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if($mile_stones->count() > 0): ?>
                                <div class="tab-content-item mt-4" id="Description">
                                <?php else: ?>
                                    <div class="tab-content-item mt-4 active" id="Description">
                            <?php endif; ?>
                            <div class="myOrder-single bg-white padding-20 radius-10">
                                <div class="myOrder-single-item">
                                    <div class="myOrder-single-content">
                                        <p class="myOrder-single-content-para"><?php echo e($order_details->description ?? __('No description.')); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content-item mt-4" id="Works">
                            <div class="pay-now-single">
                                <h4 class="pay-now-single-title"><?php echo e(__('Work Submitted')); ?></h4>
                                <div class="pay-now-single-contents profile-border-top">
                                    <?php if($order_details?->order_submit_history?->count() > 0): ?>
                                        <?php $__currentLoopData = $order_details->order_submit_history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="pay-now-single-contents-work">
                                                <div class="pay-now-single-contents-work-flex">
                                                    <div class="pay-now-single-contents-work-item">
                                                        <span
                                                            class="pay-now-single-contents-work-date"><?php echo e($history->created_at->toFormattedDateString()); ?></span>
                                                    </div>
                                                    <div class="pay-now-single-contents-work-item">
                                                        <div class="single-refundRequest-item">
                                                            <?php if($history->attachment): ?>
                                                                <a href="<?php echo e(asset('assets/uploads/attachment/order/' . $history->attachment)); ?>"
                                                                    download class="single-refundRequest-item-uploads">
                                                                    <i class="fa-solid fa-cloud-arrow-down"></i>
                                                                    <?php echo e(__('Download Attachment')); ?>

                                                                </a>
                                                            <?php else: ?>
                                                                <span class="single-refundRequest-item-uploads text-muted">
                                                                    <i class="fa-solid fa-check-circle"></i>
                                                                    <?php echo e(__('Service Completed')); ?>

                                                                </span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="pay-now-single-contents-work-item">
                                                        <div class="pay-now-single-contents-work-item-status">
                                                            <?php if($history->status === 0): ?>
                                                                <span
                                                                    class="milestone-approved "><?php echo e(__('Pending')); ?></span>
                                                                <?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 1): ?>
                                                                    <a href="javascript:void(0)"
                                                                        class="btn-profile btn-bg-cancel btn-small request_revision_submit"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#RevisionRequestModal"
                                                                        data-order_submit_history_id="<?php echo e($history->id); ?>"
                                                                        data-order_id="<?php echo e($history->order_id); ?>"
                                                                        data-order_milestone_id="<?php echo e($history->order_milestone_id); ?>">
                                                                        <?php echo e(__('Request Revision')); ?>

                                                                    </a>
                                                                    <?php
                                                                        $urlType = empty($history->order_milestone_id) ? 'order' : 'milestone';
                                                                    ?>
                                                                    <?php if (isset($component)) { $__componentOriginaled49183813b6264fe02b2283042511dd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled49183813b6264fe02b2283042511dd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status.table.status-change','data' => ['title' => __('Accept Order'),'class' => 'btn-profile btn-bg-1 btn-small accept_and_pay','url' => route(
                                                                            'client.order.milestone.approve',
                                                                            [
                                                                                $history->order_milestone_id ??
                                                                                $history->order_id,
                                                                                $urlType,
                                                                            ],
                                                                        )]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status.table.status-change'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Accept Order')),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('btn-profile btn-bg-1 btn-small accept_and_pay'),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route(
                                                                            'client.order.milestone.approve',
                                                                            [
                                                                                $history->order_milestone_id ??
                                                                                $history->order_id,
                                                                                $urlType,
                                                                            ],
                                                                        ))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled49183813b6264fe02b2283042511dd)): ?>
<?php $attributes = $__attributesOriginaled49183813b6264fe02b2283042511dd; ?>
<?php unset($__attributesOriginaled49183813b6264fe02b2283042511dd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled49183813b6264fe02b2283042511dd)): ?>
<?php $component = $__componentOriginaled49183813b6264fe02b2283042511dd; ?>
<?php unset($__componentOriginaled49183813b6264fe02b2283042511dd); ?>
<?php endif; ?>
                                                                <?php endif; ?>
                                                                <?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 2 && Session::get('user_role') == 'client'): ?>
                                                                    <a href="javascript:void(0)"
                                                                       class="btn-profile btn-bg-cancel btn-small request_revision_submit"
                                                                       data-bs-toggle="modal"
                                                                       data-bs-target="#RevisionRequestModal"
                                                                       data-order_submit_history_id="<?php echo e($history->id); ?>"
                                                                       data-order_id="<?php echo e($history->order_id); ?>"
                                                                       data-order_milestone_id="<?php echo e($history->order_milestone_id); ?>">
                                                                        <?php echo e(__('Request Revision')); ?>

                                                                    </a>
                                                                    <?php
                                                                        $urlType = empty($history->order_milestone_id) ? 'order' : 'milestone';
                                                                    ?>
                                                                    <?php if (isset($component)) { $__componentOriginaled49183813b6264fe02b2283042511dd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled49183813b6264fe02b2283042511dd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status.table.status-change','data' => ['title' => __('Accept Order'),'class' => 'btn-profile btn-bg-1 btn-small accept_and_pay','url' => route(
                                                                            'client.order.milestone.approve',
                                                                            [
                                                                                $history->order_milestone_id ??
                                                                                $history->order_id,
                                                                                $urlType,
                                                                            ],
                                                                        )]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status.table.status-change'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Accept Order')),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('btn-profile btn-bg-1 btn-small accept_and_pay'),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route(
                                                                            'client.order.milestone.approve',
                                                                            [
                                                                                $history->order_milestone_id ??
                                                                                $history->order_id,
                                                                                $urlType,
                                                                            ],
                                                                        ))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled49183813b6264fe02b2283042511dd)): ?>
<?php $attributes = $__attributesOriginaled49183813b6264fe02b2283042511dd; ?>
<?php unset($__attributesOriginaled49183813b6264fe02b2283042511dd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled49183813b6264fe02b2283042511dd)): ?>
<?php $component = $__componentOriginaled49183813b6264fe02b2283042511dd; ?>
<?php unset($__componentOriginaled49183813b6264fe02b2283042511dd); ?>
<?php endif; ?>
                                                                <?php endif; ?>
                                                            <?php elseif($history->status === 1): ?>
                                                                <span
                                                                    class="myJob-wrapper-single-fixed active"><?php echo e(__('Approved')); ?></span>
                                                            <?php elseif($history->status === 2): ?>
                                                                <span
                                                                    class="btn myJob-wrapper-single-fixed danger show_revision_details"
                                                                    data-bs-target="#RevisionDetailsModal"
                                                                    data-bs-toggle="modal"
                                                                    data-revision_id="<?php echo e($history->request_revision?->id); ?>"
                                                                    data-revision_description="<?php echo e($history->request_revision?->description); ?>">
                                                                    <?php echo e(__('Revision Details')); ?>

                                                                </span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="pay-now-single-contents-work-item">
                                                        <div class="pay-now-single-contents-work-item-btn">
                                                            <a href="javascript:void(0)"
                                                                class="pay-now-single-contents-work-viewMore order_submit_description"
                                                                data-description="<?php echo e($history->description); ?>"
                                                                data-order_milestone_id="<?php echo e($history->order_milestone_id); ?>"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#OrderSubmitDescriptionModal">
                                                                <?php echo e(__('Description')); ?>

                                                                <i class="fa-solid fa-angle-right"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <p><?php echo e(__('No work submitted')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <?php
                            $check_order_has_report_by_client = \App\Models\Report::where('client_id',$order_details->user_id)
                            ->where('order_id',$order_details->id)
                            ->where('reporter','client')
                            ->first();
                        ?>

                        <?php if(empty($check_order_has_report_by_client)): ?>
                        <div class="myOrder-single-item mt-4">
                            <div class="myOrder-single-flex flex-between">
                                <?php if($order_details?->user?->is_suspend != 1): ?>
                                    <?php if($order_details->status == 3 || $order_details->status == 4): ?>
                                        <a href="javascript:void(0)" data-order-id="<?php echo e($order_details->id); ?>"
                                            data-freelancer-id="<?php echo e($order_details->freelancer_id); ?>"
                                            class="btn-profile btn-bg-cancel btn-hover-danger open_order_report_modal"
                                            data-bs-target="#reportModal" data-bs-toggle="modal"><?php echo e(__('Report Order')); ?>

                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php else: ?>
                            <div class="myOrder-single-item mt-4">
                                <div class="myOrder-single-flex flex-between">
                                   <span class="btn-profile btn-bg-cancel"> <?php echo e(__('Reported')); ?></span>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="profile-details-widget sticky_top_lg">

                        <div class="jobFilter-wrapper-item">
                            <div class="jobFilter-wrapper-item-header">
                                <div class="jobFilter-proposal-author-flex">
                                <span class="jobFilter-proposal-author-thumb">
                                    <div class="myOrder-single-block-item-author">
                                        <?php if (isset($component)) { $__componentOriginalcef7038228be606933751cd86f8a6046 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcef7038228be606933751cd86f8a6046 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.order.profile-image','data' => ['image' => $order_details?->freelancer->image]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('order.profile-image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($order_details?->freelancer->image)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcef7038228be606933751cd86f8a6046)): ?>
<?php $attributes = $__attributesOriginalcef7038228be606933751cd86f8a6046; ?>
<?php unset($__attributesOriginalcef7038228be606933751cd86f8a6046); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcef7038228be606933751cd86f8a6046)): ?>
<?php $component = $__componentOriginalcef7038228be606933751cd86f8a6046; ?>
<?php unset($__componentOriginalcef7038228be606933751cd86f8a6046); ?>
<?php endif; ?>
                                    </div>
                                </span>
                                    <div class="jobFilter-proposal-author-contents">
                                        <h4 class="single-freelancer-author-name">
                                            <a href="<?php echo e(route('freelancer.profile.details', $order_details?->freelancer->username)); ?>">
                                                <?php echo e($order_details?->freelancer->first_name); ?>

                                                <?php echo e($order_details?->freelancer->last_name); ?>

                                            </a>
                                            <?php if (isset($component)) { $__componentOriginal904e0112ca5a0dc03a39a72400a188a0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal904e0112ca5a0dc03a39a72400a188a0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status.user-active-inactive-check','data' => ['userID' => $order_details?->freelancer->id]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status.user-active-inactive-check'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['userID' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($order_details?->freelancer->id)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal904e0112ca5a0dc03a39a72400a188a0)): ?>
<?php $attributes = $__attributesOriginal904e0112ca5a0dc03a39a72400a188a0; ?>
<?php unset($__attributesOriginal904e0112ca5a0dc03a39a72400a188a0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal904e0112ca5a0dc03a39a72400a188a0)): ?>
<?php $component = $__componentOriginal904e0112ca5a0dc03a39a72400a188a0; ?>
<?php unset($__componentOriginal904e0112ca5a0dc03a39a72400a188a0); ?>
<?php endif; ?>
                                        </h4>
                                        <p class="jobFilter-proposal-author-contents-subtitle">
                                            <?php echo e($order_details?->freelancer?->user_introduction?->title); ?> ·
                                            <span>
                                                <?php if($order_details?->freelancer?->user_state?->state != null): ?>
                                                <?php echo e($order_details?->freelancer?->user_state?->state); ?>,
                                                <?php endif; ?>
                                                <?php echo e($order_details?->freelancer?->user_country?->country); ?>

                                            </span>
                                            <?php if($order_details?->freelancer?->user_verified_status == 1): ?> <i class="fas fa-circle-check"></i><?php endif; ?>
                                        </p>
                                        <div class="jobFilter-proposal-author-contents-review mt-2">
                                            <span class="jobFilter-proposal-author-contents-review-star">
                                                <i class="fas fa-star"></i>
                                                <?php echo e(number_format($order_details->freelancer->freelancer_ratings_avg_rating ?? 0, 1)); ?>

                                                (<?php echo e($order_details->freelancer->freelancer_ratings_count ?? 0); ?>)
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

                </div>
            </div>
        </div>
        <!-- Profile Details area end -->
    </main>

    <?php echo $__env->make('frontend.user.client.order.request-revision', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('frontend.user.client.order.revision-details', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('frontend.user.client.order.report-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('frontend.user.client.order.order-submit-description', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php if (isset($component)) { $__componentOriginal54c16274d3d0b2e3d7bba6b79dadebcb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal54c16274d3d0b2e3d7bba6b79dadebcb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sweet-alert.sweet-alert2-js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sweet-alert.sweet-alert2-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal54c16274d3d0b2e3d7bba6b79dadebcb)): ?>
<?php $attributes = $__attributesOriginal54c16274d3d0b2e3d7bba6b79dadebcb; ?>
<?php unset($__attributesOriginal54c16274d3d0b2e3d7bba6b79dadebcb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal54c16274d3d0b2e3d7bba6b79dadebcb)): ?>
<?php $component = $__componentOriginal54c16274d3d0b2e3d7bba6b79dadebcb; ?>
<?php unset($__componentOriginal54c16274d3d0b2e3d7bba6b79dadebcb); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalc522360e2a07084453b413c76e27c7e9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc522360e2a07084453b413c76e27c7e9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.summernote.summernote-js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('summernote.summernote-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc522360e2a07084453b413c76e27c7e9)): ?>
<?php $attributes = $__attributesOriginalc522360e2a07084453b413c76e27c7e9; ?>
<?php unset($__attributesOriginalc522360e2a07084453b413c76e27c7e9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc522360e2a07084453b413c76e27c7e9)): ?>
<?php $component = $__componentOriginalc522360e2a07084453b413c76e27c7e9; ?>
<?php unset($__componentOriginalc522360e2a07084453b413c76e27c7e9); ?>
<?php endif; ?>
    <?php echo $__env->make('frontend.user.client.order.order-js', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/client/order/order-details.blade.php ENDPATH**/ ?>