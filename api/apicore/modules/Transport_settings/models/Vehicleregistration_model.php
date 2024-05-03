<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vehicleregistration_model
 *
 * @author chandrajith.edsys
 */
class Vehicleregistration_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_vehiclereg_details($apikey, $query)
    {
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $vehicle_reg = $this->db->query("[docme_transport].[vehicles_select] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $vehicle_reg = $this->db->query("[docme_transport].[vehicles_select] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $vehicle_reg;
    }
    public function add_new_vehiclereg($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            //            dev_export($dbparams);die;
            $vehicle_reg_save = $this->db->query("[docme_transport].[vehicleregdetails_Save] ?,?,?", $dbparams)->result_array();
            if (!empty($vehicle_reg_save) && is_array($vehicle_reg_save)) {
                return $vehicle_reg_save[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Registration not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Registration not added. Please check the data and try again');
        }
    }

    public function update_vehiclereg($dbparams)
    {
        $this->db->flush_cache();
        $param_string = procedure_param_string($dbparams);
        if (is_array($dbparams)) {
            $vehicle_reg_update = $this->db->query("[docme_transport].[vehicle_registration_update] $param_string", $dbparams)->result_array();
            if (!empty($vehicle_reg_update) && is_array($vehicle_reg_update)) {
                return $vehicle_reg_update[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Registration not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Registration not updated. Please check the data and try again');
        }
    }
    public function update_veh_data($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $veh_status = $this->db->query("[docme_transport].[vehiclestatus_update] ?,?,?", $dbparams)->result_array();
            if (!empty($veh_status) && is_array($veh_status)) {
                return $veh_status[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle not updated. Please check the data and try again');
        }
    }
}
