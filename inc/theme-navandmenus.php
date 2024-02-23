<?php
/*-----------------------------------------------------------------------------------*/
/* Menus and Navigation
/*-----------------------------------------------------------------------------------*/

register_nav_menus( array( 'primary'	=>	__( 'Primary Menu', 'warp9' ), ));

function warp9_wp_nav_menu_remove($var) {
        return is_array($var) ? array_intersect($var, array('current-menu-item','menu-item-has-children','current-menu-parent')) : '';
}
add_filter('page_css_class', 'warp9_wp_nav_menu_remove', 100, 1);
add_filter('nav_menu_item_id', 'warp9_wp_nav_menu_remove', 100, 1);
add_filter('nav_menu_css_class', 'warp9_wp_nav_menu_remove', 100, 1);


?>