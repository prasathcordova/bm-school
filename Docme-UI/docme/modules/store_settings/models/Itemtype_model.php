<?php

/**
 * Description of country_model
 *
 * @author aju.docme
 */
class Itemtype_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function get_all_itemtype_list() {
        $apikey = $this->session->userdata('API-Key');
        $itemtype_data = transport_data_with_param_with_urlencode(array('action' => 'get_itemtype'), $apikey);
        if (is_array($itemtype_data)) {
//            dev_export($itemtype_data);die;
            return $itemtype_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $itemtype_data,
                'data' => FALSE
            );
        }
    }
    
    public function edit_status_itemtype($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'modify_itemtype_status';
        $itemtype_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($itemtype_status) && $itemtype_status['status'] == 1) {
            if (is_array($itemtype_status['data']) && $itemtype_status['data']['error_status'] == 0) {
                if ($itemtype_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $itemtype_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data update failed with error message : " . $itemtype_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }

            public function save_item($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'save_itemtype';
        $itemtype_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($itemtype_status) && $itemtype_status['status'] == 1) {
            if (is_array($itemtype_status['data']) && $itemtype_status['data']['error_status'] == 0) {
                if ($itemtype_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $itemtype_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data Insert failed with error message : " . $itemtype_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data Insert failed');
        }
    }
        public function edit_save_itemtype($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'update_itemtype';
        $itemtype_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($itemtype_status) && $itemtype_status['status'] == 1) {
            if (is_array($itemtype_status['data']) && $itemtype_status['data']['error_status'] == 0) {
                if ($itemtype_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $itemtype_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => $itemtype_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }
    
     public function get_itemtype_details($itemtype_id) {
        $apikey = $this->session->userdata('API-Key');
        $itemtype_data = transport_data_with_param_with_urlencode(array('action' => 'get_itemtype', 'id' => $itemtype_id, 'mode' => 'strict'), $apikey);
        if (is_array($itemtype_data)) {
            return $itemtype_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $itemtype_data,
                'data' => FALSE
            );
        }
    }
    }