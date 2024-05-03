<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Incidents_model
 *
 * @author chandrajith.edsys
 */
class Incidents_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_vehicleincidents($apikey, $query)
    {
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $vehicle_incidents = $this->db->query("[docme_transport].[vehicleincident_select] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $vehicle_incidents = $this->db->query("[docme_transport].[vehicleincident_select] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $vehicle_incidents;
    }
    public function add_new_incidents($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vehicle_inc_save = $this->db->query("[docme_transport].[vehicleincidentsdetails_Save] ?,?,?", $dbparams)->result_array();
            if (!empty($vehicle_inc_save) && is_array($vehicle_inc_save)) {
                return $vehicle_inc_save[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Incidents not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Incidents not added. Please check the data and try again');
        }
    }

    public function update_vehicleincidents($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vehicle_incidents_update = $this->db->query("[docme_transport].[vehicletype_update] ?,?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($vehicle_incidents_update) && is_array($vehicle_incidents_update)) {
                return $vehicle_incidents_update[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Incidents not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle Incidents not updated. Please check the data and try again');
        }
    }
}
