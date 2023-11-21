<?php
/**
 * This Theme Sucks Child Functions
 */
$sucky_theme_child_directory = '/inc';
$sucky_theme_child_includes = array(
 '/enqueue.php',
 '/custom-functions.php',
);

foreach($sucky_theme_child_includes as $file) {
 require_once get_stylesheet_directory() . $sucky_theme_child_directory . $file;
}