<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ohtemplate_model
 *
 * @author Rahul
 */
class Ohtemplate_model extends CI_Model {
   public function __construct() {
        parent::__construct();     
}
 public function get_all_oh_list() {
        $apikey = $this->session->userdata('API-Key');
        $city_data = transport_data_with_param_with_urlencode(array('action' => 'get_city'), $apikey);       
        if(is_array($city_data)) {
            return $city_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $city_data,
                'data' => FALSE
                );
        }
    }
     public function get_all_suppliers_list() {
        $apikey = $this->session->userdata('API-Key');
        $suppliers_data = transport_data_with_param_with_urlencode(array('action' => 'get_suppliers'), $apikey);
        if (is_array($suppliers_data)) {
//            dev_export($suppliers_data);die;
            return $suppliers_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $suppliers_data,
                'data' => FALSE
            );
        }
    }
     
}
