<script>
    (function () {
        "use strict";

        // Wait for jQuery to be available
        function initProjectFilter() {
            if (typeof jQuery === 'undefined') {
                setTimeout(initProjectFilter, 50);
                return;
            }

            var $ = jQuery;

            // Define routes
            window.routes = window.routes || {};
            window.routes.subcategoryAll = "<?php echo e(route('au.subcategory.all')); ?>";
            window.routes.stateAll = "<?php echo e(route('au.state.all')); ?>";
            window.routes.projectsFilter = "<?php echo e(route('projects.filter')); ?>";
            window.routes.projectsPagination = "<?php echo e(route('projects.pagination')); ?>";
            window.routes.projectsFilterReset = "<?php echo e(route('projects.filter.reset')); ?>";
            window.csrfToken = "<?php echo e(csrf_token()); ?>";

            console.log('=== Project Filter Routes Configured ===');

            $(document).ready(function () {
                console.log('Project Filter Initialized');

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
                $(document).on('change', '#sidebar #category, #category', function() {
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
                                    let subcategorySelect = $('#sidebar #subcategory');
                                    subcategorySelect.empty().append('<option value=""><?php echo e(__('Select Subcategory')); ?></option>');

                                    if (res.subcategories && res.subcategories.length > 0) {
                                        res.subcategories.forEach(function(subcat) {
                                            subcategorySelect.append(
                                                $('<option></option>').val(subcat.id).text(subcat.sub_category)
                                            );
                                        });
                                        $('#subcategory_info').html('');
                                    } else {
                                        $('#subcategory_info').html('<span class="text-red-500 text-sm"><?php echo e(__('No subcategories found!')); ?></span>');
                                    }
                                }
                            },
                            error: function(xhr) {
                                console.error('Subcategory error:', xhr);
                            }
                        });

                        filterProjects();
                    } else {
                        $('#subcategory_info').hide();
                        $('#sidebar #subcategory').empty().append('<option value=""><?php echo e(__('Select Subcategory')); ?></option>');
                    }
                });

                // ===== COUNTRY & STATE =====
                $(document).on('change', '#sidebar #country, #country', function() {
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
                                    let stateSelect = $('#sidebar #state');
                                    stateSelect.empty().append('<option value=""><?php echo e(__('Select State')); ?></option>');

                                    if (res.states && res.states.length > 0) {
                                        res.states.forEach(function(state) {
                                            stateSelect.append(
                                                $('<option></option>').val(state.id).text(state.state)
                                            );
                                        });
                                        $('#state_info').html('');
                                    } else {
                                        $('#state_info').html('<span class="text-red-500 text-sm"><?php echo e(__('No states found!')); ?></span>');
                                    }
                                }
                            },
                            error: function(xhr) {
                                console.error('State error:', xhr);
                            }
                        });

                        filterProjects();
                    } else {
                        $('#state_info').hide();
                        $('#sidebar #state').empty().append('<option value=""><?php echo e(__('Select State')); ?></option>');
                    }
                });

                // ===== STATE & CITY =====
                $(document).on('change', '#sidebar #state, #state', function() {
                    let state = $(this).val();
                    console.log('State changed:', state);

                    if (state) {
                        $.ajax({
                            method: 'POST',
                            url: "<?php echo e(route('au.city.all')); ?>",
                            data: {
                                state: state,
                                _token: window.csrfToken
                            },
                            success: function(res) {
                                if (res.status === 'success') {
                                    let citySelect = $('#sidebar #city');
                                    citySelect.empty().append('<option value=""><?php echo e(__('Select City')); ?></option>');

                                    if (res.cities && res.cities.length > 0) {
                                        res.cities.forEach(function(city) {
                                            citySelect.append(
                                                $('<option></option>').val(city.id).text(city.city)
                                            );
                                        });
                                    }
                                }
                            },
                            error: function(xhr) {
                                console.error('City error:', xhr);
                            }
                        });

                        filterProjects();
                    } else {
                        $('#sidebar #city').empty().append('<option value=""><?php echo e(__('Select City')); ?></option>');
                    }
                });

                // ===== FILTER ON CHANGE =====
                $(document).on('change', '#sidebar #subcategory, #sidebar #city, #sidebar #skills, #sidebar #delivery_day', function() {
                    console.log('Filter changed:', $(this).attr('id'));
                    filterProjects();
                });

                // ===== RATING FILTER =====
                $(document).on('change', '#sidebar input[name="rating"], input[name="rating"]', function() {
                    console.log('Rating changed:', $(this).val());
                    filterProjects();
                });

                // ===== SEARCH BY TEXT =====
                let searchTimeout;
                let lastSearchQuery = '';

                $(document).on('input', '#sidebar #project_search_string, #project_search_string', function (e) {
                    const searchQuery = $(this).val().trim();

                    // Clear previous timeout
                    clearTimeout(searchTimeout);

                    // If search query is empty, trigger filter immediately
                    if (searchQuery === '') {
                        filterProjects();
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
                            filterProjects();
                            lastSearchQuery = searchQuery;
                        }
                        // If user clears input, still trigger filter to show all results
                        else if (searchQuery.length === 0) {
                            filterProjects();
                            lastSearchQuery = '';
                        }
                    }, 500); // 500ms delay
                });

// Keep Enter key functionality for accessibility
                $(document).on('keydown', '#sidebar #project_search_string, #project_search_string', function (e) {
                    if (e.key === 'Enter' || e.which === 13) {
                        e.preventDefault();
                        clearTimeout(searchTimeout); // Clear any pending timeout
                        filterProjects();
                    }
                });

                // ===== SORT BY =====
                $(document).on('change', '#sidebar #sort_by, #sort_by', function() {
                    filterProjects();
                });

                // ===== PRICE RANGE =====
                let priceFilterTimeout;

                // Text input changes
                $(document).on('input', '#sidebar #priceMin, #sidebar #priceMax, #priceMin, #priceMax', function() {
                    clearTimeout(priceFilterTimeout);
                    priceFilterTimeout = setTimeout(function() {
                        filterProjects();
                    }, 500);
                });

                // ===== MAIN FILTER FUNCTION =====
                function filterProjects() {
                    console.log('=== FILTERING PROJECTS ===');

                    // Get values from sidebar or main page
                    let category = $('#sidebar #category').val() || $('#category').val() || '';
                    let subcategory = $('#sidebar #subcategory').val() || $('#subcategory').val() || '';
                    let country = $('#sidebar #country').val() || $('#country').val() || '';
                    let state = $('#sidebar #state').val() || $('#state').val() || '';
                    let city = $('#sidebar #city').val() || $('#city').val() || '';
                    let skills = $('#sidebar #skills').val() || $('#skills').val() || '';
                    let delivery_day = $('#sidebar #delivery_day').val() || $('#delivery_day').val() || '';

                    // Get selected rating from sidebar or page
                    let rating = '';
                    let sidebarRating = $('#sidebar input[name="rating"]:checked').val();
                    let pageRating = $('input[name="rating"]:checked').val();
                    rating = sidebarRating || pageRating || '';

                    let min_price = $('#sidebar #priceMin').val() || $('#priceMin').val() || '';
                    let max_price = $('#sidebar #priceMax').val() || $('#priceMax').val() || '';
                    let project_search_string = $('#sidebar #project_search_string').val() || $('#project_search_string').val() || '';
                    let sort_by = $('#sidebar #sort_by').val() || $('#sort_by').val() || '';

                    let filterData = {
                        category: category,
                        subcategory: subcategory ? [subcategory] : [],
                        country: country,
                        state: state ? [state] : [],
                        city: city ? [city] : [],
                        skills: skills ? [skills] : [],
                        delivery_day: delivery_day,
                        rating: rating,
                        min_price: min_price,
                        max_price: max_price,
                        project_search_string: project_search_string,
                        sort_by: sort_by
                    };

                    console.log('Filter data:', filterData);

                    $.ajax({
                        url: window.routes.projectsFilter,
                        method: 'GET',
                        data: filterData,
                        beforeSend: function() {
                            $('.search_project_result').html('<div class="col-span-2 text-center py-8"><p class="text-gray-600"><?php echo e(__('Loading...')); ?></p></div>');
                            $('.project-count-display').html('<?php echo e(__('Loading...')); ?>');
                        },
                        success: function(res) {
                            if (res.status === 'nothing') {
                                $('.search_project_result').html(`
                                    <section>
                                        <div class="flex items-center justify-center h-full w-full py-10">
                                            <div class="max-w-lg flex flex-col items-center justify-center text-center">
                                                <img src="/assets/frontend/new_design/assets/images/error-images/no_service_found.svg" alt="nothing-found">
                                                <p class="text-base-300 text-base-400 text-lg">Sorry, no results found. Don't worry! You can create
                                                a job post and get proposals from top freelancers.</p>
                                                <button
                                                    class=" px-6 mt-6 rounded-full bg-primary hover:bg-primary/90 text-white font-medium py-3 mb-3 transition-colors flex items-center justify-center gap-2">
                                                    <a href="<?php echo e(route('freelancer.project.create')); ?>">Create a job</a>
                                                    <i class="icon-base ti tabler-arrow-right icon-20px text-white -rotate-45"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </section>
                                `);
                                $('.project-count-display').html('<?php echo e(__('Showing 0 results')); ?>');
                            } else {
                                if (res.html) {
                                    $('.search_project_result').html(res.html);
                                    $('.project-count-display').html('<?php echo e(__('Showing')); ?> ' + res.count + ' <?php echo e(__('out of')); ?> ' + res.total + ' <?php echo e(__('results')); ?>');

                                    // === UPDATE MAX PRICE IF AVAILABLE ===
                                    if (res.max_price !== undefined) {
                                        window.maxProjectPrice = res.max_price;
                                        console.log('Updated max project price from filter:', window.maxProjectPrice);
                                    }
                                } else {
                                    $('.search_project_result').html(res);
                                    updateProjectCountFromDOM();
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

                    // Get values from sidebar or main page
                    let category = $('#sidebar #category').val() || $('#category').val() || '';
                    let subcategory = $('#sidebar #subcategory').val() || $('#subcategory').val() || '';
                    let country = $('#sidebar #country').val() || $('#country').val() || '';
                    let state = $('#sidebar #state').val() || $('#state').val() || '';
                    let city = $('#sidebar #city').val() || $('#city').val() || '';
                    let skills = $('#sidebar #skills').val() || $('#skills').val() || '';
                    let delivery_day = $('#sidebar #delivery_day').val() || $('#delivery_day').val() || '';

                    // Get selected rating from sidebar or page
                    let rating = '';
                    let sidebarRating = $('#sidebar input[name="rating"]:checked').val();
                    let pageRating = $('input[name="rating"]:checked').val();
                    rating = sidebarRating || pageRating || '';

                    let min_price = $('#sidebar #priceMin').val() || $('#priceMin').val() || '';
                    let max_price = $('#sidebar #priceMax').val() || $('#priceMax').val() || '';
                    let project_search_string = $('#sidebar #project_search_string').val() || $('#project_search_string').val() || '';
                    let sort_by = $('#sidebar #sort_by').val() || $('#sort_by').val() || '';

                    // Build filter data object
                    let filterData = {
                        category: category,
                        subcategory: subcategory ? [subcategory] : [],
                        country: country,
                        state: state ? [state] : [],
                        city: city ? [city] : [],
                        skills: skills ? [skills] : [],
                        delivery_day: delivery_day,
                        rating: rating,
                        min_price: min_price,
                        max_price: max_price,
                        project_search_string: project_search_string,
                        sort_by: sort_by,
                        page: page
                    };

                    console.log('Pagination filter data:', filterData);

                    // Make AJAX request
                    $.ajax({
                        url: window.routes.projectsFilter,
                        method: 'GET',
                        data: filterData,
                        beforeSend: function() {
                            $('.search_project_result').css('opacity', '0.5');
                            // Scroll to top of results smoothly
                            $('html, body').animate({
                                scrollTop: $('.search_project_result').offset().top - 100
                            }, 300);
                        },
                        success: function(res) {
                            if (res.status === 'nothing') {
                                $('.search_project_result').html(`
                    <section>
                        <div class="flex items-center justify-center h-full w-full py-10">
                            <div class="max-w-lg flex flex-col items-center justify-center text-center">
                                <img src="/assets/frontend/new_design/assets/images/error-images/no_service_found.svg" alt="nothing-found">
                                <p class="text-base-300 text-base-400 text-lg">Sorry, no results found. Don't worry! You can create
                                a job post and get proposals from top freelancers.</p>
                                <button
                                    class=" px-6 mt-6 rounded-full bg-primary hover:bg-primary/90 text-white font-medium py-3 mb-3 transition-colors flex items-center justify-center gap-2">
                                    <a href="<?php echo e(route('freelancer.project.create')); ?>">Create a job</a>
                                    <i class="icon-base ti tabler-arrow-right icon-20px text-white -rotate-45"></i>
                                </button>
                            </div>
                        </div>
                    </section>
                `);
                                $('.project-count-display').html('<?php echo e(__('Showing 0 results')); ?>');
                            } else {
                                if (res.html) {
                                    $('.search_project_result').html(res.html);
                                    $('.project-count-display').html('<?php echo e(__('Showing')); ?> ' + res.count + ' <?php echo e(__('out of')); ?> ' + res.total + ' <?php echo e(__('results')); ?>');

                                    // Update max price if available
                                    if (res.max_price !== undefined) {
                                        window.maxProjectPrice = res.max_price;
                                        console.log('Updated max project price from pagination:', window.maxProjectPrice);
                                    }
                                }
                            }
                            $('.search_project_result').css('opacity', '1');

                            // Update active filters and initialize carousels
                            updateActiveFilters();
                            setTimeout(initializeProjectCarousels, 100);
                        },
                        error: function(xhr) {
                            console.error('Pagination error:', xhr);
                            $('.search_project_result').css('opacity', '1');
                            alert('<?php echo e(__('An error occurred while loading the page. Please try again.')); ?>');
                        }
                    });
                }

                // ===== RESET FILTERS =====
                $(document).on('click', '#project_filter_reset, #clear-all-filters', function(e) {
                    e.preventDefault();

                    // Reset sidebar filters
                    $('#sidebar #country').val('');
                    $('#sidebar #category').val('');
                    $('#sidebar #subcategory').val('');
                    $('#sidebar #state').val('');
                    $('#sidebar #city').val('');
                    $('#sidebar #skills').val('');
                    $('#sidebar #delivery_day').val('');
                    $('#sidebar input[name="rating"]').prop('checked', false);
                    $('#sidebar #priceMin').val('');
                    $('#sidebar #priceMax').val('');
                    $('#sidebar #project_search_string').val('');
                    $('#sidebar #sort_by').val('');

                    // Reset main page filters (if they exist)
                    $('#country').val('');
                    $('#category').val('');
                    $('#subcategory').val('');
                    $('#state').val('');
                    $('#city').val('');
                    $('#skills').val('');
                    $('#delivery_day').val('');
                    $('input[name="rating"]').prop('checked', false);
                    $('#priceMin').val('');
                    $('#priceMax').val('');
                    $('#project_search_string').val('');
                    $('#sort_by').val('');

                    // Reset price range sliders
                    if (typeof initializePriceRangeSlider === 'function') {
                        initializePriceRangeSlider();
                    }

                    // Close sidebar if open
                    $('#sidebar').addClass('hidden');

                    $.ajax({
                        url: window.routes.projectsFilterReset,
                        method: 'GET',
                        beforeSend: function() {
                            $('.search_project_result').html('<div class="col-span-2 text-center py-8"><p class="text-gray-600"><?php echo e(__('Loading...')); ?></p></div>');
                            $('.project-count-display').html('<?php echo e(__('Loading...')); ?>');
                        },
                        success: function(res) {
                            if (res.status === 'nothing') {
                                $('.search_project_result').html('<div class="col-span-2 text-center py-8"><h3 class="text-2xl text-red-500"><?php echo e(__('Nothing Found')); ?></h3></div>');
                                $('.project-count-display').html('<?php echo e(__('Showing 0 results')); ?>');
                            } else {
                                if (res.html) {
                                    $('.search_project_result').html(res.html);
                                    $('.project-count-display').html('<?php echo e(__('Showing')); ?> ' + res.count + ' <?php echo e(__('out of')); ?> ' + res.total + ' <?php echo e(__('results')); ?>');

                                    // === UPDATE MAX PRICE IF AVAILABLE ===
                                    if (res.max_price !== undefined) {
                                        window.maxProjectPrice = res.max_price;
                                        console.log('Updated max project price from reset:', window.maxProjectPrice);
                                    }
                                } else {
                                    $('.search_project_result').html(res);
                                    updateProjectCountFromDOM();
                                }
                            }
                            updateActiveFilters();
                        }
                    });
                });

                // ===== ACTIVE FILTERS DISPLAY =====
                function updateActiveFilters() {
                    let activeFilters = [];

                    // Get values from sidebar or main page
                    let category = $('#sidebar #category').val() || $('#category').val() || '';
                    let subcategory = $('#sidebar #subcategory').val() || $('#subcategory').val() || '';
                    let country = $('#sidebar #country').val() || $('#country').val() || '';
                    let state = $('#sidebar #state').val() || $('#state').val() || '';
                    let city = $('#sidebar #city').val() || $('#city').val() || '';
                    let skills = $('#sidebar #skills').val() || $('#skills').val() || '';
                    let delivery_day = $('#sidebar #delivery_day').val() || $('#delivery_day').val() || '';
                    let rating = $('#sidebar input[name="rating"]:checked').val() || $('input[name="rating"]:checked').val() || '';
                    let min_price = $('#sidebar #priceMin').val() || $('#priceMin').val() || '';
                    let max_price = $('#sidebar #priceMax').val() || $('#priceMax').val() || '';
                    let project_search_string = $('#sidebar #project_search_string').val() || $('#project_search_string').val() || '';

                    if (category) {
                        let categoryName = $('#sidebar #category option:selected').text() || $('#category option:selected').text();
                        activeFilters.push({
                            name: categoryName,
                            field: 'category'
                        });
                    }

                    if (subcategory) {
                        let subcategoryName = $('#sidebar #subcategory option:selected').text() || $('#subcategory option:selected').text();
                        activeFilters.push({
                            name: subcategoryName,
                            field: 'subcategory'
                        });
                    }

                    if (skills) {
                        let skillsName = $('#sidebar #skills option:selected').text() || $('#skills option:selected').text();
                        activeFilters.push({
                            name: skillsName,
                            field: 'skills'
                        });
                    }

                    if (country) {
                        let countryName = $('#sidebar #country option:selected').text() || $('#country option:selected').text();
                        activeFilters.push({
                            name: countryName,
                            field: 'country'
                        });
                    }

                    if (state) {
                        let stateName = $('#sidebar #state option:selected').text() || $('#state option:selected').text();
                        activeFilters.push({
                            name: stateName,
                            field: 'state'
                        });
                    }

                    if (city) {
                        let cityName = $('#sidebar #city option:selected').text() || $('#city option:selected').text();
                        activeFilters.push({
                            name: cityName,
                            field: 'city'
                        });
                    }

                    if (delivery_day) {
                        let deliveryName = $('#sidebar #delivery_day option:selected').text() || $('#delivery_day option:selected').text();
                        activeFilters.push({
                            name: deliveryName,
                            field: 'delivery_day'
                        });
                    }

                    if (rating) {
                        let ratingElement = $('#sidebar input[name="rating"][value="' + rating + '"]');
                        if (!ratingElement.length) {
                            ratingElement = $('input[name="rating"][value="' + rating + '"]');
                        }
                        let ratingLabel = ratingElement.length ? ratingElement.next('label').find('i.text-amber-400').length + ' Stars' : rating + ' Stars';
                        activeFilters.push({
                            name: ratingLabel,
                            field: 'rating'
                        });
                    }

                    if (min_price || max_price) {
                        activeFilters.push({
                            name: `${min_price || '0'} - ${max_price || '∞'}`,
                            field: 'price'
                        });
                    }

                    if (project_search_string) {
                        activeFilters.push({
                            name: project_search_string.length > 20 ? project_search_string.substring(0, 20) + '...' : project_search_string,
                            field: 'search'
                        });
                    }

                    if (activeFilters.length > 0) {
                        $('.active-filters-section').show();
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
                        $('.active-filters-section').hide();
                        $('#active-filters-container').html('');
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
                            $('#sidebar #category').val('');
                            $('#category').val('');
                            break;
                        case 'subcategory':
                            $('#sidebar #subcategory').val('');
                            $('#subcategory').val('');
                            break;
                        case 'skills':
                            $('#sidebar #skills').val('');
                            $('#skills').val('');
                            break;
                        case 'country':
                            $('#sidebar #country').val('');
                            $('#country').val('');
                            break;
                        case 'state':
                            $('#sidebar #state').val('');
                            $('#state').val('');
                            break;
                        case 'city':
                            $('#sidebar #city').val('');
                            $('#city').val('');
                            break;
                        case 'delivery_day':
                            $('#sidebar #delivery_day').val('');
                            $('#delivery_day').val('');
                            break;
                        case 'rating':
                            $('#sidebar input[name="rating"]').prop('checked', false);
                            $('input[name="rating"]').prop('checked', false);
                            break;
                        case 'price':
                            $('#sidebar #priceMin').val('');
                            $('#sidebar #priceMax').val('');
                            $('#priceMin').val('');
                            $('#priceMax').val('');
                            if (typeof initializePriceRangeSlider === 'function') {
                                initializePriceRangeSlider();
                            }
                            break;
                        case 'search':
                            $('#sidebar #project_search_string').val('');
                            $('#project_search_string').val('');
                            break;
                    }

                    filterProjects();
                });

                // ===== PRICE RANGE SLIDER FUNCTIONALITY =====
                function initializePriceRangeSlider() {
                    const rangeStart = document.getElementById('priceRangeStart');
                    const rangeEnd = document.getElementById('priceRangeEnd');
                    const rangeTrack = document.getElementById('rangeTrack');
                    const priceMin = document.getElementById('priceMin');
                    const priceMax = document.getElementById('priceMax');

                    if (!rangeStart || !rangeEnd || !rangeTrack || !priceMin || !priceMax) {
                        console.error('Price range elements not found');
                        return;
                    }

                    // === USE DYNAMIC MAX VALUE ===
                    const MIN_VALUE = 0;
                    const MAX_VALUE = window.maxProjectPrice || 1000; // Use dynamic max value

                    console.log('Using max project price:', MAX_VALUE);

                    // Update max attribute of both sliders
                    rangeStart.setAttribute('max', MAX_VALUE);
                    rangeEnd.setAttribute('max', MAX_VALUE);

                    // Set initial values
                    rangeStart.value = MIN_VALUE;
                    rangeEnd.value = MAX_VALUE;

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

                // Initialize when sidebar opens
                $(document).on('click', '#filter', function() {
                    setTimeout(function() {
                        console.log('Initializing price slider with max:', window.maxProjectPrice);
                        initializePriceRangeSlider();
                    }, 100);
                });

            // ALSO INITIALIZE ON PAGE LOAD
                $(document).ready(function() {
                    setTimeout(function() {
                        console.log('Page load - max project price:', window.maxProjectPrice);
                        initializePriceRangeSlider();
                    }, 300);
                });

                // Helper function to update project count from DOM
                function updateProjectCountFromDOM() {
                    let projectCards = $('.search_project_result').find('.card-animate').length;
                    if (projectCards > 0) {
                        $('.project-count-display').html('<?php echo e(__('Showing all')); ?> ' + projectCards + ' <?php echo e(__('results')); ?>');
                    }
                }

                // ===== INITIALIZE CAROUSELS =====
                function initializeProjectCarousels() {
                    const projectCards = document.querySelectorAll('.card-animate.bg-white.rounded-2xl');

                    projectCards.forEach((card) => {
                        const track = card.querySelector('.carousel-track');
                        const slides = card.querySelectorAll('.carousel-slide');
                        const leftArrow = card.querySelector('.left-arrow');
                        const rightArrow = card.querySelector('.right-arrow');
                        const dots = card.querySelectorAll('.pagination-dot');

                        if (!track || slides.length === 0) return;

                        let currentIndex = 0;
                        const totalSlides = slides.length;

                        // Only enable carousel if multiple images
                        if (totalSlides === 1) {
                            return; // Single image, no carousel needed
                        }

                        function updateCarousel() {
                            const offset = -currentIndex * 100;
                            track.style.transform = `translateX(${offset}%)`;

                            // Update dots
                            if (dots) {
                                dots.forEach((dot, index) => {
                                    if (index === currentIndex) {
                                        dot.classList.add('active', 'bg-white', 'w-4');
                                        dot.classList.remove('bg-white/60');
                                    } else {
                                        dot.classList.remove('active', 'bg-white', 'w-4');
                                        dot.classList.add('bg-white/60');
                                    }
                                });
                            }

                            // Update arrow visibility
                            if (leftArrow) {
                                if (currentIndex === 0) {
                                    leftArrow.classList.add('hidden');
                                } else {
                                    leftArrow.classList.remove('hidden');
                                }
                            }
                            if (rightArrow) {
                                if (currentIndex === totalSlides - 1) {
                                    rightArrow.classList.add('hidden');
                                } else {
                                    rightArrow.classList.remove('hidden');
                                }
                            }
                        }

                        // Left arrow click
                        if (leftArrow) {
                            leftArrow.addEventListener('click', (e) => {
                                e.preventDefault();
                                e.stopPropagation();
                                if (currentIndex > 0) {
                                    currentIndex--;
                                    updateCarousel();
                                }
                            });
                        }

                        // Right arrow click
                        if (rightArrow) {
                            rightArrow.addEventListener('click', (e) => {
                                e.preventDefault();
                                e.stopPropagation();
                                if (currentIndex < totalSlides - 1) {
                                    currentIndex++;
                                    updateCarousel();
                                }
                            });
                        }

                        // Dot click
                        if (dots) {
                            dots.forEach((dot) => {
                                dot.addEventListener('click', (e) => {
                                    e.preventDefault();
                                    e.stopPropagation();
                                    currentIndex = parseInt(dot.getAttribute('data-index'));
                                    updateCarousel();
                                });
                            });
                        }

                        // Initialize
                        updateCarousel();
                    });
                }

                // Initialize carousels on page load
                initializeProjectCarousels();

                // Re-initialize after AJAX loads new projects
                $(document).ajaxComplete(function() {
                    setTimeout(initializeProjectCarousels, 100);
                });

                // ===== BOOKMARK FUNCTIONALITY =====

                 // Add bookmark
                $(document).on('click', '.add_to_bookmark', function(e) {

                });

                 // Remove bookmark
                $(document).on('click', '.remove_from_bookmark', function(e) {

                });

                  // Login required for guests
                $(document).on('click', '.bookmark-login-required', function(e) {


                });

                // Initial update of active filters
                updateActiveFilters();

                console.log('=== Project Filter Loaded ===');
            });
        }

        // Initialize
        initProjectFilter();
    })();
</script>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/pages/projects/project-filter-js.blade.php ENDPATH**/ ?>