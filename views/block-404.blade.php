<div class="{{ $block_class }}">
    <div class="{{ isset($classes) && !empty($classes) ? $classes : 'mt-8 mb-8' }}">
        <div class="text-center not-found">
            {{ $block->config->name }} @if($exception)- {{ $exception }}@endif
        </div>
    </div>
</div>