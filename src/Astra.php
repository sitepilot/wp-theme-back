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
        if (!$this->is_active()) {
            return;
        }

        /* Actions */
        add_action('wp', [$this, 'action_clear_layout'], 99);

        /* Filters */
        add_filter('astra_tablet_breakpoint', function ($value) {
            if ($this->theme->model->get_tablet_breakpoint()) {
                return $this->theme->model->get_tablet_breakpoint();
            };

            return $value;
        });

        add_filter('astra_get_option_site-content-width', function ($value) {
            if ($this->theme->model->get_container_width()) {
                return $this->theme->model->get_container_width();
            }

            return $value;
        });
    }

    /**
     * Check if theme is active.
     *
     * @return boolean
     */
    public function is_active()
    {
        return defined("ASTRA_THEME_VERSION");
    }

    /**
     * Filter layout options.
     *
     * @return void
     */
    public function action_clear_layout(): void
    {
        if ($this->theme->model->is_blocks_layout()) {
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
        } elseif ($this->theme->model->is_builder_layout()) {
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
        }
    }
}
