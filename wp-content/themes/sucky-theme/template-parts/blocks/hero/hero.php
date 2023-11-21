<?php
$hero_text_alignment = get_sub_field('hero_text_alignment');
$hero_text_responsive_align = get_sub_field('hero_text_responsive_align'); // true/false
$hero_include_subhead = get_sub_field('hero_include_subhead'); // true/false
$hero_subhead = get_sub_field('hero_subhead');

$hero_mobile_text_alignments = get_sub_field('hero_mobile_text_alignments'); // group
$hero_mobile_text_alignment = $hero_mobile_text_alignments['hero_mobile_text_alignment'];
$hero_mobile_text_breakpoints = $hero_mobile_text_alignments['hero_mobile_text_breakpoints']; // select
$hero_new_text_alignment = $hero_mobile_text_alignments['hero_new_text_alignment'];

$hero_mobile_classes = '';
if($hero_text_responsive_align) {
   $hero_mobile_classes .= 'text-' . $hero_mobile_text_alignment['value'] . ' text-' . $hero_mobile_text_breakpoints['value'] . '-' . $hero_new_text_alignment['value'] . '';
} else {
   $hero_mobile_classes .= 'text-' . $hero_text_alignment['value'] . '';
}

   the_title('<h1 class="entry-title display-1 ' . $hero_mobile_classes . '">', '</h1>');

   if($hero_include_subhead):
   echo '<p class="lead ' . $hero_mobile_classes . '">'. $hero_subhead . '</p>';
   endif;

