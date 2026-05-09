
<script>
    (function ($) {
        "use strict";

        $(document).ready(function () {
            console.log('Job Filter - Standard Select Version');

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
                        url: window.routes.subcategoryAll,
                        data: {
                            category: category,
                            _token: window.csrfToken
                        },
                        success: function(res) {
                            if (res.status === 'success') {
                                let subcategorySelect = $('#subcategory');
                                subcategorySelect.empty().append('<option value="">Select Subcategory</option>');

                                if (res.subcategories && res.subcategories.length > 0) {
                                    res.subcategories.forEach(function(subcat) {
                                        subcategorySelect.append(
                                            $('<option></option>').val(subcat.id).text(subcat.sub_category)
                                        );
                                    });
                                    $('#subcategory_info').html('');
                                } else {
                                    $('#subcategory_info').html('<span class="text-red-500 text-sm">No subcategories found!</span>');
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
                    $('#subcategory').empty().append('<option value="">Select Subcategory</option>');
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
                        url: window.routes.stateAll,
                        data: {
                            country: country,
                            _token: window.csrfToken
                        },
                        success: function(res) {
                            if (res.status === 'success') {
                                let stateSelect = $('#state');
                                stateSelect.empty().append('<option value="">Select State</option>');

                                if (res.states && res.states.length > 0) {
                                    res.states.forEach(function(state) {
                                        stateSelect.append(
                                            $('<option></option>').val(state.id).text(state.state)
                                        );
                                    });
                                    $('#state_info').html('');
                                } else {
                                    $('#state_info').html('<span class="text-red-500 text-sm">No states found!</span>');
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
                    $('#state').empty().append('<option value="">Select State</option>');
                }
            });

            // ===== FILTER ON CHANGE =====
            $(document).on('change', '#subcategory, #state, #skills, #type, #level, #duration', function() {
                console.log('Filter changed:', $(this).attr('id'));
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
                    // Show extra options
                    $extraOptions.removeClass('hidden');
                    $btn.html('<span>-</span> <span>Show Less</span>');
                } else {
                    // Hide extra options
                    $extraOptions.addClass('hidden');
                    $btn.html('<span>+</span> <span>Show More</span>');
                }
            });

            // ===== SEARCH BY TEXT =====
            let searchTimeout;
            let lastSearchQuery = '';

            $(document).on('input', '#job_search_string', function (e) {
                const searchQuery = $(this).val().trim();

                // Clear previous timeout
                clearTimeout(searchTimeout);

                // If search query is empty, trigger filter immediately
                if (searchQuery === '') {
                    filterJobs();
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
                        filterJobs();
                        lastSearchQuery = searchQuery;
                    }
                    // If user clears input, still trigger filter to show all results
                    else if (searchQuery.length === 0) {
                        filterJobs();
                        lastSearchQuery = '';
                    }
                }, 500); // 500ms delay
            });

             // Keep Enter key functionality for accessibility
            $(document).on('keydown', '#job_search_string', function (e) {
                if (e.key === 'Enter' || e.which === 13) {
                    e.preventDefault();
                    clearTimeout(searchTimeout); // Clear any pending timeout
                    filterJobs();
                }
            });

            // ===== SORT BY =====
            $(document).on('change', '#sort_by', function() {
                filterJobs();
            });

            // ===== PRICE RANGE =====
            // Trigger filter when user stops moving the slider (debounced)
            let priceFilterTimeout;

            $(document).on('input', '#min_price, #max_price', function() {
                clearTimeout(priceFilterTimeout);
                priceFilterTimeout = setTimeout(function() {
                    let min_price = $('#min_price').val();
                    let max_price = $('#max_price').val();

                    // Filter if at least one value exists
                    if (min_price || max_price) {
                        min_price = min_price ? parseFloat(min_price) : 0;
                        max_price = max_price ? parseFloat(max_price) : 999999;

                        // Validate values
                        if (min_price >= 0 && max_price >= 0 && min_price <= max_price) {
                            filterJobs();
                        }
                    } else {
                        // If both are cleared, reset the filter
                        filterJobs();
                    }
                }, 500); // 500ms delay after user stops typing/sliding
            });


            // ===== MAIN FILTER FUNCTION =====
            function filterJobs() {
                console.log('=== FILTERING JOBS ===');

                // Get selected date filter
                let datePosted = '';
                let selectedDate = $('input[name="datePosted"]:checked');
                if (selectedDate.length) {
                    datePosted = selectedDate.attr('id');
                }

                let filterData = {
                    category: $('#category').val(),
                    subcategory: $('#subcategory').val() ? [$('#subcategory').val()] : [], // Convert to array
                    country: $('#country').val(),
                    state: $('#state').val() ? [$('#state').val()] : [], // Convert to array
                    skills: $('#skills').val() ? [$('#skills').val()] : [], // Convert to array
                    type: $('#type').val(),
                    level: $('#level').val(),
                    min_price: $('#min_price').val(),
                    max_price: $('#max_price').val(),
                    duration: $('#duration').val(),
                    job_search_string: $('#job_search_string').val(),
                    sort_by: $('#sort_by').val(),
                    page: 1
                };

                // Only add date_posted if a radio button is actually selected
                if (datePosted) {
                    filterData.date_posted = datePosted;
                }

                console.log('Filter data:', filterData);

                $.ajax({
                    url: window.routes.jobsFilter,
                    method: 'GET',
                    data: filterData,
                    beforeSend: function() {
                        $('.search_job_result').html('<div class="col-span-2 text-center py-8"><p class="text-gray-600">Loading...</p></div>');
                        $('.job-count-display').html('Loading...');
                    },
                    success: function(res) {
                        if (res.status === 'nothing') {
                            $('.search_job_result').html(`
            <div class="col-span-2">
                <section>
                    <div class="flex items-center justify-center min-h-[calc(100vh-171px)] w-full py-10">
                        <div class="max-w-md flex flex-col items-center justify-center">
                         <img src="/assets/frontend/new_design/assets/images/error-images/no_jobs_found.svg" alt="nothing-found">
                            <p class="text-base-300 text-2xl">Ops! Sorry, no results found.</p>
                        </div>
                    </div>
                </section>
            </div>
        `);
                            $('.job-count-display').html('Showing 0 results');
                        } else {
                            if (res.html) {
                                $('.search_job_result').html(res.html);
                                $('.job-count-display').html('Showing ' + res.count + ' out of ' + res.total + ' results');

                                // === UPDATE MAX PRICE IF AVAILABLE ===
                                if (res.max_price !== undefined) {
                                    window.maxJobPrice = res.max_price;
                                    console.log('Updated max price from filter:', window.maxJobPrice);
                                }
                            } else {
                                $('.search_job_result').html(res);
                                // Extract count from response if available
                                updateJobCountFromDOM();
                            }
                        }

                        updateActiveFilters();
                    },
                    error: function(xhr) {
                        console.error('Filter error:', xhr);
                        alert('An error occurred. Please try again.');
                    }
                });
            }

            function loadPaginationContent(url) {
                // Parse the URL to get page number only
                const urlObj = new URL(url, window.location.origin);
                const page = urlObj.searchParams.get('page') || 1;

                // Get selected date filter
                let datePosted = '';
                let selectedDate = $('input[name="datePosted"]:checked');
                if (selectedDate.length) {
                    datePosted = selectedDate.attr('id');
                }

                // Build filter data object with current filters
                let filterData = {
                    category: $('#category').val() || '',
                    subcategory: $('#subcategory').val() ? [$('#subcategory').val()] : [],
                    country: $('#country').val() || '',
                    state: $('#state').val() ? [$('#state').val()] : [],
                    skills: $('#skills').val() ? [$('#skills').val()] : [],
                    type: $('#type').val() || '',
                    level: $('#level').val() || '',
                    min_price: $('#min_price').val() || '',
                    max_price: $('#max_price').val() || '',
                    duration: $('#duration').val() || '',
                    job_search_string: $('#job_search_string').val() || '',
                    sort_by: $('#sort_by').val() || '',
                    page: page
                };

                // Only add date_posted if a radio button is actually selected
                if (datePosted) {
                    filterData.date_posted = datePosted;
                }

                console.log('Pagination filter data:', filterData);

                // Make AJAX request
                $.ajax({
                    url: window.routes.jobsFilter,
                    method: 'GET',
                    data: filterData,
                    beforeSend: function() {
                        $('.search_job_result').css('opacity', '0.5');
                        // Scroll to top of results smoothly
                        $('html, body').animate({
                            scrollTop: $('.search_job_result').offset().top - 100
                        }, 300);
                    },
                    success: function(res) {
                        if (res.status === 'nothing') {
                            $('.search_job_result').html(`
                    <div class="col-span-2">
                        <section>
                            <div class="flex items-center justify-center min-h-[calc(100vh-171px)] w-full py-10">
                                <div class="max-w-md flex flex-col items-center justify-center">
                                    <img src="/assets/frontend/new_design/assets/images/error-images/no_jobs_found.svg" alt="nothing-found">
                                    <p class="text-base-300 text-2xl">Ops! Sorry, no results found.</p>
                                </div>
                            </div>
                        </section>
                    </div>
                `);
                            $('.job-count-display').html('Showing 0 results');
                        } else {
                            if (res.html) {
                                $('.search_job_result').html(res.html);
                                $('.job-count-display').html('Showing ' + res.count + ' out of ' + res.total + ' results');

                                // Update max price if available
                                if (res.max_price !== undefined) {
                                    window.maxJobPrice = res.max_price;
                                    console.log('Updated max price from pagination:', window.maxJobPrice);
                                }
                            }
                        }
                        $('.search_job_result').css('opacity', '1');

                        // Update active filters
                        updateActiveFilters();
                    },
                    error: function(xhr) {
                        console.error('Pagination error:', xhr);
                        $('.search_job_result').css('opacity', '1');
                        alert('An error occurred while loading the page. Please try again.');
                    }
                });
            }

            // ===== RESET FILTERS =====
            $(document).on('click', '#job_filter_reset, #clear-all-filters', function(e) {
                e.preventDefault();

                $('#country').val('');
                $('#category').val('');
                $('#subcategory').val('');
                $('#state').val('');
                $('#skills').val('');
                $('#type').val('');
                $('#level').val('');
                $('#min_price').val('');
                $('#max_price').val('');
                $('#duration').val('');
                $('#job_search_string').val('');
                $('#sort_by').val('');

                // Reset date posted radio buttons - NO DEFAULT
                $('input[name="datePosted"]').prop('checked', false);

                $.ajax({
                    url: window.routes.jobsFilterReset,
                    method: 'GET',
                    success: function(res) {
                        if (res.status === 'nothing') {
                            $('.search_job_result').html('<div class="col-span-2 text-center py-8"><h3 class="text-2xl text-red-500">Nothing Found</h3></div>');
                            $('.job-count-display').html('Showing 0 results');
                        } else {
                            if (res.html) {
                                $('.search_job_result').html(res.html);
                                $('.job-count-display').html('Showing ' + res.count + ' out of ' + res.total + ' results');

                                // === UPDATE MAX PRICE IF AVAILABLE ===
                                if (res.max_price !== undefined) {
                                    window.maxJobPrice = res.max_price;
                                    console.log('Updated max price from reset:', window.maxJobPrice);
                                }
                            } else {
                                $('.search_job_result').html(res);
                                updateJobCountFromDOM();
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

                // Skills
                if ($('#skills').val()) {
                    activeFilters.push({
                        name: $('#skills option:selected').text(),
                        field: 'skills'
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


            // ===== PRICE RANGE SLIDER FUNCTIONALITY =====
            function initializePriceRangeSlider() {
                const rangeStart = document.getElementById('priceRangeStart');
                const rangeEnd = document.getElementById('priceRangeEnd');
                const rangeTrack = document.getElementById('rangeTrack');
                const priceMin = document.getElementById('min_price');
                const priceMax = document.getElementById('max_price');

                console.log('Initializing price range slider...');
                console.log('Elements:', { rangeStart, rangeEnd, rangeTrack, priceMin, priceMax });

                // === USE DYNAMIC MAX VALUE ===
                const MIN_VALUE = 0;
                const MAX_VALUE = window.maxJobPrice || 1000; // Use dynamic max value

                console.log('Using max price:', MAX_VALUE);

                if (!rangeStart || !rangeEnd || !rangeTrack || !priceMin || !priceMax) {
                    console.error('Price range elements not found');
                    return;
                }

                // Update max attribute of both sliders
                rangeStart.setAttribute('max', MAX_VALUE);
                rangeEnd.setAttribute('max', MAX_VALUE);

                // Set initial values
                rangeStart.value = MIN_VALUE;
                rangeEnd.value = MAX_VALUE;

                function updateRangeTrack() {
                    // ADD THIS CODE TO PREVENT HANDLE COLLISION
                    const minVal = parseInt(rangeStart.value);
                    const maxVal = parseInt(rangeEnd.value);

                    if (maxVal - minVal < 10) {
                        if (rangeStart === document.activeElement) {
                            rangeEnd.value = minVal + 10;
                        } else if (rangeEnd === document.activeElement) {
                            rangeStart.value = maxVal - 10;
                        }
                    }

                    const range = MAX_VALUE - MIN_VALUE;
                    const minPercent = ((parseInt(rangeStart.value) - MIN_VALUE) / range) * 100;
                    const maxPercent = ((parseInt(rangeEnd.value) - MIN_VALUE) / range) * 100;

                    rangeTrack.style.left = minPercent + '%';
                    rangeTrack.style.width = (maxPercent - minPercent) + '%';

                    console.log('Range track updated:', {
                        minValue: rangeStart.value,
                        maxValue: rangeEnd.value,
                        minPercent,
                        maxPercent
                    });
                }

                function updateInputValues() {
                    priceMin.value = parseInt(rangeStart.value);
                    priceMax.value = parseInt(rangeEnd.value);
                }

                // Range slider: Start input
                rangeStart.addEventListener('input', function() {
                    const minVal = parseInt(this.value);
                    const maxVal = parseInt(rangeEnd.value);

                    if (minVal > maxVal) {
                        this.value = maxVal;
                    }

                    updateRangeTrack();
                    updateInputValues();

                    // Trigger jQuery input event to fire the filter
                    $(priceMin).trigger('input');
                });

                // Range slider: End input
                rangeEnd.addEventListener('input', function() {
                    const minVal = parseInt(rangeStart.value);
                    const maxVal = parseInt(this.value);

                    if (maxVal < minVal) {
                        this.value = minVal;
                    }

                    updateRangeTrack();
                    updateInputValues();

                    // Trigger jQuery input event to fire the filter
                    $(priceMax).trigger('input');
                });

                // Text input: Min price
                priceMin.addEventListener('input', function() {
                    let value = parseInt(this.value) || 0;

                    if (value < MIN_VALUE) value = MIN_VALUE;
                    if (value > MAX_VALUE) value = MAX_VALUE;
                    if (value > parseInt(priceMax.value)) value = parseInt(priceMax.value);

                    rangeStart.value = value;
                    updateRangeTrack();
                    // jQuery event listener will catch this automatically
                });

                // Text input: Max price
                priceMax.addEventListener('input', function() {
                    let value = parseInt(this.value) || 0;

                    if (value < MIN_VALUE) value = MIN_VALUE;
                    if (value > MAX_VALUE) value = MAX_VALUE;
                    if (value < parseInt(priceMin.value)) value = parseInt(priceMin.value);

                    rangeEnd.value = value;
                    updateRangeTrack();
                    // jQuery event listener will catch this automatically
                });

                // Clear input fields and set different slider positions
                priceMin.value = '';
                priceMax.value = '';
                updateRangeTrack();
                console.log('Price range slider initialized with max:', MAX_VALUE);
            }

            // Initialize when sidebar opens
            $(document).on('click', '#filter', function() {
                setTimeout(initializePriceRangeSlider, 100);
            });

            // Helper function to update job count from DOM
            function updateJobCountFromDOM() {
                let jobCards = $('.search_job_result').find('.bg-white.border.border-gray-200').length;
                if (jobCards > 0) {
                    $('.job-count-display').html('Showing all ' + jobCards + ' results');
                }
            }

            // Initial update
            updateActiveFilters();

            console.log('=== Job Filter Loaded ===');
            console.log('Initial max price:', window.maxJobPrice);
        });
    }(jQuery));

</script>
