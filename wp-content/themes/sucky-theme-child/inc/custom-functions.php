<?php
/**
	* @var $output		Output the jQuery Widget Bridge script tags needed to prevent jQuery UI and Bootstrap from butting heads
	* from https://www.ryadel.com/en/using-jquery-ui-bootstrap-togheter-web-page/
 */
function load_widget_bridge() {
	$output = '
	<script>
			(function($){
				$.widget.bridge("uitooltip", $.ui.tooltip);
				$.widget.bridge("uibutton", $.ui.button);
			})(jQuery);
	</script>';

	echo $output;
}
add_action('wp_footer', 'load_widget_bridge', 10); // even though 10 is default, explicit statement of manual priority will cause WP Core to run its stuff first

	/**
		* @param string $str  Snake case name of post, as generated in the CPT UI plugin or custom post type function.
		* use this with a switch statement that checks for a post type and calls the specific acf field associated with the hero styles (see archive.php for an example)
	 */
function sucky_custom_archive_hero($str = 'group_name') {

	$hero_options_group = get_field($str, 'option');

	$header_classes = 'archive__header py-5 vh-85 d-flex flex-column justify-content-center align-items-center position-relative container-fluid';

	if($hero_options_group['hero_img_group']['enable_parallax']) {
		$header_classes .= ' bg-parallax';
	}
		
		switch($hero_options_group['text_align']['value']) {
			case 'start':
				$header_classes .= ' text-start';
				break;
			case 'center':
				$header_classes .= ' text-center';
				break;
			case 'end':
				$header_classes .= ' text-end';
				break;
			default:
				return;
				break;
		}

		$header_styles = '';
		if(
			$hero_options_group['background_type']['value'] === 'image' && 
			!$hero_options_group['hero_img_group']['enable_parallax']
			) {
			$header_styles .= 'background-image: url(' . $hero_options_group['hero_img_group']['bg_img']['url'] . '); background-repeat: no-repeat; background-position: center center; background-size: cover;';
		} else if(
			$hero_options_group['background_type']['value'] === 'image' && 
			$hero_options_group['hero_img_group']['enable_parallax']
			) {
			$header_styles .= 'background-image: url(' . $hero_options_group['hero_img_group']['bg_img']['url'] . ');';
		} else if(
			$hero_options_group['background_type']['value'] === 'color'
			) {
			$header_styles .= 'background-color: ' . $hero_options_group['background_color'] . ';';
		}

		if($hero_options_group['hero_font_color']) {
			$header_styles .= 'color: ' . $hero_options_group['hero_font_color'] . ';';
		}
		?>
		<header 
			class="<?php echo $header_classes; ?>"
			style="<?php echo $header_styles; ?>"
			>
			<?php if($hero_options_group['hero_img_group']['include_gradient_overlay']): ?>
				<div
						style="position: absolute; background: linear-gradient(<?php echo $hero_options_group['hero_img_group']['main_gradient_color'];?>, transparent); height: 100%; width: 100%; top: 0; right: 0; bottom: 0; left: 0; mix-blend-mode: <?php echo $hero_options_group['hero_img_group']['mix_blend_mode']['value']; ?>;"
						class="z-0"
				></div>
			<?php endif; ?>
			<div class="container position-relative z-1">
				<h1 class="display-1">
					<?php echo str_replace('Archives: ', '', get_the_archive_title()); ?>
				</h1>
				<?php the_archive_description('<div class="archive__header--description">', '</div>'); ?>
			</div>
		</header>
		<?php
}

/**
	* 
	* @param html $content  Content on the page to be cleared of any rogue empty <p></p> tags output by the WordPress Core WYSIWYG
	* @return $content
 */
function remove_empty_p($content) {
	$content = force_balance_tags($content);

	return preg_replace('#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content);
}
add_filter('the_content', 'remove_empty_p', 20, 1);