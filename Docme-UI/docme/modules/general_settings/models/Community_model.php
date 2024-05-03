<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of community_model
 *
 * @author chandrajith.edsys
 */
class community_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
     public function get_all_community_list() {
        $apikey = $this->session->userdata('API-Key');
        $community_data = transport_data_with_param_with_urlencode(array('action' => 'get_community'), $apikey);        
        if(is_array($community_data)) {
            return $community_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $community_data,
                'data' => FALSE
                );
        }
    }
    public function save_community($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'save_community';
        $community_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($community_status) && $community_status['status'] == 1) {
            if (is_array($community_status['data']) && $community_status['data']['error_status'] == 0) {
                if ($community_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $community_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data Insert failed with error message : " . $community_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data Insert failed');
        }
    }
    
    public function edit_save_community($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'update_community';
        $community_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($community_status) && $community_status['status'] == 1) {
            if (is_array($community_status['data']) && $community_status['data']['error_status'] == 0) {
                if ($community_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $community_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data update failed with error message : " . $community_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }

    public function get_community_details($community_id) {
        $apikey = $this->session->userdata('API-Key');
        $community_data = transport_data_with_param_with_urlencode(array('action' => 'get_community', 'id' => $community_id, 'mode' => 'strict'), $apikey);
        
        if (is_array($community_data) && $community_data['status'] == 1) {
            return $community_data['data'];
        } else {
            if (is_array($community_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $community_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $community_data,
                    'data' => FALSE
                );
            }
        }
    }
    public function edit_status_community($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'modify_community_status';
        $community_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($community_status) && $community_status['status'] == 1) {
            if (is_array($community_status['data']) && $community_status['data']['error_status'] == 0) {
                if ($community_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $community_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data update failed with error message : " . $community_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }
}
