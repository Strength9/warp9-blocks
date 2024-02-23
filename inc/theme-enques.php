<?php

/*-----------------------------------------------------------------------------------*/
/* Enqueue Styles and Scripts
/*-----------------------------------------------------------------------------------*/

remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );

function warp9_scripts()  { 
	//Javascript
	wp_enqueue_script( 'ws9-thp-splide', get_template_directory_uri() . '/assets/js/thirdparty/splide.js','','',true); 
	wp_enqueue_script( 'ws9-ajax', get_template_directory_uri() . '/assets/js/script.js','','',true); 
	// New Enques Here --

	wp_localize_script( 'ws9-ajax', 'frontend_ajax_object',
	array( 
		  'ajaxurl' => admin_url( 'admin-ajax.php' ),
		  'ajax_nonce' => wp_create_nonce('secure_nonce_name'),
	)
	);


	wp_enqueue_style('warp9-style', get_stylesheet_directory_uri() . '/style.css?v='.rand(111,999));
	wp_enqueue_script( 'jquery-core' );
	wp_dequeue_style( 'classic-theme-styles' );
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style('hoverIntent');
}
add_action( 'wp_enqueue_scripts', 'warp9_scripts' ); 


/*-----------------------------------------------------------------------------------*/
/* Css Control for front end of site.
/*-----------------------------------------------------------------------------------*/

	add_filter( 'should_load_separate_core_block_assets', '__return_true' );
	add_filter( 'styles_inline_size_limit', function() {
		return 50000; // Size in bytes.
	});

?>
