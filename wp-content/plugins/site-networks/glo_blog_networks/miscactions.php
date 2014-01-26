<?php
/*
Plugin Name: Miscellaneous actions options for glo_blog_networks
Text Domain: site-networks
*/


// Require the functions.php file

include_once dirname(__FILE__) . '/functions.php';

// hook into Misc Blog Actions in network/site-settings.php.
add_action('wpmueditblogaction', 'glo_blognetworks_misc_actions');

//hook to handle posted data from misc actions
//3.1+
if (function_exists('is_network_admin')) {
	add_action('wpmu_update_blog_options', 'glo_blognetworks_misc_actions_posted');
}
//-3.1
else{
	add_action('wpmuadminedit', 'glo_blognetworks_misc_actions_posted');
}


// Main functions called by above hooks
function glo_blognetworks_misc_actions() { 
	$id = intval( $_GET['id'] );
	
	// $excludelist = get_site_option('glo_blognetworks_excluded_blogs');
	// $excluded = glo_bn_listfind($excludelist, $id, ",");
	
	?>
<h3><?php _e( 'Site Network Options', 'site-networks' ); ?></h3>
<table class="form-table">
	<tr>
		 <?php  global $glo_wpmubn; $glo_wpmubn->get_networks_select($id); ?>
	</tr>
	<!-- <tr>	
		<th><?php _e( 'Privacy', 'site-networks' ); ?></th>
		<td>
		<input type='radio' name='glo_networkexclude' value='0'<?php if( $excluded == '0' || strlen($excluded) == 0 ) echo " checked"?>> <?php _e('Include this blog in networks aggregation') ?>&nbsp;&nbsp;
		<br />
		<input type='radio' name='glo_networkexclude' value='1'<?php if( $excluded == '0' ) ?>> <?php _e('Exclude this blog from networks aggregation') ?>&nbsp;&nbsp;	
		</td>
	</tr> -->
</table>
	<?php
}

function glo_blognetworks_misc_actions_posted() {
	global $glo_wpmubn;
	if( isset($_GET[ 'id' ]) ) { 
		$id = intval( $_GET[ 'id' ] ); 
	} elseif( isset($_POST[ 'id' ]) ) { 
		$id = intval( $_POST[ 'id' ] ); 
	}
	

// set the network
	$glo_wpmubn->set_blog_network($id,$_POST['blog_network_id']);

	glo_bn_toggle_blog_exclusion($id, 'i');
	
	// handle privacy
	if ($_POST['glo_networkexclude'] == 1) {
		// exclude this blog
		glo_bn_toggle_blog_exclusion($id, 'i');
	}
	else {
		// include this blog
		glo_bn_toggle_blog_exclusion($id, 'i');
	}
			
}

	?>