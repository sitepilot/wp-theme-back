<?php

namespace Sitepilot\Theme\Fields\Style;

use Sitepilot\Theme\Fields\Select;

class FontSize extends Select
{
    public function __construct(...$arguments)
    {
        parent::__construct(...$arguments);

        $this->options([
            'default' => '',
            'xs' => __('Extra Small', 'sp-theme'),
            'sm' => __('Small', 'sp-theme'),
            'md' => __('Medium', 'sp-theme'),
            'lg' => __('Large', 'sp-theme'),
            'xl' => __('Extra Large', 'sp-theme'),
            '2xl' => __('2 XL', 'sp-theme'),
            '3xl' => __('3 XL', 'sp-theme'),
            '4xl' => __('4 XL', 'sp-theme'),
            '5xl' => __('5 XL', 'sp-theme'),
            '6xl' => __('6 XL', 'sp-theme'),
            '7xl' => __('7 XL', 'sp-theme'),
            '8xl' => __('8 XL', 'sp-theme'),
            '9xl' => __('9 XL', 'sp-theme')
        ]);

        $this->default_select('default');
    }

    protected function value($value)
    {
        $classes = [
            'xs' => 'text-xs',
            'sm' => 'text-sm',
            'md' => 'text-base',
            'lg' => 'text-lg',
            'xl' => 'text-xl',
            '2xl' => 'text-2xl',
            '3xl' => 'text-3xl',
            '4xl' => 'text-4xl',
            '5xl' => 'text-5xl',
            '6xl' => 'text-6xl',
            '7xl' => 'text-7xl',
            '8xl' => 'text-8xl',
            '9xl' => 'text-9xl'
        ];

        return $classes[$value] ?? $value;
    }
}
