<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Account_code_model
 *
 * @author chandrajith.edsys
 */
class Account_code_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_account_code_data($inst_id) {
        $apikey = $this->session->userdata('API-Key');
        $account_code = transport_data_with_param_with_urlencode(array('action' => 'get_accountcode', 'inst_id' => $inst_id, 'mode' => 'strict'), $apikey);
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
    public function get_account_code_data($account_code_id) {
        $apikey = $this->session->userdata('API-Key');
        $account_code = transport_data_with_param_with_urlencode(array('action' => 'get_accountcode', 'id' => $account_code_id, 'mode' => 'strict'), $apikey);
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

    public function update_status_account_code($account_code, $status, $inst_id) {
        $apikey = $this->session->userdata('API-Key');
        $account_code = transport_data_with_param_with_urlencode(array('action' => 'status_accountcode', 'id' => $account_code, 'status' => $status, 'inst_id' => $inst_id), $apikey);
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
    public function save_account_code_edit($account_code, $code, $desc) {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $account_code = transport_data_with_param_with_urlencode(array('action' => 'update_accountcode', 'id' => $account_code, 'accountcode' => $code,'accountdesc'=> $desc,'inst_id' => $inst_id), $apikey);
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
    public function save_account_code_new($code, $desc) {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $account_code = transport_data_with_param_with_urlencode(array('action' => 'save_accountcode', 'accountcode' => $code,'accountdesc'=> $desc,'inst_id' => $inst_id), $apikey);
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

}
