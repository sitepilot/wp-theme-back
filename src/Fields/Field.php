<?php

namespace Sitepilot\Theme\Fields;

use Sitepilot\Theme\Block;

abstract class Field
{
    /**
     * The displayable name of the field.
     *
     * @var string
     */
    public $name;

    /**
     * The attribute name of the field.
     *
     * @var string
     */
    public $attribute;

    /**
     * The default value of the field.
     *
     * @var string
     */
    public $default;

    /**
     * Wether the field is required.
     *
     * @var string
     */
    public $required;

    /**
     * The field namespace.
     *
     * @var string
     */
    public $namespace;

    /**
     * Create a new element.
     *
     * @return static
     */
    public static function make(...$arguments)
    {
        return new static(...$arguments);
    }

    /**
     * Create a new field.
     *
     * @param string $name
     * @param string $attribute
     * @return void
     */
    public function __construct(string $name, string $attribute, string $namespace)
    {
        $this->name = $name;
        $this->attribute = $attribute;
        $this->namespace = $namespace;
    }

    /**
     * Returns the ACF field configuration.
     *
     * @return array
     */
    abstract public function config(): array;

    /**
     * Returns the field key.
     *
     * @return string
     */
    public function key()
    {
        return 'field_' . $this->namespace . '_' . $this->attribute;
    }

    /**
     * Set the field's default value.
     *
     * @param mixed $value
     * @return $this
     */
    public function default_value($value)
    {
        $this->default = $value;

        return $this;
    }

    /**
     * Set the field's required value.
     *
     * @param mixed $value
     * @return $this
     */
    public function required($value = true)
    {
        $this->required = $value;

        return $this;
    }
}
