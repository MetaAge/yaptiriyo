<?php if(Auth::guard('web')->user()->user_type == 1 && Session::get('user_role') != 'freelancer'): ?>
    <?php
        if(get_static_option('project_enable_disable') != 'disable' && get_static_option('job_enable_disable') != 'disable'){
            $client_bookmarks = \App\Models\Bookmark::where('user_id',Auth::guard('web')->user()->id)->get();
        }else if(get_static_option('project_enable_disable') == 'disable' && get_static_option('job_enable_disable') == 'disable'){
            $client_bookmarks = '';
        }else if(get_static_option('project_enable_disable') == 'disable'){
            $client_bookmarks = \App\Models\Bookmark::whereHas('bookmark_job')
            ->where('is_project_job','job')
            ->where('user_id',Auth::guard('web')->user()->id)
            ->get();
        }else if(get_static_option('job_enable_disable') == 'disable'){
            $client_bookmarks = \App\Models\Bookmark::whereHas('bookmark_project')
            ->where('is_project_job','projct')
            ->where('user_id',Auth::guard('web')->user()->id)
            ->get();
        }
    ?>
    <div class="navbar-right-item">
        <?php
            $unseen_message_count = \App\Models\User::select('id')->withCount(['client_unseen_message' => function($q){
                  $q->where('is_seen',0)->where('from_user',2);
                }])->where('id', auth("web")->id())->first();
        ?>
        <a href="<?php echo e(route('client.live.chat')); ?>" class="navbar-right-chat position-relative reload_unseen_message_count"> <i class="fa-regular fa-comment-dots"></i>
            <?php if($unseen_message_count->client_unseen_message_count > 0): ?>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo e($unseen_message_count->client_unseen_message_count ?? ''); ?></span>
            <?php endif; ?>
        </a>
    </div>
    <div class="navbar-right-item bookmark_area position-relative">
        <a href="#0" class="navbar-right-chat nav-right-bookmark-icon position-relative">
            <i class="fa-regular fa-bookmark"></i>
            <?php if(!empty($client_bookmarks) && $client_bookmarks->count() > 0): ?>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary">
                     <?php echo e($client_bookmarks->count()); ?>

                </span>
            <?php endif; ?>
        </a>
        <div class="bookmark-wrap">
            <?php if(!empty($client_bookmarks) && $client_bookmarks->count() > 0): ?>
                <?php $__currentLoopData = $client_bookmarks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bookmark): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bookmark-item">
                        <?php if($bookmark->is_project_job == 'project'): ?>
                            <a href="<?php echo e(route('project.details', ['username' => $bookmark?->bookmark_project?->project_creator?->username, 'slug' => $bookmark?->bookmark_project?->slug])); ?>"
                               class="bookmark-item-para">
                                <span class="bookmark-header-icon"><i class="fa-regular fa-bookmark"></i></span>
                                <?php echo e($bookmark?->bookmark_project?->title ?? ''); ?>

                            </a>
                        <?php else: ?>
                            <a href="<?php echo e(route('job.details', ['username' => $bookmark?->bookmark_job?->job_creator?->username, 'slug' => $bookmark?->bookmark_job?->slug])); ?>"
                               class="bookmark-item-para">
                                <span class="bookmark-header-icon"><i class="fa-regular fa-bookmark"></i></span>
                                <?php echo e($bookmark?->bookmark_job?->title ?? ''); ?>

                            </a>
                        <?php endif; ?>
                        <span class="bookmark-item-close remove_from_bookmark"
                              data-identity = "<?php echo e($bookmark->id); ?>"
                              data-route = "<?php echo e(route('client.bookmark.remove')); ?>">
                                        <i class="fas fa-times"></i>
                                    </span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <span class="navbar-right-notification-wrapper-list-item-content-title">
                                    <span class="bookmark-header">
                                        <span class="bookmark-header-icon"><i class="fa-regular fa-bookmark"></i></span>
                                        <h6 class="bookmark-header-title"><?php echo e(__('No Bookmarks')); ?></h6>
                                    </span>
                                </span>
            <?php endif; ?>
        </div>
    </div>
<?php else: ?>
    <?php
        if(get_static_option('project_enable_disable') != 'disable' && get_static_option('job_enable_disable') != 'disable'){
            $freelancer_bookmarks = \App\Models\Bookmark::where('user_id',Auth::guard('web')->user()->id)->get();
        }else if(get_static_option('project_enable_disable') == 'disable' && get_static_option('job_enable_disable') == 'disable'){
            $freelancer_bookmarks = '';
        }else if(get_static_option('project_enable_disable') == 'disable'){
            $freelancer_bookmarks = \App\Models\Bookmark::whereHas('bookmark_job')
            ->where('is_project_job','job')
            ->where('user_id',Auth::guard('web')->user()->id)->get();
        }else if(get_static_option('job_enable_disable') == 'disable'){
            $freelancer_bookmarks = \App\Models\Bookmark::whereHas('bookmark_project')
            ->where('is_project_job','project')
            ->where('user_id',Auth::guard('web')->user()->id)->get();
        }
    ?>

    <?php if(Auth::guard('web')->user()->user_type == 2 && Session::get('user_role') == 'client'): ?>
        
        <?php
            if(get_static_option('project_enable_disable') != 'disable' && get_static_option('job_enable_disable') != 'disable'){
                $client_bookmarks = \App\Models\Bookmark::where('user_id',Auth::guard('web')->user()->id)->get();
            }else if(get_static_option('project_enable_disable') == 'disable' && get_static_option('job_enable_disable') == 'disable'){
                $client_bookmarks = '';
            }else if(get_static_option('project_enable_disable') == 'disable'){
                $client_bookmarks = \App\Models\Bookmark::whereHas('bookmark_job')
                ->where('is_project_job','job')
                ->where('user_id',Auth::guard('web')->user()->id)
                ->get();
            }else if(get_static_option('job_enable_disable') == 'disable'){
                $client_bookmarks = \App\Models\Bookmark::whereHas('bookmark_project')
                ->where('is_project_job','projct')
                ->where('user_id',Auth::guard('web')->user()->id)
                ->get();
            }
        ?>
        <div class="navbar-right-item">
            <?php
                $unseen_message_count = \App\Models\User::select('id')->withCount(['client_unseen_message' => function($q){
                      $q->where('is_seen',0)->where('from_user',2);
                    }])->where('id', auth("web")->id())->first();
            ?>
            <a href="<?php echo e(route('client.live.chat')); ?>" class="navbar-right-chat position-relative reload_unseen_message_count"> <i class="fa-regular fa-comment-dots"></i>
                <?php if($unseen_message_count->client_unseen_message_count > 0): ?>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo e($unseen_message_count->client_unseen_message_count ?? ''); ?></span>
                <?php endif; ?>
            </a>
        </div>
    <?php else: ?>
        
        <div class="navbar-right-item">
            <?php
                $unseen_message_count = \App\Models\User::select('id')->withCount(['freelancer_unseen_message' => function($q){
                      $q->where('is_seen',0)->where('from_user',1);
                    }])->where('id', auth("web")->id())->first();
            ?>
            <a href="<?php echo e(route('freelancer.live.chat')); ?>" class="navbar-right-chat position-relative reload_unseen_message_count"> <i class="fa-regular fa-comment-dots"></i>
                <?php if($unseen_message_count->freelancer_unseen_message_count > 0): ?>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo e($unseen_message_count->freelancer_unseen_message_count ?? ''); ?></span>
                <?php endif; ?>
            </a>
        </div>
    <?php endif; ?>

    <div class="navbar-right-item bookmark_area position-relative">
        <a href="#0" class="navbar-right-chat nav-right-bookmark-icon position-relative">
            <i class="fa-regular fa-bookmark"></i>
            <?php if(!empty($freelancer_bookmarks) && $freelancer_bookmarks->count() > 0): ?>
                <span
                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary">
                                    <?php echo e($freelancer_bookmarks->count()); ?>

                                </span>
            <?php endif; ?>
        </a>
        <div class="bookmark-wrap">
            <?php if(!empty($freelancer_bookmarks) && $freelancer_bookmarks->count() > 0): ?>
                <?php $__currentLoopData = $freelancer_bookmarks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bookmark): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bookmark-item">
                        <?php if($bookmark->is_project_job == 'project'): ?>
                            <?php if($bookmark?->bookmark_project?->project_creator?->username && $bookmark?->bookmark_project?->slug): ?>
                                <a href="<?php echo e(route('project.details', ['username' => $bookmark?->bookmark_project?->project_creator?->username, 'slug' => $bookmark?->bookmark_project?->slug])); ?>"
                                   class="bookmark-item-para"> <span class="bookmark-header-icon"><i class="fa-regular fa-bookmark"></i></span>
                                    <?php echo e($bookmark?->bookmark_project?->title ?? ''); ?>

                                </a>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php if($bookmark?->bookmark_job?->job_creator?->username && $bookmark?->bookmark_job?->slug): ?>
                                <a href="<?php echo e(route('job.details', ['username' => $bookmark?->bookmark_job?->job_creator?->username, 'slug' => $bookmark?->bookmark_job?->slug])); ?>"
                                   class="bookmark-item-para"><span class="bookmark-header-icon"><i class="fa-regular fa-bookmark"></i></span>
                                    <?php echo e($bookmark?->bookmark_job?->title ?? ''); ?>

                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                        <span class="bookmark-item-close remove_from_bookmark"
                              data-identity = "<?php echo e($bookmark->id); ?>"
                              data-route = "<?php echo e(route('freelancer.bookmark.remove')); ?>">
                                            <i class="fas fa-times"></i>
                                        </span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <span class="navbar-right-notification-wrapper-list-item-content-title">
                                    <span class="bookmark-header">
                                        <span class="bookmark-header-icon"><i class="fa-regular fa-bookmark"></i></span>
                                        <h6 class="bookmark-header-title"><?php echo e(__('No Bookmarks')); ?></h6>
                                    </span>
                                </span>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/components/frontend/menu-chat-bookmark.blade.php ENDPATH**/ ?>