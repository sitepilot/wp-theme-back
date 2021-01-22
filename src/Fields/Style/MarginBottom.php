<?php

namespace Sitepilot\Theme\Fields\Style;

use Sitepilot\Theme\Fields\Select;

class MarginBottom extends Select
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
            'x' => 'mb-x',
            0 => 'mb-0',
            1 => 'mb-1',
            2 => 'mb-2',
            4 => 'mb-4',
            6 => 'mb-6',
            8 => 'mb-8',
            10 => 'mb-10',
            12 => 'mb-12',
            14 => 'mb-14',
            16 => 'mb-16',
            20 => 'mb-20',
            24 => 'mb-24'
        ];

        return $classes[$value] ?? $value;
    }
}
