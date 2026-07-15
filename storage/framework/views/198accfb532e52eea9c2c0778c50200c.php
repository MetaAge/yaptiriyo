<?php
$current_url = url()->current();
$root_url = url('/');
$contains = Str::of($current_url)->contains($root_url.'/jobs');
if($contains == $root_url.'/jobs') {
    //if project disable show job categories as default
    if(get_static_option('project_enable_disable') != 'disable'){
        $jobs_categories = \Modules\Service\Entities\Category::with('sub_categories')->where('status', '1')->where('selected_category',1)->get();
    }
    //if project disable show job categories as default end
}
else{
    $all_categories = \Modules\Service\Entities\Category::with('sub_categories')->where('status','1')->where('selected_category',1)->get();
}
?>


<!-- Menu area Starts -->
<nav class="navbar navbar-area navbar-four navbar-expand-lg">
    <div class="container nav-container">
        <div class="logo-wrapper">
            <a href="<?php echo e(route('homepage')); ?>" class="logo">
                <?php if(!empty(get_static_option('site_logo'))): ?>
                    <?php echo render_image_markup_by_attachment_id(get_static_option('site_logo')); ?>

                <?php else: ?>
                    <img src="<?php echo e(asset('assets/static/img/logo/logo.png')); ?>" alt="site-logo">
                <?php endif; ?>
            </a>
        </div>
        <div class="responsive-mobile-menu d-lg-none">
            <a href="javascript:void(0)" class="click-nav-right-icon">
                <i class="fas fa-ellipsis-v"></i>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#xilancer_menu">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="xilancer_menu">
            <ul class="navbar-nav">
                <?php if(moduleExists('CoinPaymentGateway')): ?>
                    <?php if(get_static_option('category_section_enable_disable') != 'disable'): ?>

                        <?php if(!empty($jobs_categories)): ?>
                            <li class="menu-item-has-children current-menu-item">
                                <a href="javascript:void(0)"><?php echo e(__('Categories')); ?></a>
                                <ul class="sub-menu">
                                    <?php $__currentLoopData = $jobs_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><li>
                                        <li class="menu-item-has-children position-static">
                                            <a href="<?php echo e(route('category.jobs',$category->slug)); ?>"> <?php echo e($category->category); ?> </a>
                                            <ul class="sub-mega-menu">
                                                <?php $__currentLoopData = $category->sub_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($sub_category->jobs()): ?>
                                                        <li><a href="<?php echo e(route('subcategory.jobs',$sub_category->slug)); ?>"><?php echo e($sub_category->sub_category); ?></a></li>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <?php if(get_static_option('project_enable_disable') == 'disable'): ?>
                            
                            <?php
                                $jobs_categories = \Modules\Service\Entities\Category::with('sub_categories')->where('status', '1')->whereHas('jobs')->get();
                            ?>
                            <?php if(!empty($jobs_categories)): ?>
                                    <li class="menu-item-has-children current-menu-item">
                                        <a href="javascript:void(0)"><?php echo e(__('Categories')); ?></a>
                                        <ul class="sub-menu">
                                            <?php $__currentLoopData = $jobs_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><li>
                                                <li class="menu-item-has-children position-static">
                                                    <a href="<?php echo e(route('category.jobs',$category->slug)); ?>"> <?php echo e($category->category); ?> </a>
                                                    <ul class="sub-mega-menu">
                                                        <?php $__currentLoopData = $category->sub_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($sub_category->jobs()): ?>
                                                                <li><a href="<?php echo e(route('subcategory.jobs',$sub_category->slug)); ?>"><?php echo e($sub_category->sub_category); ?></a></li>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </li>
                            <?php endif; ?>
                            
                        <?php else: ?>
                            <?php if(!empty($all_categories)): ?>

                                    <li class="menu-item-has-children current-menu-item">
                                        <a href="javascript:void(0)"><?php echo e(__('Categories')); ?></a>
                                        <ul class="sub-menu">
                                            <?php $__currentLoopData = $all_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="menu-item-has-children position-static">
                                                    <a href="<?php echo e(route('category.projects',$category->slug)); ?>"> <?php echo e($category->category); ?> </a>
                                                    <ul class="sub-mega-menu">
                                                        <?php $__currentLoopData = $category->sub_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <li><a href="<?php echo e(route('subcategory.projects',$sub_category->slug)); ?>"><?php echo e($sub_category->sub_category); ?></a></li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </li>
                            <?php endif; ?>
                        <?php endif; ?>

                    <?php endif; ?>
                <?php endif; ?>
                <?php echo render_frontend_menu($primary_menu); ?>

            </ul>
        </div>
        <?php if (isset($component)) { $__componentOriginal021c9b265a6b201438aa2913c01ce526 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal021c9b265a6b201438aa2913c01ce526 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.user-menu-for-nav-03','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.user-menu-for-nav-03'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal021c9b265a6b201438aa2913c01ce526)): ?>
<?php $attributes = $__attributesOriginal021c9b265a6b201438aa2913c01ce526; ?>
<?php unset($__attributesOriginal021c9b265a6b201438aa2913c01ce526); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal021c9b265a6b201438aa2913c01ce526)): ?>
<?php $component = $__componentOriginal021c9b265a6b201438aa2913c01ce526; ?>
<?php unset($__componentOriginal021c9b265a6b201438aa2913c01ce526); ?>
<?php endif; ?>
    </div>
</nav>
<!-- Menu area end --><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/layout/partials/navbar-variant/navbar-03.blade.php ENDPATH**/ ?>