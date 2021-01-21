<?php

namespace Sitepilot\Theme\Traits;

use Sitepilot\Theme\Block;
use Sitepilot\Theme\Fields\Post;
use Sitepilot\Theme\Fields\Text;
use Sitepilot\Theme\Fields\Color;
use Sitepilot\Theme\Fields\Group;
use Sitepilot\Theme\Fields\Image;
use Sitepilot\Theme\Fields\Editor;
use Sitepilot\Theme\Fields\Number;
use Sitepilot\Theme\Fields\Select;
use Sitepilot\Theme\Fields\Repeater;
use Sitepilot\Theme\Fields\Taxonomy;
use Sitepilot\Theme\Fields\Textarea;
use Sitepilot\Theme\Fields\GoogleMap;
use Sitepilot\Theme\Fields\Preset\YesNo;
use Sitepilot\Theme\Fields\Style\Padding;
use Sitepilot\Theme\Fields\Style\Rounded;
use Sitepilot\Theme\Fields\Style\FontSize;
use Sitepilot\Theme\Fields\Style\MaxWidth;
use Sitepilot\Theme\Fields\Style\PaddingX;
use Sitepilot\Theme\Fields\Style\PaddingY;
use Sitepilot\Theme\Fields\Style\BoxShadow;
use Sitepilot\Theme\Fields\Style\MarginTop;
use Sitepilot\Theme\Fields\Style\TextColor;
use Sitepilot\Theme\Fields\Style\PaddingTop;
use Sitepilot\Theme\Fields\Style\MarginBottom;
use Sitepilot\Theme\Fields\Style\PaddingBottom;
use Sitepilot\Theme\Fields\Style\BackgroundColor;

trait HasFields
{
    public function fields(): array
    {
        return [];
    }

    public function field_namespace()
    {
        if ($this instanceof Block) {
            return $this->config->id;
        } else {
            return 'theme';
        }
    }

    static public function get_field($key, $post_id = null, $default = null)
    {
        $value = null;

        if (function_exists('get_field')) {
            $value = get_field($key, $post_id);
        }

        return $value ? $value : $default;
    }

    public function field_image($name, $attribute)
    {
        return Image::make($name, $attribute, $this->field_namespace());
    }

    public function field_text($name, $attribute)
    {
        return Text::make($name, $attribute, $this->field_namespace());
    }

    public function field_textarea($name, $attribute)
    {
        return Textarea::make($name, $attribute, $this->field_namespace());
    }

    public function field_number($name, $attribute)
    {
        return Number::make($name, $attribute, $this->field_namespace());
    }

    public function field_editor($name, $attribute)
    {
        return Editor::make($name, $attribute, $this->field_namespace());
    }

    public function field_repeater($name, $attribute)
    {
        return Repeater::make($name, $attribute, $this->field_namespace());
    }

    public function field_post($name, $attribute)
    {
        return Post::make($name, $attribute, $this->field_namespace());
    }

    public function field_taxonomy($name, $attribute)
    {
        return Taxonomy::make($name, $attribute, $this->field_namespace());
    }

    public function field_google_map($name, $attribute)
    {
        return GoogleMap::make($name, $attribute, $this->field_namespace());
    }

    public function field_select($name, $attribute)
    {
        return Select::make($name, $attribute, $this->field_namespace());
    }

    public function field_color($name, $attribute)
    {
        return Color::make($name, $attribute, $this->field_namespace());
    }

    public function field_group($name, $attribute)
    {
        return Group::make($name, $attribute, $this->field_namespace());
    }

    public function field_style_max_width($name, $attribute)
    {
        return MaxWidth::make($name, $attribute, $this->field_namespace());
    }

    public function field_style_text_color($name, $attribute)
    {
        return TextColor::make($name, $attribute, $this->field_namespace());
    }

    public function field_style_bg_color($name, $attribute)
    {
        return BackgroundColor::make($name, $attribute, $this->field_namespace());
    }

    public function field_style_margin_top($name, $attribute)
    {
        return MarginTop::make($name, $attribute, $this->field_namespace());
    }

    public function field_style_margin_bottom($name, $attribute)
    {
        return MarginBottom::make($name, $attribute, $this->field_namespace());
    }

    public function field_style_padding($name, $attribute)
    {
        return Padding::make($name, $attribute, $this->field_namespace());
    }

    public function field_style_padding_x($name, $attribute)
    {
        return PaddingX::make($name, $attribute, $this->field_namespace());
    }

    public function field_style_padding_y($name, $attribute)
    {
        return PaddingY::make($name, $attribute, $this->field_namespace());
    }

    public function field_style_padding_bottom($name, $attribute)
    {
        return PaddingBottom::make($name, $attribute, $this->field_namespace());
    }

    public function field_style_padding_top($name, $attribute)
    {
        return PaddingTop::make($name, $attribute, $this->field_namespace());
    }

    public function field_style_rounded($name, $attribute)
    {
        return Rounded::make($name, $attribute, $this->field_namespace());
    }

    public function field_style_box_shadow($name, $attribute)
    {
        return BoxShadow::make($name, $attribute, $this->field_namespace());
    }

    public function field_style_font_size($name, $attribute)
    {
        return FontSize::make($name, $attribute, $this->field_namespace());
    }

    public function field_preset_yes_no($name, $attribute)
    {
        return YesNo::make($name, $attribute, $this->field_namespace());
    }
}
