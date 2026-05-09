<?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <!-- Plan Card -->
    <div class="card-animate bg-white rounded-2xl border-2 border-gray-200 p-6 hover:border-orange-500 hover:shadow-lg hover:shadow-orange-100 transition-all duration-300 group">
        <!-- Plan Header -->
        <div class="mb-6">
            <h3 class="text-2xl font-medium text-base-300 mb-3"><?php echo e($subscription->title ?? ''); ?></h3>
            <div class="flex items-baseline mb-4">
                <span class="text-4xl font-semibold text-base-300"><?php echo e(float_amount_with_currency_symbol($subscription->price ?? '')); ?></span>
                <span class="text-gray-500 ml-2">/<?php echo e(ucfirst($subscription->subscription_type?->type ?? 'month')); ?></span>
            </div>
            <p class="text-gray-600 leading-relaxed">
                <?php echo e($subscription->limit ?? ''); ?> <?php echo e(__('Connects')); ?>

            </p>
        </div>

        <!-- CTA Button -->
        <a href="<?php echo e(route('subscriptions.checkout', $subscription->id)); ?>"
           class="choose_plan w-full bg-primary hover:bg-secondary text-white font-medium py-2 px-6 rounded-xl transition-colors duration-500 mb-6 flex items-center justify-center text-center">
            <?php echo e($subscription->price <= 0 ? __('Get Started') : __('Buy Now')); ?>

            <i class="fas fa-arrow-right ml-2"></i>
        </a>

        <!-- Features -->
        <div class="space-y-4">
            <h4 class="font-semibold text-base-300"><?php echo e(__('Marketplace Plan include')); ?>:</h4>
            <ul class="space-y-2">
                <?php $__currentLoopData = $subscription->features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="flex items-start">
                        <div class="flex-shrink-0 flex items-center justify-center mt-0.5 mr-2">
                            <?php if($feature->status == 'on'): ?>
                                <img src="<?php echo e(asset('assets/frontend/new_design/assets/images/checkmark.svg')); ?>" alt="">
                            <?php else: ?>
                                <img src="<?php echo e(asset('assets/frontend/new_design/assets/images/crossmark.svg')); ?>" alt="">
                            <?php endif; ?>
                        </div>
                        <span class="text-gray-600"><?php echo e($feature->feature ?? ''); ?></span>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php if(empty($type_id)): ?>
    <?php echo $subscriptions->links(); ?>

<?php endif; ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/Modules/Subscription/Resources/views/frontend/subscriptions/search-result.blade.php ENDPATH**/ ?>