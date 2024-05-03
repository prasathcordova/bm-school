<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Incidents_controller
 *
 * @author chandrajith.edsys
 */
class Incidents_controller extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Incidents_model', 'MIm');
    }
    public function get_vehicle_incidents($params = NULL)
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
                    $query_string = $query_string . " AND " . "c.accountCode = '" . $params['vehicletype'] . "' ";
                } else {
                    $query_string = "c.vehicleTypeName = '" . $params['vehicleTypeName'] . "' ";
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
        // return $query_string;

        $vehicleincident_list = $this->MIm->get_vehicleincidents($apikey, $query_string);
        // return $vehicleincident_list;
        //        dev_export($vehicleincident_list);die;
        if (!empty($vehicleincident_list) && is_array($vehicleincident_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $vehicleincident_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_vehicle_incidents($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['incidents_data']) && !empty($params['incidents_data'])) {
            $dbparams[1] = $params['incidents_data'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Incident details are required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        $incident_add_status = $this->MIm->add_new_incidents($dbparams);
        if (!empty($incident_add_status) && is_array($incident_add_status) && $incident_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $incident_add_status['id']));
        } else {
            if (is_array($incident_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $incident_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function update_vehicle_incidents($params = NULL)
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

        $vehicleincident_update_status = $this->MIm->update_vehicleincidents($dbparams);

        if (!empty($vehicleincident_update_status) && is_array($vehicleincident_update_status) && isset($vehicleincident_update_status['ErrorStatus']) && $vehicleincident_update_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $vehicleincident_update_status);
        } else {
            if (isset($vehicleincident_update_status['ErrorMessage']) && !empty($vehicleincident_update_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $vehicleincident_update_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }

    public function modify_vehicle_incidents_status($params = NULL)
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
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip Status is required', 'data' => FALSE);
        }

        $vehicleincident_modify_status = $this->MIm->update_vehicleincidents($dbparams);
        if (!empty($vehicleincident_modify_status['ErrorStatus']) && is_array($vehicleincident_modify_status) && $vehicleincident_modify_status['ErrorStatus'] == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => $vehicleincident_modify_status['ErrorMessage'], 'data' => FALSE);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => $vehicleincident_modify_status['ErrorMessage'], 'data' => TRUE);
        }
    }
}
