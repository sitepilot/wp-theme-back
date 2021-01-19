<div class="{{ $class }} {{ isset($margin) && !empty($margin) ? $margin : 'mt-x mb-x' }}">
    <div class="text-center not-found">
        {{ $block->name }} @if($exception)- {{ $exception }}@endif
    </div>
</div>