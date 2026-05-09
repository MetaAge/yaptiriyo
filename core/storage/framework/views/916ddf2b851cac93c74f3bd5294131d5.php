<?php $__env->startSection('site_title', __('Subscriptions')); ?>
<?php $__env->startSection('meta_title'); ?><?php echo e(__('Subscriptions')); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <style>
        .modal {
            z-index: 100001;
        }

        .modal-backdrop {
            z-index: 10000;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <main>

       
            <!-- Breadcrumb -->
            <?php if (isset($component)) { $__componentOriginal5f19dd716048daf403d00235f9f2d409 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5f19dd716048daf403d00235f9f2d409 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.breadcrumb.user-profile-breadcrumb-02','data' => ['innerTitle' => __('Subscription')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('breadcrumb.user-profile-breadcrumb-02'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['innerTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Subscription'))]); ?>
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

        <!-- Subscription Plan -->
        <section id="subscription" class="bg-[#F8F9FD]">
            <div class="container mx-auto max-w-7xl px-6 py-10 md:py-16 lg:py-[120px] ">

                <!-- Section Heading with buttons -->
                <div class="text-center mb-16">
                    <h4 class="text-4xl text-base-300 font-medium text-center mb-6 animate-on-scroll">
                        <?php echo e(__('Subscription Plan')); ?>

                    </h4>

                    <div id="subscription_type_buttons">
                        <button data-type_id="all" class="get_subscription_type_id px-4 py-1 bg-secondary rounded-xl text-base-100 active"><?php echo e(__('All')); ?></button>
                        <?php $__currentLoopData = $subscription_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button data-type_id="<?php echo e($type->id); ?>" class="get_subscription_type_id px-4 py-1 bg-base-100 rounded-xl hover:bg-secondary hover:text-white transition-all duration-300"><?php echo e($type->type); ?></button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <!-- Section contents including subscription plan cards -->
                <div id="pricingCards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 search_subscription_result">
                    <?php echo $__env->make('subscription::frontend.subscriptions.search-result', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
    <?php echo $__env->make('subscription::frontend.subscriptions.subscriptions-js', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.new_design.layout.new_master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/Modules/Subscription/Resources/views/frontend/subscriptions/subscriptions.blade.php ENDPATH**/ ?>