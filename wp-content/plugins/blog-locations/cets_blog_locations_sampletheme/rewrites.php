<?php


add_filter('generate_rewrite_rules', 'cets_fyi_theme_rewrites');

function cets_fyi_theme_rewrites( $wp_rewrite )
{
$new_rules = array(
'topic/(.+)' => 'index.php?topic=' . $wp_rewrite->preg_index(1),
'sites/(.+)' => 'index.php?sitelist=' . $wp_rewrite->preg_index(1)
 );

$wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}


add_action('init', 'cets_fyi_theme_flush_rewrite_rules');

function cets_fyi_theme_flush_rewrite_rules()
{
global $wp_rewrite;
$wp_rewrite->flush_rules();
}


// add topic as an allowed query var
function cets_fyi_theme_add_topicvar($public_query_vars) {
	$public_query_vars[] = 'topic';
	return $public_query_vars;
}
add_filter('query_vars', 'cets_fyi_theme_add_topicvar');
		
// add sites as an allowed query var
function cets_fyi_theme_add_sitesvar($public_query_vars) {
	$public_query_vars[] = 'sitelist';
	return $public_query_vars;
}
add_filter('query_vars', 'cets_fyi_theme_add_sitesvar');




add_action('template_redirect','cets_fyi_theme_template');


/*
This function stops processing the index.php and includes a template specific for the query arg
*/

function cets_fyi_theme_template($arg){
	global $wp_query;
	// if neither topic nor sites is set, just get out of here
	if( !isset($wp_query->query_vars['topic']) && !isset($wp_query->query_vars['sitelist']) )
		return $arg;
	
	if (isset($wp_query->query_vars['topic'])) {		
		// if the topic var is set, set the topic var as the template
		$template = TEMPLATEPATH . "/topic.php";
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