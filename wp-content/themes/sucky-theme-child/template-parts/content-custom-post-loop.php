<?php
 $vgr_category_tag_color = get_field('vgr_category_tag_color', 'option');
 $vgr_category_tag_font_color = get_field('vgr_category_tag_font_color', 'option');

 $tvs_category_tag_color = get_field('tvs_category_tag_color', 'option');
 $tvs_category_tag_font_color = get_field('tvs_category_tag_font_color', 'option');

 $br_category_tag_color = get_field('br_category_tag_color', 'option');
 $br_category_tag_font_color = get_field('br_category_tag_font_color', 'option');

 $cat_tag_bg = '';
 $cat_tag_color = '';

 switch(get_post_type()) {
  case 'video_game_reviews':
   $cat_tag_bg = $vgr_category_tag_color;
   $cat_tag_color = $vgr_category_tag_font_color;
   break;
  case 'tv-show-reviews':
   $cat_tag_bg = $tvs_category_tag_color;
   $cat_tag_color = $tvs_category_tag_font_color;
   break;
  case 'book-reviews':
   $cat_tag_bg = $br_category_tag_color;
   $cat_tag_color = $br_category_tag_font_color;
   break;
  default:
   return;
   break;
 }

  $add_spoilers_tag = get_field('add_spoilers_tag');
  $spollers_text = __('Spoilers ahead!', 'sucky-theme-child');

  $spoilers_div = '
      <div class="position-absolute d-flex card__spoilers w-100 moveUpDown justify-content-end align-items-center start-0">
        <span class="card__spoilers--txt small shadow p-2 position-relative text-bg-spoilers">
          ' . $spollers_text . '
        </span>
      </div>
    ';

?>
<div class="g-col-12 g-col-md-6 g-col-lg-4">
 <div class="card rounded-0 border-0 shadow shadow-hover-lg position-relative">
  <img src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" alt="" class="card-img-top rounded-0">
    <?php
     if($add_spoilers_tag) {
      echo $spoilers_div;
    } ?>
  <div class="card-body position-relative">
   <h5 class="card-title mt-3"><?php the_title(); ?></h5>
   <p class="card-text"><?php the_excerpt(); ?></p>
  </div>
  <div class="card-footer bg-none border-none p-0">
    <span
      style="background-color: <?php echo $cat_tag_bg;?>; color: <?php echo $cat_tag_color; ?>;" 
      class="card__cat d-block text-center p-2 w-100 small text-uppercase"
      >
      <?php echo strip_tags(get_the_category_list(', ')); ?>
    </span>
  </div>
  <a href="<?php the_permalink(); ?>" class="stretched-link" title="<?php the_title(); ?>"></a>
 </div>
</div>