<?php

namespace Sitepilot\Theme;

class Template extends Module
{
    /**
     * Construct the Template module.
     * 
     * @return void
     */
    public function __construct(...$arguments)
    {
        parent::__construct(...$arguments);

        /* Actions */
        add_action('init', [$this, 'action_register_template_options'], 99);
        add_action('init', [$this, 'action_register_template_post_type'], 99);

        /* Filters */
        add_filter('template_include', [$this, 'filter_template_include']);
    }

    /**
     * Register template custom post type.
     *
     * @return void
     */
    public function action_register_template_post_type(): void
    {
        $labels = array(
            'name' => __('Templates', 'sp-theme'),
            'singular_name' => __('Template', 'sp-theme'),
            'add_new' => __('New Template', 'sp-theme'),
            'add_new_item' => __('New Template', 'sp-theme'),
            'edit_item' => __('Edit Template', 'sp-theme'),
            'new_item' => __('New Template', 'sp-theme'),
            'view_item' => __('View Template', 'sp-theme'),
            'search_items' => __('Search Templates', 'sp-theme'),
            'not_found' =>  __('No Templates Found', 'sp-theme'),
            'not_found_in_trash' => __('No templates in trash.', 'sp-theme'),
        );

        $args = array(
            'labels' => $labels,
            'has_archive' => false,
            'public' => true,
            'hierarchical' => false,
            'supports' => array(
                'title',
                'editor'
            ),
            'taxonomies' => [],
            'rewrite' => array('slug' => 'template'),
            'show_in_rest' => true,
            'menu_icon' => 'dashicons-welcome-widgets-menus',
        );

        register_post_type('sp-template', $args);
    }

    /**
     * Register template options.
     *
     * @return void
     */
    public function action_register_template_options()
    {
        $locations = [];
        foreach (get_post_types() as $post_type) {
            if ((substr($post_type, 0, 3) == 'sp-' || in_array($post_type, ['post', 'page'])) && !in_array($post_type, ['sp-log', 'sp-template'])) {
                $object = get_post_type_object($post_type);
                $locations[$post_type . '_archive'] = $object->labels->singular_name . ' ' . __('Archive', 'sp-theme');
            }
        }

        $locations = array_merge($locations, [
            'search' => __('Search Results', 'sp-theme'),
            '404' => __('Page Not Found', 'sp-theme')
        ]);

        if (function_exists('acf_add_local_field_group')) {
            acf_add_local_field_group(array(
                'key' => 'group_UC5lGtpYP4',
                'title' => 'Template',
                'fields' => array(
                    array(
                        'key' => 'field_dTXVnLBQ8o',
                        'label' => __('Location', 'sp-theme'),
                        'name' => 'sp_location',
                        'type' => 'checkbox',
                        'conditional_logic' => 0,
                        'choices' => $locations,
                        'allow_custom' => 0,
                        'default_value' => array(),
                        'layout' => 'vertical',
                        'toggle' => 0,
                        'return_format' => 'value',
                        'save_custom' => 0,
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'sp-template',
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'side',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => true
            ));
        }
    }

    /**
     * Filter template path.
     *
     * @param string $template
     * @return void
     */
    public function filter_template_include($template): string
    {
        if (self::get_template_id()) {
            return __DIR__ . '/../templates/template.php';
        }

        return $template;
    }

    /**
     * Get the template ID.
     *
     * @return int
     */
    public static function get_template_id(): ?int
    {
        $template_id = 0;
        $templates = new \WP_Query([
            'post_type' => 'sp-template',
            'post_status' => 'publish'
        ]);
        $post_types = get_post_types();

        foreach ($templates->posts as $template) {
            $locations = get_field('sp_location', $template->ID);
            $locations = is_array($locations) ? $locations : [];

            foreach ($post_types as $post_type) {
                if (in_array("{$post_type}_archive", $locations) && is_post_type_archive($post_type)) {
                    $template_id = $template->ID;
                }
            }

            if (in_array('search', $locations) && is_search()) {
                $template_id = $template->ID;
            }

            if (in_array('post_archive', $locations) && is_home()) {
                $template_id = $template->ID;
            }
        }

        return $template_id;
    }
}
