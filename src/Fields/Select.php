<?php

namespace Sitepilot\Theme\Fields;

class Select extends Field
{
    /**
     * The choices.
     *
     * @var array
     */
    public $options = [];

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
            'choices' => $this->options
        ];
    }

    /**
     * Set the option fields.
     *
     * @param array $fields
     * @return self
     */
    public function options(array $options): self
    {
        $this->options = $options;

        return $this;
    }
}
