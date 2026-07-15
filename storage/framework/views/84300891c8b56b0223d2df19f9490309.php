<!-- Setup Skills Starts -->
<div class="setup-wrapper-contents">
    <div class="setup-wrapper-contents-item">
        <h3 class="setup-wrapper-contents-title"> <?php echo e(get_static_option('skill_title') ?? __('Great! Now add some skills you have')); ?> </h3>
        <div class="setup-wrapper-skill">
            <p class="setup-wrapper-skill-para"><?php echo e(__('Type and hit ↵ Enter to add a skill or choose from suggestions below')); ?></p>
            <div class="setup-wrapper-skill-tagInputs mt-4">
                <input type="text" id="skill_input" placeholder="__('select tags')">
            </div>
        </div>
    </div>
    <div class="setup-wrapper-contents-item">
        <ul class="setup-wrapper-work-list overflow-auto set_scroll_height">
            <?php
                $skills =  \App\Models\UserSkill::select('skill')->where('user_id',Auth::guard('web')->user()->id)->first()->skill ?? '';
                $array_skill = explode(",",$skills);
            ?>
            <?php if($skills_according_to_category): ?>
                <?php $__currentLoopData = $skills_according_to_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!in_array($skill->skill, $array_skill)): ?>
                        <li class="setup-wrapper-work-list-item choose_skill"> <?php echo e($skill->skill); ?> </li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </ul>
    </div>
</div>
<!-- Setup Skills Ends -->

<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/freelancer/account/skill/skill.blade.php ENDPATH**/ ?>