<header class="bg-white border-b border-gray-100 sticky top-0 z-[1000]">
    <nav class="navbar navbar-area navbar-expand-lg py-4">
        <div class="container mx-auto max-w-7xl px-6 flex items-center justify-between">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="<?php echo e(route('homepage')); ?>" class="flex items-center">
                    <?php if(!empty(get_static_option('site_logo'))): ?>
                        <?php echo render_image_markup_by_attachment_id(get_static_option('site_logo'), '', 'h-8 w-auto'); ?>

                    <?php else: ?>
                        <img src="<?php echo e(asset('assets/static/img/logo/logo.png')); ?>" alt="site-logo" class="h-8 w-auto">
                    <?php endif; ?>
                </a>
            </div>

            <!-- Mobile Toggler -->
            <div class="lg:hidden flex items-center gap-4">
                <button class="navbar-toggler p-2 text-slate-600 focus:outline-none" type="button" data-bs-toggle="collapse" data-bs-target="#xilancer_menu">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>

            <!-- Menu & Auth -->
            <div class="collapse navbar-collapse flex-grow justify-end" id="xilancer_menu">
                <div class="flex flex-col lg:flex-row items-center gap-8 lg:gap-10">
                    <!-- Nav Links -->
                    <ul class="flex flex-col lg:flex-row items-center gap-6 lg:gap-8 font-medium text-slate-600">
                        <?php echo render_frontend_menu($primary_menu); ?>

                    </ul>

                    <!-- User Menu / Auth -->
                    <div class="flex items-center gap-4 border-t lg:border-t-0 pt-4 lg:pt-0 w-full lg:w-auto">
                        <?php if (isset($component)) { $__componentOriginal52832d31110f84da973eba1608c59933 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal52832d31110f84da973eba1608c59933 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.user-menu','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.user-menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal52832d31110f84da973eba1608c59933)): ?>
<?php $attributes = $__attributesOriginal52832d31110f84da973eba1608c59933; ?>
<?php unset($__attributesOriginal52832d31110f84da973eba1608c59933); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal52832d31110f84da973eba1608c59933)): ?>
<?php $component = $__componentOriginal52832d31110f84da973eba1608c59933; ?>
<?php unset($__componentOriginal52832d31110f84da973eba1608c59933); ?>
<?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <?php if(request()->routeIs('homepage')): ?>
        <?php if (isset($component)) { $__componentOriginal7ecac999957263c09523da7583aa96ad = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7ecac999957263c09523da7583aa96ad = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.category.category','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.category.category'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7ecac999957263c09523da7583aa96ad)): ?>
<?php $attributes = $__attributesOriginal7ecac999957263c09523da7583aa96ad; ?>
<?php unset($__attributesOriginal7ecac999957263c09523da7583aa96ad); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7ecac999957263c09523da7583aa96ad)): ?>
<?php $component = $__componentOriginal7ecac999957263c09523da7583aa96ad; ?>
<?php unset($__componentOriginal7ecac999957263c09523da7583aa96ad); ?>
<?php endif; ?>
    <?php endif; ?>
</header>

<style>
    /* Premium Bionluk-style button overrides for User Menu components */
    .user-menu-item-link { @apply font-semibold text-slate-600 hover:text-[#FA8C00] transition-colors; }
    .btn-register, .register-btn { 
        background-color: #FA8C00 !important; 
        color: white !important; 
        border-radius: 8px !important;
        padding: 10px 24px !important;
        font-weight: 700 !important;
        transition: all 0.3s ease !important;
    }
    .btn-register:hover, .register-btn:hover {
        background-color: #E67E00 !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(250, 140, 0, 0.2);
    }
</style>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/layout/partials/navbar-variant/navbar-02.blade.php ENDPATH**/ ?>