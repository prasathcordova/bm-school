<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Trip_route_pickpointmap_model
 *
 * @author Chandrajith
 */
class Trip_route_pickpointmap_model extends CI_model {
    public function __construct() {
        parent::__construct();
    }

     public function save_trip_route_pickpoint($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
//            dev_export($dbparams);die;
            $trip_route_pickpoint_save = $this->db->query("[docme_transport].[triproutepickpointtime_Save] ?,?,?,?,?", $dbparams)->result_array();
            if (!empty($trip_route_pickpoint_save) && is_array($trip_route_pickpoint_save)) {
                return $trip_route_pickpoint_save[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Trip Route Pickpoint Mapping not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Trip Route Pickpoint Mapping not added. Please check the data and try again');
        }
    }
     public function get_tripmapdetails_data($dbparams) {
        $this->db->flush_cache();
         $this->db->flush_cache();
        if (is_array($dbparams)) {           
            
            $trip_details = $this->db->query("[docme_transport].[trip_route_stopz_map] ?,?,?", $dbparams)->result_array();
            
            return $trip_details;
    }
    }
}
