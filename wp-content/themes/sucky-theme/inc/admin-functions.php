<?php

/**
 * Admin functions
 *
 * @package This_Theme_Sucks
 */

// exit if accessed directly
defined('ABSPATH') || exit;

function acf_options_init()
{
  if (function_exists('acf_add_options_page')) :

    /**
     * Add theme options page
     *
     * $option_page Parent settings menu item
     *
     * $option_subpage Subpages under the Theme Options admin menu
     *
     * @param array Array of settings
     *
     */

    $option_page = acf_add_options_page(array(
      'page_title'  =>  __('Theme General Settings', 'sucky-theme'),
      'menu_title'  =>  __('Theme Settings', 'sucky-theme'),
      'menu_slug'   =>  'theme-general-settings',
      'capability'  =>  'edit_posts',
      'redirect'    =>  false,
      'autoload'    =>  true
    ));

    //sub pages
    $option_subpage = acf_add_options_page(array(
      'page_title'  =>  __('Navbar Settings', 'sucky-theme'),
      'menu_title'  =>  __('Navbar'),
      'parent_slug' =>  $option_page['menu_slug'],
    ));

    $option_subpage = acf_add_options_page(array(
      'page_title'  =>  __('Footer Settings', 'sucky-theme'),
      'menu_title'  =>  __('Footer'),
      'parent_slug' =>  $option_page['menu_slug'],
    ));

  endif;
}
add_action('acf/init', 'acf_options_init');

function acf_register_block_types()
{
  acf_register_block_type(array(
    'name'  =>  'acf-flex-content',
    'title' =>  __('ACF Flexible Content Block', 'sucky-theme'),
    'description' =>  __('Custom Gutenberg block', 'sucky-theme'),
    'render_template' =>  'template-parts/blocks/default/default.php',
    'mode'  =>  'edit',
    'icon'  =>  'book-alt',
    'align' =>  'full',
    'category'  =>  'formatting',
  ));
}

if (function_exists('acf_register_block_type')) {
  add_action('acf/init', 'acf_register_block_types');
}

/**
 * Filter function to remove tinymce emoji plugin
 * @param array $plugins
 * @return array Difference between arrays
 */
function disable_emojis_tinymce($plugins)
{
  return is_array($plugins) ? array_diff($plugins, array('wpemoji')) : array();
}

/**
 * remove wp logo from admin bar
 *
 * from https://www.isitwp.com/remove-wordpress-logo-admin-bar/
 */
function remove_wp_admin_bar_logo()
{
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('wp-logo');
}
add_action('wp_before_admin_bar_render', 'remove_wp_admin_bar_logo', 0);

function no_howdy($wp_admin_bar)
{
  $sucky_account = $wp_admin_bar->get_node('my-account');
  $newText = str_replace('Howdy', 'The truth is out there', $sucky_account->title);

  $wp_admin_bar->add_node(array(
    'id'  =>  'my-account',
    'title' =>  $newText,
  ));
}
add_filter('admin_bar_menu', 'no_howdy', 25);

if (!function_exists('sucky_custom_menu')) :
  /**
   * customize the order of menu items
   * @param  array $menu_order               Array of menu items
   * @return array             return the array
   */
  function sucky_custom_menu($menu_order)
  {
    if (!$menu_order) return true;

    return array(
      'index.php',
      'separator1',
      'edit.php?post_type=page',
      'separator2',
      'edit.php?post_type=video_game_reviews',
      'edit.php?post_type=tv-show-reviews',
      'edit.php?post_type=book-reviews',
      'separator3',
      'upload.php',
      'theme-general-settings',
      'nav-menus.php',
      'themes.php',
      'separator-last',
      'plugins.php',
      'users.php',
      'tools.php',
      'options-general.php'
    );
  }
endif;
add_filter('custom_menu_order', 'sucky_custom_menu');
add_filter('menu_order', 'sucky_custom_menu');

if(!function_exists('sucky_theme_allowed_block_types')):
  /**
   * limit Gutenberg blocks to only our custom ACF ones
   */
  function sucky_theme_allowed_block_types($allowed_blocks) {
    return array(
      'acf/acf-flex-content'
    );
  }
endif;
add_filter('allowed_block_types', 'sucky_theme_allowed_block_types');

function my_layout_title($title, $field, $layout, $i)
{
  /**
   * customize acf flexible layout titles to help with organization on the backend
   * from https://www.advancedcustomfields.com/resources/acf-fields-flexible_content-layout_title/
   * @var string
   * @return string
   */
  $title = '';
  
  if ($value = get_sub_field('layout_title')) {
    return
      $title .= '<span style="font-weight: bold;">' . esc_html($value) . '</span>';
  } else if ($get_thumbnail = get_sub_field('add_layout_thumbnail') && $image = get_sub_field('layout_thumbnail')) {
    // get thumbnail image
    $title .= '<span style=""><img src="' . esc_url($image['sizes']['thumbnail']) . '" style="max-width: 100%; display: block; margin: auto;" /></span>';
  }
  return $title;
}
add_filter('acf/fields/flexible_content/layout_title', 'my_layout_title', 10, 4);

function remove_comments()
{
  // from https://www.wpbeginner.com/wp-tutorials/how-to-completely-disable-comments-in-wordpress/
  // redirect any user trying to aaccess comments page
  global $pagenow;

  if ($pagenow === 'edit-comments.php') {
    wp_safe_redirect(admin_url());
    exit;
  }

  // Remove comments metabox from dashboard
  remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

  // Disable support for commments and trackbacks in post types
  foreach (get_post_types() as $post_type) {
    if (post_type_supports($post_type, 'comments')) {
      remove_post_type_support($post_type, 'comments');
      remove_post_type_support($post_type, 'trackbacks');
    }
  }
}
add_action('admin_init', 'remove_comments');

// close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments page in menu
function remove_admin_comments()
{
  remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'remove_admin_comments');

// Remove comments links from admin bar
function remove_comments_admin_menu()
{
  if (is_admin_bar_showing()) {
    remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
  }
}
add_action('init', 'remove_comments_admin_menu');

function remove_widgets() {
  remove_submenu_page('themes.php', 'widgets.php');
}
add_action('admin_menu', 'remove_widgets', 999);

// bootstrap 5 wp_nav_menu walker
// from https://github.com/AlexWebLab/bootstrap-5-wordpress-navbar-walker
// bootstrap 5 wp_nav_menu walker
// depth fix from https://github.com/imanishpushkar/bs5-navwalker
class bootstrap_5_wp_nav_menu_walker extends Walker_Nav_menu
{
  private $current_item;
  private $dropdown_menu_alignment_values = [
    'dropdown-menu-start',
    'dropdown-menu-end',
    'dropdown-menu-sm-start',
    'dropdown-menu-sm-end',
    'dropdown-menu-md-start',
    'dropdown-menu-md-end',
    'dropdown-menu-lg-start',
    'dropdown-menu-lg-end',
    'dropdown-menu-xl-start',
    'dropdown-menu-xl-end',
    'dropdown-menu-xxl-start',
    'dropdown-menu-xxl-end'
  ];

  function start_lvl(&$output, $depth = 0, $args = null)
  {
    $dropdown_menu_class[] = '';
    foreach ($this->current_item->classes as $class) {
      if (in_array($class, $this->dropdown_menu_alignment_values)) {
        $dropdown_menu_class[] = $class;
      }
    }
    $indent = str_repeat("\t", $depth);
    $submenu = ($depth > 0) ? ' dropdown-submenu' : '';
    $output .= "\n$indent<ul class=\"dropdown-menu$submenu " . esc_attr(implode(" ", $dropdown_menu_class)) . " depth_$depth\">\n";
  }

  function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
  {
    $this->current_item = $item;

    $indent = ($depth) ? str_repeat("\t", $depth) : '';

    $li_attributes = '';
    $class_names = $value = '';

    $classes = empty($item->classes) ? array() : (array) $item->classes;

    $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
    $classes[] = 'nav-item';
    $classes[] = 'nav-item-' . $item->ID;
    if ($depth && $args->walker->has_children) {
      $classes[] = 'dropdown-menu-child-item dropdown-menu-end at_depth_' . $depth;
    }

    $class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
    $class_names = ' class="' . esc_attr($class_names) . '"';

    $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
    $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

    $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

    $attributes  = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
    $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
    $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
    $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

    /*$active_class = ($item->current || $item->current_item_ancestor || in_array("current_page_parent", $item->classes, true) || in_array("current-post-ancestor", $item->classes, true)) ? 'active' : '';
    $nav_link_class = ($depth > 0) ? 'dropdown-item ' : 'nav-link ';*/

    $active_class = ($item->current || $item->current_item_ancestor) ? 'active' : '';
    $nav_link_class = ($depth > 0) ? 'dropdown-item ' : 'nav-link ';
    $attributes .= ($args->walker->has_children) ? ' class="' . $nav_link_class . $active_class . ' dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="' . $nav_link_class . $active_class . '"';

    if ($args->walker->has_children) {
      $attributes .=  ' class="' . $nav_link_class . $active_class . ' dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" data-bs-auto-close="outside" aria-expanded="false"';
    } else {
      $attributes .=  ' class="' . $nav_link_class . $active_class . '"';
    }

    $item_output = $args->before;
    $item_output .= '<a' . $attributes . '>';
    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
}

if(!function_exists('remove_default_posts')):
  /**
   * remove default posts item from wp-admin menu
   */
  function remove_default_posts() {
    remove_menu_page('edit.php');
  }
endif;
add_action('admin_init', 'remove_default_posts');
