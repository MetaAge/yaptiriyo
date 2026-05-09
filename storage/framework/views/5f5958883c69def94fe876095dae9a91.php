<?php $__env->startSection('title', __('Navbar Global Variant')); ?>
<?php $__env->startSection('style'); ?>
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
        <div class="row">
            <div class="col-lg-12">
                <div class="customMarkup__single">
                    <div class="customMarkup__single__item">
                        <h4 class="customMarkup__single__title"><?php echo e(__('Navbar Global Variant')); ?></h4>
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
                            <form action="<?php echo e(route('admin.general.settings.navbar.global.variant')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="single-input mb-3">
                                    <input type="hidden" class="form-control" id="global_navbar_variant" value="<?php echo e(get_static_option('global_navbar_variant')); ?>" name="global_navbar_variant">
                                    <div class="row">
                                        <?php for($i = 1; $i <5; $i++): ?>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="img-select selected">
                                                    <div class="img-wrap">
                                                        <img src="<?php echo e(asset('assets/frontend/navbar-variant/'.$i.'.jpg')); ?>" data-home_id="0<?php echo e($i); ?>" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                                <button type="submit" id="update" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Changes')); ?></button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        (function($) {
            "use strict";
            $(document).ready(function(){
                //For Navbar
                let imgSelect = $('.img-select');
                let id = $('#global_navbar_variant').val();
                imgSelect.removeClass('selected');
                $('img[data-home_id="'+id+'"]').parent().parent().addClass('selected');
                $(document).on('click','.img-select img',function (e) {
                    e.preventDefault();
                    imgSelect.removeClass('selected');
                    $(this).parent().parent().addClass('selected').siblings();
                    $('#global_navbar_variant').val($(this).data('home_id'));
                })

            });
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/Modules/GeneralSettings/Resources/views/navbar-global-variant.blade.php ENDPATH**/ ?>