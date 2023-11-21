<?php

/**
 * Bootstrap slider block
 * https://getbootstrap.com/docs/5.2/components/carousel/#example
 *
 * // =================================================================================================================================== //
 *
 * Carousels don’t automatically normalize slide dimensions. As such, you may need to use additional utilities or custom styles to appropriately size content. While carousels support previous/next controls and indicators, they’re not explicitly required. Add and customize as you see fit.
 *
 * The .active class needs to be added to one of the slides otherwise the carousel will not be visible. Also be sure to set a unique id on the .carousel for optional controls, especially if you’re using multiple carousels on a single page. Control and indicator elements must have a data-bs-target attribute (or href for links) that matches the id of the .carousel element.
 *
 * // =================================================================================================================================== //
 *
 * 1) check  out data-attributes https://getbootstrap.com/docs/5.2/components/carousel/#via-data-attributes
 *
 * 2) use a wysiwyg block [*]
 *     - option to change bg color or add bg image similar to section options (but don't use those here!) [*]
 *
 * Options:
 *   - Slides only [*]
 *   - With controls [*]
 *   - With indicators [*]
 *       - with both controls and indicators [*]
 *   - With captions [*]
 *   - The Works:
 *      - with Controls, Indicators, and Captions [*]
 *   - Crossfade [*]
 *
 * Utilities:
 *   - Disable touch swiping [*]
 *   - Dark variant [*]
 */

// slides_only : Slides only 
// with_controls : With controls 
// with_indicators: With indicators 
// both_con_ind : With both controls and indicators 
// with_captions : With captions 
// the_works : The Works (controls, indicators, and captions) 

$carousel_group = get_sub_field('carousel_group'); // group

$carousel_id = get_sub_field('carousel_id');

$carousel_slides             = $carousel_group['carousel_slides'];
$carousel_options            = $carousel_group['carousel_options'];
$carousel_utilities          = $carousel_group['carousel_utilities'];
$carousel_crossfade          = $carousel_group['carousel_crossfade'];
$carousel_disable_touch_swiping = $carousel_group['carousel_disable_touch_swiping'];

$indicator_array = array(
  'both_con_ind',
  'the_works',
  'with_indicators',
);

$main_button_logic = '
  type="button"
  data-bs-target="#' . $carousel_id . ' "
';
?>

<div id="<?php echo $carousel_id; ?>" class="carousel slide 
  <?php if ($carousel_crossfade) :
    echo 'carousel-fade ';
  endif;
  if ($carousel_utilities['value'] === 'dark_variant') :
    echo 'carousel-dark';
  endif;
  ?>" <?php
      echo $carousel_disable_touch_swiping ? 'data-bs-touch="false"' : 'data-bs-ride="carousel"';
      ?>>

 <div class="carousel-inner">
  <?php if ($carousel_options['value'] != 'slides_only' && $carousel_options['value'] != 'with_controls') {?>
  
    <div class="carousel-indicators">
    <?php
        $h = 0;
        if (have_rows('carousel_group')) : while (have_rows('carousel_group')) : the_row();

            if (have_rows('carousel_slides')) : while (have_rows('carousel_slides')) : the_row();
                $h++;
        ?>

    <button <?php echo $main_button_logic; ?> data-bs-slide-to="<?php echo $h - 1; ?>" <?php if ($h === 1) : echo "class='active' aria-current='true'";
                                                                                                    endif; ?>
      aria-label="Slide <?php echo $h; ?>"></button>

    <?php endwhile;
            endif;

          endwhile;
        endif;
        ?>
    </div>
  <?php } ?>
  <?php
    $i = 0;
    if (have_rows('carousel_group')) : while (have_rows('carousel_group')) : the_row();

        if (have_rows('carousel_slides')) : while (have_rows('carousel_slides')) : the_row();

            $carousel_content           = get_sub_field('carousel_content');
            $carousel_background_type   = get_sub_field('carousel_background_type');
            $carousel_background_color  = get_sub_field('carousel_background_color');
            $carousel_background_image  = get_sub_field('carousel_background_image');

            $i++;

            $options_array = array(
              'with_controls',
              'both_con_ind',
              'the_works',
            );

            $captions_array = array(
              'with_captions',
              'the_works',
            );
    ?>
  <div class="carousel-item position-relative
                <?php if ($i === 1) :
                  echo " active";
                endif;
                ?>
              " <?php
                if ($carousel_background_type['value'] === 'background_color') :
                  echo "style='background-color: $carousel_background_color;'";
                elseif ($carousel_background_type['value'] === 'background_image') :
                  echo "style='background-image: url($carousel_background_image); background-repeat: no-repeat; background-size: cover; background-position: center center;'";
                endif;
                ?>>
   <div class="container carousel-item__inner mt-4">
    <div>
      <?php echo $carousel_content; ?>
    </div>
   </div>

   <?php
              foreach ($captions_array as $caption_option) :
                if ($carousel_options['value'] === $caption_option) :

                  if (have_rows('carousel_captions')) : while (have_rows('carousel_captions')) : the_row();

                      $slide_label = get_sub_field('slide_label');
                      $captions_label_custom_color = get_sub_field('captions_label_custom_color');
                      $slide_caption = get_sub_field('slide_caption');

                      $label_styles = '';
                      if ($captions_label_custom_color) {
                        $label_styles .= 'style="color: ' . $captions_label_custom_color . ';"';
                      }

                      echo
                      '<div class="carousel-caption d-none d-md-block">
                          <h5 class="carousel-caption__title" ' . $label_styles . '>' . $slide_label . '</h5>
                        <div class="carousel-caption__caption">'
                        . $slide_caption .
                        '</div></div>
                        ';
                    endwhile;
                  endif;
                endif;
              endforeach;
              ?>
  </div>

  <?php
          endwhile;
        endif;
      endwhile;
    endif;
    ?>
 </div>

 <?php
  foreach ($options_array as $option) :
    if ($carousel_options['value'] === $option) :
  ?>
 <button class="carousel-control-prev" <?php echo $main_button_logic; ?> data-bs-slide="prev">
  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
  <span class="visually-hidden">Previous</span>
 </button>
 <button class="carousel-control-next" <?php echo $main_button_logic; ?> data-bs-slide="next">
  <span class="carousel-control-next-icon" aria-hidden="true"></span>
  <span class="visually-hidden">Next</span>
 </button>
 <?php endif;
  endforeach; ?>

</div>