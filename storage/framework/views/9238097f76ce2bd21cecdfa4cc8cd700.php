<?php $__env->startSection('site_title', __('Email Verify')); ?>
<?php $__env->startSection('style'); ?>
    <style>
        .verify-form input {
            height: 50px;
            padding-left: 5px;
        }

        button.close {
            width: 30px;
            height: 30px;
            border: none;
            background: #000;
            color: #fff;
            border-radius: 3px;
            float: right;
            font-size: 20px;
        }

        .verify-form .verify-account {
            border-radius: 5px;
            font-size: 16px;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="signup-area pat-100 pab-100">
        <div class="container">
            <div class="signup-wrapper verify-account-wrapper">
                <div class="signup-contents">
                    <h3 class="signup-title"> <?php echo e(__('Verify Your Account')); ?> </h3>
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
                    <div class="alert alert-info alert-bs-dismissible fade show mt-5 mb-1" role="alert">
                        <?php echo e(__('Please check email inbox/spam for verification code')); ?>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="verify-form" method="post" action="<?php echo e(route('email.verify')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="single-input mt-4">
                            <label class="label-title mb-3"><?php echo e(__('Enter verification code*')); ?></label>
                            <input class="form--control" type="text" name="email_verify_token"
                                placeholder="<?php echo e(__('Enter code')); ?>">
                        </div>
                        <button class="submit-btn mt-4 verify-account" type="submit"><?php echo e(__('Verify Account')); ?></button>
                    </form>
                    <div class="resend-verify-code-wrap mt-3">
                        <a class="text-center"
                            href="<?php echo e(route('resend.verify.code')); ?>"><strong><?php echo e(__('Resend Code')); ?></strong></a>
                    </div>
                </div>
                <br>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/email-verify.blade.php ENDPATH**/ ?>