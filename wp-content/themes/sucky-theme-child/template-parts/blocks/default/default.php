<?php

/**
 * ACF Flexible Content Block Template
 * https://www.advancedcustomfields.com/resources/blocks/
 * @package This_Theme_Sucks
 *
 */

if (have_rows('sections')) : while (have_rows('sections')) : the_row();

    if (have_rows('options')) {
      while (have_rows('options')) {
        the_row();

        $layout_title = get_sub_field('layout_title');
        $section_id = get_sub_field('section_id');
        $section_class = get_sub_field('section_class');
        $section_background_image = get_sub_field('section_background_image');
        $section_background_color = get_sub_field('section_background_color');
        $section_text_color = get_sub_field('section_text_color');
        $enable_background_parallax = get_sub_field('enable_background_parallax');
        $background_scroll_speed = get_sub_field('background_scroll_speed');
        $include_gradient_overlay = get_sub_field('include_gradient_overlay');
        $main_gradient_color = get_sub_field('main_gradient_color');
        $mix_blend_mode = get_sub_field('mix_blend_mode');

        $adjust_outer_content_width = get_sub_field('adjust_outer_content_width'); // true/false
        $adjust_inner_content_width = get_sub_field('adjust_inner_content_width'); // true/false
        $section_width = get_sub_field('section_width'); // select dropdown
        $section_inner_width = get_sub_field('section_inner_width'); // select dropdown

        $outer_container = $adjust_outer_content_width ? 'container-' . $section_width['value'] : 'container';
        $inner_container = $adjust_inner_content_width ? 'container-' . $section_inner_width['value'] : 'container';

        $inner_container_classes = get_sub_field('inner_container_classes');
        $disable_layout = get_sub_field('disable_layout');

        $div_logic = '';
        if ($section_id) {
          $div_logic .= 'id="' . $section_id . '"';
        }
        if ($section_class && !$enable_background_parallax) {
          $div_logic .= 'class="' . $section_class . ' ' . $outer_container . '"';
        }
        if ($section_class && $enable_background_parallax) {
          $div_logic .= 'class="bg-parallax ' . $section_class . ' ' . $outer_container . '"';
        }
        if ($enable_background_parallax) {
          $div_logic .= 'class="bg-parallax ' . $outer_container . '"';
        }

        $div_style = 'style="';
        if ($section_background_color) {
          $div_style .= 'background-color: ' . $section_background_color . ';';
        }
        if ($section_background_image) {
          $div_style .= 'background-image: url(' . $section_background_image . '); background-repeat: no-repeat; background-size: cover; background-position: center;';
        }
        if ($section_text_color) {
          $div_style .= 'color: ' . $section_text_color . ';';
        }
        $div_style .= '"';

        $inner_div_class = '';
        if ($inner_container_classes) {
          $inner_div_class .= $inner_container_classes;
        }
      }
    }

?>
<?php if(!$disable_layout): ?>
<section <?php echo $div_style . $div_logic; ?> <?php if ($enable_background_parallax) : echo 'data-scroll="' . $background_scroll_speed . '"';
                                                    endif; ?>>
  <?php if($include_gradient_overlay): ?>
  <div
    style="position: absolute; background: linear-gradient(<?php echo $main_gradient_color;?>, transparent); mix-blend-mode: <?php echo $mix_blend_mode['value'];?>; height: 100%; width: 100%; top: 0; right: 0; bottom: 0; left: 0;"
    class="z-0"
  ></div>
  <?php endif; ?>
 <div class="<?php if($include_gradient_overlay) {echo 'position-relative z-1 ';} echo $inner_container . ' ' . $inner_div_class; ?>">
  <?php
        switch (get_row_layout()) {
          // templates that live in the parent theme use get_template_directory()
          // if they need to be customized, copy their folders into the child theme
          // and use get_stylesheet_directory()
          case 'content':
            echo get_sub_field('content_editor');
            break;
          case 'carousel':
            include(get_template_directory() . '/template-parts/blocks/carousel/carousel.php');
            break;
          case 'hero':
            require_once get_stylesheet_directory() . '/template-parts/blocks/hero/hero.php'; // only use require_once for items that only need to be on the page ONCE 
            break;
          case 'cards':
            include(get_stylesheet_directory() . '/template-parts/blocks/cards/cards.php');
            break;
          default:
            return;
            break;
        }
        ?>
 </div>
</section>
<?php
endif;
  endwhile;
endif;