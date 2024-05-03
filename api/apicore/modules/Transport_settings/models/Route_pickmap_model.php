<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Route_pickmap_model
 *
 * @author chandrajith.edsys
 */
class Route_pickmap_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    public function add_new_route_pick_map($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            
//            dev_export($dbparams);die;
            $route_pickuppoint_map_save = $this->db->query("[docme_transport].[route_pickuppoint_mapping_Save] ?,?,?,?", $dbparams)->result_array();
            if (!empty($route_pickuppoint_map_save) && is_array($route_pickuppoint_map_save)) {
                return $route_pickuppoint_map_save[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Route Pickup point Map not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Route Pickup point Map not added. Please check the data and try again');
        }
    }
      public function get_routepickmap_details($apikey, $query) {
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $map_details = $this->db->query("[docme_transport].[routepickmap_select] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $map_details = $this->db->query("[docme_transport].[routepickmap_select] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $map_details;
    }
      public function get_route_pickmap($dbparams) {
        $this->db->flush_cache();
         $this->db->flush_cache();
        if (is_array($dbparams)) {
            
//            dev_export($dbparams);die;
            $map_details = $this->db->query("[docme_transport].[route_pickuppoint_map_select] ?,?", $dbparams)->result_array();
        return $map_details;
    }
    }
      public function get_route_pick_maps_details_stoptime($dbparams) {
        $this->db->flush_cache();
         $this->db->flush_cache();
        if (is_array($dbparams)) {
            
//            dev_export($dbparams);die;
            $map_details = $this->db->query("[docme_transport].[route_pickuppoint_map_stoptimeselect] ?,?,?,?", $dbparams)->result_array();
        return $map_details;
    }
    }
    public function get_route_pick_maps_details($apikey, $query) {
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $map_details = $this->db->query("[docme_transport].[routepickmaps_select] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $map_details = $this->db->query("[docme_transport].[routepickmaps_select] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $map_details;
    }
}
