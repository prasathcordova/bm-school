<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fuel_log_controller
 *
 * @author chandrajith.edsys
 */
class Fuel_log_controller extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Fuel_log_model', 'MFlog');
    }
    public function get_fuellog($params = NULL)
    {
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
                    $query_string = $query_string . " AND " . "c.id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "c.id = '" . $params['id'] . "' ";
                }
            }
            if (isset($params['vehicleId'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.vehicleId LIKE '%" . $params['vehicleId'] . "%' ";
                } else {
                    $query_string = "c.vehicleId LIKE '%" . $params['vehicleId'] . "%' ";
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
            if (isset($params['vehicleId'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.vehicleId = '" . $params['vehicleId'] . "' ";
                } else {
                    $query_string = "c.vehicleId = '" . $params['vehicleId'] . "' ";
                }
            }
        }

        $fueltype_list = $this->MFlog->get_fuellog_details($apikey, $query_string);

        if (!empty($fueltype_list) && is_array($fueltype_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $fueltype_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_fueltype_log($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['vehicleId']) && !empty($params['vehicleId'])) {
            $dbparams[1] = $params['vehicleId'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle details are required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }

        $fueltype_list = $this->MFlog->get_fueltype_details($dbparams);

        if (!empty($fueltype_list) && is_array($fueltype_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $fueltype_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function save_fuel_log_entry($params = NULL)
    {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['fuellog_data']) && !empty($params['fuellog_data'])) {
            $dbparams[1] = $params['fuellog_data'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Fuel Log details are required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }

        $fuellog_add_status = $this->MFlog->add_new_fuellog($dbparams);
        if (!empty($fuellog_add_status) && is_array($fuellog_add_status) && $fuellog_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $fuellog_add_status['id']));
        } else {
            if (is_array($fuellog_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => v['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }
}
