<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Student_allotment_model
 *
 * @author chandrajith.edsys
 */
class Student_allotment_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    public function get_trip_details($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
             
            $tripdetails = $this->db->query("[docme_transport].[Trip_details_select] ?,?,?",$dbparams)->result_array();
        }
        return $tripdetails;
    
}
    public function get_pickup_details($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
             
            $tripdetails = $this->db->query("[docme_transport].[route_pickuppoint_select] ?,?,?",$dbparams)->result_array();
        }
        return $tripdetails;
    
}
 public function save_student_transport_allotment($apikey, $student_allotment_data_final,$inst_id) {
        $this->db->flush_cache();
//        return $xml_language ;
        $data = $this->db->query("[docme_transport].[student_allotment_save] ?,?,?", array($apikey, $student_allotment_data_final,$inst_id))->result_array();
//        dev_export($data);die;
        return $data;
//        return isset($data[0]) ? $data['0'] : $data;
    }

}
