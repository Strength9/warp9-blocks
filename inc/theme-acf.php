<?php

namespace warp9\ACF;

/**
 * Register Options Page
 */
function register_options_page() {
	if ( function_exists( 'acf_add_options_page' ) ) {
		acf_add_options_page(
			[
				'title'      => 'Site Options',
				'capability' => 'manage_options',
                'position' => '0',
			]
		);
	}
}
add_action( 'init', __NAMESPACE__ . '\\register_options_page' );

?>