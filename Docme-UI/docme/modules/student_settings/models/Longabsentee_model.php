<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Longabsentee_model
 *
 * @author chandrajith.edsys
 */
class Longabsentee_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_longabsent_list()
    {
        $apikey = $this->session->userdata('API-Key');
        $longabsent_data = transport_data_with_param_with_urlencode(array('action' => 'get_longabsent'), $apikey);
        if (is_array($longabsent_data)) {
            return $longabsent_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $longabsent_data,
                'data' => FALSE
            );
        }
    }
    public function save_stud_longabsent($student_data)
    {
        //        dev_export($student_data);die;
        $apikey = $this->session->userdata('API-Key');
        $status_data = transport_data_with_param_with_urlencode(array('action' => 'save_longabsent', 'student_data' => $student_data), $apikey);

        if (is_array($status_data) && isset($status_data['data']) && !empty($status_data['data'])) {
            return $status_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => 'Error in saving data',
                'data' => FALSE
            );
        }
    }
    public function save_longabsentrelease($student_id, $fee_enable_date)
    {
        //        dev_export($student_data);die;
        $apikey = $this->session->userdata('API-Key');
        $status_data = transport_data_with_param_with_urlencode(array('action' => 'longabsent_release', 'student_id' => $student_id, 'fee_enable_date' => $fee_enable_date), $apikey);

        if (is_array($status_data) && isset($status_data['data']) && !empty($status_data['data'])) {
            return $status_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => 'Error in saving data',
                'data' => FALSE
            );
        }
    }
    public function get_all_acadyr()
    {
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
    public function get_batch_details_for_filter($acd_year_id)
    {
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
    public function get_longabsentstudentdata($acd_year_id, $batchid, $courseid = 0)
    {
        $apikey = $this->session->userdata('API-Key');
        $student_data = transport_data_with_param_with_urlencode(array('action' => 'get_longabsent_students', 'acd_year' => $acd_year_id, 'batchid' => $batchid, 'courseid' => $courseid), $apikey);
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

    public function get_student_by_admission_no($data)
    {
        $apikey = $this->session->userdata('API-Key');
        // $data['action'] = 'parent_search_for_registration';
        $data['action'] = 'get_la_student_by_admission_no';
        $search_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($search_status)) {
            return $search_status['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $search_status,
                'data' => FALSE
            );
        }
    }
}
