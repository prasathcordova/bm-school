<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vehicleinsurance_model
 *
 * @author chandrajith.edsys
 */
class Vehicleinsurance_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_all_vehicle_insurance_data()
    {
        $apikey = $this->session->userdata('API-Key');
        $vehicle_insurance = transport_data_with_param_with_urlencode(array('action' => 'get_insurance', 'mode' => 'search'), $apikey);
        if (isset($vehicle_insurance) && !empty($vehicle_insurance) && is_array($vehicle_insurance)) {
            return $vehicle_insurance['data'];
        } else {
            if (isset($vehicle_insurance['message']) && !empty($vehicle_insurance['message']) && is_array($vehicle_insurance)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_insurance['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_insurance,
                    'data' => FALSE
                );
            }
        }
    }
    public function save_vehicle_insurance($insurance_cmpny, $desc)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');

        $ins_cmpny = transport_data_with_param_with_urlencode(array('action' => 'save_insurance', 'insurancename' => $insurance_cmpny, 'desc' => $desc, 'inst_id' => $inst_id), $apikey);
        //        dev_export($vehicle_insurance);die;
        if (isset($ins_cmpny) && !empty($ins_cmpny) && is_array($ins_cmpny)) {
            return $ins_cmpny['data'];
        } else {
            if (isset($ins_cmpny['message']) && !empty($ins_cmpny['message']) && is_array($ins_cmpny)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $ins_cmpny['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $ins_cmpny,
                    'data' => FALSE
                );
            }
        }
    }
    public function update_status_insurance($insurance, $status)
    {
        $apikey = $this->session->userdata('API-Key');
        $insurance = transport_data_with_param_with_urlencode(array('action' => 'modify_insurance', 'id' => $insurance, 'status' => $status), $apikey);
        if (isset($insurance) && !empty($insurance) && is_array($insurance)) {
            return $insurance['data'];
        } else {
            if (isset($insurance['message']) && !empty($insurance['message']) && is_array($insurance)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $insurance['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $insurance,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_vehicle_insurance_data($insurance_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $insurance = transport_data_with_param_with_urlencode(array('action' => 'get_insurance', 'id' => $insurance_id, 'mode' => 'strict'), $apikey);
        if (isset($insurance) && !empty($insurance) && is_array($insurance)) {
            return $insurance['data'];
        } else {
            if (isset($insurance['message']) && !empty($insurance['message']) && is_array($insurance)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $insurance['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $insurance,
                    'data' => FALSE
                );
            }
        }
    }
    public function save_insurance_edit($insurance_id, $insurnace_name, $desc)
    {

        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $vehicle_insurance = transport_data_with_param_with_urlencode(array('action' => 'update_insurance', 'id' => $insurance_id, 'insurancename' => $insurnace_name, 'desc' => $desc), $apikey);
        if (isset($vehicle_insurance) && !empty($vehicle_insurance) && is_array($vehicle_insurance)) {
            return $vehicle_insurance['data'];
        } else {
            if (isset($vehicle_insurance['message']) && !empty($vehicle_insurance['message']) && is_array($vehicle_insurance)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_insurance['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_insurance,
                    'data' => FALSE
                );
            }
        }
    }
}
