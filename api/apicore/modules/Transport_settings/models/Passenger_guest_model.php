<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Passenger_guest_model
 *
 * @author Chandrajith
 */
class Passenger_guest_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
      public function save_guestallotmentdata($dbparams) {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $studentallotment_save = $this->db->query("[docme_transport].[triproutepickpointtime_Save] ?,?,?,?", $dbparams)->result_array();
            if (!empty($studentallotment_save) && is_array($studentallotment_save)) {
                return $studentallotment_save[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Student allotment failed. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Student allotment failed. Please check the data and try again');
        }
    }
}
