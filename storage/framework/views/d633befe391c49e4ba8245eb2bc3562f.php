<?php $__env->startSection('title', __('Sipariş Başarılı')); ?>
<?php $__env->startSection('content'); ?>
    <div class="py-20 md:py-[120px] bg-slate-50">
        <div class="container mx-auto max-w-2xl px-6">
            <div class="bg-white rounded-3xl p-8 md:p-12 shadow-sm border border-slate-100 text-center">
                <div class="w-24 h-24 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-8 animate-bounce">
                    <i class="fa-solid fa-check text-4xl"></i>
                </div>
                
                <h1 class="text-3xl font-bold text-slate-800 mb-4"><?php echo e(__('Tebrikler!')); ?></h1>
                <p class="text-slate-500 mb-10 text-lg">
                    <?php echo e(__('Hizmet siparişiniz başarıyla oluşturuldu. Hizmet verenle iletişime geçebilirsiniz.')); ?>

                </p>

                <div class="bg-slate-50 rounded-2xl p-6 mb-10 text-left">
                    <h3 class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-4 border-b pb-2">
                        <?php echo e(__('Sipariş Özeti')); ?>

                    </h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-slate-500 font-medium"><?php echo e(__('Sipariş No')); ?></span>
                            <span class="text-slate-800 font-bold">#<?php echo e(1000 + $order_details->id); ?></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-500 font-medium"><?php echo e(__('Toplam Tutar')); ?></span>
                            <span class="text-[#FA8C00] font-bold text-xl"><?php echo e(float_amount_with_currency_symbol($order_details->price)); ?></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-500 font-medium"><?php echo e(__('Randevu Tarihi')); ?></span>
                            <span class="text-slate-800 font-semibold"><?php echo e(\Carbon\Carbon::parse($order_details->appointment_date)->translatedFormat('j F Y')); ?></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-500 font-medium"><?php echo e(__('Randevu Saati')); ?></span>
                            <span class="text-slate-800 font-semibold"><?php echo e($order_details->appointment_time); ?></span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="<?php echo e(route('client.order.details', $order_details->id)); ?>" 
                       class="flex-1 bg-[#FA8C00] hover:bg-[#E67E00] text-white font-bold py-4 rounded-xl transition-all shadow-lg shadow-[#FA8C00]/20">
                        <?php echo e(__('Detayları Görüntüle')); ?>

                    </a>
                    <a href="<?php echo e(route('homepage')); ?>" 
                       class="flex-1 bg-white border border-slate-200 text-slate-600 font-bold py-4 rounded-xl hover:bg-slate-50 transition-all">
                        <?php echo e(__('Ana Sayfaya Dön')); ?>

                    </a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.new_design.layout.new_master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/pages/order/success.blade.php ENDPATH**/ ?>