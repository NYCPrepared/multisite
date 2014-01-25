<?php
/*
Plugin Name: Blog Locations Locations with Posts Widget
Plugin URI: 
Description: Adds a sidebar widget to display Blog's Location and/or Recent Posts
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

class cets_bl_locations_with_posts extends WP_Widget{
	/** constructor **/
	function cets_bl_locations_with_posts() {
		parent::WP_Widget(false, $name = 'Blog Locations - With Posts');
		
		// this widget requires the cets_blog_locations plugin
		if ( !class_exists('cets_blog_locations') )
		return;
	}
	
	/** This function displays the output of the widget **/
    function widget($args, $instance) {	
		global $current_site;	
        extract( $args );
        $options = $instance;
		$title = empty($options['title']) ? __('Locations') : apply_filters('widget_title', $options['title']);
		$defaults = array(
			'title' => 'Latest Posts', 'postrows' => 5, 'exclude' => array()
		);
		
		
		$args = wp_parse_args( $options, $defaults );
		
		
		if (!is_numeric($args['postrows'])){
			$args['postrows'] = $defaults['postrows'];
			}
		
		
		// get the locations
		$locations = cets_get_used_locations();
		
			
		echo $before_widget;
		echo $before_title . $args['title'] . $after_title;
		foreach($locations as $location) {
					if (!in_array($location->id, $args['exclude'])){ //is not in the array of excluded ones
						echo("<div class='locationListing " . $location->slug . "'>");
						echo ("<h3><a href='location/" . strtolower($location->slug) . "'>" . $location->location_name . "</a></h3>");
						echo ("<ul>");
						echo (cets_get_recent_posts_from_location_id_html($location->id, $args['postrows'], 0));
						echo ("</ul>");
						echo ("<div class='locationMore'>");
						echo ("<a href='/location/" . strtolower($location->slug) . "'>(More " . $location->slug . " Posts</a> | <a href='/sites/" . strtolower($location->slug) . "'>All " . $location->slug . " Sites)</a>");
						echo ("</div>");
						echo ("</div>");
				
					}// end if
				}
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
		
		$instance['exclude'] = strip_tags($new_instance['exclude']);

		
					
        return $new_instance;
    }


	/** This function creates the form **/
	/** @see WP_Widget::form */
    function form($instance) {				
        // Get the list of used locations
		$locations = cets_get_used_locations();
		
		// Set defaults
		$defaults = array(
			'title' => 'Latest Posts', 'postrows' => 5, 'exclude' => array()
			);
			
		$title = esc_attr($instance['title']);
		$postrows = esc_attr($instance['postrows'] );
		$exclude = $instance['exclude'] ;
		if (!is_numeric($postrows)) $postrows = $defaults['postrows'];
		
		if (! is_array($exclude)) $exclude = array();
		
		
		
	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('postrows'); ?>"><?php _e('# of Posts to Include:'); ?> <input size="5" id="<?php echo $this->get_field_id('postrows'); ?>" name="<?php echo $this->get_field_name('postrows'); ?>" type="text" value="<?php echo $postrows; ?>" /></label></p>
		

	<p><label for="<?php echo $this->get_field_id('exclude'); ?>"><?php _e('Exclude these blogs:') ?><br/>
	<?php foreach ($locations as $location){ ?>
	<input type="checkbox" name="<?php echo ( 'widget-' . $this->id_base . '[' . $this->number . '][exclude][]'); ?>" id="<?php echo $this->get_field_id('exclude'. '_$location->id') ; ?>" value="<?php echo $location->id; ?>" <?php if (in_array($location->id, $exclude)) { echo 'checked="checked"';}?> > <?php echo $location->location_name; ?> <br/> 
	
	
	<?php } ?>
	</label>
			
		
	<?php
		
    }

	
	
} // End of class


// register cets_tag_cloud widget
add_action('widgets_init', create_function('', 'return register_widget("cets_bl_locations_with_posts");'));










?>
