<!-- Breadcrumb-->
<section class="pt-[82px] pb-6 border-b border-base-300/10">
    <div class="container mx-auto max-w-8xl px-6">
        <nav class="text-gray-600 font-medium" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex space-x-2">
                <!-- First level (Home/Dashboard) -->
                <li class="flex items-center">
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->user()->user_type == 1): ?>
                            <a href="<?php echo e(route('client.dashboard')); ?>" class="hover:text-primary transition">
                                <?php echo e(__('Dashboard')); ?>

                            </a>
                        <?php else: ?>
                            <a href="<?php echo e(route('freelancer.dashboard')); ?>" class="hover:text-primary transition">
                                <?php echo e(__('Dashboard')); ?>

                            </a>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="<?php echo e(route('homepage')); ?>" class="hover:text-primary transition">
                            <?php echo e(__('Home')); ?>

                        </a>
                    <?php endif; ?>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mx-2 text-gray-400" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </li>

                <!-- Middle levels (optional) -->
                <?php if(isset($middleLinks) && is_array($middleLinks)): ?>
                    <?php $__currentLoopData = $middleLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="flex items-center">
                            <a href="<?php echo e($link['url']); ?>" class="hover:text-primary transition">
                                <?php echo e($link['title']); ?>

                            </a>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mx-2 text-gray-400" fill="none"
                                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

                <!-- Current page -->
                <li class="flex items-center">
                    <span class="text-gray-500"><?php echo e($innerTitle); ?></span>
                </li>
            </ol>
        </nav>
    </div>
</section><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/components/breadcrumb/user-profile-breadcrumb-02.blade.php ENDPATH**/ ?>