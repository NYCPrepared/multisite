				<div id="sidebar1" class="sidebar clearfix" role="complementary">

					<div id="network-description" class="widget primary network description">
						<?php the_content(); ?>

						<?php 
							global $wp_query;
							$post_obj = $wp_query->get_queried_object();
							$page_ID = $post_obj->ID;
							$website_url = get_post_meta($page_ID, '_community_websiteurl', true );

							if($website_url) { ?>

								<a href="<?php echo $website_url; ?>" target="_blank" class="button">Visit Our Website</a>

							<?php } ?>
					</div>

					<div id="network-site-list" class="widget primary network site-list">
						<ul>
							<?php 
							$sites = get_post_meta($page_ID, '_community_network_sites');

							foreach ($sites as $key => $value) {
								$site = get_blog_details($value); ?>
								
								<li><a href="?php echo $site->siteurl; ?>"><?php echo $site->blogname; ?></a></li>

							<?php } ?>
						</ul>
					</div>

					<?php if ( is_active_sidebar( 'sidebar1' ) ) : ?>

						<?php dynamic_sidebar( 'sidebar1' ); ?>

					<?php else : ?>

						<?php // This content shows up if there are no widgets defined in the backend. ?>

					<?php endif; ?>

				</div>