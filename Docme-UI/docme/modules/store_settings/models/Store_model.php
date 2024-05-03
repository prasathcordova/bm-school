<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Store_model
 *
 * @author saranya.kumar
 */
class Store_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_all_store_list() {
        $apikey = $this->session->userdata('API-Key');
        $store_data = transport_data_with_param_with_urlencode(array('action' => 'store_show'), $apikey);
        if (is_array($store_data)) {
            return $store_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $store_data,
                'data' => FALSE
            );
        }
    }
    
    
    public function save_store($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'save_store';
        $store_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($store_status) && $store_status['status'] == 1) {
            if (is_array($store_status['data']) && $store_status['data']['error_status'] == 0) {
                if ($store_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $store_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data Insert failed with error message : " . $store_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data Insert failed');
        }
    }
    
    
    
    public function get_store_details($pub_id) {
        $apikey = $this->session->userdata('API-Key');
        $store_data = transport_data_with_param_with_urlencode(array('action' => 'store_show', 'store_id' => $pub_id, 'mode' => 'strict'), $apikey);
        if (is_array($store_data)) {
            return $store_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $store_data,
                'data' => FALSE
            );
        }
    }
    
    public function edit_save_store($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'update_store';
        $store_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($store_status) && $store_status['status'] == 1) {
            if (is_array($store_status['data']) && $store_status['data']['error_status'] == 0) {
                if ($store_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $store_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data update failed with error message : " . $store_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }
    
    public function edit_status_store($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'modify_store_status';
        $store_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($store_status) && $store_status['status'] == 1) {
            if (is_array($store_status['data']) && $store_status['data']['error_status'] == 0) {
                if ($store_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $store_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data update failed with error message : " . $store_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }
}
