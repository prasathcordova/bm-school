<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Service_type_controller
 *
 * @author chandrajith.edsys
 */
class Service_type_controller extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Service_type_model', 'MStype');
    }
    public function get_vehicleservicetype_details($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[1] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }

        $vehicleservicetypes_list = $this->MStype->get_vehicleservice_types($dbparams);
        if (!empty($vehicleservicetypes_list) && is_array($vehicleservicetypes_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $vehicleservicetypes_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function modify_servicetype_status($params = NULL)
    {

        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = $params['id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'SERVICE TYPE ID is required', 'data' => FALSE);
        }
        $dbparams[2] = NULL;

        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[3] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        $dbparams[4] = 0;
        if (isset($params['status'])) {
            $dbparams[5] = $params['status'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Service type Status is required', 'data' => FALSE);
        }

        $ven_status = $this->MStype->update_servicetype_data($dbparams);

        if (!empty($ven_status) && is_array($ven_status)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $ven_status);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data update failed', 'data' => FALSE);
        }
    }
    public function get_particularservicetype($params = NULL)
    {
        // return $params;
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['servicetypeid']) && !empty($params['servicetypeid'])) {
            $dbparams[1] = $params['servicetypeid'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Service Type Id is required', 'data' => FALSE);
        }

        $servicetypedata = $this->MStype->get_servicetype_particular($dbparams);
        if (!empty($servicetypedata) && is_array($servicetypedata)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $servicetypedata);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function update_servicetype($params = NULL)
    {
        $apikey = $params['API_KEY'];
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        //        $dbparams[1] = 1;
        if (isset($params['id']) && !empty($params['id'])) {
            $dbparams[1] = $params['id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Service Type Id is required', 'data' => FALSE);
        }
        if (isset($params['servicetype']) && !empty($params['servicetype'])) {
            $dbparams[2] = $params['servicetype'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Service Type Name is required', 'data' => FALSE);
        }


        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[3] = $params['inst_id'];
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst. details are required', 'data' => FALSE);
        }
        $dbparams[4] = 1;
        $dbparams[5] = 0;

        $servicetype_update_status = $this->MStype->update_servicetype_data($dbparams);
        if (!empty($servicetype_update_status) && is_array($servicetype_update_status) && isset($servicetype_update_status['ErrorStatus']) && $servicetype_update_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => $servicetype_update_status);
        } else {
            if (isset($servicetype_update_status['ErrorMessage']) && !empty($servicetype_update_status['ErrorMessage'])) {
                return array('data_status' => 0, 'error_status' => 1, 'message' => $servicetype_update_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Data update failed', 'data' => FALSE);
            }
        }
    }
}
