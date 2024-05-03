<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Modeldate_model
 *
 * @author chandrajith.edsys
 */
class Modeldate_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_all_model_yr()
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $modelyr = transport_data_with_param_with_urlencode(array('action' => 'get_model_date', 'mode' => 'search'), $apikey);

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
    public function save_vehicle_modelyr_new($vehiclemodelyr)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');

        $vehicle_modelyr = transport_data_with_param_with_urlencode(array('action' => 'save_model_date', 'vModel' => $vehiclemodelyr, 'inst_id' => $inst_id), $apikey);
        //        dev_export($vehicle_modelyr);die;
        if (isset($vehicle_modelyr) && !empty($vehicle_modelyr) && is_array($vehicle_modelyr)) {
            return $vehicle_modelyr['data'];
        } else {
            if (isset($vehicle_modelyr['message']) && !empty($vehicle_modelyr['message']) && is_array($vehicle_modelyr)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_modelyr['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_modelyr,
                    'data' => FALSE
                );
            }
        }
    }
    public function update_status_vehicle_modelyr($vehicle_model, $status)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $vehicle_model = transport_data_with_param_with_urlencode(array('action' => 'modify_model_date', 'id' => $vehicle_model,  'status' => $status, 'inst_id' => $inst_id), $apikey);
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
    public function get_modelyear_data($modelyr_id)
    {
        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $model_year = transport_data_with_param_with_urlencode(array('action' => 'get_model_date', 'id' => $modelyr_id,  'mode' => 'strict'), $apikey);
        if (isset($model_year) && !empty($model_year) && is_array($model_year)) {
            return $model_year['data'];
        } else {
            if (isset($model_year['message']) && !empty($model_year['message']) && is_array($model_year)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $model_year['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $model_year,
                    'data' => FALSE
                );
            }
        }
    }

    public function save_model_year_edit($model_year_id, $model_year)
    {

        $apikey = $this->session->userdata('API-Key');
        $inst_id = $this->session->userdata('inst_id');
        $vehicle_model_year = transport_data_with_param_with_urlencode(array('action' => 'update_model_date', 'id' => $model_year_id, 'vModel' => $model_year, 'inst_id' => $inst_id), $apikey);
        if (isset($vehicle_model_year) && !empty($vehicle_model_year) && is_array($vehicle_model_year)) {
            return $vehicle_model_year['data'];
        } else {
            if (isset($vehicle_model_year['message']) && !empty($vehicle_model_year['message']) && is_array($vehicle_model_year)) {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_model_year['message'],
                    'data' => FALSE
                );
            } else {
                return array(
                    'status' => 0,
                    'data_status' => 0,
                    'error_status' => 1,
                    'message' => $vehicle_model_year,
                    'data' => FALSE
                );
            }
        }
    }
}
