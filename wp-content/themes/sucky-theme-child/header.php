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

$nav_type = get_field('nav_type', 'option');
$offcanvas_options_group = get_field('offcanvas_options_group', 'option');

$nav_customize_colors = get_field('nav_customize_colors', 'option');

$offcanvas_options_group = get_field('offcanvas_options_group', 'option'); // group
$offcanvas_responsive_activate = $offcanvas_options_group['offcanvas_responsive_activate'];
$offcanvas_breakpoints = $offcanvas_options_group['offcanvas_breakpoints'];


?>

<!doctype html>
<html <?php language_attributes(); ?>>

<?php
global $post;
$sandbox_class = '';
$slug = $post->post_name;
if($slug === 'the-sandbox') {
  $sandbox_class .= 'sandbox';
}
?>

<head>
 <meta charset="<?php bloginfo('charset'); ?>">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="profile" href="https://gmpg.org/xfn/11">

 <?php wp_head(); ?>

 <?php if($nav_customize_colors):
        include(get_template_directory() . '/template-parts/theme-options/nav-custom-styles.php');
  
 endif;

    $sticky_nav = get_field('sticky_nav', 'option');

?>


 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cutive+Mono&family=Libre+Franklin:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Lisu+Bosa:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

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
<script src="https://kit.fontawesome.com/21c20b6f66.js" crossorigin="anonymous"></script>
</head>

<body <?php body_class($sandbox_class); ?>>
 <?php wp_body_open(); ?>
 <div id="page" class="site">
  <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'sucky-theme'); ?></a>

  <header id="masthead" class="site-header">
   <?php
      if ($nav_type['value'] === 'offcanvas') { ?>
    <div class="container d-flex justify-content-md-center">
       <?php require_once get_stylesheet_directory() . '/template-parts/theme-options/offcanvas-nav.php'; ?>
    </div>


   <?php } else { ?>

        <nav class="navbar navbar-expand-md">
              <div class="container d-flex justify-content-md-center">
                     <?php require_once get_stylesheet_directory() . '/template-parts/theme-options/default-nav.php'; ?>
              </div>
        </nav>

   <?php } ?>


  </header><!-- #masthead -->