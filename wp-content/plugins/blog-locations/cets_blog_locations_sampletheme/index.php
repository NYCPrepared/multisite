<?php get_header(); ?>
  <div id="mainContent">
  		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
			<div class="entry">
				
                <div class="entry-head">
                    <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link:');?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
                    <div class="entry-meta">
                    <p><span class="entry-author">By <?php the_author_posts_link(); ?></span> <span class="entry-date"><?php the_time(get_option('date_format')); ?></span> <span class="entry-category">Categories: <?php the_category(', '); ?></span> <span class="entry-commentcount"><?php comments_popup_link('No Comments', '1 Comment', '[%] Comments'); ?></span> <span class="entry-edit"><?php edit_post_link('Edit'); ?></span></p>
                    </div> <!-- /.entry-meta -->
                </div> <!-- /.entry-head -->
                
                <div class="entry-content">
                    <?php the_content(); ?>
                    <div class="entry-info">
                        <?php wp_link_pages(); ?>											
                    </div>
                    
                </div>
                
                <div class="entry-footer entry-meta"><p><?php the_tags(); ?></p></div>
                    
                <div class="comments"><?php comments_template(); // Get wp-comments.php template ?></div> <!-- /.comment-area -->
                
			</div> <!-- /.entry -->
			<?php endwhile; else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php endif; ?>
		<p align="center"><?php posts_nav_link() ?></p>	
  
    </div><!-- / #mainContent -->
    
  <div id="sideContent1">
  
    <div class="topicListing">
    	<?php 
		if (function_exists('cets_get_recent_posts_from_topic_id')){
		// this is the "featured" topic, which for now let's hardcode to 1	
		$topicid = 1;	
		// Get the recent posts
		$posts = cets_get_recent_posts_from_topic_id($topicid, 1, 0);
		$topic = cets_get_topic($topicid);
		if (sizeOf($posts) > 0) {
			echo ("<h3><a href='topic/" . strtolower($topic->slug) . "'>" . $topic->topic_name . "</a></h3>");
			echo ("<ul>");
			echo(cets_get_recent_posts_from_topic_id_html($topicid, 0, 0));
			echo ("</ul>");
			}
		else {
			echo("There are no recent posts in this topic.");
		}
		}
		?>
    </div> <!-- /.topicListing -->
    </div> <!-- / #sideContent1 -->



<?php get_footer(); ?>
