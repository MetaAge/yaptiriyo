@extends('backend.layout.master')
@section('title', __('Project Details'))
@section('style')
    <x-select2.select2-css />
@endsection
@section('content')
    <div class="dashboard__body">
        <div class="customMarkup__single__item">

            <div class="customMarkup__single__inner mt-4">
                <div class="row g-4">
                    <div class="col-xl-7 col-lg-12">
                        <div class="project-preview">
                            @php
                                // Get all media for this project (images AND videos)
                                $projectMedia = $project->media ?? [];
                                $mediaCount = count($projectMedia);
                                $hasMultipleMedia = $mediaCount > 1;
                            @endphp

                            <div class="project-preview-thumb">
                                @if($mediaCount > 0)
                                    {{-- TO: Bootstrap Carousel --}}
                                    <div id="projectMediaCarousel" class="carousel slide" data-bs-ride="carousel">
                                        <!-- Indicators -->
                                        @if($mediaCount > 1)
                                            <div class="carousel-indicators">
                                                @foreach($projectMedia as $index => $mediaFile)
                                                    <button type="button"
                                                            data-bs-target="#projectMediaCarousel"
                                                            data-bs-slide-to="{{ $index }}"
                                                            class="{{ $index === 0 ? 'active' : '' }}"
                                                            aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                                            aria-label="Slide {{ $index + 1 }}"></button>
                                                @endforeach
                                            </div>
                                        @endif

                                        <!-- Slides -->
                                        <div class="carousel-inner rounded-lg overflow-hidden">
                                            @foreach($projectMedia as $index => $mediaFile)
                                                @php
                                                    $ext = pathinfo($mediaFile, PATHINFO_EXTENSION);
                                                    $isImage = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'bmp', 'tiff', 'svg', 'webp', 'gif', 'avif']);
                                                @endphp
                                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                    @if($isImage)
                                                        @if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi']))
                                                            <img src="{{ render_frontend_cloud_image_if_module_exists('project/'.$mediaFile, load_from: $project->load_from) }}"
                                                                 class="d-block w-100"
                                                                 alt="{{ $project->title }}"
                                                                 style="height: 400px; object-fit: cover;">
                                                        @else
                                                            <img src="{{ asset('assets/uploads/project/' . $mediaFile) }}"
                                                                 class="d-block w-100"
                                                                 alt="{{ $project->title }}"
                                                                 style="height: 400px; object-fit: cover;">
                                                        @endif
                                                    @else
                                                        @if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi']))
                                                            <video src="{{ render_frontend_cloud_image_if_module_exists('project/'.$mediaFile, load_from: $project->load_from) }}"
                                                                   class="d-block w-100"
                                                                   controls muted loop playsinline
                                                                   style="height: 400px; object-fit: cover;">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        @else
                                                            <video src="{{ asset('assets/uploads/project/' . $mediaFile) }}"
                                                                   class="d-block w-100"
                                                                   controls muted loop playsinline
                                                                   style="height: 400px; object-fit: cover;">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        @endif
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>

                                        <!-- Navigation arrows -->
                                        @if($mediaCount > 1)
                                            <button class="carousel-control-prev" type="button" data-bs-target="#projectMediaCarousel" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon custom-carousel-prev" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#projectMediaCarousel" data-bs-slide="next">
                                                <span class="carousel-control-next-icon custom-carousel-next" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        @endif
                                    </div>
                                @else
                                    <!-- Fallback: No media -->
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                        <div class="text-center">
                                            <svg class="w-16 h-16 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <span class="text-gray-400 text-sm">{{ __('No Media') }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="project-preview-contents mt-4">
                                <div class="customMarkup__single__item__flex project--rejected--wrapper">
                                   <span class="customMarkup__single__title">{{ __('Status:') }}
                                    @if ($project->status === 0)
                                     <span>{{ __('Pending') }}</span>
                                       @elseif($project->status === 1)
                                        <span>{{ __('Approved') }}</span>
                                            @elseif($project->status === 2)
                                           <span>{{ __('Rejected') }}</span>
                                              @endif
            </span>
                                    <span class="customMarkup__single__title">{{ __('Reject:') }}
                <span>{{ $project->project_history?->reject_count ?? '0' }}</span>
            </span>
                                    <span class="customMarkup__single__title">{{ __('Edit:') }}
                <span>{{ $project->project_history?->edit_count ?? '0' }}</span>
            </span>
                                </div>
                                <h4 class="project-preview-contents-title mt-3"> {{ $project->title }} </h4>
                                <p class="project-preview-contents-para"> {!! $project->description !!} </p>
                            </div>
                        </div>
                        <div class="project-preview">
                            <div class="myJob-wrapper-single-flex flex-between align-items-center">
                                <div class="myJob-wrapper-single-contents">
                                    <div class="jobFilter-proposal-author-flex">
                                        <div class="jobFilter-proposal-author-thumb">
                                            @if($user->image)
                                                @if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi']))
                                                    <img src="{{ render_frontend_cloud_image_if_module_exists( 'profile/'. $user->image, load_from: $user->load_from ?? '') }}" alt="{{ __('profile img') }}">
                                                @else
                                                    <img src="{{ asset('assets/uploads/profile/' . $user->image) }}" alt="{{ $user->first_name }}">
                                                @endif
                                            @else
                                                <img src="{{ asset('assets/static/img/author/author.jpg') }}" alt="{{ __('AuthorImg') }}">
                                            @endif
                                        </div>
                                        <div class="jobFilter-proposal-author-contents">
                                            <h4 class="jobFilter-proposal-author-contents-title"> {{ $user->first_name }}
                                                {{ $user->last_name }}</h4>
                                            <p class="jobFilter-proposal-author-contents-subtitle mt-2">
                                                @if($user->user_introduction?->title)
                                                    {{ $user->user_introduction?->title }} ·
                                                @endif
                                                <span>
                                                    @if($user->user_state?->state)
                                                        {{ $user->user_state?->state }},
                                                    @endif
                                                    @if($user->user_country?->country)
                                                        {{ $user->user_country?->country }}
                                                    @endif
                                                </span>
                                            </p>

                                            <div class="jobFilter-proposal-author-contents-review mt-2">
                                                {!! freelancer_rating($user->id) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (!empty($project->standard_title) && !empty($project->premium_title))
                            <div class="project-preview" id="comparePackage">
                                <div class="project-preview-head profile-border-bottom">
                                    <h4 class="project-preview-head-title"> {{ __('Compare Packages') }} </h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="comparison-table compare-package-table w-100">
                                        <thead class="pricing-wrapper-card text-center">
                                            <tr class="pricing-wrapper-card-top">
                                                <th class="text-center">
                                                    <h2 class="pricing-wrapper-card-top-prices">
                                                    {{ __('Packages') }}
                                                    </h2>
                                                </th>
                                                <th class="text-center">
                                                    
                                                    <h2 class="pricing-wrapper-card-top-prices">
                                                        {{ __('Basic') }}
                                                    </h2>
                                                </th>
                                                @if (!empty($project->standard_title))
                                                    <th class="text-center">
                                                        <h2 class="pricing-wrapper-card-top-prices">
                                                            {{ __('Standard') }}
                                                        </h2>
                                                        </th>
                                                @endif
                                                @if (!empty($project->premium_title))
                                                    <th class="text-center">
                                                        <h2 class="pricing-wrapper-card-top-prices">
                                                        {{ __('Premium') }}
                                                        </h2>
                                                    </th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody class="pricing-wrapper-card-bottom-list">
                                            <tr>
                                                <td class="text-center">{{ __('Revisions') }}</td>
                                                @foreach (['basic', 'standard', 'premium'] as $type)
                                                    <td class="text-center">
                                                        <span
                                                            class="close-icon">{{ $project->{"{$type}_revision"} }}</span>
                                                    </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td class="text-center">{{ __('Delivery Time') }}</td>
                                                @foreach (['basic', 'standard', 'premium'] as $type)
                                                    <td class="text-center">
                                                        <span class="close-icon">
                                                            {{ $project->{"{$type}_delivery"} }}
                                                        </span>
                                                    </td>
                                                @endforeach
                                            </tr>
                                            @foreach ($project->project_attributes as $attr)
                                                <tr>
                                                    <td class="text-center">
                                                        {{ $attr->check_numeric_title }}
                                                    </td>
                                                    @foreach (['basic', 'standard', 'premium'] as $type)
                                                        @php
                                                            $value = $attr->{"{$type}_check_numeric"};
                                                        @endphp
                                                        <td class="text-center">
                                                            {!! in_array($value, ['on', true], true)
                                                                ? '<span class="check-icon"> <i class="fas fa-check"></i>
                                                                </span>'
                                                                : (in_array($value, ['off', false], true)
                                                                    ? '<span class="close-icon"> <i class="fas fa-times"></i>
                                                                </span>'
                                                                    : '<span>' . $value . '</span>') !!}
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                            
                                            <tr class="total">
                                                <td class="text-center">
                                                    <span class="deep_black_text md-font fw_semibold">
                                                        <h2 class="pricing-wrapper-card-top-prices">
                                                            {{ __('Price') }}
                                                        </h2>
                                                    </span>
                                                </td>
                                                @foreach (['basic', 'standard', 'premium'] as $type)
                                                    <td class="text-center">
                                                        <div class="price">
                                                            @if ($project->{"{$type}_discount_charge"} && $project->{"{$type}_discount_charge"} > 0 && $project->{"{$type}_discount_charge"} < $project->{"{$type}_regular_charge"})
                                                                <h6 class="price-main">
                                                                    {{ float_amount_with_currency_symbol($project->{"{$type}_discount_charge"}) }}
                                                                </h6>
                                                                <s class="price-old">
                                                                    {{ float_amount_with_currency_symbol($project->{"{$type}_regular_charge"}) }}
                                                                </s>
                                                            @else
                                                                <h6 class="price-main">
                                                                    {{ float_amount_with_currency_symbol($project->{"{$type}_regular_charge"}) }}
                                                                </h6>
                                                            @endif
                                                        </div>
                                                    </td>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif

                    </div>

                    <div class="col-xl-5 col-lg-8">
                        <div class="sticky-sidebar">
                            <div class="project-preview">
                                <div class="project-preview-tab">
                                    <ul class="tabs dashboard-tabs">
                                        <li data-tab="basic" class="active">{{ __($project->basic_title) }}</li>
                                        <li data-tab="standard">{{ __($project->standard_title) }}</li>
                                        <li data-tab="premium">{{ __($project->premium_title) }}</li>
                                    </ul>
                                    <div class="project-preview-tab-contents mt-4">

                                        <div class="tab-content-item dashboard-tab-content-item active" id="basic">
                                            <div class="project-preview-tab-header">
                                                <div class="project-preview-tab-header-item">
                                                    <span class="left"><i class="fa-solid fa-repeat"></i>
                                                        {{ __('Revisions') }}</span>
                                                    <strong class="right">{{ $project->basic_revision }}</strong>
                                                </div>
                                                <div class="project-preview-tab-header-item">
                                                    <span class="left"><i class="fa-regular fa-clock"></i>
                                                        {{ __('Delivery time') }}</span>
                                                    <strong class="right">{{ $project->basic_delivery }} </strong>
                                                </div>
                                            </div>
                                            <div class="project-preview-tab-inner mt-4">
                                                @foreach ($project->project_attributes as $attr)
                                                    @if(empty($attr->basic_extra_price) || $attr->basic_extra_price == 0)
                                                        <div class="project-preview-tab-inner-item">
                                                            <span class="left">{{ $attr->check_numeric_title }}</span>
                                                            @if ($attr->basic_check_numeric == 'on')
                                                                <span class="check-icon"> <i class="fas fa-check"></i> </span>
                                                            @elseif ($attr->basic_check_numeric == 'off')
                                                                <span class="close-icon"> <i class="fas fa-times"></i> </span>
                                                            @else
                                                                <span class="right">{{ $attr->basic_check_numeric }}</span>
                                                            @endif
                                                        </div>
                                                    @endif
                                                @endforeach

                                                {{-- Extra Services (Basic) --}}
                                                @php
                                                    $basicExtras = $project->project_attributes->filter(fn($attr) => $attr->basic_extra_price > 0);
                                                @endphp

                                                @if($basicExtras->count())
                                                    <div class="project-preview-tab-inner-item">
                                                        <span class="left price-title">{{ __('Extra Service') }}</span>
                                                    </div>
                                                    @foreach ($basicExtras as $attr)
                                                        <div class="project-preview-tab-inner-item d-flex justify-content-between align-items-center">
                                                            <label class="extra-service m-0 left">
                                                                <input type="checkbox" class="basic-extra-checkbox"
                                                                    data-price="{{ $attr->basic_extra_price }}"
                                                                    name="extras[{{ $attr->id }}]">
                                                                {{ $attr->check_numeric_title }}
                                                            </label>
                                                            <span class="right price">+{{ float_amount_with_currency_symbol($attr->basic_extra_price) }}</span>
                                                        </div>
                                                    @endforeach
                                                @endif

                                                <div class="project-preview-tab-inner-item">
                                                    @if ($project->basic_discount_charge != null && $project->basic_discount_charge > 0)
                                                        <span class="left price-title">{{ __('Price') }}</span>
                                                        <span class="right price">
                                                            <s>{{ float_amount_with_currency_symbol($project->basic_regular_charge ?? '') }}</s><span>{{ float_amount_with_currency_symbol($project->basic_discount_charge) }}</span></span>
                                                    @else
                                                        <span class="left price-title">{{ __('Price') }}</span>
                                                        <span
                                                            class="right price"><span>{{ float_amount_with_currency_symbol($project->basic_regular_charge ?? '') }}</span></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-content-item dashboard-tab-content-item" id="standard">
                                            <div class="project-preview-tab-header">
                                                <div class="project-preview-tab-header-item">
                                                    <span class="left"><i class="fa-solid fa-repeat"></i>
                                                        {{ __('Revisions') }}</span>
                                                    <strong class="right">{{ $project->basic_revision }}</strong>
                                                </div>
                                                <div class="project-preview-tab-header-item">
                                                    <span class="left"><i class="fa-regular fa-clock"></i>
                                                        {{ __('Delivery time') }}</span>
                                                    <strong class="right">{{ $project->basic_delivery }}</strong>
                                                </div>
                                            </div>
                                            <div class="project-preview-tab-inner mt-4">
                                                @foreach ($project->project_attributes as $attr)
                                                    @if(empty($attr->standard_extra_price) || $attr->standard_extra_price == 0)
                                                        <div class="project-preview-tab-inner-item">
                                                            <span class="left">{{ $attr->check_numeric_title }}</span>
                                                            @if ($attr->standard_check_numeric == 'on')
                                                                <span class="check-icon"> <i class="fas fa-check"></i> </span>
                                                            @elseif($attr->standard_check_numeric == 'off')
                                                                <span class="close-close"> <i class="fas fa-times"></i>
                                                                </span>
                                                            @else
                                                                <span class="right"> {{ $attr->standard_check_numeric }}
                                                                </span>
                                                            @endif
                                                        </div>
                                                    @endif
                                                @endforeach

                                                @php
                                                    $standardExtras = $project->project_attributes->filter(fn($attr) => $attr->standard_extra_price > 0);
                                                @endphp

                                                @if($standardExtras->count())
                                                    <div class="project-preview-tab-inner-item">
                                                        <span class="left price-title">{{ __('Extra Service') }}</span>
                                                    </div>
                                                    @foreach ($standardExtras as $attr)
                                                        <div class="project-preview-tab-inner-item d-flex justify-content-between align-items-center">
                                                            <label class="extra-service m-0">
                                                                <input type="checkbox" class="standard-extra-checkbox"
                                                                    data-price="{{ $attr->standard_extra_price }}"
                                                                    name="extras[{{ $attr->id }}]">
                                                                {{ $attr->check_numeric_title }}
                                                            </label>
                                                            <span class="right price">+{{ float_amount_with_currency_symbol($attr->standard_extra_price) }}</span>
                                                        </div>
                                                    @endforeach
                                                @endif


                                                <div class="project-preview-tab-inner-item">
                                                    @if ($project->standard_discount_charge != null && $project->standard_discount_charge > 0)
                                                        <span class="left price-title">{{ __('Price') }}</span>
                                                        <span class="right price">
                                                            <s>{{ float_amount_with_currency_symbol($project->standard_regular_charge ?? '') }}</s><span>{{ float_amount_with_currency_symbol($project->standard_discount_charge) }}</span></span>
                                                    @else
                                                        <span class="left price-title">{{ __('Price') }}</span>
                                                        <span
                                                            class="right price"><span>{{ float_amount_with_currency_symbol($project->standard_regular_charge ?? '') }}</span></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-content-item dashboard-tab-content-item" id="premium">
                                            <div class="project-preview-tab-header">
                                                <div class="project-preview-tab-header-item">
                                                    <span class="left"><i class="fa-solid fa-repeat"></i>
                                                        {{ __('Revisions') }}</span>
                                                    <strong class="right">{{ $project->premium_revision }}</strong>
                                                </div>
                                                <div class="project-preview-tab-header-item">
                                                    <span class="left"><i class="fa-regular fa-clock"></i>
                                                        {{ __('Delivery time') }}</span>
                                                    <strong class="right">{{ $project->premium_delivery }}</strong>
                                                </div>
                                            </div>
                                            <div class="project-preview-tab-inner mt-4">
                                                @foreach ($project->project_attributes as $attr)
                                                    @if(empty($attr->premium_extra_price) || $attr->premium_extra_price == 0)
                                                        <div class="project-preview-tab-inner-item">
                                                            <span class="left">{{ $attr->check_numeric_title }}</span>
                                                            @if ($attr->premium_check_numeric == 'on')
                                                                <span class="check-icon"> <i class="fas fa-check"></i> </span>
                                                            @elseif($attr->premium_check_numeric == 'off')
                                                                <span class="close-icon"> <i class="fas fa-times"></i> </span>
                                                            @else
                                                                <span class="right"> {{ $attr->premium_check_numeric }}
                                                                </span>
                                                            @endif
                                                        </div>
                                                    @endif
                                                @endforeach

                                                {{-- Extra Services (Premium) --}}
                                                @php
                                                    $premiumExtras = $project->project_attributes->filter(fn($attr) => $attr->premium_extra_price > 0);
                                                @endphp

                                                @if($premiumExtras->count())
                                                    <div class="project-preview-tab-inner-item">
                                                        <span class="left price-title">{{ __('Extra Service') }}</span>
                                                    </div>
                                                    @foreach ($premiumExtras as $attr)
                                                        <div class="project-preview-tab-inner-item d-flex justify-content-between align-items-center">
                                                            <label class="extra-service m-0">
                                                                <input type="checkbox" class="premium-extra-checkbox"
                                                                    data-price="{{ $attr->premium_extra_price }}"
                                                                    name="extras[{{ $attr->id }}]">
                                                                {{ $attr->check_numeric_title }}
                                                            </label>
                                                            <span class="right price">+{{ float_amount_with_currency_symbol($attr->premium_extra_price) }}</span>
                                                        </div>
                                                    @endforeach
                                                @endif

                                                <div class="project-preview-tab-inner-item">
                                                    @if ($project->premium_discount_charge != null && $project->premium_discount_charge > 0)
                                                        <span class="left price-title">{{ __('Price') }}</span>
                                                        <span class="right price">
                                                            <s>{{ float_amount_with_currency_symbol($project->premium_regular_charge ?? '') }}</s><span>{{ float_amount_with_currency_symbol($project->premium_discount_charge) }}</span></span>
                                                    @else
                                                        <span class="left price-title">{{ __('Price') }}</span>
                                                        <span
                                                            class="right price"><span>{{ float_amount_with_currency_symbol($project->premium_regular_charge ?? '') }}</span></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <hr class="mt-5">
                                        <div class="btn-wrapper flex-btn justify-content-between">
                                            @can('project-reject')
                                                <a href="#" class="btn-profile btn-outline-gray btn-hover-danger" data-bs-target="#rejectProjectModal" data-bs-toggle="modal">{{ __('Click to Reject') }}</a>
                                            @endcan
                                            @can('project-status-change')
                                                @if ($project->status === 0 || $project->status === 2)
                                                    <x-status.table.status-change :title="__('Click to Active')" :class="'btn-profile btn-bg-1 swal_status_change_button'"
                                                                                  :url="route('admin.project.status.change', $project->id)" />
                                                @else
                                                    <x-status.table.status-change :title="__('Click to Inactive')" :class="'btn-profile btn-bg-1 swal_status_change_button'"
                                                                                  :url="route('admin.project.status.change', $project->id)" />
                                                @endif
                                            @endcan
                                            <div class="mt-3">
                                                <x-notice.general-notice :description="__(
                                                    'Notice: Active means users will be able to see the project on the website.',
                                                )" :description1="__(
                                                    'Notice: Inactive means the project will be hidden from users.',
                                                )"
                                                                         :description2="__(
                                                        'Notice: Rejected means the project has issues and the user is requested to resolve these issues and resubmit the project.',
                                                    )" />
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.pages.project.project-reject')

@endsection

@section('script')
    <x-sweet-alert.sweet-alert2-js />
    <x-select2.select2-js />
    @include('backend.pages.project.project-js')
    {{-- TO: Simplified video handling for Bootstrap carousel --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Pause videos when carousel slides
            var projectCarousel = document.getElementById('projectMediaCarousel');
            if (projectCarousel) {
                projectCarousel.addEventListener('slide.bs.carousel', function (event) {
                    // Pause videos in the previous slide
                    var previousSlide = event.from;
                    var previousVideo = projectCarousel.querySelectorAll('.carousel-item')[previousSlide]?.querySelector('video');
                    if (previousVideo && !previousVideo.paused) {
                        previousVideo.pause();
                    }

                    // Pause videos in the next slide (in case auto-playing)
                    var nextSlide = event.to;
                    var nextVideo = projectCarousel.querySelectorAll('.carousel-item')[nextSlide]?.querySelector('video');
                    if (nextVideo && !nextVideo.paused) {
                        nextVideo.pause();
                    }
                });

                // Handle video play events
                projectCarousel.querySelectorAll('video').forEach(video => {
                    video.addEventListener('play', function() {
                        // Pause other videos in the carousel
                        projectCarousel.querySelectorAll('video').forEach(otherVideo => {
                            if (otherVideo !== video && !otherVideo.paused) {
                                otherVideo.pause();
                            }
                        });
                    });
                });
            }
        });
    </script>

    @section('style')
        <x-select2.select2-css />
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <style>
            /* Custom black arrows for Bootstrap carousel */
            .custom-carousel-prev,
            .custom-carousel-next {
                background-color: rgba(0, 0, 0, 0.8); /* Black with transparency */
                border-radius: 50%;
                width: 40px;
                height: 40px;
                background-size: 50% 50%;
                border: 2px solid white;
            }

            .custom-carousel-prev {
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffffff'%3e%3cpath d='M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z'/%3e%3c/svg%3e");
                margin-left: 15px;
            }

            .custom-carousel-next {
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffffff'%3e%3cpath d='M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
                margin-right: 15px;
            }

            .custom-carousel-prev:hover,
            .custom-carousel-next:hover {
                background-color: rgba(0, 0, 0, 1); /* Solid black on hover */
                border-color: #f8f9fa;
            }

            /* Custom indicator dots */
            .carousel-indicators button {
                background-color: #000; /* Black dots */
                opacity: 0.5;
                width: 10px;
                height: 10px;
                border-radius: 50%;
                margin: 0 5px;
            }

            .carousel-indicators button.active {
                background-color: #000; /* Active black dot */
                opacity: 1;
                width: 12px;
                height: 12px;
            }
        </style>
    @endsection

@endsection
