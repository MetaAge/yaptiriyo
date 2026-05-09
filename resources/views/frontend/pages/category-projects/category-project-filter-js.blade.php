<script>
    (function () {
        "use strict";

        // Wait for jQuery to be available
        function initCategoryProjectFilter() {
            if (typeof jQuery === 'undefined') {
                setTimeout(initCategoryProjectFilter, 50);
                return;
            }

            var $ = jQuery;

            console.log('=== Category Project Filter Routes Configured ===');

            $(document).ready(function () {

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
                                    stateSelect.empty().append('<option value="">{{ __('Select State') }}</option>');

                                    if (res.states && res.states.length > 0) {
                                        res.states.forEach(function(state) {
                                            stateSelect.append(
                                                $('<option></option>').val(state.id).text(state.state)
                                            );
                                        });
                                        $('#state_info').html('');
                                    } else {
                                        $('#state_info').html('<span class="text-red-500 text-sm">{{ __('No states found!') }}</span>');
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
                        $('#sidebar #state').empty().append('<option value="">{{ __('Select State') }}</option>');
                    }
                });

                // ===== FILTER ON CHANGE =====
                $(document).on('change', '#sidebar #subcategory, #sidebar #state, #sidebar #skills, #sidebar #delivery_day, #sidebar #level', function() {
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

                $(document).on('input', '#sidebar #job_search_string, #job_search_string', function (e) {
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
                $(document).on('keydown', '#sidebar #job_search_string, #job_search_string', function (e) {
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
                    console.log('=== FILTERING CATEGORY PROJECTS ===');

                    // Get category ID
                    let category = $('#category_id').val();

                    // Get values from sidebar or main page
                    let subcategory = $('#sidebar #subcategory').val() || $('#subcategory').val() || '';
                    let country = $('#sidebar #country').val() || $('#country').val() || '';
                    let state = $('#sidebar #state').val() || $('#state').val() || '';
                    let skills = $('#sidebar #skills').val() || $('#skills').val() || '';
                    let delivery_day = $('#sidebar #delivery_day').val() || $('#delivery_day').val() || '';
                    let level = $('#sidebar #level').val() || $('#level').val() || '';

                    // Get selected rating from sidebar or page
                    let rating = '';
                    let sidebarRating = $('#sidebar input[name="rating"]:checked').val();
                    let pageRating = $('input[name="rating"]:checked').val();
                    rating = sidebarRating || pageRating || '';

                    let min_price = $('#sidebar #priceMin').val() || $('#priceMin').val() || '';
                    let max_price = $('#sidebar #priceMax').val() || $('#priceMax').val() || '';
                    let job_search_string = $('#sidebar #job_search_string').val() || $('#job_search_string').val() || '';
                    let sort_by = $('#sidebar #sort_by').val() || $('#sort_by').val() || '';

                    let filterData = {
                        category: category,
                        subcategory: subcategory,
                        country: country,
                        state: state,
                        skills: skills,
                        delivery_day: delivery_day,
                        level: level,
                        rating: rating,
                        min_price: min_price,
                        max_price: max_price,
                        job_search_string: job_search_string,
                        sort_by: sort_by
                    };

                    console.log('Filter data:', filterData);

                    $.ajax({
                        url: window.routes.categoryProjectsFilter,
                        method: 'GET',
                        data: filterData,
                        beforeSend: function() {
                            $('.search_category_result').html('<div class="col-span-3 text-center py-8"><p class="text-gray-600">{{ __('Loading...') }}</p></div>');
                            $('.project-count-display').html('{{ __('Loading...') }}');
                        },
                        success: function(res) {
                            console.log('Filter response:', res);

                            if (res.status === 'nothing') {
                                $('.search_category_result').html(`
                                <section>
                                    <div class="flex items-center justify-center h-full w-full py-10">
                                        <div class="max-w-lg flex flex-col items-center justify-center text-center">
                                            <img src="{{ asset('assets/frontend/new_design/assets/images/error-images/no_service_found.svg') }}" alt="nothing-found">
                                            <p class="text-base-300 text-base-400 text-lg">{{ __('Sorry, no results found.') }}</p>
                                        </div>
                                    </div>
                                </section>
                            `);
                                $('.project-count-display').html('{{ __('Showing 0 results') }}');
                            } else {
                                if (res.html) {
                                    $('.search_category_result').html(res.html);
                                    $('.project-count-display').html('{{ __('Showing') }} ' + res.count + ' {{ __('out of') }} ' + res.total + ' {{ __('results') }}');

                                    // === UPDATE MAX PRICE IF AVAILABLE ===
                                    if (res.max_price !== undefined) {
                                        window.maxProjectPrice = res.max_price;
                                        console.log('Updated max project price from filter:', window.maxProjectPrice);
                                    }
                                } else {
                                    $('.search_category_result').html(res);
                                    updateProjectCountFromDOM();
                                }
                            }

                            updateActiveFilters();
                        },
                        error: function(xhr) {
                            console.error('Filter error:', xhr);
                            alert('{{ __('An error occurred. Please try again.') }}');
                        }
                    });
                }

                // ===== PAGINATION HANDLER =====
                $(document).on('click', '.pagination a', function(e) {
                    e.preventDefault();
                    let url = $(this).attr('href');
                    if (url) {
                        loadPaginationContent(url);
                    }
                });

                function loadPaginationContent(url) {
                    const urlObj = new URL(url, window.location.origin);

                    // Get values from sidebar or main page
                    let category = $('#category_id').val();
                    let subcategory = $('#sidebar #subcategory').val() || $('#subcategory').val() || urlObj.searchParams.get('subcategory') || '';
                    let country = $('#sidebar #country').val() || $('#country').val() || urlObj.searchParams.get('country') || '';
                    let state = $('#sidebar #state').val() || $('#state').val() || urlObj.searchParams.get('state') || '';
                    let skills = $('#sidebar #skills').val() || $('#skills').val() || urlObj.searchParams.get('skills') || '';
                    let delivery_day = $('#sidebar #delivery_day').val() || $('#delivery_day').val() || urlObj.searchParams.get('delivery_day') || '';
                    let level = $('#sidebar #level').val() || $('#level').val() || urlObj.searchParams.get('level') || '';

                    // Get selected rating
                    let rating = '';
                    let sidebarRating = $('#sidebar input[name="rating"]:checked').val();
                    let pageRating = $('input[name="rating"]:checked').val();
                    rating = sidebarRating || pageRating || urlObj.searchParams.get('rating') || '';

                    let min_price = $('#sidebar #priceMin').val() || $('#priceMin').val() || urlObj.searchParams.get('min_price') || '';
                    let max_price = $('#sidebar #priceMax').val() || $('#priceMax').val() || urlObj.searchParams.get('max_price') || '';
                    let job_search_string = $('#sidebar #job_search_string').val() || $('#job_search_string').val() || urlObj.searchParams.get('job_search_string') || '';
                    let sort_by = $('#sidebar #sort_by').val() || $('#sort_by').val() || urlObj.searchParams.get('sort_by') || '';

                    let filterData = {
                        category: category,
                        subcategory: subcategory,
                        country: country,
                        state: state,
                        skills: skills,
                        delivery_day: delivery_day,
                        level: level,
                        rating: rating,
                        min_price: min_price,
                        max_price: max_price,
                        job_search_string: job_search_string,
                        sort_by: sort_by,
                        page: urlObj.searchParams.get('page') || 1
                    };

                    $.ajax({
                        url: window.routes.categoryProjectsFilter,
                        method: 'GET',
                        data: filterData,
                        beforeSend: function() {
                            $('.search_category_result').css('opacity', '0.5');
                        },
                        success: function(res) {
                            if (res.status === 'nothing') {
                                $('.search_category_result').html(`
                                <div class="col-span-3">
                                    <section>
                                        <div class="flex items-center justify-center h-full w-full py-10">
                                            <div class="max-w-lg flex flex-col items-center justify-center text-center">
                                                <img src="{{ asset('assets/frontend/new_design/assets/images/error-images/no_service_found.svg') }}" alt="nothing-found">
                                                <p class="text-base-300 text-base-400 text-lg">{{ __('Sorry, no results found.') }}</p>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            `);
                                $('.project-count-display').html('{{ __('Showing 0 results') }}');
                            } else {
                                if (res.html) {
                                    $('.search_category_result').html(res.html);
                                    $('.project-count-display').html('{{ __('Showing') }} ' + res.count + ' {{ __('out of') }} ' + res.total + ' {{ __('results') }}');

                                }
                            }
                            $('.search_category_result').css('opacity', '1');
                            updateActiveFilters();
                        },
                        error: function(xhr) {
                            console.error('Pagination error:', xhr);
                            $('.search_category_result').css('opacity', '1');
                        }
                    });
                }

                // ===== RESET FILTERS =====
                $(document).on('click', '#clear-all-filters', function(e) {
                    e.preventDefault();

                    // Reset sidebar filters
                    $('#sidebar #country').val('');
                    $('#sidebar #subcategory').val('');
                    $('#sidebar #state').val('');
                    $('#sidebar #skills').val('');
                    $('#sidebar #delivery_day').val('');
                    $('#sidebar #level').val('');
                    $('#sidebar input[name="rating"]').prop('checked', false);
                    $('#sidebar #priceMin').val('');
                    $('#sidebar #priceMax').val('');
                    $('#sidebar #job_search_string').val('');
                    $('#sidebar #sort_by').val('');

                    // Reset price range sliders
                    if (typeof initializePriceRangeSlider === 'function') {
                        initializePriceRangeSlider();
                    }

                    // Close sidebar if open
                    $('#sidebar').addClass('hidden');

                    $.ajax({
                        url: window.routes.categoryProjectsReset,
                        method: 'GET',
                        data: { category: $('#category_id').val() },
                        beforeSend: function() {
                            $('.search_category_result').html('<div class="col-span-3 text-center py-8"><p class="text-gray-600">{{ __('Loading...') }}</p></div>');
                            $('.project-count-display').html('{{ __('Loading...') }}');
                        },
                        success: function(res) {
                            if (res.status === 'nothing') {
                                $('.search_category_result').html(`
                                <div class="col-span-3">
                                    <section>
                                        <div class="flex items-center justify-center h-full w-full py-10">
                                            <div class="max-w-lg flex flex-col items-center justify-center text-center">
                                                <img src="{{ asset('assets/frontend/new_design/assets/images/error-images/no_service_found.svg') }}" alt="nothing-found">
                                                <p class="text-base-300 text-base-400 text-lg">{{ __('Sorry, no results found.') }}</p>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            `);
                                $('.project-count-display').html('{{ __('Showing 0 results') }}');
                            } else {
                                if (res.html) {
                                    $('.search_category_result').html(res.html);
                                    $('.project-count-display').html('{{ __('Showing') }} ' + res.count + ' {{ __('out of') }} ' + res.total + ' {{ __('results') }}');
                                } else {
                                    $('.search_category_result').html(res);
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

                    let subcategory = $('#sidebar #subcategory').val() || '';
                    let country = $('#sidebar #country').val() || '';
                    let state = $('#sidebar #state').val() || '';
                    let skills = $('#sidebar #skills').val() || '';
                    let delivery_day = $('#sidebar #delivery_day').val() || '';
                    let level = $('#sidebar #level').val() || '';
                    let rating = $('#sidebar input[name="rating"]:checked').val() || '';
                    let min_price = $('#sidebar #priceMin').val() || '';
                    let max_price = $('#sidebar #priceMax').val() || '';
                    let job_search_string = $('#sidebar #job_search_string').val() || '';

                    if (subcategory) {
                        let subcategoryName = $('#sidebar #subcategory option:selected').text();
                        activeFilters.push({
                            name: subcategoryName,
                            field: 'subcategory'
                        });
                    }

                    if (skills) {
                        let skillsName = $('#sidebar #skills option:selected').text();
                        activeFilters.push({
                            name: skillsName,
                            field: 'skills'
                        });
                    }

                    if (country) {
                        let countryName = $('#sidebar #country option:selected').text();
                        activeFilters.push({
                            name: countryName,
                            field: 'country'
                        });
                    }

                    if (state) {
                        let stateName = $('#sidebar #state option:selected').text();
                        activeFilters.push({
                            name: stateName,
                            field: 'state'
                        });
                    }

                    if (delivery_day) {
                        let deliveryName = $('#sidebar #delivery_day option:selected').text();
                        activeFilters.push({
                            name: deliveryName,
                            field: 'delivery_day'
                        });
                    }

                    if (level) {
                        let levelName = $('#sidebar #level option:selected').text();
                        activeFilters.push({
                            name: levelName,
                            field: 'level'
                        });
                    }

                    if (rating) {
                        let ratingElement = $('#sidebar input[name="rating"][value="' + rating + '"]');
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

                    if (job_search_string) {
                        activeFilters.push({
                            name: job_search_string.length > 20 ? job_search_string.substring(0, 20) + '...' : job_search_string,
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
                        case 'subcategory':
                            $('#sidebar #subcategory').val('');
                            break;
                        case 'skills':
                            $('#sidebar #skills').val('');
                            break;
                        case 'country':
                            $('#sidebar #country').val('');
                            break;
                        case 'state':
                            $('#sidebar #state').val('');
                            break;
                        case 'delivery_day':
                            $('#sidebar #delivery_day').val('');
                            break;
                        case 'level':
                            $('#sidebar #level').val('');
                            break;
                        case 'rating':
                            $('#sidebar input[name="rating"]').prop('checked', false);
                            break;
                        case 'price':
                            $('#sidebar #priceMin').val('');
                            $('#sidebar #priceMax').val('');
                            if (typeof initializePriceRangeSlider === 'function') {
                                initializePriceRangeSlider();
                            }
                            break;
                        case 'search':
                            $('#sidebar #job_search_string').val('');
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

                    const MIN_VALUE = 0;
                    const MAX_VALUE = window.maxProjectPrice || 1000;

                    console.log('Using max project price:', MAX_VALUE);

                    rangeStart.setAttribute('max', MAX_VALUE);
                    rangeEnd.setAttribute('max', MAX_VALUE);

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

                // Initialize on page load
                $(document).ready(function() {
                    setTimeout(function() {
                        console.log('Page load - max project price:', window.maxProjectPrice);
                        initializePriceRangeSlider();
                    }, 300);
                });

                // ===== BOOKMARK FUNCTIONALITY =====
                $(document).on('click', '.click_to_bookmark', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    let identity = $(this).data('identity');
                    let route = $(this).data('route');
                    let type = $(this).data('type');
                    let loginRequired = $(this).data('login');

                    if (loginRequired === 'login-please') {
                        toastr_warning_js('{{ __('Please login to bookmark') }}');
                        return;
                    }

                    $.ajax({
                        url: route,
                        type: 'POST',
                        data: {
                            identity: identity,
                            type: type,
                            _token: window.csrfToken
                        },
                        success: function(res) {
                            if (res.status === 'success') {
                                toastr_success_js('{{ __('Bookmark added successfully') }}');
                                // Reload to update bookmark icon
                                location.reload();
                            } else if (res.status === 'exists') {
                                toastr_warning_js('{{ __('Already bookmarked') }}');
                            }
                        },
                        error: function(xhr) {
                            console.error('Bookmark error:', xhr);
                            toastr_error_js('{{ __('Failed to add bookmark') }}');
                        }
                    });
                });

                // Remove bookmark
                $(document).on('click', '.remove_from_bookmark', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    let identity = $(this).data('identity');
                    let route = $(this).data('route');

                    $.ajax({
                        url: route,
                        type: 'POST',
                        data: {
                            identity: identity,
                            _token: window.csrfToken
                        },
                        success: function(res) {
                            if (res.status === 'success') {
                                toastr_success_js('{{ __('Bookmark removed successfully') }}');
                                location.reload();
                            }
                        },
                        error: function(xhr) {
                            console.error('Remove bookmark error:', xhr);
                            toastr_error_js('{{ __('Failed to remove bookmark') }}');
                        }
                    });
                });

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
                            return;
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

                console.log('=== Category Project Filter Loaded ===');
            });
        }

        // Initialize
        initCategoryProjectFilter();
    })();
</script>