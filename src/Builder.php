<?php

namespace Sitepilot\Theme;

class Builder extends Module
{
    /**
     * Construct the Builder module.
     * 
     * @return void
     */
    public function __construct(...$arguments)
    {
        parent::__construct(...$arguments);

        add_action('wp', [$this, 'action_after_theme_setup'], 20);
    }

    /**
     * Initialize the Builder module.
     * 
     * @return void
     */
    public function action_after_theme_setup()
    {
        if (!defined("FL_BUILDER_VERSION")) {
            return;
        }

        if (get_post_meta(get_the_ID(), '_fl_builder_enabled', true) || isset($_GET['fl_builder'])) {
            add_filter('sp_theme_layout', function () {
                return 'builder';
            });
        }
    }
}
