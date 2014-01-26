<?php


add_filter('generate_rewrite_rules', 'glo_community_theme_rewrites');

function glo_community_theme_rewrites( $wp_rewrite ) {
	$new_rules = array(
	'network/(.+)' => 'index.php?network=' . $wp_rewrite->preg_index(1),
	'sites/(.+)' => 'index.php?sitelist=' . $wp_rewrite->preg_index(1)
	 );

	$wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}

add_action('init', 'glo_community_theme_flush_rewrite_rules');

function glo_community_theme_flush_rewrite_rules() {
	global $wp_rewrite;
	$wp_rewrite->flush_rules();
}

// add network as an allowed query var
function glo_community_theme_add_networkvar($public_query_vars) {
	$public_query_vars[] = 'network';
	return $public_query_vars;
}
add_filter('query_vars', 'glo_community_theme_add_networkvar');
		
// add sites as an allowed query var
function glo_community_theme_add_sitesvar($public_query_vars) {
	$public_query_vars[] = 'sitelist';
	return $public_query_vars;
}
add_filter('query_vars', 'glo_community_theme_add_sitesvar');

add_action('template_redirect','glo_community_theme_template');

/*
This function stops processing the index.php and includes a template specific for the query arg
*/

function glo_community_theme_template($arg){
	global $wp_query;
	// if neither network nor sites is set, just get out of here
	if( !isset($wp_query->query_vars['network']) && !isset($wp_query->query_vars['sitelist']) )
		return $arg;
	
	if (isset($wp_query->query_vars['network'])) {		
		// if the network var is set, set the network var as the template
		$template = TEMPLATEPATH . "/single-network.php";
	}
	else {
		$template = TEMPLATEPATH . "/sites.php"; // otherwise, this must be a sites template
	}
	
	// make sure the file actually exists
	if (file_exists($template)) {
		require_once($template);
		die(); //To stop anything further being run
	}
		else {return $arg;} // the file didn't exist - get outa here.
	}
	
	
?>