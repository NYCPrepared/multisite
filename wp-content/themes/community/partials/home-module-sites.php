<?php $sites = wp_get_sites('offset=1'); // Set up variable that holds array of sites ?>

<article id="sites-module" class="module row sites">
	<h2 class="module-heading"><a href="/directory">Sites</a></h2>
	<ul class="sites-list">

	<?php
	$counter = 0; 

	foreach ($sites as $site) {
		$site_id = $site['blog_id'];
		$site_details = get_blog_details($site_id);

		if(function_exists('community_get_site_image')) {
			$header = community_get_site_image($site_id);
		} 
		?>
	
		<li id="site-<?php echo $site_id; ?>">
		    <a href="<?php echo $site_details->path; ?>" title="<?php echo $site_details->blogname; ?>" class="item-image <?php if(!$header) { echo 'no-image'; } ?>" style="background-image: url('<?php if($header) { echo $header; } ?>');"></a>
			<h3 class="item-title"><a href="<?php echo $site_details->path; ?>" title="<?php echo $site_details->blogname; ?>"><?php echo $site_details->blogname; ?></a></h3>
			<h6 class="meta item-modified"><span class="modified-title">Last updated</span> <time><?php echo date_i18n(get_option('date_format') ,strtotime($site_details->last_updated));?></time></h6>
		</li>
	
	<?php
        if (++$counter == 7) break;
    } ?>

		<li class="directory-promo" id="promo-directory">
			<a href="/directory" title="Directory">
				<h3 class="post-title">Join the community</h3>
				<div class="promo-icons"><i class="icon"></i><i class="icon"></i><i class="icon"></i><i class="icon"></i></div>
			</a>
		</li>

	</ul>
</article>

