<?php

namespace Sitepilot\Theme\Fields\Style;

use Sitepilot\Theme\Fields\Select;

class Padding extends Select
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
            0 => 'p-0',
            1 => 'p-1',
            2 => 'p-2',
            4 => 'p-4',
            6 => 'p-6',
            8 => 'p-8',
            10 => 'p-10',
            12 => 'p-12',
            14 => 'p-14',
            16 => 'p-16',
            20 => 'p-20',
            24 => 'p-24'
        ];

        return $classes[$value] ?? $value;
    }
}
