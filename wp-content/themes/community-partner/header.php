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

<body <?php body_class('community-partner'); ?>>

	<div id="container">

		<header class="header-global">

			<div class="inner-header">

				<?php // Get the site info for the main site
				$blog_details = get_blog_details(1);
				?>

					<p class="domain-title"><a href="<?php echo $blog_details->siteurl; ?>" rel="nofollow"><?php echo $blog_details->blogname; ?></a></p>
				<nav role="navigation" class="nav-global">
					<ul class="nav-anchors js-anchors">
                    	<li><a href="#menu-main-navigation" class="anchor-menu" title="menu"><?php echo $blog_details->blogname; ?></a></li>
                    	<li><a href="#search-global" class="anchor-search" title="search"></a></li>
                    </ul>
					<div class="search-form" id="search">
					    <?php get_search_form(); ?>
					</div>
					<?php
					if(function_exists('community_navigation')) {
						$global_nav = community_navigation();
						echo $global_nav;
					}
					?>
				</nav>

			</div>

		</header>


		<header class="header-local" role="banner">

			<div class="inner-header">

				<div class="site-banner">
				    <div class="banner-inner">
					    <img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
				    </div>
                    <h1 class="site-name"><a href="<?php echo home_url(); ?>" rel="nofollow"><?php bloginfo('name'); ?></a></h1>
				</div>
				<?php // bloginfo('description'); ?>


			</div>

		</header>
