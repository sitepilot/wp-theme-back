<?php

namespace Sitepilot\Theme\Blocks;

use Sitepilot\Theme\Block;

class ContactForm7 extends Block
{
    public function __construct()
    {
        parent::__construct([
            'id' => 'sp-contact-form-7',
            'name' => __('Contact Form 7', 'sp-theme'),
            'icon' => 'email-alt',
            'supports' => [
                'text_align' => true
            ]
        ]);
    }

    public function fields(): array
    {
        return [
            $this->field_post(__('Contact Form', 'sp-theme'), 'form_id')
                ->post_types([
                    'wpcf7_contact_form'
                ]),

            $this->field_select(__('Button Alignment', 'sp-theme'), 'btn_alignment')
                ->options([
                    'default' => __('Default', 'sp-theme'),
                    'btn-left' => __('Left', 'sp-theme'),
                    'btn-center' => __('Center', 'sp-theme'),
                    'btn-right' => __('Right', 'sp-theme'),
                    'btn-full-width' => __('Full Width', 'sp-theme')
                ])
        ];
    }
}
