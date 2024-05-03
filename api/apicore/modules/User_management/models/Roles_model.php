<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Role_model
 *
 * @author chandrajith.edsys
 */
class Roles_model extends CI_model {
    public function __construct() {
        parent::__construct();        
    }
    public function get_role_list($apikey, $query) {
         $this->db->flush_cache();
        if(strlen($query) > 0) {
            $role = $this->db->query("[settings].[role_select] ?,?,?", array(0,$apikey,$query))->result_array();
        } else {
            $role = $this->db->query("[settings].[role_select] ?,?,?", array(1,$apikey,NULL))->result_array();
        }        
        return $role; 
        
    }
    public function add_new_role($dbparams) {
         $this->db->flush_cache();
        if(is_array($dbparams)) {
            $role = $this->db->query("[settings].[role_save] ?,?,?",$dbparams )->result_array();            
            if(!empty($role) && is_array($role)) {
                return $role[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Role not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Role not added. Please check the data and try again');
        }
    }
    public function update_role_data($dbparams) {
         $this->db->flush_cache();
        if(is_array($dbparams)) {
            $role = $this->db->query("[settings].[role_update] ?,?,?,?,?,?",$dbparams )->result_array();            
            if(!empty($role) && is_array($role)) {
                return $role[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Role not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Role not updated. Please check the data and try again');
        }
    }
   
        
}
