<section class="w-full py-12 md:py-20 lg:py-[120px] bg-[#F8F9FD] md:min-h-[calc(100vh-139px)] flex items-center justify-center" data-padding-top="<?php echo e($padding_top ?? ''); ?>" data-padding-bottom="<?php echo e($padding_bottom ?? ''); ?>">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-12">

        <!-- Left Section -->
        <div class="flex flex-col justify-center">
            <div>
                <h2 class="text-3xl font-medium mb-4"><?php echo nl2br(e($heading ?? '')); ?></h2>
                <p class="text-gray-600 text-base leading-relaxed">
                    <?php echo e($contact_form_des ?? ''); ?>

                </p>
            </div>

            <!-- Contact Details -->
            <div class="space-y-6 mt-8">
                <?php if(isset($repeater_data['icon_']) && is_array($repeater_data['icon_'])): ?>
                    <?php $__currentLoopData = $repeater_data['icon_']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="<?php echo e($icon); ?> text-primary"></i>
                            </div>
                            <div>
                                <h3 class="text-base-300 font-medium mb-1"><?php echo e($repeater_data['title_'][$key] ?? ''); ?></h3>
                                <p class="text-gray-600 text-sm"><?php echo e($repeater_data['description_'][$key] ?? ''); ?></p>
                            </div>
                        </div>
                        <?php if(!$loop->last): ?>
                            <hr>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Right Section - Form -->
        <div class="bg-white rounded-lg p-8 shadow-sm">
            <?php if (isset($component)) { $__componentOriginal4bb59b834d778ff0cb72af5a473e2885 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4bb59b834d778ff0cb72af5a473e2885 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.validation.error','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('validation.error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4bb59b834d778ff0cb72af5a473e2885)): ?>
<?php $attributes = $__attributesOriginal4bb59b834d778ff0cb72af5a473e2885; ?>
<?php unset($__attributesOriginal4bb59b834d778ff0cb72af5a473e2885); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4bb59b834d778ff0cb72af5a473e2885)): ?>
<?php $component = $__componentOriginal4bb59b834d778ff0cb72af5a473e2885; ?>
<?php unset($__componentOriginal4bb59b834d778ff0cb72af5a473e2885); ?>
<?php endif; ?>
            <?php echo $form_details; ?>

        </div>
    </div>
</section><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/app/Providers/../../plugins/PageBuilder/views/contact-page/form.blade.php ENDPATH**/ ?>