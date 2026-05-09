<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name' => 'switch',
    'id' => null,
    'label' => '',
    'checked' => false,
    'divClass' => 'mb-3',
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'name' => 'switch',
    'id' => null,
    'label' => '',
    'checked' => false,
    'divClass' => 'mb-3',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="single-input mt-3">
    <?php if($label): ?>
        <label for="<?php echo e($id ?? $name); ?>" class="label-title"><?php echo e($label); ?></label>
    <?php endif; ?>
    <div class="form-check form-switch px-0">
        <input 
            class="d-none form-check-input styled-switch" 
            type="checkbox" 
            role="switch" 
            name="<?php echo e($name); ?>" 
            id="<?php echo e($id ?? $name); ?>"
            <?php echo e($checked ? 'checked' : ''); ?> 
            value="1">
        <label class="form-check-label toggle-label" for="<?php echo e($id ?? $name); ?>">
            <?php echo e($slot); ?>

            <span class="custom-switch-new knob"></span>
        </label>
    </div>
</div>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/components/form/switch-toggle.blade.php ENDPATH**/ ?>