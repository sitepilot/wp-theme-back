<?php

namespace Sitepilot\Theme;

abstract class Module
{
    /**
     * The theme instance.
     *
     * @var Base $theme
     */
    protected $theme;

    /**
     * Construct the module.
     *
     * @param Base $theme
     */
    public function __construct(Base $theme)
    {
        $this->theme = $theme;
    }
}
