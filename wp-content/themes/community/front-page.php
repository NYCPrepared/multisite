<?php get_header(); ?>

 <?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); ?>
 <?php $sites = wp_get_sites('offset=1'); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

					<section class="home-main clearfix">
						<article class="home-feature clearfix">

							<script type="text/javascript">
							jQuery(document).ready(function(){
							  jQuery('#featured').slippry({pause: 5000})
							  adaptiveHeight: false
							});
							</script>

							<ul id="featured" class="featured-posts bxslider">

								<?php
								$sticky = get_option( 'sticky_posts' );
								rsort( $sticky );
								$sticky = array_slice( $sticky, 0, 5 );
								$featuredposts = new WP_Query( array( 'post__in' => $sticky, 'ignore_sticky_posts' => 1 ) );

								while ($featuredposts->have_posts()) : $featuredposts->the_post();

									$permalink = get_permalink();
									$title = get_the_title();
									$imagearg = array(
										'title'	=> trim(strip_tags($title)),
										'alt'	=> trim(strip_tags($title))
									);
								?>


								<li class="featured-post">
									<a href="<?php echo $permalink; ?>" title="<?php echo get_the_title();?>">
									<?php echo get_the_post_thumbnail($page->ID, 'large', $imagearg); ?>
									</a>
								</li>

							<?php endwhile; ?>
							<?php wp_reset_query(); ?> 

							</ul>

						</article>
						<article class="home-intro">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
								<?php the_content(); ?>
							<?php endwhile; endif; ?>
							<?php wp_reset_query(); ?> 
						</article>
					</section>

					<section class="home-modules clearfix">
						<article class="module row volunteers clearfix">
							<h2 class="module-heading"><a href="#">Volunteers Needed</a></h2>
							<ul class="volunteer-list">
								<?php 
								if(function_exists('recent_network_posts')) {
									$volunteer_posts = recent_network_posts($numberposts = 5, $postsperblog = 3, $postcat = 'Volunteers');
									foreach ($volunteer_posts as $post) {
										$title = $post->post_title;
										$content = $post->post_content;
										$permalink = $post->post_url;
										$post_excerpt = recent_posts_excerpt($count = 20, $content, $permalink, $excerpt_trail = '... ');
									?>
									<li>
										<h3 class="post-title"><a href="<?php echo $permalink; ?>"><?php echo $title; ?></a></h3>
										<p class="post-excerpt">
											<?php echo $post_excerpt; ?>
											<span class="meta location">{Custom Field}</span>
										</p>
									</li>

								<?php }

								}
								?>
							</ul>
						</article>
						<script>
						
						</script>
						<article id="news-module" class="module row news clearfix">
							<h2 class="module-heading"><a href="#">News</a></h2>
							<ul class="news-list">
								<?php 
								if(function_exists('recent_network_posts')) {
									$recent_posts = recent_network_posts($numberposts = 5, $excludepostcat = 'Volunteers');
									foreach ($recent_posts as $post) { 
										$title = $post->post_title;
										$content = $post->post_content;
										$permalink = $post->post_url;
										$post_excerpt = recent_posts_excerpt($count = 20, $content, $permalink, $excerpt_trail = '... ');
										$date = $post->post_date;
									?>
								<li>
									<h3 class="post-title"><a href="<?php echo $permalink; ?>"><?php echo $title; ?></a></h3>
									<p class="post-excerpt"><?php echo $post_excerpt; ?>
									<span class="meta post-date"><?php echo date_i18n(get_option('date_format') ,strtotime($date));?></span></p>
								</li>
								<?php }
								}
								?>
							</ul>
						</article>
						<?php // check for plugin using plugin name
						if ( is_plugin_active('events-manager/events-manager.php') ) { ?>
						<article class="module row events clearfix">
							<h2 class="module-heading"><a href="#">Events</a></h2>
							<ul class="events-list">
								<?php
								$events = EM_Events::output(array('limit'=>5, 
									'format'=>'<li><span class="event-month">#M</span>
									<span class="event-date">#j</span>
									<span class="event-day">#D</span>
									<h3 class="post-title event-title">#_EVENTLINK</h3></li>'));?>
								<?php echo $events; ?>
							</ul>
						</article>
						<?php } ?>
						<article class="module row sites clearfix">
							<h2 class="module-heading"><a href="#">Sites</a></h2>
							<ul class="sites-list">

							<?php
							foreach ($sites as $site) {
								$site_id = $site['blog_id'];
								$site_details = get_blog_details($site_id);
								?>
							
								<li id="site-<?php echo $site_id; ?>">
    								<img class="post-thumbnail site-thumbnail" src="">
									<h3 class="post-title site-title"><a href="<?php echo $site_details->path; ?>" title="<?php echo $site_details->blogname; ?>"><?php echo $site_details->blogname; ?></a></h3>
									<h6 class="site-meta modified"><span class"modified-title">Last updated</span> <time><?php echo date_i18n(get_option('date_format') ,strtotime($site_details->last_updated));?></time></h6>
								</li>
							
								<?php } ?>
							</ul>

						</article>

						<?php 
						
						// echo "<pre>";
						// var_dump($recent_posts);
						// echo "</pre>";

						// $posts = get_posts('post_type=post');
						// echo "<pre>";
						// var_dump($posts);
						// echo "</pre>";

						?>
					</section>

				</div>

			</div>

<?php get_footer(); ?>
