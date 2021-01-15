<?php

namespace Sitepilot\Theme\Fields;

class Repeater extends Field
{
    /**
     * The repeatable fields.
     *
     * @var array
     */
    public $fields = [];

    /**
     * Returns the ACF field configuration.
     *
     * @return array
     */
    public function config(): array
    {
        $sub_fields = [];
        foreach($this->fields as $field) {
            $sub_fields[] = $field->config();
        }

        return [
            'key' => $this->key(),
            'label' => $this->name,
            'name' => $this->attribute,
            'type' => 'repeater',
            'layout' => 'block',
            'button_label' => __('New item', 'sitepilot-block'),
            'sub_fields' => $sub_fields
        ];
    }

    /**
     * Set the repeater fields.
     *
     * @param array $fields
     * @return self
     */
    public function fields(array $fields): self
    {
        $this->fields = $fields;

        return $this;
    }
}
