<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

/************* FUNCTION TO CHECK IF PLUGINS ARE ACTIVE ***************/
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/************* INCLUDE NEEDED FILES ***************/

/*
1. library/bones.php
	- head cleanup (remove rsd, uri links, junk css, ect)
	- enqueueing scripts & styles
	- theme support functions
	- custom menu output & fallbacks
	- related post function
	- page-navi function
	- removing <p> from around images
	- customizing the post excerpt
	- custom google+ integration
	- adding custom fields to user profiles
*/
require_once( 'library/bones.php' ); // if you remove this, bones will break
/*
2. library/custom-post-type.php
	- an example custom post type
	- example custom taxonomy (like categories)
	- example custom taxonomy (like tags)
*/
// require_once( 'library/custom-post-type.php' ); // you can disable this if you like
/*
3. library/admin.php
	- removing some default WordPress dashboard widgets
	- an example custom dashboard widget
	- adding custom login css
	- changing text in footer of admin
*/
// require_once( 'library/admin.php' ); // this comes turned off by default
/*
4. library/translation/translation.php
	- adding support for other languages
*/
// require_once( 'library/translation/translation.php' ); // this comes turned off by default

require_once( 'library/recent-network-posts.php' ); // Required to display recent posts
// require_once( 'customize.php' ); // Required to display recent posts

/************* REWRITE RULES FOR USE WITH NETWORK SITES PLUGIN *****************/
if ( is_plugin_active('site-networks/site_networks.php') ) { 
	include_once dirname(__FILE__) . '/rewrites.php';
}

function community_theme_customize_register( $wp_customize ) {
	
	$wp_customize->remove_section( 'background_image' );
	$wp_customize->remove_section( 'colors' );

	// SECTION
    $wp_customize->add_section(
        'community_header_section',
        array(
            'title' => 'Header',
            // 'description' => 'This is a settings section.',
            'priority' => 20,
        )
    );
    // SETTINGS
    $wp_customize->add_setting( 'community_header_image' );
	// CONTROLS
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'community_header_image',
	        array(
	            'label' => 'Image Upload',
	            'section' => 'community_header_section',
	            'settings' => 'community_header_image'
	        )
	    )
	);


	// SECTION
    $wp_customize->add_section(
        'community_social_section',
        array(
            'title' => 'Social',
            // 'description' => 'This is a settings section.',
            'priority' => 30,
        )
    );
    // SETTINGS
    $wp_customize->add_setting( 'community_site_image' );
	// CONTROLS
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'community_site_image',
	        array(
	            'label' => 'Image Upload',
	            'section' => 'community_social_section',
	            'settings' => 'community_site_image'
	        )
	    )
	);


	// SECTION
	$wp_customize->add_section(
        'footer_section',
        array(
            'title' => 'Footer',
            // 'description' => 'Footer Options.',
            'priority' => 500,
        )
    );
	// SETTINGS
	$wp_customize->add_setting(
	    'copyleft_textbox',
	    array(
	        'default' => 'Default copyleft text',
	        'sanitize_callback' => 'community_sanitize_text',
	    )
	);
	// CONTROLS
	$wp_customize->add_control(
	    'copyleft_textbox',
	    array(
	        'label' => 'Copyleft text',
	        'section' => 'footer_section',
	        'type' => 'text',
	    )
	);


}

add_action( 'customize_register', 'community_theme_customize_register' );

function community_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}


/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );
add_image_size( 'bones-thumb-150', 150, 150, true );
/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Primary', 'bonestheme' ),
		'description' => __( 'First (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget primary %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'id' => 'home-sidebar',
		'name' => __( 'Home Sidebar', 'bonestheme' ),
		'description' => __( 'A homepage widget area.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget home-sidebar %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'id' => 'footer1',
		'name' => __( 'Footer 1', 'bonestheme' ),
		'description' => __( 'First footer widget area.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget footer-widget-1 %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'id' => 'footer2',
		'name' => __( 'Footer 2', 'bonestheme' ),
		'description' => __( 'Second footer widget area.', 'bonestheme' ),
		'before_widget' => '<nav id="%1$s" class="widget footer-widget-2 %2$s">',
		'after_widget' => '</nav>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'id' => 'footer3',
		'name' => __( 'Footer 3', 'bonestheme' ),
		'description' => __( 'Third footer widget area.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget footer-widget-3 %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'id' => 'footer4',
		'name' => __( 'Footer 4', 'bonestheme' ),
		'description' => __( 'Fourth footer widget area.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget footer-widget-4 %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	/*

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!

/*********************
MENUS & NAVIGATION
*********************/

// wp menus
add_theme_support( 'menus' );

// registering wp3+ menus
register_nav_menus(
	array(
		'secondary-nav' => __( 'The Secondary Menu', 'bonestheme' ),   // secondary nav in header
		'utility-nav' => __( 'The Utility Menu', 'bonestheme' ),   // utility nav in header
	)
);

// the secondary menu
function bones_secondary_nav() {
	// display the wp3 menu if available
	wp_nav_menu(array(
		'container' => false,                           // remove nav container
		'container_class' => 'menu clearfix',           // class of container (should you choose to use it)
		'menu' => __( 'The Secondary Menu', 'bonestheme' ),  // nav name
		'menu_class' => 'nav second-nav clearfix',         // adding custom nav class
		'theme_location' => 'second-nav',                 // where it's located in the theme
		'before' => '',                                 // before the menu
		'after' => '',                                  // after the menu
		'link_before' => '',                            // before each link
		'link_after' => '',                             // after each link
		'depth' => 0                                  // limit the depth of the nav
	));
} /* end bones secondary nav */

// the utility menu
function bones_utility_nav() {
	// display the wp3 menu if available
	wp_nav_menu(array(
		'container' => false,                           // remove nav container
		'container_class' => 'menu clearfix',           // class of container (should you choose to use it)
		'menu' => __( 'Utility Menu', 'bonestheme' ),  // nav name
		'menu_class' => 'nav utility-nav clearfix',         // adding custom nav class
		'theme_location' => 'utility-nav',                 // where it's located in the theme
		'before' => '',                                 // before the menu
		'after' => '',                                  // after the menu
		'link_before' => '',                            // before each link
		'link_after' => '',                             // after each link
		'depth' => 0                                  // limit the depth of the nav
	));
} /* end bones secondary nav */

/*************************
OPTIONS FRAMEWORK FUNCTION
*************************/

if ( !function_exists( 'of_get_option' ) ) {
	function of_get_option($name, $default = false) {
		
		$optionsframework_settings = get_option('optionsframework');
		
		// Gets the unique option id
		$option_name = $optionsframework_settings['id'];
		
		if ( get_option($option_name) ) {
			$options = get_option($option_name);
		}
			
		if ( isset($options[$name]) ) {
			return $options[$name];
		} else {
			return $default;
		}
	}
}
/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
				<?php
				/*
					this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
					echo get_avatar($comment,$size='32',$default='<path_to_url>' );
				*/
				?>
				<?php // custom gravatar call ?>
				<?php
					// create variable
					$bgauthemail = get_comment_author_email();
				?>
				<img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
				<?php // end custom gravatar call ?>
				<?php printf(__( '<cite class="fn">%s</cite>', 'bonestheme' ), get_comment_author_link()) ?>
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>
				<?php edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
				<div class="alert alert-info">
					<p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
				</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
	<?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
	$form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
	<label class="screen-reader-text" for="s">' . __( 'Search for:', 'bonestheme' ) . '</label>
	<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . esc_attr__( 'Search', 'bonestheme' ) . '" />
	<button type="submit" id="searchsubmit"></button>
	</form>';
	return $form;
} // don't remove this bracket!


/************* CUSTOM METABOX *****************/

/* Location Field for Volunteer Posts */

/* Fire our meta box setup function on the post editor screen. */
add_action( 'load-post.php', 'community_post_meta_boxes_setup' );
add_action( 'load-post-new.php', 'community_post_meta_boxes_setup' );

/* Meta box setup function. */
function community_post_meta_boxes_setup() {

	/* Add meta boxes on the 'add_meta_boxes' hook. */
	add_action( 'add_meta_boxes', 'community_add_post_meta_boxes' );

	/* Save post meta on the 'save_post' hook. */
	add_action( 'save_post', 'community_save_volunteer_location_meta', 10, 2 );
}

/* Create one or more meta boxes to be displayed on the post editor screen. */
function community_add_post_meta_boxes() {

	add_meta_box(
		'community-volunteer-location',			// Unique ID
		esc_html__( 'Volunteer Location', 'example' ),		// Title
		'community_volunteer_location_meta_box',		// Callback function
		'post',					// Admin page (or post type)
		'side',					// Context
		'default'					// Priority
	);
}

/* Display the post meta box. */
function community_volunteer_location_meta_box( $object, $box ) { ?>

	<?php wp_nonce_field( basename( __FILE__ ), 'community_volunteer_location_nonce' ); ?>

	<p>
		<label for="community-volunteer-location"><?php _e( "Add a location to your volunteer posts.", 'example' ); ?></label>
		<br />
		<input class="widefat" type="text" name="community-volunteer-location" id="community-volunteer-location" value="<?php echo esc_attr( get_post_meta( $object->ID, 'community_volunteer_location', true ) ); ?>" size="30" />
	</p>
<?php }

/* Save the meta box's post metadata. */
function community_save_volunteer_location_meta( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['community_volunteer_location_nonce'] ) || !wp_verify_nonce( $_POST['community_volunteer_location_nonce'], basename( __FILE__ ) ) )
		return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	/* Get the posted data and sanitize it for use as an HTML class. */
	// $new_meta_value = ( isset( $_POST['community-volunteer-location'] ) ? sanitize_html_class( $_POST['community-volunteer-location'] ) : '' );
	$new_meta_value = $_POST['community-volunteer-location'];
	
	/* Get the meta key. */
	$meta_key = 'community_volunteer_location';

	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );

	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
}

/* Filter the post class hook with our custom post class function. */
add_filter( 'volunteer_location', 'community_volunteer_location' );

function community_volunteer_location( $locations ) {

	/* Get the current post ID. */
	$post_id = get_the_ID();

	/* If we have a post ID, proceed. */
	if ( !empty( $post_id ) ) {

		/* Get the custom post class. */
		$volunteer_location = get_post_meta( $post_id, 'community_volunteer_location', true );

		/* If a post class was input, sanitize it and add it to the post class array. */
		if ( !empty( $volunteer_location ) )
			$locations[] = sanitize_html_class( $volunteer_location );
	}

	return $locations;
}


?>
