<?php

namespace Sitepilot\Theme\Fields\Preset;

use Sitepilot\Theme\Fields\Select;

class ImageSize extends Select
{
    public function __construct(...$arguments)
    {
        parent::__construct(...$arguments);

        $image_sizes = wp_get_registered_image_subsizes();

        $options = array();
        foreach ($image_sizes as $size => $data) {
            $options[$size] = ucfirst("{$data['width']}x{$data['height']}");
        }

        $options['full'] = __('Full Size', 'sp-theme');

        $this->options($options);
    }
}
