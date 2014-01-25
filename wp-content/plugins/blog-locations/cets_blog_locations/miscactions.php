<?php
/*
Plugin Name:   Miscellaneous actions options for cets_blog_locations

*/


// Require the functions.php file

include_once dirname(__FILE__) . '/functions.php';

// hook into Misc Blog Actions in network/site-settings.php.
add_action('wpmueditblogaction', 'cets_bloglocations_misc_actions');

//hook to handle posted data from misc actions
//3.1+
if (function_exists('is_network_admin')) {
	add_action('wpmu_update_blog_options', 'cets_bloglocations_misc_actions_posted');
}
//-3.1
else{
	add_action('wpmuadminedit', 'cets_bloglocations_misc_actions_posted');
}





// Main functions called by above hooks
function cets_bloglocations_misc_actions() { 
	$id = intval( $_GET['id'] );
	
	$excludelist = get_site_option('cets_bloglocations_excluded_blogs');
	$excluded = cets_bl_listfind($excludelist, $id, ",");
	
	?>
<h3>Blog Topic Options</h3>
<table class="form-table">
<tr>
	 <?php  global $cets_wpmubl; $cets_wpmubl->get_locations_select($id); ?>
</tr>
<tr>	
<th>Privacy</th>
<td>
<input type='radio' name='cets_locationexclude' value='0'<?php if( $excluded == '0' || strlen($excluded) == 0 ) echo " checked"?>> <?php _e('Include this blog in locations aggregation') ?>&nbsp;&nbsp;
<br />
<input type='radio' name='cets_locationexclude' value='1'<?php if( $excluded == 1 ) echo " checked"?>> <?php _e('Exclude this blog from locations aggregation') ?>&nbsp;&nbsp;	
</td>
</tr>
</table>
	<?php
}

function cets_bloglocations_misc_actions_posted() {
	global $cets_wpmubl;
if( isset($_GET[ 'id' ]) ) { 
	$id = intval( $_GET[ 'id' ] ); 
} elseif( isset($_POST[ 'id' ]) ) { 
	$id = intval( $_POST[ 'id' ] ); 
}
	

// set the location
	$cets_wpmubl->set_blog_location($id,$_POST['blog_location_id']);
	
	// handle privacy
	if ($_POST['cets_locationexclude'] == 1) {
		// exclude this blog
		cets_bl_toggle_blog_exclusion($id, 'e');
	}
	else {
		// include this blog
		cets_bl_toggle_blog_exclusion($id, 'i');
	}
			
}

	?>