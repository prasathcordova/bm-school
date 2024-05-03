<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Supplier_model
 *
 * @author chandrajith.edsys
 */
class Supplier_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    public function get_all_supplier_list() {
        $apikey = $this->session->userdata('API-Key');
        $country_data = transport_data_with_param_with_urlencode(array('action' => 'get_countries'), $apikey);
        if (is_array($country_data)) {
//            dev_export($country_data);die;
            return $country_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $country_data,
                'data' => FALSE
            );
        }
    }
}
