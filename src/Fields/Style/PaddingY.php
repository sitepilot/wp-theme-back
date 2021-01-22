<?php

namespace Sitepilot\Theme\Fields\Style;

use Sitepilot\Theme\Fields\Select;

class PaddingY extends Select
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
            0 => 'py-0',
            1 => 'py-1',
            2 => 'py-2',
            4 => 'py-4',
            6 => 'py-6',
            8 => 'py-8',
            10 => 'py-10',
            12 => 'py-12',
            14 => 'py-14',
            16 => 'py-16',
            20 => 'py-20',
            24 => 'py-24'
        ];

        return $classes[$value] ?? $value;
    }
}
