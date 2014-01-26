<?php
/*
Template Name: Custom Page Example
*/
?>

<?php get_header(); ?>

<?php global $wpquery, $networkid; ?>

<?php
// check to make sure the functions we need exists
if (function_exists(glo_get_network_id_from_slug)) {
	// use the query var (text) to get the networkid (int)
	$networkvar = explode("/", $wp_query->query_vars['network']);
	$networkid = glo_get_network_id_from_slug($networkvar[0]);
	// return an object with the network info
	$network = glo_get_network($networkid);
	$network_name = glo_get_network_name($networkid);
	$network_description = $network->description;
	
	// Get the recent posts
	$posts = glo_get_recent_posts_from_network_id($networkid, 0, 0);
	
	}

	// echo "<pre>";
	// var_dump($network);
	// echo "</pre>";
	// echo $network_description;

	?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="first clearfix" role="main">

							<header class="article-header">

								<div class="network-banner"></div>
								<h1 class="page-title network-title"><?php echo $network_name; ?></h1>

							</header>


							<?php get_sidebar('network'); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="network-heading">
									<h2>Latest News from Our Members</h2>
								</header>

								<section class="entry-content clearfix" itemprop="articleBody">

									<ul class="post-list">

									<?php if($posts) { 
										foreach($posts as $post) {
											$permalink = get_blog_permalink( $post->blogid, $post->id );
											$post->post_date = date_i18n(get_option('date_format') ,strtotime($post->post_date));  // Format the date
											$post_excerpt = recent_posts_excerpt($count = 20, $post->post_content, $link , $excerpt_trail = '... ');
											$post_title = $post->post_title;
										?>

										<li>
											<h3 class="post-title"><a href="<?php echo $permalink; ?>"><?php echo $post_title; ?></a></h3>
											<p class="post-excerpt"><?php echo $post_excerpt; ?>
											<span class="meta post-date"><?php echo date_i18n(get_option('date_format') ,strtotime($post->post_date));?></span></p>
										</li>

									<?php }
									} ?>

									</ul>


									<?php// the_content(); ?>
								</section>

								<footer class="article-footer">
									<p class="clearfix"><?php the_tags( '<span class="tags">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '' ); ?></p>

								</footer>

								<?php comments_template(); ?>

							</article>


						</div>

				</div>

			</div>

<?php get_footer(); ?>
