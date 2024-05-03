<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vehicle_route_controller
 *
 * @author chandrajith.edsys
 */
class Vehicle_route_controller extends MX_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('Vehicle_route_model', 'MRoute');
    }
    public function get_route($params = NULL) {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "c.isActive = " . $params['status'];
        }

        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }


        if (strcasecmp($mode, "search") == 0) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "c.id = '" . $params['id'] . "' ";
                }
            }
            if (isset($params['routeName'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.routeName LIKE '%" . $params['routeName'] . "%' ";
                } else {
                    $query_string = "c.routeName LIKE '%" . $params['routeName'] . "%' ";
                }
            }
        } else if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "c.id = '" . $params['id'] . "' ";
                }
            }
            if (isset($params['inst_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.instId = '" . $params['inst_id'] . "' ";
                } else {
                    $query_string = "c.instId = '" . $params['inst_id'] . "' ";
                }
            }
            if (isset($params['routeName'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.routeName = '" . $params['routeName'] . "' ";
                } else {
                    $query_string = "c.routeName = '" . $params['routeName'] . "' ";
                }
            }
            if (isset($params['reverseRoute'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.reverseRoute = '" . $params['reverseRoute'] . "' ";
                } else {
                    $query_string = "c.reverseRoute = '" . $params['reverseRoute'] . "' ";
                }
            }
        }
        
        $route_list = $this->MRoute->get_route_details($apikey, $query_string);
        
        if (!empty($route_list) && is_array($route_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $route_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
     public function save_route($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        if (isset($params['routename']) && !empty($params['routename'])) {
            $dbparams[2] = $params['routename'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Route Name is required', 'data' => FALSE);
        }
        if (isset($params['sourcename']) && !empty($params['sourcename'])) {
            $dbparams[3] = $params['sourcename'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Source Name is required', 'data' => FALSE);
        }
        if (isset($params['sourcelat']) && !empty($params['sourcelat'])) {
            $dbparams[4] = $params['sourcelat'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Source Latitude is required', 'data' => FALSE);
        }
        if (isset($params['sourcelong']) && !empty($params['sourcelong'])) {
            $dbparams[5] = $params['sourcelong'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Source Longitude is required', 'data' => FALSE);
        }
        if (isset($params['destName']) && !empty($params['destName'])) {
            $dbparams[6] = $params['destName'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Source Longitude is required', 'data' => FALSE);
        }
        if (isset($params['destLat']) && !empty($params['destLat'])) {
            $dbparams[7] = $params['destLat'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Destination Latitude is required', 'data' => FALSE);
        }
        if (isset($params['destLong']) && !empty($params['destLong'])) {
            $dbparams[8] = $params['destLong'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Destination Longitude is required', 'data' => FALSE);
        }

//        dev_export($dbparams);die;

        $route_add_status = $this->MRoute->add_new_route($dbparams);
        if (!empty($route_add_status) && is_array($route_add_status) && $route_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $route_add_status['id']));
        } else {
            if (is_array($route_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $route_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }
     public function modify_route($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = $params['id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'ID is required', 'data' => FALSE);
        }
        
        $dbparams[2] = NULL;
        $dbparams[3] = NULL;
        $dbparams[4] = NULL;
        $dbparams[5] = NULL;
        $dbparams[6] = NULL;
        $dbparams[7] = NULL;
        $dbparams[8] = NULL;
        
        
       if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[9] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution data is required', 'data' => FALSE);
        }
//        $dbparams[8] = 0;
        $dbparams[10] = 0;
        if (isset($params['status'])) {
            if ($params['status'] == -1) {
                $dbparams[11] = 0;
            } else {
                $dbparams[11] = $params['status'];
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Route Status is required', 'data' => FALSE);
        }
//        dev_export($dbparams);die;
        $route_modify_status = $this->MRoute->update_route($dbparams);
        if (!empty($route_modify_status['ErrorStatus']) && is_array($route_modify_status) && $route_modify_status['ErrorStatus'] == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => $route_modify_status['ErrorMessage'], 'data' => FALSE);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => $route_modify_status['ErrorMessage'], 'data' => TRUE);
        }
    }
     public function update_route($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = intval($params['id']);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Route Id is required', 'data' => FALSE);
        }
        if (isset($params['routename']) && !empty($params['routename'])) {
            $dbparams[2] = $params['routename'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Route Name is required', 'data' => FALSE);
        }
        if (isset($params['routedesc']) && !empty($params['routedesc'])) {
            $dbparams[3] = $params['routedesc'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Route Description is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[4] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution data is required', 'data' => FALSE);
        }



        $dbparams[5] = 1;
        $dbparams[6] = 0;

        $route_update_status = $this->MRoute->update_route($dbparams);

        if (!empty($route_update_status) && is_array($route_update_status) && isset($route_update_status['ErrorStatus']) && $route_update_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $route_update_status);
        } else {
            if (isset($route_update_status['ErrorMessage']) && !empty($route_update_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $route_update_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }
}
