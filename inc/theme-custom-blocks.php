<?php

function tatlock_theme_setup() {
	remove_theme_support( 'core-block-patterns' );
}
add_action ('after_setup_theme', 'tatlock_theme_setup');


?>