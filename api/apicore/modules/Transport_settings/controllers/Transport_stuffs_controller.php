<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Transport_stuffs_controller
 *
 * @author Chandrajith
 */
class Transport_stuffs_controller extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transport_stuffs_model', 'MTstuf');
    }
    public function routewise_trip($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['routeid']) && !empty($params['routeid'])) {
            $dbparams[1] = $params['routeid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Route Id  required', 'data' => FALSE);
        }

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        $trip_list = $this->MTstuf->get_trip_details($dbparams);

        if (!empty($trip_list) && is_array($trip_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $trip_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function routewise_trip_stops($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        //        if (isset($params['routeid']) && !empty($params['routeid'])) {
        //            $dbparams[1] = $params['routeid'];
        //        } else {
        //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Route Id  required', 'data' => FALSE);
        //        }
        if (isset($params['tripid']) && !empty($params['tripid'])) {
            if ($params['tripid'] == "ALL") {
                $dbparams[1] = 0;
            } else {
                $dbparams[1] = $params['tripid'];
            };
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip Id  required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        $stops_list = $this->MTstuf->get_stops_details($dbparams);
        if (!empty($stops_list) && is_array($stops_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $stops_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    //get trip name by vinoth @ 10-06-2019 11:40
    public function vehiclewise_tripname($params = NULL)
    {
        //            return $params;
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['vehicle_id']) && !empty($params['vehicle_id'])) {
            $dbparams[1] = $params['vehicle_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Id  required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[3] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        $trip_list = $this->MTstuf->get_vehtrip_details($dbparams);

        if (!empty($trip_list) && is_array($trip_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $trip_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
}
