<!-- About Job Start -->
<div class="setup-wrapper-contents active">
    <div class="setup-wrapper-contents-item">
        <div class="setup-bank-form">
            <?php if (isset($component)) { $__componentOriginal2497cd08ed4b80389f11a0f1101e9ba2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2497cd08ed4b80389f11a0f1101e9ba2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.text','data' => ['title' => __('Job Title'),'type' => 'text','id' => 'title','name' => 'title','divClass' => 'mb-0','class' => 'form--control','value' => old('title'),'placeholder' => __('e.g. I need  landing page')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Job Title')),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('text'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('title'),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('title'),'divClass' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('mb-0'),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('form--control'),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('title')),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('e.g. I need  landing page'))]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.text','data' => ['title' => __('Slug'),'type' => 'text','id' => 'slug','name' => 'slug','value' => old('slug'),'divClass' => 'mb-0','class' => 'form--control d-none','labelClass' => 'd-none display_label_title','placeholder' => __('Slug')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Slug')),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('text'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('slug'),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('slug'),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('slug')),'divClass' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('mb-0'),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('form--control d-none'),'labelClass' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('d-none display_label_title'),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Slug'))]); ?>
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
            <div class="mb-0">

                <strong><?php echo e(__('Slug:')); ?></strong>
                <span class="full-slug-show"></span>
                <span class="edit_job_slug"><i class="fas fa-edit"></i></span>
            </div>

            <?php if (isset($component)) { $__componentOriginal84806209167b80946d2b24ff70d8da26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal84806209167b80946d2b24ff70d8da26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.category-dropdown','data' => ['title' => __('Select Category'),'name' => 'category','id' => 'category','class' => 'form-control category_select2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.category-dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Select Category')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('category'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('category'),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('form-control category_select2')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal84806209167b80946d2b24ff70d8da26)): ?>
<?php $attributes = $__attributesOriginal84806209167b80946d2b24ff70d8da26; ?>
<?php unset($__attributesOriginal84806209167b80946d2b24ff70d8da26); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal84806209167b80946d2b24ff70d8da26)): ?>
<?php $component = $__componentOriginal84806209167b80946d2b24ff70d8da26; ?>
<?php unset($__componentOriginal84806209167b80946d2b24ff70d8da26); ?>
<?php endif; ?>

            <div class="single-input">
                <label class="label-title"><?php echo e(__('Select Subcategory')); ?></label>
                <select name="subcategory[]" id="subcategory" class="form-control get_subcategory subcategory_select2"
                    multiple>
                </select>

                <span id="subcategory_info"></span>
            </div>

            <?php if($all_lengths->count() >= 1): ?>
                <div class="single-input">
                    <label class="label-title"><?php echo e(__('Job duration')); ?></label>
                    <select name="duration" id="duration" class="form-control">
                        <option value=""><?php echo e(__('Select Duration')); ?></option>
                        <?php $__currentLoopData = $all_lengths; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $length): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($length->length); ?>"><?php echo e(ucfirst($length->length)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            <?php else: ?>
                <div class="single-input">
                    <label class="label-title"><?php echo e(__('Job duration')); ?></label>
                    <select name="duration" id="duration" class="form-control">
                        <option value=""><?php echo e(__('Select Duration')); ?></option>
                        <option value="1 Days"><?php echo e(__('1 Days')); ?></option>
                        <option value="1 Days"><?php echo e(__('2 Days')); ?></option>
                        <option value="1 Days"><?php echo e(__('3 Days')); ?></option>
                        <option value="less than a week"><?php echo e(__('Less than a Week')); ?></option>
                        <option value="less than a month"><?php echo e(__('Less than a month')); ?></option>
                        <option value="less than 2 month"><?php echo e(__('Less than 2 month')); ?></option>
                        <option value="less than 3 month"><?php echo e(__('Less than 3 month')); ?></option>
                        <option value="More than 3 month"><?php echo e(__('More than 3 month')); ?></option>
                    </select>
                </div>
            <?php endif; ?>
            <?php if (isset($component)) { $__componentOriginalb58b98ca8f8917e4010335f53c8e524c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb58b98ca8f8917e4010335f53c8e524c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.experience-level-dropdown','data' => ['title' => __('Select Experience Level'),'class' => 'form-control','name' => 'level','id' => 'level']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.experience-level-dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Select Experience Level')),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('form-control'),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('level'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('level')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb58b98ca8f8917e4010335f53c8e524c)): ?>
<?php $attributes = $__attributesOriginalb58b98ca8f8917e4010335f53c8e524c; ?>
<?php unset($__attributesOriginalb58b98ca8f8917e4010335f53c8e524c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb58b98ca8f8917e4010335f53c8e524c)): ?>
<?php $component = $__componentOriginalb58b98ca8f8917e4010335f53c8e524c; ?>
<?php unset($__componentOriginalb58b98ca8f8917e4010335f53c8e524c); ?>
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
                            <option value="none"><?php echo e(__('No Location Restrictions (Global)')); ?></option>
                            <option value="include"><?php echo e(__('Only Allow Specific Countries')); ?></option>
                            <option value="exclude"><?php echo e(__('Exclude Specific Countries')); ?></option>
                        </select>
                        <small class="form-text text-muted">
                            <?php echo e(__('Choose how you want to restrict freelancer locations for this job')); ?>

                        </small>
                    </div>

                    <!-- Include Countries Section -->
                    <div class="single-input country-selection-wrapper" id="include_countries_wrapper"
                        style="display: none;">
                        <label class="label-title">
                            <?php echo e(__('Select Allowed Countries')); ?>

                            <span class="text-success">(<?php echo e(__('Only freelancers from these countries can apply')); ?>)</span>
                        </label>
                        <select name="allowed_countries[]" id="allowed_countries"
                            class="form-control allowed_countries_select2" multiple>
                            <?php $__currentLoopData = $all_countries = \Modules\CountryManage\Entities\Country::all_countries(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($country->id); ?>"><?php echo e($country->country); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <small class="form-text text-muted">
                            <?php echo e(__('Select one or more countries. Only freelancers from these countries will see and can apply to this job.')); ?>

                        </small>
                    </div>

                    <!-- Exclude Countries Section -->
                    <div class="single-input country-selection-wrapper" id="exclude_countries_wrapper"
                        style="display: none;">
                        <label class="label-title">
                            <?php echo e(__('Select Excluded Countries')); ?>

                            <span class="text-danger">(<?php echo e(__('Freelancers from these countries cannot apply')); ?>)</span>
                        </label>
                        <select name="excluded_countries[]" id="excluded_countries"
                            class="form-control excluded_countries_select2" multiple>
                            <?php $__currentLoopData = $all_countries = \Modules\CountryManage\Entities\Country::all_countries(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($country->id); ?>"><?php echo e($country->country); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <small class="form-text text-muted">
                            <?php echo e(__('Select countries to exclude. Freelancers from these countries will not see or be able to apply to this job.')); ?>

                        </small>
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


            <div class="single-input mb-4 mt-4">
                <label class="label-title flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_urgent" value="1" class="w-5 h-5 accent-primary">
                    <span class="font-bold text-red-600 uppercase tracking-wide"><i class="fa-solid fa-bolt"></i> <?php echo e(__('Bu bir ACİL İŞ talebidir')); ?></span>
                </label>
                <small class="text-gray-500 font-medium"><?php echo e(__('Acil işler ustalara öncelikli bildirim olarak gider ve listede vurgulanır.')); ?></small>
            </div>

            <?php if (isset($component)) { $__componentOriginalc90a87905706cb9b5d0ad735e5b8e7c5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc90a87905706cb9b5d0ad735e5b8e7c5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.summernote','data' => ['title' => __('Write a job description'),'name' => 'description','id' => 'description','rows' => '10','cols' => 30,'value' => old('description'),'class' => 'description ']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.summernote'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Write a job description')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('description'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('description'),'rows' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('10'),'cols' => 30,'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('description')),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('description ')]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.text','data' => ['title' => __('Meta Title - ideal length is 50–60 characters (optional)'),'type' => 'text','id' => 'meta_title','name' => 'meta_title','divClass' => 'mb-0','class' => 'form--control','value' => old('meta_title'),'placeholder' => __('Enter meta title')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Meta Title - ideal length is 50–60 characters (optional)')),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('text'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('meta_title'),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('meta_title'),'divClass' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('mb-0'),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('form--control'),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('meta_title')),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Enter meta title'))]); ?>
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
                    placeholder="<?php echo e(__('Enter meta description')); ?>"></textarea>
            </div>

        </div>
    </div>
</div>
<!-- About Job Ends -->
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/client/job/create/job-details.blade.php ENDPATH**/ ?>