<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vehicle_reg_model
 *
 * @author chandrajith.edsys
 */
class Vehicle_reg_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    public function get_all_fueltypes() {
        $apikey = $this->session->userdata('API-Key');
        $fueltype = transport_data_with_param_with_urlencode(array('action' => 'get_fueltype', 'mode' => 'search'), $apikey);
       
        if (isset($fueltype) && !empty($fueltype) && is_array($fueltype)) {
            return $fueltype['data'];
        } else {
            if (isset($fueltype['message']) && !empty($fueltype['message']) && is_array($fueltype)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $fueltype['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $fueltype,
                    'data' => FALSE
                );
            }
        }
    }
}
