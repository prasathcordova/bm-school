<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Medium_model
 *
 * @author docme2
 */
class Medium_model extends CI_Model{
     public function __construct() {
        parent::__construct();
    }
    
    public function get_medium_details($apikey, $query) {
     $this->db->flush_cache();
        if(strlen($query) > 0) {
            $medium = $this->db->query("[dbo].[Medium_select] ?,?,?", array(0,$apikey,$query))->result_array();
        } else {
            $medium = $this->db->query("[dbo].[Medium_select] ?,?,?", array(1,$apikey,NULL))->result_array();
        }               
        return $medium;   
    }
}
