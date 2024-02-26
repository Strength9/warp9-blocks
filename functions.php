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
require_once get_template_directory() . '/inc/theme-custom-blocks.php';
require_once get_template_directory() . '/inc/theme-acf.php';
require_once get_template_directory() . '/blocks/register-blocks.php';


/*-----------------------------------------------------------------------------------*/
/* Theme Options
/*-----------------------------------------------------------------------------------*/

// Google Analytics and tag manager
// require_once get_template_directory() . '/inc/theme-header-googleanalytics.php';
// Favicons
// require_once get_template_directory() . '/inc/theme-header-favicons.php';
// Google Fonts
// require_once get_template_directory() . '/inc/theme-enques-googlefonts.php';
// Fontawesome
// require_once get_template_directory() . '/inc/theme-header-fontawesome.php';
// Typekit
// require_once get_template_directory() . '/inc/theme-header-typekit.php';

// Custom Functions
// require_once get_template_directory() . '/inc/theme-custom-functions.php';





function custom_render_block_core_group (
	string $block_content, 
	array $block
): string 
{
	if (
		$block['blockName'] === 'core/group' && 
		!is_admin() &&
		!wp_is_json_request()
	) {
		$html = '';

		$block['attrs']['className'] ??= '';

		// Add background color to the page section
		//$block['attrs']['className'] .= ' theme--' . ($block['attrs']['backgroundColor'] ?? 'white');

		$html .= '<section class="group ' . $block['attrs']['className'] . '">' . "\n";
		$html .= '<div class="container">' . "\n";

		if (isset($block['innerBlocks'])) {
			foreach ($block['innerBlocks'] as $inner_block) {
				$html .= render_block($inner_block);
			}
		}

		$html .= '</div><!--/ .container -->' . "\n";
		$html .= '</section><!--/ .group -->' . "\n";

		return $html;
	}

	return $block_content;
}

add_filter('render_block', 'custom_render_block_core_group', null, 2);



remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );

add_action( 'wp_enqueue_scripts', function() {
  wp_dequeue_style( 'wp-block-library' );
  wp_dequeue_style( 'wp-block-library-theme' );
  wp_dequeue_style( 'classic-theme-styles' );
} );

add_filter( 'should_load_separate_core_block_assets', '__return_false' );









function prefix_remove_core_block_styles() {
	global $wp_styles;

	foreach ( $wp_styles->queue as $key => $handle ) {
		if ( strpos( $handle, 'wp-block-' ) === 0 ) {
			wp_dequeue_style( $handle );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'prefix_remove_core_block_styles',100 );

// This line is preferably be added to your theme's functions.php file
// with other add_theme_support() function calls.
add_theme_support( 'disable-layout-styles' );
// These two lines will probably not be necessary eventually
remove_filter( 'render_block', 'wp_render_layout_support_flag', 10, 2 );
remove_filter( 'render_block', 'gutenberg_render_layout_support_flag', 10, 2 );
?>