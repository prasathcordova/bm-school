<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Route_tripmap_model
 *
 * @author chandrajith.edsys
 */
class Route_tripmap_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
     public function add_new_route_trip_map($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $route_trip_map_save = $this->db->query("[docme_transport].[route_trip_mapping_Save] ?,?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($route_trip_map_save) && is_array($route_trip_map_save)) {
                return $route_trip_map_save[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Route Trip Map not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Route Trip Map not added. Please check the data and try again');
        }
    }
     public function get_route_tripmap($dbparams) {
        $this->db->flush_cache();
         $this->db->flush_cache();
        if (is_array($dbparams)) {
            
//            dev_export($dbparams);die;
            $map_details = $this->db->query("[docme_transport].[Tripmaproutepickup_details_select] ?,?,?", $dbparams)->result_array();
        return $map_details;
    }
    }
     public function get_triptimemap($dbparams) {
        $this->db->flush_cache();
         $this->db->flush_cache();
        if (is_array($dbparams)) {
            
//            dev_export($dbparams);die;
            $map_details = $this->db->query("[docme_transport].[Tripmap_pickuptime_details_select] ?,?,?", $dbparams)->result_array();
        return $map_details;
    }
    }
}
