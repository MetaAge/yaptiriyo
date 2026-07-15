<script>
    (function () {
        "use strict";

        // Wait for jQuery to be available
        function initTalentFilter() {
            if (typeof jQuery === 'undefined') {
                setTimeout(initTalentFilter, 50);
                return;
            }

            var $ = jQuery;

            $(document).ready(function () {
                console.log('Talent Filter Initialized');

                // ===== SIDEBAR TOGGLE =====
                $('#filter').on('click', function (e) {
                    e.preventDefault();
                    $('#sidebar').removeClass('hidden');
                });

                $('#closeSidebar').on('click', function (e) {
                    e.preventDefault();
                    $('#sidebar').addClass('hidden');
                });

                $('#sidebar').on('click', function (e) {
                    if (e.target.id === 'sidebar') {
                        $('#sidebar').addClass('hidden');
                    }
                });

                // ===== CATEGORY & SUBCATEGORY =====
                $(document).on('change', '#category', function() {
                    let category = $(this).val();
                    console.log('Category changed:', category);

                    if (category) {
                        $.ajax({
                            method: 'POST',
                            url: window.routes.subcategoryAll,
                            data: {
                                category: category,
                                _token: window.csrfToken
                            },
                            success: function(res) {
                                if (res.status === 'success') {
                                    let subcategorySelect = $('#subcategory');
                                    subcategorySelect.empty().append('<option value=""><?php echo e(__('Select Subcategory')); ?></option>');

                                    if (res.subcategories && res.subcategories.length > 0) {
                                        res.subcategories.forEach(function(subcat) {
                                            subcategorySelect.append(
                                                $('<option></option>').val(subcat.id).text(subcat.sub_category)
                                            );
                                        });
                                    }
                                }
                            },
                            error: function(xhr) {
                                console.error('Subcategory error:', xhr);
                            }
                        });

                        filterTalents();
                    } else {
                        $('#subcategory').empty().append('<option value=""><?php echo e(__('Select Subcategory')); ?></option>');
                    }
                });

                // ===== COUNTRY & STATE =====
                $(document).on('change', '#country', function() {
                    let country = $(this).val();
                    console.log('Country changed:', country);

                    if (country) {
                        $.ajax({
                            method: 'POST',
                            url: window.routes.stateAll,
                            data: {
                                country: country,
                                _token: window.csrfToken
                            },
                            success: function(res) {
                                if (res.status === 'success') {
                                    let stateSelect = $('#state');
                                    stateSelect.empty().append('<option value=""><?php echo e(__('Select State')); ?></option>');

                                    if (res.states && res.states.length > 0) {
                                        res.states.forEach(function(state) {
                                            stateSelect.append(
                                                $('<option></option>').val(state.id).text(state.state)
                                            );
                                        });
                                    }
                                }
                            },
                            error: function(xhr) {
                                console.error('State error:', xhr);
                            }
                        });

                        filterTalents();
                    } else {
                        $('#state').empty().append('<option value=""><?php echo e(__('Select State')); ?></option>');
                    }
                });

                // ===== FILTER ON CHANGE =====
                $(document).on('change', '#subcategory, #state, #skills, #level, #talent_badge', function() {
                    let fieldId = $(this).attr('id');
                    let fieldValue = $(this).val();
                    console.log('Filter changed:', fieldId, 'Value:', fieldValue);
                    filterTalents();
                });

                // ===== RATING FILTER =====
                $(document).on('change', 'input[name="rating"]', function() {
                    console.log('Rating changed:', $(this).val());
                    filterTalents();
                });

                // ===== SEARCH BY TEXT =====
                let searchTimeout;
                let lastSearchQuery = '';

                $(document).on('input', '#talent_search_string', function (e) {
                    const searchQuery = $(this).val().trim();

                    // Clear previous timeout
                    clearTimeout(searchTimeout);

                    // If search query is empty, trigger filter immediately
                    if (searchQuery === '') {
                        filterTalents();
                        lastSearchQuery = '';
                        return;
                    }

                    // If the query hasn't changed, don't search again
                    if (searchQuery === lastSearchQuery) {
                        return;
                    }

                    // Only search after user stops typing for 500ms
                    searchTimeout = setTimeout(function() {
                        if (searchQuery.length >= 2) { // Only search if at least 2 characters
                            filterTalents();
                            lastSearchQuery = searchQuery;
                        }
                        // If user clears input, still trigger filter to show all results
                        else if (searchQuery.length === 0) {
                            filterTalents();
                            lastSearchQuery = '';
                        }
                    }, 500); // 500ms delay
                });

                // Keep Enter key functionality for accessibility
                $(document).on('keydown', '#talent_search_string', function (e) {
                    if (e.key === 'Enter' || e.which === 13) {
                        e.preventDefault();
                        clearTimeout(searchTimeout); // Clear any pending timeout
                        filterTalents();
                    }
                });

                // ===== SORT BY =====
                $(document).on('change', '#sort_by', function() {
                    filterTalents();
                });

                // ===== PRICE RANGE =====
                let priceFilterTimeout;

                // Text input changes
                $(document).on('input', '#priceMin, #priceMax', function() {
                    clearTimeout(priceFilterTimeout);
                    priceFilterTimeout = setTimeout(function() {
                        let min_price = $('#priceMin').val();
                        let max_price = $('#priceMax').val();

                        if (min_price || max_price) {
                            min_price = min_price ? parseFloat(min_price) : 0;
                            max_price = max_price ? parseFloat(max_price) : 999999;

                            if (min_price >= 0 && max_price >= 0 && min_price <= max_price) {
                                filterTalents();
                            }
                        } else {
                            filterTalents();
                        }
                    }, 500);
                });

                // ===== MAIN FILTER FUNCTION =====
                function filterTalents() {
                    console.log('=== filterTalents Called ===');

                    // Get selected rating
                    let rating = $('input[name="rating"]:checked').val() || '';

                    // Build filter data - only include non-empty values
                    let filterData = {};

                    if ($('#category').val()) filterData.category = $('#category').val();
                    if ($('#subcategory').val()) filterData.subcategory = $('#subcategory').val();
                    if ($('#country').val()) filterData.country = $('#country').val();
                    if ($('#state').val()) filterData.state = $('#state').val();
                    if ($('#skills').val()) filterData.skill = $('#skills').val();
                    if ($('#level').val()) filterData.level = $('#level').val();
                    if ($('#talent_badge').val()) filterData.talent_badge = $('#talent_badge').val();
                    if (rating) filterData.rating = rating;
                    if ($('#priceMin').val()) filterData.min_price = $('#priceMin').val();
                    if ($('#priceMax').val()) filterData.max_price = $('#priceMax').val();
                    if ($('#talent_search_string').val()) filterData.talent_search_string = $('#talent_search_string').val();
                    if ($('#sort_by').val()) filterData.sort_by = $('#sort_by').val();

                    filterData.page = 1;

                    console.log('Filter data:', filterData);

                    $.ajax({
                        url: window.routes.talentsFilter,
                        method: 'GET',
                        data: filterData,
                        beforeSend: function() {
                            $('.search_talent_result').html('<div class="col-span-3 text-center py-8"><p class="text-gray-600"><?php echo e(__('Loading...')); ?></p></div>');
                            $('.talent-count-display').html('<?php echo e(__('Loading...')); ?>');
                        },
                        success: function(res) {
                            console.log('Filter response:', res);

                            if (res.status === 'nothing') {
                                $('.search_talent_result').html(`
                                <div class="col-span-3">
                                    <section>
                                        <div class="flex items-center justify-center min-h-[calc(100vh-171px)] w-full py-10">
                                            <div class="max-w-md flex flex-col items-center justify-center">
                                                <img src="/assets/frontend/new_design/assets/images/error-images/no_jobs_found.svg" alt="nothing-found">
                                                <p class="text-base-300 text-2xl"><?php echo e(__('Ops! Sorry, no talents found.')); ?></p>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            `);
                                $('.talent-count-display').html('<?php echo e(__('Showing 0 results')); ?>');
                            } else {
                                if (res.html) {
                                    $('.search_talent_result').html(res.html);
                                    $('.talent-count-display').html('<?php echo e(__('Showing')); ?> ' + res.count + ' <?php echo e(__('out of')); ?> ' + res.total + ' <?php echo e(__('results')); ?>');
                                } else {
                                    $('.search_talent_result').html(res);
                                    updateTalentCountFromDOM();
                                }
                            }

                            updateActiveFilters();
                        },
                        error: function(xhr) {
                            console.error('Filter error:', xhr);
                            alert('<?php echo e(__('An error occurred. Please try again.')); ?>');
                        }
                    });
                }

                // ===== PAGINATION HANDLER =====
                $(document).on('click', '.pagination-link', function(e) {
                    e.preventDefault();
                    let url = $(this).data('url');
                    if (url) {
                        loadPaginationContent(url);
                    }
                });

                function loadPaginationContent(url) {
                    // Parse the URL to get page number only
                    const urlObj = new URL(url, window.location.origin);
                    const page = urlObj.searchParams.get('page') || 1;

                    // Get selected rating
                    let rating = $('input[name="rating"]:checked').val() || '';

                    // Build filter data - only include non-empty values
                    let filterData = { page: page };

                    if ($('#category').val()) filterData.category = $('#category').val();
                    if ($('#subcategory').val()) filterData.subcategory = $('#subcategory').val();
                    if ($('#country').val()) filterData.country = $('#country').val();
                    if ($('#state').val()) filterData.state = $('#state').val();
                    if ($('#skills').val()) filterData.skill = $('#skills').val();
                    if ($('#level').val()) filterData.level = $('#level').val();
                    if ($('#talent_badge').val()) filterData.talent_badge = $('#talent_badge').val();
                    if (rating) filterData.rating = rating;
                    if ($('#priceMin').val()) filterData.min_price = $('#priceMin').val();
                    if ($('#priceMax').val()) filterData.max_price = $('#priceMax').val();
                    if ($('#talent_search_string').val()) filterData.talent_search_string = $('#talent_search_string').val();
                    if ($('#sort_by').val()) filterData.sort_by = $('#sort_by').val();

                    console.log('Pagination filter data:', filterData);

                    $.ajax({
                        url: window.routes.talentsFilter,
                        method: 'GET',
                        data: filterData,
                        beforeSend: function() {
                            $('.search_talent_result').css('opacity', '0.5');
                            // Scroll to top of results smoothly
                            $('html, body').animate({
                                scrollTop: $('.search_talent_result').offset().top - 100
                            }, 300);
                        },
                        success: function(res) {
                            if (res.status === 'nothing') {
                                $('.search_talent_result').html(`
                    <div class="col-span-3">
                        <section>
                            <div class="flex items-center justify-center min-h-[calc(100vh-171px)] w-full py-10">
                                <div class="max-w-md flex flex-col items-center justify-center">
                                    <img src="/assets/frontend/new_design/assets/images/error-images/no_jobs_found.svg" alt="nothing-found">
                                    <p class="text-base-300 text-2xl"><?php echo e(__('Ops! Sorry, no talents found.')); ?></p>
                                </div>
                            </div>
                        </section>
                    </div>
                `);
                                $('.talent-count-display').html('<?php echo e(__('Showing 0 results')); ?>');
                            } else {
                                if (res.html) {
                                    $('.search_talent_result').html(res.html);
                                    $('.talent-count-display').html('<?php echo e(__('Showing')); ?> ' + res.count + ' <?php echo e(__('out of')); ?> ' + res.total + ' <?php echo e(__('results')); ?>');
                                }
                            }
                            $('.search_talent_result').css('opacity', '1');

                            // Update active filters
                            updateActiveFilters();
                        },
                        error: function(xhr) {
                            console.error('Pagination error:', xhr);
                            $('.search_talent_result').css('opacity', '1');
                            alert('<?php echo e(__('An error occurred while loading the page. Please try again.')); ?>');
                        }
                    });
                }

                // ===== RESET FILTERS =====
                $(document).on('click', '#talent_filter_reset, #clear-all-filters', function(e) {
                    e.preventDefault();

                    // Reset all filter fields
                    $('#country').val('').trigger('change');
                    $('#category').val('').trigger('change');
                    $('#subcategory').val('').trigger('change');
                    $('#state').val('').trigger('change');
                    $('#skills').val('').trigger('change');
                    $('#level').val('').trigger('change');
                    $('#talent_badge').val('').trigger('change');
                    $('input[name="rating"]').prop('checked', false);
                    $('#priceMin').val('');
                    $('#priceMax').val('');
                    $('#priceRangeStart').val('0');
                    $('#priceRangeEnd').val('1000');
                    $('#talent_search_string').val('');
                    $('#sort_by').val('').trigger('change');
                    $('#ratingAll').prop('checked', true);

                    // Reset range track visual
                    if (document.getElementById('rangeTrack')) {
                        document.getElementById('rangeTrack').style.left = '0%';
                        document.getElementById('rangeTrack').style.width = '100%';
                    }

                    $.ajax({
                        url: window.routes.talentsFilterReset,
                        method: 'GET',
                        success: function(res) {
                            if (res.status === 'nothing') {
                                $('.search_talent_result').html('<div class="col-span-3 text-center py-8"><h3 class="text-2xl text-red-500"><?php echo e(__('Nothing Found')); ?></h3></div>');
                                $('.talent-count-display').html('<?php echo e(__('Showing 0 results')); ?>');
                            } else {
                                if (res.html) {
                                    $('.search_talent_result').html(res.html);
                                    $('.talent-count-display').html('<?php echo e(__('Showing')); ?> ' + res.count + ' <?php echo e(__('out of')); ?> ' + res.total + ' <?php echo e(__('results')); ?>');
                                } else {
                                    $('.search_talent_result').html(res);
                                    updateTalentCountFromDOM();
                                }
                            }
                            updateActiveFilters();
                        }
                    });
                });

                // ===== ACTIVE FILTERS DISPLAY =====
                function updateActiveFilters() {
                    let activeFilters = [];

                    if ($('#category').val()) {
                        activeFilters.push({
                            name: $('#category option:selected').text(),
                            field: 'category'
                        });
                    }

                    if ($('#subcategory').val()) {
                        activeFilters.push({
                            name: $('#subcategory option:selected').text(),
                            field: 'subcategory'
                        });
                    }

                    if ($('#skills').val()) {
                        activeFilters.push({
                            name: $('#skills option:selected').text(),
                            field: 'skills'
                        });
                    }

                    if ($('#country').val()) {
                        activeFilters.push({
                            name: $('#country option:selected').text(),
                            field: 'country'
                        });
                    }

                    if ($('#state').val()) {
                        activeFilters.push({
                            name: $('#state option:selected').text(),
                            field: 'state'
                        });
                    }

                    if ($('#level').val()) {
                        activeFilters.push({
                            name: $('#level option:selected').text(),
                            field: 'level'
                        });
                    }

                    if ($('#talent_badge').val()) {
                        activeFilters.push({
                            name: $('#talent_badge option:selected').text(),
                            field: 'talent_badge'
                        });
                    }

                    let selectedRating = $('input[name="rating"]:checked');
                    if (selectedRating.length && selectedRating.val()) {
                        let ratingLabel = selectedRating.next('label').find('i.text-amber-400').length + ' Stars';
                        activeFilters.push({
                            name: ratingLabel,
                            field: 'rating'
                        });
                    }

                    if ($('#priceMin').val() || $('#priceMax').val()) {
                        activeFilters.push({
                            name: `${$('#priceMin').val() || '0'} - ${$('#priceMax').val() || '∞'}`,
                            field: 'price'
                        });
                    }

                    if ($('#talent_search_string').val()) {
                        activeFilters.push({
                            name: $('#talent_search_string').val(),
                            field: 'search'
                        });
                    }

                    if (activeFilters.length > 0) {
                        $('.active-filters-section').css('display', 'block');
                        let filterHTML = '';

                        activeFilters.forEach(filter => {
                            filterHTML += `
                            <span class="px-3 hover:text-red-600 hover:border-red-600 group py-1 flex items-center justify-center gap-0 text-gray-700 border border-gray-400 rounded-full text-xs cursor-pointer" data-filter-field="${filter.field}">
                                ${filter.name}
                                <button class="ml-2 text-gray-500 group-hover:text-red-600 remove-filter">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </span>
                        `;
                        });

                        $('#active-filters-container').html(filterHTML);
                    } else {
                        $('.active-filters-section').css('display', 'none');
                        $('#active-filters-container').html('');
                    }
                }

                // ===== REMOVE INDIVIDUAL FILTER =====
                $(document).on('click', '.remove-filter', function(e) {
                    e.stopPropagation();

                    let $parent = $(this).closest('[data-filter-field]');
                    let field = $parent.data('filter-field');

                    switch(field) {
                        case 'category':
                            $('#category').val('');
                            break;
                        case 'subcategory':
                            $('#subcategory').val('');
                            break;
                        case 'skills':
                            $('#skills').val('');
                            break;
                        case 'country':
                            $('#country').val('');
                            break;
                        case 'state':
                            $('#state').val('');
                            break;
                        case 'level':
                            $('#level').val('');
                            break;
                        case 'talent_badge':
                            $('#talent_badge').val('');
                            break;
                        case 'rating':
                            $('input[name="rating"]').prop('checked', false);
                            $('#ratingAll').prop('checked', true);
                            break;
                        case 'price':
                            $('#priceMin').val('');
                            $('#priceMax').val('');
                            break;
                        case 'search':
                            $('#talent_search_string').val('');
                            break;
                    }

                    filterTalents();
                });

                // ===== PRICE RANGE SLIDER FUNCTIONALITY =====
                function initializePriceRangeSlider() {
                    const rangeStart = document.getElementById('priceRangeStart');
                    const rangeEnd = document.getElementById('priceRangeEnd');
                    const rangeTrack = document.getElementById('rangeTrack');
                    const priceMin = document.getElementById('priceMin');
                    const priceMax = document.getElementById('priceMax');

                    if (!rangeStart || !rangeEnd || !rangeTrack || !priceMin || !priceMax) {
                        return;
                    }

                    const MIN_VALUE = 0;
                    const MAX_VALUE = 1000;

                    function updateRangeTrack() {
                        const minValue = parseInt(rangeStart.value);
                        const maxValue = parseInt(rangeEnd.value);
                        const range = MAX_VALUE - MIN_VALUE;

                        const minPercent = ((minValue - MIN_VALUE) / range) * 100;
                        const maxPercent = ((maxValue - MIN_VALUE) / range) * 100;

                        rangeTrack.style.left = minPercent + '%';
                        rangeTrack.style.width = (maxPercent - minPercent) + '%';
                    }

                    function updateInputValues() {
                        priceMin.value = parseInt(rangeStart.value);
                        priceMax.value = parseInt(rangeEnd.value);
                    }

                    rangeStart.addEventListener('input', function() {
                        const minVal = parseInt(this.value);
                        const maxVal = parseInt(rangeEnd.value);

                        if (minVal > maxVal) {
                            this.value = maxVal;
                        }

                        updateRangeTrack();
                        updateInputValues();
                        $(priceMin).trigger('input');
                    });

                    rangeEnd.addEventListener('input', function() {
                        const minVal = parseInt(rangeStart.value);
                        const maxVal = parseInt(this.value);

                        if (maxVal < minVal) {
                            this.value = minVal;
                        }

                        updateRangeTrack();
                        updateInputValues();
                        $(priceMax).trigger('input');
                    });

                    priceMin.addEventListener('input', function() {
                        let value = parseInt(this.value) || 0;

                        if (value < MIN_VALUE) value = MIN_VALUE;
                        if (value > MAX_VALUE) value = MAX_VALUE;
                        if (value > parseInt(priceMax.value || MAX_VALUE)) value = parseInt(priceMax.value);

                        rangeStart.value = value;
                        updateRangeTrack();
                    });

                    priceMax.addEventListener('input', function() {
                        let value = parseInt(this.value) || MAX_VALUE;

                        if (value < MIN_VALUE) value = MIN_VALUE;
                        if (value > MAX_VALUE) value = MAX_VALUE;
                        if (value < parseInt(priceMin.value || 0)) value = parseInt(priceMin.value);

                        rangeEnd.value = value;
                        updateRangeTrack();
                    });

                    updateRangeTrack();
                }

                // Initialize price range slider on page load
                setTimeout(function() {
                    initializePriceRangeSlider();
                }, 500);

                // Re-initialize when sidebar opens
                $(document).on('click', '#filter', function() {
                    setTimeout(initializePriceRangeSlider, 200);
                });

                // Helper function to update talent count from DOM
                function updateTalentCountFromDOM() {
                    let talentCards = $('.search_talent_result').find('.bg-white.border.border-[#C4C8CE]').length;
                    if (talentCards > 0) {
                        $('.talent-count-display').html('<?php echo e(__('Showing')); ?> ' + talentCards + ' <?php echo e(__('out of')); ?> ' + talentCards + ' <?php echo e(__('results')); ?>');
                    }
                }

                // Initial update
                updateActiveFilters();

            });
        }

        // Initialize
        initTalentFilter();
    })();
</script><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/pages/talent/talent-filter-js.blade.php ENDPATH**/ ?>