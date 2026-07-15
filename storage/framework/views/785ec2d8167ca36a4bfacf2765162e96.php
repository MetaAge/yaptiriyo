<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-12">
    <?php $__empty_1 = true; $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow duration-300">
            <div class="flex justify-between items-start mb-4">
                <a href="<?php echo e(route('job.details', ['username' => $job->job_creator?->username, 'slug' => $job->slug])); ?>">
                    <h3 class="text-lg font-medium text-base-300 hover:text-primary transition"><?php echo e($job->title); ?></h3>
                </a>
                <div class="flex gap-2">
                    <?php if($job->is_urgent): ?>
                        <span class="bg-red-600 text-white text-[10px] font-bold px-3 py-1 rounded-md flex items-center gap-1 shadow-sm">
                            <i class="fa-solid fa-bolt"></i> <?php echo e(__('ACİL')); ?>

                        </span>
                    <?php endif; ?>
                    <?php if($job->created_at->diffInHours(now()) < 24): ?>
                        <span class="bg-secondary text-white text-[10px] px-3 py-1 rounded-md"><?php echo e(__('New')); ?></span>
                    <?php endif; ?>
                </div>
            </div>


            <div class="flex items-center gap-2 mb-4 text-gray-600">
                <span><?php echo e($job->created_at->diffForHumans()); ?></span>
                <span class="text-secondary font-extrabold">•</span>
                <span class="font-medium text-black"><?php echo e(ucfirst(__($job->level))); ?></span>
            </div>

            <div class="flex items-center gap-2 mb-4 flex-wrap">
                <div class="flex items-center gap-2">
                    <span class="text-xl font-medium text-base-300"><?php echo e($job->display_price); ?></span>
                    <span class="text-sm text-base-400 bg-gray-200 px-4 rounded-full py-1">
                       <?php echo e(ucfirst(__($job->type))); ?>

                      </span>
                </div>
            </div>

            <p class="text-base-400 text-sm mb-4 line-clamp-2">
                <?php echo Str::limit(strip_tags($job->description), 150); ?>

            </p>

            <div class="flex gap-2 mb-6 flex-wrap">
                <?php $__currentLoopData = $job->job_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('skill.jobs', $skill->id . '-' . skillToSlug($skill->skill))); ?>"
                       class="px-3 py-2 text-base-400 border-gray-400 border text-xs rounded-full hover:border-primary hover:text-primary transition">
                        <?php echo e($skill->skill ?? ''); ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <a href="<?php echo e(route('job.details', ['username' => $job->job_creator?->username, 'slug' => $job->slug])); ?>"
               class="text-primary font-medium text-sm border px-4 py-2 border-primary rounded-lg hover:bg-primary hover:text-white duration-300 inline-flex items-center gap-1 hover:gap-2 transition-all">
                <?php echo e(__('View More')); ?>

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-span-2">
            <section>
                <div class="flex items-center justify-center min-h-[calc(100vh-171px)] w-full py-10">
                    <div class="max-w-md flex flex-col items-center justify-center">
                        <img src="<?php echo e(asset('assets/frontend/new_design/assets/images/error-images/no_jobs_found.svg')); ?>" alt="nothing-found">
                        <p class="text-base-300 text-2xl">Ops! Sorry, no results found.</p>
                    </div>
                </div>
            </section>
        </div>
    <?php endif; ?>
</div>

<!-- Pagination -->
<?php if (isset($component)) { $__componentOriginal40bc08c7cd43bb4a699bd2fc78128c87 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal40bc08c7cd43bb4a699bd2fc78128c87 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.pagination.laravel-paginate-02','data' => ['allData' => $jobs]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('pagination.laravel-paginate-02'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['allData' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($jobs)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal40bc08c7cd43bb4a699bd2fc78128c87)): ?>
<?php $attributes = $__attributesOriginal40bc08c7cd43bb4a699bd2fc78128c87; ?>
<?php unset($__attributesOriginal40bc08c7cd43bb4a699bd2fc78128c87); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal40bc08c7cd43bb4a699bd2fc78128c87)): ?>
<?php $component = $__componentOriginal40bc08c7cd43bb4a699bd2fc78128c87; ?>
<?php unset($__componentOriginal40bc08c7cd43bb4a699bd2fc78128c87); ?>
<?php endif; ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/pages/jobs/search-job-result.blade.php ENDPATH**/ ?>