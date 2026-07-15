<div class="dashboard__left dashboard-left-content">
    <div class="dashboard__left__main">
        <div class="dashboard__left__close close-bars"> <i class="fa-solid fa-times"></i> </div>
        <div class="dashboard__top">
            <div class="dashboard__top__logo">
                <a href="<?php echo e(route('admin.dashboard')); ?>">
                    <?php if(!empty(get_static_option('site_white_logo'))): ?>
                        <?php echo render_image_markup_by_attachment_id(get_static_option('site_white_logo')); ?>

                    <?php else: ?>
                        <img src="<?php echo e(asset('assets/static/img/logo/dashboard_logo.png')); ?>" alt="dashboard-logo">
                    <?php endif; ?>
                </a>
            </div>
        </div>
        <div class="sidebar-search">
            <div class="search-input-wrapper">
                <i class="fa-solid fa-search search-icon"></i>
                <input type="text" class="search-input" id="sidebar-search" placeholder="<?php echo e(__('Search menu...')); ?>" autocomplete="off">
            </div>
        </div>
        <div class="dashboard__bottom mt-3">
            <div class="no-results" id="no-results-message">
                <i class="fa-solid fa-search" style="font-size: 24px; margin-bottom: 10px; opacity: 0.5;"></i>
                <p><?php echo e(__('No menu items found')); ?></p>
            </div>
            <ul class="dashboard__bottom__list dashboard-list">
                <!-- Dashboard -->
                <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.dashboard'])): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('admin.dashboard')); ?>"> <i class="fa-solid fa-chart-simple"></i><?php echo e(__('Dashboard')); ?></a>
                </li>

                <!-- User Management -->
                <li class="dashboard__bottom__list__item has-children <?php if(request()->is('admin/manage*') || request()->is('admin/role*') || (request()->is('admin/user*') && !request()->is('admin/user-report*')) || request()->is('admin/can-contact*')): ?> active open show <?php endif; ?>">
                    <a href="javascript:void(0)"> <i class="fa-solid fa-users"></i> <?php echo e(__('User Management')); ?></a>
                    <ul class="submenu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin-role-manage')): ?>
                            <li class="dashboard__bottom__list__item has-children <?php if(request()->is('admin/manage*') || request()->is('admin/role*')): ?> active open show <?php endif; ?>">
                                <a href="javascript:void(0)"> <i class="fa-solid fa-user-shield"></i> <?php echo e(__('Admin Role Manage')); ?></a>
                                <ul class="submenu">
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.create'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.create')); ?>"> <?php echo e(__('Add New Admin')); ?> </a>
                                    </li>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.all'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.all')); ?>"> <?php echo e(__('All Admins')); ?> </a>
                                    </li>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.role.create'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.role.create')); ?>"> <?php echo e(__('All Roles')); ?> </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>

                            <li class="dashboard__bottom__list__item has-children <?php if(request()->is('admin/user*') && !request()->is('admin/user-report*')): ?> active open show <?php endif; ?>">
                            <a href="javascript:void(0)"> <i class="fa-solid fa-users-line"></i> <?php echo e(__('User Manage')); ?></a>
                            <ul class="submenu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-list')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.freelancer.all'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.freelancer.all')); ?>"> <?php echo e(__('All Freelancers')); ?> </a>
                                    </li>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.client.all'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.client.all')); ?>"> <?php echo e(__('All Clients')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-trash-list')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.user.restore'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.user.restore')); ?>"> <?php echo e(__('Trash List')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-identity-verify-request-list')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.user.verification.request'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.user.verification.request')); ?>">
                                            <?php echo e(__('Identity Verify Requests')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.user.add'])): ?> selected <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.user.add')); ?>">
                                        <?php echo e(__('Add New User')); ?> </a>
                                </li>
                                <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.email.send.to.all.users'])): ?> selected <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.email.send.to.all.users')); ?>">
                                        <?php echo e(__('Email To All User')); ?> </a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="dashboard__bottom__list__item has-children <?php if(request()->is('admin/can-contact*')): ?> active open show <?php endif; ?>">
                            <a href="javascript:void(0)"> <i class="fa-solid fa-comments"></i> <?php echo e(__('User Chatting Access')); ?></a>
                            <ul class="submenu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-list')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.check.contact.availability'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.check.contact.availability')); ?>"> <?php echo e(__('Setting')); ?> </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    </ul>
                </li>

                <!-- Location Management -->
                <li class="dashboard__bottom__list__item has-children <?php if(request()->is('admin/location*')): ?> active open show <?php endif; ?>">
                    <a href="javascript:void(0)"> <i class="fa-solid fa-earth-americas"></i> <?php echo e(__('Location Management')); ?></a>
                    <ul class="submenu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('country-list')): ?>
                            <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.country.all'])): ?> selected <?php endif; ?>">
                                <a href="<?php echo e(route('admin.country.all')); ?>"> <?php echo e(__('Country')); ?> </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('country-csv-file-import')): ?>
                            <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.country.import.csv.settings'])): ?> selected <?php endif; ?>">
                                <a href="<?php echo e(route('admin.country.import.csv.settings')); ?>"> <?php echo e(__('Import Country')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('state-list')): ?>
                            <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.state.all'])): ?> selected <?php endif; ?>">
                                <a href="<?php echo e(route('admin.state.all')); ?>"> <?php echo e(__('State')); ?> </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('state-csv-file-import')): ?>
                            <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.state.import.csv.settings'])): ?> selected <?php endif; ?>">
                                <a href="<?php echo e(route('admin.state.import.csv.settings')); ?>"> <?php echo e(__('Import States')); ?> </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('city-list')): ?>
                            <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.city.all'])): ?> selected <?php endif; ?>">
                                <a href="<?php echo e(route('admin.city.all')); ?>"> <?php echo e(__('City')); ?> </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('city-csv-file-import')): ?>
                            <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.city.import.csv.settings'])): ?> selected <?php endif; ?>">
                                <a href="<?php echo e(route('admin.city.import.csv.settings')); ?>"> <?php echo e(__('Import Cities')); ?> </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('city-list')): ?>
                            <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.neighborhood.all'])): ?> selected <?php endif; ?>">
                                <a href="<?php echo e(route('admin.neighborhood.all')); ?>"> <?php echo e(__('Neighborhood')); ?> </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('city-csv-file-import')): ?>
                            <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.neighborhood.import.csv.settings'])): ?> selected <?php endif; ?>">
                                <a href="<?php echo e(route('admin.neighborhood.import.csv.settings')); ?>"> <?php echo e(__('Import Neighborhoods')); ?> </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>

                <!-- Catalog Management -->
                <li class="dashboard__bottom__list__item has-children <?php if(request()->is('admin/service*')): ?> active open show <?php endif; ?>">
                    <a href="javascript:void(0)"> <i class="fa-solid fa-list"></i><?php echo e(__('Catalog Management')); ?> </a>
                    <ul class="submenu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category-list')): ?>
                            <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.category.all'])): ?> selected <?php endif; ?>">
                                <a href="<?php echo e(route('admin.category.all')); ?>"> <?php echo e(__('Category')); ?> </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('subcategory-list')): ?>
                            <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.subcategory.all'])): ?> selected <?php endif; ?>">
                                <a href="<?php echo e(route('admin.subcategory.all')); ?>"> <?php echo e(__('Sub Category')); ?> </a>
                            </li>
                        <?php endif; ?>
                        <?php if(moduleExists('CoinPaymentGateway')): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category-list')): ?>
                                <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.category.select'])): ?> selected <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.category.select')); ?>"> <?php echo e(__('Select Navbar Category')); ?> </a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.category.enable.disable.settings'])): ?> selected <?php endif; ?>">
                            <a href="<?php echo e(route('admin.category.enable.disable.settings')); ?>"> <?php echo e(__('Enable Disable Section')); ?> </a>
                        </li>
                        <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.category.empty.settings'])): ?> selected <?php endif; ?>">
                            <a href="<?php echo e(route('admin.category.empty.settings')); ?>"> <?php echo e(__('Empty Category Settings')); ?> </a>
                        </li>
                    </ul>
                </li>

                <!-- Services & Projects -->
                <li class="dashboard__bottom__list__item has-children <?php if(request()->is('admin/feedback*') || request()->is('admin/skill*') || request()->is('admin/length*') || request()->is('admin/experience*') || request()->is('admin/project*') || request()->is('admin/job*')): ?> active open show <?php endif; ?>">
                    <a href="javascript:void(0)"> <i class="fa-solid fa-briefcase"></i><?php echo e(__('Services & Projects')); ?></a>
                    <ul class="submenu">
                        <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.feedback.all'])): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('admin.feedback.all')); ?>"> <i class="fa-solid fa-comment-dots"></i><?php echo e(__('Feedback Manage')); ?></a>
                        </li>
                        
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('skill-list')): ?>
                            <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.skill'])): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('admin.skill')); ?>"> <i class="fa-solid fa-user-gear"></i><?php echo e(__('Skills')); ?></a>
                            </li>
                        <?php endif; ?>
                        
                        <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.length.all'])): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('admin.length.all')); ?>"> <i class="fa-regular fa-clock"></i><?php echo e(__('Job & Project Length')); ?></a>
                        </li>
                        
                        <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.experience.level.all'])): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('admin.experience.level.all')); ?>"> <i class="fa-solid fa-user-gear"></i><?php echo e(__('Experience Level')); ?></a>
                        </li>
                        
                        <li class="dashboard__bottom__list__item has-children <?php if(request()->is('admin/project*')): ?> active open show <?php endif; ?>">
                            <a href="javascript:void(0)"> <i class="fa-solid fa-file-word"></i><?php echo e(__('Projects')); ?> </a>
                            <ul class="submenu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('project-list')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.project'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.project')); ?>"> <?php echo e(__('All Projects')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('project-history-list')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.project.history'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.project.history')); ?>"> <?php echo e(__('Project History')); ?> </a>
                                    </li>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.project.approval.settings'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.project.approval.settings')); ?>"> <?php echo e(__('Auto Approval Settings')); ?> </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        
                        <li class="dashboard__bottom__list__item has-children <?php if(request()->is('admin/job*')): ?> active open show <?php endif; ?>">
                            <a href="javascript:void(0)"> <i class="fa-solid fa-file-word"></i><?php echo e(__('Jobs')); ?> </a>
                            <ul class="submenu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('job-auto-approval')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.job.approval.settings'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.job.approval.settings')); ?>"> <?php echo e(__('Auto Approval Settings')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.job.country.restriction.settings'])): ?> selected <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.job.country.restriction.settings')); ?>"> <?php echo e(__('Country Restriction Settings')); ?></a>
                                </li>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('job-list')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.jobs'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.jobs')); ?>"> <?php echo e(__('All Jobs')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('job-history-list')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.job.history'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.job.history')); ?>"> <?php echo e(__('Job History')); ?> </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    </ul>
                </li>

                <!-- Financial Management -->
                <li class="dashboard__bottom__list__item has-children <?php if(request()->is('admin/wallet*') || request()->is('admin/withdraw*') || request()->is('admin/subscription*') || request()->is('admin/transaction*')): ?> active open show <?php endif; ?>">
                    <a href="javascript:void(0)"> <i class="fa-solid fa-money-bill-wave"></i><?php echo e(__('Financial Management')); ?></a>
                    <ul class="submenu">
                        <li class="dashboard__bottom__list__item has-children <?php if(request()->is('admin/wallet*')): ?> active open show <?php endif; ?>">
                            <a href="javascript:void(0)"> <i class="fa-solid fa-wallet"></i>
                                <?php echo e(__('Wallet')); ?>

                                <?php if(unread_deposit_count() > 0): ?>
                                    <span class="badge bg-danger"><?php echo e(unread_deposit_count()); ?></span>
                                <?php endif; ?>
                            </a>
                            <ul class="submenu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('deposit-settings-view')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.wallet.deposit.settings'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.wallet.deposit.settings')); ?>">
                                            <?php echo e(__('Maximum Deposit Settings')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('deposit-list')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.wallet.history'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.wallet.history')); ?>">
                                            <?php echo e(__('Wallet History')); ?>

                                            <?php if(unread_deposit_count() > 0): ?>
                                                <span class="badge bg-danger"><?php echo e(unread_deposit_count()); ?></span>
                                            <?php endif; ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        
                        <li class="dashboard__bottom__list__item has-children <?php if(request()->is('admin/withdraw*')): ?> active open show <?php endif; ?>">
                            <a href="javascript:void(0)"> <i class="fa-solid fa-money-bill-transfer"></i>
                                <?php echo e(__('Withdraw')); ?>

                                <?php if(unread_withdraw_count() > 0): ?>
                                    <span class="badge bg-danger"><?php echo e(unread_withdraw_count()); ?></span>
                                <?php endif; ?>
                            </a>
                            <ul class="submenu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('withdraw-settings-view')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.wallet.withdraw.settings'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.wallet.withdraw.settings')); ?>"> <?php echo e(__('Withdraw Settings')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('withdraw-payment-gateway-list')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.wallet.withdraw.gateway'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.wallet.withdraw.gateway')); ?>">
                                            <?php echo e(__('Withdraw Payment Gateway')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('withdraw-list')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.wallet.withdraw.request'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.wallet.withdraw.request')); ?>">
                                            <?php echo e(__('Withdraw Request')); ?>

                                            <?php if(unread_withdraw_count() > 0): ?>
                                                <span class="badge bg-danger"><?php echo e(unread_withdraw_count()); ?></span>
                                            <?php endif; ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        
                        <li class="dashboard__bottom__list__item has-children <?php if(request()->is('admin/subscription*')): ?> active open show <?php endif; ?>">
                            <a href="javascript:void(0)"> <i class="fa-solid fa-credit-card"></i><?php echo e(__('Subscription Manage')); ?></a>
                            <ul class="submenu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('subscription-type-list')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.subscription.type.all'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.subscription.type.all')); ?>"> <?php echo e(__('Subscription Type')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('subscription-list')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.subscription.all', 'admin.subscription.add', 'admin.subscription.edit'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.subscription.all')); ?>"> <?php echo e(__('All Subscriptions')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('subscription-connect-settings-view')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.subscription.limit.settings'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.subscription.limit.settings')); ?>">
                                            <?php echo e(__('Subscription Connect Settings')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-subscription-list')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.user.subscription.all'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.user.subscription.all')); ?>"> <?php echo e(__('User Subscriptions')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.free.subscription.settings'])): ?> selected <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.free.subscription.settings')); ?>">
                                        <?php echo e(__('Free Subscription Settings')); ?> </a>
                                </li>
                                <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.subscription.enable.disable.settings'])): ?> selected <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.subscription.enable.disable.settings')); ?>">
                                        <?php echo e(__('Subscription Enable Disable')); ?> </a>
                                </li>
                                <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.subscription.chat.enable.disable.settings'])): ?> selected <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.subscription.chat.enable.disable.settings')); ?>">
                                        <?php echo e(__('Subscription Chat Enable Disable')); ?> </a>
                                </li>
                                <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.subscription.expire.enable.disable.settings'])): ?> selected <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.subscription.expire.enable.disable.settings')); ?>">
                                        <?php echo e(__('Subscription Reminder Settings')); ?> </a>
                                </li>
                            </ul>
                        </li>
                        
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('transaction-manage')): ?>
                            <li class="dashboard__bottom__list__item has-children <?php if(request()->is('admin/transaction*')): ?> active open show <?php endif; ?>">
                                <a href="javascript:void(0)"> <i class="fa-solid fa-file-invoice-dollar"></i><?php echo e(__('Transaction Manage')); ?></a>
                                <ul class="submenu">
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.commission.settings'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.commission.settings')); ?>">
                                            <?php echo e(__('Admin Commission Settings')); ?> </a>
                                    </li>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.transaction.fee.settings'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.transaction.fee.settings')); ?>">
                                            <?php echo e(__('Transaction Fee Settings')); ?> </a>
                                    </li>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.withdraw.fee.settings'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.withdraw.fee.settings')); ?>">
                                            <?php echo e(__('Withdraw Fee Settings')); ?> </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>

                <!-- Order Management -->
                <li class="dashboard__bottom__list__item has-children <?php if(request()->is('admin/order*') || request()->is('admin/user-report*')): ?> active open show <?php endif; ?>">
                    <a href="javascript:void(0)"> <i class="fa-solid fa-cart-shopping"></i><?php echo e(__('Order Management')); ?></a>
                    <ul class="submenu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order-list')): ?>
                            <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.order.all'])): ?> selected <?php endif; ?>">
                                <a href="<?php echo e(route('admin.order.all')); ?>"> <?php echo e(__('All Orders')); ?> </a>
                            </li>
                            <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.order.enable.disable.description.settings'])): ?> selected <?php endif; ?>">
                                <a href="<?php echo e(route('admin.order.enable.disable.description.settings')); ?>"> <?php echo e(__('Order Description Settings')); ?> </a>
                            </li>
                            <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.order.enable.disable.milestone.settings'])): ?> selected <?php endif; ?>">
                                <a href="<?php echo e(route('admin.order.enable.disable.milestone.settings')); ?>"> <?php echo e(__('Order Milestone Settings')); ?> </a>
                            </li>
                            <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.order.approval.settings'])): ?> selected <?php endif; ?>">
                                <a href="<?php echo e(route('admin.order.approval.settings')); ?>">
                                    <?php echo e(__('Auto Approval Settings')); ?> </a>
                            </li>
                        <?php endif; ?>
                        
                        <li class="dashboard__bottom__list__item has-children <?php if(request()->is('admin/user-report*')): ?> active open show <?php endif; ?>">
                            <a href="javascript:void(0)"> <i class="fa-solid fa-flag"></i><?php echo e(__('User Report Manage')); ?> </a>
                            <ul class="submenu">
                                <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.user.report.all'])): ?> selected <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.user.report.all')); ?>"> <?php echo e(__('All Reports')); ?> </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <!-- Emergency SOS -->
                <li class="dashboard__bottom__list__item <?php if(request()->is('admin/emergency*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('admin.emergency.index')); ?>">
                        <i class="fa-solid fa-truck-medical"></i>
                        <?php echo e(__('Emergency SOS')); ?>

                    </a>
                </li>

                <!-- Reels Management -->
                <li class="dashboard__bottom__list__item <?php if(request()->is('admin/reels*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('admin.reels.all')); ?>">
                        <i class="fa-solid fa-video"></i>
                        <?php echo e(__('Reels Management')); ?>

                    </a>
                </li>

                <!-- Communication -->
                <li class="dashboard__bottom__list__item has-children <?php if(request()->is('admin/newsletter*') || request()->is('admin/blog*') || request()->is('admin/support-ticket*') || request()->is('admin/notification*') || request()->routeIs(['admin.pusher.settings'])): ?> active open show <?php endif; ?>">
                    <a href="javascript:void(0)"> <i class="fa-solid fa-comments"></i><?php echo e(__('Communication')); ?></a>
                    <ul class="submenu">
                        <li class="dashboard__bottom__list__item has-children <?php if(request()->is('admin/newsletter*')): ?> active open show <?php endif; ?>">
                            <a href="javascript:void(0)"> <i class="fa-solid fa-envelope-open-text"></i><?php echo e(__('Newsletter Manage')); ?> </a>
                            <ul class="submenu">
                                <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.newsletter.email.all'])): ?> selected <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.newsletter.email.all')); ?>"> <?php echo e(__('All Emails')); ?> </a>
                                </li>
                                <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.newsletter.email.send.to.all'])): ?> selected <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.newsletter.email.send.to.all')); ?>"> <?php echo e(__('Email to All')); ?> </a>
                                </li>
                            </ul>
                        </li>
                        
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog-list')): ?>
                            <li class="dashboard__bottom__list__item has-children <?php if(request()->is('admin/blog*')): ?> active open show <?php endif; ?>">
                                <a href="javascript:void(0)"> <i class="fa fa-blog"></i> <?php echo e(__('Blog Manage')); ?> </a>
                                <ul class="submenu">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog-list')): ?>
                                        <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.blog.all'])): ?> selected <?php endif; ?>">
                                            <a href="<?php echo e(route('admin.blog.all')); ?>"> <?php echo e(__('All Blogs')); ?> </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog-add')): ?>
                                        <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.blog.create'])): ?> selected <?php endif; ?>">
                                            <a href="<?php echo e(route('admin.blog.create')); ?>"> <?php echo e(__('Add New Blog')); ?> </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                        
                        <li class="dashboard__bottom__list__item has-children <?php if(request()->is('admin/support-ticket/*')): ?> active open show <?php endif; ?>">
                            <a href="javascript:void(0)"> <i class="fa-solid fa-headset"></i><?php echo e(__('Support')); ?> </a>
                            <ul class="submenu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('department-list')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.department'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.department')); ?>"> <?php echo e(__('Department')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('support-ticket-list')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.ticket'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.ticket')); ?>"> <?php echo e(__('Support Ticket')); ?> </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        
                        <li class="dashboard__bottom__list__item has-children <?php if(request()->is('admin/notification/*')): ?> active open show <?php endif; ?>">
                            <a href="javascript:void(0)"> <i class="fa-solid fa-bell"></i><?php echo e(__('Notifications')); ?> </a>
                            <ul class="submenu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('notification-list')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.notification.all'])): ?> active <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.notification.all')); ?>"> <?php echo e(__('All Notifications')); ?></a>
                                    </li>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.notification.settings'])): ?> active <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.notification.settings')); ?>"> <?php echo e(__('Notification Settings')); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        
                        <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.pusher.settings'])): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('admin.pusher.settings')); ?>"> <i class="fa-regular fa-message"></i><?php echo e(__('Chat Settings')); ?></a>
                        </li>
                    </ul>
                </li>

                <!-- Site Settings -->
                <li class="dashboard__bottom__list__item has-children <?php if(request()->is('admin/page-settings*') || request()->is('admin/general-settings*') || request()->is('admin/payment-settings*') || request()->is('admin/plugins*') || request()->is('admin/additional-settings*')): ?> active open show <?php endif; ?>">
                    <a href="javascript:void(0)"> <i class="fa-solid fa-gear"></i> <?php echo e(__('Site Settings')); ?></a>
                    <ul class="submenu">
                        <li class="dashboard__bottom__list__item has-children <?php if(request()->is('admin/page-settings*')): ?> active open show <?php endif; ?>">
                            <a href="javascript:void(0)"> <i class="fa-solid fa-file-lines"></i> <?php echo e(__('Page Settings')); ?> </a>
                            <ul class="submenu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('login-page-settings-view')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.page.settings.login'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.page.settings.login')); ?>"> <?php echo e(__('Login Page Settings')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('register-page-settings-view')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.page.settings.register'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.page.settings.register')); ?>">
                                            <?php echo e(__('Register Page Settings')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.page.settings.register.recaptcha'])): ?> selected <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.page.settings.register.recaptcha')); ?>">
                                        <?php echo e(__('Register Recaptcha Settings')); ?> </a>
                                </li>
                                <li class="dashboard__bottom__list__item has-children <?php if(request()->is('admin/page-settings/account*')): ?> active open show <?php endif; ?>">
                                    <a href="javascript:void(0)"> <?php echo e(__('Account Settings')); ?> </a>
                                    <ul class="submenu">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('account-page-settings-view')): ?>
                                            <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.page.account.main.page'])): ?> selected <?php endif; ?>">
                                                <a href="<?php echo e(route('admin.page.account.main.page')); ?>">
                                                    <?php echo e(__('Account Page Settings')); ?> </a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('introduction-page-settings-view')): ?>
                                            <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.page.account.introduction'])): ?> selected <?php endif; ?>">
                                                <a href="<?php echo e(route('admin.page.account.introduction')); ?>">
                                                    <?php echo e(__('Introduction Settings')); ?> </a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('experience-page-settings-view')): ?>
                                            <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.page.account.experience'])): ?> selected <?php endif; ?>">
                                                <a href="<?php echo e(route('admin.page.account.experience')); ?>">
                                                    <?php echo e(__('Experience Settings')); ?> </a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('education-page-settings-view')): ?>
                                            <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.page.account.education'])): ?> selected <?php endif; ?>">
                                                <a href="<?php echo e(route('admin.page.account.education')); ?>">
                                                    <?php echo e(__('Education Settings')); ?> </a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('work-page-settings-view')): ?>
                                            <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.page.account.work'])): ?> selected <?php endif; ?>">
                                                <a href="<?php echo e(route('admin.page.account.work')); ?>"> <?php echo e(__('Work Settings')); ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('skill-page-settings-view')): ?>
                                            <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.page.account.skill'])): ?> selected <?php endif; ?>">
                                                <a href="<?php echo e(route('admin.page.account.skill')); ?>"> <?php echo e(__('Skill Settings')); ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('photo-page-settings-view')): ?>
                                            <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.page.account.rate.photo'])): ?> selected <?php endif; ?>">
                                                <a href="<?php echo e(route('admin.page.account.rate.photo')); ?>">
                                                    <?php echo e(__('Rate & Photo Settings')); ?> </a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="dashboard__bottom__list__item has-children <?php if(request()->is('admin/general-settings*')): ?> active open show <?php endif; ?>">
                            <a href="javascript:void(0)"> <i class="fa-solid fa-sliders"></i> <?php echo e(__('General Settings')); ?></a>
                            <ul class="submenu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('reading')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.general.settings.reading'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.general.settings.reading')); ?>"> <?php echo e(__('Reading')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('navbar-global-variant')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.general.settings.navbar.global.variant'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.general.settings.navbar.global.variant')); ?>">
                                            <?php echo e(__('Navbar Global Variant')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('footer-global-variant')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.general.settings.footer.global.variant'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.general.settings.footer.global.variant')); ?>">
                                            <?php echo e(__('Footer Global Variant')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('site-identity')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.general.settings.site.identity'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.general.settings.site.identity')); ?>">
                                            <?php echo e(__('Site Identity')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('basic-settings')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.general.settings.basic'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.general.settings.basic')); ?>"> <?php echo e(__('Basic Settings')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('color-settings')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.general.settings.color'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.general.settings.color')); ?>"> <?php echo e(__('Color Settings')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('typography-settings')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.general.settings.typography'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.general.settings.typography')); ?>">
                                            <?php echo e(__('Typography Settings')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('seo-settings')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.general.settings.seo'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.general.settings.seo')); ?>"> <?php echo e(__('Seo Settings')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('third-party-script-settings')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.general.settings.third.party.script'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.general.settings.third.party.script')); ?>">
                                            <?php echo e(__('Third Party Scripts')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('social-login-settings')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.general.settings.social.login'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.general.settings.social.login')); ?>"> <?php echo e(__('Social Login')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('email-template-settings')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.general.settings.email.template'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.general.settings.email.template')); ?>">
                                            <?php echo e(__('Email Template')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('smtp-settings')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.general.settings.smtp'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.general.settings.smtp')); ?>"> <?php echo e(__('SMTP Settings')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('custom-css-settings')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.general.settings.custom.css'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.general.settings.custom.css')); ?>"> <?php echo e(__('Custom CSS')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('custom-js-settings')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.general.settings.custom.js'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.general.settings.custom.js')); ?>"> <?php echo e(__('Custom JS')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('gdpr-settings')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.general.settings.gdpr'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.general.settings.gdpr')); ?>"> <?php echo e(__('GDPR Settings')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cache-settings')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.general.settings.cache'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.general.settings.cache')); ?>"> <?php echo e(__('Cache Settings')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('database-upgrade')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.general.settings.database.upgrade'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.general.settings.database.upgrade')); ?>">
                                            <?php echo e(__('Database Upgrade')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('generate-license-key')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.license.settings'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.license.settings')); ?>">
                                            <?php echo e(__('License Settings')); ?> </a>
                                    </li>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.software.update.settings'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.software.update.settings')); ?>">
                                            <?php echo e(__('Check Update')); ?> </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        
                        <li class="dashboard__bottom__list__item has-children <?php if(request()->is('admin/payment-settings*')): ?> active open show <?php endif; ?>">
                            <a href="javascript:void(0)"> <i class="fa-solid fa-credit-card"></i>
                                <?php echo e(__('Payment Settings')); ?></a>
                            <ul class="submenu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('payment-info-settings')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.payment.settings.info'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.payment.settings.info')); ?>"> <?php echo e(__('Payment Info Settings')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('payment-gateway-settings')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.payment.settings.gateway'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.payment.settings.gateway')); ?>">
                                            <?php echo e(__('Payment Gateway Settings')); ?> </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        
                        <li class="dashboard__bottom__list__item has-children <?php if(request()->is('admin/plugins*')): ?> active open show <?php endif; ?>">
                            <a href="javascript:void(0)"> <i class="fa-solid fa-palette"></i> <?php echo e(__('Appearance Settings')); ?></a>
                            <ul class="submenu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('menu-list')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.menu']) || request()->routeIs(['admin.menu.edit'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.menu')); ?>"> <?php echo e(__('Menu Builder')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('form-list')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.form', 'admin.form.edit'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.form')); ?>"> <?php echo e(__('Form Builder')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('widget-list')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.widget'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.widget')); ?>"> <?php echo e(__('Widget Builder')); ?> </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        
                        <li class="dashboard__bottom__list__item has-children <?php if(request()->is('admin/additional-settings*')): ?> active open show <?php endif; ?>">
                            <a href="javascript:void(0)"> <i class="fa-solid fa-plus"></i><?php echo e(__('Additional Settings')); ?></a>
                            <ul class="submenu">
                                <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.loader.settings'])): ?> selected <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.loader.settings')); ?>">
                                        <?php echo e(__('Loader Settings')); ?> </a>
                                </li>
                                <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.mouse.settings'])): ?> selected <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.mouse.settings')); ?>">
                                        <?php echo e(__('Mouse Pointer Settings')); ?> </a>
                                </li>


                                <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.Freelancer-earning.settings'])): ?> selected <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.user.earning.toggle.settings')); ?>">
                                        <?php echo e(__('Freelancer Earning Hide/Show Settings')); ?> </a>
                                </li>

                                <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.bottom.to.top.settings'])): ?> selected <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.bottom.to.top.settings')); ?>">
                                        <?php echo e(__('Bottom to Top Button Settings')); ?> </a>
                                </li>
                                <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.sticky.menu.settings'])): ?> selected <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.sticky.menu.settings')); ?>">
                                        <?php echo e(__('Sticky Menu Settings')); ?> </a>
                                </li>
                                <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.commission.display.settings'])): ?> selected <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.commission.display.settings')); ?>">
                                        <?php echo e(__('Display Commission Settings')); ?> </a>
                                </li>
                                <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.home.animation.settings'])): ?> selected <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.home.animation.settings')); ?>">
                                        <?php echo e(__('Home Page Animation Settings')); ?> </a>
                                </li>
                                <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.project.enable.disable.settings'])): ?> selected <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.project.enable.disable.settings')); ?>">
                                        <?php echo e(__('Project Enable Disable')); ?> </a>
                                </li>
                                <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.job.enable.disable.settings'])): ?> selected <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.job.enable.disable.settings')); ?>">
                                        <?php echo e(__('Job Enable Disable')); ?> </a>
                                </li>
                                <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.state.filter.enable.disable.settings'])): ?> selected <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.state.filter.enable.disable.settings')); ?>">
                                        <?php echo e(__('State Filter Enable Disable')); ?> </a>
                                </li>
                                <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.chat.email.settings'])): ?> selected <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.chat.email.settings')); ?>">
                                        <?php echo e(__('Chat Email Enable Disable')); ?> </a>
                                </li>
                                <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.file.extension.settings'])): ?> selected <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.file.extension.settings')); ?>">
                                        <?php echo e(__('File Extension Settings')); ?> </a>
                                </li>
                                <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.profile.switch.settings'])): ?> selected <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.profile.switch.settings')); ?>">
                                        <?php echo e(__('Profile Switch Settings')); ?> </a>
                                </li>
                                <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.user.email.verify.settings'])): ?> selected <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.user.email.verify.settings')); ?>">
                                        <?php echo e(__('Email Verification Settings')); ?> </a>
                                </li>
                                <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.user.identity.verify.settings'])): ?> selected <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.user.identity.verify.settings')); ?>">
                                        <?php echo e(__('User Identity Verification Settings')); ?> </a>
                                </li>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin-login-url-prefix')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.url.prefix.settings'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.url.prefix.settings')); ?>">
                                            <?php echo e(__('Admin URL Prefix Settings')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.mobile.app.banner.settings'])): ?> selected <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.mobile.app.banner.settings')); ?>">
                                        <?php echo e(__('Banner Settings')); ?> </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <!-- Content Management -->
                <li class="dashboard__bottom__list__item has-children <?php if(request()->is('admin/email-template*') || request()->is('admin/dynamic-pages*') || request()->is(['admin/faq*']) || request()->is(['admin/languages*'])): ?> active open show <?php endif; ?>">
                    <a href="javascript:void(0)"> <i class="fa-solid fa-file-lines"></i> <?php echo e(__('Content Management')); ?></a>
                    <ul class="submenu">
                        <li class="dashboard__bottom__list__item has-children <?php if(request()->is('admin/email-template*')): ?> active open show <?php endif; ?>">
                            <a href="javascript:void(0)"> <i class="fa-solid fa-envelope"></i> <?php echo e(__('Email Template')); ?></a>
                            <ul class="submenu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('email-template-list')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.email.template.all'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.email.template.all')); ?>"> <?php echo e(__('All Templates')); ?> </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        
                        <li class="dashboard__bottom__list__item has-children <?php if(request()->is('admin/dynamic-pages*')): ?> active open show <?php endif; ?>">
                            <a href="javascript:void(0)"> <i class="fa-solid fa-file-circle-plus"></i> <?php echo e(__('Pages')); ?></a>
                            <ul class="submenu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page-list')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.page.all'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.page.all')); ?>"> <?php echo e(__('All Pages')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page-create-new')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.page.new'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.page.new')); ?>"> <?php echo e(__('Add New Page')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage-404-page')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.page.404'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.page.404')); ?>"> <?php echo e(__('Manage 404 Page')); ?> </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage-maintenance-page')): ?>
                                    <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.page.maintenance'])): ?> selected <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.page.maintenance')); ?>"> <?php echo e(__('Manage Maintenance Page')); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        
                        <li class="dashboard__bottom__list__item <?php if(request()->is(['admin/faq*'])): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('admin.faq.all')); ?>"> <i class="fa-solid fa-question"></i><?php echo e(__('Faq')); ?></a>
                        </li>
                        
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('language-list')): ?>
                            <li class="dashboard__bottom__list__item <?php if(request()->is(['admin/languages*'])): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('admin.languages')); ?>"> <i class="fa-solid fa-language"></i><?php echo e(__('Languages')); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>

                <!-- Integrations -->
                <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.integration'])): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('admin.integration')); ?>"> <i class="fa-solid fa-plug"></i><?php echo e(__('Integrations')); ?></a>
                </li>

                <!-- Plugin Management -->
                <?php if(moduleExists('PluginManage')): ?>
                    <li class="dashboard__bottom__list__item has-children <?php if(request()->is('admin/plugin-manage*')): ?> active open <?php endif; ?>">
                        <a href="javascript:void(0)"> <i class="fa-solid fa-puzzle-piece"></i> <?php echo e(__('Plugin Manage')); ?> </a>
                        <ul class="submenu">
                            <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.plugin.manage.all'])): ?> selected <?php endif; ?>">
                                <a href="<?php echo e(route('admin.plugin.manage.all')); ?>"> <?php echo e(__('All Plugins')); ?> </a>
                            </li>
                            <li class="dashboard__bottom__list__item <?php if(request()->routeIs(['admin.plugin.manage.new'])): ?> selected <?php endif; ?>">
                                <a href="<?php echo e(route('admin.plugin.manage.new')); ?>"> <?php echo e(__('Add Plugin')); ?> </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <!-- Dynamic Modules -->
                <?php
                    $all_modules_route = (new \App\Helper\ModuleMetaData())->getAllExternalMenu() ?? [];
                ?>
                <?php $__currentLoopData = $all_modules_route; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $externalMenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $flag = false;
                        $activeRoutes = array_column((array) $externalMenu, 'route');
                    ?>

                    <?php $__currentLoopData = $externalMenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $individual_menu_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $convert_to_array = (array) $individual_menu_item;
                            $convert_to_array['label'] = __($convert_to_array['label']);
                            if (array_key_exists('permissions', $convert_to_array) && !is_array($convert_to_array['permissions'])) {
                                $convert_to_array['permissions'] = [$convert_to_array['permissions']];
                            }
                            $routeName = $convert_to_array['route'];
                            $icon = array_key_exists('icon', $convert_to_array) ? $convert_to_array['icon'] : '';
                        ?>
                        <?php if(count($externalMenu) > 1): ?>
                            <?php if($key === 0): ?>
                                <li class="dashboard__bottom__list__item has-children <?php if(in_array(\Request::route()->getName(), $activeRoutes)): ?> active open <?php endif; ?>">
                            <?php endif; ?>
                                    <?php if(empty($convert_to_array['parent']) && !$flag): ?>
                                        <?php
                                            $flag = true;
                                        ?>
                                        <a href="javascript:void(0)">
                                            <i class="<?php echo e($icon); ?>"></i>
                                            <span class="icon_title"><?php echo e($convert_to_array['label']); ?> <span class="badge bg-danger"><?php echo e(__('Plugin')); ?></span> </span>
                                        </a>
                                        <ul class="submenu" style=" <?php if(in_array(\Request::route()->getName(), $activeRoutes)): ?> display:block; <?php endif; ?>">
                                    <?php endif; ?>
                                            <?php if($key !== 0 && $flag): ?>
                                                <li class="dashboard__bottom__list__item  <?php if(request()->routeIs($routeName) == $routeName): ?> selected <?php endif; ?>">
                                                    <a href="<?php echo e(route($routeName)); ?>"><?php echo e($convert_to_array['label']); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($key === count($externalMenu)-1): ?>
                                        </ul>
                                </li>
                            <?php endif; ?>
                        <?php else: ?>
                            <li class="dashboard__bottom__list__item <?php if(request()->routeIs($routeName)): ?> active open <?php endif; ?>">
                                <a href="<?php echo e(route($routeName)); ?>">  <i class="<?php echo e($icon); ?>"></i>  <?php echo e($convert_to_array['label']); ?> <span class="badge bg-danger"><?php echo e(__('Plugin')); ?></span> </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <!-- Logout -->
                <li class="dashboard__bottom__list__item">
                    <a href="<?php echo e(route('admin.logout')); ?>"> <i class="fa-solid fa-arrow-right-to-bracket"></i><?php echo e(__('Log Out')); ?></a>
                </li>
            </ul>
        </div>
    </div>
</div><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/backend/layout/partials/left-sidebar.blade.php ENDPATH**/ ?>