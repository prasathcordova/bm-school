<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Trip_vehicle_mapping_controller
 *
 * @author Chandrajith
 */
class Trip_vehicle_mapping_controller extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Trip_vehicle_mapping_model', 'Mtv');
    }
    public function save_tripvehiclemap($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['tripid']) && !empty($params['tripid'])) {
            $dbparams[1] = $params['tripid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip Id is required', 'data' => FALSE);
        }
        if (isset($params['tripname']) && !empty($params['tripname'])) {
            $dbparams[2] = $params['tripname'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip Name is required', 'data' => FALSE);
        }

        if (isset($params['tripstarttime']) && !empty($params['tripstarttime'])) {
            $dbparams[3] = $params['tripstarttime'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip Start time is required', 'data' => FALSE);
        }
        if (isset($params['tripendtime']) && !empty($params['tripendtime'])) {
            $dbparams[4] = $params['tripendtime'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip End time is required', 'data' => FALSE);
        }
        if (isset($params['vehilceid']) && !empty($params['vehilceid'])) {
            $dbparams[5] = $params['vehilceid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Id is required', 'data' => FALSE);
        }
        if (isset($params['vehiclenum']) && !empty($params['vehiclenum'])) {
            $dbparams[6] = $params['vehiclenum'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'vehicle number is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[7] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }

        //return $dbparams;
        $vehicletrip_add_status = $this->Mtv->add_new_vehicletripmap($dbparams);
        if (!empty($vehicletrip_add_status) && is_array($vehicletrip_add_status) && $vehicletrip_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $vehicletrip_add_status['id']));
        } else {
            if (is_array($vehicletrip_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $vehicletrip_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }
    public function get_triplinkvehi($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['tripid']) && !empty($params['tripid'])) {
            $dbparams[1] = $params['tripid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip Id is required', 'data' => FALSE);
        }

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution Id is required', 'data' => FALSE);
        }
        //        return $dbparams ;
        $tripdata = $this->Mtv->get_trip_link_vehicdata($dbparams);

        if (!empty($tripdata) && is_array($tripdata)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $tripdata);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_vehicledetails_trip($params = NULL)
    {
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
        $tripdata = $this->Mtv->get_trip_link_vehicle($dbparams);

        if (!empty($tripdata) && is_array($tripdata)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $tripdata);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_unalloted_vehicle($params)
    {
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
        $unallotted_vehicle_data = $this->Mtv->get_unallotted_vehicle_data($dbparams);

        if (!empty($unallotted_vehicle_data) && is_array($unallotted_vehicle_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $unallotted_vehicle_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
}
