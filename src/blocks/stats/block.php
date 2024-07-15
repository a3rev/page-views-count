<?php
/**
 * Server-side rendering of the `core/post-title` block.
 *
 * @package WordPress
 */

/**
 * Renders the `core/post-title` block on the server.
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block default content.
 * @param WP_Block $block      Block instance.
 *
 * @return string Returns the filtered post title for the current post wrapped inside "h1" tags.
 */
function render_block_a3_pvc( $attributes, $content, $block ) {
	if( isset( $attributes['isDisabled'] ) && false === $attributes['isDisabled'] ) {
		if ( ! empty( $attributes['postID'] ) ) {
			$attributes['in_editor'] = true;
			$html_output = pvc_stats( $attributes['postID'], 0, $attributes );
		} else {
			global $post;
			$post_id = $post->ID;
			$html_output = pvc_stats_update( $post_id, 0, $attributes );
		}
		
		$wrapper_attributes = get_block_wrapper_attributes();
		return sprintf( '<div %1$s>%2$s</div>', $wrapper_attributes, $html_output );
	}

	return '';
}

/**
 * Registers the `core/post-title` block on the server.
 */
function register_block_a3_pvc() {
	register_block_type(
		__DIR__ . '/block.json',
		array(
			'render_callback' => 'render_block_a3_pvc',
		)
	);

	if ( function_exists( 'wp_set_script_translations' ) ) {
		wp_set_script_translations( 'page_views_count-cgb-block-js', 'page-views-count' );
	} elseif ( function_exists( 'wp_get_jed_locale_data' ) || function_exists( 'gutenberg_get_jed_locale_data' ) ) {
		$locale_data = function_exists( 'wp_get_jed_locale_data' ) ? wp_get_jed_locale_data( 'page-views-count' ) : gutenberg_get_jed_locale_data( 'page-views-count' );

		wp_add_inline_script(
			'wp-i18n',
			'wp.i18n.setLocaleData( ' . wp_json_encode( $locale_data ) . ', "page-views-count" );',
			'after'
		);
	}
}
add_action( 'init', 'register_block_a3_pvc' );
