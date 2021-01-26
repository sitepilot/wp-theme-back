:root {
@if($theme->model->get_primary_color())
--sp-color-primary: {!! $theme->model->get_primary_color() !!};
@endif
@if($theme->model->get_secondary_color())
--sp-color-secondary: {!! $theme->model->get_secondary_color() !!};
@endif
@if($theme->model->get_block_margin())
--sp-block-margin: {!! $theme->model->get_block_margin() !!};
@endif
@if($theme->model->get_text_margin())
--sp-text-margin: {!! $theme->model->get_text_margin() !!};
@endif
@if($theme->model->get_container_width())
--sp-container-width: {!! $theme->model->get_container_width() !!}px;
@endif
}

@if($theme->model->is_blocks_layout() && $theme->astra->is_active())
#primary, .hentry {
margin: 0 !important;
padding: 0 !important;
}
@endif

@if($theme->model->hide_recaptcha_badge())
.grecaptcha-badge {
display: none !important;
}
@endif