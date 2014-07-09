<?php get_header(); ?>

<main>

	<div class="wrap">

		<div id="main" class="first" role="main">

			<article id="post-not-found" class="hentry clearfix">

				<header class="article-header">

					<h1><?php _e( 'Epic 404 - Article Not Found', 'bonestheme' ); ?></h1>

				</header>

				<section class="entry-content">

					<p><?php _e( 'The article you were looking for was not found, but maybe try looking again!', 'bonestheme' ); ?></p>

				</section>

				<section class="search">

						<p><?php get_search_form(); ?></p>

				</section>

				<footer class="article-footer">

						<p><?php _e( 'This is the 404.php template.', 'bonestheme' ); ?></p>

				</footer>

			</article>

		</div>

	</div>

</main>

<?php get_footer(); ?>
