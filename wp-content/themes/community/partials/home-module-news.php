<?php 
if(function_exists('glocal_customization_settings')) {
	$community_settings = glocal_customization_settings();
	$postcategory = implode(",", $community_settings['posts']['featured_category']);
	$postnumber = $community_settings['posts']['number_posts'];
} 
?>

<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('.news-list').bxSlider({
		slideWidth: 5000,
		minSlides: 2,
		maxSlides: 2,
		slideMargin: 10,
		pager: false
	});
	var responsive_viewport = jQuery(window).width();
	if (responsive_viewport < 320) {
		jQuery('.news-list').reloadSlider({
		slideWidth: 5000,
		minSlides: 1,
		maxSlides: 1,
		slideMargin: 10,
		pager: false
		});
	} 
});
</script>

<article id="news-module" class="module row news clearfix">
	<h2 class="module-heading">
	<?php if(!empty($community_settings['posts']['posts_heading_link'])) { ?>
		<a href="<?php echo $community_settings['posts']['posts_heading_link']; ?>">
			<?php echo $community_settings['posts']['posts_heading']; ?>
		</a>
	<?php } else { ?>
		<?php echo $community_settings['posts']['posts_heading']; ?>
	<?php } ?>	
	</h2>

	<?php
	if(function_exists( 'network_latest_posts' )) {

		$parameters = array(
			'title'         => '',
			'title_only'    => 'false',
			'display_type'     => 'ulist',
			'auto_excerpt'  => 'true',
			'full_meta'		=> 'true',
			'excerpt_length'   => '20',
			'sort_by_date'	=> 'true',
			'wrapper_list_css' => 'news-list',
			'wrapper_block_css'=> 'module row news', //The wrapper class
			'instance'         => 'news-module', //The wrapper ID
			'ignore_blog'	=> '1', //Omit the main site from network news
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
		$recent_posts = network_latest_posts($parameters);
	}
	?>
</article>
