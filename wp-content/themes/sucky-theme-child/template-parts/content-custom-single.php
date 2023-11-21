<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package This_Theme_Sucks
	* 
	* Leaving the sucky_theme_post_thumbnail() function call for reference
 */

 $add_spoilers_tag = get_field('add_spoilers_tag');
	$spoilers_class = $add_spoilers_tag ? 'spoiler-content' : '';

	$customize_text = get_field('customize_text'); //  true/false
	$custom_spoiler_text = get_field('custom_spoiler_text');
?>

<article 
<?php if($add_spoilers_tag && $customize_text) {
	echo 'data-warning="' . __('' . $custom_spoiler_text . '', 'sucky-theme-child') . '"';
} else {
	echo 'data-warning="' . __('Spoilers ahead!', 'sucky-theme-child') . '"';
} ?>
	id="post-<?php the_ID(); ?>" <?php post_class($spoilers_class); ?>
>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'sucky-theme' ),
				'after'  => '</div>',
			)
		);
?>
<div class="grid mb-3 mt-4">
	<div class="g-col-12">
		<div class="container position-relative">
			<?php
					the_post_navigation(
							array(
								'prev_text' => '<span class="nav-title">' . esc_html__( '◄', 'sucky-theme' ) . ' %title</span>',
								'next_text' => '<span class="nav-title">' . esc_html__( '►', 'sucky-theme' ) . ' %title</span>',
							)
						);

					?>
		</div>
	</div>
</div>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
