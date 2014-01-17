<?php get_header(); ?>

 <?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

					<section class="home-main clearfix">
						<article class="home-feature clearfix">

							<script type="text/javascript">
							jQuery(document).ready(function(){
							  jQuery('#featured').slippry({pause: 5000})
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
							<h2 class="module-heading">Volunteers Needed</h2>
							<ul class="volunteer-list">
								<li>
									<h3 class="post-title"><a href="#">Mold remediation in the Rockaways</a></h3>
									<p class="post-excerpt">We need 10 people to help us clean up a community center this weekend. <span class="location">Far Rockaway</span></p>
								</li>
								<li>
									<h3 class="post-title"><a href="#">Accounting Help</a></h3>
									<p class="post-excerpt">Excel expert would be greatly appreciated! <span class="location">Remote</span></p>
								</li>
							</ul>
						</article>
						<article class="module row news clearfix">
							<h2 class="module-heading">News</h2>
							<ul class="news-list">
								<li>
									<h3 class="post-title"><a href="#">CKAN 2.1 released</a></h3>
									<p class="post-excerpt">We are happy to announce that the new CKAN 2.1 version is available to download and install. This version adds exciting new features, including an interface for bulk dataset updates (shown below), improved previews for text files, a new redesigned dashboard and significant improvements to the documentation.</p>
									<span class="meta post-date">02-01-2014</span>
								</li>
								<li>
									<h3 class="post-title"><a href="#">Ten design teams selected for stage two of Rebuild by Design</a></h4>
									<p class="post-excerpt">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. </p>
									<span class="meta post-date">02-05-2014</span>
								</li>
							</ul>
						</article>
						<?php // check for plugin using plugin name
						if ( is_plugin_active('events-manager/events-manager.php') ) { ?>
						<article class="module row events clearfix">
							<h2 class="module-heading">Events</h2>
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
							<h2 class="module-heading">Sites</h2>
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
									<h3 class="post-title site-title"><a href="<?php echo $site_details->path; ?>" title="<?php echo $site_details->blogname; ?>"><?php echo $site_details->blogname; ?></a></h3>
									<h5 class="site-meta modified"><span class"modified-title">Last updated</span> <time><?php echo date_i18n(get_option('date_format') ,strtotime("$site_details->last_updated;"));?></time></h5>
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
