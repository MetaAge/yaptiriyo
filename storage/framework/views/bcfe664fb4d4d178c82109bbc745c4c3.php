<?php $__env->startSection('site_title',__('My Proposals')); ?>
<?php $__env->startSection('style'); ?>
    <style>
        #proposal_cover_letter_details{white-space:pre-line}
        .cover_letter{word-wrap: break-word;}
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <main>
        <?php if(moduleExists('CoinPaymentGateway')): ?><?php else: ?><?php if (isset($component)) { $__componentOriginal7ecac999957263c09523da7583aa96ad = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7ecac999957263c09523da7583aa96ad = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.category.category','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.category.category'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7ecac999957263c09523da7583aa96ad)): ?>
<?php $attributes = $__attributesOriginal7ecac999957263c09523da7583aa96ad; ?>
<?php unset($__attributesOriginal7ecac999957263c09523da7583aa96ad); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7ecac999957263c09523da7583aa96ad)): ?>
<?php $component = $__componentOriginal7ecac999957263c09523da7583aa96ad; ?>
<?php unset($__componentOriginal7ecac999957263c09523da7583aa96ad); ?>
<?php endif; ?><?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal1886b76dac2bd4a55dfc12d1a06ee6e4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1886b76dac2bd4a55dfc12d1a06ee6e4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.breadcrumb.user-profile-breadcrumb','data' => ['title' => __('Proposals'),'innerTitle' => __('My Proposals')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('breadcrumb.user-profile-breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Proposals')),'innerTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('My Proposals'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1886b76dac2bd4a55dfc12d1a06ee6e4)): ?>
<?php $attributes = $__attributesOriginal1886b76dac2bd4a55dfc12d1a06ee6e4; ?>
<?php unset($__attributesOriginal1886b76dac2bd4a55dfc12d1a06ee6e4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1886b76dac2bd4a55dfc12d1a06ee6e4)): ?>
<?php $component = $__componentOriginal1886b76dac2bd4a55dfc12d1a06ee6e4; ?>
<?php unset($__componentOriginal1886b76dac2bd4a55dfc12d1a06ee6e4); ?>
<?php endif; ?>

        <!-- Profile Details area Starts -->
        <div class="profile-area pat-100 pab-100 section-bg-2">
            <div class="container">
                <div class="row gy-4 justify-content-center">
                    <div class="<?php if(get_static_option('job_enable_disable') != 'disable'): ?> col-xl-8 col-lg-8 <?php else: ?> col-12 <?php endif; ?>">
                        <div class="shop-contents-wrapper-right">
                            <div class="myOrder-wrapper">
                                <div class="myOrder-wrapper-tabs">
                                    <div class="myOrder-tab-content">
                                        <div class="tab-content-item active">
                                            <div class="search_result">
                                                <?php echo $__env->make('frontend.user.freelancer.proposal.search-result', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if(get_static_option('job_enable_disable') != 'disable'): ?>
                    <div class="col-xl-4 col-lg-4">
                        <div class="profile-details-widget sticky_top">
                            <div class="file-wrapper-item-flex flex-between align-items-center profile-border-bottom">
                                <h4 class="profile-wrapper-item-title"> <?php echo e(__('Available Jobs')); ?> </h4>
                                <a href="<?php echo e(route('jobs.all')); ?>" class="profile-wrapper-item-browse-btn"> <?php echo e(__('Browse All')); ?> </a>
                            </div>
                            <?php if($jobs->count()>0): ?>
                                <?php if(moduleExists('HourlyJob')): ?>
                                    <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="single-jobs border-0 radius-10 bg-white mt-4">
                                            <h4 class="single-jobs-title">
                                                <a href="<?php echo e(route('job.details', ['username' => $job->job_creator?->username, 'slug' => $job->slug])); ?>"><?php echo e($job->title); ?></a>
                                            </h4>
                                            <p class="single-jobs-date">
                                                <?php echo e($job->created_at->toFormattedDateString() ?? ''); ?> -
                                                <span><?php echo e(ucfirst($job->level) ?? ''); ?></span>
                                            </p>

                                            <h3 class="single-jobs-price">
                                                <?php echo e($job->display_price); ?>

                                                <span class="single-jobs-price-fixed"><?php echo e(__(ucfirst($job->type))); ?></span>
                                            </h3>
                                            <div class="single-jobs-tag mt-4">
                                                <?php $__currentLoopData = $job->job_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="<?php echo e(route('skill.jobs', $skill->id . '-' . skillToSlug($skill->skill))); ?>"
                                        class="single-jobs-tag-link"><?php echo e($skill->skill ?? ''); ?></a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="single-jobs border-0 radius-10 bg-white mt-4">
                                            <h4 class="single-jobs-title">
                                                <a href="<?php echo e(route('job.details', ['username' => $job->job_creator?->username, 'slug' => $job->slug])); ?>"><?php echo e($job->title); ?></a>
                                            </h4>
                                            <p class="single-jobs-date">
                                                <?php echo e($job->created_at->toFormattedDateString() ?? ''); ?> -
                                                <span><?php echo e(ucfirst($job->level) ?? ''); ?></span>
                                            </p>

                                            <h3 class="single-jobs-price">
                                                <?php echo e($job->display_price); ?>

                                                <span class="single-jobs-price-fixed"><?php echo e(__(ucfirst($job->type))); ?></span>
                                            </h3>
                                            <div class="single-jobs-tag mt-4">
                                                <?php $__currentLoopData = $job->job_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="<?php echo e(route('skill.jobs', $skill->id . '-' . skillToSlug($skill->skill))); ?>"
                                                        class="single-jobs-tag-link"><?php echo e($skill->skill ?? ''); ?>

                                                    </a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            <?php else: ?>
                                <h6 class="profile-wrapper-item-title"><?php echo e(__('No Jobs Found')); ?></h6>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- Profile Details area end -->
    </main>

    <?php echo $__env->make('frontend.user.freelancer.proposal.cover-letter-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){
                $(document).on('click','.cover_letter_details',function(){
                    let cover_letter = $(this).data('cover-letter');
                    $('#proposal_cover_letter_details').text(cover_letter);
                })

                $(document).on('click', '.pagination a', function(e){
                    e.preventDefault();
                    let page = $(this).attr('href').split('page=')[1];
                    subscriptions(page);
                });
                function subscriptions(page){
                    $.ajax({
                        url:"<?php echo e(route('freelancer.proposal.paginate.data').'?page='); ?>" + page,
                        success:function(res){
                            $('.search_result').html(res);
                        }
                    });
                }
            });
        }(jQuery));
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('frontend.layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/freelancer/proposal/proposals.blade.php ENDPATH**/ ?>