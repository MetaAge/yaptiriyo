<div class="single-profile-settings">
    <form id="submit_freelancer_verify_info" method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="identity-verifying">
            <h4 class="identity-verifying-title"><?php echo e(__('Verify your Identity')); ?></h4>
            <p class="identity-verifying-para mt-2"><?php echo e(__('Please choose to submit any of the government-issued documents listed below.')); ?></p>
            <div class="error_msg_container my-1"></div>
            <div class="identity-verifying-form custom-form profile-border-top">
                <div class="identity-verifying-flex">
                    <div class="identity-verifying-list custom-radio active">
                        <div class="identity-verifying-list-flex">
                            <div class="identity-verifying-list-contents">
                                <div class="identity-verifying-list-contents-flex">
                                    <div class="identity-verifying-list-contents-icon">
                                        <i class="fa-solid fa-id-card"></i>
                                    </div>
                                    <div class="identity-verifying-list-contents-details">
                                        <h5 class="identity-verifying-list-contents-details-title"><?php echo e(__('National ID Card')); ?></h5>
                                    </div>
                                </div>
                            </div>
                            <input type="radio" class="verify-radio" name="verify" checked="">
                        </div>
                    </div>
                    <div class="identity-verifying-list custom-radio">
                        <div class="identity-verifying-list-flex">
                            <div class="identity-verifying-list-contents">
                                <div class="identity-verifying-list-contents-flex">
                                    <div class="identity-verifying-list-contents-icon">
                                        <i class="fa-solid fa-id-card"></i>
                                    </div>
                                    <div class="identity-verifying-list-contents-details">
                                        <h5 class="identity-verifying-list-contents-details-title"><?php echo e(__('Driving License')); ?></h5>
                                    </div>
                                </div>
                            </div>
                            <input type="radio" class="verify-radio" name="verify">
                        </div>
                    </div>
                    <div class="identity-verifying-list custom-radio">
                        <div class="identity-verifying-list-flex">
                            <div class="identity-verifying-list-contents">
                                <div class="identity-verifying-list-contents-flex">
                                    <div class="identity-verifying-list-contents-icon">
                                        <i class="fa-solid fa-passport"></i>
                                    </div>
                                    <div class="identity-verifying-list-contents-details">
                                        <h5 class="identity-verifying-list-contents-details-title"><?php echo e(__('Passport')); ?></h5>
                                    </div>
                                </div>
                            </div>
                            <input type="radio" class="verify-radio" name="verify">
                        </div>
                    </div>
                </div>
                <input type="hidden" name="verify_by" id="verify_by" value="National ID Card">
                <?php if (isset($component)) { $__componentOriginal516dbd59f81d12312a6824830d51c000 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal516dbd59f81d12312a6824830d51c000 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.country-dropdown','data' => ['title' => __('ID issuing country'),'name' => 'country','id' => 'country']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.country-dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('ID issuing country')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('country'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('country')]); ?>
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
                <div class="single-flex-input">
                    <?php if (isset($component)) { $__componentOriginale1575a57811d7165e65a8a34fe5df9ad = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale1575a57811d7165e65a8a34fe5df9ad = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.state-dropdown','data' => ['title' => __('State'),'name' => 'state','id' => 'state']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.state-dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('State')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('state'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('state')]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.city-dropdown','data' => ['title' => __('City'),'name' => 'city','id' => 'city']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.city-dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('City')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('city'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('city')]); ?>
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
                <?php if (isset($component)) { $__componentOriginal2497cd08ed4b80389f11a0f1101e9ba2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2497cd08ed4b80389f11a0f1101e9ba2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.text','data' => ['title' => __('Address'),'type' => 'text','name' => 'address','id' => 'address','value' => $user_identity->address ?? old('address'),'placeholder' => __('Enter address'),'class' => 'form--control']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Address')),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('text'),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('address'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('address'),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user_identity->address ?? old('address')),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Enter address')),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('form--control')]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.text','data' => ['title' => __('Zip Code'),'type' => 'text','name' => 'zipcode','id' => 'zipcode','value' => $user_identity->zipcode ?? old('zipcode'),'placeholder' => __('Enter zip code'),'class' => 'form--control']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Zip Code')),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('text'),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('zipcode'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('zipcode'),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user_identity->zipcode ?? old('zipcode')),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Enter zip code')),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('form--control')]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.text','data' => ['title' => __('National ID number'),'type' => 'number','name' => 'national_id_number','id' => 'national_id_number','value' => $user_identity->national_id_number ?? old('national_id_number'),'placeholder' => __('Enter id number'),'class' => 'form--control']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('National ID number')),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('number'),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('national_id_number'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('national_id_number'),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user_identity->national_id_number ?? old('national_id_number')),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Enter id number')),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('form--control')]); ?>
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

                <div class="identity-verifying-upload flex-btn mt-4">

                    <div class="photo-uploaded photo-uploaded-padding center-text">
                        <?php if(!empty($user_identity)): ?>
                            <img class="front_image" src="<?php echo e(asset('assets/uploads/verification/'.$user_identity->front_image)); ?>">
                        <?php endif; ?>
                        <img src="" class="front_image_preview">
                        <div class="mt-4">
                            <span class="photo-uploaded-icon"> <i class="fa-solid fa-upload"></i> </span>
                            <p class="photo-uploaded-para mt-3"> <?php echo e(__('Upload Front side of your ID')); ?>

                                <br> <small><?php echo e(__('Dimensions must be 500x300 px')); ?></small> </p>
                            <input type="file" name="front_image" id="front_image" class="photo-uploaded-file front_image_upload">
                        </div>
                    </div>
                    <div class="photo-uploaded photo-uploaded-padding center-text">
                        <?php if(!empty($user_identity)): ?>
                            <img class="front_image" src="<?php echo e(asset('assets/uploads/verification/'.$user_identity->back_image)); ?>">
                        <?php endif; ?>
                            <img src="" class="back_image_preview">

                        <div class="mt-4">
                            <span class="photo-uploaded-icon"> <i class="fa-solid fa-upload"></i> </span>
                            <p class="photo-uploaded-para mt-3"> <?php echo e(__('Upload Back side of your ID')); ?>

                                <br> <small><?php echo e(__('Dimensions must be 500x300 px')); ?></small></p>
                            <input type="file" name="back_image" id="back_image" class="photo-uploaded-file back_image_upload">
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-wrapper profile-border-top flex-btn justify-content-end">
                <?php if (isset($component)) { $__componentOriginald51d03ac38950c6ca9fceee323ea1e0d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald51d03ac38950c6ca9fceee323ea1e0d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn.submit','data' => ['title' => __('Submit'),'class' => 'btn-profile btn-bg-1']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn.submit'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Submit')),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('btn-profile btn-bg-1')]); ?>
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
    </form>
</div>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/freelancer/identity/identity-display.blade.php ENDPATH**/ ?>