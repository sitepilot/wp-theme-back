<?php

namespace Sitepilot\Theme;

use Exception;
use ReflectionClass;
use Sitepilot\Theme\Traits\HasFields;

abstract class Block
{
    use HasFields;

    /**
     * The block id.
     *
     * @var string
     */
    public $id;

    /**
     * The block name.
     *
     * @var string
     */
    public $name;

    /**
     * The caller directory.
     *
     * @var string
     */
    public $dir;

    /**
     * The block icon.
     * 
     * @var string
     */
    public $icon;

    /**
     * The default margin.
     * 
     * @var int
     */
    public $margin = 8;

    /**
     * The block class.
     * 
     * @var string
     */
    public $class;

    /**
     * Create a new block instance.
     *
     * @return static
     */
    public static function make(...$arguments)
    {
        return new static(...$arguments);
    }

    /**
     * Create a new block instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
        $this->name = $id;
        $this->class = $this->id;

        $reflectionClass = new ReflectionClass($this);
        $this->dir = dirname($reflectionClass->getFileName());

        add_shortcode($this->id, [$this, 'render_shortcode']);
    }

    /**
     * Set the block icon.
     * 
     * @return self
     */
    public function icon($icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Set the block name.
     * 
     * @return self
     */
    public function name($name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set the block class.
     * 
     * @return self
     */
    public function class($class): self
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get additional block settings.
     * 
     * @return array
     */
    public function settings(): array
    {
        return [];
    }

    /**
     * Get view data.
     *
     * @return array
     */
    public function data($data, $post_id): array
    {
        return array_merge($data, []);
    }

    /**
     * Render block.
     *
     * @return void
     */
    public function render_block($block, $content = '', $is_preview = false, $post_id = 0): void
    {
        $field_data = [];
        foreach ($this->fields() as $field) {
            $value = get_field($field->attribute);
            $field_data[str_replace('sp_', '', $field->attribute)] = $value ? $value : $field->default;
        }

        $data = $this->data(array_merge([
            'post_id' => $post_id,
            'block' => $this,
            'class' => 'sp-block ' . $this->class
        ], $field_data), $post_id);

        if (!empty($block['className'])) {
            $data['class'] .= ' ' . $block['className'];
        }

        if (!empty($block['align'])) {
            $data['class'] .= ' align' . $block['align'];
        }

        echo $this->render($data);
    }

    /**
     * Render shortcode.
     *
     * @param array $args
     * @param string $slot
     * @return string
     */
    public function render_shortcode($args = [], $slot = ''): string
    {
        $field_data = [];
        foreach ($this->fields() as $field) {
            $key = str_replace('sp_', '', $field->attribute);
            $field_data[$key] = $args[$key] ?? $field->default;
        }

        $data = $this->data(array_merge([
            'post_id' => get_the_ID(),
            'block' => $this,
            'class' => 'sp-block sp-shortcode ' . $this->class,
        ], $field_data, ['slot' => $slot ? $slot : '']), get_the_ID());

        return $this->render($data);
    }

    /**
     * Render view.
     *
     * @param array $data
     * @return string
     */
    private function render(array $data): string
    {
        $data = $this->filter_view_data($data);
        $blade = Base::blade([$this->dir . '/views']);

        try {
            $view = $blade->make($data['layout'] ?? 'frontend', $data)->render();
        } catch (Exception $e) {
            $data['exception'] = $e->getMessage();
        }

        if (empty(trim($view)) && is_admin()) {
            if (empty($data['exception'])) {
                $data['exception'] = "";
            }
            return $blade->make('block-404', $data)->render();
        } else {
            return $view;
        }
    }

    /**
     * Filter view data.
     *
     * @return array
     */
    public function filter_view_data($data): array
    {
        if (isset($data['margin'])) {
            switch ($data['margin']) {    
                case 'none':
                    $data['margin'] = "mt-0 mb-0";
                    break;
                case 'top':
                    $data['margin'] = "mt-x mb-0";
                    break;
                case 'bottom':
                    $data['margin'] = "mt-0 mb-x";
                    break;
                default:
                    $data['margin'] = "mt-x mb-x";;
                    break;
            }
        }

        return $data;
    }
}
