<?php

namespace Sitepilot\Theme\Fields;

class Image extends Field
{
    /**
     * Returns the ACF field configuration.
     *
     * @param bool $prefix
     * @return array
     */
    protected function config($prefix = true): array
    {
        return [
            'type' => 'image',
            'return_format' => 'id'
        ];
    }
}
