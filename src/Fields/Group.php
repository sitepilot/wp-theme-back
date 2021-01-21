<?php

namespace Sitepilot\Theme\Fields;

class Group extends Field
{
    /**
     * The grouped fields.
     *
     * @var array
     */
    public $fields = [];

    /**
     * Returns the ACF field configuration.
     *
     * @return array
     */
    protected function config($prefix = true): array
    {
        return [
            'type' => 'accordion'
        ];
    }

    /**
     * Set the group fields.
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
     * Returns subfields. 
     *
     * @return array
     */
    protected function subfields(): array
    {
        $subfields = [];
        foreach ($this->fields as $field) {
            $subfields[] = $field;
        }

        return $subfields;
    }
}
