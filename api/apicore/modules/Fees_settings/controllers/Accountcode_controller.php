<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Accountcode_controller
 *
 * @author chandrajith.edsys
 */
class Accountcode_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Accountcode_model', 'MAcode');
    }

    public function get_account_code($params = NULL) {
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
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "c.id = '" . $params['id'] . "' ";
                }
            }
            if (isset($params['accountCode'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.accountCode LIKE '%" . $params['accountCode'] . "%' ";
                } else {
                    $query_string = "c.accountCode LIKE '%" . $params['accountCode'] . "%' ";
                }
            }
            if (isset($params['desc'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.accountDescription LIKE '%" . $params['desc'] . "%' ";
                } else {
                    $query_string = "c.accountDescription LIKE '%" . $params['desc'] . "%' ";
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
            if (isset($params['accountCode'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.accountCode = '" . $params['accountCode'] . "' ";
                } else {
                    $query_string = "c.accountCode = '" . $params['accountCode'] . "' ";
                }
            }
            if (isset($params['desc'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.accountDescription = '" . $params['desc'] . "' ";
                } else {
                    $query_string = "c.accountDescription = '" . $params['desc'] . "' ";
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


        $accountcode_list = $this->MAcode->get_accountcode_details($apikey, $query_string);
        if (!empty($accountcode_list) && is_array($accountcode_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $accountcode_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_accountcode($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['accountcode']) && !empty($params['accountcode'])) {
            $dbparams[1] = $params['accountcode'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Account Code is required', 'data' => FALSE);
        }
        if (isset($params['accountdesc']) && !empty($params['accountdesc'])) {
            $dbparams[2] = $params['accountdesc'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Account Description is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[3] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        

        $accountcode_add_status = $this->MAcode->add_new_accountcode($dbparams);
        if (!empty($accountcode_add_status) && is_array($accountcode_add_status) && $accountcode_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $accountcode_add_status['id']));
        } else {
            if (is_array($accountcode_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $accountcode_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function update_accountcode($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = intval($params['id']);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Account Id is required', 'data' => FALSE);
        }
        if (isset($params['accountcode']) && !empty($params['accountcode'])) {
            $dbparams[2] = $params['accountcode'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Account Code is required', 'data' => FALSE);
        }
        if (isset($params['accountdesc']) && !empty($params['accountdesc'])) {
            $dbparams[3] = $params['accountdesc'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Account Description is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[4] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution data is required', 'data' => FALSE);
        }


    
        $dbparams[5] = 1;
        $dbparams[6] = 0;

        $accountcode_update_status = $this->MAcode->update_accountcode_data($dbparams);

        if (!empty($accountcode_update_status) && is_array($accountcode_update_status) && isset($accountcode_update_status['ErrorStatus']) && $accountcode_update_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $accountcode_update_status);
        } else {
            if (isset($accountcode_update_status['ErrorMessage']) && !empty($accountcode_update_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $accountcode_update_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }

    public function modify_accountcode_status($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = $params['id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'ID is required', 'data' => FALSE);
        }
        $dbparams[2] = NULL;
        $dbparams[3] = NULL;
        
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[4] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. ID is required', 'data' => FALSE);
        }
        //$dbparams[4] = NULL;
        $dbparams[5] = 0;
//        $dbparams[6] = 0;

        if (isset($params['status'])) {
            if ($params['status'] == -1) {
                $dbparams[6] = 0;
            } else {
                $dbparams[6] = $params['status'];
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Account code Status is required', 'data' => FALSE);
        }

        $accountcode_add_status = $this->MAcode->update_accountcode_data($dbparams);
        if (!empty($accountcode_add_status['ErrorStatus']) && is_array($accountcode_add_status) && $accountcode_add_status['ErrorStatus'] == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => $accountcode_add_status['ErrorMessage'], 'data' => FALSE);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => $accountcode_add_status['ErrorMessage'], 'data' => TRUE);
        }
    }

}
