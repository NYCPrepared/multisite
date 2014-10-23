<?php
// Template: Front Page

// This template makes heavy use of the Events Manager and Options Framework plugins and the recent-network-posts function (included in with this theme in recent-network-posts.php).
// Without Events Manager, the events module (module 3) will not appear.
// Without the recent-network-posts function, the network-wide posts (module 1 and module 2) will not appear

?>

<?php get_header(); ?>

<div class="content">

	<div class="wrap">

		<section class="home-start">
		
			<article class="home-intro">
				<!-- Displays any content entered in the page used as the front page -->
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; endif; ?>
			</article>
			
			<article class="home-feature">

				<script type="text/javascript">

				jQuery(document).ready(function(){
				  jQuery('.featured-posts').bxSlider({
				    mode: 'fade',
				    adaptiveHeight: true,
				    captions: true
				  });
				});
				</script>

				<ul id="featured" class="featured-posts bxslider">
				<!-- Displays sticky posts from the current site -->

					<?php
					$sticky = get_option( 'sticky_posts' ); // Fetch an array of sticky posts
					rsort( $sticky ); // Sort by latest first
					$sticky = array_slice( $sticky, 0, 5 ); // Change the last number to show more or less posts
					$featuredposts = new WP_Query( array( 'post__in' => $sticky, 'ignore_sticky_posts' => 1 ) );

					while ($featuredposts->have_posts()) : $featuredposts->the_post();
						$permalink = get_permalink();
						$title = get_the_title();
						// $post_meta = get_post_meta($post->ID, 'community_volunteer_location', true);
						$imagearg = array(
                            'title'	=> trim(strip_tags($title)),
							'alt'	=> trim(strip_tags($title))
						);
					?>

					<li class="featured-post">
						<a href="<?php echo $permalink; ?>" title="<?php echo get_the_title();?>" >
						<?php echo get_the_post_thumbnail($post->ID, 'full', $imagearg); ?>
						</a>
					</li>
					

				<?php endwhile; ?>
				<?php wp_reset_query(); ?> 

				</ul>

			</article>
		</section>

		<section class="home-modules">
			<?php if ( is_multisite() ) { // Check to see if multisite is active. If not, display a recent posts and events module for this site. ?> 

				<?php
				// Get network-wide posts
				get_template_part( 'partials/home-module', 'news' ); ?>

				<?php
				// Get network-wide updates
				get_template_part( 'partials/home-module', 'requests' ); ?>

				<?php
				// Get network-wide events
				get_template_part( 'partials/home-module', 'events' ); ?>

				<?php
				// Get network-wide sites
				get_template_part( 'partials/home-module', 'sites' ); ?>


			<?php } else { // If multisite isn't enabled, show a recent posts module for the site ?>

				<?php
				// Get multisite error message
				get_template_part( 'partials/error', 'multisite' ); ?>
			
			<?php } ?>

		</section>

	</div>

</div>

<?php get_footer(); ?>
