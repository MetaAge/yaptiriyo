    function pre_next()
    {
        let Listings = document.querySelectorAll(".single-setup-request-list li");
        let sections = document.querySelectorAll(".setup-wrapper-contents");
        let current = 0;

        const toggleListings = () => {
            Listings.forEach(function(e) {
                e.classList.remove('running');
            });
            Listings[current].classList.add("running");
            Listings[current].classList.remove("completed");
            if (current != 0) {
                Listings[current - 1].classList.add("completed");
            }
        }

        const toggleSections = () => {
            sections.forEach(function(section) {
                section.classList.remove('active');
            });
            sections[current].classList.add("active");
        }

        $(document).on("click", "#next", function (e){
            e.preventDefault();

            if (current <= Listings.length) {
                current++

                //Add restricted word check**
                if(current == 1){
                    let category = $('#category').val();
                    let subcategory = $('#subcategory').val();
                    let title = $('#project_title').val();
                    let description = $('#project_description').val();

                    let title = $('#project_title').val();
                    let description = $('#project_description').val();
                    let country = $('#country_id').val();

                    if(category == '' || subcategory == '' || title == '' || description == '' || country == ''){
                        current = 0;
                        toastr_warning_js("<?php echo e(__('Please fill all fields (category, subcategory, title, description, and country are required)!')); ?>");
                        return false;
                    }
                    if(title.length < 20){
                        current = 0;
                        toastr_warning_js("<?php echo e(__('Title must be at least 20 characters')); ?>");
                        return false;
                    }
                    if(description.length < 50){
                        current = 0;
                        toastr_warning_js("<?php echo e(__('Description must be at least 50 characters')); ?>");
                        return false;
                    }

                    // Check for restricted words before proceeding**
                    <?php if(moduleExists('SecurityManage')): ?>
                    let module_exits = "<?php echo moduleExists('SecurityManage') ?? '' ?>";
                    if (module_exits) {
                        let words = JSON.parse('<?php echo json_encode(\Modules\SecurityManage\Entities\Word::select('word')->where("status", "active")->pluck("word")->toArray()); ?>');

                        let combinedText = (title + ' ' + description).toLowerCase();

                        function checkAnyWordExists(words, text) {
                            return words.some(word => text.includes(word.toLowerCase()));
                        }
                        let anyWordExists = checkAnyWordExists(words, combinedText);

                        function getAllMatchedWords(words, text) {
                            return words.filter(word => text.includes(word.toLowerCase()));
                        }

                        // Get all matching words
                        let matchedWords = getAllMatchedWords(words, combinedText);

                        if (anyWordExists) {
                            current = 0;
                            toastr_warning_js('<?php echo e(__("You cannot use restricted words: ")); ?>' + matchedWords.join(', '));
                            return false;
                        }
                    }
                    <?php endif; ?>
                }
                else if(current == 2){
                    let image = $('#upload_project_photo').val();
                    if(image == ''){
                        current = 1;
                        toastr_warning_js("<?php echo e(__('Please upload project photo !')); ?>");
                        return false;
                    }
                    $('.setup-footer-right').html('<button type="submit" class="btn-profile btn-bg-1" id="confirm_create_project"><?php echo e(__('Create Project')); ?><span id="project_create_load_spinner"></span></button>');
                }else{
                    $('.setup-footer-right').html('<a href="javascript:void(0)" class="setup-footer-next next" id="next"> <i class="fas fa-arrow-right"></i> </a>');
                }
            }

            toggleListings();
            toggleSections();
        })

        $(document).on("click", "#previous", function (){
            if (current > 0) {
                current--
                if(current == 2){
                    $('.setup-footer-right').html('<input type="submit" class="btn-profile btn-bg-1" value="<?php echo e(__('Create Project')); ?>">');
                }else{
                    $('.setup-footer-right').html('<a href="javascript:void(0)" class="setup-footer-next next" id="next"> <i class="fas fa-arrow-right"></i> </a>');
                }
            }
            toggleListings();
            toggleSections();
        });
    }

    // todo toastr warning
    function toastr_warning_js(msg){
        Command: toastr["warning"](msg, "Warning !")
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    }
    // todo toastr success
    function toastr_success_js(msg){
        Command: toastr["success"](msg, "Success !")
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    }

</script>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/freelancer/project/create/project-js.blade.php ENDPATH**/ ?><?php echo $__env->make('frontend.layout.partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('frontend.layout.partials.preloader', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


<?php echo $__env->make('frontend.layout.partials.navbar-variant.navbar-02', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php if(!empty($page_post) && $page_post->breadcrumb_status == 'on'): ?>
    <div class="banner-inner-area border-top pat-20 pab-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-inner-contents">
                        <ul class="inner-menu">
                            <li class="list"><a href="<?php echo e(url('/')); ?>"><?php echo e(__('Home')); ?> </a></li>
                            <li class="list"> <?php echo e($page_post->title ?? ''); ?> </li>
                        </ul>
                        <h2 class="banner-inner-title"> <?php echo e($page_post->title ?? ''); ?> <?php echo $__env->yieldContent('inner-title'); ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php echo $__env->yieldContent('content'); ?>
<?php echo $__env->make('frontend.layout.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('frontend.layout.partials.gdpr-cookie', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/layout/master.blade.php ENDPATH**/ ?><?php if(Auth::guard('web')->check()): ?>
    <div class="navbar-right-content show-nav-content">
        <div class="single-right-content">
            <div class="navbar-right-flex">
                <?php if(moduleExists('CurrencySwitcher')): ?>
                    <?php if (isset($component)) { $__componentOriginald5a998454111fb6d806bc153af707fb7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald5a998454111fb6d806bc153af707fb7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.menu-currency','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.menu-currency'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald5a998454111fb6d806bc153af707fb7)): ?>
<?php $attributes = $__attributesOriginald5a998454111fb6d806bc153af707fb7; ?>
<?php unset($__attributesOriginald5a998454111fb6d806bc153af707fb7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald5a998454111fb6d806bc153af707fb7)): ?>
<?php $component = $__componentOriginald5a998454111fb6d806bc153af707fb7; ?>
<?php unset($__componentOriginald5a998454111fb6d806bc153af707fb7); ?>
<?php endif; ?>
                <?php endif; ?>
                <?php if (isset($component)) { $__componentOriginaladdcaafd8f3829115a20fa4fa94b39e7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaladdcaafd8f3829115a20fa4fa94b39e7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.menu-searchbar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.menu-searchbar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaladdcaafd8f3829115a20fa4fa94b39e7)): ?>
<?php $attributes = $__attributesOriginaladdcaafd8f3829115a20fa4fa94b39e7; ?>
<?php unset($__attributesOriginaladdcaafd8f3829115a20fa4fa94b39e7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaladdcaafd8f3829115a20fa4fa94b39e7)): ?>
<?php $component = $__componentOriginaladdcaafd8f3829115a20fa4fa94b39e7; ?>
<?php unset($__componentOriginaladdcaafd8f3829115a20fa4fa94b39e7); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal4ea3d67194cd9259fa00ff5861e7fa45 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4ea3d67194cd9259fa00ff5861e7fa45 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.menu-chat-bookmark','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.menu-chat-bookmark'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4ea3d67194cd9259fa00ff5861e7fa45)): ?>
<?php $attributes = $__attributesOriginal4ea3d67194cd9259fa00ff5861e7fa45; ?>
<?php unset($__attributesOriginal4ea3d67194cd9259fa00ff5861e7fa45); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4ea3d67194cd9259fa00ff5861e7fa45)): ?>
<?php $component = $__componentOriginal4ea3d67194cd9259fa00ff5861e7fa45; ?>
<?php unset($__componentOriginal4ea3d67194cd9259fa00ff5861e7fa45); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalf571bcd7f29cc78cae8cfeaccebe84e2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf571bcd7f29cc78cae8cfeaccebe84e2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.menu-notification','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.menu-notification'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf571bcd7f29cc78cae8cfeaccebe84e2)): ?>
<?php $attributes = $__attributesOriginalf571bcd7f29cc78cae8cfeaccebe84e2; ?>
<?php unset($__attributesOriginalf571bcd7f29cc78cae8cfeaccebe84e2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf571bcd7f29cc78cae8cfeaccebe84e2)): ?>
<?php $component = $__componentOriginalf571bcd7f29cc78cae8cfeaccebe84e2; ?>
<?php unset($__componentOriginalf571bcd7f29cc78cae8cfeaccebe84e2); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal44082960a85d37a9b44647cb098508d4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal44082960a85d37a9b44647cb098508d4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.menu-user-items','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.menu-user-items'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal44082960a85d37a9b44647cb098508d4)): ?>
<?php $attributes = $__attributesOriginal44082960a85d37a9b44647cb098508d4; ?>
<?php unset($__attributesOriginal44082960a85d37a9b44647cb098508d4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal44082960a85d37a9b44647cb098508d4)): ?>
<?php $component = $__componentOriginal44082960a85d37a9b44647cb098508d4; ?>
<?php unset($__componentOriginal44082960a85d37a9b44647cb098508d4); ?>
<?php endif; ?>
            </div>
        </div>
    </div>
<?php else: ?>
    <?php if (isset($component)) { $__componentOriginal62e2a6f240024cf89e058e2efb7d002d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal62e2a6f240024cf89e058e2efb7d002d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.menu-search-login-register','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.menu-search-login-register'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal62e2a6f240024cf89e058e2efb7d002d)): ?>
<?php $attributes = $__attributesOriginal62e2a6f240024cf89e058e2efb7d002d; ?>
<?php unset($__attributesOriginal62e2a6f240024cf89e058e2efb7d002d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal62e2a6f240024cf89e058e2efb7d002d)): ?>
<?php $component = $__componentOriginal62e2a6f240024cf89e058e2efb7d002d; ?>
<?php unset($__componentOriginal62e2a6f240024cf89e058e2efb7d002d); ?>
<?php endif; ?>
<?php endif; ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/components/frontend/user-menu.blade.php ENDPATH**/ ?><style>
    :root {
        --main-color-one: <?php echo e(get_static_option('main_color_one') ?? '#007456'); ?>;
        --main-color-two: <?php echo e(get_static_option('main_color_two') ?? '#FA8C00'); ?>;
        --main-color-one-rgb: <?php echo e('97, 118, 246'); ?>;
        --secondary-color: <?php echo e(get_static_option('secondary_color')); ?>;
        --secondary-color-rgb: <?php echo e('255, 165, 0'); ?>;
        --bg-gradient: <?php echo e('linear-gradient(90deg, #fef0db 0%, #fefbf6 50%, #ecf8f0 100%)'); ?>;
        --section-bg-base: <?php echo e('#6176f6'); ?>;
        --section-bg-1: <?php echo e('#F7F8FF'); ?>;
        --section-bg-2: <?php echo e('#F5F5F5'); ?>;
        --footer-bg-1: <?php echo e('#020418'); ?>;
        --footer-bg-2: <?php echo e('#1E84FE'); ?>;
        --copyright-bg-1: <?php echo e('#323336'); ?>;
        --border-color: <?php echo e('#EAECF0'); ?>;
        --border-color-2: <?php echo e('#ddd'); ?>;
        --heading-color: <?php echo e(get_static_option('heading_color','#1D2635')); ?>;
        --paragraph-color: <?php echo e(get_static_option('paragraph_color','#1D2635')); ?>;
        --body-color: <?php echo e(get_static_option('body_color','#999')); ?>;
        --white: <?php echo e('#fff'); ?>;
        --active-color: <?php echo e('#00C897'); ?>;
        --active-color-rgb: <?php echo e('0, 200, 151'); ?>;
        --success-color: <?php echo e('#65c18c'); ?>;
        --success-color-rgb: <?php echo e('101, 193, 140'); ?>;
        --danger-color: <?php echo e('#f53a3a'); ?>;
        --danger-color-rgb: <?php echo e('245, 58, 58'); ?>;
        --promo-one: <?php echo e('#e3e1ff'); ?>;
        --promo-two: <?php echo e('#ffe6d3'); ?>;
        --promo-three: <?php echo e('#dbf3ff'); ?>;
        --promo-four: <?php echo e('#efffe6'); ?>;
        --promo-five: <?php echo e('#ffc9c9'); ?>;
        --promo-six: <?php echo e('#ceffda'); ?>;
        --promo-seven: <?php echo e('#b2ccfd'); ?>;
        --promo-eight: <?php echo e('#f0bcff'); ?>;
        --heading-font: <?php echo e(get_static_option('heading_font_family')); ?>,sans-serif;
        --body-font: <?php echo e(get_static_option('body_font_family')); ?>,sans-serif;
        --Otomanopee-font: <?php echo e(get_static_option('section_font_family')); ?>,sans-serif;
        
        
    }
</style><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/layout/partials/root-style.blade.php ENDPATH**/ ?><div class="setup-wrapper-left create-project">
    <div class="single-setup">
        <div class="single-setup-request">
            <ul class="single-setup-request-list list-style-none">
                <li class="single-setup-request-list-item running">
                    <span class="single-setup-request-list-item-number"> 1 </span>
                    <div class="single-setup-request-list-item-contents">
                        <h5 class="single-setup-request-list-item-contents-title"><?php echo e(__('Project Intro')); ?></h5>
                        <p class="single-setup-request-list-item-contents-para"><?php echo e(__('Add title & description to your project')); ?></p>
                    </div>
                </li>
                <li class="single-setup-request-list-item">
                    <span class="single-setup-request-list-item-number"> 2 </span>
                    <div class="single-setup-request-list-item-contents">
                        <h5 class="single-setup-request-list-item-contents-title"><?php echo e(__('Upload gallery')); ?></h5>
                        <p class="single-setup-request-list-item-contents-para"><?php echo e(__('Add some images to your project')); ?></p>
                    </div>
                </li>
                <li class="single-setup-request-list-item">
                    <span class="single-setup-request-list-item-number"> 3 </span>
                    <div class="single-setup-request-list-item-contents">
                        <h5 class="single-setup-request-list-item-contents-title"><?php echo e(__('Packages & charge')); ?></h5>
                        <p class="single-setup-request-list-item-contents-para"><?php echo e(__('Add what you offer & your charges')); ?></p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/freelancer/project/create/project-sidebar.blade.php ENDPATH**/ ?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="<?php echo e(get_static_option('site_meta_description')); ?>">
    <meta name="tags" content="<?php echo e(get_static_option('site_meta_tags')); ?>">
    <title><?php echo e(get_static_option('site_title')); ?> - <?php echo e(get_static_option('site_tag_line')); ?></title>

    <!-- favicon -->
    <?php echo render_favicon_by_id(get_static_option('site_favicon')); ?>


    <link rel="stylesheet" href="<?php echo e(asset('assets/common/css/bootstrap.min.css')); ?>">
    <style>
        :root {
            --main-color-one: <?php echo e(get_static_option('main_color_one') ?? '#6176f6'); ?>;
            --main-color-two: <?php echo e(get_static_option('main_color_two') ?? '#2bdfff'); ?>;
            --main-color-one-rgb: <?php echo e('97, 118, 246'); ?>;
            --secondary-color: <?php echo e(get_static_option('secondary_color')); ?>;
            --secondary-color-rgb: <?php echo e(get_static_option('secondary_color','#ffa500')); ?>;
            --heading-color: <?php echo e(get_static_option('heading_color','#1D2635')); ?>;
            --paragraph-color: <?php echo e(get_static_option('paragraph_color','#1D2635')); ?>;
        }

        .error-area {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .error-wrapper-thumb img {
            max-width: 100%;
        }
        .error-wrapper-title {
            font-size: 42px;
            font-weight: 500;
            color: var(--heading-color);
            line-height: 1.2;
        }
        .error-wrapper-para {
            font-size: 16px;
            font-weight: 400;
            color: var(--paragraph-color);
            line-height: 24px;
        }
        .cmn-btn {
            color: var(--paragraph-color);
            font-size: 16px;
            font-weight: 500;
            font-family: var(--body-font);
            display: inline-block;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            line-height: 34px;
            padding: 7px 35px;
            white-space: nowrap;
            -webkit-transition: all 0.3s ease-in;
            transition: all 0.3s ease-in;
            text-decoration: none;
        }
        .cmn-btn.btn-bg-1 {
            background: var(--main-color-one);
            color: #fff;
            border: 2px solid transparent;
        }
        .cmn-btn.btn-bg-1:hover {
            background: var(--secondary-color);
        }

        @media screen and (max-width: 575px) {
            .error-wrapper-title {
                font-size: 32px;
            }
        }
        @media screen and (max-width: 375px) {
            .error-wrapper-title {
                font-size: 28px;
            }
        }

    </style>
</head>

<body>
    <div class="overlays"></div>
    <!-- Header area end -->
    <!-- Error Area starts -->
    <div class="error-area padding-top-100 padding-bottom-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-9">
                    <div class="error-wrapper text-center">
                        <div class="error-wrapper-thumb">
                            <?php echo render_image_markup_by_attachment_id(get_static_option('error_image')); ?>

                        </div>
                        <div class="error-wrapper-contents mt-5">
                            <h2 class="error-wrapper-title"><?php echo e(get_static_option('error_404_page_title')); ?></h2>
                            <p class="error-wrapper-para mt-3"><?php echo e(get_static_option('error_404_page_paragraph')); ?></p>
                            <div class="btn-wrapper mt-4">
                                <a href="<?php echo e(route('homepage')); ?>" class="cmn-btn btn-bg-1"><?php echo e(get_static_option('error_404_page_button_text')); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Error Area ends -->
</body>
</html>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/errors/404.blade.php ENDPATH**/ ?><script src="<?php echo e(asset('assets/backend/js/summernote/summernote-lite.min.js')); ?>"></script>

<script>
    function initializeSummernote(element, options = {}) {
        let summernoteConfig = {
            disableDragAndDrop: true,
            codeviewFilter: true,
            codeviewIframeFilter: true,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['style']],
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['Insert', ['link', 'table', 'video', 'picture']],
            ],
            styleTags: [
                'p',
                {
                    title: 'Blockquote',
                    tag: 'blockquote',
                    className: 'blockquote',
                    value: 'blockquote'
                },
                'pre', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'
            ],
            codemirror: { // codemirror options
                theme: 'monokai'
            },
            callbacks: {
                onPaste: function(e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window
                        .clipboardData).getData('Text');
                    e.preventDefault();
                    document.execCommand('insertText', false, bufferText);
                }
            }
        };

        summernoteConfig.callbacks = {...summernoteConfig.callbacks, ...options};

        let summerNote = element;

        if(summerNote.length > 1){
            summerNote.each(function (){
                const singleSummernote = $(this)
                // Get the HTML content from the textarea
                let rawData = singleSummernote.val();
                // Sanitize the HTML content
                let sanitizedData = sanitizeHTML(rawData);

                singleSummernote.html('').summernote(summernoteConfig);

                // Set the sanitized content as the initial value
                singleSummernote.summernote('code', sanitizedData);
            })
        }else{
            // Get the HTML content from the textarea
            let rawData = summerNote.val();
            // Sanitize the HTML content
            let sanitizedData = sanitizeHTML(rawData);

            summerNote.val(sanitizedData);
            summerNote.summernote(summernoteConfig);
        }
    }

    // Function to sanitize HTML content
    function sanitizeHTML(content) {
        // Use jQuery to create a temporary element and set its HTML
        let tempElement = $('<div>').html(content);

        // Remove any script tags
        tempElement.find('script').remove();

        // Return the sanitized HTML
        return tempElement.html();
    }
</script><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/components/summernote/summernote-js-function.blade.php ENDPATH**/ ?>
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




    <!-- bootstrap -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/common/css/bootstrap.min.css')); ?>">
    <!-- Animate Css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/animate.css')); ?>">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/slick.css')); ?>">
    <!-- All Plugin Css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/common/css/all_plugin.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/common/css/jquery.ihavecookies.css')); ?>">
    <!-- Toastr Css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/common/css/toastr.min.css')); ?>">
    <!-- Helper Css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/helpers.css')); ?>">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/magnific-popup.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/style.css')); ?>">





<?php if(get_user_lang_direction() == 'rtl'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/xilancer-rtl.css')); ?>">
    <?php endif; ?>
    <?php echo $__env->make('frontend.layout.partials.root-style', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <!-- page css -->
    <?php echo $__env->yieldContent('style'); ?>

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
<?php echo renderBodyStartHooks(); ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/layout/partials/header.blade.php ENDPATH**/ ?><div class="single-input mt-3">
    <label for="" class="label-title"><?php echo e($title); ?></label>
    <textarea class="<?php echo e($class ?? 'form-control summernote'); ?>" name="<?php echo e($name); ?>" id="<?php echo e($id); ?>"><?php echo $value ?? ''; ?></textarea>
</div>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/components/form/summernote.blade.php ENDPATH**/ ?><header class="header-style-01">
    <!-- Menu area Starts -->
    <nav class="navbar navbar-area navbar-expand-lg" <?php if(get_static_option('sticky_menu') == 'enable'): ?> id="navigation" <?php endif; ?>>
        <div class="container bg-white nav-container">
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
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#xilancer_menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="xilancer_menu">
                <ul class="navbar-nav">
                    <?php echo render_frontend_menu($primary_menu); ?>

                </ul>
            </div>

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
    <!-- Menu area end -->
</header>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/layout/partials/navbar-variant/navbar-02.blade.php ENDPATH**/ ?><!-- Project Introduction Start -->
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
