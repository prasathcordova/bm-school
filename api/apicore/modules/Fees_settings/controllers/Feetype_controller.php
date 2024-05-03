<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Feetype_controller
 *
 * @author chandrajith.edsys
 */
class Feetype_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Feetype_model', 'MFtype');
    }

    public function get_fee_type($params = NULL) {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "c.isActive = " . $params['status'];
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
            if (isset($params['feeTypeName'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.feeTypeName LIKE '%" . $params['feeTypeName'] . "%' ";
                } else {
                    $query_string = "c.feeTypeName LIKE '%" . $params['feeTypeName'] . "%' ";
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
            if (isset($params['inst_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.instId = '" . $params['inst_id'] . "' ";
                } else {
                    $query_string = "c.instId = '" . $params['inst_id'] . "' ";
                }
            }
            if (isset($params['feeTypeName'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.feeTypeName = '" . $params['feeTypeName'] . "' ";
                } else {
                    $query_string = "c.feeTypeName = '" . $params['feeTypeName'] . "' ";
                }
            }
        }

        $feetype_list = $this->MFtype->get_feetype_details($apikey, $query_string);
        if (!empty($feetype_list) && is_array($feetype_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $feetype_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_feetype($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['feeTypeName']) && !empty($params['feeTypeName'])) {
            $dbparams[1] = $params['feeTypeName'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Fee Type is required', 'data' => FALSE);
        }

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. ID is required', 'data' => FALSE);
        }

        $feetype_add_status = $this->MFtype->add_new_feetype($dbparams);
        if (!empty($feetype_add_status) && is_array($feetype_add_status) && $feetype_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $feetype_add_status['id']));
        } else {
            if (is_array($feetype_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $feetype_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function update_feetype($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = intval($params['id']);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Fee Type Id is required', 'data' => FALSE);
        }
        if (isset($params['feeTypeName']) && !empty($params['feeTypeName'])) {
            $dbparams[2] = $params['feeTypeName'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Fee Type Name is required', 'data' => FALSE);
        }

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[3] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution data is required', 'data' => FALSE);
        }

        $dbparams[4] = 1;
        $dbparams[5] = 0;

        $feetype_update_status = $this->MFtype->update_feetype_data($dbparams);

        if (!empty($feetype_update_status) && is_array($feetype_update_status) && isset($feetype_update_status['ErrorStatus']) && $feetype_update_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $feetype_update_status);
        } else {
            if (isset($feetype_update_status['ErrorMessage']) && !empty($feetype_update_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $feetype_update_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }

    public function modify_feetype_status($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = $params['id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'ID is required', 'data' => FALSE);
        }
        $dbparams[2] = NULL;
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[3] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. ID is required', 'data' => FALSE);
        }
        
        
        //$dbparams[3] = NULL;
        $dbparams[4] = 0;

        if (isset($params['status'])) {
            if ($params['status'] == -1) {
                $dbparams[5] = 0;
            } else {
                $dbparams[5] = $params['status'];
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Fee type Status is required', 'data' => FALSE);
        }

        $accountcode_add_status = $this->MFtype->update_feetype_data($dbparams);
        if (!empty($accountcode_add_status['ErrorStatus']) && is_array($accountcode_add_status) && $accountcode_add_status['ErrorStatus'] == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => $accountcode_add_status['ErrorMessage'], 'data' => FALSE);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => $accountcode_add_status['ErrorMessage'], 'data' => TRUE);
        }
    }

}
