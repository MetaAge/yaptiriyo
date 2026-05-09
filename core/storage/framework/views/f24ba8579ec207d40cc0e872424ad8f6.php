<table class="table_activation">
    <thead>
    <tr>
        <th class="no-sort">
            <div class="mark-all-checkbox">
                <input type="checkbox" class="all-checkbox">
            </div>
        </th>
        <th><?php echo e(__('ID')); ?></th>
        <th><?php echo e(__('Name')); ?></th>
        <th><?php echo e(__('Email')); ?></th>
        <th><?php echo e(__('Phone')); ?></th>
        <th><?php echo e(__('Active Status')); ?></th>
        <th><?php echo e(__('Verified Status')); ?></th>
        <th><?php echo e(__('Action')); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php if($all_requests->total() >= 1): ?>
        <?php $__currentLoopData = $all_requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <?php if (isset($component)) { $__componentOriginal2f3acf431e4ef3aaad9c59423cc34c19 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2f3acf431e4ef3aaad9c59423cc34c19 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.bulk-action.bulk-delete-checkbox','data' => ['id' => $req->id]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('bulk-action.bulk-delete-checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($req->id)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2f3acf431e4ef3aaad9c59423cc34c19)): ?>
<?php $attributes = $__attributesOriginal2f3acf431e4ef3aaad9c59423cc34c19; ?>
<?php unset($__attributesOriginal2f3acf431e4ef3aaad9c59423cc34c19); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2f3acf431e4ef3aaad9c59423cc34c19)): ?>
<?php $component = $__componentOriginal2f3acf431e4ef3aaad9c59423cc34c19; ?>
<?php unset($__componentOriginal2f3acf431e4ef3aaad9c59423cc34c19); ?>
<?php endif; ?>
                </td>
                <td><?php echo e($req->id); ?></td>
                <td><?php echo e(optional($req->user)->first_name); ?></td>
                <td><?php echo e(optional($req->user)->email); ?></td>
                <td><?php echo e(optional($req->user)->phone); ?></td>
                <td>
                    <?php if (isset($component)) { $__componentOriginal03379f522cfceba10901e2e1e89a2bd7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal03379f522cfceba10901e2e1e89a2bd7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status.table.active-inactive','data' => ['status' => optional($req->user)->user_active_inactive_status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status.table.active-inactive'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(optional($req->user)->user_active_inactive_status)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal03379f522cfceba10901e2e1e89a2bd7)): ?>
<?php $attributes = $__attributesOriginal03379f522cfceba10901e2e1e89a2bd7; ?>
<?php unset($__attributesOriginal03379f522cfceba10901e2e1e89a2bd7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal03379f522cfceba10901e2e1e89a2bd7)): ?>
<?php $component = $__componentOriginal03379f522cfceba10901e2e1e89a2bd7; ?>
<?php unset($__componentOriginal03379f522cfceba10901e2e1e89a2bd7); ?>
<?php endif; ?>
                </td>
                <td class="verified_status_load_<?php echo e($req->user_id); ?>">
                    <?php if (isset($component)) { $__componentOriginal0538401771b4fcefa92998c78e769e30 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0538401771b4fcefa92998c78e769e30 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status.table.verified-status','data' => ['status' => optional($req->user)->user_verified_status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status.table.verified-status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(optional($req->user)->user_verified_status)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0538401771b4fcefa92998c78e769e30)): ?>
<?php $attributes = $__attributesOriginal0538401771b4fcefa92998c78e769e30; ?>
<?php unset($__attributesOriginal0538401771b4fcefa92998c78e769e30); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0538401771b4fcefa92998c78e769e30)): ?>
<?php $component = $__componentOriginal0538401771b4fcefa92998c78e769e30; ?>
<?php unset($__componentOriginal0538401771b4fcefa92998c78e769e30); ?>
<?php endif; ?>
                    <?php if($req->status === 2): ?>
                        <span class="alert alert-danger" ><?php echo e(__('Decline')); ?></span>
                    <?php endif; ?>
                </td>
                <td>
                    <a class="btn dropdown-item status_dropdown__list__link user_identity_details" data-bs-toggle="modal" data-bs-target="#userIdentityModal" data-user_id="<?php echo e($req->user_id); ?>">
                        <?php echo e(__('View Identity Details')); ?>

                    </a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <?php if (isset($component)) { $__componentOriginal299c0410dd55ce378949b38ffa493a39 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal299c0410dd55ce378949b38ffa493a39 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table.no-data-found','data' => ['colspan' => '8','class' => 'text-danger text-center py-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table.no-data-found'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['colspan' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('8'),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('text-danger text-center py-5')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal299c0410dd55ce378949b38ffa493a39)): ?>
<?php $attributes = $__attributesOriginal299c0410dd55ce378949b38ffa493a39; ?>
<?php unset($__attributesOriginal299c0410dd55ce378949b38ffa493a39); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal299c0410dd55ce378949b38ffa493a39)): ?>
<?php $component = $__componentOriginal299c0410dd55ce378949b38ffa493a39; ?>
<?php unset($__componentOriginal299c0410dd55ce378949b38ffa493a39); ?>
<?php endif; ?>
    <?php endif; ?>
    </tbody>
</table>
<?php if (isset($component)) { $__componentOriginal0143df8887fb9686c5dbf1f1b0d7027f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0143df8887fb9686c5dbf1f1b0d7027f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.pagination.laravel-paginate','data' => ['allData' => $all_requests]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('pagination.laravel-paginate'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['allData' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($all_requests)]); ?>
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
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/backend/pages/user/verification/verification-request-search.blade.php ENDPATH**/ ?>