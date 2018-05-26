=== Page View Count  ===
Contributors: a3rev, a3rev Software, nguyencongtuan
Tags: wordpress page view, page view count , post views, postview count,
Requires at least: 4.6
Tested up to: 4.9.6
Stable tag: 2.0.5
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Places an icon, all time views count and views today count at the bottom of posts, pages and custom post types on any WordPress website.

== DESCRIPTION ==

A beautifully simple to set up plugin that gives site visitors and site owners the ability to quickly and easily see how many people have visited that page or post. 

= FEATURES =

* On the front end it adds an icon and page views count to the bottom or top of pages and posts on your WordPress website.
* Switch ON | OFF hide Page Views Count for all Posts, Pages and all custom posts types including WooCommerce and WP e-Commerce custom post types.
* Set the Position of the counter to show at the top of the page or post or at the bottom
* Set alignment of the counter Left, Right or Centre
* Set the colour and size of the counter icon
* Option to use load by Ajax to prevent the count from being cached by caching plugins 
* Option to Manually set / edit total views and views today from Page View Count meta box on any post or page editor
* Lightweight - Fontawesome icon (no image to load) and called via WordPress JSON RESTful API (not on ajax-admin.php)
* All options and settings are point click - absolutely no coding required  

= DEVELOPERS =

On the plugins dashboard in the + Page Views Count Function options box you will find the Page Views Count functions and notes on how to use them. 

* Use to manually add Page views count to any content or object in the theme. 
* Use to add page View Count to any content that is not create using WordPress custom post / taxonomy type. 
* Use to create a custom position of the Page Views Count 
* Functions support echo and return parameters when getting visitor stats on any variable.

= TROUBLESHOOTING =

* The number 1 support request we get about the plugin is that it double or triple counts page or post loads. Yes it does and if you see that it is a Red Flag that you have a misconfiguration or bug in your theme or a plugin. Page Views Count does exactly that - counts each time the page or post is loading in the browser - if its counting twice it is because the browser is double loading the page. That is a bad thing and you or your developer needs to fix that.
  
= CONTRIBUTE  =

When you download Page Views Count, you join our community. Regardless of if you are a WordPress beginner or experienced developer if youre interested in contributing to Page Views Count development head over to the [Page Views Count GitHub Repository](https://github.com/a3rev/page-views-count) to find out how you can contribute.
Want to add a new language to Page Views Count? Great! You can contribute via [translate.wordpress.org](https://translate.wordpress.org/projects/wp-plugins/page-views-count)


== Installation ==

= Minimum Requirements =

* WordPress 4.6 or greater
* PHP version 5.6.0 or greater
* MySQL version 5.6 or greater OR MariaDB version 10.0 or greater

= Automatic installation =

Automatic installation is the easiest option as WordPress handles the file transfers itself and you don't even need to leave your web browser. To do an automatic install of Page Views Count, log in to your WordPress admin panel, navigate to the Plugins menu and click Add New.

In the search field type "Page Views Count" and click Search Plugins. Once you have found our plugin you can install it by simply clicking Install Now. After clicking that link you will be asked if you are sure you want to install the plugin. Click yes and WordPress will automatically complete the installation.

= Manual installation =

The manual installation method involves down loading our plugin and uploading it to your web server via your favorite FTP application.

1. Download the plugin file to your computer and unzip it
2. Using an FTP program, or your hosting control panel, upload the unzipped plugin folder to your WordPress installations wp-content/plugins/ directory.
3. Activate the plugin from the Plugins menu within the WordPress admin.


== Screenshots ==

1. Page Views Count Dashboard
2. Counter Position and Style Options box and settings
3. Counter Position Bottom and Alignment set to Left
4. Counter Position Bottom and Alignment set to Centre
5. Counter Position Bottom and Alignment set to Right


== Usage ==

1. Install and activate the plugin

2. Go to WordPress Settings menu > Page View Count Menu

3. Activate Page Views Count and use the options box settings to make the desired configuration

4. Be sure to clear any caching and browser cache to see your Page Views Count


== Changelog ==

= 2.0.5 - 2018/05/26 =
* This maintenance update is for compatibility with WordPress 4.9.6 and the new GDPR compliance requirements for users in the EU 
* Tweak - Test for compatibility with WordPress 4.9.6
* Tweak - Check for any issues with GDPR compliance. None Found
* Framework - Update a3rev Plugin Framework to version 2.0.3

= 2.0.4 - 2018/03/06 =
* Maintenance Update. Fixes for Views today count always showing 0 value, PHP warning and conflict with Yoast SEO Facebook description
* Tweak - Update Readme - Installation - Minimum Requirements PHP to version 5.6.0 
* Fix - Update variable to resolve todays views always showing 0. Thanks to @stefanodalli  
* Fix - Check if global $post exist to resolve PHP Notice Trying to get property of non-object in pvc_class.php on line 225
* Fix - Remove old filter that was causing conflict with Yoast SEO Facebook description meta causing the post content to be used and not be changed. Thanks to @banana7777 for reporting the issue

= 2.0.3 - 2018/02/13 =
* Maintenance Update. Under the bonnet tweaks to keep your plugin running smoothly and is the foundation for new features to be developed this year 
* Framework - Update a3rev Plugin Framework to version 2.0.2
* Framework - Add Framework version for all style and script files
* Tweak - Update for full compatibility with a3rev Dashboard plugin
* Tweak - Test for compatibility with WordPress 4.9.4
* Fix - Use WPSEO_Meta::set_value instead of wpseo_set_value, for compatibility with Yoast SEO plugin

= 2.0.2 - 2017/12/14 =
* Maintenance Update. This update includes 3 bug fixes, including AMP pages conpatibility
* Fix - Headers already sent warning. Delete trailing spaces at bottom of php file
* Fix - Change attribute name element-id to data-element-id for compatibility with AMP. Thanks to @veenareddys for reporting the issue
* Fix - Update SQL query for fix bug get incorrect total views when edit a Post or Page. Thanks to @groenhart for reporting this issue

= 2.0.1 - 2017/12/13 =
* Maintenance Update. 3 code tweaks for compatibility with WordPress 4.9.1 and 2 bug fixes
* Tweak - Removed auto redirect to plugins admin panel on activation
* Tweak - Added Settings link to plugins description on plugins menu
* Tweak - Remove console log from script as it was causing theme Customizer to load slowly
* Tweak - Tested for compatibility with WordPress 4.9.1
* Fix - Update regex expression in the REST endpoint so that it accepts array-like params as expected.
* Fix - Get correct item ID if params is parse as array
* Credit - Thanks to Cypwu for the Github contribution for REST endpoint modification

= 2.0.0 - 2017/06/02 =
* Feature - Upgrade Stats image icon to fontawesome Chart Icon
* Feature - Add new + Counter Position and Style options box on plugins admin panel
* Feature - Added option to show Page Views Count at Top or Bottom of post and page content
* Feature - Added Page Views Count Alignment options Left, Centre or Right
* Feature - Added new fontawesome count icon size and colour settings
* Feature - Registry endpoint /pvc/v1 for full automatic integration with WordPress JSON RESTful API
* Feature - Plugin source code now on public Github repository to allow users and developers to contribute
* Tweak - Update Ajax load for connect to WordPress JSON RESTful API instead of calling to admin-ajax.php
* Tweak - Register fontawesome in plugin framework with style name font-awesome-styles
* Tweak - Update plugins readme to show description of new features, link to Github Repo and translations page 
* Tweak - Tested for compatibility with WordPress major version 4.8.0

= 1.4.0 - 2016/04/15 =
* Feature - Define new 'Background Color' type on plugin framework with ON | OFF switch to disable background or enable it
* Feature - Define new function - hextorgb() - for convert hex color to rgb color on plugin framework
* Feature - Define new function - generate_background_color_css() - for export background style code on plugin framework that is used to make custom style
* Tweak - Register fontawesome in plugin framework with style name is 'font-awesome-styles'
* Tweak - Saved the time number into database for one time customize style and Save change on the Plugin Settings
* Tweak - Replace version number by time number for dynamic style file are generated by Sass to solve the issue get cache file on CDN server
* Tweak - Update core style and script of plugin framework for support Background Color type
* Tweak - Update plugin framework to latest version
* Tweak - Tested for full compatibility with WordPress major version 4.5

= 1.3.2 - 2015/12/10 =
* Tweak - Upgrade media uploader to New UI of WordPress media uploader with WordPress Backbone and Underscore
* Tweak - Update the uploader script to save the Attachment ID and work with New Uploader
* Tweak - Updated a3 Plugin Framework to the latest version
* Tweak - Tested for full compatibility with WordPress major version 4.4

= 1.3.1 - 2015/11/27 =
* Fix - Don't include the script and styles from plugin framework on Post, Page Edit to fix the conflict with TinyMCE
* Fix - Don't convert the total views to number format so they can save into the database when edit total views

= 1.3.0 - 2015/10/14 =
* Feature - Add Page View Counter meta box on post, pages and custom post edit pages.
* Feature - Switch Counter ON or OFF from the new meta box controller, individually from the global settings
* Feature - Set and edit the All Total Views and Today Views for each item from the new View Counter meta box
* Feature - Add new feature for show Counter from the Excerpt Content, this option support for admin to turn the Counter ON or OFF for the homepage, Front Page, archives page, category pages
* Tweak - Change Text Domain of plugin to Plugin slug
* Tweak - Added Text Domain and Domain Path to the plugin header
* Tweak - Change file name of languages files inside /laguages/ folder from 'pvc' to 'page-views-count', so if you have make your language file then just simple rename file from 'pvc.mo' to 'page-views-count.mo'
* Tweak - Tested for full compatibility with WordPress version 4.3.1

= 1.2.1 - 2015/08/22 =
* Tweak - include new CSSMin lib from https://github.com/tubalmartin/YUI-CSS-compressor-PHP-port into plugin framework instead of old CSSMin lib from http://code.google.com/p/cssmin/ , to avoid conflict with plugins or themes that have CSSMin lib
* Tweak - make __construct() function for 'Compile_Less_Sass' class instead of using a method with the same name as the class for compatibility on WP 4.3 and is deprecated on PHP4
* Tweak - change class name from 'lessc' to 'a3_lessc' so that it does not conflict with plugins or themes that have another Lessc lib
* Tweak - Plugin Framework DB query optimization. Refactored settings_get_option call for dynamic style elements, example typography, border, border_styles, border_corner, box_shadow
* Tweak - Tested for full compatibility with WordPress major version 4.3.0
* Fix - Update the plugin framework for setup correct default settings on first installed
* Fix - Update the plugin framework for reset to correct default settings when hit on 'Reset Settings' button on each settings tab

= 1.2.0 - 2015/06/18 =
* Feature - Plugin framework Mobile First focus upgrade
* Feature - Massive improvement in admin UI and UX in PC, tablet and mobile browsers
* Feature - Introducing opening and closing Setting Boxes on admin panels.
* Feature - Added Plugin Framework Customization settings. Control how the admin panel settings show when editing.
* Feature - Added a 260px wide images to the right sidebar for support forum link, Documentation links.
* Feature - Added full support for Right to Left RTL layout on plugins admin dashboard.
* Fix - Check 'request_filesystem_credentials' function, if it does not exists then require the core php lib file from WP where it is defined

= 1.1.0 - 2015/06/03 =
* Tweak - Security Hardening. Removed all php file_put_contents functions in the plugin framework and replace with the WP_Filesystem API
* Tweak - Security Hardening. Removed all php file_get_contents functions in the plugin framework and replace with the WP_Filesystem API
* Fix - Update dynamic stylesheet url in uploads folder to the format <code>//domain.com/</code> so it's always is correct when loaded as http or https

= 1.0.9 - 2015/05/30 =
* Tweak - Tested and Tweaked for full compatibility with WordPress Version 4.2.2
* Localization - Italian translation by Antonio Petricca.
* Localization - Indonesian translation by [Ridha Harwan](https://tarjiem.com/).

= 1.0.8 - 2015/04/21 =
* Tweak - Tested and Tweaked for full compatibility with WordPress Version 4.2.0
* Tweak - Update style of plugin framework. Removed the [data-icon] selector to prevent conflict with other plugins that have font awesome icons

= 1.0.7 =
* Feature - Next step in full conversion of plugin to backbone.js and Sass - full admin panel conversion from CSS to Sass.

= 1.0.6.4 - 2014/09/13 =
* Tweak - Added WordPress plugin icon.
* Fix - Changed <code>__DIR__</code> to <code>dirname( __FILE__ )</code> for Sass script so that on some server <code>__DIR__</code> is not defined

= 1.0.6.3 - 2014/09/10 =
* Tweak - Updated google font face in plugin framework.
* Tweak - Tested 100% compatible with WordPress Version 4.0
* Fix - Use correct variable $postid instead of $post->ID for 'custom_stats_update_echo()' function to fix the problem don't auto increase total view for use template tag '<?php pvc_stats_update( $postid ); ?>'

= 1.0.6.2 - 2014/07/22 =
* Fix - Add missed style when disable AJAX load for view counts

= 1.0.6.1 - 2014/07/22 =
* Fix - Add missed style for class .pvc_clear in Sass

= 1.0.6 - 2014/07/21 =
* Feature - Beginning of conversion of the plugin to backbone.js and Sass
* Feature - Loads superfast on frontend with substantially less calls to the server making it very lightweight and super fast.
* Feature - On Category extract pages plugin now only calls once to admin-ajax.php regardless of how many extract view counts are shown.
* Feature - Upgrade Page View Count front end count and load function to backbone.js
* Feature - Upgraded plugins front end CSS to Sass.

= 1.0.5 - 2014/06/27 =
* Feature - Added load Counter on front end by Ajax option to prevent count being cached by caching plugins.
* Tweak - added ajax event 'pvc_ajax_load_stats' and trigger $("body").trigger("pvc_stats_loaded_" + pvc_object_id ); for that event
* Tweak - added ajax event 'pvc_ajax_update_stats' and trigger $("body").trigger("pvc_stats_updated_" + post_id ); for that event
* Tweak - use $wpdb->prepare() for all sql command for security
* Tweak - Updated chosen js script to latest version 1.1.0 on the a3rev Plugin Framework
* Tweak - Added support for placeholder feature for input, email , password , text area types.
* Tweak - Added Russiian translation thanks to [Renat Nurlyev](http://kluchkuspexu.ru/)

= 1.0.4.3 - 2014/05/26 =
* Tweak - Changed add_filter( 'gettext', array( $this, 'change_button_text' ), null, 2 ); to add_filter( 'gettext', array( $this, 'change_button_text' ), null, 3 );
* Tweak - Update change_button_text() function from ( $original == 'Insert into Post' ) to ( is_admin() && $original === 'Insert into Post' )
* Tweak - Checked and updated for full compatibility with WordPress version 3.9.1
* Tweak - Updated plugins description text and admin panel yellow sidebar text.
* Tweak - Updated Framework help text font for consistency.
* Tweak - Added remove_all_filters('mce_external_plugins'); before call to wp_editor to remove extension scripts from other plugins.
* Tweak - Full WP_DEBUG ran, all uncaught exceptions, errors, warnings, notices and php strict standard notices fixed.
* Tweak - Added PHP Public Static to functions in Class. Done so that Public Static warnings don't show in DE_BUG mode.
* Fix - Code tweaks to fix a3 Plugins Framework conflict with WP e-Commerce tax rates.

= 1.0.4.2 - 2013/12/24 =
* Feature - a3rev Plugin Framework admin interface upgraded to 100% Compatibility with WordPress v3.8.0 with backward compatibility.
* Feature - Feature - a3rev framework 100% mobile and tablet responsive, portrait and landscape viewing.
* Feature - Added option of return parameter to existing echo for getting page view stats on any variable.
* Tweak - Upgraded dashboard switches to Vector based display that shows when WordPress version 3.8.0 is activated.
* Tweak - Tweak - Upgraded all plugin .jpg icons and images to Vector based display for full compatibility with new WordPress version.
* Tweak - Admin panel Yellow sidebar not show in Mobile screens to optimize admin panel screen space.
* Tweak - Tested 100% compatible with WP 3.8.0
* Fix - Upgraded array_textareas type for Padding, Margin settings on the a3rev plugin framework.

= 1.0.4.1 - 2013/10/14 =
* Tweak - Fixed typos on admin panel.
* Fix - Conflict with new version of WordPress SEO plugin causing duplicate page counts - add_filter( 'wpseo_opengraph_desc', array( 'A3_PVC', 'fixed_wordpress_seo_plugin' ) );
* Fix - Updated Plugin Admin Framework by added array_map( array( $this, 'admin_stripslashes' ) , $current_settings ) to strip slashes on value when show on frontend
* Translation - Added Dutch translation thanks to Renee Klein

= 1.0.4 - 2013/10/10 =
* Tweak - a3rev logo image now resizes to the size of the yellow sidebar in tablets and mobiles.
* Fix - Intuitive Radio Switch settings not saving. Input with disabled attribute could not parse when form is submitted, replace disabled with custom attribute: checkbox-disabled
* Fix - App interface Radio switches not working properly on Android platform, replace removeProp() with removeAttr() function script

= 1.0.3 - 2013/10/05 =
* Feature - Upgraded the plugin to the newly developed a3rev admin panel app interface.
* Feature - New admin UI features check boxes replaced by switches.
* Fix - Plugins admin script and style not loading in Firefox with SSL on admin. Stripped http// and https// protocols so browser will use the protocol that the page was loaded with.

= 1.0.2 - 2013/08/28 =
* Feature - Major performance enhancement. All Time Views table data emptied each day on 24 hour cron.
* Featue - Added House Keeping function to settings. Clean up on Deletion. Option - Choose if you ever delete this plugin it will completely remove all tables and data it has created.
* Tweak - Plugin in code tested fully compatible with WordPress v3.6.0
* Tweak - Ran full WP_DEBUG All Uncaught exceptions errors and warnings fixed.
* Tweak - Added PHP Public Static to functions in Class. Done so that PHP Public Static warnings don't show in WP_DEBUG mode.
* Tweak - Added when install and activate plugin link redirects to the plugins dashboard instead of the wp-plugins dashboard.
* Tweak - Updated plugins support forum link to the wordpress support forum.

= 1.0.1 - 2013/01/10 =
* Tweak - Updated Support and Pro Version link URL's on wordpress.org description, plugins and plugins dashboard. Links were returning 404 errors since the launch of the all new a3rev.com mobile responsive site as the base e-commerce permalinks is changed.

= 1.0.0 - 2012/12/20 =
* First Release.


== Upgrade Notice ==

= 2.0.5 =
Maintenance Update. Compatibility WordPress 4.9.6 and the new GDPR compliance requirements for users in the EU

= 2.0.4 =
Maintenance Update. Fixes for Views today count always showing 0 value, PHP warning and conflict with Yoast SEO Facebook description

= 2.0.3 =
Maintenance Update. This version updates the Plugin Framework to v 2.0.2, adds full compatibility with a3rev dashboard and WordPress v 4.9.4

= 2.0.2 =
Maintenance Update. This update includes 3 bug fixes, including AMP pages compatibility

= 2.0.1 =
Maintenance Update. 3 code tweaks for compatibility with WordPress 4.9.1 and 2 bug fixes

= 2.0.0 =
Major Feature Upgrade. Release of 7 new features and 2 code tweaks for compatibility with upcoming WordPress major version 4.8.0

= 1.4.0 =
Feature Upgrade. 3 new features, 5 tweaks for full compatibility with WordPress major version 4.5

= 1.3.2 =
Maintenance update. Tweaks for full compatibility with WordPress major version 4.4

= 1.3.1 =
Maintenance Update. 2 bug fixes for conflict with TinyMCE and WordPress editor conflict

= 1.3.0 =
Major Feature Upgrade. 3 much requested new features (see the changelog) plus 3 tweaks to plugins text domains - Note if you have a translation you need to chnage the .mo file name (see changelog)

= 1.2.1 =
Major Maintenance Upgrade. 5 Code Tweaks plus 2 bug fixes for full compatibility with WordPress v 4.3.0

= 1.2.0 =
Major Feature Upgrade. Massive admin panel UI and UX upgrade. Includes 6 new features plus 1 bug fix

= 1.1.0 =
Important Maintenance Upgrade. 2 x major a3rev Plugin Framework Security Hardening Tweaks plus 1 https bug fix

= 1.0.9 =
Maintenance upgrade. Code tweaks for full compatibility with WordPress 4.2.2 and Italian, Indonesian translations.

= 1.0.8 =
Maintenance upgrade. Code tweaks for full compatibility with WordPress 4.2.0

= 1.0.7 =
Upgrade now for full admin panel conversion from CSS to Sass

= 1.0.6.4 =
Upgrade now for 1 Sass bug fix

= 1.0.6.3 =
Update you plugin now for 1 framework code tweak plus 1 bug fix and full compatibility with WordPress Version 4.0

= 1.0.6.2 =
Upgrade now for a bug fix for missed style when disable AJAX load view counts in version release 1.0.6.1.

= 1.0.6.1 =
Upgrade now for a bug fix for Sass in yesterday’s major version release 1.0.6.

= 1.0.6 =
Upgrade now for the beginning of conversion of plugin to backbone.js and Sass. Much faster front-end load and less calls on server.

= 1.0.5 =
Update now for new feature - load counter by Ajax event plus security hardening and 2 framework code tweaks and Russian translation.

= 1.0.4.3 =
Upgrade now for full compatoibility with WordPress Version 3.9.1, 8 code tweaks and 1 bug fix.

= 1.0.4.2 =
Upgrade now for full a3rev Plugin Framework compatibility with WordPress version 3.8.0 and backwards. New admin interface full mobile and tablet responsive display.

= 1.0.4.1 =
Update you plugin now for 2 bug fixes - especially important to upgrade now if you use the WordPress SEO plugin.

= 1.0.4 =
Upgrade now for another admin panel intuitive app interface feature plus a Radio switch bug fix and Android platform bug fix

= 1.0.3 =
Upgrade you plugin now for the all new a3rev admin panel app type interface and a protocols in browser bug fix

= 1.0.2 =
Important upgrade - please update your plugin now for a major performance enhancement.
