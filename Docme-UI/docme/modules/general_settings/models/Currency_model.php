<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of currency_model
 *
 * @author chandrajith.edsys
 */
class currency_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
      public function get_all_currency_list() {
        $apikey = $this->session->userdata('API-Key');
        $currency_data = transport_data_with_param_with_urlencode(array('action' => 'get_currency'), $apikey);
        //dev_export($currency_data);die;
        if (is_array($currency_data)) {
            return $currency_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $currency_data,
                'data' => FALSE
            );
        }
    }
    public function save_currency($data) {
         $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'save_currency';
        $currency_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($currency_status) && $currency_status['status'] == 1) {
            if (is_array($currency_status['data']) && $currency_status['data']['error_status'] == 0) {
                if ($currency_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $currency_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data Insert failed with error message : " . $currency_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data Insert failed');
        }
    }
    public function edit_save_currency($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'update_currency';
        $currency_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($currency_status) && $currency_status['status'] == 1) {
            if (is_array($currency_status['data']) && $currency_status['data']['error_status'] == 0) {
                if ($currency_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $currency_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => $currency_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }
    public function get_currency_details($currency_id) {
        $apikey = $this->session->userdata('API-Key');
        $currency_data = transport_data_with_param_with_urlencode(array('action' => 'get_currency', 'currency_id' => $currency_id, 'mode' => 'strict'), $apikey);
        if (is_array($currency_data)) {
            return $currency_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $currency_data,
                'data' => FALSE
            );
        }
    }
    public function edit_status_currency($dbparams) {
        $apikey = $this->session->userdata('API-Key');
        $dbparams['action'] = 'modify_currency_status';
        $currency_status = transport_data_with_param_with_urlencode($dbparams, $apikey);
        if (is_array($currency_status) && $currency_status['status'] == 1) {
            if (is_array($currency_status['data']) && $currency_status['data']['error_status'] == 0) {
                if ($currency_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $currency_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data update failed with error message : " . $currency_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }
}
