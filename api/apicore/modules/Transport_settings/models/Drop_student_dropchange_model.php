<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Drop_student_dropchange_model
 *
 * @author Chandrajith
 */
class Drop_student_dropchange_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
      public function get_student_data($dbparams) {
        $this->db->flush_cache();
         $this->db->flush_cache();
        if (is_array($dbparams)) {           
            
            $student_details = $this->db->query("[docme_transport].[studentfilter_select_pickpointchange] ?,?,?,?", $dbparams)->result_array();
            
            return $student_details;
    }
    }
    public function get_pickpoint_data($dbparams) {
        $this->db->flush_cache();
         $this->db->flush_cache();
        if (is_array($dbparams)) {           
            
            $student_details = $this->db->query("[docme_transport].[triplink_select_droppoint_data] ?,?,?,?", $dbparams)->result_array();
            
            return $student_details;
    }
    }
    public function get_allotmnetprev_data($dbparams) {
        $this->db->flush_cache();
         $this->db->flush_cache();
        if (is_array($dbparams)) {           
            
            $student_details = $this->db->query("[docme_transport].[previous_select_stud_allot_data_pickchnge] ?,?,?,?", $dbparams)->result_array();
            
            return $student_details;
    }
    }
     public function save_student_transport_allotment($apikey,$student_id,$allotment_data_raw,$inst_id,$acd_id) {
        $this->db->flush_cache();
        $data = $this->db->query("[docme_transport].[passenger_student_allotmentdropchange_save] ?,?,?,?,?", array($apikey,$student_id,$allotment_data_raw,$inst_id,$acd_id))->result_array();
        return $data;
    }
}
