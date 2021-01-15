<?php

namespace Sitepilot\Theme;

use Jenssegers\Blade\Blade;
use Sitepilot\Theme\Traits\HasFields;

abstract class Base
{
    use HasFields;

    /**
     * The model instance.
     *
     * @var Model
     */
    public $model;

    /**
     * The Astra instance.
     *
     * @var Astra
     */
    public $astra;

    /**
     * The ACF instance.
     * 
     * @var ACF
     */
    public $acf;

    /**
     * The builder instance.
     * 
     * @var Builder
     */
    public $builder;

    /**
     * The blocks instance.
     * 
     * @var Blocks
     */
    public $blocks;

    /**
     * Create a new theme instance.
     *
     * @return static
     */
    public static function make(...$arguments)
    {
        return new static(...$arguments);
    }

    /**
     * Setup theme.
     * 
     * @return void
     */
    public function __construct()
    {
        if (defined('SITEPILOT_THEME_VERSION')) {
            return;
        }

        /** Defines */
        define('SITEPILOT_THEME_VERSION', wp_get_theme()->get('Version'));
        define('SITEPILOT_THEME_DIR', trailingslashit(get_stylesheet_directory()));
        define('SITEPILOT_THEME_URL', trailingslashit(get_stylesheet_directory_uri()));
        define('SITEPILOT_THEME_FILE', SITEPILOT_THEME_DIR . 'functions.php');

        /* Actions */
        add_action('wp_head', [$this, 'action_theme_style']);
        add_action('admin_head', [$this, 'action_theme_style']);
        add_action('wp_enqueue_scripts', [$this, 'action_enqueue_scripts']);
        add_action('enqueue_block_editor_assets', [$this, 'action_enqueue_scripts']);

        /* Filters */
        add_filter('template_include', [$this, 'filter_template_include']);
        add_filter('sp_update_list', [$this, 'filter_update_list']);

        /* Modules */
        $this->acf = new Acf($this);
        $this->astra = new Astra($this);
        $this->model = new Model($this);
        $this->blocks = new Blocks($this);
        $this->builder = new Builder($this);
    }

    /**
     * Enqueue theme scripts and stylesheets.
     * 
     * @return void
     */
    abstract function action_enqueue_scripts();

    /**
     * Register theme to the Sitepilot updater.
     *
     * @param array $update_list
     * @return array $update_list
     */
    public function filter_update_list(array $update_list)
    {
        if (strpos(SITEPILOT_THEME_VERSION, '-dev') === false) {
            $theme['file'] = SITEPILOT_THEME_FILE;
            $theme['slug'] = get_option('stylesheet');

            array_push($update_list, $theme);
        }

        return $update_list;
    }

    /**
     * Returns a blade instance.
     *
     * @return Blade
     */
    public static function blade($folders = []): Blade
    {
        return new Blade(array_merge([__DIR__ . '/../views'], $folders), apply_filters('sp_theme_cache_dir', get_stylesheet_directory() . '/cache'));
    }

    /**
     * Add theme colors to WordPress head.
     *
     * @return void
     */
    public function action_theme_style(): void
    {
        echo self::blade()->make('style', ['theme' => $this])->render();
    }

    /**
     * Filter template path.
     *
     * @param string $template
     * @return void
     */
    public function filter_template_include($template): string
    {
        if (self::get_template_post_id()) {
            return __DIR__ . '/../templates/template.php';
        }

        return $template;
    }

    /**
     * Get the template ID.
     *
     * @return int
     */
    public static function get_template_post_id(): int
    {
        if (is_404()) {
            $id = apply_filters('sp_theme_template_id_404', null);
            if ($id) {
                return $id;
            }
        }

        if (is_search()) {
            $id = apply_filters('sp_theme_template_id_search', null);
            if ($id) {
                return $id;
            }
        }

        foreach (get_post_types() as $type) {
            $id = apply_filters("sp_theme_template_id_{$type}_archive", null);
            if (($type == 'post' && is_home() || is_post_type_archive($type)) && $id) {
                return $id;
            }
        }

        return 0;
    }
}
