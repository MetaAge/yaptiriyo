<?php $__env->startSection('title', __('Edit Page')); ?>

<?php $__env->startSection('style'); ?>
    <?php if (isset($component)) { $__componentOriginalbc1bcd20222d67be5eb46ea1d22a74fa = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbc1bcd20222d67be5eb46ea1d22a74fa = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('media.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbc1bcd20222d67be5eb46ea1d22a74fa)): ?>
<?php $attributes = $__attributesOriginalbc1bcd20222d67be5eb46ea1d22a74fa; ?>
<?php unset($__attributesOriginalbc1bcd20222d67be5eb46ea1d22a74fa); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbc1bcd20222d67be5eb46ea1d22a74fa)): ?>
<?php $component = $__componentOriginalbc1bcd20222d67be5eb46ea1d22a74fa; ?>
<?php unset($__componentOriginalbc1bcd20222d67be5eb46ea1d22a74fa); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalc9b7b8cd21a48778d8b7d695ecb54651 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc9b7b8cd21a48778d8b7d695ecb54651 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.summernote.summernote-css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('summernote.summernote-css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc9b7b8cd21a48778d8b7d695ecb54651)): ?>
<?php $attributes = $__attributesOriginalc9b7b8cd21a48778d8b7d695ecb54651; ?>
<?php unset($__attributesOriginalc9b7b8cd21a48778d8b7d695ecb54651); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc9b7b8cd21a48778d8b7d695ecb54651)): ?>
<?php $component = $__componentOriginalc9b7b8cd21a48778d8b7d695ecb54651; ?>
<?php unset($__componentOriginalc9b7b8cd21a48778d8b7d695ecb54651); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginald7d7479a16c5c1420f367f37a6526855 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald7d7479a16c5c1420f367f37a6526855 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.tags.tag-input-css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('tags.tag-input-css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald7d7479a16c5c1420f367f37a6526855)): ?>
<?php $attributes = $__attributesOriginald7d7479a16c5c1420f367f37a6526855; ?>
<?php unset($__attributesOriginald7d7479a16c5c1420f367f37a6526855); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald7d7479a16c5c1420f367f37a6526855)): ?>
<?php $component = $__componentOriginald7d7479a16c5c1420f367f37a6526855; ?>
<?php unset($__componentOriginald7d7479a16c5c1420f367f37a6526855); ?>
<?php endif; ?>
    <style>
        .img-select {
            position: relative;
        }
        .img-select.selected:after {
            position: absolute;
            left: 0px;
            top: 0;
            z-index: 1;
            color: #fff;
            content: "\f058";
            font-size: 30px;
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            line-height: 30px;
            width: 40px;
            height: 40px;
            background-color: #007bff;
            padding-left: 5px;
            padding-top: 4px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="dashboard__body">
        <form action="<?php echo e(route('admin.edit.page',$page_details->id)); ?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-8">
                    <div class="customMarkup__single">
                        <div class="customMarkup__single__item">
                            <h4 class="customMarkup__single__title"><?php echo e(__('Edit Page')); ?></h4>
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
                            <div class="customMarkup__single__inner mt-4">
                                <?php echo csrf_field(); ?>
                                <div class="tab-content margin-top-40">
                                    <div class="single-input">
                                        <label for="title" class="label-title mt-3"><?php echo e(__('Title')); ?></label>
                                        <input type="text" class="form-control" name="title" id="title" value="<?php echo e($page_details->title ?? ''); ?>" placeholder="<?php echo e(__('Title')); ?>" id="title">
                                    </div>
                                    <div class="single-input">
                                        <label for="slug" class="label-title mt-3"><?php echo e(__('Slug')); ?></label>
                                        <input type="text" class="form-control" name="slug" id="slug" value="<?php echo e($page_details->slug ?? ''); ?>" placeholder="<?php echo e(__('Slug')); ?>" id="title">
                                        <span class="full-slug-show"></span>
                                    </div>
                                    <div class="single-input mb-3 page_content_wrapper <?php if($page_details->page_builder_status == 'on'): ?> d-none <?php endif; ?>">
                                        <label for="content" class="label-title mt-3"><?php echo e(__('Content')); ?></label>
                                        <div class="summernote-wrapper">
                                            <textarea id="content" name="page_content"  class="form-control summernote">
                                                <?php echo $page_details->page_content; ?>

                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <?php if (isset($component)) { $__componentOriginal11ece23f9f2a4fcd51f22d3871b2d35e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal11ece23f9f2a4fcd51f22d3871b2d35e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.edit-page-meta-data','data' => ['sidebarHeading' => __('Edit Page Meta'),'pageDetails' => $page_details]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.edit-page-meta-data'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['sidebarHeading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Edit Page Meta')),'pageDetails' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($page_details)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal11ece23f9f2a4fcd51f22d3871b2d35e)): ?>
<?php $attributes = $__attributesOriginal11ece23f9f2a4fcd51f22d3871b2d35e; ?>
<?php unset($__attributesOriginal11ece23f9f2a4fcd51f22d3871b2d35e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal11ece23f9f2a4fcd51f22d3871b2d35e)): ?>
<?php $component = $__componentOriginal11ece23f9f2a4fcd51f22d3871b2d35e; ?>
<?php unset($__componentOriginal11ece23f9f2a4fcd51f22d3871b2d35e); ?>
<?php endif; ?>
                                </div>

                                <div class="single-input mb-3">
                                    <label for="navbar_variant" class="label-title mt-5"><?php echo e(__('Navbar Variant')); ?></label>
                                    <input type="hidden" class="form-control" id="navbar_variant" value="<?php echo e($page_details->navbar_variant); ?>" name="navbar_variant">
                                    <div class="row">
                                        <?php if(moduleExists('CoinPaymentGateway')): ?>
                                            <?php for($i = 1; $i <=3; $i++): ?>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="img-select img-select-navbar <?php if($page_details->navbar_variant == $i ): ?> selected <?php endif; ?>">
                                                        <div class="img-wrap">
                                                            <img src="<?php echo e(asset('assets/frontend/navbar-variant/'.$i.'.jpg')); ?>" data-home_id="0<?php echo e($i); ?>" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endfor; ?>
                                        <?php else: ?>
                                            <?php for($i = 1; $i <=1; $i++): ?>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="img-select img-select-navbar <?php if($page_details->navbar_variant == $i ): ?> selected <?php endif; ?>">
                                                        <div class="img-wrap">
                                                            <img src="<?php echo e(asset('assets/frontend/navbar-variant/'.$i.'.jpg')); ?>" data-home_id="0<?php echo e($i); ?>" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endfor; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="single-input mb-3">
                                    <label for="footer_variant" class="label-title mt-5"><?php echo e(__('Footer Variant')); ?></label>
                                    <input type="hidden" class="form-control" id="footer_variant" value="<?php echo e($page_details->footer_variant); ?>" name="footer_variant">
                                    <div class="row">
                                        <?php for($i = 1; $i <=4; $i++): ?>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="img-select img-select-footer <?php if($page_details->footer_variant == $i ): ?> selected <?php endif; ?>">
                                                    <div class="img-wrap">
                                                        <img src="<?php echo e(asset('assets/frontend/footer-variant/'.$i.'.png')); ?>" data-home_id="0<?php echo e($i); ?>" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="customMarkup__single">
                        <div class="customMarkup__single__item">
                            <div class="customMarkup__single__inner mt-4">
                                <?php echo csrf_field(); ?>
                                <div class="tab-content margin-top-40">
                                    <div class="switch">
                                        <label class="label-title mt-3"><strong><?php echo e(__('Page Builder Enable/Disable')); ?></strong></label>
                                        <input class="custom-switch" type="checkbox" id="page_builder_status" name="page_builder_status" <?php if(isset($page_details->page_builder_status)): ?> checked <?php endif; ?>>
                                        <label class="switch-label" for="page_builder_status"><?php echo e(__('Page Builder Enable/Disable')); ?></label>
                                    </div>

                                    <div class="page-builder-area-wrapper <?php if(empty($page_details->page_builder_status)): ?> d-none <?php endif; ?>">
                                        <div class="single-input col-md-12 mt-3">
                                            <div class="btn-wrapper page-builder-btn-wrapper">
                                                <a href="<?php echo e(route('admin.dynamic.page.builder',['type' =>'dynamic-page','id' => $page_details->id])); ?>" class="btn btn-primary"><?php echo e(__('Open Page Builder')); ?></a> <br>
                                                <small class="info-text"><?php echo e(__('Page builder option is available in page edit only')); ?></small>
                                            </div>
                                        </div>
                                        <div class="single-input col-md-12 layout">
                                            <label class="label-title mt-3"><?php echo e(__('Page Layout')); ?></label>
                                            <select name="layout" class="form-control">
                                                <option value="normal_layout" <?php if($page_details->layout == 'normal_layout'): ?> selected <?php endif; ?>><?php echo e(__('Normal Layout')); ?></option>
                                                <option value="home_page_layout" <?php if($page_details->layout == 'home_page_layout'): ?>selected  <?php endif; ?>><?php echo e(__('Home Page')); ?></option>
                                            </select>
                                        </div>
                                        <div class="single-input col-md-12 page_class">
                                            <label class="label-title mt-3"><?php echo e(__('Page Class')); ?></label>
                                            <select name="page_class" class="form-control">
                                                <option value="none" <?php if($page_details->page_class == 'none'): ?>selected <?php endif; ?>><?php echo e(__('None')); ?></option>
                                                <option value="nav-absolute" <?php if($page_details->page_class == 'nav-absolute'): ?>selected <?php endif; ?>><?php echo e(__('Custom Class')); ?></option>
                                            </select>
                                            <small class=""><?php echo e(__('Adjust page frontend view selecting by none or custom class')); ?></small>
                                        </div>
                                    </div>

                                    <div class="switch">
                                        <label class="label-title mt-3"><strong><?php echo e(__('Breadcrumb Show/Hide')); ?></strong></label>
                                        <input class="custom-switch" type="checkbox" id="breadcrumb_status" name="breadcrumb_status" <?php if(!empty($page_details->breadcrumb_status)): ?> checked <?php endif; ?>>
                                        <label class="switch-label" for="breadcrumb_status"><?php echo e(__('Breadcrumb Show/Hide')); ?></label>
                                    </div>
                                    <div class="single-input">
                                        <label class="label-title mt-3"><?php echo e(__('Visibility')); ?></label>
                                        <select name="visibility" class="form-control">
                                            <option value="all" <?php if($page_details->visibility == 'all'): ?>selected <?php endif; ?>><?php echo e(__('All')); ?></option>
                                            <option value="user" <?php if($page_details->visibility == 'user'): ?>selected <?php endif; ?>><?php echo e(__('Only Logged In User')); ?></option>
                                        </select>
                                    </div>
                                    <?php if (isset($component)) { $__componentOriginal00c565aaa2fbaa763cb49063e021417a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal00c565aaa2fbaa763cb49063e021417a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status.form.active-inactive','data' => ['title' => 'Status','status' => $page_details->status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status.form.active-inactive'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Status'),'status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($page_details->status)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal00c565aaa2fbaa763cb49063e021417a)): ?>
<?php $attributes = $__attributesOriginal00c565aaa2fbaa763cb49063e021417a; ?>
<?php unset($__attributesOriginal00c565aaa2fbaa763cb49063e021417a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal00c565aaa2fbaa763cb49063e021417a)): ?>
<?php $component = $__componentOriginal00c565aaa2fbaa763cb49063e021417a; ?>
<?php unset($__componentOriginal00c565aaa2fbaa763cb49063e021417a); ?>
<?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page-update')): ?>
                                        <?php if (isset($component)) { $__componentOriginald51d03ac38950c6ca9fceee323ea1e0d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald51d03ac38950c6ca9fceee323ea1e0d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn.submit','data' => ['title' => 'Update','class' => 'btn btn-primary mt-4 pr-4 pl-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn.submit'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Update'),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('btn btn-primary mt-4 pr-4 pl-4')]); ?>
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
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php if (isset($component)) { $__componentOriginal0a0c44ec0e77c6e781a03c2fda86fc75 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0a0c44ec0e77c6e781a03c2fda86fc75 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.markup','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('media.markup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0a0c44ec0e77c6e781a03c2fda86fc75)): ?>
<?php $attributes = $__attributesOriginal0a0c44ec0e77c6e781a03c2fda86fc75; ?>
<?php unset($__attributesOriginal0a0c44ec0e77c6e781a03c2fda86fc75); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0a0c44ec0e77c6e781a03c2fda86fc75)): ?>
<?php $component = $__componentOriginal0a0c44ec0e77c6e781a03c2fda86fc75; ?>
<?php unset($__componentOriginal0a0c44ec0e77c6e781a03c2fda86fc75); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php if (isset($component)) { $__componentOriginal9c9e2f22010721f1a8a11abf87b15b5e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9c9e2f22010721f1a8a11abf87b15b5e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('media.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9c9e2f22010721f1a8a11abf87b15b5e)): ?>
<?php $attributes = $__attributesOriginal9c9e2f22010721f1a8a11abf87b15b5e; ?>
<?php unset($__attributesOriginal9c9e2f22010721f1a8a11abf87b15b5e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9c9e2f22010721f1a8a11abf87b15b5e)): ?>
<?php $component = $__componentOriginal9c9e2f22010721f1a8a11abf87b15b5e; ?>
<?php unset($__componentOriginal9c9e2f22010721f1a8a11abf87b15b5e); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalc522360e2a07084453b413c76e27c7e9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc522360e2a07084453b413c76e27c7e9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.summernote.summernote-js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('summernote.summernote-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc522360e2a07084453b413c76e27c7e9)): ?>
<?php $attributes = $__attributesOriginalc522360e2a07084453b413c76e27c7e9; ?>
<?php unset($__attributesOriginalc522360e2a07084453b413c76e27c7e9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc522360e2a07084453b413c76e27c7e9)): ?>
<?php $component = $__componentOriginalc522360e2a07084453b413c76e27c7e9; ?>
<?php unset($__componentOriginalc522360e2a07084453b413c76e27c7e9); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginala3fd0630714c82531b8dc1a28d2789cb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala3fd0630714c82531b8dc1a28d2789cb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.tags.tag-input-js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('tags.tag-input-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala3fd0630714c82531b8dc1a28d2789cb)): ?>
<?php $attributes = $__attributesOriginala3fd0630714c82531b8dc1a28d2789cb; ?>
<?php unset($__attributesOriginala3fd0630714c82531b8dc1a28d2789cb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala3fd0630714c82531b8dc1a28d2789cb)): ?>
<?php $component = $__componentOriginala3fd0630714c82531b8dc1a28d2789cb; ?>
<?php unset($__componentOriginala3fd0630714c82531b8dc1a28d2789cb); ?>
<?php endif; ?>
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){
                //page builder
                $(document).on('change','input[name="page_builder_status"]',function(){
                    if($(this).is(':checked')){
                        $('.page-builder-area-wrapper').removeClass('d-none');
                        $('.page_content_wrapper').addClass('d-none');
                    }else {
                        $('.page-builder-area-wrapper').addClass('d-none');
                        $('.page_content_wrapper').removeClass('d-none');

                    }
                });

                //slug
                $('.full-slug-show').text(`<?php echo e(url('/')); ?>/` + '<?php echo e($page_details->slug); ?>');
                function makeSlug(slug){
                    let finalSlug = slug.replace(/[^a-zA-Z0-9]/g, ' ');
                    finalSlug = slug.replace(/  +/g, ' ');
                    finalSlug = slug.replace(/\s/g, '-').toLowerCase().replace(/[^\w-]+/g, '-');
                    return finalSlug;
                }

                $(document).on('keyup', '#slug', function (e) {
                    let slug = makeSlug($(this).val());
                    let url = `<?php echo e(url('/')); ?>/` + slug;
                    $('.full-slug-show').text(url);
                });

                //For Navbar
                function navbar_variant(){
                    let imgSelect = $('.img-select');
                    let id = $('#navbar_variant').val();
                    imgSelect.removeClass('selected');
                    $('img[data-home_id="'+id+'"]').parent().parent().addClass('selected');
                    $(document).on('click','.img-select-navbar img',function (e) {
                        e.preventDefault();
                        imgSelect.removeClass('selected');
                        $(this).parent().parent().addClass('selected').siblings();
                        $('#navbar_variant').val($(this).data('home_id'));
                    })
                }
                navbar_variant();

                //For Footer
                function footer_variant(){
                    let imgSelect = $('.img-select');
                    let id = $('#footer_variant').val();
                    imgSelect.removeClass('selected');
                    $('img[data-home_id="'+id+'"]').parent().parent().addClass('selected');
                    $(document).on('click','.img-select-footer img',function (e) {
                        e.preventDefault();
                        imgSelect.removeClass('selected');
                        $(this).parent().parent().addClass('selected').siblings();
                        $('#footer_variant').val($(this).data('home_id'));
                    })
                }
                footer_variant();

            });
        }(jQuery));
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/Modules/Pages/Resources/views/edit-page.blade.php ENDPATH**/ ?>