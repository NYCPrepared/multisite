<?php
/*
Template Name: Home
*/

?>


<?php get_header(); ?>
  <div id="mainContent">
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Main Widgets") ) : ?>
  
  	<?php 
  	if (function_exists('cets_get_used_topics')){
  		$topics = cets_get_used_topics();
		if (sizeOf($topics) >1 || (sizeOf($topics == 1) && $topics[0]->id != 1)){
			// if there's only 1 topic, make sure it's not news and communications
			echo ("<h2>Topic Areas</h2>");
			foreach($topics as $topic) {
				if ($topic->id != 1){ // TODO: Convert this to featured topic
					echo("<div class='topicListing " . $topic->slug . "'>");
					echo ("<h3><a href='topic/" . strtolower($topic->slug) . "'>" . $topic->topic_name . "</a></h3>");
					echo ("<ul>");
					echo (cets_get_recent_posts_from_topic_id_html($topic->id, 4, 0));
					echo ("</ul>");
					echo ("<div class='topicMore'>");
					echo ("<a href='/topic/" . strtolower($topic->slug) . "'>(More " . $topic->slug . " Posts</a> | <a href='/sites/" . strtolower($topic->slug) . "'>All " . $topic->slug . " Sites)</a>");
					echo ("</div>");
					echo ("</div>");
				}
			}
		  }	
		  else {
			echo("There are no current topics.");
			}
		}
		
		else {
			
			echo ("<p>Nothing to see here.");
			
		}
	?>
    <?php 
	// end widget area
	endif; 
	?> 
    </div><!-- end #mainContent -->

    
  <div id="sideContent1">
  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sidebar Widgets") ) : ?> 
  <!-- 280 x 210 / 280 x 158 -->
    <object type="application/x-shockwave-flash" data="http://www.youtube.com/v/bWujTT5GD7Q&amp;hl=en&amp;fs=1&amp;rel=0" width="280" height="210"><param name="movie" value="http://www.youtube.com/v/bWujTT5GD7Q&amp;hl=en&amp;fs=1&amp;rel=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param></object>
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
			echo ("<div class='topicMore'>");
			echo ("<a href='/topic/" . strtolower($topic->slug) . "'>(More " . $topic->slug . " Posts</a> | <a href='/sites/" . strtolower($topic->slug) . "'>All " . $topic->slug . " Sites)</a>");
			echo ("</div>");
			}
		else {
			echo("There are no recent posts in this topic.");
		}
		}
		?>
    </div> <!-- / .topicListing -->
    <?php 
	// end widget area
	endif; 
	?> 
    </div><!-- / #sideContent1 --> 


<?php get_footer(); ?>