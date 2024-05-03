<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Passenger_routewisedata_model
 *
 * @author Chandrajith
 */
class Passenger_routewisedata_model extends CI_Model{
  public function __construct() {
        parent::__construct();
    }
    public function get_routewise_data($dbparams) {
        $this->db->flush_cache();
         $this->db->flush_cache();
        if (is_array($dbparams)) {
            
//            dev_export($dbparams);die;
            $map_details = $this->db->query("[docme_transport].[routewise_student_passenger_select] ?,?,?,?", $dbparams)->result_array();
        return $map_details;
    }
    }
}
