<?php $__env->startSection('page-meta-data'); ?>
    <?php echo render_page_meta_data_for_job($job_details); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <main>
        <!-- Breadcrumb -->
        <?php if (isset($component)) { $__componentOriginal5f19dd716048daf403d00235f9f2d409 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5f19dd716048daf403d00235f9f2d409 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.breadcrumb.user-profile-breadcrumb-02','data' => ['innerTitle' => __('Job Details')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('breadcrumb.user-profile-breadcrumb-02'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['innerTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Job Details'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5f19dd716048daf403d00235f9f2d409)): ?>
<?php $attributes = $__attributesOriginal5f19dd716048daf403d00235f9f2d409; ?>
<?php unset($__attributesOriginal5f19dd716048daf403d00235f9f2d409); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5f19dd716048daf403d00235f9f2d409)): ?>
<?php $component = $__componentOriginal5f19dd716048daf403d00235f9f2d409; ?>
<?php unset($__componentOriginal5f19dd716048daf403d00235f9f2d409); ?>
<?php endif; ?>

        <div class="max-w-7xl mx-auto px-6 py-12 md:py-20 lg:py-28">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-4">
                    <!-- Header -->
                    <div>
                        <!-- Job Title and Download Button Row -->
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                            <h1 class="text-3xl font-medium"><?php echo e($job_details->title); ?></h1>

                            <!-- Attachment Download Button - Moved here -->
                            <?php if(Auth::guard('web')->check() && $job_details->attachment): ?>
                                <?php if(file_exists(base_path('../assets/uploads/jobs/' . $job_details->attachment))): ?>
                                    <a href="<?php echo e(asset('assets/uploads/jobs/' . $job_details->attachment)); ?>"
                                       download class="inline-block px-4 py-2 bg-primary text-white rounded-lg hover:bg-secondary transition-colors duration-300">
                                        <i class="fa-solid fa-cloud-arrow-down mr-2"></i><?php echo e(__('Download Attachment')); ?>

                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <!-- Job Overview -->
                        <h2 class="text-2xl font-medium mb-4">Job Overview</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-6 border border-base-300/10 p-6 rounded-xl">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-primary/5 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="icon-base ti tabler-file-dollar icon-24px text-primary"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium mb-1">Budget</h4>
                                    <span class="text-base-400"><?php echo e($job_details->display_price); ?></span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-primary/5 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="icon-base ti tabler-chart-arrows-vertical icon-24px text-primary"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium mb-1">Level</h4>
                                    <span class="text-base-400"><?php echo e(ucfirst($job_details->level ?? 'N/A')); ?></span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-primary/5 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="icon-base ti tabler-map-pin icon-24px text-primary"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium mb-1">Location</h4>
                                    <span class="text-base-400"><?php echo e($user->user_country->country ?? 'N/A'); ?></span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-primary/5 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="icon-base ti tabler-calendar-event icon-24px text-primary"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium mb-1">Job Posted</h4>
                                    <span class="text-base-400"><?php echo e($job_details->created_at->format('d M, Y')); ?></span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-primary/5 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="icon-base ti tabler-category-2 icon-24px text-primary"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium mb-1">Category</h4>
                                    <span class="text-base-400"><?php echo e($job_details->job_category->category ?? 'N/A'); ?></span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-primary/5 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="icon-base ti tabler-file-analytics icon-24px text-primary"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium mb-1">Total Proposals</h4>
                                    <span class="text-base-400"><?php echo e($job_details->job_proposals->count()); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Job Description -->
                    <div>
                        <h2 class="text-xl font-medium mb-4">Job Description</h2>
                        <div class="text-base-400 mb-6 prose max-w-none">
                            <?php echo html_entity_decode($job_details->description); ?>

                        </div>

                        <!-- Skills Section - Handle both cases: with skills and without skills -->
                        <h3 class="font-medium text-lg mb-3">Skills</h3>
                        <?php if($job_details->job_skills && $job_details->job_skills->count() > 0): ?>
                            <ul class="space-y-2 mb-6">
                                <?php $__currentLoopData = $job_details->job_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="flex items-start">
                                        <svg class="w-5 h-5 text-primary/70 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="text-base-400"><?php echo e($skill->skill); ?></span>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php else: ?>
                            <p class="text-base-400 mb-6">No Skills Required</p>
                        <?php endif; ?>

                        <!-- Tags Section - Only show if skills exist -->
                        <?php if($job_details->job_skills && $job_details->job_skills->count() > 0): ?>
                            <h3 class="font-medium text-lg mb-3">Tags</h3>
                            <div class="flex flex-wrap gap-2">
                                <?php $__currentLoopData = $job_details->job_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="px-3 py-1 bg-gray-100 rounded-full text-sm"><?php echo e($skill->skill); ?></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- Author Spotlight -->
                    <div>
                        <h2 class="text-2xl font-medium mb-4 pt-4">Author Spotlight</h2>
                        <div class="flex items-start space-x-4 bg-primary/5 p-6 rounded-xl">
                            <img src="<?php echo e($user->image ? asset('assets/uploads/profile/' . $user->image) : asset('assets/images/default-user.png')); ?>"
                                 alt="<?php echo e($user->fullname); ?>" class="w-16 h-16 rounded-full">
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-1">
                                    <h3 class="font-medium"><?php echo e($user->fullname); ?></h3>
                                    <?php if($user->is_pro_freelancer): ?>
                                        <i class="icon-base ti tabler-rosette-discount-check-filled icon-20px text-primary"></i>
                                    <?php endif; ?>
                                </div>
                                <p class="text-sm text-base-400 mb-3"><?php echo e($user->user_type == 2 ? 'Freelancer' : 'Client'); ?></p>
                                <p class="text-base-400 text-sm"><?php echo e($user->user_introduction?->description ?? 'No description available.'); ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- Related Jobs -->
                    <div>
                        <h2 class="text-2xl font-medium mb-4 pt-4">Related Jobs</h2>
                        <?php
                            $related_jobs = \App\Models\JobPost::where('category', $job_details->category)
                                ->where('id', '!=', $job_details->id)
                                ->where('status', 1)
                                ->with('job_creator', 'job_category')
                                ->take(4)
                                ->get();
                        ?>
                        <?php if($related_jobs->isNotEmpty()): ?>
                            <div class="space-y-4">
                                <?php $__currentLoopData = $related_jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow duration-300">
                                        <div class="flex justify-between items-start mb-4">
                                            <h3 class="text-lg font-medium text-base-300 hover:underline cursor-pointer">
                                                <a href="<?php echo e(route('job.details', ['username' => $job->job_creator->username, 'slug' => $job->slug])); ?>">
                                                    <?php echo e($job->title); ?>

                                                </a>
                                            </h3>
                                            <?php if($job->created_at->diffInHours(now()) <= 24): ?>
                                                <span class="bg-secondary text-white text-xs px-3 py-1 rounded-md">New</span>
                                            <?php endif; ?>
                                        </div>

                                        <div class="flex items-center gap-2 mb-4 text-base-400">
                                            <span><?php echo e($job->created_at->diffForHumans()); ?></span>
                                            <span class="text-secondary font-extrabold">•</span>
                                            <span class="font-medium text-base-300"><?php echo e(ucfirst($job->level ?? 'N/A')); ?></span>
                                        </div>

                                        <div class="flex items-center gap-2 mb-4">
                                            <div class="flex items-center gap-2">
                                                <span class="text-xl font-medium text-base-300"><?php echo e($job->display_price); ?></span>
                                                <span class="text-sm text-base-400 bg-gray-200 px-4 rounded-full py-1">
                                                    <?php echo e($job->type == 'hourly' ? 'Hourly' : 'Fixed'); ?>

                                                </span>
                                            </div>
                                        </div>

                                        <p class="text-base-400 mb-4 line-clamp-2"><?php echo e(Str::limit(strip_tags($job->description), 120)); ?></p>

                                        <div class="flex gap-2 mb-6 flex-wrap">
                                            <?php $__currentLoopData = $job->job_skills->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <span class="px-3 py-2 text-base-400 border-gray-400 border text-xs rounded-full">
                                                    <?php echo e($skill->skill); ?>

                                                </span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>

                                        <a href="<?php echo e(route('job.details', ['username' => $job->job_creator->username, 'slug' => $job->slug])); ?>"
                                           class="text-primary font-medium text-sm border px-4 py-2 border-primary rounded-lg hover:bg-primary hover:text-white duration-300 inline-flex items-center gap-1 hover:gap-2 transition-all">
                                            View More
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                            </svg>
                                        </a>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php else: ?>
                            <p class="text-base-400">No related jobs found.</p>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="sticky top-20 space-y-6">
                        <!-- Profile and Job Info -->
                        <div class="rounded-lg shadow-sm p-6 border">
                            <!-- Profile -->
                            <div class="flex items-center space-x-3 mb-6">
                                <img src="<?php echo e($user->image ? asset('assets/uploads/profile/' . $user->image) : asset('assets/images/default-user.png')); ?>"
                                     alt="<?php echo e($user->fullname); ?>" class="w-12 h-12 rounded-full">
                                <div>
                                    <div class="flex items-center space-x-1">
                                        <h3 class="font-semibold"><?php echo e($user->fullname); ?></h3>
                                        <?php if($user->is_pro_freelancer): ?>
                                            <i class="icon-base ti tabler-rosette-discount-check-filled icon-20px text-primary"></i>
                                        <?php endif; ?>
                                    </div>
                                    <p class="text-sm text-base-400"><?php echo e($user->user_country->country ?? 'N/A'); ?></p>
                                </div>
                            </div>
                            <hr>
                            <!-- Job Info -->
                            <div>
                                <div class="flex items-center justify-between py-2 mt-3">
                                    <div class="flex items-center gap-1">
                                        <i class="icon-base ti tabler-user-square icon-18px text-primary"></i>
                                        <span class="text-sm text-base-400"><?php echo e(__('Member Since')); ?></span>
                                    </div>
                                    <span class="text-sm font-medium"><?php echo e($user->created_at->format('M d, Y')); ?></span>
                                </div>
                                <div class="flex items-center justify-between py-2">
                                    <div class="flex items-center gap-1">
                                        <i class="icon-base ti tabler-briefcase-2 icon-18px text-primary"></i>
                                        <span class="text-sm text-base-400"><?php echo e(__('Total Created Jobs')); ?></span>
                                    </div>
                                    <span class="text-sm font-medium"><?php echo e($user->user_jobs->count()); ?></span>
                                </div>
                            </div>
                        </div>
                        <!-- Apply Button (Desktop) -->
                        <?php if(Auth::guard('web')->check()): ?>
                            <?php if(Auth::user()->user_type == 1): ?>
                                
                                <div class="text-center p-4 bg-gray-100 rounded-lg">
                                    <p class="text-base-400 text-sm"><?php echo e(__('Only freelancers can apply to jobs.')); ?></p>
                                </div>
                            <?php elseif(Auth::user()->id == $job_details->user_id): ?>
                                
                                <div class="text-center p-4 bg-gray-100 rounded-lg">
                                    <p class="text-base-400 text-sm"><?php echo e(__('This is your job posting')); ?></p>
                                </div>
                            <?php elseif($canApply && !$isCountryRestricted): ?>
                                
                                <button class="openModal hidden lg:block w-full bg-primary text-white py-3 rounded-lg font-medium hover:bg-secondary transition-colors duration-300">
                                    <?php echo e(__('Apply Job')); ?> <i class="icon-base ti tabler-arrow-up-right icon-24px text-white"></i>
                                </button>
                            <?php else: ?>
                                
                                <div class="text-center p-4 bg-gray-100 rounded-lg">
                                    <p class="text-red-600 text-sm">
                                        <?php echo e($isCountryRestricted ? $countryRestrictionMessage : $restrictionMessage); ?>

                                    </p>
                                    <?php if($requiresProfileUpdate): ?>
                                        <a href="<?php echo e(route('freelancer.profile')); ?>"
                                           class="mt-2 inline-block bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-300">
                                            <?php echo e(__('Update Profile')); ?>

                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            
                            <button class="openLoginModalForJob hidden lg:block w-full bg-primary text-white py-3 rounded-lg font-medium hover:bg-secondary transition-colors duration-300">
                                <?php echo e(__('Apply Job')); ?>

                                <i class="icon-base ti tabler-arrow-up-right icon-24px text-white"></i>
                            </button>
                        <?php endif; ?>

                        <!-- Apply Button (Mobile) -->
                        <?php if(Auth::guard('web')->check()): ?>
                            <?php if(Auth::user()->user_type == 1): ?>
                                
                                <div class="sticky lg:hidden bg-white py-6 left-4 right-4 bottom-0 z-[1001]">
                                    <div class="text-center p-4 bg-gray-100 rounded-lg">
                                        <p class="text-base-400 text-sm"><?php echo e(__('Only freelancers can apply to jobs.')); ?></p>
                                    </div>
                                </div>
                            <?php elseif(Auth::user()->id == $job_details->user_id): ?>
                                
                                <div class="sticky lg:hidden bg-white py-6 left-4 right-4 bottom-0 z-[1001]">
                                    <div class="text-center p-4 bg-gray-100 rounded-lg">
                                        <p class="text-base-400 text-sm"><?php echo e(__('This is your job posting')); ?></p>
                                    </div>
                                </div>
                            <?php elseif($canApply && !$isCountryRestricted): ?>
                                
                                <div class="sticky lg:hidden bg-white py-6 left-4 right-4 bottom-0 z-[1001]">
                                    <button class="openModal w-full bg-primary text-white py-3 rounded-lg font-medium hover:bg-secondary transition-colors duration-300">
                                        <?php echo e(__('Apply Job')); ?>

                                        <i class="icon-base ti tabler-arrow-up-right icon-24px text-white"></i>
                                    </button>
                                </div>
                            <?php else: ?>
                                
                                <div class="sticky lg:hidden bg-white py-6 left-4 right-4 bottom-0 z-[1001]">
                                    <div class="text-center p-4 bg-gray-100 rounded-lg">
                                        <p class="text-red-600 text-sm">
                                            <?php echo e($isCountryRestricted ? $countryRestrictionMessage : $restrictionMessage); ?>

                                        </p>
                                        <?php if($requiresProfileUpdate): ?>
                                            <a href="<?php echo e(route('freelancer.profile')); ?>"
                                               class="mt-2 inline-block bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-300">
                                                <?php echo e(__('Update Profile')); ?>

                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            
                            <div class="sticky lg:hidden bg-white py-6 left-4 right-4 bottom-0 z-[1001]">
                                <button class="openLoginModalForJob w-full bg-primary text-white py-3 rounded-lg font-medium hover:bg-secondary transition-colors duration-300 text-center">
                                    <?php echo e(__('Apply Job')); ?>

                                    <i class="icon-base ti tabler-arrow-up-right icon-24px text-white"></i>
                                </button>
                            </div>
                        <?php endif; ?>


                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Overlay -->
        <div id="modalOverlay" class="fixed inset-0 bg-black/40 z-[9999] hidden flex items-center justify-center px-4">
            <div class="bg-white rounded-xl shadow-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto custom-scrollbar">
                <!-- Modal Header -->
                <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between rounded-t-xl">
                    <h2 class="text-2xl font-semibold">
                        <?php echo e(__('Submit Proposal')); ?>

                    </h2>
                    <button id="closeModal" class="text-gray-400 hover:text-base-400 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <!-- Modal Body -->
                <div class="p-6">
                    <!-- Error Messages Container -->
                    <div id="errorMessages" class="mb-4 hidden">
                        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <ul id="errorList" class="list-disc list-inside"></ul>
                        </div>
                    </div>

                    <!-- Success Message Container -->
                    <div id="successMessage" class="mb-4 hidden">
                        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <span id="successText"></span>
                        </div>
                    </div>

                    <form id="proposalForm" action="<?php echo e(route('job.proposal.send')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="job_id" value="<?php echo e($job_details->id); ?>">
                        <input type="hidden" name="client_id" value="<?php echo e($user->id); ?>">
                        <!-- Proposal Amount and Delivery Time Row -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block font-medium mb-2"><?php echo e(__('Proposal amount')); ?></label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-medium">USD</span>
                                    <input type="number" name="amount" placeholder="0"
                                           value="<?php echo e($job_details->type == 'hourly' ? $job_details->hourly_rate : $job_details->budget); ?>"
                                           class="w-full pl-16 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent outline-none transition-all" id="proposalAmount" required>
                                </div>
                            </div>
                            <!-- Delivery Time Dropdown - FIXED CODE -->
                            <div class="relative">
                                <label class="block font-medium mb-2"><?php echo e(__('Delivery Time')); ?></label>
                                <select name="duration"
                                        class="my-select delivery-time-select w-full px-4 py-5 border border-gray-300 rounded-lg bg-white text-gray-700 cursor-pointer appearance-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all pr-10"
                                        id="deliveryTime"
                                        required>
                                    <option value=""><?php echo e(__('Select delivery time')); ?></option>
                                    <option value="1-3 days"><?php echo e(__('1-3 days')); ?></option>
                                    <option value="3-5 days"><?php echo e(__('3-5 days')); ?></option>
                                    <option value="1-2 weeks"><?php echo e(__('1-2 weeks')); ?></option>
                                    <option value="2-4 weeks"><?php echo e(__('2-4 weeks')); ?></option>
                                    <option value="1 month+"><?php echo e(__('1 month+')); ?></option>
                                </select>
                                <!-- Custom dropdown arrow -->
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-700" style="bottom: 8px">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <!-- Revision -->
                        <div class="mb-6">
                            <label class="block font-medium mb-2">Revision</label>
                            <input type="number" name="revision" placeholder="Job revision must be number"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent outline-none transition-all" id="revision" min="0" max="100" required>
                        </div>
                        <!-- Cover Letter -->
                        <div class="mb-6">
                            <label class="block font-medium mb-2">Your cover letter</label>
                            <textarea name="cover_letter" placeholder="Write your cover letter ..." rows="6"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent outline-none transition-all resize-none" id="coverLetter" maxlength="1000" required></textarea>
                            <div class="text-right text-sm text-gray-500 mt-1">
                                <span id="charCount">0</span>/1000 max
                            </div>
                        </div>
                        <!-- File Upload -->
                        <div class="mb-6">
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center bg-gray-50 hover:bg-gray-100 transition-colors">
                                <input type="file" name="attachment" id="fileInput" class="hidden" accept=".png,.jpg,.jpeg,.bmp,.gif,.tiff,.svg,.csv,.txt,.xlx,.xls,.pdf,.docx">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                    <!-- Only the button triggers file selection -->
                                    <label for="fileInput" class="cursor-pointer">
                                        <span class="px-4 py-2 border border-gray-300 rounded-lg font-medium hover:bg-white transition-colors inline-block">Choose File</span>
                                    </label>
                                    <p class="text-gray-500 mt-2" id="fileStatus">No file chosen</p>
                                </div>
                            </div>
                        </div>
                        <!-- Submit Button -->
                        <button type="submit" class="w-full md:w-auto bg-primary text-white px-8 py-3 rounded-lg font-medium hover:bg-teal-700 transition-colors">Send Proposal</button>
                    </form>
                </div>
            </div>
        </div>

    </main>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        console.log('job_details.js script section loaded');

        $(document).ready(function () {
            console.log('jQuery ready in script section');

            // Setup AJAX to include CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            console.log('CSRF Token:', $('meta[name="csrf-token"]').attr('content'));

            const modalOverlay = $('#modalOverlay');
            const openModalBtn = $('.openModal');
            const closeModalBtn = $('#closeModal');
            const proposalForm = $('#proposalForm');
            const coverLetter = $('#coverLetter');
            const charCount = $('#charCount');
            const fileInput = $('#fileInput');
            const fileStatus = $('#fileStatus');

            console.log('Form found:', proposalForm.length);
            console.log('Form action:', proposalForm.attr('action'));

            // Open modal
            openModalBtn.on('click', function () {
                console.log('Open modal clicked');
                modalOverlay.removeClass('hidden').addClass('flex');
                $('body').css('overflow', 'hidden');
            });

            // Close modal
            function closeModal() {
                modalOverlay.addClass('hidden').removeClass('flex');
                $('body').css('overflow', 'auto');
            }

            closeModalBtn.on('click', closeModal);

            // Close modal when clicking outside
            modalOverlay.on('click', function (e) {
                if ($(e.target).is(modalOverlay)) {
                    closeModal();
                }
            });

            // Close modal on Escape key
            $(document).on('keydown', function (e) {
                if (e.key === 'Escape' && !modalOverlay.hasClass('hidden')) {
                    closeModal();
                }
            });

            // Character counter
            coverLetter.on('input', function () {
                const count = $(this).val().length;
                charCount.text(count);
            });

            // File input change
            fileInput.on('change', function () {
                const files = this.files;
                if (files.length > 0) {
                    if (files.length === 1) {
                        fileStatus.text(files[0].name);
                    } else {
                        fileStatus.text(files.length + ' files selected');
                    }
                } else {
                    fileStatus.text('No file chosen');
                }
            });

            // Helper function to show errors
            function showError(messages) {
                console.log('Showing errors:', messages);
                $('#errorList').empty();
                messages.forEach(function(message) {
                    $('#errorList').append('<li>' + message + '</li>');
                });
                $('#errorMessages').removeClass('hidden');

                // Scroll to error message within modal
                $('#modalOverlay .overflow-y-auto').animate({
                    scrollTop: 0
                }, 300);
            }

            // Revision number validation
            function inpNum(e) {
                e = e || window.event;
                let charCode = (typeof e.which == "undefined") ? e.keyCode : e.which;
                let charStr = String.fromCharCode(charCode);
                if (!charStr.match(/^[0-9]+$/)) {
                    e.preventDefault();
                }
            }
            $("#revision").on("keypress", inpNum);

            // Form submission with AJAX
            proposalForm.on('submit', function (e) {
                e.preventDefault();
                console.log('Form submitted');

                // Clear previous messages
                $('#errorMessages').addClass('hidden');
                $('#successMessage').addClass('hidden');
                $('#errorList').empty();

                // Client-side validation
                const amount = $('#proposalAmount').val();
                const deliveryTime = $('#deliveryTime').val();
                const revision = $('#revision').val();
                const coverLetterText = coverLetter.val();

                console.log('Form values:', {
                    amount: amount,
                    deliveryTime: deliveryTime,
                    revision: revision,
                    coverLetterLength: coverLetterText.length
                });

                // Validation
                if (!amount || !deliveryTime || !revision || !coverLetterText) {
                    showError(['Please fill in all required fields']);
                    return false;
                }

                if (coverLetterText.length < 10) {
                    showError(['Cover letter must be at least 10 characters long']);
                    return false;
                }

                if (parseFloat(amount) <= 0) {
                    showError(['Proposal amount must be greater than 0']);
                    return false;
                }

                const revisionNum = parseInt(revision);
                if (revisionNum < 0 || revisionNum > 100) {
                    showError(['Revision must be between 0 and 100']);
                    return false;
                }

                // Prepare form data
                const formData = new FormData(this);

                console.log('Sending AJAX request to:', proposalForm.attr('action'));

                // Disable submit button to prevent double submission
                const submitBtn = proposalForm.find('button[type="submit"]');
                const originalBtnText = submitBtn.html();
                submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i>Sending...');

                // Submit via AJAX
                $.ajax({
                    url: proposalForm.attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log('Success response:', response);
                        // Show success message
                        $('#successText').text('Proposal successfully sent!');
                        $('#successMessage').removeClass('hidden');

                        // Reset form
                        proposalForm[0].reset();
                        charCount.text('0');
                        fileStatus.text('No file chosen');

                        // Close modal after 2 seconds and reload page
                        setTimeout(function() {
                            closeModal();
                            location.reload();
                        }, 2000);
                    },
                    error: function(xhr) {
                        console.log('Error response:', xhr);
                        console.log('Status:', xhr.status);
                        console.log('Response:', xhr.responseJSON);

                        // Handle validation errors
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            const errorMessages = [];

                            $.each(errors, function(key, value) {
                                if (Array.isArray(value)) {
                                    errorMessages.push(...value);
                                } else {
                                    errorMessages.push(value);
                                }
                            });

                            showError(errorMessages);
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            showError([xhr.responseJSON.message]);
                        } else {
                            showError(['An error occurred. Please try again.']);
                        }
                    },
                    complete: function() {
                        // Re-enable submit button
                        submitBtn.prop('disabled', false).html(originalBtnText);
                    }
                });
            });
        });
        // Handle "Apply Job" button click when not logged in
        $('.openLoginModalForJob').on('click', function(e) {
            e.preventDefault();

            // Open the login modal
            $('#loginModal').removeClass('hidden').addClass('flex');
            $('body').addClass('overflow-hidden');
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.new_design.layout.new_master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/pages/job-details/job-details.blade.php ENDPATH**/ ?>