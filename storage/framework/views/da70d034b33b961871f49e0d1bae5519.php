<!-- Project Introduction Start -->
<div class="setup-wrapper-contents active">
    <div class="create-project-wrapper-item">
        <div class="create-project-wrapper-item-top profile-border-bottom">
            <h4 class="create-project-wrapper-title"><?php echo e(__('Project Intro')); ?></h4>
        </div>
        <div class="create-project-intro-contents">
            <div class="create-project-intro-contents-form custom-form">
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
                    <select name="subcategory[]" id="subcategory" class="form-control get_subcategory subcategory_select2" multiple>
                    </select>
                    <span id="subcategory_info"></span>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <?php if (isset($component)) { $__componentOriginal516dbd59f81d12312a6824830d51c000 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal516dbd59f81d12312a6824830d51c000 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.country-dropdown','data' => ['title' => __('Service Country'),'name' => 'country_id','id' => 'country_id','class' => 'form-control country_select2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.country-dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Service Country')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('country_id'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('country_id'),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('form-control country_select2')]); ?>
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
                    <div class="col-md-4">
                        <div class="single-input">
                            <label class="label-title"><?php echo e(__('Service State/Province')); ?></label>
                            <select name="state_id" id="state_id" class="form-control state_select2 get_state_city">
                                <option value=""><?php echo e(__('Select State')); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-input">
                            <label class="label-title"><?php echo e(__('Service City/District')); ?></label>
                            <select name="city_id" id="city_id" class="form-control city_select2">
                                <option value=""><?php echo e(__('Select City')); ?></option>
                            </select>
                        </div>
                    </div>
                </div>


               <?php if (isset($component)) { $__componentOriginal2497cd08ed4b80389f11a0f1101e9ba2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2497cd08ed4b80389f11a0f1101e9ba2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.text','data' => ['title' => __('What are you offering to clients?'),'type' => 'text','id' => 'project_title','name' => 'project_title','divClass' => 'mb-0','class' => 'form--control','value' => old('project_title'),'placeholder' => __('You’ll get a Mobile application designed')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('What are you offering to clients?')),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('text'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('project_title'),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('project_title'),'divClass' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('mb-0'),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('form--control'),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('project_title')),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('You’ll get a Mobile application designed'))]); ?>
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
                <span id="project_title_char_length_check"></span>
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
                <div class="mb-4">
                    <strong><?php echo e(__('Slug:')); ?></strong>
                    <span class="full-slug-show"></span>
                    <span class="edit_project_slug"><i class="fas fa-edit"></i></span>
                </div>


                <?php if (isset($component)) { $__componentOriginalc90a87905706cb9b5d0ad735e5b8e7c5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc90a87905706cb9b5d0ad735e5b8e7c5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.summernote','data' => ['title' => __('Write a description about your service'),'name' => 'project_description','id' => 'project_description','rows' => '10','cols' => 30,'value' => old('project_description'),'class' => 'description']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.summernote'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Write a description about your service')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('project_description'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('project_description'),'rows' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('10'),'cols' => 30,'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('project_description')),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('description')]); ?>
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
                <span id="project_description_char_length_check"></span>

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
                    <label class="label-title"><?php echo e(__('Meta Description - ideal length is 150-160 characters (optional)')); ?></label>
                    <textarea name="meta_description" id="meta_description" class="form-message" cols="30" rows="3" placeholder="<?php echo e(__('Enter meta description')); ?>"></textarea>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Project Introduction Ends -->
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/freelancer/project/create/project-introduction.blade.php ENDPATH**/ ?>