<?php
/**
 * Process when plugin is activated
 */
function pvc_install(){
	update_option( 'a3_pvc_version', A3_PVC_VERSION );

	// empty pvc_daily table for daily
	wp_schedule_event( time(), 'daily', 'pvc_empty_daily_table_daily_event_hook' );

	A3_PVC::install_database();

	// Set Settings Default from Admin Init
	global $wp_pvc_admin_init;
	$wp_pvc_admin_init->set_default_settings();

	delete_metadata( 'user', 0, $wp_pvc_admin_init->plugin_name . '-' . 'plugin_framework_global_box' . '-' . 'opened', '', true );

	update_option('pvc_just_installed', true);
}

/**
 * Process when plugin is deactivated
 */
function pvc_deactivation() {
	wp_clear_scheduled_hook( 'pvc_empty_daily_table_daily_event_hook' );
}

update_option('a3rev_pvc_plugin', 'a3_page_view_count');
update_option('a3rev_auth_pvc', '');

function a3_pvc_plugin_init() {

	// Set up localisation
	a3_pvc_load_plugin_textdomain();
}

add_action( 'init', 'a3_pvc_plugin_init' );

// Add custom style to dashboard
add_action( 'admin_enqueue_scripts', array( 'A3_PVC', 'a3_wp_admin' ) );

// Add extra link on left of Deactivate link on Plugin manager page
add_action('plugin_action_links_'.A3_PVC_PLUGIN_NAME, array('A3_PVC', 'settings_plugin_links') );

// Add text on right of Visit the plugin on Plugin manager page
add_filter( 'plugin_row_meta', array('A3_PVC', 'plugin_extra_links'), 10, 2 );


// Need to call Admin Init to show Admin UI
global $wp_pvc_admin_init;
$wp_pvc_admin_init->init();

// Add upgrade notice to Dashboard pages
add_filter( $wp_pvc_admin_init->plugin_name . '_plugin_extension_boxes', array( 'A3_PVC', 'plugin_extension_box' ) );

/**
 * On the scheduled action hook, run the function.
 */
add_action( 'pvc_empty_daily_table_daily_event_hook', 'pvc_empty_daily_table_do_daily' );
function pvc_empty_daily_table_do_daily() {
	global $wpdb;
	$wpdb->query("DELETE FROM " . $wpdb->prefix . "pvc_daily WHERE time <= '".date('Y-m-d', strtotime('-2 days'))."'");
}

$pvc_settings = get_option( 'pvc_settings', array( 'position' => 'bottom' ) );
if ( isset( $pvc_settings['position'] ) && 'top' == $pvc_settings['position'] ) {
	add_action('genesis_before_post_content', array('A3_PVC', 'genesis_pvc_stats_echo'));
} else {
	add_action('genesis_after_post_content', array('A3_PVC', 'genesis_pvc_stats_echo'));
}
//add_action('loop_end', array('A3_PVC', 'pvc_stats_echo'), 9);
add_filter('the_content', array('A3_PVC','pvc_stats_show'), 8);
add_filter('the_excerpt', array('A3_PVC','excerpt_pvc_stats_show'), 8);
//add_filter('get_the_excerpt', array('A3_PVC','excerpt_pvc_stats_show'), 8);

// Add ajax script to load page view count stats into footer
add_action( 'wp_enqueue_scripts', array( 'A3_PVC', 'register_plugin_scripts' ) );

// Check upgrade functions
add_action('plugins_loaded', 'pvc_lite_upgrade_plugin');
function pvc_lite_upgrade_plugin () {
	global $a3_pvc_less;

	if(version_compare(get_option('a3_pvc_version'), '1.2') === -1){
		update_option('a3_pvc_version', '1.2');
		A3_PVC::upgrade_version_1_2();
	}

	if(version_compare(get_option('a3_pvc_version'), '1.3.5') === -1){
		update_option('a3_pvc_version', '1.3.5');

		wp_schedule_event( strtotime( date('Y-m-d'). ' 00:00:00' ), 'daily', 'pvc_empty_daily_table_daily_event_hook' );
		global $wpdb;
		$sql = "ALTER TABLE ". $wpdb->prefix . "pvc_daily  CHANGE `id` `id` BIGINT NOT NULL AUTO_INCREMENT";
		$wpdb->query($sql);
		$sql = "ALTER TABLE ". $wpdb->prefix . "pvc_total  CHANGE `id` `id` BIGINT NOT NULL AUTO_INCREMENT";
		$wpdb->query($sql);
	}
	if(version_compare(get_option('a3_pvc_version'), '1.3.6') === -1){
		update_option('a3_pvc_version', '1.3.6');

		$pvc_settings = get_option( 'pvc_settings' );
		if ( isset( $pvc_settings['post_types'] ) && is_array( $pvc_settings['post_types'] ) && count( $pvc_settings['post_types'] ) > 0 ) {
			$post_types_new = array();
			foreach ( $pvc_settings['post_types'] as $post_type ) {
				$post_types_new[$post_type] = $post_type;
			}
			$pvc_settings['post_types'] = $post_types_new;
			update_option( 'pvc_settings', $pvc_settings );
		}
	}

	if ( version_compare( get_option('a3_pvc_version'), '1.4.0' ) === -1 ) {
		update_option('a3_pvc_version', '1.4.0');

		// Set Settings Default from Admin Init
		$pvc_settings = get_option( 'pvc_settings' );
		$pvc_settings['show_on_excerpt_content'] = 'yes';

		update_option( 'pvc_settings', $pvc_settings );
	}

	if ( version_compare( get_option('a3_pvc_version'), '2.0.0' ) === -1 ) {
		update_option('a3_pvc_version', '2.0.0');

		// Build sass
		$a3_pvc_less->plugin_build_sass();
	}

	update_option( 'a3_pvc_version', A3_PVC_VERSION );

}

?>