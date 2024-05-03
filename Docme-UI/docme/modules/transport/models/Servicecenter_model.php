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
class Servicecenter_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_all_vehicle_servicecenter($inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $vehicle_servicecenter = transport_data_with_param_with_urlencode(array('action' => 'get_servicecenter', 'inst_id' => $inst_id, 'mode' => 'strict'), $apikey);

        if (isset($vehicle_servicecenter) && !empty($vehicle_servicecenter) && is_array($vehicle_servicecenter)) {
            return $vehicle_servicecenter['data'];
        } else {
            if (isset($vehicle_servicecenter['message']) && !empty($vehicle_servicecenter['message']) && is_array($vehicle_servicecenter)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_servicecenter['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_servicecenter,
                    'data' => FALSE
                );
            }
        }
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
    public function save_servicecenter_new($service_center_name, $service_cen_location, $serv_email, $contact_number)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        //         dev_export($inst_id);
        //         dev_export($service_center_name);
        //         dev_export($service_cen_location);
        //         dev_export($serv_email);
        //         dev_export($contact_number);die;
        $servicecenter = transport_data_with_param_with_urlencode(array('action' => 'save_servicecenter', 'serviceentername' => $service_center_name, 'location' => $service_cen_location, 'email' => $serv_email, 'contactno' => $contact_number, 'inst_id' => $inst_id), $apikey);

        //        dev_export($servicecenter);die;
        if (isset($servicecenter) && !empty($servicecenter) && is_array($servicecenter)) {
            return $servicecenter['data'];
        } else {
            if (isset($servicecenter['message']) && !empty($servicecenter['message']) && is_array($servicecenter)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $servicecenter['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $servicecenter,
                    'data' => FALSE
                );
            }
        }
    }

    public function select_service_center($centerid)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $data = array(
            'action' => 'get_particularservicecenter',
            'servicecenterid' => $centerid
        );

        $service_center_edit_status = transport_data_with_param_with_urlencode($data, $apikey);
        // dev_export($service_center_edit_status);
        // return;
        if (isset($service_center_edit_status) && !empty($service_center_edit_status) && is_array($service_center_edit_status)) {
            return $service_center_edit_status['data'];
        } else {
            if (isset($service_center_edit_status['message']) && !empty($service_center_edit_status['message']) && is_array($service_center_edit_status)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $service_center_edit_status['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $service_center_edit_status,
                    'data' => FALSE
                );
            }
        }
    }

    public function save_edit_service_center($id, $centername, $location, $email, $contactno)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $status_data = transport_data_with_param_with_urlencode(
            array(
                'action'      => 'update_servicecenter',
                'id'        => $id,
                'serviceCenterName'    => $centername,
                'slocation'    => $location,
                'contactNo'    => $contactno,
                'emailId'    => $email,
                'inst_id'    => $inst_id
            ),
            $apikey
        );
        // dev_export($status_data);
        // return;
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

    public function edit_status_center($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'modify_servicecenter_status';
        // dev_export($data);
        // return;
        $center_status = transport_data_with_param_with_urlencode($data, $apikey);

        if (is_array($center_status) && $center_status['status'] == 1) {
            if (is_array($center_status['data']) && $center_status['data']['error_status'] == 0) {
                if ($center_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $center_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data update failed with error message : " . $center_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }
}
