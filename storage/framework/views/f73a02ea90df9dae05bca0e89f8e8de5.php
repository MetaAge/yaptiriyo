<aside class="lg:w-[416px] space-y-8 sticky top-[100px] h-fit">
    <!-- Contact Card -->
    <div class="border border-gray-200 rounded-2xl p-6 bg-white">
        <div class="flex items-center gap-4 mb-6">
            <div class="relative">
                <?php if($user->image): ?>
                    <?php if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])): ?>
                        <img src="<?php echo e(render_frontend_cloud_image_if_module_exists( 'profile/'. $user->image, load_from: $user->load_from)); ?>" alt="<?php echo e($user->first_name .' '.$user->last_name); ?>" class="w-12 h-12 rounded-full object-cover">
                    <?php else: ?>
                        <img src="<?php echo e(asset('assets/uploads/profile/'.$user->image)); ?>" alt="<?php echo e($user->first_name .' '.$user->last_name); ?>" class="w-12 h-12 rounded-full object-cover">
                    <?php endif; ?>
                <?php else: ?>
                    <img src="<?php echo e(asset('assets/static/img/author/author.jpg')); ?>" alt="<?php echo e(__('AuthorImg')); ?>" class="w-12 h-12 rounded-full object-cover">
                <?php endif; ?>
                <?php if(Cache::has('user_is_online_' . $user->id)): ?>
                    <div class="absolute w-3 h-3 bg-primary border border-white rounded-full right-0 bottom-0"></div>
                <?php endif; ?>
            </div>
            <div>
                <h3 class="font-medium text-lg text-base-300"><?php echo e($user->first_name .' '.$user->last_name); ?></h3>
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <?php if(Cache::has('user_is_online_' . $user->id)): ?>
                        <span class="flex items-center gap-1">
                            <?php echo e(__('Online')); ?>

                            <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                        </span>
                    <?php else: ?>
                        <span class="flex items-center gap-1">
                            <span class="w-1.5 h-1.5 bg-gray-400 rounded-full"></span>
                            <?php echo e(__('Inactive')); ?>

                        </span>
                    <?php endif; ?>

                    <?php if(!empty($user->user_state->timezone)): ?>
                        <span>
                            <?php
                                date_default_timezone_set(optional($user->user_state)->timezone ?? '');
                            ?>
                            <?php echo e(date('h:i A')); ?> <?php echo e(__('local time')); ?>

                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php if(Auth::guard('web')->check()): ?>
            <?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 1 && Auth::guard('web')->user()->id != $user->id && Session::get('user_role') != 'freelancer' && optional($record)->can_contact_freelancer == 1): ?>
                <a href="<?php echo e(route('client.live.chat')); ?>?freelancer_id=<?php echo e($user->id); ?>"
                   id="contact-me-btn"
                   class="w-full bg-primary text-white font-medium py-3 rounded-lg hover:bg-primary/90 transition mb-4 flex items-center justify-center gap-2">
                    <?php echo e(__('Contact me')); ?> <i class="fa-solid fa-arrow-right -rotate-45"></i>
                </a>
            <?php elseif(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 2 && Auth::guard('web')->user()->id != $user->id && Session::get('user_role') == 'client' && optional($record)->can_contact_freelancer == 1): ?>
                <a href="<?php echo e(route('client.live.chat')); ?>?freelancer_id=<?php echo e($user->id); ?>"
                   id="contact-me-btn"
                   class="w-full bg-primary text-white font-medium py-3 rounded-lg hover:bg-primary/90 transition mb-4 flex items-center justify-center gap-2">
                    <?php echo e(__('Contact me')); ?> <i class="fa-solid fa-arrow-right -rotate-45"></i>
                </a>
            <?php endif; ?>
        <?php else: ?>
            <?php if(!empty($record->can_contact_freelancer) && optional($record)->can_contact_freelancer == 1 && optional($record)->show_contact_me_before_login == 1): ?>
                <a href="javascript:void(0)"
                   class="w-full bg-primary text-white font-medium py-3 rounded-lg hover:bg-primary/90 transition mb-4 flex items-center justify-center gap-2 contact_warning_chat_message">
                    <?php echo e(__('Contact me')); ?> <i class="fa-solid fa-arrow-right -rotate-45"></i>
                </a>
            <?php endif; ?>
        <?php endif; ?>


        <div class="text-sm font-small text-base-400 mb-4">
            <?php echo e(__('Average response time: 1 hour')); ?>

        </div>

        <?php
            // Structured plan gating (mobil API ile aynı kurallar):
            // whatsapp_button → WhatsApp, phone_call → arama, badge → rozet.
            $freelancer_gate = \Modules\Subscription\Services\PlanGate::for($user->id);
            $can_whatsapp = $freelancer_gate->can('whatsapp_button');
            $can_call = $freelancer_gate->can('phone_call');
            $usta_badge = $freelancer_gate->value('badge'); // trusted | pro | null
            $whatsapp_link = $user->phone ? "https://wa.me/" . preg_replace('/[^0-9]/', '', $user->phone) : null;
        ?>

        <?php if($usta_badge === 'pro'): ?>
            <div class="inline-flex items-center gap-1.5 bg-indigo-50 text-indigo-700 text-xs font-bold px-3 py-1.5 rounded-full mb-3">
                <i class="fa-solid fa-bolt"></i> <?php echo e(__('Pro Usta')); ?>

            </div>
        <?php elseif($usta_badge === 'trusted'): ?>
            <div class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 text-xs font-bold px-3 py-1.5 rounded-full mb-3">
                <i class="fa-solid fa-shield-halved"></i> <?php echo e(__('Güvenilir Usta')); ?>

            </div>
        <?php endif; ?>

        <?php if($can_whatsapp && $whatsapp_link): ?>
            <!-- WhatsApp Button -->
            <a href="<?php echo e($whatsapp_link); ?>" target="_blank"
               class="w-full bg-[#25D366] text-white font-medium py-3 rounded-lg hover:bg-[#128C7E] transition mb-3 flex items-center justify-center gap-2">
                <i class="fa-brands fa-whatsapp text-xl font-bold"></i> <?php echo e(__('WhatsApp ile İletişime Geç')); ?>

            </a>
        <?php endif; ?>

        <?php if($can_call && $user->phone): ?>
            <!-- Call Button -->
            <a href="tel:<?php echo e($user->phone); ?>"
               class="w-full bg-secondary text-white font-medium py-3 rounded-lg hover:bg-secondary/90 transition mb-3 flex items-center justify-center gap-2">
                <i class="fa-solid fa-phone"></i> <?php echo e(__('Hemen Ara')); ?>

            </a>
        <?php endif; ?>

        <?php if(!$can_whatsapp && !$can_call): ?>
            <!-- Locked State for Free Users -->
            <div class="w-full bg-gray-50 text-gray-500 font-medium py-4 rounded-xl mb-4 flex flex-col items-center justify-center gap-2 border border-dashed border-gray-300">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-lock text-gray-400 text-xs"></i>
                    </div>
                    <span class="text-sm font-semibold"><?php echo e(__('İletişim Bilgileri Gizli')); ?></span>
                </div>
                <p class="text-[11px] text-gray-400 text-center px-4"><?php echo e(__('Bu usta ile direkt iletişim, ücretli paket kullanan ustalarda açıktır. Mesajlaşarak iletişime geçebilirsiniz.')); ?></p>
            </div>
        <?php endif; ?>
    </div>


    <!-- Info Card -->
    <div class="border border-gray-200 rounded-2xl p-6 bg-white">
        <div class="flex items-center gap-3 mb-4 pb-4 border-b border-gray-100">
            <i class="fa-regular fa-user text-base-300"></i>
            <span class="font-medium text-base-300"><?php echo e(__("Yaptiriyo'da")); ?></span>
            <?php if($user->created_at): ?>
                <span class="font-medium text-base-300"><?php echo e($user->created_at->format('M Y')); ?></span>
            <?php else: ?>
                <span class="text-gray-500"><?php echo e(__('N/A')); ?></span>
            <?php endif; ?>
        </div>
        <div>
            <h4 class="font-medium text-base-300 mb-3"><?php echo e(__('Location')); ?></h4>
            <div class="space-y-2">
                <?php if($user?->user_country?->country): ?>
                    <div class="flex items-center gap-2 text-sm">
                        <span class="text-base-300"><?php echo e(optional($user->user_country)->country); ?></span>
                        <?php if($user?->user_state?->state != null): ?>
                            <span class="text-base-400">: <?php echo e(optional($user->user_state)->state); ?></span>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="text-sm text-gray-500">
                        <?php echo e(__('Location not specified')); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if($isOwnProfile): ?>
        <!-- Simple Earnings Toggle -->
        <?php if(get_static_option('user_earning_toggle') == 'enable'): ?>
            <div class="border border-gray-200 rounded-2xl p-6 bg-white">
                <div class="flex items-center justify-between">
                    <span class="font-medium text-base-300">
                        <?php echo e(__('Show Earnings')); ?>

                    </span>
                    <label class="toggle-switch relative inline-block w-12 h-6 flex-shrink-0" role="switch" aria-checked="<?php echo e(optional($user->user_earning)->show_earning ? 'true' : 'false'); ?>">
                        <input type="checkbox" id="earningToggle" <?php echo e(optional($user->user_earning)->show_earning ? 'checked' : ''); ?> class="opacity-0 w-0 h-0">
                        <span class="toggle-slider absolute cursor-pointer top-0 left-0 right-0 bottom-0 bg-gray-300 transition rounded-full before:absolute before:content-[''] before:h-4 before:w-4 before:left-1 before:bottom-1 before:bg-white before:transition before:rounded-full"></span>
                    </label>
                </div>
            </div>
        <?php endif; ?>

        <!-- Simple Work Availability Toggle -->
        <div class="border border-gray-200 rounded-2xl p-6 bg-white">
            <div class="flex items-center justify-between">
                <span class="font-medium text-base-300">
                    <?php echo e(__('Available for Work')); ?>

                </span>
                <label class="toggle-switch relative inline-block w-12 h-6 flex-shrink-0" role="switch" aria-checked="<?php echo e($user->check_work_availability ? 'true' : 'false'); ?>">
                    <input type="checkbox" id="workAvailabilityToggle" <?php echo e($user->check_work_availability ? 'checked' : ''); ?> class="opacity-0 w-0 h-0">
                    <span class="toggle-slider absolute cursor-pointer top-0 left-0 right-0 bottom-0 bg-gray-300 transition rounded-full before:absolute before:content-[''] before:h-4 before:w-4 before:left-1 before:bottom-1 before:bg-white before:transition before:rounded-full"></span>
                </label>
            </div>
        </div>
    <?php endif; ?>
</aside><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/profile-details/sidebar.blade.php ENDPATH**/ ?>