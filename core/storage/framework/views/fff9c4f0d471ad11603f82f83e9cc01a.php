<?php if(Auth::check()): ?>
    <?php
        $user = Auth::user();
        // Determine dashboard and logout routes based on user type
        if($user->user_type == 1) {
            $dashboardRoute = route('client.dashboard');
            $logoutRoute = route('client.logout');
        } elseif($user->user_type == 2) {
            $dashboardRoute = route('freelancer.dashboard');
            $logoutRoute = route('freelancer.logout');
        } else {
            $dashboardRoute = route('homepage'); // Fallback
            $logoutRoute = route('homepage'); // Fallback
        }
    ?>
            <!-- Logged In User Mobile -->
    <a href="<?php echo e($dashboardRoute); ?>"
       class="border flex items-center justify-center gap-2 border-primary text-primary px-4 py-2 rounded-full hover:bg-primary/20 w-full transition">
        <i class="fa-solid fa-gauge"></i>
        <?php echo e(__('Dashboard')); ?>

    </a>
    <?php if(moduleExists('Community')): ?>
        <a href="<?php echo e(route('community.all')); ?>"
        class="bg-primary text-white text-base px-5 py-2 rounded-full hover:bg-primary/80 w-full transition flex items-center justify-center gap-2">
            <i class="fa-solid fa-people-group"></i>
            <?php echo e(__('Community')); ?>

        </a>
    <?php endif; ?>
<?php else: ?>
    <!-- Guest User Mobile -->
    <?php if(moduleExists('Community')): ?>
        <a href="<?php echo e(route('community.all')); ?>"
        class="border flex items-center justify-center gap-2 border-primary text-primary px-4 py-2 rounded-full hover:bg-primary/20 w-full transition">
            <i class="fa-solid fa-people-group"></i>
            <?php echo e(__('Community')); ?>

        </a>
    <?php endif; ?>
    <a href="#" id="openLoginModalMobile"
       class="bg-primary text-white text-base px-5 py-2 rounded-full hover:bg-primary/80 w-full transition flex items-center justify-center gap-2">
        <i class="fa-solid fa-user-plus"></i>
        <?php echo e(__('Sign In')); ?>

    </a>
<?php endif; ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/components/frontend/user-menu-mobile-variant-04.blade.php ENDPATH**/ ?>