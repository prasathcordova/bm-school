<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vehicletype_controller
 *
 * @author chandrajith.edsys
 */
class Vehicletype_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Vehicletype_model', 'MVtype');
    }

    public function get_vehicletype($params = NULL)
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
            if (isset($params['vehicletype'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.vehicleTypeName LIKE '%" . $params['vehicletype'] . "%' ";
                } else {
                    $query_string = "c.vehicleTypeName LIKE '%" . $params['vehicletype'] . "%' ";
                }
            }
            if (isset($params['desc'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.vehicleDescriptionName LIKE '%" . $params['desc'] . "%' ";
                } else {
                    $query_string = "c.vehicleDescriptionName LIKE '%" . $params['desc'] . "%' ";
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
            if (isset($params['vehicletype'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.vehicleTypeName = '" . $params['vehicletype'] . "' ";
                } else {
                    $query_string = "c.vehicleTypeName = '" . $params['vehicletype'] . "' ";
                }
            }
            if (isset($params['desc'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.vehicleDescriptionName = '" . $params['desc'] . "' ";
                } else {
                    $query_string = "c.vehicleDescriptionName = '" . $params['desc'] . "' ";
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
        $vehicletype_list = $this->MVtype->get_vehicletype_details($apikey, $query_string);
        if (!empty($vehicletype_list) && is_array($vehicletype_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $vehicletype_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }


    public function save_vehicletype($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        if (isset($params['vehicleType']) && !empty($params['vehicleType'])) {
            $dbparams[2] = $params['vehicleType'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Type is required', 'data' => FALSE);
        }
        if (isset($params['vehicleDescription']) && !empty($params['vehicleDescription'])) {
            $dbparams[3] = $params['vehicleDescription'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Description is required', 'data' => FALSE);
        }



        $vehicletype_add_status = $this->MVtype->add_new_vehicletype($dbparams);
        if (!empty($vehicletype_add_status) && is_array($vehicletype_add_status) && $vehicletype_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $vehicletype_add_status['id']));
        } else {
            if (is_array($vehicletype_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $vehicletype_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function update_vehicletype($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = intval($params['id']);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Type Id is required', 'data' => FALSE);
        }
        if (isset($params['vehicleType']) && !empty($params['vehicleType'])) {
            $dbparams[2] = $params['vehicleType'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Type is required', 'data' => FALSE);
        }
        if (isset($params['vehicledesc']) && !empty($params['vehicledesc'])) {
            $dbparams[3] = $params['vehicledesc'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Description is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[4] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution data is required', 'data' => FALSE);
        }



        $dbparams[5] = 1;
        $dbparams[6] = 0;

        $vehicletype_update_status = $this->MVtype->update_vehicletype($dbparams);

        if (!empty($vehicletype_update_status) && is_array($vehicletype_update_status) && isset($vehicletype_update_status['ErrorStatus']) && $vehicletype_update_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $vehicletype_update_status);
        } else {
            if (isset($vehicletype_update_status['ErrorMessage']) && !empty($vehicletype_update_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $vehicletype_update_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }

    public function modify_vehicletype_status($params = NULL)
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
        $dbparams[3] = NULL;
        $dbparams[4] = NULL;
        $dbparams[5] = 0;
        if (isset($params['status'])) {
            if ($params['status'] == -1) {
                $dbparams[6] = 0;
            } else {
                $dbparams[6] = $params['status'];
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle  code Status is required', 'data' => FALSE);
        }

        $vehicletype_modify_status = $this->MVtype->update_vehicletype($dbparams);
        if (!empty($vehicletype_modify_status['ErrorStatus']) && is_array($vehicletype_modify_status) && $vehicletype_modify_status['ErrorStatus'] == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => $vehicletype_modify_status['ErrorMessage'], 'data' => FALSE);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => $vehicletype_modify_status['ErrorMessage'], 'data' => TRUE);
        }
    }
}
