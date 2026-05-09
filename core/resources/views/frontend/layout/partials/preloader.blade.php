@php
    $loadingText = __('loading');
@endphp
@if (get_static_option('page_loader') != 'disable')
    <!-- Preloader Starts  -->
    <div id="preloader">
        <div class="preloader-inner">
            <div class="preloader-inner-item">
                @foreach (mb_str_split($loadingText) as $char)
                    <span>{{ $char }}</span>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Preloader Ends  -->
@endif
