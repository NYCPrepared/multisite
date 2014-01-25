<?php
/*
Plugin Name: Blog Locations Location Name Widget
Plugin URI: 
Description: Adds a sidebar widget to display Blog's Location
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
function widget_cets_bl_location_name_init() {

	// check for sidebar existance
	if ( !function_exists('register_sidebar_widget') || !function_exists('register_widget_control') )
		return;

	// Check for the required blog location class
	if ( !class_exists('cets_blog_locations') )
		return;
	
	$widget_title = "Blog Location Name";
	$widget_description = "Show the blog's current location";

	// This saves options and prints the widget's config form.
	function widget_cets_bl_location_name_control() {
		global $blog_id;
		$thislocation =  cets_get_blog_location_name($blog_id);
		
		
		$options = get_option('widget_cets_bl_location_name');
		
		// this section sets defaults
		if ( !is_array($options) )
			$options = array(
			 'location_title' => 'Location',
			 'location_description' => 'False'
			 );
			 
		// let's try to manually set this option	 
		update_option('widget_cets_bl_location_name', $options);	 
		
		
			 
		// here we set the options to whatever was posted		
		if ( $_POST['cets_bl_submit'] ) {
			$options['location_title'] = strip_tags(stripslashes($_POST['cets_bl_location_title']));
			$options['location_description'] = $_POST['cets_bl_location_description'];
			
		}
		
		// Update the options
		update_option('widget_cets_bl_location_name', $options);
		
		// Figure out the default state for the checkboxes
		$include_location_description = ( $options['location_description'] == TRUE ) ? ' checked="checked"' : '';


	?>
			
                
                
	<strong>Blog location: <?php echo($thislocation); ?></strong>
    <p>
    
    <label for="cets_bl_title"><?php _e('Location Title:', 'widgets'); ?> 
	<input type="text" id="cets_bl_location_title" name="cets_bl_location_title" value="<?php echo wp_specialchars($options['location_title'], true); ?>" /></label></p>
    <p>
	<label for="cets_bl_location_description"><?php _e('Include Description:', 'widgets'); ?> 
	<input type="checkbox" id="cets_bl_location_description" name="cets_bl_location_description" <?php echo($include_location_description) ?> value="TRUE" /></label><br/>
    </p>
	<input type="hidden" name="cets_bl_submit" id="cets_bl_submit" value="TRUE" />
				
	<?php
	}

	// This prints the widget
	function widget_cets_bl_location_name($args) {
		extract($args);
		global $blog_id;
		$this_id = $blog_id;
		//$widget_title = 'Location';
		$options = get_option('widget_cets_bl_location_name');
		$title = !isset($options['title']) == 0 ? $widget_title : $options['title'];
	
		// get the location id from the blogid
		$location_id = cets_get_location_id_from_blog_id($this_id);
		// get the location info
		$location = cets_get_location($location_id);

		
		// this is the first widget - the blog location
			echo $before_widget . $before_title . $options['location_title']  . $after_title;
			echo  ("<a href='/location/" . strtolower($location->slug) . "'>" . $location->location_name . "</a>");
			if ($options['location_description'] == TRUE) {
				echo  ("<div>" . $location->description . "</div>");
				
			}
			echo $after_widget;

	}


	// Tell Dynamic Sidebar about our new widget and its control
	$widget_ops = array('classname' => 'widget_cets_bl_location_name', 'description' => __( "$widget_description") );
	wp_register_sidebar_widget('widget_cets_bl_location_name', $widget_title, 'widget_cets_bl_location_name', $widget_ops);
	wp_register_widget_control('widget_cets_bl_location_name', $widget_title, 'widget_cets_bl_location_name_control' );


}

// Delay plugin execution to ensure Dynamic Sidebar has a chance to load first
add_action('plugins_loaded', 'widget_cets_bl_location_name_init');

?>
