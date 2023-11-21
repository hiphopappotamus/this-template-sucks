<?php
/**
 * extra theme stuff
 *
 * @package This_Theme_Sucks
 */

// exit if accessed directly
defined('ABSPATH') || exit;

if (!function_exists('sucky_body_classes')):

  /**
   * add custom class to array of body classes
   * @param  array $classes               Classes for the body element
   * @return array
   */
  function sucky_body_classes($classes) {

    if(is_multi_author()) {
      $classes[] = 'hfeed';
    }
    return $classes;
  }
endif;
add_filter('body_class', 'sucky_body_classes');

if (!function_exists('adjust_body_class')):
  /**
   * remove tag class from body_class array to avoid bootstrap issues
   * @var    string $classes               CSS classes
   * @return mixed
   */
  function adjust_body_class($classes) {
    foreach($classes as $key => $value) {
      if ('tag' == $value) {
        unset($classes[$key]);
      }
    }
    return $classes;
  }
endif;
add_filter('body_class', 'adjust_body_class');

if(!function_exists('custom_logo_class')):
  /**
   * replace logo css class
   * @param  string $html               Markup
   * @return mixed
   */
  function custom_logo_class($html) {
    $html = str_replace('class="custom-logo"', 'class="img-fluid"', $html);
    $html = str_replace('class=-"custom-logo-link"', 'class="navbar-brand custom-logo-link"', $html);
    $html = str_replace('alt=""', 'title="Home" alt=""', $html);

    return $html;
  }
endif;
add_filter('get_custom_logo', 'custom_logo_class');

/**
 * display navigation to next/previous post when applicable
 */
function sucky_post_nav() {
  // don't print empty markup if there are no posts to navigate
  $previous = (is_attachment()) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
  $next = get_adjacent_post(false, '', false);

  if(!$next && !$previous) {
    return;
  }
  ?>
    <nav class="container navigation post-navigation">
      <h2 class="sr-only">
        <?php esc_html_e('Post navigation', 'sucky-theme') ?>
      </h2>
      <div class="row nav-links">
        <div class="col-12">
          <?php
            if (get_previous_post_link()) {
              previous_post_link('<span></span>');
            }
          ?>
        </div>
      </div>
    </nav>
  <?php
}

if(!function_exists('sucky_kses_title')):
  function sucky_kses_title($data) {
    // tags not supported in HTML5 are considered invalid
    $allowed_tags = array(
      'abbr'              =>  array(),
      'aria-describedby'  =>  true,
      'aria-details'      =>  true,
      'aria-label'        =>  true,
      'aria-labelledby'   =>  true,
      'aria-hidden'       =>  true,
      'b'                 =>  array(),
      'bdo'               =>  array(
        'dir'             =>  true,
      ),
      'blockquote'        =>  array(
        'cite'            =>  true,
        'lang'            =>  true,
      ),
      'dfn'               =>  array(),
      'em'                =>  array(),
      'i'                 =>  array(
        'aria-describedby'  =>  true,
        'aria-details'      =>  true,
        'aria-label'        =>  true,
        'aria-labelledby'   =>  true,
        'aria-hidden'       =>  true,
        'class'             =>  true,
      ),
      'code'              =>  array(),
      'del'               =>  array(
        'datetime'        =>  true,
      ),
      'ins'               =>  array(
        'datetime'        =>  true,
        'cite'            =>  true,
      ),
      'kbd'               =>  array(),
      'mark'              =>  array(),
      'pre'               =>  array(
        'width'           =>  true,
      ),
      'q'                 =>  array(
        'cite'            =>  true,
      ),
      's'                 =>  array(),
      'samp'              =>  array(),
      'span'              =>  array(
        'dir'             =>  true,
        'align'           =>  true,
        'lang'            =>  true,
        'xml:lang'        =>  true,
      ),
      'small'             =>  array(),
      'strong'            =>  array(),
      'sub'               =>  array(),
      'sup'               =>  array(),
      'u'                 =>  array(),
      'var'               =>  array(),
    );
    $allowed_tags = apply_filters('sucky_kses_title', $allowed_tags);
    return wp_kses($data, $allowed_tags);
  }
endif;
