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
            'gray-50' => sprintf(__('Gray %s', 'sp-theme'), 50),
            'gray-100' => sprintf(__('Gray %s', 'sp-theme'), 100),
            'gray-200' => sprintf(__('Gray %s', 'sp-theme'), 200),
            'gray-300' => sprintf(__('Gray %s', 'sp-theme'), 300),
            'gray-400' => sprintf(__('Gray %s', 'sp-theme'), 400),
            'gray-500' => sprintf(__('Gray %s', 'sp-theme'), 500),
            'gray-600' => sprintf(__('Gray %s', 'sp-theme'), 600),
            'gray-700' => sprintf(__('Gray %s', 'sp-theme'), 700),
            'gray-800' => sprintf(__('Gray %s', 'sp-theme'), 800),
            'gray-900' => sprintf(__('Gray %s', 'sp-theme'), 900),
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
