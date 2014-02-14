<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<?php get_sidebar(); ?>

						<div id="main" class="partner-main first clearfix" role="main">

							<?php get_sidebar('partner-home'); ?>
							<?php dynamic_sidebar( 'partner-home' ); ?>

						</div>


				</div>

			</div>

<?php get_footer(); ?>
