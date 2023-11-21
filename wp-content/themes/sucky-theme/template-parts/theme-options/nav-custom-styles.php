<?php

/**
 * custom inline styles for nav and offcanvas
 * 
 * TODO: 
 *  :visited, 
 *  active hover color, 
 *  site title color and hover, 
 *  dropdown active background hover color (dropdown only),
 *  top-level colors (that will also affect top-level dropdown links)
 */

$nav_custom_colors = get_field('nav_custom_colors', 'option'); // group

// top-level
// $sticky_nav = get_field('sticky_nav', 'option');
$custom_nav_background = $nav_custom_colors['custom_nav_background'];
$custom_color_links = $nav_custom_colors['custom_color_links'];
$custom_links_hover_color = $nav_custom_colors['custom_links_hover_color'];
$custom_active_link_color = $nav_custom_colors['custom_active_link_color'];

// dropdown
$dropdown_links = $nav_custom_colors['dropdown_links']; // group

$custom_dropdown_background = $nav_custom_colors['custom_dropdown_background'];
$custom_dropdown_color_links = $dropdown_links['custom_dropdown_color_links'];
$custom_dropdown_links_hover_color = $dropdown_links['custom_dropdown_links_hover_color'];

$custom_dropdown_active_link_color = $dropdown_links['custom_dropdown_active_link_color'];
$custom_dropdown_active_hover = $dropdown_links['custom_dropdown_active_hover'];
$custom_dropdown_active_link_background = $dropdown_links['custom_dropdown_active_link_background'];
$custom_dropdown_color_links = $dropdown_links['custom_dropdown_color_links'];
$custom_dropdown_links_hover_color = $dropdown_links['custom_dropdown_links_hover_color'];
$custom_dropdown_link_hover_background = $dropdown_links['custom_dropdown_link_hover_background'];

?>
<style>
.navbar,
.offcanvas,
header#masthead {
 background-color: <?php echo $custom_nav_background;
 ?>;
}

.dropdown-menu {
  border: 1px solid <?php echo $custom_dropdown_background; ?>;
}

.navbar *,
.offcanvas * {
 transition: all .32s ease-in-out;
}

.nav-link {
 color: <?php echo $custom_color_links;
 ?>;

}

.nav-link:hover {
 color: <?php echo $custom_links_hover_color;
 ?>;
}

.nav-link.active:not(.navbar-nav > .dropdown-menu-start .nav-link.active) {
 color: <?php echo $custom_active_link_color;
 ?> !important;
}

.navbar-nav > .dropdown-menu-start .nav-link.active {
  color: <?php echo $custom_color_links;
 ?>;
}

.navbar-nav > .dropdown-menu-start .nav-link.active:hover {
  color: <?php echo $custom_links_hover_color;
 ?>;
}

.dropdown-menu {
 background-color: <?php echo $custom_dropdown_background;
 ?>;
 box-shadow: 0 10px 20px rgba(0, 0, 0, .5);
}

.dropdown-item {
 color: <?php echo $custom_dropdown_color_links;
 ?> !important;
}

.dropdown-item.active,
.dropdown-item:active {
 color: <?php echo $custom_dropdown_active_link_color;
 ?>;
 background-color: <?php echo $custom_dropdown_active_link_background;
 ?>;
}

.nav-link.active:hover {
  color: <?php echo $custom_dropdown_active_hover; ?>;
}

.dropdown-item:focus,
.dropdown-item:hover {
 background-color: <?php echo $custom_dropdown_link_hover_background;
 ?>;
}

.dropdown-item:hover {
  color: <?php echo $custom_dropdown_links_hover_color;
 ?> !important;
}

.offcanvas .btn-close {
 transition: all .32s ease-in-out;
 color: <?php echo $custom_color_links;
 ?>;
 background: transparent url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23<?php echo str_replace('#', '', $custom_color_links); ?>'%3e%3cpath d='M.293.293a1 1 0 0 1 1.414 0L8 6.586 14.293.293a1 1 0 1 1 1.414 1.414L9.414 8l6.293 6.293a1 1 0 0 1-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 0 1-1.414-1.414L6.586 8 .293 1.707a1 1 0 0 1 0-1.414z'/%3e%3c/svg%3e") center/1em auto no-repeat;
}

.offcanvas .btn-close:hover {
 color: <?php echo $custom_links_hover_color;
 ?>;
 background: transparent url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23<?php echo str_replace('#', '', $custom_links_hover_color); ?>'%3e%3cpath d='M.293.293a1 1 0 0 1 1.414 0L8 6.586 14.293.293a1 1 0 1 1 1.414 1.414L9.414 8l6.293 6.293a1 1 0 0 1-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 0 1-1.414-1.414L6.586 8 .293 1.707a1 1 0 0 1 0-1.414z'/%3e%3c/svg%3e") center/1em auto no-repeat;
}
</style>