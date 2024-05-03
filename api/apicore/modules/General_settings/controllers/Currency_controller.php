<?php


/**
 * Description of Currency_controller
 *
 * @author chandrajith.edsys
 */
class Currency_controller extends MX_Controller {
    
    public function __construct() {
        parent::__construct();
    $this->load->model('Currency_model','MCurrency');
    }
    public function get_currency($params=NULL) {
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
            if (isset($params['currency_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.currency_id LIKE '%" . $params['currency_id'] . "%' ";
                } else {
                    $query_string = "c.currency_id LIKE '%" . $params['currency_id'] . "%' ";
                }
            }
            if (isset($params['currency_name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.currency_name LIKE '%" . $params['currency_name'] . "%' ";
                } else {
                    $query_string = "c.currency_name LIKE '%" . $params['currency_name'] . "%' ";
                }
            }
            if (isset($params['currency_abbr'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.currency_abbr LIKE '%" . $params['currency_abbr'] . "%' ";
                } else {
                    $query_string = "c.currency_abbr LIKE '%" . $params['currency_abbr'] . "%' ";
                }
            }
        } else if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['currency_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.currency_id = '" . $params['currency_id'] . "' ";
                } else {
                    $query_string = "c.currency_id = '" . $params['currency_id'] . "' ";
                }
            }
            if (isset($params['currency_name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.currency_name = '" . $params['currency_name'] . "' ";
                } else {
                    $query_string = "c.currency_name = '" . $params['currency_name'] . "%' ";
                }
            }
            if (isset($params['currency_abbr'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.currency_abbr = '" . $params['currency_abbr'] . "' ";
                } else {
                    $query_string = "c.currency_abbr = '" . $params['currency_abbr'] . "' ";
                }
            }
        }
//        dev_export($query_string);die;
        $currency_list = $this->MCurrency->get_currency_list($apikey, $query_string);
        if (!empty($currency_list) && is_array($currency_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $currency_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
        
    }
    public function save_currency($params=NULL) {
           $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['currency_name']) && !empty($params['currency_name'])) {
            $dbparams[1] = $params['currency_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Currency Name is required', 'data' => FALSE);
        }
        if (isset($params['currency_abbr']) && !empty($params['currency_abbr'])) {
            $dbparams[2] = $params['currency_abbr'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Currency Abbrevation is required', 'data' => FALSE);
        }
        $currency_add_status = $this->MCurrency->add_new_currency($dbparams);
        if (!empty($currency_add_status) && is_array($currency_add_status) && $currency_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('currency_id' => $currency_add_status['currency_id']));
        } else {
            if (is_array($currency_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $currency_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }
    public function update_currency($params=NULL) {
       $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['currency_id']) && !empty($params['currency_id'])) {
            $dbparams[1] = $params['currency_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Currency ID is required', 'data' => FALSE);
        }
        if (isset($params['currency_name']) && !empty($params['currency_name'])) {
            $dbparams[2] = $params['currency_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Currency Name is required', 'data' => FALSE);
        }
        if (isset($params['currency_abbr']) && !empty($params['currency_abbr'])) {
            $dbparams[3] = $params['currency_abbr'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Currency Abbrevation is required', 'data' => FALSE);
        }
        $dbparams[4] = 1;
        $dbparams[5] = 0;
        $currency_add_status = $this->MCurrency->update_currency_data($dbparams);
        if (!empty($currency_add_status) && is_array($currency_add_status) && isset($currency_add_status['ErrorStatus']) && $currency_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $currency_add_status);
        } else {
                if(isset($currency_add_status['ErrorMessage']) && !empty($currency_add_status['ErrorMessage'])) {
                     return array('data_status' => 0, 'error_status' => 1, 'message' => $currency_add_status['ErrorMessage'], 'data' => FALSE);
                 } else {
                     return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }
    public function modify_currency_status($params=NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['currency_id']) && !empty($params['currency_id'])) {
            $dbparams[1] = $params['currency_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Currency ID is required', 'data' => FALSE);
        }
        $dbparams[2] = NULL;
        $dbparams[3] = NULL;
       
        $dbparams[4] = 0;
        
        if (isset($params['status']) )  {
            $dbparams[5] = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Currency Status is required', 'data' => FALSE);
        }
        
        $currency_add_status = $this->MCurrency->update_currency_data($dbparams);
        if (!empty($currency_add_status) && is_array($currency_add_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $currency_add_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data update failed', 'data' => FALSE);
        }
    } 
    
}
