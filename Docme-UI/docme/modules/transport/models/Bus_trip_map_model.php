<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bus_trip_map_model
 *
 * @author chandrajith.edsys
 */
class Bus_trip_map_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
     public function get_all_vehicle_data($inst_id) {
        $apikey = $this->session->userdata('API-Key');
        $vehicle = transport_data_with_param_with_urlencode(array('action' => 'get_vehiclereg', 'inst_id' => $inst_id, 'mode' => 'strict'), $apikey);
       
        if (isset($vehicle) && !empty($vehicle) && is_array($vehicle)) {
            return $vehicle['data'];
        } else {
            if (isset($vehicle['message']) && !empty($vehicle['message']) && is_array($vehicle)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_all_trip_data($inst_id) {
        $apikey = $this->session->userdata('API-Key');
        $trip = transport_data_with_param_with_urlencode(array('action' => 'get_trip', 'inst_id' => $inst_id,'mode' => 'strict'), $apikey);
//        dev_export($route);die;
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
    public function save_bus_trip_map($bus_id,$formatted_trip_id) {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');         
        $map_data_status = transport_data_with_param_with_urlencode(array('action' => 'save_bus_trip_map','bus_id' => $bus_id,'inst_id' => $inst_id,'template_data' => $formatted_trip_id), $apikey);
//        dev_export($map_data_status);die;
        if (isset($map_data_status) && !empty($map_data_status) && is_array($map_data_status)) {
            return $map_data_status['data'];
        } else {
            if (isset($map_data_status['message']) && !empty($map_data_status['message']) && is_array($map_data_status)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $map_data_status['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $map_data_status,
                    'data' => FALSE
                );
            }
        }
}
}
