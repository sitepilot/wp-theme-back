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
     * The default selected option.
     *
     * @var string
     */
    public $default_select;

    /**
     * Returns the ACF field configuration.
     *
     * @return array
     */
    protected function config($prefix = true): array
    {
        return [
            'type' => 'select',
            'default_value' => $this->default_select ? $this->default_select : $this->default,
            'choices' => $this->options
        ];
    }

    /**
     * Set the field's default select value.
     *
     * @param mixed $value
     * @return $this
     */
    public function default_select($value)
    {
        $this->default_select = $value;

        return $this;
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
