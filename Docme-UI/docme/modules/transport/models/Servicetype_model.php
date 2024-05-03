<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Servicetype_model
 *
 * @author Chandrajith
 */
class Servicetype_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_vehicle_servicetype($inst_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $vehicle_servicetype = transport_data_with_param_with_urlencode(array('action' => 'get_servicetype', 'inst_id' => $inst_id), $apikey);
        // dev_export(($vehicle_servicetype));
        // die;
        if (isset($vehicle_servicetype) && !empty($vehicle_servicetype) && is_array($vehicle_servicetype)) {
            return $vehicle_servicetype['data'];
        } else {
            if (isset($vehicle_servicetype['message']) && !empty($vehicle_servicetype['message']) && is_array($vehicle_servicetype)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_servicetype['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_servicetype,
                    'data' => FALSE
                );
            }
        }
    }
    public function save_servicetype_new($service_type)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        //         dev_export($inst_id);
        //         dev_export($service_center_name);
        //         dev_export($service_cen_location);
        //         dev_export($serv_email);
        //         dev_export($service_type);die;
        $servicecenter = transport_data_with_param_with_urlencode(array('action' => 'save_servicetypes', 'service_type' => $service_type, 'inst_id' => $inst_id), $apikey);
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

    public function select_service_type($typeid)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $data = array(
            'action' => 'get_particularservicetype',
            'servicetypeid' => $typeid
        );

        $service_type_edit_status = transport_data_with_param_with_urlencode($data, $apikey);
        // dev_export($service_type_edit_status);
        // return;
        if (isset($service_type_edit_status) && !empty($service_type_edit_status) && is_array($service_type_edit_status)) {
            return $service_type_edit_status['data'];
        } else {
            if (isset($service_type_edit_status['message']) && !empty($service_type_edit_status['message']) && is_array($service_type_edit_status)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $service_type_edit_status['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $service_type_edit_status,
                    'data' => FALSE
                );
            }
        }
    }

    public function save_edit_service_type($typeid, $typename)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $status_data = transport_data_with_param_with_urlencode(
            array(
                'action'      => 'update_servicetype',
                'id'        => $typeid,
                'servicetype'    => $typename,
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

    public function edit_status_type($data)
    {
        $apikey = $this->session->userdata('API-Key');
        $data['action'] = 'modify_servicetype_status';
        // dev_export($data);
        // return;
        $servive_type_status = transport_data_with_param_with_urlencode($data, $apikey);

        if (is_array($servive_type_status) && $servive_type_status['status'] == 1) {
            if (is_array($servive_type_status['data']) && $servive_type_status['data']['error_status'] == 0) {
                if ($servive_type_status['data']['data_status'] == 1) {
                    return array('status' => 1, 'message' => 'Data saved');
                } else {
                    return array('status' => 0, 'message' => $servive_type_status['data']['message']);
                }
            } else {
                return array('status' => 0, 'message' => "Data update failed with error message : " . $servive_type_status['data']['message']);
            }
        } else {
            return array('status' => 0, 'message' => 'Data update failed');
        }
    }
}
