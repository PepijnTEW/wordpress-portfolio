<?php

function ptw_dev_setup() {
    add_theme_support( 'post-thumbnails' );
}

function ptw_enqueue_styles() {
    wp_enqueue_style('ptw-style', get_stylesheet_uri());
}

function ptw_enqueue_scripts(){
    wp_enqueue_script(
        'ptw-theme-script',
        get_template_directory_uri() . '/assets/js/theme.js',
        array(),
        '1.0',
        true
    );

    $theme_translations = array(
        'theme' => __('THEME', 'ptw-dev'),
        'light' => __('LIGHT', 'ptw-dev'),
        'dark'  => __('DARK', 'ptw-dev'),
        'auto'  => __('AUTO', 'ptw-dev'),
    );

    wp_localize_script('ptw-theme-script', 'ptwThemeData', $theme_translations);
}

function ptw_dev_load_textdomain() {
    load_theme_textdomain('ptw-dev', get_template_directory());
}

add_action( 'after_setup_theme', 'ptw_dev_setup' );
add_action('after_setup_theme', 'ptw_dev_load_textdomain');
add_action('wp_enqueue_scripts', 'ptw_enqueue_styles');
add_action('wp_enqueue_scripts', 'ptw_enqueue_scripts');
add_filter('show_admin_bar', '__return_false');
