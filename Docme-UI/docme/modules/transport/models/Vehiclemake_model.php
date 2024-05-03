<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vehiclemake_model
 *
 * @author chandrajith.edsys
 */
class Vehiclemake_model extends CI_model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_all_vehicle_make_data()
    {
        $apikey = $this->session->userdata('API-Key');
        $vehicle_make = transport_data_with_param_with_urlencode(array('action' => 'get_make', 'mode' => 'search'), $apikey);
        if (isset($vehicle_make) && !empty($vehicle_make) && is_array($vehicle_make)) {
            return $vehicle_make['data'];
        } else {
            if (isset($vehicle_make['message']) && !empty($vehicle_make['message']) && is_array($vehicle_make)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_make['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_make,
                    'data' => FALSE
                );
            }
        }
    }
    public function save_vehicle_make_new($vehicle_make)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');

        $vehicle_make = transport_data_with_param_with_urlencode(array('action' => 'save_make', 'make' => $vehicle_make, 'inst_id' => $inst_id), $apikey);
        //        dev_export($vehicle_type);die;
        if (isset($vehicle_make) && !empty($vehicle_make) && is_array($vehicle_make)) {
            return $vehicle_make['data'];
        } else {
            if (isset($vehicle_make['message']) && !empty($vehicle_make['message']) && is_array($vehicle_make)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_make['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_make,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_vehicle_make_data($vehicle_make_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $vehicle_make = transport_data_with_param_with_urlencode(array('action' => 'get_make', 'id' => $vehicle_make_id, 'mode' => 'strict'), $apikey);
        //        dev_export($vehicle_make);die;
        if (isset($vehicle_make) && !empty($vehicle_make) && is_array($vehicle_make)) {
            return $vehicle_make['data'];
        } else {
            if (isset($vehicle_make['message']) && !empty($vehicle_make['message']) && is_array($vehicle_make)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_make['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_make,
                    'data' => FALSE
                );
            }
        }
    }
    public function save_vehicle_make_edit($vehicle_make_id, $vehicle_make)
    {

        $apikey = $this->session->userdata('API-Key');
        //        $inst_id = $this->session->userdata('inst_id');
        $vehicle_make = transport_data_with_param_with_urlencode(array('action' => 'update_make', 'id' => $vehicle_make_id, 'make' => $vehicle_make), $apikey);
        if (isset($vehicle_make) && !empty($vehicle_make) && is_array($vehicle_make)) {
            return $vehicle_make['data'];
        } else {
            if (isset($vehicle_make['message']) && !empty($vehicle_make['message']) && is_array($vehicle_make)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_make['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_make,
                    'data' => FALSE
                );
            }
        }
    }
    public function update_status_vehicle_make($vehicle_make, $status)
    {
        $apikey = $this->session->userdata('API-Key');
        $vehicle_make = transport_data_with_param_with_urlencode(array('action' => 'modify_make', 'id' => $vehicle_make, 'status' => $status), $apikey);
        if (isset($vehicle_make) && !empty($vehicle_make) && is_array($vehicle_make)) {
            return $vehicle_make['data'];
        } else {
            if (isset($vehicle_make['message']) && !empty($vehicle_make['message']) && is_array($vehicle_make)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_make['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_make,
                    'data' => FALSE
                );
            }
        }
    }
}
