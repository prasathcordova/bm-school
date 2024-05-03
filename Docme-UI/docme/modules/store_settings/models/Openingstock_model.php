<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Openingstock_model
 *
 * @author chandrajith.edsys
 */
class Openingstock_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_openingstock_master() {
        $apikey = $this->session->userdata('API-Key');
        $store_data = transport_data_with_param_with_urlencode(array('action' => 'get_opening_stock_master'), $apikey);
        if (is_array($store_data)) {
//            dev_export($store_data);die;
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

    public function get_store_details() {
        $apikey = $this->session->userdata('API-Key');
        $store_data = transport_data_with_param_with_urlencode(array('action' => 'store_show'), $apikey);
        if (is_array($store_data)) {
//            dev_export($store_data);die;
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

    public function get_all_item_list() {
        $apikey = $this->session->userdata('API-Key');
        $item_data = transport_data_with_param_with_urlencode(array('action' => 'show_items_master',), $apikey);
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

    public function get_all_purchase_list() {
        $apikey = $this->session->userdata('API-Key');
        $purchase_data = transport_data_with_param_with_urlencode(array('action' => 'get_all_purchase_list'), $apikey);
        if (is_array($purchase_data)) {
            return $purchase_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $purchase_data,
                'data' => FALSE
            );
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
    public function get_current_stock_list($storeid) {
        $apikey = $this->session->userdata('API-Key');
        $stock_data = transport_data_with_param_with_urlencode(array('action' => 'get_current_stock_list','store_id' => $storeid), $apikey);
        if (is_array($stock_data)) {
            return $stock_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $stock_data,
                'data' => FALSE
            );
        }
    }
    public function save_openingstock_details($stockdata,$purchase_status) {
        $apikey = $this->session->userdata('API-Key');
        $stock_data = transport_data_with_param_with_urlencode(array('action' => 'save_opening_stock_new','os_item_details' => $stockdata,'purchase_status' => $purchase_status), $apikey);
//        dev_export($stock_data);die;
        if (is_array($stock_data)) {
            return $stock_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $stock_data,
                'data' => FALSE
            );
        }
    }

}
