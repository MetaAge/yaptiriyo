@extends('backend.layout.master')
@section('title', __('User Subscriptions'))
@section('style')
    <x-select2.select2-css />
@endsection
@section('content')

    <div class="dashboard__body">
        <div class="row">
            <div class="col-lg-12">
                <x-notice.general-notice :description="__(
                    'Notice: A manual payment subscription can be used only when the payment status is complete and the status remains active.',
                )" :description1="__('Notice: You can search here by id, user id, purchase date and expire date.')" />
                <div class="customMarkup__single">
                    <div class="customMarkup__single__item">
                        <div class="customMarkup__single__item__flex">
                            <h4 class="customMarkup__single__title">{{ __('User Subscriptions') }}</h4>
                            <div class="d-flex align-items-center gap-2">
                                <x-search.search-in-table :placeholder="__('Search by ....')" :id="'string_search'" />
                                @can('user-subscription-assign')
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#assignSubscriptionModal">{{ __('Assign Subscription') }}</button>
                                @elsecan('user-subscription-list')
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#assignSubscriptionModal">{{ __('Assign Subscription') }}</button>
                                @endcan
                            </div>
                        </div>

                        <div class="userSubscription__list">
                            <input type="hidden" id="get_selected_value">
                            @can('user-active-subscription')
                                <button id="active_subscription" class="userSubscription__list__item" data-val="active-sub">
                                    {{ __('Active') }} {{ $active_subscription ?? 0 }}</button>
                            @endcan
                            @can('user-inactive-subscription')
                                <button id="inactive_subscription" class="userSubscription__list__item" data-val="inactive-sub">
                                    {{ __('Inactive') }} {{ $inactive_subscription ?? 0 }}</button>
                            @endcan
                            @can('user-manual-subscription')
                                <button id="manual_subscription" class="userSubscription__list__item" data-val="manual-sub">
                                    {{ __('Manual') }} {{ $manual_subscription ?? 0 }}</button>
                            @endcan
                        </div>
                        <div class="customMarkup__single__inner mt-4">
                            <!-- Table Start -->
                            <div class="custom_table style-04 search_result">
                                @include('subscription::backend.user-subscription.search-result')
                            </div>
                            <!-- Table End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('subscription::backend.user-subscription.manual-payment-modal')
    
    <div class="modal fade" id="assignSubscriptionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Assign Subscription to User') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.user.subscription.assign') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="user_id">{{ __('Select User') }}</label>
                            <select name="user_id" id="user_id" class="form-control select2">
                                <option value="">{{ __('Select User') }}</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }} ({{ $user->username }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="subscription_id">{{ __('Select Subscription Plan') }}</label>
                            <select name="subscription_id" id="subscription_id" class="form-control select2">
                                <option value="">{{ __('Select Plan') }}</option>
                                @foreach($subscriptions as $subscription)
                                    <option value="{{ $subscription->id }}">{{ $subscription->title }} ({{ float_amount_with_currency_symbol($subscription->price) }}) - {{ $subscription->subscription_type->type ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Assign Now') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-media.markup />

@endsection

@section('script')
    <x-sweet-alert.sweet-alert2-js />
    <x-select2.select2-js />
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){
                $('.select2').select2({
                    dropdownParent: $('#assignSubscriptionModal')
                });
            });
        })(jQuery);
    </script>
    @include('subscription::backend.user-subscription.subscription-js')
@endsection

