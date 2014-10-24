<?php

/************* CUSTOM WIDGET FOR DISPLAYING SOCIAL LINKS ***************/

class glocal_social_plugin extends WP_Widget {

	// constructor
	function glocal_social_plugin() {
		parent::WP_Widget(false, $name = __('Social Links Widget', 'glocal-network') );
	}

	// widget form creation
	function form($instance) {

	// Check values
	if( $instance) {
		$title = esc_attr($instance['title']);

		$email = esc_attr($instance['email']);
		$twitter = esc_attr($instance['twitter']);
		$facebook = esc_attr($instance['facebook']);
		$github = esc_attr($instance['github']);
		$reddit = esc_attr($instance['reddit']);
		$rss = esc_attr($instance['rss']);
		$othername = esc_attr($instance['othername']);
		$otherlink = esc_attr($instance['otherlink']);
	} else {
		$title = '';

		$email = '';
		$twitter = '';
		$facebook = '';
		$reddit = '';
		$rss = '';
		$othername = '';
		$otherlink = '';
	}
	?>

	<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'glocal-social-widget'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	</p>

	<!-- Social Links -->
	<p>
	<label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Email:', 'glocal-social-widget'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" placeholder="user@email.com" type="text" value="<?php echo $email; ?>" />
	</p>
	<p>
	<label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter:', 'glocal-social-widget'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" placeholder="http://twitter.com/YOURTWITTERNAME" type="text" value="<?php echo $twiter; ?>" />
	</p>
	<p>
	<label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook:', 'glocal-social-widget'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" placeholder="http://facebook.com/FACEBOOKNAME" type="text" value="<?php echo $facebook; ?>" />
	</p>
	<p>
	<label for="<?php echo $this->get_field_id('github'); ?>"><?php _e('Github:', 'glocal-social-widget'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('github'); ?>" name="<?php echo $this->get_field_name('github'); ?>" placeholder="https://github.com/GITHUBNAME" type="text" value="<?php echo $github; ?>" />
	</p>
	<label for="<?php echo $this->get_field_id('reddit'); ?>"><?php _e('Reddit:', 'glocal-social-widget'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('reddit'); ?>" name="<?php echo $this->get_field_name('reddit'); ?>" placeholder="http://www.reddit.com/user/REDDITNAME/.rss" type="text" value="<?php echo $reddit; ?>" />
	</p>
	<label for="<?php echo $this->get_field_id('rss'); ?>"><?php _e('RSS:', 'glocal-social-widget'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('rss'); ?>" name="<?php echo $this->get_field_name('rss'); ?>" placeholder="<?php bloginfo('rss2_url'); ?>" type="text" value="<?php echo $rss; ?>" />
	</p>
	<label for="<?php echo $this->get_field_id('othername'); ?>"><?php _e('Other:', 'glocal-social-widget'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('othername'); ?>" name="<?php echo $this->get_field_name('othername'); ?>" placeholder="Social Network Name" type="text" value="<?php echo $othername; ?>" />
		<input class="widefat" id="<?php echo $this->get_field_id('otherlink'); ?>" name="<?php echo $this->get_field_name('otherlink'); ?>" placeholder="http://socialnetwork.com/USERNAME" type="text" value="<?php echo $otherlink; ?>" />
	</p>
	<?php
	}

	// update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		// Fields
		$instance['title'] = strip_tags($new_instance['title']);

		$instance['email'] = strip_tags($new_instance['email']);
		$instance['twitter'] = strip_tags($new_instance['twitter']);
		$instance['facebook'] = strip_tags($new_instance['facebook']);
		$instance['github'] = strip_tags($new_instance['github']);
		$instance['reddit'] = strip_tags($new_instance['reddit']);
		$instance['rss'] = strip_tags($new_instance['rss']);
		$instance['othername'] = strip_tags($new_instance['othername']);
		$instance['otherlink'] = strip_tags($new_instance['otherlink']);
	return $instance;
	}

	// display widget
	function widget($args, $instance) {
		extract( $args );
		// these are the widget options
		$title = apply_filters('widget_title', $instance['title']);

		$email = esc_attr($instance['email']);
		$twitter = esc_attr($instance['twitter']);
		$facebook = esc_attr($instance['facebook']);
		$github = esc_attr($instance['github']);
		$reddit = esc_attr($instance['reddit']);
		$rss = esc_attr($instance['rss']);
		$othername = esc_attr($instance['othername']);
		$otherlink = esc_attr($instance['otherlink']);

	   echo $before_widget;
	   // Display the widget
	   echo '<ul class="nav-social" id="social-group">';

		// Check if title is set
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		// Check if email is set
		if( $email ) {
			echo '<li class="email"><a href="mailto:' . $email . '" name="email"></a></li>';
		}
		// Check if github is set
		if( $github) {
			echo '<li class="github"><a href="' . $github . '" name="github" target="_blank"></a></li>';
		}
		// Check if twitter is set
		if( $twitter ) {
			echo '<li class="twitter"><a href="' . $twitter . '" name="twitter" target="_blank"></a></li>';
		}
		// Check if facebook is set
		if( $facebook ) {
			echo '<li class="facebook"><a href="' . $facebook . '" name="facebook" target="_blank"></a></li>';
		}
		// Check if other is set
		if( $otherlink ) {
			echo '<li class="network"><a href="' . $otherlink . '" name="' . $othername . '" target="_blank"></a></li>';
		}
		// Check if rss is set
		if( $rss ) {
			echo '<li class="rss"><a href="' . $rss . '" name="rss" target="_blank"></a></li>';
		} else {
			echo '<li class="rss"><a href="';
			bloginfo('rss2_url');
			echo '" name="rss"></a></li>';
		}

		echo '</ul>';
		echo $after_widget;
	}
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("glocal_social_plugin");'));


/************* Get Global Navigation from Site 1 *****************/

function community_navigation() {

	//store the current blog_id being viewed
	global $blog_id;
	$current_blog_id = $blog_id;

	//switch to the main blog which will have an id of 1
	switch_to_blog(1);

	//output the WordPress navigation menu
	$community_nav = bones_main_nav();

	//switch back to the current blog being viewed
	switch_to_blog($current_blog_id);

	return $community_nav;
}

/************* Get Custom Header Images from Other Sites *****************/

function community_get_site_image($site_id) {
	//store the current blog_id being viewed
	global $blog_id;
	$current_blog_id = $blog_id;

	//switch to the main blog designated in $site_id
	switch_to_blog($site_id);

	$site_image = get_custom_header();

	//switch back to the current blog being viewed
	switch_to_blog($current_blog_id);

	return $site_image->thumbnail_url;
}

/************* Add Slug to Body Class *****************/

// Add specific CSS class by filter
add_filter('body_class','community_class_names');
function community_class_names($classes) {
	// add 'class-name' to the $classes array
	global $post; 
	$post_slug_class = $post->post_name; 
	$classes[] = $post_slug_class . ' page-' . $post_slug_class;
	// return the $classes array
	return $classes;
}

/************* Custom Excerpt *****************/

function get_excerpt_by_id($post_id, $length='55', $trailer=' ...') {
	$the_post = get_post($post_id); //Gets post ID
	$the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
	$excerpt_length = $length; //Sets excerpt length by word count
	$the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
	$words = explode(' ', $the_excerpt, $excerpt_length + 1);

	if(count($words) > $excerpt_length) :
		array_pop($words);
		$trailer = '<a href="' . get_permalink($post_id) . '">' . $trailer . '</a>';
		array_push($words, $trailer);
		$the_excerpt = implode(' ', $words);
	endif;
	// $the_excerpt = '<p>' . $the_excerpt . '</p>';
	return $the_excerpt;
}



// Return the category name selected in theme customization
function community_home_category() {
	$homecategory = get_option("community_options");
	$homeheading = get_option("post_heading");
	if (!empty($homecategory)) {
	    foreach ($homecategory as $key => $option)
	        $options[$key] = $option;
	    	$categoryname = get_cat_name($option);
	}
	return $categoryname;
	return $homeheading;
}

// Return the header entered in theme customization
function community_home_header() {
	$homeheading = get_option("post_heading", "Lastest");
	return $homeheading;
}

// Hack to fix title on static homepage
add_filter( 'wp_title', 'community_hack_wp_title_for_home' );

function community_hack_wp_title_for_home( $title ) {
  if( empty( $title ) && ( is_home() || is_front_page() ) ) {
    return __( 'Home', 'community' ) . ' | ';
  }
  return $title;
}

// Remove unused menus
add_action( 'after_setup_theme', 'remove_theme_customization_community', 20); 

function remove_theme_customization_community() {

	unregister_nav_menu( 'secondary-nav' );
	unregister_nav_menu( 'utility-nav' );
	unregister_nav_menu( 'footer-links' );

}

/************* FEATURED IMAGE PREVIEW IN ADMIN ********************/

// add_theme_support( 'post-thumbnails' ); // theme should support
function community_add_post_thumbnail_column( $cols ) { // add the thumb column
  // output feature thumb in the end
  //$cols['community_post_thumb'] = __( 'Featured image', 'community' );
  //return $cols;
  // output feature thumb in a different column position
  $cols_start = array_slice( $cols, 0, 2, true );
  $cols_end   = array_slice( $cols, 2, null, true );
  $custom_cols = array_merge(
    $cols_start,
    array( 'community_post_thumb' => __( 'Featured image', 'community' ) ),
    $cols_end
  );
  return $custom_cols;
}
add_filter( 'manage_posts_columns', 'community_add_post_thumbnail_column', 5 ); // add the thumb column to posts
add_filter( 'manage_pages_columns', 'community_add_post_thumbnail_column', 5 ); // add the thumb column to pages

function community_display_post_thumbnail_column( $col, $id ) { // output featured image thumbnail
  switch( $col ){
    case 'community_post_thumb':
      if( function_exists( 'the_post_thumbnail' ) ) {
        echo the_post_thumbnail( 'thumbnail' );
      } else {
        echo __( 'Not supported in theme', 'community' );
      }
      break;
  }
}
add_action( 'manage_posts_custom_column', 'community_display_post_thumbnail_column', 5, 2 ); // add the thumb to posts
add_action( 'manage_pages_custom_column', 'community_display_post_thumbnail_column', 5, 2 ); // add the thumb to pages


// Disable Update Plugins Messages in the Dashboard
// http://www.wpoptimus.com/626/7-ways-disable-update-wordpress-notifications/
// Plugins should be managed via git
// remove_action('load-update-core.php','wp_update_plugins');
// add_filter('pre_site_transient_update_plugins','__return_null');

?>