<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OH_issue_model
 *
 * @author Akhil.A.S
 */
class OH_issue_model extends CI_Model {
    
 public function __construct() {
        parent::__construct();
    }
    
    
      public function oh_issue() {
        $apikey = $this->session->userdata('API-Key');
        $currency = transport_data_with_param_with_urlencode(array('action' => 'get_currency', 'status' => 1), $apikey);        
        if (is_array($currency)) {
            return $currency['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $currency,
                'data' => FALSE
            );
        }
    }
      public function oh_group_issue() {
        $apikey = $this->session->userdata('API-Key');
        $currency = transport_data_with_param_with_urlencode(array('action' => 'get_currency', 'status' => 1), $apikey);        
        if (is_array($currency)) {
            return $currency['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $currency,
                'data' => FALSE
            );
        }
    }
    public function get_all_acadyr() {
        $apikey = $this->session->userdata('API-Key');
        $acd_data = transport_data_with_param_with_urlencode(array(
            'action' => 'get_acdyear',
            'status' => 1,
            'mode' => 'strict',
                ), $apikey);
        if (is_array($acd_data)) {
            return $acd_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $acd_data,
                'data' => FALSE
            );
        }
    }
     public function get_batch_details_for_filter($acd_year_id) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_batch_details_for_filter';
        $data['acd_year_id'] = $acd_year_id;
        $batch_details = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($batch_details)) {
            return $batch_details['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $batch_details,
                'data' => FALSE
            );
        }
    }
     public function no_batch_count($acd_year_id) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'no_batch_counts';
        $data['acd_year'] = $acd_year_id;
        $batch_details_count = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($batch_details_count)) {
            return $batch_details_count['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $batch_details_count,
                'data' => FALSE
            );
        }
    }
     public function get_all_studentdata($acd_year_id, $batchid) {
        $apikey = $this->session->userdata('API-Key');
        $student_data = transport_data_with_param_with_urlencode(array('action' => 'getdetails_student', 'acd_year' => $acd_year_id, 'batchid' => $batchid), $apikey);
        if (is_array($student_data)) {
            return $student_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $student_data,
                'data' => FALSE
            );
        }
    }
}