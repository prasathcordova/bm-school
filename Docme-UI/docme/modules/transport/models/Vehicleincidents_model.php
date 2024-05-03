<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vehicleincidents_model
 *
 * @author chandrajith.edsys
 */
class Vehicleincidents_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_all_vehicles()
    {
        $apikey = $this->session->userdata('API-Key');
        $pickuppoint_details = transport_data_with_param_with_urlencode(array('action' => 'get_vehiclereg', 'mode' => 'strict'), $apikey);
        if (isset($pickuppoint_details) && !empty($pickuppoint_details) && is_array($pickuppoint_details)) {
            return $pickuppoint_details['data'];
        } else {
            if (isset($pickuppoint_details['message']) && !empty($pickuppoint_details['message']) && is_array($pickuppoint_details)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $pickuppoint_details['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $pickuppoint_details,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_all_trip()
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $trip_details = transport_data_with_param_with_urlencode(array('action' => 'get_trip', 'mode' => 'strict', 'inst_id' => $inst_id), $apikey);
        // dev_export($trip_details);
        // return;
        if (isset($trip_details) && !empty($trip_details) && is_array($trip_details)) {
            return $trip_details['data'];
        } else {
            if (isset($trip_details['message']) && !empty($trip_details['message']) && is_array($trip_details)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trip_details['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trip_details,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_all_pickuppoint()
    {
        $apikey = $this->session->userdata('API-Key');
        $pickuppoint_details = transport_data_with_param_with_urlencode(array('action' => 'get_pickuppoint', 'mode' => 'strict'), $apikey);
        if (isset($pickuppoint_details) && !empty($pickuppoint_details) && is_array($pickuppoint_details)) {
            return $pickuppoint_details['data'];
        } else {
            if (isset($pickuppoint_details['message']) && !empty($pickuppoint_details['message']) && is_array($pickuppoint_details)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $pickuppoint_details['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $pickuppoint_details,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_trip_pickuppoints($trip_id, $inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $trip_pickuppoint = transport_data_with_param_with_urlencode(array('action' => 'get_trip_pickups', 'trip_id' => $trip_id, 'inst_id' => $inst_id, 'mode' => 'strict', 'status' => 1), $apikey);
        // return;
        if (isset($trip_pickuppoint) && !empty($trip_pickuppoint) && is_array($trip_pickuppoint)) {
               return $trip_pickuppoint['data'];
        } else {
            if (isset($trip_pickuppoint['message']) && !empty($trip_pickuppoint['message']) && is_array($trip_pickuppoint)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trip_pickuppoint['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trip_pickuppoint,
                    'data' => FALSE
                );
            }
        }
    }
    public function save_vehicle_incidents($incidents_data)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        //          dev_export($incidents_data);die;
        $status_data = transport_data_with_param_with_urlencode(array('action' => 'save_incidents', 'incidents_data' => $incidents_data, 'inst_id' => $inst_id), $apikey);
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
    public function get_all_incident_data($inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $vehicle_data = transport_data_with_param_with_urlencode(array('action' => 'get_incidents', 'inst_id' => $inst_id, 'mode' => 'search'), $apikey);
        // dev_export($vehicle_data);
        // die;
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
}
