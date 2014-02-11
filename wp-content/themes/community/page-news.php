<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="intro" class="first clearfix" role="intro">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>

								</header>

								<section class="entry-content clearfix" itemprop="articleBody">
									<?php the_content(); ?>
								</section>

								<footer class="article-footer">
									<?php the_tags( '<span class="tags">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '' ); ?>

								</footer>

							</article>

							<?php endwhile; endif; ?>

						</div>
						<div id="main" class="content news-feed first clearfix" role="main">
						<?php
						if(function_exists( 'network_latest_posts' )) {

							$parameters = array(
							'title_only'    => 'false',
							'auto_excerpt'  => 'true',
							'full_meta'		=> 'true',
							'show_categories'    => 'true', 
							'display_type'		=> 'block',
							'thumbnail'        => 'true',
							'thumbnail_wh'	   => 'medium',
							'thumbnail_class'  => 'post-image',
							'wrapper_list_css' => 'post-list',
							'wrapper_block_css'=> 'news', //The wrapper classe
							'instance'         => 'news-page', //The wrapper ID
							'paginate'         => 'true',        // Paginate results
					        'posts_per_page'   => 25, 
							);
							// Execute
							$posts = network_latest_posts($parameters);
						}
						?>

						</div>

				</div>

			</div>

<?php get_footer(); ?>
