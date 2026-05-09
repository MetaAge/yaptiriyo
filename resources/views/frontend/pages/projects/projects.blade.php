@extends('frontend.new_design.layout.new_master')
@section('site_title','Hizmetler')
@section('meta_title')Hizmetler@endsection

@section('content')

    <main>

        <!-- Breadcrumb -->
        <x-breadcrumb.user-profile-breadcrumb-02 :innerTitle="'Tüm Hizmetler'" />

        <section class="bg-[#F8F9FD]">
            <div class="max-w-7xl mx-auto px-6 py-8 md:py-12 lg:py-16">
                <div class="mb-8">
                    <h1 class="text-3xl font-medium mb-2 text-base-300">Tüm Hizmetler</h1>
                    <p class="text-base-400">En iyi hizmetlerimizi keşfedin</p>
                </div>

                <!-- Header Section -->
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-8 overflow-hidden">
                    <div class="flex items-center gap-4">
                        <div id="filter"
                             class="flex items-center gap-2 border border-gray-300 px-4 py-1 rounded-lg cursor-pointer hover:bg-gray-200 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                            </svg>
                            <span class="text-base-400">Filtrele</span>
                        </div>
                        <span class="text-base-400 project-count-display">{{ $projects->count() }} / {{ $projects->total() }} sonuç gösteriliyor</span>
                    </div>

                    <div class="flex items-center gap-3 whitespace-nowrap md:self-auto w-full sm:w-auto justify-end">
                        <span class="text-base-400 font-medium">Sıralama</span>
                        <div class="relative min-w-[180px] w-full sm:w-auto">
                            <select title="sort by" id="sort_by"
                                    class="my-select w-full px-4 py-2.5 border border-gray-300 rounded-lg bg-white text-gray-700 cursor-pointer appearance-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                                <option value="">Varsayılan</option>
                                <option value="newest">En Yeni</option>
                                <option value="oldest">En Eski</option>
                                <option value="price_high">Fiyat: Yüksekten Düşüğe</option>
                                <option value="price_low">Fiyat: Düşükten Yükseğe</option>
                            </select>
                            <!-- Custom dropdown arrow -->
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Filters Display -->
                <div class="active-filters-section" style="display: none;">
                    <h4 class="text-lg font-medium mb-2">Seçtikleriniz</h4>
                    <div class="flex items-center justify-between mb-12">
                        <div class="flex flex-wrap gap-2" id="active-filters-container">
                            <!-- Active filters will be inserted here -->
                        </div>
                        <span id="clear-all-filters"
                              class="px-3 py-1 bg-primary text-white hover:bg-red-600 cursor-pointer flex items-center justify-center gap-0 rounded-full text-xs">
                            Tümünü Temizle
                        </span>
                    </div>
                </div>

                <input type="hidden" id="category_id" value="{{ $category->id ?? '' }}">

                <!-- Projects Grid -->
                <div class="search_project_result">
                    @include('frontend.pages.projects.search-result')
                </div>

                <script>
                    window.maxProjectPrice = {{ $maxProjectPrice ?? 1000 }};
                </script>

                <!-- Sidebar Filter -->
                @include('frontend.pages.projects.sidebar', ['maxProjectPrice' => $maxProjectPrice])
            </div>
        </section>

    </main>


@endsection

@push('page_scripts')
    <script>
        window.routes = window.routes || {};
        window.routes.subcategoryAll = "{{ route('au.subcategory.all') }}";
        window.routes.stateAll = "{{ route('au.state.all') }}";
        window.routes.projectsFilter = "{{ route('projects.filter') }}";
        window.routes.projectsPagination = "{{ route('projects.pagination') }}";
        window.routes.projectsFilterReset = "{{ route('projects.filter.reset') }}";
        window.csrfToken = "{{ csrf_token() }}";
        window.maxProjectPrice = {{ $maxProjectPrice ?? 1000 }};
    </script>

    @include('frontend.pages.projects.project-filter-js')
@endpush

