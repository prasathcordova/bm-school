<?php
/**
 * Description of Language_controller
 *
 * @author chandrajith.edsys
 */
class Language_controller extends MX_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Language_model','MLanguage');
    }
    
    public function get_languages($params = NULL) {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "l.isactive = " . $params['status'];
        }
        if (isset($params['language_id'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "l.language_id LIKE '%" . $params['language_id'] . "%' ";
            } else {
                $query_string = "l.language_id LIKE '%" . $params['language_id'] . "%' ";
            }
        }
        if (isset($params['language_name'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "l.language_name LIKE '%" . $params['language_name'] . "%' ";
            } else {
                $query_string = "l.language_name LIKE '%" . $params['language_name'] . "%' ";
            }
        }
        $language_list = $this->MLanguage->get_language_list($apikey, $query_string);
        if (!empty($language_list) && is_array($language_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $language_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        } 
    }
    
    public function save_language($params = NULL) {
         $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['language_name']) && !empty($params['language_name'])) {
            $dbparams[1] = $params['language_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Language Name is required', 'data' => FALSE);
        }
        $language_add_status = $this->MLanguage->add_new_language($dbparams);
        if (!empty($language_add_status) && is_array($language_add_status) && $language_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('language_id' => $language_add_status['language_id']));
        } else {
            if (is_array($language_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $language_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }
    
    public function update_language($params = NULL) {
         $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 1;
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[2] = $params['id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Language ID is required', 'data' => FALSE);
        }
        if (isset($params['name']) && !empty($params['name'])) {
            $dbparams[3] = $params['name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Language Name is required', 'data' => FALSE);
        }
        $dbparams[4] = NULL;
        
        $language_add_status = $this->MLanguage->update_language_data($dbparams);
        if (!empty($language_add_status) && is_array($language_add_status) && isset($language_add_status['ErrorStatus']) && $language_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $language_add_status);
        } else {
             if(isset($language_add_status['ErrorMessage']) && !empty($language_add_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $language_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }
    
    public function modify_language_status($params = NULL) {
               
         $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 0;
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[2] = $params['id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Language ID is required', 'data' => FALSE);
        }
        
        $dbparams[3] = NULL;
       
        if (isset($params['status']) )  {
            $dbparams[4] = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Language Status is required', 'data' => FALSE);
        }
        
        $language_add_status = $this->MLanguage->update_language_data($dbparams);
        if (!empty($language_add_status) && is_array($language_add_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $language_add_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data update failed', 'data' => FALSE);
        }
    }
}
