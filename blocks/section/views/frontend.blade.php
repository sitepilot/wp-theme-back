<div class="{{ $classes }}">
    @if($bg_image_url)
    <div class="{{ $bg_image_classes }}" style="background-image: url('{{ $bg_image_url }}');"></div>
    @endif

    <div class="{{ $content_classes }}">
        <InnerBlocks />
    </div>
</div>