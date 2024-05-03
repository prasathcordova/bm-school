<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Session_model
 *
 * @author rahul.shibukumar
 */
class Session_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
            public function get_session_details($apikey, $inst_id) {
        $this->db->flush_cache();
//         echo'1231';die;
        if(strlen($inst_id) > 0) {
           
            $data = $this->db->query("[settings].[academicsession_select] ?,?", array($apikey,$inst_id))->result_array();
        } else {
            $data = $this->db->query("[settings].[academicsession_select] ?,?", array($apikey,5))->result_array();
        }        
        return $data;
    }
    
}
