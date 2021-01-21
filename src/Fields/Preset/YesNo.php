<?php

namespace Sitepilot\Theme\Fields\Preset;

use Sitepilot\Theme\Fields\Select;

class YesNo extends Select
{
    public function __construct(...$arguments)
    {
        parent::__construct(...$arguments);

        $this->options([
            1 => __('Yes', 'sp-theme'),
            0 => __('No', 'sp-theme')
        ]);
    }
}
