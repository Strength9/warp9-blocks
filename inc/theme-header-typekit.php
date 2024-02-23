<?php

/**
 * Function to add Typekit font to the website header.
 *
 * @return void
 */

function warp_typekit() {
    $typekitid = 'XXX.css';
    echo '<link rel="stylesheet" href="https://use.typekit.net/'.$typekitid.'">';
}

add_action('wp_head', 'warp_typekit', 2);

?>