<div class="{{ $class }}">
    <div class="{{ isset($margin) && !empty($margin) ? $margin : 'mt-x mb-x' }} not-found">
        {{ $block->name }} - {{ $exception }}
    </div>
</div>