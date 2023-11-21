<?php
$footer_custom_colors = get_field('footer_custom_colors', 'option'); // group

$footer_background_color = $footer_custom_colors['footer_background_color'];
$footer_text_color = $footer_custom_colors['footer_text_color'];
$footer_link_colors = $footer_custom_colors['footer_link_colors']; // group

$footer_linkcolor_main = $footer_link_colors['footer_linkcolor_main'];
$footer_linkcolor_hover = $footer_link_colors['footer_linkcolor_hover'];
?>

<style>
 .site-footer {
  background-color: <?php echo $footer_background_color; ?>;
 }
 .site-footer p,
 .footer-info,
 .footer-links-divide {
  color: <?php echo $footer_text_color; ?>;
 }
 .site-footer a {
  transition: color .32s ease-in-out;
  color: <?php echo $footer_linkcolor_main;?>;
  font-weight: 700;
 }
 .site-footer a:hover {
  color: <?php echo $footer_linkcolor_hover; ?>;
 }
</style>