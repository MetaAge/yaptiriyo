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
        <th><?php echo e(__('Account Status')); ?></th>
        <th><?php echo e(__('Identity Verify')); ?></th>
        <th><?php echo e(__('Action')); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php if($all_users->total() >=1): ?>
        <?php $__currentLoopData = $all_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td> <?php if (isset($component)) { $__componentOriginal2f3acf431e4ef3aaad9c59423cc34c19 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2f3acf431e4ef3aaad9c59423cc34c19 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.bulk-action.bulk-delete-checkbox','data' => ['id' => $user->id]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('bulk-action.bulk-delete-checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user->id)]); ?>
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
                <td><?php echo e($user->id); ?></td>
                <td><?php echo e($user->first_name.' '.$user->last_name); ?></td>
                <td><?php echo e($user->email); ?></td>
                <td><?php echo e($user->phone); ?> </td>
                <?php if($user->is_suspend == 1): ?>
                <td> <?php if (isset($component)) { $__componentOriginal1454465292ef3821dd627e77cf0f5d90 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1454465292ef3821dd627e77cf0f5d90 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status.table.account-status','data' => ['status' => $user->is_suspend]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status.table.account-status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user->is_suspend)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1454465292ef3821dd627e77cf0f5d90)): ?>
<?php $attributes = $__attributesOriginal1454465292ef3821dd627e77cf0f5d90; ?>
<?php unset($__attributesOriginal1454465292ef3821dd627e77cf0f5d90); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1454465292ef3821dd627e77cf0f5d90)): ?>
<?php $component = $__componentOriginal1454465292ef3821dd627e77cf0f5d90; ?>
<?php unset($__componentOriginal1454465292ef3821dd627e77cf0f5d90); ?>
<?php endif; ?> </td>
                <?php else: ?>
                <td> <?php if (isset($component)) { $__componentOriginal03379f522cfceba10901e2e1e89a2bd7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal03379f522cfceba10901e2e1e89a2bd7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status.table.active-inactive','data' => ['status' => $user->user_active_inactive_status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status.table.active-inactive'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user->user_active_inactive_status)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal03379f522cfceba10901e2e1e89a2bd7)): ?>
<?php $attributes = $__attributesOriginal03379f522cfceba10901e2e1e89a2bd7; ?>
<?php unset($__attributesOriginal03379f522cfceba10901e2e1e89a2bd7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal03379f522cfceba10901e2e1e89a2bd7)): ?>
<?php $component = $__componentOriginal03379f522cfceba10901e2e1e89a2bd7; ?>
<?php unset($__componentOriginal03379f522cfceba10901e2e1e89a2bd7); ?>
<?php endif; ?> </td>
                <?php endif; ?>
                <td class="verified_status_load_<?php echo e($user->id); ?>">
                    <?php if (isset($component)) { $__componentOriginal0538401771b4fcefa92998c78e769e30 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0538401771b4fcefa92998c78e769e30 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status.table.verified-status','data' => ['status' => $user->user_verified_status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status.table.verified-status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user->user_verified_status)]); ?>
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
                    <?php if(!empty($user->identity_verify) && $user->identity_verify?->status == null): ?>
                        <span class="badge bg-danger" ><?php echo e(__('new')); ?></span>
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
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-details')): ?>
                        <li class="status_dropdown__item">
                            <a class="btn dropdown-item status_dropdown__list__link user_details"
                               data-bs-toggle="modal"
                               data-bs-target="#userDetailsModal"
                               data-user_id="<?php echo e($user->id); ?>"
                               data-type="<?php echo e($user->user_type); ?>"
                               data-hourly_rate="<?php echo e($user->hourly_rate); ?>"
                               data-first_name="<?php echo e($user->first_name); ?>"
                               data-last_name="<?php echo e($user->last_name); ?>"
                               data-username="<?php echo e($user->username); ?>"
                               data-email="<?php echo e($user->email); ?>"
                               data-phone="<?php echo e($user->phone); ?>"
                               data-country="<?php echo e(optional($user->user_country)->country); ?>"
                               data-country_id="<?php echo e($user->country_id); ?>"
                               data-state="<?php echo e(optional($user->user_state)->state); ?>"
                               data-state_id="<?php echo e($user->state_id); ?>"
                               data-city="<?php echo e(optional($user->user_city)->city); ?>"
                               data-city_id="<?php echo e($user->city_id); ?>">
                                <?php echo e(__('View User Details')); ?>

                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-identity-details')): ?>
                        <li class="status_dropdown__item">
                            <a class="btn dropdown-item status_dropdown__list__link user_identity_details"
                               data-bs-toggle="modal"
                               data-bs-target="#userIdentityModal"
                               data-user_id="<?php echo e($user->id); ?>">
                                <?php echo e(__('View Identity Details')); ?>

                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-password-change')): ?>
                        <li class="status_dropdown__item">
                            <a class="btn dropdown-item status_dropdown__list__link user_password_update_modal"
                               data-bs-toggle="modal"
                               data-bs-target="#userPasswordModal"
                               data-user_id_for_change_password="<?php echo e($user->id); ?>">
                                <?php echo e(__('Change Password')); ?>

                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if($user->google_2fa_enable_disable_disable == 1): ?>
                        <li class="status_dropdown__item">
                            <?php if (isset($component)) { $__componentOriginal96978baca952cfb8ff9a99443fa2658e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal96978baca952cfb8ff9a99443fa2658e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status.table.-2fa','data' => ['title' => __('Disable 2FA'),'url' => route('admin.user.disable._2fa',$user->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status.table.-2fa'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Disable 2FA')),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.user.disable._2fa',$user->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal96978baca952cfb8ff9a99443fa2658e)): ?>
<?php $attributes = $__attributesOriginal96978baca952cfb8ff9a99443fa2658e; ?>
<?php unset($__attributesOriginal96978baca952cfb8ff9a99443fa2658e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal96978baca952cfb8ff9a99443fa2658e)): ?>
<?php $component = $__componentOriginal96978baca952cfb8ff9a99443fa2658e; ?>
<?php unset($__componentOriginal96978baca952cfb8ff9a99443fa2658e); ?>
<?php endif; ?>
                        </li>
                        <?php endif; ?>
                        <?php if($user->is_email_verified == 0): ?>
                            <li class="status_dropdown__item">
                                <?php if (isset($component)) { $__componentOriginal2380b8055b78e7be0db9a78ed9e4a1b8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2380b8055b78e7be0db9a78ed9e4a1b8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status.table.email-verify','data' => ['title' => __('Verify User Email'),'url' => route('admin.user.verify.email',$user->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status.table.email-verify'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Verify User Email')),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.user.verify.email',$user->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2380b8055b78e7be0db9a78ed9e4a1b8)): ?>
<?php $attributes = $__attributesOriginal2380b8055b78e7be0db9a78ed9e4a1b8; ?>
<?php unset($__attributesOriginal2380b8055b78e7be0db9a78ed9e4a1b8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2380b8055b78e7be0db9a78ed9e4a1b8)): ?>
<?php $component = $__componentOriginal2380b8055b78e7be0db9a78ed9e4a1b8; ?>
<?php unset($__componentOriginal2380b8055b78e7be0db9a78ed9e4a1b8); ?>
<?php endif; ?>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-delete')): ?>
                        <li class="status_dropdown__item">
                            <?php if (isset($component)) { $__componentOriginal7973b0ce98592c79f9209abd6e46a09b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7973b0ce98592c79f9209abd6e46a09b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.popup.delete-popup','data' => ['title' => __('Delete User'),'url' => route('admin.user.delete',$user->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('popup.delete-popup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Delete User')),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.user.delete',$user->id))]); ?>
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
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-account-status-change')): ?>
                        <li class="status_dropdown__item">
                            <?php if (isset($component)) { $__componentOriginaled49183813b6264fe02b2283042511dd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled49183813b6264fe02b2283042511dd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status.table.status-change','data' => ['title' => __('Change Account Status'),'url' => route('admin.user.status',$user->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status.table.status-change'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Change Account Status')),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.user.status',$user->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled49183813b6264fe02b2283042511dd)): ?>
<?php $attributes = $__attributesOriginaled49183813b6264fe02b2283042511dd; ?>
<?php unset($__attributesOriginaled49183813b6264fe02b2283042511dd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled49183813b6264fe02b2283042511dd)): ?>
<?php $component = $__componentOriginaled49183813b6264fe02b2283042511dd; ?>
<?php unset($__componentOriginaled49183813b6264fe02b2283042511dd); ?>
<?php endif; ?>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-account-status-change')): ?>
                        <li class="status_dropdown__item">
                            <?php if($user->is_suspend == 1): ?>
                                <?php if (isset($component)) { $__componentOriginaled49183813b6264fe02b2283042511dd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled49183813b6264fe02b2283042511dd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status.table.status-change','data' => ['class' => 'btn dropdown-item status_dropdown__list__link unsuspend_user_account','title' => __('Unsuspend User'),'url' => route('admin.account.unsuspend',$user->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status.table.status-change'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('btn dropdown-item status_dropdown__list__link unsuspend_user_account'),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Unsuspend User')),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.account.unsuspend',$user->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled49183813b6264fe02b2283042511dd)): ?>
<?php $attributes = $__attributesOriginaled49183813b6264fe02b2283042511dd; ?>
<?php unset($__attributesOriginaled49183813b6264fe02b2283042511dd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled49183813b6264fe02b2283042511dd)): ?>
<?php $component = $__componentOriginaled49183813b6264fe02b2283042511dd; ?>
<?php unset($__componentOriginaled49183813b6264fe02b2283042511dd); ?>
<?php endif; ?>
                            <?php else: ?>
                                <?php if (isset($component)) { $__componentOriginaled49183813b6264fe02b2283042511dd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled49183813b6264fe02b2283042511dd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status.table.status-change','data' => ['class' => 'btn dropdown-item status_dropdown__list__link suspend_user_account','title' => __('Suspend User'),'url' => route('admin.account.suspend',$user->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status.table.status-change'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('btn dropdown-item status_dropdown__list__link suspend_user_account'),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Suspend User')),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.account.suspend',$user->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled49183813b6264fe02b2283042511dd)): ?>
<?php $attributes = $__attributesOriginaled49183813b6264fe02b2283042511dd; ?>
<?php unset($__attributesOriginaled49183813b6264fe02b2283042511dd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled49183813b6264fe02b2283042511dd)): ?>
<?php $component = $__componentOriginaled49183813b6264fe02b2283042511dd; ?>
<?php unset($__componentOriginaled49183813b6264fe02b2283042511dd); ?>
<?php endif; ?>
                            <?php endif; ?>
                        </li>
                        <?php endif; ?>
                        
                        <?php if(moduleExists('SecurityManage')): ?>
                            <?php $user->freeze_job == 'freeze' ? $is_job_freeze = 'Job Create Edit Unfreeze' : $is_job_freeze = 'Job Create Edit Freeze'; ?>
                            <?php $user->freeze_order_create == 'freeze' ? $is_order_freeze = 'New Order Create Unfreeze' : $is_order_freeze = 'New Order Create Freeze'; ?>
                            <?php $user->freeze_chat == 'freeze' ? $is_chat_freeze = 'Chat Unfreeze' : $is_chat_freeze = 'Chat Freeze'; ?>

                            <?php if (isset($component)) { $__componentOriginaled49183813b6264fe02b2283042511dd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled49183813b6264fe02b2283042511dd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status.table.status-change','data' => ['title' => __($is_job_freeze),'url' => route('admin.client.job.freeze',$user->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status.table.status-change'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__($is_job_freeze)),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.client.job.freeze',$user->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled49183813b6264fe02b2283042511dd)): ?>
<?php $attributes = $__attributesOriginaled49183813b6264fe02b2283042511dd; ?>
<?php unset($__attributesOriginaled49183813b6264fe02b2283042511dd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled49183813b6264fe02b2283042511dd)): ?>
<?php $component = $__componentOriginaled49183813b6264fe02b2283042511dd; ?>
<?php unset($__componentOriginaled49183813b6264fe02b2283042511dd); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginaled49183813b6264fe02b2283042511dd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled49183813b6264fe02b2283042511dd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status.table.status-change','data' => ['title' => __($is_order_freeze),'url' => route('admin.client.new.order.freeze',$user->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status.table.status-change'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__($is_order_freeze)),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.client.new.order.freeze',$user->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled49183813b6264fe02b2283042511dd)): ?>
<?php $attributes = $__attributesOriginaled49183813b6264fe02b2283042511dd; ?>
<?php unset($__attributesOriginaled49183813b6264fe02b2283042511dd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled49183813b6264fe02b2283042511dd)): ?>
<?php $component = $__componentOriginaled49183813b6264fe02b2283042511dd; ?>
<?php unset($__componentOriginaled49183813b6264fe02b2283042511dd); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginaled49183813b6264fe02b2283042511dd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled49183813b6264fe02b2283042511dd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status.table.status-change','data' => ['title' => __($is_chat_freeze),'url' => route('admin.user.chat.freeze',$user->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status.table.status-change'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__($is_chat_freeze)),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.user.chat.freeze',$user->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled49183813b6264fe02b2283042511dd)): ?>
<?php $attributes = $__attributesOriginaled49183813b6264fe02b2283042511dd; ?>
<?php unset($__attributesOriginaled49183813b6264fe02b2283042511dd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled49183813b6264fe02b2283042511dd)): ?>
<?php $component = $__componentOriginaled49183813b6264fe02b2283042511dd; ?>
<?php unset($__componentOriginaled49183813b6264fe02b2283042511dd); ?>
<?php endif; ?>
                        <?php endif; ?>
                    </ul>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <?php if (isset($component)) { $__componentOriginal299c0410dd55ce378949b38ffa493a39 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal299c0410dd55ce378949b38ffa493a39 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table.no-data-found','data' => ['colspan' => '7','class' => 'text-danger text-center py-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table.no-data-found'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['colspan' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('7'),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('text-danger text-center py-5')]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.pagination.laravel-paginate','data' => ['allData' => $all_users]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('pagination.laravel-paginate'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['allData' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($all_users)]); ?>
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
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/backend/pages/user/clients/search-result.blade.php ENDPATH**/ ?>