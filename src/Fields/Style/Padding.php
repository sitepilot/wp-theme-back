<?php

namespace Sitepilot\Theme\Fields\Style;

use Sitepilot\Theme\Fields\Dimension;

class Padding extends Dimension
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
            28 => 28,
            32 => 32,
            36 => 36,
            40 => 40,
            44 => 44,
            48 => 48,
            52 => 52,
            56 => 56,
            60 => 60
        ]);

        $this->default_select('default');
    }

    protected function value($value)
    {
        $pt = [
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
            24 => 'pt-24',
            28 => 'pt-28',
            32 => 'pt-32',
            36 => 'pt-36',
            40 => 'pt-40',
            44 => 'pt-44',
            48 => 'pt-48',
            52 => 'pt-52',
            56 => 'pt-56',
            60 => 'pt-60'
        ];

        $pb = [
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
            24 => 'pb-24',
            28 => 'pb-28',
            32 => 'pb-32',
            36 => 'pb-36',
            40 => 'pb-40',
            44 => 'pb-44',
            48 => 'pb-48',
            52 => 'pb-52',
            56 => 'pb-56',
            60 => 'pb-60'
        ];

        $pl = [
            0 => 'pl-0',
            1 => 'pl-1',
            2 => 'pl-2',
            4 => 'pl-4',
            6 => 'pl-6',
            8 => 'pl-8',
            10 => 'pl-10',
            12 => 'pl-12',
            14 => 'pl-14',
            16 => 'pl-16',
            20 => 'pl-20',
            24 => 'pl-24',
            28 => 'pl-28',
            32 => 'pl-32',
            36 => 'pl-36',
            40 => 'pl-40',
            44 => 'pl-44',
            48 => 'pl-48',
            52 => 'pl-52',
            56 => 'pl-56',
            60 => 'pl-60'
        ];

        $pr = [
            0 => 'pr-0',
            1 => 'pr-1',
            2 => 'pr-2',
            4 => 'pr-4',
            6 => 'pr-6',
            8 => 'pr-8',
            10 => 'pr-10',
            12 => 'pr-12',
            14 => 'pr-14',
            16 => 'pr-16',
            20 => 'pr-20',
            24 => 'pr-24',
            28 => 'pr-28',
            32 => 'pr-32',
            36 => 'pr-36',
            40 => 'pr-40',
            44 => 'pr-44',
            48 => 'pr-48',
            52 => 'pr-52',
            56 => 'pr-56',
            60 => 'pr-60'
        ];

        $classes = [
            $this->get_class('top', $pt, $value),
            $this->get_class('bottom', $pb, $value),
            $this->get_class('left', $pl, $value),
            $this->get_class('right', $pr, $value)
        ];

        return implode(" ", array_filter($classes));
    }
}
