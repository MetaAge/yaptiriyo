@foreach ($subscriptions as $subscription)
    <!-- Plan Card -->
    <div class="card-animate bg-white rounded-2xl border-2 border-gray-200 p-6 hover:border-orange-500 hover:shadow-lg hover:shadow-orange-100 transition-all duration-300 group">
        <!-- Plan Header -->
        <div class="mb-6">
            <h3 class="text-2xl font-medium text-base-300 mb-3">{{ $subscription->title ?? '' }}</h3>
            <div class="flex items-baseline mb-4">
                <span class="text-4xl font-semibold text-base-300">{{ float_amount_with_currency_symbol($subscription->price ?? '') }}</span>
                <span class="text-gray-500 ml-2">/{{ ucfirst($subscription->subscription_type?->type ?? 'month') }}</span>
            </div>
            <p class="text-gray-600 leading-relaxed">
                {{ $subscription->limit ?? '' }} {{ __('Connects') }}
            </p>
        </div>

        <!-- CTA Button -->
        <a href="{{ route('subscriptions.checkout', $subscription->id) }}"
           class="choose_plan w-full bg-primary hover:bg-secondary text-white font-medium py-2 px-6 rounded-xl transition-colors duration-500 mb-6 flex items-center justify-center text-center">
            {{ $subscription->price <= 0 ? __('Get Started') : __('Buy Now') }}
            <i class="fas fa-arrow-right ml-2"></i>
        </a>

        <!-- Features -->
        <div class="space-y-4">
            <h4 class="font-semibold text-base-300">{{ __('Marketplace Plan include') }}:</h4>
            <ul class="space-y-2">
                @foreach ($subscription->features as $feature)
                    <li class="flex items-start">
                        <div class="flex-shrink-0 flex items-center justify-center mt-0.5 mr-2">
                            @if ($feature->status == 'on')
                                <img src="{{ asset('assets/frontend/new_design/assets/images/checkmark.svg') }}" alt="">
                            @else
                                <img src="{{ asset('assets/frontend/new_design/assets/images/crossmark.svg') }}" alt="">
                            @endif
                        </div>
                        <span class="text-gray-600">{{ $feature->feature ?? '' }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endforeach

@if (empty($type_id))
    {!! $subscriptions->links() !!}
@endif