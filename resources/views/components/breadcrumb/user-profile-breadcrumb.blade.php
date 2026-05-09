<div class="breadcrumb-area border-top">
    <div class="container custom-container-one">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-contents">
                    <h4 class="breadcrumb-contents-title"> {{ $title }} </h4>
                    <ul class="breadcrumb-contents-list list-style-none">
                        <li class="breadcrumb-contents-list-item">
                            <a href="{{ route('homepage') }}" class="breadcrumb-contents-list-item-link">
                                {{ __('Home') }}
                            </a>
                        </li>

                        @auth
                            <li class="breadcrumb-contents-list-item">
                                @if (auth()->user()->user_type == 1)
                                    <a href="{{ route('client.dashboard') }}" class="breadcrumb-contents-list-item-link">
                                        {{ __('Dashboard') }}
                                    </a>
                                @else
                                    <a href="{{ route('freelancer.dashboard') }}" class="breadcrumb-contents-list-item-link">
                                        {{ __('Dashboard') }}
                                    </a>
                                @endif
                            </li>
                        @endauth

                        <li class="breadcrumb-contents-list-item">
                            <span class="breadcrumb-contents-list-item-text">{{ $innerTitle }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
