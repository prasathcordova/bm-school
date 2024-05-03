<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Staff_deallocate_transport
 *
 * @author chandrajith.edsys
 */
class Staff_deallocate_transport extends MX_Controller{
     public function __construct() {
        parent::__construct();
        $this->load->model('Staff_deallocate_model', 'Mempdeallot');
    }
    public function get_allotted_employees($params = NULL) {

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


        $employeesdetails_list = $this->Mempdeallot->get_trip_allotted_employees($dbparams);
        if (!empty($employeesdetails_list) && is_array($employeesdetails_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $employeesdetails_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function modify_allotted_employees($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = $params['id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'STUDENT ID is required', 'data' => FALSE);
        }
        
        $employees_modify_status = $this->Mempdeallot->update_employees_allotted_data($dbparams);
        if (!empty($employees_modify_status['ErrorStatus']) && is_array($employees_modify_status) && $employees_modify_status['ErrorStatus'] == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => $employees_modify_status['ErrorMessage'], 'data' => FALSE);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => $employees_modify_status['ErrorMessage'], 'data' => TRUE);
        }
    }
}
