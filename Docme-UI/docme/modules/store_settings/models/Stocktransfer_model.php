<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Stocktransfer_model
 *
 * @author chandrajith.edsys
 */
class Stocktransfer_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
        public function get_all_publisher_list() {
        $apikey = $this->session->userdata('API-Key');
        $publisher_data = transport_data_with_param_with_urlencode(array('action' => 'get_publisher'), $apikey);
        if (is_array($publisher_data)) {
//            dev_export($publisher_data);die;
            return $publisher_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $publisher_data,
                'data' => FALSE
            );
        }
    }     
}
