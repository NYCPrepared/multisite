<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category Community
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'community_meta_boxes', 'community_custom_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */


function community_custom_metaboxes( array $meta_boxes ) {

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

		// Pull all the categories into an array
	$options_sites = array();
	$options_sites_obj = wp_get_sites('offset=1');
	foreach ($options_sites_obj as $site) {
		$site_id = $site['blog_id'];
		$site_details = get_blog_details($site_id);
		$options_sites[$site_id] = $site_details->blogname;
	}

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_community_';

	$meta_boxes['site_networks_sites_metabox'] = array(
		'id'         => 'site_networks_sites_metabox',
		'title'      => __( 'Site Networks Options', 'community' ),
		'pages'      => array( 'site_networks', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'community_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name'     => __( 'Sites', 'community' ),
				'desc'     => __( 'Select the sites associated with this network', 'community' ),
				'id'       => $prefix . 'site_networks_sites',
				'type'     => 'taxonomy_multicheck',
				'options'  => $options_sites
				// 'inline'  => true, // Toggles display to inline
			),
			array(
				'name' => __( 'Site Networks Text', 'community' ),
				'desc' => __( 'field description (optional)', 'community' ),
				'id'   => $prefix . 'site_networks_text',
				'type' => 'text',
				// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
				// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
				// 'on_front'        => false, // Optionally designate a field to wp-admin only
				// 'repeatable'      => true,
			),
			array(
				'name' => __( 'Site Networks Text Small', 'community' ),
				'desc' => __( 'field description (optional)', 'community' ),
				'id'   => $prefix . 'site_networks_textsmall',
				'type' => 'text_small',
				// 'repeatable' => true,
			),
			array(
				'name' => __( 'Site Networks Text Medium', 'community' ),
				'desc' => __( 'field description (optional)', 'community' ),
				'id'   => $prefix . 'site_networks_textmedium',
				'type' => 'text_medium',
				// 'repeatable' => true,
			),
			array(
				'name' => __( 'Website URL', 'community' ),
				'desc' => __( 'field description (optional)', 'community' ),
				'id'   => $prefix . 'url',
				'type' => 'text_url',
				// 'protocols' => array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet'), // Array of allowed protocols
				// 'repeatable' => true,
			),
			array(
				'name' => __( 'Site Networks Text Email', 'community' ),
				'desc' => __( 'field description (optional)', 'community' ),
				'id'   => $prefix . 'email',
				'type' => 'text_email',
				// 'repeatable' => true,
			),
			array(
				'name' => __( 'Site Networks Time', 'community' ),
				'desc' => __( 'field description (optional)', 'community' ),
				'id'   => $prefix . 'site_networks_time',
				'type' => 'text_time',
			),
			array(
				'name' => __( 'Time zone', 'community' ),
				'desc' => __( 'Time zone', 'community' ),
				'id'   => $prefix . 'timezone',
				'type' => 'select_timezone',
			),
			array(
				'name' => __( 'Site Networks Date Picker', 'community' ),
				'desc' => __( 'field description (optional)', 'community' ),
				'id'   => $prefix . 'site_networks_textdate',
				'type' => 'text_date',
			),
			array(
				'name' => __( 'Site Networks Date Picker (UNIX timestamp)', 'community' ),
				'desc' => __( 'field description (optional)', 'community' ),
				'id'   => $prefix . 'site_networks_textdate_timestamp',
				'type' => 'text_date_timestamp',
				// 'timezone_meta_key' => $prefix . 'timezone', // Optionally make this field honor the timezone selected in the select_timezone specified above
			),
			array(
				'name' => __( 'Site Networks Date/Time Picker Combo (UNIX timestamp)', 'community' ),
				'desc' => __( 'field description (optional)', 'community' ),
				'id'   => $prefix . 'site_networks_datetime_timestamp',
				'type' => 'text_datetime_timestamp',
			),
			// This text_datetime_timestamp_timezone field type
			// is only compatible with PHP versions 5.3 or above.
			// Feel free to uncomment and use if your server meets the requirement
			// array(
			// 	'name' => __( 'Site Networks Date/Time Picker/Time zone Combo (serialized DateTime object)', 'community' ),
			// 	'desc' => __( 'field description (optional)', 'community' ),
			// 	'id'   => $prefix . 'site_networks_datetime_timestamp_timezone',
			// 	'type' => 'text_datetime_timestamp_timezone',
			// ),
			array(
				'name' => __( 'Site Networks Money', 'community' ),
				'desc' => __( 'field description (optional)', 'community' ),
				'id'   => $prefix . 'site_networks_textmoney',
				'type' => 'text_money',
				// 'before'     => '£', // override '$' symbol if needed
				// 'repeatable' => true,
			),
			array(
				'name'    => __( 'Site Networks Color Picker', 'community' ),
				'desc'    => __( 'field description (optional)', 'community' ),
				'id'      => $prefix . 'site_networks_colorpicker',
				'type'    => 'colorpicker',
				'default' => '#ffffff'
			),
			array(
				'name' => __( 'Site Networks Text Area', 'community' ),
				'desc' => __( 'field description (optional)', 'community' ),
				'id'   => $prefix . 'site_networks_textarea',
				'type' => 'textarea',
			),
			array(
				'name' => __( 'Site Networks Text Area Small', 'community' ),
				'desc' => __( 'field description (optional)', 'community' ),
				'id'   => $prefix . 'site_networks_textareasmall',
				'type' => 'textarea_small',
			),
			array(
				'name' => __( 'Site Networks Text Area for Code', 'community' ),
				'desc' => __( 'field description (optional)', 'community' ),
				'id'   => $prefix . 'site_networks_textarea_code',
				'type' => 'textarea_code',
			),
			array(
				'name' => __( 'Site Networks Title Weeeee', 'community' ),
				'desc' => __( 'This is a title description', 'community' ),
				'id'   => $prefix . 'site_networks_title',
				'type' => 'title',
			),
			array(
				'name'    => __( 'Site Networks Select', 'community' ),
				'desc'    => __( 'field description (optional)', 'community' ),
				'id'      => $prefix . 'site_networks_select',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __( 'Option One', 'community' ), 'value' => 'standard', ),
					array( 'name' => __( 'Option Two', 'community' ), 'value' => 'custom', ),
					array( 'name' => __( 'Option Three', 'community' ), 'value' => 'none', ),
				),
			),
			array(
				'name'    => __( 'Site Networks Radio inline', 'community' ),
				'desc'    => __( 'field description (optional)', 'community' ),
				'id'      => $prefix . 'site_networks_radio_inline',
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name' => __( 'Option One', 'community' ), 'value' => 'standard', ),
					array( 'name' => __( 'Option Two', 'community' ), 'value' => 'custom', ),
					array( 'name' => __( 'Option Three', 'community' ), 'value' => 'none', ),
				),
			),
			array(
				'name'    => __( 'Site Networks Radio', 'community' ),
				'desc'    => __( 'field description (optional)', 'community' ),
				'id'      => $prefix . 'site_networks_radio',
				'type'    => 'radio',
				'options' => array(
					array( 'name' => __( 'Option One', 'community' ), 'value' => 'standard', ),
					array( 'name' => __( 'Option Two', 'community' ), 'value' => 'custom', ),
					array( 'name' => __( 'Option Three', 'community' ), 'value' => 'none', ),
				),
			),
			array(
				'name'     => __( 'Site Networks Taxonomy Radio', 'community' ),
				'desc'     => __( 'field description (optional)', 'community' ),
				'id'       => $prefix . 'text_taxonomy_radio',
				'type'     => 'taxonomy_radio',
				'taxonomy' => 'category', // Taxonomy Slug
				// 'inline'  => true, // Toggles display to inline
			),
			array(
				'name'     => __( 'Site Networks Taxonomy Select', 'community' ),
				'desc'     => __( 'field description (optional)', 'community' ),
				'id'       => $prefix . 'text_taxonomy_select',
				'type'     => 'taxonomy_select',
				'taxonomy' => 'category', // Taxonomy Slug
			),
			array(
				'name'     => __( 'Site Networks Taxonomy Multi Checkbox', 'community' ),
				'desc'     => __( 'field description (optional)', 'community' ),
				'id'       => $prefix . 'site_networks_multitaxonomy',
				'type'     => 'taxonomy_multicheck',
				'taxonomy' => 'post_tag', // Taxonomy Slug
				// 'inline'  => true, // Toggles display to inline
			),
			array(
				'name' => __( 'Site Networks Checkbox', 'community' ),
				'desc' => __( 'field description (optional)', 'community' ),
				'id'   => $prefix . 'site_networks_checkbox',
				'type' => 'checkbox',
			),
			array(
				'name'    => __( 'Site Networks Multi Checkbox', 'community' ),
				'desc'    => __( 'field description (optional)', 'community' ),
				'id'      => $prefix . 'site_networks_multicheckbox',
				'type'    => 'multicheck',
				'options' => array(
					'check1' => __( 'Check One', 'community' ),
					'check2' => __( 'Check Two', 'community' ),
					'check3' => __( 'Check Three', 'community' ),
				),
				// 'inline'  => true, // Toggles display to inline
			),
			array(
				'name'    => __( 'Site Networks wysiwyg', 'community' ),
				'desc'    => __( 'field description (optional)', 'community' ),
				'id'      => $prefix . 'site_networks_wysiwyg',
				'type'    => 'wysiwyg',
				'options' => array( 'textarea_rows' => 5, ),
			),
			array(
				'name' => __( 'Site Networks Image', 'community' ),
				'desc' => __( 'Upload an image or enter a URL.', 'community' ),
				'id'   => $prefix . 'site_networks_image',
				'type' => 'file',
			),
			array(
				'name' => __( 'Multiple Files', 'community' ),
				'desc' => __( 'Upload or add multiple images/attachments.', 'community' ),
				'id'   => $prefix . 'site_networks_file_list',
				'type' => 'file_list',
			),
			array(
				'name' => __( 'oEmbed', 'community' ),
				'desc' => __( 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.', 'community' ),
				'id'   => $prefix . 'site_networks_embed',
				'type' => 'oembed',
			),
		),
	);

	$meta_boxes['site_networks_contact_metabox'] = array(
		'id'         => 'site_networks_contact_metabox',
		'title'      => __( 'Contact', 'community' ),
		'pages'      => array( 'site_networks', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => __( 'Facebook', 'community' ),
				'desc' => __( 'Facebook URL', 'community' ),
				'id'   => $prefix . 'facebookurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Twitter', 'community' ),
				'desc' => __( 'Twitter URL', 'community' ),
				'id'   => $prefix . 'twitterurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Website', 'community' ),
				'desc' => __( 'Website URL', 'community' ),
				'id'   => $prefix . 'googleplusurl',
				'type' => 'text_url',
			),
		)
	);

	// Add other metaboxes as needed

	return $meta_boxes;
}

add_action( 'init', 'community_initialize_community_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function community_initialize_community_meta_boxes() {

	if ( ! class_exists( 'community_Meta_Box' ) )
		require_once 'init.php';

}
