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
    protected function config($prefix = true): array
    {
        return [
            'type' => 'taxonomy',
            'taxonomy' => $this->taxonomy,
            'return_format' => 'id'
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
