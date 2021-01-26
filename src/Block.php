<?php

namespace Sitepilot\Theme;

use Exception;
use ReflectionClass;
use Sitepilot\Theme\Fields\Field;
use Sitepilot\Theme\Traits\HasFields;

abstract class Block
{
    use HasFields;

    /**
     * Holds the block view data.
     *
     * @var array
     */
    private $view_data;

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
            'supports' => [
                'full_width' => false,
                'wide_width' => false,
                'text_align' => false,
                'inner_blocks' => false
            ],
            'defaults' => [
                'width' => ''
            ],
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
        $this->view_data = $data;

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

        return $fields;
    }

    /**
     * Render block.
     *
     * @return void
     */
    public function render_block($block, $content = '', $is_preview = false, $post_id = 0): void
    {
        $field_data = array();
        foreach ($this->get_fields() as $field) {
            $value = $field->get_value('acf');
            $field_data[$field->attribute()] = $value;

            foreach ($field->get_subfields() as $subfield) {
                if ($subfield instanceof Field) {
                    $value = $subfield->get_value('acf');
                    $field_data[$subfield->attribute()] = $value;
                }
            }
        }

        $classes = [
            'sp-block', $this->config->class
        ];

        if (!empty($block['className'])) $classes[] = $block['className'];
        if (!empty($block['align'])) $classes[] = 'align' . $block['align'];
        if (!empty($block['align_text'])) $classes[] = 'has-text-align-' . $block['align_text'];

        $id = isset($block['id']) ? ' id="' . $block['id'] . '"' : "";
        $class = count($classes) ? ' class="' . implode(" ", $classes) . '"' : "";
        $block_open = "<div{$class}{$id}>";

        $data = $this->get_data(array_merge([
            'post_id' => $post_id,
            'block' => $this,
            'block_class' => '',
            'classes' => '',
            'block_start' => $block_open,
            'block_end' => "</div>"
        ], $field_data), $post_id);

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
        $field_data = array();
        foreach ($this->get_fields() as $field) {
            $value = $field->get_value('shortcode', $args);
            $field_data[$field->attribute()] = $value;

            foreach ($field->get_subfields() as $subkey => $subfield) {
                if ($subfield instanceof Field) {
                    $value = $subfield->get_value('shortcode', $args);
                    $field_data[$subfield->attribute()] = $value;
                }
            }
        }

        $classes = [
            'sp-block', 'sp-shortcode', $this->config->class
        ];

        $id = isset($block['id']) ? ' id="' . $block['id'] . '"' : "";
        $class = count($classes) ? ' class="' . implode(" ", $classes) . '"' : "";
        $block_open = "<div{$class}{$id}>";

        $data = $this->get_data(array_merge([
            'post_id' => get_the_ID(),
            'block' => $this,
            'block_class' => '',
            'classes' => '',
            'block_start' => $block_open,
            'block_end' => "</div>"
        ], $field_data, ['slot' => !empty($slot) ? $slot : $field_data['slot'] ?? '']), get_the_ID());

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

            $view = $blade->make('block-404', $data)->render();
        }

        return (isset($data['block_start']) ? $data['block_start'] : '') . $view . (isset($data['block_end']) ? $data['block_end'] : '');
    }

    /**
     * Returns class elements.
     *
     * @param array $fields
     * @param array $additonal_classes
     * @return void
     */
    public function get_classes(array $classes): string
    {
        $return = array();

        foreach ($classes as $class) {
            if (substr($class, 0, 6) == 'field:') {
                $field = str_replace('field:', '', $class);

                if (isset($this->view_data[$field])) {
                    $return[] = $this->view_data[$field];
                }
            } else {
                $return[] = $class;
            }
        }

        return implode(" ", array_filter($return));
    }

    /**
     * Returns style elements.
     *
     * @param array $fields
     * @param array $additonal_classes
     * @return void
     */
    public function get_styles(array $fields, array $additonal_styles = []): string
    {
        $styles = array();

        foreach ($fields as $field => $style) {
            if (isset($this->view_data[$field])) {
                $styles[] = sprintf($style, $this->view_data[$field]);
            }
        }

        return implode(" ", array_filter(array_merge($styles, $additonal_styles)));
    }

    public function get_image_url($image_id, $size = 'full')
    {
        return wp_get_attachment_image_src($image_id, $size)[0] ?? '';
    }
}
