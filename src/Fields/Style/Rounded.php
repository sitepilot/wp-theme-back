<?php

namespace Sitepilot\Theme\Fields\Style;

use Sitepilot\Theme\Fields\Select;

class Rounded extends Select
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
            'xl' => __('Extra Large', 'sp-theme'),
            'full' => __('Full', 'sp-theme')
        ]);

        $this->default_select('default');
    }

    protected function value($value)
    {
        $classes = [
            'xs' => 'rounded-sm',
            'sm' => 'rounded',
            'md' => 'rounded-md',
            'lg' => 'rounded-lg',
            'xl' => 'rounded-xl',
            'full' => 'rounded-full'
        ];

        return $classes[$value] ?? $value;
    }
}
