<!-- Budget, Skills Start -->
<div class="setup-wrapper-contents">
    <div class="setup-wrapper-contents-item">
        <div class="setup-bank-form">
            <div class="setup-bank-form-item">
                <label class="label-title"><?php echo e(__('Job type')); ?></label>
                <select class="form-control" name="type" id="type">
                    <option value="fixed" <?php echo e($job_details->type == 'fixed' ? 'selected' : ''); ?>><?php echo e(__('Fixed-Price (Pay a fixed amount for the job)')); ?></option>
                    <?php if(moduleExists('HourlyJob')): ?>
                        <option value="hourly" <?php echo e($job_details->type == 'hourly' ? 'selected' : ''); ?>><?php echo e(__('Hourly Rate (Pay based on total hours worked for the job)')); ?></option>
                    <?php endif; ?>
                </select>
            </div>
            <?php if(moduleExists('HourlyJob')): ?>
                <div class="setup-bank-form-item setup-bank-form-item-icon d-none manage-hourly-jobs">
                    <label class="label-title"><?php echo e(__('Hourly Rate')); ?></label>
                    <?php if(moduleExists('CurrencySwitcher')): ?>
                        <input type="number" class="form--control" name="hourly_rate" onkeyup="setTimeout(() => { if (this.value === '' || this.value <= 0) this.value = 1; if (this.value > 100000) this.value = 100000; }, 1500);" value="<?php echo e(float_amount_without_currency_symbol($job_details->hourly_rate) ?? ''); ?>" id="hourly_rate" placeholder="<?php echo e(__('Enter Hourly Rate')); ?>">
                        <span class="input-icon"><?php echo e(get_currency_according_to_user() ?? get_static_option('site_global_currency')); ?></span>
                    <?php else: ?>
                        <input type="number" class="form--control" name="hourly_rate" onkeyup="setTimeout(() => { if (this.value === '' || this.value <= 0) this.value = 1; if (this.value > 100000) this.value = 100000; }, 1500);" value="<?php echo e($job_details->hourly_rate ?? ''); ?>" id="hourly_rate" placeholder="<?php echo e(__('Enter Hourly Rate')); ?>">
                        <span class="input-icon"><?php echo e(get_static_option('site_global_currency') ?? ''); ?></span>
                    <?php endif; ?>
                </div>
                <div class="setup-bank-form-item d-none manage-hourly-jobs">
                    <label class="label-title"><?php echo e(__('Estimated Hours')); ?></label>
                    <input type="number" class="form--control" name="estimated_hours" onkeyup="setTimeout(() => { if (this.value === '' || this.value <= 0) this.value = 1; if (this.value > 100000) this.value = 100000; }, 1500);" value="<?php echo e($job_details->estimated_hours ?? ''); ?>" id="estimated_hours" placeholder="<?php echo e(__('Enter Estimated Hours')); ?>">
                </div>
            <?php endif; ?>
            <div class="setup-bank-form-item setup-bank-form-item-icon manage-fixed-jobs">
                <label class="label-title"><?php echo e(__('Enter Budget')); ?></label>
                <?php if(moduleExists('CurrencySwitcher')): ?>
                    <input type="number" class="form--control" name="budget" id="budget" value="<?php echo e(float_amount_without_currency_symbol($job_details->budget)); ?>" placeholder="<?php echo e(__('Enter Your Budget')); ?>">
                    <span class="input-icon"><?php echo e(get_currency_according_to_user() ?? get_static_option('site_global_currency')); ?></span>
                <?php else: ?>
                    <input type="number" class="form--control" name="budget" id="budget" value="<?php echo e($job_details->budget); ?>" placeholder="<?php echo e(__('Enter Your Budget')); ?>">
                    <span class="input-icon"><?php echo e(get_static_option('site_global_currency') ?? ''); ?></span>
                <?php endif; ?>
            </div>
            <div class="single-input mt-3">
                <label class="label-title"><?php echo e(__('Select Skill')); ?></label>
                <select name="skill[]" id="skill" class="form-control skill_select2" multiple>
                    <?php $__currentLoopData = $allSkills = \App\Models\Skill::all_skills(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option
                            <?php $__currentLoopData = $job_details->job_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($skill->id === $data->id ? 'selected' : ''); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            value="<?php echo e($data->id); ?>"><?php echo e($data->skill); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="setup-bank-form-item">
                <?php
                    $extension = pathinfo($job_details->attachment,PATHINFO_EXTENSION);
                    $extensions = array('png','jpg','jpeg','bmp','gif','tiff','svg');
                ?>

                <?php if(in_array($extension, $extensions)): ?>
                    <div class="remove-attachment-wrap mb-4 img_max_width">
                        <?php if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])): ?>
                            <img class="remove_attachment w-100" src="<?php echo e(render_frontend_cloud_image_if_module_exists('jobs/'.$job_details->attachment, load_from: $job_details->load_from)); ?>" alt="<?php echo e($job_details->attachment ?? ''); ?>">
                        <?php else: ?>
                            <img class="remove_attachment w-100" src="<?php echo e(asset('assets/uploads/jobs/'.$job_details->attachment)); ?>" alt="<?php echo e($job_details->attachment ?? ''); ?>">
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="remove-attachment-wrap mb-4">
                        <span class="remove_attachment"><?php echo e($job_details->attachment ?? ''); ?></span>
                    </div>
                <?php endif; ?>
                <label class="photo-uploaded center-text w-100">
                    <div class="photo-uploaded-flex d-flex uploadImage">
                        <div class="photo-uploaded-icon"><i class="fa-solid fa-paperclip"></i></div>
                        <span class="photo-uploaded-para"><?php echo e(__('Add attachments')); ?></span>
                    </div>
                    <input class="photo-uploaded-file inputTag" type="file" name="attachment" id="attachment">
                </label>
                <?php if(get_static_option('file_extensions')): ?>
                    <p class="mt-2">
                        <?php echo e(__('Supported files:')); ?> <?php echo e(implode(', ', json_decode(get_static_option('file_extensions'), true))); ?>

                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- Budget, Skills Ends -->
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/client/job/edit/job-budget.blade.php ENDPATH**/ ?>