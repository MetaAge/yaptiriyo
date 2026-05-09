<?php
    $footer_variant = !is_null(get_footer_style()) ? get_footer_style() : '04';
?>
<?php echo $__env->make('frontend.layout.partials.footer-variant.footer-'.$footer_variant, array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<script src="<?php echo e(asset('assets/frontend/new_design/assets/js/navbar.js')); ?>"></script>
<!-- new design js -->

<script src="https://kit.fontawesome.com/c4e937c9d9.js" crossorigin="anonymous"></script>


<script src="<?php echo e(asset('assets/frontend/new_design/assets/js/jquery-3.7.1.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/new_design/assets/js/about_us.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/new_design/assets/js/all_categories.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/new_design/assets/js/job_details.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/new_design/assets/js/animation.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/new_design/assets/js/blog.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/new_design/assets/js/browser_service_by_category.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/new_design/assets/js/gsap.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/new_design/assets/js/header.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/new_design/assets/js/ScrollTrigger.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/new_design/assets/js/service_card.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/new_design/assets/js/trending_service.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/new_design/assets/js/checkout.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/new_design/assets/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/new_design/assets/js/service_details.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/new_design/assets/js/talent_details.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/new_design/assets/js/login.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/new_design/assets/js/sign_up.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/new_design/assets/js/sign_form.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/new_design/assets/js/varify.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/newsletter.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/new_design/assets/js/main.js')); ?>"></script>




<!-- Toastr js -->
<?php if(get_static_option('home_page_animation') != 'disable'): ?>
    <!-- Wow Js -->
    <script>new WOW().init();</script>
<?php endif; ?>

<script src="<?php echo e(asset('assets/common/js/toastr.min.js')); ?>"></script>
<?php echo Toastr::message(); ?>

<!-- global ajax setup -->
<script> $.ajaxSetup({headers: {'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'} }) </script>

<?php if(moduleExists('HourlyJob')): ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<?php endif; ?>

<?php if (isset($component)) { $__componentOriginalf1c79c8ea18e2860687f4d18fb9318ac = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf1c79c8ea18e2860687f4d18fb9318ac = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'chat::components.livechat-js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('chat::livechat-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf1c79c8ea18e2860687f4d18fb9318ac)): ?>
<?php $attributes = $__attributesOriginalf1c79c8ea18e2860687f4d18fb9318ac; ?>
<?php unset($__attributesOriginalf1c79c8ea18e2860687f4d18fb9318ac); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf1c79c8ea18e2860687f4d18fb9318ac)): ?>
<?php $component = $__componentOriginalf1c79c8ea18e2860687f4d18fb9318ac; ?>
<?php unset($__componentOriginalf1c79c8ea18e2860687f4d18fb9318ac); ?>
<?php endif; ?>

<!-- End Of new-design js -->

<?php echo $__env->yieldContent('script'); ?>

<?php echo $__env->yieldPushContent('page_scripts'); ?>

<?php if(!empty( get_static_option('site_third_party_tracking_code'))): ?>
    <?php echo get_static_option('site_third_party_tracking_code'); ?>

<?php endif; ?>
<?php echo renderBodyEndHooks(); ?>

<?php echo $__env->make('frontend.layout.partials.gdpr-cookie', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/new_design/layout/partial/new_footer.blade.php ENDPATH**/ ?>