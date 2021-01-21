<?php

namespace Sitepilot\Theme\Fields\Style;

use Sitepilot\Theme\Fields\Select;

class PaddingBottom extends Select
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
            0 => 'pb-0',
            1 => 'pb-1',
            2 => 'pb-2',
            4 => 'pb-4',
            6 => 'pb-6',
            8 => 'pb-8',
            10 => 'pb-10',
            12 => 'pb-12',
            14 => 'pb-14',
            16 => 'pb-16',
            20 => 'pb-20',
            24 => 'pb-24'
        ];

        return $classes[$value] ?? $value;
    }
}
