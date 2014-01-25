<?php
/*
Plugin Name: Blog Topics Featured Topic with Posts Widget
Plugin URI: 
Description: Adds a sidebar widget to display Blog's Topic and/or Recent Posts
Version: 1.0
Author: Deanna Schneider
Copyright:

    Copyright 2009 CETS

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111_1307  USA

*/

class cets_bt_featured_topic_with_posts extends WP_Widget{
	/** constructor **/
	function cets_bt_featured_topic_with_posts() {
		parent::WP_Widget(false, $name = 'Blog Topics - Featured Topic With Posts');
		
		// this widget requires the cets_blog_topics plugin
		if ( !class_exists('cets_blog_topics') )
		return;
	}
	
	/** This function displays the output of the widget **/
    function widget($args, $instance) {	
		global $current_site;	
        extract( $args );
        $options = $instance;
		$title = empty($options['title']) ? __('Topics') : apply_filters('widget_title', $options['title']);
		$defaults = array(
			'title' => 'Latest Posts', 'postrows' => 5
		);
		
		
		$args = wp_parse_args( $options, $defaults );
		
		
		if (!is_numeric($args['postrows'])){
			$args['postrows'] = $defaults['postrows'];
			}
		
		
		// get the featured topic
		$topic = cets_get_featured_topic();
		
			
		echo $before_widget;
		echo $before_title . $args['title'] . $after_title;
		
		echo("<div class='topicListing " . $topic->slug . "'>");
		echo ("<h3><a href='topic/" . strtolower($topic->slug) . "'>" . $topic->topic_name . "</a></h3>");
		echo ("<ul>");
		echo (cets_get_recent_posts_from_topic_id_html($topic, $args['postrows'], 0));
		echo ("</ul>");
		echo ("<div class='topicMore'>");
		echo ("<a href='/topic/" . strtolower($topic->slug) . "'>(More " . $topic->slug . " Posts</a> | <a href='/sites/" . strtolower($topic->slug) . "'>All " . $topic->slug . " Sites)</a>");
		echo ("</div>");
		echo ("</div>");
				
		echo $after_widget;
		
    }
	
	/** This function handles the updating **/
	 /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {	
		$instance = $old_instance;
		
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		if (is_numeric($new_instance['postrows'])){
			$instance['postrows'] = $new_instance['postrows'];
		}
		else {
			$instance['postrows'] = 5;
		}
		

		
					
        return $new_instance;
    }


	/** This function creates the form **/
	/** @see WP_Widget::form */
    function form($instance) {				
        // Get the featured topic name
		$topic = cets_get_featured_topic_name();
		
		// Set defaults
		$defaults = array(
			'title' => $topic, 'postrows' => 5
			);
			
		$title = esc_attr($instance['title']);
		$postrows = esc_attr($instance['postrows'] );
		if (!is_numeric($postrows)) $postrows = $defaults['postrows'];
		
		
		
	?>
	
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('postrows'); ?>"><?php _e('# of Posts to Include:'); ?> <input size="5" id="<?php echo $this->get_field_id('postrows'); ?>" name="<?php echo $this->get_field_name('postrows'); ?>" type="text" value="<?php echo $postrows; ?>" /></label></p>
					
	<?php
		
    }

	
	
} // End of class


// register cets_tag_cloud widget
add_action('widgets_init', create_function('', 'return register_widget("cets_bt_featured_topic_with_posts");'));










?>
