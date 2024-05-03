<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pick_emp_dropchange_controller
 *
 * @author Chandrajith get_emp_alloted_data
 */
class Pick_emp_dropchange_controller extends MX_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('Pick_emp_dropchange_model', 'MSP');
    }
    public function get_emp_alloted_data($params = NULL) {     
         $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
             
          if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution Id is required', 'data' => FALSE);
        }           
        
        $emp_alloted_list = $this->MSP->get_emp_data($dbparams);
        
        if (!empty($emp_alloted_list) && is_array($emp_alloted_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $emp_alloted_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_triplink_pick_data($params = NULL) {     
         $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
          if (isset($params['empid']) && !empty($params['empid'])) {
            $dbparams[1] = $params['empid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Employee Id is required', 'data' => FALSE);
        }           
          if (isset($params['acdyr']) && !empty($params['acdyr'])) {
            $dbparams[2] = $params['acdyr'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academicyear Id is required', 'data' => FALSE);
        }           
          if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[3] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution Id is required', 'data' => FALSE);
        }           
        
        $tripdata = $this->MSP->get_trip_data($dbparams);
        
        if (!empty($tripdata) && is_array($tripdata)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $tripdata);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function emp_allotment_save($param) {
        $student_data_raw = NULL;
       
        $apikey = $param['API_KEY'];
       
        if (isset($param['emp_id']) && !empty($param['emp_id'])) {
            $emp_id = $param['emp_id'];
        } else {
            return array('status' => 0, 'message' => 'Employee id  is requried.', 'data' => FALSE);
        }
        if (isset($param['allotment_data']) && !empty($param['allotment_data'])) {
            $allotment_data_raw = $param['allotment_data'];
        } else {
            return array('status' => 0, 'message' => 'Allotment data  is requried.', 'data' => FALSE);
        }
        if (isset($param['inst_id']) && !empty($param['inst_id'])) {
            $inst_id = $param['inst_id'];
                        
        } else {
            return array('status' => 0, 'message' => 'Institution details is requried.', 'data' => FALSE);
        }
        if (isset($param['acdyr']) && !empty($param['acdyr'])) {
            $acd_id = $param['acdyr'];
                        
        } else {
            return array('status' => 0, 'message' => 'Acdemic year details is requried.', 'data' => FALSE);
        }
//return $allotment_data_raw;
       
        $status = $this->MSP->save_emp_transport_allotment($apikey,$emp_id, $allotment_data_raw,$inst_id,$acd_id);
        
//        dev_export($status);die;
        
        if (!empty($status) && is_array($status) && $status[0]['ErrorStatus'] == 0) {
//        if (isset($status['id']) && !empty($status['id']) && $status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Employee allotment created successfully.', 'allotmentid' => $status[0]['id']);
        } else {
            if (isset($status[0]['ErrorMessage']) && !empty($status[0]['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status[0]['ErrorMessage'], 'studentid' => 0);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student allotment failed', 'studentid' => 0);
            }
        }
    }
}
