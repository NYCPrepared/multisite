=== YD Network-wide Options ===
Contributors: ydubois
Donate link: http://www.yann.com/
Tags: WordPress MU, wpmu, mu, plugin, automatic, admin, administration, blogs, blog, options, subsite, multiple, sitewide, site-wide, network-wide, replicate, option, plugins, centralize, manage, deploy, replicate, parameter, setting, settings, centralized, management, French, English, Dutch, sync, synchronization, synching, German, template, multisite, network, default, defaults, multi-site
Requires at least: 2.9.1
Tested up to: 3.0.3
Stable tag: trunk

Automatically replicate any plugin setting network-wide: apply sitewide settings. Spread your settings or options on all your multisite blogs. Options synching between blogs.

== Description ==

This plugin has been thoroughly tested and is fully compatible with **WordPress 3.0x multisite** or with **WPMU 2.9**.

This plugin was originally named **YD WPMU Sitewide Options**. The name has been changed with version 3.0 to match WordPress 3.0 vocabulary and concepts. Backwards compatibility with WordPress MU has been maintained.

= Centralized management of your network-wide installed plugins! =

This WordPress 3.0 multisite or WPMU plugin installs a **new settings page** where you can choose which blog or plugin settings you want to replicate site-wide or network-wide to all your **children sites**.
Any change (update) to those settings (options) on the **mother site** admin pages can be automatically copied to all the sub-sites (blogs).

You can choose which settings to replicate, you can decide if changes of the settings on the main blog should be automatically replicated to all blogs.

You can replicate your settings as a "one-shot" process (for example when setting up new blogs or installing a new network-wide or site-wide plugin), 
or have the plugin maintain your settings in sync on all your blogs over time.

You can decide if chosen settings will be automatically "spread" to newly created blogs or not.

You can choose to manually spread the settings only when you decide to, and not to overwrite existing individual blog settings.
This way, you can maintain specific settings on some blogs while keeping the ability to spread default settings to new blogs.

Since version 4.0.0, the plugin can now create and copy custom database tables used by some plugins, further widening the scope of plugins that can be made network-wide manageable.

Those techniques can be used to convert any standard WordPress plugin from standalone to a versatile multisite network-wide or sitewide WPMU plugin!

You can use your main blog as a template-blog for the creation of new sites in your network: the new sites can automatically adopt any or all settings of your main blog, 
activated plugins can also be copied, as well as the settings of each plugin. This is an alternative to other commercial or non-commercial new blog defaults / new blog template plugins for WPMU. 

Many other creative uses are possible.

It efficiently makes for a centralized deployment of any plugin parameter on all your WPMU blogs: the main blog acts as a "master" when setting the site-wide option, while your child blogs replicate any change in the option over time like "slaves" (a rather typical master-slave replication pattern).

The plugin has its own admin options page (settings page).

It is **fully internationalized**.

Base package includes .pot file for translation of the interface, and English, French, Dutch and German versions.

= Compatibility =
This plugin has been successfully tested to convert the following standalone WordPress plugins to network-wide Worpress 3.0x multisite or sitewide WordPress MU plugins with centralized administration:

* All WordPress core-options including WordPress 3.0x default theme header options, active plugins, administrator e-mail, commenting otpions and search engine accessibility (public/private status), etc.
* [Akismet plugin](http://WordPress.org/extend/plugins/akismet/) credentials (API Key)
* [YD Spread Parameter plugin](http://WordPress.org/extend/plugins/yd-spread-parameter/)
* [YD Export2Email plugin](http://WordPress.org/extend/plugins/yd-export2email/)
* [WP Theme Switcher plugin](http://WordPress.org/extend/plugins/wp-theme-switcher/)
* [DJ E-mail Publish plugin](http://WordPress.org/extend/plugins/dj-email-publish/)
* [WPRobot plugin](http://wprobot.net/) credentials and settings
* [Easy Privacy Policy plugin](http://WordPress.org/extend/plugins/easy-privacy-policy/)
* [WordPress plugin Commander](http://wpmu.org/plugin-commander-111/) to centrally activate or de-activate plugins network-wide
* [WPML Multilingual CMS](http://wpml.org/) (new since version 4.0.0)
* and many, many more...

Only some plugins that do not use either WordPress' built-in options mechanism or some simple database tables to store their settings cannot be made network-wide with this plugin.
However, the vast majority of state-of-the art third-party plugins use options and/or simple tables.

*Please leave a comment on the [support site](http://www.yann.com/en/wp-plugins/yd-wpmu-sitewide-options "Yann Dubois' Network-wide options plugin for multisite WordPress") to report
other successful implementations, or any incompatibility.*

= Active support =

Drop me a line on my [WordPress developer site](http://www.yann.com/en/wp-plugins/yd-wpmu-sitewide-options "Yann Dubois' Network-wide options plugin for multisite WordPress") to report bugs, ask for a specific feature or improvement, or just tell me how you're using the plugin.

= Description en Français : =

Ce plug-in pour WordPress 3.0x multi-site ou WordPress MU permet de recopier automatiquement n'importe quel paramétrage (option, réglage) de plugin sur tous les blogs de votre réseau WordPress 3.0x ou WPMU.
Toute modification (mise à jour) faite sur un paramètre sélectionné dans le blog principal peut être automatiquement répercutée sur les sous-blogs.
De cette façon, vous pouvez centraliser la gestion de vos plugins transversaux.

Avec cette technique, n'importe quel plugin WordPress standard peut être converti en un plugin transversal pour WP3.0x multisite ou WPMU !

Les réglages de vos plugins sont automatiquement déployés sur tous vos sites WP MU ou sur tous les sites de votre réseau multi-sites.

Très pratique si vous installez un plugin transversalement (network-wide) sur tous vos blogs.

Le plugin a sa propre page d'options dans l'administration.
Il est entièrement internationalisé.

La distribution standard inclut le fichier de traduction .pot et les versions française, anglaise, hollandaise et allemande.

Le plugin peut fonctionner avec n'importe quelle langue ou jeu de caractères.

Pour toute aide ou information en français, laissez-moi un commentaire sur le [site de support du plugin YD WPMU Network-wide Options](http://www.yann.com/en/wp-plugins/yd-wpmu-sitewide-options "Yann Dubois' Network-wide Options for multisite WordPress").

Yann dubois, [Développeur WordPress](http://www.yann.com/fr/a-propos/developpeur-wordpress "Développeur WordPress freelance à Paris").

= Funding Credits =

Original development of this plugin has been paid for by [Wellcom.fr](http://www.wellcom.fr "Wellcom"). Please visit their site!

Additional development was paid for by [Matt Hardy](http://bossinternetmarketing.com/ "bossinternetmarketing.com"). Please visit his site!

Additional development was paid for by [Eurospreed](http://www.eurospreed.com/ "Eurospreed.com"). Please visit their site!

Le développement d'origine de ce plugin a été financé par [Wellcom.fr](http://www.wellcom.fr "Wellcom"). Allez visiter leur site !

Des développements additionnels ont été financés par [Matt Hardy](http://bossinternetmarketing.com/ "bossinternetmarketing.com"). Allez visiter son site!

= Translation =

If you want to contribute to a translation of this plugin, please drop me a line by e-mail or leave a comment on the [plugin's page](http://www.yann.com/en/wp-plugins/yd-wpmu-sitewide-options "Yann Dubois' Network-wide Options plugin for multisite WordPress").
You will get credit for your translation in the plugin file and this documentation, as well as a link on this page and on [my developers' blog](http://www.yann.com/).

Dutch version kindly provided by [Rene](http://www.fethiyehotels.com)

German version kindly provided by [Rian](http://www.pangaea.nl/diensten/exact-webshop)

== Installation ==

1. Unzip yd-wpmu-sitewide-options.zip
1. Upload the `yd-wpmu-sitewide-options` directory and all its contents into the `/wp-content/plugins/` directory of your main site
1. Activate the plugin **on your main site** or **network-wide** through the 'Plugins' menu in WordPress
1. Use the plugins's own setting page to select which other plugin's options (settings) to make nertwork-wide / site-wide.

For specific installations, some more information might be found on the [YD WPMU Sitewide Options plugin support page](http://www.yann.com/en/wp-plugins/yd-wpmu-sitewide-options "Yann Dubois' Network-wide Options plugin for multisite WordPress")

== Frequently Asked Questions ==

= Where should I ask questions? =

http://www.yann.com/en/wp-plugins/yd-wpmu-sitewide-options

Use comments.

I will answer only on that page so that all users can benefit from the answer. 
So please come back to see the answer or subscribe to that page's post comments.

= Puis-je poser des questions et avoir des docs en français ? =

Oui, l'auteur est un [Développeur WordPress freelance](http://www.yann.com/fr/a-propos/developpeur-wordpress Développeur WordPress freelance à Paris) français.
("but alors... you are French?")

== Screenshots ==

1. This plugin will present you with a list of settings to deploy network-wide on all your multisite WordPress blogs.

== Plugin settings/options page ==

Use the plugin's own settings page to select which plugin options/settings to automatically replicate network-wide / site-wide.

== Revisions ==

* 0.1.0 Original beta version.
* 0.1.1 Optional debug code.
* 0.2.0 Bugfixes + improved settings page.
* 1.0.0 Bugfixes + important new features.
* 1.1.0 Bugfixes + new features.* 1.1.
* 1.1.1 Bugfix
* 3.0	WordPress 3.0 compatibility
* 3.0.1	Minor text changes
* 4.0.0	Database table replication, bugfixes, flush rewrite rules, choose master, ignore blogs

== Changelog ==

= 0.1.0 =
* Initial release
= 0.1.1 =
* Optional debug code
= 0.2.0 =
* Bugfix: memory leak when replicating to a large number of blogs
* Bugfix: possible unwanted recursion when updating an option
* Improved settings page design
* Debug messages for diagnosing memory problems
* Dutch version
= 1.0.0 =
* Final release 1
* Bugfix: A single child blog should be enough
* Bugfix: Blogs should not have to be public/immature/... to allow replication
* New feature: Autospreading settings change is now an option (enable/disable update action hook)
* New feature: Auto-apply default options when new blog is created
* New feature: Can disable overwriting of existing options when updating from the settings page
= 1.1.0 =
* Bugfix: Auto-apply default options when new blog is created (funded by Matt Hardy @ bbgqt.org)
* New feature: default options are displayed in the settings page
* German version
= 1.1.1 =
* Bugfix: unserialize
= 3.0 =
* WordPress 3.0 compatibility
* Admin panel W3C compatibility issues
* Minor bug fixes
* Documentation upgraded to match WP 3.0 vocabulary
* Upgraded French version
* Upgraded funding credits
* Name changed from YD WPMU Sitewide Options to YD Network-wide options
* Widget settings buttons renamed to plugin settings (there is no widget)
= 3.0.1 =
* Minor text changes
= 4.0.0 =
* Added feature to replicate custom database tables used by some plugins
* Checked overwrite option
* Fixed bug in autospread(ing) option
* Fixed debug_backtrace / PHP4 warning
* Switched form submission to POST method
* Added option for flushing URL rewrite rules on sub blogs
* Added option to choose "master" blog for replication features
* Added optional blog filtering options
* Added option to ignore specific blogs
* Tested WP3.0.3 compatibility, updated doc

== Upgrade Notice ==

= 0.1.0 =
Initial release.
= 0.1.1 =
No special issue. Upgrade normally. See changelog for details.
= 0.2.0 =
No special issue. Upgrade normally. See changelog for details.
= 1.0.0 =
No special issue. Upgrade normally. See changelog for details. Reset plugin option to get original full functionality.
= 1.1.0 =
No special issue. Upgrade normally. See changelog for details.
= 1.1.1 =
No special issue. Upgrade normally. See changelog for details.
= 3.0 =
No special issue. Upgrade normally. See changelog for details.
= 3.0.1 =
No special issue. Upgrade normally. See changelog for details.
= 4.0.0 =
No special issue. Upgrade normally. See changelog for details.

== Did you like it? ==

Drop me a line on http://www.yann.com/en/wp-plugins/yd-wpmu-sitewide-options

And... *please* rate this plugin --&gt;