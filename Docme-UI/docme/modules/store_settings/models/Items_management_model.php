<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Items_management_model
 *
 * @author chandrajith.edsys
 */
class Items_management_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
   public function get_all_items_list() {
        $apikey = $this->session->userdata('API-Key');
        $item_data = transport_data_with_param_with_urlencode(array('action' => 'show_items_master'), $apikey);
        if (is_array($item_data)) {
//            dev_export($item_data);die;
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
   public function get_all_category() {
        $apikey = $this->session->userdata('API-Key');
        $category_data = transport_data_with_param_with_urlencode(array('action' => 'get_category'), $apikey);
        if (is_array($category_data)) {
//            dev_export($item_data);die;
            return $category_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $category_data,
                'data' => FALSE
            );
        }
    }
   public function get_all_itemtype() {
        $apikey = $this->session->userdata('API-Key');
        $itemtype_data = transport_data_with_param_with_urlencode(array('action' => 'get_itemtype'), $apikey);
        if (is_array($itemtype_data)) {
//            dev_export($item_data);die;
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
   public function get_all_itemedition() {
        $apikey = $this->session->userdata('API-Key');
        $itemtype_data = transport_data_with_param_with_urlencode(array('action' => 'get_itemedition'), $apikey);
        if (is_array($itemtype_data)) {
//            dev_export($item_data);die;
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
   public function get_all_publisher() {
        $apikey = $this->session->userdata('API-Key');
        $publisher_data = transport_data_with_param_with_urlencode(array('action' => 'get_publisher'), $apikey);
        if (is_array($publisher_data)) {
//            dev_export($item_data);die;
            return $publisher_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $publisher_data,
                'data' => FALSE
            );
        }
    }
    public function save_item($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'save_itemmaster';
        $item_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($item_status) && $item_status['status'] == 1) {
            if (is_array($item_status['data']) && $item_status['data']['error_status'] == 0) {
                if ($item_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $item_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data Insert failed with error message : " . $item_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data Insert failed');
        }
    }
     public function edit_status_item($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'modify_item_status';
        $item_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($item_status) && $item_status['status'] == 1) {
            if (is_array($item_status['data']) && $item_status['data']['error_status'] == 0) {
                if ($item_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $item_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data update failed with error message : " . $item_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }
}
