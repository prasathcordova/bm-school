<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Passenger_vehiclewisewisedata_controller
 *
 * @author Chandrajith 
 */
class Passenger_vehiclewisewisedata_controller extends MX_Controller {
  public function __construct() {
        parent::__construct();
         $this->load->model('Passenger_vehiclewisewisedata_model', 'Mps');
    }
    public function get_vehiclewise_passnger_data($params = NULL) {       
         $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
          if (isset($params['vehicle_id']) && !empty($params['vehicle_id'])) {
            $dbparams[1] = $params['vehicle_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Id is required', 'data' => FALSE);
        }           
          if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution Id is required', 'data' => FALSE);
        }           
          if (isset($params['acdyr_id']) && !empty($params['acdyr_id'])) {
            $dbparams[3] = $params['acdyr_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academice year Id is required', 'data' => FALSE);
        }           
//return $dbparams;
        $passengers_list = $this->Mps->get_vehiclewise_data($dbparams);
        if (!empty($passengers_list) && is_array($passengers_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $passengers_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
}
