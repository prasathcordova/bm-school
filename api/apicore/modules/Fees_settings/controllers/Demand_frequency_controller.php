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
class Demand_frequency_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Demand_frequency_model', 'MDemandFrequency');
    }

    public function get_demand_frequency($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "c.isActive = " . $params['status'];
        }
        if ($params['nondemand'] == 2) {
            $query_string = $query_string . " AND ( " . "c.is_recurring = 1 )";
            //$query_string = $query_string . " OR " . "c.monthSpan = 1)";
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
            if (isset($params['frequencyName'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.frequencyName LIKE '%" . $params['frequencyName'] . "%' ";
                } else {
                    $query_string = "c.frequencyName LIKE '%" . $params['frequencyName'] . "%' ";
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
            if (isset($params['frequencyName'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.frequencyName = '" . $params['frequencyName'] . "' ";
                } else {
                    $query_string = "c.frequencyName = '" . $params['frequencyName'] . "' ";
                }
            }
        }

        $demand_freq = $this->MDemandFrequency->get_demand_freq_details($apikey, $query_string);
        if (!empty($demand_freq) && is_array($demand_freq)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $demand_freq);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_demand_frequency($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['frequency_name']) && !empty($params['frequency_name'])) {
            $dbparams[1] = $params['frequency_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Frequency name is required', 'data' => FALSE);
        }

        if (isset($params['monthSpan']) && !empty($params['monthSpan'])) {
            $dbparams[2] = $params['monthSpan'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Month span is required', 'data' => FALSE);
        }
        if (isset($params['is_recurring']) && !empty($params['is_recurring'])) {

            $dbparams[3] = $params['is_recurring'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Recurring status is required', 'data' => FALSE);
        }

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[4] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. ID is required', 'data' => FALSE);
        }

        $demand_freq_add_status = $this->MDemandFrequency->add_new_demand_freq($dbparams);
        if (!empty($demand_freq_add_status) && is_array($demand_freq_add_status) && $demand_freq_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $demand_freq_add_status['id']));
        } else {
            if (is_array($demand_freq_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $demand_freq_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function update_demand_frequency($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = intval($params['id']);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Demand frequency Id is required', 'data' => FALSE);
        }
        if (isset($params['frequencyName']) && !empty($params['frequencyName'])) {
            $dbparams[2] = $params['frequencyName'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Demand frequency name is required', 'data' => FALSE);
        }

        if (isset($params['monthSpan']) && !empty($params['monthSpan'])) {
            $dbparams[3] = $params['monthSpan'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Demand frequency month span is required', 'data' => FALSE);
        }

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[4] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution data is required', 'data' => FALSE);
        }

        $dbparams[5] = 1;
        $dbparams[6] = 0;
        if (isset($params['is_recurring']) && !empty($params['is_recurring'])) {
            if ($params['is_recurring'] == -1) {
                $dbparams[7] = 0;
            } else {
                $dbparams[7] = $params['is_recurring'];
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Recurring status is required', 'data' => FALSE);
        }

        $demand_freq_update_status = $this->MDemandFrequency->update_demand_frequency_data($dbparams);

        if (!empty($demand_freq_update_status) && is_array($demand_freq_update_status) && isset($demand_freq_update_status['ErrorStatus']) && $demand_freq_update_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $demand_freq_update_status);
        } else {
            if (isset($demand_freq_update_status['ErrorMessage']) && !empty($demand_freq_update_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $demand_freq_update_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }

    public function modify_demand_frequency_status($params = NULL)
    {
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

        if (isset($params['status'])) {
            if ($params['status'] == -1) {
                $dbparams[6] = 0;
            } else {
                $dbparams[6] = $params['status'];
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Demand frequency status is required', 'data' => FALSE);
        }
        $dbparams[7] = 0;

        $demand_freq_update_status = $this->MDemandFrequency->update_demand_frequency_data($dbparams);
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
