<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Transport_fees_model
 *
 * @author chandrajith.edsys
 */
class Transport_fees_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_vehicle_route_data($inst_id) {
        $apikey = $this->session->userdata('API-Key');
        $route = transport_data_with_param_with_urlencode(array('action' => 'get_route', 'inst_id' => $inst_id, 'mode' => 'strict'), $apikey);

        if (isset($route) && !empty($route) && is_array($route)) {
            return $route['data'];
        } else {
            if (isset($route['message']) && !empty($route['message']) && is_array($route)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $route['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $route,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_all_pickuppoints($inst_id) {
        $apikey = $this->session->userdata('API-Key');

        $pickuppoints = transport_data_with_param_with_urlencode(array('action' => 'get_pickuppoint', 'inst_id' => $inst_id, 'mode' => 'strict'), $apikey);

        if (isset($pickuppoints) && !empty($pickuppoints) && is_array($pickuppoints)) {
            return $pickuppoints['data'];
        } else {
            if (isset($pickuppoints['message']) && !empty($pickuppoints['message']) && is_array($pickuppoints)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $pickuppoints['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $pickuppoints,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_pickup_dataz($inst_id, $routeid) {
        $apikey = $this->session->userdata('API-Key');
        $pickup = transport_data_with_param_with_urlencode(array('action' => 'get_pickup_details', 'route_id' => $routeid, 'inst_id' => $inst_id), $apikey);

        if (isset($pickup) && !empty($pickup) && is_array($pickup)) {
            return $pickup['data'];
        } else {
            if (isset($pickup['message']) && !empty($pickup['message']) && is_array($pickup)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $pickup['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $pickup,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_pickup_data($inst_id,$routeid,$fee_set) {
        $apikey = $this->session->userdata('API-Key');
         $acdyr = $this->session->userdata('acd_year');
        $pickuppoints = transport_data_with_param_with_urlencode(array('action' => 'get_pickpoint_feez', 'route_id' => $routeid,'fee_set'=>$fee_set,'inst_id' => $inst_id,'acdyr'=>$acdyr), $apikey);

        if (isset($pickuppoints) && !empty($pickuppoints) && is_array($pickuppoints)) {
            return $pickuppoints['data'];
        } else {
            if (isset($pickuppoints['message']) && !empty($pickuppoints['message']) && is_array($pickuppoints)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $pickuppoints['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $pickuppoints,
                    'data' => FALSE
                );
            }
        }
    }

    public function save_fees_pickuppoint($routeid, $pick_fee_data, $fees_entity) {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $acdyr = $this->session->userdata('acd_year');
        $fees_data_status = transport_data_with_param_with_urlencode(array(
            'action' => 'save_feesdata_pickpoint',
            'routeid' => $routeid,            
            'pick_fee_data' => $pick_fee_data,
            'fees_entity' => $fees_entity,
            'inst_id' => $inst_id,
            'acd_year' => $acdyr
                ), $apikey);
        
        if (isset($fees_data_status) && !empty($fees_data_status) && is_array($fees_data_status)) {
            return $fees_data_status['data'];
        } else {
            if (isset($fees_data_status['message']) && !empty($fees_data_status['message']) && is_array($fees_data_status)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $fees_data_status['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $fees_data_status,
                    'data' => FALSE
                );
            }
        }
    }

}
