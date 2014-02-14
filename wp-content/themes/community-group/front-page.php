<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="group-main first clearfix" role="main">

							<header class="page-header">
								<div class="social-links">
									<ul>
										<li class="rss"><a href="/feed" target="_blank"></a></li>
									</ul>
								</div>
								<h2 class="page-title">Latest News</h2>
							</header>

							<?php// query_posts('posts_per_page=10'); ?>

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article class="post news siteid-3">
								<header class="post-header">
									<div class="post-date date"><?php the_date(); ?></div>
									<?php echo get_the_category_list(); ?>
								</header>
								<section class="post-body">
									<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<div class="post-image"><?php echo get_the_post_thumbnail($page->ID, 'medium'); ?></div>
									<div class="post-excerpt"><?php the_excerpt(); ?></div>
								</section>
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
												<p><?php _e( 'This is the error message in the index.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div>

						<?php get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
