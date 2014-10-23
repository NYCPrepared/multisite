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
		<a href="/news/">News</a>
	</h2>

	<?php
	if(function_exists( 'network_latest_posts' )) {

		$parameters = array(
		'title'         => '',
		'title_only'    => 'false',
		'display_type'     => 'ulist',
		'auto_excerpt'  => 'true',
		'full_meta'		=> 'true',
		// 'category'         => 'news',
		'excerpt_length'   => '20',
		'number_posts'     => 2,
		'wrapper_list_css' => 'news-list',
		'wrapper_block_css'=> 'module row news', //The wrapper classe
		'instance'         => 'news-module', //The wrapper ID
		);
		// Execute
		$recent_posts = network_latest_posts($parameters);
	}
	?>
</article>