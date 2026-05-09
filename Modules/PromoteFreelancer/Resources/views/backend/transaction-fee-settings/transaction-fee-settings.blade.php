@extends('backend.layout.master')
@section('title', __('Transaction Fee Settings'))
@section('style')
    <x-media.css />
@endsection
@section('content')
    <div class="dashboard__body">
        <x-validation.error />
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="customMarkup__single">
                    <div class="customMarkup__single__item">
                        <div class="customMarkup__single__item__flex">
                            <h4 class="customMarkup__single__title">{{ __('Transaction Fee Settings') }}</h4>
                        </div>

                        <div class="customMarkup__single__inner mt-4">
                            <x-notice.general-notice :class="'mt-5'" :description="__(
                                'Notice: Transaction fee means how much charge will user pay for each transaction. Generally no charge will be added if you set transaction charge 0.',
                            )" />
                            <form action="{{ route('admin.promote.transaction.fee.settings') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="single-input my-5">
                                    <label class="label-title">{{ __('Transaction Type') }}</label>
                                    <select name="promote_transaction_fee_type" class="form-control">
                                        <option value="" selected>{{ __('Select Type') }}</option>
                                        <option value="percentage" @if (get_static_option('promote_transaction_fee_type') == 'percentage') selected @endif>
                                            {{ __('Percentage') }}</option>
                                        <option value="fixed" @if (get_static_option('promote_transaction_fee_type') == 'fixed') selected @endif>
                                            {{ __('Fixed') }}</option>
                                    </select>
                                </div>
                                <x-form.number :title="__('Transaction Charge')" :min="'0.0'" :max="'500.0'" :step="'0.01'"
                                    :name="'promote_transaction_fee_charge'" :value="get_static_option('promote_transaction_fee_charge') ?? 0" :placeholder="__('Transaction Charge')" />
                                @can('transaction-fee-settings-update')
                                    <x-btn.submit :title="__('Update')" :class="'btn btn-primary mt-4 pr-4 pl-4'" />
                                @endcan
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="customMarkup__single">
                    <div class="customMarkup__single__item">
                        <div class="customMarkup__single__item__flex">
                            <h4 class="customMarkup__single__title">{{ __('Promoted Items Per Page Settings') }}</h4>
                        </div>

                        <div class="customMarkup__single__inner mt-4">
                            <x-notice.general-notice :class="'mt-5'" :description="__(
                                'Notice: Set how many promoted items to show per page. You can also control the ratio of promoted items per page.',
                            )" />

                            <form action="{{ route('admin.promote.projects.perpage.settings') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                {{-- Projects Per Page --}}
                                <x-form.number :title="__('Projects Per Page')" :min="'1'" :max="'100'" :step="'1'"
                                    :name="'projects_per_page'" :value="get_static_option('projects_per_page') ?? 12" :placeholder="__('Number of projects per page')" />

                                {{-- Pro Projects Ratio Switch --}}
                                <div class="switch mt-4">
                                    <label class="label-title mt-3"><strong>{{ __('Pro Projects Ratio') }}</strong></label>
                                    <input class="custom-switch" type="checkbox" id="pro_projects_default_first"
                                        name="pro_projects_default_first" @if (get_static_option('pro_projects_default_first', 0)) checked @endif>
                                    <label class="switch-label"
                                        for="pro_projects_default_first">{{ __('Show all pro projects first') }}</label>
                                    <small>{{ __('Toggle ON to set custom numbers for promoted and non-promoted items per page, or OFF to show all promoted items first by default.') }}</small>
                                </div>

                                {{-- Custom Ratio Inputs --}}
                                <div id="custom_ratio_inputs" class="mt-3">
                                    <x-form.number :title="__('Number of Pro Projects Per Page')" :min="'0'" :max="'100'"
                                        :step="'1'" :name="'pro_projects_count'" :value="get_static_option('pro_projects_count') ?? 5" :placeholder="__('Pro projects per page')" />

                                    <x-form.number :title="__('Number of Non-Pro Projects Per Page')" :min="'0'" :max="'100'"
                                        :step="'1'" :name="'non_pro_projects_count'" :value="get_static_option('non_pro_projects_count') ?? 5" :placeholder="__('Non-pro projects per page')" />
                                </div>

                                {{-- Promoted Badge Text Switch --}}
                                <div class="switch mt-4">
                                    <label
                                        class="label-title mt-3"><strong>{{ __('Promoted Badge Text') }}</strong></label>
                                    <input class="custom-switch" type="checkbox" id="promoted_badge_text_toggle"
                                        name="promoted_badge_text_toggle" @if (get_static_option('promoted_badge_text_toggle', 0)) checked @endif>
                                    <label class="switch-label"
                                        for="promoted_badge_text_toggle">{{ __('Enable Promoted Badge Text') }}</label>
                                    <small>{{ __('Toggle ON to show the input field for Promoted Badge Text, or OFF to leave it blank.') }}</small>
                                </div>

                                {{-- Promoted Badge Text Input --}}
                                <div id="promoted_badge_text_input" class="mt-3" style="display: none;">
                                    <x-form.text :title="__('Promoted Badge Text')" :name="'promoted_badge_text'" :value="get_static_option('promoted_badge_text')"
                                        :placeholder="__('Enter promoted badge text')" />
                                </div>
                                <x-form.text :title="__('Promoted User Profile Text')" :name="'promoted_user_profile_text'" :value="get_static_option('promoted_user_profile_text')" :placeholder="__('Enter promoted user profile text')" />

                                @can('projects-perpage-settings-update')
                                    <x-btn.submit :title="__('Update Settings')" :class="'btn btn-primary mt-4 pr-4 pl-4'" />
                                @endcan
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-media.markup />
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            if ($('#pro_projects_default_first').prop('checked')) {
                $('#custom_ratio_inputs').show();
            } else {
                $('#custom_ratio_inputs').hide();
            }

            // Toggle on change
            $('#pro_projects_default_first').on('change', function() {
                if ($(this).prop('checked')) {
                    $('#custom_ratio_inputs').show();
                } else {
                    $('#custom_ratio_inputs').hide();
                }
            });

            // Handle "Promoted Badge Text" toggle
            if ($('#promoted_badge_text_toggle').prop('checked')) {
                $('#promoted_badge_text_input').show();
            } else {
                $('#promoted_badge_text_input').hide();
            }

            $('#promoted_badge_text_toggle').on('change', function() {
                if ($(this).prop('checked')) {
                    $('#promoted_badge_text_input').show();
                } else {
                    $('#promoted_badge_text_input').hide();
                }
            });
        });
    </script>
@endsection
