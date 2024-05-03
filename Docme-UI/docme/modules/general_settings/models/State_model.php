<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of state_model
 *
 * @author chandrajith.edsys
 */
class state_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
     public function get_all_state_list() {
        $apikey = $this->session->userdata('API-Key');
        $state_data = transport_data_with_param_with_urlencode(array('action' => 'get_state'), $apikey);
        if (is_array($state_data)) {
            return $state_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $state_data,
                'data' => FALSE
            );
        }
    }
     public function get_all_country() {
        $apikey = $this->session->userdata('API-Key');
        $state_data = transport_data_with_param_with_urlencode(array('action' => 'get_countries','status' => 1), $apikey);
        if (is_array($state_data)) {
            return $state_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $state_data,
                'data' => FALSE
            );
        }
    }
     public function save_state($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'save_state';
        $state_status = transport_data_with_param_with_urlencode($data, $apikey);
        
        if (is_array($state_status) && $state_status['status'] == 1) {
            if (is_array($state_status['data']) && $state_status['data']['error_status'] == 0) {
                if ($state_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $state_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data Insert failed with error message : " . $state_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data Insert failed');
        }
    }
    
    public function get_state_details($state_id) {
        $apikey = $this->session->userdata('API-Key');
        $state_data = transport_data_with_param_with_urlencode(array('action' => 'get_state', 'state_id' => $state_id, 'mode' => 'strict'), $apikey);
        if (is_array($state_data)) {
            return $state_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $state_data,
                'data' => FALSE
            );
        }
    }

    public function edit_save_state($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'update_state';
        $state_status = transport_data_with_param_with_urlencode($data, $apikey);                
        if (is_array($state_status) && $state_status['status'] == 1) {
            if (is_array($state_status['data']) && $state_status['data']['error_status'] == 0) {
                if ($state_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $state_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' =>  $state_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }

    public function edit_status_state($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'modify_state_status';
        $state_status = transport_data_with_param_with_urlencode($data, $apikey);        
       if (is_array($state_status) && $state_status['status'] == 1) {
            return $state_status['data'];
        }else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }
}
