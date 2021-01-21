<?php

namespace Sitepilot\Theme\Blocks;

use Sitepilot\Theme\Block;

class Map extends Block
{
    public function __construct()
    {
        parent::__construct([
            'id' => 'sp-map',
            'name' => __('Google Maps', 'sp-theme'),
            'icon' => 'location-alt',
        ]);
    }

    public function fields(): array
    {
        return [
            $this->field_textarea(__('Embed Code', 'sp-theme'), 'embed_code')
        ];
    }
}
