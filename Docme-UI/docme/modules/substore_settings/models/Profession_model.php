<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of profession_model
 *
 * @author chandrajith.edsys
 */
class profession_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    public function get_all_profession_list() {
        $apikey = $this->session->userdata('API-Key');
        $profession_data = transport_data_with_param_with_urlencode(array('action' => 'get_profession'), $apikey);
        //dev_export($profession_data);die;
        if (is_array($profession_data)) {
            return $profession_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $profession_data,
                'data' => FALSE
            );
        }
    }
     public function save_profession($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'save_profession';
        $profession_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($profession_status) && $profession_status['status'] == 1) {
            if (is_array($profession_status['data']) && $profession_status['data']['error_status'] == 0) {
                if ($profession_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $profession_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data Insert failed with error message : " . $profession_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data Insert failed');
        }
    }
    
     public function edit_save_profession($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'update_profession';
        $profession_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($profession_status) && $profession_status['status'] == 1) {
            if (is_array($profession_status['data']) && $profession_status['data']['error_status'] == 0) {
                if ($profession_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $profession_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => $profession_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }
    public function get_profession_details($profession_id) {
        $apikey = $this->session->userdata('API-Key');
        $profession_data = transport_data_with_param_with_urlencode(array('action' => 'get_profession', 'profession_id' => $profession_id, 'mode' => 'strict'), $apikey);
        if (is_array($profession_data)) {
            return $profession_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $profession_data,
                'data' => FALSE
            );
        }
    }
    public function edit_status_profession($dbparams) {
        $apikey = $this->session->userdata('API-Key');
        $dbparams['action'] = 'modify_Profession_status';
        $profession_status = transport_data_with_param_with_urlencode($dbparams, $apikey);        
        if (is_array($profession_status) && $profession_status['status'] == 1) {
            if (is_array($profession_status['data']) && $profession_status['data']['error_status'] == 0) {
                if ($profession_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $profession_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data update failed with error message : " . $profession_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }
}
