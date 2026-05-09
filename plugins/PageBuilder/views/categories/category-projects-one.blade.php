@if(get_static_option('project_enable_disable') != 'disable')
    <!-- Kategorilere Göre Hizmetler -->
    <section class="py-16 bg-white"
             @if($section_bg) style="background-color: {{$section_bg}};" @endif
             data-padding-top="{{$padding_top ?? ''}}"
             data-padding-bottom="{{$padding_bottom ?? ''}}">
        <div class="container mx-auto max-w-7xl px-6">

            <!-- Section Title -->
            <div class="flex flex-col items-center text-center mb-12 space-y-4">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-800">
                    Kategorilere Göre Hizmetler
                </h2>
                <div class="w-20 h-1.5 bg-[#FA8C00] rounded-full"></div>
            </div>

            <!-- Categories Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8">
                @foreach($project_categories as $category)
                    @php
                        $customData = $processed_categories[$category->id] ?? null;
                        $backgroundImage = $customData['background_image'] ?? null;
                    @endphp

                    <a href="{{ route('category.projects', $category->slug) }}"
                       class="group flex flex-col items-center space-y-4 transition-all duration-300">
                        
                        <!-- Circular Icon Container -->
                        <div class="relative w-24 h-24 md:w-32 md:h-32 rounded-full bg-slate-50 border-2 border-slate-100 flex items-center justify-center overflow-hidden group-hover:border-[#FA8C00] group-hover:shadow-xl transition-all duration-300">
                            @if(!empty($backgroundImage))
                                <img src="{{ get_attachment_image_by_id($backgroundImage)['img_url'] ?? '' }}"
                                     alt="{{ $category->category ?? '' }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <i class="fas fa-th-large text-3xl text-slate-300 group-hover:text-[#FA8C00] transition-colors"></i>
                            @endif
                            
                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-[#FA8C00]/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>

                        <!-- Text Content -->
                        <div class="text-center">
                            <h3 class="text-base md:text-lg font-bold text-slate-700 group-hover:text-[#FA8C00] transition-colors line-clamp-1">
                                {{ $category->category ?? '' }}
                            </h3>
                            <span class="text-xs text-slate-400 font-medium">
                                {{ $category->projects_count ?? 0 }} Hizmet
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- View All Button -->
            <div class="mt-16 text-center">
                <a href="{{ $view_all_button_link }}"
                   class="inline-flex items-center gap-2 px-8 py-3 border-2 border-[#FA8C00] text-[#FA8C00] font-bold rounded-xl hover:bg-[#FA8C00] hover:text-white transition-all duration-300">
                    Tüm Kategorileri Gör
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                    </svg>
                </a>
            </div>
        </div>
    </section>
@endif