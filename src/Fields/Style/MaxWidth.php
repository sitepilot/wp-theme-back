<?php

namespace Sitepilot\Theme\Fields\Style;

use Sitepilot\Theme\Fields\Select;

class MaxWidth extends Select
{
    public function __construct(...$arguments)
    {
        parent::__construct(...$arguments);

        $this->options([
            'default' => __('Default', 'sp-theme'),
            'container' => __('Container', 'sp-theme'),
            'xl' => __('Extra Large', 'sp-theme'),
            'lg' => __('Large', 'sp-theme'),
            'md' => __('Medium', 'sp-theme'),
            'sm' => __('Small', 'sp-theme'),
            'xs' => __('Extra Small', 'sp-theme')
        ]);

        $this->default_select('default');
    }

    protected function value($value)
    {
        $classes = [
            'container' => 'ast-container',
            'xl' => 'mx-auto max-w-xl',
            'lg' => 'mx-auto max-w-lg',
            'md' => 'mx-auto max-w-md',
            'sm' => 'mx-auto max-w-sm',
            'xs' => 'mx-auto max-w-xs'
        ];

        return $classes[$value] ?? $value;
    }
}
