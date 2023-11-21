<?php
wp_nav_menu(array(
    'theme_location' => 'main-menu',
    'container' => false,
    'menu_class' => '',
    'fallback_cb' => '__return_false',
    'items_wrap' => '<ul id="%1$s" class="' . $row_class .' navbar-nav me-auto mb-2 mb-md-0 %2$s">%3$s</ul>',
    'depth' => 3,
    'walker' => new bootstrap_5_wp_nav_menu_walker()
));?>