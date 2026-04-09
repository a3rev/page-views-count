<?php
/**
 * Block Editor document sidebar: mirrors legacy Page View Counter meta box.
 *
 * @package Page Views Count
 */

namespace A3Rev\PageViewsCount;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * REST + editor script for Page Views Count panel in the block editor.
 */
class Pvc_Editor_Sidebar {

	/**
	 * REST field name (post object key).
	 */
	const REST_FIELD = 'a3_pvc';

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'register_rest_field' ) );
		add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_block_editor_assets' ) );
	}

	/**
	 * Post types that expose the REST API (editor-relevant).
	 *
	 * @return string[]
	 */
	protected function get_rest_post_types() {
		return array_keys( get_post_types( array( 'show_in_rest' => true ), 'names' ) );
	}

	/**
	 * Register combined panel data for block editor save/load.
	 */
	public function register_rest_field() {
		$post_types = $this->get_rest_post_types();
		if ( empty( $post_types ) ) {
			return;
		}

		register_rest_field(
			$post_types,
			self::REST_FIELD,
			array(
				'get_callback'    => array( $this, 'rest_get_a3_pvc' ),
				'update_callback' => array( $this, 'rest_update_a3_pvc' ),
				'schema'          => array(
					'description' => __( 'Page Views Count: activation and manual view counts.', 'page-views-count' ),
					'type'        => 'object',
					'context'     => array( 'view', 'edit' ),
					'properties'  => array(
						'activated'   => array(
							'description' => __( 'Whether counting is activated for this item.', 'page-views-count' ),
							'type'        => 'boolean',
							'context'     => array( 'view', 'edit' ),
						),
						'total_views' => array(
							'description' => __( 'All-time views (manual adjust).', 'page-views-count' ),
							'type'        => 'integer',
							'context'     => array( 'view', 'edit' ),
						),
						'today_views' => array(
							'description' => __( 'Today views (manual adjust).', 'page-views-count' ),
							'type'        => 'integer',
							'context'     => array( 'view', 'edit' ),
						),
					),
				),
			)
		);
	}

	/**
	 * REST get callback: meta activation resolution + DB counts (same sources as legacy meta box).
	 *
	 * @param array $prepared_post Post response data.
	 * @return array<string,mixed>
	 */
	public function rest_get_a3_pvc( $prepared_post ) {
		$post_id = isset( $prepared_post['id'] ) ? (int) $prepared_post['id'] : 0;
		if ( $post_id <= 0 ) {
			return array(
				'activated'   => false,
				'total_views' => 0,
				'today_views' => 0,
			);
		}

		$view_status = A3_PVC::pvc_fetch_post_counts( $post_id );

		return array(
			'activated'   => A3_PVC::pvc_admin_is_activated( $post_id ),
			'total_views' => isset( $view_status->total ) ? (int) $view_status->total : 0,
			'today_views' => isset( $view_status->today ) ? (int) $view_status->today : 0,
		);
	}

	/**
	 * REST update: _a3_pvc_activated + optional manual stats (matches legacy save_post).
	 *
	 * @param array|\WP_Error $value New value.
	 * @param \WP_Post        $post_object Post object.
	 * @return true|\WP_Error
	 */
	public function rest_update_a3_pvc( $value, $post_object ) {
		if ( is_wp_error( $value ) ) {
			return $value;
		}

		if ( ! $post_object instanceof \WP_Post ) {
			return new \WP_Error(
				'rest_invalid_param',
				__( 'Invalid post object.', 'page-views-count' ),
				array( 'status' => 400 )
			);
		}

		$post_id = (int) $post_object->ID;
		if ( $post_id <= 0 ) {
			return new \WP_Error(
				'rest_invalid_param',
				__( 'Invalid post ID.', 'page-views-count' ),
				array( 'status' => 400 )
			);
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return new \WP_Error(
				'rest_cannot_edit',
				__( 'Sorry, you are not allowed to edit this post.', 'page-views-count' ),
				array( 'status' => rest_authorization_required_code() )
			);
		}

		if ( ! is_array( $value ) ) {
			return true;
		}

		if ( array_key_exists( 'activated', $value ) ) {
			$a3_pvc_activated = ! empty( $value['activated'] ) ? 'true' : 'false';
			update_post_meta( $post_id, '_a3_pvc_activated', $a3_pvc_activated );
		}

		// Legacy only runs manual update when both POST fields are set.
		if ( isset( $value['total_views'], $value['today_views'] ) ) {
			$total_views = absint( $value['total_views'] );
			$today_views = absint( $value['today_views'] );
			A3_PVC::pvc_stats_manual_update( $post_id, $total_views, $today_views );
		}

		return true;
	}

	/**
	 * Load editor script only on block post screens.
	 */
	public function enqueue_block_editor_assets() {
		$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
		if ( ! $screen || 'post' !== $screen->base || empty( $screen->post_type ) ) {
			return;
		}

		if ( ! function_exists( 'use_block_editor_for_post_type' ) || ! use_block_editor_for_post_type( $screen->post_type ) ) {
			return;
		}

		$handle = 'a3-pvc-editor-sidebar';
		wp_register_script(
			$handle,
			A3_PVC_URL . '/assets/js/pvc-editor-sidebar.js',
			array(
				'wp-plugins',
				'wp-edit-post',
				'wp-components',
				'wp-data',
				'wp-element',
				'wp-i18n',
				'wp-editor',
			),
			A3_PVC_VERSION,
			true
		);

		if ( function_exists( 'wp_set_script_translations' ) ) {
			wp_set_script_translations( $handle, 'page-views-count' );
		}

		wp_enqueue_script( $handle );
	}
}
