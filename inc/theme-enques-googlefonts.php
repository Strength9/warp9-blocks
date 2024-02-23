<?php

function warp_google_fonts() {

    $googleurl = 'XXX';

    echo '<link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="'.$googleurl.'" rel="stylesheet">';
 
 }
 
 add_action('wp_head', 'warp_google_fonts', 2);
 
?>