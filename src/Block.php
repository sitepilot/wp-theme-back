<?php

namespace Sitepilot\Theme;

use Exception;
use ReflectionClass;
use Sitepilot\Theme\Traits\HasFields;

abstract class Block
{
    use HasFields;

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
    public function __construct(array $config = [])
    {
        $reflectionClass = new ReflectionClass($this);

        $this->config = json_decode(json_encode(array_replace_recursive([
            'id' => $config['id'],
            'name' => $config['id'],
            'class' => $config['id'],
            'icon' => '',
            'category' => 'sp-blocks',
            'supports' => array(
                'full_width' => false,
                'wide_width' => false,
                'text_align' => false,
                'inner_blocks' => false,
                'block_margin' => true
            ),
            'dir' => dirname($reflectionClass->getFileName()),
        ], $config)));

        add_shortcode($this->config->id, [$this, 'render_shortcode']);
    }

    /**
     * Returns block view data.
     *
     * @return array
     */
    protected function data($data, $post_id): array
    {
        return array_merge($data, []);
    }

    /**
     * Get block view data.
     *
     * @param array $data
     * @param int $post_id
     * @return array
     */
    public function get_data($data, $post_id): array
    {
        return array_merge($data, $this->data($data, $post_id));
    }

    /**
     * Returns and extends block fields.
     *
     * @return array
     */
    public function get_fields(): array
    {
        $fields = $this->fields();

        if ($this->config->supports->block_margin) {
            $fields[] = $this->field_group(__('Block Margin', 'sp-theme'), 'block_margin')
                ->fields([
                    $this->field_style_margin_top(__('Top Margin', 'sp-theme'), 'margin_top')->default_value('x'),
                    $this->field_style_margin_bottom(__('Bottom Margin', 'sp-theme'), 'margin_bottom')->default_value('x')
                ]);
        }

        return $fields;
    }

    /**
     * Render block.
     *
     * @return void
     */
    public function render_block($block, $content = '', $is_preview = false, $post_id = 0): void
    {
        $field_data = $classes = array();
        foreach ($this->get_fields() as $field) {
            $value = $field->get_value('acf');
            $field_data[$field->attribute()] = $value;

            foreach ($field->get_subfields() as $field) {
                $value = $field->get_value('acf');
                $field_data[$field->attribute()] = $value;

                if (!empty($value) && in_array($field->attribute(), ['margin_top', 'margin_bottom'])) {
                    $classes[] = $value;
                }
            }
        }

        $data = $this->get_data(array_merge([
            'post_id' => $post_id,
            'block' => $this,
            'block_class' => 'sp-block ' . $this->config->class,
            'classes' => implode(" ", $classes)
        ], $field_data), $post_id);

        if (!empty($block['className'])) {
            $data['block_class'] .= ' ' . $block['className'];
        }

        if (!empty($block['align'])) {
            $data['block_class'] .= ' align' . $block['align'];
        }

        if (!empty($block['align_text'])) {
            $data['block_class'] .= ' has-text-align-' . $block['align_text'];
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
        $field_data = $classes = array();
        foreach ($this->get_fields() as $field) {
            $value = $field->get_value('shortcode', $args);
            $field_data[$field->attribute()] = $value;

            foreach ($field->get_subfields() as $field) {
                $value = $field->get_value('shortcode', $args);
                $field_data[$field->attribute()] = $value;

                if (!empty($value) && in_array($field->attribute(), ['margin_top', 'margin_bottom'])) {
                    $classes[] = $value;
                }
            }
        }

        $data = $this->get_data(array_merge([
            'post_id' => get_the_ID(),
            'block' => $this,
            'block_class' => 'sp-block sp-shortcode ' . $this->config->class,
            'classes' => implode(" ", $classes)
        ], $field_data, ['slot' => !empty($slot) ? $slot : $field_data['slot']]), get_the_ID());

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
        $blade = Base::blade([$this->config->dir . '/views']);

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
}
