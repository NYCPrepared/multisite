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

// require_once( 'library/metaboxes/community-custom-metaboxes.php' );


include_once( 'library/network-posts3.php' );


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
ADD THEME SUPPORT
*************************/

if ( ! function_exists('community_theme_features') ) {

// Register Theme Features
function community_theme_features()  {

	// Add theme support for Post Formats
	$formats = array( 'gallery', 'image', 'video', 'link', 'aside', );
	add_theme_support( 'post-formats', $formats );	

	// Add theme support for Semantic Markup
	$markup = array( 'search-form', );
	add_theme_support( 'html5', $markup );	

	// Add theme support for Translation
	load_theme_textdomain( 'community', get_template_directory() . '/library/language' );	
}

// Hook into the 'after_setup_theme' action
add_action( 'after_setup_theme', 'community_theme_features' );

}

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


/**************************
SITE NETWORKS CONTENT TYPE
**************************/

if ( ! function_exists('site_networks') ) {

// Register Custom Post Type
function site_networks() {

	$labels = array(
		'name'                => _x( 'Site Networks', 'Post Type General Name', 'site_networks' ),
		'singular_name'       => _x( 'Site Network', 'Post Type Singular Name', 'site_networks' ),
		'menu_name'           => __( 'Networks', 'site_networks' ),
		'parent_item_colon'   => __( 'Parent Item:', 'site_networks' ),
		'all_items'           => __( 'All Networks', 'site_networks' ),
		'view_item'           => __( 'View Network', 'site_networks' ),
		'add_new_item'        => __( 'Add New Network', 'site_networks' ),
		'add_new'             => __( 'Add New', 'site_networks' ),
		'edit_item'           => __( 'Edit Network', 'site_networks' ),
		'update_item'         => __( 'Update Network', 'site_networks' ),
		'search_items'        => __( 'Search Network', 'site_networks' ),
		'not_found'           => __( 'Not found', 'site_networks' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'site_networks' ),
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
		'label'               => __( 'site_networks', 'site_networks' ),
		'description'         => __( 'Post type that collects MS sites into network groupings', 'site_networks' ),
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
	register_post_type( 'site_networks', $args );

}

// Hook into the 'init' action
add_action( 'init', 'site_networks', 0 );

}


/**************************
SITE NETWORKS METABOXES
**************************/

require_once 'library/metaboxes/metabox-functions.php';




?>
