<?php
/**
 * This file contains the functions used by the Warp9 theme.
 * It defines the theme version, includes necessary files, and registers theme supports, menus, and blocks.
 * It also adds filters for loading separate core block assets and setting the inline styles size limit.
 */


define( 'warp9_VERSION', 1.0 ); // Define the version so we can easily replace it throughout the theme

require_once (ABSPATH .'wp-includes/class-wpdb.php');
require_once(ABSPATH . 'wp-admin/includes/file.php');

require_once get_template_directory() . '/inc/wordpress-cleanup.php';
require_once get_template_directory() . '/inc/wordpress-defaults.php';
require_once get_template_directory() . '/inc/theme-supports.php';
require_once get_template_directory() . '/inc/theme-navandmenus.php';
require_once get_template_directory() . '/inc/theme-enques.php';
require_once get_template_directory() . '/inc/theme-editor-scripts.php';
require_once get_template_directory() . '/inc/theme-disable-comments.php';


// Acf Fields management
require_once get_template_directory() . '/inc/theme-acf.php';
require_once get_template_directory() . '/blocks/register-blocks.php';


/*-----------------------------------------------------------------------------------*/
/* Theme Options
/*-----------------------------------------------------------------------------------*/

// Google Analytics and tag manager
require_once get_template_directory() . '/inc/theme-header-googleanalytics.php';
// Favicons
require_once get_template_directory() . '/inc/theme-header-favicons.php';
// Google Fonts
require_once get_template_directory() . '/inc/theme-enques-googlefonts.php';
// Fontawesome
require_once get_template_directory() . '/inc/theme-header-fontawesome.php';
// Typekit
require_once get_template_directory() . '/inc/theme-header-typekit.php';

// Custom Functions
require_once get_template_directory() . '/inc/theme-custom-functions.php';

?>