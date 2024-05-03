<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vehicletype_model
 *
 * @author chandrajith.edsys
 */
class Vehicletype_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_all_vehicle_type_data($inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $vehicle_type = transport_data_with_param_with_urlencode(array('action' => 'get_vehicletype', 'inst_id' => $inst_id, 'mode' => 'search'), $apikey);
        if (isset($vehicle_type) && !empty($vehicle_type) && is_array($vehicle_type)) {
            return $vehicle_type['data'];
        } else {
            if (isset($vehicle_type['message']) && !empty($vehicle_type['message']) && is_array($vehicle_type)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_type['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_type,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_vehicle_type_data($vehicle_type_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $vehicle_type = transport_data_with_param_with_urlencode(array('action' => 'get_vehicletype', 'id' => $vehicle_type_id, 'mode' => 'strict'), $apikey);
        if (isset($vehicle_type) && !empty($vehicle_type) && is_array($vehicle_type)) {
            return $vehicle_type['data'];
        } else {
            if (isset($vehicle_type['message']) && !empty($vehicle_type['message']) && is_array($vehicle_type)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_type['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_type,
                    'data' => FALSE
                );
            }
        }
    }
    public function save_vehicle_type_new($vehicle_type_data, $desc)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');

        $vehicle_type = transport_data_with_param_with_urlencode(array('action' => 'save_vehicletype', 'vehicleType' => $vehicle_type_data, 'vehicleDescription' => $desc, 'inst_id' => $inst_id), $apikey);
        //        dev_export($vehicle_type);die;
        if (isset($vehicle_type) && !empty($vehicle_type) && is_array($vehicle_type)) {
            return $vehicle_type['data'];
        } else {
            if (isset($vehicle_type['message']) && !empty($vehicle_type['message']) && is_array($vehicle_type)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_type['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_type,
                    'data' => FALSE
                );
            }
        }
    }
    public function save_vehicle_type_edit($vehicle_type_id, $vehicle_type, $desc)
    {

        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $vehicle_type = transport_data_with_param_with_urlencode(array('action' => 'update_vehicletype', 'id' => $vehicle_type_id, 'vehicleType' => $vehicle_type, 'vehicledesc' => $desc, 'inst_id' => $inst_id), $apikey);
        if (isset($vehicle_type) && !empty($vehicle_type) && is_array($vehicle_type)) {
            return $vehicle_type['data'];
        } else {
            if (isset($vehicle_type['message']) && !empty($vehicle_type['message']) && is_array($vehicle_type)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_type['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_type,
                    'data' => FALSE
                );
            }
        }
    }
    public function update_status_vehicle_type($vehicle_type, $status)
    {
        $apikey = $this->session->userdata('API-Key');
        $vehicle_type = transport_data_with_param_with_urlencode(array('action' => 'modify_vehicletype', 'id' => $vehicle_type, 'status' => $status), $apikey);
        if (isset($vehicle_type) && !empty($vehicle_type) && is_array($vehicle_type)) {
            return $vehicle_type['data'];
        } else {
            if (isset($vehicle_type['message']) && !empty($vehicle_type['message']) && is_array($vehicle_type)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_type['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_type,
                    'data' => FALSE
                );
            }
        }
    }
}
