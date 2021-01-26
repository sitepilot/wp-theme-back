<?php

namespace Sitepilot\Theme\Blocks;

use Sitepilot\Theme\Block;

class Template extends Block
{
    public function __construct()
    {
        parent::__construct([
            'id' => 'sp-template',
            'name' => __('Template', 'sp-theme'),
            'supports' => [
                'full_width' => true,
                'wide_width' => true
            ],
            'defaults' => [
                'width' => 'full'
            ]
        ]);
    }

    public function fields(): array
    {
        return [
            $this->field_post(__('Template', 'sp-theme'), 'template_id')
                ->post_types([
                    'sp-template'
                ]),

            $this->field_style_margin(__('Margin', 'sp-theme'), 'margin')
        ];
    }

    protected function data($data, $post_id): array
    {
        $content = '';

        if ($data['template_id'] && $post_id != $data['template_id']) {
            $post = get_post($data['template_id']);

            if ($post && has_blocks($post->post_content)) {
                $blocks = parse_blocks($post->post_content);

                foreach ($blocks as $block) {
                    $content .= render_block($block);
                }
            }
        }

        return [
            'template' => $content,
            'classes' => $this->get_classes([
                'field:margin'
            ])
        ];
    }
}
