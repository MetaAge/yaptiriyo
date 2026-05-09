<style>
    /* Navbar dark mode styles */
    .navbar-dark-mode {
        border-color: rgba(255, 255, 255, 0.3) !important;
        color: #ffffff !important;
    }

    .navbar-dark-mode:hover {
        background-color: rgba(255, 255, 255, 0.1) !important;
        border-color: rgba(255, 255, 255, 0.5) !important;
    }

    /* Navbar light mode - reset to defaults */
    .navbar-light-mode {
        border-color: '' !important;
        color: '' !important;
    }
</style>

<!-- Hero Section -->
<section class="bg-[#125D4A] min-h-screen flex items-center justify-center pt-28 pb-20 overflow-hidden relative {{ $section_bg ? '' : 'section-bg-gradient' }}"
         data-padding-top="{{$padding_top ?? ''}}"
         data-padding-bottom="{{$padding_bottom ?? ''}}"
         data-navbar-style="light"
         @if($section_bg) style="background-color: {{$section_bg}};" @endif>
    <div class="container mx-auto max-w-8xl px-6 relative z-50">
        <div class="space-y-8">

            <!-- Left Content -->
            <div class="flex flex-col lg:flex-row items-start justify-between gap-4">
                <h1 class="text-[42px] md:text-[56px] 2xl:text-[80px] font-semibold text-base-100 leading-[65px] md:leading-[80px] lg:leading-[110px] lg:-mt-5">
                    {!! nl2br(e($title)) !!}
                </h1>

                <!-- User Avatars Section -->
                <div class="flex-col items-start lg:items-end hidden lg:flex">
                    <div class="flex items-center justify-end mb-4">
                        <div class="flex -space-x-3">
                            @if(!empty($user_images))
                                @foreach($user_images as $index => $user_image)
                                    @if($index < 4)
                                        @if(isset($user_image['user_image']))
                                            {!! render_image_markup_by_attachment_id($user_image['user_image'], 'w-12 h-12 rounded-full border-white border-2', 'thumbnail', __('User') . ' ' . ($index + 1)) !!}
                                        @else
                                            <img src="{{ asset('assets/static/img/user-placeholder.png') }}" alt="User {{ $index + 1 }}" class="w-12 h-12 rounded-full border-white border-2">
                                        @endif
                                    @endif
                                @endforeach
                            @else
                                @for($i = 0; $i < 4; $i++)
                                    <img src="{{ asset('assets/static/img/user-placeholder.png') }}" alt="User {{ $i + 1 }}" class="w-12 h-12 rounded-full border-white border-2">
                                @endfor
                            @endif

                            <div class="w-12 h-12 rounded-full border-white border-2 bg-primary flex items-center justify-center text-white text-3xl">
                                +
                            </div>
                        </div>
                    </div>
                    <p class="text-white font-medium text-right mb-2 text-[18px]">{{ $user_count_text }}</p>
                </div>

                <!-- Search Section (Mobile) -->
                <div class="w-full lg:w-1/2 pb-10 max-w-[524px] lg:hidden">
                    <p class="text-[#ECEDEF] text-lg mb-8">
                        {!! nl2br(e($description)) !!}
                    </p>

                    <div class="relative w-full lg:mx-0 mt-4">
                        <div class="relative">
                            <input type="text"
                                   id="tag-search-input-desktop"
                                   placeholder="{{ $search_placeholder }}"
                                   class="w-full px-6 py-4 pr-16 text-md rounded-full bg-white border-gray-300 border border-base-300 focus:border-primary transition-all duration-300 shadow-md outline-none">
                            <button title="search"
                                    class="tag-search-btn absolute right-2 top-1/2 -translate-y-1/2 w-12 h-12 bg-secondary text-primary-foreground rounded-full hover:bg-primary/90 transition-colors duration-300">
                                <i class="fas fa-search text-base"></i>
                            </button>
                            <div id="tag-search-results-desktop" class="hidden absolute left-0 right-0 mt-2 bg-white rounded-xl shadow-lg max-h-96 overflow-y-auto z-[100] border border-gray-200"></div>
                        </div>
                    </div>

                    @if(!empty($search_tags))
                        <div class="flex flex-wrap gap-2 md:gap-4 justify-start pt-4">
                            @foreach($search_tags as $tag)
                                @if(isset($tag['tag_text']))
                                    <a href="{{ $tag['tag_link'] ?? '#' }}" class="px-4 py-2 border border-gray-300/40 text-base-100 rounded-full text-sm hover:bg-gray-300/20 transition-all duration-300 cursor-pointer">
                                        {{ $tag['tag_text'] }} <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <div class="flex flex-col lg:flex-row items-center justify-between gap-10 lg:gap-20">
                @if(!empty($video_url))
                    <video class="w-full lg:w-2/5 lg:max-w-[820px] rounded-[150px] object-cover flex-shrink-0 h-[243px] lg:h-[280px]"
                           autoplay loop muted playsinline preload="auto">
                        <source src="{{ $video_url }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @else
                    <div class="w-full lg:w-1/2 rounded-full object-cover flex-shrink-0 h-[243px] lg:h-[380px] bg-gray-300 flex items-center justify-center">
                        <span class="text-gray-500">Video placeholder</span>
                    </div>
                @endif

                <!-- Search Section (Desktop) -->
                <div class="w-full lg:w-1/2 pb-10 max-w-[524px] hidden lg:block">
                    <p class="text-[#ECEDEF] text-lg mb-4">
                        {!! nl2br(e($description)) !!}
                    </p>

                    <div class="relative w-full lg:mx-0 mt-4">
                        <div class="relative">
                            <input type="text"
                                   id="tag-search-input-mobile"
                                   placeholder="{{ $search_placeholder }}"
                                   class="w-full px-6 py-4 pr-16 text-md rounded-full bg-white border-gray-300 border border-base-300 focus:border-primary transition-all duration-300 shadow-md outline-none">
                            <button title="search"
                                    class="tag-search-btn absolute right-2 top-1/2 -translate-y-1/2 w-12 h-12 bg-secondary text-primary-foreground rounded-full hover:bg-primary/90 transition-colors duration-300">
                                <i class="fas fa-search text-base"></i>
                            </button>
                            <div id="tag-search-results-mobile" class="hidden absolute left-0 right-0 mt-2 bg-white rounded-xl shadow-lg max-h-96 overflow-y-auto z-[100] border border-gray-200"></div>
                        </div>
                    </div>

                    @if(!empty($search_tags))
                        <div class="flex flex-wrap gap-2 md:gap-4 justify-start pt-4">
                            @foreach($search_tags as $tag)
                                @if(isset($tag['tag_text']))
                                    <a href="{{ $tag['tag_link'] ?? '#' }}" class="px-4 py-2 border border-gray-300/40 text-base-100 rounded-full text-sm hover:bg-gray-300/20 transition-all duration-300 cursor-pointer">
                                        {{ $tag['tag_text'] }} <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- User Avatars Section (Mobile) -->
                <div class="flex-col items-center lg:items-end flex lg:hidden gap-0">
                    <div class="flex items-center justify-end mb-4">
                        <div class="flex -space-x-3">
                            @if(!empty($user_images))
                                @foreach($user_images as $index => $user_image)
                                    @if($index < 4)
                                        @if(isset($user_image['user_image']))
                                            {!! render_image_markup_by_attachment_id($user_image['user_image'], 'w-12 h-12 rounded-full border-white border-2', 'thumbnail', __('User') . ' ' . ($index + 1)) !!}
                                        @else
                                            <img src="{{ asset('assets/static/img/user-placeholder.png') }}" alt="User {{ $index + 1 }}" class="w-12 h-12 rounded-full border-white border-2">
                                        @endif
                                    @endif
                                @endforeach
                            @else
                                @for($i = 0; $i < 4; $i++)
                                    <img src="{{ asset('assets/static/img/user-placeholder.png') }}" alt="User {{ $i + 1 }}" class="w-12 h-12 rounded-full border-white border-2">
                                @endfor
                            @endif

                            <div class="w-12 h-12 rounded-full border-white border-2 bg-primary flex items-center justify-center text-white text-3xl">
                                +
                            </div>
                        </div>
                    </div>
                    <p class="text-white font-medium text-right mb-2 text-[18px]">{{ $user_count_text }}</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Navbar color adaptation
            function updateNavbarColors() {
                const section = document.querySelector('section[data-navbar-style]');
                const nav = document.getElementById('mainNav');

                if (!section || !nav) return;

                // Get background color
                const bgColor = section.style.backgroundColor || window.getComputedStyle(section).backgroundColor;

                // Calculate luminance to determine if background is dark
                function getLuminance(color) {
                    const rgb = color.match(/\d+/g);
                    if (!rgb || rgb.length < 3) return 1;

                    const [r, g, b] = rgb.map(val => {
                        const v = parseInt(val) / 255;
                        return v <= 0.03928 ? v / 12.92 : Math.pow((v + 0.055) / 1.055, 2.4);
                    });

                    return 0.2126 * r + 0.7152 * g + 0.0722 * b;
                }

                const isDark = getLuminance(bgColor) < 0.5;

                if (isDark) {
                    // Light text for dark background
                    nav.style.backgroundColor = 'transparent';
                    nav.style.borderColor = 'rgba(255, 255, 255, 0.1)';

                    // Update desktop menu links
                    document.querySelectorAll('#desktopMenu > li > a').forEach(link => {
                        link.style.color = '#ffffff';
                        link.classList.remove('text-gray-700');
                        link.classList.add('text-white');
                    });

                    // Update desktop menu arrows
                    document.querySelectorAll('#desktopMenu svg').forEach(svg => {
                        svg.style.color = '#ffffff';
                    });

                    // Update mobile menu button
                    const mobileBtn = document.getElementById('mobileMenuBtn');
                    if (mobileBtn) {
                        mobileBtn.style.color = '#ffffff';
                    }
                } else {
                    // Dark text for light background (default)
                    nav.style.backgroundColor = '';
                    nav.style.borderColor = '';

                    document.querySelectorAll('#desktopMenu > li > a').forEach(link => {
                        link.style.color = '';
                        link.classList.add('text-gray-700');
                        link.classList.remove('text-white');
                    });

                    document.querySelectorAll('#desktopMenu svg').forEach(svg => {
                        svg.style.color = '';
                    });

                    const mobileBtn = document.getElementById('mobileMenuBtn');
                    if (mobileBtn) {
                        mobileBtn.style.color = '';
                    }
                }
            }

            // Run on load and when colors might change
            updateNavbarColors();

            // Watch for style changes
            const observer = new MutationObserver(updateNavbarColors);
            const section = document.querySelector('section[data-navbar-style]');
            if (section) {
                observer.observe(section, { attributes: true, attributeFilter: ['style'] });
            }

            // Enhanced search functionality with filtering
            function setupEnhancedSearch(inputId, resultsId) {
                const searchInput = document.getElementById(inputId);
                const resultsDiv = document.getElementById(resultsId);
                const searchContainer = searchInput?.parentElement;
                const searchBtn = searchInput?.nextElementSibling;

                if (!searchInput || !resultsDiv || !searchContainer || !searchBtn) return;

                let activeFilter = 'project';
                let lastSearchResults = [];
                let currentFilteredResults = [];

                function updateCurrentFilteredResults(data) {
                    let filteredData = data;
                    if (activeFilter !== 'all') {
                        filteredData = data.filter(item => item.type === activeFilter);
                    }
                    currentFilteredResults = filteredData;
                    return filteredData;
                }

                function searchTags() {
                    const query = searchInput.value.trim();

                    if (query.length < 2) {
                        resultsDiv.classList.add('hidden');
                        currentFilteredResults = [];
                        return;
                    }

                    // Position dropdown
                    const inputRect = searchInput.getBoundingClientRect();
                    const containerRect = searchContainer.getBoundingClientRect();
                    const spaceBelow = window.innerHeight - inputRect.bottom - 20;

                    if (spaceBelow < 200) {
                        resultsDiv.style.top = 'auto';
                        resultsDiv.style.bottom = '100%';
                        resultsDiv.style.marginTop = '0';
                        resultsDiv.style.marginBottom = '8px';
                    } else {
                        resultsDiv.style.top = '100%';
                        resultsDiv.style.bottom = 'auto';
                        resultsDiv.style.marginTop = '8px';
                        resultsDiv.style.marginBottom = '0';
                    }

                    // Fetch results
                    fetch(`/header-search?q=${encodeURIComponent(query)}`)
                        .then(response => response.json())
                        .then(data => {
                            lastSearchResults = data;

                            if (data.length === 0) {
                                resultsDiv.innerHTML = '<div class="p-4 text-center text-gray-500">Sonuç bulunamadı</div>';
                                resultsDiv.classList.remove('hidden');
                                currentFilteredResults = [];
                                return;
                            }

                            // Apply filter
                            let filteredData = updateCurrentFilteredResults(data);

                            if (filteredData.length === 0) {
                                // No results for current filter
                                let html = `
    <div class="sticky top-0 bg-white border-b border-gray-100 p-3 z-10">
        <div class="flex items-center justify-between mb-2">
            <span class="text-sm font-medium text-gray-700">Filtrele:</span>
            ${activeFilter !== 'project' ? '<button class="clear-filter-btn text-xs text-primary hover:underline">Temizle</button>' : ''}
        </div>
        <div class="flex gap-2">
            <button class="filter-btn ${activeFilter === 'project' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700'} px-3 py-1.5 rounded-lg text-xs font-medium transition-colors flex items-center gap-1" data-type="project">
                <i class="fas fa-project-diagram text-xs"></i>
                Hizmetler
            </button>
            <button class="filter-btn ${activeFilter === 'job' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700'} px-3 py-1.5 rounded-lg text-xs font-medium transition-colors flex items-center gap-1" data-type="job">
                <i class="fas fa-briefcase text-xs"></i>
                İlanlar
            </button>
            <button class="filter-btn ${activeFilter === 'talent' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700'} px-3 py-1.5 rounded-lg text-xs font-medium transition-colors flex items-center gap-1" data-type="talent">
                <i class="fas fa-user text-xs"></i>
                Ustalar
            </button>
        </div>
    </div>
    <div class="p-6 text-center">
        <div class="text-gray-500 mb-4">${activeFilter === 'project' ? 'Hizmet' : activeFilter === 'job' ? 'İlan' : 'Usta'} sonuçlarında "${query}" bulunamadı</div>
        <button class="clear-filter-btn px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors">
            Filtreyi Temizle
        </button>
    </div>`;
                                resultsDiv.innerHTML = html;
                                resultsDiv.classList.remove('hidden');

                                // Add event listeners to new buttons
                                resultsDiv.querySelectorAll('.filter-btn').forEach(btn => {
                                    btn.addEventListener('click', function() {
                                        activeFilter = this.getAttribute('data-type');
                                        searchTags();
                                        setTimeout(() => searchInput.focus(), 100);
                                    });
                                });

                                resultsDiv.querySelectorAll('.clear-filter-btn').forEach(btn => {
                                    btn.addEventListener('click', function() {
                                        activeFilter = 'project';
                                        searchTags();
                                        setTimeout(() => searchInput.focus(), 100);
                                    });
                                });

                                return;
                            }

                            // Build results with filter buttons
                            let html = `
    <div class="sticky top-0 bg-white border-b border-gray-100 p-3 z-10">
        <div class="flex items-center justify-between mb-2">
            <span class="text-sm font-medium text-gray-700">Filter by:</span>
            ${activeFilter !== 'project' ? '<button class="clear-filter-btn text-xs text-primary hover:underline">Clear</button>' : ''}
        </div>
        <div class="flex gap-2">
            <button class="filter-btn ${activeFilter === 'project' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700'} px-3 py-1.5 rounded-lg text-xs font-medium transition-colors flex items-center gap-1" data-type="project">
                <i class="fas fa-project-diagram text-xs"></i>
                Hizmetler
            </button>
            <button class="filter-btn ${activeFilter === 'job' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700'} px-3 py-1.5 rounded-lg text-xs font-medium transition-colors flex items-center gap-1" data-type="job">
                <i class="fas fa-briefcase text-xs"></i>
                İlanlar
            </button>
            <button class="filter-btn ${activeFilter === 'talent' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700'} px-3 py-1.5 rounded-lg text-xs font-medium transition-colors flex items-center gap-1" data-type="talent">
                <i class="fas fa-user text-xs"></i>
                Ustalar
            </button>
        </div>
    </div>
    <div class="p-2 max-h-72 overflow-y-auto">`;

                            filteredData.forEach(item => {
                                html += `<a href="${item.url}" class="search-result-link flex items-center gap-3 px-4 py-3 hover:bg-gray-100 rounded-lg mb-1 transition-colors">`;
                                html += `<i class="${item.icon} text-primary"></i>`;
                                html += `<div class="flex-1">`;
                                html += `<span class="font-medium text-gray-800">${item.title}</span>`;
                                html += `<p class="text-xs text-gray-500 capitalize">${item.type}</p>`;
                                html += `</div>`;
                                html += `<i class="fas fa-arrow-right text-gray-400"></i>`;
                                html += `</a>`;
                            });

                            html += '</div>';
                            resultsDiv.innerHTML = html;
                            resultsDiv.classList.remove('hidden');

                            // Add event listeners
                            resultsDiv.querySelectorAll('.search-result-link').forEach(link => {
                                link.addEventListener('click', () => {
                                    resultsDiv.classList.add('hidden');
                                });
                            });

                            resultsDiv.querySelectorAll('.filter-btn').forEach(btn => {
                                btn.addEventListener('click', function() {
                                    activeFilter = this.getAttribute('data-type');
                                    searchTags();
                                    setTimeout(() => searchInput.focus(), 100);
                                });
                            });

                            resultsDiv.querySelectorAll('.clear-filter-btn').forEach(btn => {
                                btn.addEventListener('click', function() {
                                    activeFilter = 'project';
                                    searchTags();
                                    setTimeout(() => searchInput.focus(), 100);
                                });
                            });
                        })
                        .catch(error => {
                            console.error('Search error:', error);
                            resultsDiv.innerHTML = '<div class="p-4 text-center text-gray-500">Arama başarısız oldu</div>';
                            resultsDiv.classList.remove('hidden');
                            currentFilteredResults = [];
                        });
                }

                // Navigate to first result
                function navigateToFirstResult() {
                    if (currentFilteredResults.length > 0) {
                        window.location.href = currentFilteredResults[0].url;
                    } else if (lastSearchResults.length > 0) {
                        window.location.href = lastSearchResults[0].url;
                    }
                }

                // Event listeners
                searchInput.addEventListener('input', searchTags);

                searchBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (!resultsDiv.classList.contains('hidden') && currentFilteredResults.length > 0) {
                        navigateToFirstResult();
                    } else {
                        searchTags();
                    }
                });

                searchInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        resultsDiv.classList.add('hidden');
                        navigateToFirstResult();
                    }
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!searchContainer.contains(e.target)) {
                        resultsDiv.classList.add('hidden');
                    }
                });

                // Handle scroll on mobile
                let hideOnScroll = true;
                resultsDiv.addEventListener('wheel', function(e) {
                    hideOnScroll = false;
                    setTimeout(() => { hideOnScroll = true; }, 100);
                });

                window.addEventListener('scroll', function() {
                    if (window.innerWidth < 1024 && hideOnScroll) {
                        resultsDiv.classList.add('hidden');
                    }
                });
            }

            // Setup both search inputs
            setupEnhancedSearch('tag-search-input-mobile', 'tag-search-results-mobile');
            setupEnhancedSearch('tag-search-input-desktop', 'tag-search-results-desktop');
        });

        document.addEventListener('DOMContentLoaded', function() {
            const nav = document.getElementById('mainNav');
            const heroSection = document.querySelector('section[data-navbar-style]');

            if (!nav) return;

            // Function to update navbar colors based on background
            function updateNavbarColors(isDark) {
                const desktopLinks = document.querySelectorAll('#desktopMenu > li > a');
                const desktopArrows = document.querySelectorAll('#desktopMenu svg');
                const mobileBtn = document.getElementById('mobileMenuBtn');
                const userMenuButtons = document.querySelectorAll('a[href*="register"], a[href*="login"], a[href*="dashboard"], a[href*="community"], button[type="submit"]');

                if (isDark) {
                    // Light colors for dark background
                    nav.style.backgroundColor = 'transparent';
                    nav.style.borderColor = 'rgba(255, 255, 255, 0.1)';

                    desktopLinks.forEach(link => {
                        link.style.color = '#ffffff';
                        link.classList.remove('text-gray-700');
                        link.classList.add('text-white');
                    });

                    desktopArrows.forEach(svg => {
                        svg.style.color = '#ffffff';
                    });

                    if (mobileBtn) {
                        mobileBtn.style.color = '#ffffff';
                    }

                    userMenuButtons.forEach(btn => {
                        // Community button with bg-primary (filled style)
                        if (btn.textContent.includes('Community') && btn.classList.contains('bg-primary')) {
                            btn.style.color = '#ffffff';
                        }
                        // Community or Dashboard button with border (outlined style)
                        else if ((btn.textContent.includes('Community') || btn.textContent.includes('Dashboard')) && btn.classList.contains('border-primary')) {
                            btn.style.borderColor = 'rgba(255, 255, 255, 0.3)';
                            btn.style.color = '#ffffff';
                        }
                        // Sign Up button
                        else if (btn.textContent.includes('Sign Up') && btn.classList.contains('bg-primary')) {
                            btn.style.color = '#ffffff';
                        }
                    });
                } else {
                    // Dark colors for light background
                    nav.style.backgroundColor = '#ffffff';
                    nav.style.borderColor = 'rgb(229, 231, 235)';

                    desktopLinks.forEach(link => {
                        link.style.color = '#374151';
                        link.classList.add('text-gray-700');
                        link.classList.remove('text-white');
                    });

                    desktopArrows.forEach(svg => {
                        svg.style.color = '#6b7280';
                    });

                    if (mobileBtn) {
                        mobileBtn.style.color = '#4b5563';
                    }

                    userMenuButtons.forEach(btn => {
                        // Reset all styles to default
                        btn.style.borderColor = '';
                        btn.style.color = '';
                    });
                }
            }

            // Function to calculate luminance
            function getLuminance(color) {
                const rgb = color.match(/\d+/g);
                if (!rgb || rgb.length < 3) return 1;

                const [r, g, b] = rgb.map(val => {
                    const v = parseInt(val) / 255;
                    return v <= 0.03928 ? v / 12.92 : Math.pow((v + 0.055) / 1.055, 2.4);
                });

                return 0.2126 * r + 0.7152 * g + 0.0722 * b;
            }

            // Function to check if navbar is over hero section
            // Function to check if navbar is over hero section
            function checkNavbarPosition() {
                if (!heroSection) {
                    // If no hero section, use default light navbar
                    updateNavbarColors(false);
                    updateLogoDisplay(false);
                    return;
                }

                const navRect = nav.getBoundingClientRect();
                const heroRect = heroSection.getBoundingClientRect();

                // Check if navbar is overlapping with hero section
                const isOverHero = navRect.bottom > heroRect.top && navRect.top < heroRect.bottom;

                if (isOverHero) {
                    // Navbar is over hero section - check hero background color
                    const bgColor = heroSection.style.backgroundColor ||
                        window.getComputedStyle(heroSection).backgroundColor;
                    const isDark = getLuminance(bgColor) < 0.5;
                    updateNavbarColors(isDark);
                    updateLogoDisplay(isDark);
                } else {
                    // Navbar is not over hero section - use light navbar
                    updateNavbarColors(false);
                    updateLogoDisplay(false);
                }
            }

            // Function to switch logo based on background darkness
            function updateLogoDisplay(isDark) {
                const whiteLogo = document.querySelector('.site-white-logo');
                const darkLogo = document.querySelector('.site-dark-logo');

                if (!whiteLogo || !darkLogo) return;

                if (isDark) {
                    // Show white logo for dark background
                    whiteLogo.classList.remove('hidden');
                    darkLogo.classList.add('hidden');
                } else {
                    // Show dark logo for light background
                    whiteLogo.classList.add('hidden');
                    darkLogo.classList.remove('hidden');
                }
            }

            // Function to initialize navbar colors after menu is ready
            function initializeNavbarColorsSystem() {
                // First check immediately
                checkNavbarPosition();

                // Run on scroll
                window.addEventListener('scroll', checkNavbarPosition);

                // Also check after a small delay to ensure menu is fully built
                setTimeout(checkNavbarPosition, 200);

                // Monitor menu container for changes (in case menu loads asynchronously)
                const desktopMenu = document.getElementById('desktopMenu');
                if (desktopMenu) {
                    const menuObserver = new MutationObserver(function(mutations) {
                        // Only re-check if menu items were added
                        if (mutations.some(mutation => mutation.addedNodes.length > 0)) {
                            checkNavbarPosition();
                        }
                    });

                    menuObserver.observe(desktopMenu, {
                        childList: true,
                        subtree: true
                    });
                }
            }

         // Initialize based on page load state
            if (document.readyState === 'loading') {
                // Page is still loading, wait for DOMContentLoaded
                document.addEventListener('DOMContentLoaded', function() {
                    // Wait a bit more for menu JS to execute
                    setTimeout(initializeNavbarColorsSystem, 100);
                });
            } else {
                // DOM is already loaded, check if menu is initialized
                if (window.menuInitialized) {
                    // Menu JS already ran
                    initializeNavbarColorsSystem();
                } else {
                    // Wait for menu to initialize
                    setTimeout(initializeNavbarColorsSystem, 300);
                }
            }

            // Watch for hero section style changes
            if (heroSection) {
                const observer = new MutationObserver(checkNavbarPosition);
                observer.observe(heroSection, {
                    attributes: true,
                    attributeFilter: ['style']
                });
            }
        });

        // Logo switching based on hero section overlap
        document.addEventListener('DOMContentLoaded', function() {
            const whiteLogo = document.querySelector('.site-white-logo');
            const darkLogo = document.querySelector('.site-dark-logo');
            const heroSection = document.querySelector('section[data-navbar-style]');
            const nav = document.getElementById('mainNav');

            if (!whiteLogo || !darkLogo || !heroSection || !nav) return;

            function switchLogo() {
                const navRect = nav.getBoundingClientRect();
                const heroRect = heroSection.getBoundingClientRect();

                // Check if navbar is overlapping with hero section
                const isOverHero = navRect.bottom > heroRect.top && navRect.top < heroRect.bottom;

                if (isOverHero) {
                    // Show white logo when over hero section
                    whiteLogo.classList.remove('hidden');
                    darkLogo.classList.add('hidden');
                } else {
                    // Show dark logo when not over hero section
                    whiteLogo.classList.add('hidden');
                    darkLogo.classList.remove('hidden');
                }
            }

            // Run on load
            switchLogo();

            // Run on scroll
            window.addEventListener('scroll', switchLogo);
        });
        // Add CSS for search results dropdown positioning
        const style = document.createElement('style');
        style.textContent = `
            @media (max-width: 768px) {
                #tag-search-results-mobile,
                #tag-search-results-desktop {
                    position: fixed !important;
                    left: 16px !important;
                    right: 16px !important;
                    width: auto !important;
                    max-height: 300px !important;
                }

                @media (max-width: 480px) {
                    #tag-search-results-mobile,
                    #tag-search-results-desktop {
                        max-height: 250px !important;
                    }
                }
            }

            @media (min-width: 769px) {
                #tag-search-results-mobile,
                #tag-search-results-desktop {
                    min-width: 100% !important;
                    width: 100% !important;
                }
            }
        `;
        document.head.appendChild(style);

    </script>

    @if($background_shape)
        <div class="absolute -right-40 z-[1]">
            {!! render_image_markup_by_attachment_id($background_shape, '', 'full', __('Background Shape')) !!}
        </div>
    @endif
</section>