<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vehiclemodel_model
 *
 * @author chandrajith.edsys
 */
class Vehiclemodel_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    public function get_vehiclemodel_details($apikey, $query) {
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $vehicle_type = $this->db->query("[docme_transport].[vehiclemodel_select] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $vehicle_type = $this->db->query("[docme_transport].[vehiclemodel_select] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $vehicle_type;
    }
    public function add_new_vehiclemodel($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vehicle_type_save = $this->db->query("[docme_transport].[vehicle_model_save] ?,?", $dbparams)->result_array();
            if (!empty($vehicle_type_save) && is_array($vehicle_type_save)) {
                return $vehicle_type_save[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Model not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Model  not added. Please check the data and try again');
        }
    }

    public function update_vehiclemodel($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vehicle_type_update = $this->db->query("[docme_transport].[vehiclemodel_update] ?,?,?,?,?", $dbparams)->result_array();
            if (!empty($vehicle_type_update) && is_array($vehicle_type_update)) {
                return $vehicle_type_update[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Model not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Model not updated. Please check the data and try again');
        }
    }
    
}
