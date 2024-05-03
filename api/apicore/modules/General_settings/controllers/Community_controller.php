<?php

/**
 * Description of Community_controller
 *
 * @author aju.docme
 */
class Community_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Community_model', 'MCommunity');
    }

    public function get_community($params = NULL) {
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
                $query_string = $query_string . " AND " . "community_id LIKE '%" . $params['id'] . "%' ";
            } else {
                $query_string = "community_id LIKE '%" . $params['id'] . "%' ";
            }
        }
        if (isset($params['name'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "community_name LIKE '%" . $params['name'] . "%' ";
            } else {
                $query_string = "community_name LIKE '%" . $params['name'] . "%' ";
            }
        }
        } else {
            if (isset($params['id'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "community_id = '" . $params['id'] . "' ";
            } else {
                $query_string = "community_id = '" . $params['id'] . "' ";
            }
        }
        if (isset($params['name'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "community_name = '" . $params['name'] . "' ";
            } else {
                $query_string = "community_name = '" . $params['name'] . "' ";
            }
        }
        }

        $community_list = $this->MCommunity->get_community_data($query_string, $apikey);
        if (!empty($community_list) && is_array($community_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $community_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_community($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['name']) && !empty($params['name'])) {
            $dbparams[1] = $params['name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Community Name is required', 'data' => FALSE);
        }

        $community_add_status = $this->MCommunity->add_new_community($dbparams);
        if (!empty($community_add_status) && is_array($community_add_status) && $community_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('country_id' => $community_add_status['community_id']));
        } else {
            if (is_array($community_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $community_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function update_community($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 1;
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[2] = $params['id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Community ID is required', 'data' => FALSE);
        }
        $dbparams[3] = 0;
        if (isset($params['name']) && !empty($params['name'])) {
            $dbparams[4] = $params['name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Community Name is required', 'data' => FALSE);
        }

        $community_update_status = $this->MCommunity->update_community_data($dbparams);
        if (!empty($community_update_status) && is_array($community_update_status) && $community_update_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $community_update_status);
        } else {
            if (is_array($community_update_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $community_update_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }

    public function modify_community_status($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 0;
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[2] = $params['id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Community ID is required', 'data' => FALSE);
        }
        if (isset($params['status'])) {
            $dbparams[3] = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Community Status is required', 'data' => FALSE);
        }
        $dbparams[4] = NULL;
        $community_update_status = $this->MCommunity->update_community_data($dbparams);
        if (!empty($community_update_status) && is_array($community_update_status) && $community_update_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $community_update_status);
        } else {
            if (is_array($community_update_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $community_update_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }

}
