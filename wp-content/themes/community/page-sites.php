<?php get_header(); ?>        		        

<div id="content">

	<div id="inner-content" class="wrap clearfix">

		<div id="main" class="first clearfix">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> itemscope itemtype="http://schema.org/BlogPosting">

				<header class="article-header">

					<ul class="toggle js-buttons" id="toggle">
						<li data-view="grid" class="is-on">Grid</li>
						<li data-view="list">List</li>
					</ul>

					<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>

					<ul class="filter js-buttons" id="filter">
						<li id="network-all" data-filter="*" class="is-on">All Networks</li>
						<?php
						$networks = get_posts('post_type=network');
						foreach ($networks as $network) {											
						?>
                        <li id="network-<?php echo $network->post_name; ?>" data-filter="network-<?php echo $network->post_name; ?>"><?php echo $network->post_title; ?></li>
						<?php } ?>
					</ul>


				</header>

				<section class="entry-content clearfix" itemprop="articleBody" rel="main">

					<ul class="sites-list" id="isotope">
						<?php
						$sites = wp_get_sites('offset=1');

						foreach ($sites as $site) {
							$site_id = $site['blog_id'];
							$site_details = get_blog_details($site_id);
							$site_options = get_blog_option($site_id, 'theme_mods_community-group');
							$site_image = $site_options['community_site_image'];
							$site_path = $site_details->path;
							$site_slug = trim($site_path,'/');

							// Find Network pages that are associated with this site
							$args = array (
								'post_type'              => 'network',
								'meta_query'             => array(
									array(
										'key'       => 'community_network_sites',
										'value'     => $site_id,
										'compare'   => '=',
									),
								),
							);
							$network_query = new WP_Query( $args );
							
							?>
							<?php
							if(function_exists('community_get_site_image')) {
								$header = community_get_site_image($site_id);
							} ?>

							<li class="js-site id-<?php echo $site_id; ?> site-<?php echo $site_slug; ?>  network-<?php foreach($network_query as $post){ echo $post->post_name;} ?>  ">
								<div class="site-image <?php if(!$header) { echo 'no-image'; } ?>"><?php if($header) { ?><img src="<?php echo $header; ?>" class="site-image"><?php } ?></div>
								<h3 class="site-title"><a href="<?php echo $site_details->siteurl; ?>"><?php echo $site_details->blogname; ?></a></h3>
								<h6 class="meta site-network"><a href="/network/<?php foreach ($network_query as $post) { echo $post->post_name;} ?>/"><?php foreach($network_query as $post){ echo $post->post_title;} ?></a></h6>
								<h6 class="meta site-location"></h6>
								<h6 class="meta site-topic"></h6>
							</li>

						<?php } ?>

					</ul>
					
				</section>

				<section class="entry-content clearfix" itemprop="articleBody" rel="main">

					<header class="article-header">
						<h2 class="section-title" itemprop="subheadline">Networks</h2>
					</header>

					<ul class="network-list sites-list">
						<?php
							$networks = get_posts('post_type=network');
							foreach ($networks as $network) {
								setup_postdata($post);
								$thumbnail = get_the_post_thumbnail($network->ID, 'thumbnail');
								$content = get_the_content(' ...');
								$permalink = get_permalink($network->ID);
								if(function_exists('get_excerpt_by_id')) {
									$excerpt = get_excerpt_by_id($network->ID, '25');
								} else {
									$excerpt = $network->post_content;
								}

							?>
								<li id="network-<?php echo $network->post_name; ?>">
									<div class="network-image post-image"><?php echo $thumbnail; ?></div>
									<h3 class="network-title site-title post-title"><a href="<?php echo $permalink; ?>"><?php echo $network->post_title; ?></a></h3>
									<h6 class="network-excerpt post-excerpt">
										<?php echo $excerpt; ?>
									</h6>
								</li>
							<?php } ?>

					</ul>
					
				</section>

				<footer class="article-footer">

					<?php ?>

				</footer>

				<?php comments_template(); ?>

			</article>

			<?php endwhile; else : ?>

					<article id="post-not-found" class="hentry clearfix">
						<header class="article-header">
							<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
						</header>
						<section class="entry-content">
							<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
						</section>
						<footer class="article-footer">
								<p><?php _e( 'This is the error message in the page.php template.', 'bonestheme' ); ?></p>
						</footer>
					</article>

			<?php endif; ?>

		</div>

			

	</div>

</div>


<!-- isotope -->
<script src="<?php echo get_template_directory_uri(); ?>/library/js/isotope.pkgd.min.js"></script>

<script>
$(document).ready(function() {
    
    var $container = $('#isotope');
    $container.isotope({
        itemSelector: 'li',
        layoutMode: 'masonry'
    });

  // bind filter button click
    $('#filter').on( 'click', 'li', function() {
      var $filterValue = $(this).attr('data-filter');
      $container.isotope({ filter: $filterValue });
    });

  /*
  // bind view button click
  $('#toggle').on( 'click', 'li', function() {
    $(this).toggleClass('is-on');
    var $viewValue = $(this).attr('data-view');
    $container.toggleClass({ $viewValue });
    $container.isotope({  });
  });
  
  // change is-checked class on buttons
  $('.js-buttons').each( function( i, buttonGroup ) {
    var $buttonGroup = $( buttonGroup );
    $buttonGroup.on( 'click', 'button', function() {
      $buttonGroup.find('.is-checked').removeClass('is-checked');
      $( this ).addClass('is-checked');
    });
  });
*/
  
});

</script>
<?php get_footer(); ?>
