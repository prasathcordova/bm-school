<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Insurance_controller
 *
 * @author chandrajith.edsys
 */
class Insurance_controller extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Insurance_model', 'MImodel');
    }
    public function get_insurance($params = NULL)
    {
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
            $query_string = "1=1";
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "c.id = '" . $params['id'] . "' ";
                }
            }
            if (isset($params['insuranceName'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.insuranceName LIKE '%" . $params['insuranceName'] . "%' ";
                } else {
                    $query_string = "c.insuranceName LIKE '%" . $params['insuranceName'] . "%' ";
                }
            }
            if (isset($params['desc'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.insuranceDescription LIKE '%" . $params['desc'] . "%' ";
                } else {
                    $query_string = "c.insuranceDescription LIKE '%" . $params['desc'] . "%' ";
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
            if (isset($params['insuranceName'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.insuranceName = '" . $params['insuranceName'] . "' ";
                } else {
                    $query_string = "c.insuranceName = '" . $params['insuranceName'] . "' ";
                }
            }
            if (isset($params['desc'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.insuranceDescription = '" . $params['desc'] . "' ";
                } else {
                    $query_string = "c.insuranceDescription = '" . $params['desc'] . "' ";
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


        $insurance_list = $this->MImodel->get_insurance_details($apikey, $query_string);
        if (!empty($insurance_list) && is_array($insurance_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $insurance_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_insurance($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['insurancename']) && !empty($params['insurancename'])) {
            $dbparams[1] = $params['insurancename'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Insurance Company Name is required', 'data' => FALSE);
        }
        if (isset($params['desc']) && !empty($params['desc'])) {
            $dbparams[2] = $params['desc'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Insurance Description is required', 'data' => FALSE);
        }



        $insurance_add_status = $this->MImodel->add_new_insurance($dbparams);
        if (!empty($insurance_add_status) && is_array($insurance_add_status) && $insurance_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $insurance_add_status['id']));
        } else {
            if (is_array($insurance_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $insurance_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function update_insurance($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = intval($params['id']);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Insurance Id is required', 'data' => FALSE);
        }
        if (isset($params['insurancename']) && !empty($params['insurancename'])) {
            $dbparams[2] = $params['insurancename'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Insurance Company Name is required', 'data' => FALSE);
        }
        if (isset($params['desc']) && !empty($params['desc'])) {
            $dbparams[3] = $params['desc'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Insurance Description is required', 'data' => FALSE);
        }




        $dbparams[4] = 1;
        $dbparams[5] = 0;

        $insurance_update_status = $this->MImodel->update_insurance($dbparams);

        if (!empty($insurance_update_status) && is_array($insurance_update_status) && isset($insurance_update_status['ErrorStatus']) && $insurance_update_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $insurance_update_status);
        } else {
            if (isset($insurance_update_status['ErrorMessage']) && !empty($insurance_update_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $insurance_update_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }

    public function modify_insurance_status($params = NULL)
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

        $dbparams[4] = 0;
        if (isset($params['status'])) {
            if ($params['status'] == -1) {
                $dbparams[5] = 0;
            } else {
                $dbparams[5] = $params['status'];
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Insurace details Status is required', 'data' => FALSE);
        }

        $insurance_modify_status = $this->MImodel->update_insurance($dbparams);
        if (!empty($insurance_modify_status['ErrorStatus']) && is_array($insurance_modify_status) && $insurance_modify_status['ErrorStatus'] == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => $insurance_modify_status['ErrorMessage'], 'data' => FALSE);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => $insurance_modify_status['ErrorMessage'], 'data' => TRUE);
        }
    }
}
