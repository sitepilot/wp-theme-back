<?php

namespace Sitepilot\Theme;

class Model extends Module
{
    public function get_theme_version()
    {
        return strpos(SITEPILOT_THEME_VERSION, '-dev') !== false ? time() : SITEPILOT_THEME_VERSION;
    }

    public function get_layout()
    {
        return apply_filters('sp_theme_layout', null);
    }

    public function is_blocks_layout()
    {
        return $this->get_layout() == 'blocks';
    }

    public function is_builder_layout()
    {
        return $this->get_layout() == 'builder';
    }

    public function autoload_blocks()
    {
        return apply_filters('sp_theme_autoload_blocks', true);
    }

    public function filter_blocks()
    {
        return apply_filters('sp_theme_filter_blocks', true);
    }

    public function get_primary_color()
    {
        return apply_filters('sp_theme_primary_color', null);
    }

    public function get_secondary_color()
    {
        return apply_filters('sp_theme_secondary_color', null);
    }

    public function get_block_margin()
    {
        return apply_filters('sp_theme_block_margin', '2rem');
    }

    public function get_block_category_name()
    {
        return apply_filters('sp_theme_block_category', 'Sitepilot');
    }

    public function get_container_width()
    {
        return apply_filters('sp_theme_container_width', null);
    }

    public function get_tablet_breakpoint()
    {
        return apply_filters('sp_theme_tablet_breakpoint', null);
    }
}
