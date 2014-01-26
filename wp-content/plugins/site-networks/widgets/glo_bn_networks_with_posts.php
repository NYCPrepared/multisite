<?php
/*
Plugin Name: Site Networks Networks with Posts Widget
Plugin URI: 
Description: Adds a sidebar widget to display Blog's Network and/or Recent Posts
Version: 1.0
Author: Deanna Schneider
Text Domain: site-networks


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

class glo_bn_networks_with_posts extends WP_Widget{
	/** constructor **/
	function glo_bn_networks_with_posts() {
		parent::WP_Widget(false, $name = 'Site Networks - With Posts');
		
		// this widget requires the glo_blog_networks plugin
		if ( !class_exists('glo_blog_networks') )
		return;
	}
	
	/** This function displays the output of the widget **/
    function widget($args, $instance) {	
		global $current_site;	
        extract( $args );
        $options = $instance;
		$title = empty($options['title']) ? __('Networks') : apply_filters('widget_title', $options['title']);
		$defaults = array(
			'title' => 'Latest Posts', 'postrows' => 5, 'exclude' => array()
		);
		
		
		$args = wp_parse_args( $options, $defaults );
		
		
		if (!is_numeric($args['postrows'])){
			$args['postrows'] = $defaults['postrows'];
			}
		
		
		// get the networks
		$networks = glo_get_used_networks();
		
			
		echo $before_widget;
		echo $before_title . $args['title'] . $after_title;
		foreach($networks as $network) {
					if (!in_array($network->id, $args['exclude'])){ //is not in the array of excluded ones
						echo("<div class='networkListing " . $network->slug . "'>");
						echo ("<h3><a href='network/" . strtolower($network->slug) . "'>" . $network->network_name . "</a></h3>");
						echo ("<ul>");
						echo (glo_get_recent_posts_from_network_id_html($network->id, $args['postrows'], 0));
						echo ("</ul>");
						echo ("<div class='networkMore'>");
						echo ("<a href='/network/" . strtolower($network->slug) . "'>(More " . $network->slug . " Posts</a> | <a href='/sites/" . strtolower($network->slug) . "'>All " . $network->slug . " Sites)</a>");
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
        // Get the list of used networks
		$networks = glo_get_used_networks();
		
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
	<?php foreach ($networks as $network){ ?>
	<input type="checkbox" name="<?php echo ( 'widget-' . $this->id_base . '[' . $this->number . '][exclude][]'); ?>" id="<?php echo $this->get_field_id('exclude'. '_$network->id') ; ?>" value="<?php echo $network->id; ?>" <?php if (in_array($network->id, $exclude)) { echo 'checked="checked"';}?> > <?php echo $network->network_name; ?> <br/> 
	
	
	<?php } ?>
	</label>
			
		
	<?php
		
    }

	
	
} // End of class


// register glo_tag_cloud widget
add_action('widgets_init', create_function('', 'return register_widget("glo_bn_networks_with_posts");'));










?>
