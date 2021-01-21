<?php

namespace Sitepilot\Theme\Fields\Style;

use Sitepilot\Theme\Fields\Select;

class TextColor extends Select
{
    public function __construct(...$arguments)
    {
        parent::__construct(...$arguments);

        $this->options([
            'default' => __('Default', 'sp-theme'),
            'primary' => __('Primary', 'sp-theme'),
            'secondary' => __('Secondary', 'sp-theme'),
            'gray-50' => __('Gray 50', 'sp-theme'),
            'gray-100' => __('Gray 100', 'sp-theme'),
            'gray-200' => __('Gray 200', 'sp-theme'),
            'gray-300' => __('Gray 300', 'sp-theme'),
            'gray-400' => __('Gray 400', 'sp-theme'),
            'gray-500' => __('Gray 500', 'sp-theme'),
            'gray-600' => __('Gray 600', 'sp-theme'),
            'gray-700' => __('Gray 700', 'sp-theme'),
            'gray-800' => __('Gray 800', 'sp-theme'),
            'gray-900' => __('Gray 900', 'sp-theme')
        ]);

        $this->default_select('default');
    }

    protected function value($value)
    {
        $classes = [
            'primary' => 'text-primary',
            'secondary' => 'text-secondary',
            'gray-50' => 'text-gray-50',
            'gray-100' => 'text-gray-100',
            'gray-200' => 'text-gray-200',
            'gray-300' => 'text-gray-300',
            'gray-400' => 'text-gray-400',
            'gray-500' => 'text-gray-500',
            'gray-600' => 'text-gray-600',
            'gray-700' => 'text-gray-700',
            'gray-800' => 'text-gray-800',
            'gray-900' => 'text-gray-900'
        ];

        return $classes[$value] ?? $value;
    }
}
