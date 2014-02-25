<?php
/*
Plugin Name: Network Landing Pages
Description: Makes a custom post type called Networks. Network posts can have sites associated with them so that it serves as a landing page for a Network grouping of sites. The page can contain a custom header image (featured image), a description and contact fields. The post type can be further customized as needed.
Version: 1
Author: Pea, Glocal
Author URI: http://glocal.coop
Text Domain: network-landing-pages
*/

include_once('metaboxes/metabox-functions.php');
include_once('widgets/network-sites-widget.php');

/**************************
CUSTOM NETWORK COLUMNS
**************************/

add_filter( 'manage_edit-network_columns', 'community_edit_network_columns' ) ;

function community_edit_network_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Network Name' ),
		'community_network_sites' => __( 'Sites' ),
		'thumbnail' => __( 'Banner' ),
		'date' => __( 'Date' )
	);

	return $columns;
}


add_action( 'manage_network_posts_custom_column', 'community_manage_network_columns', 10, 2 );

function community_manage_network_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {

		/* If displaying the 'site' column. */
		case 'community_network_sites' :

			/* Get the post meta. */
			$blog_ids = get_post_meta($post_id, 'community_network_sites');

			/* If there are sites assigned, display them as a list */
			if (!empty($blog_ids)) {

				echo '<ul>';
				foreach ($blog_ids as $blog_id) {
					$blog_details = get_blog_details($blog_id);
					echo '<li class="blog-' . $blog_id . '">';
					echo $blog_details->blogname . ' (ID: ' . $blog_id . ')';
					echo '</li>';
				}
				echo '</ul>';
				// $sites = implode(", ", $blog_ids);

			/* Else display a message */
			} else {

				echo __( 'None Assigned' );

			}	
			
			break;

		/* If displaying the 'image' column. */
		case 'thumbnail' :

			/* Get the network banner. */
			echo get_the_post_thumbnail($page->ID, array(120,120));

			break;

		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}

/**************************
NETWORKS CONTENT TYPE
**************************/

// Register Post Type
function community_networks() {

	$labels = array(
		'name'                => _x( 'Networks', 'Post Type General Name', 'community_networks' ),
		'singular_name'       => _x( 'Network', 'Post Type Singular Name', 'community_networks' ),
		'menu_name'           => __( 'Networks', 'community_networks' ),
		'parent_item_colon'   => __( 'Parent Network:', 'community_networks' ),
		'all_items'           => __( 'All Networks', 'community_networks' ),
		'view_item'           => __( 'View Network', 'community_networks' ),
		'add_new_item'        => __( 'Add New Network', 'community_networks' ),
		'add_new'             => __( 'Add New', 'community_networks' ),
		'edit_item'           => __( 'Edit Network', 'community_networks' ),
		'update_item'         => __( 'Update Network', 'community_networks' ),
		'search_items'        => __( 'Search Network', 'community_networks' ),
		'not_found'           => __( 'Not found', 'community_networks' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'community_networks' ),
	);
	$rewrite = array(
		'slug'                => 'network',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$capabilities = array(
		'edit_post'           => 'manage_network',
		'read_post'           => 'read_post',
		'delete_post'         => 'manage_network',
		'edit_posts'          => 'manage_network',
		'edit_others_posts'   => 'manage_network',
		'publish_posts'       => 'manage_network',
		'read_private_posts'  => 'manage_network',
	);
	$args = array(
		'label'               => __( 'network', 'community_networks' ),
		'description'         => __( 'Post type that collects MS sites into network groupings', 'community_networks' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', ),
		'taxonomies'          => array( 'network_sites' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 80,
		'menu_icon'           => 'dashicons-networking',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'query_var'           => 'network',
		'rewrite'             => $rewrite,
		'capabilities'        => $capabilities,
		// 'register_meta_box_cb' => 'register_field_group'
	);
	register_post_type( 'network', $args );

}

// Hook into the 'init' action
add_action( 'init', 'community_networks', 0 );


/**************************
NETWORKS CUSTOM FIELDS
**************************/

// Fields are in metaboxes/metabox-functions.php


/**************************
NETWORKS SITES LIST WIDGET
**************************/

// Widget is in 

?>