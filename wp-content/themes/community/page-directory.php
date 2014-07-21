<?php get_header(); ?>

<div class="content">

	<div class="wrap">

		<main role="main">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> itemscope itemtype="http://schema.org/BlogPosting">

				<header class="article-header">

					<ul class="toggle js-menu">
						<li data-view="masonry" class="view-grid is-on">Grid</li>
						<li data-view="vertical" class="view-list">List</li>
					</ul>

					<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>

				</header>

				<section class="entry-content" itemprop="articleBody" rel="main">

				    <h4 class="subtitle">Sites</h4>

					<ul class="filter js-menu">
						<li data-filter="*" class="is-on">All Networks</li>
						<?php
						$networks = get_posts('post_type=network');
						foreach ($networks as $network) {											
						?>
	                        <li data-filter=".network-<?php echo $network->post_name; ?>"><?php echo $network->post_title; ?></li>
						<?php } ?>
					</ul>

					<ul class="sort js-menu">
						<li data-sort="id" class="is-on">Most Recently Added</li>
						<li data-sort="slug">Alphabetically</li>
						<li data-sort="posts">Most Active</li>
					</ul>

					<ul class="sites-list view-grid" id="isotope">
						<?php
						$sites = wp_get_sites('offset=1');

						foreach ($sites as $site) {
							$site_id = $site['blog_id'];
							$site_details = get_blog_details($site_id);
							$site_options = get_blog_option($site_id, 'theme_mods_community-group');
							$site_image = $site_options['community_site_image'];
							$site_path = $site_details->path;
							$site_slug = str_replace('/','',$site_path);

							// Get post count for each site
							$site_details = get_blog_details($site_id);

							// Find Network pages that are associated with this site
							$args = array (
								'post_type'         => 'network',
								'meta_query'        => array(
									array(
										'key'       => 'community_network_sites',
										'value'     => $site_id,
										'compare'   => '=',
									),
								),
							);
							$network_query = new WP_Query( $args );

							?>
							<?php
							if(function_exists('community_get_site_image')) {
								$header = community_get_site_image($site_id);
							} ?>

							<li class="isomote id-<?php echo $site_id; ?> site-<?php echo $site_slug; ?> network-<?php foreach($network_query as $post){ echo $post->post_name;} ?>" data-id="<?php echo $site_id ?>" data-slug="<?php echo $site_slug ?>" data-posts="<?php echo $site_details->post_count; ?>">
								<a href="<?php echo $site_details->siteurl; ?>" class="item-image <?php if(!$header) { echo 'no-image'; } ?>" style="background-image: url('<?php if($header) { echo $header; } ?>');"></a>
								<h3 class="item-title"><a href="<?php echo $site_details->siteurl; ?>"><?php echo $site_details->blogname; ?></a></h3>
								<h6 class="meta item-network"><?php foreach($network_query as $post){ echo $post->post_title;} ?></h6>
								<h6 class="meta item-posts">
								<?php
									if($site_details->post_count) {
										echo $site_details->post_count . ' posts';
									}
								?>
								</h6>
								<h6 class="meta item-topic"></h6>
							</li>

						<?php } ?>

					</ul>
					
				</section>

				<section class="entry-content" itemprop="articleBody" rel="main">

				    <h4 class="subtitle">Networks</h4>

					<ul class="networks-list">
						<?php
							$networks = get_posts('post_type=network');
							foreach ($networks as $network) {
								setup_postdata($post);
								// $thumbnail = get_the_post_thumbnail($network->ID, 'thumbnail'); 
								$content = get_the_content(' ...');
								$permalink = get_permalink($network->ID);
								$thumbnailurl = wp_get_attachment_image_src( get_post_thumbnail_id($network->ID), 'full' );
								$thumbnail = $thumbnailurl['0'];
								if(function_exists('get_excerpt_by_id')) {
									$excerpt = get_excerpt_by_id($network->ID, '25');
								} else {
									$excerpt = $network->post_content;
								}

							?>
							<li id="network-<?php echo $network->post_name; ?>">
								<a href="<?php echo $permalink; ?>" class="item-image" style="background-image: url(' <?php echo $thumbnail; ?> ');"></a>
								<h3 class="item-title"><a href="<?php echo $permalink; ?>"><?php echo $network->post_title; ?></a></h3>
								<h6 class="meta item-excerpt"><?php echo $excerpt; ?></h6>
							</li>
							<?php } ?>

					</ul>
					
				</section>

				<section class="promo-directory">

				    <h4 class="subtitle">Join the directory</h4>
					<a class="button" href="/register" title="Register">Register</a>

				</section>

				<?php comments_template(); ?>

			</article>


			<?php endwhile; else : ?>

					<article id="post-not-found" class="hentry clearfix">
						<header class="article-header">
							<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
						</header>
						<section class="entry-content">
							<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
						</section>
						<footer class="article-footer">
                            <p><?php _e( 'This is the error message in the page.php template.', 'bonestheme' ); ?></p>
						</footer>
					</article>

			<?php endif; ?>

		</main>

			

	</div>

</div>

<script>
$(document).ready(function() {

  var $container = $('#isotope');
  
  // init Isotope
  $container.isotope({
    itemSelector: '.isomote',
    layoutMode: 'masonry',
    masonry: {
        columnWidth: 285, 
        gutter: 20
    },
    getSortData: {
        id: '[data-id]', 
        slug: '[data-slug]', 
        posts: '[data-posts]'
    },
    sortAscending: {
        id: false,
        slug: true,
        posts: false
    },
    sortBy: 'id'
  });

  // filter
  $('.filter').on( 'click', 'li', function() {
    var filterValue = $(this).attr('data-filter');
    $container.isotope({ filter: filterValue });
  });

  // sort
  $('.sort').on( 'click', 'li', function() {
    var sortValue = $(this).attr('data-sort');
    $container.isotope({ 
        sortBy: sortValue
    });
  });
  

  // change view
  $('.toggle').on('click', 'li', function() {
    if ($(this).hasClass('view-grid')) {
        $('#isotope').removeClass('view-list').addClass('view-grid');
    }
    else if($(this).hasClass('view-list')) {
        $('#isotope').removeClass('view-grid').addClass('view-list');
    }
    var viewValue = $(this).attr('data-view');
    $container.isotope({ layoutMode: viewValue });
  });

  // change is-on class
  $('.js-menu').each(function(i, focus) {
    var $focus = $(focus);
    $focus.on('click', 'li', function() {
      $focus.find('.is-on').removeClass('is-on');
      $(this).addClass('is-on');
    });
  });


});

</script>




<?php get_footer(); ?>
