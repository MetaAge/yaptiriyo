<aside class="lg:w-[416px] space-y-8 sticky top-[100px] h-fit">
    <!-- Contact Card -->
    <div class="border border-gray-200 rounded-2xl p-6 bg-white">
        <div class="flex items-center gap-4 mb-6">
            <div class="relative">
                @if($user->image)
                    @if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi']))
                        <img src="{{ render_frontend_cloud_image_if_module_exists( 'profile/'. $user->image, load_from: $user->load_from) }}" alt="{{ $user->first_name .' '.$user->last_name }}" class="w-12 h-12 rounded-full object-cover">
                    @else
                        <img src="{{ asset('assets/uploads/profile/'.$user->image) }}" alt="{{ $user->first_name .' '.$user->last_name }}" class="w-12 h-12 rounded-full object-cover">
                    @endif
                @else
                    <img src="{{ asset('assets/static/img/author/author.jpg') }}" alt="{{ __('AuthorImg') }}" class="w-12 h-12 rounded-full object-cover">
                @endif
                @if(Cache::has('user_is_online_' . $user->id))
                    <div class="absolute w-3 h-3 bg-primary border border-white rounded-full right-0 bottom-0"></div>
                @endif
            </div>
            <div>
                <h3 class="font-medium text-lg text-base-300">{{ $user->first_name .' '.$user->last_name }}</h3>
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    @if(Cache::has('user_is_online_' . $user->id))
                        <span class="flex items-center gap-1">
                            {{ __('Online') }}
                            <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                        </span>
                    @else
                        <span class="flex items-center gap-1">
                            <span class="w-1.5 h-1.5 bg-gray-400 rounded-full"></span>
                            {{ __('Inactive') }}
                        </span>
                    @endif

                    @if(!empty($user->user_state->timezone))
                        <span>
                            @php
                                date_default_timezone_set(optional($user->user_state)->timezone ?? '');
                            @endphp
                            {{ date('h:i A') }} {{ __('local time') }}
                        </span>
                    @endif
                </div>
            </div>
        </div>

        @if (Auth::guard('web')->check())
            @if (Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 1 && Auth::guard('web')->user()->id != $user->id && Session::get('user_role') != 'freelancer' && optional($record)->can_contact_freelancer == 1)
                <a href="{{ route('client.live.chat') }}?freelancer_id={{ $user->id }}"
                   id="contact-me-btn"
                   class="w-full bg-primary text-white font-medium py-3 rounded-lg hover:bg-primary/90 transition mb-4 flex items-center justify-center gap-2">
                    {{ __('Contact me') }} <i class="fa-solid fa-arrow-right -rotate-45"></i>
                </a>
            @elseif (Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 2 && Auth::guard('web')->user()->id != $user->id && Session::get('user_role') == 'client' && optional($record)->can_contact_freelancer == 1)
                <a href="{{ route('client.live.chat') }}?freelancer_id={{ $user->id }}"
                   id="contact-me-btn"
                   class="w-full bg-primary text-white font-medium py-3 rounded-lg hover:bg-primary/90 transition mb-4 flex items-center justify-center gap-2">
                    {{ __('Contact me') }} <i class="fa-solid fa-arrow-right -rotate-45"></i>
                </a>
            @endif
        @else
            @if(!empty($record->can_contact_freelancer) && optional($record)->can_contact_freelancer == 1 && optional($record)->show_contact_me_before_login == 1)
                <a href="javascript:void(0)"
                   class="w-full bg-primary text-white font-medium py-3 rounded-lg hover:bg-primary/90 transition mb-4 flex items-center justify-center gap-2 contact_warning_chat_message">
                    {{ __('Contact me') }} <i class="fa-solid fa-arrow-right -rotate-45"></i>
                </a>
            @endif
        @endif


        <div class="text-sm font-small text-base-400 mb-4">
            {{ __('Average response time: 1 hour') }}
        </div>

        @php
            // Structured plan gating (mobil API ile aynı kurallar):
            // whatsapp_button → WhatsApp, phone_call → arama, badge → rozet.
            $freelancer_gate = \Modules\Subscription\Services\PlanGate::for($user->id);
            $can_whatsapp = $freelancer_gate->can('whatsapp_button');
            $can_call = $freelancer_gate->can('phone_call');
            $usta_badge = $freelancer_gate->value('badge'); // trusted | pro | null
            $whatsapp_link = $user->phone ? "https://wa.me/" . preg_replace('/[^0-9]/', '', $user->phone) : null;
        @endphp

        @if($usta_badge === 'pro')
            <div class="inline-flex items-center gap-1.5 bg-indigo-50 text-indigo-700 text-xs font-bold px-3 py-1.5 rounded-full mb-3">
                <i class="fa-solid fa-bolt"></i> {{ __('Pro Usta') }}
            </div>
        @elseif($usta_badge === 'trusted')
            <div class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 text-xs font-bold px-3 py-1.5 rounded-full mb-3">
                <i class="fa-solid fa-shield-halved"></i> {{ __('Güvenilir Usta') }}
            </div>
        @endif

        @if($can_whatsapp && $whatsapp_link)
            <!-- WhatsApp Button -->
            <a href="{{ $whatsapp_link }}" target="_blank"
               class="w-full bg-[#25D366] text-white font-medium py-3 rounded-lg hover:bg-[#128C7E] transition mb-3 flex items-center justify-center gap-2">
                <i class="fa-brands fa-whatsapp text-xl font-bold"></i> {{ __('WhatsApp ile İletişime Geç') }}
            </a>
        @endif

        @if($can_call && $user->phone)
            <!-- Call Button -->
            <a href="tel:{{ $user->phone }}"
               class="w-full bg-secondary text-white font-medium py-3 rounded-lg hover:bg-secondary/90 transition mb-3 flex items-center justify-center gap-2">
                <i class="fa-solid fa-phone"></i> {{ __('Hemen Ara') }}
            </a>
        @endif

        @if(!$can_whatsapp && !$can_call)
            <!-- Locked State for Free Users -->
            <div class="w-full bg-gray-50 text-gray-500 font-medium py-4 rounded-xl mb-4 flex flex-col items-center justify-center gap-2 border border-dashed border-gray-300">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-lock text-gray-400 text-xs"></i>
                    </div>
                    <span class="text-sm font-semibold">{{ __('İletişim Bilgileri Gizli') }}</span>
                </div>
                <p class="text-[11px] text-gray-400 text-center px-4">{{ __('Bu usta ile direkt iletişim, ücretli paket kullanan ustalarda açıktır. Mesajlaşarak iletişime geçebilirsiniz.') }}</p>
            </div>
        @endif

        {{-- Şikâyet et / Engelle (UGC güvenliği) --}}
        @auth
            @if(auth()->id() !== $user->id)
                <div class="flex items-center justify-center gap-4 mt-1 mb-2">
                    <button type="button" onclick="yaptiriyoReport({{ $user->id }})"
                            class="text-xs text-gray-400 hover:text-red-500 transition">
                        <i class="fa-regular fa-flag mr-1"></i>{{ __('Şikâyet Et') }}
                    </button>
                    <button type="button" onclick="yaptiriyoBlock({{ $user->id }})"
                            class="text-xs text-gray-400 hover:text-red-500 transition">
                        <i class="fa-solid fa-ban mr-1"></i>{{ __('Engelle') }}
                    </button>
                </div>
                <script>
                    async function yaptiriyoModeration(url, body, confirmMsg) {
                        if (confirmMsg && !confirm(confirmMsg)) return;
                        const res = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                            },
                            body: JSON.stringify(body),
                        });
                        const data = await res.json();
                        alert(data.msg || (res.ok ? @json(__('İşlem tamamlandı.')) : @json(__('İşlem başarısız.'))));
                    }
                    function yaptiriyoReport(userId) {
                        const reason = prompt(@json(__('Şikâyet nedeninizi kısaca yazın:')));
                        if (!reason || !reason.trim()) return;
                        yaptiriyoModeration(@json(route('web.moderation.report')), {
                            reason: reason.trim().slice(0, 100),
                            reported_user_id: userId,
                            reportable_type: 'user',
                            reportable_id: userId,
                        });
                    }
                    function yaptiriyoBlock(userId) {
                        yaptiriyoModeration(@json(route('web.moderation.block')), { user_id: userId },
                            @json(__('Bu kullanıcıyı engellemek istediğinize emin misiniz? Engellenen kullanıcı sizinle mesajlaşamaz.')));
                    }
                </script>
            @endif
        @endauth
    </div>


    <!-- Info Card -->
    <div class="border border-gray-200 rounded-2xl p-6 bg-white">
        <div class="flex items-center gap-3 mb-4 pb-4 border-b border-gray-100">
            <i class="fa-regular fa-user text-base-300"></i>
            <span class="font-medium text-base-300">{{ __("Yaptiriyo'da") }}</span>
            @if($user->created_at)
                <span class="font-medium text-base-300">{{ $user->created_at->format('M Y') }}</span>
            @else
                <span class="text-gray-500">{{ __('N/A') }}</span>
            @endif
        </div>
        <div>
            <h4 class="font-medium text-base-300 mb-3">{{ __('Location') }}</h4>
            <div class="space-y-2">
                @if($user?->user_country?->country)
                    <div class="flex items-center gap-2 text-sm">
                        <span class="text-base-300">{{ optional($user->user_country)->country }}</span>
                        @if($user?->user_state?->state != null)
                            <span class="text-base-400">: {{ optional($user->user_state)->state }}</span>
                        @endif
                    </div>
                @else
                    <div class="text-sm text-gray-500">
                        {{ __('Location not specified') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if ($isOwnProfile)
        <!-- Simple Earnings Toggle -->
        @if(get_static_option('user_earning_toggle') == 'enable')
            <div class="border border-gray-200 rounded-2xl p-6 bg-white">
                <div class="flex items-center justify-between">
                    <span class="font-medium text-base-300">
                        {{ __('Show Earnings') }}
                    </span>
                    <label class="toggle-switch relative inline-block w-12 h-6 flex-shrink-0" role="switch" aria-checked="{{ optional($user->user_earning)->show_earning ? 'true' : 'false' }}">
                        <input type="checkbox" id="earningToggle" {{ optional($user->user_earning)->show_earning ? 'checked' : '' }} class="opacity-0 w-0 h-0">
                        <span class="toggle-slider absolute cursor-pointer top-0 left-0 right-0 bottom-0 bg-gray-300 transition rounded-full before:absolute before:content-[''] before:h-4 before:w-4 before:left-1 before:bottom-1 before:bg-white before:transition before:rounded-full"></span>
                    </label>
                </div>
            </div>
        @endif

        <!-- Simple Work Availability Toggle -->
        <div class="border border-gray-200 rounded-2xl p-6 bg-white">
            <div class="flex items-center justify-between">
                <span class="font-medium text-base-300">
                    {{ __('Available for Work') }}
                </span>
                <label class="toggle-switch relative inline-block w-12 h-6 flex-shrink-0" role="switch" aria-checked="{{ $user->check_work_availability ? 'true' : 'false' }}">
                    <input type="checkbox" id="workAvailabilityToggle" {{ $user->check_work_availability ? 'checked' : '' }} class="opacity-0 w-0 h-0">
                    <span class="toggle-slider absolute cursor-pointer top-0 left-0 right-0 bottom-0 bg-gray-300 transition rounded-full before:absolute before:content-[''] before:h-4 before:w-4 before:left-1 before:bottom-1 before:bg-white before:transition before:rounded-full"></span>
                </label>
            </div>
        </div>
    @endif
</aside>