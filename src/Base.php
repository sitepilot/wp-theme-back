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

        /* Modules */
        $this->acf = new Acf($this);
        $this->astra = new Astra($this);
        $this->model = new Model($this);
        $this->blocks = new Blocks($this);
        $this->builder = new Builder($this);
        $this->template = new Template($this);

        /* Actions */
        add_action('wp_enqueue_scripts', [$this, 'action_enqueue_scripts']);
        add_action('enqueue_block_editor_assets', [$this, 'action_enqueue_scripts']);

        /* Filters */
        add_filter('sp_update_list', [$this, 'filter_update_list']);

        /* Translation */
        load_theme_textdomain('sp-theme', __DIR__ . '/../lang');
    }

    /**
     * Enqueue theme scripts and stylesheets.
     * 
     * @return void
     */
    public function action_enqueue_scripts()
    {
        wp_register_script('font-awesome-5', 'https://kit.fontawesome.com/ec90000d1a.js');
    }

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
     * @return string
     */
    public function get_theme_css(): string
    {
        return self::blade()->make('theme-css', ['theme' => $this])->render();
    }
}
