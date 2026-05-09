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
<table class="DataTable_activation">
    <thead>
        <tr>
            <th class="no-sort">
                <div class="mark-all-checkbox">
                    <input type="checkbox" class="all-checkbox">
                </div>
            </th>
            <th><?php echo e(__('ID')); ?></th>
            <th><?php echo e(__('Type')); ?></th>
            <th><?php echo e(__('Validity')); ?></th>
            <th><?php echo e(__('Is Free')); ?></th>
            <th><?php echo e(__('Action')); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $all_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td> <?php if (isset($component)) { $__componentOriginal2f3acf431e4ef3aaad9c59423cc34c19 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2f3acf431e4ef3aaad9c59423cc34c19 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.bulk-action.bulk-delete-checkbox','data' => ['id' => $type->id]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('bulk-action.bulk-delete-checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($type->id)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2f3acf431e4ef3aaad9c59423cc34c19)): ?>
<?php $attributes = $__attributesOriginal2f3acf431e4ef3aaad9c59423cc34c19; ?>
<?php unset($__attributesOriginal2f3acf431e4ef3aaad9c59423cc34c19); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2f3acf431e4ef3aaad9c59423cc34c19)): ?>
<?php $component = $__componentOriginal2f3acf431e4ef3aaad9c59423cc34c19; ?>
<?php unset($__componentOriginal2f3acf431e4ef3aaad9c59423cc34c19); ?>
<?php endif; ?> </td>
                <td><?php echo e($type->id); ?></td>
                <td><?php echo e($type->type); ?></td>
                <td><?php echo e($type->validity); ?> <?php echo e(__('days')); ?></td>
                <td>
                    <?php if($type->is_free): ?>
                        <span class="badge bg-success"><?php echo e(__('Yes')); ?></span>
                    <?php else: ?>
                        <span class="badge bg-danger"><?php echo e(__('No')); ?></span>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if (isset($component)) { $__componentOriginal8f171b7aec972ecdf8c21b4ace25e397 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8f171b7aec972ecdf8c21b4ace25e397 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status.table.select-action','data' => ['title' => __('Select Action')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status.table.select-action'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Select Action'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8f171b7aec972ecdf8c21b4ace25e397)): ?>
<?php $attributes = $__attributesOriginal8f171b7aec972ecdf8c21b4ace25e397; ?>
<?php unset($__attributesOriginal8f171b7aec972ecdf8c21b4ace25e397); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8f171b7aec972ecdf8c21b4ace25e397)): ?>
<?php $component = $__componentOriginal8f171b7aec972ecdf8c21b4ace25e397; ?>
<?php unset($__componentOriginal8f171b7aec972ecdf8c21b4ace25e397); ?>
<?php endif; ?>
                    <ul class="dropdown-menu status_dropdown__list">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('subscription-type-edit')): ?>
                            <li class="status_dropdown__item">
                                <a class="btn dropdown-item status_dropdown__list__link edit_type_modal"
                                    data-bs-toggle="modal" data-bs-target="#editTypeModal" data-id="<?php echo e($type->id); ?>"
                                    data-type="<?php echo e($type->type); ?>" data-validity="<?php echo e($type->validity); ?>">
                                    <?php echo e(__('Edit Type')); ?>

                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('subscription-type-delete')): ?>
                            <li class="status_dropdown__item"><?php if (isset($component)) { $__componentOriginal7973b0ce98592c79f9209abd6e46a09b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7973b0ce98592c79f9209abd6e46a09b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.popup.delete-popup','data' => ['title' => __('Delete Type'),'url' => route('admin.subscription.type.delete', $type->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('popup.delete-popup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Delete Type')),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.subscription.type.delete', $type->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7973b0ce98592c79f9209abd6e46a09b)): ?>
<?php $attributes = $__attributesOriginal7973b0ce98592c79f9209abd6e46a09b; ?>
<?php unset($__attributesOriginal7973b0ce98592c79f9209abd6e46a09b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7973b0ce98592c79f9209abd6e46a09b)): ?>
<?php $component = $__componentOriginal7973b0ce98592c79f9209abd6e46a09b; ?>
<?php unset($__componentOriginal7973b0ce98592c79f9209abd6e46a09b); ?>
<?php endif; ?>
                            </li>
                        <?php endif; ?>
                    </ul>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php if (isset($component)) { $__componentOriginal0143df8887fb9686c5dbf1f1b0d7027f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0143df8887fb9686c5dbf1f1b0d7027f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.pagination.laravel-paginate','data' => ['allData' => $all_types]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('pagination.laravel-paginate'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['allData' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($all_types)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0143df8887fb9686c5dbf1f1b0d7027f)): ?>
<?php $attributes = $__attributesOriginal0143df8887fb9686c5dbf1f1b0d7027f; ?>
<?php unset($__attributesOriginal0143df8887fb9686c5dbf1f1b0d7027f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0143df8887fb9686c5dbf1f1b0d7027f)): ?>
<?php $component = $__componentOriginal0143df8887fb9686c5dbf1f1b0d7027f; ?>
<?php unset($__componentOriginal0143df8887fb9686c5dbf1f1b0d7027f); ?>
<?php endif; ?>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/Modules/Subscription/Resources/views/backend/type/search-result.blade.php ENDPATH**/ ?>