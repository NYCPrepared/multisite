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

remove_action( 'customize_register', 'community_customize_register', 100 );


// Remove menu customization on child themes

add_action( 'after_setup_theme', 'remove_theme_customization_community_group', 20 ); 

function remove_theme_customization_community_group() {

    unregister_nav_menu( 'main-nav' );
	unregister_nav_menu( 'secondary-nav' );
	unregister_nav_menu( 'utility-nav' );
	unregister_nav_menu( 'footer-links' );
	register_nav_menus(
		array(
			'site-nav' => __( 'The Main Site Menu', 'community-group' ),
		)
	);
}


?>