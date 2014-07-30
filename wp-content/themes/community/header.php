<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

<head>
	<meta charset="utf-8">

	<?php // Google Chrome Frame for IE ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?php wp_title( '|', true, 'right' ); echo get_bloginfo( 'name' ); ?></title>

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

</head>

<body <?php body_class('community-network'); ?>>

	<div id="container">

		<header class="header-global">

			<div class="wrap">

					<p class="domain-title"><a href="<?php echo home_url(); ?>" rel="nofollow"><?php bloginfo('name'); ?></a></p>
				<?php // to use a image just replace the bloginfo('name') with your img src and remove the surrounding <p> ?>

				<nav role="navigation" class="menu-global">
					<ul class="nav-anchors js-anchors">
                    	<li><a href="#menu-main-navigation" class="anchor-menu" title="menu"><?php bloginfo('name'); ?></a></li>
                    	<li><a href="#search-global" class="anchor-search" title="search"></a></li>
                    </ul>
					<div class="search-form" id="search-global">
					    <?php get_search_form(); ?>
					</div>

					<?php
					//This is the global navigation that appears across all sites in the WP network
					bones_main_nav(); ?>
				</nav>

				<?php // if you'd like to use the site description you can un-comment it below ?>
				<?php // bloginfo('description'); ?>

			</div>

		</header>
