<?php

namespace Sitepilot\Theme\Blocks;

use Sitepilot\Theme\Block;

class Section extends Block
{
    public function __construct()
    {
        parent::__construct([
            'id' => 'sp-section',
            'name' => __('Section', 'sp-theme'),
            'icon' => 'editor-kitchensink',
            'supports' => [
                'full_width' => true,
                'wide_width' => true,
                'inner_blocks' => true
            ]
        ]);
    }

    public function fields(): array
    {
        return [
            $this->field_group(__('Section', 'sp-theme'), 'section_fields')
                ->fields([
                    $this->field_style_bg_color(__('Background Color', 'sp-theme'), 'bg_color'),

                    $this->field_style_rounded(__('Rounded Corners', 'sp-theme'), 'rounded'),

                    $this->field_style_box_shadow(__('Box Shadow', 'sp-theme'), 'box_shadow'),

                    $this->field_style_padding_x(__('Padding X', 'sp-theme'), 'padding_x'),

                    $this->field_style_padding_y(__('Padding Y', 'sp-theme'), 'padding_y')
                ]),

            $this->field_group(__('Content', 'sp-theme'), 'content_fields')
                ->fields([
                    $this->field_style_max_width(__('Max Width', 'sp-theme'), 'content_max_width'),

                    $this->field_style_bg_color(__('Background Color', 'sp-theme'), 'content_bg_color'),

                    $this->field_style_box_shadow(__('Box Shadow', 'sp-theme'), 'content_box_shadow'),

                    $this->field_style_rounded(__('Rounded Corners', 'sp-theme'), 'content_rounded'),

                    $this->field_style_text_color(__('Text Color', 'sp-theme'), 'content_text_color'),

                    $this->field_style_padding_x(__('Padding X', 'sp-theme'), 'content_padding_x'),

                    $this->field_style_padding_y(__('Padding Y', 'sp-theme'), 'content_padding_y')
                ])
        ];
    }

    protected function data($data, $post_id): array
    {
        $classes = [
            $data['bg_color'],
            $data['box_shadow'],
            $data['rounded'],
            $data['padding_x'],
            $data['padding_y']
        ];

        $content_classes = [
            $data['content_max_width'],
            $data['content_text_color'],
            $data['content_bg_color'],
            $data['content_box_shadow'],
            $data['content_rounded'],
            $data['content_padding_x'],
            $data['content_padding_y']
        ];

        return [
            'classes' => $data['classes'] . " " . implode(" ", $classes),
            'content_classes' => implode(" ", $content_classes)
        ];
    }
}
