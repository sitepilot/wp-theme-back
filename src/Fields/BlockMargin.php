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
                'top' => __('Top', 'sp-theme'),
                'bottom' => __('Bottom', 'sp-theme'),
                'top-bottom' => __('Top & Bottom', 'sp-theme'),
                'none' => __('None', 'sp-theme')
            ]
        ];
    }
}
