<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pick_emp_dropchange_model
 *
 * @author Chandrajith
 */
class Pick_emp_dropchange_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
     public function get_emp_data($dbparams) {
        $this->db->flush_cache();
         $this->db->flush_cache();
        if (is_array($dbparams)) {           
            
            $emp_details = $this->db->query("[docme_transport].[select_emplpyee_pickpointchange] ?,?", $dbparams)->result_array();
            
            return $emp_details;
    }
    }
    public function get_trip_data($dbparams) {
        $this->db->flush_cache();
         $this->db->flush_cache();
        if (is_array($dbparams)) {           
            
            $trip_details = $this->db->query("[docme_transport].[routelinktrip_emp_select_droptripchange] ?,?,?,?", $dbparams)->result_array();
            
            return $trip_details;
    }
    }
    public function save_emp_transport_allotment($apikey,$emp_id,$allotment_data_raw,$inst_id,$acd_id) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_transport].[passenger_emp_allotmentdroptripchange_save] ?,?,?,?,?", array($apikey,$emp_id,$allotment_data_raw,$inst_id,$acd_id))->result_array();
        return $data;
    }
}
