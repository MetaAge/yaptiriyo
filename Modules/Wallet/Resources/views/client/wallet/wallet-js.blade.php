<script>
    (function($) {
        "use strict";
        $(document).ready(function() {
            let site_default_currency_symbol = '{{ site_currency_symbol() }}';
            //update profile
            $(document).on('click', '.deposit_amount_to_wallet', function(e) {
                e.preventDefault(); // Prevent form submission until validation passes

                @if (moduleExists('CurrencySwitcher'))
                    @php
                        $get_user_currency = \Modules\CurrencySwitcher\App\Models\SelectedCurrencyList::where('currency', get_currency_according_to_user())->first() ?? null;
                    @endphp
                    let max_deposit_amount =
                        "{{ get_static_option('deposit_amount_limitation_for_user') * ($get_user_currency->conversion_rate ?? 1) }}";
                    let min_deposit_amount =
                        "{{ get_static_option('minimum_deposit_amount') * ($get_user_currency->conversion_rate ?? 1) }}";
                    let amount_for_currency = parseFloat($('#amount').val());
                    let max_amount_for_currency = parseFloat(max_deposit_amount ?? 500);
                    let min_amount_for_currency = parseFloat(min_deposit_amount ?? 1);

                    if (!amount_for_currency || isNaN(amount_for_currency) || amount_for_currency <=
                        0) {
                        toastr_warning_js("{{ __('Please enter a valid deposit amount.') }}");
                        return false;
                    }
                    if (amount_for_currency < min_amount_for_currency) {
                        toastr_warning_js("{{ __('Deposit amount must be at least ') }}" +
                            min_amount_for_currency.toFixed(2) +
                            " {{ get_currency_according_to_user() ?? get_static_option('site_global_currency') }}."
                            );
                        return false;
                    }
                    if (amount_for_currency > max_amount_for_currency) {
                        toastr_warning_js(
                            "{{ __('Deposit amount must not exceed the maximum limit of ') }}" +
                            max_amount_for_currency.toFixed(2) +
                            " {{ get_currency_according_to_user() ?? get_static_option('site_global_currency') }}."
                            );
                        return false;
                    }
                @else
                    let amount = parseFloat($('#amount').val());
                    let max_amount = parseFloat(
                        "{{ get_static_option('deposit_amount_limitation_for_user') ?? '500' }}"
                        );
                    let min_amount = parseFloat(
                        "{{ get_static_option('minimum_deposit_amount') ?? '1' }}");

                    if (!amount || isNaN(amount) || amount <= 0) {
                        toastr_warning_js("{{ __('Please enter a valid deposit amount.') }}");
                        return false;
                    }
                    if (amount < min_amount) {
                        toastr_warning_js("{{ __('Deposit amount must be at least ') }}" +
                            min_amount.toFixed(2) +
                            " {{ get_static_option('site_global_currency') }}.");
                        return false;
                    }
                    if (amount > max_amount) {
                        toastr_warning_js(
                            "{{ __('Deposit amount must not exceed the maximum limit of ') }}" +
                            max_amount.toFixed(2) +
                            " {{ get_static_option('site_global_currency') }}.");
                        return false;
                    }
                @endif

                // If validation passes, allow form submission
                $(this).closest('form').submit();
            });

            // pagination
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                histories(page);
            });

            function histories(page) {
                $.ajax({
                    url: "{{ route('client.wallet.paginate.data') . '?page=' }}" + page,
                    success: function(res) {
                        $('.search_result').html(res);
                    }
                });
            }

            // search category
            $(document).on('keyup', '#string_search', function() {
                let string_search = $(this).val();
                $.ajax({
                    url: "{{ route('client.wallet.search') }}",
                    method: 'GET',
                    data: {
                        string_search: string_search
                    },
                    success: function(res) {
                        if (res.status == 'nothing') {
                            $('.search_result').html(
                                '<h3 class="text-center text-danger">' +
                                "{{ __('Nothing Found') }}" + '</h3>');
                        } else {
                            $('.search_result').html(res);
                        }
                    }
                });
            })


            // Filter by type
            $(document).on('change', '#wallet_filter', function() {
                let type = $(this).val();
                let string_search = $('#string_search').val();
                $.ajax({
                    url: "{{ route('client.wallet.filter') }}",
                    method: 'GET',
                    data: {
                        type: type,
                        string_search: string_search
                    },
                    success: function(res) {
                        if (res.status == 'nothing') {
                            $('.search_result').html(
                                '<h3 class="text-center text-danger">{{ __('Nothing Found') }}</h3>'
                                );
                        } else {
                            $('.search_result').html(res);
                        }
                    }
                });
            });

            // Download report
            $(document).on('click', '#download_report', function() {
                let type = $('#wallet_filter').val();
                window.location.href = "{{ route('client.wallet.download') }}" + "?type=" + type;
            });

            $(document).on('keyup change', '#amount', function() {
                let amount = parseFloat($(this).val()) || 0;

                let transaction_type = "{{ get_static_option('transaction_fee_type') ?? '' }}";
                let transaction_charge = parseFloat(
                    "{{ get_static_option('transaction_fee_charge') ?? 0 }}");

                if (transaction_charge > 0 && amount > 0) {
                    $('.show_hide_transaction_section').removeClass('d-none');

                    let fee = transaction_type === 'fixed' ?
                        transaction_charge :
                        (amount * transaction_charge / 100);

                    let total = amount + fee;

                    $('.currency_symbol').text(site_default_currency_symbol);

                    $('.transaction_fee_amount').text(fee.toFixed(2));
                    $('.transaction_total_amount').text(total.toFixed(2));
                } else {
                    $('.show_hide_transaction_section').addClass('d-none');
                }
            });
        });
    }(jQuery));
</script>
