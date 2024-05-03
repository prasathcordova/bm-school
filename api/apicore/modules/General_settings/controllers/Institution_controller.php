<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Institution_model
 *
 * @author Salahudheen DocMe
 */
class Institution_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Institution_model', 'MInstitution');
    }

    public function get_institution_list($params = NULL)
    {
        $apikey = $params['API_KEY'];

        $institution_list = $this->MInstitution->get_institution_list($apikey);
        if (!empty($institution_list) && is_array($institution_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $institution_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_employee_list_from_wfm($params)
    {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution ID required', 'data' => FALSE);
        }
        if (isset($params['gender']) && !empty($params['gender'])) {
            $dbparams[2] = $params['gender'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'who worked is required', 'data' => FALSE);
        }
        $dbparams[3] = NULL;
        $institution_details = $this->MInstitution->get_employee_list_from_wfm($dbparams);
        if (!empty($institution_details) && is_array($institution_details)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $institution_details);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_employee_details_from_wfm($params)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution ID required', 'data' => FALSE);
        }
        $dbparams[2] = NULL;
        if (isset($params['emp_id']) && !empty($params['emp_id'])) {
            $dbparams[3] = $params['emp_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Emp id is required', 'data' => FALSE);
        }

        $institution_details = $this->MInstitution->get_employee_list_from_wfm($dbparams);
        if (!empty($institution_details) && is_array($institution_details)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $institution_details);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_system_parameters($params)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = "get_system_parameters";
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution ID required', 'data' => FALSE);
        }
        $dbparams[3] = 0;
        $dbparams[4] = 0;
        $system_parameters = $this->MInstitution->system_parameters_operation($dbparams);
        if (!empty($system_parameters) && is_array($system_parameters)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $system_parameters);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function save_system_parameters($params)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        $dbparams[1] = "update_system_parameters";
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution ID required', 'data' => FALSE);
        }
        if (isset($params['code_value']) && !empty($params['code_value'])) {
            $dbparams[3] = $params['code_value'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Code Value is required', 'data' => FALSE);
        }
        if (isset($params['system_parameter_id']) && !empty($params['system_parameter_id'])) {
            $dbparams[4] = $params['system_parameter_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'ID required', 'data' => FALSE);
        }
        $system_parameters = $this->MInstitution->system_parameters_operation($dbparams);
        if (!empty($system_parameters) && is_array($system_parameters)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $system_parameters);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
}
