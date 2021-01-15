<?php

namespace Sitepilot\Theme\Fields;

class Text extends Field
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
            'type' => 'text',
            'required' => $this->required,
            'default_value' => $this->default
        ];
    }
}
