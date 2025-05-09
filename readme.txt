=== Page View Count  ===
Contributors: a3rev, a3rev Software, nguyencongtuan
Tags: wordpress page view, page view count , post views, post view count, gutenberg
Requires at least: 6.0
Tested up to: 6.8
Stable tag: 2.8.7
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Places an icon, all time views count and views today count at the bottom of posts, pages and custom post types on any WordPress website.

== DESCRIPTION ==

A beautifully simple to set up plugin that gives site visitors and site owners the ability to quickly and easily see how many people have visited that page or post.

= FEATURES =

* On the front end it adds an icon and page views count to the bottom or top of pages and posts on your WordPress website.
* Switch ON | OFF hide Page Views Count for all Posts, Pages and all custom posts types including WooCommerce custom post types.
* Set the Position of the counter to show at the top of the page or post or at the bottom
* Set alignment of the counter Left, Right or Centre
* Set the colour and size of the counter icon
* Option to use load by Ajax to prevent the count from being cached by caching plugins
* Option to Manually set / edit total views and views today from Page View Count meta box on any post or page editor
* Add Page Views counter via the PVC Gutenberg block
* Add Page Views counter via shortcode
* Add Page Views counter via widget
* Developers can add the Page Views Counter via php tag
* All options and settings are point click - absolutely no coding required

= COMPATIBILTY =
Compatible with WordPress 5.9+ and backwards to WP 5.6.0 Compatible with Classic Editor plugin (Gutenberg editor Deactivated)

= GUTENBERG BLOCK =
Using the Gutenberg Editor. Use the Page View Count Block to add the counter to any page or post content.  Block search for 'Page Views' or selecting the block from the a3rev Blocks menu.

Adding the Page Views block to your content automatically deactivates the Global Page View counter on the post or page.

= ELEMENTOR TEMPLATES =
Fully compatible with Elementor templates. Add counter via Shortcode or widget to any template.

= DEVELOPERS =

On the plugins dashboard in the + Page Views Count Function options box you will find the Page Views Count functions and notes on how to use them.

* Use to manually add Page views count to any content or object in the theme.
* Use to add page View Count to any content that is not create using WordPress custom post / taxonomy type.
* Use to create a custom position of the Page Views Count
* Functions support echo and return parameters when getting visitor stats on any variable.

= TROUBLESHOOTING =

* The number 1 support request we get about the plugin is that it double or triple counts page or post loads. Yes it does and if you see that it is a Red Flag that you have a misconfiguration or bug in your theme or a plugin. Page Views Count does exactly that - counts each time the page or post is loading in the browser - if its counting twice it is because the browser is double loading the page. That is a bad thing and you or your developer needs to fix that.

= CONTRIBUTE  =

When you download Page Views Count, you join our community. Regardless of if you are a WordPress beginner or experienced developer if you'’re interested in contributing to Page Views Count development head over to the [Page Views Count GitHub Repository](https://github.com/a3rev/page-views-count) to find out how you can contribute.
Want to add a new language to Page Views Count? Great! You can contribute via [translate.wordpress.org](https://translate.wordpress.org/projects/wp-plugins/page-views-count)


== Installation ==

= Minimum Requirements =

* PHP version 7.4 or greater is recommended
* MySQL version 5.6 or greater is recommended

= Automatic installation =

Automatic installation is the easiest option as WordPress handles the file transfers itself and you don't even need to leave your web browser. To do an automatic install of Page Views Count, log in to your WordPress admin panel, navigate to the Plugins menu and click Add New.

In the search field type "Page Views Count" and click Search Plugins. Once you have found our plugin you can install it by simply clicking Install Now. After clicking that link you will be asked if you are sure you want to install the plugin. Click yes and WordPress will automatically complete the installation.

= Manual installation =

The manual installation method involves down loading our plugin and uploading it to your web server via your favorite FTP application.

1. Download the plugin file to your computer and unzip it
2. Using an FTP program, or your hosting control panel, upload the unzipped plugin folder to your WordPress installations wp-content/plugins/ directory.
3. Activate the plugin from the Plugins menu within the WordPress admin.


== Screenshots ==

1. Counter
2. PVC Admin
3. Counter position and type
4. PVC Widget
5. PVC Gutenberg Block


== Usage ==

1. Install and activate the plugin

2. Go to WordPress Settings menu > Page View Count Menu

3. Activate Page Views Count and use the options box settings to make the desired configuration

4. Be sure to clear any caching and browser cache to see your Page Views Count


== Changelog ==

= 2.8.7 - 2025/05/02 =
* This maintenance release has 2 user identified code bug fixes.
* Fix - Remove wp_ajax_nopriv_  action for not logged in user. Props @PluginVulnerabilities for reporting the issue
* Fix - Call get_all_settings at init to resolve textdomain load warning. Props @adrianodownload for reporting the bug

= 2.8.6 - 2025/04/28 =
* This maintenance release has a bug fix that was introduced in security patch release 2.8.5 earlier today.
* Fix - Correct value from post_ids array
* Props - to @dmaragris for reporting the bug.

= 2.8.5 - 2025/04/28 =
* This maintenance update applies 3 security patches and compatibility with WordPress 6.8 - please upgrade now.
* Security Hardening - Reject the request if the key provided does not match the list of allowed keys
* Security Hardening - Allow only administrators with manage_options capability to perform the action
* Security Hardening - Allow only administrators with manage_options capability to enqueue script
* Tweak - Tested for compatibility with WordPress 6.8

= 2.8.4 - 2024/07/15 =
* This release has various tweaks for compatibility with WordPress 6.6
* Tweak - Tested for compatibility with WordPress 6.6
* Tweak - Validate and correct block.json based schema from WordPress Block
* Tweak - Update block.json to v3
* Fix - Make page view count block work with block template and block part template

= 2.8.3 - 2024/05/10 =
* This maintenance release has an edge case fix that means total views record is created again at 1 when a duplicate post ID exists in the database.
* Tweak - Test for compatibility with WordPress 6.5.3
* Fix - Get correct total views instead create new record with value 1 when it has duplicate post ID from database (edge case).

= 2.8.2 - 2023/11/23 =
* This maintenance release has plugin framework updates for compatibility with PHP 8.1 onwards, plus compatibility with WordPress 6.4.1
* Tweak - Test for compatibility with WordPress 6.4.1
* Framework - Set parameter number of preg_match function from null to 0 for compatibility with PHP 8.1 onwards
* Framework - Validate empty before call trim for option value

= 2.8.1 - 2023/05/25 =
* This maintenance release has 1 fix for plugin on new option ADMIN-AJAX.
* Fix - add action to wp_ajax_nopriv_ for new option ADMIN-AJAX

= 2.8.0 - 2023/05/24 =
* This release removes loading PVC Stats with PHP and replaces with REST API as default with Admin-ajax as the fallback.
* Feature - Support options for choose WP REST API or Admin Ajax load PVC stats
* Tweak - Remove load PVC stats by PHP
* Tweak - On upgrade if using PHP to load PVC stats it will update to use WP REST API
* Tweak - If WP REST API is not active it will fall back to ADMIN-AJAX
* Tweak - Auto detect if WP REST API and PVC endpoint are disabled, it will fall back to the ADMIN-AJAX
* Tweak - Add warning notification if WP REST API or PVC Endpoint are disabled.
* Tweak - Updated setting and help text on the Page View Count Load option box.
* Tweak - Test for compatibility with WordPress 6.2.2

= 2.7.0 - 2023/04/08 =
* This release changes the daily views reset from fixed GMT = 00 to use the timezone that is set in the site's WordPress General Settings.
* Feature - Use the timezone from WordPress General Settings as the reset time for daily views counter.
* Tweak - Test for compatibility with WordPress 6.2

= 2.6.3 - 2023/02/25 =
* This maintenance release had 2 performance tweaks for the page view count loading icon.
* Tweak - Upgrade loading icon to a larger one for improved display on mobile retina
* Tweak - Set loading icon width and height attributes to comply with Google Core Web Vitals standards.

= 2.6.2 - 2023/01/30 =
* This maintenance release adds compatibility with plugins that set user roles, ie membership plugins.
* Tweak - Validate $post->ID is not empty for compatibility with User Role plugins

= 2.6.1 - 2023/01/07 =
* Please run this update now to apply a security vulnerability patch
* Security - Page View Block security hardening.

= 2.6.0 - 2023/01/03 =
* This feature release removes the fontawesome lib and replaces icons with SVGs plus adds Default Topography option to font controls.
* Feature - Convert icon from font awesome to SVG
* Feature - Update styling for new SVG icons
* Plugin Framework - Update typography control from plugin framework to add support for Default value
* Plugin Framework - Default value will get fonts set in the theme.
* Plugin Framework - Change generate typography style for change on typography control
* Plugin Framework - Remove fontawesome lib

= 2.5.6 - 2022/09/20 =
* This maintenance release has a security vulnerability patch, please run this update.
* Security - This release has a patch for a security vulnerability identified by Mika @mika_sec via Patchstack

= 2.5.5 - 2022/05/24 =
* This maintenance release is for compatibility with WordPress major version 6.0 plus a bug fix.
* Tweak - Test for compatibility with WordPress 6.0
* Fix - Alignment settings for page view count block not working on frontend

= 2.5.4 - 2022/04/18 =
* This maintenance release has 2 fixes for plugins that filter custom content without post or page.
* Fix - Return custom content for 3rd plugin that use apply_filters 'the_content' instead of the post, page or post type.
* Fix - Return custom content for 3rd plugin that use apply_filters 'the_excerpt' instead of the post, page or post type.

= 2.5.3 - 2022/03/12 =
* This security release follows a full security audit with code refactoring, security hardening including additional escaping and sanitizing.
* Security - Define new esc_attribute_name_e function to escape attribute name late for echo
* Security - Define new esc_description_e function to escape description late for echo
* Security - Escape all $-variable
* Security - Sanitize all $_REQUEST, $_GET, $_POST
* Security - Apply wp_unslash before sanitize

= 2.5.2 - 2022/03/07 =
* This maintenance release contains more code security hardening updates � please run it now.
* Security - Define new esc_attribute_array_e function to escape attribute array late for echo
* Security - Escape $default_color late for echo
* Security - Put $-variable additional with html include into wp_kses_post
* Security - Turn off display_errors to prevent malformed JSON from API for when WP_DEBUG is set to off OR WP_DEBUG_DISPLAY is set to off
* Framework - Allow filters output of CSS are generated from plugin framework
* Framework - Upgrade Plugin Framework to version 2.6.0

= 2.5.1 - 2022/02/25 =
* This maintenance release contains security hardening updates - please run it now.
* Security - Apply wp_kses_post for $-variables that include html before output
* Security - Validate $is_open variable
* Security - Move check nonce and capabilities from before to inside functions

= 2.5.0 - 2022/02/23 =
* This update has 4 code tweaks that harden the plugins security and improve performance - please run this update as soon as you see it.
* Tweak - Nonce check for when settings form is submitted from plugin framework
* Tweak - Capabilities manage_options check for when settings form is submitted from plugin framework
* Tweak - Call update_google_map_api_key when settings form is submitted instead of instance of Admin_UI
* Tweak - Call update_google_font_api_key when settings form is submitted instead of instance of Fonts_Face

= 2.4.15 - 2022/02/01 =
* This is an important security release that patches a SQL injection vulnerability that affects all previous versions. Please run this immediately.
* Security - Patch for SQL injection attack vulnerability

= 2.4.14 - 2022/01/21 =
* This is a maintenance release for compatibility with WordPress major version 5.9
* Tweak - Test for compatibility with WordPress 5.9
* Tweak - Test for compatibility with latest version of Gutenberg from WordPress 5.9
* Framework - Update a3rev Plugin Framework to version 2.5.0

= 2.4.13 - 2021/11/16 =
* This maintenance release has a bug fix for compatibility with Gutenberg 10.8 and PHP 8.x
* Tweak - Test for compatibility with PHP 8.x
* Tweak - Test for compatibility with Gutenberg 10.8
* Fix - Change block_categories to block_categories_all for work on Gutenberg 10.8

= 2.4.12 - 2021/07/19 =
* This maintenance release has code tweaks for WordPress 5.8 compatibility plus more Security hardening
* Tweak - Test for compatibility with WordPress 5.8
* Security - Get variable via name instead of use extract

= 2.4.11 - 2021/07/13 =
* This maintenance release has more code security hardening
* Security - Add more variable, options and html escaping
* Tweak - Skipped version 2.4.10 to avoid PHP misread

= 2.4.9 - 2021/07/10 =
* This maintenance release has code rewrites for WordPress 5.8 compatibility plus a Security patch
* Tweak - Test for compatibility with WordPress 5.8
* Tweak - Test for compatibility with Gutenberg 10.7
* Tweak - Register block page-views-count/stats-editor inside block.js file for work compatibility with WordPress 5.8 new features
* Security - Added escaping for the shortcode postid parameter

= 2.4.8 - 2021/03/17 =
* This maintenance release updates 23 deprecated jQuery functions for compatibility with the latest version of jQuery in WordPress 5.7
* Tweak - Update JavaScript on plugin framework for compatibility with latest version of jQuery and resolve PHP warning event shorthand is deprecated.
* Tweak - Replace deprecated .change( handler ) with .on( 'change', handler )
* Tweak - Replace deprecated .change() with .trigger('change')
* Tweak - Replace deprecated .focus( handler ) with .on( 'focus', handler )
* Tweak - Replace deprecated .focus() with .trigger('focus')
* Tweak - Replace deprecated .click( handler ) with .on( 'click', handler )
* Tweak - Replace deprecated .click() with .trigger('click')
* Tweak - Replace deprecated .select( handler ) with .on( 'select', handler )
* Tweak - Replace deprecated .select() with .trigger('select')
* Tweak - Replace deprecated .blur( handler ) with .on( 'blur', handler )
* Tweak - Replace deprecated .blur() with .trigger('blur')
* Tweak - Replace deprecated .resize( handler ) with .on( 'resize', handler )
* Tweak - Replace deprecated .submit( handler ) with .on( 'submit', handler )
* Tweak - Replace deprecated .scroll( handler ) with .on( 'scroll', handler )
* Tweak - Replace deprecated .mousedown( handler ) with .on( 'mousedown', handler )
* Tweak - Replace deprecated .mouseover( handler ) with .on( 'mouseover', handler )
* Tweak - Replace deprecated .mouseout( handler ) with .on( 'mouseout', handler )
* Tweak - Replace deprecated .keydown( handler ) with .on( 'keydown', handler )
* Tweak - Replace deprecated .attr('disabled', 'disabled') with .prop('disabled', true)
* Tweak - Replace deprecated .removeAttr('disabled') with .prop('disabled', false)
* Tweak - Replace deprecated .attr('selected', 'selected') with .prop('selected', true)
* Tweak - Replace deprecated .removeAttr('selected') with .prop('selected', false)
* Tweak - Replace deprecated .attr('checked', 'checked') with .prop('checked', true)
* Tweak - Replace deprecated .removeAttr('checked') with .prop('checked', false)

= 2.4.7 - 2021/03/09 =
* This maintenance release is for compatibility with WordPress 5.7 and Gutenberg 10.0
* Tweak - Test for compatibility with WordPress 5.7
* Tweak - Test for compatibility with Gutenberg 10.0

= 2.4.6 - 2020/12/30 =
* This is an important maintenance release that updates our scripts for compatibility with the latest version of jQuery released in WordPress 5.6
* Tweak - Update JavaScript on plugin framework for work compatibility with latest version of jQuery
* Fix - Replace .bind( event, handler ) by .on( event, handler ) for compatibility with latest version of jQuery
* Fix - Replace :eq() Selector by .eq() for compatibility with latest version of jQuery
* Fix - Replace .error() by .on( �error� ) for compatibility with latest version of jQuery
* Fix - Replace :first Selector by .first() for compatibility with latest version of jQuery
* Fix - Replace :gt(0) Selector by .slice(1) for compatibility with latest version of jQuery
* Fix - Remove jQuery.browser for compatibility with latest version of jQuery
* Fix - Replace jQuery.isArray() by Array.isArray() for compatibility with latest version of jQuery
* Fix - Replace jQuery.isFunction(x) by typeof x === �function� for compatibility with latest version of jQuery
* Fix - Replace jQuery.isNumeric(x) by typeof x === �number� for compatibility with latest version of jQuery
* Fix - Replace jQuery.now() by Date.now() for compatibility with latest version of jQuery
* Fix - Replace jQuery.parseJSON() by JSON.parse() for compatibility with latest version of jQuery
* Fix - Remove jQuery.support for compatibility with latest version of jQuery
* Fix - Replace jQuery.trim(x) by x.trim() for compatibility with latest version of jQuery
* Fix - Replace jQuery.type(x) by typeof x for compatibility with latest version of jQuery
* Fix - Replace .load( handler ) by .on( �load�, handler ) for compatibility with latest version of jQuery
* Fix - Replace .size() by .length for compatibility with latest version of jQuery
* Fix - Replace .unbind( event ) by .off( event ) for compatibility with latest version of jQuery
* Fix - Replace .unload( handler ) by .on( �unload�, handler ) for compatibility with latest version of jQuery

= 2.4.5 - 2020/12/15 =
* This maintenance release adds a block preview image for block discovery
* Tweak - Add support for Block Discovery Preview

= 2.4.4 - 2020/12/08 =
* This maintenance release has tweaks and a fix for compatibility with WordPress major version 5.6, PHP 7.4.8 and Gutenberg 9.4
* Tweak - Test for compatibility with PHP 7.4.8
* Tweak - Test for compatibility with WordPress 5.6
* Tweak - Test for compatibility with Gutenberg 9.4
* Fix - Update plugin framework script, remove jQuery.browser is deprecated to resolve conflict with jQuery Migrate Helper plugin

= 2.4.3 - 2020/08/08 =
* This maintenance release is for compatibility with WordPress major version 5.5 and WooCommerce 4.3.1.
* Tweak - Test for compatibility with WordPress 5.5
* Tweak - Test for compatibility with WooCommerce 4.3.1
* Tweak - Return default true for permission_callback, required from register_rest_route on WordPress 5.5

= 2.4.2 - 2020/07/20 =
* This maintenance release has a performance tweak, plus compatibility with WordPress 5.4.2, Gutenberg 8.5.1 and WooCommerce 4.3.0
* Tweak - Reduce the block scripts on first load in the Gutenberg Editor
* Tweak - Test for compatibility with WordPress 5.4.2
* Tweak - Test for compatibility with WooCommerce 4.3.0
* Tweak - Test for compatibility with Gutenberg 8.5.1

= 2.4.1 - 2020/04/03 =
* This maintenance release fixes a PHP global function missed in the last update.
* Fix - Update some code from global ${$this- to $GLOBALS[$this missed on previous version

= 2.4.0 - 2020/03/19 =
* This big feature release adds dynamic text, change Total Views and Views Today text from the plugins dashboard. Add support for Dynamic Text string translation. Compatibility with WordPress 5.4, Gutenberg 7.5, WooCommerce 4.0 plus PHP 7.0 to 7.4
* Feature - Add dynamic text support for Total Views and Views Today day text from plugin settings
* Feature - Option to show text on either side of the count number or both sides
* Feature - Add dynamic text strings support for translations with plugins like WPML and Qtranslate
* Tweak - Add the dynamic text options to the Counter Position and Style option box.
* Tweak - Replace No total views yet text with the number 0
* Tweak - Do not show Views Today when the count is 0
* Tweak - Move the Counter Icon settings to new options box.
* Tweak - Update Gutenberg block for work compatibility with Gutenberg latest version 7.5
* Tweak - Test for compatibility with WordPress 5.4
* Tweak - Run Travis CI unit build tests for PHP compatibility issues with PHP 7.0 to 7.4
* Tweak - Update readme decription screenshots.

= 2.3.0 - 2020/03/10 =
* This feature release contains, new PVC shortcode, new PVC Widget, option to only show total views, a new eye icon option, full compatibility with Elementor Templates, completion of PHP Composer refactor and 4 PHP fixes for compatibility with PHP v 7.0 to 7.4.
* Feature - Add new PVC shortcode `[pvc_stats postid="" increase="1" show_views_today="1"]`
* Feature - Add new PVC widget
* Feature - Add new Counter Icon eye option
* Feature - Add Counter Views Type option: Default is ## Total Views, ## Views Today, Option is ## Total Views (hide Views Today)
* Feature - Plugin Framework fully refactored to Composer for cleaner code and faster PHP code
* Feature - Full compatibility with Elementor Templates
* Tweak - Conter Position and Style Options box, added Counter Views Type option
* Tweak - Counter Position and Style Options box, added new Counter Icon eye option
* Tweak - Added new + Page Views Count Shortcode options box with shortcode and parameters
* Tweak - Update plugin for compatibility with new version of plugin Framework
* Tweak - Tested for compatibility with WordPress v 5.3.2
* Fix - Update global ${$this- to $GLOBALS[$this to resolve 7.0+ PHP warnings
* Fix - Update global ${$option to $GLOBALS[$option to resolve 7.0+ PHP warnings
* Fix - Update less PHP lib that use square brackets [] instead of curly braces {} for Array , depreciated in PHP 7.4
* Fix - Validate for not use get_magic_quotes_gpc function for PHP 7.4

= 2.2.1 - 2019/12/17 =
* This maintenance release has a full code security review plus compatibility with WordPress 5.3.1
* Tweak - Remove the hard coded PHP error_reporting display errors false from compile sass to css
* Tweak - Test for compatibility with WordPress 5.3.1
* Dev - Replace file_get_contents with HTTP API wp_remote_get
* Dev - Ensure that all inputs are sanitized and all outputs are escaped

= 2.2.0 - 2019/09/12 =
* This feature upgrade is a full refactor of the plugins PHP to PHP dependency manager Composer with autoloading.
* Feature - Plugin fully refactored to Composer for cleaner code and faster PHP code

= 2.1.3 - 2019/08/01 =
* This maintenance upgrade is to fix a style conflict with fontawesome icons
* Fix - fontawesome icons not able to get correct style on frontend when the fontawesome script is loaded on the page by theme or another plugin.

= 2.1.2 - 2019/06/29 =
* This is a maintenance upgrade to fix a potentially fatal error conflict with sites running PHP 7.3 plus compatibility with WordPress 5.2.2
* Fix - PHP warning continue targeting switch is equivalent to break for compatibility on PHP 7.3

= 2.1.1 - 2018/12/17 =
* This is a maintenance update for WordPress version 5.0.2 and PHP 7.3 compatibility.
* Framework - Update to use WordPress ESLint rules
* Framework - Test and update for compatibility with PHP 7.3
* Tweak - Test for compatibility with WordPress

= 2.1.0 - 2018/12/14 =
* This feature upgrade ports Page View Count editor meta to Page Views Gutenberg block. Full compatibility with WP 5.0.1, 4.9.9 and the Classic editor.
* Feature - Add Dynamic Page Views Block for Gutenberg. Admin can use block to show anywhere in post content. When insert the block it auto deactivates global show PVC at top or bottom of that post.
* Tweak - Global PVC metabox that shows on editor sidebar works with both Gutenberg and Classic Editor
* Tweak - Update functions for frontend view so that it syncs count parameters with Dynamic Block Gutenberg
* Framework - Replace wp_remote_fopen  with file_get_contents for get web fonts
* Framework - Define new variable `is_load_google_fonts` for custom turn it off if plugins do not need to load google font
* Framework - Register style name for dynamic style of plugin for use with Gutenberg block
* Framework - Update Modal script and style to version 4.1.1
* Framework - Update a3rev Plugin Framework to version 2.1.0
* Tweak - Test for compatibility with WordPress 5.0.1 and WordPress 4.9.9

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

= 2.8.7 =
This maintenance release has 2 user identified code bug fixes.

= 2.8.6 =
This maintenance release has a bug fix that was introduced in security patch release 2.8.5 earlier today.

= 2.8.5 =
This maintenance update applies 3 security patches and compatibility with WordPress 6.8 - please upgrade now.

= 2.8.4 =
This release has various tweaks for compatibility with WordPress 6.6

= 2.8.3 =
This maintenance release has an edge case fix that means total views record is created again at 1 when a duplicate post ID exists in the database.

= 2.8.2 =
This maintenance release has plugin framework updates for compatibility with PHP 8.1 onwards, plus compatibility with WordPress 6.4.1

= 2.8.1 =
This maintenance release has 1 fix for plugin on new option ADMIN-AJAX.

= 2.8.0 =
This release removes loading PVC Stats with PHP and replaces with REST API as default with Admin-ajax as the fallback.

= 2.7.0 =
This release changes the daily views reset from fixed GMT = 00 to use the timezone that is set in the site's WordPress General Settings.

= 2.6.3 =
This maintenance release had 2 performance tweaks for the page view count loading icon.

= 2.6.2 =
This maintenance release adds compatibility with plugins that set user roles, ie membership plugins.

= 2.6.1 =
Please run this update now to apply a security vulnerability patch

= 2.6.0 =
This feature release removes the fontawesome lib and replaces icons with SVGs plus adds Default Topography option to font controls.

= 2.5.6 =
This maintenance release has a security vulnerability patch, please run this update.

= 2.5.5 =
This maintenance release is for compatibility with WordPress major version 6.0 plus a bug fix.

= 2.5.4 =
This maintenance release has 2 fixes for plugins that filter custom content without post or page.

= 2.5.3 =
This security release follows a full security audit with code refactoring, security hardening including additional escaping and sanitizing.

= 2.5.2 =
This maintenance release contains more code security hardening updates � please run it now.

= 2.5.1 =
This maintenance release contains security hardening updates - please run it now.

= 2.5.0 =
This update has 4 code tweaks that harden the plugins security and improve performance - please run this update as soon as you see it.

= 2.4.15 =
This is an important security release that patches a SQL injection vulnerability that affects all previous versions. Please run this immediately.

= 2.4.14 =
This is a maintenance release for compatibility with WordPress major version 5.9

= 2.4.13 =
This maintenance release has a bug fix for compatibility with Gutenberg 10.8 and PHP 8.x

= 2.4.12 =
This maintenance release has code tweaks for WordPress 5.8 compatibility plus more Security hardening

= 2.4.11 =
This maintenance release has more code security hardening.

= 2.4.9 =
This maintenance release has code rewrites for WordPress 5.8 compatibility plus a Security patch

= 2.4.8 =
This maintenance release updates 23 deprecated jQuery functions for compatibility with the latest version of jQuery in WordPress 5.7

= 2.4.7 =
This maintenance release is for compatibility with WordPress 5.7 and Gutenberg 10.0

= 2.4.6 =
This is an important maintenance release that updates our scripts for compatibility with the latest version of jQuery released in WordPress 5.6

= 2.4.5 =
This maintenance release adds a block preview image for block discovery

= 2.4.4 =
This maintenance release has tweaks and a fix for compatibility with WordPress major version 5.6, PHP 7.4.8 and Gutenberg 9.4

= 2.4.3 =
This maintenance release is for compatibility with WordPress major version 5.5 and WooCommerce 4.3.1.

= 2.4.2 =
This maintenance release has a performance tweak, plus compatibility with WordPress 5.4.2, Gutenberg 8.5.1 and WooCommerce 4.3.0

= 2.4.1 =
This maintenance release fixes a PHP global function missed in the last update.

= 2.4.0 =
This big feature release adds dynamic text, change Total Views and Views Today text from the plugins dashboard. Add support for Dynamic Text string translation. Compatibility with WordPress 5.4, Gutenberg 7.5, WooCommerce 4.0 plus PHP 7.0 to 7.4

= 2.3.0 =
This feature release contains, new PVC shortcode, new PVC Widget, option to only show total views, a new eye icon option, full compatibility with Elementor Templates, completion of PHP Composer refactor and 4 PHP fixes for compatibility with PHP v 7.0 to 7.4.

= 2.2.1 =
This maintenance release has a full code security review plus compatibility with WordPress 5.3.1

= 2.2.0 =
This feature upgrade is a full refactor of the plugins PHP to PHP dependency manager Composer with autoloading.

= 2.1.3 =
This maintenance upgrade is to fix a style conflict with fontawesome icons

= 2.1.2 =
* This is a maintenance upgrade to fix a potentially fatal error conflict with sites running PHP 7.3 plus compatibility with WordPress 5.2.2

= 2.1.1 =
This is a maintenance update for WordPress version 5.0.2 and PHP 7.3 compatibility

= 2.1.0 =
This feature upgrade ports Page View Count editor meta box to Page Views Gutenberg block. Full compatibility with WP 5.0.1, 4.9.9 and the Classic Editor.

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
Upgrade now for a bug fix for Sass in yesterday's major version release 1.0.6.

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
