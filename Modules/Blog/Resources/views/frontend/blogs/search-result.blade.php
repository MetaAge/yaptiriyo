<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12" id="articlesGrid">
    @if($blogs->count() > 0)
        @foreach($blogs as $blog)
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
        @endforeach
    @else
        <div class="col-span-full text-center py-12">
            <h4 class="text-danger text-xl">{{ __('No Blogs Found') }}</h4>
        </div>
    @endif
</div>

<!-- Pagination -->
<x-pagination.laravel-paginate-02 :allData="$jobs" />