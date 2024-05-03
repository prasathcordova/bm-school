<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Place_controller
 *
 * @author chandrajith.edsys
 */
class City_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('City_model', 'MCity');
    }

    public function get_city($params = NULL) {
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

            if (isset($params['city_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "ci.city_id = '" . $params['city_id'] . "' ";
                } else {
                    $query_string = "ci.city_id = '" . $params['city_id'] . "' ";
                }
            }
            if (isset($params['city_name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "ci.city_name LIKE '%" . $params['city_name'] . "%' ";
                } else {
                    $query_string = "ci.city_name LIKE '%" . $params['city_name'] . "%' ";
                }
            }
            if (isset($params['city_abbr'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "ci.city_abbr LIKE '%" . $params['city_abbr'] . "%' ";
                } else {
                    $query_string = "ci.city_abbr LIKE '%" . $params['city_abbr'] . "%' ";
                }
            }
            if (isset($params['state_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "s.state_id LIKE '%" . $params['state_id'] . "%' ";
                } else {
                    $query_string = "s.state_id LIKE '%" . $params['state_id'] . "%'";
                }
            }
        } else if (strcasecmp($mode, "strict" == 0)) {
             if (isset($params['city_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "ci.city_id  = '" . $params['city_id'] . "' ";
                } else {
                    $query_string = "ci.city_id  = '" . $params['city_id'] . "' ";
                }
            }
            if (isset($params['city_name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "ci.city_name = '" . $params['city_name'] . "' ";
                } else {
                    $query_string = "ci.city_name = '" . $params['city_name'] . "' ";
                }
            }
            if (isset($params['city_abbr'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "ci.city_abbr = '" . $params['city_abbr'] . "' ";
                } else {
                    $query_string = "ci.city_abbr = '" . $params['city_abbr'] . "' ";
                }
            }
            if (isset($params['state_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "s.state_id = '" . $params['state_id'] . "' ";
                } else {
                    $query_string = "s.state_id = '" . $params['state_id'] . "'";
                }
            }
        }


        $city_list = $this->MCity->get_city_details($apikey, $query_string);

        if (!empty($city_list) && is_array($city_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $city_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_city($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['city_name']) && !empty($params['city_name'])) {
            $dbparams[1] = $params['city_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'City Name is required', 'data' => FALSE);
        }
        if (isset($params['city_abbr']) && !empty($params['city_abbr'])) {
            $dbparams[2] = $params['city_abbr'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'City Abbrivation is required', 'data' => FALSE);
        }
        if (isset($params['state_id']) && !empty($params['state_id'])) {
            $dbparams[3] = $params['state_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'State ID is required', 'data' => FALSE);
        }
        $city_add_status = $this->MCity->add_new_city($dbparams);
        if (!empty($city_add_status) && is_array($city_add_status) && $city_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('city_id' => $city_add_status['city_id']));
        } else {
            if (is_array($city_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $city_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function update_city($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['city_id']) && !empty($params['city_id'])) {
            $dbparams[1] = $params['city_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'City ID is required', 'data' => FALSE);
        }
        if (isset($params['city_name']) && !empty($params['city_name'])) {
            $dbparams[2] = $params['city_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'City Name is required', 'data' => FALSE);
        }
        if (isset($params['city_abbr']) && !empty($params['city_abbr'])) {
            $dbparams[3] = $params['city_abbr'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'City Abbrevation is required', 'data' => FALSE);
        }
        if (isset($params['state_id']) && !empty($params['state_id'])) {
            $dbparams[4] = $params['state_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'State ID is required', 'data' => FALSE);
        }
        $dbparams[5] = 1;
        $dbparams[6] = 0;
        $city_add_status = $this->MCity->update_city_data($dbparams);
        if (!empty($city_add_status) && is_array($city_add_status) && $city_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $city_add_status);
        } else {
            if (is_array($city_add_status) && !empty($city_add_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $city_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }

    public function modify_city_status($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['city_id']) && !empty($params['city_id'])) {
            $dbparams[1] = $params['city_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'City ID is required', 'data' => FALSE);
        }
        $dbparams[2] = NULL;
        $dbparams[3] = NULL;
        $dbparams[4] = NULL;
        $dbparams[5] = 0;

        if (isset($params['status'])) {
            $dbparams[6] = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'City Status is required', 'data' => FALSE);
        }

        $city_add_status = $this->MCity->update_city_data($dbparams);
        if (!empty($city_add_status) && is_array($city_add_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $city_add_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data update failed', 'data' => FALSE);
        }
    }

}
