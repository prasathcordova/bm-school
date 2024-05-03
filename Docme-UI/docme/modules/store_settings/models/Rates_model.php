<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rates_model
 *
 * @author chandrajith.edsys
 */
class Rates_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    
      public function update_store_details($storeid,$ratesetdata) {
        $apikey = $this->session->userdata('API-Key');
        $store_data = transport_data_with_param_with_urlencode(array('action' => 'rate_change_item','rate_item_details'=>$ratesetdata,'store_id'=>$storeid), $apikey);
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
     public function get_all_rates_list() {
        $apikey = $this->session->userdata('API-Key');
        $item_data = transport_data_with_param_with_urlencode(array('action' => 'rate_item_show'), $apikey);
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
     public function get_all_rates_list_substore() {
        $apikey = $this->session->userdata('API-Key');
        $item_data = transport_data_with_param_with_urlencode(array('action' => 'rate_display_item_for_allsubstore'), $apikey);
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
     public function get_all_stores() {
        $apikey = $this->session->userdata('API-Key');
        $store_data = transport_data_with_param_with_urlencode(array('action' => 'store_show'), $apikey);
        if (is_array($store_data)) {
//            dev_export($item_data);die;
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
}
