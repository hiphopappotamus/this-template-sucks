<?php
/**
 * Custom hooks
 *
 * @package This_Theme_Sucks
 */

// exit if accessed directly
defined('ABSPATH') || exit;

if (!function_exists('sucky_theme_site_info')):
  /**
   * add site info hook to WP hook library
   *
   */
  function sucky_theme_site_info() {
    do_action('sucky_theme_site_info');
  }
endif;
add_action('sucky_theme_add_site_info', 'sucky_theme_site_info');

if(!function_exists('sucky_theme_add_site_info')):
  $the_theme = wp_get_theme();

  $site_info = sprintf(
    '<a href="%1$s">%2$s</a><span class="sep"> | </span>%3$s(%4$s)', esc_url( __( 'http://wordpress.org', 'sucky-theme' ) ),
      sprintf(
        /* translators: Wordpress */
        esc_html__( 'Happily cooked up by %s', 'sucky-theme' ), 'WordPress'
      ),
      sprintf( // WPCS: XSS ok.
        /* translators: 1: Theme name, 2: theme author */
        esc_html( 'Theme: %1$s by %2$s.', 'sucky-theme' ),
        $the_theme->get( 'Name' ),
        '<a href="' . esc_url( __( 'https://underscores.me', 'sucky-theme' ) ) . '">Made from an Underscores Starter Theme.</a>'
      ),
      sprintf( // WPCS: XSS ok.
        /* translators: Theme version */
        esc_html__( 'Version: %1$s', 'sucky-theme' ),
        $the_theme->get( 'Version' )
      )
    );
    echo apply_filters( 'sucky_theme_site_info_content', $site_info ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
endif;
