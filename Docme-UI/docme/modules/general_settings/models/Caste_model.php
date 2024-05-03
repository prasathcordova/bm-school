<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of caste_model
 *
 * @author chandrajith.edsys
 */
class caste_model extends CI_Model{
 
        
    public function __construct() {
        parent::__construct();
    }
    public function get_all_caste_list() {
        $apikey = $this->session->userdata('API-Key');
        $caste_data = transport_data_with_param_with_urlencode(array('action' => 'get_caste'), $apikey);        
        if(is_array($caste_data)) {
            return $caste_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $caste_data,
                'data' => FALSE
                );
        }
    }
    public function get_all_relegion() {
        $apikey = $this->session->userdata('API-Key');
        $religion = transport_data_with_param_with_urlencode(array('action' => 'get_religion', 'status' => 1), $apikey);
        if (is_array($religion)) {
            return $religion['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $religion,
                'data' => FALSE
            );
        }
    }
    
    public function get_all_community() {
        $apikey = $this->session->userdata('API-Key');
        $community = transport_data_with_param_with_urlencode(array('action' => 'get_community', 'status' => 1), $apikey);
//        dev_export($community);die;
        if (is_array($community)) {
            return $community['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $community,
                'data' => FALSE
            );
        }
    }

    public function save_caste($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'save_caste';
        $caste_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($caste_status) && $caste_status['status'] == 1) {
            if (is_array($caste_status['data']) && $caste_status['data']['error_status'] == 0) {
                if ($caste_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $caste_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data Insert failed with error message : " . $caste_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data Insert failed');
        }
    }

    public function get_caste_details($caste_id) {
        $apikey = $this->session->userdata('API-Key');
        $caste_data = transport_data_with_param_with_urlencode(array('action' => 'get_caste', 'caste_id' => $caste_id, 'mode' => 'strict'), $apikey);
        if (is_array($caste_data)) {
            return $caste_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $caste_data,
                'data' => FALSE
            );
        }
    }

    public function edit_save_caste($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'update_caste';        
        $caste_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($caste_status) && $caste_status['status'] == 1) {
            if (is_array($caste_status['data']) && $caste_status['data']['error_status'] == 0) {
                if ($caste_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $caste_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' =>  $caste_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }

    public function edit_status_caste($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'modify_caste_status';
//        dev_export($data);die;
        $caste_status = transport_data_with_param_with_urlencode($data, $apikey);
         if (is_array($caste_status) && $caste_status['status'] == 1) {
            return $caste_status['data'];
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }
}
