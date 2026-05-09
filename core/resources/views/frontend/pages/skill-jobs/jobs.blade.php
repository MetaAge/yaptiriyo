@extends('frontend.new_design.layout.new_master')
@section('site_title', $skill->skill ?? __('Skill Jobs'))
@section('meta_title'){{ $skill->skill ?? __('Skill Jobs') }}@endsection

@section('content')
    <main>
        <!-- Breadcrumb -->
        <x-breadcrumb.user-profile-breadcrumb-02 :innerTitle="$skill->skill ?? __('Skill Jobs')" />

        <section class="bg-[#F8F9FD]">
            <div class="max-w-7xl mx-auto px-6 py-8 md:py-12 lg:py-16">
                <div class="mb-8">
                    <h1 class="text-3xl font-medium mb-2">{{ $skill->skill ?? __('Skill Jobs') }}</h1>
                    <p class="text-gray-600">{{ __('Browse all available freelance projects for this skill') }}</p>
                </div>

                <!-- Header Section -->
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-8">
                    <div class="flex items-center gap-4">
                        <div id="filter"
                             class="flex items-center gap-2 border border-gray-300 px-4 py-1 rounded-lg cursor-pointer hover:bg-gray-200 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                            </svg>
                            <span>{{ __('Filter') }}</span>
                        </div>
                        <span class="text-base-400 job-count-display">{{ __('Showing') }} {{ $jobs->count() }} {{ __('out of') }} {{ $jobs->total() }} {{ __('results') }}</span>
                    </div>

                    <div class="flex items-center gap-3 whitespace-nowrap md:self-auto w-full sm:w-auto">
                        <span class="text-base-400 font-medium">{{ __('Sort by') }}</span>
                        <div class="relative min-w-[180px] sm:min-w-[200px] w-full sm:w-auto">
                            <select title="sort by" id="sort_by"
                                    class="my-select w-full px-4 py-2.5 border border-gray-300 rounded-lg bg-white text-gray-700 cursor-pointer appearance-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                                <option value="">{{ __('Default') }}</option>
                                <option value="newest">{{ __('Newest') }}</option>
                                <option value="oldest">{{ __('Oldest') }}</option>
                                <option value="price_high">{{ __('Price: High to Low') }}</option>
                                <option value="price_low">{{ __('Price: Low to High') }}</option>
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
                <div class="active-filters-section mb-12" style="display: none;">
                    <h4 class="text-lg font-medium mb-2">{{ __('You selected') }}</h4>
                    <div class="flex items-center justify-between">
                        <div class="flex flex-wrap gap-2" id="active-filters-container">
                            <!-- Active filters will be inserted here -->
                        </div>
                        <span id="clear-all-filters"
                              class="px-3 py-1 bg-primary text-white hover:bg-red-600 cursor-pointer flex items-center justify-center gap-0 rounded-full text-xs">
                            {{ __('Clear All') }}
                        </span>
                    </div>
                </div>

                <input type="hidden" id="skill_id" value="{{ $skill->id ?? '' }}">

                <!-- Jobs Grid -->
                <div class="search_job_result">
                    @include('frontend.pages.skill-jobs.search-job-result')
                </div>

                <!-- Sidebar Filter -->
                @include('frontend.pages.skill-jobs.sidebar')
            </div>
        </section>
    </main>
@endsection

@push('page_scripts')
    <script>
        window.routes = {
            subcategoryAll: "{{ route('au.subcategory.all') }}",
            stateAll: "{{ route('au.state.all') }}",
            skillJobsFilter: "{{ route('skill.jobs.filter') }}",
            skillJobsPagination: "{{ route('skill.jobs.pagination') }}",
            skillJobsFilterReset: "{{ route('skill.jobs.filter.reset') }}"
        };
        window.csrfToken = "{{ csrf_token() }}";
        window.skillId = "{{ $skill->id ?? '' }}";

        console.log('Route URLs:', window.routes);
        console.log('Skill ID:', window.skillId);
    </script>

    @include('frontend.pages.skill-jobs.jobs-filter-js')
@endpush