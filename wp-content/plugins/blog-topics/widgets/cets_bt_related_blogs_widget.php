<?php
/*
Plugin Name: Blog Topics Related Blogs Widget
Plugin URI: 
Description: Adds a sidebar widget to display blogs from the same topic area.
Version 2.0
Author: Deanna Schneider
Copyright:

    Copyright 2008 CETS

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

// This gets called at the plugins_loaded action
function widget_cets_bt_related_blogs_init() {

	// check for sidebar existance
	if ( !function_exists('register_sidebar_widget') || !function_exists('register_widget_control') )
		return;

	// Check for the required blog topic class
	if ( !class_exists('cets_blog_topics') )
		return;
	
	$widget_title = "Blog Topics - Related Blogs";
	$widget_description = "Show the linked list of other blogs with the same topic";
	
	// This saves options and prints the widget's config form.
	function widget_cets_bt_related_blogs_control() {
		global $blog_id;
		$thistopic =  cets_get_blog_topic_name($blog_id);
		
		
		$options = get_option('widget_cets_bt_related_blogs');
		
		// this section sets defaults
		if ( !is_array($options) )
			$options = array('blogs_title'=>'Related Blogs',
			 'limit'=>'5'
			 );
			 
		// let's try to manually set this option	 
		update_option('widget_cets_bt_related_blogs', $options);	 
		
		
			 
		// here we set the options to whatever was posted		
		if ( $_POST['cets_bt_related_blogs_submit'] ) {
			$options['blogs_title'] = strip_tags(stripslashes($_POST['cets_bt_blogs_title']));
			$options['maxrows'] = strip_tags(stripslashes($_POST['cets_bt_maxrows']));
			
			
		}
		
		// Update the options
		update_option('widget_cets_bt_related_blogs', $options);
		
		

	?>
     <strong>Sitewide Related Blogs</strong>
     <p>
     <label for="cets_bt_title"><?php _e('Title:', 'widgets'); ?> 
	 <input type="text" id="cets_bt_blogs_title" name="cets_bt_blogs_title" value="<?php echo wp_specialchars($options['blogs_title'], true); ?>" /></label>
     </p>
	 <p>
	 <label for="cets_bt_maxrows"><?php _e('Number of related blogs to include:', 'widgets'); ?> 
	 <input type="text" id="cets_bt_maxrows" name="cets_bt_maxrows" size="5" value="<?php echo wp_specialchars($options['maxrows'], true);?>" /></label>
     </p>
     <input type="hidden" name="cets_bt_related_blogs_submit" id="cets_bt_related_blogs_submit" value="TRUE" />
		
	<?php
	}

	// This prints the widget
	function widget_cets_bt_related_blogs($args) {
		extract($args);
		global $blog_id;
		$this_id = $blog_id;
		//$widget_title = 'Topic';
		$maxrows_default = 0; // this is no limit
		
		$options = get_option('widget_cets_bt_related_blogs');
		$title = !isset($options['title']) == 0 ? $widget_title : $options['title'];
		
		// check to see if they added a number for the maxrows to include
		if (strlen($options['maxrows']) == 0) {
			// if no number, set it to the default 
			$options['maxrows'] = $maxrows_default;
		}
		
		// if they entered something that's not a number, set it to 5
		if (!$options['maxrows'] == (int) $options['maxrows']) {
			$maxrows = 5;
		}
		else {
			// otherwise, let them choose how many
			$maxrows = $options['maxrows'];
		}
		
		// get the topic id from the blogid
		$topic_id = cets_get_topic_id_from_blog_id($this_id);
		
		
		
		// the sitewide related blogs
			echo $before_widget . $before_title . $options['blogs_title']  . $after_title;
			cets_get_blogs_from_topic_id_html($topic_id, $maxrows, $this_id);
			echo $after_widget;
	
	}


	// Tell Dynamic Sidebar about our new widget and its control
	$widget_ops = array('classname' => 'widget_cets_bt_related_blogs', 'description' => __( "$widget_description") );
	wp_register_sidebar_widget('widget_cets_bt_related_blogs', $widget_title, 'widget_cets_bt_related_blogs', $widget_ops);
	wp_register_widget_control('widget_cets_bt_related_blogs', $widget_title, 'widget_cets_bt_related_blogs_control');

}

// Delay plugin execution to ensure Dynamic Sidebar has a chance to load first
add_action('plugins_loaded', 'widget_cets_bt_related_blogs_init');

?>
