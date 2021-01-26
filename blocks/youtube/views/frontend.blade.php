@if($embed_url)
<div class="{{ $classes }}">
    @if(is_admin())<div class="absolute inset-0 z-50"></div>@endif
    <div class="video">
        <iframe src="{{ $embed_url }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
</div>
@endif