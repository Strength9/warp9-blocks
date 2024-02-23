<?php
/*-----------------------------------------------------------------------------------*/
/* Set Theme Supports
/*-----------------------------------------------------------------------------------*/
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'menus' );
add_theme_support( 'title-tag' );
add_theme_support( 'editor-styles' ); 
add_editor_style( 'style-editor.css' );

// Woocomerce Support For the image gallerys and sliders
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );
function warp9_add_woocommerce_support() { add_theme_support( 'woocommerce' ); }
add_action( 'after_setup_theme', 'warp9_add_woocommerce_support' );  

if ( function_exists( 'add_theme_support' ) ) {	add_theme_support( 'post-thumbnails' );}
add_image_size( 'category-thumb', 313, 380, true );

function warp9_post_image_sizes($sizes){
	$custom_sizes = array(
		'category-thumb' => 'Category Thumb'
	);
	return array_merge( $sizes, $custom_sizes );
}
add_filter('image_size_names_choose', 'warp9_post_image_sizes');

?>