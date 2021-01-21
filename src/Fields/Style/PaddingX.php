<?php

namespace Sitepilot\Theme\Fields\Style;

use Sitepilot\Theme\Fields\Select;

class PaddingX extends Select
{
    public function __construct(...$arguments)
    {
        parent::__construct(...$arguments);

        $this->options([
            'default' => __('Default', 'sp-theme'),
            0 => __('None', 'spx-theme'),
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
            0 => 'px-0',
            1 => 'px-1',
            2 => 'px-2',
            4 => 'px-4',
            6 => 'px-6',
            8 => 'px-8',
            10 => 'px-10',
            12 => 'px-12',
            14 => 'px-14',
            16 => 'px-16',
            20 => 'px-20',
            24 => 'px-24'
        ];

        return $classes[$value] ?? $value;
    }
}
