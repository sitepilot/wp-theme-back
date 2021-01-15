<?php

namespace Sitepilot\Theme\Fields;

class Post extends Field
{
    /**
     * The selectable post types.
     *
     * @var array
     */
    protected $post_types = [];

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
            'type' => 'post_object',
            'required' => $this->required,
            'post_type' => $this->post_types,
            'return_format' => 'id',
        ];
    }

    /**
     * Set the selectable post types.
     *
     * @param array $post_types
     * @return self
     */
    public function post_types(array $post_types): self
    {
        $this->post_types = $post_types;

        return $this;
    }
}
