<?php

namespace Sitepilot\Theme\Traits;

use Sitepilot\Theme\Block;
use Sitepilot\Theme\Fields\Post;
use Sitepilot\Theme\Fields\Text;
use Sitepilot\Theme\Fields\Image;
use Sitepilot\Theme\Fields\Editor;
use Sitepilot\Theme\Fields\Number;
use Sitepilot\Theme\Fields\Select;
use Sitepilot\Theme\Fields\Repeater;
use Sitepilot\Theme\Fields\Taxonomy;
use Sitepilot\Theme\Fields\Textarea;
use Sitepilot\Theme\Fields\GoogleMap;
use Sitepilot\Theme\Fields\BlockMargin;

trait HasFields
{
    public function fields(): array
    {
        return [];
    }

    public function field_namespace()
    {
        if ($this instanceof Block) {
            return $this->id;
        } else {
            return 'theme';
        }
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

    public function field_block_margin($name, $attribute)
    {
        return BlockMargin::make($name, $attribute, $this->field_namespace());
    }
}
