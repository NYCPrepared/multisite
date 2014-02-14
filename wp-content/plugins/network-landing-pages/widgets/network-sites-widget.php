<?php
/*
Plugin Name: Network Sites Widget
Description: Lists sites that are part of a Network grouping.
Version: 1
Author: Pea, Glocal
Author URI: http://glocal.coop
Text Domain: network-landing-pages
*/


/**************************
NETWORKS SITES LIST WIDGET
**************************/

class Network_Sites_Widget extends WP_Widget {
  function Network_Sites_Widget(){
  	$widget_ops = array(
  		'classname'=>'Network_Sites_Widget',
  		'description'=>'Display list of sites associated with a network'
  		);
    $this->WP_Widget('Network_Sites_Widget','Network Sites',$widget_ops);
  }

  function form($instance){
  	$instance = wp_parse_args((array)$instance,array('title'=>''));
    $title = $instance['title'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title:<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>"/></label></p>
<?php
  }

  function update($new_instance,$old_instance){
  	$instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }

  function widget($args,$instance){
	extract($args, EXTR_SKIP);

	$post_id = get_the_ID();
    $sites = get_post_meta($post_id, 'community_network_sites');
    // var_dump($sites);

    if(!empty($sites)) {
 
	    echo $before_widget;
	    $title = empty($instance['title']) ? '': apply_filters('widget_title',$instance['title']);
	 
	    if(!empty($title))
			echo $before_title . $title . $after_title;
			echo '<ul class="network-sites">';
			foreach ($sites as $site) {
			  $blog_details = get_blog_details($site);
			  echo '<li class="blog-' . $site . '">';
			  echo '<a href="' . $blog_details->siteurl . '">';
			  echo $blog_details->blogname;
			  echo '</a>';
			  echo '</li>';
			}
			echo '</ul>';
		 
		    echo $after_widget;   
	}

  }
}
add_action('widgets_init',create_function('','return register_widget("Network_Sites_Widget");'));

?>