<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of state_model
 *
 * @author chandrajith.edsys
 */
class State_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    public function get_state_details($apikey, $query) {
        $this->db->flush_cache();
        if(strlen($query) > 0) {
            $state = $this->db->query("[settings].[state_select] ?,?,?", array(0,$apikey,$query))->result_array();
        } else {
            $state = $this->db->query("[settings].[state_select] ?,?,?", array(1,$apikey,NULL))->result_array();
        }        
        return $state;
    }
    
    public function add_new_state($dbparams) {
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $state = $this->db->query("[settings].[state_save] ?,?,?,?",$dbparams )->result_array();            
            if(!empty($state) && is_array($state)) {
                return $state[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'State not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'State not added. Please check the data and try again');
        }
    }
    
    public function update_state_data($dbparams) {
        $this->db->flush_cache();
        if(is_array($dbparams)) {
            $state = $this->db->query("[settings].[state_update] ?,?,?,?,?,?,?",$dbparams )->result_array(); 
//            dev_export($state);die;
            if(!empty($state) && is_array($state)) {
                return $state[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'State not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'State not updated. Please check the data and try again');
        }
    }
}

