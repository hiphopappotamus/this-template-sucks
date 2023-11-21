<?php
wp_nav_menu((array(
 'theme_location'  => 'footer-menu',
 'container'       => false,
 'menu_class'      => '',
 'fallback_cb'     => '__return_false',
 'items_wrap'      => '<ul id="%1$s" class="m-0 d-flex list-unstyled">%3$s</ul>',
 'depth'           => 0,
))); ?>