<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tc_model
 *
 * @author chandrajith.edsys
 */
class Tc_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
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
    public function get_class()
    {
        $apikey = $this->session->userdata('API-Key');
        $class_data = transport_data_with_param_with_urlencode(array(
            'action' => 'get_class',
            'status' => 1,
            'mode' => 'strict',
        ), $apikey);
        if (is_array($class_data)) {
            return $class_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $class_data,
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
    public function get_all_studentdata($acd_year_id, $batchid)
    {
        //        dev_export($acd_year_id);
        //        dev_export($batchid);die;
        $apikey = $this->session->userdata('API-Key');
        $student_data = transport_data_with_param_with_urlencode(array('action' => 'get_tc_applied_stud', 'acd_year' => $acd_year_id, 'batchid' => $batchid), $apikey);
        //        dev_export($student_data);die;
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
    public function get_tc_issue_data($studentid, $inst_id, $rname, $iname)
    {
        $apikey = $this->session->userdata('API-Key');
        $tc_data = transport_data_with_param_with_urlencode(array('action' => 'get_tc_issue_data', 'studentid' => $studentid, 'inst_id' => $inst_id, 'tc_recieved' => $rname, 'tc_issued' => $iname), $apikey);
        if (is_array($tc_data)) {
            return $tc_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $tc_data,
                'data' => FALSE
            );
        }
    }
    public function get_all_studenttcprepdata($acd_year_id, $batchid)
    {
        $apikey = $this->session->userdata('API-Key');
        $student_data = transport_data_with_param_with_urlencode(array('action' => 'get_tc_prepared_list', 'acd_year' => $acd_year_id, 'batchid' => $batchid), $apikey);
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

    public function save_tc_application($student_data, $student_id, $inst_id, $acdyr_id)
    {
        //        dev_export($student_data);die;
        $apikey = $this->session->userdata('API-Key');
        $status_data = transport_data_with_param_with_urlencode(array('action' => 'save_tc', 'student_data' => $student_data, 'student_id' => $student_id, 'inst_id' => $inst_id, 'acdyr_id' => $acdyr_id), $apikey);

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
    public function cancel_tc_application($student_id, $flag = NULL)
    {
        $apikey = $this->session->userdata('API-Key');
        $status_data = transport_data_with_param_with_urlencode(array('action' => 'cancel_tc', 'student_data' => $student_id, 'flag' => $flag), $apikey);
        //        dev_export($status_data);die;
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
    public function save_tc_preparation($student_data)
    {
        $apikey = $this->session->userdata('API-Key');
        $status_data = transport_data_with_param_with_urlencode(array('action' => 'save_tc_prep', 'student_data' => $student_data), $apikey);
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

    public function get_student_tc_id($student_id)
    {

        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_tc_applied_stud_by_id';
        $data['student_id'] = $student_id;
        $studenttc_detailsid = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($studenttc_detailsid)) {
            return $studenttc_detailsid['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $studenttc_detailsid,
                'data' => FALSE
            );
        }
    }

    public function get_tc_types($instid)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_tc_types';
        $data['instid'] = $instid;
        $studenttc_detailsid = transport_data_with_param_with_urlencode($data, $apikey);
        if (is_array($studenttc_detailsid)) {
            return $studenttc_detailsid['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $studenttc_detailsid,
                'data' => FALSE
            );
        }
    }

    public function get_acd_year()
    {
        $apikey = $this->session->userdata('API-Key');
        $acdyear_data = transport_data_with_param_with_urlencode(array('action' => 'get_acdyear', 'status' => 1), $apikey);
        if (is_array($acdyear_data)) {
            return $acdyear_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $acdyear_data,
                'data' => FALSE
            );
        }
    }

    public function get_student_by_admission_no($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'parent_search_for_registration';
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
    //This function written by Elavarasan S @ 16-05-2019 12:10
    function get_studenttcprepdata_by_admnno($admn_no)
    {
        $apikey = $this->session->userdata('API-Key');
        $student_data = transport_data_with_param_with_urlencode(array('action' => 'get_tc_prepared_list_by_admno', 'admn_no' => $admn_no), $apikey);
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
    //This function written by Elavarasan S @ 16-05-2019 12:20
    function get_studentdata_by_admnno($admn_no)
    {
        $apikey = $this->session->userdata('API-Key');
        $student_data = transport_data_with_param_with_urlencode(array('action' => 'get_tc_applied_stud_by_admno', 'admn_no' => $admn_no), $apikey);
        //        dev_export($student_data);die;
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
