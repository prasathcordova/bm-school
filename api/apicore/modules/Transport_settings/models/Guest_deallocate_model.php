<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Guest_deallocate_model
 *
 * @author chandrajith.edsys
 */
class Guest_deallocate_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
     public function get_trip_allotted_guests($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
             
            $tripdetails = $this->db->query("[docme_transport].[Trip_allotted_guest_select] ?,?,?",$dbparams)->result_array();
        }
        return $tripdetails;
    
}
 public function update_guests_allotted_data($dbparams) {
          
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $guestallocation_update = $this->db->query("[docme_transport].[guest_deallocation_save] ?,?", $dbparams)->result_array();
            if (!empty($guestallocation_update) && is_array($guestallocation_update)) {
                return $guestallocation_update[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Employee Fail to Deallocate From Transport. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Employee Deallocated Sucessfully. Please check the data and try again');
        }
    }
}
