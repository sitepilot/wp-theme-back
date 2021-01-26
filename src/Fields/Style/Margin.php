<?php

namespace Sitepilot\Theme\Fields\Style;

use Sitepilot\Theme\Fields\Dimension;

class Margin extends Dimension
{
    public function __construct(...$arguments)
    {
        parent::__construct(...$arguments);

        $this->fields([
            'top' => __('Top', 'sp-theme'),
            'bottom' => __('Bottom', 'sp-theme'),
            'left' => __('Left', 'sp-theme'),
            'right' => __('Right', 'sp-theme')
        ]);

        $this->options([
            'default' => '',
            0 => '0',
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
            24 => 24,
            'auto' => 'auto'
        ]);

        $this->default_select('default');
    }

    protected function value($value)
    {
        $mt = [
            'x' => 'mt-x',
            'auto' => 'mt-auto',
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

        $mb = [
            'x' => 'mb-x',
            'auto' => 'mb-auto',
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

        $ml = [
            'x' => 'ml-x',
            'auto' => 'ml-auto',
            0 => 'ml-0',
            1 => 'ml-1',
            2 => 'ml-2',
            4 => 'ml-4',
            6 => 'ml-6',
            8 => 'ml-8',
            10 => 'ml-10',
            12 => 'ml-12',
            14 => 'ml-14',
            16 => 'ml-16',
            20 => 'ml-20',
            24 => 'ml-24'
        ];

        $mr = [
            'x' => 'mr-x',
            'auto' => 'mr-auto',
            0 => 'mr-0',
            1 => 'mr-1',
            2 => 'mr-2',
            4 => 'mr-4',
            6 => 'mr-6',
            8 => 'mr-8',
            10 => 'mr-10',
            12 => 'mr-12',
            14 => 'mr-14',
            16 => 'mr-16',
            20 => 'mr-20',
            24 => 'mr-24'
        ];

        $classes = [
            $this->get_class('top', $mt, $value),
            $this->get_class('bottom', $mb, $value),
            $this->get_class('left', $ml, $value),
            $this->get_class('right', $mr, $value)
        ];

        return implode(" ", array_filter($classes));
    }
}
