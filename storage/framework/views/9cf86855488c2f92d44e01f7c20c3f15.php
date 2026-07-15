<!-- Sidebar Filter -->
<div id="sidebar" class="fixed inset-0 bg-black/40 z-[9999] hidden">
    <div class="w-80 bg-white rounded-lg shadow-lg border border-gray-200 p-6 h-screen overflow-y-auto fixed left-0 top-0 custom-scrollbar overflow-hidden">
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
                <input type="text" id="job_search_string" placeholder="<?php echo e(__('e.g. Adobe photoshop')); ?>"
                       class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-primary">
            </div>
        </div>

        <!-- Categories (Hidden since we're in a category) -->
        <input type="hidden" id="category" value="<?php echo e($category->id ?? ''); ?>">

        <!-- Subcategories (Only for this category) -->
        <div class="mb-8">
            <label class="block text-lg font-medium mb-4 text-base-300 text-black/80"><?php echo e(__('Subcategories')); ?></label>
            <select id="subcategory" class="my-select custom-select w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-primary bg-white">
                <option value=""><?php echo e(__('Select Subcategory')); ?></option>
                <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($subcat->id); ?>"><?php echo e($subcat->sub_category); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- Skills (Only for this category) -->
        <div class="mb-8">
            <label class="block text-lg font-medium mb-4 text-base-300 text-black/80"><?php echo e(__('Skills')); ?></label>
            <select id="skills" class="my-select custom-select w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-primary bg-white">
                <option value=""><?php echo e(__('Select Skill')); ?></option>
                <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($skill->id); ?>"><?php echo e($skill->skill); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- Country -->
        <div class="mb-8">
            <label class="block text-lg font-medium mb-4 text-base-300 text-black/80"><?php echo e(__('Country')); ?></label>
            <select id="country" class="my-select custom-select w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-primary bg-white">
                <option value=""><?php echo e(__('Select Country')); ?></option>
                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($country->id); ?>"><?php echo e($country->country); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- States -->
        <div class="mb-8">
            <label class="block text-lg font-medium mb-4 text-base-300 text-black/80"><?php echo e(__('States')); ?></label>
            <select id="state" class="my-select custom-select w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-primary bg-white">
                <option value=""><?php echo e(__('Select State')); ?></option>
                <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($state->id); ?>"><?php echo e($state->state); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- Delivery Time -->
        <div class="mb-8">
            <label class="block text-lg font-medium mb-4 text-base-300 text-black/80"><?php echo e(__('Delivery Time')); ?></label>
            <select id="delivery_day" class="my-select custom-select w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-primary bg-white">
                <option value=""><?php echo e(__('Select Delivery Time')); ?></option>
                <?php $all_lengths = \App\Models\Length::where('status',1)->get() ?>
                <?php if($all_lengths->count() >= 1): ?>
                    <?php $__currentLoopData = $all_lengths; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $length): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($length->length); ?>"><?php echo e($length->length); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <option value="1"><?php echo e(__('1 Day')); ?></option>
                    <option value="2"><?php echo e(__('2 Days')); ?></option>
                    <option value="3"><?php echo e(__('3 Days')); ?></option>
                    <option value="7"><?php echo e(__('7 Days')); ?></option>
                    <option value="14"><?php echo e(__('14 Days')); ?></option>
                    <option value="30"><?php echo e(__('30 Days')); ?></option>
                <?php endif; ?>
            </select>
        </div>

        <!-- Experience Level -->
        <div class="mb-8">
            <label class="block text-lg font-medium mb-4 text-base-300 text-black/80"><?php echo e(__('Experience Level')); ?></label>
            <select id="level" class="my-select custom-select w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-primary bg-white">
                <option value=""><?php echo e(__('Select Experience Level')); ?></option>
                <?php $experienceLevels = \App\Models\ExperienceLevel::where('status', 1)->get() ?>
                <?php $__currentLoopData = $experienceLevels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($level->level); ?>"><?php echo e($level->level); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- Price Range -->
        <div class="mb-12">
            <label class="block text-lg font-medium mb-4 text-base-300 text-black/80"><?php echo e(__('Price Range')); ?></label>
            <div class="flex items-center gap-2 mb-4">
                <input type="text" id="priceMin" placeholder="0"
                       class="w-full px-3 py-2 border rounded-lg text-sm focus:outline-primary" />
                <span>-</span>
                <input type="text" id="priceMax" placeholder="<?php echo e($maxProjectPrice ?? 1000); ?>"
                       class="w-full px-3 py-2 border rounded-lg text-sm focus:outline-primary" />
            </div>

            <div class="relative w-full">
                <div class="absolute top-1/2 left-0 right-0 h-1 bg-gray-300 rounded-full -translate-y-1/2"></div>
                <div id="rangeTrack" class="absolute top-1/2 h-1 bg-primary rounded-full -translate-y-1/2"></div>

                <input type="range" id="priceRangeStart" min="0" max="<?php echo e($maxProjectPrice ?? 1000); ?>" value="0" class="range-slider">
                <input type="range" id="priceRangeEnd" min="0" max="<?php echo e($maxProjectPrice ?? 1000); ?>" value="<?php echo e($maxProjectPrice ?? 1000); ?>" class="range-slider">
            </div>
        </div>

        <!-- Choose Ratings Section -->
        <div class="mb-8">
            <label class="block text-lg font-medium mb-4 text-black/80"><?php echo e(__('Choose Rating')); ?></label>
            <div>
                <div class="flex items-center pb-2">
                    <input type="radio" id="rating1" name="rating" value="1"
                           class="w-4 h-4 text-primary cursor-pointer accent-teal-600">
                    <label for="rating1" class="ml-3 text-sm text-gray-700 cursor-pointer flex items-center gap-0.5">
                        <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-gray-300"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-gray-300"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-gray-300"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-gray-300"></i>
                    </label>
                </div>
                <div class="flex items-center pb-2">
                    <input type="radio" id="rating2" name="rating" value="2"
                           class="w-4 h-4 text-primary cursor-pointer accent-teal-600">
                    <label for="rating2" class="ml-3 text-sm text-gray-700 cursor-pointer flex items-center gap-0.5">
                        <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-gray-300"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-gray-300"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-gray-300"></i>
                    </label>
                </div>
                <div class="flex items-center pb-2">
                    <input type="radio" id="rating3" name="rating" value="3"
                           class="w-4 h-4 text-primary cursor-pointer accent-teal-600">
                    <label for="rating3" class="ml-3 text-sm text-gray-700 cursor-pointer flex items-center gap-0.5">
                        <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-gray-300"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-gray-300"></i>
                    </label>
                </div>
                <div class="flex items-center pb-2">
                    <input type="radio" id="rating4" name="rating" value="4"
                           class="w-4 h-4 text-primary cursor-pointer accent-teal-600">
                    <label for="rating4" class="ml-3 text-sm text-gray-700 cursor-pointer flex items-center gap-0.5">
                        <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-gray-300"></i>
                    </label>
                </div>
                <div class="flex items-center pb-2">
                    <input type="radio" id="rating5" name="rating" value="5"
                           class="w-4 h-4 text-primary cursor-pointer accent-teal-600">
                    <label for="rating5" class="ml-3 text-sm text-gray-700 cursor-pointer flex items-center gap-0.5">
                        <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                    </label>
                </div>
                <div class="flex items-center">
                    <input type="radio" id="ratingAll" name="rating" value=""
                           class="w-4 h-4 text-primary cursor-pointer accent-teal-600">
                    <label for="ratingAll" class="ml-3 text-sm text-gray-700 cursor-pointer"><?php echo e(__('All')); ?></label>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/pages/category-projects/sidebar.blade.php ENDPATH**/ ?>