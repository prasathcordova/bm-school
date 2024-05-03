<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of state_controller
 *
 * @author chandrajith.edsys
 */
class State_controller extends MX_Controller {
    public function __construct() {
        parent::__construct();
         $this->load->model('State_model', 'MState');
    }
    public function get_states($params = NULL) {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "s.isactive = " . $params['status'];
        }

        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }


        if (strcasecmp($mode, "search") == 0) {
            if (isset($params['state_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "s.state_id LIKE '%" . $params['id'] . "%' ";
                } else {
                    $query_string = "s.state_id LIKE '%" . $params['id'] . "%' ";
                }
            }
            if (isset($params['country_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "s.country_id LIKE '%" . $params['country_id'] . "%' ";
                } else {
                    $query_string = "s.country_id LIKE '%" . $params['country_id'] . "%'";
                }
            }
            if (isset($params['state_name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "s.state_name LIKE '%" . $params['state_name'] . "%' ";
                } else {
                    $query_string = "s.state_name LIKE '%" . $params['state_name'] . "%'";
                }
            }
            if (isset($params['state_abbr'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "s.state_abbr LIKE '%" . $params['state_abbr'] . "%' ";
                } else {
                    $query_string = "s.state_abbr LIKE '%" . $params['state_abbr'] . "%'";
                }
            }
            
          
        } else if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['state_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "s.state_id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "s.state_id = '" . $params['state_id'] . "' ";
                }
            }
            if (isset($params['country_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "s.country_id LIKE '%" . $params['country_id'] . "%' ";
                } else {
                    $query_string = "s.country_id LIKE '%" . $params['country_id'] . "%'";
                }
            }
            if (isset($params['state_name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "s.state_name = '" . $params['state_name'] . "' ";
                } else {
                    $query_string = "s.state_name = '" . $params['state_name'] . "'";
                }
            }
            if (isset($params['state_abbr'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "s.state_abbr LIKE '%" . $params['state_abbr'] . "%' ";
                } else {
                    $query_string = "s.state_abbr LIKE '%" . $params['state_abbr'] . "%'";
                }
            }
             
        }


        $state_list = $this->MState->get_state_details($apikey, $query_string);
        if (!empty($state_list) && is_array($state_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $state_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_state($params = NULL) { 
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['state_name']) && !empty($params['state_name'])) {
            $dbparams[1] = $params['state_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'State Name is required', 'data' => FALSE);
        }
        if (isset($params['state_abbr']) && !empty($params['state_abbr'])) {
            $dbparams[2] = $params['state_abbr'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'State Abbrivation is required', 'data' => FALSE);
        }
        if (isset($params['country_id']) && !empty($params['country_id'])) {
            $dbparams[3] = $params['country_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Country details is required', 'data' => FALSE);
        }
        $state_add_status = $this->MState->add_new_state($dbparams);
        
        if (!empty($state_add_status) && is_array($state_add_status) && $state_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('state_id' => $state_add_status['State_id']));
        } else {
            if (is_array($state_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $state_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function update_state($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['state_id']) && !empty($params['state_id'])) {
            $dbparams[1] = $params['state_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'State ID is required', 'data' => FALSE);
        }
        if (isset($params['state_name']) && !empty($params['state_name'])) {
            $dbparams[2] = $params['state_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'State Name is required', 'data' => FALSE);
        }
        if (isset($params['state_abbr']) && !empty($params['state_abbr'])) {
            $dbparams[3] = $params['state_abbr'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'State Abbrivation is required', 'data' => FALSE);
        }
        if (isset($params['country_id']) && !empty($params['country_id'])) {
            $dbparams[4] = $params['country_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Country details is required', 'data' => FALSE);
        }
        $dbparams[5] = 1;
        $dbparams[6] = 0;
        $state_add_status = $this->MState->update_state_data($dbparams);
        if (!empty($state_add_status) && is_array($state_add_status) && isset($state_add_status['ErrorStatus']) && $state_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $state_add_status);
        } else {
             if(isset($state_add_status['ErrorMessage']) && !empty($state_add_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $state_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }

    public function modify_state_status($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['state_id']) && !empty($params['state_id'])) {
            $dbparams[1] = $params['state_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'State ID is required', 'data' => FALSE);
        }
        $dbparams[2] = NULL;
        $dbparams[3] = NULL;
        $dbparams[4] = NULL;
        $dbparams[5] = 0;

        if (isset($params['status'])) {
            $dbparams[6] = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'State Status is required', 'data' => FALSE);
        }        
        $state_status = $this->MState->update_state_data($dbparams);        
        if (!empty($state_status['ErrorStatus']) && is_array($state_status) && $state_status['ErrorStatus'] == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => $state_status['ErrorMessage'], 'data' => FALSE);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => $state_status['ErrorMessage'], 'data' => TRUE);
        }
    }

}
