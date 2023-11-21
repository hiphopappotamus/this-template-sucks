<?php
/**
 * Enqueue scripts and styles for child theme
 */

 wp_enqueue_script('jquery');


$js_dir = '/js';
$js_files = array(
 '/bootstrap.bundle.min.js',
 '/minified/custom.min.js'
);

function jquery_ui_enqueue_scripts() {
 wp_enqueue_script('jquery-ui-js', get_stylesheet_directory_uri() . '/js/jquery-ui.min.js', array(), '1.0');
 wp_add_inline_script('jquery-ui', json_encode('jquery-ui'), 'before');
}
add_action('wp_enqueue_scripts', 'jquery_ui_enqueue_scripts');

foreach($js_files as $file) {
 wp_enqueue_script(str_replace(['/', '.', 'js'], '', $file), get_stylesheet_directory_uri() . $js_dir . $file, null, null, true);
}

function sucky_theme_child_styles() {
 wp_enqueue_style('sucky-theme-child-main', get_stylesheet_directory_uri() . '/css/main.css', array());
}
add_action('wp_enqueue_scripts', 'sucky_theme_child_styles');