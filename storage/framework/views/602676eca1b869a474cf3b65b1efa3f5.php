<!-- Sidebar Filter -->
<div id="sidebar" class="fixed inset-0 bg-black/40 z-[9999] hidden ">
    <div class="w-80 bg-white rounded-lg shadow-lg border border-gray-200 p-6 h-screen overflow-y-auto fixed left-0 top-0 custom-scrollbar">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-bold text-base-300"><?php echo e(__('All Filters')); ?></h2>
            <button id="closeSidebar"
                    class="w-[32px] h-[32px] min-w-[32px] min-h-[32px] flex items-center justify-center transition-all duration-300 rounded-md bg-primary/10 hover:bg-primary text-base-300 hover:text-white leading-none p-0">
                <span class="text-2xl leading-none block font-bold" style="margin-top: -4px;">×</span>
            </button>
        </div>

        <!-- Search by Keywords -->
        <div class="mb-8">
            <label class="block text-lg font-medium mb-4 text-base-300 text-black/80"><?php echo e(__('Search by Keywords')); ?></label>
            <div class="relative">
                <svg class="absolute left-3 top-3 w-5 h-5 text-gray-400" fill="none"
                     stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="text" id="job_search_string" placeholder="<?php echo e(__('e.g. Web Developer')); ?>"
                       class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-primary">
            </div>
        </div>

        <!-- Categories -->
        <div class="mb-8">
            <label class="block text-lg font-medium mb-4 text-base-300 text-black/80"><?php echo e(__('Categories')); ?></label>
            <select id="category" class="my-select category_select2 w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-primary bg-white">
                <option value=""><?php echo e(__('Select Category')); ?></option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->category); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <div id="subcategory_info" style="display: none;"></div>
        </div>

        <!-- Subcategories -->
        <div class="mb-8">
            <label class="block text-lg font-medium mb-4 text-base-300 text-black/80"><?php echo e(__('Subcategories')); ?></label>
            <select id="subcategory" class="my-select w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-primary bg-white">
                <option value=""><?php echo e(__('Select Subcategory')); ?></option>
                <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($subcat->id); ?>"><?php echo e($subcat->sub_category); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- Country -->
        <div class="mb-8">
            <label class="block text-lg font-medium mb-4 text-base-300 text-black/80"><?php echo e(__('Country')); ?></label>
            <select id="country" class="my-select country_select2 w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-primary bg-white">
                <option value=""><?php echo e(__('Select Country')); ?></option>
                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($country->id); ?>"><?php echo e($country->country); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <div id="state_info" style="display: none;"></div>
        </div>

        <!-- States -->
        <div class="mb-8">
            <label class="block text-lg font-medium mb-4 text-base-300 text-black/80"><?php echo e(__('States')); ?></label>
            <select id="state" class="my-select w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-primary bg-white">
                <option value=""><?php echo e(__('Select State')); ?></option>
                <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($state->id); ?>"><?php echo e($state->state); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- Experience Level -->
        <div class="mb-8">
            <label class="block text-lg font-medium mb-4 text-base-300 text-black/80"><?php echo e(__('Experience Level')); ?></label>
            <select id="level" class="my-select w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-primary bg-white">
                <option value=""><?php echo e(__('Select Level')); ?></option>
                <option value="junior"><?php echo e(__('Junior')); ?></option>
                <option value="midLevel"><?php echo e(__('Mid Level')); ?></option>
                <option value="senior"><?php echo e(__('Senior')); ?></option>
            </select>
        </div>

        <!-- Job Type -->
        <div class="mb-8">
            <label class="block text-lg font-medium mb-4 text-base-300 text-black/80"><?php echo e(__('Job Type')); ?></label>
            <select id="type" class="my-select w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-primary bg-white">
                <option value=""><?php echo e(__('Select Type')); ?></option>
                <?php if(moduleExists('HourlyJob')): ?>
                    <option value="hourly"><?php echo e(__('Hourly')); ?></option>
                <?php endif; ?>
                <option value="fixed"><?php echo e(__('Fixed')); ?></option>
            </select>
        </div>

        <!-- Price Range -->
        <div class="mb-12">
            <label class="block text-lg font-medium mb-4 text-base-300 text-black/80"><?php echo e(__('Price Range')); ?></label>

            <!-- Price Input Fields -->
            <div class="flex items-center gap-2 mb-4">
                <input type="number" id="min_price" placeholder="Min" min="0"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-primary">
                <span>-</span>
                <input type="number" id="max_price" placeholder="Max" min="0"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-primary">
            </div>

            <!-- Range Slider Container -->
            <div class="relative w-full mb-4">
                <!-- Background Track -->
                <div class="absolute left-0 right-0 h-1 bg-gray-300 rounded-full pointer-events-none top-1/2 transform -translate-y-1/2"></div>

                <!-- Active Track -->
                <div id="rangeTrack" class="absolute h-1 bg-primary rounded-full pointer-events-none top-1/2 transform -translate-y-1/2"></div>

                <!-- Slider Handles -->
                <input type="range" id="priceRangeStart" min="0" max="1000" class="range-slider">
                <input type="range" id="priceRangeEnd" min="0" max="1000" class="range-slider">
            </div>
        </div>

        <!-- Date Posted -->
        <div class="mb-8">
            <label class="block text-lg font-medium mb-4 text-base-300 text-black/80"><?php echo e(__('Date Posted')); ?></label>
            <div class="">
                <div class="flex items-center pb-2">
                    <input type="radio" id="lastHour" name="datePosted"
                           class="w-4 h-4 text-primary cursor-pointer accent-primary">
                    <label for="lastHour" class="ml-3 text-sm text-gray-700 cursor-pointer"><?php echo e(__('Last hour')); ?></label>
                </div>
                <div class="flex items-center pb-2">
                    <input type="radio" id="last24Hours" name="datePosted"
                           class="w-4 h-4 text-primary cursor-pointer accent-primary">
                    <label for="last24Hours" class="ml-3 text-sm text-gray-700 cursor-pointer"><?php echo e(__('Last 24 hours')); ?></label>
                </div>
                <div class="flex items-center pb-2">
                    <input type="radio" id="last7Days" name="datePosted"
                           class="w-4 h-4 text-primary cursor-pointer accent-primary">
                    <label for="last7Days" class="ml-3 text-sm text-gray-700 cursor-pointer"><?php echo e(__('Last 7 days')); ?></label>
                </div>

                <!-- Hidden Extra Options -->
                <div class="hidden" id="extraOptions">
                    <div class="flex items-center pb-2">
                        <input type="radio" id="last30Days" name="datePosted"
                               class="w-4 h-4 text-primary cursor-pointer accent-primary">
                        <label for="last30Days" class="ml-3 text-sm text-gray-700 cursor-pointer"><?php echo e(__('Last 30 days')); ?></label>
                    </div>
                    <div class="flex items-center pb-2">
                        <input type="radio" id="allTime" name="datePosted"
                               class="w-4 h-4 text-primary cursor-pointer accent-primary">
                        <label for="allTime" class="ml-3 text-sm text-gray-700 cursor-pointer"><?php echo e(__('All Time')); ?></label>
                    </div>
                </div>
            </div>

            <!-- Show More/Less Button -->
            <button type="button" id="showMoreBtn"
                    class="text-primary hover:text-teal-700 text-sm font-medium mt-3 flex items-center gap-1 transition-colors">
                <span>+</span> <span><?php echo e(__('Show More')); ?></span>
            </button>
        </div>
    </div>
</div><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/pages/skill-jobs/sidebar.blade.php ENDPATH**/ ?>