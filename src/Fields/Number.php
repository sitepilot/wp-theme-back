<?php

namespace Sitepilot\Theme\Fields;

class Number extends Field
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
            'type' => 'number',
            'required' => $this->required,
            'default_value' => $this->default
        ];
    }
}
