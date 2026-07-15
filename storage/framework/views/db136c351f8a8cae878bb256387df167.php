<?php $__env->startSection('site_title',__('Proposal Details')); ?>
<?php $__env->startSection('style'); ?>
    <?php if (isset($component)) { $__componentOriginalc9b7b8cd21a48778d8b7d695ecb54651 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc9b7b8cd21a48778d8b7d695ecb54651 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.summernote.summernote-css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('summernote.summernote-css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc9b7b8cd21a48778d8b7d695ecb54651)): ?>
<?php $attributes = $__attributesOriginalc9b7b8cd21a48778d8b7d695ecb54651; ?>
<?php unset($__attributesOriginalc9b7b8cd21a48778d8b7d695ecb54651); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc9b7b8cd21a48778d8b7d695ecb54651)): ?>
<?php $component = $__componentOriginalc9b7b8cd21a48778d8b7d695ecb54651; ?>
<?php unset($__componentOriginalc9b7b8cd21a48778d8b7d695ecb54651); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal7a9f1fc0e33dbb5b6865e47c39fccade = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7a9f1fc0e33dbb5b6865e47c39fccade = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select2.select2-css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select2.select2-css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7a9f1fc0e33dbb5b6865e47c39fccade)): ?>
<?php $attributes = $__attributesOriginal7a9f1fc0e33dbb5b6865e47c39fccade; ?>
<?php unset($__attributesOriginal7a9f1fc0e33dbb5b6865e47c39fccade); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7a9f1fc0e33dbb5b6865e47c39fccade)): ?>
<?php $component = $__componentOriginal7a9f1fc0e33dbb5b6865e47c39fccade; ?>
<?php unset($__componentOriginal7a9f1fc0e33dbb5b6865e47c39fccade); ?>
<?php endif; ?>
    <style>
        .cover_letter_details{white-space:pre-line}
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <main>
        <?php if (isset($component)) { $__componentOriginal1886b76dac2bd4a55dfc12d1a06ee6e4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1886b76dac2bd4a55dfc12d1a06ee6e4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.breadcrumb.user-profile-breadcrumb','data' => ['title' => __('Proposal Details'),'innerTitle' => __('Proposal Details')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('breadcrumb.user-profile-breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Proposal Details')),'innerTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Proposal Details'))]); ?>
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


        <!-- Add this after the breadcrumb section or at the beginning of the main content -->
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-4"><?php echo e($proposal_details->job->title ?? 'Job Title'); ?></h3>
                </div>
            </div>
        </div>




        <div class="profile-area pat-100 pab-100 section-bg-2">
            <div class="container">
                <div class="row gy-4 justify-content-center">
                    <div class="col-lg-12">
                        <div class="profile-wrapper">
                            <div class="myJob-wrapper">
                                <div class="myJob-wrapper-single">
                                    <div class="myJob-wrapper-single-flex flex-between align-items-center">
                                        <div class="myJob-wrapper-single-contents">
                                            <div class="jobFilter-proposal-author-flex">
                                                <div class="jobFilter-proposal-author-thumb position-relative">
                                                    <?php if($proposal_details->freelancer?->image): ?>
                                                        <?php if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])): ?>
                                                            <img src="<?php echo e(render_frontend_cloud_image_if_module_exists( 'profile/'. $proposal_details?->freelancer?->image, load_from: $proposal_details?->freelancer?->load_from)); ?>" alt="<?php echo e($proposal_details?->freelancer?->first_name); ?>">
                                                        <?php else: ?>
                                                        <a href="<?php echo e(route('freelancer.profile.details', $proposal_details?->freelancer->username)); ?>">
                                                            <img src="<?php echo e(asset('assets/uploads/profile/'.$proposal_details?->freelancer?->image)); ?>" alt="<?php echo e($proposal_details?->freelancer?->fullname); ?>">
                                                        </a>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <a href="<?php echo e(route('freelancer.profile.details', $proposal_details?->freelancer->username)); ?>">
                                                        <img src="<?php echo e(asset('assets/static/img/author/author.jpg')); ?>" alt="<?php echo e(__('AuthorImg')); ?>">
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="jobFilter-proposal-author-contents">
                                                    <h4 class="jobFilter-proposal-author-contents-title">
                                                        <a href="<?php echo e(route('freelancer.profile.details', $proposal_details?->freelancer->username)); ?>">
                                                        <?php echo e($proposal_details->freelancer?->fullname ?? ''); ?>

                                                        </a>
                                                        <?php if (isset($component)) { $__componentOriginal904e0112ca5a0dc03a39a72400a188a0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal904e0112ca5a0dc03a39a72400a188a0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status.user-active-inactive-check','data' => ['userID' => $proposal_details->freelancer->id]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status.user-active-inactive-check'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['userID' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($proposal_details->freelancer->id)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal904e0112ca5a0dc03a39a72400a188a0)): ?>
<?php $attributes = $__attributesOriginal904e0112ca5a0dc03a39a72400a188a0; ?>
<?php unset($__attributesOriginal904e0112ca5a0dc03a39a72400a188a0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal904e0112ca5a0dc03a39a72400a188a0)): ?>
<?php $component = $__componentOriginal904e0112ca5a0dc03a39a72400a188a0; ?>
<?php unset($__componentOriginal904e0112ca5a0dc03a39a72400a188a0); ?>
<?php endif; ?>
                                                    </h4>
                                                    <p class="jobFilter-proposal-author-contents-subtitle mt-1"> <?php echo e($proposal_details->freelancer?->user_introduction?->title ?? ''); ?> · <span><?php echo e($proposal_details->freelancer?->user_state?->state ?? ''); ?>, <?php echo e($proposal_details->freelancer?->user_country?->country ?? ''); ?></span> </p>
                                                    <div class="jobFilter-proposal-author-contents-review mt-2">
                                                        <?php
                                                            $freelancerAvgRating = $proposal_details->freelancer->freelancer_ratings_avg_rating ?? 0;
                                                            $freelancerReviewCount = $proposal_details->freelancer->freelancer_ratings_count ?? 0;
                                                        ?>
                                                        <div class="flex items-center gap-1">
                                                            <div class="rating-stars text-warning">
                                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                                    <?php if($i <= round($freelancerAvgRating)): ?>
                                                                        <i class="fa-solid fa-star"></i>
                                                                    <?php else: ?>
                                                                        <i class="fa-regular fa-star"></i>
                                                                    <?php endif; ?>
                                                                <?php endfor; ?>
                                                            </div>
                                                            <span class="text-sm font-semibold text-gray-700"><?php echo e(number_format($freelancerAvgRating, 1)); ?></span>
                                                            <span class="text-sm text-gray-500">(<?php echo e($freelancerReviewCount); ?>)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="myJob-wrapper-single-arrow">
                                            <div class="job-proposal-btn">
                                                <div class="job-proposal-btn-item">
                                                    <?php if (isset($component)) { $__componentOriginal78b125a979f4c19ac28d3899b79f9f36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal78b125a979f4c19ac28d3899b79f9f36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.job.job-proposal-view','data' => ['isView' => $proposal_details->is_view]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('job.job-proposal-view'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['isView' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($proposal_details->is_view)]); ?>
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
                                                </div>
                                                <div class="job-proposal-btn-item">
                                                    <?php if (isset($component)) { $__componentOriginal35beda515b977db44ee46e12ed4e7815 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal35beda515b977db44ee46e12ed4e7815 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.job.hire-short-list-check','data' => ['isHired' => $proposal_details->is_hired,'isShortListed' => $proposal_details->is_short_listed]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('job.hire-short-list-check'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['isHired' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($proposal_details->is_hired),'isShortListed' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($proposal_details->is_short_listed)]); ?>
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
                                                <div class="job-proposal-btn-item">
                                                    <p class="jobFilter-proposal-author-contents-time"><?php echo e($proposal_details->created_at->diffForHumans()); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="jobFilter-proposal-offered profile-border-top">
                                        <div class="jobFilter-proposal-offered-single">
                                            <span class="offered"><?php echo e(__('Offered')); ?> <span class="offered-price"><?php echo e(float_amount_with_currency_symbol($proposal_details->amount)); ?></span> </span>
                                        </div>
                                        <div class="jobFilter-proposal-offered-single">
                                            <span class="offered"><?php echo e(__('Est. delivery duration')); ?> <span class="offered-days"><?php echo e($proposal_details->duration); ?></span> </span>
                                        </div>
                                        <?php if($proposal_details?->job?->type == 'hourly'): ?>
                                            <div class="jobFilter-proposal-offered-single">
                                                <span class="offered"><?php echo e(__(ucfirst($proposal_details?->job->type))); ?>

                                                 <span class="offered-price"><?php echo e(float_amount_with_currency_symbol($proposal_details?->job->hourly_rate)); ?></span>
                                                </span>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($proposal_details?->job?->type == 'hourly'): ?>
                                            <div class="jobFilter-proposal-offered-single">
                                                <span class="offered"><?php echo e(__('Estimated hour')); ?>

                                                 <span class="offered-price"><?php echo e($proposal_details?->job->estimated_hours ?? ''); ?></span>
                                                </span>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="flex-between profile-border-top">
                                        <div class="btn-wrapper flex-btn gap-2 add_remove_interview_location_<?php echo e($proposal_details->id); ?>">

                                            <a href="javascript:void(0)" class="loadingRound add_remove_shortlist" data-proposal-id="<?php echo e($proposal_details->id); ?>">
                                                <?php if($proposal_details->is_short_listed == 0): ?>
                                                    <span class="btn-profile btn-outline-gray add_to_short_listed"><?php echo e(__('Add to Shortlist')); ?></span>
                                                <?php else: ?>
                                                    <span class="btn-profile btn-outline-gray remove_from_short_listed"><?php echo e(__('Remove from Shortlist')); ?></span>
                                                <?php endif; ?>
                                            </a>

                                            <?php if($proposal_details?->job?->type == 'hourly'): ?>
                                                <a href="javascript:void(0)"
                                                   data-bs-toggle="modal"
                                                   data-bs-target="#RateAndHoursModal"
                                                   class="btn-profile btn-bg-1"><?php echo e(__('Update Hourly Rate')); ?></a>
                                            <?php endif; ?>

                                            <div class="btn-wrapper rejected_interview_location_<?php echo e($proposal_details->id); ?>">
                                                <?php if($proposal_details->is_rejected == 1): ?>
                                                    <a href="javascript:void(0)" class="btn-profile btn-outline-gray"><?php echo e(__('Rejected')); ?></a>
                                                <?php else: ?>
                                                    <a href="javascript:void(0)"
                                                       class="btn-profile btn-bg-1 click-interview take_freelancer_interview"
                                                       data-job-id="<?php echo e($proposal_details->job?->id); ?>"
                                                       data-proposal-id="<?php echo e($proposal_details->id); ?>"
                                                       data-freelancer-id="<?php echo e($proposal_details->freelancer_id); ?>"
                                                       data-job-title="<?php echo e($proposal_details->job?->title); ?>"
                                                       data-job-level="<?php echo e($proposal_details->job?->level); ?>"
                                                       data-job-type="<?php echo e($proposal_details->job?->type); ?>"
                                                       data-job-create-date="<?php echo e($proposal_details->job?->created_at); ?>"
                                                    >
                                                        <?php if($proposal_details->is_interview_take == 1): ?> <?php echo e(__('Interviewed')); ?> <?php else: ?> <?php echo e(__('Take Interview')); ?> <?php endif; ?>
                                                    </a>
                                                    <?php if($proposal_details->is_hired == 0 && $proposal_details?->job?->type != 'hourly'): ?>
                                                        <a href="javascript:void(0)" class="btn-profile btn-outline-gray reject_proposal" data-proposal-id="<?php echo e($proposal_details->id); ?>"><?php echo e(__('Reject')); ?></a>
                                                        <a href="javascript:void(0)"
                                                           class="btn-profile btn-outline-gray accept_proposal"
                                                           data-job-id-for-order="<?php echo e($proposal_details->job_id); ?>"
                                                           data-proposal-id-for-order="<?php echo e($proposal_details->id); ?>"
                                                           data-bs-toggle="modal"
                                                           data-bs-target="#paymentGatewayModal"><?php echo e(__('Accept')); ?></a>
                                                    <?php endif; ?>
                                                    <?php if(moduleExists('HourlyJob')): ?>
                                                        <?php if($proposal_details->is_hired == 0 && $proposal_details?->job->type == 'hourly'): ?>
                                                            <a href="javascript:void(0)" class="btn-profile btn-outline-gray reject_proposal" data-proposal-id="<?php echo e($proposal_details->id); ?>"><?php echo e(__('Reject')); ?></a>

                                                            <a href="javascript:void(0)" class="btn-profile btn-outline-gray accept_hourly_proposal swal_status_change_button"><?php echo e(__('Accept')); ?></a>
                                                            <form method='post' action='<?php echo e(route('order.user.confirm')); ?>' class="d-none">
                                                                <input type='hidden' name='_token' value='<?php echo e(csrf_token()); ?>'>
                                                                <input type='hidden' name='job_id_for_order' value="<?php echo e($proposal_details->job_id); ?>">
                                                                <input type='hidden' name='proposal_id_for_order' value="<?php echo e($proposal_details->id); ?>">
                                                                <input type="hidden" name="offer_id_for_order" id="offer_id_for_order">
                                                                <input type="hidden" name="job_type_for_order" id="job_type_for_order">
                                                                <button type="submit" class="swal_form_submit_btn d-none"></button>
                                                            </form>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="myJob-wrapper-single">
                                    <div class="myJob-wrapper-single-header profile-border-bottom">
                                        <h2 class="myJob-wrapper-single-title"><?php echo e(__('Cover Letter')); ?></h2>
                                    </div>
                                    <div class="myJob-wrapper-single-contents">
                                        <div class="myJob-wrapper-single-contents-item">
                                            <p class="myJob-wrapper-single-contents-para cover_letter_details"><?php echo e($proposal_details->cover_letter ?? ''); ?> </p>
                                        </div>
                                    </div>
                                </div>
                                <?php if($proposal_details->attachment): ?>
                                    <div class="myJob-wrapper-single">
                                        <div class="myJob-wrapper-single-header profile-border-bottom">
                                            <h2 class="myJob-wrapper-single-title"><?php echo e(__('Attachments')); ?></h2>
                                        </div>
                                        <div class="myJob-wrapper-single-contents">
                                            <?php if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])): ?>
                                                <a href="<?php echo e(render_frontend_cloud_image_if_module_exists('jobs/proposal/'.$proposal_details->attachment, load_from: $proposal_details->load_from)); ?>"
                                                   download
                                                   class="single-refundRequest-item-uploads">
                                                    <i class="fa-solid fa-cloud-arrow-down"></i>
                                                    <?php echo e(__('Download Attachment')); ?>

                                                </a>
                                            <?php else: ?>
                                                <a href="<?php echo e(asset('assets/uploads/jobs/proposal/'.$proposal_details->attachment)); ?>" download class="single-refundRequest-item-uploads"><i class="fa-solid fa-cloud-arrow-down"></i> <?php echo e(__('Download Attachment')); ?></a>
                                           <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Send Offer Modal area starts -->
        <div class="popup-overlay"></div>
        <div class="popup-fixed interview-popup">
            <div class="popup-contents">
                <span class="popup-contents-close popup-close"> <i class="fas fa-times"></i> </span>
                <h2 class="popup-contents-title"><?php echo e(__('Take Interview')); ?></h2>
                <div class="popup-contents-interview profile-border-top">
                    <div class="myJob-wrapper-single-contents">
                        <span class="myJob-wrapper-single-id">#000<?php echo e($proposal_details->job?->id); ?> </span>
                        <h4 class="myJob-wrapper-single-title mt-3"><a href="javascript:void(0)"><?php echo e($proposal_details->job?->title); ?></a></h4>
                        <div class="myJob-wrapper-single-list mt-3">
                            <span class="myJob-wrapper-single-list-para"><?php echo e($proposal_details->job?->created_at->diffForHumans()); ?> - <a href="javascript:void(0)"><?php echo e(ucfirst($proposal_details->job?->level)); ?> </a></span>
                        </div>
                    </div>
                </div>
                <div class="popup-contents-btn flex-between profile-border-top">
                    <div class="popup-contents-interview-form custom-form w-100">
                        <form action="<?php echo e(route('client.message.send')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="freelancer_id" id="freelancer_id">
                            <input type="hidden" name="from_user" id="from_user" value="<?php echo e($proposal_details?->job?->user_id); ?>">
                            <input type="hidden" name="job_id" id="job_id" value="<?php echo e($proposal_details?->job?->id); ?>">
                            <input type="hidden" name="type" id="type" value="job">
                            <input type="hidden" name="proposal_id" id="proposal_id_for_check_interview" value="job">
                            <div class="form-group mb-4 mt-0">
                                <label for="messages" class="label-title"><?php echo e(__('Write a Message')); ?></label>
                                <textarea name="interview_message" id="interview_message" cols="30" rows="2" class="form-message form-control" placeholder="<?php echo e(__('E.g.I would you like to invite yo...')); ?>"></textarea>
                            </div>
                            <div class="btn-wrapper flex-btn gap-2 mt-3">
                                <div class="btn-wrapper">
                                    <a href="javascript:void(0)" class="btn-profile btn-outline-gray btn-hover-danger popup-close"> <?php echo e(__('Cancel')); ?> </a>
                                </div>
                                <button type="submit" class="btn-profile btn-bg-1"><i class="fa-regular fa-comments"></i> <?php echo e(__('Send Message')); ?></button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- Send Offer Modal area ends -->

        <!-- update rate and hours -->
        <div class="modal fade" id="RateAndHoursModal" tabindex="-1" aria-labelledby="RateAndHoursModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="<?php echo e(route('client.job.hourly.rate')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="RateAndHoursModalLabel"> <?php echo e(__('Hourly Rate & Estimated Hours')); ?> </h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="job_id" value="<?php echo e($proposal_details?->job?->id); ?>">
                            <div class="single-input">
                                <label class="label-title mb-2"><?php echo e(__('Hourly Rate')); ?></label>
                                <input name="hourly_rate" class="form-control" value="<?php echo e($proposal_details?->job?->hourly_rate); ?>">
                            </div>
                            <div class="single-input mt-2">
                                <label class="label-title mb-2"><?php echo e(__('Estimated Hours')); ?></label>
                                <input name="estimated_hour" class="form-control" value="<?php echo e($proposal_details?->job?->estimated_hours); ?>">
                            </div>
                        </div>
                        <div class="modal-footer flex-column">
                            <div class="d-flex flex-wrap gap-3">
                                <button type="submit" class="btn-profile btn-bg-1"><?php echo e(__('Update')); ?></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php echo $__env->make('frontend.user.client.job.modal.payment-gateway-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    </main>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php if (isset($component)) { $__componentOriginala8bbaec8b85679b9c75e7fd34ed38e55 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bbaec8b85679b9c75e7fd34ed38e55 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.payment-gateway.gateway-select-js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.payment-gateway.gateway-select-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala8bbaec8b85679b9c75e7fd34ed38e55)): ?>
<?php $attributes = $__attributesOriginala8bbaec8b85679b9c75e7fd34ed38e55; ?>
<?php unset($__attributesOriginala8bbaec8b85679b9c75e7fd34ed38e55); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala8bbaec8b85679b9c75e7fd34ed38e55)): ?>
<?php $component = $__componentOriginala8bbaec8b85679b9c75e7fd34ed38e55; ?>
<?php unset($__componentOriginala8bbaec8b85679b9c75e7fd34ed38e55); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalc522360e2a07084453b413c76e27c7e9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc522360e2a07084453b413c76e27c7e9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.summernote.summernote-js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('summernote.summernote-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc522360e2a07084453b413c76e27c7e9)): ?>
<?php $attributes = $__attributesOriginalc522360e2a07084453b413c76e27c7e9; ?>
<?php unset($__attributesOriginalc522360e2a07084453b413c76e27c7e9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc522360e2a07084453b413c76e27c7e9)): ?>
<?php $component = $__componentOriginalc522360e2a07084453b413c76e27c7e9; ?>
<?php unset($__componentOriginalc522360e2a07084453b413c76e27c7e9); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginala34b824a201f14e7e09beb6785e605e8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala34b824a201f14e7e09beb6785e605e8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select2.select2-js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select2.select2-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala34b824a201f14e7e09beb6785e605e8)): ?>
<?php $attributes = $__attributesOriginala34b824a201f14e7e09beb6785e605e8; ?>
<?php unset($__attributesOriginala34b824a201f14e7e09beb6785e605e8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala34b824a201f14e7e09beb6785e605e8)): ?>
<?php $component = $__componentOriginala34b824a201f14e7e09beb6785e605e8; ?>
<?php unset($__componentOriginala34b824a201f14e7e09beb6785e605e8); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal54c16274d3d0b2e3d7bba6b79dadebcb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal54c16274d3d0b2e3d7bba6b79dadebcb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sweet-alert.sweet-alert2-js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sweet-alert.sweet-alert2-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal54c16274d3d0b2e3d7bba6b79dadebcb)): ?>
<?php $attributes = $__attributesOriginal54c16274d3d0b2e3d7bba6b79dadebcb; ?>
<?php unset($__attributesOriginal54c16274d3d0b2e3d7bba6b79dadebcb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal54c16274d3d0b2e3d7bba6b79dadebcb)): ?>
<?php $component = $__componentOriginal54c16274d3d0b2e3d7bba6b79dadebcb; ?>
<?php unset($__componentOriginal54c16274d3d0b2e3d7bba6b79dadebcb); ?>
<?php endif; ?>
    <?php echo $__env->make('frontend.user.client.job.job-details.proposal-js', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/client/job/job-details/proposal-details.blade.php ENDPATH**/ ?>