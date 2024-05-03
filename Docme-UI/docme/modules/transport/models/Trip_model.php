<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Trip_model
 *
 * @author Chandrajith
 */
class Trip_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_all_trip_data($inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $route = transport_data_with_param_with_urlencode(array('action' => 'get_trip', 'inst_id' => $inst_id, 'mode' => 'strict'), $apikey);

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

    public function get_trip_data($trip_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $tripdata = transport_data_with_param_with_urlencode(array('action' => 'get_trip_details_byId', 'tripId' => $trip_id, 'inst_id' => $inst_id, 'mode' => 'strict'), $apikey);
        if (isset($tripdata) && !empty($tripdata) && is_array($tripdata)) {
            return $tripdata['data'];
        } else {
            if (isset($tripdata['message']) && !empty($tripdata['message']) && is_array($tripdata)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $tripdata['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $tripdata,
                    'data' => FALSE
                );
            }
        }
    }

    //public function save_trip($trip_name, $trip_desc, $start_time, $end_time)
    public function save_trip($data)
    {
        //        dev_export($trip_name);
        //        dev_export($trip_desc);
        //        dev_export($start_time);
        //        dev_export($end_time);die;
        //        dev_export($destName);
        //        dev_export($destLat);


        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $data['action'] = 'save_trip';
        $data['inst_id'] = $inst_id;
        $trip = transport_data_with_param_with_urlencode($data, $apikey);
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

    public function update_status_trip($tripid, $status)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'modify_trip';
        $data['tripId'] = $tripid;
        $data['status'] = $status;
        $inst_id = $this->session->userdata('inst_id');
        $data['inst_id'] = $inst_id;
        $trip_data = transport_data_with_param_with_urlencode($data, $apikey);
        if (isset($trip_data) && !empty($trip_data) && is_array($trip_data)) {
            return $trip_data['data'];
        } else {
            if (isset($trip_data['message']) && !empty($trip_data['message']) && is_array($trip_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trip_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trip_data,
                    'data' => FALSE
                );
            }
        }
    }

    public function save_trip_edit($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'save_trip_edit';
        $inst_id = $this->session->userdata('inst_id');
        $data['inst_id'] = $inst_id;
        $trip_data = transport_data_with_param_with_urlencode($data, $apikey);

        if (isset($trip_data) && !empty($trip_data) && is_array($trip_data)) {
            return $trip_data['data'];
        } else {
            if (isset($trip_data['message']) && !empty($trip_data['message']) && is_array($trip_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trip_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trip_data,
                    'data' => FALSE
                );
            }
        }
    }

    //For Mapping

    public function get_active_pickuppoints($inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $pickuppoints = transport_data_with_param_with_urlencode(array('action' => 'get_pickuppoint', 'inst_id' => $inst_id, 'mode' => 'strict', 'status' => 1), $apikey);

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

    public function save_trip_pickpoint_relation($data)
    {

        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $data['action'] = 'save_trip_pickpoint_relation';
        $data['inst_id'] = $inst_id;
        $trip_pickup_relation = transport_data_with_param_with_urlencode($data, $apikey);
        return $trip_pickup_relation;
        if (isset($trip_pickup_relation) && !empty($trip_pickup_relation) && is_array($trip_pickup_relation)) {
            return $trip_pickup_relation['data'];
        } else {
            if (isset($trip_pickup_relation['message']) && !empty($trip_pickup_relation['message']) && is_array($trip_pickup_relation)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trip_pickup_relation['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $trip_pickup_relation,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_trippickuppoint_relation_data($pickuppointId = 0, $tripId = 0)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $pickuppoint = transport_data_with_param_with_urlencode(array('action' => 'get_trip_pickuppoint_relation_data', 'inst_id' => $inst_id, 'pickuppointId' => $pickuppointId, 'tripId' => $tripId, 'mode' => 'strict'), $apikey);
        if (isset($pickuppoint) && !empty($pickuppoint) && is_array($pickuppoint)) {
            return $pickuppoint['data'];
        } else {
            if (isset($pickuppoint['message']) && !empty($pickuppoint['message']) && is_array($pickuppoint)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $pickuppoint['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $pickuppoint,
                    'data' => FALSE
                );
            }
        }
    }
}
