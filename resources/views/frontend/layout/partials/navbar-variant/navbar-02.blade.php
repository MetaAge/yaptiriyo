<header class="bg-white border-b border-gray-100 sticky top-0 z-[1000]">
    <nav class="navbar navbar-area navbar-expand-lg py-4">
        <div class="container mx-auto max-w-7xl px-6 flex items-center justify-between">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('homepage') }}" class="flex items-center">
                    @if(!empty(get_static_option('site_logo')))
                        {!! render_image_markup_by_attachment_id(get_static_option('site_logo'), '', 'h-8 w-auto') !!}
                    @else
                        <img src="{{ asset('assets/static/img/logo/logo.png') }}" alt="site-logo" class="h-8 w-auto">
                    @endif
                </a>
            </div>

            <!-- Mobile Toggler -->
            <div class="lg:hidden flex items-center gap-4">
                <button class="navbar-toggler p-2 text-slate-600 focus:outline-none" type="button" data-bs-toggle="collapse" data-bs-target="#xilancer_menu">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>

            <!-- Menu & Auth -->
            <div class="collapse navbar-collapse flex-grow justify-end" id="xilancer_menu">
                <div class="flex flex-col lg:flex-row items-center gap-8 lg:gap-10">
                    <!-- Nav Links -->
                    <ul class="flex flex-col lg:flex-row items-center gap-6 lg:gap-8 font-medium text-slate-600">
                        {!! render_frontend_menu($primary_menu) !!}
                    </ul>

                    <!-- User Menu / Auth -->
                    <div class="flex items-center gap-4 border-t lg:border-t-0 pt-4 lg:pt-0 w-full lg:w-auto">
                        <x-frontend.user-menu />
                    </div>
                </div>
            </div>
        </div>
    </nav>
    @if(request()->routeIs('homepage'))
        <x-frontend.category.category />
    @endif
</header>

<style>
    /* Premium Bionluk-style button overrides for User Menu components */
    .user-menu-item-link { @apply font-semibold text-slate-600 hover:text-[#FA8C00] transition-colors; }
    .btn-register, .register-btn { 
        background-color: #FA8C00 !important; 
        color: white !important; 
        border-radius: 8px !important;
        padding: 10px 24px !important;
        font-weight: 700 !important;
        transition: all 0.3s ease !important;
    }
    .btn-register:hover, .register-btn:hover {
        background-color: #E67E00 !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(250, 140, 0, 0.2);
    }
</style>
