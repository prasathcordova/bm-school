<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Student_deallocate_model
 *
 * @author chandrajith.edsys
 */
class Student_deallocate_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
     public function get_trip_allotted_students($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
             
            $tripdetails = $this->db->query("[docme_transport].[Trip_allotted_students_select] ?,?,?",$dbparams)->result_array();
        }
        return $tripdetails;
    
}
 public function update_student_allotted_data($dbparams) {
          
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $studentallocation_update = $this->db->query("[docme_transport].[student_deallocation_save] ?,?", $dbparams)->result_array();
            if (!empty($studentallocation_update) && is_array($studentallocation_update)) {
                return $studentallocation_update[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Student Fail to Deallocate From Transport. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Student Deallocated Sucessfully. Please check the data and try again');
        }
    }
}
