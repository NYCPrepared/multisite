<?php get_header(); ?>

<header class="header-local">

	<div class="wrap">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

			<?php $meta = get_post_meta(get_the_ID()); ?>

			<header class="network-header">
			
		        <ul class="social-links">
					<?php 
					$facebook_url = get_post_meta($post->ID, 'community_facebookurl', true );
					$twitter_url = get_post_meta($post->ID, 'community_twitterurl', true );
					if($facebook_url) {
					  echo '<li class="facebook icon"><a href="' . $facebook_url . '"><span> </span></a></li>';
					} 
					if($twitter_url) {
					  echo '<li class="twitter icon"><a href="' . $twitter_url . '"><span> </span></a></li>';
					} 
					?>
				</ul>

				<?php if ( has_post_thumbnail() ) { ?>
					<div class="network banner"><?php the_post_thumbnail('full'); ?></div>
				<?php } else { ?>
					<div class="network no-banner"> </div>
				<?php } ?>

				<h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>
		        <h4 class="subtitle">Network News</h4>
				
			</header>

		</article>	

		<?php endwhile; ?>
		<?php endif; ?>



	</div>

</header>




<div class="content">

	<div class="wrap">


		<?php get_sidebar ('site_networks'); ?>


		<main class="main-network" role="main">


			<?php

			$blog_ids = get_post_meta($post->ID, 'community_network_sites');
			$blog_list = implode(",", $blog_ids);									

			if(function_exists( 'network_latest_posts' )) {

				$parameters = array(
					'title_only'    => 'false',
					'auto_excerpt'  => 'true',
					'full_meta'		=> 'true',
					'show_categories'    => 'true', 
					'display_type'		=> 'block',
					'thumbnail'        => 'true',
					'thumbnail_wh'	   => 'large',
					'thumbnail_class'  => 'post-image',
					'wrapper_list_css' => 'post-list',
					'wrapper_block_css'=> 'network-posts', //  wrapper class to add
					'instance'         => 'network-posts', // wrapper ID to add
					'paginate'         => 'true',        // paginate results
					'blog_id'          => $blog_list,
					'posts_per_page'   => 25,
				);
				// Execute
				$posts = network_latest_posts($parameters);
			}

			?> 

		</main>

	</div>

</div>

<?php get_footer(); ?>
