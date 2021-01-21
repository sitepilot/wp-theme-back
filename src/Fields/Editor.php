<?php

namespace Sitepilot\Theme\Fields;

class Editor extends Field
{
    /**
     * Returns the ACF field configuration.
     *
     * @return array
     */
    protected function config($prefix = true): array
    {
        return [
            'type' => 'wysiwyg'
        ];
    }
}
