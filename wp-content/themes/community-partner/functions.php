<?php
/*
Author: Pea, Glocal
URL: htp://glocal.coop
*/

require_once( 'library/community-rss-widget.php' );

$args = array(
	'flex-width'    => true,
	'width'         => 0,
	'flex-height'    => true,
	'height'        => 0,
);
add_theme_support( 'custom-header', $args );


function unregister_default_wp_widgets() {
    unregister_widget('WP_Widget_RSS');
}
add_action('widgets_init', 'unregister_default_wp_widgets', 1);


?>