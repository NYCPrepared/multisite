<?php
/**
 * Glocal Network Theme Customizer
 *
 * @package Glocal Network
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
// function glocal_network_customize_register( $wp_customize ) {
// 	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
// 	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
// 	$wp_customize->get_setting( 'nav_menu_locations' )->transport = 'postMessage';
// 	$wp_customize->get_setting( 'community_options' )->transport = 'postMessage';
// }
// add_action( 'customize_register', 'glocal_network_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
// function glocal_network_customize_preview_js() {
// 	wp_enqueue_script( 'glocal_network_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
// }
// add_action( 'customize_preview_init', 'glocal_network_customize_preview_js' );



// Check that WP_Customize_Control exists

if ( class_exists( 'WP_Customize_Control' ) ) {


	/**
	 * Multiple select customize control class.
	 */
	class WP_Customize_Multiple_Select_Control extends WP_Customize_Control {

		/**
		* The type of customize control being rendered.
		*/
	    public $type = 'multiple-select';

	    /**
	     * Displays the multiple select on the customize screen.
	     */
	    public function render_content() {

	    if ( empty( $this->choices ) )
	        return;
	    ?>
	        <label>
	            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	            <select <?php $this->link(); ?> multiple="multiple" style="height: 100%;">
	                <?php
	                    foreach ( $this->choices as $value => $label ) {
	                        $selected = ( in_array( $value, $this->value() ) ) ? selected( 1, 1, false ) : '';
	                        echo '<option value="' . esc_attr( $value ) . '"' . $selected . '>' . $label . '</option>';
	                    }
	                ?>
	            </select>
	        </label>
	    <?php }
	}


	/**
	 * NARGA Category Drop Down List Class
	 *
	 * modified dropdown-pages from wp-includes/class-wp-customize-control.php
	 *
	 * @since NARGA v1.0
	 */

	class WP_Customize_Dropdown_Categories_Control extends WP_Customize_Control {

		/**
		* The type of customize control being rendered.
		*/
	    public $type = 'dropdown-categories';	
	 
	    public function render_content() {
	        $dropdown = wp_dropdown_categories( 
	            array( 
	                'name'             => '_customize-dropdown-categories-' . $this->id,
	                'echo'             => 0,
	                'hide_empty'       => true, // Only show categories that have posts associated
	                'show_option_none' => '&mdash; ' . __('Select', 'community') . ' &mdash;',
	                'hide_if_empty'    => false,
	                'selected'         => $this->value(),
	            )
	        );
	 
	        $dropdown = str_replace('<select', '<select ' . $this->get_link(), $dropdown );
	 
	        printf( 
	            '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
	            $this->label,
	            $dropdown
	        );
	    }
	}
}


// Customization Functions

function glocal_customize_register( $wp_customize ) {

	// if(function_exists('glocal_home_category')) {
	// 	$postcategory = glocal_home_category();
	// }

	// Post Category Drop-down

	$categories = get_categories();
	$cats = array();
	$i = 0;
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cats[$category->slug] = $category->name;
	}

	/**
	* Panels & Sections
	*/

	// Panel
	$wp_customize->add_panel( 'home_panel', array(
		// 'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __( 'Front Page', 'community' ),
		'description'    => __( 'Customize the display of the homepage', 'community' ),
	) );

	// Section - Select Modules
	$wp_customize->add_section( 'home_modules' , array(
		'title'      => __( 'Modules', 'community' ),
		'description'    => __( 'Select the content modules to display on the home page.', 'community' ),
		'priority'   => 10,
		'panel'  => 'home_panel',
	) );

	// Section - Updates
	$wp_customize->add_section( 'home_updates' , array(
		'title'      => __( 'Updates', 'community' ),
		'priority'   => 20,
		'panel'  => 'home_panel',
	) );

	// Section - Posts
	$wp_customize->add_section( 'home_posts' , array(
		'title'      => __( 'Posts', 'community' ),
		'priority'   => 30,
		'panel'  => 'home_panel',
	) );

	// Section - Events
	$wp_customize->add_section( 'home_events' , array(
		'title'      => __( 'Events', 'community' ),
		'priority'   => 40,
		'panel'  => 'home_panel',
	) );

	// Section - Sites
	$wp_customize->add_section( 'home_sites' , array(
		'title'      => __( 'Sites', 'community' ),
		'priority'   => 50,
		'panel'  => 'home_panel',
	) );


	/**
	* Settings & Controls
	*/

	// Homepage Modules
	$wp_customize->add_setting( 'community_options[modules]', array(
		'default' => array(),
		'type'           => 'option',
	) );

	$wp_customize->add_control(
		new WP_Customize_Multiple_Select_Control(
			$wp_customize,
			'glocal_home_modules',
			array(
				'settings' => 'community_options[modules]',
				'label'    => __( 'Homepage Modules', 'community' ),
				'section'  => 'home_modules',
				'type'     => 'multiple-select', // The $type in our class
				'choices'  => array(
					'updates' => __('Updates', 'community'),
					'posts' => __('Posts', 'community'),
					'events' => __('Events', 'community'),
					'sites' => __('Sites', 'community'),
				),
				'priority' => 20,
			)
		)
	);

	/**
	* Posts
	*/
 
	// Posts - Categories
	// Setting
	$wp_customize->add_setting('community_options[posts][featured_category]', array(
		'default'        => $default,
		'type'           => 'option',
	));

	// Control
	$wp_customize->add_control( 
		new WP_Customize_Multiple_Select_Control(
			$wp_customize,
			'glocal_featured_category', array(
			'settings' => 'community_options[posts][featured_category]',
			'label'   => __('Categorie(s)', 'community'),
			'section'  => 'home_posts',
			'type'    => 'multiple-select',
			'choices' => $cats,
			'priority' => 10,
			)
		)
	);

	// Posts - Heading
    $wp_customize->add_setting('community_options[posts][posts_heading]', array(
        'default'        => __('Posts', 'community'),
        // 'capability'     => 'manage_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('glocal_post_heading', array(
        'label'      => __('Heading', 'community'),
        'section'    => 'home_posts',
        'settings'   => 'community_options[posts][posts_heading]',
        'type' => 'text',
        'priority' => 20,
		'input_attrs' => array(
			'placeholder'   => __('Enter a heading for the posts list', 'community'),
		)
    ));

	// Posts - Heading Link
	$wp_customize->add_setting('community_options[posts][posts_heading_link]', array(
		'default'        => '',
		// 'capability'     => 'manage_options',
		'type'           => 'option',
		)
	);

	$wp_customize->add_control('glocal_posts_heading_link', array(
		'label'      => __('Heading Link', 'community'),
		'section'    => 'home_posts',
		'settings'   => 'community_options[posts][posts_heading_link]',
		'type' => 'url',
		'priority' => 21,
		'input_attrs' => array(
			'placeholder'   => __('Enter a URL or path', 'community'),
			)
		)
	);

	// Posts - Number
    $wp_customize->add_setting('community_options[posts][number_posts]', array(
        'default'        => '10',
        // 'capability'     => 'manage_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('glocal_post_number', array(
        'label'      => __('Number of Posts', 'community'),
        'section'    => 'home_posts',
        'settings'   => 'community_options[posts][number_posts]',
        'type' => 'number',
        'priority' => 22,
		'input_attrs' => array(
			'min'   => 1,
			'max'   => 20,
			'placeholder'   => __('Min: 1, Max: 20', 'community'),
		)
    ));

	/**
	* Updates
	*/

    // Updates - Categories
	// Setting
	$wp_customize->add_setting('community_options[updates][featured_category]', array(
		'default'        => $default,
		'type'           => 'option',
	));

	// Control
	$wp_customize->add_control( 
		new WP_Customize_Multiple_Select_Control(
			$wp_customize,
			'glocal_featured_category', array(
			'settings' => 'community_options[updates][featured_category]',
			'label'   => __('Categorie(s)', 'community'),
			'section'  => 'home_updates',
			'type'    => 'multiple-select',
			'choices' => $cats,
			'priority' => 10,
			)
		)
	);

	// Updates - Heading
    $wp_customize->add_setting('community_options[updates][updates_heading]', array(
        'default'        => __('Updates', 'community'),
        // 'capability'     => 'manage_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('glocal_update_heading', array(
        'label'      => __('Heading', 'community'),
        'section'    => 'home_updates',
        'settings'   => 'community_options[updates][updates_heading]',
        'type' => 'text',
        'priority' => 20,
		'input_attrs' => array(
			'placeholder'   => __('Enter a heading for the updates list', 'community'),
		)
    ));

	// Updates - Heading Link
	$wp_customize->add_setting('community_options[updates][updates_heading_link]', array(
		'default'        => '',
		// 'capability'     => 'manage_options',
		'type'           => 'option',
		)
	);

	$wp_customize->add_control('glocal_updates_heading_link', array(
		'label'      => __('Heading Link', 'community'),
		'section'    => 'home_updates',
		'settings'   => 'community_options[updates][updates_heading_link]',
		'type' => 'url',
		'priority' => 21,
		'input_attrs' => array(
			'placeholder'   => __('Enter a URL or path', 'community'),
			)
		)
	);

	// Updates - Number
    $wp_customize->add_setting('community_options[updates][number_updates]', array(
        'default'        => '10',
        // 'capability'     => 'manage_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('glocal_update_number', array(
        'label'      => __('Number of Updates', 'community'),
        'section'    => 'home_updates',
        'settings'   => 'community_options[updates][number_updates]',
        'type' => 'number',
        'priority' => 22,
		'input_attrs' => array(
			'min'   => 1,
			'max'   => 20,
			'placeholder'   => __('Min: 1, Max: 20', 'community'),
		)
    ));

	/**
	* Events
	*/

	// Events - Heading
    $wp_customize->add_setting('community_options[events][events_heading]', array(
        'default'        => __('Events', 'community'),
        // 'capability'     => 'manage_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('glocal_events_heading', array(
        'label'      => __('Heading', 'community'),
        'section'    => 'home_events',
        'settings'   => 'community_options[events][events_heading]',
        'type' => 'text',
        'priority' => 20,
		'input_attrs' => array(
			'placeholder'   => __('Enter a heading for the events list', 'community'),
		)
     ));

	// Events - Heading Link
	$wp_customize->add_setting('community_options[events][events_heading_link]', array(
		'default'        => '',
		// 'capability'     => 'manage_options',
		'type'           => 'option',
		)
	);

	$wp_customize->add_control('glocal_events_heading_link', array(
		'label'      => __('Heading Link', 'community'),
		'section'    => 'home_events',
		'settings'   => 'community_options[events][events_heading_link]',
		'type' => 'url',
		'priority' => 21,
		'input_attrs' => array(
			'placeholder'   => __('Enter a URL or path', 'community'),
			)
		)
	);

	// Events - Number
    $wp_customize->add_setting('community_options[events][number_events]', array(
        'default'        => '10',
        // 'capability'     => 'manage_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('glocal_events_number', array(
        'label'      => __('Number of Events', 'community'),
        'section'    => 'home_events',
        'settings'   => 'community_options[events][number_events]',
        'type' => 'number',
        'priority' => 22,
		'input_attrs' => array(
			'min'   => 1,
			'max'   => 20,
			'placeholder'   => __('Min: 1, Max: 20', 'community'),
		)
    ));

	/**
	* Sites
	*/

	// Sites - Heading
    $wp_customize->add_setting('community_options[sites][sites_heading]', array(
        'default'        => __('Sites', 'community'),
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('glocal_sites_heading', array(
        'label'      => __('Heading', 'community'),
        'section'    => 'home_sites',
        'settings'   => 'community_options[sites][sites_heading]',
        'type' => 'text',
        'priority' => 20,
		'input_attrs' => array(
			'placeholder'   => __('Enter a heading for the sites list', 'community'),
		)
     ));

	// Sites - Heading Link
	$wp_customize->add_setting('community_options[sites][sites_heading_link]', array(
		'default'        => '',
		// 'capability'     => 'manage_options',
		'type'           => 'option',
		)
	);

	$wp_customize->add_control('glocal_sites_heading_link', array(
		'label'      => __('Heading Link', 'community'),
		'section'    => 'home_sites',
		'settings'   => 'community_options[sites][sites_heading_link]',
		'type' => 'url',
		'priority' => 21,
		'input_attrs' => array(
			'placeholder'   => __('Enter a URL or path', 'community'),
			)
		)
	);

	// Sites - Number
    $wp_customize->add_setting('community_options[sites][number_sites]', array(
        'default'        => '8',
        // 'capability'     => 'manage_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('glocal_sites_number', array(
        'label'      => __('Number of Sites', 'community'),
        'section'    => 'home_sites',
        'settings'   => 'community_options[sites][number_sites]',
        'type' => 'number',
        'priority' => 22,
		'input_attrs' => array(
			'min'   => 1,
			'max'   => 20,
			'placeholder'   => __('Min: 1, Max: 20', 'community'),
		)
    ));

	// Look & Feel - To be implemented later

}
add_action( 'customize_register', 'glocal_customize_register' );

// Return nice array of customization options

function glocal_customation_settings() {
	$glocal_home_settings = get_option('community_options');

	if (!empty($glocal_home_settings)) {
		foreach ($glocal_home_settings as $key => $option)
			$home_options[$key] = $option;
	}
	return $home_options;
}

