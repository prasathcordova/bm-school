<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Session_controller
 *
 * @author rahul.shibukumar
 */
class Session_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Session_model', 'MSession');
    }
      public function get_session($params = NULL) {
        $apikey = $params['API_KEY'];
        $query_string = "";

        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }

        if (strcasecmp($mode, "search") == 0) {
            if (isset($params['Session_ID'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "Session_ID LIKE '%" . $params['Session_ID'] . "%' ";
                } else {
                    $query_string = "Session_ID LIKE '%" . $params['Session_ID'] . "%' ";
                }
            }
            if (isset($params['Session_code'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . " Session_code LIKE '%" . $params['Session_code'] . "%' ";
                } else {
                    $query_string = " Session_code LIKE '%" . $params['Session_code'] . "%' ";
                }
            }
            
        } else if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['Session_ID'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "Session_ID LIKE '%" . $params['Session_ID'] . "%' ";
                } else {
                    $query_string = "Session_ID LIKE '%" . $params['Session_ID'] . "%' ";
                }
            }
            if (isset($params['Session_code'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . " Session_code LIKE '%" . $params['Session_code'] . "%' ";
                } else {
                    $query_string = " Session_code LIKE '%" . $params['Session_code'] . "%' ";
                }
            }
            
        }

//        dev_export($query_string);die;
        $session_list = $this->MSession->get_session_details($apikey, $query_string);
        if (!empty($session_list) && is_array($session_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $session_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

}
