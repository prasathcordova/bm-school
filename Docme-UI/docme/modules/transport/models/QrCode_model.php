<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Servicecenter_model
 *
 * @author chandrajith.edsys
 */
class QrCode_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_vehicle_details($inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $vehicle_data = transport_data_with_param_with_urlencode(array('action' => 'get_vehiclereg', 'inst_id' => $inst_id, 'mode' => 'strict', 'status' => 1), $apikey);

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
}
