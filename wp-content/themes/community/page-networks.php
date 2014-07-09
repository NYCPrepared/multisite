<?php get_header(); ?>

<main>

	<div class="wrap">

		<div id="main" class="first clearfix" role="main">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article">

				<header class="article-header">

					<h1 class="page-title"><?php the_title(); ?></h1>

				</header>

				<section class="entry-content clearfix">

					<ul class="post-list">
					<?php
					$posts = get_posts('post_type=network');
					foreach ($posts as $post) {
					?>

						<li><h3 class="post-title network-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3></li>

					<?php } ?>
					</ul>
				</section>

				<footer class="article-footer">
					<p class="tags"><?php the_tags( '<span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '' ); ?></p>

				</footer>

				<?php // comments_template(); // uncomment if you want to use them ?>

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

</main>

<?php get_footer(); ?>
