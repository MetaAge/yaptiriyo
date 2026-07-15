<div class="profile-wrapper-item radius-10">
    <div class="profile-wrapper-flex flex-between">
        <div class="profile-wrapper-author-cotents">
            <h4 class="profile-wrapper-about-title mt-2"> <a href="<?php echo e(route('client.job.create')); ?>"><?php echo e(__('Post a Job')); ?></a> </h4>
            <span class="profile-wrapper-about-para mt-2"><?php echo e(__('Post a job to find and hire talents for your projects.')); ?> </span>
        </div>
        <div class="profile-wrapper-right">
            <div class="btn-wrapper">
                <?php if(moduleExists('SecurityManage')): ?>
                    <?php if(Auth::guard('web')->user()->freeze_job == 'freeze'): ?>
                        <a href="#" class="btn-profile btn-bg-1 <?php if(Auth::guard('web')->user()->freeze_job == 'freeze'): ?> disabled-link <?php endif; ?>"><?php echo e(__('Post a Job')); ?></a>
                    <?php else: ?>
                        <a href="<?php echo e(route('client.job.create')); ?>" class="btn-profile btn-bg-1"><?php echo e(__('Post a Job')); ?></a>
                    <?php endif; ?>
                <?php else: ?>
                   <a href="<?php echo e(route('client.job.create')); ?>" class="btn-profile btn-bg-1"><?php echo e(__('Post a Job')); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="tab-content-item-two active" id="job-postings">
    <div class="myJob-wrapper-tab mt-4">
        <div class="myJob-tabs">
            <ul class="tabs">
                <li data-tab="all-jobs" data-val="all" class="active jobs_filter_for_client"> <?php echo e(__('All Jobs')); ?> (<?php echo e($all_jobs->total()); ?>)</li>
                <li data-tab="active-jobs" data-val="active" class="jobs_filter_for_client"> <?php echo e(__('Active Jobs')); ?> (<?php echo e($active_jobs); ?>)</li>
                <li data-tab="closed-jobs" data-val="close" class="jobs_filter_for_client"> <?php echo e(__('Closed Jobs')); ?> (<?php echo e($closed_jobs); ?>)</li>
                <li data-tab="completed-jobs" data-val="complete" class="jobs_filter_for_client"> <?php echo e(__('Completed Jobs')); ?> (<?php echo e($complete_jobs); ?>)</li>
            </ul>
        </div>
    </div>
</div>

<input type="hidden" id="set_filter_type_value" value="all">
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/client/job/my-job/header.blade.php ENDPATH**/ ?>