<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Student_Model
 *
 * @author docMe
 */
class Student_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function save_promotion($promotion_data, $batchid, $class_id, $acd_year, $type, $cur_class)
    {
        $apikey = $this->session->userdata('API-Key');
        $promote = transport_data_with_param_with_urlencode(array('action' => 'save_promotion', 'promotion_data' => $promotion_data, 'batchid' => $batchid, 'classid' => $class_id, 'acd_year' => $acd_year, 'type' => $type, 'cur_class' => $cur_class), $apikey);
        //        dev_export($student_data);die;
        if (is_array($promote)) {
            return $promote['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => 'Student creation failed',
                'data' => FALSE
            );
        }
    }

    public function get_promoted_batch_data($courseid, $acdyear_id)
    {
        if (isset($acdyear_id) && !empty($acdyear_id)) {
            $acd_id = $acdyear_id;
        } else {
            $acd_id = 0;
        }
        $apikey = $this->session->userdata('API-Key');
        $batch_data = transport_data_with_param_with_urlencode(array('action' => 'get_batch', 'Acd_Year' => $acd_id,  'Class_Det_ID' => $courseid), $apikey);
        //        dev_export($batch_data);die;
        if (is_array($batch_data)) {
            return $batch_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $batch_data,
                'data' => FALSE
            );
        }
    }

    public function get_promoted_class($class)
    {
        $apikey = $this->session->userdata('API-Key');
        $promoted_Class = transport_data_with_param_with_urlencode(array('action' => 'get_promoted_class', 'class' => $class), $apikey);
        //        dev_export($promoted_Class);die;
        if (is_array($promoted_Class)) {
            return $promoted_Class['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $promoted_Class,
                'data' => FALSE
            );
        }
    }

    public function get_promoted_year($acd_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $acd_year = transport_data_with_param_with_urlencode(array('action' => 'get_promoted_year', 'ACD_ID' => $acd_id), $apikey);
        //        dev_export($student_data);die;
        if (is_array($acd_year)) {
            return $acd_year['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $acd_year,
                'data' => FALSE
            );
        }
    }

    public function get_promotion_stud($batchid)
    {

        $apikey = $this->session->userdata('API-Key');
        $batch_data = transport_data_with_param_with_urlencode(array('action' => 'get_promotion_stud', 'BatchID' => $batchid), $apikey);
        //        dev_export($student_data);die;
        if (is_array($batch_data)) {
            return $batch_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $batch_data,
                'data' => FALSE
            );
        }
    }

    public function get_preload_batch_data()
    {
        //        dev_export($batchid);die;
        $acd_year_id = $this->session->userdata('acd_year');
        $apikey = $this->session->userdata('API-Key');
        $batch_data = transport_data_with_param_with_urlencode(array('action' => 'get_batch', 'Acd_Year' => $acd_year_id), $apikey);
        //        dev_export($student_data);die;
        if (is_array($batch_data)) {
            return $batch_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $batch_data,
                'data' => FALSE
            );
        }
    }

    public function get_all_batchdata($courseid, $acd_year_id)
    {
        if (isset($acdyear_id) && !empty($acdyear_id)) {
            $acd_id = $acd_year_id;
        } else {
            $acd_id = 0;
        }
        $apikey = $this->session->userdata('API-Key');
        $batch_data = transport_data_with_param_with_urlencode(array('action' => 'get_batch', 'Class_Det_ID' => $courseid, 'Acd_Year' => $acd_year_id), $apikey);
        //        dev_export($student_data);die;
        if (is_array($batch_data)) {
            return $batch_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => $batch_data,
                'data' => FALSE
            );
        }
    }

    //    public function get_all_acd_year() {
    //        $apikey = $this->session->userdata('API-Key');
    //
    //        $acdyear_data = transport_data_with_param_with_urlencode(array('action' => 'get_acdyear'), $apikey);
    //
    //        if (is_array($acdyear_data)) {
    //            return $acdyear_data['data'];
    //        } else {
    //            return array(
    //                'status' => 0,
    //                'data_status' => 0,
    //                'error_status' => 1,
    //                'message' => $acdyear_data,
    //                'data' => FALSE
    //            );
    //        }
    //    }
    public function get_all_acd_year()
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

    public function get_all_class_list()
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $class_data = transport_data_with_param_with_urlencode(array('action' => 'get_class', 'inst_id' => $inst_id, 'status' => 1), $apikey);

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

    //PROMOTION ENDS-------------------------------------------------------------------------------------------------------------------------



    public function parent_search($data)
    {                                         //display students list on search
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_student_search_list';
        $search_status = transport_data_with_param_with_urlencode($data, $apikey);
        //        dev_export($data);die;
        return $search_status['data'];
    }
    public function parent_search_new($data)
    {                                         //display students list on search
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'parent_search_for_registration';
        $search_status = transport_data_with_param_with_urlencode($data, $apikey);
        //        dev_export($data);die;
        return $search_status['data'];
    }

    public function pass_id($data)
    {                                                    //to get parent details from students id
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'search_student_details';

        $search_status = transport_data_with_param_with_urlencode($data, $apikey);
        //        dev_export($search_status);die;
        return $search_status['data'];

        if (is_array($search_status) && $search_status['status'] == 1) {
            if (is_array($search_status['data']) && $search_status['data']['error_status'] == 0) {
                if ($search_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $search_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data Insert failed with error message : " . $search_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data Insert failed');
        }
    }

    public function studentadvance_search($data)
    {                                         //display students list on search
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_advancestudent_search';
        $search_status = transport_data_with_param_with_urlencode($data, $apikey);
        return $search_status['data'];
    }

    public function student_search($data)
    {                                         //display students list on search
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'get_billstudent_search_list';
        $search_status = transport_data_with_param_with_urlencode($data, $apikey);
        return $search_status['data'];
    }

    public function student_images()
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $data['action'] = 'get_student_images';
        $data['contoller_function'] = 'Student_settings/Student_controller/get_student_images';
        $data['inst_id'] = $inst_id;
        $search_status = transport_data_with_param_with_urlencode($data, $apikey);
        return $search_status['data'];
    }
}
