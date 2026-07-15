<?php $__env->startSection('page-meta-data'); ?>
    <title><?php echo e(__('Acil Usta Çağır')); ?> | <?php echo e(get_static_option('site_title', 'Yaptiriyo')); ?></title>
    <meta name="description" content="<?php echo e(__('Acil işlerin için SOS talebi oluştur — 30 dakikada yakınındaki uygun ustalardan teklif al.')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<main class="pt-24 pb-16 min-h-screen bg-gray-50">
    <div class="max-w-3xl mx-auto px-4 md:px-6">

        <div class="text-center mb-8">
            <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-red-500 text-white flex items-center justify-center text-2xl shadow-lg shadow-red-500/30">
                <i class="fa-solid fa-bolt"></i>
            </div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900"><?php echo e(__('Acil Usta Çağır')); ?></h1>
            <p class="text-gray-500 mt-2"><?php echo e(__('Talebini oluştur, yakınındaki uygun ustalar 30 dakika içinde teklif versin.')); ?></p>
        </div>

        
        <div id="sosFormCard" class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 md:p-8">
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-2"><?php echo e(__('Kategori')); ?> <span class="text-red-500">*</span></label>
                <select id="sosCategory" class="w-full border border-gray-200 rounded-xl p-3 text-sm outline-none focus:border-primary bg-white">
                    <option value=""><?php echo e(__('Kategori seçin...')); ?></option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->category); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-2"><?php echo e(__('Sorununu anlat')); ?> <span class="text-red-500">*</span></label>
                <textarea id="sosDescription" rows="4"
                          class="w-full border border-gray-200 rounded-xl p-3 text-sm outline-none focus:border-primary resize-none"
                          placeholder="<?php echo e(__('Örn: Mutfak lavabosu tıkandı, su taşıyor. Acil müdahale gerekiyor.')); ?>"></textarea>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2"><?php echo e(__('Adres')); ?></label>
                <input type="text" id="sosAddress"
                       class="w-full border border-gray-200 rounded-xl p-3 text-sm outline-none focus:border-primary"
                       placeholder="<?php echo e(__('Mahalle, cadde, bina no...')); ?>">
            </div>
            <button type="button" id="sosCreateBtn"
                    class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-4 rounded-2xl transition shadow-lg shadow-red-500/25">
                <i class="fa-solid fa-bolt mr-1"></i> <?php echo e(__('Acil Talep Oluştur')); ?>

            </button>
            <p id="sosFormError" class="hidden text-sm text-red-600 text-center mt-3"></p>
        </div>

        
        <div id="sosActiveCard" class="hidden bg-white rounded-3xl border border-gray-100 shadow-sm p-6 md:p-8">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-lg font-bold text-gray-900" id="sosActiveTitle"><?php echo e(__('Usta Aranıyor...')); ?></h2>
                    <p class="text-sm text-gray-500" id="sosActiveSubtitle"><?php echo e(__('Yakındaki ustalar bilgilendirildi, teklifler burada görünecek.')); ?></p>
                </div>
                <span id="sosStatusBadge" class="text-xs font-bold px-3 py-1.5 rounded-full bg-amber-50 text-amber-600"><?php echo e(__('Bekliyor')); ?></span>
            </div>

            <div id="sosSpinner" class="flex justify-center py-6">
                <div class="w-10 h-10 border-4 border-red-200 border-t-red-500 rounded-full animate-spin"></div>
            </div>

            <div id="sosOffers" class="space-y-3"></div>

            <div id="sosAcceptedBox" class="hidden text-center py-4">
                <div class="w-14 h-14 mx-auto mb-3 rounded-full bg-green-500 text-white flex items-center justify-center text-xl">
                    <i class="fa-solid fa-check"></i>
                </div>
                <h3 class="font-bold text-gray-900 mb-1"><?php echo e(__('Usta Bulundu!')); ?></h3>
                <p class="text-sm text-gray-500 mb-1" id="sosAcceptedName"></p>
                <p class="text-primary font-bold" id="sosAcceptedPrice"></p>
                <p class="text-xs text-gray-400 mt-2"><?php echo e(__('Ödeme ve sipariş adımları için mobil uygulamayı kullanabilir veya ustayla mesajlaşabilirsiniz.')); ?></p>
            </div>

            <button type="button" id="sosCancelBtn"
                    class="w-full mt-6 border border-red-200 text-red-500 font-semibold py-3 rounded-2xl hover:bg-red-50 transition">
                <?php echo e(__('Talebi İptal Et')); ?>

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
            statusBadge.textContent = <?php echo json_encode(__('Kabul Edildi'), 15, 512) ?>;
            statusBadge.className = 'text-xs font-bold px-3 py-1.5 rounded-full bg-green-50 text-green-600';
            document.getElementById('sosActiveTitle').textContent = <?php echo json_encode(__('Usta Bulundu!'), 15, 512) ?>;
            document.getElementById('sosActiveSubtitle').textContent = <?php echo json_encode(__('Talebiniz kabul edildi.'), 15, 512) ?>;
            document.getElementById('sosAcceptedName').textContent = e.freelancer_name || '';
            document.getElementById('sosAcceptedPrice').textContent = e.offered_price
                ? <?php echo json_encode(__('Teklif:'), 15, 512) ?> + ' ' + Number(e.offered_price).toLocaleString('tr-TR') + ' ₺' : '';
            clearInterval(pollTimer);
            return;
        }

        if (offers.length > 0) {
            spinner.classList.add('hidden');
            offersEl.innerHTML = offers.map(o => `
                <div class="flex items-center justify-between border border-gray-100 rounded-2xl p-4">
                    <div>
                        <div class="font-semibold text-gray-900 text-sm">${o.freelancer_name || <?php echo json_encode(__('Usta'), 15, 512) ?>}</div>
                        <div class="text-primary font-bold">${Number(o.offered_price).toLocaleString('tr-TR')} ₺</div>
                    </div>
                    <button data-offer="${o.id}"
                            class="sos-select-btn bg-primary text-white text-sm font-bold px-5 py-2.5 rounded-xl hover:opacity-90 transition">
                        ${<?php echo json_encode(__('Seç'), 15, 512) ?>}
                    </button>
                </div>`).join('');
            offersEl.querySelectorAll('.sos-select-btn').forEach(btn => {
                btn.addEventListener('click', async function () {
                    this.disabled = true;
                    const r = await api(<?php echo json_encode(url('acil-talep/teklif-sec'), 15, 512) ?> + '/' + activeId, 'POST', { offer_id: Number(this.dataset.offer) });
                    if (!r.ok) { alert(r.data.msg || <?php echo json_encode(__('İşlem başarısız'), 15, 512) ?>); this.disabled = false; return; }
                    refresh();
                });
            });
        } else {
            spinner.classList.remove('hidden');
            offersEl.innerHTML = '';
        }
    }

    async function refresh() {
        const r = await api(<?php echo json_encode(route('web.emergency.active'), 15, 512) ?>);
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
            err.textContent = <?php echo json_encode(__('Lütfen kategori seçin ve sorununuzu kısaca anlatın.'), 15, 512) ?>;
            err.classList.remove('hidden');
            return;
        }
        this.disabled = true;
        const r = await api(<?php echo json_encode(route('web.emergency.create'), 15, 512) ?>, 'POST', {
            category_id: Number(category_id),
            description,
            address: document.getElementById('sosAddress').value.trim() || null,
        });
        this.disabled = false;
        if (!r.ok) {
            err.textContent = r.data.msg || r.data.message || <?php echo json_encode(__('Talep oluşturulamadı.'), 15, 512) ?>;
            err.classList.remove('hidden');
            return;
        }
        refresh();
        pollTimer = setInterval(refresh, 6000);
    });

    document.getElementById('sosCancelBtn').addEventListener('click', async function () {
        if (!activeId || !confirm(<?php echo json_encode(__('Talebi iptal etmek istediğinize emin misiniz?'), 15, 512) ?>)) return;
        const r = await api(<?php echo json_encode(url('acil-talep/iptal'), 15, 512) ?> + '/' + activeId, 'POST');
        if (!r.ok) { alert(r.data.msg || <?php echo json_encode(__('İptal edilemedi (iş başlamış olabilir).'), 15, 512) ?>); return; }
        clearInterval(pollTimer);
        location.reload();
    });

    // Sayfa açıldığında aktif talep varsa direkt durum ekranı.
    refresh().then(() => {
        if (activeId) pollTimer = setInterval(refresh, 6000);
    });
})();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.new_design.layout.new_master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/pages/emergency/emergency.blade.php ENDPATH**/ ?>