<?php if(Auth::guard('web')->user()->user_type == 1 && Session::get('user_role') != 'freelancer'): ?>
    <?php
        $client_notifications = \App\Models\ClientNotification::where('client_id', Auth::guard('web')->user()->id)
            ->latest()
            ->take(200)
            ->get();
        $client_new_notifications = \App\Models\ClientNotification::where('is_read', 'unread')
            ->where('client_id', Auth::guard('web')->user()->id)
            ->latest()
            ->get();
    ?>
    <div class="navbar-right-item">
        <div class="navbar-right-notification">
            <a href="javascript:void(0)" class="navbar-right-notification-icon">
                <i class="fa-regular fa-bell"></i>
                <?php if($client_new_notifications->count() > 0): ?>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo e($client_new_notifications->count() ?? 0); ?></span>
                <?php endif; ?>
            </a>
            <div class="navbar-right-notification-wrapper">
                <div class="navbar-right-notification-wrapper-list">
                    <?php if($client_notifications->count() > 0): ?>
                        <?php $__currentLoopData = $client_notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span href="javascript:void(0)"
                                  class="navbar-right-notification-wrapper-list-item click-notification">
                                                <div class="navbar-right-notification-wrapper-list-item-left">
                                                    <div class="navbar-right-notification-wrapper-list-item-icon decline">
                                                        <?php if($notification->is_read == 'read'): ?>
                                                            <i class="fa-regular fa-bell opacity-25 pe-none"></i>
                                                        <?php else: ?>
                                                            <i class="fa-regular fa-bell"></i>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="navbar-right-notification-wrapper-list-item-content">
                                                    <?php if($notification->type == 'Offer'): ?>
                                                        <a
                                                                href="<?php echo e(route('client.offer.details', $notification->identity)); ?>?mark_as_read=true">
                                                            <span
                                                                    class="navbar-right-notification-wrapper-list-item-content-title"><?php echo e(__($notification->message)); ?></span>
                                                        </a>
                                                        <span
                                                                class="navbar-right-notification-wrapper-list-item-content-time"><?php echo e($notification->created_at->toFormattedDateString()); ?></span>
                                                    <?php endif; ?>
                                                    <?php if($notification->type == 'Proposal'): ?>
                                                        <a
                                                                href="<?php echo e(route('client.job.proposal.details', $notification->identity)); ?>?mark_as_read=true">
                                                            <span
                                                                    class="navbar-right-notification-wrapper-list-item-content-title"><?php echo e(__($notification->message)); ?></span>
                                                        </a>
                                                        <span
                                                                class="navbar-right-notification-wrapper-list-item-content-time"><?php echo e($notification->created_at->toFormattedDateString()); ?></span>
                                                    <?php endif; ?>
                                                    <?php if($notification->type == 'Order'): ?>
                                                        <a
                                                                href="<?php echo e(route('client.order.details', $notification->identity)); ?>?mark_as_read=true">
                                                            <span
                                                                    class="navbar-right-notification-wrapper-list-item-content-title"><?php echo e(__($notification->message)); ?></span>
                                                        </a>
                                                        <span
                                                                class="navbar-right-notification-wrapper-list-item-content-time"><?php echo e($notification->created_at->toFormattedDateString()); ?></span>
                                                    <?php endif; ?>
                                                    <?php if($notification->type == 'Job'): ?>
                                                        <a
                                                                href="<?php echo e(route('client.job.details', $notification->identity)); ?>?mark_as_read=true">
                                                            <span
                                                                    class="navbar-right-notification-wrapper-list-item-content-title"><?php echo e(__($notification->message)); ?></span>
                                                        </a>
                                                        <span
                                                                class="navbar-right-notification-wrapper-list-item-content-time"><?php echo e($notification->created_at->toFormattedDateString()); ?></span>
                                                    <?php endif; ?>
                                                    <?php if($notification->type == 'Ticket Update' || $notification->type == 'Ticket'): ?>
                                                        <a href="<?php echo e(route('client.ticket.details',$notification->identity)); ?>?mark_as_read=true">
                                                        <span class="navbar-right-notification-wrapper-list-item-content-title"><?php echo e(__($notification->message)); ?></span>
                                                    </a>
                                                        <span class="navbar-right-notification-wrapper-list-item-content-time"><?php echo e($notification->created_at->toFormattedDateString()); ?></span>
                                                    <?php endif; ?>
                                                    <?php if($notification->type == 'Subscription'): ?>
                                                        <a href="<?php echo e(route('client.subscriptions.all')); ?>?mark_as_read=true">
                                                        <span class="navbar-right-notification-wrapper-list-item-content-title"><?php echo e(__($notification->message)); ?></span>
                                                        </a>
                                                        <span class="navbar-right-notification-wrapper-list-item-content-time"><?php echo e($notification->created_at->toFormattedDateString()); ?></span>
                                                    <?php endif; ?>
                                                    <?php if($notification->type == 'Deposit'): ?>
                                                        <a href="<?php echo e(route('client.wallet.history')); ?>?mark_as_read=true">
                                                        <span class="navbar-right-notification-wrapper-list-item-content-title"><?php echo e(__($notification->message)); ?></span>
                                                        </a>
                                                        <span class="navbar-right-notification-wrapper-list-item-content-time"><?php echo e($notification->created_at->toFormattedDateString()); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <a href="javascript:void(0)"
                           class="navbar-right-notification-wrapper-list-item click-notification">
                            <div class="navbar-right-notification-wrapper-list-item-left">
                                <div class="navbar-right-notification-wrapper-list-item-icon decline">
                                    <i class="fa-regular fa-bell"></i>
                                </div>
                            </div>
                            <div class="navbar-right-notification-wrapper-list-item-content">
                                <span class="navbar-right-notification-wrapper-list-item-content-title">
                                    <strong><?php echo e(__('No Notification')); ?></strong>
                                </span>
                            </div>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <?php if(Auth::guard('web')->user()->user_type == 2 && Session::get('user_role') == 'client'): ?>
        
        <?php
            $client_notifications = \App\Models\ClientNotification::where('client_id', Auth::guard('web')->user()->id)
                ->latest()
                ->take(200)
                ->get();

            $client_new_notifications = \App\Models\ClientNotification::where('is_read', 'unread')
            ->where('client_id', Auth::guard('web')->user()->id)
            ->latest()
            ->get();
        ?>
        <div class="navbar-right-item">
            <div class="navbar-right-notification">
                <a href="javascript:void(0)" class="navbar-right-notification-icon">
                    <i class="fa-regular fa-bell"></i>
                    <?php if($client_new_notifications->count() > 0): ?>
                        <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo e($client_new_notifications->count() ?? 0); ?></span>
                    <?php endif; ?>
                </a>
                <div class="navbar-right-notification-wrapper">
                    <div class="navbar-right-notification-wrapper-list">
                        <?php if($client_notifications->count() > 0): ?>
                            <?php $__currentLoopData = $client_notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span href="javascript:void(0)"
                                      class="navbar-right-notification-wrapper-list-item click-notification">
                                                <div class="navbar-right-notification-wrapper-list-item-left">
                                                    <div class="navbar-right-notification-wrapper-list-item-icon decline">
                                                         <?php if($notification->is_read == 'read'): ?>
                                                            <i class="fa-regular fa-bell opacity-25 pe-none"></i>
                                                        <?php else: ?>
                                                            <i class="fa-regular fa-bell"></i>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="navbar-right-notification-wrapper-list-item-content">
                                                    <?php if($notification->type == 'Offer'): ?>
                                                        <a
                                                                href="<?php echo e(route('client.offer.details', $notification->identity)); ?>?mark_as_read=true">
                                                            <span
                                                                    class="navbar-right-notification-wrapper-list-item-content-title"><?php echo e(__($notification->message)); ?></span>
                                                        </a>
                                                        <span
                                                                class="navbar-right-notification-wrapper-list-item-content-time"><?php echo e($notification->created_at->toFormattedDateString()); ?></span>
                                                    <?php endif; ?>
                                                    <?php if($notification->type == 'Proposal'): ?>
                                                        <a
                                                                href="<?php echo e(route('client.job.proposal.details', $notification->identity)); ?>?mark_as_read=true">
                                                            <span
                                                                    class="navbar-right-notification-wrapper-list-item-content-title"><?php echo e(__($notification->message)); ?></span>
                                                        </a>
                                                        <span
                                                                class="navbar-right-notification-wrapper-list-item-content-time"><?php echo e($notification->created_at->toFormattedDateString()); ?></span>
                                                    <?php endif; ?>
                                                    <?php if($notification->type == 'Order'): ?>
                                                        <a
                                                                href="<?php echo e(route('client.order.details', $notification->identity)); ?>?mark_as_read=true">
                                                            <span
                                                                    class="navbar-right-notification-wrapper-list-item-content-title"><?php echo e(__($notification->message)); ?></span>
                                                        </a>
                                                        <span
                                                                class="navbar-right-notification-wrapper-list-item-content-time"><?php echo e($notification->created_at->toFormattedDateString()); ?></span>
                                                    <?php endif; ?>
                                                    <?php if($notification->type == 'Job'): ?>
                                                        <a
                                                                href="<?php echo e(route('client.job.details', $notification->identity)); ?>?mark_as_read=true">
                                                            <span
                                                                    class="navbar-right-notification-wrapper-list-item-content-title"><?php echo e(__($notification->message)); ?></span>
                                                        </a>
                                                        <span
                                                                class="navbar-right-notification-wrapper-list-item-content-time"><?php echo e($notification->created_at->toFormattedDateString()); ?></span>
                                                    <?php endif; ?>

                                                        <?php if($notification->type == 'Email Verify'): ?>
                                                            <a href="javascript:void(0)">
                                                                <span class="navbar-right-notification-wrapper-list-item-content-title"><?php echo e(__($notification->message)); ?></span>
                                                            </a>
                                                            <span class="navbar-right-notification-wrapper-list-item-content-time"><?php echo e($notification->created_at->toFormattedDateString()); ?></span>
                                                        <?php endif; ?>
                                                        <?php if($notification->type == 'Account'): ?>
                                                            <a href="javascript:void(0)">
                                                            <span class="navbar-right-notification-wrapper-list-item-content-title"><?php echo e(__($notification->message)); ?></span>
                                                        </a>
                                                            <span class="navbar-right-notification-wrapper-list-item-content-time"><?php echo e($notification->created_at->toFormattedDateString()); ?></span>
                                                        <?php endif; ?>

                                                    <?php if($notification->type == 'Identity Verify'): ?>
                                                        <a href="javascript:void(0)">
                                                            <span class="navbar-right-notification-wrapper-list-item-content-title"><?php echo e(__($notification->message)); ?></span>
                                                        </a>
                                                        <span class="navbar-right-notification-wrapper-list-item-content-time"><?php echo e($notification->created_at->toFormattedDateString()); ?></span>
                                                    <?php endif; ?>
                                                    <?php if($notification->type == 'Ticket Update' || $notification->type == 'Ticket'): ?>
                                                        <a href="<?php echo e(route('client.ticket.details',$notification->identity)); ?>?mark_as_read=true">
                                                        <span class="navbar-right-notification-wrapper-list-item-content-title"><?php echo e(__($notification->message)); ?></span>
                                                    </a>
                                                        <span class="navbar-right-notification-wrapper-list-item-content-time"><?php echo e($notification->created_at->toFormattedDateString()); ?></span>
                                                    <?php endif; ?>
                                                    <?php if($notification->type == 'Subscription'): ?>
                                                        <a href="<?php echo e(route('client.subscriptions.all')); ?>?mark_as_read=true">
                                                            <span class="navbar-right-notification-wrapper-list-item-content-title"><?php echo e(__($notification->message)); ?></span>
                                                        </a>
                                                        <span class="navbar-right-notification-wrapper-list-item-content-time"><?php echo e($notification->created_at->toFormattedDateString()); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <a href="javascript:void(0)"
                               class="navbar-right-notification-wrapper-list-item click-notification">
                                <div class="navbar-right-notification-wrapper-list-item-left">
                                    <div class="navbar-right-notification-wrapper-list-item-icon decline">
                                        <i class="fa-regular fa-bell"></i>
                                    </div>
                                </div>
                                <div class="navbar-right-notification-wrapper-list-item-content">
                                <span class="navbar-right-notification-wrapper-list-item-content-title">
                                    <strong><?php echo e(__('No Notification')); ?></strong>
                                </span>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        
        <?php
            $freelancer_notifications = \App\Models\FreelancerNotification::where('freelancer_id', Auth::guard('web')->user()->id)
                ->latest()->take(200)->get();

             $freelancer_new_notifications = \App\Models\FreelancerNotification::where('is_read', 'unread')
                ->where('freelancer_id', Auth::guard('web')->user()->id)
                ->latest()->get();
        ?>
        <div class="navbar-right-item">
            <div class="navbar-right-notification">
                <a href="javascript:void(0)" class="navbar-right-notification-icon">
                    <i class="fa-regular fa-bell"></i>
                    <?php if($freelancer_new_notifications->count() > 0): ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo e($freelancer_new_notifications->count() ?? 0); ?></span>
                    <?php endif; ?>
                </a>
                <div class="navbar-right-notification-wrapper">
                    <div class="navbar-right-notification-wrapper-list">
                        <?php if($freelancer_notifications->count() > 0): ?>
                            <?php $__currentLoopData = $freelancer_notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span href="javascript:void(0)"
                                      class="navbar-right-notification-wrapper-list-item click-notification">
                                    <div
                                            class="navbar-right-notification-wrapper-list-item-left show_and_read_freelancer_notification">
                                        <div class="navbar-right-notification-wrapper-list-item-icon decline">
                                            <?php if($notification->is_read == 'read'): ?>
                                                <i class="fa-regular fa-bell opacity-25 pe-none"></i>
                                            <?php else: ?>
                                                <i class="fa-regular fa-bell"></i>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="navbar-right-notification-wrapper-list-item-content">

                                        <?php if($notification->type == 'Offer'): ?>
                                            <a
                                                    href="<?php echo e(route('freelancer.offer.details', $notification->identity)); ?>">
                                                <span
                                                        class="navbar-right-notification-wrapper-list-item-content-title"><?php echo e(__($notification->message)); ?></span>
                                            </a>
                                            <span
                                                    class="navbar-right-notification-wrapper-list-item-content-time"><?php echo e($notification->created_at->toFormattedDateString()); ?></span>
                                        <?php endif; ?>

                                        <?php if($notification->type == 'Order'): ?>
                                            <a
                                                    href="<?php echo e(route('freelancer.order.details', $notification->identity)); ?>?mark_as_read=true">
                                                <span
                                                        class="navbar-right-notification-wrapper-list-item-content-title"><?php echo e(__($notification->message)); ?></span>
                                            </a>
                                            <span
                                                    class="navbar-right-notification-wrapper-list-item-content-time"><?php echo e($notification->created_at->toFormattedDateString()); ?></span>
                                        <?php endif; ?>

                                        <?php if($notification->type == 'Withdraw'): ?>
                                            <a href="<?php echo e(route('freelancer.wallet.withdraw.history')); ?>">
                                                <span
                                                        class="navbar-right-notification-wrapper-list-item-content-title"><?php echo e(__($notification->message)); ?></span>
                                            </a>
                                            <span
                                                    class="navbar-right-notification-wrapper-list-item-content-time"><?php echo e($notification->created_at->toFormattedDateString()); ?></span>
                                        <?php endif; ?>

                                        <?php if($notification->type == 'Reject Project'): ?>
                                            <a href="<?php echo e(route('freelancer.profile.details',Auth::guard('web')->user()->username)); ?>?mark_as_read=true">
                                                <span class="navbar-right-notification-wrapper-list-item-content-title"><?php echo e(__($notification->message)); ?></span>
                                            </a>
                                            <span class="navbar-right-notification-wrapper-list-item-content-time"><?php echo e($notification->created_at->toFormattedDateString()); ?></span>
                                        <?php endif; ?>
                                        <?php if($notification->type == 'Activate Project' || $notification->type == 'Inactivate Project' || $notification->type == 'Project' || $notification->type == 'Profile'): ?>
                                            <a href="<?php echo e(route('freelancer.profile.details',Auth::guard('web')->user()->username)); ?>?mark_as_read=true">
                                                <span class="navbar-right-notification-wrapper-list-item-content-title"><?php echo e(__($notification->message)); ?></span>
                                            </a>
                                            <span class="navbar-right-notification-wrapper-list-item-content-time"><?php echo e($notification->created_at->toFormattedDateString()); ?></span>
                                        <?php endif; ?>
                                        <?php if($notification->type == 'Email Verify'): ?>
                                            <a href="javascript:void(0)">
                                            <span class="navbar-right-notification-wrapper-list-item-content-title"><?php echo e(__($notification->message)); ?></span>
                                        </a>
                                            <span class="navbar-right-notification-wrapper-list-item-content-time"><?php echo e($notification->created_at->toFormattedDateString()); ?></span>
                                        <?php endif; ?>
                                        <?php if($notification->type == 'Account'): ?>
                                            <a href="javascript:void(0)">
                                                    <span class="navbar-right-notification-wrapper-list-item-content-title"><?php echo e(__($notification->message)); ?></span>
                                                </a>
                                            <span class="navbar-right-notification-wrapper-list-item-content-time"><?php echo e($notification->created_at->toFormattedDateString()); ?></span>
                                        <?php endif; ?>
                                        <?php if($notification->type == 'Identity Verify'): ?>
                                            <a href="javascript:void(0)">
                                                    <span class="navbar-right-notification-wrapper-list-item-content-title"><?php echo e(__($notification->message)); ?></span>
                                                </a>
                                            <span class="navbar-right-notification-wrapper-list-item-content-time"><?php echo e($notification->created_at->toFormattedDateString()); ?></span>
                                        <?php endif; ?>
                                        <?php if($notification->type == 'New Job'): ?>
                                            <?php $job_details = \App\Models\JobPost::select('id','user_id','slug')->where('id', $notification->identity)->first() ?>
                                            <?php if(isset($job_details)): ?>
                                                <a href="<?php echo e(route('job.details', ['username' => $job_details->job_creator?->username, 'slug' => $job_details->slug])); ?>">
                                                    <span class="navbar-right-notification-wrapper-list-item-content-title"><?php echo e(__($notification->message)); ?></span>
                                                </a>
                                            <?php endif; ?>
                                            <span class="navbar-right-notification-wrapper-list-item-content-time"><?php echo e($notification->created_at->toFormattedDateString()); ?></span>
                                        <?php endif; ?>
                                        <?php if($notification->type == 'Ticket Update' || $notification->type == 'Ticket'): ?>
                                            <a href="<?php echo e(route('freelancer.ticket.details',$notification->identity)); ?>">
                                                <span class="navbar-right-notification-wrapper-list-item-content-title"><?php echo e(__($notification->message)); ?></span>
                                            </a>
                                            <span class="navbar-right-notification-wrapper-list-item-content-time"><?php echo e($notification->created_at->toFormattedDateString()); ?></span>
                                        <?php endif; ?>
                                        <?php if($notification->type == 'Subscription'): ?>
                                            <a href="<?php echo e(route('freelancer.subscriptions.all')); ?>?mark_as_read=true">
                                                        <span class="navbar-right-notification-wrapper-list-item-content-title"><?php echo e(__($notification->message)); ?></span>
                                                    </a>
                                            <span class="navbar-right-notification-wrapper-list-item-content-time"><?php echo e($notification->created_at->toFormattedDateString()); ?></span>
                                        <?php endif; ?>
                                        <?php if($notification->type == 'Deposit'): ?>
                                            <a href="<?php echo e(route('freelancer.wallet.history')); ?>?mark_as_read=true">
                                                    <span class="navbar-right-notification-wrapper-list-item-content-title"><?php echo e(__($notification->message)); ?></span>
                                                    </a>
                                            <span class="navbar-right-notification-wrapper-list-item-content-time"><?php echo e($notification->created_at->toFormattedDateString()); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <a href="javascript:void(0)"
                               class="navbar-right-notification-wrapper-list-item click-notification">
                                <div class="navbar-right-notification-wrapper-list-item-left">
                                    <div class="navbar-right-notification-wrapper-list-item-icon decline">
                                        <i class="fa-regular fa-bell"></i>
                                    </div>
                                </div>
                                <div class="navbar-right-notification-wrapper-list-item-content">
                                    <span class="navbar-right-notification-wrapper-list-item-content-title">
                                        <strong><?php echo e(__('No Notification')); ?></strong>
                                    </span>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/components/frontend/menu-notification.blade.php ENDPATH**/ ?>