<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="first clearfix" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>

									<h2 class="section-title" itemprop="subheadline">Sites</h2>

									<div class="filters">
										<?php // This is currently using a plugin based on Blog Topics, should be changed if we decide to use something else

										if (function_exists('cets_get_used_topics')) { ?>
										<ul id="filter site-topics">
											<li id="topic-all">All Topics</li>
											<?php
											$topics = cets_get_used_topics();
											foreach ($topics as $topic) {											
											?>
												<li id="topic-<?php echo $topic->slug; ?>"><?php echo $topic->topic_name; ?></li>
											<?php } ?>
										</ul>
										<?php } ?>
										<?php if (function_exists('glo_get_used_locations')) { ?>
										<ul id="filter site-locations">
											<li id="location-all">All Locations</li>
											<?php
											$locations = glo_get_used_locations();
											foreach ($locations as $location) {											
											?>
												<li id="location-<?php echo $location->slug; ?>"><?php echo $location->location_name; ?></li>
											<?php } ?>
										</ul>
										<?php } ?>
										<ul id="filter site-networks">
											<li id="network-all">All Networks</li>
											<?php
											$networks = get_posts('post_type=network');
											foreach ($networks as $network) {											
											?>
												<li id="network-<?php echo $network->post_name; ?>"><?php echo $network->post_title; ?></li>
											<?php } ?>
										</ul>
										<ul id="filter site-view">
											<li id="view-grid">Grid</li>
											<li id="view-list">List</li>
										</ul>

									</div>

								</header>

								<section class="entry-content clearfix" itemprop="articleBody" rel="main">

									<header class="article-header">
										<h2 class="section-title" itemprop="subheadline">Networks</h2>
									</header>

									<ul class="sites-list">
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
											if(function_exists('glo_get_blog_location_name')) { 
												$location_name = glo_get_blog_location_name($site_id);
												$location_slug = glo_get_blog_location_slug($site_id); 
											} ?>
											<?php 
											if(function_exists('cets_get_blog_topic_name')) { 
												$topic_name = cets_get_blog_topic_name($site_id);
												$topic_slug = cets_get_blog_topic_slug($site_id); 
											} ?>
											<?php
											if(function_exists('community_get_site_image')) {
												$header = community_get_site_image($site_id);
											} ?>

											<li class="id-<?php echo $site_id; ?> site-<?php echo $site_slug; ?> topic-<?php if($location_name) { echo $topic_slug; } ?> network-<?php foreach($network_query as $post){ echo $post->post_name;} ?> location-<?php if($location_name) { echo $location_slug; } ?> ">
												<div class="site-image <?php if(!$header) { echo 'no-image'; } ?>"><?php if($header) { ?><img src="<?php echo $header; ?>" class="site-image"><?php } ?></div>
												<h3 class="site-title"><a href="<?php echo $site_details->siteurl; ?>"><?php echo $site_details->blogname; ?></a></h3>
												<div class="meta site-network"><a href="/network/<?php foreach ($network_query as $post) { echo $post->post_name;} ?>/"><?php foreach($network_query as $post){ echo $post->post_title;} ?></a></div>
												<div class="meta site-location"><?php if($location_name) { echo $location_name; } ?></div>
												<div class="meta site-topic"><?php if($location_name) { echo $topic_name; } ?></div>
											</li>

										<?php } ?>

									</ul>
									
								</section>

								<section class="entry-content clearfix" itemprop="articleBody" rel="main">

									<ul class="network-list">
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
													<h3 class="network-title post-title"><a href="<?php echo $permalink; ?>"><?php echo $network->post_title; ?></a></h3>
													<div class="network-excerpt post-excerpt">
														<?php echo $excerpt; ?>
													</div>
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

<?php get_footer(); ?>
