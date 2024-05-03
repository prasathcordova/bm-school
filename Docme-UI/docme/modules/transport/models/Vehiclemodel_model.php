<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vehiclemodel_model
 *
 * @author chandrajith.edsys
 */
class Vehiclemodel_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_all_vehicle_model_data()
    {
        $apikey = $this->session->userdata('API-Key');
        $vehicle_model = transport_data_with_param_with_urlencode(array('action' => 'get_model', 'mode' => 'search'), $apikey);
        if (isset($vehicle_model) && !empty($vehicle_model) && is_array($vehicle_model)) {
            return $vehicle_model['data'];
        } else {
            if (isset($vehicle_model['message']) && !empty($vehicle_model['message']) && is_array($vehicle_model)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_model['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_model,
                    'data' => FALSE
                );
            }
        }
    }
    public function save_vehicle_model_new($vehicle_model)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');

        $vehicle_model = transport_data_with_param_with_urlencode(array('action' => 'save_model', 'vehiclemodel' => $vehicle_model, 'inst_id' => $inst_id), $apikey);
        //        dev_export($vehicle_type);die;
        if (isset($vehicle_model) && !empty($vehicle_model) && is_array($vehicle_model)) {
            return $vehicle_model['data'];
        } else {
            if (isset($vehicle_model['message']) && !empty($vehicle_model['message']) && is_array($vehicle_model)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_model['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_model,
                    'data' => FALSE
                );
            }
        }
    }
    public function update_status_vehicle_model($vehicle_model, $status)
    {
        $apikey = $this->session->userdata('API-Key');
        $vehicle_model = transport_data_with_param_with_urlencode(array('action' => 'modify_model', 'id' => $vehicle_model, 'status' => $status), $apikey);
        if (isset($vehicle_model) && !empty($vehicle_model) && is_array($vehicle_model)) {
            return $vehicle_model['data'];
        } else {
            if (isset($vehicle_model['message']) && !empty($vehicle_model['message']) && is_array($vehicle_model)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_model['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_model,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_vehicle_model_data($vehicle_model_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $vehicle_model = transport_data_with_param_with_urlencode(array('action' => 'get_model', 'id' => $vehicle_model_id, 'mode' => 'strict'), $apikey);
        //        dev_export($vehicle_make);die;
        if (isset($vehicle_model) && !empty($vehicle_model) && is_array($vehicle_model)) {
            return $vehicle_model['data'];
        } else {
            if (isset($vehicle_model['message']) && !empty($vehicle_model['message']) && is_array($vehicle_model)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_model['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_model,
                    'data' => FALSE
                );
            }
        }
    }
    public function save_vehicle_model_edit($vehicle_model_id, $vehicle_model)
    {

        $apikey = $this->session->userdata('API-Key');
        //        $inst_id = $this->session->userdata('inst_id');
        $vehicle_model = transport_data_with_param_with_urlencode(array('action' => 'update_model', 'id' => $vehicle_model_id, 'vehiclemodel' => $vehicle_model), $apikey);
        //        dev_export($vehicle_model);die;
        if (isset($vehicle_model) && !empty($vehicle_model) && is_array($vehicle_model)) {
            return $vehicle_model['data'];
        } else {
            if (isset($vehicle_model['message']) && !empty($vehicle_model['message']) && is_array($vehicle_model)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_model['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_model,
                    'data' => FALSE
                );
            }
        }
    }
}
