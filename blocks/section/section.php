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
            ],
            'defaults' => [
                'width' => 'full'
            ]
        ]);
    }

    public function fields(): array
    {
        return [
            $this->field_group(__('Section', 'sp-theme'), 'section_fields')
                ->fields([
                    $this->field_style_bg_color(__('Background Color', 'sp-theme'), 'bg_color'),

                    $this->field_image(__('Background Image', 'sp-theme'), 'bg_image'),

                    $this->field_preset_image_size(__('Background Image Size', 'sp-theme'), 'bg_image_size')
                        ->default_value('full')
                        ->conditional('bg_image'),

                    $this->field_style_opacity(__('Background Image Opacity', 'sp-theme'), 'bg_image_opacity')
                        ->default_value(100)
                        ->conditional('bg_image'),

                    $this->field_style_bg_attachment(__('Background Image Behaviour', 'sp-theme'), 'bg_image_attachment')
                        ->conditional('bg_image'),

                    $this->field_preset_yes_no(__('Use Post Featured Image', 'sp-theme'), 'bg_image_featured')
                        ->default_value(0)
                        ->conditional('bg_image'),

                    $this->field_style_box_shadow(__('Box Shadow', 'sp-theme'), 'box_shadow'),

                    $this->field_style_rounded(__('Rounded Corners', 'sp-theme'), 'rounded'),

                    $this->field_style_margin(__('Margin', 'sp-theme'), 'margin')->default_value([
                        'top' => apply_filters('sp_block_section_margin_top', 0),
                        'bottom' => apply_filters('sp_block_section_margin_bottom', 0),
                        'left' => apply_filters('sp_block_section_margin_left', 0),
                        'right' => apply_filters('sp_block_section_margin_right', 0)
                    ])
                ]),

            $this->field_group(__('Content', 'sp-theme'), 'content_fields')
                ->fields([
                    $this->field_style_bg_color(__('Background Color', 'sp-theme'), 'content_bg_color'),

                    $this->field_style_max_width(__('Max Width', 'sp-theme'), 'content_max_width')
                        ->default_value('container'),

                    $this->field_style_text_align(__('Text Align', 'sp-theme'), 'content_text_align'),

                    $this->field_style_box_shadow(__('Box Shadow', 'sp-theme'), 'content_box_shadow'),

                    $this->field_style_rounded(__('Rounded Corners', 'sp-theme'), 'content_rounded'),

                    $this->field_style_padding(__('Padding', 'sp-theme'), 'content_padding')->default_value([
                        'top' => apply_filters('sp_block_section_padding_top', 4),
                        'bottom' => apply_filters('sp_block_section_padding_bottom', 4),
                        'left' => apply_filters('sp_block_section_padding_left', 4),
                        'right' => apply_filters('sp_block_section_padding_right', 4)
                    ]),
                ])
        ];
    }

    protected function data($data, $post_id): array
    {
        $bg_image_url = $this->get_image_url($data['bg_image'], $data['bg_image_size']);
        if ($data['bg_image_featured'] && $featured_image_url = get_the_post_thumbnail_url($post_id, $data['bg_image_size'])) {
            $bg_image_url = $featured_image_url;
        }

        return [
            'classes' => $this->get_classes([
                'relative',
                'field:margin',
                'field:bg_color',
                'field:box_shadow',
                'field:rounded',
                $data['box_shadow'] ? 'z-10' : null
            ]),
            'content_classes' => $this->get_classes([
                'content',
                'relative',
                'field:content_text_align',
                'field:content_max_width',
                'field:content_bg_color',
                'field:content_box_shadow',
                'field:content_rounded',
                'field:content_padding'
            ]),
            'bg_image_classes' => $this->get_classes([
                'image',
                'absolute',
                'inset-0',
                'bg-cover',
                'bg-center',
                'field:rounded',
                'field:bg_image_opacity',
                'field:bg_image_attachment'
            ]),
            'bg_image_url' => $bg_image_url
        ];
    }
}
