<?php

namespace Sitepilot\Theme\Fields\Style;

use Sitepilot\Theme\Fields\Select;

class Opacity extends Select
{
    public function __construct(...$arguments)
    {
        parent::__construct(...$arguments);

        $this->options([
            'default' => '',
            0 => '0%',
            5 => '5%',
            10 => '10%',
            20 => '20%',
            25 => '25%',
            30 => '30%',
            40 => '40%',
            50 => '50%',
            60 => '60%',
            70 => '70%',
            75 => '75%',
            80 => '80%',
            90 => '90%',
            95 => '95%',
            100 => '100%',
        ]);

        $this->default_select('default');
    }

    protected function value($value)
    {
        $classes = [
            0 => 'opacity-0',
            5 => 'opacity-5%',
            10 => 'opacity-10',
            20 => 'opacity-20',
            25 => 'opacity-25',
            30 => 'opacity-30',
            40 => 'opacity-40',
            50 => 'opacity-50',
            60 => 'opacity-60',
            70 => 'opacity-70',
            75 => 'opacity-75',
            80 => 'opacity-80',
            90 => 'opacity-90',
            95 => 'opacity-95',
            100 => 'opacity-100'
        ];

        return $classes[$value] ?? $value;
    }
}
