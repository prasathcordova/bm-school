<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vehicleservicebooking_controller
 *
 * @author chandrajith.edsys
 */
class Vehicleservicebooking_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('vehicleservicebooking_model', 'MVsb');
    }

    public function get_vehicleservicebooking_details($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }

        $vehicleservicebooking_list = $this->MVsb->get_vehicleservice_booking($dbparams);
        if (!empty($vehicleservicebooking_list) && is_array($vehicleservicebooking_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $vehicleservicebooking_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_servicebooked_vehicle($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['vehicle_id']) && !empty($params['vehicle_id'])) {
            $dbparams[1] = $params['vehicle_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }

        $vehicleservicebooking_list = $this->MVsb->get_vehicleservice_booked_data($dbparams);
        if (!empty($vehicleservicebooking_list) && is_array($vehicleservicebooking_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $vehicleservicebooking_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function checking_isvehicle_service($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['vehicle_id']) && !empty($params['vehicle_id'])) {
            $dbparams[1] = $params['vehicle_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }

        $vehicleservicebooking_list = $this->MVsb->is_vehicle_service($dbparams);
        if (!empty($vehicleservicebooking_list) && is_array($vehicleservicebooking_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $vehicleservicebooking_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_invoice_data($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }

        $vehicleservicebooking_list = $this->MVsb->get_vehicleservice_invoice($dbparams);
        if (!empty($vehicleservicebooking_list) && is_array($vehicleservicebooking_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $vehicleservicebooking_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_particular_vehicle_invoice_details($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['vehicle_id']) && !empty($params['vehicle_id'])) {
            $dbparams[1] = $params['vehicle_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }

        $vehicleservicebooking_list = $this->MVsb->get_vehicleservicedata_invoice($dbparams);
        if (!empty($vehicleservicebooking_list) && is_array($vehicleservicebooking_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $vehicleservicebooking_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_vehicle_invoice_history($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['vehicle_id']) && !empty($params['vehicle_id'])) {
            $dbparams[1] = $params['vehicle_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }

        $vehicleservicebooking_list = $this->MVsb->get_vehicle_invoice_data($dbparams);
        if (!empty($vehicleservicebooking_list) && is_array($vehicleservicebooking_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $vehicleservicebooking_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_vehicle_service_history($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['vehicle_id']) && !empty($params['vehicle_id'])) {
            $dbparams[1] = $params['vehicle_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }

        $vehicleservicebooking_list = $this->MVsb->get_vehicle_service_data($dbparams);
        if (!empty($vehicleservicebooking_list) && is_array($vehicleservicebooking_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $vehicleservicebooking_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_vehicleservice_booking($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['servicebooking_data']) && !empty($params['servicebooking_data'])) {
            $dbparams[1] = $params['servicebooking_data'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Service Booking data are required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        //        dev_export($dbparams);die;
        //        $dbparams[2] = $params['vehicle_data'];
        //        return $dbparams;

        $servicebooking_add_status = $this->MVsb->add_servicebooking_details($dbparams);
        //        return $servicebooking_add_status;
        if (!empty($servicebooking_add_status) && is_array($servicebooking_add_status) && $servicebooking_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $servicebooking_add_status['id']));
        } else {
            if (is_array($servicebooking_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $servicebooking_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }


    public function update_vehicleservice_booking($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = intval($params['id']);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Type Id is required', 'data' => FALSE);
        }
        if (isset($params['vehicleType']) && !empty($params['vehicleType'])) {
            $dbparams[2] = $params['vehicleType'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Type is required', 'data' => FALSE);
        }
        if (isset($params['vehicledesc']) && !empty($params['vehicledesc'])) {
            $dbparams[3] = $params['vehicledesc'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Vehicle Description is required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[4] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution data is required', 'data' => FALSE);
        }



        $dbparams[5] = 1;
        $dbparams[6] = 0;

        $vehicletrip_update_status = $this->MVsb->update_vehicleservice_booking($dbparams);

        if (!empty($vehicletrip_update_status) && is_array($vehicletrip_update_status) && isset($vehicletrip_update_status['ErrorStatus']) && $vehicletrip_update_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $vehicletrip_update_status);
        } else {
            if (isset($vehicletrip_update_status['ErrorMessage']) && !empty($vehicletrip_update_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $vehicletrip_update_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }

    public function modify_vehicleservice_booking_status($params = NULL)
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
        $dbparams[5] = 0;
        if (isset($params['status'])) {
            if ($params['status'] == -1) {
                $dbparams[6] = 0;
            } else {
                $dbparams[6] = $params['status'];
            }
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Trip Status is required', 'data' => FALSE);
        }

        $vehicletrip_modify_status = $this->MVsb->update_vehicleservice_booking($dbparams);
        if (!empty($vehicletrip_modify_status['ErrorStatus']) && is_array($vehicletrip_modify_status) && $vehicletrip_modify_status['ErrorStatus'] == 1) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => $vehicletrip_modify_status['ErrorMessage'], 'data' => FALSE);
        } else {
            return array('data_status' => 1, 'error_status' => 0, 'message' => $vehicletrip_modify_status['ErrorMessage'], 'data' => TRUE);
        }
    }
    public function save_service_invoice($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['serviceinvoice_data']) && !empty($params['serviceinvoice_data'])) {
            $dbparams[1] = $params['serviceinvoice_data'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Service Invoice data are required', 'data' => FALSE);
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[2] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        if (isset($params['spare_data']) && !empty($params['spare_data'])) {
            $dbparams[3] = $params['spare_data'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Spare parts details are required', 'data' => FALSE);
        }
        if (isset($params['acessorie_data']) && !empty($params['acessorie_data'])) {
            $dbparams[4] = $params['acessorie_data'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Acessories details are required', 'data' => FALSE);
        }
        if (isset($params['miscellaneous_data']) && !empty($params['miscellaneous_data'])) {
            $dbparams[5] = $params['miscellaneous_data'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Miscellaneous details are required', 'data' => FALSE);
        }
        // dev_export($dbparams);
        // return;
        //        $dbparams[2] = $params['vehicle_data'];
        //        return $dbparams;

        $serviceinvoice_add_status = $this->MVsb->add_serviceinvoice_details($dbparams);
        // return $serviceinvoice_add_status;
        if (!empty($serviceinvoice_add_status) && is_array($serviceinvoice_add_status) && $serviceinvoice_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $serviceinvoice_add_status['id']));
        } else {
            if (is_array($serviceinvoice_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $serviceinvoice_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }
}
