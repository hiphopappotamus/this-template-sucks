<?php
/**
 * Custom theme settings
 * 
 * @package This_Theme_Sucks
 * 
 * TODO: custom menu items order
 */

if(!function_exists('custom_theme_excerpt_length')):
 function custom_theme_excerpt_length($length) {
  return 10;
 }
endif;
add_filter('excerpt_length', 'custom_theme_excerpt_length');