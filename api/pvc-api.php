<?php
if (!defined('ABSPATH')) exit;
 // Exit if accessed directly

class PVC_API
{
    public function __construct()
    {
        add_action('parse_request', array($this, 'handle_api_requests'), 0);
    }

    /**
     * API request - Trigger any API requests
     *
     */
    public function handle_api_requests()
    {
        global $wp;

        if (isset($_GET['pvc-api'])) {
            define('PVC_API_REQUEST', true);

            // Buffer, we won't want any output here
            ob_start();

            // Get API trigger
            $api   = strtolower(esc_attr($_GET['pvc-api']));
            $ouput = 1;

            if ($api == 'pvc_backbone_load_stats') {
                $ouput = $this->pvc_backbone_load_stats();
            }

            // Done, clear buffer and exit
            ob_end_clean();
            die($ouput);
        }
    }

    public function pvc_backbone_load_stats()
    {
        $post_ids = $_REQUEST['post_ids'];

        $data     = array();
        $ids      = array();
        if (is_array($post_ids) && count($post_ids) > 0) {
            foreach ($post_ids as $post_id  => $post_data) {
                $ids[]          = $post_id;
                if (isset($post_data['ask_update']) && $post_data['ask_update'] == 'true') {
                    $this->pvc_stats_update($post_id);
                }
            }
            $results = $this->pvc_fetch_posts_stats($ids);
            if ($results) {
                foreach ($results as $result) {
                    $data[$result->post_id]         = array('post_id'         => (int)$result->post_id, 'total_view'         => (int)$result->total, 'today_view'         => (int)$result->today);
                    $ids     = array_diff($ids, array($result->post_id));
                }
            }

            foreach ($ids as $post_id) {
                $total   = $this->pvc_fetch_post_total($post_id);
                $data[$post_id]         = array('post_id' => (int)$post_id, 'total_view' => (int)$total, 'today_view' => 0);
            }
        }
        header('Content-Type: application/json', true, 200);
        return json_encode($data);
    }

    public function pvc_fetch_posts_stats($post_ids)
    {
        global $wpdb;
        $nowisnow = date('Y-m-d');

        if (!is_array($post_ids)) $post_ids = array($post_ids);

        $sql      = $wpdb->prepare("SELECT t.postnum AS post_id, t.postcount AS total, d.postcount AS today FROM " . $wpdb->prefix . "pvc_total AS t
			LEFT JOIN " . $wpdb->prefix . "pvc_daily AS d ON t.postnum = d.postnum
			WHERE t.postnum IN ( " . implode(',', $post_ids) . " ) AND d.time = %s", $nowisnow);
        return $wpdb->get_results($sql);
    }

    public function pvc_fetch_post_total($post_id)
    {
        global $wpdb;

        $sql = $wpdb->prepare("SELECT t.postcount AS total FROM " . $wpdb->prefix . "pvc_total AS t
			WHERE t.postnum = %s", $post_id);
        return $wpdb->get_var($sql);
    }

    public function pvc_stats_update($post_id)
    {
        global $wpdb;

        // get the local time based off WordPress setting
        $nowisnow = date('Y-m-d');

        // first try and update the existing total post counter
        $results  = $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "pvc_total SET postcount = postcount+1 WHERE postnum = '%s' LIMIT 1", $post_id));

        // if it doesn't exist, then insert two new records
        // one in the total views, another in today's views
        if ($results == 0) {
            $wpdb->query($wpdb->prepare("INSERT INTO " . $wpdb->prefix . "pvc_total (postnum, postcount) VALUES ('%s', 1)", $post_id));
            $wpdb->query($wpdb->prepare("INSERT INTO " . $wpdb->prefix . "pvc_daily (time, postnum, postcount) VALUES ('%s', '%s', 1)", $nowisnow, $post_id));

            // post exists so let's just update the counter

        } else {
            $results2 = $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "pvc_daily SET postcount = postcount+1 WHERE time = '%s' AND postnum = '%s' LIMIT 1", $nowisnow, $post_id));

            // insert a new record since one hasn't been created for current day
            if ($results2 == 0) $wpdb->query($wpdb->prepare("INSERT INTO " . $wpdb->prefix . "pvc_daily (time, postnum, postcount) VALUES ('%s', '%s', 1)", $nowisnow, $post_id));
        }

        // get all the post view info so we can update meta fields
        //$row = A3_PVC::pvc_fetch_post_counts( $post_id );

    }
}

new PVC_API();
?>