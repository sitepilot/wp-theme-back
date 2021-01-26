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
     * The field description.
     *
     * @var string
     */
    public $description;

    /**
     * The field conditional rules.
     *
     * @var array
     */
    public $conditionals = [];

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

                $conditional_logic = array();

                foreach ($this->conditionals as $conditional) {
                    $conditional_logic[] = [
                        'field' => $this->key($prefix, $conditional['field']),
                        'operator' => $conditional['operator'] . $conditional['value']
                    ];
                }

                return array_merge([
                    'key' => $this->key($prefix),
                    'label' => $this->name,
                    'name' => $this->attribute($prefix),
                    'required' => $this->required,
                    'default_value' => $this->default,
                    'instructions' => $this->description,
                    'conditional_logic' => $conditional_logic
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
    public function key($prefix = false, $attribute = null)
    {
        return 'field_' . $this->namespace . '_' . $this->attribute($prefix, $attribute);
    }

    /**
     * Returns the field attribute name.
     *
     * @return string
     */
    public function attribute($prefix = false, $attribute = null)
    {
        if (!$attribute) {
            $attribute = $this->attribute;
        }

        return ($prefix && substr($attribute, 0, 3) != 'sp_' ? 'sp_' : '') . $attribute;
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
     * Set the field's description value;
     *
     * @param string $value
     * @return $this
     */
    public function description($value)
    {
        $this->description = $value;

        return $this;
    }

    /**
     * Set a field conditional rule.
     *
     * @param string $field
     * @param string $operator
     * @param string $value
     * @return void
     */
    public function conditional($field_name, $operator = '!=', $value = 'empty')
    {
        $this->conditionals[] = [
            'field' => $field_name,
            'operator' => $operator,
            'value' => $value
        ];

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
                if (!is_null(json_decode($value, true))) {
                    $value = json_decode($value, true);
                }
                break;
        }

        if (is_array($value) && is_array($this->default)) {
            foreach ($value as $key => $field_value) {
                if (isset($this->default[$key]) && (is_null($field_value) || $field_value == 'default')) {
                    $value[$key] = $this->default[$key];
                }
            }

            return $this->value($value);
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
