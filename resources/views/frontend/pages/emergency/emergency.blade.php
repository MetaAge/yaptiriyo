@extends('frontend.new_design.layout.new_master')

@section('page-meta-data')
    <title>{{ __('Acil Usta Çağır') }} | {{ get_static_option('site_title', 'Yaptiriyo') }}</title>
    <meta name="description" content="{{ __('Acil işlerin için SOS talebi oluştur — 30 dakikada yakınındaki uygun ustalardan teklif al.') }}">
@endsection

@section('content')
<main class="pt-24 pb-16 min-h-screen bg-gray-50">
    <div class="max-w-3xl mx-auto px-4 md:px-6">

        <div class="text-center mb-8">
            <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-red-500 text-white flex items-center justify-center text-2xl shadow-lg shadow-red-500/30">
                <i class="fa-solid fa-bolt"></i>
            </div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900">{{ __('Acil Usta Çağır') }}</h1>
            <p class="text-gray-500 mt-2">{{ __('Talebini oluştur, yakınındaki uygun ustalar 30 dakika içinde teklif versin.') }}</p>
        </div>

        {{-- FORM --}}
        <div id="sosFormCard" class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 md:p-8">
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Kategori') }} <span class="text-red-500">*</span></label>
                <select id="sosCategory" class="w-full border border-gray-200 rounded-xl p-3 text-sm outline-none focus:border-primary bg-white">
                    <option value="">{{ __('Kategori seçin...') }}</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->category }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Sorununu anlat') }} <span class="text-red-500">*</span></label>
                <textarea id="sosDescription" rows="4"
                          class="w-full border border-gray-200 rounded-xl p-3 text-sm outline-none focus:border-primary resize-none"
                          placeholder="{{ __('Örn: Mutfak lavabosu tıkandı, su taşıyor. Acil müdahale gerekiyor.') }}"></textarea>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Adres') }}</label>
                <input type="text" id="sosAddress"
                       class="w-full border border-gray-200 rounded-xl p-3 text-sm outline-none focus:border-primary"
                       placeholder="{{ __('Mahalle, cadde, bina no...') }}">
            </div>
            <button type="button" id="sosCreateBtn"
                    class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-4 rounded-2xl transition shadow-lg shadow-red-500/25">
                <i class="fa-solid fa-bolt mr-1"></i> {{ __('Acil Talep Oluştur') }}
            </button>
            <p id="sosFormError" class="hidden text-sm text-red-600 text-center mt-3"></p>
        </div>

        {{-- AKTİF TALEP / TEKLİFLER --}}
        <div id="sosActiveCard" class="hidden bg-white rounded-3xl border border-gray-100 shadow-sm p-6 md:p-8">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-lg font-bold text-gray-900" id="sosActiveTitle">{{ __('Usta Aranıyor...') }}</h2>
                    <p class="text-sm text-gray-500" id="sosActiveSubtitle">{{ __('Yakındaki ustalar bilgilendirildi, teklifler burada görünecek.') }}</p>
                </div>
                <span id="sosStatusBadge" class="text-xs font-bold px-3 py-1.5 rounded-full bg-amber-50 text-amber-600">{{ __('Bekliyor') }}</span>
            </div>

            <div id="sosSpinner" class="flex justify-center py-6">
                <div class="w-10 h-10 border-4 border-red-200 border-t-red-500 rounded-full animate-spin"></div>
            </div>

            <div id="sosOffers" class="space-y-3"></div>

            <div id="sosAcceptedBox" class="hidden text-center py-4">
                <div class="w-14 h-14 mx-auto mb-3 rounded-full bg-green-500 text-white flex items-center justify-center text-xl">
                    <i class="fa-solid fa-check"></i>
                </div>
                <h3 class="font-bold text-gray-900 mb-1">{{ __('Usta Bulundu!') }}</h3>
                <p class="text-sm text-gray-500 mb-1" id="sosAcceptedName"></p>
                <p class="text-primary font-bold" id="sosAcceptedPrice"></p>
                <p class="text-xs text-gray-400 mt-2">{{ __('Ödeme ve sipariş adımları için mobil uygulamayı kullanabilir veya ustayla mesajlaşabilirsiniz.') }}</p>
            </div>

            <button type="button" id="sosCancelBtn"
                    class="w-full mt-6 border border-red-200 text-red-500 font-semibold py-3 rounded-2xl hover:bg-red-50 transition">
                {{ __('Talebi İptal Et') }}
            </button>
        </div>

    </div>
</main>

<script>
(function () {
    const csrf = document.querySelector('meta[name=csrf-token]').content;
    const formCard = document.getElementById('sosFormCard');
    const activeCard = document.getElementById('sosActiveCard');
    const offersEl = document.getElementById('sosOffers');
    const spinner = document.getElementById('sosSpinner');
    const acceptedBox = document.getElementById('sosAcceptedBox');
    const statusBadge = document.getElementById('sosStatusBadge');
    let activeId = null;
    let pollTimer = null;

    async function api(url, method = 'GET', body = null) {
        const res = await fetch(url, {
            method,
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf,
            },
            body: body ? JSON.stringify(body) : null,
        });
        return res.json().then(data => ({ ok: res.ok, data }));
    }

    function showActive(e) {
        formCard.classList.add('hidden');
        activeCard.classList.remove('hidden');
        activeId = e.id;

        const offers = e.offers || [];
        if (e.status === 'accepted') {
            spinner.classList.add('hidden');
            offersEl.innerHTML = '';
            acceptedBox.classList.remove('hidden');
            statusBadge.textContent = @json(__('Kabul Edildi'));
            statusBadge.className = 'text-xs font-bold px-3 py-1.5 rounded-full bg-green-50 text-green-600';
            document.getElementById('sosActiveTitle').textContent = @json(__('Usta Bulundu!'));
            document.getElementById('sosActiveSubtitle').textContent = @json(__('Talebiniz kabul edildi.'));
            document.getElementById('sosAcceptedName').textContent = e.freelancer_name || '';
            document.getElementById('sosAcceptedPrice').textContent = e.offered_price
                ? @json(__('Teklif:')) + ' ' + Number(e.offered_price).toLocaleString('tr-TR') + ' ₺' : '';
            clearInterval(pollTimer);
            return;
        }

        if (offers.length > 0) {
            spinner.classList.add('hidden');
            offersEl.innerHTML = offers.map(o => `
                <div class="flex items-center justify-between border border-gray-100 rounded-2xl p-4">
                    <div>
                        <div class="font-semibold text-gray-900 text-sm">${o.freelancer_name || @json(__('Usta'))}</div>
                        <div class="text-primary font-bold">${Number(o.offered_price).toLocaleString('tr-TR')} ₺</div>
                    </div>
                    <button data-offer="${o.id}"
                            class="sos-select-btn bg-primary text-white text-sm font-bold px-5 py-2.5 rounded-xl hover:opacity-90 transition">
                        ${@json(__('Seç'))}
                    </button>
                </div>`).join('');
            offersEl.querySelectorAll('.sos-select-btn').forEach(btn => {
                btn.addEventListener('click', async function () {
                    this.disabled = true;
                    const r = await api(@json(url('acil-talep/teklif-sec')) + '/' + activeId, 'POST', { offer_id: Number(this.dataset.offer) });
                    if (!r.ok) { alert(r.data.msg || @json(__('İşlem başarısız'))); this.disabled = false; return; }
                    refresh();
                });
            });
        } else {
            spinner.classList.remove('hidden');
            offersEl.innerHTML = '';
        }
    }

    async function refresh() {
        const r = await api(@json(route('web.emergency.active')));
        const e = r.data.emergency ?? r.data;
        if (r.ok && e && e.id && ['pending', 'accepted'].includes(e.status)) {
            showActive(e);
        } else {
            clearInterval(pollTimer);
            formCard.classList.remove('hidden');
            activeCard.classList.add('hidden');
        }
    }

    document.getElementById('sosCreateBtn').addEventListener('click', async function () {
        const err = document.getElementById('sosFormError');
        err.classList.add('hidden');
        const category_id = document.getElementById('sosCategory').value;
        const description = document.getElementById('sosDescription').value.trim();
        if (!category_id || description.length < 5) {
            err.textContent = @json(__('Lütfen kategori seçin ve sorununuzu kısaca anlatın.'));
            err.classList.remove('hidden');
            return;
        }
        this.disabled = true;
        const r = await api(@json(route('web.emergency.create')), 'POST', {
            category_id: Number(category_id),
            description,
            address: document.getElementById('sosAddress').value.trim() || null,
        });
        this.disabled = false;
        if (!r.ok) {
            err.textContent = r.data.msg || r.data.message || @json(__('Talep oluşturulamadı.'));
            err.classList.remove('hidden');
            return;
        }
        refresh();
        pollTimer = setInterval(refresh, 6000);
    });

    document.getElementById('sosCancelBtn').addEventListener('click', async function () {
        if (!activeId || !confirm(@json(__('Talebi iptal etmek istediğinize emin misiniz?')))) return;
        const r = await api(@json(url('acil-talep/iptal')) + '/' + activeId, 'POST');
        if (!r.ok) { alert(r.data.msg || @json(__('İptal edilemedi (iş başlamış olabilir).'))); return; }
        clearInterval(pollTimer);
        location.reload();
    });

    // Sayfa açıldığında aktif talep varsa direkt durum ekranı.
    refresh().then(() => {
        if (activeId) pollTimer = setInterval(refresh, 6000);
    });
})();
</script>
@endsection
