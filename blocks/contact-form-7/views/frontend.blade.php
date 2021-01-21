@if($form_id)
<div class="{{ $block_class }}">
    <div class="{{ $classes }} {{ $btn_alignment }}">
        {!! do_shortcode('[contact-form-7 id="' . $form_id . '"]') !!}
        <div style="clear: both;"></div>
    </div>
</div>
@endif