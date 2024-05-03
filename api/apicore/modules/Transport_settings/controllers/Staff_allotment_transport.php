<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Staff_allotment_transport
 *
 * @author chandrajith.edsys
 */
class Staff_allotment_transport extends MX_Controller{
     public function __construct() {
        parent::__construct();
        $this->load->model('Staff_allotment_model', 'Mstaffallot');
    }
     public function save_staff_allotment($param) {
        $student_data_raw = NULL;
       
        $apikey = $param['API_KEY'];
        if (isset($param['staff_data']) && !empty($param['staff_data'])) {
            $staff_data_raw = $param['staff_data'];
        } else {
            return array('status' => 0, 'message' => 'Staff data  is requried.', 'data' => FALSE);
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

        $staff_data = json_decode($staff_data_raw, TRUE);
        $allotment_data = json_decode($allotment_data_raw, TRUE);
//        dev_export($allotment_data);die;
        $staff_allotment_data_final = array();
        foreach ($staff_data as $staff) {
            $staff_allotment_data_final[] = array(
                'emp_id' => $staff['employeeid'],
                'emp_name' => $staff['employee_name'],
                'emp_code' => $staff['empcode'],
                'routeid' => $allotment_data['routeid'],
                'tripid' => $allotment_data['tripid'],
                'busname' => $allotment_data['busname'],
                'fromdate' => $allotment_data['fromdate'],
                'todate' => $allotment_data['todate'],
                'pickid' => $allotment_data['pickid'],
                'dropid' => $allotment_data['dropid']
                   
            );
        }
//echo json_encode($staff_allotment_data_final);die;
        $status = $this->Mstaffallot->save_staff_transport_allotment($apikey, json_encode($staff_allotment_data_final),$inst_id);
        
        
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
