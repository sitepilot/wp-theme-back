<?php

namespace Sitepilot\Theme\Fields\Style;

use Sitepilot\Theme\Fields\Select;

class TextAlign extends Select
{
    public function __construct(...$arguments)
    {
        parent::__construct(...$arguments);

        $this->options([
            'default' => __('Default', 'sp-theme'),
            'left' => __('Left', 'sp-theme'),
            'center' => __('Center', 'sp-theme'),
            'right' => __('Right', 'sp-theme'),
            'justify' => __('Justify', 'sp-theme')
        ]);

        $this->default_select('default');
    }

    protected function value($value)
    {
        $classes = [
            'left' => 'text-left',
            'center' => 'text-center',
            'right' => 'text-right',
            'justify' => 'text-justify'
        ];

        return $classes[$value] ?? $value;
    }
}
