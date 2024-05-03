<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Spareparts_controller
 *
 * @author chandrajith.edsys
 */
class Conductor_controller extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Conductor_model', 'Conmod');
    }

    public function get_conductors($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution Id is required', 'data' => FALSE);
        }

        $conductor_data = $this->Conmod->get_conductor_data($dbparams);
        if (!empty($conductor_data) && is_array($conductor_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $conductor_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }


    public function save_conductor($params = NULL)
    {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['name']) && !empty($params['name'])) {
            $dbparams[1] = $params['name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Conductor name required', 'data' => FALSE);
        }
        if (isset($params['mobile']) && !empty($params['mobile'])) {
            $dbparams[2] = $params['mobile'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Mobile No required', 'data' => FALSE);
        }
        if (isset($params['password']) && !empty($params['password'])) {
            $dbparams[3] = $params['password'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Password Is required', 'data' => FALSE);
        }
        if (isset($params['Inst_id']) && !empty($params['Inst_id'])) {
            $dbparams[4] = $params['Inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Instut id are required', 'data' => FALSE);
        }
        //        return $dbparams;
        $conductor_add_status = $this->Conmod->add_new_conductor($dbparams);
        if (!empty($conductor_add_status) && is_array($conductor_add_status) && $conductor_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $conductor_add_status['id']));
        } else {
            if (is_array($conductor_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $conductor_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function get_particularconductor($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['cid']) && !empty($params['cid'])) {
            $dbparams[1] = $params['cid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Conductor  Id is required', 'data' => FALSE);
        }

        $conductor_list = $this->Conmod->get_conductor_particular($dbparams);
        if (!empty($conductor_list) && is_array($conductor_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $conductor_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }


    public function update_conductor($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        //        $dbparams[1] = 1;
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = $params['id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Conductor ID is required', 'data' => FALSE);
        }
        if (isset($params['name']) && !empty($params['name'])) {
            $dbparams[2] = $params['name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Conductor name required', 'data' => FALSE);
        }
        if (isset($params['mobile']) && !empty($params['mobile'])) {
            $dbparams[3] = $params['mobile'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Mobile No required', 'data' => FALSE);
        }
        if (isset($params['paswd']) && !empty($params['paswd'])) {
            $dbparams[4] = $params['paswd'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Password Is required', 'data' => FALSE);
        }
        $dbparams[5] = 1;
        $dbparams[6] = 0;
        $conductor_update_status = $this->Conmod->update_conductor_data($dbparams);
        if (!empty($conductor_update_status) && is_array($conductor_update_status) && isset($conductor_update_status['ErrorStatus']) && $conductor_update_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $conductor_update_status);
        } else {
            if (isset($conductor_update_status['ErrorMessage']) && !empty($conductor_update_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $conductor_update_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }

    public function update_conductor_password($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['conductor_id']) && !empty($params['conductor_id'])) {
            $dbparams[1] = $params['conductor_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Conductor ID is required', 'data' => FALSE);
        }
        $dbparams[2] = 0;
        //$dbparams[3] = 0;
        if (isset($params['old_password']) && !empty($params['old_password'])) {
            $dbparams[3] = $params['old_password'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Old Password is required', 'data' => FALSE);
        }
        if (isset($params['new_password']) && !empty($params['new_password'])) {
            $dbparams[4] = $params['new_password'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Old Password is required', 'data' => FALSE);
        }
        $dbparams[5] = 2; //flag
        $dbparams[6] = 0;
        $conductor_update_status = $this->Conmod->update_conductor_data($dbparams);
        if (!empty($conductor_update_status) && is_array($conductor_update_status) && isset($conductor_update_status['ErrorStatus']) && $conductor_update_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $conductor_update_status);
        } else {
            if (isset($conductor_update_status['ErrorMessage']) && !empty($conductor_update_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $conductor_update_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }


    public function modify_conductor_status($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['CId']) && !empty($params['CId'])) {
            $dbparams[1] = $params['CId'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Conductor ID is required', 'data' => FALSE);
        }
        $dbparams[2] = NULL;
        $dbparams[3] = NULL;
        $dbparams[4] = NULL;


        $dbparams[5] = $params['flag'];
        if (isset($params['status'])) {
            $dbparams[6] = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Conductor Status is required', 'data' => FALSE);
        }

        $conductor_modify_status = $this->Conmod->update_conductor_data($dbparams);
        if (!empty($conductor_modify_status['ErrorStatus']) && is_array($conductor_modify_status) && $conductor_modify_status['ErrorStatus'] == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => $conductor_modify_status['ErrorMessage'], 'data' => FALSE);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => $conductor_modify_status['ErrorMessage'], 'data' => TRUE);
        }
    }

    public function get_employee($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution Id is required', 'data' => FALSE);
        }

        $emp_data = $this->Conmod->get_employee_data($dbparams);
        if (!empty($emp_data) && is_array($emp_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $emp_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_select_emp($params = NULL)
    {
        // return $params;
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['C_id']) && !empty($params['C_id'])) {
            $dbparams[1] = $params['C_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Conductor Id  required', 'data' => FALSE);
        }

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }

        $emp_data = $this->Conmod->get_select_employee($dbparams);
        if (!empty($emp_data) && is_array($emp_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $emp_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
}
