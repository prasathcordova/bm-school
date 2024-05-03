<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Passenger_deallocate_student_model
 *
 * @author Chandrajith
 */
class Passenger_deallocate_student_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
     public function get_student_detail_transportdata($dbparams) {
        $this->db->flush_cache();
         $this->db->flush_cache();
        if (is_array($dbparams)) {
            
//            dev_export($dbparams);die;
            $map_details = $this->db->query("[docme_transport].[passengerstudent_select_allotment] ?,?,?,?", $dbparams)->result_array();
        return $map_details;
    }
    }
     public function deallot_data($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $student_deallotment_data = $this->db->query("[docme_transport].[passenger_student_deallocation] ?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($student_deallotment_data) && is_array($student_deallotment_data)) {
                return $student_deallotment_data[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Deallotment failed. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Deallotment failed. Please check the data and try again');
        }
    }
     public function deallot_data_drop($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $student_deallotment_data = $this->db->query("[docme_transport].[passenger_student_deallocation_drop] ?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($student_deallotment_data) && is_array($student_deallotment_data)) {
                return $student_deallotment_data[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Deallotment failed. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Deallotment failed. Please check the data and try again');
        }
    }
}
