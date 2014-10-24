<?php get_header(); ?>

<div class="content">

	<div class="wrap">

		<?php get_sidebar(); ?>

		<main class="main-partner">

      <?php // add RSS feed to the widget in the admin ?>
			<?php get_sidebar('partner-home'); ?>

		</main>

	</div>

</div>

<?php get_footer(); ?>
