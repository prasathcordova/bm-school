<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Itemedition_model
 *
 * @author docme2
 */
class Itemedition_model extends CI_Model{
   public function __construct() {
        parent::__construct();
    }
    
     public function get_all_itemedition() {
        $apikey = $this->session->userdata('API-Key');
        $edition_data = transport_data_with_param_with_urlencode(array('action' => 'get_itemedition'), $apikey);
        if (is_array($edition_data)) {
            return $edition_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $edition_data,
                'data' => FALSE
            );
        }
    }
    
    
    public function save_itemedition($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'save_itemedition';
        $edition_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($edition_status) && $edition_status['status'] == 1) {
            if (is_array($edition_status['data']) && $edition_status['data']['error_status'] == 0) {
                if ($edition_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $edition_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data Insert failed with error message : " . $edition_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data Insert failed');
        }
    }

    public function edit_save_itemedition($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'update_itemedition';
        $edition_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($edition_status) && $edition_status['status'] == 1) {
            if (is_array($edition_status['data']) && $edition_status['data']['error_status'] == 0) {
                if ($edition_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $edition_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data update failed with error message : " . $edition_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }

    public function get_itemedition_details($edition_id) {
        $apikey = $this->session->userdata('API-Key');
        $edition_data = transport_data_with_param_with_urlencode(array('action' => 'get_itemedition', 'id' => $edition_id, 'mode' => 'strict'), $apikey);
        if (is_array($edition_data) && $edition_data['status'] == 1) {
            return $edition_data['data'];
        } else {
            if (is_array($edition_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $edition_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $edition_data,
                    'data' => FALSE
                );
            }
        }
    }
    public function edit_status_itemediton($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'modify_itemedition_status';
        $edition_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($edition_status) && $edition_status['status'] == 1) {
            if (is_array($edition_status['data']) && $edition_status['data']['error_status'] == 0) {
                if ($edition_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $edition_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data update failed with error message : " . $edition_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }
}
