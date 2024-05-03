<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Student_allotment_controller
 *
 * @author chandrajith.edsys
 */
class Student_allotment_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Student_allotment_model', 'Mstallot');
    }

    public function get_trip_details($params = NULL) {

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


        $tripdetails_list = $this->Mstallot->get_trip_details($dbparams);
        if (!empty($tripdetails_list) && is_array($tripdetails_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $tripdetails_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_pickup_details($params = NULL) {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst details are required', 'data' => FALSE);
        }
        if (isset($params['trip_id']) && !empty($params['trip_id'])) {
            $dbparams[2] = $params['trip_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip details are required', 'data' => FALSE);
        }
        $routedetails_list = $this->Mstallot->get_pickup_details($dbparams);
        if (!empty($routedetails_list) && is_array($routedetails_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $routedetails_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_student_allotment($param) {
        $student_data_raw = NULL;
       
        $apikey = $param['API_KEY'];
        if (isset($param['student_data']) && !empty($param['student_data'])) {
            $student_data_raw = $param['student_data'];
        } else {
            return array('status' => 0, 'message' => 'Student data  is requried.', 'data' => FALSE);
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

        $student_data = json_decode($student_data_raw, TRUE);
        $allotment_data = json_decode($allotment_data_raw, TRUE);
        $student_allotment_data_final = array();
        foreach ($student_data as $student) {
            $student_allotment_data_final[] = array(
                'student_id' => $student['studentid'],
                'student_name' => $student['studentname'],
                'admn_no' => $student['admnno'],
                'routeid' => $allotment_data['routeid'],
                'tripid' => $allotment_data['tripid'],
                'busname' => $allotment_data['busname'],
                'fromdate' => $allotment_data['fromdate'],
                'todate' => $allotment_data['todate'],
                'pickid' => $allotment_data['pickid'],
                'dropid' => $allotment_data['dropid']
                   
            );
        }
//echo json_encode($student_allotment_data_final);die;
        $status = $this->Mstallot->save_student_transport_allotment($apikey, json_encode($student_allotment_data_final),$inst_id);
        
        
        if (!empty($status) && is_array($status) && $status['ErrorStatus'] == 0) {
//        if (isset($status['id']) && !empty($status['id']) && $status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Student allotment created successfully.', 'allotmentid' => $status[0]['id']);
        } else {
            if (isset($status['ErrorMessage']) && !empty($status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $status['ErrorMessage'], 'studentid' => 0);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student allotment failed', 'studentid' => 0);
            }
        }
    }

}
