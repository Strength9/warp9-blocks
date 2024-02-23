<?php

    function website_remove_version() { return ''; }
	remove_action('wp_head', 'rest_output_link_wp_head', 10);
	remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
	remove_action('template_redirect', 'rest_output_link_header', 11, 0);
	remove_action ('wp_head', 'rsd_link');
	remove_action( 'wp_head', 'wlwmanifest_link');
	remove_action( 'wp_head', 'wp_shortlink_wp_head');

	add_filter('the_generator', 'website_remove_version');
	add_filter( 'tiny_mce_plugins', 'warp9_disable_emojis_tinymce' );
	add_filter( 'rank_math/frontend/remove_credit_notice', '__return_true' );
	add_filter( 'script_loader_src', 'warp9_website_cleanup_query_string', 15, 1 ); 
	add_filter( 'style_loader_src', 'warp9_website_cleanup_query_string', 15, 1 );

	function warp9_website_cleanup_query_string( $src ){ $parts = explode( '?', $src );  return $parts[0];  }  
	function warp9_remove_jquery_migrate($scripts){
				if (!is_admin() && isset($scripts->registered['jquery'])) {
					$script = $scripts->registered['jquery'];
					
					if ($script->deps) { // Check whether the script has any dependencies
						$script->deps = array_diff($script->deps, array(
							'jquery-migrate'
						));
					}
				}
	}
	add_action('wp_default_scripts', 'warp9_remove_jquery_migrate');

	function warp9_disable_emojis() {
				remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
				remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
				remove_action( 'wp_print_styles', 'print_emoji_styles' );
				remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
				remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
				remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
				remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
				add_filter( 'tiny_mce_plugins', 'warp9_disable_emojis_tinymce' );
				add_filter( 'wp_resource_hints', 'warp9_disable_emojis_remove_dns_prefetch', 10, 2 );
	}
	add_action( 'init', 'warp9_disable_emojis' );
			
	function warp9_disable_emojis_tinymce( $plugins ) {
				if ( is_array( $plugins ) ) {
				return array_diff( $plugins, array( 'wpemoji' ) );
				} else {
				return array();
				}
	}	
	function warp9_disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
				if ( 'dns-prefetch' == $relation_type ) {
					$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
					$urls = array_diff( $urls, array( $emoji_svg_url ) );
				}
			
			return $urls;
	}
				
	remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
	remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );

	function itsme_disable_feed() {
		wp_die( __( 'No feed available, please visit the <a href="'. esc_url( home_url( '/' ) ) .'">homepage</a>!' ) );
	}
	
	add_action('do_feed', 'itsme_disable_feed', 1);
	add_action('do_feed_rdf', 'itsme_disable_feed', 1);
	add_action('do_feed_rss', 'itsme_disable_feed', 1);
	add_action('do_feed_rss2', 'itsme_disable_feed', 1);
	add_action('do_feed_atom', 'itsme_disable_feed', 1);
	add_action('do_feed_rss2_comments', 'itsme_disable_feed', 1);
	add_action('do_feed_atom_comments', 'itsme_disable_feed', 1);
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'feed_links', 2 );

?>