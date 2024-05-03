<?php

/**
 *  Fee_penalty_controller
 *
 * @author aju.docme
 */
class Fee_penalty_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Fee_penalty_model', 'MPenalty');
    }

    public function get_fee_code($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "fc.isActive = " . $params['status'];
        }

        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }


        if (strcasecmp($mode, "search") == 0) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "fc.id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "fc.id = '" . $params['id'] . "' ";
                }
            }
            if (isset($params['inst_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "fc.inst_id = '" . $params['inst_id'] . "' ";
                } else {
                    $query_string = "fc.inst_id = '" . $params['inst_id'] . "' ";
                }
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution data is required.', 'data' => FALSE);
            }
            if (isset($params['feeCode'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "fc.feeCode LIKE '%" . $params['feeCode'] . "%' ";
                } else {
                    $query_string = "fc.feeCode LIKE '%" . $params['feeCode'] . "%' ";
                }
            }
        } else if (strcasecmp($mode, "strict" == 0)) {
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "fc.id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "fc.id = '" . $params['id'] . "' ";
                }
            }
            if (isset($params['inst_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "fc.inst_id = '" . $params['inst_id'] . "' ";
                } else {
                    $query_string = "fc.inst_id = '" . $params['inst_id'] . "' ";
                }
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution data is required.', 'data' => FALSE);
            }
            if (isset($params['feeCode'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "fc.feeCode = '" . $params['feeCode'] . "' ";
                } else {
                    $query_string = "fc.feeCode = '" . $params['feeCode'] . "' ";
                }
            }
            if (isset($params['description'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "fc.description = '" . $params['description'] . "' ";
                } else {
                    $query_string = "fc.description = '" . $params['description'] . "' ";
                }
            }
            if (isset($params['demand_type'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "fc.demandType = '" . $params['demand_type'] . "' ";
                } else {
                    $query_string = "fc.demandType = '" . $params['demand_type'] . "' ";
                }
            }
        }

        $fee_code = $this->MPenalty->get_fee_code_details($apikey, $query_string);
        if (!empty($fee_code) && is_array($fee_code)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $fee_code);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_feecodes_for_penalty($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. ID is required', 'data' => FALSE);
        }
        $dbparams[2] = 0;
        $dbparams[3] = '';
        $dbparams[4] = '';
        $dbparams[5] = '';
        $dbparams[6] = 4; //FEE CODE LIST
        $fee_code = $this->MPenalty->get_feecodes_for_penalty($dbparams);
        if (!empty($fee_code) && is_array($fee_code)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $fee_code);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_all_penalty_data($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. ID is required', 'data' => FALSE);
        }
        $dbparams[2] = 0;
        $dbparams[3] = '';
        $dbparams[4] = '';
        $dbparams[5] = '';
        $dbparams[6] = 3; //PENALTY LIST
        $fee_code = $this->MPenalty->get_all_penalty_data($dbparams);
        if (!empty($fee_code) && is_array($fee_code)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $fee_code);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_penalty_data($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. ID is required', 'data' => FALSE);
        }
        $dbparams[2] = $params['penalty_id']; //this is for penalty id in edit
        $dbparams[3] = '';
        $dbparams[4] = '';
        $dbparams[5] = '';
        $dbparams[6] = 5; //Edit Screen
        $fee_code = $this->MPenalty->get_penalty_data($dbparams);
        if (!empty($fee_code) && is_array($fee_code)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $fee_code);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function save_penalty($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. ID is required', 'data' => FALSE);
        }
        if (isset($params['fee_code']) && !empty($params['fee_code'])) {
            $dbparams[2] = $params['fee_code'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Fee Code required', 'data' => FALSE);
        }
        if (isset($params['penalty_type']) && !empty($params['penalty_type'])) {
            $dbparams[3] = $params['penalty_type'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Penalty Type required', 'data' => FALSE);
        }
        if (isset($params['effectdate']) && !empty($params['effectdate'])) {
            $dbparams[4] = $params['effectdate'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Effect Date required', 'data' => FALSE);
        }
        $dbparams[5] = $params['penalty_array'];
        $dbparams[6] = 1; //save

        $penalty_save_status = $this->MPenalty->manage_penalty($dbparams);
        //return $penalty_save_status;
        //        dev_export($penalty_save_status);die;
        if (!empty($penalty_save_status) && is_array($penalty_save_status) && $penalty_save_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $penalty_save_status['id']));
        } else {
            if (is_array($penalty_save_status)) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $penalty_save_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }
    public function update_penalty($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. ID is required', 'data' => FALSE);
        }
        if (isset($params['fee_code']) && !empty($params['fee_code'])) {
            $dbparams[2] = $params['fee_code'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Fee Code required', 'data' => FALSE);
        }
        if (isset($params['penalty_type']) && !empty($params['penalty_type'])) {
            $dbparams[3] = $params['penalty_type'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Penalty Type required', 'data' => FALSE);
        }
        if (isset($params['effectdate']) && !empty($params['effectdate'])) {
            $dbparams[4] = $params['effectdate'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Effect Date required', 'data' => FALSE);
        }
        $dbparams[5] = $params['penalty_array'];
        $dbparams[6] = 2; //update

        $penalty_save_status = $this->MPenalty->manage_penalty($dbparams);
        //        dev_export($penalty_save_status);die;
        if (!empty($penalty_save_status) && is_array($penalty_save_status) && $penalty_save_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $penalty_save_status['id']));
        } else {
            if (is_array($penalty_save_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $penalty_save_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }
    public function change_penalty_status($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. ID is required', 'data' => FALSE);
        }
        if (isset($params['fee_penalty_id']) && !empty($params['fee_penalty_id'])) {
            $dbparams[2] = $params['fee_penalty_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Penalty required', 'data' => FALSE);
        }
        if ($params['status'] == 1) $stt = 'Y';
        else $stt = 'N';
        $dbparams[3] = $stt;
        $dbparams[4] = '';
        $dbparams[5] = '';
        $dbparams[6] = 6; //Change Status

        $penalty_save_status = $this->MPenalty->manage_penalty($dbparams);
        //        dev_export($penalty_save_status);die;
        if (!empty($penalty_save_status) && is_array($penalty_save_status) && $penalty_save_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Status Changed successfully', 'data' => array('id' => $penalty_save_status['id']));
        } else {
            if (is_array($penalty_save_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $penalty_save_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Status Changing failed', 'data' => FALSE);
            }
        }
    }

    public function modify_penalty_save_status($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 0; //flag    
        if (isset($params['status'])) {
            if ($params['status'] == -1) {
                $dbparams[2] = 0;
            } else {
                $dbparams[2] = $params['status'];
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Demand frequency status is required', 'data' => FALSE);
        }
        if (isset($params['fee_code_id']) && !empty($params['fee_code_id'])) {
            $dbparams[3] = $params['fee_code_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'ID is required', 'data' => FALSE);
        }
        $dbparams[4] = NULL;
        $dbparams[5] = NULL;
        $dbparams[6] = 0;
        $dbparams[7] = 0;
        $dbparams[8] = 0;
        $dbparams[9] = 0;
        $dbparams[10] = NULL;
        $dbparams[11] = 0;
        $dbparams[12] = 0;
        $dbparams[13] = 0;
        $dbparams[14] = 0;



        $demand_freq_update_status = $this->MPenalty->update_fee_code_data($dbparams);
        if (!empty($demand_freq_update_status['ErrorStatus']) && is_array($demand_freq_update_status) && $demand_freq_update_status['ErrorStatus'] == 1) {
            if (isset($demand_freq_update_status['ErrorMessage']) && !empty($demand_freq_update_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $demand_freq_update_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data updation failed. Please try again later', 'data' => FALSE);
            }
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Status updated successfully', 'data' => TRUE);
        }
    }
}
