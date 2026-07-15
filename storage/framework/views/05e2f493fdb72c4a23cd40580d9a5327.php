<?php if($all_proposals->total() < 1): ?>
    <div class="myOrder-single bg-white padding-20 radius-10">
        <div class="myOrder-single-item">
            <h4 class="text-danger"><?php echo e(__('No Proposals Found')); ?></h4>
        </div>
    </div>
<?php else: ?>
    <?php $__currentLoopData = $all_proposals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proposal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="myOrder-single bg-white padding-20 radius-10">
            <!-- ADD JOB TITLE SECTION HERE -->
            <div class="myOrder-single-item">
                <h4 class="myOrder-single-item-title mb-3">
                    <?php if($proposal->job && $proposal->job->title): ?>
                        <h4 class="mb-2">
                            <a href="<?php echo e(route('job.details', ['username' => $proposal->job->job_creator->username ?? '', 'slug' => $proposal->job->slug ?? ''])); ?>"
                               target="_blank"
                               style="color: inherit; text-decoration: none; font-size: 1.25rem;">
                                <?php echo e($proposal->job->title); ?>

                            </a>
                        </h4>
                    <?php else: ?>
                        <span class="text-danger" style="font-size: 1.25rem;"><?php echo e(__('Job Not Found')); ?></span>
                    <?php endif; ?>
                </h4>
            </div>
            <!-- END JOB TITLE SECTION -->

            <div class="myOrder-single-item">
                <div class="myOrder-single-flex">
                    <div class="myOrder-single-content">
                        <span class="myOrder-single-content-id">#000<?php echo e($proposal->id); ?></span>
                        <div class="myOrder-single-content-btn flex-btn mt-3">
                            <?php if (isset($component)) { $__componentOriginal78b125a979f4c19ac28d3899b79f9f36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal78b125a979f4c19ac28d3899b79f9f36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.job.job-proposal-view','data' => ['isView' => $proposal->is_view]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('job.job-proposal-view'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['isView' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($proposal->is_view)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal78b125a979f4c19ac28d3899b79f9f36)): ?>
<?php $attributes = $__attributesOriginal78b125a979f4c19ac28d3899b79f9f36; ?>
<?php unset($__attributesOriginal78b125a979f4c19ac28d3899b79f9f36); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal78b125a979f4c19ac28d3899b79f9f36)): ?>
<?php $component = $__componentOriginal78b125a979f4c19ac28d3899b79f9f36; ?>
<?php unset($__componentOriginal78b125a979f4c19ac28d3899b79f9f36); ?>
<?php endif; ?>
                            <div class="job-proposal-btn-item">
                                <?php if (isset($component)) { $__componentOriginal35beda515b977db44ee46e12ed4e7815 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal35beda515b977db44ee46e12ed4e7815 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.job.hire-short-list-check','data' => ['isHired' => $proposal->is_hired,'isShortListed' => $proposal->is_short_listed]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('job.hire-short-list-check'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['isHired' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($proposal->is_hired),'isShortListed' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($proposal->is_short_listed)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal35beda515b977db44ee46e12ed4e7815)): ?>
<?php $attributes = $__attributesOriginal35beda515b977db44ee46e12ed4e7815; ?>
<?php unset($__attributesOriginal35beda515b977db44ee46e12ed4e7815); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal35beda515b977db44ee46e12ed4e7815)): ?>
<?php $component = $__componentOriginal35beda515b977db44ee46e12ed4e7815; ?>
<?php unset($__componentOriginal35beda515b977db44ee46e12ed4e7815); ?>
<?php endif; ?>
                            </div>
                            <?php if($proposal->is_interview_take == 1): ?>
                                <span class="shortlisted-item seen"><?php echo e(__('Interviewed')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <span class="myOrder-single-content-time"><?php echo e($proposal->created_at->diffForHumans()); ?> </span>
                </div>
            </div>
            <div class="myOrder-single-item">
                <div class="myOrder-single-block">
                    <div class="myOrder-single-block-item">
                        <div class="myOrder-single-block-item-content">
                            <span class="myOrder-single-block-subtitle"><?php echo e(__('Offer Price')); ?></span>
                            <h6 class="myOrder-single-block-title mt-2"><?php echo e(float_amount_with_currency_symbol($proposal->amount)); ?>

                            </h6>
                        </div>
                    </div>
                    <?php if($proposal->duration): ?>
                        <div class="myOrder-single-block-item">
                            <div class="myOrder-single-block-item-content">
                                <span class="myOrder-single-block-subtitle"><?php echo e(__('Delivery Time')); ?></span> <br>
                                <h6 class="myOrder_single__block__title mt-2">
                                    <?php echo e($proposal->duration); ?>

                                </h6>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="myOrder-single-block-item">
                        <div class="myOrder-single-block-item-content">
                            <span class="myOrder-single-block-subtitle"><?php echo e(__('Create Date')); ?></span><br>
                            <h6 class="myOrder_single__block__title mt-2">
                                <?php echo e($proposal->created_at->toFormattedDateString() ?? ''); ?>

                            </h6>
                        </div>
                    </div>

                    <?php if($proposal->attachment): ?>
                        <div class="myJob-wrapper-single">
                            <div class="myJob-wrapper-single-contents">
                                <?php if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])): ?>
                                    <a href="<?php echo e(render_frontend_cloud_image_if_module_exists('jobs/proposal/'.$proposal->attachment, load_from: $proposal->load_from)); ?>"
                                       download
                                       class="single-refundRequest-item-uploads">
                                        <i class="fa-solid fa-cloud-arrow-down"></i>
                                        <?php echo e(__('Download Attachment')); ?>

                                    </a>
                                <?php else: ?>
                                <a href="<?php echo e(asset('assets/uploads/jobs/proposal/'.$proposal->attachment)); ?>" download class="single-refundRequest-item-uploads">
                                    <i class="fa-solid fa-cloud-arrow-down"></i>
                                    <?php echo e(__('Download Attachment')); ?>

                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
                <p class="mt-4 cover_letter"><?php echo e(Str::limit($proposal->cover_letter,250 ?? '')); ?></p>
            </div>
            <div class="myOrder-single-item">
                <div class="myOrder-single-flex flex-between">

                    <?php if(moduleExists('HourlyJob')): ?>
                        <?php if($proposal?->job->type == 'hourly'): ?>
                            <div class="jobFilter-proposal-offered-single">
                                <span class="offered"><?php echo e(__(ucfirst($proposal?->job->type))); ?>

                                 <span class="offered-price"><?php echo e(float_amount_with_currency_symbol($proposal?->job->hourly_rate)); ?></span>
                                </span>
                            </div>
                        <?php endif; ?>
                        <?php if($proposal?->job->type == 'hourly'): ?>
                            <div class="jobFilter-proposal-offered-single">
                                <span class="offered"><?php echo e(__('Estimated Hour')); ?>

                                 <span class="offered-price"><?php echo e($proposal?->job->estimated_hours ?? ''); ?></span>
                                </span>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <div class="btn-wrapper flex-btn">
                        <button
                           class="btn-profile btn-outline-1 cover_letter_details"
                           data-bs-target="#CoverLetterModal"
                           data-bs-toggle="modal"
                           data-cover-letter="<?php echo e($proposal->cover_letter); ?>"
                        >
                            <?php echo e(__('Proposal Details')); ?>

                        </button>
                    </div>
                    <div class="btn-wrapper flex-btn">
                        <a href="<?php echo e(route('job.details', ['username' => $proposal?->job?->job_creator?->username, 'slug' => $proposal?->job?->slug])); ?>"
                           class="btn-profile btn-bg-1"
                           target="_blank">
                            <?php echo e(__('Job Details')); ?>

                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php if (isset($component)) { $__componentOriginal0143df8887fb9686c5dbf1f1b0d7027f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0143df8887fb9686c5dbf1f1b0d7027f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.pagination.laravel-paginate','data' => ['allData' => $all_proposals]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('pagination.laravel-paginate'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['allData' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($all_proposals)]); ?>
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
<?php endif; ?>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/freelancer/proposal/search-result.blade.php ENDPATH**/ ?>