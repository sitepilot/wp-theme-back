<?php

namespace Sitepilot\Theme\Fields\Style;

use Sitepilot\Theme\Fields\Select;

class BackgroundColor extends Select
{
    public function __construct(...$arguments)
    {
        parent::__construct(...$arguments);

        $this->options([
            'default' => '',
            'primary' => __('Primary', 'sp-theme'),
            'secondary' => __('Secondary', 'sp-theme'),
            'black' => __('Black', 'sp-theme'),
            'white' => __('White', 'sp-theme'),
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
            'primary' => 'bg-primary',
            'secondary' => 'bg-secondary',
            'black' => 'bg-black',
            'white' => 'bg-white',
            'gray-50' => 'bg-gray-50',
            'gray-100' => 'bg-gray-100',
            'gray-200' => 'bg-gray-200',
            'gray-300' => 'bg-gray-300',
            'gray-400' => 'bg-gray-400',
            'gray-500' => 'bg-gray-500',
            'gray-600' => 'bg-gray-600',
            'gray-700' => 'bg-gray-700',
            'gray-800' => 'bg-gray-800',
            'gray-900' => 'bg-gray-900'
        ];

        return $classes[$value] ?? $value;
    }
}
