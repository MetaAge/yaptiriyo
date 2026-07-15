<?php $__env->startSection('site_title', __('Reply to Review')); ?>
<?php $__env->startSection('content'); ?>
    <main>
        <?php if (isset($component)) { $__componentOriginal7ecac999957263c09523da7583aa96ad = $component; } ?>
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
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal1886b76dac2bd4a55dfc12d1a06ee6e4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1886b76dac2bd4a55dfc12d1a06ee6e4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.breadcrumb.user-profile-breadcrumb','data' => ['title' => __('Reply to Review'),'innerTitle' => __('Reply to Review')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('breadcrumb.user-profile-breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Reply to Review')),'innerTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Reply to Review'))]); ?>
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

        <!-- End Contract area Starts -->
        <div class="end-contract-area pat-100 pab-100 section-bg-2">
            <div class="container">
                <form action="<?php echo e(route('freelancer.order.rating',$id)); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="row gy-4 justify-content-center">
                        <div class="col-lg-8">
                            <div class="end-contract">

                                <!-- Client's Review Display -->
                                <div class="end-contract-single mb-5">
                                    <div class="card">
                                        <div class="card-header bg-light">
                                            <h5 class="mb-0"><?php echo e(__('Client Review')); ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <?php if($client_rating): ?>
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="me-3">
                                                        <?php if($find_login_user_order?->user?->image): ?>
                                                            <img src="<?php echo e(asset('assets/uploads/profile/'.$find_login_user_order?->user?->image)); ?>"
                                                                 alt="<?php echo e($find_login_user_order?->user?->first_name); ?>"
                                                                 style="width: 50px; height: 50px; border-radius: 50%;">
                                                        <?php else: ?>
                                                            <img src="<?php echo e(asset('assets/static/img/author/author.jpg')); ?>"
                                                                 alt="<?php echo e(__('author')); ?>"
                                                                 style="width: 50px; height: 50px; border-radius: 50%;">
                                                        <?php endif; ?>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-1"><?php echo e($find_login_user_order?->user?->first_name); ?> <?php echo e($find_login_user_order?->user?->last_name); ?></h6>
                                                        <div class="rating_profile_details d-flex align-items-center">
                                                            <div class="rating_profile_details_icon me-2">
                                                                <i data-star="<?php echo e($client_rating->rating); ?>"></i>
                                                            </div>
                                                            <span class="rating_profile_details-para"><?php echo e($client_rating->rating); ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="ms-auto text-muted small">
                                                        <?php echo e($client_rating->created_at->toFormattedDateString() ?? ''); ?>

                                                    </div>
                                                </div>
                                                <p class="mb-0"><?php echo e($client_rating->review_feedback); ?></p>
                                            <?php else: ?>
                                                <p class="text-muted mb-0"><?php echo e(__('Client has not submitted a review yet.')); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Freelancer's Reply Section -->
                                <?php if(!$freelancer_reply): ?>
                                    <div class="end-contract-single">
                                        <div class="end-contract-single-select">
                                            <label class="label-title"><?php echo e(__('Your Reply to Client Review')); ?></label>
                                            <textarea name="review_feedback" id="review_feedback" class="form-control" rows="5"
                                                      placeholder="<?php echo e(__('Type your reply to the client review here...')); ?>"></textarea>
                                            <?php $__errorArgs = ['review_feedback'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <!-- Show existing reply -->
                                    <div class="end-contract-single">
                                        <div class="card border-success">
                                            <div class="card-header bg-success text-white">
                                                <h5 class="mb-0"><?php echo e(__('Your Reply')); ?></h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="me-3">
                                                        <?php if(auth()->user()->image): ?>
                                                            <img src="<?php echo e(asset('assets/uploads/profile/'.auth()->user()->image)); ?>"
                                                                 alt="<?php echo e(auth()->user()->first_name); ?>"
                                                                 style="width: 50px; height: 50px; border-radius: 50%;">
                                                        <?php else: ?>
                                                            <img src="<?php echo e(asset('assets/static/img/author/author.jpg')); ?>"
                                                                 alt="<?php echo e(__('author')); ?>"
                                                                 style="width: 50px; height: 50px; border-radius: 50%;">
                                                        <?php endif; ?>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-1"><?php echo e(auth()->user()->first_name); ?> <?php echo e(auth()->user()->last_name); ?></h6>
                                                        <small class="text-muted"><?php echo e(__('Your reply')); ?></small>
                                                    </div>
                                                    <div class="ms-auto text-muted small">
                                                        <?php echo e($freelancer_reply->created_at->toFormattedDateString() ?? ''); ?>

                                                    </div>
                                                </div>
                                                <p class="mb-0"><?php echo e($freelancer_reply->review_feedback); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="end-contract-widget sticky_top_lg">
                                <div class="end-contract-widget-item">
                                    <ul class="end-contract-widget-list">
                                    </ul>
                                    <div class="end-contract-widget-item-footer profile-border-top">
                                        <div class="btn-wrapper mt-4">
                                            <?php if(!$freelancer_reply): ?>
                                                <button type="submit" class="btn-profile btn-bg-1 w-100">
                                                    <?php echo e(__('Submit Reply')); ?>

                                                </button>
                                            <?php else: ?>
                                                <button type="button" class="btn-profile btn-success w-100" disabled>
                                                    <?php echo e(__('Already Replied')); ?>

                                                </button>
                                            <?php endif; ?>
                                        </div>
                                        <div class="mt-3">
                                            <a href="<?php echo e(route('freelancer.order.all')); ?>" class="btn-profile btn-outline-gray w-100">
                                                <?php echo e(__('Back to Orders')); ?>

                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Contract area end -->
    </main>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <!-- Remove old rating JS if not needed -->
    <script>
        // Simple validation for reply form
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            if(form) {
                form.addEventListener('submit', function(e) {
                    const textarea = document.getElementById('review_feedback');
                    if(textarea && textarea.value.trim().length === 0) {
                        e.preventDefault();
                        alert('<?php echo e(__("Please write your reply before submitting.")); ?>');
                        textarea.focus();
                    }
                });
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/freelancer/order/rating/rating.blade.php ENDPATH**/ ?>