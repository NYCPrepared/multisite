<?php
/*
Plugin Name: Network Landing Pages
Description: Makes Landing pages
Version: 1
Author: Pea, Glocal
Author URI: http://glocal.coop
Text Domain: network-landing-pages
*/

define( 'ACF_LITE', true );
include_once('advanced-custom-fields/acf.php');

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
		'menu_icon'           => '',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'query_var'           => '',
		'rewrite'             => $rewrite,
		'capabilities'        => $capabilities,
		// 'register_meta_box_cb' => 'register_field_group'
	);
	register_post_type( 'network', $args );

}

// Hook into the 'init' action
add_action( 'init', 'community_networks', 0 );


/**************************
NETWORKS TAXONOMY
**************************/

// // Register Custom Taxonomy
// function community_sites() {

// 	$labels = array(
// 		'name'                       => _x( 'Sites', 'Taxonomy General Name', 'network_sites' ),
// 		'singular_name'              => _x( 'Site', 'Taxonomy Singular Name', 'network_sites' ),
// 		'menu_name'                  => __( 'Sites', 'network_sites' ),
// 		'all_items'                  => __( 'All Sites', 'network_sites' ),
// 		'parent_item'                => __( 'Parent Site', 'network_sites' ),
// 		'parent_item_colon'          => __( 'Parent Site:', 'network_sites' ),
// 		'new_item_name'              => __( 'New Site Name', 'network_sites' ),
// 		'add_new_item'               => __( 'Add New Site', 'network_sites' ),
// 		'edit_item'                  => __( 'Edit Site', 'network_sites' ),
// 		'update_item'                => __( 'Update Site', 'network_sites' ),
// 		'separate_items_with_commas' => __( 'Separate site with commas', 'network_sites' ),
// 		'search_items'               => __( 'Search Sites', 'network_sites' ),
// 		'add_or_remove_items'        => __( 'Add or remove sites', 'network_sites' ),
// 		'choose_from_most_used'      => __( 'Choose from the most used sites', 'network_sites' ),
// 		'not_found'                  => __( 'Not Found', 'network_sites' ),
// 	);
// 	$rewrite = array(
// 		'slug'                       => 'site',
// 		'with_front'                 => false,
// 		'hierarchical'               => false,
// 	);
// 	$capabilities = array(
// 		'manage_terms'               => 'manage_categories',
// 		'edit_terms'                 => 'manage_categories',
// 		'delete_terms'               => 'manage_categories',
// 		'assign_terms'               => 'manage_categories',
// 	);
// 	$args = array(
// 		'labels'                     => $labels,
// 		'hierarchical'               => true,
// 		'public'                     => true,
// 		'show_ui'                    => true,
// 		'show_admin_column'          => true,
// 		'show_in_nav_menus'          => true,
// 		'show_tagcloud'              => true,
// 		'query_var'                  => 'network_sites',
// 		'rewrite'                    => $rewrite,
// 		'capabilities'               => $capabilities,
// 	);
// 	register_taxonomy( 'network_sites', 'network', $args );

// }

// // Hook into the 'init' action
// add_action( 'init', 'community_sites', 0 );


/**************************
NETWORKS CUSTOM FIELDS
**************************/

if(function_exists("register_field_group")) {

	// Pull all the sites into an array
	$options_sites = array();
	$options_sites_obj = wp_get_sites('offset=1');
	foreach ($options_sites_obj as $site) {
		$site_id = $site['blog_id'];
		$site_details = get_blog_details($site_id);
		$options_sites[$site_id] = $site_details->blogname;
	}
	
	register_field_group(
		array (
		'id' => 'acf_site',
		'title' => 'Site',
		'fields' => array (
			array (
				'key' => 'network_sites',
				'label' => 'Sites',
				'name' => 'network_sites',
				'type' => 'checkbox',
				'choices' => $options_sites,
				'default_value' => '',
				'layout' => 'vertical',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'network',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'permalink',
				1 => 'excerpt',
				2 => 'custom_fields',
				3 => 'discussion',
				4 => 'comments',
				5 => 'revisions',
				6 => 'slug',
				7 => 'author',
				8 => 'format',
				9 => 'categories',
				10 => 'tags',
				11 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));

	register_field_group(
		array (
		'id' => 'network_contact-information',
		'title' => 'Contact Information',
		'fields' => array (
			array (
				'key' => 'network_facebook',
				'label' => 'Facebook',
				'name' => 'network_facebook',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'https://evilproprietarysocialnetwork.com',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'network_twitter',
				'label' => 'Twitter',
				'name' => 'network_twitter',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'https://twitter.com',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'network_email',
				'label' => 'Email',
				'name' => 'network_email',
				'type' => 'email',
				'default_value' => '',
				'placeholder' => 'name@email.com',
				'prepend' => '',
				'append' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'network',
					'order_no' => 10,
					'group_no' => 10,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'permalink',
				1 => 'excerpt',
				2 => 'custom_fields',
				3 => 'discussion',
				4 => 'comments',
				5 => 'revisions',
				6 => 'slug',
				7 => 'author',
				8 => 'format',
				9 => 'categories',
				10 => 'tags',
				11 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));

	// Add location field to volunteer posts
	register_field_group(
		array (
		'id' => 'network_location',
		'title' => 'Location',
		'fields' => array (
			array (
				'key' => 'volunteer_location',
				'label' => 'Volunteer Location',
				'name' => 'volunteer_location',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'Rockaway, New York',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
				array (
					'param' => 'post_category',
					'operator' => '==',
					'value' => '10',
					'order_no' => 1,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}



?>