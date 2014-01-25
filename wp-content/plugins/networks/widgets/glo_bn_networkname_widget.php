<?php
/*
Plugin Name: Site Networks Toic Name Widget
Plugin URI: 
Description: Adds a sidebar widget to display Blog's Network
Version: 2.0
Author: Deanna Schneider
Copyright:

    

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
function widget_glo_bn_network_name_init() {

	// check for sidebar existance
	if ( !function_exists('register_sidebar_widget') || !function_exists('register_widget_control') )
		return;

	// Check for the required blog network class
	if ( !class_exists('glo_blog_networks') )
		return;
	
	$widget_title = "Site Network Name";
	$widget_description = "Show the blog's current network";

	// This saves options and prints the widget's config form.
	function widget_glo_bn_network_name_control() {
		global $blog_id;
		$thisnetwork =  glo_get_blog_network_name($blog_id);
		
		
		$options = get_option('widget_glo_bn_network_name');
		
		// this section sets defaults
		if ( !is_array($options) )
			$options = array(
			 'network_title' => 'Network',
			 'network_description' => 'False'
			 );
			 
		// let's try to manually set this option	 
		update_option('widget_glo_bn_network_name', $options);	 
		
		
			 
		// here we set the options to whatever was posted		
		if ( $_POST['glo_bn_submit'] ) {
			$options['network_title'] = strip_tags(stripslashes($_POST['glo_bn_network_title']));
			$options['network_description'] = $_POST['glo_bn_network_description'];
			
		}
		
		// Update the options
		update_option('widget_glo_bn_network_name', $options);
		
		// Figure out the default state for the checkboxes
		$include_network_description = ( $options['network_description'] == TRUE ) ? ' checked="checked"' : '';


	?>
			
                
                
	<strong>Blog network: <?php echo($thisnetwork); ?></strong>
    <p>
    
    <label for="glo_bn_title"><?php _e('Network Title:', 'widgets'); ?> 
	<input type="text" id="glo_bn_network_title" name="glo_bn_network_title" value="<?php echo wp_specialchars($options['network_title'], true); ?>" /></label></p>
    <p>
	<label for="glo_bn_network_description"><?php _e('Include Description:', 'widgets'); ?> 
	<input type="checkbox" id="glo_bn_network_description" name="glo_bn_network_description" <?php echo($include_network_description) ?> value="TRUE" /></label><br/>
    </p>
	<input type="hidden" name="glo_bn_submit" id="glo_bn_submit" value="TRUE" />
				
	<?php
	}

	// This prints the widget
	function widget_glo_bn_network_name($args) {
		extract($args);
		global $blog_id;
		$this_id = $blog_id;
		//$widget_title = 'Network';
		$options = get_option('widget_glo_bn_network_name');
		$title = !isset($options['title']) == 0 ? $widget_title : $options['title'];
	
		// get the network id from the blogid
		$network_id = glo_get_network_id_from_blog_id($this_id);
		// get the network info
		$network = glo_get_network($network_id);

		
		// this is the first widget - the blog network
			echo $before_widget . $before_title . $options['network_title']  . $after_title;
			echo  ("<a href='/network/" . strtolower($network->slug) . "'>" . $network->network_name . "</a>");
			if ($options['network_description'] == TRUE) {
				echo  ("<div>" . $network->description . "</div>");
				
			}
			echo $after_widget;

	}


	// Tell Dynamic Sidebar about our new widget and its control
	$widget_ops = array('classname' => 'widget_glo_bn_network_name', 'description' => __( "$widget_description") );
	wp_register_sidebar_widget('widget_glo_bn_network_name', $widget_title, 'widget_glo_bn_network_name', $widget_ops);
	wp_register_widget_control('widget_glo_bn_network_name', $widget_title, 'widget_glo_bn_network_name_control' );


}

// Delay plugin execution to ensure Dynamic Sidebar has a chance to load first
add_action('plugins_loaded', 'widget_glo_bn_network_name_init');

?>
