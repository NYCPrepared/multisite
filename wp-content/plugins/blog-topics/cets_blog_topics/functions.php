<?php
// -------------------------------------------------------------------------//
// Helper functions used in multiple files within the cets_blogtopics plugin.
// -------------------------------------------------------------------------//
function cets_bt_listfind($list,$value,$delimiter=",")
{
	// check to make sure this is an actual list as with some length
	if (strlen($list) == 0 || strlen($list) == 1) {
		if ($list == $value) {
		return 1;
		}
		else {
			return 0;
			}
		
	}	
	// it's got some length to it, so go on from there	
	$a = explode($delimiter,$list);
	for($i=0;$i<count($a);$i++)
	{
	
	if( $a[$i] == $value)
	
	{
	return 1 ;
	}
	}
	return 0;
}

function cets_bt_toggle_blog_exclusion($id, $flag = 'e') {
	$currentlist = get_site_option('cets_blogtopics_excluded_blogs');
	$newlist = "0";
	$currentstatus = cets_bt_listfind($currentlist, $id, ","); // 0 == it is not excluded; 1 == it is excluded
	// if we're excluding
	if ($flag == 'e') {
	// check to see if it's already excluded
	if ( currentstatus == 0)
		{
		$newlist = $currentlist . "," . $id;
		$newlist = implode(",", array_unique(explode(",",$newlist)));
		update_site_option('cets_blogtopics_excluded_blogs', $newlist);
		}
	}
	// okay, we're including it, not excluding
	else {
		if ($currentstatus == 1) {
			if ($currentlist != $id){
				// loop through the list to remove it
				$currentlist = explode(",", $currentlist);
				foreach ($currentlist as $item) {
					if ($item != $id) {
						$newlist .= "," . $item;
					}//end if item != id
					
				}//end foreach
			}
			else {
				$newlist = 0;
			}
			
		// either way, update the site option
		$newlist = implode(",", array_unique(explode(",",$newlist)));
		update_site_option('cets_blogtopics_excluded_blogs', $newlist);
		}
		
	}		
}

?>