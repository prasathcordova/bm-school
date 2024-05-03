<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vehicle_registration_model
 *
 * @author chandrajith.edsys
 */
class vehicle_registration_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_all_vehicletypes()
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $vehicletype = transport_data_with_param_with_urlencode(array('action' => 'get_vehicletype', 'mode' => 'strict', 'status' => 1), $apikey);
        if (isset($vehicletype) && !empty($vehicletype) && is_array($vehicletype)) {
            return $vehicletype['data'];
        } else {
            if (isset($vehicletype['message']) && !empty($vehicletype['message']) && is_array($vehicletype)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicletype['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => '',
                    'data' => FALSE
                );
            }
        }
    }
    public function get_all_fueltypes()
    {
        $apikey = $this->session->userdata('API-Key');
        $fueltype = transport_data_with_param_with_urlencode(array('action' => 'get_fueltype', 'mode' => 'strict', 'status' => 1), $apikey);

        if (isset($fueltype) && !empty($fueltype) && is_array($fueltype)) {
            return $fueltype['data'];
        } else {
            if (isset($fueltype['message']) && !empty($fueltype['message']) && is_array($fueltype)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $fueltype['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $fueltype,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_all_vehicle_insurance_data()
    {
        $apikey = $this->session->userdata('API-Key');
        $vehicle_insurance = transport_data_with_param_with_urlencode(array('action' => 'get_insurance', 'mode' => 'strict', 'status' => 1), $apikey);
        if (isset($vehicle_insurance) && !empty($vehicle_insurance) && is_array($vehicle_insurance)) {
            return $vehicle_insurance['data'];
        } else {
            if (isset($vehicle_insurance['message']) && !empty($vehicle_insurance['message']) && is_array($vehicle_insurance)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_insurance['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_insurance,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_all_vehicle_make_data()
    {
        $apikey = $this->session->userdata('API-Key');
        $vehicle_make = transport_data_with_param_with_urlencode(array('action' => 'get_make', 'mode' => 'strict', 'status' => 1), $apikey);
        if (isset($vehicle_make) && !empty($vehicle_make) && is_array($vehicle_make)) {
            return $vehicle_make['data'];
        } else {
            if (isset($vehicle_make['message']) && !empty($vehicle_make['message']) && is_array($vehicle_make)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_make['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_make,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_all_model_yr()
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $modelyr = transport_data_with_param_with_urlencode(array('action' => 'get_model_date', 'mode' => 'strict', 'status' => 1), $apikey); //$inst_id => 'inst_id'

        if (isset($modelyr) && !empty($modelyr) && is_array($modelyr)) {
            return $modelyr['data'];
        } else {
            if (isset($modelyr['message']) && !empty($modelyr['message']) && is_array($modelyr)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $modelyr['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $modelyr,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_all_vehicle_model_data()
    {
        $apikey = $this->session->userdata('API-Key');
        $vehicle_model = transport_data_with_param_with_urlencode(array('action' => 'get_model', 'mode' => 'strict', 'status' => 1), $apikey);
        if (isset($vehicle_model) && !empty($vehicle_model) && is_array($vehicle_model)) {
            return $vehicle_model['data'];
        } else {
            if (isset($vehicle_model['message']) && !empty($vehicle_model['message']) && is_array($vehicle_model)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_model['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_model,
                    'data' => FALSE
                );
            }
        }
    }
    public function save_vehicle_profile($vehicle_data)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        //         dev_export($vehicle_data);die;
        $status_data = transport_data_with_param_with_urlencode(array('action' => 'save_vehiclereg', 'vehicle_data' => $vehicle_data, 'inst_id' => $inst_id), $apikey);
        //        dev_export($status_data);die;
        if (is_array($status_data) && isset($status_data['data']) && !empty($status_data['data'])) {
            return $status_data['data'];
        } else {
            return array(
                'status' => 0,
                'data_status' => 0,
                'error_status' => 1,
                'message' => 'Error in saving data',
                'data' => FALSE
            );
        }
    }
    public function get_all_vehicle_data($inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $vehicle_data = transport_data_with_param_with_urlencode(array('action' => 'get_vehiclereg', 'inst_id' => $inst_id, 'mode' => 'search'), $apikey);

        if (isset($vehicle_data) && !empty($vehicle_data) && is_array($vehicle_data)) {
            return $vehicle_data['data'];
        } else {
            if (isset($vehicle_data['message']) && !empty($vehicle_data['message']) && is_array($vehicle_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_data,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_vehicle_data($inst_id, $data = array())
    {
        $apikey = $this->session->userdata('API-Key');

        $data['action'] = 'get_vehiclereg';
        $data['inst_id'] = $inst_id;
        $data['mode'] = 'strict';

        $vehicle_data = transport_data_with_param_with_urlencode($data, $apikey);

        if (isset($vehicle_data) && !empty($vehicle_data) && is_array($vehicle_data)) {
            return $vehicle_data['data'];
        } else {
            if (isset($vehicle_data['message']) && !empty($vehicle_data['message']) && is_array($vehicle_data)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_data['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_data,
                    'data' => FALSE
                );
            }
        }
    }
    public function edit_status_vehicle($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'modify_vehicle_status';
        $veh_status = transport_data_with_param_with_urlencode($data, $apikey);
        //        dev_export($veh_status);die;
        if (is_array($veh_status) && $veh_status['status'] == 1) {
            if (is_array($veh_status['data']) && $veh_status['data']['error_status'] == 0) {
                if ($veh_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $veh_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data update failed with error message : " . $veh_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }

    public function update_vehicle_registration($vehicle_id, $vehicle_data)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'update_vehiclereg';
        $data['inst_id'] = $this->session->userdata('inst_id');
        $data['vehicle_id'] = $vehicle_id;
        $data['vehicle_data_json'] = $vehicle_data;
        $veh_status = transport_data_with_param_with_urlencode($data, $apikey);
        if (isset($veh_status) && !empty($veh_status) && is_array($veh_status)) {
            return $veh_status['data'];
        } else {
            if (isset($veh_status['message']) && !empty($veh_status['message']) && is_array($veh_status)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $veh_status['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $veh_status,
                    'data' => FALSE
                );
            }
        }
    }
}
