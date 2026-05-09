@php
    if(!isset($page_post)){
        return;
    }
@endphp

        <!-- New Design Layout for Dynamic Pages -->
<main>
    <section class="w-full py-12 px-6 md:py-20 lg:py-[120px] flex items-center justify-center">
        <div class="max-w-7xl mx-auto p-6 bg-[#F8F9FD] rounded-md">
            <!-- Page Title -->
            <h1 class="text-3xl md:text-4xl font-bold mb-6 text-gray-700">{{ $page_post->title }}</h1>

            <!-- Page Content -->
            <div class="dynamic-page-content text-gray-700 leading-relaxed">
                {!! $page_post->page_content !!}
            </div>
        </div>
    </section>
</main>