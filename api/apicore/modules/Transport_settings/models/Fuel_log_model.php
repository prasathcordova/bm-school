<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fuel_log_model
 *
 * @author chandrajith.edsys
 */
class Fuel_log_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
     public function get_fuellog_details($apikey, $query) {
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $vehicle_type = $this->db->query("[docme_transport].[fuellogbook_select] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $vehicle_type = $this->db->query("[docme_transport].[fuellogbook_select] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $vehicle_type;
    }
     public function get_fueltype_details($dbparams) {
        $this->db->flush_cache();
        if ($dbparams) {
            $fuel_type = $this->db->query("[docme_transport].[fueltype_select_vehicle] ?,?,?", $dbparams)->result_array();
       
        return $fuel_type;
    }
    }
    public function add_new_fuellog($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vehicle_inc_save = $this->db->query("[docme_transport].[vehiclefuellogdetails_Save] ?,?,?", $dbparams)->result_array();
            if (!empty($vehicle_inc_save) && is_array($vehicle_inc_save)) {
                return $vehicle_inc_save[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Fuel Log Details not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Fuel Log Details not added. Please check the data and try again');
        }
    }
}
