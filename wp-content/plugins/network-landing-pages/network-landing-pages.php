<?php
/*
Plugin Name: Network Landing Pages
Description: Makes Landing pages
Version: 1
Author: Pea, Glocal
Author URI: http://glocal.coop
Text Domain: network-landing-pages
*/


/**************************
NETWORKS CONTENT TYPE
**************************/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! function_exists('network_landing_pages') ) {

// Register Custom Post Type
function network_landing_pages() {

	$labels = array(
		'name'                => _x( 'Site Networks', 'Post Type General Name', 'network_landing_pages' ),
		'singular_name'       => _x( 'Site Network', 'Post Type Singular Name', 'network_landing_pages' ),
		'menu_name'           => __( 'Networks', 'network_landing_pages' ),
		'parent_item_colon'   => __( 'Parent Item:', 'network_landing_pages' ),
		'all_items'           => __( 'All Networks', 'network_landing_pages' ),
		'view_item'           => __( 'View Network', 'network_landing_pages' ),
		'add_new_item'        => __( 'Add New Network', 'network_landing_pages' ),
		'add_new'             => __( 'Add New', 'network_landing_pages' ),
		'edit_item'           => __( 'Edit Network', 'network_landing_pages' ),
		'update_item'         => __( 'Update Network', 'network_landing_pages' ),
		'search_items'        => __( 'Search Network', 'network_landing_pages' ),
		'not_found'           => __( 'Not found', 'network_landing_pages' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'network_landing_pages' ),
	);
	$rewrite = array(
		'slug'                => 'network',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$capabilities = array(
		'manage_options'      => 'manage_options',
	);
	$args = array(
		'label'               => __( 'network_landing_pages', 'network_landing_pages' ),
		'description'         => __( 'Post type that collects MS sites into network groupings', 'network_landing_pages' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'permalink' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 80,
		'menu_icon'           => '',
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'query_var'           => '',
		'rewrite'             => $rewrite,
		'capabilities'        => $capabilities,
	);
	register_post_type( 'network_landing_pages', $args );

}

// Hook into the 'init' action
add_action( 'init', 'network_landing_pages', 0 );

}


/**************************
SITE NETWORKS METABOXES
**************************/

require plugin_dir_path( __FILE__ ) . '/metaboxes/metabox-functions.php';






?>