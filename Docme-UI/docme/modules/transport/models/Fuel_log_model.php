<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fuel_log_model
 *
 * @author chandrajith.edsys
 */
class Fuel_log_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    public function get_all_vehicle_details($inst_id) {
        $apikey = $this->session->userdata('API-Key');
        $vehicle_data = transport_data_with_param_with_urlencode(array('action' => 'get_vehiclereg','inst_id' => $inst_id, 'mode' => 'strict'), $apikey);
       
        if (isset($vehicle_data) && !empty($vehicle_data) && is_array($vehicle_data)) {
            return $vehicle_data['data'];
        } else {
            if (isset($vehicle_data['message']) && !empty($vehicle_data['message']) && is_array($vehicle_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_data,
                    'data' => FALSE
                );
            }
        }
    }
     public function get_fuel_details($vehicle_id,$inst_id) {
        $apikey = $this->session->userdata('API-Key');
        $vehicle_data = transport_data_with_param_with_urlencode(array('action' => 'get_fuel_log','vehicleId' => $vehicle_id,'inst_id' => $inst_id, 'mode' => 'strict'), $apikey);
       
        if (isset($vehicle_data) && !empty($vehicle_data) && is_array($vehicle_data)) {
            return $vehicle_data['data'];
        } else {
            if (isset($vehicle_data['message']) && !empty($vehicle_data['message']) && is_array($vehicle_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_data,
                    'data' => FALSE
                );
            }
        }
    }
     public function get_fueltype_details($vehicle_id,$inst_id) {
        $apikey = $this->session->userdata('API-Key');
        $vehicle_data = transport_data_with_param_with_urlencode(array('action' => 'get_fueltype_log','vehicleId' => $vehicle_id,'inst_id' => $inst_id), $apikey);
       
        if (isset($vehicle_data) && !empty($vehicle_data) && is_array($vehicle_data)) {
            return $vehicle_data['data'];
        } else {
            if (isset($vehicle_data['message']) && !empty($vehicle_data['message']) && is_array($vehicle_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_data,
                    'data' => FALSE
                );
            }
        }
    }
      public function save_vehicle_fuel_log($fuellog_data) {
        $apikey = $this->session->userdata('API-Key');
         $inst_id = $this->session->userdata('inst_id');     
//          dev_export($incidents_data);die;
        $status_data = transport_data_with_param_with_urlencode(array('action' => 'save_fuel_log', 'fuellog_data' => $fuellog_data,'inst_id'=>$inst_id), $apikey);        
//        dev_export($status_data);die;
        if (is_array($status_data) && isset($status_data['data']) && !empty($status_data['data'])) {
            return $status_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => 'Error in saving data',
                'data' => FALSE
            );
        }
}
   public function get_all_fuel_types() {
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
