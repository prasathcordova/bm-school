<?php

/**
 * Description of Religion_controller
 *
 * @author aju.docme
 */
class Religion_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Religion_model', 'MReligion');
    }

    public function get_religion($params = NULL) {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "isactive = " . $params['status'];
        }
        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }
        if (strcasecmp($mode, "search") == 0) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "religion_id LIKE '%" . $params['id'] . "%' ";
                } else {
                    $query_string = "religion_id LIKE '%" . $params['id'] . "%' ";
                }
            }
            if (isset($params['name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "religion_name LIKE '%" . $params['name'] . "%' ";
                } else {
                    $query_string = "religion_name LIKE '%" . $params['name'] . "%' ";
                }
            }
        } else if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "religion_id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "religion_id = '" . $params['id'] . "' ";
                }
            }
            if (isset($params['name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "religion_name = '" . $params['name'] . "' ";
                } else {
                    $query_string = "religion_name = '" . $params['name'] . "' ";
                }
            }
        }

        $religion_list = $this->MReligion->get_religion($query_string, $apikey);
        if (!empty($religion_list) && is_array($religion_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $religion_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_religion($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['name']) && !empty($params['name'])) {
            $dbparams[1] = $params['name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Religion Name is required', 'data' => FALSE);
        }
        $religion_add_status = $this->MReligion->save_religion_data($dbparams);
        if (!empty($religion_add_status) && is_array($religion_add_status) && $religion_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('religion_id' => $religion_add_status['religion_id']));
        } else {
            if (is_array($religion_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $religion_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function update_religion($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 1;
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[2] = $params['id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Religion ID is required', 'data' => FALSE);
        }
        if (isset($params['name']) && !empty($params['name'])) {
            $dbparams[3] = $params['name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Religion Name is required', 'data' => FALSE);
        }
        $dbparams[4] = 0;

        $religion_update_status = $this->MReligion->update_religion_data($dbparams);
        if (!empty($religion_update_status) && is_array($religion_update_status) && $religion_update_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $religion_update_status['religion_id']);
        } else {
            if (is_array($religion_update_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $religion_update_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }

    public function modify_status_religion($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 0;
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[2] = $params['id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Religion ID is required', 'data' => FALSE);
        }
        $dbparams[3] = NULL;
        if (isset($params['status'])) {
            $dbparams[4] = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Religion Status is required', 'data' => FALSE);
        }        
        $religion_update_status = $this->MReligion->update_religion_data($dbparams);
         if (!empty($religion_update_status['ErrorStatus']) && is_array($religion_update_status) && $religion_update_status['ErrorStatus'] == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => $religion_update_status['ErrorMessage'], 'data' => FALSE);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => $religion_update_status['ErrorMessage'], 'data' => TRUE);
        } 
    }

}
