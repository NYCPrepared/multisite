<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">
					
					<?php get_sidebar ('site_networks'); ?>

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


								<section class="entry-content clearfix" itemprop="articleBody">

									<?php

									$blog_ids = get_post_meta($post->ID, '_community_network_sites');
									$blog_list = implode(",", $blog_ids);									

									if(function_exists( 'network_latest_posts' )) {

										$parameters = array(
											'title'         => '',
											'title_only'    => 'false',
											'auto_excerpt'  => 'true',
											'full_meta'		=> 'true',
											'thumbnail'        => 'true',
											'thumbnail_wh'	   => 'medium',
											'thumbnail_class'  => 'post-image',
											'wrapper_block_css'=> 'network-posts',
											'instance'         => 'network-posts',
											'blog_id'          => $blog_list,
											'category'         => 'News',
											'number_posts'     => '25', 
										);
										// Execute
										$posts = network_latest_posts($parameters);
									}

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
