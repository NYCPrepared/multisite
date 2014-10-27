<?php 
if(function_exists('glocal_customization_settings')) {
	$community_settings = glocal_customization_settings();
	$postcategory = implode(",", $community_settings['updates']['featured_category']);
	$postnumber = $community_settings['updates']['number_updates'];
} 
?>

<article id="highlights-module" class="module row highlights clearfix">
	<h2 class="module-heading">
	<?php if(!empty($community_settings['updates']['updates_heading_link'])) { ?>
		<a href="<?php echo $community_settings['updates']['updates_heading_link']; ?>">
			<?php echo $community_settings['updates']['updates_heading']; ?>
		</a>
	<?php } else { ?>
		<?php echo $community_settings['updates']['updates_heading']; ?>
	<?php } ?>	
	</h2>

	<?php
	if(function_exists( 'network_latest_posts' )) {

		$parameters = array(
			'title'         => '',
			'title_only'    => 'false',
			'auto_excerpt'  => 'true',
			'display_type'     => 'ulist',
			'full_meta'		=> 'true',
			'sort_by_date'	=> 'true',
			'use_pub_date'     => 'true',
			'wrapper_list_css' => 'highlights-list',
			'wrapper_block_css'=> 'module row highlights', //The wrapper class
			'instance'         => 'highlights-module', //The wrapper ID
		);
		// If a category was selected, limit to that category
		if(!empty($postcategory)) {
			$parameters['category'] = $postcategory;
		}

		// If number of posts is specified, limit to that number of posts
		if(!empty($postnumber)) {
			$parameters['number_posts'] = $postnumber;
		}
		// Execute
		$hightlights_posts = network_latest_posts($parameters);
	}
	?>

</article>
