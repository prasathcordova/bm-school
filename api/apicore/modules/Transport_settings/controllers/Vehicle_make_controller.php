<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vehicle_make_controller
 *
 * @author chandrajith.edsys
 */
class Vehicle_make_controller extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Vehiclemake_model', 'MVm');
    }
    public function get_make($params = NULL)
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
            if (isset($params['make'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.makeName LIKE '%" . $params['make'] . "%' ";
                } else {
                    $query_string = "c.makeName LIKE '%" . $params['make'] . "%' ";
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
            if (isset($params['make'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.makeName = '" . $params['make'] . "' ";
                } else {
                    $query_string = "c.makeName = '" . $params['make'] . "' ";
                }
            }
        }

        $make_list = $this->MVm->get_vehiclemake_details($apikey, $query_string);
        if (!empty($make_list) && is_array($make_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $make_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_make($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['make']) && !empty($params['make'])) {
            $dbparams[1] = $params['make'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Make  is required', 'data' => FALSE);
        }


        $make_add_status = $this->MVm->add_new_vehiclemake($dbparams);
        if (!empty($make_add_status) && is_array($make_add_status) && $make_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $make_add_status['id']));
        } else {
            if (is_array($make_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $make_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function update_make($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = intval($params['id']);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Make Id is required', 'data' => FALSE);
        }
        if (isset($params['make']) && !empty($params['make'])) {
            $dbparams[2] = $params['make'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Make name is required', 'data' => FALSE);
        }

        $dbparams[3] = 1;
        $dbparams[4] = 0;

        $make_update_status = $this->MVm->update_vehiclemake($dbparams);

        if (!empty($make_update_status) && is_array($make_update_status) && isset($make_update_status['ErrorStatus']) && $make_update_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $make_update_status);
        } else {
            if (isset($make_update_status['ErrorMessage']) && !empty($make_update_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $make_update_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }


    public function modify_make_status($params = NULL)
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
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Make details Status is required', 'data' => FALSE);
        }

        $make_modify_status = $this->MVm->update_vehiclemake($dbparams);
        if (!empty($make_modify_status['ErrorStatus']) && is_array($make_modify_status) && $make_modify_status['ErrorStatus'] == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => $make_modify_status['ErrorMessage'], 'data' => FALSE);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => $make_modify_status['ErrorMessage'], 'data' => TRUE);
        }
    }
}
