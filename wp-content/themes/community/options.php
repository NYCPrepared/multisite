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
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
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

	$options = array();

	$options[] = array(
		'name' => __('Homepage Settings', 'options_check'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Here are some options to customize the appearance of the home page.', 'options_check'),
		'type' => 'info');

	$options[] = array(
		'name' => __('Volunteers Module', 'options_check'),
		'desc' => __('Display Volunteers Module?', 'options_check'),
		'id' => 'module_1',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Volunteers Module Heading', 'options_check'),
		'desc' => __('Enter Text to Display for Heading', 'options_check'),
		'id' => 'module_1_heading',
		'std' => 'Volunteers',
		'type' => 'text');

	$options[] = array(
		'name' => __('Volunteers Modules Posts', 'options_check'),
		'desc' => __('Select number of posts to display in module.', 'options_check'),
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
		'id' => 'module_1_heading',
		'std' => 'News',
		'type' => 'text');

	$options[] = array(
		'name' => __('News Module Posts', 'options_check'),
		'desc' => __('Select number of posts to display in module.', 'options_check'),
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
		'name' => __('Events Module Posts', 'options_check'),
		'desc' => __('Select number of posts to display in module.', 'options_check'),
		'id' => 'module_3_posts',
		'std' => 'two',
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
		'name' => __('Sites Module Sites', 'options_check'),
		'desc' => __('Select number of sites to display in module.', 'options_check'),
		'id' => 'module_4_posts',
		'std' => 'two',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $default_array);

	$options[] = array(
		'name' => __('Input Text Mini', 'options_check'),
		'desc' => __('A mini text input field.', 'options_check'),
		'id' => 'example_text_mini',
		'std' => 'Default',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('Input Text', 'options_check'),
		'desc' => __('A text input field.', 'options_check'),
		'id' => 'example_text',
		'std' => 'Default Value',
		'type' => 'text');

	$options[] = array(
		'name' => __('Textarea', 'options_check'),
		'desc' => __('Textarea description.', 'options_check'),
		'id' => 'example_textarea',
		'std' => 'Default Text',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Input Select Small', 'options_check'),
		'desc' => __('Small Select Box.', 'options_check'),
		'id' => 'example_select',
		'std' => 'three',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $default_array);

	$options[] = array(
		'name' => __('Input Select Wide', 'options_check'),
		'desc' => __('A wider select box.', 'options_check'),
		'id' => 'example_select_wide',
		'std' => 'two',
		'type' => 'select',
		'options' => $default_array);

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
		'name' => __('Input Radio (one)', 'options_check'),
		'desc' => __('Radio select with default options "one".', 'options_check'),
		'id' => 'example_radio',
		'std' => 'one',
		'type' => 'radio',
		'options' => $default_array);

	$options[] = array(
		'name' => __('Example Info', 'options_check'),
		'desc' => __('This is just some example information you can put in the panel.', 'options_check'),
		'type' => 'info');

	$options[] = array(
		'name' => __('Input Checkbox', 'options_check'),
		'desc' => __('Example checkbox, defaults to true.', 'options_check'),
		'id' => 'example_checkbox',
		'std' => '1',
		'type' => 'checkbox');

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

/**
 * Front End Customizer
 *
 * WordPress 3.4 Required
 */

add_action( 'customize_register', 'options_theme_customizer_register' );

function options_theme_customizer_register($wp_customize) {

	/**
	 * This is optional, but if you want to reuse some of the defaults
	 * or values you already have built in the options panel, you
	 * can load them into $options for easy reference
	 */
	 
	$options = optionsframework_options();
	
	/* Basic */

	$wp_customize->add_section( 'options_theme_customizer_basic', array(
		'title' => __( 'Basic', 'options_theme_customizer' ),
		'priority' => 100
	) );
	
	$wp_customize->add_setting( 'options_theme_customizer[example_text]', array(
		'default' => $options['example_text']['std'],
		'type' => 'option'
	) );

	$wp_customize->add_control( 'options_theme_customizer_example_text', array(
		'label' => $options['example_text']['name'],
		'section' => 'options_theme_customizer_basic',
		'settings' => 'options_theme_customizer[example_text]',
		'type' => $options['example_text']['type']
	) );
	
	$wp_customize->add_setting( 'options_theme_customizer[example_select]', array(
		'default' => $options['example_select']['std'],
		'type' => 'option'
	) );

	$wp_customize->add_control( 'options_theme_customizer_example_select', array(
		'label' => $options['example_select']['name'],
		'section' => 'options_theme_customizer_basic',
		'settings' => 'options_theme_customizer[example_select]',
		'type' => $options['example_select']['type'],
		'choices' => $options['example_select']['options']
	) );
	
	$wp_customize->add_setting( 'options_theme_customizer[example_radio]', array(
		'default' => $options['example_radio']['std'],
		'type' => 'option'
	) );

	$wp_customize->add_control( 'options_theme_customizer_example_radio', array(
		'label' => $options['example_radio']['name'],
		'section' => 'options_theme_customizer_basic',
		'settings' => 'options_theme_customizer[example_radio]',
		'type' => $options['example_radio']['type'],
		'choices' => $options['example_radio']['options']
	) );
	
	$wp_customize->add_setting( 'options_theme_customizer[example_checkbox]', array(
		'default' => $options['example_checkbox']['std'],
		'type' => 'option'
	) );

	$wp_customize->add_control( 'options_theme_customizer_example_checkbox', array(
		'label' => $options['example_checkbox']['name'],
		'section' => 'options_theme_customizer_basic',
		'settings' => 'options_theme_customizer[example_checkbox]',
		'type' => $options['example_checkbox']['type']
	) );
	
	/* Extended */

	$wp_customize->add_section( 'options_theme_customizer_extended', array(
		'title' => __( 'Extended', 'options_theme_customizer' ),
		'priority' => 110
	) );
	
	$wp_customize->add_setting( 'options_theme_customizer[example_uploader]', array(
		'type' => 'option'
	) );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'example_uploader', array(
		'label' => $options['example_uploader']['name'],
		'section' => 'options_theme_customizer_extended',
		'settings' => 'options_theme_customizer[example_uploader]'
	) ) );
	
	$wp_customize->add_setting( 'options_theme_customizer[example_colorpicker]', array(
		'default' => $options['example_colorpicker']['std'],
		'type' => 'option'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
		'label'   => $options['example_colorpicker']['name'],
		'section' => 'options_theme_customizer_extended',
		'settings'   => 'options_theme_customizer[example_colorpicker]'
	) ) );
}
