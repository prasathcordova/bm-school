<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Route_tripmap_controller
 *
 * @author chandrajith.edsys
 */
class Route_tripmap_controller extends MX_Controller {
    public function __construct() {
        parent::__construct();
         $this->load->model('Route_tripmap_model', 'Mrt');
    }
     public function save_routetrip_map ($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        
        if (isset($params['trip_name']) && !empty($params['trip_name'])) {
            $dbparams[1] = $params['trip_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip Name is required', 'data' => FALSE);
        }
        if (isset($params['route_id']) && !empty($params['route_id'])) {
            $dbparams[2] = $params['route_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Route  ID is required', 'data' => FALSE);
        }
       
        if (isset($params['route_start_time']) && !empty($params['route_start_time'])) {
            $dbparams[3] = $params['route_start_time'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Route Start time is required', 'data' => FALSE);
        }
        if (isset($params['route_end_time']) && !empty($params['route_end_time'])) {
            $dbparams[4] = $params['route_end_time'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Route End time is required', 'data' => FALSE);
        }
        if (isset($params['template_data']) && !empty($params['template_data'])) {
            $dbparams[5] = $params['template_data'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Template Data is required', 'data' => FALSE);
        }  
         if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[6] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
//        return $dbparams;
        $route_trip_map_add_status = $this->Mrt->add_new_route_trip_map($dbparams);
        if (!empty($route_trip_map_add_status) && is_array($route_trip_map_add_status) && $route_trip_map_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $route_trip_map_add_status['id']));
        } else {
            if (is_array($route_trip_map_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $route_trip_map_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }
     public function get_routetrip_map($params = NULL) {       
         $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
          if (isset($params['route_id']) && !empty($params['route_id'])) {
            $dbparams[1] = $params['route_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Route Id is required', 'data' => FALSE);
        }           
          if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution Id is required', 'data' => FALSE);
        }           

        $routetrippickmap_list = $this->Mrt->get_route_tripmap($dbparams);
        if (!empty($routetrippickmap_list) && is_array($routetrippickmap_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $routetrippickmap_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
     public function get_trippickuppoint_time($params = NULL) {       
         $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
          if (isset($params['trip_id']) && !empty($params['trip_id'])) {
            $dbparams[1] = $params['trip_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip Id is required', 'data' => FALSE);
        }           
          if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution Id is required', 'data' => FALSE);
        }           

        $routetrippickmaptime_list = $this->Mrt->get_triptimemap($dbparams);
        if (!empty($routetrippickmaptime_list) && is_array($routetrippickmaptime_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $routetrippickmaptime_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
}
