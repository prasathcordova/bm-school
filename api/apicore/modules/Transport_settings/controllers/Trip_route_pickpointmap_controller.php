<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Trip_route_pickpointmap_controller
 *
 * @author chandrajith
 */
class Trip_route_pickpointmap_controller extends MX_Controller {
    public function __construct() {
        parent::__construct();
         $this->load->model('Trip_route_pickpointmap_model', 'Mtrp');
    }
    public function save_trip_route_pickpoint($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['pickuppoint_data']) && !empty($params['pickuppoint_data'])) {
            $dbparams[1] = $params['pickuppoint_data'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Pickuppoint data are required', 'data' => FALSE);
        }
        if (isset($params['trip_id']) && !empty($params['trip_id'])) {
            $dbparams[2] = $params['trip_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip id details are required', 'data' => FALSE);
        }
       
        if (isset($params['route_id']) && !empty($params['route_id'])) {
            $dbparams[3] = $params['route_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Route  Id details are required', 'data' => FALSE);
        }
       
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[4] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
//        dev_export($dbparams);die;
//        $dbparams[2] = $params['vehicle_data'];
//        return $dbparams;die;

        $trip_route_pickpoint_map_status = $this->Mtrp->save_trip_route_pickpoint($dbparams);
//        return $trip_route_pickpoint_map_status;die;
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
     public function get_tripmapdetails($params = NULL) {       
         $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
          if (isset($params['trip_id']) && !empty($params['trip_id'])) {
            $dbparams[1] = $params['trip_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => ' Trip Id is required', 'data' => FALSE);
        }           
          if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution Id is required', 'data' => FALSE);
        }           
                  
        
        $map_list = $this->Mtrp->get_tripmapdetails_data($dbparams);
        if (!empty($map_list) && is_array($map_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $map_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
}

