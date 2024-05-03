<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Guest_deallocate_controller
 *
 * @author chandrajith.edsys
 */
class Guest_deallocate_controller extends MX_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Guest_deallocate_model', 'Mguestdeallot');
    }
    public function get_allotted_guests($params = NULL) {

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


        $guestdetails_list = $this->Mguestdeallot->get_trip_allotted_guests($dbparams);
        if (!empty($guestdetails_list) && is_array($guestdetails_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $guestdetails_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function modify_allotted_guests($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = $params['id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'GUEST ID is required', 'data' => FALSE);
        }
        
        $guest_modify_status = $this->Mguestdeallot->update_guests_allotted_data($dbparams);
        if (!empty($guest_modify_status['ErrorStatus']) && is_array($guest_modify_status) && $guest_modify_status['ErrorStatus'] == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => $guest_modify_status['ErrorMessage'], 'data' => FALSE);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => $guest_modify_status['ErrorMessage'], 'data' => TRUE);
        }
    }
}
