<div class="tab-content-item active mt-4" id="all-jobs">
    <div class="myJob-wrapper">
        <?php if(!empty($all_jobs)): ?>
            <?php $__currentLoopData = $all_jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="myJob-wrapper-single job_open_close_location_<?php echo e($job->id); ?>">
                    <div class="myJob-wrapper-single-flex flex-between align-items-center">
                        <div class="myJob-wrapper-single-contents">
                            <div class="flex-btn">
                                <span class="myJob-wrapper-single-id">#000<?php echo e($job->id); ?></span>
                                <div class="btn-item">
                                    <span class="myJob-wrapper-single-fixed"><?php echo e(__(ucfirst($job->type))); ?></span>
                                </div>
                                <?php if($job->on_off == 0): ?>
                                <div class="btn-item">
                                    <span
                                        class="myJob-wrapper-single-fixed closed"><?php echo e(__('Closed')); ?></span>
                                </div>
                                <?php else: ?>
                                <div class="btn-item">
                                    <span
                                        class="myJob-wrapper-single-fixed active"><?php echo e(__('Open')); ?>

                                    </span>
                                </div>
                                <?php endif; ?>
                                <?php if($job->current_status == 1): ?>
                                <div class="btn-item">
                                    <span
                                        class="myJob-wrapper-single-fixed not-started"><?php echo e(__('In Progress')); ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if($job->current_status == 2): ?>
                                <div class="btn-item">
                                    <span
                                        class="myJob-wrapper-single-fixed completed"><?php echo e(__('Complete')); ?></span>
                                </div>
                                <?php endif; ?>
                            </div>
                            <h4 class="myJob-wrapper-single-title mt-3">
                                <a href="<?php echo e(route('client.job.details', $job->id)); ?>"><?php echo e($job->title); ?></a>
                            </h4>
                            <div class="myJob-wrapper-single-list mt-3">
                                <?php if($job->on_off == 1): ?>
                                    <span class="job_publicPrivate_view"><?php echo e(__('Public')); ?></span>
                                <?php else: ?>
                                    <span class="job_publicPrivate_view"><?php echo e(__('Only Me')); ?></span>
                                <?php endif; ?>
                                <div
                                    class="single-jobs-date mt-0"><?php echo e(Carbon\Carbon::parse($job->created_at)->toFormattedDateString()); ?>

                                    - <span><?php echo e(ucfirst($job->level)); ?></span>
                                </div>
                                <span class="single-jobs-date mt-0"><?php echo e(__('Proposals:')); ?> <?php echo e($job?->job_proposals_count ?? 0); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="flex-between profile-border-top">
                        <div class="btn-wrapper">
                            <a href="javascript:void(0)" class="job_open_close" data-job-id="<?php echo e($job->id); ?>"
                                data-job-on-off="<?php echo e($job->on_off); ?>">
                                <?php if($job->on_off == 0): ?>
                                    <span class="btn-profile btn-outline-1"><?php echo e(__('Open Job')); ?></span>
                                <?php else: ?>
                                    <span class="btn-profile btn-outline-cancel"><?php echo e(__('Close Job')); ?></span>
                                <?php endif; ?>
                            </a>
                        </div>
                        <div class="btn-wrapper flex-btn gap-2">
                            <?php if(moduleExists('SecurityManage')): ?>
                                <?php if(Auth::guard('web')->user()->freeze_job == 'freeze'): ?>
                                    <a href="#" class="btn-profile btn-outline-gray <?php if(Auth::guard('web')->user()->freeze_job == 'freeze'): ?> disabled-link <?php endif; ?>">
                                        <i class="fa-regular fa-edit"></i><?php echo e(__('Edit Job')); ?>

                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo e(route('client.job.edit', $job->id)); ?>" class="btn-profile btn-outline-gray">
                                        <i class="fa-regular fa-edit"></i><?php echo e(__('Edit Job')); ?>

                                    </a>
                                <?php endif; ?>
                            <?php else: ?>
                                <a href="<?php echo e(route('client.job.edit', $job->id)); ?>" class="btn-profile btn-outline-gray">
                                    <i class="fa-regular fa-edit"></i><?php echo e(__('Edit Job')); ?>

                                </a>
                            <?php endif; ?>
                            <a href="<?php echo e(route('client.job.details', $job->id)); ?>"
                                class="btn-profile btn-bg-1"><?php echo e(__('View Job')); ?></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <h2 class="text-danger"><?php echo e(__('No Jobs Found')); ?></h2>
        <?php endif; ?>
    </div>
</div>

<div class="mt-3">
    <?php if (isset($component)) { $__componentOriginal0143df8887fb9686c5dbf1f1b0d7027f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0143df8887fb9686c5dbf1f1b0d7027f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.pagination.laravel-paginate','data' => ['allData' => $all_jobs]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('pagination.laravel-paginate'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['allData' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($all_jobs)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0143df8887fb9686c5dbf1f1b0d7027f)): ?>
<?php $attributes = $__attributesOriginal0143df8887fb9686c5dbf1f1b0d7027f; ?>
<?php unset($__attributesOriginal0143df8887fb9686c5dbf1f1b0d7027f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0143df8887fb9686c5dbf1f1b0d7027f)): ?>
<?php $component = $__componentOriginal0143df8887fb9686c5dbf1f1b0d7027f; ?>
<?php unset($__componentOriginal0143df8887fb9686c5dbf1f1b0d7027f); ?>
<?php endif; ?>
</div>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/client/job/my-job/search-result.blade.php ENDPATH**/ ?>