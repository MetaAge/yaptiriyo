@extends('frontend.layout.master')
@section('site_title', __('Reply to Review'))
@section('content')
    <main>
        <x-frontend.category.category />
        <x-breadcrumb.user-profile-breadcrumb :title="__('Reply to Review')" :innerTitle="__('Reply to Review')"/>

        <!-- End Contract area Starts -->
        <div class="end-contract-area pat-100 pab-100 section-bg-2">
            <div class="container">
                <form action="{{ route('freelancer.order.rating',$id) }}" method="post">
                    @csrf
                    <div class="row gy-4 justify-content-center">
                        <div class="col-lg-8">
                            <div class="end-contract">

                                <!-- Client's Review Display -->
                                <div class="end-contract-single mb-5">
                                    <div class="card">
                                        <div class="card-header bg-light">
                                            <h5 class="mb-0">{{ __('Client Review') }}</h5>
                                        </div>
                                        <div class="card-body">
                                            @if($client_rating)
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="me-3">
                                                        @if($find_login_user_order?->user?->image)
                                                            <img src="{{ asset('assets/uploads/profile/'.$find_login_user_order?->user?->image) }}"
                                                                 alt="{{ $find_login_user_order?->user?->first_name }}"
                                                                 style="width: 50px; height: 50px; border-radius: 50%;">
                                                        @else
                                                            <img src="{{ asset('assets/static/img/author/author.jpg') }}"
                                                                 alt="{{ __('author') }}"
                                                                 style="width: 50px; height: 50px; border-radius: 50%;">
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-1">{{ $find_login_user_order?->user?->first_name }} {{ $find_login_user_order?->user?->last_name }}</h6>
                                                        <div class="rating_profile_details d-flex align-items-center">
                                                            <div class="rating_profile_details_icon me-2">
                                                                <i data-star="{{ $client_rating->rating }}"></i>
                                                            </div>
                                                            <span class="rating_profile_details-para">{{ $client_rating->rating }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="ms-auto text-muted small">
                                                        {{ $client_rating->created_at->toFormattedDateString() ?? '' }}
                                                    </div>
                                                </div>
                                                <p class="mb-0">{{ $client_rating->review_feedback }}</p>
                                            @else
                                                <p class="text-muted mb-0">{{ __('Client has not submitted a review yet.') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Freelancer's Reply Section -->
                                @if(!$freelancer_reply)
                                    <div class="end-contract-single">
                                        <div class="end-contract-single-select">
                                            <label class="label-title">{{ __('Your Reply to Client Review') }}</label>
                                            <textarea name="review_feedback" id="review_feedback" class="form-control" rows="5"
                                                      placeholder="{{ __('Type your reply to the client review here...') }}"></textarea>
                                            @error('review_feedback')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @else
                                    <!-- Show existing reply -->
                                    <div class="end-contract-single">
                                        <div class="card border-success">
                                            <div class="card-header bg-success text-white">
                                                <h5 class="mb-0">{{ __('Your Reply') }}</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="me-3">
                                                        @if(auth()->user()->image)
                                                            <img src="{{ asset('assets/uploads/profile/'.auth()->user()->image) }}"
                                                                 alt="{{ auth()->user()->first_name }}"
                                                                 style="width: 50px; height: 50px; border-radius: 50%;">
                                                        @else
                                                            <img src="{{ asset('assets/static/img/author/author.jpg') }}"
                                                                 alt="{{ __('author') }}"
                                                                 style="width: 50px; height: 50px; border-radius: 50%;">
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-1">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h6>
                                                        <small class="text-muted">{{ __('Your reply') }}</small>
                                                    </div>
                                                    <div class="ms-auto text-muted small">
                                                        {{ $freelancer_reply->created_at->toFormattedDateString() ?? '' }}
                                                    </div>
                                                </div>
                                                <p class="mb-0">{{ $freelancer_reply->review_feedback }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="end-contract-widget sticky_top_lg">
                                <div class="end-contract-widget-item">
                                    <ul class="end-contract-widget-list">
                                    </ul>
                                    <div class="end-contract-widget-item-footer profile-border-top">
                                        <div class="btn-wrapper mt-4">
                                            @if(!$freelancer_reply)
                                                <button type="submit" class="btn-profile btn-bg-1 w-100">
                                                    {{ __('Submit Reply') }}
                                                </button>
                                            @else
                                                <button type="button" class="btn-profile btn-success w-100" disabled>
                                                    {{ __('Already Replied') }}
                                                </button>
                                            @endif
                                        </div>
                                        <div class="mt-3">
                                            <a href="{{ route('freelancer.order.all') }}" class="btn-profile btn-outline-gray w-100">
                                                {{ __('Back to Orders') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Contract area end -->
    </main>

@endsection

@section('script')
    <!-- Remove old rating JS if not needed -->
    <script>
        // Simple validation for reply form
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            if(form) {
                form.addEventListener('submit', function(e) {
                    const textarea = document.getElementById('review_feedback');
                    if(textarea && textarea.value.trim().length === 0) {
                        e.preventDefault();
                        alert('{{ __("Please write your reply before submitting.") }}');
                        textarea.focus();
                    }
                });
            }
        });
    </script>
@endsection