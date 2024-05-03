<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Staff_vehicle_controller
 *
 * @author chandrajith.edsys
 */
class Staff_vehicle_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Staff_vehicle_model', 'Mstaff');
    }

    public function get_staff_drivers($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }

        $drivers_list = $this->Mstaff->get_drivers($dbparams);
        if (!empty($drivers_list) && is_array($drivers_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $drivers_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_staff_cleaners($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }

        $cleaners_list = $this->Mstaff->get_cleaners($dbparams);
        if (!empty($cleaners_list) && is_array($cleaners_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $cleaners_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function get_staff_vehicle_data($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        if (isset($params['vehicleId']) && !empty($params['vehicleId'])) {
            $dbparams[1] = $params['vehicleId'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[3] = $params['id'];
        } else {
            $dbparams[3] = NULL;
        }

        $staff_data_list = $this->Mstaff->get_data_staff_vehicle($dbparams);
        if (!empty($staff_data_list) && is_array($staff_data_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $staff_data_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_vehicle_staff($params = NULL) {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['staff_data']) && !empty($params['staff_data'])) {
            $dbparams[1] = $params['staff_data'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Staff details are required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        $staff_add_status = $this->Mstaff->add_new_staff($dbparams);
        if (!empty($staff_add_status) && is_array($staff_add_status) && $staff_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $staff_add_status['id']));
        } else {
            if (is_array($staff_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $staff_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

//    public function disable_vehstaff_status($params = NULL) {
//
//        $apikey = $params['API_KEY'];
//        $dbparams = array();
//        $dbparams[0] = $params['API_KEY'];
//        if (isset($params['id']) && !empty($params['id'])) {
//            $dbparams[1] = $params['id'];
//        } else {
//            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle ID is required', 'data' => FALSE);
//        }
//        $dbparams[2] = NULL;
//        $dbparams[3] = NULL;
//        if (isset($params['status'])) {
//            $dbparams[4] = $params['status'];
//        } else {
//            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Status is required', 'data' => FALSE);
//        }
//        return $dbparams;
//        $veh_status = $this->Mstaff->update_veh_staffdata($dbparams);
//        if (!empty($veh_status) && is_array($veh_status)) {
//            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $veh_status);
//        } else {
//            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data update failed', 'data' => FALSE);
//        }
//    }

    public function disable_vehstaff_status($params = NULL) {

        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = $params['id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle staff map ID is required', 'data' => FALSE);
        }
        if (isset($params['driverid']) && !empty($params['driverid'])) {
            $dbparams[2] = $params['driverid'];
        } else {
            $dbparams[2] = NULL;
        }
        if (isset($params['cleanerid']) && !empty($params['cleanerid'])) {
            $dbparams[3] = $params['cleanerid'];
        } else {
            $dbparams[3] = NULL;
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[4] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        if (isset($params['status'])) {
            $dbparams[5] = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle staff map Status is required', 'data' => FALSE);
        }
        $dbparams[6] = $params['update_flag'];
//return $dbparams;
        $ven_status = $this->Mstaff->update_veh_staffdata($dbparams);

        if (!empty($ven_status) && is_array($ven_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $ven_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data update failed', 'data' => FALSE);
        }
    }

}
