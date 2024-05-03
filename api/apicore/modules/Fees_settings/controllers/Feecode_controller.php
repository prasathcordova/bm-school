<?php

/**
 *  Controls fee code data
 *
 * @author aju.docme
 */
class Feecode_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Feecode_model', 'MFeecode');
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

        $fee_code = $this->MFeecode->get_fee_code_details($apikey, $query_string);
        if (!empty($fee_code) && is_array($fee_code)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $fee_code);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_linked_fee_code($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $inst_id = $params['inst_id'];
        $student_id = $params['student_id'];

        $fee_code = $this->MFeecode->get_linked_fee_code_details($apikey, $inst_id, $student_id);
        if (!empty($fee_code) && is_array($fee_code)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $fee_code);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function save_fee_code($params = NULL)
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
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Fee code name is required', 'data' => FALSE);
        }
        if (isset($params['desc']) && !empty($params['desc'])) {
            $dbparams[3] = $params['desc'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Description is required', 'data' => FALSE);
        }
        if (isset($params['feeTypeId']) && !empty($params['feeTypeId'])) {
            $dbparams[4] = $params['feeTypeId'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Fee type ID is required', 'data' => FALSE);
        }
        if (isset($params['demandFrequencyId']) && !empty($params['demandFrequencyId'])) {
            $dbparams[5] = $params['demandFrequencyId'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Demand frequency ID is required', 'data' => FALSE);
        }
        if (isset($params['accountCodeId']) && !empty($params['accountCodeId'])) {
            $dbparams[6] = $params['accountCodeId'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Account code ID is required', 'data' => FALSE);
        }
        if (isset($params['dueDate']) && !empty($params['dueDate'])) {
            $dbparams[7] = $params['dueDate'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Due date is required', 'data' => FALSE);
        }
        if (isset($params['demandType']) && !empty($params['demandType'])) {
            $dbparams[8] = $params['demandType'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Demand type is required', 'data' => FALSE);
        }
        if (isset($params['is_vat']) && !empty($params['is_vat'])) {
            if ($params['is_vat'] == -1) {
                $dbparams[9] = 0;
                $dbparams[10] = 0;
            } else {
                $dbparams[9] = 1;
                $dbparams[10] = $params['vat'];
            }
        } else {
            $dbparams[9] = 0;
            $dbparams[10] = 0;
        }
        if (isset($params['fee_shortcode']) && !empty($params['fee_shortcode'])) {
            $dbparams[11] = $params['fee_shortcode'];
        } else {
            $dbparams[11] = substr($params['fee_shortcode'], 0, 3);
        }


        $fee_code_status = $this->MFeecode->add_new_fee_code($dbparams);
        //        dev_export($fee_code_status);die;
        if (!empty($fee_code_status) && is_array($fee_code_status) && $fee_code_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $fee_code_status['id']));
        } else {
            if (is_array($fee_code_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $fee_code_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function update_fee_code($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 1; //flag
        $dbparams[2] = 0; //status
        if (isset($params['fee_code_id']) && !empty($params['fee_code_id'])) {
            $dbparams[3] = intval($params['fee_code_id']);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Fee code Id is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[4] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution data is required', 'data' => FALSE);
        }
        if (isset($params['fee_code']) && !empty($params['fee_code'])) {
            $dbparams[5] = $params['fee_code'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Fee code name is required', 'data' => FALSE);
        }
        if (isset($params['desc']) && !empty($params['desc'])) {
            $dbparams[6] = $params['desc'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Description is required', 'data' => FALSE);
        }
        if (isset($params['feeTypeId']) && !empty($params['feeTypeId'])) {
            $dbparams[7] = $params['feeTypeId'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Fee type ID is required', 'data' => FALSE);
        }
        if (isset($params['demandFrequencyId']) && !empty($params['demandFrequencyId'])) {
            $dbparams[8] = $params['demandFrequencyId'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Demand frequency ID is required', 'data' => FALSE);
        }
        if (isset($params['accountCodeId']) && !empty($params['accountCodeId'])) {
            $dbparams[9] = $params['accountCodeId'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Account code ID is required', 'data' => FALSE);
        }
        if (isset($params['dueDate']) && !empty($params['dueDate'])) {
            $dbparams[10] = $params['dueDate'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Due date is required', 'data' => FALSE);
        }
        if (isset($params['demandType']) && !empty($params['demandType'])) {
            $dbparams[11] = $params['demandType'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Demand type is required', 'data' => FALSE);
        }
        if (isset($params['is_vat']) && !empty($params['is_vat'])) {
            if ($params['is_vat'] == -1) {
                $dbparams[12] = 0;
                $dbparams[13] = 0;
            } else {
                $dbparams[12] = 1;
                $dbparams[13] = $params['vat'];
            }
        } else {
            $dbparams[12] = 0;
            $dbparams[13] = 0;
        }
        if (isset($params['fee_shortcode']) && !empty($params['fee_shortcode'])) {
            $dbparams[14] = $params['fee_shortcode'];
        } else {
            $dbparams[14] = substr($params['fee_shortcode'], 0, 3);
        }
        $dbparams[15] = $params['acd_year_id'];


        $fee_code_update_status = $this->MFeecode->update_fee_code_data($dbparams);

        if (!empty($fee_code_update_status) && is_array($fee_code_update_status) && isset($fee_code_update_status['ErrorStatus']) && $fee_code_update_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $fee_code_update_status);
        } else {
            if (isset($fee_code_update_status['ErrorMessage']) && !empty($fee_code_update_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $fee_code_update_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }

    public function modify_fee_code_status($params = NULL)
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



        $demand_freq_update_status = $this->MFeecode->update_fee_code_data($dbparams);
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

    public function approve_or_reject_fee_code($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = 2; //flag    
        if (isset($params['status'])) {
            if ($params['status'] == -1) {
                $dbparams[2] = 0;
            } else {
                $dbparams[2] = $params['status'];
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Demand frequency approval status is required', 'data' => FALSE);
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



        $demand_freq_update_status = $this->MFeecode->update_fee_code_data($dbparams);
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
