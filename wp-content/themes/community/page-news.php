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
						<div id="main" class="content first clearfix" role="main">
						<?php
						if(function_exists('recent_network_posts')) {
							$news_posts = recent_network_posts($numberposts = 50); // This adjusts total number of posts
							foreach ($news_posts as $post) {
								$blog_details = get_blog_details($post->blog_id);
								$title = $post->post_title;
								$content = $post->post_content;
								$permalink = $post->post_url;
								$date = $post->post_date;
								// $count is the number of words to display in the excerpt; change as desired
								// $excerpt_trail is the trailer after the excerpt, it will link to the post; change as desired
								$post_excerpt = recent_posts_excerpt($count = 55, $content, $permalink, $excerpt_trail = '... ');

							?>
							<article class="<?php $post->post_name; ?>">
								<header class="post-header">
									<h2 class="post-title"><a href="<?php echo $post->post_url; ?>"><?php echo $title; ?></a></h2>
									<p class="post-author"><a href="<?php echo $blog_details->path; ?>"><?php echo $blog_details->blogname; ?></a></p>
									<p class="post-author"><?php echo date_i18n(get_option('date_format') ,strtotime($date));?></time></p>
								</header>
								<section class="post-body"><?php echo $post_excerpt; ?></section>
								<footer class="post-footer">
									<ul class="meta taxonomy categories">
									<?php
									foreach ($post->post_categories as $key => $value) {
									?>
										<li id="category-<?php echo $value['slug']; ?>"><?php echo $value['nice_link']; ?></li>
									<?php } ?>
									</ul>
								</footer>
							<article>

						<?php }	
							// echo "<pre>";
							// var_dump($news_posts);
							// echo "</pre>";
						} ?>
						</div>

						<?php get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
