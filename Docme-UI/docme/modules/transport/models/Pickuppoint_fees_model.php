<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pickuppoint_model
 *
 * @author AHB
 */
class Pickuppoint_fees_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_all_pickuppoint_fees($inst_id, $acd_year)
    {
        $apikey = $this->session->userdata('API-Key');
        $pickuppoints = transport_data_with_param_with_urlencode(array('action' => 'get_all_pickuppoint_fees', 'inst_id' => $inst_id, 'acd_year' => $acd_year, 'mode' => 'strict'), $apikey);

        if (isset($pickuppoints) && !empty($pickuppoints) && is_array($pickuppoints)) {
            return $pickuppoints['data'];
        } else {
            if (isset($pickuppoints['message']) && !empty($pickuppoints['message']) && is_array($pickuppoints)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $pickuppoints['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $pickuppoints,
                    'data' => FALSE
                );
            }
        }
    }
    public function get_pickuppoint_all_fees_details($pickuppoint_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data = [
            'action' => 'get_pickuppoint_all_fees_details',
            'pickuppoint_id' => $pickuppoint_id,
            'inst_id' => $this->session->userdata('inst_id'),
            'acd_year' => $this->session->userdata('acd_year')
        ];
        $pickuppoints = transport_data_with_param_with_urlencode($data, $apikey);
        if (isset($pickuppoints) && !empty($pickuppoints) && is_array($pickuppoints)) {
            return $pickuppoints['data'];
        } else {
            if (isset($pickuppoints['message']) && !empty($pickuppoints['message']) && is_array($pickuppoints)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $pickuppoints['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $pickuppoints,
                    'data' => FALSE
                );
            }
        }
    }

    public function save_pickuppoint_fees_data($save_data)
    {
        $apikey = $this->session->userdata('API-Key');
        $data = [

            'action' => 'save_pickuppoint_fees_data',
            'inst_id' => $this->session->userdata('inst_id'),
            'acd_year' => $this->session->userdata('acd_year')
        ];
        $data = array_merge($save_data, $data);
        $pickuppoints = transport_data_with_param_with_urlencode($data, $apikey);
        if (isset($pickuppoints) && !empty($pickuppoints) && is_array($pickuppoints)) {
            return $pickuppoints['data'];
        } else {
            if (isset($pickuppoints['message']) && !empty($pickuppoints['message']) && is_array($pickuppoints)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $pickuppoints['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $pickuppoints,
                    'data' => FALSE
                );
            }
        }
    }

    public function get_pickuppoint_student_details($pickuppoint_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $data = [
            'action' => 'get_pickuppoint_student_details',
            'pickuppoint_id' => $pickuppoint_id,
            'inst_id' => $this->session->userdata('inst_id'),
            'acd_year' => $this->session->userdata('acd_year')
        ];
        $pickuppoints = transport_data_with_param_with_urlencode($data, $apikey);
        if (isset($pickuppoints) && !empty($pickuppoints) && is_array($pickuppoints)) {
            return $pickuppoints['data'];
        } else {
            if (isset($pickuppoints['message']) && !empty($pickuppoints['message']) && is_array($pickuppoints)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $pickuppoints['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $pickuppoints,
                    'data' => FALSE
                );
            }
        }
    }
}
