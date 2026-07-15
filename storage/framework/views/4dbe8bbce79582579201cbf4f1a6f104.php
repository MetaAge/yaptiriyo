<!-- About Job Start -->
<div class="setup-wrapper-contents active">
    <div class="setup-wrapper-contents-item">
        <div class="setup-bank-form">
            <?php if (isset($component)) { $__componentOriginal2497cd08ed4b80389f11a0f1101e9ba2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2497cd08ed4b80389f11a0f1101e9ba2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.text','data' => ['title' => __('Job Title'),'type' => 'text','id' => 'title','name' => 'title','divClass' => 'mb-0','class' => 'form--control','value' => $job_details->title ?? old('title'),'placeholder' => __('e.g. I need  landing page')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Job Title')),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('text'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('title'),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('title'),'divClass' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('mb-0'),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('form--control'),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($job_details->title ?? old('title')),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('e.g. I need  landing page'))]); ?>
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
            <span id="job_title_char_length_check"></span>

            <?php if (isset($component)) { $__componentOriginal2497cd08ed4b80389f11a0f1101e9ba2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2497cd08ed4b80389f11a0f1101e9ba2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.text','data' => ['title' => __('Slug'),'type' => 'text','id' => 'slug','name' => 'slug','value' => $job_details->slug ?? old('slug'),'divClass' => 'mb-0','class' => 'form--control d-none','labelClass' => 'd-none display_label_title','placeholder' => __('Slug')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Slug')),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('text'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('slug'),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('slug'),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($job_details->slug ?? old('slug')),'divClass' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('mb-0'),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('form--control d-none'),'labelClass' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('d-none display_label_title'),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Slug'))]); ?>
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

            <div class="mb-1">
                <strong><?php echo e(__('Slug:')); ?></strong>
                <span class="full-slug-show"></span>
                <span class="edit_job_slug"><i class="fas fa-edit"></i></span>
            </div>

            <div class="single-input mt-3">
                <label class="label-title"><?php echo e(__('Select Category')); ?></label>
                <select name="category" id="category" class="form-control category_select2">
                    <?php $__currentLoopData = \Modules\Service\Entities\Category::all_categories(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($data->id); ?>" <?php if($job_details->category == $data->id): ?> selected <?php endif; ?>>
                            <?php echo e($data->category); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="single-input">
                <label class="label-title"><?php echo e(__('Select Subcategory')); ?></label>
                <select name="subcategory[]" id="subcategory" class="form-control get_subcategory subcategory_select2"
                    multiple>
                    <?php $__currentLoopData = $get_sub_categories_from_job_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option
                            <?php $__currentLoopData = $job_details->job_sub_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job_subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($job_subcategory->id === $subcategory->id ? 'selected' : ''); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            value="<?php echo e($subcategory->id); ?>"><?php echo e($subcategory->sub_category); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <span id="subcategory_info"></span>
            </div>

            <?php if($all_lengths->count() >= 1): ?>
                <div class="single-input">
                    <label class="label-title"><?php echo e(__('Job duration')); ?></label>
                    <select name="duration" id="duration" class="form-control">
                        <?php $__currentLoopData = $all_lengths; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $length): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($length->length); ?>" <?php if($job_details->duration == $length->length): ?> selected <?php endif; ?>>
                                <?php echo e($length->length); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            <?php else: ?>
                <div class="single-input">
                    <label class="label-title"><?php echo e(__('Job duration')); ?></label>
                    <select name="duration" id="duration" class="form-control">
                        <option value="1 Days" <?php if($job_details->duration == '1 Days'): ?> selected <?php endif; ?>><?php echo e(__('1 Days')); ?>

                        </option>
                        <option value="2 Days" <?php if($job_details->duration == '2 Days'): ?> selected <?php endif; ?>><?php echo e(__('2 Days')); ?>

                        </option>
                        <option value="3 Days" <?php if($job_details->duration == '3 Days'): ?> selected <?php endif; ?>><?php echo e(__('3 Days')); ?>

                        </option>
                        <option value="less than a week" <?php if($job_details->duration == 'less than a week'): ?> selected <?php endif; ?>>
                            <?php echo e(__('Less than a Week')); ?></option>
                        <option value="less than a month" <?php if($job_details->duration == 'less than a month'): ?> selected <?php endif; ?>>
                            <?php echo e(__('Less than a month')); ?></option>
                        <option value="less than 2 month" <?php if($job_details->duration == 'less than 2 month'): ?> selected <?php endif; ?>>
                            <?php echo e(__('Less than 2 month')); ?></option>
                        <option value="less than 3 month" <?php if($job_details->duration == 'less than 3 month'): ?> selected <?php endif; ?>>
                            <?php echo e(__('Less than 3 month')); ?></option>
                        <option value="More than 3 month" <?php if($job_details->duration == 'More than 3 month'): ?> selected <?php endif; ?>>
                            <?php echo e(__('More than 3 month')); ?></option>
                    </select>
                </div>
            <?php endif; ?>

            <?php if($all_levels->count() >= 1): ?>
                <div class="single-input">
                    <label class="label-title"><?php echo e(__('Choose experience level')); ?></label>
                    <select name="level" id="level" class="form-control">
                        <?php $__currentLoopData = $all_levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($level->level); ?>" <?php if($job_details->level == $level->level): ?> selected <?php endif; ?>>
                                <?php echo e($level->level); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            <?php else: ?>
                <div class="single-input">
                    <label class="label-title"><?php echo e(__('Choose experience level')); ?></label>
                    <select name="level" id="level" class="form-control">
                        <option value="junior" <?php if($job_details->level == 'junior'): ?> selected <?php endif; ?>><?php echo e(__('Junior')); ?>

                        </option>
                        <option value="midLevel" <?php if($job_details->level == 'midLevel'): ?> selected <?php endif; ?>>
                            <?php echo e(__('MidLevel')); ?></option>
                        <option value="senior" <?php if($job_details->level == 'senior'): ?> selected <?php endif; ?>><?php echo e(__('Senior')); ?>

                        </option>
                        <option value="not mandatory" <?php if($job_details->level == 'not mandatory'): ?> selected <?php endif; ?>>
                            <?php echo e(__('Not Mandatory')); ?></option>
                    </select>
                </div>
            <?php endif; ?>

            <?php
                $restrictionEnabled = get_static_option('job_country_restriction_enabled', 0);
            ?>

            <?php if($restrictionEnabled): ?>
                <div class="country-restrictions-section mt-4">
                    <h5 class="label-title mb-3"><?php echo e(__('Freelancer Location Requirements')); ?></h5>

                    <div class="single-input">
                        <label class="label-title"><?php echo e(__('Location Restriction Type')); ?></label>
                        <select name="country_restriction_type" id="country_restriction_type" class="form-control">
                            <option value="none"
                                <?php echo e($job_details->country_restriction_type == 'none' ? 'selected' : ''); ?>>
                                <?php echo e(__('No Location Restrictions (Global)')); ?>

                            </option>
                            <option value="include"
                                <?php echo e($job_details->country_restriction_type == 'include' ? 'selected' : ''); ?>>
                                <?php echo e(__('Only Allow Specific Countries')); ?>

                            </option>
                            <option value="exclude"
                                <?php echo e($job_details->country_restriction_type == 'exclude' ? 'selected' : ''); ?>>
                                <?php echo e(__('Exclude Specific Countries')); ?>

                            </option>
                        </select>
                        <small class="form-text text-muted">
                            <?php echo e(__('Choose how you want to restrict freelancer locations for this job')); ?>

                        </small>
                    </div>

                    <!-- Include Countries Section -->
                    <div class="single-input country-selection-wrapper" id="include_countries_wrapper"
                        style="<?php echo e($job_details->country_restriction_type == 'include' ? '' : 'display: none;'); ?>">
                        <label class="label-title">
                            <?php echo e(__('Select Allowed Countries')); ?>

                            <span
                                class="text-success">(<?php echo e(__('Only freelancers from these countries can apply')); ?>)</span>
                        </label>
                        <select name="allowed_countries[]" id="allowed_countries"
                            class="form-control allowed_countries_select2" multiple>
                            <?php $__currentLoopData = \Modules\CountryManage\Entities\Country::all_countries(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($country->id); ?>"
                                    <?php echo e(in_array($country->id, $job_details->allowed_countries ?? []) ? 'selected' : ''); ?>>
                                    <?php echo e($country->country); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Exclude Countries Section -->
                    <div class="single-input country-selection-wrapper" id="exclude_countries_wrapper"
                        style="<?php echo e($job_details->country_restriction_type == 'exclude' ? '' : 'display: none;'); ?>">
                        <label class="label-title">
                            <?php echo e(__('Select Excluded Countries')); ?>

                            <span
                                class="text-danger">(<?php echo e(__('Freelancers from these countries cannot apply')); ?>)</span>
                        </label>
                        <select name="excluded_countries[]" id="excluded_countries"
                            class="form-control excluded_countries_select2" multiple>
                            <option></option>
                            <?php $__currentLoopData = \Modules\CountryManage\Entities\Country::all_countries(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($country->id); ?>"
                                    <?php echo e(in_array($country->id, $job_details->excluded_countries ?? []) ? 'selected' : ''); ?>>
                                    <?php echo e($country->country); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Preview Section -->
                    <div class="country-preview mt-3" id="country_preview" style="display: none;">
                        <div class="alert alert-info">
                            <strong><?php echo e(__('Preview:')); ?></strong>
                            <span id="country_preview_text"></span>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (isset($component)) { $__componentOriginalc90a87905706cb9b5d0ad735e5b8e7c5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc90a87905706cb9b5d0ad735e5b8e7c5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.summernote','data' => ['title' => __('Write a job description'),'name' => 'description','id' => 'description','rows' => '10','cols' => 30,'value' => $job_details->description ?? old('description'),'class' => 'description ']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.summernote'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Write a job description')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('description'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('description'),'rows' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('10'),'cols' => 30,'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($job_details->description ?? old('description')),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('description ')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc90a87905706cb9b5d0ad735e5b8e7c5)): ?>
<?php $attributes = $__attributesOriginalc90a87905706cb9b5d0ad735e5b8e7c5; ?>
<?php unset($__attributesOriginalc90a87905706cb9b5d0ad735e5b8e7c5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc90a87905706cb9b5d0ad735e5b8e7c5)): ?>
<?php $component = $__componentOriginalc90a87905706cb9b5d0ad735e5b8e7c5; ?>
<?php unset($__componentOriginalc90a87905706cb9b5d0ad735e5b8e7c5); ?>
<?php endif; ?>
            <span id="job_description_char_length_check"></span>

            <?php if (isset($component)) { $__componentOriginal2497cd08ed4b80389f11a0f1101e9ba2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2497cd08ed4b80389f11a0f1101e9ba2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.text','data' => ['title' => __('Meta Title - ideal length is 50–60 characters (optional)'),'type' => 'text','id' => 'meta_title','name' => 'meta_title','divClass' => 'mb-0','class' => 'form--control','value' => $job_details->meta_title ?? old('meta_title'),'placeholder' => __('Enter meta title')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Meta Title - ideal length is 50–60 characters (optional)')),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('text'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('meta_title'),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('meta_title'),'divClass' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('mb-0'),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('form--control'),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($job_details->meta_title ?? old('meta_title')),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Enter meta title'))]); ?>
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

            <div class="single-input">
                <label
                    class="label-title"><?php echo e(__('Meta Description - ideal length is 150-160 characters (optional)')); ?></label>
                <textarea name="meta_description" id="meta_description" class="form-message" cols="30" rows="3"
                    placeholder="<?php echo e(__('Enter meta description')); ?>"><?php echo e($job_details->meta_description ?? ''); ?></textarea>
            </div>

        </div>
    </div>
</div>
<!-- About Job Ends -->
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/client/job/edit/job-details.blade.php ENDPATH**/ ?>