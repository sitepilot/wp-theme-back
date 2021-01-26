<?php

namespace Sitepilot\Theme\Blocks;

use Sitepilot\Theme\Block;

class Youtube extends Block
{
    public function __construct()
    {
        parent::__construct([
            'id' => 'sp-youtube',
            'name' => __('Youtube Video', 'sp-theme'),
            'icon' => 'youtube',
            'supports' => [
                'full_width' => true,
                'wide_width' => true
            ]
        ]);
    }

    public function fields(): array
    {
        return [
            $this->field_text(__('Youtube ID', 'sp-theme'), 'youtube_id'),

            $this->field_preset_yes_no(__('Autoplay', 'sp-theme'), 'autoplay')
                ->default_value(0),

            $this->field_preset_yes_no(__('Muted', 'sp-theme'), 'muted')
                ->default_value(0),

            $this->field_preset_yes_no(__('Show Controls', 'sp-theme'), 'controls')
                ->default_value(1),

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
                'relative',
                'field:margin'
            ]),
            'embed_url' => $data['youtube_id'] ? "https://www.youtube.com/embed/{$data['youtube_id']}?autoplay={$data['autoplay']}&mute={$data['muted']}&showinfo={$data['controls']}&controls={$data['controls']}" : ''
        ];
    }
}
