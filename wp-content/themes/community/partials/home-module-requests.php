<?php 
if(function_exists('community_home_category')) {
	$postcategory = community_home_category(); // Get the category from theme customization 
	$categoryid = get_option("community_options");
}

if(function_exists('community_home_header')) {
	$heading = community_home_header(); // Get the header text from theme customization 
	if(!empty($heading)) {
		$postheading = $heading;
	} elseif(!empty($postcategory)) {
		$postheading = $postcategory;
	}
	else {
		$postheading = 'Latest'; // Fallback header text. Change to whatever you'd like.
	}
}
?>

<article id="highlights-module" class="module row highlights clearfix">
	<h2 class="module-heading"><?php echo $postheading ?></h2>

	<?php
	if(function_exists( 'network_latest_posts' )) {

		$parameters = array(
		'title'         => '',
		'title_only'    => 'false',
		'auto_excerpt'  => 'true',
		'display_type'     => 'ulist',
		'full_meta'		=> 'true',
		'category'         => $postcategory,          // Widget title
		'number_posts'     => 9,
		'wrapper_list_css' => 'highlights-list',
		'wrapper_block_css'=> 'module row highlights', //The wrapper classe
		'instance'         => 'highlights-module', //The wrapper ID
		);
		// Execute
		$hightlights_posts = network_latest_posts($parameters);
	}
	?>

</article>
