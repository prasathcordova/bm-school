<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Academicyr_controller
 *
 * @author docme2
 */
class Academicyr_controller extends MX_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('Academicyr_model', 'MAcademic');
    }
    
    public function get_academicyr($params = NULL) {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "acd.isactive = " . $params['status'];
        }
        if (isset($params['acd_id'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "acd.acd_id LIKE '%" . $params['acd_id'] . "%' ";
            } else {
                $query_string = "acd.acd_id LIKE '%" . $params['acd_id'] . "%' ";
            }
        }
        if (isset($params['frm_yr'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "acd.frm_yr LIKE '%" . $params['frm_yr'] . "%' ";
            } else {
                $query_string = "acd.frm_yr LIKE '%" . $params['frm_yr'] . "%' ";
            }
        }

        if (isset($params['to_yr'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "acd.to_yr LIKE '%" . $params['to_yr'] . "%' ";
            } else {
                $query_string = "acd.to_yr LIKE '%" . $params['to_yr'] . "%'";
            }
        }
        if (isset($params['descriptn'])) {
            if (strlen($query_string) > 0) {
                $query_string = $query_string . " AND " . "acd.descriptn LIKE '%" . $params['descriptn'] . "%' ";
            } else {
                $query_string = "acd.descriptn LIKE '%" . $params['descriptn'] . "%'";
            }
        }

        $academic_list = $this->MAcademic->get_acdyr_details($apikey, $query_string);
//        dev_export($academic_list);die;
        if (!empty($academic_list) && is_array($academic_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $academic_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    
    
     public function save_academicyr($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['fromyr']) && !empty($params['fromyr'])) {
            $dbparams[1] = $params['fromyr'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'From Year is required', 'data' => FALSE);
        }
        if (isset($params['toyr']) && !empty($params['toyr'])) {
            $dbparams[2] = $params['toyr'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'To Year is required', 'data' => FALSE);
        }
        if (isset($params['descrtn']) && !empty($params['descrtn'])) {
            $dbparams[3] = $params['descrtn'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Description is required', 'data' => FALSE);
        }
        $academicyr_add_status = $this->MAcademic->add_new_academicyr($dbparams);
        if (!empty($academicyr_add_status) && is_array($academicyr_add_status) && $academicyr_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('acd_id' => $academicyr_add_status['acd_id']));
        } else {
            if (is_array($academicyr_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $academicyr_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }
    
     public function update_academicyr($params = NULL) {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['acd_id']) && !empty($params['acd_id'])) {
            $dbparams[1] = $params['acd_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic ID is required', 'data' => FALSE);
        }
        if (isset($params['frmyr']) && !empty($params['frmyr'])) {
            $dbparams[2] = $params['frmyr'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'From Year is required', 'data' => FALSE);
        }
        if (isset($params['toyr']) && !empty($params['toyr'])) {
            $dbparams[3] = $params['toyr'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'To Year is required', 'data' => FALSE);
        }
        if (isset($params['descriptn']) && !empty($params['descriptn'])) {
            $dbparams[4] = $params['descriptn'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Description is required', 'data' => FALSE);
        }
        $dbparams[5] = 1;
        $dbparams[6] = 0;
        $acdyr_add_status = $this->MAcademic->update_acdyr_data($dbparams);
        if (!empty($acdyr_add_status) && is_array($acdyr_add_status) && isset($acdyr_add_status['ErrorStatus']) && $acdyr_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $acdyr_add_status);
        } else {
             if(isset($acdyr_add_status['ErrorMessage']) && !empty($acdyr_add_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $acdyr_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }
}
