<?php

namespace Sitepilot\Theme\Fields\Style;

use Sitepilot\Theme\Fields\Select;

class Height extends Select
{
    public function __construct(...$arguments)
    {
        parent::__construct(...$arguments);

        $this->options([
            'default' => '',
            'screen' => __('Screen', 'sp-theme')
        ]);

        $this->default_select('default');
    }

    protected function value($value)
    {
        $classes = [
            'screen' => 'h-screen'
        ];

        return $classes[$value] ?? $value;
    }
}
