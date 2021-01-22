<?php

namespace Sitepilot\Theme;

class Blocks extends Module
{
    /**
     * The registered blocks.
     *
     * @var array
     */
    public $blocks = [];

    /**
     * Construct the Blocks module.
     * 
     * @return void
     */
    public function __construct(...$arguments)
    {
        parent::__construct(...$arguments);

        /* Actions */
        add_action('after_setup_theme', [$this, 'action_autoload_blocks']);

        /* Filters */
        add_filter('block_categories', [$this, 'filter_block_categories']);
        add_filter('allowed_block_types', [$this, 'filter_allowed_block_types']);
    }

    /**
     * Get the registered blocks.
     *
     * @return array
     */
    public function get(): array
    {
        return $this->blocks;
    }

    /**
     * Load Gutenberg blocks.
     *
     * @return void
     */
    public function action_autoload_blocks(): void
    {
        if ($this->theme->model->autoload_blocks()) {
            $dir = get_stylesheet_directory() . '/blocks';
            $folders = scandir($dir);

            foreach ($folders as $block) {
                $this->load_block($dir, $block);
            }

            $dir = __DIR__ . '/../blocks';
            $folders = scandir($dir);

            foreach ($folders as $block) {
                $this->load_block($dir, $block);
            }
        }
    }

    /**
     * Load block from dir.
     *
     * @param string $dir
     * @param string $block
     * @return void
     */
    private function load_block($dir, $block)
    {
        $class = "\Sitepilot\Theme\Blocks\\";
        $file = "$dir/$block/$block.php";
        $words = explode('-', $block);

        foreach ($words as $word) {
            $class .= ucfirst($word);
        }

        if (file_exists($file)) {
            require_once $file;

            if (class_exists($class)) {
                $this->blocks[] = new $class();
            }
        }
    }

    /**
     * Filter Gutenberg block categories.
     * 
     * @return array
     */
    public function filter_block_categories($categories): array
    {
        array_splice($categories, 1, 0, array(
            array(
                'slug' => 'sp-blocks',
                'title' => $this->theme->model->get_block_category_name()
            ),
        ));

        return $categories;
    }


    /**
     * Filter allowed block types.
     *
     * @param bool|array $blocks
     * @return bool|array
     */
    public function filter_allowed_block_types($blocks)
    {
        if ($this->theme->model->filter_blocks()) {
            $blocks = !is_array($blocks) ? [] : $blocks;

            $blocks = array_merge($blocks, [
                'core/image',
                'core/paragraph',
                'core/heading',
                'core/list',
                'core/code',
                'core/file',
                'core/buttons',
                'core/columns',
                'core/separator',
                'core/code',
                'core/spacer',
                'fl-builder/layout'
            ]);
        }

        return $blocks;
    }
}
