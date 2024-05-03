<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vehiclemodeldate_controller
 *
 * @author chandrajith.edsys
 */
class Vehiclemodeldate_controller extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Vehiclemodedate_model', 'MVmodeldate');
    }
    public function get_vehiclemodeldate($params = NULL)
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
            if (isset($params['vModel'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.vModel LIKE '%" . $params['vModel'] . "%' ";
                } else {
                    $query_string = "c.vModel LIKE '%" . $params['vModel'] . "%' ";
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
            if (isset($params['vModel'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.vModel = '" . $params['vModel'] . "' ";
                } else {
                    $query_string = "c.vModel = '" . $params['vModel'] . "' ";
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


        $vehiclemodeldate_list = $this->MVmodeldate->get_vehiclemodeldate_details($apikey, $query_string);
        if (!empty($vehiclemodeldate_list) && is_array($vehiclemodeldate_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $vehiclemodeldate_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function save_vehiclemodeldate($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        if (isset($params['vModel']) && !empty($params['vModel'])) {
            $dbparams[2] = $params['vModel'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Model date is required', 'data' => FALSE);
        }
        $vehiclemodeldate_add_status = $this->MVmodeldate->add_new_vehiclemodeldate($dbparams);
        if (!empty($vehiclemodeldate_add_status) && is_array($vehiclemodeldate_add_status) && $vehiclemodeldate_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $vehiclemodeldate_add_status['id']));
        } else {
            if (is_array($vehiclemodeldate_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $vehiclemodeldate_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }
    public function update_vehiclemodeldate($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = intval($params['id']);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Model date Id is required', 'data' => FALSE);
        }
        if (isset($params['vModel']) && !empty($params['vModel'])) {
            $dbparams[2] = $params['vModel'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Model date is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[3] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution data is required', 'data' => FALSE);
        }

        $dbparams[4] = 1;
        $dbparams[5] = 0;

        $vehiclemodeldate_update_status = $this->MVmodeldate->update_vehiclemodeldate($dbparams);

        if (!empty($vehiclemodeldate_update_status) && is_array($vehiclemodeldate_update_status) && isset($vehiclemodeldate_update_status['ErrorStatus']) && $vehiclemodeldate_update_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $vehiclemodeldate_update_status);
        } else {
            if (isset($vehiclemodeldate_update_status['ErrorMessage']) && !empty($vehiclemodeldate_update_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $vehiclemodeldate_update_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }
    public function modify_vehiclemodeldate_status($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = $params['id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'ID is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution data is required', 'data' => FALSE);
        }
        $dbparams[3] = NULL;
        //        $dbparams[3] = NULL;

        $dbparams[4] = 0;
        if (isset($params['status'])) {
            if ($params['status'] == -1) {
                $dbparams[5] = 0;
            } else {
                $dbparams[5] = $params['status'];
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle  code Status is required', 'data' => FALSE);
        }
        //        dev_export($dbparams);die;
        $vehicletype_modify_status = $this->MVmodeldate->update_vehiclemodeldate($dbparams);
        if (!empty($vehicletype_modify_status['ErrorStatus']) && is_array($vehicletype_modify_status) && $vehicletype_modify_status['ErrorStatus'] == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => $vehicletype_modify_status['ErrorMessage'], 'data' => FALSE);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => $vehicletype_modify_status['ErrorMessage'], 'data' => TRUE);
        }
    }
}
