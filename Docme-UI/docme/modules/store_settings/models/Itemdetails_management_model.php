<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Details_management_model
 *
 * @author chandrajith.edsys
 */
class Itemdetails_management_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_item_list() {
        $apikey = $this->session->userdata('API-Key');
        $item_data = transport_data_with_param_with_urlencode(array('action' => 'show_items_master','count' => SEARCH_ITEM_COUNT_MAX_LIMIT), $apikey);
        if (is_array($item_data) && isset($item_data['status']) && $item_data['status'] == 1) {
            return $item_data['data'];
        } else {
            if (isset($item_data['message'])) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $item_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $item_data,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_publishers() {
        $apikey = $this->session->userdata('API-Key');
        $publisher = transport_data_with_param_with_urlencode(array('action' => 'get_publisher', 'status' => 1), $apikey);
        if (is_array($publisher) && isset($publisher['status']) && $publisher['status'] == 1) {
            return $publisher['data'];
        } else {
            if (isset($publisher['message'])) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $publisher['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $publisher,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_item_type() {
        $apikey = $this->session->userdata('API-Key');
        $data = transport_data_with_param_with_urlencode(array('action' => 'get_itemtype', 'status' => 1), $apikey);
        if (is_array($data) && isset($data['status']) && $data['status'] == 1) {
            return $data['data'];
        } else {
            if (isset($data['message'])) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $data,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_item_edition() {
        $apikey = $this->session->userdata('API-Key');
        $data = transport_data_with_param_with_urlencode(array('action' => 'get_itemedition', 'status' => 1), $apikey);
        if (is_array($data) && isset($data['status']) && $data['status'] == 1) {
            return $data['data'];
        } else {
            if (isset($data['message'])) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $data,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_stock_category() {
        $apikey = $this->session->userdata('API-Key');
        $data = transport_data_with_param_with_urlencode(array('action' => 'get_category', 'status' => 1), $apikey);
        if (is_array($data) && isset($data['status']) && $data['status'] == 1) {
            return $data['data'];
        } else {
            if (isset($data['message'])) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $data,
                    'data' => FALSE
                );
            }
        }
    }

    public function save_item($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'save_itemmaster';
        $item_status = transport_data_with_param_with_urlencode($data, $apikey);
//        dev_export($item_status);die;
        if (is_array($item_status) && $item_status['status'] == 1) {
            if (is_array($item_status['data']) && $item_status['data']['error_status'] == 0 && empty($item_status['data']['data']['ErrorStatus'])) {
                if ($item_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $item_status['data']['message']);
                }
            } else {
                if ($item_status['data']['data']['ErrorStatus'] == 1) {
                    return array('status' => 0, 'message' => $item_status['data']['data']['ErrorMessage']);
                }
            }
        } else {
            return array('status' => 0, 'message' => 'Data Insert failed');
        }
    }

    public function edit_save_item($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'update_items';
        $item_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($item_status) && $item_status['status'] == 1) {
            if (is_array($item_status['data']) && $item_status['data']['error_status'] == 0) {
                if ($item_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $item_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => $item_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }

    public function get_item_details($item_id) {
        $apikey = $this->session->userdata('API-Key');
        $item_data = transport_data_with_param_with_urlencode(array('action' => 'show_items_master', 'item_id' => $item_id, 'mode' => 'strict'), $apikey);
        if (is_array($item_data)) {
            return $item_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $item_data,
                'data' => FALSE
            );
        }
    }
    
    public function edit_status_item($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'modify_item_status';
        $item_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($item_status) && $item_status['status'] == 1) {
            return $item_status['data'];
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }

}
