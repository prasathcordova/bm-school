<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pickuppoint_fees_controller
 *
 * @author AHB
 */
class Pickuppoint_fees_controller extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pickuppoint_fees_model', 'MPFees');
    }
    public function get_all_pickuppoint_fees($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst id is required', 'data' => FALSE);
        }
        if (isset($params['acd_year']) && !empty($params['acd_year'])) {
            $dbparams[2] = $params['acd_year'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year id is required', 'data' => FALSE);
        }

        $all_pickuppoint_fees = $this->MPFees->get_all_pickuppoint_fees($dbparams);
        if (!empty($all_pickuppoint_fees) && is_array($all_pickuppoint_fees)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $all_pickuppoint_fees);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_pickuppoint_all_fees_details($params)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst id is required', 'data' => FALSE);
        }
        if (isset($params['acd_year']) && !empty($params['acd_year'])) {
            $dbparams[2] = $params['acd_year'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year id is required', 'data' => FALSE);
        }
        if (isset($params['pickuppoint_id']) && !empty($params['pickuppoint_id'])) {
            $dbparams[3] = $params['pickuppoint_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Pickuppoint id is required', 'data' => FALSE);
        }
        $all_pickuppoint_fees = $this->MPFees->get_pickuppoint_all_fees_details($dbparams);
        if (!empty($all_pickuppoint_fees) && is_array($all_pickuppoint_fees)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $all_pickuppoint_fees);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function save_pickuppoint_fees_data($params)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst id is required', 'data' => FALSE);
        }
        if (isset($params['acd_year']) && !empty($params['acd_year'])) {
            $dbparams[2] = $params['acd_year'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year id is required', 'data' => FALSE);
        }
        if (isset($params['pickuppointId']) && !empty($params['pickuppointId'])) {
            $dbparams[3] = $params['pickuppointId'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Pickuppoint id is required', 'data' => FALSE);
        }
        if ($params['amtPay'] >= 0) {
            $dbparams[4] = $params['amtPay'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Fee Amount required', 'data' => FALSE);
        }
        if ($params['amtPay_2'] >= 0) {
            $dbparams[5] = $params['amtPay_2'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Fee Amount required', 'data' => FALSE);
        }
        if (isset($params['StartDate']) && !empty($params['StartDate'])) {
            $dbparams[6] = $params['StartDate'];
        } else {
            $dbparams[6] = date('Y-m-d');
            //return array('data_status' => 0, 'error_status' => 1, 'message' => 'Start Date is required', 'data' => FALSE);
        }

        $pickuppoint_fees_update = $this->MPFees->save_pickuppoint_fees_data($dbparams);
        if (!empty($pickuppoint_fees_update) && is_array($pickuppoint_fees_update)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $pickuppoint_fees_update);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    function get_pickuppoint_student_details($params)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst id is required', 'data' => FALSE);
        }
        if (isset($params['acd_year']) && !empty($params['acd_year'])) {
            $dbparams[2] = $params['acd_year'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic Year id is required', 'data' => FALSE);
        }
        if (isset($params['pickuppoint_id']) && !empty($params['pickuppoint_id'])) {
            $dbparams[3] = $params['pickuppoint_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Pickuppoint id is required', 'data' => FALSE);
        }
        $data = $this->MPFees->get_pickuppoint_student_details($dbparams);
        if (!empty($data) && is_array($data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
}
