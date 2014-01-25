<?php
/*
Plugin Name:   Miscellaneous actions options for cets_blog_topics

*/


// Require the functions.php file

include_once dirname(__FILE__) . '/functions.php';

// hook into Misc Blog Actions in network/site-settings.php.
add_action('wpmueditblogaction', 'cets_blogtopics_misc_actions');

//hook to handle posted data from misc actions
//3.1+
if (function_exists('is_network_admin')) {
	add_action('wpmu_update_blog_options', 'cets_blogtopics_misc_actions_posted');
}
//-3.1
else{
	add_action('wpmuadminedit', 'cets_blogtopics_misc_actions_posted');
}





// Main functions called by above hooks
function cets_blogtopics_misc_actions() { 
	$id = intval( $_GET['id'] );
	
	$excludelist = get_site_option('cets_blogtopics_excluded_blogs');
	$excluded = cets_bt_listfind($excludelist, $id, ",");
	
	?>
<h3>Blog Topic Options</h3>
<table class="form-table">
<tr>
	 <?php  global $cets_wpmubt; $cets_wpmubt->get_topics_select($id); ?>
</tr>
<tr>	
<th>Privacy</th>
<td>
<input type='radio' name='cets_topicexclude' value='0'<?php if( $excluded == '0' || strlen($excluded) == 0 ) echo " checked"?>> <?php _e('Include this blog in topics aggregation') ?>&nbsp;&nbsp;
<br />
<input type='radio' name='cets_topicexclude' value='1'<?php if( $excluded == 1 ) echo " checked"?>> <?php _e('Exclude this blog from topics aggregation') ?>&nbsp;&nbsp;	
</td>
</tr>
</table>
	<?php
}

function cets_blogtopics_misc_actions_posted() {
	global $cets_wpmubt;
if( isset($_GET[ 'id' ]) ) { 
	$id = intval( $_GET[ 'id' ] ); 
} elseif( isset($_POST[ 'id' ]) ) { 
	$id = intval( $_POST[ 'id' ] ); 
}
	

// set the topic
	$cets_wpmubt->set_blog_topic($id,$_POST['blog_topic_id']);
	
	// handle privacy
	if ($_POST['cets_topicexclude'] == 1) {
		// exclude this blog
		cets_bt_toggle_blog_exclusion($id, 'e');
	}
	else {
		// include this blog
		cets_bt_toggle_blog_exclusion($id, 'i');
	}
			
}

	?>