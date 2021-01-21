<?php

namespace Sitepilot\Theme\Fields\Style;

use Sitepilot\Theme\Fields\Select;

class MarginTop extends Select
{
    public function __construct(...$arguments)
    {
        parent::__construct(...$arguments);

        $this->options([
            'default' => __('Default', 'sp-theme'),
            0 => __('None', 'sp-theme'),
            1 => 1,
            2 => 2,
            4 => 4,
            6 => 6,
            8 => 8,
            10 => 10,
            12 => 12,
            14 => 14,
            16 => 16,
            20 => 20,
            24 => 24
        ]);

        $this->default_select('default');
    }

    protected function value($value)
    {
        $classes = [
            0 => 'mt-0',
            1 => 'mt-1',
            2 => 'mt-2',
            4 => 'mt-4', 
            6 => 'mt-6', 
            8 => 'mt-8',
            10 => 'mt-10', 
            12 => 'mt-12',
            14 => 'mt-14', 
            16 => 'mt-16', 
            20 => 'mt-20', 
            24 => 'mt-24'
        ];

        return $classes[$value] ?? $value;
    }
}
