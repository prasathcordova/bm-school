<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Stock_model
 *
 * @author Saranya kumar G
 */
class Stock_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_stockAllotmnt_list() {
        $apikey = $this->session->userdata('API-Key');
        $stockAllot_data = transport_data_with_param_with_urlencode(array('action' => 'uniform_get_stock_allotment_list_substore',), $apikey);
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

    public function get_all_stockAllotmnt_list_out() {
        $apikey = $this->session->userdata('API-Key');
        $stockAllot_data = transport_data_with_param_with_urlencode(array('action' => 'uniform_get_stock_allotment_list_substore_out',), $apikey);
//        dev_export($apikey);die;
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
            'action' => 'uniform_get_allotment_approval_data',
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

    public function get_stock_data_for_store($storeid) {
        $apikey = $this->session->userdata('API-Key');
        $data_prep = array(
            'action' => 'uniform_get_current_stock_list_report_substore',
            'store_id' => $storeid
        );
        $stock_data = transport_data_with_param_with_urlencode($data_prep, $apikey);
        return $stock_data['data'];
    }

    public function save_allotment($itemdata, $store_id, $total_items, $net_value, $description) {
        $apikey = $this->session->userdata('API-Key');
//        dev_export($store_id);die;
        $substore_data = transport_data_with_param_with_urlencode(array('action' => 'uniform_save_Stock_allotment_sub_out', 'allotment_item_details' => $itemdata, 'store_id' => $store_id, 'total_qty' => $total_items, 'total_value' => $net_value, 'description' => $description), $apikey);
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

    public function save_allotment_edit($data) {
        $apikey = $this->session->userdata('API-Key');
        $allotment = transport_data_with_param_with_urlencode($data, $apikey);
//        dev_export($allotment);die;
        if (isset($allotment) && !empty($allotment) && isset($allotment['status']) && $allotment['status'] == 1) {
            return $allotment['data'];
        } else {
            if (isset($allotment['message']) && !empty($allotment['message'])) {
                return array('data_status' => 0, 'message' => $allotment['message']);
            } else {
                return array('data_status' => 0);
            }
        }
    }

}
