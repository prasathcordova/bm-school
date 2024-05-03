<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bus_trip_mapping_model
 *
 * @author chandrajith.edsys
 */
class Bus_trip_mapping_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    public function add_new_bus_trip_map($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $bus_trip_map_save = $this->db->query("[docme_transport].[bus_trip_mapping_Save] ?,?,?,?", $dbparams)->result_array();
            
            if (!empty($bus_trip_map_save) && is_array($bus_trip_map_save)) {
                return $bus_trip_map_save[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Bus Trip Map not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Bus Trip Map not added. Please check the data and try again');
        }
    }
}
