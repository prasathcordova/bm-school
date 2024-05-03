<?php

/**
 * Description of religion_model
 *
 * @author chandrajith.edsys
 */
class Religion_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_religion() {
        $apikey = $this->session->userdata('API-Key');
        $religion_data = transport_data_with_param_with_urlencode(array('action' => 'get_religion'), $apikey);
        if (is_array($religion_data)) {
            return $religion_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $religion_data,
                'data' => FALSE
            );
        }
    }
    
    
    public function save_religion($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'save_religion';
        $religion_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($religion_status) && $religion_status['status'] == 1) {
            if (is_array($religion_status['data']) && $religion_status['data']['error_status'] == 0) {
                if ($religion_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $religion_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data Insert failed with error message : " . $religion_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data Insert failed');
        }
    }

    public function edit_save_religion($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'update_religion';
        $religion_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($religion_status) && $religion_status['status'] == 1) {
            if (is_array($religion_status['data']) && $religion_status['data']['error_status'] == 0) {
                if ($religion_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $religion_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data update failed with error message : " . $religion_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }

    public function get_religion_details($religion_id) {
        $apikey = $this->session->userdata('API-Key');
        $religion_data = transport_data_with_param_with_urlencode(array('action' => 'get_religion', 'id' => $religion_id, 'mode' => 'strict'), $apikey);
        if (is_array($religion_data) && $religion_data['status'] == 1) {
            return $religion_data['data'];
        } else {
            if (is_array($religion_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $religion_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $religion_data,
                    'data' => FALSE
                );
            }
        }
    }
    public function edit_status_religion($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'modify_religion_status';
        $religion_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($religion_status) && $religion_status['status'] == 1) {
            return $religion_status['data'];
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }

}
