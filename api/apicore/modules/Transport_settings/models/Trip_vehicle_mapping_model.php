<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Trip_vehicle_mapping_model
 *
 * @author Chandrajith
 */
class Trip_vehicle_mapping_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function add_new_vehicletripmap($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $vehicle_trip_save = $this->db->query("[docme_transport].[trip_vehicle_map_Save] ?,?,?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($vehicle_trip_save) && is_array($vehicle_trip_save)) {
                return $vehicle_trip_save[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle mapping to trip not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Vehicle mapping to trip not added. Please check the data and try again');
        }
    }

    public function get_trip_link_vehicdata($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {

            $vhi_details = $this->db->query("[docme_transport].[data_vehicletriplink] ?,?,?", $dbparams)->result_array();

            return $vhi_details;
        }
    }

    public function get_unallotted_vehicle_data($dbparams)
    {
        $this->db->flush_cache();
        $param_string = procedure_param_string($dbparams);
        if (is_array($dbparams)) {

            $vhi_details = $this->db->query("[docme_transport].[unallotted_vehicle_select] $param_string", $dbparams)->result_array();

            return $vhi_details;
        }
    }
    public function get_trip_link_vehicle($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {

            $vhi_details = $this->db->query("[docme_transport].[vehiclereg_select] ?,?,?", $dbparams)->result_array();

            return $vhi_details;
        }
    }
}
