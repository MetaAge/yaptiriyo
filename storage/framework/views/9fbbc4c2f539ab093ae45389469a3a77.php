<?php $__env->startSection('title'); ?>
    <?php echo e($page->title); ?> <?php echo e(__('Page Builder')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <?php if (isset($component)) { $__componentOriginal48ea0679a06c39775cf7fe484273570c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal48ea0679a06c39775cf7fe484273570c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.pagebuilder.css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('pagebuilder.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal48ea0679a06c39775cf7fe484273570c)): ?>
<?php $attributes = $__attributesOriginal48ea0679a06c39775cf7fe484273570c; ?>
<?php unset($__attributesOriginal48ea0679a06c39775cf7fe484273570c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal48ea0679a06c39775cf7fe484273570c)): ?>
<?php $component = $__componentOriginal48ea0679a06c39775cf7fe484273570c; ?>
<?php unset($__componentOriginal48ea0679a06c39775cf7fe484273570c); ?>
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
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/custom-style.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="dashboard__body">
        <div class="row">
            <div class="col-lg-12">
                <div class="customMarkup__single">
                    <div class="customMarkup__single__item">
                        <h4 class="customMarkup__single__title"><?php echo e(__('Page Builder')); ?></h4>
                        <br>
                        <a class="btn btn-lg btn-secondary btn-sm mb-3 mr-1"  href="<?php echo e(route('admin.edit.page',$page->id)); ?>"><?php echo e(__('Go Back')); ?></a>
                        <a class="btn btn-lg btn-primary btn-sm mb-3 mr-1"  href="<?php echo e(route('admin.page.all')); ?>"><?php echo e(__('All pages')); ?></a>
                        <div class="customMarkup__single__inner mt-4">
                            <div id="page-builder-wrap" class="margin-top-50 page-builder-content-wrap">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <?php if($page->layout === 'normal_layout' || $page->layout === 'home_page_layout' || $page->layout === 'home_page_layout_two'): ?>
                                            <div class="page-builder-area-wrapper extra-title">
                                                <h4 class="main-title"><?php echo e(__(ucfirst(str_replace('_',' ',$page->layout)))); ?></h4>
                                                <ul id="dynamic_page"
                                                    class="sortable available-form-field main-fields sortable_widget_location">
                                                    <?php echo \plugins\PageBuilder\PageBuilderSetup::get_saved_addons_for_dynamic_page('dynamic_page',$page->id); ?>

                                                </ul>
                                            </div>
                                        <?php endif; ?>

                                        <?php if($page->layout === 'home_page_layout_two'): ?>
                                            <div class="page-builder-area-wrapper extra-title">
                                                <h4 class="main-title"><?php echo e(__('Without Sidebar Layout')); ?></h4>
                                                <ul id="dynamic_page_with_sidebar_two"
                                                    class="sortable available-form-field main-fields sortable_widget_location margin-bottom-15">
                                                    <?php echo \plugins\PageBuilder\PageBuilderSetup::get_saved_addons_for_dynamic_page('dynamic_page_with_sidebar_two',$page->id); ?>

                                                </ul>
                                            </div>
                                        <?php endif; ?>

                                        <?php if($page->layout === 'sidebar_layout'): ?>
                                            <div class="page-builder-area-wrapper extra-title">
                                                <h4 class="main-title"><?php echo e(__('With Sidebar Layout')); ?></h4>
                                                <ul id="dynamic_page_with_sidebar"
                                                    class="sortable available-form-field main-fields sortable_widget_location margin-bottom-15">
                                                    <?php echo \plugins\PageBuilder\PageBuilderSetup::get_saved_addons_for_dynamic_page('dynamic_page_with_sidebar',$page->id); ?>

                                                </ul>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                    <div class="col-lg-6">
                                        <div class="search-wrap">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="search_addon_field" placeholder="<?php echo e(__('Search Addon')); ?>" name="s">
                                            </div>
                                        </div>
                                        <div class="all-addons-wrapper">
                                            <ul id="sortable_02" class="available-form-field all-widgets sortable_02">
                                                <?php echo \plugins\PageBuilder\PageBuilderSetup::get_admin_panel_widgets(); ?>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    <?php if (isset($component)) { $__componentOriginal07d08fed7fd607708d2fd75bc3bffd8a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal07d08fed7fd607708d2fd75bc3bffd8a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.pagebuilder.js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('pagebuilder.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal07d08fed7fd607708d2fd75bc3bffd8a)): ?>
<?php $attributes = $__attributesOriginal07d08fed7fd607708d2fd75bc3bffd8a; ?>
<?php unset($__attributesOriginal07d08fed7fd607708d2fd75bc3bffd8a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal07d08fed7fd607708d2fd75bc3bffd8a)): ?>
<?php $component = $__componentOriginal07d08fed7fd607708d2fd75bc3bffd8a; ?>
<?php unset($__componentOriginal07d08fed7fd607708d2fd75bc3bffd8a); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalf2dadd09bf38d963d4e6fc9fba23324e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf2dadd09bf38d963d4e6fc9fba23324e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.pagebuilder.helper','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('pagebuilder.helper'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf2dadd09bf38d963d4e6fc9fba23324e)): ?>
<?php $attributes = $__attributesOriginalf2dadd09bf38d963d4e6fc9fba23324e; ?>
<?php unset($__attributesOriginalf2dadd09bf38d963d4e6fc9fba23324e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf2dadd09bf38d963d4e6fc9fba23324e)): ?>
<?php $component = $__componentOriginalf2dadd09bf38d963d4e6fc9fba23324e; ?>
<?php unset($__componentOriginalf2dadd09bf38d963d4e6fc9fba23324e); ?>
<?php endif; ?>
    <script>
        /*-----------------------------------
         *  COLOR Picker INIT FUnction
         * ---------------------------------*/

        function colorPickerInit(selector) {

            $.each(selector, function(index, value) {
                var el = $(this);
                el.spectrum({
                    showAlpha: true,
                    showPalette: true,
                    cancelText: '',
                    showInput: true,
                    allowEmpty: true,
                    chooseText: '',
                    maxSelectionSize: 2,
                    color: el.next('input').val(),
                    change: function(color) {
                        el.next('input').val(color ? color.toRgbString() : '');
                        el.css({
                            'background-color': color ? color.toRgbString() : ''
                        });
                    },
                    move: function(color) {
                        el.next('input').val(color ? color.toRgbString() : '');
                        el.css({
                            'background-color': color ? color.toRgbString() : ''
                        });
                    },
                    palette: [
                        [
                            "<?php echo e(get_static_option('site_color')); ?>",
                            "<?php echo e(get_static_option('site_main_color_two')); ?>",
                            "<?php echo e(get_static_option('site_secondary_color')); ?>",
                            "<?php echo e(get_static_option('site_heading_color')); ?>",
                            "<?php echo e(get_static_option('site_paragraph_color')); ?>",
                        ]
                    ]
                });

                el.on("dragstop.spectrum", function(e, color) {
                    el.next('input').val(color.toRgbString());
                    el.css({
                        'background-color': color.toHexString()
                    });
                });
            });
        }
    </script>
    <script src="<?php echo e(asset('assets/common/js/sweetalert2.js')); ?>"></script>
    <script>
        let summernoteConfig = {
            disableDragAndDrop: true,
            height: 200, //set editable area's height
            codeviewFilter: true,
            codeviewIframeFilter: true,
            toolbar: [
                // [groupName, [list of button]]
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

        // Function to sanitize HTML content
        function sanitizeHTML(content) {
            // Use jQuery to create a temporary element and set its HTML
            let tempElement = $('<div>').html(content);

            // Remove any script tags
            tempElement.find('script').remove();

            // Return the sanitized HTML
            return tempElement.html();
        }

        (function ($) {
            "use strict";

            $(document).ready(function () {
                /*---------------------------------
                *   PREVIEW IMAGE
                * --------------------------------*/
                $(document).on('mouseover','.all-addons-wrapper ul.ui-sortable li.widget-handler',function (e){
                    var imgUrl = $(this).find('a').attr('href');
                    $(this).append('<div class="imageupshow"><img src="'+imgUrl+'" alt=""></div>');
                });
                $(document).on('mouseout','.all-addons-wrapper ul.ui-sortable li.widget-handler',function (e){
                    $(this).find('.imageupshow').remove();
                });


                $(document).on('change','.addon_advertisement_size',function(e){
                    e.preventDefault();
                });

                /*----------------------------------
                *   SEARCH WIDGETS
                * ---------------------------------*/
                $(document).on('keyup','#search_addon_field',function (){
                    var searchText = $(this).val();
                    var allWidgets = $('.available-form-field.sortable_02 li > h4');
                    $.each(allWidgets,function (index,value){
                        var text = $(this).text();
                        var found = text.toLowerCase().match(searchText.toLowerCase().trim());
                        if (!found){
                            $(this).parent().hide();
                        }else{
                            $(this).parent().show();
                        }
                    });
                });

                /*-----------------------------------
                *   PAGE BUILDER CORE SCRIPT
                * ---------------------------------*/
                $(".sortable").sortable({
                    handle: "h4.top-part",
                    axis: "y",
                    helper: "clone",
                    placeholder: "sortable-placeholder",
                    receive: function (event, li) {
                        resetOrder(this.id);
                        setAddonLocation(event);
                    },
                    stop: function (event, li) {
                        resetOrder(this.id);
                    }
                });


                function setAddonLocation(event){
                    var addonLocation = event.target.getAttribute('id');
                    var allDraggerdAddon = $('#'+event.target.getAttribute('id')).find('li');
                    allDraggerdAddon.each(function (index,value){
                        $(this).find('input[name="addon_location"]').val(addonLocation);
                        $(this).find('input[name="addon_page_type"]').val(addonLocation);
                        $(this).find('input[name="addon_order"]').val(index + 1);
                    });
                }

                function renderWidgetMarkup(event,li){

                    var addonClass = li.item.attr('data-name');
                    var namespace = li.item.attr('data-namespace');
                    var markup = '';
                    $.ajax({
                        'url': "<?php echo e(route('admin.page.builder.get.addon.markup')); ?>",
                        'type': "POST",
                        'data': {
                            '_token': "<?php echo csrf_token(); ?>",
                            'addon_class': addonClass,
                            'addon_namespace': namespace,
                            'addon_page_id': '<?php echo e($page->id); ?>',
                            'addon_page_type': event.target.getAttribute('id'),
                            'addon_location': event.target.getAttribute('id'),
                        },
                        async: false,
                        success: function (data) {
                            markup = data;

                            $('.summernote').summernote(summernoteConfig);
                        }
                    });

                    li.item.clone()
                        .html(markup)
                        .insertAfter(li.item);
                    return markup;
                }


                $(".sortable_02").sortable({
                    handle: "h4.top-part",
                    connectWith: '.sortable_widget_location',
                    helper: "clone",
                    remove: function (e, li) {
                        renderWidgetMarkup(e,li);
                        $(this).sortable('cancel');
                    }
                }).disableSelection();


                $('body').on('click', '.remove-widget', function (e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure to delete?',
                        text: 'You would revert this anytime!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "Yes, Delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).parent().remove();
                            $(".sortable_02").sortable("refreshPositions");
                            var parent = $(this).parent();
                            var widgetType = parent.find('input[name="addon_type"]').val();
                            resetOrder();

                            if (widgetType === 'update') {
                                var widget_id = parent.find('input[name="id"]').val();
                                $.ajax({
                                    'url': "<?php echo e(route('admin.page.builder.delete')); ?>",
                                    'type': "POST",
                                    'data': {
                                        '_token': "<?php echo csrf_token(); ?>",
                                        'id': widget_id
                                    },
                                    success: function (data) {
                                    }
                                });
                            }
                        }
                    });
                });

                $('body').on('click', '.expand', function (e) {
                    $(this).parent().siblings().find('.content-part').find('.nice-select').niceSelect('destroy');
                    $(this).parent().siblings().find('.content-part').removeClass('show');
                    $(this).parent().find('.content-part').find('.nice-select').niceSelect('destroy');
                    $(this).parent().find('.content-part').toggleClass('show');


                    var expand = $(this).children('i');
                    var parent = $(this).parent();
                    var classname = $(this).parent().data('name');

                    if (expand.hasClass('fas-fa-angle-down')) {
                        expand.attr('class', 'fas-fa-angle-up');
                        $('.note-editable').trigger('focus');
                        var colorPickerNode = $('li[data-name="'+classname+'"] .color_picker');
                        colorPickerInit(colorPickerNode);
                    } else {
                        expand.attr('class', 'fas fa-angle-down');
                        $('body .color_picker').spectrum('destroy');
                        $('body .nice-select').niceSelect('destroy');

                        let summerNote = $('li[data-name="'+classname+'"] .summernote');

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

                            summerNote.html('').summernote(summernoteConfig);

                            // Set the sanitized content as the initial value
                            summerNote.summernote('code', sanitizedData);
                        }

                        var colorPickerNode = $('li[data-name="'+classname+'"] .color_picker');
                        colorPickerInit(colorPickerNode);
                    }


                    $('body .icp-dd').iconpicker('destroy');
                    $('body .icp-dd').iconpicker();
                    $(this).parent().find('.content-part').find('.nice-select').niceSelect();

                });

                $('body').on('click', '.widget_save_change_button', function (e) {
                    e.preventDefault();
                    var parent = $(this).parent().find('.widget_save_change_button');
                    parent.text('<?php echo e(__('Saving...')); ?>').attr('disabled', true);
                    var form = $(this).parent();
                    var widgetType = $(this).parent().find('input[name="addon_type"]').val();
                    var formAction = $(this).parent().attr('action');
                    var udpateId = '';
                    var formContainer = $(this).parent();
                    var sortableId = formContainer.parent().parent().parent().attr('id');

                    $.ajax({
                        type: "POST",
                        url: formAction,
                        data: form.serializeArray(),
                        success: function (data) {
                            udpateId = data.id;
                            if (widgetType === 'new') {
                                formContainer.attr('action', "<?php echo e(route('admin.page.builder.update')); ?>")
                                formContainer.find('input[name="addon_type"]').val('update');
                                formContainer.prepend('<input type="hidden" name="id" value="' + udpateId + '">');
                            }
                            if (data === 'ok') {
                                form.append('<span class="text-success"><?php echo e(__('data saved success')); ?></span>');
                            }
                            setTimeout(function () {
                                form.find('span.text-success').remove();
                            }, 2000);

                        }
                    });

                    parent.text('saved..');
                    setTimeout(function () {
                        parent.text('<?php echo e(__('Save Changes')); ?>').attr('disabled', false);
                    }, 1000);
                });

                /**
                 * reset order function
                 * */
                function resetOrder(dropedOn) {
                    var allItems = $('#' + dropedOn + ' li');
                    $.each(allItems, function (index, value) {
                        $(this).find('input[name="addon_order"]').val(index + 1);
                        $(this).find('input[name="addon_location"]').val(dropedOn);
                        var id = $(this).find('input[name="id"]').val();
                        var widget_order = index + 1;
                        if (typeof id != 'undefined') {
                            reset_db_order(id, widget_order);
                        }
                    });
                }

                /**
                 * reorder function
                 * */
                function reset_db_order(id, addon_order) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo e(route('admin.page.builder.update.addon.order')); ?>",
                        data: {
                            _token: "<?php echo e(csrf_token()); ?>",
                            id: id,
                            addon_order: addon_order
                        },
                        success: function (data) {
                            //response ok if it saved success
                        }
                    });
                }

                $(document).on('click', '.widget-area-expand', function (e) {
                    e.preventDefault();
                    var widgetbody = $(this).parent().parent().find('.widget-area-body');
                    widgetbody.toggleClass('hide');
                    var expand = $(this).children('i');
                    if (expand.hasClass('fas fa-angle-down')) {
                        expand.attr('class', 'fas fa-angle-up');
                    } else {
                        expand.attr('class', 'fas fa-angle-down');
                        var allWidgets = $(this).parent().parent().find('.widget-area-body ul li');
                        $.each(allWidgets, function (value) {
                            $(this).find('.content-part').removeClass('show');
                        });
                    }
                });


            });
        })(jQuery);

    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/backend/page-builder/dynamicpage.blade.php ENDPATH**/ ?>