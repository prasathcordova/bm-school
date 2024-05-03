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
class Driver_controller extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Driver_model', 'Drivmod');
    }

    public function get_driver($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution Id is required', 'data' => FALSE);
        }

        $driver_data = $this->Drivmod->get_driver_data($dbparams);
        if (!empty($driver_data) && is_array($driver_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $driver_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }


    public function save_driver($params = NULL)
    {
        // return $params;
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['name']) && !empty($params['name'])) {
            $dbparams[1] = $params['name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Driver name required', 'data' => FALSE);
        }
        if (isset($params['veh_no']) && !empty($params['veh_no'])) {
            $dbparams[2] = $params['veh_no'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle No required', 'data' => FALSE);
        }
        if (isset($params['startdate']) && !empty($params['startdate'])) {
            $dbparams[3] = $params['startdate'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Start Date Is required', 'data' => FALSE);
        }
        if (isset($params['enddate']) && !empty($params['enddate'])) {
            $dbparams[4] = $params['enddate'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'End Date Is required', 'data' => FALSE);
        }
        if (isset($params['Inst_id']) && !empty($params['Inst_id'])) {
            $dbparams[5] = $params['Inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Instut id are required', 'data' => FALSE);
        }
        //        return $dbparams;
        $driver_add_status = $this->Drivmod->add_new_driver($dbparams);
        // return $driver_add_status;
        if (!empty($driver_add_status) && is_array($driver_add_status) && $driver_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $driver_add_status['id']));
        } else {
            if (is_array($driver_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $driver_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function get_particulardriver($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['did']) && !empty($params['did'])) {
            $dbparams[1] = $params['did'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Driver  Id is required', 'data' => FALSE);
        }

        $driver_list = $this->Drivmod->get_driver_particular($dbparams);
        if (!empty($driver_list) && is_array($driver_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $driver_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }


    public function update_driver($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        //        $dbparams[1] = 1;
        // if (isset($params['id']) && !empty($params['id'])) {
        //     $dbparams[1] = $params['id'];
        // } else {
        //     return array('data_status' => 0, 'error_status' => 1, 'message' => 'ID is required', 'data' => FALSE);
        // }
        if (isset($params['driver_name']) && !empty($params['driver_name'])) {
            $dbparams[1] = $params['driver_name'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Driver name required', 'data' => FALSE);
        }
        if (isset($params['vehicle_no']) && !empty($params['vehicle_no'])) {
            $dbparams[2] = $params['vehicle_no'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle No required', 'data' => FALSE);
        }
        // if (isset($params['start_date']) && !empty($params['start_date'])) {
        //     $dbparams[4] = $params['start_date'];
        // } else {
        //     return array('data_status' => 0, 'error_status' => 1, 'message' => 'Start Date Is required', 'data' => FALSE);
        // }
        // if (isset($params['enddate']) && !empty($params['enddate'])) {
        //     $dbparams[5] = $params['enddate'];
        // } else {
        //     return array('data_status' => 0, 'error_status' => 1, 'message' => 'End Date Is required', 'data' => FALSE);
        // }
        $dbparams[3] = 1;
        $dbparams[4] = 0;
        $driver_update_status = $this->Drivmod->update_driver_data($dbparams);
        if (!empty($driver_update_status) && is_array($driver_update_status) && isset($driver_update_status['ErrorStatus']) && $driver_update_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $driver_update_status);
        } else {
            if (isset($driver_update_status['ErrorMessage']) && !empty($driver_update_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $driver_update_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }


    public function modify_driver_status($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['drivId']) && !empty($params['drivId'])) {
            $dbparams[1] = $params['drivId'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Driver ID is required', 'data' => FALSE);
        }
        $dbparams[2] = NULL;
        $dbparams[3] = NULL;
        $dbparams[4] = NULL;
        $dbparams[5] = NULL;
        $dbparams[6] = $params['flag'];
        if (isset($params['status'])) {
            $dbparams[7] = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Driver Status is required', 'data' => FALSE);
        }

        $driver_modify_status = $this->Drivmod->update_driver_data($dbparams);
        // return $driver_modify_status;
        if (!empty($driver_modify_status['ErrorStatus']) && is_array($driver_modify_status) && $driver_modify_status['ErrorStatus'] == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => $driver_modify_status['ErrorMessage'], 'data' => FALSE);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => $driver_modify_status['ErrorMessage'], 'data' => TRUE);
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

        $emp_data = $this->Drivmod->get_employee_data($dbparams);
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

    public function get_vehiclereg_for_driver($params = null)
    {

        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['Inst_Id']) && !empty($params['Inst_Id'])) {
            $dbparams[1] = $params['Inst_Id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution Id is required', 'data' => FALSE);
        }

        $vehicle_data = $this->Drivmod->get_vehicle_data($dbparams);
        if (!empty($vehicle_data) && is_array($vehicle_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $vehicle_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
}
