<?php
/*
Plugin Name:   Miscellaneous actions options for glo_blog_locations

*/


// Require the functions.php file

include_once dirname(__FILE__) . '/functions.php';

// hook into Misc Blog Actions in network/site-settings.php.
add_action('wpmueditblogaction', 'glo_bloglocations_misc_actions');

//hook to handle posted data from misc actions
//3.1+
if (function_exists('is_network_admin')) {
	add_action('wpmu_update_blog_options', 'glo_bloglocations_misc_actions_posted');
}
//-3.1
else{
	add_action('wpmuadminedit', 'glo_bloglocations_misc_actions_posted');
}





// Main functions called by above hooks
function glo_bloglocations_misc_actions() { 
	$id = intval( $_GET['id'] );
	
	$excludelist = get_site_option('glo_bloglocations_excluded_blogs');
	$excluded = glo_bl_listfind($excludelist, $id, ",");
	
	?>
<h3>Blog Location Options</h3>
<table class="form-table">
<tr>
	 <?php  global $glo_wpmsbl; $glo_wpmsbl->get_locations_select($id); ?>
</tr>
<tr>	
<th>Privacy</th>
<td>
<input type='radio' name='glo_locationexclude' value='0'<?php if( $excluded == '0' || strlen($excluded) == 0 ) echo " checked"?>> <?php _e('Include this blog in locations aggregation') ?>&nbsp;&nbsp;
<br />
<input type='radio' name='glo_locationexclude' value='1'<?php if( $excluded == 1 ) echo " checked"?>> <?php _e('Exclude this blog from locations aggregation') ?>&nbsp;&nbsp;	
</td>
</tr>
</table>
	<?php
}

function glo_bloglocations_misc_actions_posted() {
	global $glo_wpmsbl;
if( isset($_GET[ 'id' ]) ) { 
	$id = intval( $_GET[ 'id' ] ); 
} elseif( isset($_POST[ 'id' ]) ) { 
	$id = intval( $_POST[ 'id' ] ); 
}
	

// set the location
	$glo_wpmsbl->set_blog_location($id,$_POST['blog_location_id']);
	
	// handle privacy
	if ($_POST['glo_locationexclude'] == 1) {
		// exclude this blog
		glo_bl_toggle_blog_exclusion($id, 'e');
	}
	else {
		// include this blog
		glo_bl_toggle_blog_exclusion($id, 'i');
	}
			
}

	?>