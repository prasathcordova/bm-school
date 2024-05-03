<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Passenger_staff_model
 *
 * @author Chandrajith
 */
class Passenger_staff_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_staff_details($dbparams) {
        $this->db->flush_cache();

        if (is_array($dbparams)) {
            $staff_details = $this->db->query("[docme_transport].[staff_select_allotment_transport] ?,?", $dbparams)->result_array();
            return $staff_details;
        }
    }
     public function get_trip_route_pickuppoints_emp($dbparams) {
        $this->db->flush_cache();
         $this->db->flush_cache();
        if (is_array($dbparams)) {
            
//            dev_export($dbparams);die;
            $map_details = $this->db->query("[docme_transport].[pickuppoint_select_allotment_emp] ?,?,?", $dbparams)->result_array();
        return $map_details;
    }
    }
      public function save_employee_transport_allotment($apikey, $emp_allotment_data_final,$inst_id,$acd_id) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_transport].[passenger_employee_allotment_save] ?,?,?,?", array($apikey, $emp_allotment_data_final,$inst_id,$acd_id))->result_array();
        return $data;
    }
      public function save_employee_transport_allotment_pick($apikey, $emp_allotment_data_final,$inst_id,$acd_id) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_transport].[passenger_employee_allotment_save_pick] ?,?,?,?", array($apikey, $emp_allotment_data_final,$inst_id,$acd_id))->result_array();
        return $data;
    }
      public function save_employee_transport_allotment_drop($apikey, $emp_allotment_data_final,$inst_id,$acd_id) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_transport].[passenger_employee_allotment_save_drop] ?,?,?,?", array($apikey, $emp_allotment_data_final,$inst_id,$acd_id))->result_array();
        return $data;
    }

}
