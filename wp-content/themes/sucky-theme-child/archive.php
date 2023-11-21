<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package This_Theme_Sucks
 */

get_header();
?>
	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : 
				
				switch(get_post_type()) {
					case 'video_game_reviews':
						sucky_custom_archive_hero('vgr_hero_styles');
						break;
					case 'tv-show-reviews':
						sucky_custom_archive_hero('tvs_hero_styles');
						break;
					case 'book-reviews':
						sucky_custom_archive_hero('br_hero_styles');
						break;
					default:
						return;
						break;
				}
		?>

		<div class="container-fluid bg-white">
			<div class="container">
						<div class="grid mt-n5 mb-5 position-relative z-1" style="--bs-gap: .25rem 1rem;">

							<?php
							/* Start the Loop */
							while ( have_posts() ) :
								the_post(); ?>
					<?php 
									/*
										* Include the Post-Type-specific template for the content.
										* If you want to override this in a child theme, then include a file
										* called content-___.php (where ___ is the Post Type name) and that will be used instead.
										*/
									// get_template_part( 'template-parts/content', get_post_type() );
									// get_template_part('template-parts/loop-posts/loop', get_post_type());
									get_template_part('template-parts/content', 'custom-post-loop');

								endwhile; ?>

							<?php the_posts_navigation();

						else :

							get_template_part( 'template-parts/content', 'none' );

						endif;
						?>
				</div>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();
