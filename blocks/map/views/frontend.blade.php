@if($embed_code)
<div class="{{ $block_class }}">
    <div class="{{ $classes }}">
        <div class="map">
            {!! $embed_code !!}
        </div>
    </div>
</div>
@endif