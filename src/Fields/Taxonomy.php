<?php

namespace Sitepilot\Theme\Fields;

class Taxonomy extends Field
{
    /**
     * The selectable taxonomy.
     *
     * @var string
     */
    protected $taxonomy = [];

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
            'type' => 'taxonomy',
            'required' => $this->required,
            'taxonomy' => $this->taxonomy,
            'return_format' => 'id',
        ];
    }

    /**
     * Set the selectable taxonomy.
     *
     * @param string $taxonomy
     * @return self
     */
    public function taxonomy(string $taxonomy): self
    {
        $this->taxonomy = $taxonomy;

        return $this;
    }
}
