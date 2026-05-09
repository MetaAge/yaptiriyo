<!-- HERO SECTION - Yaptırıyo -->
<section class="bg-white min-h-[80vh] flex items-center justify-center pt-32 pb-20 px-6 overflow-hidden">
    <div class="container mx-auto max-w-5xl">
        <div class="flex flex-col items-center text-center space-y-10">
            <!-- Content -->
            <div class="space-y-6 max-w-4xl">
                <h1 class="text-5xl md:text-6xl lg:text-7xl leading-tight font-bold text-slate-800 tracking-tight">
                    İhtiyacınız olan her hizmeti <span class="text-[#FA8C00]">Yaptırıyo</span> ile bulun.
                </h1>

                <p class="text-xl text-slate-500 max-w-2xl mx-auto leading-relaxed">
                    Temizlikten tadilata, nakliyattan boyacıya kadar binlerce doğrulanmış profesyonele anında ulaşın. Güvenle yaptırın.
                </p>
            </div>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo e($find_work_button_link ?? route('projects.all')); ?>"
                   class="px-10 py-5 bg-[#FA8C00] font-bold text-white rounded-lg shadow-xl hover:bg-[#E67E00] transform hover:-translate-y-1 transition-all duration-300 text-lg">
                    Hizmet Bul
                </a>
            </div>

            <!-- Search Input with Results Container -->
            <div class="relative w-full max-w-2xl mt-8">
                <div class="relative group">
                    <input type="text"
                           id="tag-search-input"
                           placeholder="Ne yaptırmak istiyorsunuz? (Temizlik, tamirat, nakliye...)"
                           class="w-full px-8 py-5 pr-16 text-lg rounded-2xl border-gray-200 border-2 focus:border-[#FA8C00] transition-all duration-300 shadow-sm outline-none bg-slate-50 focus:bg-white">
                    <button title="search"
                            id="tag-search-btn"
                            class="absolute right-3 top-1/2 -translate-y-1/2 w-12 h-12 bg-[#FA8C00] text-white rounded-xl hover:bg-[#E67E00] transition-colors duration-300 flex items-center justify-center">
                        <i class="fas fa-search text-lg"></i>
                    </button>

                    
                    <div id="tag-search-results"
                         class="hidden absolute left-0 right-0 mt-3 bg-white rounded-2xl shadow-2xl max-h-96 overflow-y-auto z-[100] border border-gray-100 p-2">
                        <!-- Filter buttons will be added here by JavaScript -->
                    </div>
                </div>
            </div>

            <!-- Tags -->
            <div class="flex flex-wrap gap-3 justify-center pt-6">
                <?php if(isset($skill_tags['tag_name_']) && is_array($skill_tags['tag_name_']) && count($skill_tags['tag_name_']) > 0): ?>
                    <?php $__currentLoopData = $skill_tags['tag_name_']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tag_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($skill_tags['tag_link_'][$key] ?? '#'); ?>"
                           class="px-5 py-2.5 bg-slate-100 text-slate-600 rounded-full text-sm font-semibold hover:bg-[#FA8C00] hover:text-white transition-all duration-300 cursor-pointer">
                            <?php echo e($tag_name); ?>

                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <?php
                        $sample_tags = ['Ev Temizliği', 'Tadilat & Boya', 'Nakliye', 'Tesisatçı', 'Elektrikçi'];
                    ?>
                    <?php $__currentLoopData = $sample_tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="px-5 py-2.5 bg-slate-100 text-slate-600 rounded-full text-sm font-semibold hover:bg-[#FA8C00] hover:text-white transition-all duration-300 cursor-pointer">
                            <?php echo e($tag); ?>

                        </span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('tag-search-input');
        const searchBtn = document.getElementById('tag-search-btn');
        const resultsDiv = document.getElementById('tag-search-results');
        const searchContainer = searchInput.parentElement;

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

            const inputRect = searchInput.getBoundingClientRect();
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

                    let filteredData = updateCurrentFilteredResults(data);

                    if (filteredData.length === 0) {
                        let html = `
    <div class="sticky top-0 bg-white border-b border-gray-100 p-3 z-10">
        <div class="flex items-center justify-between mb-2">
            <span class="text-sm font-medium text-gray-700">Filtrele:</span>
            ${activeFilter !== 'project' ? '<button onclick="clearFilter()" class="text-xs text-[#FA8C00] hover:underline">Temizle</button>' : ''}
        </div>
        <div class="flex gap-2">
            <button onclick="setFilter('project')" class="filter-btn ${activeFilter === 'project' ? 'bg-[#FA8C00] text-white' : 'bg-gray-100 text-gray-700'} px-3 py-1.5 rounded-lg text-xs font-medium transition-colors flex items-center gap-1">
                <i class="fas fa-concierge-bell text-xs"></i>
                Hizmetler
            </button>
            <button onclick="setFilter('job')" class="filter-btn ${activeFilter === 'job' ? 'bg-[#FA8C00] text-white' : 'bg-gray-100 text-gray-700'} px-3 py-1.5 rounded-lg text-xs font-medium transition-colors flex items-center gap-1">
                <i class="fas fa-briefcase text-xs"></i>
                İlanlar
            </button>
            <button onclick="setFilter('talent')" class="filter-btn ${activeFilter === 'talent' ? 'bg-[#FA8C00] text-white' : 'bg-gray-100 text-gray-700'} px-3 py-1.5 rounded-lg text-xs font-medium transition-colors flex items-center gap-1">
                <i class="fas fa-user text-xs"></i>
                Ustalar
            </button>
        </div>
    </div>
    <div class="p-6 text-center">
        <div class="text-gray-500 mb-4">"${query}" için sonuç bulunamadı</div>
        <div class="text-sm text-gray-600 mb-4">Farklı bir filtre veya arama terimi deneyin</div>
        <button onclick="clearFilter()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors">
            Filtreyi Temizle
        </button>
    </div>`;

                        resultsDiv.innerHTML = html;
                        resultsDiv.classList.remove('hidden');
                        return;
                    }

                    let html = `
            <div class="sticky top-0 bg-white border-b border-gray-100 p-3 z-10">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-gray-700">Filtrele:</span>
                                    ${activeFilter !== 'project' ? '<button onclick="clearFilter()" class="text-xs text-[#FA8C00] hover:underline">Temizle</button>' : ''}
                </div>
                <div class="flex gap-2">
                    <button onclick="setFilter('project')" class="filter-btn ${activeFilter === 'project' ? 'bg-[#FA8C00] text-white' : 'bg-gray-100 text-gray-700'} px-3 py-1.5 rounded-lg text-xs font-medium transition-colors flex items-center gap-1">
                        <i class="fas fa-concierge-bell text-xs"></i>
                        Hizmetler
                    </button>
                    <button onclick="setFilter('job')" class="filter-btn ${activeFilter === 'job' ? 'bg-[#FA8C00] text-white' : 'bg-gray-100 text-gray-700'} px-3 py-1.5 rounded-lg text-xs font-medium transition-colors flex items-center gap-1">
                        <i class="fas fa-briefcase text-xs"></i>
                        İlanlar
                    </button>
                    <button onclick="setFilter('talent')" class="filter-btn ${activeFilter === 'talent' ? 'bg-[#FA8C00] text-white' : 'bg-gray-100 text-gray-700'} px-3 py-1.5 rounded-lg text-xs font-medium transition-colors flex items-center gap-1">
                        <i class="fas fa-user text-xs"></i>
                        Ustalar
                    </button>
                </div>
            </div>
            <div class="p-2 max-h-72 overflow-y-auto">`;

                    filteredData.forEach(item => {
                        html += `<a href="${item.url}" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-100 rounded-lg mb-1 transition-colors search-result-link">`;
                        html += `<i class="${item.icon} text-[#FA8C00]"></i>`;
                        html += `<div class="flex-1">`;
                        html += `<span class="font-medium text-gray-800">${item.title}</span>`;
                        html += `<p class="text-xs text-gray-500 capitalize">${item.type === 'project' ? 'Hizmet' : item.type === 'job' ? 'İlan' : 'Usta'}</p>`;
                        html += `</div>`;
                        html += `<i class="fas fa-arrow-right text-gray-400"></i>`;
                        html += `</a>`;
                    });

                    html += '</div>';
                    resultsDiv.innerHTML = html;
                    resultsDiv.classList.remove('hidden');

                    const links = resultsDiv.querySelectorAll('.search-result-link');
                    links.forEach(link => {
                        link.addEventListener('click', () => {
                            resultsDiv.classList.add('hidden');
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

        function navigateToFirstResult() {
            if (currentFilteredResults.length > 0) {
                window.location.href = currentFilteredResults[0].url;
            } else if (lastSearchResults.length > 0) {
                window.location.href = lastSearchResults[0].url;
            }
        }

        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                resultsDiv.classList.add('hidden');
                navigateToFirstResult();
            }
        });

        searchInput.addEventListener('input', searchTags);
        searchBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (!resultsDiv.classList.contains('hidden') && currentFilteredResults.length > 0) {
                navigateToFirstResult();
            } else {
                searchTags();
            }
        });

        window.addEventListener('resize', () => {
            if (!resultsDiv.classList.contains('hidden')) {
                searchTags();
            }
        });

        document.addEventListener('click', function(e) {
            if (!searchContainer.contains(e.target)) {
                resultsDiv.classList.add('hidden');
            }
        });

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

        document.addEventListener('touchstart', function(e) {
            if (!searchContainer.contains(e.target)) {
                resultsDiv.classList.add('hidden');
            }
        });

        window.setFilter = function(type) {
            activeFilter = type;
            searchTags();
            setTimeout(() => {
                searchInput.focus();
            }, 100);
        };

        window.clearFilter = function() {
            activeFilter = 'project';
            searchTags();
            searchInput.focus();
        };
    });
</script><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/app/Providers/../../plugins/PageBuilder/views/header/header-one.blade.php ENDPATH**/ ?>