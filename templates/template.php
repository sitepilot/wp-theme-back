<?php

use Sitepilot\Theme\Template;

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$page = get_post(Template::get_template_id());
?>

<div class="<?php echo apply_filters('sp_theme_template_class', 'entry-content') ?>">
    <?php echo apply_filters('the_content', $page->post_content); ?>
</div>

<?php
get_footer();
