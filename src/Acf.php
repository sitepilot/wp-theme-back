<?php

namespace Sitepilot\Theme;

class Acf extends Module
{
    /**
     * The options page object.
     *
     * @var mixed
     */
    protected $options_page;

    /**
     * Construct the ACF module.
     * 
     * @return void
     */
    public function __construct(...$arguments)
    {
        if (!class_exists("ACF")) {
            return;
        }

        parent::__construct(...$arguments);

        /* Actions */
        add_action('acf/init', [$this, 'action_register_blocks']);
        add_action('acf/init', [$this, 'action_register_options_page']);
    }

    /**
     * Register theme options page.
     *
     * @return void
     */
    public function action_register_options_page(): void
    {
        if (count($this->theme->fields())) {
            if (function_exists('acf_add_options_page')) {
                $this->options_page = acf_add_options_page(array(
                    'page_title' => __('Theme Options', 'sp-theme'),
                    'menu_title' => __('Theme', 'sp-theme'),
                    'menu_slug' => 'sp-theme',
                    'capability' => 'edit_posts',
                    'redirect' => false,
                    'parent_slug' => 'sitepilot-menu',
                    'position' => 0
                ));
            }

            if (function_exists('acf_add_local_field_group')) {
                $fields = [];
                foreach ($this->theme->fields() as $field) {
                    $fields[] = $field->get_config('acf');
                }

                acf_add_local_field_group(array(
                    'key' => 'group_theme',
                    'title' => __('Theme Options', 'sp-theme'),
                    'fields' => $fields,
                    'location' => array(
                        array(
                            array(
                                'param' => 'options_page',
                                'operator' => '==',
                                'value' => 'sp-theme',
                            ),
                        ),
                    )
                ));
            }
        }
    }

    /**
     * Returns a theme option field.
     * 
     * @param string $key
     * @param mixed $default
     * @return void
     */
    static public function get_field($key, $default = null)
    {
        $value = null;

        if (function_exists('get_field')) {
            $value = get_field($key, 'option');
        }

        return $value ? $value : $default;
    }

    /**
     * Register block types.
     *
     * @return void
     */
    public function action_register_blocks(): void
    {
        foreach ($this->theme->blocks->get() as $block) {
            $fields = array();
            foreach ($block->get_fields() as $field) {
                $fields[] = $field->get_config('acf');

                foreach ($field->get_subfields() as $field) {
                    $fields[] = $field->get_config('acf');
                }
            }

            if (function_exists('acf_register_block_type')) {
                $align = array();
                if ($block->config->supports->full_width ?? false) $align[] = 'full';
                if ($block->config->supports->wide_width ?? false) $align[] = 'wide';

                acf_register_block_type([
                    'name' => $block->config->id,
                    'title' => $block->config->name,
                    'render_callback' => array($block, 'render_block'),
                    'category' => $block->config->category,
                    'icon' => $block->config->icon,
                    'supports' => [
                        'align' => count($align) ? $align : false,
                        'align_text' => $block->config->supports->text_align ?? false,
                        'jsx' => $block->config->supports->inner_blocks
                    ]
                ]);
            }

            if (function_exists('acf_add_local_field_group')) {
                acf_add_local_field_group(array(
                    'key' => 'group_' . $block->config->id,
                    'title' => $block->config->name,
                    'fields' => $fields,
                    'location' => array(
                        array(
                            array(
                                'param' => 'block',
                                'operator' => '==',
                                'value' => 'acf/' . $block->config->id,
                            ),
                        ),
                    )
                ));
            }

            add_filter('allowed_block_types', function ($blocks) use ($block) {
                if (is_array($blocks)) {
                    $blocks[] = 'acf/' . $block->config->id;
                }
                return $blocks;
            }, 99, 1);
        }
    }
}
