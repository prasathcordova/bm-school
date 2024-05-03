<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Active_model
 *
 * @author docme2
 */
class Active_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    
    public function get_active_details($apikey) {
     $this->db->flush_cache();
            $active = $this->db->query("[dbo].[Active_count] ?", $apikey)->result_array();
        return $active;   
    }
}
