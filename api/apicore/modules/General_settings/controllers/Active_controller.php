<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Active_controller
 *
 * @author docme2
 */
class Active_controller extends MX_Controller{
     public function __construct() {
        parent::__construct();
        $this->load->model('Active_model', 'MActive');
    }
    
    public function get_active($params = NULL) {
        $apikey = $params['API_KEY'];
//        $query_string = "";
//        if (isset($params['status'])) {
//            $query_string = "c.isactive = " . $params['status'];
//        }
//        if (isset($params['caste_id'])) {
//            if (strlen($query_string) > 0) {
//                $query_string = $query_string . " AND " . "c.caste_id LIKE '%" . $params['caste_id'] . "%' ";
//            } else {
//                $query_string = "c.caste_id LIKE '%" . $params['caste_id'] . "%' ";
//            }
//        }
//        if (isset($params['caste_name'])) {
//            if (strlen($query_string) > 0) {
//                $query_string = $query_string . " AND " . "c.caste_name LIKE '%" . $params['caste_name'] . "%' ";
//            } else {
//                $query_string = "c.caste_name LIKE '%" . $params['caste_name'] . "%' ";
//            }
//        }
//
//        if (isset($params['religion_id'])) {
//            if (strlen($query_string) > 0) {
//                $query_string = $query_string . " AND " . "r.religion_id LIKE '%" . $params['religion_id'] . "%' ";
//            } else {
//                $query_string = "r.religion_id LIKE '%" . $params['religion_id'] . "%'";
//            }
//        }
//        if (isset($params['community_id'])) {
//            if (strlen($query_string) > 0) {
//                $query_string = $query_string . " AND " . "c.community_id LIKE '%" . $params['community_id'] . "%' ";
//            } else {
//                $query_string = "c.community_id LIKE '%" . $params['community_id'] . "%'";
//            }
//        }

        $active_list = $this->MActive->get_active_details($apikey);
        if (!empty($active_list) && is_array($active_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $active_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    
}
