<?php

namespace Sitepilot\Theme\Fields;

class GoogleMap extends Field
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
            'type' => 'google_map',
            'required' => $this->required,
        ];
    }
}
