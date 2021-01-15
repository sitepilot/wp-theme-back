<?php

namespace Sitepilot\Theme;

class Astra extends Module
{
    /**
     * Construct the Astra module.
     * 
     * @return void
     */
    public function __construct(...$arguments)
    {
        parent::__construct(...$arguments);

        add_action('after_setup_theme', [$this, 'action_after_theme_setup']);
    }

    /**
     * Initialize the Astra module.
     * 
     * @return void
     */
    public function action_after_theme_setup(): void
    {
        if (!defined("ASTRA_THEME_VERSION")) {
            return;
        }

        /* Actions */
        add_action('wp', [$this, 'action_clear_layout'], 99);

        /* Filters */
        add_filter('astra_tablet_breakpoint', function () {
            return $this->theme->model->get_tablet_breakpoint();
        });
    }

    /**
     * Filter layout options.
     *
     * @return void
     */
    public function action_clear_layout(): void
    {
        if ($this->theme->model->is_builder_layout()) {
            add_filter('astra_the_title_enabled', '__return_false');
            add_filter('astra_featured_image_enabled', '__return_false');
            add_filter('astra_single_post_navigation_enabled', '__return_false');

            if (is_front_page()) {
                add_filter('astra_is_transparent_header', '__return_true');
            }

            add_filter('astra_page_layout', function () {
                return 'no-sidebar';
            });

            add_filter('astra_get_content_layout', function () {
                return 'page-builder';
            });
        } elseif ($this->theme->model->is_blocks_layout()) {
            add_filter('astra_the_title_enabled', '__return_false');
            add_filter('astra_featured_image_enabled', '__return_false');
            add_filter('astra_single_post_navigation_enabled', '__return_false');
            add_filter('astra_content_margin_full_width_contained', '__return_true');

            add_filter('astra_page_layout', function () {
                return 'no-sidebar';
            });

            add_filter('astra_get_content_layout', function () {
                return 'plain-container';
            });
        }
    }
}
