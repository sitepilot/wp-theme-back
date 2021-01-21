<?php

namespace Sitepilot\Theme\Fields;

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
    abstract protected function config(): array;

    /**
     * Get the field configuration.
     * 
     * @return mixed
     */
    public function get_config($type, $prefix = null)
    {
        switch ($type) {
            case 'acf':
                if (is_null($prefix)) $prefix = true;
                
                return array_merge([
                    'key' => $this->key($prefix),
                    'label' => $this->name,
                    'name' => $this->attribute($prefix),
                    'required' => $this->required,
                    'default_value' => $this->default
                ], $this->config());
                break;
        }

        return null;
    }

    /**
     * Returns the field key.
     *
     * @return string
     */
    public function key($prefix = false)
    {
        return 'field_' . $this->namespace . '_' . $this->attribute($prefix);
    }

    /**
     * Returns the field attribute name.
     *
     * @return string
     */
    public function attribute($prefix = false)
    {
        return ($prefix && substr($this->attribute, 0, 3) != 'sp_' ? 'sp_' : '') . $this->attribute;
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

    /**
     * Returns the field value.
     *
     * @param mixed $value
     * @return void
     */
    protected function value($value)
    {
        return $value;
    }

    /**
     * Get the field value.
     *
     * @return mixed
     */
    public function get_value($type = 'acf', $data = [])
    {
        switch ($type) {
            case 'acf':
                if (function_exists('get_field')) {
                    $value = get_field($this->attribute(true));
                }
                break;
            case 'shortcode':
                $value = $data[$this->attribute()] ?? null;
                break;
        }

        return $this->value(!is_null($value) && $value != 'default' ? $value : $this->default);
    }

    /**
     * Returns the field subfields.
     *
     * @return array
     */
    protected function subfields(): array
    {
        return [];
    }

    /**
     * Get the field subfields.
     *
     * @return void
     */
    public function get_subfields()
    {
        return $this->subfields();
    }
}
