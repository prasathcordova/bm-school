<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of city_model
 *
 * @author chandrajith.edsys
 */
class city_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    public function get_all_city_list() {
        $apikey = $this->session->userdata('API-Key');
        $city_data = transport_data_with_param_with_urlencode(array('action' => 'get_city'), $apikey);       
        if(is_array($city_data)) {
            return $city_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $city_data,
                'data' => FALSE
                );
        }
    }
    public function get_all_state() {
        $apikey = $this->session->userdata('API-Key');
        $city_data = transport_data_with_param_with_urlencode(array('action' => 'get_state','status' => 1), $apikey);       
        if(is_array($city_data)) {
            return $city_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $city_data,
                'data' => FALSE
                );
        }
    }
    
    public function get_all_country() {
        $apikey = $this->session->userdata('API-Key');
        $city_data = transport_data_with_param_with_urlencode(array('action' => 'get_countries','status' => 1), $apikey);       
        if(is_array($city_data)) {
            return $city_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $city_data,
                'data' => FALSE
                );
        }
    }
    
    public function save_city($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'save_city';
        $city_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($city_status) && $city_status['status'] == 1) {
            if (is_array($city_status['data']) && $city_status['data']['error_status'] == 0) {
                if ($city_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $city_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data Insert failed with error message : " . $city_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data Insert failed');
        }
    }

    public function get_city_details($city_id) {
        $apikey = $this->session->userdata('API-Key');
        $city_data = transport_data_with_param_with_urlencode(array('action' => 'get_city', 'city_id' => $city_id, 'mode' => 'strict'), $apikey);
        if (is_array($city_data)) {
            return $city_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $city_data,
                'data' => FALSE
            );
        }
    }

    public function edit_save_city($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'update_city';
        $city_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($city_status) && $city_status['status'] == 1) {
            if (is_array($city_status['data']) && $city_status['data']['error_status'] == 0) {
                if ($city_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $city_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data update failed with error message : " . $city_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }

    public function edit_status_city($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'modify_city_status';
        $city_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($city_status) && $city_status['status'] == 1) {
            if (is_array($city_status['data']) && $city_status['data']['error_status'] == 0) {
                if ($city_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $city_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data update failed with error message : " . $city_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }
}
