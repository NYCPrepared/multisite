<?php
// Template: Front Page

// This template makes heavy use of the Events Manager and Options Framework plugins and the recent-network-posts function (included in with this theme in recent-network-posts.php).
// Without Events Manager, the events module (module 3) will not appear.
// Without the recent-network-posts function, the network-wide posts (module 1 and module 2) will not appear

?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

					<section class="home-main clearfix">
						<article class="home-intro">
							<!-- Displays any content entered in the page used as the front page -->
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
								<?php the_content(); ?>
							<?php endwhile; endif; ?>
						</article>
						<article class="home-feature clearfix">

							<script type="text/javascript">

							jQuery(document).ready(function(){
							  jQuery('.featured-posts').bxSlider({
							    mode: 'fade',
							    adaptiveHeight: true,
							    captions: true
							  });
							});
							</script>

							<ul id="featured" class="featured-posts bxslider">
							<!-- Displays sticky posts from the current site -->

								<?php
								$sticky = get_option( 'sticky_posts' ); // Fetch an array of sticky posts
								rsort( $sticky ); // Sort by latest first
								$sticky = array_slice( $sticky, 0, 5 ); // Change the last number to show more or less posts
								$featuredposts = new WP_Query( array( 'post__in' => $sticky, 'ignore_sticky_posts' => 1 ) );

								while ($featuredposts->have_posts()) : $featuredposts->the_post();
									$permalink = get_permalink();
									$title = get_the_title();
									// $post_meta = get_post_meta($post->ID, 'community_volunteer_location', true);
									$imagearg = array(
										'title'	=> trim(strip_tags($title)),
										'alt'	=> trim(strip_tags($title))
									);
								?>

								<li class="featured-post">
									<a href="<?php echo $permalink; ?>" title="<?php echo get_the_title();?>">
									<?php echo get_the_post_thumbnail($post->ID, 'full', $imagearg); ?>
									</a>
								</li>
								

							<?php endwhile; ?>
							<?php wp_reset_query(); ?> 

							</ul>

						</article>
					</section>

					<section class="home-modules clearfix">
						<?php if ( is_multisite() ) { // Check to see if multisite is active. If not, display a recent posts and events module for this site. ?> 
						<?php $sites = wp_get_sites('offset=1'); // Set up variable that holds array of sites ?>
	
						<?php
						if(function_exists( 'network_latest_posts' )) {

							$parameters = array(
							'title'         => 'Volunteer',
							'title_only'    => 'false',
							'auto_excerpt'  => 'true',
							'full_meta'		=> 'true',
							'category'         => 'volunteer',          // Widget title
							'number_posts'     => 2,
							'wrapper_list_css' => 'highlights-list',
							'wrapper_block_css'=> 'module row highlights', //The wrapper classe
							'instance'         => 'highlights-module', //The wrapper ID
							);
							// Execute
							$hightlights_posts = network_latest_posts($parameters);
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

						<?php
						if(function_exists( 'network_latest_posts' )) {

							$parameters = array(
							'title'         => 'News',
							'title_link'    => '/news/',
							'title_only'    => 'false',
							'auto_excerpt'  => 'true',
							'full_meta'		=> 'true',
							// 'category'         => 'news',
							'number_posts'     => 2,
							'wrapper_list_css' => 'news-list',
							'wrapper_block_css'=> 'module row news', //The wrapper classe
							'instance'         => 'news-module', //The wrapper ID
							);
							// Execute
							$recent_posts = network_latest_posts($parameters);
						}
						?>

						<script type="text/javascript">
						jQuery(document).ready(function(){
						  jQuery('.events-list').bxSlider({
                            slideWidth: 5000,
						    minSlides: 4,
						    maxSlides: 4,
						    slideMargin: 10,
						    pager: false
						  });
                          var responsive_viewport = jQuery(window).width();
                          if (responsive_viewport < 320) {
                              jQuery('.events-list').reloadSlider({
        					    slideWidth: 5000,
        					    minSlides: 1,
        					    maxSlides: 1,
        					    slideMargin: 10,
        					    pager: false
                              });
                          } 
						});
						</script>

						<?php // Check to see if Events Manager is active. If not don't display this module.
						if ( is_plugin_active('events-manager/events-manager.php') ) { ?>
						<article id="events-module" class="module row events clearfix">
							<h2 class="module-heading"><a href="/events/">Events</a></h2>
							<ul class="events-list">
								<?php
								$events = EM_Events::output(array('limit'=>5, 
									'format'=>'<li>
									<h6 class="event-start">
                				        <time class="event-month" datetime="#M">#M</time>
                				        <time class="event-date" datetime="#j">#j</time>
                				        <time class="event-day" datetime="#D">#D</time>
                					</h6>
									<h3 class="post-title event-title">#_EVENTLINK</h3>
									</li>'));?>
								<?php echo $events; ?>
							</ul>
						</article>
						<?php } ?>
						<article id="sites-module" class="module row sites clearfix">
							<h2 class="module-heading"><a href="/sites/">Sites</a></h2>
							<ul class="sites-list grid">

							<?php
							foreach ($sites as $site) {
								$site_id = $site['blog_id'];
								$site_details = get_blog_details($site_id);

								if(function_exists('community_get_site_image')) {
									$header = community_get_site_image($site_id);
								} 
								?>
							
								<li id="site-<?php echo $site_id; ?>">
    								<img class="post-image site-image" src="<?php echo $header; ?>">
									<h3 class="post-title site-title"><a href="<?php echo $site_details->path; ?>" title="<?php echo $site_details->blogname; ?>"><?php echo $site_details->blogname; ?></a></h3>
									<h6 class="site-meta modified"><span class="modified-title">Last updated</span> <time><?php echo date_i18n(get_option('date_format') ,strtotime($site_details->last_updated));?></time></h6>
								</li>
							
                            <?php } ?>

								<li id="site-promo">
									<h3 class="post-title">Join the community</h3>
									<div class="promo-icons"><i></i><i></i><i></i><i></i></div>
									<a class="button" href="/register" title="Create a site">Create a Site</a>
								</li>

							</ul>
						</article>

						<?php } else { // If multisite isn't enabled, show a recent posts module for the site ?>

						<article id="news-module" class="module row news clearfix">
							<h2 class="module-heading"><a href="/news/">News</a></h2>
							<ul class="news-list">
								<?php 
								// WP_Query arguments
								$recentargs = array (
									'post_type'              => 'post',
									'ignore_sticky_posts'    => false,
								);

								// The Query
								$recentposts = new WP_Query($recentargs);
								?>
								<?php while ($recentposts->have_posts()) : $recentposts->the_post(); ?>
								<li>
									<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<p class="post-excerpt"><?php the_excerpt(); ?>
									<span class="meta post-date"><?php the_date(); ?><?php// echo date_i18n(get_option('date_format'),strtotime($date));?></span></p>
								</li>
								<?php endwhile; ?>
							</ul>
						</article>
						<?php // Check to see if Events Manager is active. If not don't display this module.
						if ( is_plugin_active('events-manager/events-manager.php') ) { ?>
						<article id="events-module" class="module row events clearfix">
							<h2 class="module-heading"><a href="/events/">Events</a></h2>
							<ul class="events-list">
								<?php
								$events = EM_Events::output(array('limit'=>5, 
									'format'=>'<li>
									<h6 class="event-start">
                				        <time class="event-month" datetime="#M">#M</time>
                				        <time class="event-date" datetime="#j">#j</time>
                				        <time class="event-day" datetime="#D">#D</time>
                					</h6>
									<h3 class="post-title event-title">#_EVENTLINK</h3>
									</li>'));?>
								<?php echo $events; ?>
							</ul>
						</article>
						<?php } ?>


						<?php } ?>

						<?php
						

						// $posts = get_posts('post_type=post');
						// echo "<pre>";
						// var_dump($news);
						// echo "</pre>";

						?>
					</section>

				</div>

			</div>

<?php get_footer(); ?>
