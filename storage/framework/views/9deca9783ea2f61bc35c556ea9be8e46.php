<!-- Profile Settings Popup Starts -->
<div class="popup-overlay"></div>
<form id="edit_profile_form" method="post">
    <?php echo csrf_field(); ?>
    <div class="popup-fixed profile-popup">
        <div class="popup-contents">
            <span class="popup-contents-close popup-close"> <i class="fas fa-times"></i> </span>
            <h2 class="popup-contents-title"> <?php echo e(__('Personal Information')); ?> </h2>
            <?php if (isset($component)) { $__componentOriginalfc4e3c8108f5f9458dc90e11adc2a670 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfc4e3c8108f5f9458dc90e11adc2a670 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.notice.general-notice','data' => ['description' => __('Notice: Except state and city all fields are required. Your identity verify documents info must be similar your personal info.')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('notice.general-notice'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Notice: Except state and city all fields are required. Your identity verify documents info must be similar your personal info.'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfc4e3c8108f5f9458dc90e11adc2a670)): ?>
<?php $attributes = $__attributesOriginalfc4e3c8108f5f9458dc90e11adc2a670; ?>
<?php unset($__attributesOriginalfc4e3c8108f5f9458dc90e11adc2a670); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfc4e3c8108f5f9458dc90e11adc2a670)): ?>
<?php $component = $__componentOriginalfc4e3c8108f5f9458dc90e11adc2a670; ?>
<?php unset($__componentOriginalfc4e3c8108f5f9458dc90e11adc2a670); ?>
<?php endif; ?>

            <div class="popup-contents-form custom-form profile-border-top">

                <div class="error_msg_container"></div>

                <div class="single-flex-input">
                    <?php if (isset($component)) { $__componentOriginal2497cd08ed4b80389f11a0f1101e9ba2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2497cd08ed4b80389f11a0f1101e9ba2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.text','data' => ['title' => __('First Name'),'type' => __('text'),'name' => 'first_name','id' => 'first_name','placeholder' => __('Type First Name'),'value' => Auth::guard('web')->user()->first_name ?? '' ]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('First Name')),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('text')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('first_name'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('first_name'),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Type First Name')),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Auth::guard('web')->user()->first_name ?? '' )]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2497cd08ed4b80389f11a0f1101e9ba2)): ?>
<?php $attributes = $__attributesOriginal2497cd08ed4b80389f11a0f1101e9ba2; ?>
<?php unset($__attributesOriginal2497cd08ed4b80389f11a0f1101e9ba2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2497cd08ed4b80389f11a0f1101e9ba2)): ?>
<?php $component = $__componentOriginal2497cd08ed4b80389f11a0f1101e9ba2; ?>
<?php unset($__componentOriginal2497cd08ed4b80389f11a0f1101e9ba2); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal2497cd08ed4b80389f11a0f1101e9ba2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2497cd08ed4b80389f11a0f1101e9ba2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.text','data' => ['title' => __('Last Name'),'type' => __('text'),'name' => 'last_name','id' => 'last_name','placeholder' => __('Type Last Name'),'value' => Auth::guard('web')->user()->last_name ?? '' ]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Last Name')),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('text')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('last_name'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('last_name'),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Type Last Name')),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Auth::guard('web')->user()->last_name ?? '' )]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2497cd08ed4b80389f11a0f1101e9ba2)): ?>
<?php $attributes = $__attributesOriginal2497cd08ed4b80389f11a0f1101e9ba2; ?>
<?php unset($__attributesOriginal2497cd08ed4b80389f11a0f1101e9ba2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2497cd08ed4b80389f11a0f1101e9ba2)): ?>
<?php $component = $__componentOriginal2497cd08ed4b80389f11a0f1101e9ba2; ?>
<?php unset($__componentOriginal2497cd08ed4b80389f11a0f1101e9ba2); ?>
<?php endif; ?>
                </div>
                <div class="single-flex-input">
                    <?php if (isset($component)) { $__componentOriginal14ae78b4f6fa5129467a3ebbe9326d74 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal14ae78b4f6fa5129467a3ebbe9326d74 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.email','data' => ['title' => __('Your Email'),'type' => __('email'),'name' => 'email','id' => 'email','placeholder' => __('Type Email'),'value' => Auth::guard('web')->user()->email ?? '' ]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.email'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Your Email')),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('email')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('email'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('email'),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Type Email')),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Auth::guard('web')->user()->email ?? '' )]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal14ae78b4f6fa5129467a3ebbe9326d74)): ?>
<?php $attributes = $__attributesOriginal14ae78b4f6fa5129467a3ebbe9326d74; ?>
<?php unset($__attributesOriginal14ae78b4f6fa5129467a3ebbe9326d74); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal14ae78b4f6fa5129467a3ebbe9326d74)): ?>
<?php $component = $__componentOriginal14ae78b4f6fa5129467a3ebbe9326d74; ?>
<?php unset($__componentOriginal14ae78b4f6fa5129467a3ebbe9326d74); ?>
<?php endif; ?>
                </div>
                <div class="single-flex-input">
                    <?php if (isset($component)) { $__componentOriginal516dbd59f81d12312a6824830d51c000 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal516dbd59f81d12312a6824830d51c000 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.country-dropdown','data' => ['title' => __('Select Your Country'),'id' => 'country_id']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.country-dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Select Your Country')),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('country_id')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal516dbd59f81d12312a6824830d51c000)): ?>
<?php $attributes = $__attributesOriginal516dbd59f81d12312a6824830d51c000; ?>
<?php unset($__attributesOriginal516dbd59f81d12312a6824830d51c000); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal516dbd59f81d12312a6824830d51c000)): ?>
<?php $component = $__componentOriginal516dbd59f81d12312a6824830d51c000; ?>
<?php unset($__componentOriginal516dbd59f81d12312a6824830d51c000); ?>
<?php endif; ?>
                </div>
                <?php if(moduleExists('CoinPaymentGateway')): ?>
                <?php else: ?>
                    <div class="single-flex-input">
                        <?php if (isset($component)) { $__componentOriginale1575a57811d7165e65a8a34fe5df9ad = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale1575a57811d7165e65a8a34fe5df9ad = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.state-dropdown','data' => ['title' => __('Select Your State'),'id' => 'state_id']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.state-dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Select Your State')),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('state_id')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale1575a57811d7165e65a8a34fe5df9ad)): ?>
<?php $attributes = $__attributesOriginale1575a57811d7165e65a8a34fe5df9ad; ?>
<?php unset($__attributesOriginale1575a57811d7165e65a8a34fe5df9ad); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale1575a57811d7165e65a8a34fe5df9ad)): ?>
<?php $component = $__componentOriginale1575a57811d7165e65a8a34fe5df9ad; ?>
<?php unset($__componentOriginale1575a57811d7165e65a8a34fe5df9ad); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal00c59bb80979fa38e61598a5020700f9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal00c59bb80979fa38e61598a5020700f9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.city-dropdown','data' => ['title' => __('Select Your City'),'id' => 'city_id']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.city-dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Select Your City')),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('city_id')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal00c59bb80979fa38e61598a5020700f9)): ?>
<?php $attributes = $__attributesOriginal00c59bb80979fa38e61598a5020700f9; ?>
<?php unset($__attributesOriginal00c59bb80979fa38e61598a5020700f9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal00c59bb80979fa38e61598a5020700f9)): ?>
<?php $component = $__componentOriginal00c59bb80979fa38e61598a5020700f9; ?>
<?php unset($__componentOriginal00c59bb80979fa38e61598a5020700f9); ?>
<?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="popup-contents-btn flex-btn profile-border-top justify-content-end">
                <?php if (isset($component)) { $__componentOriginal48996d52dcd3abb9272cf9c4e59ea156 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal48996d52dcd3abb9272cf9c4e59ea156 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn.close','data' => ['title' => __('Cancel'),'class' => 'btn-profile btn-outline-gray btn-hover-danger color-one popup-close']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn.close'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Cancel')),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('btn-profile btn-outline-gray btn-hover-danger color-one popup-close')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal48996d52dcd3abb9272cf9c4e59ea156)): ?>
<?php $attributes = $__attributesOriginal48996d52dcd3abb9272cf9c4e59ea156; ?>
<?php unset($__attributesOriginal48996d52dcd3abb9272cf9c4e59ea156); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal48996d52dcd3abb9272cf9c4e59ea156)): ?>
<?php $component = $__componentOriginal48996d52dcd3abb9272cf9c4e59ea156; ?>
<?php unset($__componentOriginal48996d52dcd3abb9272cf9c4e59ea156); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginald51d03ac38950c6ca9fceee323ea1e0d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald51d03ac38950c6ca9fceee323ea1e0d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn.submit','data' => ['title' => __('Update Profile'),'class' => 'btn-profile btn-bg-1']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn.submit'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Update Profile')),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('btn-profile btn-bg-1')]); ?>
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
        </div>
    </div>
</form>
</div>
<!-- Profile Settings Popup Ends -->
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/client/profile/edit-profile-info-modal.blade.php ENDPATH**/ ?>