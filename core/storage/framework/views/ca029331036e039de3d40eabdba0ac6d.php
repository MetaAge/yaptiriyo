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
            <!-- Logged In User -->
    <a href="<?php echo e($dashboardRoute); ?>" class="border border-primary text-base-300 px-4 py-1 rounded-full hover:bg-primary/10 font-medium transition-all duration-300">
        <?php echo e(__('Dashboard')); ?>

    </a>
    <?php if(moduleExists('Community')): ?>
        <a href="<?php echo e(route('community.all')); ?>" class="bg-primary text-white text-base-100 px-5 py-1 rounded-full hover:bg-secondary transition-all duration-300 font-medium">
            <?php echo e(__('Community')); ?>

        </a>
    <?php endif; ?>
<?php else: ?>
    <!-- Guest User -->
    <?php if(moduleExists('Community')): ?>
        <a href="<?php echo e(route('community.all')); ?>" class="border border-primary text-base-300 px-4 py-1 rounded-full hover:bg-primary/10 font-medium transition-all duration-300">
            <?php echo e(__('Community')); ?>

        </a>
    <?php endif; ?>
    <a href="<?php echo e(route('user.login')); ?>" class="border border-primary text-base-300 px-4 py-1 rounded-full hover:bg-primary/10 font-medium transition-all duration-300">
        <?php echo e(__('Login')); ?>

    </a>
    <a href="<?php echo e(route('user.register')); ?>" id="openRegisterLink" class="bg-primary text-white text-base-100 px-5 py-1 rounded-full hover:bg-secondary transition-all duration-300 font-medium">
        <?php echo e(__('Sign Up')); ?>

    </a>
<?php endif; ?><?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/components/frontend/user-menu-variant-04.blade.php ENDPATH**/ ?>