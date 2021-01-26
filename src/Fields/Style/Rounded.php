<?php

namespace Sitepilot\Theme\Fields\Style;

use Sitepilot\Theme\Fields\Dimension;

class Rounded extends Dimension
{
    public function __construct(...$arguments)
    {
        parent::__construct(...$arguments);

        $this->fields([
            'tl' => __('T. Left', 'sp-theme'),
            'tr' => __('T. Right', 'sp-theme'),
            'bl' => __('B. Left', 'sp-theme'),
            'br' => __('B. Right', 'sp-theme')
        ]);

        $this->options([
            'default' => '',
            'none' => __('none', 'sp-theme'),
            'xs' => __('xs', 'sp-theme'),
            'sm' => __('sm', 'sp-theme'),
            'md' => __('md', 'sp-theme'),
            'lg' => __('lg', 'sp-theme'),
            'xl' => __('xl', 'sp-theme'),
            'full' => __('full', 'sp-theme')
        ]);

        $this->default_select('default');
    }

    protected function value($value)
    {
        $tl = [
            'none' => 'rounded-tl-none',
            'xs' => 'rounded-tl-xs',
            'sm' => 'rounded-tl-sm',
            'md' => 'rounded-tl-md',
            'lg' => 'rounded-tl-lg',
            'xl' => 'rounded-tl-xl',
            'full' => 'rounded-tl-full'
        ];

        $tr = [
            'none' => 'rounded-tr-none',
            'xs' => 'rounded-tr-xs',
            'sm' => 'rounded-tr-sm',
            'md' => 'rounded-tr-md',
            'lg' => 'rounded-tr-lg',
            'xl' => 'rounded-tr-xl',
            'full' => 'rounded-tr-full'
        ];

        $bl = [
            'none' => 'rounded-bl-none',
            'xs' => 'rounded-bl-xs',
            'sm' => 'rounded-bl-sm',
            'md' => 'rounded-bl-md',
            'lg' => 'rounded-bl-lg',
            'xl' => 'rounded-bl-xl',
            'full' => 'rounded-bl-full'
        ];

        $br = [
            'none' => 'rounded-br-none',
            'xs' => 'rounded-br-xs',
            'sm' => 'rounded-br-sm',
            'md' => 'rounded-br-md',
            'lg' => 'rounded-br-lg',
            'xl' => 'rounded-br-xl',
            'full' => 'rounded-br-full'
        ];

        $classes = [
            $this->get_class('tl', $tl, $value),
            $this->get_class('tr', $tr, $value),
            $this->get_class('bl', $bl, $value),
            $this->get_class('br', $br, $value)
        ];

        return implode(" ", array_filter($classes));
    }
}
