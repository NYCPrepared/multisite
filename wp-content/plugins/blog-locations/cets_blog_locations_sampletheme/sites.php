<?php
/*
Template Name: Sites
*/

// Set up global vars
global $wpquery;

// Make sure our function exists
if (function_exists('cets_get_topic_id_from_slug')){
// use the query var (text) to get the topicid (int)
$topicid = cets_get_topic_id_from_slug($wp_query->query_vars['sitelist']);
// return an object with the topic info
$topic = cets_get_topic($topicid);

$bloglist = cets_get_blog_details_from_topic_id($topicid, 0, 0, 'alpha'); //$topic_id, $max_rows = 0, $blog_id = 0, $orderby = 'last_updated|alpha'



?>

<?php get_header() ?>
  <div id="mainContent">
    <h2>Sites</h2>
	<?php 
	if (sizeOf($bloglist) > 0) {
	echo("<ul class='siteList'>");
	foreach ($bloglist as $key=>$value) {
		echo "<li><a href='http://" . $bloglist[$key][domain] . $bloglist[$key][path] . "'>" . $bloglist[$key][blogname] . "</a></li>";
	}
	echo("</ul>");
	
	}
	else {
		echo("There are no blogs in this topic.");
	}

} // end of big if statement making sure we have the blog topics plugin
else {
	
	echo ("<p>This page is only useful with the blog topics plugin.</p>");
	
}	
?>
	
    
  </div> <!-- end #mainContent -->
  <div id="sideContent1">
  <!-- 280 x 210 / 280 x 158 -->
    <div class="topicListing">
    </div> <!-- /.topicListing -->
   </div> <!-- end #sideContent1 -->  

<?php get_footer(); ?>

