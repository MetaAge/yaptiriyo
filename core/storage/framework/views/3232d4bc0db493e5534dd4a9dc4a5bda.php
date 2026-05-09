<!-- Pagination -->
<?php if($allData->hasPages()): ?>
    <div class="flex justify-center items-center flex-wrap gap-2">
        
        <?php if($allData->onFirstPage()): ?>
            <button disabled class="flex items-center gap-1 px-3 py-1 border border-gray-300 rounded-full text-base-400 opacity-50 cursor-not-allowed">
                <i class="fa-solid fa-angle-left"></i>
                <span><?php echo e(__('Prev')); ?></span>
            </button>
        <?php else: ?>
            <a href="javascript:void(0)" data-url="<?php echo e($allData->previousPageUrl()); ?>" class="pagination-link flex items-center gap-1 px-3 py-1 border border-gray-300 rounded-full text-base-400 hover:border-gray-400 transition-colors duration-300">
                <i class="fa-solid fa-angle-left"></i>
                <span><?php echo e(__('Prev')); ?></span>
            </a>
        <?php endif; ?>

        
        <?php
            $currentPage = $allData->currentPage();
            $lastPage = $allData->lastPage();
            $start = max(1, $currentPage - 2);
            $end = min($lastPage, $currentPage + 2);
        ?>

        
        <?php if($start > 1): ?>
            <a href="javascript:void(0)" data-url="<?php echo e($allData->url(1)); ?>" class="pagination-link w-8 h-8 border border-gray-300 rounded-full text-base-400 hover:border-gray-400 transition-colors duration-300 font-medium flex items-center justify-center text-sm">1</a>
            <?php if($start > 2): ?>
                <span class="px-2 text-gray-500">...</span>
            <?php endif; ?>
        <?php endif; ?>

        
        <?php for($page = $start; $page <= $end; $page++): ?>
            <?php if($page == $currentPage): ?>
                <button class="w-8 h-8 border border-gray-300 rounded-full text-white bg-secondary hover:border-gray-400 transition-colors duration-300 font-medium flex items-center justify-center text-sm"><?php echo e($page); ?></button>
            <?php else: ?>
                <a href="javascript:void(0)" data-url="<?php echo e($allData->url($page)); ?>" class="pagination-link w-8 h-8 border border-gray-300 rounded-full text-base-400 hover:border-gray-400 transition-colors duration-300 font-medium flex items-center justify-center text-sm"><?php echo e($page); ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        
        <?php if($end < $lastPage): ?>
            <?php if($end < $lastPage - 1): ?>
                <span class="px-2 text-gray-500">...</span>
            <?php endif; ?>
            <a href="javascript:void(0)" data-url="<?php echo e($allData->url($lastPage)); ?>" class="pagination-link w-8 h-8 border border-gray-300 rounded-full text-base-400 hover:border-gray-400 transition-colors duration-300 font-medium flex items-center justify-center text-sm"><?php echo e($lastPage); ?></a>
        <?php endif; ?>

        
        <?php if($allData->hasMorePages()): ?>
            <a href="javascript:void(0)" data-url="<?php echo e($allData->nextPageUrl()); ?>" class="pagination-link flex items-center gap-1 px-3 py-1 border border-gray-300 rounded-full text-base-400 hover:border-gray-400 transition-colors duration-300">
                <span><?php echo e(__('Next')); ?></span>
                <i class="fa-solid fa-angle-right"></i>
            </a>
        <?php else: ?>
            <button disabled class="flex items-center gap-1 px-3 py-1 border border-gray-300 rounded-full text-base-400 opacity-50 cursor-not-allowed">
                <span><?php echo e(__('Next')); ?></span>
                <i class="fa-solid fa-angle-right"></i>
            </button>
        <?php endif; ?>
    </div>
<?php endif; ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/components/pagination/laravel-paginate-02.blade.php ENDPATH**/ ?>