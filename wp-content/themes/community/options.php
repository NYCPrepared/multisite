<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);

	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */

function optionsframework_options() {

	// Test data
	$default_array = array(
		'one' => __('2', 'options_check'),
		'two' => __('3', 'options_check'),
		'three' => __('4', 'options_check'),
		'four' => __('5', 'options_check'),
		'five' => __('6', 'options_check')
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'options_check'),
		'two' => __('Pancake', 'options_check'),
		'three' => __('Omelette', 'options_check'),
		'four' => __('Crepe', 'options_check'),
		'five' => __('Waffle', 'options_check')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );

	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','community_themeal' => 'community_themeal' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/library/images/options/';


	if(get_page_by_title('News')) {
		$news_page = get_page_by_title( 'News', ARRAY_A );
		$news_page = array_shift($news_page);
	} else {
		$news_page = '';
	}

	if(get_page_by_title('Events')) {
		$events_page = get_page_by_title( 'Events', ARRAY_A );
		$events_page = array_shift($events_page);
	} else {
		$events_page = '';
	}

	if(get_page_by_title('Sites')) {
		$sites_page = get_page_by_title( 'Sites', ARRAY_A );
		$sites_page = array_shift($sites_page);
	} else {
		$sites_page = '';
	}

	$options = array();

	$options[] = array(
		'name' => __('Homepage Settings', 'options_check'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Here are some options to customize the appearance of the home page.', 'options_check'),
		'type' => 'info');

	$options[] = array(
		'name' => __('First Module', 'options_check'),
		'desc' => __('Display First Module?', 'options_check'),
		'id' => 'module_1',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('First Module Heading', 'options_check'),
		'desc' => __('Enter Text to Display for Heading', 'options_check'),
		'id' => 'module_1_heading',
		'std' => 'Volunteers',
		'type' => 'text');

	$options[] = array(
		'name' => __('First Module Category', 'options_check'),
		'desc' => __('Enter Post Category Name to Display', 'options_check'),
		'id' => 'module_1_post_category',
		'std' => 'Volunteers',
		'type' => 'text',
		'class' => 'mini');

	$options[] = array(
		'name' => __('First Modules Posts', 'options_check'),
		'desc' => __('Select number of posts to display in module', 'options_check'),
		'id' => 'module_1_posts',
		'std' => 'two',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $default_array);

	$options[] = array(
		'name' => __('News Module', 'options_check'),
		'desc' => __('Display News Module?', 'options_check'),
		'id' => 'module_2',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('News Module Heading', 'options_check'),
		'desc' => __('Enter Text to Display for Heading', 'options_check'),
		'id' => 'module_2_heading',
		'std' => 'News',
		'type' => 'text');

	// $news_page = get_page_by_title( 'News' );
	$options[] = array(
		'name' => __('News Module Link', 'options_check'),
		'desc' => __('Select Page to Which the Header Should Link', 'options_check'),
		'id' => 'module_2_link',
		'type' => 'select',
		'std' => $news_page,
		'class' => 'mini',
		'options' => $options_pages);

	$options[] = array(
		'name' => __('News Module Posts', 'options_check'),
		'desc' => __('Select number of posts to display in module', 'options_check'),
		'id' => 'module_2_posts',
		'std' => 'two',
		'type' => 'radio',
		'options' => $default_array);

	$options[] = array(
		'name' => __('Events Module', 'options_check'),
		'desc' => __('Display Events Module?', 'options_check'),
		'id' => 'module_3',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Events Module Heading', 'options_check'),
		'desc' => __('Enter Text to Display for Heading', 'options_check'),
		'id' => 'module_3_heading',
		'std' => 'Events',
		'type' => 'text');

	$options[] = array(
		'name' => __('Events Module Link', 'options_check'),
		'desc' => __('Select Page to Which the Header Should Link', 'options_check'),
		'id' => 'module_3_link',
		'type' => 'select',
		'std' => $events_page,
		'class' => 'mini',
		'options' => $options_pages);

	$options[] = array(
		'name' => __('Events Module Posts', 'options_check'),
		'desc' => __('Select number of posts to display in module', 'options_check'),
		'id' => 'module_3_posts',
		'std' => 'four',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $default_array);

	$options[] = array(
		'name' => __('Sites Module', 'options_check'),
		'desc' => __('Display Sites Module?', 'options_check'),
		'id' => 'module_4',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Sites Module Heading', 'options_check'),
		'desc' => __('Enter Text to Display for Module Heading', 'options_check'),
		'id' => 'module_4_heading',
		'std' => 'Sites',
		'type' => 'text');

	$options[] = array(
		'name' => __('Sites Module Link', 'options_check'),
		'desc' => __('Select Page to Which the Header Should Link', 'options_check'),
		'id' => 'module_4_link',
		'std' => $sites_page,
		'type' => 'select',
		'class' => 'mini',
		'options' => $options_pages);

	$options[] = array(
		'name' => __('Sites Module Sites', 'options_check'),
		'desc' => __('Select number of sites to display in module', 'options_check'),
		'id' => 'module_4_posts',
		'std' => 'two',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $default_array);

	$options[] = array(
		'name' => __('Site Settings', 'options_check'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Here are some options to customize this site.', 'options_check'),
		'type' => 'info');

	$options[] = array(
		'name' => __('Site Header', 'options_check'),
		'desc' => __('Upload or select an image to display in the site header.', 'options_check'),
		'id' => 'site_banner_image',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Select a Category', 'options_check'),
		'desc' => __('Passed an array of categories with cat_ID and cat_name', 'options_check'),
		'id' => 'example_select_categories',
		'type' => 'select',
		'options' => $options_categories);

	if ( $options_tags ) {
	$options[] = array(
		'name' => __('Select a Tag', 'options_check'),
		'desc' => __('Passed an array of tags with term_id and term_name', 'options_check'),
		'id' => 'example_select_tags',
		'type' => 'select',
		'options' => $options_tags);
	}

	$options[] = array(
		'name' => __('Select a Page', 'options_check'),
		'desc' => __('Passed an array of pages with ID and post_title', 'options_check'),
		'id' => 'example_select_pages',
		'type' => 'select',
		'options' => $options_pages);


	$options[] = array(
		'name' => __('Advanced Settings', 'options_check'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Check to Show a Hidden Text Input', 'options_check'),
		'desc' => __('Click here and see what happens.', 'options_check'),
		'id' => 'example_showhidden',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Hidden Text Input', 'options_check'),
		'desc' => __('This option is hidden unless activated by a checkbox click.', 'options_check'),
		'id' => 'example_text_hidden',
		'std' => 'Hello',
		'class' => 'hidden',
		'type' => 'text');

	$options[] = array(
		'name' => __('Uploader Test', 'options_check'),
		'desc' => __('This creates a full size uploader that previews the image.', 'options_check'),
		'id' => 'example_uploader',
		'type' => 'upload');

	$options[] = array(
		'name' => "Example Image Selector",
		'desc' => "Images for layout.",
		'id' => "example_images",
		'std' => "2c-l-fixed",
		'type' => "images",
		'options' => array(
			'1col-fixed' => $imagepath . '1col.png',
			'2c-l-fixed' => $imagepath . '2cl.png',
			'2c-r-fixed' => $imagepath . '2cr.png')
	);

	$options[] = array(
		'name' =>  __('Example Background', 'options_check'),
		'desc' => __('Change the background CSS.', 'options_check'),
		'id' => 'example_background',
		'std' => $background_defaults,
		'type' => 'background' );

	$options[] = array(
		'name' => __('Multicheck', 'options_check'),
		'desc' => __('Multicheck description.', 'options_check'),
		'id' => 'example_multicheck',
		'std' => $multicheck_defaults, // These items get checked by default
		'type' => 'multicheck',
		'options' => $multicheck_array);

	$options[] = array(
		'name' => __('Colorpicker', 'options_check'),
		'desc' => __('No color selected by default.', 'options_check'),
		'id' => 'example_colorpicker',
		'std' => '',
		'type' => 'color' );

	$options[] = array( 'name' => __('Typography', 'options_check'),
		'desc' => __('Example typography.', 'options_check'),
		'id' => "example_typography",
		'std' => $typography_defaults,
		'type' => 'typography' );

	$options[] = array(
		'name' => __('Custom Typography', 'options_check'),
		'desc' => __('Custom typography options.', 'options_check'),
		'id' => "custom_typography",
		'std' => $typography_defaults,
		'type' => 'typography',
		'options' => $typography_options );

	$options[] = array(
		'name' => __('Text Editor', 'options_check'),
		'type' => 'heading' );

	/**
	 * For $settings options see:
	 * http://codex.wordpress.org/Function_Reference/wp_editor
	 *
	 * 'media_buttons' are not supported as there is no post to attach items to
	 * 'textarea_name' is set by the 'id' you choose
	 */

	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);

	$options[] = array(
		'name' => __('Default Text Editor', 'options_check'),
		'desc' => sprintf( __( 'You can also pass settings to the editor.  Read more about wp_editor in <a href="%1$s" target="_blank">the WordPress codex</a>', 'options_check' ), 'http://codex.wordpress.org/Function_Reference/wp_editor' ),
		'id' => 'example_editor',
		'type' => 'editor',
		'settings' => $wp_editor_settings );

	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'media_buttons' => true
	);

	$options[] = array(
		'name' => __('Additional Text Editor', 'options_check'),
		'desc' => sprintf( __( 'This editor includes media button.', 'options_check' ), 'http://codex.wordpress.org/Function_Reference/wp_editor' ),
		'id' => 'example_editor_media',
		'type' => 'editor',
		'settings' => $wp_editor_settings );

	return $options;
}

?>

