<?php

namespace Sitepilot\Theme\Fields;

class Textarea extends Field
{
    /**
     * Returns the ACF field configuration.
     *
     * @return array
     */
    protected function config($prefix = true): array
    {
        return [
            'type' => 'textarea'
        ];
    }
}
