<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of language_model
 *
 * @author chandrajith.edsys
 */
class language_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_language_list() {
        $apikey = $this->session->userdata('API-Key');
        $language_data = transport_data_with_param_with_urlencode(array('action' => 'get_languages'), $apikey);
        //dev_export($language_data);die;
        if (is_array($language_data)) {
            return $language_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $language_data,
                'data' => FALSE
            );
        }
    }

    public function save_language($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'save_language';
        $language_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($language_status) && $language_status['status'] == 1) {
            if (is_array($language_status['data']) && $language_status['data']['error_status'] == 0) {
                if ($language_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $language_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data Insert failed with error message : " . $language_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data Insert failed');
        }
    }

    public function edit_save_language($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'update_language';
        $language_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($language_status) && $language_status['status'] == 1) {
            if (is_array($language_status['data']) && $language_status['data']['error_status'] == 0) {
                if ($language_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $language_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => $language_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }

    public function get_language_details($language_id) {
        $apikey = $this->session->userdata('API-Key');
        $language_data = transport_data_with_param_with_urlencode(array('action' => 'get_languages', 'language_id' => $language_id, 'mode' => 'strict'), $apikey);
        if (is_array($language_data) && $language_data['status'] == 1) {
            return $language_data['data'];
        } else {
            if (is_array($language_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $language_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $language_data,
                    'data' => FALSE
                );
            }
        }
    }
    public function edit_status_language($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'modify_language_status';
        $language_status = transport_data_with_param_with_urlencode($data, $apikey);        
        if (is_array($language_status) && $language_status['status'] == 1) {
            if (is_array($language_status['data']) && $language_status['data']['error_status'] == 0) {
                if ($language_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $language_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data update failed with error message : " . $language_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }

}
