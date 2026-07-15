<?php $__env->startSection('meta_title'); ?> <?php echo e($subcategory->meta_title ?? $subcategory->sub_category ?? __('Subcategory Project')); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('meta_description'); ?> <?php echo e($subcategory->meta_description ?? ''); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('site_title'); ?> <?php echo $__env->yieldContent('meta_title'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <main>
        <!-- Breadcrumb -->
        <?php if (isset($component)) { $__componentOriginal5f19dd716048daf403d00235f9f2d409 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5f19dd716048daf403d00235f9f2d409 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.breadcrumb.user-profile-breadcrumb-02','data' => ['title' => $subcategory->sub_category ?? __('Project Category'),'innerTitle' => $subcategory->sub_category ?? '' ]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('breadcrumb.user-profile-breadcrumb-02'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($subcategory->sub_category ?? __('Project Category')),'innerTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($subcategory->sub_category ?? '' )]); ?>
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

        <section class="bg-[#F8F9FD]">
            <div class="max-w-7xl mx-auto px-6 py-8 md:py-12 lg:py-16">
                <div class="mb-8">
                    <h1 class="text-3xl font-medium mb-2 text-base-300"><?php echo e($subcategory->sub_category ?? __('Sub Category Projects')); ?></h1>
                    <p class="text-base-400"><?php echo e(__('Browse all services in this sub category')); ?></p>
                </div>

                <!-- Header Section -->
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-8 overflow-hidden">
                    <div class="flex items-center gap-4">
                        <div id="filter"
                             class="flex items-center gap-2 border border-gray-300 px-4 py-1 rounded-lg cursor-pointer hover:bg-gray-200 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                            </svg>
                            <span class="text-base-400"><?php echo e(__('Filter')); ?></span>
                        </div>
                        <span class="text-base-400 project-count-display"><?php echo e(__('Showing')); ?> <?php echo e($projects->count()); ?> <?php echo e(__('out of')); ?> <?php echo e($projects->total()); ?> <?php echo e(__('results')); ?></span>
                    </div>

                    <div class="flex items-center gap-3 whitespace-nowrap md:self-auto w-full sm:w-auto justify-end">
                        <span class="text-base-400 font-medium"><?php echo e(__('Sort by')); ?></span>
                        <div class="relative min-w-[180px] w-full sm:w-auto">
                            <select title="sort by" id="sort_by"
                                    class="my-select w-full px-4 py-2.5 border border-gray-300 rounded-lg bg-white text-gray-700 cursor-pointer appearance-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                                <option value=""><?php echo e(__('Default')); ?></option>
                                <option value="newest"><?php echo e(__('Newest')); ?></option>
                                <option value="oldest"><?php echo e(__('Oldest')); ?></option>
                                <option value="price_high"><?php echo e(__('Price: High to Low')); ?></option>
                                <option value="price_low"><?php echo e(__('Price: Low to High')); ?></option>
                            </select>
                            <!-- Custom dropdown arrow -->
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Filters Display -->
                <div class="active-filters-section" style="display: none;">
                    <h4 class="text-lg font-medium mb-2"><?php echo e(__('You selected')); ?></h4>
                    <div class="flex items-center justify-between mb-12">
                        <div class="flex flex-wrap gap-2" id="active-filters-container">
                            <!-- Active filters will be inserted here -->
                        </div>
                        <span id="clear-all-filters"
                              class="px-3 py-1 bg-primary text-white hover:bg-red-600 cursor-pointer flex items-center justify-center gap-0 rounded-full text-xs">
                        <?php echo e(__('Clear All')); ?>

                    </span>
                    </div>
                </div>

                <input type="hidden" id="subcategory_id" value="<?php echo e($subcategory->id ?? ''); ?>">

                <!-- Projects Grid -->
                <div class="search_category_result">
                    <?php echo $__env->make('frontend.pages.subcategory-projects.search-subcategory-result', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>

                <script>
                    window.maxProjectPrice = <?php echo e($maxProjectPrice ?? 1000); ?>;
                </script>

                <!-- Sidebar Filter -->
                <?php echo $__env->make('frontend.pages.subcategory-projects.sidebar', [
                    'maxProjectPrice' => $maxProjectPrice,
                    'subcategory' => $subcategory,
                    'categories' => $categories,
                    'subcategories' => $subcategories,
                    'skills' => $skills,
                    'countries' => $countries,
                    'states' => $states
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
        </section>
    </main>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo $__env->make('frontend.pages.subcategory-projects.subcategory-project-filter-js', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.new_design.layout.new_master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/pages/subcategory-projects/projects.blade.php ENDPATH**/ ?>