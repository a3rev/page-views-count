<?php
class A3_PVC
{
	public static function upgrade_version_1_2(){
		global $wpdb;
		$sql = "ALTER TABLE ". $wpdb->prefix . "pvc_total CHANGE `postnum` `postnum` VARCHAR( 255 ) NOT NULL";
		$wpdb->query($sql);

		$sql = "ALTER TABLE ". $wpdb->prefix . "pvc_daily CHANGE `postnum` `postnum` VARCHAR( 255 ) NOT NULL";
		$wpdb->query($sql);
	}
	public static function install_database(){
		global $wpdb;
		$collate = '';
		if ( $wpdb->has_cap( 'collation' ) ) {
			if ( !empty($wpdb->charset) ) $collate = "DEFAULT CHARACTER SET $wpdb->charset";
			if ( !empty($wpdb->collate) ) $collate .= " COLLATE $wpdb->collate";
		}

		$sql = "CREATE TABLE IF NOT EXISTS ". $wpdb->prefix . "pvc_daily" ." (
         `id` mediumint(9) NOT NULL AUTO_INCREMENT,
		 `time` date DEFAULT '0000-00-00' NOT NULL,
		 `postnum` varchar(255) NOT NULL,
		 `postcount` int DEFAULT '0' NOT NULL,
		 UNIQUE KEY id (id)) $collate;";

		$wpdb->query($sql);


		$sql = "CREATE TABLE IF NOT EXISTS ". $wpdb->prefix . "pvc_total" ." (
			 `id` mediumint(9) NOT NULL AUTO_INCREMENT,
			 `postnum` varchar(255) NOT NULL,
			 `postcount` int DEFAULT '0' NOT NULL,
			 UNIQUE KEY id (id)) $collate;";

		$wpdb->query($sql);
	}

	public static function pvc_fetch_posts_stats( $post_ids ) {
		global $wpdb;
		$nowisnow = date('Y-m-d');

		if ( !is_array( $post_ids ) ) $post_ids = array( $post_ids );

		$sql = $wpdb->prepare( "SELECT t.postnum AS post_id, t.postcount AS total, d.postcount AS today FROM ". $wpdb->prefix . "pvc_total AS t
			LEFT JOIN ". $wpdb->prefix . "pvc_daily AS d ON t.postnum = d.postnum
			WHERE t.postnum IN ( ".implode( ',', $post_ids )." ) AND d.time = %s", $nowisnow );
		return $wpdb->get_results($sql);
	}

	public static function pvc_fetch_post_counts( $post_id ) {
		$total = A3_PVC::pvc_fetch_post_total( $post_id );
		$today = A3_PVC::pvc_fetch_post_today( $post_id );

		$post_counts        = new stdClass();
		$post_counts->total = 0;
		$post_counts->today = 0;

		if ( ! empty( $total ) ) {
			$post_counts->total = $total;
		}

		if ( ! empty( $today ) ) {
			$post_counts->today = $today;
		}

		return $post_counts;
	}

	public static function pvc_fetch_post_total( $post_id ) {
		global $wpdb;

		$sql = $wpdb->prepare( "SELECT postcount AS total FROM ". $wpdb->prefix . "pvc_total
			WHERE postnum = %s", $post_id );
		return $wpdb->get_var($sql);
	}

	public static function pvc_fetch_post_today( $post_id ) {
		global $wpdb;
		$nowisnow = date('Y-m-d');

		$sql = $wpdb->prepare( "SELECT postcount AS today FROM ". $wpdb->prefix . "pvc_daily
			WHERE postnum = %s AND time = %s", $post_id, $nowisnow );
		return $wpdb->get_var($sql);
	}

	public static function pvc_stats_update($post_id) {
		global $wpdb;

		// get the local time based off WordPress setting
		$nowisnow = date('Y-m-d');

		// first try and update the existing total post counter
		$results = $wpdb->query( $wpdb->prepare( "UPDATE ". $wpdb->prefix . "pvc_total SET postcount = postcount+1 WHERE postnum = '%s' LIMIT 1", $post_id ) );

		// if it doesn't exist, then insert two new records
		// one in the total views, another in today's views
		if ($results == 0) {
			$wpdb->query( $wpdb->prepare( "INSERT INTO ". $wpdb->prefix . "pvc_total (postnum, postcount) VALUES ('%s', 1)", $post_id ) );
			$wpdb->query( $wpdb->prepare ( "INSERT INTO ". $wpdb->prefix . "pvc_daily (time, postnum, postcount) VALUES ('%s', '%s', 1)", $nowisnow, $post_id ) );
		// post exists so let's just update the counter
		} else {
			$results2 = $wpdb->query( $wpdb->prepare ( "UPDATE ". $wpdb->prefix . "pvc_daily SET postcount = postcount+1 WHERE time = '%s' AND postnum = '%s' LIMIT 1", $nowisnow, $post_id ) );
			// insert a new record since one hasn't been created for current day
			if ($results2 == 0)
				$wpdb->query( $wpdb->prepare( "INSERT INTO ". $wpdb->prefix . "pvc_daily (time, postnum, postcount) VALUES ('%s', '%s', 1)", $nowisnow, $post_id ) );
		}

	}

	public static function pvc_stats_manual_update( $post_id, $new_total_views, $new_today_views ) {
		global $wpdb;

		// get the local time based off WordPress setting
		$nowisnow = date('Y-m-d');

		// if it doesn't exist, then insert new record
		// one in the total views
		if ( '1' != $wpdb->get_var( $wpdb->prepare( "SELECT EXISTS( SELECT 1 FROM ". $wpdb->prefix . "pvc_total WHERE postnum = %s LIMIT 0, 1 )", $post_id ) ) ) {
			$wpdb->query( $wpdb->prepare( "INSERT INTO ". $wpdb->prefix . "pvc_total ( postnum, postcount ) VALUES ( %s, %d )", $post_id, $new_total_views ) );
		// post exists so let's just update the counter
		} else {
			$wpdb->query( $wpdb->prepare( "UPDATE ". $wpdb->prefix . "pvc_total SET postcount = %d WHERE postnum = %s LIMIT 1", $new_total_views, $post_id ) );
		}

		// if it doesn't exist, then insert new record
		// one in today's views
		if ( '1' != $wpdb->get_var( $wpdb->prepare( "SELECT EXISTS( SELECT 1 FROM ". $wpdb->prefix . "pvc_daily WHERE time = %s AND postnum = %s LIMIT 0, 1 )", $nowisnow, $post_id ) ) ) {
			$wpdb->query( $wpdb->prepare ( "INSERT INTO ". $wpdb->prefix . "pvc_daily ( time, postnum, postcount ) VALUES ( %s, %s, %d )", $nowisnow, $post_id, $new_today_views ) );
		// post exists so let's just update the counter
		} else {
			$wpdb->query( $wpdb->prepare ( "UPDATE ". $wpdb->prefix . "pvc_daily SET postcount = %d WHERE time = %s AND postnum = %s LIMIT 1", $new_today_views, $nowisnow, $post_id ) );
		}
	}

	public static function pvc_get_stats( $post_id ) {
		global $wpdb;

		$output_html = '';
		// get all the post view info to display
		$total = A3_PVC::pvc_fetch_post_total( $post_id );
		$today = A3_PVC::pvc_fetch_post_today( $post_id );

		if ( ! empty( $total ) ) {

			$output_html .= number_format( $total ) . '&nbsp;' .__('total views', 'page-views-count');
			$output_html .= ', ';

			if ( ! empty( $today ) ) {
				$output_html .= number_format( $today ) . '&nbsp;' .__('views today', 'page-views-count');
			} else {
				$output_html .= __('no views today', 'page-views-count');
			}

		} else {
			$output_html .=  __('No views yet', 'page-views-count');
		}

		$output_html = apply_filters( 'pvc_filter_get_stats', $output_html, $post_id );

		return $output_html;
	}

	// get the total page views and daily page views for the post
	public static function pvc_stats_counter( $post_id, $increase_views = false, $attributes = array() ) {
		global $wpdb;
		global $pvc_settings;

		$load_by_ajax_update_class = '';
		if ( $increase_views ) $load_by_ajax_update_class = 'pvc_load_by_ajax_update';

		// get the stats and
		$html = '<div class="pvc_clear"></div>';

		$custom_class = '';
		if ( ! empty( $attributes['className'] ) ) {
			$custom_class = $attributes['className'];
		}

		$custom_style = '';
		if ( ! empty( $attributes['align'] ) ) {
			switch ( $attributes['align'] ) {
				case 'center':
					$custom_style = 'text-align:center;float:none;';
					break;
				case 'right':
					$custom_style = 'float:right;';
					break;
				default:
					$custom_style = 'float:left;';
					break;
			}
		}

		if ( $pvc_settings['enable_ajax_load'] == 'yes' && empty( $attributes['in_editor'] ) ) {
			$stats_html = '<p id="pvc_stats_'.$post_id.'" class="pvc_stats '. $custom_class .' '.$load_by_ajax_update_class.'" data-element-id="'.$post_id.'" style="'. $custom_style .'"><i class="fa fa-bar-chart pvc-stats-icon '.$pvc_settings['icon_size'].'" aria-hidden="true"></i> <img src="'.A3_PVC_URL.'/ajax-loader.gif" border=0 /></p>';
		} else {
			$stats_html = '<p class="pvc_stats '. $custom_class .'" data-element-id="'.$post_id.'" style="'. $custom_style .'"><i class="fa fa-bar-chart pvc-stats-icon '.$pvc_settings['icon_size'].'" aria-hidden="true"></i> ' . A3_PVC::pvc_get_stats( $post_id ) . '</p>';
		}

		$html .= apply_filters( 'pvc_filter_stats', $stats_html, $post_id );
		$html .= '<div class="pvc_clear"></div>';
		return $html;
	}

	public static function register_plugin_scripts() {
		global $pvc_settings;
		global $pvc_api;

		$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';

		// If don't have any plugin or theme register font awesome style then register it from plugin framework
		if ( ! wp_style_is( 'font-awesome-styles', 'registered' ) ) {
			global $wp_pvc_admin_interface;
			$wp_pvc_admin_interface->register_fontawesome_style();
		}

		wp_enqueue_style( 'a3-pvc-style', A3_PVC_CSS_URL . '/style'.$suffix.'.css', array( 'font-awesome-styles' ), A3_PVC_VERSION );

		if ( $pvc_settings['enable_ajax_load'] != 'yes' ) return;

	?>
    <!-- PVC Template -->
    <script type="text/template" id="pvc-stats-view-template">
    <i class="fa fa-bar-chart pvc-stats-icon <?php echo $pvc_settings['icon_size']; ?>" aria-hidden="true"></i> 
	<% if ( total_view > 0 ) { %>
		<%= total_view %> <%= total_view > 1 ? "<?php _e('total views', 'page-views-count'); ?>" : "<?php _e('total view', 'page-views-count'); ?>" %>,
		<% if ( today_view > 0 ) { %>
			<%= today_view %> <%= today_view > 1 ? "<?php _e('views today', 'page-views-count'); ?>" : "<?php _e('view today', 'page-views-count'); ?>" %>
		<% } else { %>
		<?php _e('no views today', 'page-views-count'); ?>
		<% } %>
	<% } else { %>
	<?php _e('No views yet', 'page-views-count'); ?>
	<% } %>
	</script>
    <?php
		wp_enqueue_script( 'a3-pvc-backbone', A3_PVC_JS_URL . '/pvc.backbone'.$suffix.'.js', array( 'jquery', 'backbone', 'underscore' ), A3_PVC_VERSION );
		wp_localize_script( 'a3-pvc-backbone', 'vars', array( 'rest_api_url' => rest_url( '/' . $pvc_api->namespace ) ) );
	}

	public static function pvc_remove_stats($content) {
		remove_action('the_content', array('A3_PVC','pvc_stats_show'));
		return $content;
	}

	public static function pvc_stats_show($content){
		remove_action('loop_end', array('A3_PVC', 'pvc_stats_echo'));
		remove_action('genesis_before_post_content', array('A3_PVC', 'genesis_pvc_stats_echo'));
		remove_action('genesis_after_post_content', array('A3_PVC', 'genesis_pvc_stats_echo'));
		global $post;
		if ( ! $post ) return;

		$args=array(
			  'public'   => true,
			  '_builtin' => false
			);
		$output = 'names'; // names or objects, note names is the default
		$operator = 'and'; // 'and' or 'or'
		$post_types = get_post_types($args, $output, $operator );

		global $pvc_settings;
		if ( empty( $pvc_settings ) ) {
			$pvc_settings = get_option('pvc_settings', array() );
		}

		if ( self::pvc_is_activated( $post->ID ) ) {
			if ( is_singular() || is_singular( $post_types ) ) {
				if ( ! isset( $pvc_settings['enable_ajax_load'] ) || $pvc_settings['enable_ajax_load'] != 'yes' ) {
					A3_PVC::pvc_stats_update($post->ID);
				}
				$pvc_stats_html = A3_PVC::pvc_stats_counter($post->ID, true );
			} else {
				$pvc_stats_html = A3_PVC::pvc_stats_counter($post->ID);
			}

			if ( 'top' == $pvc_settings['position'] ) {
				$content = $pvc_stats_html . $content;
			} else {
				$content .= $pvc_stats_html;
			}
		}
		return $content;
	}

	public static function excerpt_pvc_stats_show($excerpt){
		remove_action('loop_end', array('A3_PVC', 'pvc_stats_echo'));
		remove_action('genesis_before_post_content', array('A3_PVC', 'genesis_pvc_stats_echo'));
		remove_action('genesis_after_post_content', array('A3_PVC', 'genesis_pvc_stats_echo'));
		global $post;
		if ( ! $post ) return;
		global $pvc_settings;
		if ( empty( $pvc_settings ) ) {
			$pvc_settings = get_option('pvc_settings', array() );
		}
		if ( self::pvc_is_activated( $post->ID ) && 'no' != $pvc_settings['show_on_excerpt_content'] ) {
			$pvc_stats_html = A3_PVC::pvc_stats_counter($post->ID);
			if ( 'top' == $pvc_settings['position'] ) {
				$excerpt = $pvc_stats_html . $excerpt;
			} else {
				$excerpt .= $pvc_stats_html;
			}
		}
		return $excerpt;
	}

	public static function pvc_stats_echo(){
		global $post;
		global $pvc_settings;
		if ( empty( $pvc_settings ) ) {
			$pvc_settings = get_option('pvc_settings', array() );
		}
		if ( self::pvc_is_activated( $post->ID ) && 'no' != $pvc_settings['show_on_excerpt_content'] ) {
			echo A3_PVC::pvc_stats_counter($post->ID);
		}
	}

	public static function genesis_pvc_stats_echo(){
		remove_action('loop_end', array('A3_PVC', 'pvc_stats_echo'));
		global $post;
		global $pvc_settings;
		if ( empty( $pvc_settings ) ) {
			$pvc_settings = get_option('pvc_settings', array() );
		}
		if ( self::pvc_is_activated( $post->ID ) && 'no' != $pvc_settings['show_on_excerpt_content'] ) {
			echo A3_PVC::pvc_stats_counter($post->ID);
		}
	}

	public static function custom_stats_echo($postid=0, $have_echo = 1, $attributes = array() ){
		if($have_echo == 1)
			echo A3_PVC::pvc_stats_counter($postid, false, $attributes );
		else
			return A3_PVC::pvc_stats_counter($postid, false, $attributes );
	}

	public static function custom_stats_update_echo($postid=0, $have_echo=1, $attributes = array() ){
		$output = '';
		global $pvc_settings;
		if ( empty( $pvc_settings ) ) {
			$pvc_settings = get_option('pvc_settings', array() );
		}
		if ( ! isset( $pvc_settings['enable_ajax_load'] ) || $pvc_settings['enable_ajax_load'] != 'yes' ) {
			A3_PVC::pvc_stats_update($postid);
		}

		$output .= A3_PVC::pvc_stats_counter($postid, true, $attributes );

		if ( $have_echo == 1 )
			echo $output;
		else
			return $output;
	}

	public static function pvc_is_activated( $post_id = 0 ) {
		if ( 0 == $post_id || '' == trim( $post_id ) ) {
			global $post;
			if ( $post ) {
				$post_id = $post->ID;
			} else {
				return false;
			}
		}

		global $pvc_settings;
		if ( empty( $pvc_settings ) ) {
			$pvc_settings = get_option( 'pvc_settings', array() );
		}

		// Don't show counter on homepage, frontpage, archive page if admin deactivate for excerpt
		if( 'no' == $pvc_settings['show_on_excerpt_content'] && ( is_home() || is_front_page() || is_archive() || is_tax() ) ) {
			return false;
		}

		$is_acticvated = self::pvc_admin_is_activated( $post_id );

		return $is_acticvated;
	}

	public static function pvc_admin_is_activated( $post_id = 0 ) {
		if ( $post_id < 0 ) {
			return false;
		}

		$post_type = get_post_type( $post_id );
		if ( false == $post_type ) {
			return false;
		}

		$is_activated = get_post_meta( $post_id, '_a3_pvc_activated', true );
		if ( empty( $is_activated ) ) {
			global $pvc_settings;
			if ( empty( $pvc_settings ) ) {
				$pvc_settings = get_option( 'pvc_settings', array() );
			}
			if ( isset( $pvc_settings['post_types'] ) && in_array( $post_type, (array) $pvc_settings['post_types'] ) ) {
				return true;
			} else {
				return false;
			}
		} else {
			if ( 'true' == $is_activated ) {
				return true;
			} else {
				return false;
			}
		}

		return false;
	}

	public static function pvc_reset_individual_items() {
		global $wpdb;
		$wpdb->query( "DELETE FROM ".$wpdb->postmeta." WHERE meta_key='_a3_pvc_activated' " );
	}

	public static function a3_wp_admin() {
		wp_enqueue_style( 'a3rev-wp-admin-style', A3_PVC_CSS_URL . '/a3_wp_admin.css' );
	}

	public static function plugin_extension_box( $boxes = array() ) {
		$support_box = '<a href="https://wordpress.org/support/plugin/page-views-count" target="_blank" alt="'.__('Go to Support Forum', 'page-views-count').'"><img src="'.A3_PVC_IMAGES_URL.'/go-to-support-forum.png" /></a>';
		$boxes[] = array(
			'content' => $support_box,
			'css' => 'border: none; padding: 0; background: none;'
		);

		$first_box = '<a href="https://profiles.wordpress.org/a3rev/#content-plugins" target="_blank" alt="'.__('Free WordPress Plugins', 'page-views-count').'"><img src="'.A3_PVC_IMAGES_URL.'/free-wordpress-plugins.png" /></a>';

		$boxes[] = array(
			'content' => $first_box,
			'css' => 'border: none; padding: 0; background: none;'
		);

		$second_box = '<a href="https://profiles.wordpress.org/a3rev/#content-plugins" target="_blank" alt="'.__('Free WooCommerce Plugins', 'page-views-count').'"><img src="'.A3_PVC_IMAGES_URL.'/free-woocommerce-plugins.png" /></a>';

		$boxes[] = array(
			'content' => $second_box,
			'css' => 'border: none; padding: 0; background: none;'
		);

        $third_box = '<div style="margin-bottom: 5px; font-size: 12px;"><strong>' . __('Is this plugin is just what you needed? If so', 'page-views-count') . '</strong></div>';
        $third_box .= '<a href="https://wordpress.org/support/view/plugin-reviews/page-views-count#postform" target="_blank" alt="'.__('Submit Review for Plugin on WordPress', 'page-views-count').'"><img src="'.A3_PVC_IMAGES_URL.'/a-5-star-rating-would-be-appreciated.png" /></a>';

        $boxes[] = array(
            'content' => $third_box,
            'css' => 'border: none; padding: 0; background: none;'
        );

        $four_box = '<div style="margin-bottom: 5px;">' . __('Connect with us via','page-views-count') . '</div>';
		$four_box .= '<a href="https://www.facebook.com/a3rev" target="_blank" alt="'.__('a3rev Facebook', 'page-views-count').'" style="margin-right: 5px;"><img src="'.A3_PVC_IMAGES_URL.'/follow-facebook.png" /></a> ';
		$four_box .= '<a href="https://twitter.com/a3rev" target="_blank" alt="'.__('a3rev Twitter', 'page-views-count').'"><img src="'.A3_PVC_IMAGES_URL.'/follow-twitter.png" /></a>';

		$boxes[] = array(
			'content' => $four_box,
			'css' => 'border-color: #3a5795;'
		);

		return $boxes;
	}

	public static function settings_plugin_links($actions) {
		$actions = array_merge( array( 'settings' => '<a href="options-general.php?page=a3-pvc">' . __( 'Settings', 'page-views-count' ) . '</a>' ), $actions );

		return $actions;
	}

	public static function plugin_extra_links($links, $plugin_name) {
		if ( $plugin_name != A3_PVC_PLUGIN_NAME) {
			return $links;
		}
		$links[] = '<a href="http://docs.a3rev.com/user-guides/page-view-count/" target="_blank">'.__('Documentation', 'page-views-count').'</a>';
		$links[] = '<a href="http://wordpress.org/support/plugin/page-views-count/" target="_blank">'.__('Support', 'page-views-count').'</a>';
		return $links;
	}
}

if ( 'responsi' === get_template() ) {
   remove_filter('the_content', array(
       'A3_PVC',
       'pvc_stats_show'
   ), 8);
   remove_filter('the_excerpt', array(
       'A3_PVC',
       'excerpt_pvc_stats_show'
   ), 8);
   remove_action('wp_head', 'add_view_count_for_theme');
   add_action('wp_head', 'add_view_count_for_theme');

   if (!function_exists('add_view_count_for_theme')) {
       function add_view_count_for_theme()
       {
           remove_filter('the_content', array('A3_PVC','pvc_stats_show'), 8);
           remove_filter('the_excerpt', array('A3_PVC','excerpt_pvc_stats_show'), 8);
           if ( !is_admin() && !is_home() ) {
           		global $pvc_settings;
           		if ( 'top' == $pvc_settings['position'] ) {
					add_action('responsi_loop_before', 'add_view_count', 30);
				} else {
					add_action('responsi_loop_after', 'add_view_count', 30);
				}
           }
       }
   }
   if (!function_exists('add_view_count')) {
       function add_view_count()
       {
           $postid = get_the_ID();
           $html   = '';
           $class  = '';
           if (!is_single() && !is_page() && !is_404()) {
               $class = ' custom_box';
           }
           if (function_exists('pvc_check_exclude') && pvc_check_exclude())
               return '';

           if (function_exists('pvc_stats_update'))
               $html .= '<div class="add_view_count' . $class . '">' . pvc_stats_update($postid, 0) . '</div>';
           echo $html;
       }
   }
}
?>