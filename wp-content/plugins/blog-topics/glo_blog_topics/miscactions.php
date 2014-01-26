<?php
/*
Plugin Name:   Miscellaneous actions options for glo_blog_topics
Text Domain: blogtopics

*/


// Require the functions.php file

include_once dirname(__FILE__) . '/functions.php';

// hook into Misc Blog Actions in network/site-settings.php.
add_action('wpmueditblogaction', 'glo_blogtopics_misc_actions');

//hook to handle posted data from misc actions
//3.1+
if (function_exists('is_network_admin')) {
	add_action('wpmu_update_blog_options', 'glo_blogtopics_misc_actions_posted');
}
//-3.1
else{
	add_action('wpmuadminedit', 'glo_blogtopics_misc_actions_posted');
}





// Main functions called by above hooks
function glo_blogtopics_misc_actions() { 
	$id = intval( $_GET['id'] );
	
	$excludelist = get_site_option('glo_blogtopics_excluded_blogs');
	$excluded = glo_bt_listfind($excludelist, $id, ",");
	
	?>
<h3>Blog Topic Options</h3>
<table class="form-table">
<tr>
	 <?php  global $glo_wpmubt; $glo_wpmubt->get_topics_select($id); ?>
</tr>
<tr>	
<th>Privacy</th>
<td>
<input type='radio' name='glo_topicexclude' value='0'<?php if( $excluded == '0' || strlen($excluded) == 0 ) echo " checked"?>> <?php _e('Include this blog in topics aggregation') ?>&nbsp;&nbsp;
<br />
<input type='radio' name='glo_topicexclude' value='1'<?php if( $excluded == 1 ) echo " checked"?>> <?php _e('Exclude this blog from topics aggregation') ?>&nbsp;&nbsp;	
</td>
</tr>
</table>
	<?php
}

function glo_blogtopics_misc_actions_posted() {
	global $glo_wpmubt;
if( isset($_GET[ 'id' ]) ) { 
	$id = intval( $_GET[ 'id' ] ); 
} elseif( isset($_POST[ 'id' ]) ) { 
	$id = intval( $_POST[ 'id' ] ); 
}
	

// set the topic
	$glo_wpmubt->set_blog_topic($id,$_POST['blog_topic_id']);
	
	// handle privacy
	if ($_POST['glo_topicexclude'] == 1) {
		// exclude this blog
		glo_bt_toggle_blog_exclusion($id, 'e');
	}
	else {
		// include this blog
		glo_bt_toggle_blog_exclusion($id, 'i');
	}
			
}

	?>