<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://www.w3.org/2005/10/profile">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <title><?php wp_title(); ?> <?php bloginfo('name'); ?></title>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	
	<link rel="alternate" type="application/rss+xml" title="Full <?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
    <?php get_fyiTopicRSSforHead(); ?>
    
    
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  
    <?php wp_enqueue_script('jquery'); ?>
	
	<?php
	global $wp_query;
	$imageurl = get_template_directory_uri() . "/images/homeimage.jpg";
	$imagefile = get_template_directory() . "/images/homeimage.jpg";
	$desc = "<p>Cooperative Extension educators don’t lecture or give grades in a typical classroom. Instead, we deliver education where people live and work –
	  on the farm, in schools and community centers.</p> <p><em>For Your Information</em> is a network of educator sites that continues this tradition online.</p>";
	$title = "Welcome";
	// if this is either a topic page or a sitelist page, grab the slug
	if (isset($wp_query->query_vars['topic']) || isset($wp_query->query_vars['sitelist'])){
		if (isset($wp_query->query_vars['topic'])) {
			$slug = $wp_query->query_vars['topic'];
		}
		if (isset($wp_query->query_vars['sitelist'])) {
			$slug = $wp_query->query_vars['sitelist'];
		}
		
		if (function_exists(cets_get_topic_id_from_slug)){
		// use the query var (text) to get the topicid (int)
		$topicid = cets_get_topic_id_from_slug($slug);
		// return an object with the topic info
		$topic = cets_get_topic($topicid);
		}
		if (strlen($slug)){
			$imageurl = get_template_directory_uri() . "/images/topics/" . $topic->slug . ".png";
			$imagefile = get_template_directory() . "/images/topics/" . $topic->slug . ".png";
		}
		$desc = "<p>" . $topic->description . "</p>";
		$title = $topic->topic_name;

	}
	?>
    
	<?php wp_head(); ?>
    
    <!-- Script to display sites list in multiple columns -->
    <script src="<?php echo get_template_directory_uri(); ?>/js/columnizer.js" type="text/javascript"></script>
    <script type="text/javascript">
    //jQuery.noConflict();
	jQuery(document).ready(function($){
		// http://plugins.jquery.com/project/makeacolumnlists
		$('.siteList').makeacolumnlists({cols:2,colWidth:0,equalHeight:false,startN:1});
	});
	</script>

</head>

<body class="<?php get_fyiBodyClass();?>">

<div id="wrapper">
  <div id="header">
    <h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
  <!-- end #header --></div>
	<ul id="topnav">
	  <?php cets_get_topics_html(true, false, true, true) ?>	
	
  </ul>
 <!-- <br class="clear" />-->
  <div id="pageHeader">
  	<div class="pageHeaderImage">
  		<?php 
		if (file_exists($imagefile)){
			echo("<img src='" . $imageurl . "' alt='' />");
		}
		?>
		</div> <!-- /#pageHeaderImage -->
	
	<h1><?php echo $title; ?></h1>
	<?php echo $desc; ?>
	<br class="clear" />
  
  </div><!-- / #pageHeader -->
  <div id="contentArea">