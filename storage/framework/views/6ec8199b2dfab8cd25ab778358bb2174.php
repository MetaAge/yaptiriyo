<?php $__env->startSection('page-meta-data'); ?>
    <title><?php echo e(get_static_option('site_title', 'Yaptiriyo')); ?> — <?php echo e(__('Aradığın usta, bir dokunuş uzağında')); ?></title>
    <meta name="description" content="<?php echo e(__('Tesisatçıdan boyacıya, temizlikten nakliyeye binlerce güvenilir usta. Fiyatı önceden öğren, güvenle sipariş ver.')); ?>">
    <link rel="canonical" href="<?php echo e(route('homepage')); ?>">
    <script type="application/ld+json"><?php echo json_encode([
        '<?php $__contextArgs = [];
if (context()->has($__contextArgs[0])) :
if (isset($value)) { $__contextPrevious[] = $value; }
$value = context()->get($__contextArgs[0]); ?>' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => 'Yaptiriyo',
        'url' => route('homepage'),
        'potentialAction' => [
            '@type' => 'SearchAction',
            'target' => route('projects.all') . '?search={search_term_string}',
            'query-input' => 'required name=search_term_string',
        ],
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<main class="pt-20 md:pt-24">

    
    <section class="relative overflow-hidden" style="background: linear-gradient(135deg, #FF751F 0%, #FF8E53 60%, #FFA97A 100%);">
        <div class="absolute -right-16 -top-16 w-72 h-72 rounded-full bg-white/10"></div>
        <div class="absolute right-24 bottom-0 w-40 h-40 rounded-full bg-white/5"></div>
        <div class="max-w-7xl mx-auto px-4 md:px-6 py-14 md:py-24 relative z-10">
            <div class="max-w-2xl">
                <h1 class="text-3xl md:text-5xl font-extrabold text-white leading-tight mb-4">
                    <?php echo e(__('Aradığın usta, bir dokunuş uzağında')); ?>

                </h1>
                <p class="text-white/90 text-base md:text-lg mb-8">
                    <?php echo e(__('Tesisatçıdan boyacıya, temizlikten nakliyeye binlerce güvenilir usta tek platformda. Fiyatı önceden öğren, güvenle sipariş ver.')); ?>

                </p>

                
                <form action="<?php echo e(route('projects.all')); ?>" method="GET" class="flex bg-white rounded-2xl p-2 shadow-lg max-w-xl">
                    <input type="text" name="search"
                           placeholder="<?php echo e(__('Usta, hizmet veya kategori ara...')); ?>"
                           class="flex-1 px-4 py-3 text-gray-700 outline-none rounded-xl min-w-0">
                    <button type="submit"
                            class="bg-primary text-white font-semibold px-6 py-3 rounded-xl hover:opacity-90 transition shrink-0">
                        <i class="fa-solid fa-magnifying-glass mr-1"></i> <?php echo e(__('Ara')); ?>

                    </button>
                </form>

                
                <?php if($top_categories->isNotEmpty()): ?>
                    <div class="flex flex-wrap gap-2 mt-6">
                        <?php $__currentLoopData = $top_categories->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('category.projects', ['slug' => $cat->slug])); ?>"
                               class="bg-white/15 hover:bg-white/25 text-white text-sm font-medium px-4 py-2 rounded-full transition">
                                <?php echo e($cat->category); ?>

                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    
    <section class="border-b border-gray-100 bg-white">
        <div class="max-w-7xl mx-auto px-4 md:px-6 py-6 grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
            <div class="flex items-center justify-center gap-2 text-gray-700">
                <i class="fa-solid fa-shield-halved text-primary text-xl"></i>
                <span class="text-sm font-semibold"><?php echo e(__('Onaylı Ustalar')); ?></span>
            </div>
            <div class="flex items-center justify-center gap-2 text-gray-700">
                <i class="fa-solid fa-lock text-primary text-xl"></i>
                <span class="text-sm font-semibold"><?php echo e(__('Güvenli Ödeme')); ?></span>
            </div>
            <a href="<?php echo e(route('web.emergency.page')); ?>" class="flex items-center justify-center gap-2 text-gray-700 hover:text-red-500 transition">
                <i class="fa-solid fa-bolt text-red-500 text-xl"></i>
                <span class="text-sm font-semibold"><?php echo e(__('30 Dk\'da Acil Usta')); ?></span>
            </a>
            <div class="flex items-center justify-center gap-2 text-gray-700">
                <i class="fa-solid fa-star text-primary text-xl"></i>
                <span class="text-sm font-semibold"><?php echo e(__('Gerçek Yorumlar')); ?></span>
            </div>
        </div>
    </section>

    
    <?php if($top_categories->isNotEmpty()): ?>
    <section class="max-w-7xl mx-auto px-4 md:px-6 py-12 md:py-16">
        <div class="flex items-end justify-between mb-8">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900"><?php echo e(__('Kategorilere Göz At')); ?></h2>
                <p class="text-gray-500 mt-1"><?php echo e(__('Ne lazımsa hepsi burada')); ?></p>
            </div>
            <a href="<?php echo e(route('projects.all')); ?>" class="text-primary font-semibold text-sm hover:underline shrink-0">
                <?php echo e(__('Tümünü Gör')); ?> <i class="fa-solid fa-arrow-right ml-1"></i>
            </a>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            <?php $__currentLoopData = $top_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('category.projects', ['slug' => $cat->slug])); ?>"
                   class="group bg-white border border-gray-100 rounded-2xl p-5 text-center hover:border-primary/40 hover:shadow-lg transition">
                    <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-primary/10 text-primary flex items-center justify-center group-hover:bg-primary group-hover:text-white transition">
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                    </div>
                    <div class="text-sm font-semibold text-gray-800 group-hover:text-primary transition"><?php echo e($cat->category); ?></div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
    <?php endif; ?>

    
    <?php if($featured_projects->isNotEmpty()): ?>
    <section class="bg-gray-50 py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <div class="flex items-end justify-between mb-8">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900">
                        <i class="fa-solid fa-rocket text-primary mr-2"></i><?php echo e(__('Öne Çıkan Hizmetler')); ?>

                    </h2>
                    <p class="text-gray-500 mt-1"><?php echo e(__('En çok tercih edilen ustalar ve hizmetler')); ?></p>
                </div>
                <a href="<?php echo e(route('projects.all')); ?>" class="text-primary font-semibold text-sm hover:underline shrink-0">
                    <?php echo e(__('Tümünü Gör')); ?> <i class="fa-solid fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php $__currentLoopData = $featured_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $creator = $project->project_creator;
                        $price = ($project->basic_discount_charge ?? 0) > 0
                            ? $project->basic_discount_charge
                            : $project->basic_regular_charge;
                    ?>
                    <a href="<?php echo e($creator?->username ? route('project.details', ['username' => $creator->username, 'slug' => $project->slug]) : '#'); ?>"
                       class="group bg-white rounded-2xl overflow-hidden border border-gray-100 hover:shadow-xl hover:border-primary/30 transition flex flex-col">
                        <div class="relative h-44 bg-gray-100 overflow-hidden">
                            <?php if($project->first_image): ?>
                                <?php if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])): ?>
                                    <img src="<?php echo e(render_frontend_cloud_image_if_module_exists('project/'.$project->first_image, load_from: $project->load_from)); ?>"
                                         alt="<?php echo e($project->title); ?>" loading="lazy"
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('assets/uploads/project/' . $project->first_image)); ?>"
                                         alt="<?php echo e($project->title); ?>" loading="lazy"
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <i class="fa-regular fa-image text-4xl"></i>
                                </div>
                            <?php endif; ?>
                            <span class="absolute top-3 left-3 bg-primary text-white text-[11px] font-bold px-2.5 py-1 rounded-full">
                                <i class="fa-solid fa-rocket mr-1"></i><?php echo e(__('Öne Çıkan')); ?>

                            </span>
                        </div>
                        <div class="p-4 flex flex-col flex-1">
                            <h3 class="font-semibold text-gray-900 text-sm leading-snug line-clamp-2 mb-2 group-hover:text-primary transition">
                                <?php echo e($project->title); ?>

                            </h3>
                            <div class="flex items-center gap-2 text-xs text-gray-500 mb-3">
                                <span class="font-medium"><?php echo e($creator?->first_name); ?> <?php echo e($creator?->last_name); ?></span>
                                <?php if(($project->ratings_count ?? 0) > 0): ?>
                                    <span class="flex items-center gap-1 text-amber-500 font-semibold">
                                        <i class="fa-solid fa-star"></i><?php echo e(number_format((float) $project->ratings_avg_rating, 1)); ?>

                                    </span>
                                <?php else: ?>
                                    <span class="bg-green-50 text-green-700 font-semibold px-2 py-0.5 rounded-full"><?php echo e(__('Yeni')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="mt-auto pt-3 border-t border-gray-100 flex items-center justify-between">
                                <span class="text-[11px] text-gray-400"><?php echo e(__('Başlangıç')); ?></span>
                                <span class="text-primary font-bold"><?php echo e(yaptiriyo_price_label($price, $project->pricing_type)); ?></span>
                            </div>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    
    <section class="max-w-7xl mx-auto px-4 md:px-6 py-12 md:py-16">
        <div class="rounded-3xl p-8 md:p-12 relative overflow-hidden"
             style="background: linear-gradient(135deg, #FF6B6B 0%, #FF8E53 100%);">
            <div class="absolute -right-10 -top-10 w-56 h-56 rounded-full bg-white/10"></div>
            <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <div>
                    <span class="inline-block bg-amber-400 text-black text-[11px] font-extrabold px-2.5 py-1 rounded-md mb-3">AI</span>
                    <h2 class="text-2xl md:text-3xl font-bold text-white mb-2"><?php echo e(__('Usta Çağırmadan Fiyat Al')); ?></h2>
                    <p class="text-white/85 text-sm md:text-base"><?php echo e(__('İşini birkaç kelimeyle anlat, yapay zekâ ortalama piyasa fiyatını saniyeler içinde hesaplasın.')); ?></p>
                </div>
                <div class="bg-white rounded-2xl p-5 shadow-lg">
                    <textarea id="aiEstimateInput" rows="3"
                              class="w-full border border-gray-200 rounded-xl p-3 text-sm text-gray-700 outline-none focus:border-primary resize-none"
                              placeholder="<?php echo e(__('Örn: 2+1 daire boyama, malzeme dahil, acil.')); ?>"></textarea>
                    <button type="button" id="aiEstimateBtn"
                            class="w-full mt-3 bg-primary text-white font-bold py-3 rounded-xl hover:opacity-90 transition">
                        <?php echo e(__('Analiz Et ve Fiyat Al')); ?>

                    </button>
                    <div id="aiEstimateResult" class="hidden mt-4 border-t border-gray-100 pt-4 text-center">
                        <div class="text-[11px] font-bold tracking-widest text-gray-400 mb-1"><?php echo e(__('ÖNERİLEN BÜTÇE')); ?></div>
                        <div id="aiEstimatePrice" class="text-3xl font-extrabold text-primary"></div>
                        <div id="aiEstimateRange" class="text-sm text-gray-500 mt-1"></div>
                    </div>
                    <div id="aiEstimateError" class="hidden mt-3 text-sm text-red-600 text-center"></div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="max-w-7xl mx-auto px-4 md:px-6 py-12 md:py-16">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 text-center mb-10"><?php echo e(__('Nasıl Çalışır?')); ?></h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-14 h-14 mx-auto mb-4 rounded-2xl bg-primary/10 text-primary flex items-center justify-center text-xl font-extrabold">1</div>
                <h3 class="font-bold text-gray-900 mb-2"><?php echo e(__('Hizmeti Seç')); ?></h3>
                <p class="text-sm text-gray-500"><?php echo e(__('Kategorilerden ihtiyacını bul, ustaları ve fiyatları karşılaştır.')); ?></p>
            </div>
            <div class="text-center">
                <div class="w-14 h-14 mx-auto mb-4 rounded-2xl bg-primary/10 text-primary flex items-center justify-center text-xl font-extrabold">2</div>
                <h3 class="font-bold text-gray-900 mb-2"><?php echo e(__('Randevunu Oluştur')); ?></h3>
                <p class="text-sm text-gray-500"><?php echo e(__('Adresini ve uygun tarihi seç, güvenli ödemeyle siparişini ver.')); ?></p>
            </div>
            <div class="text-center">
                <div class="w-14 h-14 mx-auto mb-4 rounded-2xl bg-primary/10 text-primary flex items-center justify-center text-xl font-extrabold">3</div>
                <h3 class="font-bold text-gray-900 mb-2"><?php echo e(__('İş Bitince Onayla')); ?></h3>
                <p class="text-sm text-gray-500"><?php echo e(__('Usta işi tamamlasın, sen onayla — ödemen o zamana kadar güvende.')); ?></p>
            </div>
        </div>
    </section>

    
    <section class="max-w-7xl mx-auto px-4 md:px-6 pb-14 md:pb-20">
        <div class="rounded-3xl p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-6"
             style="background: linear-gradient(135deg, #11141D 0%, #1E2432 100%);">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-2"><?php echo e(__('Usta mısın? Kazanmaya başla')); ?></h2>
                <p class="text-white/70 text-sm md:text-base"><?php echo e(__('Ücretsiz kayıt ol, hizmetlerini oluştur, yakınındaki işlere teklif ver.')); ?></p>
            </div>
            <a href="<?php echo e(route('user.register')); ?>"
               class="bg-primary text-white font-bold px-8 py-4 rounded-2xl hover:opacity-90 transition shrink-0">
                <?php echo e(__('Hemen Kayıt Ol')); ?> <i class="fa-solid fa-arrow-right ml-1"></i>
            </a>
        </div>
    </section>

</main>

<script>
    (function () {
        const btn = document.getElementById('aiEstimateBtn');
        if (!btn) return;
        const input = document.getElementById('aiEstimateInput');
        const result = document.getElementById('aiEstimateResult');
        const priceEl = document.getElementById('aiEstimatePrice');
        const rangeEl = document.getElementById('aiEstimateRange');
        const errEl = document.getElementById('aiEstimateError');

        btn.addEventListener('click', async function () {
            const description = (input.value || '').trim();
            errEl.classList.add('hidden');
            result.classList.add('hidden');
            if (description.length < 3) {
                errEl.textContent = <?php echo json_encode(__('Lütfen işinizi birkaç kelimeyle anlatın.'), 15, 512) ?>;
                errEl.classList.remove('hidden');
                return;
            }
            btn.disabled = true;
            btn.textContent = <?php echo json_encode(__('Analiz ediliyor...'), 15, 512) ?>;
            try {
                const res = await fetch(<?php echo json_encode(route('web.price.estimate'), 15, 512) ?>, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                    },
                    body: JSON.stringify({ description }),
                });
                const data = await res.json();
                if (!res.ok || data.status === 'error') {
                    throw new Error(data.message || <?php echo json_encode(__('Tahmin alınamadı, lütfen tekrar deneyin.'), 512) ?>);
                }
                const est = data.estimate || {};
                const rec = est.recommended ?? est.median ?? null;
                const min = est.min ?? null;
                const max = est.max ?? null;
                const cur = est.currency ?? '₺';
                if (!rec) throw new Error(<?php echo json_encode(__('Bu iş için yeterli veri bulunamadı. Daha fazla detay yazmayı deneyin.'), 15, 512) ?>);
                priceEl.textContent = Number(rec).toLocaleString('tr-TR') + cur;
                rangeEl.textContent = (min !== null && max !== null)
                    ? <?php echo json_encode(__('Beklenen aralık:'), 15, 512) ?> + ' ' + Number(min).toLocaleString('tr-TR') + cur + ' – ' + Number(max).toLocaleString('tr-TR') + cur
                    : '';
                result.classList.remove('hidden');
            } catch (e) {
                errEl.textContent = e.message;
                errEl.classList.remove('hidden');
            } finally {
                btn.disabled = false;
                btn.textContent = <?php echo json_encode(__('Analiz Et ve Fiyat Al'), 15, 512) ?>;
            }
        });
    })();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.new_design.layout.new_master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/pages/yaptiriyo-home.blade.php ENDPATH**/ ?>