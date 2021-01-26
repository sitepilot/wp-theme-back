<?php

namespace Sitepilot\Theme\Blocks;

use Sitepilot\Theme\Block;

class PoweredBy extends Block
{
    public function __construct()
    {
        parent::__construct([
            'id' => 'sp-powered-by',
            'name' => __('Powered By', 'sp-theme')
        ]);
    }

    public function fields(): array
    {
        return [
            $this->field_textarea(__('Text', 'sp-theme'), 'slot')
                ->default_value(apply_filters('sp_theme_powered_by_text', 'Powered by <a href="https://sitepilot.io" target="_blank">Sitepilot</a>')),

            $this->field_style_font_size(__('Font Size', 'sp-theme'), 'font_size')
                ->default_value('sm'),

            $this->field_style_text_align(__('Text Align', 'sp-theme'), 'text_align')
                ->default_value('center'),

            $this->field_style_margin(__('Margin', 'sp-theme'), 'margin')->default_value([
                'bottom' => 'x'
            ])
        ];
    }

    protected function data($data, $post_id): array
    {
        return [
            'classes' => $this->get_classes([
                'field:margin',
                'field:font_size',
                'field:text_align'
            ])
        ];
    }
}
