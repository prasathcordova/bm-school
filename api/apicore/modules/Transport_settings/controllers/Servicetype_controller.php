<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of servicetype_controller
 *
 * @author Chandrajith
 */
class Servicetype_controller extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Servicetype_model', 'Msm');
    }

    public function get_servicetype($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution Id is required', 'data' => FALSE);
        }

        $servicetypes_data = $this->Msm->getservice_types($dbparams);
        if (!empty($servicetypes_data) && is_array($servicetypes_data)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $servicetypes_data);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function save_servicetypes($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution Id is required', 'data' => FALSE);
        }
        if (isset($params['service_type']) && !empty($params['service_type'])) {
            $dbparams[2] = $params['service_type'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Service Type Name is required', 'data' => FALSE);
        }
        // return $dbparams;
        $servicecenter_add_status = $this->Msm->add_new_servicetype($dbparams);
        if (!empty($servicecenter_add_status) && is_array($servicecenter_add_status) && $servicecenter_add_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $servicecenter_add_status['id']));
        } else {
            if (is_array($servicecenter_add_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $servicecenter_add_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function get_particularservice_type($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['typeid']) && !empty($params['typeid'])) {
            $dbparams[1] = $params['typeid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Service type Id is required', 'data' => FALSE);
        }

        $service_type_list = $this->Msm->get_servicetype_particular($dbparams);
        if (!empty($sparepart_list) && is_array($service_type_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $service_type_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
}
