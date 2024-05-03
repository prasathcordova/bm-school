<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reports_model
 *
 * @author chandrajith.edsys
 */
class Reports_model extends CI_model{
    public function __construct() {
        parent::__construct();
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
     public function get_student_parentaddress($studentid) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_studentparent_details';
        $data['studentid'] = $studentid;
        $studentparent_details = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($studentparent_details)) {
            return $studentparent_details['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $studentparent_details,
                'data' => FALSE
            );
        }
    }
     public function get_profiles_student($studentid) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'getstudent_profiledetails';
        $data['studentid'] = $studentid;
        $student_details = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($student_details)) {
            return $student_details['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $student_details,
                'data' => FALSE
            );
        }
    }

     public function get_sibilings_student($studentid) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'getstudent_sibilingsdetails';
        $data['studentid'] = $studentid;
        $sibilings_details = transport_data_with_param_with_urlencode($data, $apikey);
//        dev_export($sibilings_details);die;
        if (is_array($sibilings_details)) {
            return $sibilings_details['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $sibilings_details,
                'data' => FALSE
            );
        }
    }
 public function get_profiles_student_status($data) {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'status_history';
        $student_details = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($student_details)) {
            return $student_details['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $student_details,
                'data' => FALSE
            );
        }
    }
     public function get_emailID($student_id) {
        $apikey = $this->session->userdata('API-Key');
        $email_data = transport_data_with_param_with_urlencode(array('action' => 'Email_priority','student_id'=>$student_id), $apikey);
        //dev_export($language_data);die;
        if (is_array($email_data)) {
            return $email_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $email_data,
                'data' => FALSE
            );
        }
    }

}
