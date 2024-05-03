<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vehicletype_model
 *
 * @author chandrajith.edsys
 */
class Vehicletype_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
     public function get_vehicletype_details($apikey, $query) {
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $vehicle_type = $this->db->query("[docme_transport].[vehicletype_select] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $vehicle_type = $this->db->query("[docme_transport].[vehicletype_select] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $vehicle_type;
    }
    public function add_new_vehicletype($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vehicle_type_save = $this->db->query("[docme_transport].[vehicletype_save] ?,?,?,?", $dbparams)->result_array();
            if (!empty($vehicle_type_save) && is_array($vehicle_type_save)) {
                return $vehicle_type_save[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Type not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Type not added. Please check the data and try again');
        }
    }

    public function update_vehicletype($dbparams) {
        $this->db->flush_cache();
//        dev_export($dbparams);die;
        if (is_array($dbparams)) {
            $vehicle_type_update = $this->db->query("[docme_transport].[vehicletype_update] ?,?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($vehicle_type_update) && is_array($vehicle_type_update)) {
                return $vehicle_type_update[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Type not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Type not updated. Please check the data and try again');
        }
    }

}
