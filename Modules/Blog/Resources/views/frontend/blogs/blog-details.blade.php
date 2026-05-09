@extends('frontend.new_design.layout.new_master')

@if((isset($blog_details?->meta_data->meta_title) && !empty($blog_details?->meta_data->meta_title))|| (isset($blog_details?->title) && !empty($blog_details?->title)) )
    @section('site_title', $blog_details->meta_data->meta_title ?? $blog_details->title)
@else
    @section('site_title',__('Blog Details'))
@endif

@if((isset($blog_details?->meta_data->meta_title) && !empty($blog_details?->meta_data->meta_title))|| (isset($blog_details?->title) && !empty($blog_details?->title)) )
    @section('meta_title', $blog_details->meta_data->meta_title ?? $blog_details->title)
@else
    @section('meta_title',__('Blog Details'))
@endif

@if(isset($blog_details?->meta_data->meta_description) && !empty($blog_details?->meta_data->meta_description))
    @section('meta_description', $blog_details->meta_data->meta_description)
@endif

@section('content')
    <main>
        <!-- Breadcrumb -->
        <x-breadcrumb.user-profile-breadcrumb-02 :innerTitle="__('Blog Details')" />
        <!-- Blog Details Section -->
        <section class="">
            <div class="max-w-7xl px-6 mx-auto py-8 md:py-20 lg:py-[120px]">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    <!-- Main Content -->
                    <div class="lg:col-span-2">

                        <!-- Featured Image -->
                        <div class="mb-8 rounded-lg overflow-hidden">
                            <div class="w-full [&>img]:w-full [&>img]:h-96 [&>img]:object-cover">
                                {!! render_image_markup_by_attachment_id($blog_details->image) !!}
                            </div>
                        </div>

                        <!-- Article Header -->
                        <div class="mb-6">
                            <div class="flex items-center gap-4 mb-4 text-sm text-gray-600">
                                <span>{{ $blog_details->category ? $blog_details->category->category : __('Uncategorized') }}</span>
                                <span>|</span>
                                <span>{{ $blog_details->created_at->format('F d, Y') }}</span>
                            </div>
                            <h1 class="text-3xl font-medium mb-4">{{ $blog_details->title }}</h1>
                        </div>

                        <!-- Article Body -->
                        <div class="prose prose-lg max-w-none mb-8">
                            <div class="text-gray-700 leading-relaxed">
                                {!! $blog_details->content !!}
                            </div>
                        </div>

                        <!-- Tags Section (if you have tags) -->
                        @if($blog_details->tag_name)
                            <div class="mb-8">
                                <h3 class="text-2xl font-medium mb-4">{{ __('Tags') }}</h3>
                                <div class="flex flex-wrap gap-2 bg-[#F8F9FD] p-6 rounded-lg border border-gray-200">
                                    @php
                                        $tags = explode(',', $blog_details->tag_name);
                                    @endphp
                                    @foreach($tags as $tag)
                                        <span class="px-4 py-1 bg-white text-gray-700 rounded-full text-sm border">{{ trim($tag) }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Related Blog Section -->
                        @if($related_blogs->count() > 0)
                            <div>
                                <h3 class="text-2xl font-medium mb-6">{{ __('Related Blog') }}</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    @foreach($related_blogs as $blog)
                                        <div class="bg-[#F8F9FD] rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300 cursor-pointer">
                                            <a href="{{ route('blog.details', $blog->slug) }}">
                                                <div class="w-full [&>img]:w-full [&>img]:h-48 [&>img]:object-cover">
                                                    {!! render_image_markup_by_attachment_id($blog->image) !!}
                                                </div>
                                                <div class="p-4">
                                                    <p class="text-sm text-gray-600 mb-2">{{ $blog->created_at->format('F d, Y') }}</p>
                                                    <h4 class="font-semibold text-gray-900 mb-2">{{ $blog->title }}</h4>
                                                    <p class="text-sm text-gray-600">{{ $blog->category ? $blog->category->category : __('Uncategorized') }}</p>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Sidebar -->
                    <div class="lg:col-span-1 lg:sticky lg:top-28 h-max">


                        <!-- Categories -->
                        <div class="bg-white rounded-lg p-6 mb-8 border">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Categories') }} ({{ $categories->count() }})</h3>
                            <ul id="categoriesList" class="space-y-4">
                                <li class="border-b-[2px] transition-all duration-300 border-secondary pb-2 cursor-pointer group">
                                    <a href="{{ route('blog.all') }}" class="text-gray-600 hover:text-gray-700 font-medium group-hover:font-medium text-sm transition-all duration-300">
                                        {{ __('All') }} ({{ $blogs->total() }})
                                    </a>
                                </li>
                                @foreach($categories as $category)
                                    <li class="category-item border-b-[2px] transition-all duration-300 hover:border-secondary pb-2 cursor-pointer group">
                                        <a href="{{ route('blog.all') }}?category={{ $category->id }}"
                                           class="text-gray-600 hover:text-gray-700 group-hover:font-medium text-sm transition-all duration-300"
                                           data-category-name="{{ strtolower($category->category) }}">
                                            {{ $category->category }} ({{ $category->blogs_count }})
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <div id="noResults" class="hidden text-center text-gray-500 py-4">
                                {{ __('No categories found.') }}
                            </div>
                        </div>




                        <!-- Share Section -->
                        <div class="bg-primary/10 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Share This Article') }}</h3>
                            <div class="flex gap-3">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.details', $blog_details->slug)) }}"
                                   target="_blank"
                                   class="w-8 h-8 bg-primary rounded flex items-center justify-center hover:bg-secondary transition-colors">
                                    <i class="fab fa-facebook-f text-white"></i>
                                </a>
                                <a href="https://www.linkedin.com/shareArticle?url={{ urlencode(route('blog.details', $blog_details->slug)) }}"
                                   target="_blank"
                                   class="w-8 h-8 bg-primary rounded flex items-center justify-center hover:bg-secondary transition-colors">
                                    <i class="fab fa-linkedin-in text-white"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.details', $blog_details->slug)) }}&text={{ urlencode($blog_details->title) }}"
                                   target="_blank"
                                   class="w-8 h-8 bg-primary rounded flex items-center justify-center hover:bg-secondary transition-colors">
                                    <i class="fab fa-twitter text-white"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Get Started -->
        <section class="container mx-auto max-w-7xl px-6 py-10 md:py-16">
            <div class="container overflow-hidden mx-auto max-w-7xl px-10 py-10 md:py-20 lg:py-28 bg-[#051D17] rounded-lg relative">
                <div class="absolute inset-0 z-0 pointer-events-none">
                    <img class="absolute -left-10 bottom-5" src="{{ asset('assets/images/get-started/arc-2.svg') }}" alt="">
                </div>

                <div class="text-center relative z-10 flex items-center justify-center flex-col gap-6">
                    <h3 class="text-[36px] text-white font-medium animate-on-scroll">{{ __('Get Started with Xilancer') }}</h3>
                    <p class="text-white max-w-[600px] text-center">
                        {{ __('Connect with top freelancers or showcase your skills to clients worldwide. Start your journey today and turn ideas into successful projects.') }}
                    </p>
                    <a href="{{ route('homepage') }}" class="text-white flex font-medium hover:text-white bg-secondary hover:bg-primary transition-all duration-300 px-4 py-2 rounded-lg border-primary/50 items-center gap-2">
                        {{ __('Join Free') }}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('categorySearch');
                const categoryItems = document.querySelectorAll('.category-item');
                const categoriesList = document.getElementById('categoriesList');
                const noResults = document.getElementById('noResults');
                const allCategoryItem = document.querySelector('li:first-child');

                searchInput.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase().trim();
                    let visibleCount = 0;

                    // Always show the "All" category
                    allCategoryItem.style.display = 'block';

                    categoryItems.forEach(item => {
                        const categoryLink = item.querySelector('a');
                        const originalText = categoryLink.textContent;
                        const categoryName = categoryLink.getAttribute('data-category-name');

                        if (searchTerm === '' || categoryName.includes(searchTerm)) {
                            item.style.display = 'block';
                            visibleCount++;

                            // Highlight matching text
                            if (searchTerm !== '') {
                                const regex = new RegExp(`(${searchTerm})`, 'gi');
                                const highlightedText = originalText.replace(regex, '<span class="bg-yellow-200">$1</span>');
                                categoryLink.innerHTML = highlightedText;
                            } else {
                                categoryLink.innerHTML = originalText;
                            }
                        } else {
                            item.style.display = 'none';
                            categoryLink.innerHTML = originalText; // Reset to original text
                        }
                    });

                    // Handle no results
                    if (visibleCount === 0 && searchTerm !== '') {
                        noResults.classList.remove('hidden');
                        categoriesList.classList.add('hidden');
                    } else {
                        noResults.classList.add('hidden');
                        categoriesList.classList.remove('hidden');
                    }
                });

                // Clear search functionality
                const addClearButton = () => {
                    const existingClearBtn = document.querySelector('.clear-search');
                    if (existingClearBtn) existingClearBtn.remove();

                    if (searchInput.value !== '') {
                        const clearBtn = document.createElement('button');
                        clearBtn.innerHTML = '×';
                        clearBtn.className = 'clear-search absolute right-3 top-2.5 text-gray-400 hover:text-gray-600 cursor-pointer';
                        clearBtn.style.fontSize = '20px';
                        clearBtn.style.lineHeight = '1';

                        clearBtn.addEventListener('click', function() {
                            searchInput.value = '';
                            const event = new Event('input');
                            searchInput.dispatchEvent(event);
                            searchInput.focus();
                        });

                        searchInput.parentNode.appendChild(clearBtn);
                    }
                };

                searchInput.addEventListener('input', addClearButton);
                addClearButton(); // Initial check
            });
        </script>

    </main>
@endsection