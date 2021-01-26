@if($form_id)
<div class="{{ $classes }}">
    {!! do_shortcode('[contact-form-7 id="' . $form_id . '"]') !!}
    <div style="clear: both;"></div>
</div>
@endif