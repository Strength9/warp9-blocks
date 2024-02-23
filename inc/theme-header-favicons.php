<?php


/**
 * This function adds the site's favicon to the head of the document by echoing the necessary HTML code.
 * The function is hooked to the 'wp_head' action using the 'add_action' function.
 *
 * @since 1.0.0
 */
function myfavicon() {

    echo '<link rel="apple-touch-icon" sizes="180x180" href="'.get_stylesheet_directory_uri().'/assets/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="'.get_stylesheet_directory_uri().'/assets/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="'.get_stylesheet_directory_uri().'/assets/favicons/favicon-16x16.png">
        <link rel="manifest" href="'.get_stylesheet_directory_uri().'/assets/favicons/site.webmanifest">
        <link rel="mask-icon" href="'.get_stylesheet_directory_uri().'/assets/favicons/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="shortcut icon" href="'.get_stylesheet_directory_uri().'/assets/favicons/favicon.ico">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="msapplication-config" content="'.get_stylesheet_directory_uri().'/assets/favicons/browserconfig.xml">
        <meta name="theme-color" content="#ffffff">';
}

add_action('wp_head', 'myfavicon');

// First, create a function that includes the path to your favicon
function add_favicon() {
  	$favicon_url = get_stylesheet_directory_uri()."/assets/favicons/favicon.ico";
	echo '<link rel="shortcut icon" href="' . $favicon_url . '" />';
}
   
add_action('login_head', 'add_favicon');
add_action('admin_head', 'add_favicon');
?>
