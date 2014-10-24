=== Nav Menu Roles ===

Contributors: helgatheviking
Donate link: https://inspirepay.com/pay/helgatheviking
Tags: menu, menus, nav menu, nav menus
Requires at least: 3.8
Tested up to: 4.0
Stable tag: 1.6.3
License: GPLv3

Hide custom menu items based on user roles

== Description ==

This plugin lets you hide custom menu items based on user roles.  So if you have a link in the menu that you only want to show to logged in users, certain types of users, or even only to logged out users, this plugin is for you.

Nav Menu Roles is very flexible. In addition to standard user roles, you can customize the functionality by adding your own check boxes with custom labels using the `nav_menu_roles` filter and then using the `nav_menu_roles_item_visibility` filter to check against whatever criteria you need. You can check against any user meta values (like capabilities) and any custom attributes added by other plugins. See the [FAQ](http://wordpress.org/plugins/nav-menu-roles/faq/#new-role).

= IMPORTANT NOTE =

In WordPress menu items and pages are completely separate entities. Nav Menu Roles does not restrict access to content. Nav Menu Roles is *only* for showing/hiding *nav menu* items. If you wish to restrict content then you need to also be using a membership plugin.

= Usage =

1. Go to Appearance > Menus
1. Edit the menu items accordingly.  First select whether you'd like to display the item to all logged in users, all logged out users or to customize by role.
1. If you chose customize by role, then you you can check the boxes next to the roles you'd like to restrict visibility to.
1. If you choose 'By Role' and don't check any boxes, the item will be visible to everyone like normal.

= Support =

Support is handled in the [WordPress forums](http://wordpress.org/support/plugin/radio-button-for-taxonomies). Please note that support is limited and does not cover any custom implementation of the plugin. Before posting, please read the [FAQ](http://wordpress.org/plugins/nav-menu-roles/faq/). Also, please verify the problem with other plugins disabled and while using a default theme. 

Please report any bugs, errors, warnings, code problems to [Github](https://github.com/helgatheviking/Radio-Buttons-for-Taxonomies/issues)

== Installation ==

1. Upload the `plugin` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Go to Appearance > Menus
1. Edit the menu items accordingly.  First select whether you'd like to display the item to all logged in users, all logged out users or to customize by role.
1. If you chose customize by role, then you you can check the boxes next to the roles you'd like to restrict visibility to.
1. If you choose 'By Role' and don't check any boxes, the item will be visible to everyone like normal.

== Screenshots ==

1. Show the new options for the menu items in the admin menu customizer

== Frequently Asked Questions ==

= <a name="conflict"></a>I don't see the Nav Menu Roles options in the admin menu items?  =

This is because you have another plugin (or theme) that is also trying to alter the same code that creates the Menu section in the admin.  

WordPress does not have sufficient hooks in this area of the admin and until they do plugins are forced to replace everything via custom admin menu Walker, of which there can be only one. There's a [trac ticket](http://core.trac.wordpress.org/ticket/18584) for this, but it has been around a while. 

**A non-exhaustive list of known conflicts:**

1. UberMenu 2.x Mega Menus plugin
2. Add Descendants As Submenu Items plugin
3. Navception plugin
4. Suffusion theme
5. BeTheme
6. Yith Menu
7. Kleo Theme
8. Jupiter Theme


= <a name="compatibility"></a>Workaround #1 =
Shazdeh, the author of Menu Item Visibility Control plugin had the [genius idea](http://shazdeh.me/2014/06/25/custom-fields-nav-menu-items/) to not wait for a core hook and simply add the hook ourselves. If all plugin and theme authors use the same hook, we can make our plugins play together.

Therefore, as of version 1.6 I am modifying my admin walker to *only* adding the following line (right after the description input):

`
<?php 
// This is the added section
do_action( 'wp_nav_menu_item_custom_fields', $item_id, $item, $depth, $args );
// end added section 
?>
`

I am then adding my fields to this hook. Ask your conflicting plugin/theme's author to do the same and our plugins should become compatible. 

= Workaround #2 =

As a workaround, you can switch to a default theme (or disable the conflicting plugin), edit the Nav Menu Roles, for each menu item, then revert to your original theme/ reenable the conflicting plugin. The front-end functionality of Nav Menu Roles will still work. 

= I'm using XYZ Membership plugin and I don't see its "levels"? =

There are apparently a few membership plugins out there that *don't* use traditional WordPress roles/capabilities. My plugin will list any role registered in the traditional WordPress way. If your membership plugin is using some other system, then Nav Menu Roles won't work with it out of the box.  Since 1.3.5 I've added a filter called `nav_menu_roles_item_visibility` just before my code decides whether to show/hide a menu item. There's also always been the `nav_menu_roles` filter which lets you modify the roles listed in the admin. Between these two, I believe you have enough to integrate Nav Menu Roles with any membership plugin. 

Here's an example where I've added a new pseudo role, creatively called "new-role".  The first function adds it to the menu item admin screen. The second function is pretty generic and won't actually do anything because you need to supply your own logic based on the plugin you are using.  Nav Menu Roles will save the new "role" info and add it to the item in an array to the `$item->roles` variable.

= <a name="new-role"></a>Adding a new "role"  =

`
/*
 * Add custom roles to Nav Menu Roles menu list
 * param: $roles an array of all available roles, by default is global $wp_roles 
 * return: array
 */
function kia_new_roles( $roles ){
  $roles['new-role-key'] = 'new-role';
  return $roles;
}
add_filter( 'nav_menu_roles', 'kia_new_roles' );
`

Note, if you want to add a WordPress capability the above is literally all you need. Because Nav Menu Roles checks whether a role has permission to view the menu item using `current_user_can($role) you do not need to right a custom callback for the `nav_menu_roles_item_visibility` filter.

In case you *do* need to check your visibility status against something very custom, here is how you'd go about it:

`
/*
 * Change visibilty of each menu item
 * param: $visible boolean
 * param: $item object, the complete menu object. Nav Menu Roles adds its info to $item->roles
 * $item->roles can be "in" (all logged in), "out" (all logged out) or an array of specific roles
 * return boolean
 */
function kia_item_visibility( $visible, $item ){
  if( isset( $item->roles ) && is_array( $item->roles ) && in_array( 'new-role-key', $item->roles ) ){
  /*  if ( // your own custom check on the current user versus 'new-role' status ){
        $visible = true;
      } else {
        $visible = false;
    }
  */  }
  return $visible;
}
add_filter( 'nav_menu_roles_item_visibility', 'kia_item_visibility', 10, 2 );
`

Note that you have to generate your own if/then logic. I can't provide free support for custom integration with another plugin. You may [contact me](http://kathyisawesome.com/contact) to discuss hiring me, or I would suggest using a plugin that supports WordPress' roles, such as Justin Tadlock's [Members](http://wordpress.org/plugins/members).

= What happened to my menu roles on import/export? =

The Nav Menu Roles plugin stores 1 piece of post *meta* to every menu item/post.  This is exported just fine by the default Export tool.

However, the Import plugin only imports certain post meta for menu items.  As of version 1.3, I've added a custom Importer to Nav Menu Roles as a work around.

= How Do I Use the Custom Importer? =

1. Go to Tools>Export, choose to export All Content and download the Export file
1. Go to Tools>Import on your new site and perform your normal WordPress import
1. Return to Tools>Import and this time select the Nav Menu Roles importer.
1. Use the same .xml file and perform a second import
1. No duplicate posts will be created but all menu post meta (including your Nav Menu Roles info) will be imported

== Changelog ==

= 1.6.3 =
* Try again to add languages. Where'd they all go?

= 1.6.2 =
* Add French translation. Props @Philippe Gilles

= 1.6.1 =
* Update list of conflits
* Don't display radio buttons if no roles - allows for granular permissions control

= 1.6.0 =
* Feature: Hiding a parent menu item will automatically hide all its children
* Feature: Add compatibility with Menu Item Visibility Control plugin and any plugin/theme that is willing to add its inputs via the `wp_nav_menu_item_custom_fields` hook. See the [FAQ](http://wordpress.org/plugins/nav-menu-roles/faq/#compatibility) to make our plugins compatible.

= 1.5.1 =
* Hopefully fix missing nav-menu-roles.min.js SVN issue

= 1.5.0 =
* Switch to instance of plugin
* Add notice when conflicting plugins are detected 
* Remove some extraneous parameters
* Add Spanish translation thanks to @deskarrada

= 1.4.1 =
* update to WP 3.8 version of Walker_Nav_Menu_Edit (prolly not any different from 3.7.1)
* minor CSS adjustment to admin menu items
* checked against WP 3.8

= 1.4 =
* Add to FAQ
* add JS flair to admin menu items
* update to WP 3.7.1 version of Walker_Nav_Menu_Edit

= 1.3.5 =
* Add nav_menu_roles_item_visibility filter to work with plugins that don't use traditional roles

= 1.3.4 =
* Update admin language thanks to @hassanhamm
* Add Arabic translation thanks to @hassanhamm

= 1.3.3 =
* Fix Nav_Menu_Roles_Import not found error

= 1.3.2 =
* Stupid comment error causing save issues

= 1.3.1 =
* SVN failure to include importer files!

= 1.3 =
* Added custom importer

= 1.2 =
* Major fix for theme's that use their own custom Walkers, thanks to Evan Stein @vanpop http://vanpop.com/
* Instead of a custom nav Walker, menu items are controlled through the wp_get_nav_menu_items filter
* Remove the custom nav Walker code

= 1.1.1 =
* Fix link to plugin site
* Fix labels in admin Walker

= 1.1 =
* Clean up debug messages

= 1.0 =
* Initial release