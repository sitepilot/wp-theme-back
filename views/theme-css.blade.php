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
}
.sp-block.mt-x { margin-top: var(--sp-block-margin); }
.sp-block.mt-0 { margin-top: 0; }
.sp-block.mb-x { margin-bottom: var(--sp-block-margin); }
.sp-block.mb-0 { margin-bottom: 0; }
.sp-block .not-found { padding: 1rem; border: 1px dashed gray; }
@if($theme->model->is_blocks_layout() && $theme->astra->is_active())#primary, .hentry { margin: 0 !important; }@endif