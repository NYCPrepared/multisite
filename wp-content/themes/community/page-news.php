<?php
// Template Name: Network Posts
// Description: Used to display network-wide posts in the WP multisite network.
?>

<?php get_header(); ?>

<div class="content">

	<div class="wrap">

		<div id="intro" role="intro" class="intro-news">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<article role="article" id="post-<?php the_ID(); ?>" itemscope itemtype="http://schema.org/BlogPosting">

				<header class="post-header">
					<h1 class="post-title" itemprop="headline"><?php the_title(); ?></h1>
				</header>

				<section class="post-body" itemprop="articleBody">
					<?php the_content(); ?>
				</section>

				<footer class="post-footer">
					<?php the_tags( '<h6 class="tags">' . __( 'Tags:', 'bonestheme' ) . '</h6> ', ', ', '' ); ?>
				</footer>

			</article>

			<?php endwhile; endif; ?>

		</div>
		
		
		<main class="main-news" >
		<?php
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
				'wrapper_block_css'=> '', //  wrapper class to add
				'instance'         => '', // wrapper ID to add
				'paginate'         => 'true',        // paginate results
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
