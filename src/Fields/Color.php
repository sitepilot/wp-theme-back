<?php

namespace Sitepilot\Theme\Fields;

class Color extends Field
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
            'type' => 'color_picker',
            'required' => $this->required,
            'default_value' => $this->default
        ];
    }
}
