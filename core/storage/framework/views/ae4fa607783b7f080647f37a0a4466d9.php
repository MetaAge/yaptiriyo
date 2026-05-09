<!DOCTYPE html>
<html lang="<?php echo e(get_user_lang()); ?>" dir="<?php echo e(get_user_lang_direction()); ?>">

<head>
    <?php echo renderHeadStartHooks(); ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <!-- favicon -->
    <?php
        $site_favicon = get_attachment_image_by_id(get_static_option('site_favicon'),"full",false);
    ?>
    <?php if(!empty($site_favicon)): ?>
        <link rel="icon" href="<?php echo e($site_favicon['img_url'] ?? ''); ?>" sizes="40x40" type="icon/png">
    <?php endif; ?>

    <?php echo load_google_fonts(); ?>


    <!-- TAILWIND CSS FILES -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/new_design/assets/css/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/new_design/assets/css/all_job.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/new_design/assets/css/tailwindmain.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/new_design/assets/css/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/new_design/assets/css/tablar-icon.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/new_design/assets/css/style.css')); ?>">
    <!-- Toastr Css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/common/css/toastr.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/common/css/jquery.ihavecookies.css')); ?>">


    <!-- TAILWIND JS FILES -->
    <script src="<?php echo e(asset('assets/frontend/new_design/assets/js/tailwind.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/frontend/new_design/assets/js/tailwind-config.js')); ?>"></script>

    <!-- jQuery (if needed for your components) -->
    <script src="<?php echo e(asset('assets/frontend/new_design/assets/js/jquery-3.7.1.min.js')); ?>"></script>

    <?php echo $__env->make('frontend.layout.partials.root-style', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->yieldContent('style'); ?>

    <!-- Page Title & Meta Data -->
    <?php if(request()->routeIs('homepage')): ?>
        <title><?php echo e(get_static_option('site_title')); ?> - <?php echo e(get_static_option('site_tag_line')); ?></title>
        <?php echo render_site_meta_home(); ?>

    <?php elseif( request()->routeIs('frontend.dynamic.page') && $page_type === 'page' ): ?>
        <?php echo render_site_title(optional($page_post)->title ); ?>

        <?php echo render_site_meta(optional($page_post)->title ); ?>

    <?php else: ?>
        <?php if(View::hasSection('page-meta-data')): ?>
            <?php echo $__env->yieldContent('page-meta-data'); ?>
        <?php else: ?>
            <title>
                <?php echo $__env->yieldContent('site_title'); ?> | <?php echo e(get_static_option('site_title')); ?>

            </title>
        <?php endif; ?>
        <?php if(View::hasSection('meta_title')): ?>
            <meta name="title" content="<?php echo $__env->yieldContent('meta_title'); ?> | <?php echo e(get_static_option('site_title')); ?>">
        <?php endif; ?>
        <?php if(View::hasSection('meta_description')): ?>
            <meta name="description" content="<?php echo $__env->yieldContent('meta_description'); ?>">
        <?php endif; ?>
    <?php endif; ?>

    <?php

        $custom_css = '';
        if (file_exists('assets/frontend/css/dynamic-style.css')) {
            $custom_css = file_get_contents('assets/frontend/css/dynamic-style.css');
        }
    ?>
    <?php if(!empty($custom_css)): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/dynamic-style.css')); ?>">
    <?php endif; ?>
    <?php echo renderHeadEndHooks(); ?>

</head>

<body>
<?php echo renderBodyStartHooks(); ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/new_design/layout/partial/new_header.blade.php ENDPATH**/ ?>