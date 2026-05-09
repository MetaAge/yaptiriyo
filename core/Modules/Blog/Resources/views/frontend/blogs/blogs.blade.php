@extends('frontend.new_design.layout.new_master')
@section('site_title',__('Blogs'))
@section('meta_title'){{ __('Blogs') }}@endsection

@section('content')
    <main>

        <!-- Breadcrumb -->
        <x-breadcrumb.user-profile-breadcrumb-02 :innerTitle="__('All Blogs')" />

        <!-- Blogs -->
        <section class="bg-[#F8F9FD]">
            <div class="max-w-7xl mx-auto px-6 py-12 md:py-20 lg:py-[120px]">

                <!-- Section Heading -->
                <div class="max-w-2xl mb-10">
                    <h2 class="text-3xl font-medium mb-3">
                        {{ __('Latest Articles & Insights') }}
                    </h2>
                    <p class="text-gray-600 text-base md:text-lg">
                        {{ __('Explore helpful articles, tips, and industry trends written by experts.') }}
                    </p>
                </div>

                <!-- Main Content Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                    <!-- Articles Grid -->
                    <div class="lg:col-span-3">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12" id="articlesGrid">
                            @forelse($blogs as $blog)
                                <div class="blog-item group cursor-pointer bg-white rounded-lg hover:shadow-lg transition-shadow duration-300">
                                    <a href="{{ route('blog.details', $blog->slug) }}">
                                        <div class="relative overflow-hidden rounded-t-lg h-48">
                                            <div class="w-full h-full [&>img]:w-full [&>img]:h-full [&>img]:object-cover [&>img]:group-hover:scale-105 [&>img]:transition-transform [&>img]:duration-300">
                                                {!! render_image_markup_by_attachment_id($blog->image) !!}
                                            </div>
                                        </div>
                                        <div class="px-4 pb-4 pt-4">
                                            <p class="text-sm text-gray-500 mb-2">{{ $blog->created_at->format('F d, Y') }}</p>
                                            <h3 class="font-medium mb-2 group-hover:text-primary transition-colors duration-300 line-clamp-2">
                                                {{ $blog->title }}
                                            </h3>
                                            <p class="text-sm text-gray-600">{{ $blog->category ? $blog->category->category : __('Uncategorized') }}</p>
                                        </div>
                                    </a>
                                </div>
                            @empty
                                <div class="col-span-full text-center py-12">
                                    @if(isset($categoryId) && $categoryId != 'all')
                                        <p class="text-gray-600 mb-4">{{ __('No blogs found in this category.') }}</p>
                                    @endif
                                    <a href="{{ route('blog.all') }}?category=all"
                                       class="inline-block px-6 py-2 bg-primary text-white rounded-lg hover:bg-secondary transition-colors">
                                        {{ __('View All Blogs') }}
                                    </a>
                                </div>
                            @endforelse
                        </div>

                        <!-- Pagination -->
                        @if($blogs->hasPages())
                            <div class="flex justify-center items-center flex-wrap gap-2" id="paginationContainer">
                                {{ $blogs->appends(['category' => $categoryId ?? 'all'])->links() }}
                            </div>
                        @endif
                    </div>

                    <!-- Sidebar -->
                    <div class="lg:col-span-1">
                        <!-- Categories -->
                        <div class="bg-white rounded-lg p-6 mb-8 border">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Categories') }}</h3>
                            <ul class="space-y-4">
                                <li class="border-b-[2px] transition-all duration-300 {{ ($categoryId ?? 'all') == 'all' ? 'border-secondary' : 'border-transparent' }} pb-2 cursor-pointer group">
                                    <a href="{{ route('blog.all') }}?category=all"
                                       class="text-gray-600 hover:text-gray-700 font-medium group-hover:font-medium text-sm transition-all duration-300">
                                        {{ __('All Categories') }}
                                        <span class="text-gray-400 ml-1">({{ $categories->sum('blogs_count') }})</span>
                                    </a>
                                </li>
                                @foreach($categories as $category)
                                    <li class="border-b-[2px] transition-all duration-300 hover:border-secondary pb-2 cursor-pointer group {{ ($categoryId ?? '') == $category->id ? 'border-secondary' : 'border-transparent' }}">
                                        <a href="{{ route('blog.all') }}?category={{ $category->id }}"
                                           class="text-gray-600 hover:text-gray-700 group-hover:font-medium text-sm transition-all duration-300">
                                            {{ $category->category }}
                                            <span class="text-gray-400 ml-1">({{ $category->blogs_count }})</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection