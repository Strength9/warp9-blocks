<?php

/*-----------------------------------------------------------------------------------*/
/* MODIFY WORDPRESS DEFAULTS
/*-----------------------------------------------------------------------------------*/

/* Remove the auto p tag removal */

remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );

?>