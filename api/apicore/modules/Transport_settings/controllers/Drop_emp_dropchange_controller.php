<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Drop_emp_dropchange_controller
 *
 * @author Chandrajith
 */
class Drop_emp_dropchange_controller extends MX_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Drop_emp_dropchange_model', 'MSP');
    }
     public function get_triplink_drop_data($params = NULL) {    
//         echo 'gfdsgdsg';die;
         $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
          if (isset($params['empid']) && !empty($params['empid'])) {
            $dbparams[1] = $params['empid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Employee is required', 'data' => FALSE);
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
//        dev_export($dbparams) ;die;
        $pickpointdata = $this->MSP->get_pickpoint_data($dbparams);
       
        if (!empty($pickpointdata) && is_array($pickpointdata)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $pickpointdata);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_allotmnetprevious_data($params = NULL) {     
         $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
          if (isset($params['empid']) && !empty($params['empid'])) {
            $dbparams[1] = $params['empid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Employeee is required', 'data' => FALSE);
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
        
        $allotment_prev_data = $this->MSP->get_allotmnetprev_data($dbparams);
        
        if (!empty($allotment_prev_data) && is_array($allotment_prev_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $allotment_prev_data);
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
            return array('status' => 0, 'message' => 'employee id  is requried.', 'data' => FALSE);
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

       
        $status = $this->MSP->save_emp_transport_allotment($apikey,$emp_id, $allotment_data_raw,$inst_id,$acd_id);
        
//        dev_export($status);die;
        
        if (!empty($status) && is_array($status) && $status[0]['ErrorStatus'] == 0) {
//        if (isset($status['id']) && !empty($status['id']) && $status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Student allotment created successfully.', 'allotmentid' => $status[0]['id']);
        } else {
            if (isset($status[0]['ErrorMessage']) && !empty($status[0]['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status[0]['ErrorMessage'], 'studentid' => 0);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student allotment failed', 'studentid' => 0);
            }
        }
    }
}
