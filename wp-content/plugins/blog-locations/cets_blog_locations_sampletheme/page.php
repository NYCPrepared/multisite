<?php get_header(); ?>
  <div id="mainContent">
  			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
			<div class="entry">
				
                <h2 id="pageTitle"><?php the_title(); ?></h2>
                    
                <div class="entry-content">
                    <?php the_content(); ?>
                    <div class="entry-info">
                        <?php wp_link_pages(); ?>											
                    </div> <!-- /.entry-info -->
                    
                </div> <!-- /.entry-content -->
                    
			</div> <!-- /.entry -->
			<?php endwhile; else: ?>
			<p><?php _e('Sorry, no topics matched your criteria.'); ?></p>
			<?php endif; ?>
		<p align="center"><?php posts_nav_link() ?></p>	
  
    </div> <!-- end #mainContent -->

  <div id="sideContent1">

  </div> <!-- end #sideContent1 --> 

<?php get_footer(); ?>
