<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Passenger_deallocate_student_controller
 *
 * @author Chandrajith
 */
class Passenger_deallocate_student_controller extends MX_Controller{
   public function __construct() {
        parent::__construct();
        $this->load->model('Passenger_deallocate_student_model', 'Mps');
    }
      public function get_stud_transport_detaildata($params = NULL) {       
         $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
          if (isset($params['student_id']) && !empty($params['student_id'])) {
            $dbparams[1] = $params['student_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student Id is required', 'data' => FALSE);
        }           
          if (isset($params['acdyr']) && !empty($params['acdyr'])) {
            $dbparams[2] = $params['acdyr'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year Id is required', 'data' => FALSE);
        }           
          if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[3] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution Id is required', 'data' => FALSE);
        }           
        
        $pickuppoint_list = $this->Mps->get_student_detail_transportdata($dbparams);
        if (!empty($pickuppoint_list) && is_array($pickuppoint_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $pickuppoint_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
     public function savestudent_passengerdeallotment($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['studentid']) && !empty($params['studentid'])) {
            $dbparams[1] = intval($params['studentid']);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student Id is required', 'data' => FALSE);
        }
        if (isset($params['startdate']) && !empty($params['startdate'])) {
            $dbparams[2] = $params['startdate'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Start Date is required', 'data' => FALSE);
        }
        if (isset($params['endDate']) && !empty($params['endDate'])) {
            $dbparams[3] = $params['endDate'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'End Date is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[4] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution data is required', 'data' => FALSE);
        }
        if (isset($params['acdyr']) && !empty($params['acdyr'])) {
            $dbparams[5] = $params['acdyr'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        }

//        return $dbparams;
        $student_deallotment_data = $this->Mps->deallot_data($dbparams);

        if (!empty($student_deallotment_data) && is_array($student_deallotment_data) && isset($student_deallotment_data['ErrorStatus']) && $student_deallotment_data['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $student_deallotment_data);
        } else {
            if (isset($student_deallotment_data['ErrorMessage']) && !empty($student_deallotment_data['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $student_deallotment_data['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }
     public function savestudent_passengerdeallotment_drop($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['studentid']) && !empty($params['studentid'])) {
            $dbparams[1] = intval($params['studentid']);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student Id is required', 'data' => FALSE);
        }
        if (isset($params['startdate']) && !empty($params['startdate'])) {
            $dbparams[2] = $params['startdate'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Start Date is required', 'data' => FALSE);
        }
        if (isset($params['endDate']) && !empty($params['endDate'])) {
            $dbparams[3] = $params['endDate'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'End Date is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[4] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution data is required', 'data' => FALSE);
        }
        if (isset($params['acdyr']) && !empty($params['acdyr'])) {
            $dbparams[5] = $params['acdyr'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        }

//        return $dbparams;
        $student_deallotment_data = $this->Mps->deallot_data_drop($dbparams);

        if (!empty($student_deallotment_data) && is_array($student_deallotment_data) && isset($student_deallotment_data['ErrorStatus']) && $student_deallotment_data['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $student_deallotment_data);
        } else {
            if (isset($student_deallotment_data['ErrorMessage']) && !empty($student_deallotment_data['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $student_deallotment_data['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }
}
