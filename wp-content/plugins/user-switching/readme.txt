=== User Switching ===

Contributors: johnbillion  
Tags: user, users, profiles, switching, wpmu, multisite, buddypress, bbpress, become, user control, user management, user access, developer  
Requires at least: 3.1  
Tested up to: 3.9  
Stable tag: 0.8.7  
License: GPL v2 or later  

Instant switching between user accounts in WordPress.

== Description ==

This plugin allows you to quickly swap between user accounts in WordPress at the click of a button. You'll be instantly logged out and logged in as your desired user. This is handy for test environments where you regularly log out and in between different accounts, or for adminstrators who need to switch between multiple accounts.

= Features =

 * Switch user: Instantly switch to any user account from the *Users* screen.
 * Switch back: Instantly switch back to your originating account.
 * Switch off: Log out of your account but retain the ability to instantly switch back in again.
 * It's completely secure (see the *Security* section below).
 * Compatible with WordPress, WordPress Multisite, BuddyPress and bbPress.

= Security =

 * Only users with the ability to edit other users can switch user accounts. By default this is only Administrators on single site installs, and Super Admins on Multisite installs.
 * Passwords are not (and cannot be) revealed.
 * Implements WordPress' nonce security system, meaning only those who intend to switch users can switch.
 * Full support for administration over SSL (if applicable).

= Usage =

 1. Visit the *Users* menu in WordPress and you'll see a *Switch To* link next to each user.
 2. Click this and you will immediately switch into that user account.
 3. You can switch back to your originating account via the *Switch back* link on each dashboard screen or in your profile menu in the WordPress toolbar.

See the [FAQ](http://wordpress.org/plugins/user-switching/faq/) for information about the *Switch Off* feature.

= Translations Included =

 * Arabic by Hassan Hisham
 * Chinese Simplified by Tunghsiao Liu
 * Farsi (Persian) by Amin Ab
 * German by Ralph Stenzel
 * Japanese by Yusuke Hayasaki
 * Lithuanian by Tommixoft
 * Polish by Bartosz Arendt
 * Russian by R J
 * Slovak by Max Samael

== Screenshots ==

1. ![The *Switch To* link on the Users screen](https://raw.github.com/johnbillion/user-switching/master/assets-wp-repo/screenshot-1.png)
2. ![The *Switch To* link on a user's profile](https://raw.github.com/johnbillion/user-switching/master/assets-wp-repo/screenshot-2.png)

== Installation ==

If you have the [WordPress Developer plugin](http://wordpress.org/plugins/developer/) installed then User Switching is a one-click install from the Tools -> Developer screen.

Alternatively, you can install this plugin directly from your WordPress dashboard:

 1. Go to the *Plugins* menu and click *Add New*.
 2. Search for *User Switching*.
 3. Click *Install Now* next to the *User Switching* plugin.
 4. Activate the plugin.

== Frequently Asked Questions ==

= What does "Switch off" mean? =

Switching off logs you out of your account but retains your user ID in an authorisation cookie so you can switch straight back without having to log in again manually. It's akin to switching to no user, and being able to switch back.

The *Switch Off* link can be found in your profile menu in the WordPress toolbar. Once you've switched off you'll see a *Switch back* link in the footer of your site.

= Does this plugin work with WordPress Multisite? =

Yes, and you'll also be able to switch users from the Users screen in Network Admin.

= Does this plugin work with BuddyPress? =

Yes, and you'll also be able to switch users from member profile screens and the member listing screen.

= Does this plugin work with bbPress? =

Yes, and you'll also be able to switch users from member profile screens.

= Does this work as a mu-plugin? =

Yes, but you'll need to install `user-switching.php` into the root of your `mu-plugins` directory, not in the `user-switching` subdirectory. This is a restriction of WordPress.

= What capability does a user need in order to switch accounts? =

A user needs the `edit_users` capability in order to switch user accounts. By default only Administrators have this capability, and with Multisite enabled only Super Admins have this capability.

= Can regular admins on Multisite installs switch accounts? =

No. This can be enabled though by installing the [User Switching for Regular Admins](https://github.com/johnbillion/user-switching-for-regular-admins) plugin.

= Are any plugin hooks called when users switch accounts? =

Yes. When a user switches to another account, the `switch_to_user` hook is called with the new and old user IDs passed as parameters.

When a user switches back to their original account, the `switch_back_user` hook is called with the new (original) and old user IDs passed as parameters. Note that the old user ID can be boolean false if the user is switching back after they've been switched off.

When a user switches off, the `switch_off_user` hook is called with the old user ID as a parameter.

== Upgrade Notice ==

= 0.8.7 =
* Respect the `secure_logged_in_cookie` and `login_redirect` filters.

== Changelog ==

= 0.8.7 =
* Respect the `secure_logged_in_cookie` and `login_redirect` filters.

= 0.8.6 =
* Correctly encode the `redirect_to` parameter in the login screen message.

= 0.8.5 =
* Add a 'Switch To' link to bbPress profile screens.

= 0.8.4 =
* Revert a change in 0.8.3 which switched to using the `login_init` hook. This hook is fired too late.

= 0.8.3 =
* Switch to storing data in cookies as JSON instead of PHP-serialized.
* Show admin notices on all possible admin screens.
* Tweak the redirect location for BuddyPress user profiles.
* Change the textdomain in the plugin to match the plugin slug (required for language packs in WordPress core).

= 0.8.2 =
* Russian translation by R J

= 0.8.1 =
* Japanese translation by Yusuke Hayasaki

= 0.8 =
* Nested switching and switching back is now supported (capability permitting). Switch, switch again, switch back, switch back!
* Fix for BuddyPress 1.7 member profile pages. Props nat0n.
* Updated Arabic translation by Hassan Hisham.
* A little code refactoring and improving, completed inline docs.

= 0.7.1 =
* Arabic translation by Hassan Hisham.
* Minor code tweaks.

= 0.7 =
* Always show a 'Switch back' link in the footer when the admin toolbar isn't showing.
* More intuitive redirecting after switching.

= 0.6.3 =
* Lithuanian translation by Tommixoft.

= 0.6.2 =
* Polish translation by Bartosz Arendt.

= 0.6.1 =
* Slovak translation by Max Samael.

= 0.6 =
* More intuitive redirecting after switching.
* Avoid a BuddyPress bug preventing Switch To buttons from appearing.
* Added a template function: `current_user_switched()` which lets you know if the current user switched into their account.
* Added some hooks: `switch_to_user`, `switch_back_user` and `switch_off_user`, fired when appropriate.

= 0.5.2 =
* Farsi (Persian) translation by Amin Ab.
* Display switch back links in Network Admin and login screen.
* Avoid a BuddyPress bug preventing Switch To buttons from appearing.

= 0.5.1.2 =
* German translation by Ralph Stenzel.

= 0.5.1.1 =
* Chinese Simplified translation by Sparanoid.

= 0.5.1 =
* Toolbar tweaks for WordPress 3.3.

= 0.5 =
* New "Switch off" function: Log out and log instantly back in again when needed (see the FAQ).

= 0.4.1 =
* Support for upcoming changes to the admin bar in WordPress 3.3.

= 0.4 =
* Add some extended support for BuddyPress.
* Add some extended support for Multisite.
* Fix a permissions problem for users with no privileges.
* Fix a PHP warning when used as a mu-plugin (thanks Scribu).

= 0.3.2 =
* Fix the 'Switch back to' menu item in the WordPress admin bar (WordPress 3.1+).
* Fix a formatting issue on the user profile page.

= 0.3.1 =
* Prevent admins switching to multisite super admin accounts.

= 0.3 =
* Adds an admin bar menu item (WordPress 3.1+) for switching back to the user you switched from.

= 0.2.2 =
* Respect the current 'Remember me' setting when switching users.
* Redirect to home page instead of admin screen if the user you're switching to has no privileges.

= 0.2.1 =
* Edge case bugfix to prevent 'Switch back to...' message appearing when it shouldn't.

= 0.2 =
* Functionality for switching back to user you switched from.

= 0.1 =
* Initial release.
