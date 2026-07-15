<script>
    (function ($) {
        "use strict";

        $(document).ready(function () {
            console.log('Skill Jobs Filter - Debug Version');

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

            // ===== PAGINATION HANDLER =====
            $(document).on('click', '.pagination-link', function(e) {
                e.preventDefault();
                let url = $(this).data('url');
                console.log('Pagination clicked:', url);
                if (url) {
                    loadPaginationContent(url);
                }
            });

            // ===== CATEGORY & SUBCATEGORY =====
            $(document).on('change', '#category', function() {
                let category = $(this).val();
                console.log('Category changed:', category);

                if (category) {
                    $('#subcategory_info').show();

                    $.ajax({
                        method: 'POST',
                        url: "<?php echo e(route('au.subcategory.all')); ?>",
                        data: {
                            category: category,
                            _token: window.csrfToken
                        },
                        success: function(res) {
                            console.log('Subcategories loaded:', res);
                            if (res.status === 'success') {
                                let subcategorySelect = $('#subcategory');
                                subcategorySelect.empty().append('<option value=""><?php echo e(__("Select Subcategory")); ?></option>');

                                if (res.subcategories && res.subcategories.length > 0) {
                                    res.subcategories.forEach(function(subcat) {
                                        subcategorySelect.append(
                                            $('<option></option>').val(subcat.id).text(subcat.sub_category)
                                        );
                                    });
                                    $('#subcategory_info').html('');
                                } else {
                                    $('#subcategory_info').html('<span class="text-red-500 text-sm"><?php echo e(__("No subcategories found!")); ?></span>');
                                }
                            }
                        },
                        error: function(xhr) {
                            console.error('Subcategory error:', xhr);
                        }
                    });

                    filterJobs();
                } else {
                    $('#subcategory_info').hide();
                    $('#subcategory').empty().append('<option value=""><?php echo e(__("Select Subcategory")); ?></option>');
                    filterJobs();
                }
            });

            // ===== COUNTRY & STATE =====
            $(document).on('change', '#country', function() {
                let country = $(this).val();
                console.log('Country changed:', country);

                if (country) {
                    $('#state_info').show();

                    $.ajax({
                        method: 'POST',
                        url: "<?php echo e(route('au.state.all')); ?>",
                        data: {
                            country: country,
                            _token: window.csrfToken
                        },
                        success: function(res) {
                            console.log('States loaded:', res);
                            if (res.status === 'success') {
                                let stateSelect = $('#state');
                                stateSelect.empty().append('<option value=""><?php echo e(__("Select State")); ?></option>');

                                if (res.states && res.states.length > 0) {
                                    res.states.forEach(function(state) {
                                        stateSelect.append(
                                            $('<option></option>').val(state.id).text(state.state)
                                        );
                                    });
                                    $('#state_info').html('');
                                } else {
                                    $('#state_info').html('<span class="text-red-500 text-sm"><?php echo e(__("No states found!")); ?></span>');
                                }
                            }
                        },
                        error: function(xhr) {
                            console.error('State error:', xhr);
                        }
                    });

                    filterJobs();
                } else {
                    $('#state_info').hide();
                    $('#state').empty().append('<option value=""><?php echo e(__("Select State")); ?></option>');
                    filterJobs();
                }
            });

            // ===== FILTER ON CHANGE =====
            $(document).on('change', '#subcategory, #state, #type, #level, #duration', function() {
                console.log('Filter changed:', $(this).attr('id'), 'value:', $(this).val());
                filterJobs();
            });

            // ===== DATE POSTED FILTER =====
            $(document).on('change', 'input[name="datePosted"]', function() {
                console.log('Date filter changed:', $(this).attr('id'));
                filterJobs();
            });

            // Show More button for date options
            $(document).on('click', '#showMoreBtn', function(e) {
                e.preventDefault();
                let $extraOptions = $('#extraOptions');
                let $btn = $(this);

                if ($extraOptions.hasClass('hidden')) {
                    $extraOptions.removeClass('hidden');
                    $btn.html('<span>-</span> <span><?php echo e(__("Show Less")); ?></span>');
                } else {
                    $extraOptions.addClass('hidden');
                    $btn.html('<span>+</span> <span><?php echo e(__("Show More")); ?></span>');
                }
            });

            // ===== SEARCH BY TEXT =====
            $(document).on('keydown', '#job_search_string', function (e) {
                if (e.key === 'Enter' || e.which === 13) {
                    e.preventDefault();
                    console.log('Search by text (Enter):', $(this).val());
                    filterJobs();
                }
            });

            // ===== SORT BY =====
            $(document).on('change', '#sort_by', function() {
                console.log('Sort by changed:', $(this).val());
                filterJobs();
            });

            // ===== PRICE RANGE =====
            let priceFilterTimeout;
            $(document).on('input', '#min_price, #max_price', function() {
                clearTimeout(priceFilterTimeout);
                priceFilterTimeout = setTimeout(function() {
                    let min_price = $('#min_price').val();
                    let max_price = $('#max_price').val();
                    console.log('Price range changed - min:', min_price, 'max:', max_price);

                    if (min_price || max_price) {
                        min_price = min_price ? parseFloat(min_price) : 0;
                        max_price = max_price ? parseFloat(max_price) : 999999;

                        if (min_price >= 0 && max_price >= 0 && min_price <= max_price) {
                            filterJobs();
                        }
                    } else {
                        filterJobs();
                    }
                }, 500);
            });

            // ===== MAIN FILTER FUNCTION =====
            function filterJobs() {
                console.log('=== FILTERING JOBS ===');

                // Get selected date filter
                let datePosted = '';
                let selectedDate = $('input[name="datePosted"]:checked');
                if (selectedDate.length) {
                    datePosted = selectedDate.attr('id');
                    console.log('Date posted selected:', datePosted);
                }

                let filterData = {
                    skill: window.skillId,
                    category: $('#category').val(),
                    subcategory: $('#subcategory').val() ? [$('#subcategory').val()] : [],
                    country: $('#country').val(),
                    state: $('#state').val() ? [$('#state').val()] : [],
                    type: $('#type').val(),
                    level: $('#level').val(),
                    min_price: $('#min_price').val(),
                    max_price: $('#max_price').val(),
                    duration: $('#duration').val(),
                    job_search_string: $('#job_search_string').val(),
                    sort_by: $('#sort_by').val(),
                    page: 1
                };

                if (datePosted) {
                    filterData.date_posted = datePosted;
                }

                console.log('Filter data to send:', filterData);
                console.log('Route URL:', window.routes.skillJobsFilter);

                $.ajax({
                    url: window.routes.skillJobsFilter,
                    method: 'GET',
                    data: filterData,
                    beforeSend: function() {
                        console.log('Sending AJAX request...');
                        $('.search_job_result').html('<div class="col-span-2 text-center py-8"><p class="text-gray-600"><?php echo e(__("Loading...")); ?></p></div>');
                        $('.job-count-display').html('<?php echo e(__("Loading...")); ?>');
                    },
                        success: function(res) {
                            console.log('AJAX Success Response:', res);
                            if (res.status === 'nothing') {
                                console.log('No results found');
                                $('.search_job_result').html(`
            <div class="col-span-2">
                <section>
                    <div class="flex items-center justify-center min-h-[calc(100vh-171px)] w-full py-10">
                        <div class="max-w-md flex flex-col items-center justify-center">
                            <img src="<?php echo e(asset('assets/frontend/new_design/assets/images/error-images/no_jobs_found.svg')); ?>" alt="nothing-found">
                            <p class="text-base-300 text-2xl"><?php echo e(__("Ops! Sorry, no results found.")); ?></p>
                        </div>
                    </div>
                </section>
            </div>
        `);
                                $('.job-count-display').html('<?php echo e(__("Showing 0 results")); ?>');
                            } else {
                                console.log('Results found, updating HTML');
                                if (res.html) {
                                    $('.search_job_result').html(res.html);
                                    $('.job-count-display').html('<?php echo e(__("Showing")); ?> ' + res.count + ' <?php echo e(__("out of")); ?> ' + res.total + ' <?php echo e(__("results")); ?>');
                                } else {
                                    console.error('No HTML in response:', res);
                                }
                            }
                            updateActiveFilters();
                        },
                    error: function(xhr, status, error) {
                        console.error('Filter AJAX Error:');
                        console.error('Status:', status);
                        console.error('Error:', error);
                        console.error('XHR:', xhr);
                        console.error('Response Text:', xhr.responseText);

                        // Show error message
                        $('.search_job_result').html(`
                            <div class="col-span-2">
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                                    <p class="font-bold"><?php echo e(__("Error occurred")); ?></p>
                                    <p><?php echo e(__("Please try again or contact support if the issue persists.")); ?></p>
                                    <p class="text-sm mt-2">Error: ${xhr.status} - ${xhr.statusText}</p>
                                    <p class="text-sm">Response: ${xhr.responseText ? xhr.responseText.substring(0, 200) : 'No response'}</p>
                                </div>
                            </div>
                        `);
                        $('.job-count-display').html('<?php echo e(__("Error loading jobs")); ?>');
                    }
                });
            }

            function loadPaginationContent(url) {
                console.log('Loading pagination content:', url);
                const urlObj = new URL(url, window.location.origin);

                let datePosted = '';
                let selectedDate = $('input[name="datePosted"]:checked');
                if (selectedDate.length) {
                    datePosted = selectedDate.attr('id');
                }

                const page = urlObj.searchParams.get('page') || 1;

                let filterData = {
                    skill: window.skillId,
                    category: $('#category').val(),
                    subcategory: $('#subcategory').val() ? [$('#subcategory').val()] : [],
                    country: $('#country').val(),
                    state: $('#state').val() ? [$('#state').val()] : [],
                    type: $('#type').val(),
                    level: $('#level').val(),
                    min_price: $('#min_price').val(),
                    max_price: $('#max_price').val(),
                    duration: $('#duration').val(),
                    job_search_string: $('#job_search_string').val(),
                    sort_by: $('#sort_by').val(),
                    page: page
                };

                if (datePosted) {
                    filterData.date_posted = datePosted;
                }

                console.log('Pagination filter data:', filterData);

                $.ajax({
                    url: window.routes.skillJobsFilter,
                    method: 'GET',
                    data: filterData,
                    beforeSend: function() {
                        $('.search_job_result').css('opacity', '0.5');
                    },
                    success: function(res) {
                        console.log('Pagination Success:', res);
                        if (res.status === 'nothing') {
                            $('.search_job_result').html(`...`);
                            $('.job-count-display').html('<?php echo e(__("Showing 0 results")); ?>');
                        } else {
                            if (res.html) {
                                $('.search_job_result').html(res.html);
                                $('.job-count-display').html('<?php echo e(__("Showing")); ?> ' + res.count + ' <?php echo e(__("out of")); ?> ' + res.total + ' <?php echo e(__("results")); ?>');
                            }
                        }
                        $('.search_job_result').css('opacity', '1');
                        updateActiveFilters();
                    },
                    error: function(xhr) {
                        console.error('Pagination error:', xhr);
                        $('.search_job_result').css('opacity', '1');
                    }
                });
            }

            // ===== RESET FILTERS =====
            $(document).on('click', '#clear-all-filters', function(e) {
                e.preventDefault();
                console.log('Resetting all filters');

                $('#country').val('').trigger('change');
                $('#category').val('').trigger('change');
                $('#subcategory').val('');
                $('#state').val('');
                $('#type').val('');
                $('#level').val('');
                $('#min_price').val('');
                $('#max_price').val('');
                $('#duration').val('');
                $('#job_search_string').val('');
                $('#sort_by').val('');

                // Reset date posted radio buttons
                $('input[name="datePosted"]').prop('checked', false);

                $.ajax({
                    url: window.routes.skillJobsFilterReset,
                    method: 'GET',
                    data: { skill: window.skillId },
                    success: function(res) {
                        console.log('Reset Success:', res);
                        if (res.status === 'nothing') {
                            $('.search_job_result').html(`...`);
                            $('.job-count-display').html('<?php echo e(__("Showing 0 results")); ?>');
                        } else {
                            if (res.html) {
                                $('.search_job_result').html(res.html);
                                $('.job-count-display').html('<?php echo e(__("Showing")); ?> ' + res.count + ' <?php echo e(__("out of")); ?> ' + res.total + ' <?php echo e(__("results")); ?>');
                            }
                        }
                        updateActiveFilters();
                    }
                });
            });

            // ===== ACTIVE FILTERS DISPLAY =====
            function updateActiveFilters() {
                let activeFilters = [];

                // Category
                if ($('#category').val()) {
                    activeFilters.push({
                        name: $('#category option:selected').text(),
                        field: 'category'
                    });
                }

                // Subcategory
                if ($('#subcategory').val()) {
                    activeFilters.push({
                        name: $('#subcategory option:selected').text(),
                        field: 'subcategory'
                    });
                }

                // Country
                if ($('#country').val()) {
                    activeFilters.push({
                        name: $('#country option:selected').text(),
                        field: 'country'
                    });
                }

                // State
                if ($('#state').val()) {
                    activeFilters.push({
                        name: $('#state option:selected').text(),
                        field: 'state'
                    });
                }

                // Type
                if ($('#type').val()) {
                    activeFilters.push({
                        name: $('#type option:selected').text(),
                        field: 'type'
                    });
                }

                // Level
                if ($('#level').val()) {
                    activeFilters.push({
                        name: $('#level option:selected').text(),
                        field: 'level'
                    });
                }

                // Duration
                if ($('#duration').val()) {
                    activeFilters.push({
                        name: $('#duration option:selected').text(),
                        field: 'duration'
                    });
                }

                // Price Range
                if ($('#min_price').val() || $('#max_price').val()) {
                    activeFilters.push({
                        name: `$${$('#min_price').val() || '0'} - $${$('#max_price').val() || '∞'}`,
                        field: 'price'
                    });
                }

                // Search String
                if ($('#job_search_string').val()) {
                    activeFilters.push({
                        name: $('#job_search_string').val(),
                        field: 'search'
                    });
                }

                // Date Posted
                let selectedDate = $('input[name="datePosted"]:checked');
                if (selectedDate.length) {
                    let dateLabel = selectedDate.next('label').text();
                    activeFilters.push({
                        name: dateLabel,
                        field: 'datePosted'
                    });
                }

                // Display active filters
                if (activeFilters.length > 0) {
                    $('.active-filters-section').show();
                    let filterHTML = '';

                    activeFilters.forEach(filter => {
                        filterHTML += `
                            <span class="px-3 hover:text-red-600 hover:border-red-600 group py-1 flex items-center justify-center gap-0 text-gray-700 border border-gray-400 rounded-full text-xs cursor-pointer" data-filter-field="${filter.field}">
                                ${filter.name}
                                <button class="ml-2 text-gray-500 group-hover:text-red-600 remove-filter">
                                    <svg xmlns="http://www.w3.org2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </span>
                        `;
                    });

                    $('#active-filters-container').html(filterHTML);
                } else {
                    $('.active-filters-section').hide();
                }
            }

            // ===== REMOVE INDIVIDUAL FILTER =====
            $(document).on('click', '.remove-filter', function(e) {
                e.stopPropagation();

                let $parent = $(this).closest('[data-filter-field]');
                let field = $parent.data('filter-field');

                console.log('Removing filter:', field);

                switch(field) {
                    case 'category':
                        $('#category').val('').trigger('change');
                        break;
                    case 'subcategory':
                        $('#subcategory').val('');
                        break;
                    case 'country':
                        $('#country').val('').trigger('change');
                        break;
                    case 'state':
                        $('#state').val('');
                        break;
                    case 'type':
                        $('#type').val('');
                        break;
                    case 'level':
                        $('#level').val('');
                        break;
                    case 'duration':
                        $('#duration').val('');
                        break;
                    case 'price':
                        $('#min_price').val('');
                        $('#max_price').val('');
                        break;
                    case 'search':
                        $('#job_search_string').val('');
                        break;
                    case 'datePosted':
                        $('input[name="datePosted"]').prop('checked', false);
                        break;
                }

                filterJobs();
            });

            // Initial update
            updateActiveFilters();

            console.log('=== Skill Jobs Filter Loaded ===');
        });
    }(jQuery));
</script><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/pages/skill-jobs/jobs-filter-js.blade.php ENDPATH**/ ?>