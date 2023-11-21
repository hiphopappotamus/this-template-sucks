<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package This_Theme_Sucks
 */

$footer_alignment = get_field('footer_alignment', 'option');
$footer_add_links = get_field('footer_add_links', 'option');


include(get_template_directory() . '/template-parts/theme-options/footer-custom-styles.php');
?>

<footer id="colophon" class="site-footer my-0 py-0">
 <div class="site-info container d-flex pt-3 justify-content-<?php echo $footer_alignment['value']; ?>">
  <p class="footer-info">
   &copy; <?php echo date('Y'); ?> <?php echo bloginfo('name'); ?>
  </p>
  <?php
   if($footer_add_links) {
    echo '<span class="footer-links-divide mx-3">|</span>';
    include(get_template_directory() . '/template-parts/theme-options/footer-menu.php');
   }
  ?>
 </div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>

</html>