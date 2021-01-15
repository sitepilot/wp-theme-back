<?php

namespace Sitepilot\Theme\Fields;

class BlockMargin extends Field
{
    public $default = 'top-bottom';

    /**
     * Returns the ACF field configuration.
     *
     * @return array
     */
    public function config(): array
    {
        return [
            'key' => $this->key(),
            'label' => $this->name,
            'name' => $this->attribute,
            'type' => 'select',
            'required' => $this->required,
            'default_value' => $this->default,
            'choices' => [
                'none' => __('None', 'sitepilot-theme'),
                'top' => __('Top', 'sitepilot-block'),
                'bottom' => __('Bottom', 'sitepilot-block'),
                'top-bottom' => __('Top & Bottom', 'sitepilot-block'),
            ]
        ];
    }
}
