<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Passenger_student_diff_route_model
 *
 * @author Chandrajith
 */
class Passenger_student_diff_route_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    public function get_trip_route_pickuppoints($dbparams) {
        $this->db->flush_cache();
         $this->db->flush_cache();
        if (is_array($dbparams)) {
            
//            dev_export($dbparams);die;
            $map_details = $this->db->query("[docme_transport].[pickuppoint_select_allotment] ?,?,?", $dbparams)->result_array();
        return $map_details;
    }
    }
     public function get_trip_pickuppoints($dbparams) {
        $this->db->flush_cache();
         $this->db->flush_cache();
        if (is_array($dbparams)) {
            
//            dev_export($dbparams);die;
            $map_details = $this->db->query("[docme_transport].[trip_select_passenger_allotment] ?,?,?", $dbparams)->result_array();
        return $map_details;
    }
    }

    public function save_student_transport_allotment($apikey, $student_allotment_data_final,$inst_id,$acd_id) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_transport].[passenger_student_allotment_save] ?,?,?,?", array($apikey, $student_allotment_data_final,$inst_id,$acd_id))->result_array();
        return $data;
    }
    public function save_student_transport_allotment_pick($apikey, $student_allotment_data_final,$inst_id,$acd_id) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_transport].[passenger_student_allotment_pickonly_save] ?,?,?,?", array($apikey, $student_allotment_data_final,$inst_id,$acd_id))->result_array();
        return $data;
    }
    public function save_student_transport_allotment_drop($apikey, $student_allotment_data_final,$inst_id,$acd_id) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_transport].[passenger_student_allotment_diff_route_save] ?,?,?,?", array($apikey, $student_allotment_data_final,$inst_id,$acd_id))->result_array();
        return $data;
    }
}
