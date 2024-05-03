<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pickuppoint_model
 *
 * @author chandrajith.edsys
 */
class Pickuppoint_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_all_pickuppoints($inst_id)
    {
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
    public function save_pickuppoint_new($data)
    //public function save_pickuppoint_new($pickuppoint, $desc)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $data['action'] = 'save_pickuppoint';
        $data['inst_id'] = $inst_id;
        $pickuppoint = transport_data_with_param_with_urlencode($data, $apikey);
        //        dev_export($pickuppoint);die;
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
    public function get_pickuppoint_data($pickuppoint_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $pickuppoint = transport_data_with_param_with_urlencode(array('action' => 'get_pickuppoint', 'id' => $pickuppoint_id, 'mode' => 'strict'), $apikey);
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


    public function save_pickuppoint_edit($data)
    {

        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $data['action'] = 'update_pickuppoint';
        $data['inst_id'] = $inst_id;
        $pickuppoint = transport_data_with_param_with_urlencode($data, $apikey);
        //return $pickuppoint;
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
    public function update_status_pickuppoint($pickid, $status)
    {
        $apikey = $this->session->userdata('API-Key');
        $pickuppoint = transport_data_with_param_with_urlencode(array('action' => 'modify_pickuppoint', 'id' => $pickid, 'status' => $status), $apikey);

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


    ////For mapping Purposes  


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
}
