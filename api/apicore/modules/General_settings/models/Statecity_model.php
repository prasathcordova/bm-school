<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Statecity_model
 *
 * @author rahul.shibukumar
 */
class Statecity_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
     public function state_details_id($dbparams) {
        $this->db->flush_cache();   
        $data = $this->db->query("[settings].[state_city_select] ?,?",$dbparams )->result_array();
              
        return $data; 
    }
}
