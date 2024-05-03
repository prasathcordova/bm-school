<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Trip_vehicle_map_model
 *
 * @author Chandrajith
 */
class Trip_vehicle_map_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_all_trip_data($inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $route = transport_data_with_param_with_urlencode(array('action' => 'get_trip', 'inst_id' => $inst_id, 'mode' => 'strict', 'status' => 1), $apikey);

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
    public function get_trip_data($inst_id, $id)
    {
        $apikey = $this->session->userdata('API-Key');
        $route = transport_data_with_param_with_urlencode(array('action' => 'get_trip', 'inst_id' => $inst_id, 'id' => $id, 'mode' => 'strict'), $apikey);
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

    public function get_trip_all_details($inst_id, $id)
    {
        $apikey = $this->session->userdata('API-Key');
        $trip = transport_data_with_param_with_urlencode(array('action' => 'get_trip_details_byId', 'inst_id' => $inst_id, 'tripId' => $id), $apikey);
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

    public function get_vehicledetails_data($trip_id, $inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $vehicledetails = transport_data_with_param_with_urlencode(array('action' => 'get_vehicledetails_trip', 'trip_id' => $trip_id, 'inst_id' => $inst_id), $apikey);
        if (isset($vehicledetails) && !empty($vehicledetails) && is_array($vehicledetails)) {
            return $vehicledetails['data'];
        } else {
            if (isset($vehicledetails['message']) && !empty($vehicledetails['message']) && is_array($vehicledetails)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicledetails['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicledetails,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_all_vehicle_data($inst_id, $trip_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $vehicle = transport_data_with_param_with_urlencode(array('action' => 'get_unalloted_vehicle', 'inst_id' => $inst_id, 'trip_id' => $trip_id), $apikey);
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
    public function get_trip_vehiclelinkdata($inst_id, $trip_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $trip_vehiclelink = transport_data_with_param_with_urlencode(array('action' => 'get_triplinkvehi', 'inst_id' => $inst_id, 'tripid' => $trip_id), $apikey);
        //        dev_export($vehicle);die;
        if (isset($trip_vehiclelink) && !empty($trip_vehiclelink) && is_array($trip_vehiclelink)) {
            return $trip_vehiclelink['data'];
        } else {
            if (isset($trip_vehiclelink['message']) && !empty($trip_vehiclelink['message']) && is_array($trip_vehiclelink)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trip_vehiclelink['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trip_vehiclelink,
                    'data' => FALSE
                );
            }
        }
    }
    public function save_vehicle_trip_mapping($trip_id, $trip_name, $trip_start_time, $trip_end_time, $vehilceid, $vehiclenum)
    {

        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');

        $trip_vehiclemap = transport_data_with_param_with_urlencode(array('action' => 'save_tripvehiclemap', 'tripid' => $trip_id, 'tripname' => $trip_name, 'tripstarttime' => $trip_start_time, 'tripendtime' => $trip_end_time, 'vehilceid' => $vehilceid, 'vehiclenum' => $vehiclenum, 'inst_id' => $inst_id), $apikey);
        //        dev_export($trip);die;
        if (isset($trip_vehiclemap) && !empty($trip_vehiclemap) && is_array($trip_vehiclemap)) {
            return $trip_vehiclemap['data'];
        } else {
            if (isset($trip_vehiclemap['message']) && !empty($trip_vehiclemap['message']) && is_array($trip_vehiclemap)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trip_vehiclemap['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trip_vehiclemap,
                    'data' => FALSE
                );
            }
        }
    }
}
