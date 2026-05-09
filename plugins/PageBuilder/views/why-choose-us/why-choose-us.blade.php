<!-- Neden Yaptırıyo? Section -->
<section class="bg-white" style="padding-top: {{ $padding_top }}px; padding-bottom: {{ $padding_bottom }}px;">
    <div class="container mx-auto max-w-7xl px-6">
        <!-- Section Header -->
        <div class="text-center mb-16 space-y-4">
            <h2 class="text-4xl md:text-5xl font-bold text-slate-800 leading-tight">
                {{ $title ?? 'Neden Yaptırıyo\'yu Tercih Etmelisiniz?' }}
            </h2>
        </div>

        <!-- Features Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            @if(!empty($repeater_data['title_']))
                @foreach ($repeater_data['title_'] as $key => $item_title)
                    <div class="group flex flex-col items-center text-center space-y-6 p-8 rounded-2xl hover:bg-slate-50 transition-all duration-300 transform hover:-translate-y-2">
                        <!-- Icon / Illustration -->
                        <div class="w-24 h-24 bg-slate-100 rounded-2xl flex items-center justify-center group-hover:bg-[#FA8C00]/10 transition-colors">
                            @if(!empty($repeater_data['image_'][$key] ?? ''))
                                {!! render_image_markup_by_attachment_id($repeater_data['image_'][$key], '', 'w-16 h-16 object-contain') !!}
                            @else
                                <i class="fas fa-rocket text-3xl text-slate-400 group-hover:text-[#FA8C00] transition-colors"></i>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="space-y-3">
                            <h3 class="text-2xl font-bold text-slate-800 tracking-tight">
                                {{ $item_title }}
                            </h3>
                            @if(!empty($repeater_data['description_'][$key] ?? ''))
                                <p class="text-slate-500 leading-relaxed">
                                    {{ $repeater_data['description_'][$key] }}
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>