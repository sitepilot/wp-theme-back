<?php

namespace Sitepilot\Theme\Fields;

class Dimension extends Field
{
    /**
     * The fields.
     *
     * @var array
     */
    public $fields = [];

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
            'type' => 'sp_dimension',
            'fields' => $this->fields,
            'choices' => $this->options,
            'default_value' => $this->default_select ? $this->default_select : $this->default
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
     * Set the fields.
     *
     * @param array $fields
     * @return self
     */
    public function fields(array $fields): self
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * Set the options.
     *
     * @param array $fields
     * @return self
     */
    public function options(array $options): self
    {
        $this->options = $options;

        return $this;
    }

    protected function get_class($key, $classes, $value)
    {
        if (is_array($value)) {
            if (isset($value[$key]) && isset($classes[$value[$key]])) {
                return $classes[$value[$key]];
            }
        }

        return null;
    }

    /**
     * Returns subfields. 
     *
     * @return array
     */
    protected function subfields(): array
    {
        return $this->fields;
    }
}
