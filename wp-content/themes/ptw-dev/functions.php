<?php
function ptw_enqueue_styles() {
    wp_enqueue_style('ptw-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'ptw_enqueue_styles');
add_filter('show_admin_bar', '__return_false');
