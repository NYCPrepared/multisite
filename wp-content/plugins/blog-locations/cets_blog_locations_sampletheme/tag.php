<?php
// Setting the theme options for use on this template
global $options;
foreach ($options as $value) {
	if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>

<?php get_header(); ?>
  <div id="mainContent">
  	
    <h2 id="pageTitle"><?php if ($ceblogs_tag_linkpage != "") { ?><a href="<?php echo $ceblogs_tag_linkpage; ?>">Posts Tagged As:</a><?php } else { ?>Posts Tagged As:<?php }; ?> <span class="tag_title"><?php single_tag_title(); ?></span></h2>
	<?php if ($paged < 2 ) { ?>
	<div class="tagDescription"><?php echo tag_description(); ?></div>
 	<?php } else { ?>
    <p align="center"><?php posts_nav_link() ?></p>	
    <?php } ?>
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
			<div class="tag-post">
                <h3 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php _e('Permanent Link:');?> <?php the_title(); ?>"><?php the_title(); ?></a></h3>
                <?php
				if (isSet($options['linkpage']) && strlen($options['linkpage'])){
				echo('<p class="more"><a href="' . $options['linkpage'] . '">(More)</a></p>');
				}
				?>
                <div class="entry-content">
                    <?php the_excerpt(); ?>
                </div> <!-- /.entry-content -->
                <div class="post-meta">
                <span class="postedBy">Posted by: <span class="author"><?php the_author(); ?></span></span> on <span class="date"><?php the_date(); ?></span> | <?php the_tags(); ?>
                </div> <!-- /.post-meta -->    
			</div> <!-- /.tag-post -->
			<?php endwhile; else: ?>
			<p><?php _e('Sorry, no posts matched this tag.'); ?></p>
			<?php endif; ?>
		<p align="center"><?php posts_nav_link() ?></p>	
  
    </div> <!-- end #mainContent -->

<?php get_footer(); ?>
