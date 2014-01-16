<?php get_header(); ?>

 <?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

					<section class="home-main clearfix">
						<article class="home-feature clearfix">

							<script type="text/javascript">
							jQuery(document).ready(function(){
							  jQuery('#featured').slippry(pause: 5000)
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

							</ul>

						</article>
						<article class="home-intro">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
								<?php the_content(); ?>
							<?php endwhile; endif; ?>
						</article>
					</section>
					<section class="home-modules clearfix">
						<article class="module row volunteers clearfix">
							<h3 class="module-heading">Volunteers needed</h3>
							<ul class="volunteer-list">
								<li></li>
							</ul>
						</article>
						<article class="module row news clearfix">
							<h3 class="module-heading">News</h3>
							<ul class="news-list">
								<li></li>
							</ul>
						</article>
						<?php // check for plugin using plugin name
						if ( is_plugin_active('events-manager/events-manager.php') ) { ?>
						<article class="module row events clearfix">
							<h3 class="module-heading">Events</h3>
							<ul class="events-list">
								<?php
								$events = EM_Events::output(array('limit'=>5, 
									'format'=>'<li><span class="event-month">#M</span>
									<span class="event-date">#j</span>
									<span class="event-day">#D</span>
									<h4 class="post-title event-title">#_EVENTLINK</h4></li>'));?>
								<?php echo $events; ?>
							</ul>
						</article>
						<?php } ?>
						<article class="module row sites clearfix">
							<h3 class="module-heading">Sites</h3>
							<ul class="sites-list">

							<?php
							$siteargs = array(
								'limit'      => 5,
							    'offset'     => 1,
							    );
							$sites = wp_get_sites($siteargs);
							rsort($sites);

							foreach ($sites as $site) {
								$site_id = $site['blog_id'];
								$site_details = get_blog_details($site_id);
								?>
							
								<li id="site-<?php echo $site_id; ?>">
									<h4 class="post-title site-title"><a href="<?php echo $site_details->path; ?>" title="<?php echo $site_details->blogname; ?>"><?php echo $site_details->blogname; ?></a></h4>
									<div class="site-meta modified-date"><span class"modified-date">Last Updated</span> <?php echo date_i18n(get_option('date_format') ,strtotime("$site_details->last_updated;"));?></div>
								</li>
							
								<?php }
							// echo "<pre>";
							// var_dump($sites);
							// echo "</pre>";
							?>
							</ul>

						</article>
					</section>

				</div>

			</div>

<?php get_footer(); ?>
