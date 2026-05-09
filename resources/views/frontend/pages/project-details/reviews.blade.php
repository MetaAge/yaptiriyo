{{-- frontend/pages/project-details/reviews.blade.php --}}
@foreach($project_complete_orders as $order)
    @php
        $rating = \App\Models\Rating::with('order')->where('order_id', $order->id)->where('sender_type', 1)->first();
    @endphp

    @if($rating)
        @php
            $fullname = $rating->order?->user?->fullname;
        @endphp

        <div class="rounded-2xl border border-[#C4C8CE] p-4 review-item">
            <!-- Top Section -->
            <div class="flex items-center gap-3 border-b pb-4">
                @if($rating->order?->user?->image)
                    <img src="{{ asset('assets/uploads/profile/'.$rating->order?->user?->image) }}"
                         alt="{{ $fullname }}"
                         class="w-12 h-12 rounded-full object-cover">
                @else
                    <img src="{{ asset('assets/static/img/author/author.jpg') }}"
                         alt="{{ __('author') }}"
                         class="w-12 h-12 rounded-full object-cover">
                @endif
                <div>
                    <h3 class="text-base font-medium text-base-300">{{ $fullname }}</h3>
                    <p class="text-sm text-gray-600">
                        @if($rating->order?->user?->user_state?->state)
                            {{ $rating->order?->user?->user_state?->state }},
                        @endif
                        {{ $rating->order?->user?->user_country?->country }}
                    </p>
                </div>
            </div>

            <!-- Bottom section -->
            <div class="mt-2">
                <!-- Rating and time section -->
                <div class="flex items-center gap-2">
                    <div class="flex star-rating">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $rating->rating)
                                <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                            @else
                                <i class="icon-base ti tabler-star icon-16px text-amber-400"></i>
                            @endif
                        @endfor
                    </div>
                    <span class="text-2xl text-base-400">•</span>
                    <span class="text-sm text-base-400">{{ $rating->created_at->diffForHumans() }}</span>
                </div>

                <p class="text-sm text-base-400 leading-relaxed mt-2">
                    {{ $rating->review_feedback }}
                </p>
            </div>
        </div>
    @endif
@endforeach

@if($project_complete_orders->hasMorePages())
    <div class="pagination hidden">{{-- Hidden pagination for JavaScript detection --}}</div>
@endif
