<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Count_model
 *
 * @author Rahul
 */
class Count_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
   public function get_active_details($apikey) {
     $this->db->flush_cache();
            $caste = $this->db->query("[docme_bookstore].[count_storesettings] ?", $apikey)->result_array();
        return $caste;  
    }
}
