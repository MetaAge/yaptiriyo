<!-- Preloader Starts  -->
@php
    $loadingText = __('loading');
@endphp
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
