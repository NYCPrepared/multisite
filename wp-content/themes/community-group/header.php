<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<?php // Google Chrome Frame for IE ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title><?php wp_title(''); ?></title>

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-touch.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

		<?php // drop Google Analytics Here ?>
		<?php // end analytics ?>
		
        <link rel="stylesheet" href="http://localhost/multisite/wp-content/themes/community/library/css/style.css">
        
	</head>

	<body <?php body_class(); ?>>

		<div id="container">

			<header class="header" role="banner">

				<div id="inner-header" class="wrap clearfix">

					<?php  // Get the site info for the main site
					$blog_details = get_blog_details(1);
					?>

 					<p class="domain-title"><a href="<?php echo $blog_details->siteurl; ?>" rel="nofollow"><?php echo $blog_details->blogname; ?></a></p>
					<ul id="nav-anchors" class="nav-anchors">
                    	<li><a href="#nav" class="menu-anchor" id="menu-anchor" title="menu"></a></li>
                    	<li><a href="#search" class="search-anchor" id="search-anchor" title="search"></a></li>
                    </ul>
					<div class="search-form" id="search">
					    <?php get_search_form(); ?>
					</div>
					<nav class="main-nav" id="global-nav" role="navigation">
					<?php
					if(function_exists('community_navigation')) {
						$global_nav = community_navigation();
						echo $global_nav;
					}
					?>
					</nav>

					<div class="site-banner">
						<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
					</div>
					<h1 class="site-name">
						<a href="<?php echo home_url(); ?>" rel="nofollow"><?php bloginfo('name'); ?></a>
					</h1>
					<ul class="social-links icons-NYCP">
					    <li class="twitter"><a href="" target="_blank"></a></li>
					    <li class="facebook"><a href="" target="_blank"></a></li>
                    </ul>
					<?php // bloginfo('description'); ?>

					<nav class="site-nav" id="local-nav" role="navigation">
						<?php bones_main_nav(); ?>
						<div class="search-form" id="search">
						    <?php get_search_form(); ?>
						</div
					</nav>

				</div>

			</header>
