<?php
/*
Author: Pea, Glocal
URL: htp://glocal.coop
*/

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

// require_once( 'library/community-rss-widget.php' );

// Custom header support

$args = array(
	'flex-width'    => true,
	'width'         => 250,
	'flex-height'    => true,
	'height'        => 98,
	'header-text'   => false,
);

add_theme_support( 'custom-header', $args );

// Remove default RSS feed widget

if ( is_plugin_active('partner-rss-feed/partner-rss-widget.php') ) { 
// If the partner rss feed is active, hide the default feed widget

	function unregister_default_wp_widgets() {
	    unregister_widget('WP_Widget_RSS');
	}
	add_action('widgets_init', 'unregister_default_wp_widgets', 1);

}

?>