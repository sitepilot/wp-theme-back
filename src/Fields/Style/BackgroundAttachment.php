<?php

namespace Sitepilot\Theme\Fields\Style;

use Sitepilot\Theme\Fields\Select;

class BackgroundAttachment extends Select
{
    public function __construct(...$arguments)
    {
        parent::__construct(...$arguments);

        $this->options([
            'default' => '',
            'fixed' => __('Fixed', 'sp-theme'),
            'local' => __('Local', 'sp-theme'),
            'scroll' => __('Scroll', 'sp-theme')
        ]);

        $this->default_select('default');
    }

    protected function value($value)
    {
        $classes = [
            'fixed' => 'bg-fixed',
            'local' => 'bg-local',
            'scroll' => 'bg-scroll',
        ];

        return $classes[$value] ?? $value;
    }
}
