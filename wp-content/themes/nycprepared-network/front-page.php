<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

					<section class="home-main clearfix">
						<article class="left home-feature eightcol first clearfix">

							<ul class="featured-posts">

							<?php
							/* Get all Sticky Posts */
							$sticky = get_option( 'sticky_posts' );

							/* Sort Sticky Posts, newest at the top */
							rsort( $sticky );

							/* Get top 5 Sticky Posts */
							$sticky = array_slice( $sticky, 0, 5 );

							/* Query Sticky Posts */
							$featuredposts = new WP_Query( array( 'post__in' => $sticky, 'ignore_sticky_posts' => 1 ) );
							while ($featuredposts->have_posts()) : $featuredposts->the_post();

							$permalink = get_permalink();
							?>

							<li class="featured-post">
								<a href="<?php echo $permalink; ?>" title="<?php echo get_the_title();?>">
								</h3><?php the_title('<h3 class="post-title">','</h3>'); ?>
								<div class="post-image"><?php the_post_thumbnail('large'); ?></div>
								<div class="post-meta"></div>
								</a>
							</li>

							<?php endwhile; ?>

							</ul>

						</article>
						<article class="right home-main fourcol">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
								<?php the_content(); ?>
							<?php endwhile; endif; ?>
						</article>
					</section>
					<section class="home-modules clearfix">
						<article class="module row volunteers clearfix">
							<h3 class="module-heading">Volunteers</h3>
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
						<article class="module row events clearfix">
							<h3 class="module-heading">Events</h3>
							<ul class="events-list">
								<?php
								$events = EM_Events::output(array('limit'=>5, 
									'format'=>'<li><span class="event-month">#M</span>
									<span class="event-date">#j</span>
									<span class="event-day">#D</span>
									<h4 class="post-title event-title">#_EVENTLINK</h4></li>'));
								?>

								<?php echo $events; ?>
							</ul>
						</article>
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
