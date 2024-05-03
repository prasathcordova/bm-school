<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Allotment_management_model
 *
 * @author saranya.kumar
 */
class Allotment_management_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function save_allotment($itemdata,$store_id,$total_items,$net_value,$description) {
        $apikey = $this->session->userdata('API-Key');
        $substore_data = transport_data_with_param_with_urlencode(array('action' => 'save_Stock_allotment','allotment_item_details' => $itemdata,'store_id' => $store_id,'total_qty' => $total_items,'total_value' => $net_value,'description' =>$description), $apikey);
//          dev_export($substore_data);die;
        if (is_array($substore_data)) {
//            dev_export($category_data);die;
            return $substore_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $substore_data,
                'data' => FALSE
            );
        }
    }

    public function get_all_substore_list() {
        $apikey = $this->session->userdata('API-Key');
        $substore_data = transport_data_with_param_with_urlencode(array('action' => 'get_sub_stores'), $apikey);
        if (is_array($substore_data)) {
//            dev_export($category_data);die;
            return $substore_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $substore_data,
                'data' => FALSE
            );
        }
    }

    public function get_all_item_list($store_id) {
        $apikey = $this->session->userdata('API-Key');
        $item_data = transport_data_with_param_with_urlencode(array('action' => 'rate_display_item_for_allsubstore', 'store_id' => $store_id), $apikey);
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
    public function get_all_item_lists() {
        $apikey = $this->session->userdata('API-Key');
        $item_data = transport_data_with_param_with_urlencode(array('action' => 'show_items_master'), $apikey);
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

    public function get_all_stockAllotmnt_list() {
        $apikey = $this->session->userdata('API-Key');
        $stockAllot_data = transport_data_with_param_with_urlencode(array('action' => 'get_stock_allotment_list',), $apikey);
        if (is_array($stockAllot_data) && isset($stockAllot_data['status']) && $stockAllot_data['status'] == 1) {
            return $stockAllot_data['data'];
        } else {
            if (isset($stockAllot_data['message'])) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $stockAllot_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $stockAllot_data,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_allotment_approval_details($allotment_id) {
        $apikey = $this->session->userdata('API-Key');
       $data = array(
            'action' => 'get_allotment_approval_data',
            'allotment_id' => $allotment_id
        );
        $item_data = transport_data_with_param_with_urlencode($data, $apikey);
//        dev_export($item_data);die;
        if (is_array($item_data) && isset($item_data['status']) && $item_data['status'] == 1) {
            return $item_data['data'];
        } else {
            if (isset($item_data['data']) && isset($item_data['data']['message'])) {
                return array('status' => 0, 'message' => $item_data['data']['message']);
            } else {
                return array('status' => 0, 'message' => $item_data['data']);
            }
        }
    }
 public function get_all_item_list_search($data) {
        $apikey = $this->session->userdata('API-Key');
        $item_data = transport_data_with_param_with_urlencode($data, $apikey);
//        dev_export($item_data);die;
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
    
    
    public function delete_allotment($data_prep) {
        $apikey = $this->session->userdata('API-Key');       
        $item_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($item_data) && isset($item_data['status']) && $item_data['status'] == 1) {
            return $item_data['data'];
        } else {
            if (isset($item_data['data']) && isset($item_data['data']['message'])) {
                return array('status' => 0, 'message' => $item_data['data']['message']);
            } else {
                return array('status' => 0, 'message' => $item_data['data']);
            }
        }
    }
    
    
      public function save_allotment_approval($data_prep) {       
        $apikey = $this->session->userdata('API-Key');
            $data_prep['action'] = 'approve_allotment';
        $item_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        if (is_array($item_data) && isset($item_data['status']) && $item_data['status'] == 1) {
            return $item_data['data'];
        } else {
            if (isset($item_data['data']) && isset($item_data['data']['message'])) {
                return array('status' => 0, 'message' => $item_data['data']['message']);
            } else {
                return array('status' => 0, 'message' => $item_data['data']);
            }
        }
    }
}
