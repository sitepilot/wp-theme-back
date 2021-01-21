<?php

namespace Sitepilot\Theme\Fields\Style;

use Sitepilot\Theme\Fields\Select;

class FontSize extends Select
{
    public function __construct(...$arguments)
    {
        parent::__construct(...$arguments);

        $this->options([
            'default' => __('Default', 'sp-theme'),
            'xs' => __('Extra Small', 'sp-theme'),
            'sm' => __('Small', 'sp-theme'),
            'md' => __('Medium', 'sp-theme'),
            'lg' => __('Large', 'sp-theme'),
            'xl' => __('Extra Large', 'sp-theme')
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
            'xl' => 'text-xl'
        ];

        return $classes[$value] ?? $value;
    }
}
