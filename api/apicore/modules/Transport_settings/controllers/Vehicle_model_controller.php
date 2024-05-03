<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vehicle_model_controller
 *
 * @author chandrajith.edsys
 */
class Vehicle_model_controller extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Vehiclemodel_model', 'MVmodel');
    }
    public function get_vehiclemodel($params = NULL)
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
            $query_string = "1=1";
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "c.id = '" . $params['id'] . "' ";
                }
            }
            if (isset($params['vehiclemodel'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.model_name LIKE '%" . $params['model_name'] . "%' ";
                } else {
                    $query_string = "c.model_name LIKE '%" . $params['vehiclemodel'] . "%' ";
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
            if (isset($params['vehiclemodel'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.model_name = '" . $params['vehiclemodel'] . "' ";
                } else {
                    $query_string = "c.model_name = '" . $params['vehiclemodel'] . "' ";
                }
            }

            if (isset($params['inst_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.instId = '" . $params['inst_id'] . "' ";
                } else {
                    $query_string = "c.instId = '" . $params['inst_id'] . "' ";
                }
            }
        }


        $vehiclemodel_list = $this->MVmodel->get_vehiclemodel_details($apikey, $query_string);
        if (!empty($vehiclemodel_list) && is_array($vehiclemodel_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $vehiclemodel_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_vehiclemodel($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['vehiclemodel']) && !empty($params['vehiclemodel'])) {
            $dbparams[1] = $params['vehiclemodel'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Model is required', 'data' => FALSE);
        }


        $vehiclemodel_add_status = $this->MVmodel->add_new_vehiclemodel($dbparams);
        if (!empty($vehiclemodel_add_status) && is_array($vehiclemodel_add_status) && $vehiclemodel_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $vehiclemodel_add_status['id']));
        } else {
            if (is_array($vehiclemodel_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $vehiclemodel_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function update_vehiclemodel($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = intval($params['id']);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Model Id is required', 'data' => FALSE);
        }
        if (isset($params['vehiclemodel']) && !empty($params['vehiclemodel'])) {
            $dbparams[2] = $params['vehiclemodel'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Model is required', 'data' => FALSE);
        }

        $dbparams[3] = 1;
        $dbparams[4] = 0;

        $vehiclemodel_update_status = $this->MVmodel->update_vehiclemodel($dbparams);

        if (!empty($vehiclemodel_update_status) && is_array($vehiclemodel_update_status) && isset($vehiclemodel_update_status['ErrorStatus']) && $vehiclemodel_update_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $vehiclemodel_update_status);
        } else {
            if (isset($vehiclemodel_update_status['ErrorMessage']) && !empty($vehiclemodel_update_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $vehiclemodel_update_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }

    public function modify_vehiclemodel_status($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = $params['id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'ID is required', 'data' => FALSE);
        }
        $dbparams[2] = NULL;


        $dbparams[3] = 0;
        if (isset($params['status'])) {
            if ($params['status'] == -1) {
                $dbparams[4] = 0;
            } else {
                $dbparams[4] = $params['status'];
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle  model Status is required', 'data' => FALSE);
        }

        $vehiclemodel_modify_status = $this->MVmodel->update_vehiclemodel($dbparams);
        if (!empty($vehiclemodel_modify_status['ErrorStatus']) && is_array($vehiclemodel_modify_status) && $vehiclemodel_modify_status['ErrorStatus'] == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => $vehiclemodel_modify_status['ErrorMessage'], 'data' => FALSE);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => $vehiclemodel_modify_status['ErrorMessage'], 'data' => TRUE);
        }
    }
}
