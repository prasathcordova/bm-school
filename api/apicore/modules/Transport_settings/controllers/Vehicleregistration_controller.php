<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vehicleregistration_controller
 *
 * @author chandrajith.edsys
 */
class Vehicleregistration_controller extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Vehicleregistration_model', 'MVR');
    }
    public function get_vehicleregistrationdetails($params = NULL)
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
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "c.id = '" . $params['id'] . "' ";
                }
            }
            if (isset($params['vehicleNum'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.vehicleNum LIKE '%" . $params['vehicleNum'] . "%' ";
                } else {
                    $query_string = "c.vehicleNum LIKE '%" . $params['vehicleNum'] . "%' ";
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
            if (isset($params['vehicleNum'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.vehicleNum = '" . $params['vehicleNum'] . "' ";
                } else {
                    $query_string = "c.vehicleNum = '" . $params['vehicleNum'] . "' ";
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


        $vehiclereg_list = $this->MVR->get_vehiclereg_details($apikey, $query_string);
        if (!empty($vehiclereg_list) && is_array($vehiclereg_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $vehiclereg_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_vehicleregistration($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['vehicle_data']) && !empty($params['vehicle_data'])) {
            $dbparams[1] = $params['vehicle_data'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle details are required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        //        dev_export($dbparams);die;
        //        $dbparams[2] = $params['vehicle_data'];

        //        return $dbparams;

        $vehiclereg_add_status = $this->MVR->add_new_vehiclereg($dbparams);
        if (!empty($vehiclereg_add_status) && is_array($vehiclereg_add_status) && $vehiclereg_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $vehiclereg_add_status['id']));
        } else {
            if (is_array($vehiclereg_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $vehiclereg_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }
    //    public function save_vehicleregistration($params = NULL) {
    //        $dbparams = array();
    //        $dbparams[0] = $params['API_KEY'];
    //         if (isset($params['inst_id']) && !empty($params['inst_id'])) {
    //            $dbparams[1] = $params['inst_id'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
    //        }
    //        if (isset($params['vehicleNum']) && !empty($params['vehicleNum'])) {
    //            $dbparams[2] = $params['vehicleNum'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Number is required', 'data' => FALSE);
    //        }
    //        if (isset($params['regnum']) && !empty($params['regnum'])) {
    //            $dbparams[3] = $params['regnum'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Registration Number is required', 'data' => FALSE);
    //        }
    //        if (isset($params['chaisisNum']) && !empty($params['chaisisNum'])) {
    //            $dbparams[4] = $params['chaisisNum'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Chasis Number is required', 'data' => FALSE);
    //        }
    //        if (isset($params['EngineNum']) && !empty($params['EngineNum'])) {
    //            $dbparams[5] = $params['EngineNum'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Engine Number is required', 'data' => FALSE);
    //        }
    //        if (isset($params['vehicleModelId']) && !empty($params['vehicleModelId'])) {
    //            $dbparams[6] = $params['vehicleModelId'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Model Id is required', 'data' => FALSE);
    //        }
    //        if (isset($params['vehicleMake']) && !empty($params['vehicleMake'])) {
    //            $dbparams[7] = $params['vehicleMake'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Make is required', 'data' => FALSE);
    //        }
    //        if (isset($params['seatCapacity']) && !empty($params['seatCapacity'])) {
    //            $dbparams[8] = $params['seatCapacity'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Seat Capacity is required', 'data' => FALSE);
    //        }
    //        if (isset($params['companyId']) && !empty($params['companyId'])) {
    //            $dbparams[9] = $params['companyId'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Company ID is required', 'data' => FALSE);
    //        }
    //        if (isset($params['fuelTypeId']) && !empty($params['fuelTypeId'])) {
    //            $dbparams[10] = $params['fuelTypeId'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Fuel Type ID is required', 'data' => FALSE);
    //        }
    //        if (isset($params['InsuranceCompanyId']) && !empty($params['InsuranceCompanyId'])) {
    //            $dbparams[11] = $params['InsuranceCompanyId'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Insurance company ID is required', 'data' => FALSE);
    //        }
    //        if (isset($params['insuranceDate']) && !empty($params['insuranceDate'])) {
    //            $dbparams[12] = $params['insuranceDate'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Insurance Date is required', 'data' => FALSE);
    //        }
    //        if (isset($params['insuranceExpiryDate']) && !empty($params['insuranceExpiryDate'])) {
    //            $dbparams[13] = $params['insuranceExpiryDate'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Insurance Expiry Date is required', 'data' => FALSE);
    //        }
    //        if (isset($params['taxDate']) && !empty($params['taxDate'])) {
    //            $dbparams[14] = $params['taxDate'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Tax Date is required', 'data' => FALSE);
    //        }
    //        if (isset($params['taxExpiryDate']) && !empty($params['taxExpiryDate'])) {
    //            $dbparams[15] = $params['taxExpiryDate'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Tax Expiry Date is required', 'data' => FALSE);
    //        }
    //        if (isset($params['permitDate']) && !empty($params['permitDate'])) {
    //            $dbparams[16] = $params['permitDate'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Permit Date is required', 'data' => FALSE);
    //        }
    //        if (isset($params['permitExpiryDate']) && !empty($params['permitExpiryDate'])) {
    //            $dbparams[17] = $params['permitExpiryDate'];
    //        } else {
    //            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Permit Expiry Date is required', 'data' => FALSE);
    //        }
    //       
    //        
    //
    //        $vehiclereg_add_status = $this->MVR->add_new_vehiclereg($dbparams);
    //        if (!empty($vehiclereg_add_status) && is_array($vehiclereg_add_status) && $vehiclereg_add_status['ErrorStatus'] == 0) {
    //            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $vehiclereg_add_status['id']));
    //        } else {
    //            if (is_array($vehiclereg_add_status)) {
    //                return array('data_status' => 0, 'error_status' => 0, 'message' => $vehiclereg_add_status['ErrorMessage'], 'data' => FALSE);
    //            } else {
    //                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
    //            }
    //        }
    //    }

    public function update_vehicleregistration($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        if (isset($params['vehicle_id']) && !empty($params['vehicle_id'])) {
            $dbparams[2] = $params['vehicle_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        if (isset($params['vehicle_data_json']) && !empty($params['vehicle_data_json'])) {
            $dbparams[3] = $params['vehicle_data_json'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }

        // if (isset($params['vehicleNum']) && !empty($params['vehicleNum'])) {
        //     $dbparams[3] = $params['vehicleNum'];
        // } else {
        //     return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Number is required', 'data' => FALSE);
        // }
        // if (isset($params['regnum']) && !empty($params['regnum'])) {
        //     $dbparams[4] = $params['regnum'];
        // } else {
        //     return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Registration Number is required', 'data' => FALSE);
        // }
        // if (isset($params['chaisisNum']) && !empty($params['chaisisNum'])) {
        //     $dbparams[5] = $params['chaisisNum'];
        // } else {
        //     return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Chasis Number is required', 'data' => FALSE);
        // }
        // if (isset($params['EngineNum']) && !empty($params['EngineNum'])) {
        //     $dbparams[6] = $params['EngineNum'];
        // } else {
        //     return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Engine Number is required', 'data' => FALSE);
        // }
        // if (isset($params['vehicleModelId']) && !empty($params['vehicleModelId'])) {
        //     $dbparams[7] = $params['vehicleModelId'];
        // } else {
        //     return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Model Id is required', 'data' => FALSE);
        // }
        // if (isset($params['vehicleMake']) && !empty($params['vehicleMake'])) {
        //     $dbparams[8] = $params['vehicleMake'];
        // } else {
        //     return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Make is required', 'data' => FALSE);
        // }
        // if (isset($params['seatCapacity']) && !empty($params['seatCapacity'])) {
        //     $dbparams[9] = $params['seatCapacity'];
        // } else {
        //     return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Seat Capacity is required', 'data' => FALSE);
        // }
        // if (isset($params['companyId']) && !empty($params['companyId'])) {
        //     $dbparams[10] = $params['companyId'];
        // } else {
        //     return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Company ID is required', 'data' => FALSE);
        // }
        // if (isset($params['fuelTypeId']) && !empty($params['fuelTypeId'])) {
        //     $dbparams[11] = $params['fuelTypeId'];
        // } else {
        //     return array('data_status' => 0, 'error_status' => 1, 'message' => 'Fuel Type ID is required', 'data' => FALSE);
        // }
        // if (isset($params['InsuranceCompanyId']) && !empty($params['InsuranceCompanyId'])) {
        //     $dbparams[12] = $params['InsuranceCompanyId'];
        // } else {
        //     return array('data_status' => 0, 'error_status' => 1, 'message' => 'Insurance company ID is required', 'data' => FALSE);
        // }
        // if (isset($params['insuranceDate']) && !empty($params['insuranceDate'])) {
        //     $dbparams[13] = $params['insuranceDate'];
        // } else {
        //     return array('data_status' => 0, 'error_status' => 1, 'message' => 'Insurance Date is required', 'data' => FALSE);
        // }
        // if (isset($params['insuranceExpiryDate']) && !empty($params['insuranceExpiryDate'])) {
        //     $dbparams[14] = $params['insuranceExpiryDate'];
        // } else {
        //     return array('data_status' => 0, 'error_status' => 1, 'message' => 'Insurance Expiry Date is required', 'data' => FALSE);
        // }
        // if (isset($params['taxDate']) && !empty($params['taxDate'])) {
        //     $dbparams[15] = $params['taxDate'];
        // } else {
        //     return array('data_status' => 0, 'error_status' => 1, 'message' => 'Tax Date is required', 'data' => FALSE);
        // }
        // if (isset($params['taxExpiryDate']) && !empty($params['taxExpiryDate'])) {
        //     $dbparams[16] = $params['taxExpiryDate'];
        // } else {
        //     return array('data_status' => 0, 'error_status' => 1, 'message' => 'Tax Expiry Date is required', 'data' => FALSE);
        // }
        // if (isset($params['permitDate']) && !empty($params['permitDate'])) {
        //     $dbparams[17] = $params['permitDate'];
        // } else {
        //     return array('data_status' => 0, 'error_status' => 1, 'message' => 'Permit Date is required', 'data' => FALSE);
        // }
        // if (isset($params['permitExpiryDate']) && !empty($params['permitExpiryDate'])) {
        //     $dbparams[18] = $params['permitExpiryDate'];
        // } else {
        //     return array('data_status' => 0, 'error_status' => 1, 'message' => 'Permit Expiry Date is required', 'data' => FALSE);
        // }


        // $dbparams[19] = 1;
        // $dbparams[20] = 0;
        $vehiclereg_update_status = $this->MVR->update_vehiclereg($dbparams);

        if (!empty($vehiclereg_update_status) && is_array($vehiclereg_update_status) && isset($vehiclereg_update_status['ErrorStatus']) && $vehiclereg_update_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $vehiclereg_update_status);
        } else {
            if (isset($vehiclereg_update_status['ErrorMessage']) && !empty($vehiclereg_update_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $vehiclereg_update_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => $vehiclereg_update_status);
            }
        }
    }

    public function modify_vehicleregistration_status($params = NULL)
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
        $dbparams[4] = NULL;
        $dbparams[5] = NULL;
        $dbparams[6] = NULL;
        $dbparams[7] = NULL;
        $dbparams[8] = NULL;
        $dbparams[9] = NULL;
        $dbparams[10] = NULL;
        $dbparams[11] = NULL;
        $dbparams[12] = NULL;
        $dbparams[13] = NULL;
        $dbparams[14] = NULL;
        $dbparams[15] = NULL;
        $dbparams[16] = NULL;
        $dbparams[17] = NULL;
        $dbparams[18] = NULL;
        //        $dbparams[19] = NULL;
        $dbparams[19] = 0;
        if (isset($params['status'])) {
            if ($params['status'] == -1) {
                $dbparams[20] = 0;
            } else {
                $dbparams[20] = $params['status'];
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle  code Status is required', 'data' => FALSE);
        }

        $vehicletype_modify_status = $this->MVR->update_vehiclereg($dbparams);
        if (!empty($vehicletype_modify_status['ErrorStatus']) && is_array($vehicletype_modify_status) && $vehicletype_modify_status['ErrorStatus'] == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => $vehicletype_modify_status['ErrorMessage'], 'data' => FALSE);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => $vehicletype_modify_status['ErrorMessage'], 'data' => TRUE);
        }
    }
    public function modify_vehreg_status($params = NULL)
    {

        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = $params['id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle ID is required', 'data' => FALSE);
        }

        if (isset($params['status'])) {
            $dbparams[2] = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Status is required', 'data' => FALSE);
        }

        $veh_status = $this->MVR->update_veh_data($dbparams);
        if (!empty($veh_status) && is_array($veh_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $veh_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data update failed', 'data' => FALSE);
        }
    }
}
