<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vehiclemodedate_model
 *
 * @author chandrajith.edsys
 */
class Vehiclemodedate_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
     public function get_vehiclemodeldate_details($apikey, $query) {
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $vehicle_modeldate = $this->db->query("[docme_transport].[vehiclemodeldate_select] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $vehicle_modeldate = $this->db->query("[docme_transport].[vehiclemodeldate_select] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $vehicle_modeldate;
    }
    public function add_new_vehiclemodeldate($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
           $vehicle_modeldate_save = $this->db->query("[docme_transport].[vehiclemodeldate_save] ?,?,?", $dbparams)->result_array();
            if (!empty($vehicle_modeldate_save) && is_array($vehicle_modeldate_save)) {
                return $vehicle_modeldate_save[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Make not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Make  not added. Please check the data and try again');
        }
    }
     public function update_vehiclemodeldate($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vehicle_modeldate_update = $this->db->query("[docme_transport].[vehiclemodeldate_update] ?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($vehicle_modeldate_update) && is_array($vehicle_modeldate_update)) {
                return $vehicle_modeldate_update[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Make not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Make not updated. Please check the data and try again');
        }
    }
}
