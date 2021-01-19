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
}
.sp-block.mt-x { margin-top: var(--sp-block-margin); }
.sp-block.mt-0 { margin-top: 0; }
.sp-block.mb-x { margin-bottom: var(--sp-block-margin); }
.sp-block.mb-0 { margin-bottom: 0; }
.sp-block .not-found { padding: 1rem; border: 1px dashed gray; }
.wp-block-columns { margin-top: var(--sp-block-margin); margin-bottom: var(--sp-block-margin); }
@if($theme->model->is_blocks_layout() && $theme->astra->is_active())
#primary, .hentry { margin: 0 !important; }
.entry-content p, .entry-content h1, .entry-content h2, .entry-content h3, .entry-content h4, .entry-content h5, .entry-content h6 { margin-bottom: var(--sp-text-margin); }
.entry-content p:last-child, .entry-content h1:last-child, .entry-content h2:last-child, .entry-content h3:last-child, .entry-content h4:last-child, .entry-content h5:last-child, .entry-content h6:last-child { margin-bottom: var(--sp-block-margin); }
@endif
