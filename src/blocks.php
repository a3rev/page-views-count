<?php
/**
 * Blocks Initializer
 *
 * Enqueue CSS/JS of all the blocks.
 *
 * @since   1.0.0
 * @package CGB
 */

namespace A3Rev\PageViewsCount;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Blocks {

	public function __construct() {

		add_action( 'init', array( $this, 'register_block' ) );

		// Hook: Editor assets.
		add_action( 'enqueue_block_assets', array( $this, 'cgb_editor_assets' ) );
	}

	/**
	 * Enqueue Gutenberg block assets for backend editor.
	 *
	 * @uses {wp-blocks} for block type registration & related functions.
	 * @uses {wp-element} for WP Element abstraction — structure of blocks.
	 * @uses {wp-i18n} to internationalize the block's text.
	 * @uses {wp-editor} for WP editor styles.
	 * @since 1.0.0
	 */
	function cgb_editor_assets() { // phpcs:ignore

		if ( ! is_admin() ) {
			return;
		}

		$GLOBALS[A3_PVC_PREFIX.'less']->register_dynamic_style_file();

		$js_deps = apply_filters( 'pvc_block_js_deps', array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ) );

		wp_register_script(
			'page_views_count-cgb-block-js', // Handle.
			plugins_url( '/dist/blocks.build.js', dirname( __FILE__ ) ),
			$js_deps,
			A3_PVC_VERSION,
			array(
				'strategy'  => 'defer',
				'in_footer' => true,
			)
		);

		wp_localize_script( 'page_views_count-cgb-block-js', 'pvcblock', array( 
			'preview'    => A3_PVC_URL.  '/src/blocks/stats/preview.jpg',
		) );
	}

	public function create_a3blocks_section() {

		add_filter( 'block_categories_all', function( $categories ) {

			$category_slugs = wp_list_pluck( $categories, 'slug' );

			if ( in_array( 'a3rev-blocks', $category_slugs ) ) {
				return $categories;
			}

			return array_merge(
				array(
					array(
						'slug' => 'a3rev-blocks',
						'title' => __( 'a3rev Blocks' ),
						'icon' => '',
					),
				),
				$categories
			);
		}, 2 );
	}

	public function register_block() {
		$this->create_a3blocks_section();
	}
}
