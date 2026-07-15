
<?php $__currentLoopData = $project_complete_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $rating = \App\Models\Rating::with('order')->where('order_id', $order->id)->where('sender_type', 1)->first();
    ?>

    <?php if($rating): ?>
        <?php
            $fullname = $rating->order?->user?->fullname;
        ?>

        <div class="rounded-2xl border border-[#C4C8CE] p-4 review-item">
            <!-- Top Section -->
            <div class="flex items-center gap-3 border-b pb-4">
                <?php if($rating->order?->user?->image): ?>
                    <img src="<?php echo e(asset('assets/uploads/profile/'.$rating->order?->user?->image)); ?>"
                         alt="<?php echo e($fullname); ?>"
                         class="w-12 h-12 rounded-full object-cover">
                <?php else: ?>
                    <img src="<?php echo e(asset('assets/static/img/author/author.jpg')); ?>"
                         alt="<?php echo e(__('author')); ?>"
                         class="w-12 h-12 rounded-full object-cover">
                <?php endif; ?>
                <div>
                    <h3 class="text-base font-medium text-base-300"><?php echo e($fullname); ?></h3>
                    <p class="text-sm text-gray-600">
                        <?php if($rating->order?->user?->user_state?->state): ?>
                            <?php echo e($rating->order?->user?->user_state?->state); ?>,
                        <?php endif; ?>
                        <?php echo e($rating->order?->user?->user_country?->country); ?>

                    </p>
                </div>
            </div>

            <!-- Bottom section -->
            <div class="mt-2">
                <!-- Rating and time section -->
                <div class="flex items-center gap-2">
                    <div class="flex star-rating">
                        <?php for($i = 1; $i <= 5; $i++): ?>
                            <?php if($i <= $rating->rating): ?>
                                <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                            <?php else: ?>
                                <i class="icon-base ti tabler-star icon-16px text-amber-400"></i>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                    <span class="text-2xl text-base-400">•</span>
                    <span class="text-sm text-base-400"><?php echo e($rating->created_at->diffForHumans()); ?></span>
                </div>

                <p class="text-sm text-base-400 leading-relaxed mt-2">
                    <?php echo e($rating->review_feedback); ?>

                </p>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php if($project_complete_orders->hasMorePages()): ?>
    <div class="pagination hidden"></div>
<?php endif; ?>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/pages/project-details/reviews.blade.php ENDPATH**/ ?>