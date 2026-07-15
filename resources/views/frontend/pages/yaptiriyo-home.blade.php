@extends('frontend.new_design.layout.new_master')

@section('page-meta-data')
    <title>{{ get_static_option('site_title', 'Yaptiriyo') }} — {{ __('Aradığın usta, bir dokunuş uzağında') }}</title>
    <meta name="description" content="{{ __('Tesisatçıdan boyacıya, temizlikten nakliyeye binlerce güvenilir usta. Fiyatı önceden öğren, güvenle sipariş ver.') }}">
    <link rel="canonical" href="{{ route('homepage') }}">
    <script type="application/ld+json">{!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => 'Yaptiriyo',
        'url' => route('homepage'),
        'potentialAction' => [
            '@type' => 'SearchAction',
            'target' => route('projects.all') . '?search={search_term_string}',
            'query-input' => 'required name=search_term_string',
        ],
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endsection

@section('content')
<main class="pt-20 md:pt-24">

    {{-- HERO --}}
    <section class="relative overflow-hidden" style="background: linear-gradient(135deg, #FF751F 0%, #FF8E53 60%, #FFA97A 100%);">
        <div class="absolute -right-16 -top-16 w-72 h-72 rounded-full bg-white/10"></div>
        <div class="absolute right-24 bottom-0 w-40 h-40 rounded-full bg-white/5"></div>
        <div class="max-w-7xl mx-auto px-4 md:px-6 py-14 md:py-24 relative z-10">
            <div class="max-w-2xl">
                <h1 class="text-3xl md:text-5xl font-extrabold text-white leading-tight mb-4">
                    {{ __('Aradığın usta, bir dokunuş uzağında') }}
                </h1>
                <p class="text-white/90 text-base md:text-lg mb-8">
                    {{ __('Tesisatçıdan boyacıya, temizlikten nakliyeye binlerce güvenilir usta tek platformda. Fiyatı önceden öğren, güvenle sipariş ver.') }}
                </p>

                {{-- Arama --}}
                <form action="{{ route('projects.all') }}" method="GET" class="flex bg-white rounded-2xl p-2 shadow-lg max-w-xl">
                    <input type="text" name="search"
                           placeholder="{{ __('Usta, hizmet veya kategori ara...') }}"
                           class="flex-1 px-4 py-3 text-gray-700 outline-none rounded-xl min-w-0">
                    <button type="submit"
                            class="bg-primary text-white font-semibold px-6 py-3 rounded-xl hover:opacity-90 transition shrink-0">
                        <i class="fa-solid fa-magnifying-glass mr-1"></i> {{ __('Ara') }}
                    </button>
                </form>

                {{-- Hızlı kategoriler --}}
                @if($top_categories->isNotEmpty())
                    <div class="flex flex-wrap gap-2 mt-6">
                        @foreach($top_categories->take(5) as $cat)
                            <a href="{{ route('category.projects', ['slug' => $cat->slug]) }}"
                               class="bg-white/15 hover:bg-white/25 text-white text-sm font-medium px-4 py-2 rounded-full transition">
                                {{ $cat->category }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- GÜVEN ŞERİDİ --}}
    <section class="border-b border-gray-100 bg-white">
        <div class="max-w-7xl mx-auto px-4 md:px-6 py-6 grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
            <div class="flex items-center justify-center gap-2 text-gray-700">
                <i class="fa-solid fa-shield-halved text-primary text-xl"></i>
                <span class="text-sm font-semibold">{{ __('Onaylı Ustalar') }}</span>
            </div>
            <div class="flex items-center justify-center gap-2 text-gray-700">
                <i class="fa-solid fa-lock text-primary text-xl"></i>
                <span class="text-sm font-semibold">{{ __('Güvenli Ödeme') }}</span>
            </div>
            <div class="flex items-center justify-center gap-2 text-gray-700">
                <i class="fa-solid fa-bolt text-primary text-xl"></i>
                <span class="text-sm font-semibold">{{ __('Acil Hizmet') }}</span>
            </div>
            <div class="flex items-center justify-center gap-2 text-gray-700">
                <i class="fa-solid fa-star text-primary text-xl"></i>
                <span class="text-sm font-semibold">{{ __('Gerçek Yorumlar') }}</span>
            </div>
        </div>
    </section>

    {{-- KATEGORİLER --}}
    @if($top_categories->isNotEmpty())
    <section class="max-w-7xl mx-auto px-4 md:px-6 py-12 md:py-16">
        <div class="flex items-end justify-between mb-8">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">{{ __('Kategorilere Göz At') }}</h2>
                <p class="text-gray-500 mt-1">{{ __('Ne lazımsa hepsi burada') }}</p>
            </div>
            <a href="{{ route('projects.all') }}" class="text-primary font-semibold text-sm hover:underline shrink-0">
                {{ __('Tümünü Gör') }} <i class="fa-solid fa-arrow-right ml-1"></i>
            </a>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach($top_categories as $cat)
                <a href="{{ route('category.projects', ['slug' => $cat->slug]) }}"
                   class="group bg-white border border-gray-100 rounded-2xl p-5 text-center hover:border-primary/40 hover:shadow-lg transition">
                    <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-primary/10 text-primary flex items-center justify-center group-hover:bg-primary group-hover:text-white transition">
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                    </div>
                    <div class="text-sm font-semibold text-gray-800 group-hover:text-primary transition">{{ $cat->category }}</div>
                </a>
            @endforeach
        </div>
    </section>
    @endif

    {{-- ÖNE ÇIKAN HİZMETLER --}}
    @if($featured_projects->isNotEmpty())
    <section class="bg-gray-50 py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <div class="flex items-end justify-between mb-8">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900">
                        <i class="fa-solid fa-rocket text-primary mr-2"></i>{{ __('Öne Çıkan Hizmetler') }}
                    </h2>
                    <p class="text-gray-500 mt-1">{{ __('En çok tercih edilen ustalar ve hizmetler') }}</p>
                </div>
                <a href="{{ route('projects.all') }}" class="text-primary font-semibold text-sm hover:underline shrink-0">
                    {{ __('Tümünü Gör') }} <i class="fa-solid fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($featured_projects as $project)
                    @php
                        $creator = $project->project_creator;
                        $price = ($project->basic_discount_charge ?? 0) > 0
                            ? $project->basic_discount_charge
                            : $project->basic_regular_charge;
                    @endphp
                    <a href="{{ $creator?->username ? route('project.details', ['username' => $creator->username, 'slug' => $project->slug]) : '#' }}"
                       class="group bg-white rounded-2xl overflow-hidden border border-gray-100 hover:shadow-xl hover:border-primary/30 transition flex flex-col">
                        <div class="relative h-44 bg-gray-100 overflow-hidden">
                            @if($project->first_image)
                                @if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi']))
                                    <img src="{{ render_frontend_cloud_image_if_module_exists('project/'.$project->first_image, load_from: $project->load_from) }}"
                                         alt="{{ $project->title }}" loading="lazy"
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                @else
                                    <img src="{{ asset('assets/uploads/project/' . $project->first_image) }}"
                                         alt="{{ $project->title }}" loading="lazy"
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                @endif
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <i class="fa-regular fa-image text-4xl"></i>
                                </div>
                            @endif
                            <span class="absolute top-3 left-3 bg-primary text-white text-[11px] font-bold px-2.5 py-1 rounded-full">
                                <i class="fa-solid fa-rocket mr-1"></i>{{ __('Öne Çıkan') }}
                            </span>
                        </div>
                        <div class="p-4 flex flex-col flex-1">
                            <h3 class="font-semibold text-gray-900 text-sm leading-snug line-clamp-2 mb-2 group-hover:text-primary transition">
                                {{ $project->title }}
                            </h3>
                            <div class="flex items-center gap-2 text-xs text-gray-500 mb-3">
                                <span class="font-medium">{{ $creator?->first_name }} {{ $creator?->last_name }}</span>
                                @if(($project->ratings_count ?? 0) > 0)
                                    <span class="flex items-center gap-1 text-amber-500 font-semibold">
                                        <i class="fa-solid fa-star"></i>{{ number_format((float) $project->ratings_avg_rating, 1) }}
                                    </span>
                                @else
                                    <span class="bg-green-50 text-green-700 font-semibold px-2 py-0.5 rounded-full">{{ __('Yeni') }}</span>
                                @endif
                            </div>
                            <div class="mt-auto pt-3 border-t border-gray-100 flex items-center justify-between">
                                <span class="text-[11px] text-gray-400">{{ __('Başlangıç') }}</span>
                                <span class="text-primary font-bold">{{ yaptiriyo_price_label($price, $project->pricing_type) }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- NASIL ÇALIŞIR --}}
    <section class="max-w-7xl mx-auto px-4 md:px-6 py-12 md:py-16">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 text-center mb-10">{{ __('Nasıl Çalışır?') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-14 h-14 mx-auto mb-4 rounded-2xl bg-primary/10 text-primary flex items-center justify-center text-xl font-extrabold">1</div>
                <h3 class="font-bold text-gray-900 mb-2">{{ __('Hizmeti Seç') }}</h3>
                <p class="text-sm text-gray-500">{{ __('Kategorilerden ihtiyacını bul, ustaları ve fiyatları karşılaştır.') }}</p>
            </div>
            <div class="text-center">
                <div class="w-14 h-14 mx-auto mb-4 rounded-2xl bg-primary/10 text-primary flex items-center justify-center text-xl font-extrabold">2</div>
                <h3 class="font-bold text-gray-900 mb-2">{{ __('Randevunu Oluştur') }}</h3>
                <p class="text-sm text-gray-500">{{ __('Adresini ve uygun tarihi seç, güvenli ödemeyle siparişini ver.') }}</p>
            </div>
            <div class="text-center">
                <div class="w-14 h-14 mx-auto mb-4 rounded-2xl bg-primary/10 text-primary flex items-center justify-center text-xl font-extrabold">3</div>
                <h3 class="font-bold text-gray-900 mb-2">{{ __('İş Bitince Onayla') }}</h3>
                <p class="text-sm text-gray-500">{{ __('Usta işi tamamlasın, sen onayla — ödemen o zamana kadar güvende.') }}</p>
            </div>
        </div>
    </section>

    {{-- USTA CTA --}}
    <section class="max-w-7xl mx-auto px-4 md:px-6 pb-14 md:pb-20">
        <div class="rounded-3xl p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-6"
             style="background: linear-gradient(135deg, #11141D 0%, #1E2432 100%);">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-2">{{ __('Usta mısın? Kazanmaya başla') }}</h2>
                <p class="text-white/70 text-sm md:text-base">{{ __('Ücretsiz kayıt ol, hizmetlerini oluştur, yakınındaki işlere teklif ver.') }}</p>
            </div>
            <a href="{{ route('user.register') }}"
               class="bg-primary text-white font-bold px-8 py-4 rounded-2xl hover:opacity-90 transition shrink-0">
                {{ __('Hemen Kayıt Ol') }} <i class="fa-solid fa-arrow-right ml-1"></i>
            </a>
        </div>
    </section>

</main>
@endsection
