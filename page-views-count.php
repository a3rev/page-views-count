<?php
/*
Plugin Name: Page Views Count
Description: Show front end users all time views and views today on posts, pages, index pages and custom post types with the Page Views Count Plugin. Use the Page Views Count function to add page views to any content type or object created by your theme or plugins.
Version: 2.1.1
Requires at least: 4.6
Tested up to: 5.0.2
Author: a3rev Software
Author URI: https://a3rev.com
Text Domain: page-views-count
Domain Path: /languages
License: A "Slug" license name e.g. GPL2
*/
?>
<?php
define('A3_PVC_FOLDER', dirname(plugin_basename(__FILE__)));
define('A3_PVC_DIR', WP_CONTENT_DIR . '/plugins/' . A3_PVC_FOLDER);
define('A3_PVC_PLUGIN_NAME', plugin_basename(__FILE__));
define('A3_PVC_URL', untrailingslashit(plugins_url('/', __FILE__)));
define('A3_PVC_CSS_URL', A3_PVC_URL . '/assets/css');
define('A3_PVC_JS_URL', A3_PVC_URL . '/assets/js');
define('A3_PVC_IMAGES_URL', A3_PVC_URL . '/assets/images');

define( 'A3_PVC_KEY', 'a3_page_view_count' );
define( 'A3_PVC_VERSION', '2.1.1' );
define( 'A3_PVC_G_FONTS', false );

/**
 * Load Localisation files.
 *
 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
 *
 * Locales found in:
 * 		- WP_LANG_DIR/page-views-count/page-views-count-LOCALE.mo
 * 	 	- /wp-content/plugins/page-views-count/languages/page-views-count-LOCALE.mo (which if not found falls back to)
 * 	 	- WP_LANG_DIR/plugins/page-views-count-LOCALE.mo
 */
function a3_pvc_load_plugin_textdomain() {
	$locale = apply_filters( 'plugin_locale', get_locale(), 'page-views-count' );

	load_textdomain( 'page-views-count', WP_LANG_DIR . '/page-views-count/page-views-count-' . $locale . '.mo' );
	load_plugin_textdomain( 'page-views-count', false, A3_PVC_FOLDER . '/languages/' );
}

// API Class
include_once( 'api/pvc-api.php' );

include ('admin/admin-ui.php');
include ('admin/admin-interface.php');

include ('admin/admin-pages/admin-pvc-page.php');

include ('admin/admin-init.php');
include ('admin/less/sass.php');

include ("pvc_class.php");
include ("classes/class-pvc-metabox.php");
include ('src/blocks.php');

include ('admin/plugin-init.php');

/**
 * Process when plugin is activated
 */
register_activation_hook(__FILE__, 'pvc_install');

/**
 * Process when plugin is deactivated
 */
register_deactivation_hook(__FILE__, 'pvc_deactivation');

function pvc_stats( $postid, $have_echo = 1, $attributes = array() ) {
    return A3_PVC::custom_stats_echo( $postid, $have_echo, $attributes );
}

function pvc_stats_update( $postid, $have_echo = 1, $attributes = array() ) {
    return A3_PVC::custom_stats_update_echo( $postid, $have_echo, $attributes );
}

function pvc_is_activated( $postid = 0 ) {
    return A3_PVC::pvc_is_activated( $postid );
}

// For Support 3rd party plugins have used this on their custom code
function pvc_check_exclude( $postid = 0 ) {
	if ( pvc_is_activated( $postid ) ) {
		return false;
	} else {
		return true;
	}
}

?>