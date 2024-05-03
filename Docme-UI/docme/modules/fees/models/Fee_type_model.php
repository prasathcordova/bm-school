<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fee_type_model
 *
 * @author chandrajith.edsys
 */
class Fee_type_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    
    public function get_all_fee_type_data($inst_id) {
        $apikey = $this->session->userdata('API-Key');
        $account_code = transport_data_with_param_with_urlencode(array('action' => 'get_feetype', 'inst_id' => $inst_id, 'mode' => 'strict'), $apikey);
        if (isset($account_code) && !empty($account_code) && is_array($account_code)) {
            return $account_code['data'];
        } else {
            if (isset($account_code['message']) && !empty($account_code['message']) && is_array($account_code)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $account_code['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $account_code,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_fee_type_data($fee_type_id) {
        $apikey = $this->session->userdata('API-Key');
        $fee_type = transport_data_with_param_with_urlencode(array('action' => 'get_feetype', 'id' => $fee_type_id, 'mode' => 'strict'), $apikey);
        if (isset($fee_type) && !empty($fee_type) && is_array($fee_type)) {
            return $fee_type['data'];
        } else {
            if (isset($fee_type['message']) && !empty($fee_type['message']) && is_array($fee_type)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $fee_type['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $fee_type,
                    'data' => FALSE
                );
            }
        }
    }

    public function update_status_fee_type($fee_type_id, $inst_id, $status) {
        $apikey = $this->session->userdata('API-Key');
        $fee_type = transport_data_with_param_with_urlencode(array('action' => 'modify_feetype_status', 'id' => $fee_type_id, 'inst_id' => $inst_id, 'status' => $status), $apikey);
        
        if (isset($fee_type) && !empty($fee_type) && is_array($fee_type)) {
            return $fee_type['data'];
        } else {
            if (isset($fee_type['message']) && !empty($fee_type['message']) && is_array($fee_type)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $fee_type['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $fee_type,
                    'data' => FALSE
                );
            }
        }
    }
    public function save_fee_type_edit($fee_type_id, $feeTypeName) {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $fee_type = transport_data_with_param_with_urlencode(array('action' => 'update_feetype', 'id' => $fee_type_id, 'feeTypeName' => $feeTypeName,'inst_id' => $inst_id), $apikey);
        if (isset($fee_type) && !empty($fee_type) && is_array($fee_type)) {
            return $fee_type['data'];
        } else {
            if (isset($fee_type['message']) && !empty($fee_type['message']) && is_array($fee_type)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $fee_type['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $fee_type,
                    'data' => FALSE
                );
            }
        }
    }
    public function save_fee_type_new($code) {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $fee_type = transport_data_with_param_with_urlencode(array('action' => 'save_feetype', 'feeTypeName' => $code,'inst_id' => $inst_id), $apikey);
        if (isset($fee_type) && !empty($fee_type) && is_array($fee_type)) {
            return $fee_type['data'];
        } else {
            if (isset($fee_type['message']) && !empty($fee_type['message']) && is_array($fee_type)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $fee_type['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $fee_type,
                    'data' => FALSE
                );
            }
        }
    }
}
