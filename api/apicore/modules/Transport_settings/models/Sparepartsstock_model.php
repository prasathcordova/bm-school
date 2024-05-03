<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sparepartsstock_model
 *
 * @author Chandrajith
 */
class Sparepartsstock_model extends CI_Model{
     public function __construct() {
        parent::__construct();
    }
     public function get_parts_stockdata($dbparams) {
        $this->db->flush_cache();
         $this->db->flush_cache();
        if (is_array($dbparams)) {
            
//            dev_export($dbparams);die;
            $details = $this->db->query("[docme_transport].[sparepartsstock_select] ?,?", $dbparams)->result_array();
        return $details;
    }
    }
}
