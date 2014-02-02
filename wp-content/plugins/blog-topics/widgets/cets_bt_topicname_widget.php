<?php
/*
Plugin Name: Blog Topics Toic Name Widget
Plugin URI: 
Description: Adds a sidebar widget to display Blog's Topic
Version: 2.0
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
function widget_cets_bt_topic_name_init() {

	// check for sidebar existance
	if ( !function_exists('register_sidebar_widget') || !function_exists('register_widget_control') )
		return;

	// Check for the required blog topic class
	if ( !class_exists('cets_blog_topics') )
		return;
	
	$widget_title = "Blog Topic Name";
	$widget_description = "Show the blog's current topic";

	// This saves options and prints the widget's config form.
	function widget_cets_bt_topic_name_control() {
		global $blog_id;
		$thistopic =  cets_get_blog_topic_name($blog_id);
		
		
		$options = get_option('widget_cets_bt_topic_name');
		
		// this section sets defaults
		if ( !is_array($options) )
			$options = array(
			 'topic_title' => 'Topic',
			 'topic_description' => 'False'
			 );
			 
		// let's try to manually set this option	 
		update_option('widget_cets_bt_topic_name', $options);	 
		
		
			 
		// here we set the options to whatever was posted		
		if ( $_POST['cets_bt_submit'] ) {
			$options['topic_title'] = strip_tags(stripslashes($_POST['cets_bt_topic_title']));
			$options['topic_description'] = $_POST['cets_bt_topic_description'];
			
		}
		
		// Update the options
		update_option('widget_cets_bt_topic_name', $options);
		
		// Figure out the default state for the checkboxes
		$include_topic_description = ( $options['topic_description'] == TRUE ) ? ' checked="checked"' : '';


	?>
			
                
                
	<strong>Blog topic: <?php echo($thistopic); ?></strong>
    <p>
    
    <label for="cets_bt_title"><?php _e('Topic Title:', 'widgets'); ?> 
	<input type="text" id="cets_bt_topic_title" name="cets_bt_topic_title" value="<?php echo wp_specialchars($options['topic_title'], true); ?>" /></label></p>
    <p>
	<label for="cets_bt_topic_description"><?php _e('Include Description:', 'widgets'); ?> 
	<input type="checkbox" id="cets_bt_topic_description" name="cets_bt_topic_description" <?php echo($include_topic_description) ?> value="TRUE" /></label><br/>
    </p>
	<input type="hidden" name="cets_bt_submit" id="cets_bt_submit" value="TRUE" />
				
	<?php
	}

	// This prints the widget
	function widget_cets_bt_topic_name($args) {
		extract($args);
		global $blog_id;
		$this_id = $blog_id;
		//$widget_title = 'Topic';
		$options = get_option('widget_cets_bt_topic_name');
		$title = !isset($options['title']) == 0 ? $widget_title : $options['title'];
	
		// get the topic id from the blogid
		$topic_id = cets_get_topic_id_from_blog_id($this_id);
		// get the topic info
		$topic = cets_get_topic($topic_id);

		
		// this is the first widget - the blog topic
			echo $before_widget . $before_title . $options['topic_title']  . $after_title;
			echo  ("<a href='/topic/" . strtolower($topic->slug) . "'>" . $topic->topic_name . "</a>");
			if ($options['topic_description'] == TRUE) {
				echo  ("<div>" . $topic->description . "</div>");
				
			}
			echo $after_widget;

	}


	// Tell Dynamic Sidebar about our new widget and its control
	$widget_ops = array('classname' => 'widget_cets_bt_topic_name', 'description' => __( "$widget_description") );
	wp_register_sidebar_widget('widget_cets_bt_topic_name', $widget_title, 'widget_cets_bt_topic_name', $widget_ops);
	wp_register_widget_control('widget_cets_bt_topic_name', $widget_title, 'widget_cets_bt_topic_name_control' );


}

// Delay plugin execution to ensure Dynamic Sidebar has a chance to load first
add_action('plugins_loaded', 'widget_cets_bt_topic_name_init');

?>
