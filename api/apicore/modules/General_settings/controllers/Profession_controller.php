<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Profession_model
 *
 * @author chandrajith.edsys
 */
class Profession_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Profession_model', 'MProfession');
    }

    public function get_profession($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "p.isactive = " . $params['status'];
        }

        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }
        if (strcasecmp($mode, "search") == 0) {
            if (isset($params['profession_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "p.profession_id LIKE '%" . $params['profession_id'] . "%' ";
                } else {
                    $query_string = "p.profession_id LIKE '%" . $params['profession_id'] . "%' ";
                }
            }
            if (isset($params['profession_name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "p.profession_name LIKE '%" . $params['profession_name'] . "%' ";
                } else {
                    $query_string = "p.profession_name LIKE '%" . $params['profession_name'] . "%' ";
                }
            }
            if (isset($params['profession_code'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "p.profession_code LIKE '%" . $params['profession_code'] . "%' ";
                } else {
                    $query_string = "p.profession_code LIKE '%" . $params['profession_code'] . "%' ";
                }
            }
        } else if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['profession_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "p.profession_id = '" . $params['profession_id'] . "' ";
                } else {
                    $query_string = "p.profession_id = '" . $params['profession_id'] . "' ";
                }
            }
            if (isset($params['profession_name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "p.profession_name = '" . $params['profession_name'] . "' ";
                } else {
                    $query_string = "p.profession_name = '" . $params['profession_name'] . "%' ";
                }
            }
            if (isset($params['profession_code'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "p.profession_code = '" . $params['profession_code'] . "' ";
                } else {
                    $query_string = "p.profession_code = '" . $params['profession_code'] . "' ";
                }
            }
        }

        $profession_list = $this->MProfession->get_profession_list($apikey, $query_string);
        if (!empty($profession_list) && is_array($profession_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $profession_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function save_profession($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['profession_name']) && !empty($params['profession_name'])) {
            $dbparams[1] = $params['profession_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Profession Name is required', 'data' => FALSE);
        }
        if (isset($params['profession_code']) && !empty($params['profession_code'])) {
            $dbparams[2] = $params['profession_code'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Profession Code is required', 'data' => FALSE);
        }
        $profession_add_status = $this->MProfession->add_new_profession($dbparams);
        if (!empty($profession_add_status) && is_array($profession_add_status) && $profession_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('profession_id' => $profession_add_status['profession_id']));
        } else {
            if (is_array($profession_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $profession_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }
    public function update_profession($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['profession_id']) && !empty($params['profession_id'])) {
            $dbparams[1] = $params['profession_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Profession ID is required', 'data' => FALSE);
        }
        if (isset($params['profession_name']) && !empty($params['profession_name'])) {
            $dbparams[2] = $params['profession_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Profession Name is required', 'data' => FALSE);
        }
        if (isset($params['profession_code']) && !empty($params['profession_code'])) {
            $dbparams[3] = $params['profession_code'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Profession Code is required', 'data' => FALSE);
        }
        $dbparams[4] = 1;
        $dbparams[5] = 0;
        $profession_add_status = $this->MProfession->update_profession_data($dbparams);
        //        dev_export($profession_add_status);die;
        if (!empty($profession_add_status) && is_array($profession_add_status) && isset($profession_add_status['ErrorStatus']) && $profession_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $profession_add_status);
        } else {
            if (isset($profession_add_status['ErrorMessage']) && !empty($profession_add_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $profession_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }
    public function modify_Profession_status($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['profession_id']) && !empty($params['profession_id'])) {
            $dbparams[1] = $params['profession_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Profession ID is required', 'data' => FALSE);
        }
        $dbparams[2] = NULL;
        $dbparams[3] = NULL;

        $dbparams[4] = 0;

        if (isset($params['status'])) {
            $dbparams[5] = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Profession Status is required', 'data' => FALSE);
        }

        $profession_add_status = $this->MProfession->update_profession_data($dbparams);
        if (!empty($profession_add_status) && is_array($profession_add_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $profession_add_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data update failed', 'data' => FALSE);
        }
    }
}
