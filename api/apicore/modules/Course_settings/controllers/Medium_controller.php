<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of medium_controller
 *
 * @author docme2
 */
class Medium_controller extends MX_Controller{
     public function __construct() {
        parent::__construct();
        $this->load->model('Medium_model', 'MMedium');
    }
    
    public function get_medium($params = NULL) {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "m.isactive = " . $params['status'];
        }
        if (isset($params['Medium_ID'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "m.Medium_ID LIKE '%" . $params['Medium_ID'] . "%' ";
            } else {
                $query_string = "m.Medium_ID LIKE '%" . $params['Medium_ID'] . "%' ";
            }
        }
        if (isset($params['Medium_Code'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "m.Medium_Code LIKE '%" . $params['Medium_Code'] . "%' ";
            } else {
                $query_string = "m.Medium_Code LIKE '%" . $params['Medium_Code'] . "%' ";
            }
        }
        if (isset($params['Description'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "m.Description LIKE '%" . $params['Description'] . "%' ";
            } else {
                $query_string = "m.Description LIKE '%" . $params['Description'] . "%' ";
            }
        }
        $medium_list = $this->MMedium->get_medium_details($apikey, $query_string);
        if (!empty($medium_list) && is_array($medium_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $medium_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
}
