<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Route_pickmap_controller
 *
 * @author chandrajith.edsys
 */
class Route_pickmap_controller extends MX_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Route_pickmap_model', 'Mrp');
    }
   public function save_routepick_map ($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        
        if (isset($params['route_id']) && !empty($params['route_id'])) {
            $dbparams[1] = $params['route_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Route Id is required', 'data' => FALSE);
        }
       
        if (isset($params['pickuppoint_data']) && !empty($params['pickuppoint_data'])) {
            $dbparams[2] = $params['pickuppoint_data'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Pickup Point Data is required', 'data' => FALSE);
        }  
         if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[3] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        $test=json_decode($dbparams[2]);
//        dev_export($test);die;
//        return $dbparams;
        $route_pickuppoint_map_add_status = $this->Mrp->add_new_route_pick_map($dbparams);
        if (!empty($route_pickuppoint_map_add_status) && is_array($route_pickuppoint_map_add_status) && $route_pickuppoint_map_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $route_pickuppoint_map_add_status['id']));
        } else {
            if (is_array($route_pickuppoint_map_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $route_pickuppoint_map_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }
    public function get_routepick_map($params = NULL) {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "c.isactive = " . $params['status'];
        }

        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }


        if (strcasecmp($mode, "search") == 0) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "rpm.routeId = '" . $params['id'] . "' ";
                } else {
                    $query_string = "rpm.routeId = '" . $params['id'] . "' ";
                }
            }
            
        } else if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
//                    $query_string = $query_string . " AND " . "rpm.routeId = '" . $params['id'] . "' ";
                    $query_string = $query_string . " AND " . "trp.isActive = 1 ";
                } else {
//                    $query_string = "rpm.routeId = '" . $params['id'] . "' ";
                    $query_string = "trp.isActive = 1 ";
                }
            }
           
            if (isset($params['inst_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "rpm.instId = '" . $params['inst_id'] . "' ";
                } else {
                    $query_string = "rpm.instId = '" . $params['inst_id'] . "' ";
                }
            }
        }


        $routepickmap_list = $this->Mrp->get_routepickmap_details($apikey, $query_string);
        if (!empty($routepickmap_list) && is_array($routepickmap_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $routepickmap_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_route_pick_maps_details($params = NULL) {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "c.isactive = " . $params['status'];
        }

        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }


        if (strcasecmp($mode, "search") == 0) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "rpm.routeId = '" . $params['id'] . "' ";
                } else {
                    $query_string = "rpm.routeId = '" . $params['id'] . "' ";
                }
            }
            
        } else if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
//                    $query_string = $query_string . " AND " . "rpm.routeId = '" . $params['id'] . "' ";
                    $query_string = $query_string . " AND " . "trp.isActive = 1 ";
                } else {
//                    $query_string = "rpm.routeId = '" . $params['id'] . "' ";
//                    $query_string = "trp.isActive = 1 ";
                    $query_string = "rpm.routeId = '" . $params['id'] . "' ";
                }
            }
           
            if (isset($params['inst_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "rpm.instId = '" . $params['inst_id'] . "' ";
                } else {
                    $query_string = "rpm.instId = '" . $params['inst_id'] . "' ";
                }
            }
        }


        $routepickmap_list = $this->Mrp->get_route_pick_maps_details($apikey, $query_string);
        if (!empty($routepickmap_list) && is_array($routepickmap_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $routepickmap_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_routepickuppoint($params = NULL) {       
         $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
          if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution Id is required', 'data' => FALSE);
        }           

        $routepickmap_list = $this->Mrp->get_route_pickmap($dbparams);
        if (!empty($routepickmap_list) && is_array($routepickmap_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $routepickmap_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_route_pick_maps_details_stoptimes($params = NULL) {       
         $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
          if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution Id is required', 'data' => FALSE);
        }           
          if (isset($params['routeid']) && !empty($params['routeid'])) {
            $dbparams[2] = $params['routeid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Route Id is required', 'data' => FALSE);
        }           
          if (isset($params['tripid']) && !empty($params['tripid'])) {
            $dbparams[3] = $params['tripid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip Id is required', 'data' => FALSE);
        }           

        $routepickmap_list = $this->Mrp->get_route_pick_maps_details_stoptime($dbparams);
        if (!empty($routepickmap_list) && is_array($routepickmap_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $routepickmap_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
}
