<form action="<?php echo e(route('client.message.send')); ?>" method="post"
      enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="freelancer_id" id="freelancer_id"
           value="<?php echo e($project->user_id); ?>">
    <input type="hidden" name="from_user" id="from_user"
           value="1">
    <input type="hidden" name="project_id" id="project_id"
           value="<?php echo e($project->id); ?>">
    <button type="submit" class="btn-profile btn-outline-gray"><i
                class="fa-regular fa-comments"></i>
        <?php echo e(__('Contact Me')); ?></button>
</form>
<?php if(moduleExists('SecurityManage')): ?>
    <?php if(Auth::guard('web')->user()->freeze_order_create == 'freeze'): ?>
        <a href="#/" class="btn-profile btn-bg-1 <?php if(Auth::guard('web')->user()->freeze_order_create == 'freeze'): ?> disabled-link <?php endif; ?>">
            <?php echo e(__('Continue to Order')); ?>

        </a>
    <?php else: ?>
        <a href="#/"
           class="btn-profile btn-bg-1 basic_standard_premium"
           data-project_id="<?php echo e($project->id); ?>" data-bs-toggle="modal"
           data-bs-target="#paymentGatewayModal"><?php echo e(__('Continue to Order')); ?>

        </a>
    <?php endif; ?>
<?php else: ?>
    <a href="#/"
       class="btn-profile btn-bg-1 basic_standard_premium"
       data-project_id="<?php echo e($project->id); ?>" data-bs-toggle="modal"
       data-bs-target="#paymentGatewayModal"><?php echo e(__('Continue to Order')); ?>

    </a>
<?php endif; ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/pages/project-details/freelancer-order-as-client.blade.php ENDPATH**/ ?>