<div class="btn-wrapper job_open_close_location_<?php echo e($job->id); ?>">
    <a href="javascript:void(0)" class="job_open_close" data-job-id="<?php echo e($job->id); ?>" data-job-on-off="<?php echo e($job->on_off); ?>">
        <?php if($job->on_off == 0): ?>
            <span class="btn-profile btn-bg-1"><?php echo e(__('Open Job')); ?></span>
        <?php else: ?>
            <span class="btn-profile btn-bg-cancel"><?php echo e(__('Close Job')); ?></span>
        <?php endif; ?>
    </a>
</div>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/client/job/my-job/open-close.blade.php ENDPATH**/ ?>