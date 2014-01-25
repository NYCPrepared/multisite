<?php
/*
Template Name: Topic
*/

// Set some global variables

global $wpquery, $topicid;

// check to make sure the functions we need exists
if (function_exists(cets_get_topic_id_from_slug)){
	// use the query var (text) to get the topicid (int)
	$topicvar = explode("/", $wp_query->query_vars['topic']);
	$topicid = cets_get_topic_id_from_slug($topicvar[0]);
	// return an object with the topic info
	$topic = cets_get_topic($topicid);
	
	// Get the recent posts
	$posts = cets_get_recent_posts_from_topic_id($topicid, 0, 0);
	
	// check to see if this is a feed page
	if (isset($topicvar[1]) && $topicvar[1] == 'feed') {
		$template = TEMPLATEPATH . "/topicfeed.php";
		if (file_exists($template)) {
		require_once($template);
		die();
		echo ("hey we should be on the feed page!");
		}
		
	}

	// get the feed icon
	$imageurl = get_template_directory_uri() . "/images/feed-icon.png";


?>


<?php get_header(); ?>
  <div id="mainContent">
  	
	<?php if (sizeOf($posts) > 0) {
	echo("<h2> Latest Posts <a href='/topic/" . $topicvar[0] . "/feed' class='rss imagereplacement' target='_new'>RSS</a></h2>");
	
	echo("<div class='topicListing'>");
	echo("<ul>");
	foreach ($posts as $post) {
		
		$link = get_blog_permalink( $post->blogid, $post->id );
		$post->post_date = date("m/d/Y",strtotime($post->post_date));  // Format the date
		echo "<li><span class='headline'><a href='" .$link . "'>" . $post->post_title . "</a></span> - <span class='date'>" . $post->post_date . "</span><br />";
		if (strlen(strip_tags($post->post_content)) > 0){
			echo  "<span class='blurb'>" . truncate(strip_shortcodes($post->post_content), "30") . "</span> <br />";
		}
		echo "<span class='sitename'>From: <a href='" . $post->siteurl . "'>" . $post->blogname . "</a></span>";
		echo "</li>";
		
	}
	echo("</ul>");
	echo("</div>");
	}
else {
	echo("There are no recent posts in this topic.");
}
?>
    
    <!-- end #mainContent -->
  </div>
  <div id="sideContent1">
  <!-- 280 x 210 / 280 x 158 -->
  <div class="topicListing">
      <h3>New Sites</h3>
      <?php cets_get_blogs_from_topic_id_html($topicid, 5, 0, 'added'); // change the 2 to the number of sites you want. If you want to pass a class for the UL, it's the last parameter ?>
      <h3>Recently Updated Sites</h3>
      <?php cets_get_blogs_from_topic_id_html($topicid, 20, 0, 'updated'); ?>
        <p class="showAllSites"><a href="/sites/<?php echo $topic->slug; ?> ">Show All <?php echo $topic->topic_name; ?> Sites</a></p>
    </div> <!-- / .topicListing -->
    </div><!-- / #sideContent1 --> 
	<br class="clear" />  
 
 <?php 
 
 } // this ends the if that checks for the blog topics functions- needs to be at bottom of page
 else {
 	echo("<p>This page is to be used with the cets_blog_topics plugin only."); 
	
 }
 ?>

<?php get_footer(); ?>
