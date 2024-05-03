<?php

/**
 * Description of Caste_controller
 *
 * @author chandrajith.edsys
 */
class Caste_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Caste_model', 'MCaste');
    }

    public function get_caste($params = NULL) {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "c.isactive = " . $params['status'];
        }
        if (isset($params['caste_id'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "c.caste_id LIKE '%" . $params['caste_id'] . "%' ";
            } else {
                $query_string = "c.caste_id LIKE '%" . $params['caste_id'] . "%' ";
            }
        }
        if (isset($params['caste_name'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "c.caste_name LIKE '%" . $params['caste_name'] . "%' ";
            } else {
                $query_string = "c.caste_name LIKE '%" . $params['caste_name'] . "%' ";
            }
        }

        if (isset($params['religion_id'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "r.religion_id LIKE '%" . $params['religion_id'] . "%' ";
            } else {
                $query_string = "r.religion_id LIKE '%" . $params['religion_id'] . "%'";
            }
        }
        if (isset($params['community_id'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "c.community_id LIKE '%" . $params['community_id'] . "%' ";
            } else {
                $query_string = "c.community_id LIKE '%" . $params['community_id'] . "%'";
            }
        }

        $caste_list = $this->MCaste->get_caste_details($apikey, $query_string);
        if (!empty($caste_list) && is_array($caste_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $caste_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_caste($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['caste_name']) && !empty($params['caste_name'])) {
            $dbparams[1] = $params['caste_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Caste Name is required', 'data' => FALSE);
        }
        if (isset($params['religion_id']) && !empty($params['religion_id'])) {
            $dbparams[2] = $params['religion_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Religion ID is required', 'data' => FALSE);
        }
        if (isset($params['community_id']) && !empty($params['community_id'])) {
            $dbparams[3] = $params['community_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Community details is required', 'data' => FALSE);
        }
        $country_add_status = $this->MCaste->add_new_caste($dbparams);
        if (!empty($country_add_status) && is_array($country_add_status) && $country_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('country_id' => $country_add_status['Country_id']));
        } else {
            if (is_array($country_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $country_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function update_caste($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['caste_id']) && !empty($params['caste_id'])) {
            $dbparams[1] = $params['caste_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Caste ID is required', 'data' => FALSE);
        }
        if (isset($params['caste_name']) && !empty($params['caste_name'])) {
            $dbparams[2] = $params['caste_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Caste Name is required', 'data' => FALSE);
        }
        if (isset($params['relegion_id']) && !empty($params['relegion_id'])) {
            $dbparams[3] = $params['relegion_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Relegion ID is required', 'data' => FALSE);
        }
        if (isset($params['community_id']) && !empty($params['community_id'])) {
            $dbparams[4] = $params['community_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Community ID is required', 'data' => FALSE);
        }
        $dbparams[5] = 1;
        $dbparams[6] = 0;
        $caste_add_status = $this->MCaste->update_caste_data($dbparams);
        if (!empty($caste_add_status) && is_array($caste_add_status) && isset($caste_add_status['ErrorStatus']) && $caste_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $caste_add_status);
        } else {
            if (isset($caste_add_status['ErrorMessage']) && !empty($caste_add_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $caste_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }

    public function modify_caste_status($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['caste_id']) && !empty($params['caste_id'])) {
            $dbparams[1] = $params['caste_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Caste ID is required', 'data' => FALSE);
        }
        $dbparams[2] = NULL;
        $dbparams[3] = NULL;
        if (isset($params['community_id']) && !empty($params['community_id'])) {
            $dbparams[4] = $params['community_id'];
        } else {
              return array('data_status' => 0, 'error_status' => 1, 'message' => 'Community ID is required', 'data' => FALSE);
        }

        $dbparams[5] = 0;

        if (isset($params['status'])) {
            $dbparams[6] = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Caste Status is required', 'data' => FALSE);
        }

        $caste_add_status = $this->MCaste->update_caste_data($dbparams);
        if (!empty($caste_add_status['ErrorStatus']) && is_array($caste_add_status) && $caste_add_status['ErrorStatus'] == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => $caste_add_status['ErrorMessage'], 'data' => FALSE);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => $caste_add_status['ErrorMessage'], 'data' => TRUE);
        } 
    }

}
