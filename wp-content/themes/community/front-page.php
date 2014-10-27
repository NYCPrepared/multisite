<?php
// Template: Home Page
// This template has dependencies:
// 		- Requires that WP multisite is set-up
// 		- Makes heavy use of the Events Manager plugin and a customized Network Latest Posts plugin.
// 			- Without Events Manager, Events will not appear
// 			- Without custom Network Latest Posts, News and Requests (aka Posts and Updates) will not appear
// Some customization is available:
// 		- Which modules appear is selected in the theme's Customization settings 
// 			- Go to: Appearance > Customization > Front Page
// 		- Module heading text can be changed (defaults: News, Requests, Events, Sites)
//		- Module heading links can be added (default: none)
//		- Number of items to display can be specified


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

			<?php 
			if(function_exists('glocal_customization_settings')) {
				$community_settings = glocal_customization_settings();
			} 
			?>

			<?php if ( is_multisite() ) { // Check to see if multisite is active. If not, display a recent posts and events module for this site. ?> 

				<?php
				// Check that modules customization settings are in DB
				if(!empty($community_settings['modules'])) { ?>

					<?php
					// Check if the "posts" module is selected
					if (in_array("posts", $community_settings['modules'])) { ?>

						<?php
						// Get network-wide news
						get_template_part( 'partials/home-module', 'news' ); ?>

					<?php } ?>
					
					<?php
					// Check if the "events" module is selected
					if (in_array("events", $community_settings['modules'])) { ?>

						<?php
						// Get network-wide events
						get_template_part( 'partials/home-module', 'events' ); ?>

					<?php } ?>

					<?php
					// Check if the "updates" module is selected
					if (in_array("updates", $community_settings['modules'])) { ?>

						<?php
						// Get network-wide requests
						get_template_part( 'partials/home-module', 'requests' ); ?>

					<?php } ?>

					<?php
					// Check if the "sites" module is selected
					if (in_array("sites", $community_settings['modules'])) { ?>

						<?php
						// Get network-wide sites
						get_template_part( 'partials/home-module', 'sites' ); ?>

					<?php } ?>

				<?php } else { // Else just show all modules ?>

					<?php
					// Get network-wide news
					get_template_part( 'partials/home-module', 'news' ); ?>

					<?php
					// Get network-wide events
					get_template_part( 'partials/home-module', 'events' ); ?>

					<?php
					// Get network-wide requests
					get_template_part( 'partials/home-module', 'requests' ); ?>
					
					<?php
					// Get network-wide sites
					get_template_part( 'partials/home-module', 'sites' ); ?>

				<?php } ?>

			<?php } else { // If multisite isn't enabled, show an error ?>

				<!-- TODO: Make more meaningful error messages. -->

				<?php
				// Get multisite error message
				get_template_part( 'partials/error', 'multisite' ); ?>
			
			<?php } ?>

		</section>

	</div>

</div>

<?php get_footer(); ?>
