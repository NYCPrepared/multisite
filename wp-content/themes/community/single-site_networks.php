<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

					<div id="main" class="clearfix" role="main">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<?php $meta = get_post_meta(get_the_ID()); ?>

								<header class="article-header">
								<?php if ( has_post_thumbnail() ) { ?>

									<div class="network banner"><?php the_post_thumbnail('full'); ?></div>

								<?php } else { ?>

									<div class="network no-banner"> </div>

								<?php } ?>

									<h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>

										<ul class="social-links">
										<?php 
										$facebook_url = get_post_meta($post->ID, '_community_facebookurl', true );
										$twitter_url = get_post_meta($post->ID, '_community_twitterurl', true );
										if($facebook_url) {
										  echo '<li class="facebook icon"><a href="' . $facebook_url . '"><span> </span></a></li>';
										} 
										if($twitter_url) {
										  echo '<li class="twitter icon"><a href="' . $twitter_url . '"><span> </span></a></li>';
										} 

										?>

									</ul>

								</header>

								<?php get_sidebar ('site_networks'); ?>

								<section class="entry-content clearfix" itemprop="articleBody">

									<?php

										$network_id = get_the_ID();
										
										if(function_exists('recent_mu_posts')) {
											$network_posts = recent_mu_posts($howMany = 20, $network = $network_id);

											echo '<ul class="post-list">';

											foreach ($network_posts as $post) {
												global $post;
												setup_postdata( $post );
												$content = $post->post_content;
												$permalink = $post->guid;
												if(function_exists('recent_posts_excerpt')) {
													$post_excerpt = recent_posts_excerpt($count = 20, $content, $permalink, $excerpt_trail = ' ... ');
												} else {
													$post_excerpt = $post->post_content;
												}

												 ?>

												<li id="post-<?php echo $post->post_name; ?>">
													<h3 class="post-title"><a href="<?php echo $post->guid; ?>"><?php the_title(); ?></a></h3>
													<p class="post-excerpt"><?php echo $post_excerpt; ?></p>
													<span class="meta post-date"><?php the_date(); ?></span>

												</li>

												<?php
	
											}
											echo '</li>';
										}
										// echo "<pre>";
										// var_dump($network_posts);
										// echo "</pre>";
										?>

								</section>

								<footer class="article-footer">
									<?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>

								</footer>

								<?php comments_template(); ?>

							</article>

						<?php endwhile; ?>

						<?php if ( function_exists( 'bones_page_navi' ) ) { ?>
							<?php bones_page_navi(); ?>
							<?php } else { ?>
								<nav class="wp-prev-next">
									<ul class="clearfix">
										<li class="prev-link"><?php next_posts_link( __( '&laquo; Older Entries', 'bonestheme' )) ?></li>
										<li class="next-link"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'bonestheme' )) ?></li>
									</ul>
								</nav>
						<?php } ?>

						<?php else : ?>

							<article id="post-not-found" class="hentry clearfix">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'This is the error message in the single.php template.', 'bonestheme' ); ?></p>
									</footer>
							</article>

						<?php endif; ?>

					</div>

				</div>

			</div>

<?php get_footer(); ?>
