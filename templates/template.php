<?php

use Sitepilot\Theme\Theme;

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$page = get_post(Theme::get_template_post_id());

echo apply_filters('the_content', $page->post_content);

get_footer();
