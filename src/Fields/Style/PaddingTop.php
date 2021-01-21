<?php

namespace Sitepilot\Theme\Fields\Style;

use Sitepilot\Theme\Fields\Select;

class PaddingTop extends Select
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
            0 => 'pt-0',
            1 => 'pt-1',
            2 => 'pt-2',
            4 => 'pt-4',
            6 => 'pt-6',
            8 => 'pt-8',
            10 => 'pt-10',
            12 => 'pt-12',
            14 => 'pt-14',
            16 => 'pt-16',
            20 => 'pt-20',
            24 => 'pt-24'
        ];

        return $classes[$value] ?? $value;
    }
}
