=== Site Networks For WPMU===
Contributors: DeannaS
Author URI: http://deannaschneider.wordpress.com
Tags: WPMU site-wide networks, WMPU site-wide categories, WordPress MU, Wordpress Multiuser
Requires at least: 2.9
Tested up to: 3.1.1
Stable tag: trunk



Allows users to categorize blogs by network. Allows users to categorize blogs by network. Includes multiple optional widgets and optional sample theme code.

== Description ==

This plugin creates site-wide networks. Each blog can be identified as belonging to a single network. Blog owners can select a network for their blog at creation time, and through a menu under settings. Blog owners can also choose whether or not to include their content in any site-wide aggregated content via the Site Networks Settings menu.

Site Admins can set up the site-wide networks, select a "featured network," and manage blog's network settings through the Site Admin -> Blogs -> Edit menu.

This plugin comes with 5 optional widgets (in the widgets subdirectory).

1. BT - Network Name - displays the name of the network of the current blog.
2. BT - Related Blogs - displays a linked list of other blogs in the same network.
3. BT - Related Posts - displays the title of the N most recent posts in the same network as the current blog.
4. BT - Featured Network w/Posts - displays the N most recent posts from the "featured" network.
5. BT - Networks w/Posts - displays the N most recent posts from each network, with the option of excluding selected networks.

Some of the widgets rely on theme code for network listing pages and site listing pages, referred to as "portal links." All portal links can be turned on and off in the widgets. This plugin comes with a sample theme to help you learn how to modify your own theme to incorporate the portal elements.


== Installation ==

1. Place the glo_blognetworks.php file and the glo_blog_networks folder in the wp-content/mu-plugins folder.
2. If desired, place the widget files (located in the widgets subdirectory) in the wp-content/mu-plugins or the plugins folder. It's recommended that you use the plugins folder and only enable these widgets on blogs that need them. They may be confusing for some users.
4. Go to Site Admin -> Site Networks Management to add/edit networks. You should enter a name and slug for each network you wish to use. Description is optional. It is used in the BT Network Name widget and in the example theme code.
5. Blog admins can go to Settings -> Site Network to edit their assigned network.

If Use of the Portal Aspects are desired

1. By default, none of the widgets use the portal links. If you want to use the portal links, examine the sample theme. The most relevant bits of code are in rewrites.php, networks.php, and sites.php. The portal code rewrites links such as ?network_id=1 to /network/slug. 



== Frequently Asked Questions ==
1. Can I upgrade from version 0.3.2 to 3.0?
The plugin will attempt to upgrade your database tables from the previous version of this plugin. There are elements from the previous version that are no longer supported, particularly the portal elements. If you had previously used glo_blog_networks_page.php or glo_blog_networks_list.php you will want to carefully examine the sample theme to determine how to integrate the new portal elements into your blog's theme code.



== CHANGELOG ==

1.2
 * Bug fix for featured network setting page
 * Moved sharing/notification settings to privacy page
 * Moved managment menu to network admin page
 * Added notification of blog/site being in "development mode" - ie, not sharing content - and added way to turn off/on notification. Default is notification on.


1.1

* Tweaked uninstall script for 3.0


1.0

* major overhaul of portal aspects
* addition of several columns to database tables
* incorporation of "featured" network


.3.2
* Fixed bug that prevented initially signing up users from setting blog network.

.3.1
* Modified layout code for sign up page to fit new 2.6.3 divs instead of tables.

.3
* Added optional count of blogs by network to glo_blog_networks_page.php page (defaults to showing count). 
	If you don't want to show the count, change line 16 from 
		<?php glo_get_networks_html($used=true, $show_count=false); ?>
		to
		<?php glo_get_networks_html($used=true, $show_count=false); ?>

.2
* modified naming conventions for more consistency throughout.
* fixed set up bug
* fixed bug to not include Donncha's site wide tags blog

== Screenshots ==

1. Back end view of the BT - Networks with Posts widget
2. Front end view of the BT - Networks with Posts widget, including portal links (highlighted in red)
3. Back end view of the BT - Featured Network with Posts widget
4. Front end view of the BT - Featured Network with Posts widget, including portal links (highlighted in red)
5. Back end view of the BT - Network Name widget
6. Front end view of the BT - Network Name widget
7. Back end view of the BT - Related Blogs widget
8. Front end view of the BT - Related Blogs widget
9. Back end view of the BT - Related Posts widget
10. Front end view of the BT - Related Posts widget
11. Back end view of blog admins settings screen.
12. Back end view of the add/edit interface for site admins.
13. Back end view of site admins featured network and uninstall interface.
14. Back end view of site admins blog edit features.
