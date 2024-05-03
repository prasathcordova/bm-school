<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vehiceltrip_model
 *
 * @author chandrajith.edsys
 */
class Vehiceltrip_model extends CI_model{
    public function __construct() {
        parent::__construct();
    }
     public function get_all_vehicle_trip_data($inst_id) {
        $apikey = $this->session->userdata('API-Key');
        $vehicle_trip = transport_data_with_param_with_urlencode(array('action' => 'get_trip', 'inst_id' => $inst_id, 'mode' => 'strict'), $apikey);
       
        if (isset($vehicle_trip) && !empty($vehicle_trip) && is_array($vehicle_trip)) {
            return $vehicle_trip['data'];
        } else {
            if (isset($vehicle_trip['message']) && !empty($vehicle_trip['message']) && is_array($vehicle_trip)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_trip['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_trip,
                    'data' => FALSE
                );
            }
        }
    }
    public function save_trip_new($trip, $desc) {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        
        $trip = transport_data_with_param_with_urlencode(array('action' => 'save_trip', 'tripname' => $trip,'tripdesc'=> $desc,'inst_id' => $inst_id), $apikey);
//        dev_export($trip);die;
        if (isset($trip) && !empty($trip) && is_array($trip)) {
            return $trip['data'];
        } else {
            if (isset($trip['message']) && !empty($trip['message']) && is_array($trip)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trip['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trip,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_trip_data($trip_id) {
        $apikey = $this->session->userdata('API-Key');
        $trip = transport_data_with_param_with_urlencode(array('action' => 'get_trip', 'id' => $trip_id, 'mode' => 'strict'), $apikey);
        if (isset($trip) && !empty($trip) && is_array($trip)) {
            return $trip['data'];
        } else {
            if (isset($trip['message']) && !empty($trip['message']) && is_array($trip)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trip['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trip,
                    'data' => FALSE
                );
            }
            
        }
    }
    public function save_trip_edit($id,$trip,$desc) {
        
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $trip = transport_data_with_param_with_urlencode(array('action' => 'update_trip', 'id' => $id, 'tripname' => $trip,'tripdesc'=> $desc,'inst_id' => $inst_id), $apikey);
        if (isset($trip) && !empty($trip) && is_array($trip)) {
            return $trip['data'];
        } else {
            if (isset($trip['message']) && !empty($trip['message']) && is_array($trip)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trip['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trip,
                    'data' => FALSE
                );
            }
        }
    }
    public function update_status_trip($trip_id, $status) {
                
        $apikey = $this->session->userdata('API-Key');
        $trip = transport_data_with_param_with_urlencode(array('action' => 'modify_trip', 'id' => $trip_id, 'status' => $status), $apikey);
        if (isset($trip) && !empty($trip) && is_array($trip)) {
            return $trip['data'];
        } else {
            if (isset($trip['message']) && !empty($trip['message']) && is_array($trip)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trip['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trip,
                    'data' => FALSE
                );
            }
        }
    }
}
