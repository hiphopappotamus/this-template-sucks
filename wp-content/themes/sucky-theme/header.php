<!doctype html>
<html <?php language_attributes(); ?>>

<head>
 <meta charset="<?php bloginfo('charset'); ?>">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="profile" href="https://gmpg.org/xfn/11">

 <?php wp_head(); ?>


 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

 <?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package This_Theme_Sucks
 */


// Bootstrap menu logic

/**
 * Offcanvas menu TODO =======
 * 
 * position options:
 *   1) top (default) [*]
 *   2) right (end) [*]
 *   3) bottom [*]
 *   4) left (start) [*]
 *   
 *   classes for position:
 *      .offcanvas-start
        .offcanvas-end 
        .offcanvas-bottom
 * 
 * body-scrolling options:
 *   1) enable
 *      a. enabled with backdrop
 *   2) static
 * 
 * appearance options:
 *   1) light (default)
 *   2) dark
 * 
 * utility options:
 *   - responsive (only show offcanvas on mobile screens)
 *      classes: 
          .offcanvas
          .offcanvas-sm
          .offcanvas-md
          .offcanvas-lg
          .offcanvas-xl
          .offcanvas-xxl
 */

// TODO: set up general Theme Options to control theme main logo, post placeholder images, and favicon (might leave that one to native customizer)?

// TODO: sticky nav option if not offcanvas? (don't use position: fixed, use position: sticky so content doesn't get covered up as use scrolls. Figure out how to minify and simplify on scroll as well, to help save real estate)

// TODO: nav position: left, start, end

$nav_type = get_field('nav_type', 'option');
$offcanvas_options_group = get_field('offcanvas_options_group', 'option');

$nav_customize_colors = get_field('nav_customize_colors', 'option');

$offcanvas_options_group = get_field('offcanvas_options_group', 'option'); // group
$offcanvas_responsive_activate = $offcanvas_options_group['offcanvas_responsive_activate'];
$offcanvas_breakpoints = $offcanvas_options_group['offcanvas_breakpoints'];

if($nav_customize_colors):
        include(get_template_directory() . '/template-parts/theme-options/nav-custom-styles.php');
endif;

$sticky_nav = get_field('sticky_nav', 'option');


?>

<style>
    <?php 
    if($sticky_nav) { ?>
    #page.site {
        position: relative;
    }
    header#masthead.site-header {
        position: sticky;
        z-index: 9;
        top: 0;
    }
  <?php } ?>
 </style>

</head>

<body <?php body_class('my-0'); ?>>
 <?php wp_body_open(); ?>
 <div id="page" class="site">
  <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'sucky-theme'); ?></a>

  <header id="masthead" class="site-header">
   <?php
      if ($nav_type['value'] === 'offcanvas') { ?>

   <?php include(get_template_directory() . '/template-parts/theme-options/offcanvas-nav.php'); ?>

   <?php } else { ?>

        <nav class="navbar navbar-expand-md">
            <?php include(get_template_directory() . '/template-parts/theme-options/default-nav.php'); ?>
        </nav>

   <?php } ?>


  </header><!-- #masthead -->