<?php

namespace Sitepilot\Theme\Blocks;

use Sitepilot\Theme\Block;

class Icon extends Block
{
    public function __construct()
    {
        parent::__construct([
            'id' => 'sp-icon',
            'name' => __('Icon', 'sp-theme'),
            'supports' => [
                'text_align' => true
            ]
        ]);
    }

    public function fields(): array
    {
        return [
            $this->field_text(__('Class', 'sp-theme'), 'icon_class')
                ->description(sprintf(__('Search for icons %shere%s.', 'sp-theme'), '<a href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank">', '</a>')),

            $this->field_style_text_color(__('Color', 'sp-theme'), 'icon_color'),

            $this->field_style_font_size(__('Size', 'sp-theme'), 'icon_size'),

            $this->field_style_margin(__('Margin', 'sp-theme'), 'margin')
                ->default_value([
                    'bottom' => 'x'
                ])
        ];
    }

    protected function data($data, $post_id): array
    {
        return [
            'classes' => $this->get_classes([
                'field:margin',
                'field:icon_color',
                'field:icon_size'
            ]),
        ];
    }
}
