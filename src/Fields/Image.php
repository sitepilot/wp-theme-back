<?php

namespace Sitepilot\Theme\Fields;

class Image extends Field
{
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
            'type' => 'image',
            'required' => $this->required,
            'default_value' => $this->default,
            'return_format' => 'url'
        ];
    }
}
