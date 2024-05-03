<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Passenger_guest_controller
 *
 * @author Chandrajith
 */
class Passenger_guest_controller extends MX_Controller {
   public function __construct() {
        parent::__construct();
        $this->load->model('Passenger_guest_model', 'Mpg');
    }
    public function guest_allotment_save($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['student_data']) && !empty($params['student_data'])) {
            $dbparams[1] = $params['student_data'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data  required', 'data' => FALSE);
        }
        if (isset($params['allotment_data']) && !empty($params['allotment_data'])) {
            $dbparams[2] = $params['allotment_data'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Allotment details  required', 'data' => FALSE);
        }
       
       
       
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[3] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        $trip_route_pickpoint_map_status = $this->Mpg->save_guestallotmentdata($dbparams);
        if (!empty($trip_route_pickpoint_map_status) && is_array($trip_route_pickpoint_map_status) && $trip_route_pickpoint_map_status['ErrorStatus'] == 0) {  
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $trip_route_pickpoint_map_status['id']));
        } else {
            if (is_array($trip_route_pickpoint_map_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $trip_route_pickpoint_map_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }
}
