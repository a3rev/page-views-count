<?php
/**
 * Class SampleTest
 *
 * @package Sample_Plugin
 */

/**
 * Sample test case.
 */
class a3Rev_Tests_PVC_Shortcode extends WP_UnitTestCase {

	/**
	 * A single example test.
	 */
	function test_shortcode_work() {
		$output = do_shortcode( '[pvc_stats postid=1]' );

		$this->assertStringContainsString( 'total views' , $output );
	}

	function test_show_views_today() {
		$pvc_settings = array( 'views_type' => 'total_only' );
		update_option( 'pvc_settings', $pvc_settings );
		
		$output = do_shortcode( '[pvc_stats postid=1 show_views_today=1]' );

		$this->assertStringContainsString( 'views today' , $output );
	}
}
