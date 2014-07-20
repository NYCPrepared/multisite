<?php
/*
Author: Pea, Glocal
URL: htp://glocal.coop
*/

$args = array(
	'flex-width'    => true,
	'width'         => 960,
	'flex-height'    => true,
	'height'        => 300,
	'header-text'   => false,
);
add_theme_support( 'custom-header', $args );


// Remove theme customization settings for child theme

remove_action( 'customize_register', 'community_customize_register' );



?>