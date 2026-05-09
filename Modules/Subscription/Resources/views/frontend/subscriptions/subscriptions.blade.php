@extends('frontend.new_design.layout.new_master')
@section('site_title', __('Subscriptions'))
@section('meta_title'){{ __('Subscriptions') }}@endsection
@section('style')
    <style>
        .modal {
            z-index: 100001;
        }

        .modal-backdrop {
            z-index: 10000;
        }
    </style>
@endsection
@section('content')
    <main>

       {{-- @if(moduleExists('CoinPaymentGateway'))@else<x-frontend.category.category/>@endif--}}
            <!-- Breadcrumb -->
            <x-breadcrumb.user-profile-breadcrumb-02 :innerTitle="__('Subscription')" />

        <!-- Subscription Plan -->
        <section id="subscription" class="bg-[#F8F9FD]">
            <div class="container mx-auto max-w-7xl px-6 py-10 md:py-16 lg:py-[120px] ">

                <!-- Section Heading with buttons -->
                <div class="text-center mb-16">
                    <h4 class="text-4xl text-base-300 font-medium text-center mb-6 animate-on-scroll">
                        {{ __('Subscription Plan') }}
                    </h4>

                    <div id="subscription_type_buttons">
                        <button data-type_id="all" class="get_subscription_type_id px-4 py-1 bg-secondary rounded-xl text-base-100 active">{{ __('All') }}</button>
                        @foreach ($subscription_types as $type)
                            <button data-type_id="{{ $type->id }}" class="get_subscription_type_id px-4 py-1 bg-base-100 rounded-xl hover:bg-secondary hover:text-white transition-all duration-300">{{ $type->type }}</button>
                        @endforeach
                    </div>
                </div>

                <!-- Section contents including subscription plan cards -->
                <div id="pricingCards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 search_subscription_result">
                    @include('subscription::frontend.subscriptions.search-result')
                </div>
            </div>

        </section>

    </main>

@endsection

@section('script')
    <x-frontend.payment-gateway.gateway-select-js />
    @include('subscription::frontend.subscriptions.subscriptions-js')
@endsection