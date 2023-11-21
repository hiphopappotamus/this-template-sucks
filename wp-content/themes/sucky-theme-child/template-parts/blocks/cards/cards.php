<?php
$card_type = get_sub_field('card_type');
$amount_of_columns = get_sub_field('amount_of_columns');


$g_col_classes = 'position-relative g-col-12';
/**
 * (amount of columns / 12)
 * g-col-12 g-col-md-6
 * g-col-12 g-col-md-6 g-col-lg-4
 * g-col-12 g-col-md-6 g-col-lg-3
 */

$num = intval($amount_of_columns['value']);
switch(true) {
  case (12 / $num === 2):
    $g_col_classes .= ' g-col-md-' . $num;
    break;
  case (12 / $num === 4):
  case (12 / $num === 3):
    $g_col_classes .= ' g-col-md-6 g-col-lg-' . $num;
    break;
  default:
    return;
    break;
}

?>
<div class="grid">
  <?php 
    if(have_rows('cards_repeater')): 
    while(have_rows('cards_repeater')): the_row(); 

    $include_link = get_sub_field('include_link');
    $contains_spoilers = get_sub_field('contains_spoilers');
    $card_link = get_sub_field('card_link');
    $img_text_group = get_sub_field('img_text_group');
    $txt_solid_group = get_sub_field('txt_solid_group');
    
    $color_group = $txt_solid_group['color_group'];

    $color_blank_arr = array();
    $color_group_arr = array(
     'bg'  =>  'background',
     'txt' =>  'text_color',
     'bg_hov'  =>  'background_hover',
     'txt_hov'  =>  'text_color_hover',
    );
    foreach($color_group_arr as $value => $label) {
      $color_blank_arr[$value] = $color_group[$label];
    }

    if($card_link) {
      $title = esc_attr($card_link['title']);
      $displayed_title = esc_html($card_link['title']);
      $url = esc_url($card_link['url']);
      $target = $card_link['target'] ? $card_link['target'] : '_self';
    }

    $spollers_text = __('Spoilers ahead!', 'sucky-theme-child');
    
    $position = $card_type['value'] === 'full_card' ? 'end' : 'center';

    $spoilers_pos = '
        <div class="position-absolute d-flex card__spoilers w-100 moveUpDown justify-content-' . $position . ' align-items-center start-0">
          <span class="card__spoilers--txt small shadow p-2 position-relative text-bg-spoilers">
            ' . $spollers_text . '
          </span>
        </div>
      ';
    
  ?>
   <div class="<?php echo $g_col_classes; ?>">
    <div
      <?php if($card_type['value'] != 'full_card') { 
          echo 'data-color="' . $color_blank_arr['txt'] . '"';
          echo 'data-hover-color="' . $color_blank_arr['txt_hov'] . '"';
        }
      ?> 
      class="card rounded-0 border-0 shadow shadow-hover-lg position-relative<?php if($card_type['value'] != 'full_card') {echo ' p-4 text-center'; } ?>"
      <?php if($card_type['value'] != 'full_card') {
        echo 'style="background: ' . $color_blank_arr['bg'] . '; color: '. $color_blank_arr['txt'] .'"';
        echo 'data-hover-bg="' . $color_blank_arr['bg_hov'] . '"';
        echo 'data-initial-bg="' . $color_blank_arr['bg'] . '"';
      } ?>
    >

      <?php if($contains_spoilers && $card_type['value'] != 'full_card') { 
          echo $spoilers_pos;
        }
      ?>

      <?php if($card_type['value'] === 'full_card') { ?>
      <!-- full card -->
        <figure class="card__imgTop">
          <img 
            src="<?php echo esc_url($img_text_group['img']['url']); ?>" 
            alt="<?php echo esc_attr($img_text_group['img']['alt']); ?>" 
            class="card-img-top rounded-0 card__imgTop--img"
          />
        </figure>

          <?php if($contains_spoilers && $card_type['value'] === 'full_card') { 
            echo $spoilers_pos;
          } 
        ?>
        <div class="card-text p-4 position-relative">
          <?php if($include_link) { ?>
            <h5 class="card-title h3">
              <?php echo $displayed_title; ?>
            </h5>
          <?php } ?>
          <?php echo $img_text_group['text']; ?>
        </div>
        <!-- end full card -->
      <?php } ?>
      
      <?php if($card_type['value'] != 'full_card') { 
        echo '<h5 class="h3">' . $displayed_title . '</h5>';
      } ?>
      <?php if($include_link) {?>
        <a 
          href="<?php echo $url; ?>" 
          target="<?php echo $target; ?>"
          title="<?php echo $title; ?>"
          class="stretched-link"
        ></a>
      <?php }?>

    </div><!-- .card -->
   </div>
  <?php endwhile; endif; ?>
</div>