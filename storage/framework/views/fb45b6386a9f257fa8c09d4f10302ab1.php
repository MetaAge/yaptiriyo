<!-- Country Edit Modal -->
<div class="modal fade" id="editPaymentGatewayModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo e(__('Complete Payment Status')); ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo e(route('admin.user.subscription.update.manual.payment')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="subscription_id" id="subscription_id">
                <input type="hidden" name="user_firstname" id="user_firstname">
                <input type="hidden" name="user_email" id="user_email">
                <div class="modal-body">
                    <h4><?php echo e(__('User Details')); ?></h4>
                    <p><?php echo e(__('User Type:')); ?> <span class="user_type"></span></p>
                    <p><?php echo e(__('User Email:')); ?> <span class="user_email"></span></p>
                    <p><?php echo e(__('Payment Document:')); ?>

                        <span class="manual_payment_img"></span>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mt-4" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                    <?php if (isset($component)) { $__componentOriginald51d03ac38950c6ca9fceee323ea1e0d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald51d03ac38950c6ca9fceee323ea1e0d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn.submit','data' => ['title' => __('Update'),'class' => 'btn btn-primary mt-4 pr-4 pl-4 update_category']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn.submit'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Update')),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('btn btn-primary mt-4 pr-4 pl-4 update_category')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald51d03ac38950c6ca9fceee323ea1e0d)): ?>
<?php $attributes = $__attributesOriginald51d03ac38950c6ca9fceee323ea1e0d; ?>
<?php unset($__attributesOriginald51d03ac38950c6ca9fceee323ea1e0d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald51d03ac38950c6ca9fceee323ea1e0d)): ?>
<?php $component = $__componentOriginald51d03ac38950c6ca9fceee323ea1e0d; ?>
<?php unset($__componentOriginald51d03ac38950c6ca9fceee323ea1e0d); ?>
<?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/Modules/Subscription/Resources/views/backend/user-subscription/manual-payment-modal.blade.php ENDPATH**/ ?>