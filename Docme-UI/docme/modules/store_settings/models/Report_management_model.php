<?php

/**
 * Description of Report_management_model
 *
 * @author Aju
 */
class Report_management_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function report_lock_date() {
        $apikey = $this->session->userdata('API-Key');
        $report_lock_date = transport_data_with_param_with_urlencode(array('action' => 'report_lock_date'), $apikey);
        if (is_array($report_lock_date) && isset($report_lock_date['status']) && !empty($report_lock_date['status']) && $report_lock_date['status'] == 1 && isset($report_lock_date['data'])) {
            return $report_lock_date['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_lock_date,
                'data' => FALSE
            );
        }
    }

    public function get_stock_report_all($startdate, $enddate, $store_id) {
        $apikey = $this->session->userdata('API-Key');
        $data_prep = array(
            'action' => 'get_all_stock_report_data',
            'store_id' => $store_id,
            'from_date' => $startdate,
            'to_date' => $enddate
        );
        $report_lock_date = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($report_lock_date) && isset($report_lock_date['status']) && !empty($report_lock_date['status']) && $report_lock_date['status'] == 1 && isset($report_lock_date['data'])) {
            return $report_lock_date['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_lock_date,
                'data' => FALSE
            );
        }
    }
    public function get_stock_report_summary($startdate, $enddate, $store_id) {
        $apikey = $this->session->userdata('API-Key');
        $data_prep = array(
            'action' => 'get_all_stock_report_data',
            'store_id' => $store_id,
            'from_date' => $startdate,
            'to_date' => $enddate,
            'type' => 2
        );
        $report_data = transport_data_with_param_with_urlencode($data_prep, $apikey);        
        if (is_array($report_data) && isset($report_data['status']) && !empty($report_data['status']) && $report_data['status'] == 1 && isset($report_data['data'])) {
            return $report_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $report_data,
                'data' => FALSE
            );
        }
    }

}
