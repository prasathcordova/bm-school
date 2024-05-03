<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dataport_model
 *
 * @author docme2
 */
class Dataport_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    public function get_auth_data_equator_data($dbparams) {
        $this->db->flush_cache();
        $dataport_data = $this->db->query("[Other_integ].[Data_port_select] ?,?",$dbparams)->result_array();        
        return $dataport_data;   
       }
}
    