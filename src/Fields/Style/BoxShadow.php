<?php

namespace Sitepilot\Theme\Fields\Style;

use Sitepilot\Theme\Fields\Select;

class BoxShadow extends Select
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
            'full' => __('Full', 'sp-theme')
        ]);

        $this->default_select('default');
    }

    protected function value($value)
    {
        $classes = [
            'xs' => 'shadow-sm',
            'sm' => 'shadow',
            'md' => 'shadow-md',
            'lg' => 'shadow-lg',
            'xl' => 'shadow-xl'
        ];

        return $classes[$value] ?? $value;
    }
}
