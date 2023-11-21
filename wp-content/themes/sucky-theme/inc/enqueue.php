<?php

/**
 * Enqueue scripts and styles.
 */
// exit if accessed directly
defined('ABSPATH') || exit;
function sucky_theme_scripts()
{

  wp_enqueue_script('jquery');

  // custom javascript array
  $js_dir = '/js';
  $js_files = array(
    '/bootstrap.bundle.min.js',
    '/minified/custom.min.js',
  );

  foreach ($js_files as $file) {
    wp_enqueue_script(str_replace(['/', '.', 'js'], '', $file), get_template_directory_uri() . $js_dir . $file, null, null, true);
  }

  wp_register_style('FontAwesome', 'https://use.fontawesome.com/releases/v5.15.3/css/all.css');
  wp_enqueue_style('FontAwesome');

  wp_enqueue_style('sucky-theme-style', get_stylesheet_uri(), array(), _S_VERSION);

  wp_enqueue_style('sucky-theme-mainstyle', get_template_directory_uri() . '/css/main.css', array());
  
  wp_enqueue_style('sucky-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array());

  wp_style_add_data('sucky-theme-style', 'rtl', 'replace');

  wp_enqueue_script('sucky-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

  if (is_singular() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }
}
add_action('wp_enqueue_scripts', 'sucky_theme_scripts');