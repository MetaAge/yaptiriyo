<script>
    (function($) {
        "use strict";
        $(document).ready(function() {
            let searchTimeout = null;

            // Search on keypress with debounce
            $(document).on('input', '#job_search_string', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function() {
                    projects();
                    updateActiveFilters();
                }, 500);
            });

            // Search on Enter key
            $(document).on('keydown', '#job_search_string', function(e) {
                if (e.key === "Enter" || e.which === 13) {
                    e.preventDefault();
                    clearTimeout(searchTimeout);
                    projects();
                    updateActiveFilters();
                }
            });

            // Skills filter
            $(document).on('change', '#skills', function() {
                projects();
                updateActiveFilters();
            });

            // Country filter - load states dynamically
            $(document).on('change', '#country', function() {
                let countryId = $(this).val();
                
                // Clear state dropdown
                $('#state').html('<option value="">{{ __("Select State") }}</option>');
                
                if (countryId) {
                    // Load states for selected country
                    $.ajax({
                        url: "{{ route('au.state.all') }}",
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            country: countryId
                        },
                        success: function(res) {
                            if (res.status === 'success' && res.states) {
                                let stateOptions = '<option value="">{{ __("Select State") }}</option>';
                                res.states.forEach(function(state) {
                                    stateOptions += `<option value="${state.id}">${state.state}</option>`;
                                });
                                $('#state').html(stateOptions);
                            }
                        },
                        error: function() {
                            console.error('State error:', xhr);
                        }
                    });
                } else {
                    // Reset state when country is cleared
                    $('#state').val('');
                }
                
                projects();
                updateActiveFilters();
            });

            // State filter
            $(document).on('change', '#state', function() {
                projects();
                updateActiveFilters();
            });

            // Other filters
            $(document).on('change', '#level, #delivery_day', function() {
                projects();
                updateActiveFilters();
            });

            // Sort by dropdown
            $(document).on('change', '#sort_by', function() {
                projects();
            });

            // Rating filter
            $(document).on('change', 'input[name="rating"]', function() {
                projects();
                updateActiveFilters();
            });

            // Price range - auto filter on input change (matching projects folder pattern)
            let priceFilterTimeout;
            $(document).on('input', '#sidebar #priceMin, #sidebar #priceMax, #priceMin, #priceMax', function() {
                clearTimeout(priceFilterTimeout);
                priceFilterTimeout = setTimeout(function() {
                    projects();
                    updateActiveFilters();
                }, 500);
            });

            // Pagination
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                projects(page);
            });

            // Clear all filters - smooth reset
            $(document).on('click', '#clear-all-filters', function(e) {
                e.preventDefault();
                
                // Reset all form fields
                $('#country').val('');
                $('#state').html('<option value="">{{ __("Select State") }}</option>');
                $('#skills').val('');
                $('#level').val('');
                $('#delivery_day').val('');
                $('#priceMin').val('');
                $('#priceMax').val('');
                $('#job_search_string').val('');
                $('#sort_by').val('');
                $('input[name="rating"]').prop('checked', false);
                
                // Close sidebar
                $('#sidebar').addClass('hidden');
                
                // Get original subcategory ID
                let originalSubcategoryId = $('#subcategory_id').val();
                
                // Call reset endpoint
                $.ajax({
                    url: "{{ route('subcategory.project.filter.reset') }}",
                    method: 'GET',
                    data: {
                        subcategory_id: originalSubcategoryId
                    },
                    beforeSend: function() {
                        $('.search_category_result').html('<div class="col-span-3 text-center py-8"><p class="text-gray-600">{{ __("Loading...") }}</p></div>');
                        $('.project-count-display').html('{{ __("Loading...") }}');
                    },
                    success: function(res) {
                        if (res.status == 'nothing') {
                            $('.search_category_result').html(
                                `<section>
                                    <div class="flex items-center justify-center h-full w-full py-10">
                                        <div class="max-w-lg flex flex-col items-center justify-center text-center">
                                            <img src="{{ asset('assets/frontend/new_design/assets/images/error-images/no_service_found.svg') }}"
                                                alt="nothing-found">
                                            <p class="text-base-300 text-base-400 text-lg">
                                                {{ __("Sorry, no results found.") }}
                                            </p>
                                            <button
                                                class=" px-6 mt-6 rounded-full bg-primary hover:bg-primary/90 text-white font-medium py-3 mb-3 transition-colors flex items-center justify-center gap-2">
                                                <a href="{{ route('freelancer.project.create') }}">
                                                    {{ __('Create a job') }}
                                                </a>
                                                <i class="icon-base ti tabler-arrow-right icon-20px text-white -rotate-45"></i>
                                            </button>
                                        </div>
                                    </div>
                                </section>`);
                            $('.project-count-display').text("{{ __('Showing') }} 0 {{ __('out of') }} 0 {{ __('results') }}");
                        } else {
                            $('.search_category_result').html(res.html);
                            if (res.count !== undefined && res.total !== undefined) {
                                $('.project-count-display').text("{{ __('Showing') }} " + res.count + " {{ __('out of') }} " + res.total + " {{ __('results') }}");
                            }
                        }
                        updateActiveFilters();
                    },
                    error: function(xhr) {
                        console.error('Reset error:', xhr);
                        $('.search_category_result').html('<div class="col-span-3 text-center py-8"><p class="text-red-600">{{ __("Error loading projects") }}</p></div>');
                    }
                });
            });

            // Filter sidebar toggle
            $(document).on('click', '#filter', function() {
                $('#sidebar').removeClass('hidden');
            });

            $(document).on('click', '#closeSidebar', function() {
                $('#sidebar').addClass('hidden');
            });

            // Close sidebar when clicking outside
            $(document).on('click', '#sidebar', function(e) {
                if (e.target === this) {
                    $(this).addClass('hidden');
                }
            });

            // Main projects function
            function projects(page = 1) {
                // Get values from sidebar or main page (matching projects folder pattern)
                let subcategory_id = $('#subcategory_id').val();
                let country = $('#sidebar #country').val() || $('#country').val() || '';
                let state = $('#sidebar #state').val() || $('#state').val() || '';
                let level = $('#sidebar #level').val() || $('#level').val() || '';
                let min_price = $('#sidebar #priceMin').val() || $('#priceMin').val() || '';
                let max_price = $('#sidebar #priceMax').val() || $('#priceMax').val() || '';
                let delivery_day = $('#sidebar #delivery_day').val() || $('#delivery_day').val() || '';
                let job_search_string = $('#sidebar #job_search_string').val() || $('#job_search_string').val() || '';
                let sort_by = $('#sidebar #sort_by').val() || $('#sort_by').val() || '';
                let skills = $('#sidebar #skills').val() || $('#skills').val() || '';
                
                // Get rating from sidebar or page
                let rating = '';
                let sidebarRating = $('#sidebar input[name="rating"]:checked').val();
                let pageRating = $('input[name="rating"]:checked').val();
                rating = sidebarRating || pageRating || '';
                
                let get_pro_projects;

                if ($('#get_pro_projects').prop('checked')) {
                    $('#get_pro_projects').val('1')
                    get_pro_projects = $('#get_pro_projects').val()
                } else {
                    $('#get_pro_projects').val('0')
                    get_pro_projects = $('#get_pro_projects').val()
                }

                $.ajax({
                    url: "{{ route('subcategory.project.pagination') . '?page=' }}" + page,
                    method: 'GET',
                    data: {
                        subcategory_id: subcategory_id,
                        country: country,
                        state: state ? [state] : [],
                        level: level,
                        min_price: min_price,
                        max_price: max_price,
                        delivery_day: delivery_day,
                        rating: rating,
                        sort_by: sort_by,
                        get_pro_projects: get_pro_projects,
                        job_search_string: job_search_string,
                        skills: skills ? [skills] : []
                    },
                    success: function(res) {
                        if (res.status == 'nothing') {
                            $('.search_category_result').html(
                                `<section>
                                    <div class="flex items-center justify-center h-full w-full py-10">
                                        <div class="max-w-lg flex flex-col items-center justify-center text-center">
                                            <img src="{{ asset('assets/frontend/new_design/assets/images/error-images/no_service_found.svg') }}"
                                                alt="nothing-found">
                                            <p class="text-base-300 text-base-400 text-lg">
                                                {{ __("Sorry, no results found.") }}
                                            </p>
                                            <button
                                                class=" px-6 mt-6 rounded-full bg-primary hover:bg-primary/90 text-white font-medium py-3 mb-3 transition-colors flex items-center justify-center gap-2">
                                                <a href="{{ route('freelancer.project.create') }}">
                                                    {{ __('Create a job') }}
                                                </a>

                                                <i class="icon-base ti tabler-arrow-right icon-20px text-white -rotate-45"></i>
                                            </button>
                                        </div>
                                    </div>
                                </section>`);
                            $('.project-count-display').text("{{ __('Showing') }} 0 {{ __('out of') }} 0 {{ __('results') }}");
                        } else {
                            $('.search_category_result').html(res.html);
                            
                            if (res.count !== undefined && res.total !== undefined) {
                                $('.project-count-display').text("{{ __('Showing') }} " + res.count + " {{ __('out of') }} " + res.total + " {{ __('results') }}");
                            }
                            
                            $('html, body').animate({
                                scrollTop: 0
                            }, 'smooth');
                        }
                    }
                });
            }

            // Update active filters display
            function updateActiveFilters() {
                let activeFilters = [];
                
                // Search keyword
                let searchString = $('#sidebar #job_search_string').val() || $('#job_search_string').val() || '';
                if (searchString) {
                    activeFilters.push({
                        label: searchString.length > 20 ? searchString.substring(0, 20) + '...' : searchString,
                        field: 'search'
                    });
                }
                
                // Skills
                let skillsVal = $('#sidebar #skills').val() || $('#skills').val() || '';
                if (skillsVal) {
                    let skills = $('#sidebar #skills option:selected').text() || $('#skills option:selected').text();
                    if (skills && skills !== '{{ __("Select Skill") }}') {
                        activeFilters.push({
                            label: skills,
                            field: 'skills'
                        });
                    }
                }
                
                // Country
                let countryVal = $('#sidebar #country').val() || $('#country').val() || '';
                if (countryVal) {
                    let country = $('#sidebar #country option:selected').text() || $('#country option:selected').text();
                    if (country && country !== '{{ __("Select Country") }}') {
                        activeFilters.push({
                            label: country,
                            field: 'country'
                        });
                    }
                }
                
                // State
                let stateVal = $('#sidebar #state').val() || $('#state').val() || '';
                if (stateVal) {
                    let state = $('#sidebar #state option:selected').text() || $('#state option:selected').text();
                    if (state && state !== '{{ __("Select State") }}') {
                        activeFilters.push({
                            label: state,
                            field: 'state'
                        });
                    }
                }
                
                // Delivery Time
                let deliveryVal = $('#sidebar #delivery_day').val() || $('#delivery_day').val() || '';
                if (deliveryVal) {
                    let deliveryDay = $('#sidebar #delivery_day option:selected').text() || $('#delivery_day option:selected').text();
                    if (deliveryDay && deliveryDay !== '{{ __("Select Delivery Time") }}') {
                        activeFilters.push({
                            label: deliveryDay,
                            field: 'delivery'
                        });
                    }
                }
                
                // Experience Level
                let levelVal = $('#sidebar #level').val() || $('#level').val() || '';
                if (levelVal) {
                    let level = $('#sidebar #level option:selected').text() || $('#level option:selected').text();
                    if (level && level !== '{{ __("Select Experience Level") }}') {
                        activeFilters.push({
                            label: level,
                            field: 'level'
                        });
                    }
                }
                
                // Price Range
                let minPrice = $('#sidebar #priceMin').val() || $('#priceMin').val() || '';
                let maxPrice = $('#sidebar #priceMax').val() || $('#priceMax').val() || '';
                if (minPrice || maxPrice) {
                    activeFilters.push({
                        label: (minPrice || '0') + ' - ' + (maxPrice || '∞'),
                        field: 'price'
                    });
                }
                
                // Rating
                let rating = $('#sidebar input[name="rating"]:checked').val() || $('input[name="rating"]:checked').val() || '';
                if (rating) {
                    let ratingElement = $('#sidebar input[name="rating"][value="' + rating + '"]');
                    if (!ratingElement.length) {
                        ratingElement = $('input[name="rating"][value="' + rating + '"]');
                    }
                    let ratingLabel = ratingElement.length ? ratingElement.next('label').find('i.text-amber-400').length + ' Stars' : rating + ' Stars';
                    activeFilters.push({
                        label: ratingLabel,
                        field: 'rating'
                    });
                }
                
                // Update UI
                if (activeFilters.length > 0) {
                    $('.active-filters-section').show();
                    let filtersHtml = '';
                    activeFilters.forEach(function(filter) {
                        filtersHtml += `<span class="px-3 hover:text-red-600 hover:border-red-600 group py-1 flex items-center justify-center gap-0 text-gray-700 border border-gray-400 rounded-full text-xs cursor-pointer" data-filter-field="${filter.field}">
                            ${filter.label}
                            <button class="ml-2 text-gray-500 group-hover:text-red-600 remove-filter">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </span>`;
                    });
                    $('#active-filters-container').html(filtersHtml);
                } else {
                    $('.active-filters-section').hide();
                }
            }

            // Remove individual filter
            $(document).on('click', '.remove-filter', function(e) {
                e.stopPropagation();
                
                let $parent = $(this).closest('[data-filter-field]');
                let field = $parent.data('filter-field');
                
                switch(field) {
                    case 'skills':
                        $('#skills').val('');
                        break;
                    case 'country':
                        $('#country').val('');
                        $('#state').html('<option value="">{{ __("Select State") }}</option>');
                        break;
                    case 'state':
                        $('#state').val('');
                        break;
                    case 'delivery':
                        $('#delivery_day').val('');
                        break;
                    case 'level':
                        $('#level').val('');
                        break;
                    case 'rating':
                        $('input[name="rating"]').prop('checked', false);
                        break;
                    case 'price':
                        $('#priceMin').val('');
                        $('#priceMax').val('');
                        break;
                    case 'search':
                        $('#job_search_string').val('');
                        break;
                }
                
                projects();
                updateActiveFilters();
            });

            // Filter reset button (if exists in sidebar)
            $(document).on('click', '#subcategory_project_filter_reset', function(e) {
                $('#country').val('');
                $('#state').html('<option value="">{{ __("Select State") }}</option>');
                $('#skills').val('');
                $('#level').val('');
                $('#delivery_day').val('');
                $('#priceMin').val('');
                $('#priceMax').val('');
                $('#job_search_string').val('');
                $('#sort_by').val('');
                $('input[name="rating"]').prop('checked', false);
                
                projects();
                updateActiveFilters();
            });

            // Get pro projects
            $(document).on('change', '#get_pro_projects', function(e) {
                e.preventDefault();
                projects();
            });

            // Initialize active filters on page load
            updateActiveFilters();

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
                    initializePriceRangeSlider();
                }, 100);
            });

            setTimeout(function() {
                initializePriceRangeSlider();
            }, 300);
        });
    }(jQuery));
</script>
