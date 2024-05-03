<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Student_deallocate_controller
 *
 * @author chandrajith.edsys
 */
class Student_deallocate_controller extends MX_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Student_deallocate_model', 'Mstdeallot');
    }
     public function get_allotted_students($params = NULL) {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['trip_id']) && !empty($params['trip_id'])) {
            $dbparams[1] = $params['trip_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip details are required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }


        $studentdetails_list = $this->Mstdeallot->get_trip_allotted_students($dbparams);
        if (!empty($studentdetails_list) && is_array($studentdetails_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $studentdetails_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function modify_allotted_students($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = $params['id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'STUDENT ID is required', 'data' => FALSE);
        }
        
        $student_modify_status = $this->Mstdeallot->update_student_allotted_data($dbparams);
        if (!empty($student_modify_status['ErrorStatus']) && is_array($student_modify_status) && $student_modify_status['ErrorStatus'] == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => $student_modify_status['ErrorMessage'], 'data' => FALSE);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => $student_modify_status['ErrorMessage'], 'data' => TRUE);
        }
    }
}
