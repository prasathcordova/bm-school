<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Guest_allotment_controller
 *
 * @author chandrajith.edsys
 */
class Guest_allotment_controller extends MX_Controller{
     public function __construct() {
        parent::__construct();
        $this->load->model('Guest_allotment_model', 'Mgallot');
    }
    public function save_guest_allotment($param) {
        $student_data_raw = NULL;
       
        $apikey = $param['API_KEY'];
        
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

        $status = $this->Mgallot->save_guest_transport_allotment($apikey,$allotment_data_raw ,$inst_id);
        
        
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
